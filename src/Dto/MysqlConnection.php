<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Dto;

final class MysqlConnection
{
    public function __construct(
        public string $hostname,
        public string $username,
        public string $password,
        public int $port,
    ) {}
}
