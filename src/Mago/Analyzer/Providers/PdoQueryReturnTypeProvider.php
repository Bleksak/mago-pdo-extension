<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer\Providers;

use Bleksak\MagoPdoExtension\Mago\Analyzer\ExplainableQuery;
use Bleksak\MagoPdoExtension\Services\ConnectionProvider;
use Bleksak\MagoPdoExtension\Services\DbTypeMapper;
use Bleksak\MagoPdoExtension\Services\SchemaIntrospector;
use Bleksak\MagoPdoExtension\Sql\ColumnInfo;
use Bleksak\MagoPdoExtension\Sql\SelectedColumn;
use Bleksak\MagoPdoExtension\Sql\SelectedColumnKind;
use Bleksak\MagoPdoExtension\Sql\SelectParser;
use Bleksak\MagoPdoExtension\Sql\SelectQuery;
use Mago\Sdk\Analyzer\MethodReturnTypeProvider;
use Mago\Sdk\Analyzer\MethodTarget;
use Mago\Sdk\Analyzer\ReturnTypeProviderContext;
use Mago\Sdk\Analyzer\Type;
use Mago\Sdk\PHPVersion;
use Override;
use PDO;
use PDOException;

use function array_key_exists;

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
        $select = SelectParser::parse($query);

        if ($select === null) {
            return null;
        }

        $columns = $this->schema->tableColumns($select->table);

        if ($columns === null) {
            return null;
        }

        $mapper = new DbTypeMapper($driver);

        return self::mapColumns($select, $columns, $mapper);
    }

    /**
     * @param list<ColumnInfo> $schema
     * @return list<array{key: string, type: Type}>|null
     */
    private static function mapColumns(
        SelectQuery $select,
        array $schema,
        DbTypeMapper $mapper,
    ): ?array {
        $shape = [];

        foreach ($select->columns as $column) {
            $mapped = self::mapColumn($column, $schema, $mapper);

            if ($mapped === null) {
                return null;
            }

            foreach ($mapped as $entry) {
                $shape[] = $entry;
            }
        }

        if ($shape === []) {
            return null;
        }

        return $shape;
    }

    /**
     * @param list<ColumnInfo> $schema
     * @return list<array{key: string, type: Type}>|null
     */
    private static function mapColumn(
        SelectedColumn $column,
        array $schema,
        DbTypeMapper $mapper,
    ): ?array {
        if ($column->kind === SelectedColumnKind::Column) {
            $type = self::columnType($column->column, $schema, $mapper);

            if ($type === null) {
                return null;
            }

            return [['key' => $column->key, 'type' => $type]];
        }

        return match ($column->kind) {
            SelectedColumnKind::Star => self::expandStar($schema, $mapper),
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
     * @param list<ColumnInfo> $schema
     * @return list<array{key: string, type: Type}>
     */
    private static function expandStar(
        array $schema,
        DbTypeMapper $mapper,
    ): array {
        $shape = [];

        foreach ($schema as $info) {
            $shape[] = [
                'key' => $info->name,
                'type' => $mapper->columnType($info),
            ];
        }

        return $shape;
    }

    /**
     * @param list<ColumnInfo> $schema
     */
    private static function columnType(
        ?string $name,
        array $schema,
        DbTypeMapper $mapper,
    ): ?Type {
        if ($name === null) {
            return null;
        }

        foreach ($schema as $info) {
            if ($info->name === $name) {
                return $mapper->columnType($info);
            }
        }

        return null;
    }
}
