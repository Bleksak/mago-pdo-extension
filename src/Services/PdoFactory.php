<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Services;

use Bleksak\MagoPdoExtension\Dto\MysqlConnection;
use Bleksak\MagoPdoExtension\Dto\SqliteConnectionDto;
use PDO;
use PDOException;

use function sprintf;

/**
 * Builds PDO connections for the extension's verification queries.
 *
 * @internal
 */
final class PdoFactory
{
    public function __invoke(SqliteConnectionDto|MysqlConnection $connection): ?PDO
    {
        try {
            return match (true) {
                $connection instanceof SqliteConnectionDto => new PDO(
                    "sqlite:{$connection->path}",
                    options: [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    ],
                ),
                $connection instanceof MysqlConnection => new PDO(
                    sprintf(
                        'mysql:host=%s;port=%d;dbname=%s',
                        $connection->hostname,
                        $connection->port,
                        $connection->database,
                    ),
                    $connection->username,
                    $connection->password,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
                ),
            };
        } catch (PDOException) {
            return null;
        }
    }
}
