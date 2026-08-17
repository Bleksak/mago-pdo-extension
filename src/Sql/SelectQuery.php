<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

/**
 * A parsed single-table SELECT statement.
 *
 * @internal
 */
final class SelectQuery
{
    /**
     * @param list<SelectedColumn> $columns
     */
    public function __construct(
        public string $table,
        public array $columns,
    ) {}
}
