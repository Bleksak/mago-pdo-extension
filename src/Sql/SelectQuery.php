<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

/**
 * A parsed SELECT statement.
 *
 * @internal
 */
final class SelectQuery
{
    /**
     * @param list<SourceTable> $tables
     * @param list<SelectedColumn> $columns
     */
    public function __construct(
        public array $tables,
        public array $columns,
    ) {}
}
