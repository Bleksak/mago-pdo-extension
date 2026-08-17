<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Dto;

final class SqliteConnectionDto
{
    public function __construct(
        public string $path,
    ) {}
}
