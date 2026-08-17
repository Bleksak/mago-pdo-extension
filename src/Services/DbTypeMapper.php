<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Services;

use Bleksak\MagoPdoExtension\Sql\ColumnInfo;
use Mago\Sdk\Analyzer\Type;

use function preg_match;
use function str_contains;
use function strtolower;

/**
 * Maps database column types to the PHP types PDO returns for them.
 *
 * MySQL follows the column's declared type, while SQLite follows the
 * column affinity rules, since values only loosely follow the declared
 * type.
 *
 * @internal
 */
final class DbTypeMapper
{
    public function __construct(
        private readonly string $driver,
    ) {}

    public function columnType(ColumnInfo $column): Type
    {
        $base = $this->baseType($column->dbType);

        return $column->nullable ? Type::union($base, Type::null()) : $base;
    }

    private function baseType(string $dbType): Type
    {
        return match ($this->driver) {
            'mysql' => $this->mysqlType($dbType),
            'sqlite' => $this->sqliteType($dbType),
            default => Type::mixed(),
        };
    }

    private function mysqlType(string $dbType): Type
    {
        $matches = [];

        if (preg_match('/^([a-z]+)/i', $dbType, $matches) !== 1) {
            return Type::mixed();
        }

        $base = $matches[1] ?? null;

        if ($base === null) {
            return Type::mixed();
        }

        return match (strtolower($base)) {
            'tinyint',
            'smallint',
            'mediumint',
            'int',
            'integer',
            'bigint',
                => Type::int(),
            'float', 'double' => Type::float(),
            'decimal',
            'numeric',
            'bit',
            'char',
            'varchar',
            'tinytext',
            'text',
            'mediumtext',
            'longtext',
            'enum',
            'set',
            'json',
            'date',
            'datetime',
            'timestamp',
            'time',
            'year',
            'binary',
            'varbinary',
            'tinyblob',
            'blob',
            'mediumblob',
            'longblob',
            'geometry',
            'point',
            'linestring',
            'polygon',
            'multipoint',
            'multilinestring',
            'multipolygon',
            'geometrycollection',
                => Type::string(),
            default => Type::mixed(),
        };
    }

    private function sqliteType(string $dbType): Type
    {
        $type = strtolower($dbType);

        if ($type !== '' && str_contains($type, 'int')) {
            return Type::int();
        }

        if (
            str_contains($type, 'char')
            || str_contains($type, 'clob')
            || str_contains($type, 'text')
        ) {
            return Type::string();
        }

        if ($type === '' || str_contains($type, 'blob')) {
            return Type::string();
        }

        if (
            str_contains($type, 'real')
            || str_contains($type, 'floa')
            || str_contains($type, 'doub')
        ) {
            return Type::float();
        }

        return Type::union(Type::int(), Type::float());
    }
}
