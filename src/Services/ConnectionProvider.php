<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Services;

use Bleksak\MagoPdoExtension\Dto\MysqlConnection;
use Bleksak\MagoPdoExtension\Dto\SqliteConnectionDto;
use PDO;

use function getenv;
use function is_string;

/**
 * Lazily builds the verification connection from the worker environment, once per worker.
 *
 * Supported environment variables:
 *
 * - MAGO_PDO_EXTENSION_SQLITE_PATH
 * - MAGO_PDO_EXTENSION_MYSQL_HOST, MAGO_PDO_EXTENSION_MYSQL_PORT,
 *   MAGO_PDO_EXTENSION_MYSQL_USER, MAGO_PDO_EXTENSION_MYSQL_PASSWORD,
 *   MAGO_PDO_EXTENSION_MYSQL_DATABASE
 *
 * When no configuration is present (or the connection fails), the plugin stays silent.
 *
 * @internal
 */
final class ConnectionProvider
{
    private ?PDO $connection = null;

    private bool $attempted = false;

    public function __construct(
        private readonly PdoFactory $factory = new PdoFactory(),
    ) {}

    public function get(): ?PDO
    {
        if ($this->attempted) {
            return $this->connection;
        }

        $this->attempted = true;
        $this->connection = $this->create();

        return $this->connection;
    }

    private function create(): ?PDO
    {
        $sqlitePath = self::env('MAGO_PDO_EXTENSION_SQLITE_PATH');
        if ($sqlitePath !== null) {
            return ($this->factory)(new SqliteConnectionDto($sqlitePath));
        }

        $host = self::env('MAGO_PDO_EXTENSION_MYSQL_HOST');
        if ($host === null) {
            return null;
        }

        $port = self::env('MAGO_PDO_EXTENSION_MYSQL_PORT');
        $user = self::env('MAGO_PDO_EXTENSION_MYSQL_USER');
        $password = self::env('MAGO_PDO_EXTENSION_MYSQL_PASSWORD');
        $database = self::env('MAGO_PDO_EXTENSION_MYSQL_DATABASE');
        if (
            $port === null
            || $user === null
            || $password === null
            || $database === null
        ) {
            return null;
        }

        return ($this->factory)(
            new MysqlConnection(
                $host,
                $user,
                $password,
                (int) $port,
                $database,
            ),
        );
    }

    private static function env(string $name): ?string
    {
        $value = getenv($name);

        return is_string($value) && $value !== '' ? $value : null;
    }
}
