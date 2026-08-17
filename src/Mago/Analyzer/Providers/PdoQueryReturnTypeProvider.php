<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer\Providers;

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
use Override;
use PDO;

use function array_key_exists;

/**
 * Refines the return type of PDO query and prepare calls by encoding the
 * SELECT result shape into the returned PDOStatement type.
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
    private array $shapes = [];

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

        if (array_key_exists($query, $this->shapes)) {
            return $this->shapes[$query];
        }

        $context->cancellation->throwIfCancelled();

        $connection = $this->connections->get();

        if ($connection === null) {
            return $this->shapes[$query] = null;
        }

        $select = SelectParser::parse($query);

        if ($select === null) {
            return $this->shapes[$query] = null;
        }

        $columns = $this->schema->tableColumns($select->table);

        if ($columns === null) {
            return $this->shapes[$query] = null;
        }

        $mapper =
            new DbTypeMapper((string) $connection->getAttribute(PDO::ATTR_DRIVER_NAME));

        $shape = self::mapColumns($select, $columns, $mapper);

        if ($shape === null) {
            return $this->shapes[$query] = null;
        }

        return $this->shapes[$query] = Type::union(
            Type::namedObject(
                StatementShape::STATEMENT_CLASS,
                StatementShape::encode($shape),
            ),
            Type::false(),
        );
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
