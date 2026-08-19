<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\InputStream;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\BitExprContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\BoolPriContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\ColumnRefContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\ExprContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\ExprIsContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\FieldIdentifierContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\FromClauseContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\FunctionCallContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\JoinedTableContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\LiteralContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\LiteralOrNullContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\PredicateContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\PrimaryExprPredicateContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\QueryExpressionBodyContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SelectAliasContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SelectItemContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SelectItemListContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SelectStatementContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SimpleExprCaseContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SimpleExprColumnRefContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SimpleExprContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SimpleExprFunctionContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SimpleExprLiteralContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SimpleExprSumContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SimpleExprUnaryContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SingleTableContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\SumExprContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\TableFactorContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\TableRefContext;
use Bleksak\MagoPdoExtension\Sql\MySql\Context\TableReferenceContext;
use Bleksak\MagoPdoExtension\Sql\MySql\MySQLLexer;
use Bleksak\MagoPdoExtension\Sql\MySql\MySQLParser;
use ReflectionClass;
use ReflectionProperty;
use Throwable;

use function count;
use function dirname;
use function error_reporting;
use function file_get_contents;
use function hash;
use function is_array;
use function is_file;
use function preg_match;
use function preg_replace_callback;
use function serialize;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strcasecmp;
use function strlen;
use function substr;
use function unserialize;

/**
 * Parses a MySQL SELECT statement into the shared SelectQuery model using
 * the ANTLR-generated MySQL parser.
 *
 * The statement must already have been checked against the database; this
 * parser only decides what shape its result has. A null result means the
 * statement cannot be classified, and callers must fall back to unrefined
 * types.
 *
 * @internal
 */
final class MySqlSelectParser
{
    public const int WARM_CACHE_VERSION = 1;

    /**
     * The warm cache check runs once per process: the ANTLR statics are
     * process-wide, so retrying hydration after the first attempt —
     * successful or skipped — can never change the outcome.
     */
    private static bool $warmCacheTried = false;

    public function parse(string $sql): ?SelectQuery
    {
        self::ensureWarmCache();

        $input = self::replaceNamedPlaceholders($sql);

        $lexer = new MySQLLexer(InputStream::fromString($input));
        $parser = new MySQLParser(new CommonTokenStream($lexer));
        $failures = new MySqlParseFailureListener();
        $parser->removeErrorListeners();
        $parser->addErrorListener($failures);

        $root = $parser->simpleStatement();

        if ($failures->failed) {
            return null;
        }

        $select = $root?->selectStatement();

        if ($select === null) {
            return null;
        }

        return $this->fromSelect($select);
    }

    /**
     * Hydrates the ANTLR static prediction caches from the prebuilt warm
     * cache shipped with the package, when one exists and matches the
     * current grammar.
     *
     * The generated MySQLParser keeps its DFA and prediction-context caches
     * as class statics: shared process-wide, but empty in a fresh process,
     * where every new query shape pays a ~1 s full ATN simulation. The warm
     * cache (built by tools/warmup/build-warm-cache.php) covers the common
     * query shapes, dropping covered parses to a few milliseconds.
     *
     * Hydration must happen before the first MySQLParser is constructed —
     * guaranteed here, because parse() is the only place in this package
     * that constructs one. A missing, stale or corrupt blob is a silent
     * no-op: this is a performance optimization and must never break
     * analysis.
     */
    public static function ensureWarmCache(?string $path = null): void
    {
        if (self::$warmCacheTried) {
            return;
        }
        self::$warmCacheTried = true;

        // The 9k-state ATN graph exceeds unserialize()'s default depth.
        if (PHP_VERSION_ID < 80_100) {
            return;
        }

        $path ??= dirname(__DIR__, 2) . '/gen/mysql-warm-cache.bin';

        if (is_file($path) === false) {
            return;
        }

        // A corrupt blob must be a silent no-op: suppress the warnings a
        // truncated payload would otherwise emit into the analyzer output.
        $errorLevel = error_reporting(E_ALL & ~E_WARNING);

        try {
            $data = unserialize((string) file_get_contents($path), [
                'max_depth' => 1_000_000,
            ]);
        } catch (Throwable) {
            return;
        } finally {
            error_reporting($errorLevel);
        }

        if (
            !is_array($data)
            || ($data['version'] ?? null) !== self::WARM_CACHE_VERSION
            || !isset($data['atn'], $data['dfa'], $data['ctx'])
        ) {
            return;
        }

        // Invalidate the cache when the grammar changed since it was built.
        // The serialized ATN is an int array in the PHP target.
        $atnConstant = new ReflectionClass(MySQLParser::class)->getConstant(
            'SERIALIZED_ATN',
        );
        $atnHash = hash('sha256', (string) serialize($atnConstant));

        if (($data['atnHash'] ?? null) !== $atnHash) {
            return;
        }

        // A parser constructed before hydration binds its simulators to the
        // fresh statics; never mix hydrated and fresh caches.
        if (self::staticValue(MySQLParser::class, 'atn') !== null) {
            return;
        }

        self::setStaticValue(MySQLParser::class, 'atn', $data['atn']);
        self::setStaticValue(MySQLParser::class, 'decisionToDFA', $data['dfa']);
        self::setStaticValue(
            MySQLParser::class,
            'sharedContextCache',
            $data['ctx'],
        );
    }

