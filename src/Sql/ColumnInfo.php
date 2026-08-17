<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

/**
 * Schema information for a single database column.
 *
 * @internal
 */
final class ColumnInfo
{
    public function __construct(
        public string $name,
        public string $dbType,
        public bool $nullable,
    ) {}
}
