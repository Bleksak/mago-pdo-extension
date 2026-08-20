<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

use Bleksak\MagoPdoExtension\Mago\Analyzer\ExplainableQuery;
use PhpMyAdmin\SqlParser\Components\CaseExpression;
use PhpMyAdmin\SqlParser\Components\Expression;
use PhpMyAdmin\SqlParser\Lexer;
use PhpMyAdmin\SqlParser\Parser;
use PhpMyAdmin\SqlParser\Statements\SelectStatement;
use Throwable;

use function count;
use function explode;
use function preg_match;
use function str_ends_with;
use function strcasecmp;
use function strpos;
use function strtoupper;
use function substr;
use function trim;

/**
 * Parses a MySQL SELECT with phpmyadmin/sql-parser into the SelectQuery
 * model, producing the same classification as the legacy SelectParser:
 * the same SelectedColumn kinds, keys, operands and hasElse flags.
 *
 * Returns null (the provider stays silent) whenever the statement cannot
 * be parsed or is not a plain single-table-source SELECT.
 *
 * @internal
 */
final class PmaSelectParser
{
    /**
     * @return SelectQuery|null
     */
    public static function parse(string $sql): ?SelectQuery
    {
        $statement = trim(ExplainableQuery::firstStatement($sql));

        try {
            $lexer = new Lexer($statement);
            $parser = new Parser($lexer->list);
            $parser->parse();
        } catch (Throwable) {
            return null;
        }

        if (count($parser->statements) !== 1) {
            return null;
        }

        $select = $parser->statements[0] ?? null;

        if ($select instanceof SelectStatement === false) {
            return null;
        }

        // Parity with SelectParser: UNIONs are not supported.
        if ($select->union !== []) {
            return null;
        }

        $tables = self::tables($select);

        if ($tables === null || $tables === []) {
            return null;
        }

        $columns = self::columns($select);

        if ($columns === null || $columns === []) {
            return null;
        }

        return new SelectQuery($tables, $columns);
    }

    /**
     * @return list<SourceTable>|null
     */
    private static function tables(SelectStatement $select): ?array
    {
        $tables = [];

        foreach ($select->from as $item) {
            // Parity with SelectParser: derived tables are not supported.
            if (
                $item->table === null
                || $item->table === ''
                || $item->subquery !== null
            ) {
                return null;
            }

            $tables[] = new SourceTable($item->table, $item->alias);
        }

        foreach ($select->join ?? [] as $join) {
            $type = strtoupper((string) $join->type);

            // RIGHT/FULL joins extend the previous tables with NULL rows.
            if ($type === 'RIGHT' || $type === 'FULL') {
                foreach ($tables as $left) {
                    $left->leftJoined = true;
                }
            }

            $expr = $join->expr;

            if (
                $expr instanceof Expression === false
                || $expr->table === null
                || $expr->table === ''
                || $expr->subquery !== null
            ) {
                return null;
            }

            $tables[] = new SourceTable(
                $expr->table,
                $expr->alias,
                $type === 'LEFT' || $type === 'FULL',
            );
        }

        return $tables;
    }

    /**
     * @return list<SelectedColumn>|null
     */
    private static function columns(SelectStatement $select): ?array
    {
        $columns = [];

        foreach ($select->expr as $item) {
            $column = $item instanceof CaseExpression
                ? self::caseColumn($item)
                : self::classify($item);

            if ($column === null) {
                return null;
            }

            $columns[] = $column;
        }

        return $columns;
    }

    private static function caseColumn(CaseExpression $case): ?SelectedColumn
    {
        $branches = [];

        foreach ($case->results as $result) {
            $operand = self::classify($result);

            if ($operand === null) {
                return null;
            }

            $branches[] = $operand;
        }

        $hasElse = false;

        if ($case->elseResult instanceof Expression) {
            $operand = self::classify($case->elseResult);

            if ($operand === null) {
                return null;
            }

            $branches[] = $operand;
            $hasElse = true;
        }

        if ($branches === []) {
            return null;
        }

        $column = new SelectedColumn(
            trim($case->expr),
            SelectedColumnKind::Case,
            operands: $branches,
            hasElse: $hasElse,
        );

        if ($case->alias !== null) {
            $column->key = $case->alias;
        }

        return $column;
    }