    private static function staticValue(string $class, string $name): mixed
    {
        // No setAccessible: hydration only runs on PHP 8.1+, where
        // reflection access is unrestricted.
        $property = new ReflectionProperty($class, $name);

        return $property->getValue();
    }

    private static function setStaticValue(
        string $class,
        string $name,
        mixed $value,
    ): void {
        $property = new ReflectionProperty($class, $name);
        $property->setValue(null, $value);
    }

    /**
     * Rewrites PDO named placeholders like :id to the positional ? marker
     * the server grammar knows. Literal-aware so placeholder-looking text
     * inside strings and comments is untouched.
     */
    private static function replaceNamedPlaceholders(string $sql): string
    {
        $length = strlen($sql);
        $result = '';
        $quote = null;
        $comment = false;

        for ($index = 0; $index < $length; $index++) {
            $character = $sql[$index];

            if ($comment) {
                $result .= $character;

                if ($character === "\n") {
                    $comment = false;
                }

                continue;
            }

            if ($quote !== null) {
                $result .= $character;

                if ($character === '\\' && $quote !== 'b') {
                    $next = $sql[$index + 1] ?? null;

                    if ($next !== null) {
                        $result .= $next;
                        $index++;
                    }

                    continue;
                }

                if ($character === $quote) {
                    $quote = null;
                }

                continue;
            }

            if ($character === "'" || $character === '"') {
                $quote = $character;
                $result .= $character;
                continue;
            }

            if ($character === '`') {
                $quote = 'b';
                $result .= $character;
                continue;
            }

            if (
                $character === '-' && ($sql[$index + 1] ?? '') === '-'
                || $character === '#'
            ) {
                $comment = true;
                $result .= $character;
                continue;
            }

            if (
                $character === ':'
                && ($sql[$index - 1] ?? '') !== ':'
                && preg_match('/[A-Za-z_]/', $sql[$index + 1] ?? '') === 1
            ) {
                $result .= '?';

                $index++;

                while (
                    ($index + 1) < $length
                    && preg_match('/[A-Za-z0-9_]/', $sql[$index + 1]) === 1
                ) {
                    $index++;
                }

                continue;
            }

            $result .= $character;
        }

        return $result;
    }

    private function fromSelect(SelectStatementContext $select): ?SelectQuery
    {
        if ($select->selectStatementWithInto() !== null) {
            return null;
        }

        $query = $select->queryExpression();

        if ($query === null) {
            return null;
        }

        // CTEs and compound SELECTs are not supported yet.
        if (
            $query->withClause() !== null
            || $this->isCompound($query->queryExpressionBody())
        ) {
            return null;
        }

        $primary = $query->queryExpressionBody()?->queryPrimary();

        if ($primary === null) {
            return null;
        }

        $specification = $primary->querySpecification();

        if ($specification === null) {
            return null;
        }

        $columns = $this->columns($specification->selectItemList());

        if ($columns === null) {
            return null;
        }

        $from = $specification->fromClause();
        $tables = $from === null ? [] : $this->tables($from);

        if ($tables === null) {
            return null;
        }

        return new SelectQuery($tables, $columns);
    }

    private function isCompound(?QueryExpressionBodyContext $body): bool
    {
        if ($body === null) {
            return true;
        }

        return count($body->UNION_SYMBOL()) > 0;
    }

    /**
     * @return list<SelectedColumn>|null
     */
    private function columns(SelectItemListContext $context): ?array
    {
        if ($context->MULT_OPERATOR() !== null) {
            return [
                new SelectedColumn('*', SelectedColumnKind::Star),
            ];
        }

        $columns = [];

        foreach ($context->selectItem() as $item) {
            $column = $this->column($item);

            if ($column === null) {
                return null;
            }

            $columns[] = $column;
        }

        return $columns;
    }

