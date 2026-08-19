<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Sql\MySqlSelectParser;
use Bleksak\MagoPdoExtension\Sql\SelectedColumn;
use Bleksak\MagoPdoExtension\Sql\SelectedColumnKind;
use Bleksak\MagoPdoExtension\Sql\SelectQuery;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function assert;

#[CoversClass(MySqlSelectParser::class)]
final class MySqlSelectParserTest extends TestCase
{
    private MySqlSelectParser $parser;

    protected function setUp(): void
    {
        $this->parser = new MySqlSelectParser();
    }

    public function testSimpleColumns(): void
    {
        $select = $this->parse('SELECT id, name FROM users');

        self::assertNotNull($select);

        self::assertSame(['users'], self::tableNames($select));
        self::assertSame(
            [
                ['key' => 'id', 'kind' => SelectedColumnKind::Column, 'column' => 'id', 'qualifiedBy' => null],
                ['key' => 'name', 'kind' => SelectedColumnKind::Column, 'column' => 'name', 'qualifiedBy' => null],
            ],
            self::columnDescriptions($select),
        );
    }

    public function testIdentifierAliases(): void
    {
        $select = $this->parse('SELECT name AS n, email e FROM users');

        self::assertNotNull($select);

        self::assertSame(
            [
                ['key' => 'n', 'kind' => SelectedColumnKind::Column, 'column' => 'name', 'qualifiedBy' => null],
                ['key' => 'e', 'kind' => SelectedColumnKind::Column, 'column' => 'email', 'qualifiedBy' => null],
            ],
            self::columnDescriptions($select),
        );
    }

    public function testStringAlias(): void
    {
        $select = $this->parse("SELECT name AS 'label' FROM users");

        self::assertNotNull($select);
        self::assertSame('label', self::keys($select)[0]);
    }

    public function testQualifiedColumn(): void
    {
        $select = $this->parse('SELECT u.name FROM users u');

        self::assertNotNull($select);

        self::assertSame(
            [['key' => 'name', 'kind' => SelectedColumnKind::Column, 'column' => 'name', 'qualifiedBy' => 'u']],
            self::columnDescriptions($select),
        );
    }

    public function testDatabaseQualifiedColumn(): void
    {
        $select = $this->parse('SELECT corpus.users.name FROM users');

        self::assertNotNull($select);

        self::assertSame(
            [['key' => 'name', 'kind' => SelectedColumnKind::Column, 'column' => 'name', 'qualifiedBy' => 'users']],
            self::columnDescriptions($select),
        );
    }

    public function testStar(): void
    {
        $select = $this->parse('SELECT * FROM users');

        self::assertNotNull($select);
        self::assertCount(1, $select->columns);
        self::assertSame(SelectedColumnKind::Star, $select->columns[0]->kind);
        self::assertNull($select->columns[0]->qualifiedBy);
    }

    public function testQualifiedStar(): void
    {
        $select = $this->parse('SELECT u.* FROM users u');

        self::assertNotNull($select);
        self::assertCount(1, $select->columns);
        self::assertSame(SelectedColumnKind::Star, $select->columns[0]->kind);
        self::assertSame('u', $select->columns[0]->qualifiedBy);
    }

    public function testDatabaseQualifiedStar(): void
    {
        $select = $this->parse('SELECT corpus.users.* FROM users');

        self::assertNotNull($select);
        self::assertCount(1, $select->columns);
        self::assertSame(SelectedColumnKind::Star, $select->columns[0]->kind);
        self::assertSame('users', $select->columns[0]->qualifiedBy);
    }

    public function testLeftJoinMarksRightSide(): void
    {
        $select = $this->parse(
            'SELECT u.name, o.user_id FROM users u LEFT JOIN orders o ON o.user_id = u.id',
        );

        self::assertNotNull($select);

        self::assertSame(
            [
                ['name' => 'users', 'alias' => 'u', 'leftJoined' => false],
                ['name' => 'orders', 'alias' => 'o', 'leftJoined' => true],
            ],
            self::tableDescriptions($select),
        );
    }

    public function testJoinChain(): void
    {
        $select = $this->parse(
            'SELECT a.x FROM a JOIN b ON b.id = a.id '
            . 'INNER JOIN c ON c.id = b.id '
            . 'LEFT OUTER JOIN d ON d.id = c.id',
        );

        self::assertNotNull($select);

        self::assertSame(
            [
                ['name' => 'a', 'alias' => null, 'leftJoined' => false],
                ['name' => 'b', 'alias' => null, 'leftJoined' => false],
                ['name' => 'c', 'alias' => null, 'leftJoined' => false],
                ['name' => 'd', 'alias' => null, 'leftJoined' => true],
            ],
            self::tableDescriptions($select),
        );
    }

