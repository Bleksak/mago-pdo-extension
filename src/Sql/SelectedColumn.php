<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

/**
 * A single column in the column list of a parsed SELECT statement.
 *
 * @internal
 */
final class SelectedColumn
{
    public function __construct(
        public string $key,
        public SelectedColumnKind $kind,
        public ?string $column = null,
        public ?int $literalInt = null,
        public ?string $literalString = null,
    ) {}
}