    private function column(SelectItemContext $item): ?SelectedColumn
    {
        $alias = $this->alias($item->selectAlias());

        $wild = $item->tableWild();

        if ($wild !== null) {
            // db.table.*: the qualifier is the table, i.e. the last
            // identifier before the dot-star.
            $identifiers = $wild->identifier();
            $last = $identifiers === []
                ? null
                : $identifiers[count($identifiers) - 1];
            $qualifiedBy = $last === null
                ? null
                : self::unquoteIdentifier((string) $last->getText());

            return new SelectedColumn(
                $alias ?? '*',
                SelectedColumnKind::Star,
                qualifiedBy: $qualifiedBy === '' ? null : $qualifiedBy,
            );
        }

        $expression = $item->expr();

        if ($expression === null) {
            return null;
        }

        $column = $this->classify($expression);

        if ($column === null) {
            return null;
        }

        $column->key = $alias ?? $column->key;

        return $column;
    }

    private function alias(?SelectAliasContext $alias): ?string
    {
        if ($alias === null) {
            return null;
        }

        $identifier = $alias->identifier();

        if ($identifier !== null) {
            return self::unquoteIdentifier((string) $identifier->getText());
        }

        $literal = $alias->textStringLiteral();

        if ($literal !== null) {
            return self::unquoteString((string) $literal->getText());
        }

        return null;
    }

    /**
     * @return list<SourceTable>|null
     */
    private function tables(FromClauseContext $context): ?array
    {
        if ($context->DUAL_SYMBOL() !== null) {
            return [];
        }

        $list = $context->tableReferenceList();

        if ($list === null) {
            return null;
        }

        $tables = [];

        foreach ($list->tableReference() as $reference) {
            $walked = $this->tableReference($reference, false);

            if ($walked === null) {
                return null;
            }

            $tables = [...$tables, ...$walked];
        }

        return $tables;
    }

    /**
     * @return list<SourceTable>|null
     */
    private function tableReference(
        TableReferenceContext $context,
        bool $left,
    ): ?array {
        $factor = $context->tableFactor();

        if ($factor === null) {
            return null;
        }

        $base = $this->tableFactor($factor, $left);

        if ($base === null) {
            return null;
        }

        $tables = $base;

        foreach ($context->joinedTable() as $join) {
            $joined = $this->joinedTable($join);

            if ($joined === null) {
                return null;
            }

            $tables = [...$tables, ...$joined];
        }

        return $tables;
    }

    /**
     * @return list<SourceTable>|null
     */
    private function joinedTable(JoinedTableContext $context): ?array
    {
        $left = null;

        if ($context->outerJoinType() !== null) {
            // RIGHT JOINs cannot be represented: the left-joined nullability
            // model only applies to the right side of a join.
            if ($context->outerJoinType()->LEFT_SYMBOL() === null) {
                return null;
            }

            $left = true;
        } else {
            $left = false;
        }

        $reference = $context->tableReference();

        if ($reference !== null) {
            return $this->tableReference($reference, (bool) $left);
        }

        // NATURAL joins reference a table factor directly.
        $factor = $context->tableFactor();

        if ($factor === null) {
            return null;
        }

        return $this->tableFactor($factor, (bool) $left);
    }

    /**
     * @return list<SourceTable>|null
     */
    private function tableFactor(
        TableFactorContext $context,
        bool $left,
    ): ?array {
        $table = $context->singleTable();

        if ($table === null) {
            return null;
        }

        return $this->singleTable($table, $left);
    }

    /**
     * @return list<SourceTable>|null
     */
    private function singleTable(
        SingleTableContext $context,
        bool $left,
    ): ?array {
        $name = $this->tableName($context->tableRef());

        if ($name === null) {
            return null;
        }

        $aliasContext = $context->tableAlias();
        $alias = $aliasContext === null
            ? null
            : self::unquoteIdentifier(
                (string) ($aliasContext->identifier()?->getText() ?? ''),
            );

        return [
            new SourceTable($name, $alias === '' ? null : $alias, $left),
        ];
    }

