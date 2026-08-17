<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Mago\Analyzer\ExplainableQuery;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(ExplainableQuery::class)]
final class ExplainableQueryTest extends TestCase
{
    /** @return array<string, list{string, string, string}> */
    public static function explainableQueries(): array
    {
        return [
            'select with positional placeholder' => [
                'SELECT * FROM users WHERE id = ?',
                'sqlite',
                'SELECT * FROM users WHERE id = ?',
            ],
            'lowercase and leading whitespace' => [
                '  select 1',
                'sqlite',
                'select 1',
            ],
            'insert' => [
                'INSERT INTO users (name) VALUES (?)',
                'sqlite',
                'INSERT INTO users (name) VALUES (?)',
            ],
            'update with named placeholders' => [
                'UPDATE users SET name = :name WHERE id = :id',
                'sqlite',
                'UPDATE users SET name = :name WHERE id = :id',
            ],
            'delete' => [
                'DELETE FROM users WHERE id = ?',
                'sqlite',
                'DELETE FROM users WHERE id = ?',
            ],
            'replace' => [
                'REPLACE INTO users (name) VALUES (?)',
                'sqlite',
                'REPLACE INTO users (name) VALUES (?)',
            ],
            'with cte' => [
                'WITH c AS (SELECT 1) SELECT * FROM c',
                'sqlite',
                'WITH c AS (SELECT 1) SELECT * FROM c',
            ],
            'mysql select normalizes positional placeholder' => [
                'SELECT * FROM users WHERE id = ?',
                'mysql',
                'SELECT * FROM users WHERE id = NULL',
            ],
            'mysql with cte' => [
                'WITH c AS (SELECT 1) SELECT * FROM c',
                'mysql',
                'WITH c AS (SELECT 1) SELECT * FROM c',
            ],
            'first statement wins' => [
                'SELECT 1; DROP TABLE users',
                'sqlite',
                'SELECT 1',
            ],
            'mysql first statement wins' => [
                'SELECT * FROM users; DELETE FROM users',
                'mysql',
                'SELECT * FROM users',
            ],
            'trailing semicolon' => ['SELECT 1;', 'sqlite', 'SELECT 1'],
        ];
    }

    /** @return array<string, list{string, string}> */
    public static function unexplainableQueries(): array
    {
        return [
            'create table' => ['CREATE TABLE t (a INT)', 'sqlite'],
            'drop table' => ['DROP TABLE t', 'sqlite'],
            'pragma' => ['PRAGMA table_info(users)', 'sqlite'],
            'set' => ['SET @x = 1', 'sqlite'],
            'empty' => ['', 'sqlite'],
            'whitespace only' => ['   ', 'sqlite'],
            'trailing semicolon only' => [';', 'sqlite'],
            // MySQL has no EXPLAIN for DML, so it is skipped rather than
            // reported as unrunnable.
            'mysql insert' => ['INSERT INTO t (a) VALUES (1)', 'mysql'],
            'mysql update' => ['UPDATE t SET a = 1', 'mysql'],
            'mysql delete' => ['DELETE FROM t', 'mysql'],
            'mysql replace' => ['REPLACE INTO t (a) VALUES (1)', 'mysql'],
            'mysql drop table' => ['DROP TABLE t', 'mysql'],
            // Unknown drivers get the conservative (MySQL) behavior.
            'unknown driver dml' => ['DELETE FROM t', 'pgsql'],
        ];
    }

    #[DataProvider('explainableQueries')]
    public function testExplainableQuery(
        string $query,
        string $driver,
        string $expected,
    ): void {
        self::assertSame($expected, ExplainableQuery::fromQuery(
            $query,
            $driver,
        ));
    }

    #[DataProvider('unexplainableQueries')]
    public function testUnexplainableQuery(string $query, string $driver): void
    {
        self::assertNull(ExplainableQuery::fromQuery($query, $driver));
    }

    public function testSemicolonInsideQuotesDoesNotSplit(): void
    {
        self::assertSame("SELECT 'a;b' FROM users", ExplainableQuery::fromQuery(
            "SELECT 'a;b' FROM users",
            'sqlite',
        ));
        self::assertSame('SELECT "a;b" FROM users', ExplainableQuery::fromQuery(
            'SELECT "a;b" FROM users',
            'mysql',
        ));
    }

    public function testBackslashEscapedQuoteDoesNotToggleQuoteState(): void
    {
        $query = "SELECT 'a\\'; DROP TABLE users' FROM t; SELECT 2";

        self::assertSame("SELECT 'a\\'; DROP TABLE users' FROM t", ExplainableQuery::fromQuery(
            $query,
            'sqlite',
        ));
    }

    public function testMysqlNamedPlaceholderIsNormalized(): void
    {
        self::assertSame('SELECT * FROM users WHERE id = NULL AND name = NULL', ExplainableQuery::fromQuery(
            'SELECT * FROM users WHERE id = ? AND name = :name',
            'mysql',
        ));
    }

    public function testDoubleColonIsNotATypedPlaceholder(): void
    {
        self::assertSame('SELECT x::int FROM t', ExplainableQuery::fromQuery(
            'SELECT x::int FROM t',
            'sqlite',
        ));
        self::assertSame('SELECT x::int FROM t', ExplainableQuery::fromQuery(
            'SELECT x::int FROM t',
            'mysql',
        ));
    }

    public function testUnknownDriverFallsBackToConservativeBehavior(): void
    {
        self::assertSame('SELECT 1', ExplainableQuery::fromQuery(
            'SELECT 1',
            'pgsql',
        ));
        self::assertNull(ExplainableQuery::fromQuery('DELETE FROM t', 'pgsql'));
    }
}
