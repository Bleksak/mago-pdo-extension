<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer\Providers;

use Bleksak\MagoPdoExtension\Mago\Analyzer\ExplainableQuery;
use Bleksak\MagoPdoExtension\Services\ConnectionProvider;
use Bleksak\MagoPdoExtension\Services\DbTypeMapper;
use Bleksak\MagoPdoExtension\Services\SchemaIntrospector;
use Bleksak\MagoPdoExtension\Sql\ColumnInfo;
use Bleksak\MagoPdoExtension\Sql\PmaSelectParser;
use Bleksak\MagoPdoExtension\Sql\SelectedColumn;
use Bleksak\MagoPdoExtension\Sql\SelectedColumnKind;
use Bleksak\MagoPdoExtension\Sql\SelectParser;
use Bleksak\MagoPdoExtension\Sql\SelectQuery;
use Bleksak\MagoPdoExtension\Sql\SourceTable;
use Mago\Sdk\Analyzer\MethodReturnTypeProvider;
use Mago\Sdk\Analyzer\MethodTarget;
use Mago\Sdk\Analyzer\ReturnTypeProviderContext;
use Mago\Sdk\Analyzer\Type;
use Mago\Sdk\PHPVersion;
use Override;
use PDO;
use PDOException;

use function array_key_exists;
use function count;
use function strcasecmp;
use function strtolower;

/**
 * Refines the return type of PDO query and prepare calls.
 *
 * A query verified as runnable by EXPLAIN against the configured database
 * refines to a plain PDOStatement: since PHP 8.1, query() and prepare()
 * throw a PDOException on failure, so they can never return false. For
 * older PHP versions, `false` remains part of the type.
 *
 * When the shape of a SELECT result can be determined, it is encoded into
 * a PDOStatement type parameter so the fetch methods can refine as well.
 *
 * The provider stays silent (returns null) for anything it cannot
 * verify, so unrefined native types are used as a fallback.
 *
 * @internal
 */
final class PdoQueryReturnTypeProvider implements MethodReturnTypeProvider
{
    private readonly SchemaIntrospector $schema;

    /**
     * @var array<string, ?Type>
     */
    private array $types = [];

    public function __construct(
        private readonly ConnectionProvider $connections,
    ) {
        $this->schema = new SchemaIntrospector($connections);
    }

    #[Override]
    public function getTargets(): array
    {
        return [
            MethodTarget::exact('PDO', 'query'),
            MethodTarget::exact('PDO', 'prepare'),
        ];
    }

    #[Override]
    public function getReturnType(ReturnTypeProviderContext $context): ?Type
    {
        $query = $context
            ->invocation->getArgument(0)
            ?->type?->getLiteralString();

        if ($query === null) {
            return null;
        }

        if (array_key_exists($query, $this->types)) {
            return $this->types[$query];
        }

        $context->cancellation->throwIfCancelled();

        $connection = $this->connections->get();

        if ($connection === null) {
            return $this->types[$query] = null;
        }

        $driver = (string) $connection->getAttribute(PDO::ATTR_DRIVER_NAME);

        if (!$this->isExplainable($connection, ExplainableQuery::fromQuery(
            $query,
            $driver,
        ))) {
            return $this->types[$query] = null;
        }

        $statement = Type::namedObject(StatementShape::STATEMENT_CLASS);

        $shape = $this->rowShape($driver, $query);

        if ($shape !== null) {
            $statement = Type::namedObject(
                StatementShape::STATEMENT_CLASS,
                StatementShape::encode($shape),
            );
        }

        // Since PHP 8.1, query() and prepare() throw a PDOException on
        // failure, so a verified query can never produce a false.
        if (!$context->phpVersion->isAtLeast(PHPVersion::fromParts(8, 1))) {
            return $this->types[$query] = Type::union(
                $statement,
                Type::false(),
            );
        }

        return $this->types[$query] = $statement;
    }

    private function isExplainable(PDO $connection, ?string $explainable): bool
    {
        if ($explainable === null) {
            return false;
        }

        try {
            $explain = $connection->query("EXPLAIN {$explainable}");
        } catch (PDOException) {
            return false;
        }

        if ($explain === false) {
            return false;
        }

        $explain->closeCursor();

        return true;
    }

    /**
     * @return list<array{key: string, type: Type}>|null
     */
    private function rowShape(string $driver, string $query): ?array
    {
        // MySQL uses the full phpmyadmin/sql-parser; SQLite keeps the
        // lightweight regex parser (SQLite-only syntax is not MySQL).
        $select = $driver === 'mysql'
            ? PmaSelectParser::parse($query)
            : SelectParser::parse($query);

        if ($select === null) {
            return null;
        }

        $byTable = [];

        foreach ($select->tables as $table) {
            $columns = $this->schema->tableColumns($table->name);

            if ($columns === null) {
                return null;
            }

            $byTable[strtolower($table->name)] = $columns;
        }

        $mapper = new DbTypeMapper($driver);

        return self::mapColumns($select, $byTable, $mapper);
    }

