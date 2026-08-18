<?php

declare(strict_types=1);

namespace Corpus;

use PDO;

/**
 * Queries that are runnable against the corpus database.
 *
 * @internal
 */
final class RunnableQueries
{
    public function __construct(
        private readonly PDO $pdo,
    ) {}

    public function userName(int $id): ?string
    {
        $statement = $this->pdo->query('SELECT name FROM users WHERE id = ?');

        $name = $statement->fetchColumn();

        return $name === false ? null : $name;
    }

    public function userById(int $id): ?array
    {
        $statement = $this->pdo->prepare('SELECT id, name, email FROM users WHERE id = :id');

        $statement->execute(['id' => $id]);

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row === false ? null : $row;
    }

    public function renameUser(int $id, string $name): int
    {
        $statement = $this->pdo->prepare('UPDATE users SET name = ? WHERE id = ?');

        $statement->execute([$name, $id]);

        return $statement->rowCount();
    }

    public function countUsers(): int
    {
        // Only the first statement executes, and it is runnable.
        $statement = $this->pdo->query('SELECT COUNT(*) FROM users; DELETE FROM users');

        $count = $statement->fetchColumn();

        return $count === false ? 0 : $count;
    }
}