    public function testRightJoinIsRejected(): void
    {
        self::assertNull(
            $this->parser->parse('SELECT u.name FROM users u RIGHT JOIN orders o ON o.user_id = u.id'),
        );
    }

    public function testConcatIsClassified(): void
    {
        $select = $this->parse("SELECT CONCAT(u.name, '!') AS label FROM users u");

        self::assertNotNull($select);

        $column = $select->columns[0];

        self::assertSame(SelectedColumnKind::Concat, $column->kind);
        self::assertSame('label', $column->key);
        self::assertIsArray($column->operands);
        self::assertCount(2, $column->operands);

        $first = $column->operands[0];
        assert($first instanceof SelectedColumn);
        self::assertSame(SelectedColumnKind::Column, $first->kind);
        self::assertSame('name', $first->column);
        self::assertSame('u', $first->qualifiedBy);

        $second = $column->operands[1];
        assert($second instanceof SelectedColumn);
        self::assertSame(SelectedColumnKind::LiteralString, $second->kind);
        self::assertSame('!', $second->literalString);
    }

    public function testConcatWsIsClassified(): void
    {
        $select = $this->parse("SELECT CONCAT_WS('-', u.name, u.email) AS label FROM users u");

        self::assertNotNull($select);
        self::assertSame(SelectedColumnKind::Concat, $select->columns[0]->kind);
    }

    public function testCaseWithElse(): void
    {
        $select = $this->parse(
            "SELECT CASE WHEN u.id = 1 THEN 'one' ELSE 'many' END AS label FROM users u",
        );

        self::assertNotNull($select);

        $column = $select->columns[0];

        self::assertSame(SelectedColumnKind::Case, $column->kind);
        self::assertSame('label', $column->key);
        self::assertTrue($column->hasElse);
        self::assertIsArray($column->operands);
        self::assertCount(2, $column->operands);
    }

    public function testCaseWithoutElseIsNullableFlagged(): void
    {
        $select = $this->parse(
            'SELECT CASE WHEN u.email IS NOT NULL THEN u.id END AS label FROM users u',
        );

        self::assertNotNull($select);

        $column = $select->columns[0];

        self::assertSame(SelectedColumnKind::Case, $column->kind);
        self::assertFalse($column->hasElse);
        self::assertIsArray($column->operands);
        self::assertCount(1, $column->operands);

        $branch = $column->operands[0];
        assert($branch instanceof SelectedColumn);
        self::assertSame(SelectedColumnKind::Column, $branch->kind);
        self::assertSame('id', $branch->column);
        self::assertSame('u', $branch->qualifiedBy);
    }

    public function testMultilineCase(): void
    {
        $select = $this->parse(
            "SELECT CASE\n"
            . "    WHEN u.id = 1 THEN 'one'\n"
            . "    WHEN u.id = 2 THEN 'two'\n"
            . "    ELSE 'many'\n"
            . "END AS label FROM users u",
        );

        self::assertNotNull($select);
        self::assertSame(SelectedColumnKind::Case, $select->columns[0]->kind);
        self::assertSame('label', $select->columns[0]->key);
        self::assertCount(3, $select->columns[0]->operands);
    }

    public function testCountStar(): void
    {
        $select = $this->parse('SELECT COUNT(*) FROM users');

        self::assertNotNull($select);
        self::assertSame(SelectedColumnKind::Count, $select->columns[0]->kind);
    }

    public function testCountColumn(): void
    {
        $select = $this->parse('SELECT COUNT(u.id) FROM users u');

        self::assertNotNull($select);

        $column = $select->columns[0];

        self::assertSame(SelectedColumnKind::Count, $column->kind);
        self::assertSame('id', $column->column);
    }

    public function testLiterals(): void
    {
        $select = $this->parse("SELECT 1 AS a, -2 AS b, 'x' AS c, NULL AS d FROM users");

        self::assertNotNull($select);

        $columns = $select->columns;

        self::assertSame(SelectedColumnKind::LiteralInt, $columns[0]->kind);
        self::assertSame(1, $columns[0]->literalInt);
        self::assertSame('a', $columns[0]->key);
        self::assertSame(SelectedColumnKind::LiteralInt, $columns[1]->kind);
        self::assertSame(-2, $columns[1]->literalInt);
        self::assertSame(SelectedColumnKind::LiteralString, $columns[2]->kind);
        self::assertSame('x', $columns[2]->literalString);
        self::assertSame(SelectedColumnKind::LiteralNull, $columns[3]->kind);
    }