    /**
     * @param array<string, list<ColumnInfo>> $byTable
     * @return list<array{key: string, type: Type}>|null
     */
    private static function mapColumns(
        SelectQuery $select,
        array $byTable,
        DbTypeMapper $mapper,
    ): ?array {
        $shape = [];
        $seen = [];

        foreach ($select->columns as $column) {
            $mapped = self::mapColumn($column, $select, $byTable, $mapper);

            if ($mapped === null) {
                return null;
            }

            foreach ($mapped as $entry) {
                $key = strtolower($entry['key']);

                if (isset($seen[$key])) {
                    return null;
                }

                $seen[$key] = true;
                $shape[] = $entry;
            }
        }

        if ($shape === []) {
            return null;
        }

        return $shape;
    }

    /**
     * @param array<string, list<ColumnInfo>> $byTable
     * @return list<array{key: string, type: Type}>|null
     */
    private static function mapColumn(
        SelectedColumn $column,
        SelectQuery $select,
        array $byTable,
        DbTypeMapper $mapper,
    ): ?array {
        return match ($column->kind) {
            SelectedColumnKind::Column,
            SelectedColumnKind::Concat,
            SelectedColumnKind::Case,
                => self::typedEntry($column, $select, $byTable, $mapper),
            SelectedColumnKind::Star => self::expandStar(
                $column,
                $select,
                $byTable,
                $mapper,
            ),
            SelectedColumnKind::Count => [
                ['key' => $column->key, 'type' => Type::int()],
            ],
            SelectedColumnKind::LiteralInt => [
                [
                    'key' => $column->key,
                    'type' => Type::literalInt($column->literalInt ?? 0),
                ],
            ],
            SelectedColumnKind::LiteralString => [
                [
                    'key' => $column->key,
                    'type' => Type::literalString($column->literalString ?? ''),
                ],
            ],
            SelectedColumnKind::LiteralNull => [
                ['key' => $column->key, 'type' => Type::null()],
            ],
            SelectedColumnKind::Expression => [
                ['key' => $column->key, 'type' => Type::mixed()],
            ],
        };
    }

    /**
     * @param array<string, list<ColumnInfo>> $byTable
     * @return list<array{key: string, type: Type}>|null
     */
    private static function typedEntry(
        SelectedColumn $column,
        SelectQuery $select,
        array $byTable,
        DbTypeMapper $mapper,
    ): ?array {
        $parts = self::typeOf($column, $select, $byTable, $mapper);

        if ($parts === null) {
            return null;
        }

        return [
            [
                'key' => $column->key,
                'type' => self::withNull($parts[0], $parts[1]),
            ],
        ];
    }

    /**
     * Resolves the base type of an expression and whether the value may
     * be null. Returns null when the expression cannot be resolved.
     *
     * @param array<string, list<ColumnInfo>> $byTable
     *
     * @return array{0: Type, 1: bool}|null Base type and nullability.
     */
    private static function typeOf(
        SelectedColumn $column,
        SelectQuery $select,
        array $byTable,
        DbTypeMapper $mapper,
    ): ?array {
        return match ($column->kind) {
            SelectedColumnKind::Column => self::resolveColumn(
                $column,
                $select,
                $byTable,
                $mapper,
            ),
            SelectedColumnKind::Count => [Type::int(), false],
            SelectedColumnKind::LiteralInt => [
                Type::literalInt($column->literalInt ?? 0),
                false,
            ],
            SelectedColumnKind::LiteralString => [
                Type::literalString($column->literalString ?? ''),
                false,
            ],
            SelectedColumnKind::LiteralNull => [Type::null(), true],
            SelectedColumnKind::Concat => self::concatParts(
                $column,
                $select,
                $byTable,
                $mapper,
            ),
            SelectedColumnKind::Case => self::caseParts(
                $column,
                $select,
                $byTable,
                $mapper,
            ),
            SelectedColumnKind::Star, SelectedColumnKind::Expression => null,
        };
    }

    /**
     * @param array<string, list<ColumnInfo>> $byTable
     *
     * @return array{0: Type, 1: bool}|null
     */
    private static function resolveColumn(
        SelectedColumn $column,
        SelectQuery $select,
        array $byTable,
        DbTypeMapper $mapper,
    ): ?array {
        $name = $column->column;

        if ($name === null) {
            return null;
        }

        if ($column->qualifiedBy !== null) {
            $table = self::resolveTable($select->tables, $column->qualifiedBy);

            if ($table === null) {
                return null;
            }

            $info = self::findColumn($byTable, $table, $name);

            if ($info === null) {
                return null;
            }

            return self::columnParts($mapper, $info, $table->leftJoined);
        }

        $parts = [];

        foreach ($select->tables as $table) {
            $info = self::findColumn($byTable, $table, $name);

            if ($info !== null) {
                $parts[] = self::columnParts(
                    $mapper,
                    $info,
                    $table->leftJoined,
                );
            }
        }

        if ($parts === []) {
            return null;
        }

        return self::mergeParts($parts);
    }

