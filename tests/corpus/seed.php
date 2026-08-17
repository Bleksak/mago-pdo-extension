<?php

declare(strict_types=1);

/**
 * Seeds the corpus database used by the extension host during corpus runs.
 *
 * Run from the repository root: php tests/corpus/seed.php
 */
final class Seed
{
    public static function run(): void
    {
        $database = __DIR__ . '/.corpus.sqlite';

        if (file_exists($database)) {
            unlink($database);
        }

        $pdo = new PDO("sqlite:{$database}", options: [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        $pdo->exec('CREATE TABLE users (
            id INTEGER PRIMARY KEY,
            name TEXT NOT NULL,
            email TEXT
        )');
        $pdo->exec('CREATE TABLE orders (
            id INTEGER PRIMARY KEY,
            user_id INTEGER NOT NULL,
            total REAL NOT NULL
        )');
    }
}

Seed::run();
