<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Services;

use Bleksak\MagoPdoExtension\Sql\ColumnInfo;
use PDO;
use PDOException;

use function array_key_exists;
use function preg_match;
use function str_replace;

/**
 * Resolves table schemas from the configured database.
 *
 * Results are memoized per worker process. A null result means the
 * database or the table is unavailable, and callers must fall back to
 * unrefined types.
 *
 * @internal
 */
final class SchemaIntrospector
{
    /**
     * @var array<string, list<ColumnInfo>|null>
     */
    private array $cache = [];

    public function __construct(
        private readonly ConnectionProvider $connections,
    ) {}

    /**
     * @return list<ColumnInfo>|null
     */
    public function tableColumns(string $table): ?array
    {
        if (array_key_exists($table, $this->cache)) {
            return $this->cache[$table];
        }

        $connection = $this->connections->get();

        if ($connection === null) {
            return null;
        }

        $driver = (string) $connection->getAttribute(PDO::ATTR_DRIVER_NAME);

        try {
            $columns = match ($driver) {
                'mysql' => $this->mysqlColumns($connection, $table),
                'sqlite' => $this->sqliteColumns($connection, $table),
                default => null,
            };
        } catch (PDOException) {
            $columns = null;
        }

        return $this->cache[$table] = $columns;
    }

    /**
     * @return list<ColumnInfo>|null
     */
    private function mysqlColumns(PDO $connection, string $table): ?array
    {
        $schemaStatement = $connection->query('SELECT DATABASE()');

        if ($schemaStatement === false) {
            return null;
        }

        $schema = (string) $schemaStatement->fetchColumn();

        $statement = $connection->prepare(
            'SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE '
            . 'FROM information_schema.COLUMNS '
            . 'WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?',
        );

        if ($statement === false) {
            return null;
        }

        $statement->execute([$schema, $table]);

        /** @var list<array{COLUMN_NAME: string, COLUMN_TYPE: string, IS_NULLABLE: string}> $rows */
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $columns = [];

        foreach ($rows as $row) {
            $columns[] = new ColumnInfo(
                $row['COLUMN_NAME'],
                $row['COLUMN_TYPE'],
                $row['IS_NULLABLE'] === 'YES',
            );
        }

        return $columns === [] ? null : $columns;
    }

    /**
     * @return list<ColumnInfo>|null
     */
    private function sqliteColumns(PDO $connection, string $table): ?array
    {
        $statement = $connection->query(
            'PRAGMA table_info(' . $this->quoteIdentifier($table) . ')',
        );

        if ($statement === false) {
            return null;
        }

        /** @var list<array{name: string, type: string, notnull: int, pk: int}> $rows */
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $columns = [];

        foreach ($rows as $row) {
            // An INTEGER PRIMARY KEY is the rowid alias and can never be
            // null, even though PRAGMA reports it as nullable.
            $nullable = (int) $row['notnull'] === 0 && (int) $row['pk'] === 0;

            $columns[] = new ColumnInfo($row['name'], $row['type'], $nullable);
        }

        return $columns === [] ? null : $columns;
    }

    private function quoteIdentifier(string $identifier): string
    {
        if (!preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $identifier)) {
            throw new PDOException('Invalid table identifier: ' . $identifier);
        }

        return '"' . str_replace('"', '""', $identifier) . '"';
    }
}