    /**
     * @param array<string, list<ColumnInfo>> $byTable
     *
     * @return array{0: Type, 1: bool}
     */
    private static function concatParts(
        SelectedColumn $column,
        SelectQuery $select,
        array $byTable,
        DbTypeMapper $mapper,
    ): array {
        $nullable = false;

        foreach ($column->operands ?? [] as $operand) {
            $parts = self::typeOf($operand, $select, $byTable, $mapper);

            // An unresolved operand could be NULL, so the result is too.
            if ($parts === null) {
                $nullable = true;

                continue;
            }

            $nullable = $nullable || $parts[1];
        }

        return [Type::string(), $nullable];
    }

    /**
     * @param array<string, list<ColumnInfo>> $byTable
     *
     * @return array{0: Type, 1: bool}|null
     */
    private static function caseParts(
        SelectedColumn $column,
        SelectQuery $select,
        array $byTable,
        DbTypeMapper $mapper,
    ): ?array {
        $parts = [];
        $nullable = !$column->hasElse;

        foreach ($column->operands ?? [] as $operand) {
            $branch = self::typeOf($operand, $select, $byTable, $mapper);

            // An unresolvable branch is conservatively mixed and nullable.
            $branch ??= [Type::mixed(), true];

            $nullable = $nullable || $branch[1];
            $parts[] = $branch;
        }

        if ($parts === []) {
            return null;
        }

        $merged = self::mergeParts($parts);

        return $merged === null ? null : [$merged[0], $nullable || $merged[1]];
    }

    /**
     * Merges per-source type parts, unioning bases that differ. Literals
     * are widened to their base type so e.g. CASE branches collapse into
     * a plain string instead of a literal union.
     *
     * @param list<array{0: Type, 1: bool}> $parts
     *
     * @return array{0: Type, 1: bool}|null
     */
    private static function mergeParts(array $parts): ?array
    {
        $bases = [];
        $nullable = false;

        foreach ($parts as [$candidate, $isNullable]) {
            $nullable = $nullable || $isNullable;
            $candidate = self::widenLiteral($candidate);
            $bases[(string) $candidate] = $candidate;
        }

        $base = null;

        foreach ($bases as $candidate) {
            $base = $base === null
                ? $candidate
                : Type::union($base, $candidate);
        }

        if ($base === null) {
            return null;
        }

        return [$base, $nullable];
    }

    private static function widenLiteral(Type $base): Type
    {
        if ($base->getLiteralString() !== null) {
            return Type::string();
        }

        if ($base->getLiteralInt() !== null) {
            return Type::int();
        }

        return $base;
    }

    /**
     * @return array{0: Type, 1: bool}
     */
    private static function columnParts(
        DbTypeMapper $mapper,
        ColumnInfo $info,
        bool $left,
    ): array {
        $base = $mapper->columnType(
            new ColumnInfo($info->name, $info->dbType, false),
        );

        return [$base, $info->nullable || $left];
    }

    /**
     * @param list<SourceTable> $tables
     */
    private static function resolveTable(
        array $tables,
        string $qualifier,
    ): ?SourceTable {
        foreach ($tables as $table) {
            foreach ($table->references() as $reference) {
                if (strcasecmp($reference, $qualifier) === 0) {
                    return $table;
                }
            }
        }

        return null;
    }

    /**
     * @param array<string, list<ColumnInfo>> $byTable
     */
    private static function findColumn(
        array $byTable,
        SourceTable $table,
        string $column,
    ): ?ColumnInfo {
        foreach ($byTable[strtolower($table->name)] ?? [] as $info) {
            if ($info->name === $column) {
                return $info;
            }
        }

        return null;
    }

    /**
     * @param array<string, list<ColumnInfo>> $byTable
     *
     * @return list<array{key: string, type: Type}>|null
     */
    private static function expandStar(
        SelectedColumn $column,
        SelectQuery $select,
        array $byTable,
        DbTypeMapper $mapper,
    ): ?array {
        $table = null;

        if ($column->qualifiedBy !== null) {
            $table = self::resolveTable($select->tables, $column->qualifiedBy);

            if ($table === null) {
                return null;
            }
        } elseif (count($select->tables) !== 1) {
            return null;
        } else {
            $table = $select->tables[0];
        }

        $shape = [];

        foreach ($byTable[strtolower($table->name)] ?? [] as $info) {
            $base = $mapper->columnType(
                new ColumnInfo($info->name, $info->dbType, false),
            );

            $shape[] = [
                'key' => $info->name,
                'type' => self::withNull(
                    $base,
                    $info->nullable || $table->leftJoined,
                ),
            ];
        }

        return $shape;
    }

    private static function withNull(Type $base, bool $nullable): Type
    {
        return $nullable ? Type::union($base, Type::null()) : $base;
    }
}