    private static function classify(Expression $e): ?SelectedColumn
    {
        $expr = trim((string) $e->expr);

        if ($expr === '' || $expr === '*' || str_ends_with($expr, '.*')) {
            $prefix = null;

            if (str_ends_with($expr, '.*')) {
                $prefix = self::unquote($e->table ?? explode('.', $expr)[0]);
            }

            return new SelectedColumn(
                $e->alias ?? '*',
                SelectedColumnKind::Star,
                qualifiedBy: $prefix === '' ? null : $prefix,
            );
        }

        $column = null;

        if ($e->function !== null && $e->function !== '') {
            $function = strtoupper($e->function);

            if ($function === 'COUNT') {
                $column = new SelectedColumn(
                    $expr,
                    SelectedColumnKind::Count,
                    column: self::countInner($expr),
                );
            } elseif ($function === 'CONCAT' || $function === 'CONCAT_WS') {
                $inner = self::parenthesized($expr);
                $operands = $inner === null
                    ? null
                    : SelectParser::parseOperandList($inner);

                if ($operands === null) {
                    return null;
                }

                $column = new SelectedColumn(
                    $expr,
                    SelectedColumnKind::Concat,
                    operands: $operands,
                );
            }
        }

        if ($column === null && $e->subquery === null) {
            $column = self::classifyText($expr);
        }

        if ($column === null) {
            $column = new SelectedColumn($expr, SelectedColumnKind::Expression);
        }

        if ($e->alias !== null) {
            $column->key = $e->alias;
        }

        return $column;
    }

    /**
     * Text-level classification for CONCAT/CONCAT_WS operands — the same
     * rules as the legacy SelectParser, which only has the raw text there.
     */
    private static function classifyText(string $expr): ?SelectedColumn
    {
        $matches = [];

        if (preg_match('/^[+-]?\d+$/', $expr, $matches) === 1) {
            return new SelectedColumn(
                $expr,
                SelectedColumnKind::LiteralInt,
                literalInt: (int) $expr,
            );
        }

        if (preg_match("/^'([^']*)'$/s", $expr, $matches) === 1) {
            return new SelectedColumn(
                $expr,
                SelectedColumnKind::LiteralString,
                literalString: $matches[1] ?? '',
            );
        }

        if (strcasecmp($expr, 'NULL') === 0) {
            return new SelectedColumn('NULL', SelectedColumnKind::LiteralNull);
        }

        if (
            preg_match(
                '/^`?([A-Za-z_][A-Za-z0-9_]*)`?(?:\.`?([A-Za-z_][A-Za-z0-9_]*)`?)?$/',
                $expr,
                $matches,
            ) === 1
        ) {
            $first = $matches[1] ?? null;
            $second = $matches[2] ?? null;

            if ($first === null) {
                return null;
            }

            $column = $second ?? $first;

            return new SelectedColumn(
                $column,
                SelectedColumnKind::Column,
                column: $column,
                qualifiedBy: $second === null ? null : $first,
            );
        }

        return null;
    }

    /**
     * The column argument of COUNT(col) / COUNT(t.col), null for COUNT(*).
     */
    private static function countInner(string $expr): ?string
    {
        $matches = [];

        if (
            preg_match(
                '/^COUNT\s*\(\s*(\*|`?[A-Za-z_][A-Za-z0-9_]*`?(?:\.`?[A-Za-z_][A-Za-z0-9_]*`?)?)\s*\)$/i',
                $expr,
                $matches,
            ) !== 1
        ) {
            return null;
        }

        $inner = $matches[1] ?? '*';

        if ($inner === '*') {
            return null;
        }

        $parts = explode('.', $inner);

        return self::unquote($parts[count($parts) - 1] ?? '');
    }

    /**
     * The argument list of `fn(...)`, or null when the shape is unexpected.
     */
    private static function parenthesized(string $expr): ?string
    {
        $start = strpos($expr, '(');

        if ($start === false || str_ends_with($expr, ')') === false) {
            return null;
        }

        return substr($expr, $start + 1, -1);
    }

    private static function unquote(string $identifier): string
    {
        return trim($identifier, '`');
    }
}