    public function testPositionalPlaceholder(): void
    {
        $select = $this->parse('SELECT name FROM users WHERE id = ?');

        self::assertNotNull($select);
        self::assertSame(['name'], self::keys($select));
    }

    public function testNamedPlaceholder(): void
    {
        $select = $this->parse('SELECT name FROM users WHERE id = :id');

        self::assertNotNull($select);
        self::assertSame(['name'], self::keys($select));
    }

    public function testPlaceholderInsideStringIsUntouched(): void
    {
        $select = $this->parse("SELECT name FROM users WHERE name = 'a :name and ? b'");

        self::assertNotNull($select);
        self::assertSame(['name'], self::keys($select));
    }

    public function testBacktickIdentifiers(): void
    {
        $select = $this->parse('SELECT `name` FROM `users`');

        self::assertNotNull($select);

        self::assertSame(['users'], self::tableNames($select));
        self::assertSame(['name'], self::keys($select));
    }

    public function testSelectWithoutFrom(): void
    {
        $select = $this->parse('SELECT 1');

        self::assertNotNull($select);
        self::assertSame([], $select->tables);
        self::assertSame(SelectedColumnKind::LiteralInt, $select->columns[0]->kind);
    }

    public function testSelectFromDual(): void
    {
        $select = $this->parse('SELECT 1 FROM DUAL');

        self::assertNotNull($select);
        self::assertSame([], $select->tables);
    }

    public function testUnionIsRejected(): void
    {
        self::assertNull(
            $this->parser->parse(
                'SELECT name FROM users UNION SELECT email FROM users',
            ),
        );
    }

    public function testCteIsRejected(): void
    {
        self::assertNull(
            $this->parser->parse(
                'WITH c AS (SELECT name FROM users) SELECT name FROM c',
            ),
        );
    }

    public function testNonSelectIsRejected(): void
    {
        self::assertNull(
            $this->parser->parse('INSERT INTO users (name) VALUES (?)'),
        );
    }

    public function testSyntaxErrorIsRejected(): void
    {
        self::assertNull($this->parser->parse('SELECT name FROM'));
    }

    public function testTrailingSecondStatementIsIgnored(): void
    {
        $select = $this->parse('SELECT name FROM users; SELECT email FROM users');

        self::assertNotNull($select);
        self::assertSame(['name'], self::keys($select));
    }

    public function testUnknownColumnStillParses(): void
    {
        // Parsing does not know the schema; an unknown column is a schema
        // problem the caller must resolve, not a parse failure.
        $select = $this->parse('SELECT no_such_column FROM users');

        self::assertNotNull($select);
        self::assertSame('no_such_column', self::keys($select)[0]);
    }

    private function parse(string $sql): ?SelectQuery
    {
        return $this->parser->parse($sql);
    }

    /** @return list<string> */
    private static function keys(?SelectQuery $select): array
    {
        $keys = [];

        foreach ($select?->columns ?? [] as $column) {
            $keys[] = $column->key;
        }

        return $keys;
    }

    /** @return list<string> */
    private static function tableNames(?SelectQuery $select): array
    {
        $names = [];

        foreach ($select?->tables ?? [] as $table) {
            $names[] = $table->name;
        }

        return $names;
    }

    /**
     * @return list<array{key: string, kind: SelectedColumnKind, column: ?string, qualifiedBy: ?string}>
     */
    private static function columnDescriptions(?SelectQuery $select): array
    {
        $descriptions = [];

        foreach ($select?->columns ?? [] as $column) {
            $descriptions[] = [
                'key' => $column->key,
                'kind' => $column->kind,
                'column' => $column->column,
                'qualifiedBy' => $column->qualifiedBy,
            ];
        }

        return $descriptions;
    }

    /**
     * @return list<array{name: string, alias: ?string, leftJoined: bool}>
     */
    private static function tableDescriptions(?SelectQuery $select): array
    {
        $descriptions = [];

        foreach ($select?->tables ?? [] as $table) {
            $descriptions[] = [
                'name' => $table->name,
                'alias' => $table->alias,
                'leftJoined' => $table->leftJoined,
            ];
        }

        return $descriptions;
    }
}
