<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Dto;

use SensitiveParameter;

/**
 * @internal
 */
final class MysqlConnection
{
    public function __construct(
        public string $hostname,
        public string $username,
        #[SensitiveParameter]
        public string $password,
        public int $port,
        public string $database,
    ) {}
}
