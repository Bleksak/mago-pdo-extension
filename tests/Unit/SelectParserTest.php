<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Sql\SelectedColumn;
use Bleksak\MagoPdoExtension\Sql\SelectedColumnKind;
use Bleksak\MagoPdoExtension\Sql\SelectParser;
use Bleksak\MagoPdoExtension\Sql\SelectQuery;
use Bleksak\MagoPdoExtension\Sql\SourceTable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function count;

#[CoversClass(SelectParser::class)]
final class SelectParserTest extends TestCase
{
    public function testParsesSimpleSelect(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [
                new SelectedColumn(
                    'id',
                    SelectedColumnKind::Column,
                    column: 'id',
                ),
                new SelectedColumn(
                    'name',
                    SelectedColumnKind::Column,
                    column: 'name',
                ),
            ]),
            self::parseOrFail('SELECT id, name FROM users'),
        );
    }

    public function testParsesStar(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [new SelectedColumn(
                '*',
                SelectedColumnKind::Star,
            )]),
            self::parseOrFail('SELECT * FROM users'),
        );
    }

    public function testParsesQualifiedStar(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [new SelectedColumn(
                '*',
                SelectedColumnKind::Star,
                qualifiedBy: 'users',
            )]),
            self::parseOrFail('SELECT users.* FROM users'),
        );
    }

    public function testParsesQualifiedColumn(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [new SelectedColumn(
                'name',
                SelectedColumnKind::Column,
                column: 'name',
                qualifiedBy: 'users',
            )]),
            self::parseOrFail('SELECT users.name FROM users'),
        );
    }

    public function testParsesLiterals(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [
                new SelectedColumn(
                    '1',
                    SelectedColumnKind::LiteralInt,
                    literalInt: 1,
                ),
                new SelectedColumn(
                    "'hello'",
                    SelectedColumnKind::LiteralString,
                    literalString: 'hello',
                ),
                new SelectedColumn('NULL', SelectedColumnKind::LiteralNull),
            ]),
            self::parseOrFail("SELECT 1, 'hello', NULL FROM users"),
        );
    }

    public function testParsesCount(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [new SelectedColumn(
                'COUNT(*)',
                SelectedColumnKind::Count,
            )]),
            self::parseOrFail('SELECT COUNT(*) FROM users'),
        );

        self::assertEquals(
            self::select([new SourceTable('users')], [new SelectedColumn(
                'COUNT(users.id)',
                SelectedColumnKind::Count,
                column: 'id',
            )]),
            self::parseOrFail('SELECT COUNT(users.id) FROM users'),
        );
    }

    public function testParsesAliases(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [
                new SelectedColumn(
                    'label',
                    SelectedColumnKind::Column,
                    column: 'name',
                ),
                new SelectedColumn('total', SelectedColumnKind::Count),
            ]),
            self::parseOrFail(
                'SELECT name AS label, COUNT(*) total FROM users',
            ),
        );
    }

    public function testIgnoresEverythingAfterTable(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [new SelectedColumn(
                'name',
                SelectedColumnKind::Column,
                column: 'name',
            )]),
            self::parseOrFail(
                'SELECT name FROM users WHERE id = 1 ORDER BY id LIMIT 10',
            ),
        );
    }

    public function testParsesBacktickedIdentifier(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [new SelectedColumn(
                'name',
                SelectedColumnKind::Column,
                column: 'name',
            )]),
            self::parseOrFail('SELECT `name` FROM `users`'),
        );
    }

    public function testOnlyFirstStatementIsParsed(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [new SelectedColumn(
                'name',
                SelectedColumnKind::Column,
                column: 'name',
            )]),
            self::parseOrFail('SELECT name FROM users; DELETE FROM users'),
        );
    }

    public function testExpressionFallsBackToExpressionKind(): void
    {
        self::assertEquals(
            self::select([new SourceTable('users')], [new SelectedColumn(
                'greeting',
                SelectedColumnKind::Expression,
            )]),
            self::parseOrFail("SELECT name || '!' AS greeting FROM users"),
        );
    }

    public function testParsesInnerJoin(): void
    {
        self::assertEquals(
            self::select([
                new SourceTable('users', 'u'),
                new SourceTable('orders', 'o'),
            ], [new SelectedColumn(
                'name',
                SelectedColumnKind::Column,
                column: 'name',
                qualifiedBy: 'u',
            )]),
            self::parseOrFail(
                'SELECT u.name FROM users u JOIN orders o ON o.user_id = u.id',
            ),
        );
    }

    public function testParsesLeftJoinChain(): void
    {
        $select = self::parseOrFail(
            'SELECT a.id, b.name '
            . 'FROM first a '
            . 'LEFT JOIN second b ON b.a_id = a.id '
            . 'LEFT OUTER JOIN third AS t3 ON t3.b_id = b.id '
            . 'WHERE a.id = 1',
        );

        self::assertEquals(
            [
                new SourceTable('first', 'a'),
                new SourceTable('second', 'b', true),
                new SourceTable('third', 't3', true),
            ],
            $select->tables,
        );
    }

    public function testParsesJoinWithSubqueryInCondition(): void
    {
        $select = self::parseOrFail(
            'SELECT u.name FROM users u '
            . 'LEFT JOIN orders o ON o.user_id = u.id AND o.id NOT IN (SELECT 1) '
            . 'WHERE u.id = 1',
        );

        self::assertEquals(
            [
                new SourceTable('users', 'u'),
                new SourceTable('orders', 'o', true),
            ],
            $select->tables,
        );
    }

    public function testParsesConcat(): void
    {
        $select = self::parseOrFail(
            "SELECT CONCAT(u.first, ' ', u.last) AS value FROM users u",
        );

        self::assertCount(1, $select->columns);

        $column = $select->columns[0] ?? null;

        self::assertInstanceOf(SelectedColumn::class, $column);
        self::assertSame('value', $column->key);
        self::assertSame(SelectedColumnKind::Concat, $column->kind);
        self::assertCount(3, $column->operands ?? []);
    }

    public function testParsesCase(): void
    {
        $select = self::parseOrFail(
            "SELECT CASE WHEN u.id = 1 THEN 'one' ELSE 'many' END AS label FROM users u",
        );

        self::assertCount(1, $select->columns);

        $column = $select->columns[0] ?? null;

        self::assertInstanceOf(SelectedColumn::class, $column);
        self::assertSame('label', $column->key);
        self::assertSame(SelectedColumnKind::Case, $column->kind);
        self::assertTrue($column->hasElse);
        self::assertCount(2, $column->operands ?? []);
    }

    public function testParsesCaseWithoutElse(): void
    {
        $select = self::parseOrFail(
            'SELECT CASE WHEN u.a = 1 THEN 1 WHEN u.a = 2 THEN 2 END AS v FROM users u',
        );

        $column = $select->columns[0] ?? null;

        self::assertInstanceOf(SelectedColumn::class, $column);
        self::assertSame(SelectedColumnKind::Case, $column->kind);
        self::assertFalse($column->hasElse);
        self::assertCount(2, $column->operands ?? []);
    }

    public function testParsesMultilineCaseWithAlias(): void
    {
        $select = self::parseOrFail(<<<'SQL'
                SELECT
                    CASE
                        WHEN x IS NULL THEN 'none'
                        WHEN x = '' THEN 'empty'
                        ELSE x
                    END AS label
                FROM t
            SQL);

        $column = $select->columns[0] ?? null;

        self::assertInstanceOf(SelectedColumn::class, $column);
        self::assertSame('label', $column->key);
        self::assertSame(SelectedColumnKind::Case, $column->kind);
        self::assertTrue($column->hasElse);
        self::assertCount(3, $column->operands ?? []);
    }

    public function testRejectsNonSelect(): void
    {
        self::assertNull(SelectParser::parse(
            'INSERT INTO users (name) VALUES (\'a\')',
        ));
        self::assertNull(SelectParser::parse(''));
    }

    public function testRejectsMissingFrom(): void
    {
        self::assertNull(SelectParser::parse('SELECT 1'));
    }

    public function testRejectsCommaJoin(): void
    {
        self::assertNull(SelectParser::parse('SELECT * FROM users, orders'));
    }

    public function testRejectsRightJoin(): void
    {
        self::assertNull(SelectParser::parse(
            'SELECT u.name FROM users u RIGHT JOIN orders o ON o.user_id = u.id',
        ));
    }

    public function testRejectsUnion(): void
    {
        self::assertNull(SelectParser::parse(
            'SELECT id FROM users UNION SELECT 1',
        ));
    }

    public function testRejectsDerivedTable(): void
    {
        self::assertNull(SelectParser::parse(
            'SELECT id FROM (SELECT id FROM users) AS t',
        ));
    }

    public function testRejectsMalformedCase(): void
    {
        self::assertNull(SelectParser::parse(
            'SELECT CASE u.id THEN 1 END AS v FROM users',
        ));
    }

    public function testRejectsEmptyColumnList(): void
    {
        self::assertNull(SelectParser::parse('SELECT FROM users'));
    }

    public function testParseReturnsSelectQuery(): void
    {
        $select = self::parseOrFail('SELECT name FROM users');

        self::assertInstanceOf(SelectQuery::class, $select);
        self::assertSame(1, count($select->columns));
    }

    /**
     * @param list<SourceTable> $tables
     * @param list<SelectedColumn> $columns
     */
    private static function select(array $tables, array $columns): SelectQuery
    {
        return new SelectQuery($tables, $columns);
    }

    private static function parseOrFail(string $sql): SelectQuery
    {
        $select = SelectParser::parse($sql);

        self::assertNotNull($select);

        return $select;
    }
}
