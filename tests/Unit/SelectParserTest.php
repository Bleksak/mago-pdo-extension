<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Sql\SelectedColumn;
use Bleksak\MagoPdoExtension\Sql\SelectedColumnKind;
use Bleksak\MagoPdoExtension\Sql\SelectParser;
use Bleksak\MagoPdoExtension\Sql\SelectQuery;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function count;

#[CoversClass(SelectParser::class)]
final class SelectParserTest extends TestCase
{
    public function testParsesSimpleSelect(): void
    {
        self::assertEquals(
            new SelectQuery('users', [
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
            new SelectQuery('users', [new SelectedColumn(
                '*',
                SelectedColumnKind::Star,
            )]),
            self::parseOrFail('SELECT * FROM users'),
        );
    }

    public function testParsesQualifiedStar(): void
    {
        self::assertEquals(
            new SelectQuery('users', [new SelectedColumn(
                '*',
                SelectedColumnKind::Star,
            )]),
            self::parseOrFail('SELECT users.* FROM users'),
        );
    }

    public function testParsesQualifiedColumn(): void
    {
        self::assertEquals(
            new SelectQuery('users', [new SelectedColumn(
                'name',
                SelectedColumnKind::Column,
                column: 'name',
            )]),
            self::parseOrFail('SELECT users.name FROM users'),
        );
    }

    public function testParsesLiterals(): void
    {
        self::assertEquals(
            new SelectQuery('users', [
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
            new SelectQuery('users', [new SelectedColumn(
                'COUNT(*)',
                SelectedColumnKind::Count,
            )]),
            self::parseOrFail('SELECT COUNT(*) FROM users'),
        );
    }

    public function testParsesAliases(): void
    {
        self::assertEquals(
            new SelectQuery('users', [
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
            new SelectQuery('users', [new SelectedColumn(
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
            new SelectQuery('users', [new SelectedColumn(
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
            new SelectQuery('users', [new SelectedColumn(
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
            new SelectQuery('users', [new SelectedColumn(
                'greeting',
                SelectedColumnKind::Expression,
            )]),
            self::parseOrFail("SELECT name || '!' AS greeting FROM users"),
        );
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

    public function testRejectsJoins(): void
    {
        self::assertNull(SelectParser::parse(
            'SELECT u.name FROM users u JOIN orders o ON o.user_id = u.id',
        ));
    }

    public function testRejectsMultipleTables(): void
    {
        self::assertNull(SelectParser::parse('SELECT * FROM users, orders'));
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

    public function testRejectsForeignQualifiedColumn(): void
    {
        self::assertNull(SelectParser::parse('SELECT orders.id FROM users'));
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

    private static function parseOrFail(string $sql): SelectQuery
    {
        $select = SelectParser::parse($sql);

        self::assertNotNull($select);

        return $select;
    }
}