    private function tableName(?TableRefContext $context): ?string
    {
        if ($context === null) {
            return null;
        }

        $qualified = $context->qualifiedIdentifier();

        if ($qualified !== null) {
            $base = $qualified->identifier();

            if ($base === null) {
                return null;
            }

            $suffix = $qualified->dotIdentifier();

            return self::unquoteIdentifier(
                (string) (
                    $suffix?->identifier()?->getText() ?? $base->getText() ?? ''
                ),
            );
        }

        $dot = $context->dotIdentifier();

        if ($dot === null) {
            return null;
        }

        $identifier = $dot->identifier();

        if ($identifier === null) {
            return null;
        }

        return self::unquoteIdentifier((string) $identifier->getText());
    }

    /**
     * Classifies a selected expression. Returns null only when the
     * expression structure cannot be walked at all.
     */
    private function classify(ExprContext $expression): ?SelectedColumn
    {
        $simple = $this->valueExpression($expression);

        if ($simple === null) {
            return new SelectedColumn(
                $expression->getText(),
                SelectedColumnKind::Expression,
            );
        }

        return $this->classifySimple($simple, $expression->getText());
    }

    /**
     * Walks down to the value expression of a selected column, returning
     * null when a boolean or comparison layer makes the value indistinct.
     */
    private function valueExpression(ExprContext $expression): ?SimpleExprContext
    {
        if (!$expression instanceof ExprIsContext) {
            // Boolean combinations (NOT, AND, OR, XOR) have no distinct
            // value shape.
            return null;
        }

        if ($expression->IS_SYMBOL() !== null) {
            return null;
        }

        $boolPri = $expression->boolPri();

        if ($boolPri === null) {
            return null;
        }

        return $this->valueBoolPri($boolPri);
    }

    private function valueBoolPri(BoolPriContext $boolPri): ?SimpleExprContext
    {
        if (!$boolPri instanceof PrimaryExprPredicateContext) {
            // IS, comparisons and ALL/ANY subqueries have no distinct
            // value shape.
            return null;
        }

        $predicate = $boolPri->predicate();

        if ($predicate === null) {
            return null;
        }

        return $this->valuePredicate($predicate);
    }

    private function valuePredicate(PredicateContext $predicate): ?SimpleExprContext
    {
        if (
            $predicate->predicateOperations() !== null
            || $predicate->simpleExprWithParentheses() !== null
        ) {
            return null;
        }

        $bit = $predicate->bitExpr(0);

        if ($bit === null) {
            return null;
        }

        return $this->valueBitExpr($bit);
    }

    private function valueBitExpr(BitExprContext $bit): ?SimpleExprContext
    {
        // A binary operation keeps the left operand in the same context
        // chain; only a bare simple expression yields a distinct value.
        if ($bit->getChildCount() !== 1) {
            return null;
        }

        return $bit->simpleExpr();
    }

    private function classifySimple(
        SimpleExprContext $simple,
        string $text,
    ): ?SelectedColumn {
        if ($simple instanceof SimpleExprColumnRefContext) {
            if ($simple->jsonOperator() !== null) {
                return new SelectedColumn(
                    $text,
                    SelectedColumnKind::Expression,
                );
            }

            return $this->columnRef($simple->columnRef(), $text);
        }

        if ($simple instanceof SimpleExprFunctionContext) {
            return $this->functionCall($simple->functionCall(), $text);
        }

        if ($simple instanceof SimpleExprSumContext) {
            return $this->sum($simple->sumExpr(), $text);
        }

        if ($simple instanceof SimpleExprCaseContext) {
            return $this->caseBranches($simple, $text);
        }

        if ($simple instanceof SimpleExprLiteralContext) {
            return $this->literal($simple->literalOrNull(), $text);
        }

        if ($simple instanceof SimpleExprUnaryContext) {
            return $this->unary($simple, $text);
        }

        return new SelectedColumn($text, SelectedColumnKind::Expression);
    }

    private function columnRef(
        ?ColumnRefContext $context,
        string $text,
    ): ?SelectedColumn {
        $field = $context?->fieldIdentifier();

        if ($field === null) {
            return null;
        }

        [$qualifiedBy, $column] = $this->fieldParts($field);

        if ($column === null || $column === '') {
            return null;
        }

        return new SelectedColumn(
            $column,
            SelectedColumnKind::Column,
            column: $column,
            qualifiedBy: $qualifiedBy,
        );
    }

