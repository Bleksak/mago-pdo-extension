<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Services\ConnectionProvider;
use Bleksak\MagoPdoExtension\Services\SchemaIntrospector;
use Bleksak\MagoPdoExtension\Sql\ColumnInfo;
use Override;
use PDO;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function file_exists;
use function putenv;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;

#[CoversClass(SchemaIntrospector::class)]
final class SchemaIntrospectorTest extends TestCase
{
    private const array ENV_VARS = [
        'MAGO_PDO_EXTENSION_SQLITE_PATH',
        'MAGO_PDO_EXTENSION_MYSQL_HOST',
        'MAGO_PDO_EXTENSION_MYSQL_PORT',
        'MAGO_PDO_EXTENSION_MYSQL_USER',
        'MAGO_PDO_EXTENSION_MYSQL_PASSWORD',
        'MAGO_PDO_EXTENSION_MYSQL_DATABASE',
    ];

    private string $sqlitePath;

    #[Override]
    protected function setUp(): void
    {
        foreach (self::ENV_VARS as $name) {
            putenv($name);
        }

        $this->sqlitePath = (string) tempnam(
            sys_get_temp_dir(),
            'mago-pdo-extension-schema-',
        );

        $pdo = new PDO("sqlite:{$this->sqlitePath}");

        $pdo->exec('CREATE TABLE users (
            id INTEGER PRIMARY KEY,
            name TEXT NOT NULL,
            email TEXT
        )');
    }

    #[Override]
    protected function tearDown(): void
    {
        foreach (self::ENV_VARS as $name) {
            putenv($name);
        }

        if (file_exists($this->sqlitePath)) {
            unlink($this->sqlitePath);
        }
    }

    public function testWithoutConfigurationReturnsNull(): void
    {
        $introspector = new SchemaIntrospector(new ConnectionProvider());

        self::assertNull($introspector->tableColumns('users'));
    }

    public function testResolvesSqliteTable(): void
    {
        putenv("MAGO_PDO_EXTENSION_SQLITE_PATH={$this->sqlitePath}");

        $introspector = new SchemaIntrospector(new ConnectionProvider());

        $columns = $introspector->tableColumns('users');

        self::assertEquals(
            [
                new ColumnInfo('id', 'INTEGER', false),
                new ColumnInfo('name', 'TEXT', false),
                new ColumnInfo('email', 'TEXT', true),
            ],
            $columns,
        );
    }

    public function testUnknownTableReturnsNull(): void
    {
        putenv("MAGO_PDO_EXTENSION_SQLITE_PATH={$this->sqlitePath}");

        $introspector = new SchemaIntrospector(new ConnectionProvider());

        self::assertNull($introspector->tableColumns('missing_table'));
    }

    public function testResultsAreMemoized(): void
    {
        putenv("MAGO_PDO_EXTENSION_SQLITE_PATH={$this->sqlitePath}");

        $introspector = new SchemaIntrospector(new ConnectionProvider());

        $first = $introspector->tableColumns('users');
        $second = $introspector->tableColumns('users');

        self::assertNotNull($first);
        self::assertSame($first, $second);
    }

    public function testColumnInfoIsReturned(): void
    {
        putenv("MAGO_PDO_EXTENSION_SQLITE_PATH={$this->sqlitePath}");

        $introspector = new SchemaIntrospector(new ConnectionProvider());

        $columns = $introspector->tableColumns('users');

        self::assertNotNull($columns);

        foreach ($columns as $column) {
            self::assertInstanceOf(ColumnInfo::class, $column);
        }
    }
}
