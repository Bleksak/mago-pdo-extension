<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Services;

use Bleksak\MagoPdoExtension\Dto\SqliteConnectionDto;
use PDO;
use PDOException;

final class PdoFactory
{
    public function __construct()
    {
    }

    public function __invoke(SqliteConnectionDto $connection): ?PDO
    {
        $dsn = "sqlite:/{$connection->path}";

        try {
            return new PDO($dsn);
        }
        catch(PDOException $e) {
            return null;
        }
    }
}
