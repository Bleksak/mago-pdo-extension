<?php

declare(strict_types=1);

/**
 * Seeds the MySQL corpus database used by the extension host during
 * corpus runs.
 *
 * Connection settings are read from the MAGO_PDO_EXTENSION_MYSQL_*
 * environment variables, falling back to the local container defaults.
 *
 * Run from the repository root: php tests/corpus/seed-mysql.php
 */
final class SeedMysql
{
    public static function run(): void
    {
        $pdo = new PDO(self::dsn(), self::user(), self::password(), options: [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        $pdo->exec('DROP TABLE IF EXISTS orders');
        $pdo->exec('DROP TABLE IF EXISTS users');
        $pdo->exec('CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(255)
        )');
        $pdo->exec('CREATE TABLE orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            total DECIMAL(10,2) NOT NULL
        )');
    }

    private static function dsn(): string
    {
        $host = self::env('MAGO_PDO_EXTENSION_MYSQL_HOST', '127.0.0.1');
        $port = self::env('MAGO_PDO_EXTENSION_MYSQL_PORT', '3306');
        $database = self::env('MAGO_PDO_EXTENSION_MYSQL_DATABASE', 'corpus');

        return "mysql:host={$host};port={$port};dbname={$database}";
    }

    private static function user(): ?string
    {
        return self::env('MAGO_PDO_EXTENSION_MYSQL_USER', 'corpus');
    }

    private static function password(): ?string
    {
        return self::env('MAGO_PDO_EXTENSION_MYSQL_PASSWORD', 'corpus');
    }

    private static function env(string $name, string $default): string
    {
        $value = getenv($name);

        return is_string($value) && $value !== '' ? $value : $default;
    }
}

SeedMysql::run();