    /**
     * @return array{0: ?string, 1: ?string} Qualifier and column name.
     */
    private function fieldParts(FieldIdentifierContext $field): array
    {
        $qualified = $field->qualifiedIdentifier();

        if ($qualified === null) {
            $dot = $field->dotIdentifier();
            $identifier = $dot?->identifier();

            if ($identifier === null) {
                return [null, null];
            }

            return [
                null,
                self::unquoteIdentifier((string) $identifier->getText()),
            ];
        }

        $base = $qualified->identifier();

        if ($base === null) {
            return [null, null];
        }

        $baseName = self::unquoteIdentifier((string) $base->getText());
        $suffix = $qualified->dotIdentifier();

        if ($suffix === null) {
            return [null, $baseName === '' ? null : $baseName];
        }

        $second = $suffix->identifier();
        $secondName = $second === null
            ? null
            : self::unquoteIdentifier((string) $second->getText());

        // db.table.column: the qualifier is the table, not the database.
        $outer = $field->dotIdentifier();

        if ($outer !== null) {
            $third = $outer->identifier();
            $thirdName = $third === null
                ? null
                : self::unquoteIdentifier((string) $third->getText());

            return [
                $secondName === '' ? null : $secondName,
                $thirdName === '' ? null : $thirdName,
            ];
        }

        return [
            $baseName === '' ? null : $baseName,
            $secondName === '' ? null : $secondName,
        ];
    }

    private function functionCall(
        ?FunctionCallContext $context,
        string $text,
    ): ?SelectedColumn {
        if ($context === null) {
            return null;
        }

        [$name, $arguments] = $this->callArguments($context);

        if ($name === null) {
            return null;
        }

        if (
            strcasecmp($name, 'concat') === 0
            || strcasecmp($name, 'concat_ws') === 0
        ) {
            $operands = [];

            foreach ($arguments as $argument) {
                $operand = $this->classify($argument);

                if ($operand === null) {
                    return null;
                }

                $operands[] = $operand;
            }

            return new SelectedColumn(
                $text,
                SelectedColumnKind::Concat,
                operands: $operands,
            );
        }

        return new SelectedColumn($text, SelectedColumnKind::Expression);
    }

    /**
     * @return array{0: ?string, 1: list<ExprContext>}
     */
    private function callArguments(FunctionCallContext $context): array
    {
        $pure = $context->pureIdentifier();

        if ($pure !== null) {
            $name = self::unquoteIdentifier(
                (string) ($pure->identifier()?->getText() ?? ''),
            );

            $list = $context->udfExprList();
            $arguments = [];

            if ($list !== null) {
                foreach ($list->udfExpr() as $expression) {
                    $argument = $expression->expr();

                    if ($argument === null) {
                        return [null, []];
                    }

                    $arguments[] = $argument;
                }
            }

            return [$name === '' ? null : $name, $arguments];
        }

        $qualified = $context->qualifiedIdentifier();

        if ($qualified === null) {
            return [null, []];
        }

        [$qualifier, $name] = [
            self::unquoteIdentifier(
                (string) ($qualified->identifier()?->getText() ?? ''),
            ),
            null,
        ];

        $suffix = $qualified->dotIdentifier();

        if ($suffix !== null) {
            $name = self::unquoteIdentifier(
                (string) ($suffix->identifier()?->getText() ?? ''),
            );
        }

        $arguments = [];

        if ($context->exprList() !== null) {
            foreach ($context->exprList()->expr() as $argument) {
                $arguments[] = $argument;
            }
        }

        return [
            $name === null || $name === '' ? $qualifier : $name,
            $arguments,
        ];
    }

    private function sum(
        ?SumExprContext $context,
        string $text,
    ): ?SelectedColumn {
        if ($context === null || $context->COUNT_SYMBOL() === null) {
            return new SelectedColumn($text, SelectedColumnKind::Expression);
        }

        $inner = null;

        if ($context->inSumExpr() !== null) {
            $argument = $context->inSumExpr()->expr();

            if ($argument !== null) {
                $inner = $this->valueExpression($argument);
            }
        }

        $column = $inner instanceof SimpleExprColumnRefContext
            ? $this->columnRef($inner->columnRef(), (string) $inner->getText())
            : null;

        return new SelectedColumn(
            $text,
            SelectedColumnKind::Count,
            column: $column?->column,
        );
    }

