<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Services\ConnectionProvider;
use Override;
use PDO;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function file_exists;
use function putenv;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;

#[CoversClass(ConnectionProvider::class)]
final class ConnectionProviderTest extends TestCase
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
            'mago-pdo-extension-',
        );
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
        self::assertNull(new ConnectionProvider()->get());
    }

    public function testSqlitePathOpensConnection(): void
    {
        putenv("MAGO_PDO_EXTENSION_SQLITE_PATH={$this->sqlitePath}");

        $connection = new ConnectionProvider()->get();

        self::assertInstanceOf(PDO::class, $connection);
        self::assertSame(
            'sqlite',
            $connection->getAttribute(PDO::ATTR_DRIVER_NAME),
        );
    }

    public function testSqliteConfigurationWinsOverMysql(): void
    {
        putenv("MAGO_PDO_EXTENSION_SQLITE_PATH={$this->sqlitePath}");
        putenv('MAGO_PDO_EXTENSION_MYSQL_HOST=127.0.0.1');
        putenv('MAGO_PDO_EXTENSION_MYSQL_PORT=3306');
        putenv('MAGO_PDO_EXTENSION_MYSQL_USER=root');
        putenv('MAGO_PDO_EXTENSION_MYSQL_PASSWORD=secret');
        putenv('MAGO_PDO_EXTENSION_MYSQL_DATABASE=test');

        $connection = new ConnectionProvider()->get();

        self::assertInstanceOf(PDO::class, $connection);
        self::assertSame(
            'sqlite',
            $connection->getAttribute(PDO::ATTR_DRIVER_NAME),
        );
    }

    public function testConnectionIsMemoized(): void
    {
        putenv("MAGO_PDO_EXTENSION_SQLITE_PATH={$this->sqlitePath}");

        $provider = new ConnectionProvider();

        self::assertNotNull($provider->get());
        self::assertSame($provider->get(), $provider->get());
    }

    public function testMissingMysqlVariablesReturnNull(): void
    {
        putenv('MAGO_PDO_EXTENSION_MYSQL_HOST=127.0.0.1');

        self::assertNull(new ConnectionProvider()->get());
    }

    public function testEmptyMysqlVariablesAreIgnored(): void
    {
        putenv('MAGO_PDO_EXTENSION_MYSQL_HOST=127.0.0.1');
        putenv('MAGO_PDO_EXTENSION_MYSQL_PORT=');

        self::assertNull(new ConnectionProvider()->get());
    }

    public function testUnreachableMysqlReturnsNull(): void
    {
        putenv('MAGO_PDO_EXTENSION_MYSQL_HOST=127.0.0.1');
        putenv('MAGO_PDO_EXTENSION_MYSQL_PORT=1');
        putenv('MAGO_PDO_EXTENSION_MYSQL_USER=root');
        putenv('MAGO_PDO_EXTENSION_MYSQL_PASSWORD=secret');
        putenv('MAGO_PDO_EXTENSION_MYSQL_DATABASE=test');

        self::assertNull(new ConnectionProvider()->get());
    }
}
