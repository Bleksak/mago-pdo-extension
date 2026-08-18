<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

/**
 * A table referenced in the FROM clause or a JOIN of a parsed SELECT.
 *
 * @internal
 */
final class SourceTable
{
    public function __construct(
        public string $name,
        public ?string $alias = null,
        public bool $leftJoined = false,
    ) {}

    /**
     * Every identifier that can refer to this table in a query.
     *
     * @return list<string>
     */
    public function references(): array
    {
        return (
            $this->alias === null ? [$this->name] : [$this->name, $this->alias]
        );
    }
}