    private function caseBranches(
        SimpleExprCaseContext $context,
        string $text,
    ): ?SelectedColumn {
        $operands = [];

        foreach ($context->thenExpression() as $branch) {
            $expression = $branch->expr();

            if ($expression === null) {
                return null;
            }

            $classified = $this->classify($expression);

            if ($classified === null) {
                return null;
            }

            $operands[] = $classified;
        }

        $else = $context->elseExpression();
        $elseExpression = $else?->expr();

        if ($else !== null && $elseExpression === null) {
            return null;
        }

        if ($elseExpression !== null) {
            $branch = $this->classify($elseExpression);

            if ($branch === null) {
                return null;
            }

            $operands[] = $branch;
        }

        return new SelectedColumn(
            $text,
            SelectedColumnKind::Case,
            operands: $operands,
            hasElse: $else !== null,
        );
    }

    private function literal(
        ?LiteralOrNullContext $context,
        string $text,
    ): ?SelectedColumn {
        $literal = $context?->literal();

        if ($literal === null) {
            // nullAsLiteral (NULL keyword as a literal, MySQL 8.0.24+).
            return new SelectedColumn('NULL', SelectedColumnKind::LiteralNull);
        }

        return $this->literalValue($literal, $text);
    }

    private function literalValue(
        LiteralContext $literal,
        string $text,
    ): ?SelectedColumn {
        if ($literal->nullLiteral() !== null) {
            return new SelectedColumn('NULL', SelectedColumnKind::LiteralNull);
        }

        $number = $literal->numLiteral();

        if ($number !== null) {
            $integer = $number->int64Literal();

            if ($integer !== null && $this->isInteger($integer->getText())) {
                return new SelectedColumn(
                    $text,
                    SelectedColumnKind::LiteralInt,
                    literalInt: (int) $integer->getText(),
                );
            }

            return new SelectedColumn($text, SelectedColumnKind::Expression);
        }

        $textLiteral = $literal->textLiteral();

        if ($textLiteral !== null) {
            $string = null;

            foreach ($textLiteral->textStringLiteral() as $part) {
                $piece = self::unquoteString((string) $part->getText());
                $string = $string === null ? $piece : $string . $piece;
            }

            if ($string !== null) {
                return new SelectedColumn(
                    $text,
                    SelectedColumnKind::LiteralString,
                    literalString: $string,
                );
            }
        }

        return new SelectedColumn($text, SelectedColumnKind::Expression);
    }

    private function isInteger(string $text): bool
    {
        return preg_match('/^-?\d+$/', (string) $text) === 1;
    }

    private function unary(
        SimpleExprUnaryContext $context,
        string $text,
    ): ?SelectedColumn {
        $inner = $context->simpleExpr();

        if ($inner === null) {
            return null;
        }

        $column = $this->classifySimple($inner, (string) $inner->getText());

        if ($column === null) {
            return null;
        }

        if ($context->MINUS_OPERATOR() !== null) {
            if ($column->kind === SelectedColumnKind::LiteralInt) {
                return new SelectedColumn(
                    $text,
                    SelectedColumnKind::LiteralInt,
                    literalInt: ($column->literalInt ?? 0) * -1,
                );
            }

            return new SelectedColumn($text, SelectedColumnKind::Expression);
        }

        if ($context->PLUS_OPERATOR() !== null) {
            $column->key = $text;

            return $column;
        }

        return new SelectedColumn($text, SelectedColumnKind::Expression);
    }

    private static function unquoteIdentifier(string $identifier): string
    {
        if (
            str_starts_with($identifier, '`') && str_ends_with($identifier, '`')
        ) {
            return str_replace('``', '`', (string) substr($identifier, 1, -1));
        }

        if (
            str_starts_with($identifier, '"') && str_ends_with($identifier, '"')
        ) {
            return str_replace('""', '"', (string) substr($identifier, 1, -1));
        }

        return $identifier;
    }

    private static function unquoteString(string $literal): string
    {
        if (str_starts_with($literal, "'") && str_ends_with($literal, "'")) {
            $body = (string) substr($literal, 1, -1);
            $unquoted = self::unescape($body);

            return str_replace("''", "'", $unquoted);
        }

        if (str_starts_with($literal, '"') && str_ends_with($literal, '"')) {
            $body = (string) substr($literal, 1, -1);
            $unquoted = self::unescape($body);

            return str_replace('""', '"', $unquoted);
        }

        return $literal;
    }

    private static function unescape(string $body): string
    {
        return (string) preg_replace_callback(
            '/\\\\(.)/s',
            static fn(array $m): string => match ($m[1]) {
                'n' => "\n",
                'r' => "\r",
                't' => "\t",
                '0' => "\0",
                'Z' => "\x1a",
                'b' => "\x08",
                '\\' => '\\',
                "'" => "'",
                '"' => '"',
                default => $m[1],
            },
            $body,
        );
    }
}
