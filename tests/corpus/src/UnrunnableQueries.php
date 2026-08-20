<?php

declare(strict_types=1);

namespace Corpus;

use PDO;

/**
 * Queries that are not runnable against the corpus database.
 *
 * @internal
 */
final class UnrunnableQueries
{
    public function __construct(
        private readonly PDO $pdo,
    ) {}

    public function missingTable(): void
    {
        // @mago-expect lint:pdo/unrunnable-query
        $this->pdo->query('SELECT * FROM missing_table');
    }

    public function missingColumn(): void
    {
        // @mago-expect lint:pdo/unrunnable-query
        $this->pdo->query('SELECT no_such_column FROM users');
    }

    public function syntaxError(): void
    {
        // @mago-expect lint:pdo/unrunnable-query
        $this->pdo->prepare('SELECT * FROM users WHERE = ?');
    }

    public function missingTableDml(): void
    {
        // @mago-expect lint:pdo/unrunnable-query
        $this->pdo->exec('DELETE FROM missing_table WHERE id = ?');
    }

    public function multiStatementFirstFails(): void
    {
        // @mago-expect lint:pdo/unrunnable-query
        $this->pdo->query('SELECT * FROM missing_table; SELECT 1');
    }
}
