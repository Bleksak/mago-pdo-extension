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
    /** @return array<string, list{string, string}> */
    public static function checkableQueries(): array
    {
        return [
            'select with positional placeholder' => [
                'SELECT * FROM users WHERE id = ?',
                'SELECT * FROM users WHERE id = ?',
            ],
            'select with named placeholder' => [
                'SELECT * FROM users WHERE id = :id',
                'SELECT * FROM users WHERE id = :id',
            ],
            'lowercase and leading whitespace' => [
                '  select 1',
                'select 1',
            ],
            'insert' => [
                'INSERT INTO users (name) VALUES (?)',
                'INSERT INTO users (name) VALUES (?)',
            ],
            'update with named placeholders' => [
                'UPDATE users SET name = :name WHERE id = :id',
                'UPDATE users SET name = :name WHERE id = :id',
            ],
            'update with named limit placeholder' => [
                'UPDATE users SET name = :name WHERE id = :id ORDER BY id LIMIT :limit',
                'UPDATE users SET name = :name WHERE id = :id ORDER BY id LIMIT :limit',
            ],
            'delete with positional limit placeholder' => [
                'DELETE FROM users ORDER BY id LIMIT ?',
                'DELETE FROM users ORDER BY id LIMIT ?',
            ],
            'delete' => [
                'DELETE FROM users WHERE id = ?',
                'DELETE FROM users WHERE id = ?',
            ],
            'replace' => [
                'REPLACE INTO users (name) VALUES (?)',
                'REPLACE INTO users (name) VALUES (?)',
            ],
            'with cte' => [
                'WITH c AS (SELECT 1) SELECT * FROM c',
                'WITH c AS (SELECT 1) SELECT * FROM c',
            ],
            'first statement wins' => [
                'SELECT 1; DROP TABLE users',
                'SELECT 1',
            ],
            'first statement wins with multiple statements' => [
                'SELECT * FROM users; DELETE FROM users',
                'SELECT * FROM users',
            ],
            'trailing semicolon' => ['SELECT 1;', 'SELECT 1'],
        ];
    }

    /** @return array<string, list{string}> */
    public static function uncheckableQueries(): array
    {
        return [
            'create table' => ['CREATE TABLE t (a INT)'],
            'drop table' => ['DROP TABLE t'],
            'truncate' => ['TRUNCATE t'],
            'pragma' => ['PRAGMA table_info(users)'],
            'set' => ['SET @x = 1'],
            'empty' => [''],
            'whitespace only' => ['   '],
            'trailing semicolon only' => [';'],
        ];
    }

    #[DataProvider('checkableQueries')]
    public function testCheckableQuery(string $query, string $expected): void
    {
        self::assertSame($expected, ExplainableQuery::fromQuery($query));
    }

    #[DataProvider('uncheckableQueries')]
    public function testUncheckableQuery(string $query): void
    {
        self::assertNull(ExplainableQuery::fromQuery($query));
    }

    public function testSemicolonInsideQuotesDoesNotSplit(): void
    {
        self::assertSame(
            "SELECT 'a;b' FROM users",
            ExplainableQuery::fromQuery("SELECT 'a;b' FROM users"),
        );
        self::assertSame(
            'SELECT "a;b" FROM users',
            ExplainableQuery::fromQuery('SELECT "a;b" FROM users'),
        );
    }

    public function testBackslashEscapedQuoteDoesNotToggleQuoteState(): void
    {
        $query = "SELECT 'a\\'; DROP TABLE users' FROM t; SELECT 2";

        self::assertSame(
            "SELECT 'a\\'; DROP TABLE users' FROM t",
            ExplainableQuery::fromQuery($query),
        );
    }

    public function testPlaceholderInsideStringLiteralIsKept(): void
    {
        self::assertSame(
            "SELECT * FROM users WHERE name = 'a?b'",
            ExplainableQuery::fromQuery(
                "SELECT * FROM users WHERE name = 'a?b'",
            ),
        );
    }

    public function testDoubleColonIsKept(): void
    {
        self::assertSame(
            'SELECT x::int FROM t',
            ExplainableQuery::fromQuery('SELECT x::int FROM t'),
        );
    }
}
