<?php

declare(strict_types=1);

namespace Corpus;

use PDO;

/**
 * Statements the plugin cannot verify and must skip silently.
 *
 * @internal
 */
final class SkippedQueries
{
    public function __construct(
        private readonly PDO $pdo,
    ) {}

    public function createTable(): bool
    {
        // DDL cannot be explained, so the plugin stays silent.
        return $this->pdo->exec('CREATE TABLE IF NOT EXISTS skipped (id INTEGER)') !== false;
    }

    public function tableInfo(): int
    {
        // PRAGMA is not an explainable statement.
        $statement = $this->pdo->query('PRAGMA table_info(users)');

        if ($statement === false) {
            return 0;
        }

        return count($statement->fetchAll());
    }

    public function dynamicQuery(string $column): int
    {
        // The query is built dynamically, so it cannot be checked.
        $statement = $this->pdo->query("SELECT {$column} FROM users");

        if ($statement === false) {
            return 0;
        }

        return count($statement->fetchAll());
    }
}
