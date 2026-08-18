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
    /**
     * @param list<SelectedColumn>|null $operands Expression arguments for
     * Concat and Case columns, null for everything else.
     */
    public function __construct(
        public string $key,
        public SelectedColumnKind $kind,
        public ?string $column = null,
        public ?string $qualifiedBy = null,
        public ?int $literalInt = null,
        public ?string $literalString = null,
        public ?array $operands = null,
        public bool $hasElse = false,
    ) {}
}
