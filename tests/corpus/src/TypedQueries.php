<?php

declare(strict_types=1);

namespace Corpus;

use PDO;

/**
 * Queries whose result types the extension should refine.
 *
 * Values fetched from the corpus database are passed to helpers with
 * strict parameter types, so a wrong refinement surfaces as an analyzer
 * issue.
 *
 * @internal
 */
final class TypedQueries
{
    public function __construct(
        private readonly PDO $pdo,
    ) {}

    public function userName(): void
    {
        $statement = $this->pdo->query('SELECT name FROM users');

        if ($statement === false) {
            return;
        }

        $row = $statement->fetch();

        if ($row === false) {
            return;
        }

        $this->expectString($row['name']);
    }

    public function userEmail(): void
    {
        $statement = $this->pdo->query('SELECT email FROM users');

        if ($statement === false) {
            return;
        }

        $row = $statement->fetch();

        if ($row === false) {
            return;
        }

        $this->expectStringOrNull($row['email']);
    }

    public function userId(): void
    {
        $statement = $this->pdo->query('SELECT id, name, email FROM users');

        if ($statement === false) {
            return;
        }

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return;
        }

        $this->expectInt($row['id']);
    }

    public function userNameIsNotInt(): void
    {
        $statement = $this->pdo->query('SELECT name FROM users');

        if ($statement === false) {
            return;
        }

        $row = $statement->fetch();

        if ($row === false) {
            return;
        }

        // @mago-expect analysis:invalid-argument
        $this->expectInt($row['name']);
    }

    public function nameByColumn(): void
    {
        $statement = $this->pdo->query('SELECT name FROM users');

        if ($statement === false) {
            return;
        }

        $name = $statement->fetchColumn();

        if ($name !== false) {
            $this->expectString($name);
        }
    }

    public function userCount(): int
    {
        $statement = $this->pdo->query('SELECT COUNT(*) FROM users');

        if ($statement === false) {
            return 0;
        }

        $count = $statement->fetchColumn();

        return $count === false ? 0 : $count;
    }

    public function allUsers(): void
    {
        $statement = $this->pdo->query('SELECT id, name, email FROM users');

        if ($statement === false) {
            return;
        }

        $rows = $statement->fetchAll();

        foreach ($rows as $row) {
            $this->expectInt($row['id']);
            $this->expectString($row['name']);
            $this->expectStringOrNull($row['email']);
        }
    }

    public function asObject(): void
    {
        $statement = $this->pdo->query('SELECT name FROM users');

        if ($statement === false) {
            return;
        }

        $row = $statement->fetch(PDO::FETCH_OBJ);

        if ($row === false) {
            return;
        }

        $this->expectString($row->name);
    }

    public function preparedName(int $id): void
    {
        $statement = $this->pdo->prepare('SELECT name FROM users WHERE id = ?');

        if ($statement === false) {
            return;
        }

        $statement->execute([$id]);

        $row = $statement->fetch();

        if ($row === false) {
            return;
        }

        $this->expectString($row['name']);
    }

    public function userByStar(): void
    {
        $statement = $this->pdo->query('SELECT * FROM users');

        if ($statement === false) {
            return;
        }

        $row = $statement->fetch();

        if ($row === false) {
            return;
        }

        $this->expectInt($row['id']);
        $this->expectString($row['name']);
        $this->expectStringOrNull($row['email']);
    }

    private function expectString(string $value): string
    {
        return $value;
    }

    private function expectInt(int $value): int
    {
        return $value;
    }

    private function expectStringOrNull(?string $value): ?string
    {
        return $value;
    }
}
