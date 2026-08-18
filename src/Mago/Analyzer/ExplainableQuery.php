<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer;

use function preg_match;
use function preg_replace;
use function str_replace;
use function strlen;
use function substr;
use function trim;

/**
 * Extracts an EXPLAINable statement from a raw PDO query literal.
 *
 * The result can be prefixed with `EXPLAIN` and executed against a
 * database to verify the query is runnable in its current form.
 *
 * @internal
 */
final class ExplainableQuery
{
    private const string SQL_PREFIX = '/^\s*(?:SELECT|INSERT|UPDATE|DELETE|REPLACE|WITH)\b/i';

    public static function fromQuery(string $query, string $driver): ?string
    {
        $statement = trim(self::firstStatement($query));

        if ($statement === '' || !preg_match(self::SQL_PREFIX, $statement)) {
            return null;
        }

        return self::replacePlaceholders($statement, $driver);
    }

    /**
     * Returns the first statement of a raw query, cutting at the first
     * top-level semicolon.
     */
    public static function firstStatement(string $query): string
    {
        $length = strlen($query);
        $inSingle = false;
        $inDouble = false;

        for ($offset = 0; $offset < $length; $offset++) {
            $char = $query[$offset];

            if (
                $char === "'"
                && !$inDouble
                && !self::isEscaped($query, $offset)
            ) {
                $inSingle = !$inSingle;

                continue;
            }

            if (
                $char === '"'
                && !$inSingle
                && !self::isEscaped($query, $offset)
            ) {
                $inDouble = !$inDouble;

                continue;
            }

            if ($char === ';' && !$inSingle && !$inDouble) {
                return substr($query, 0, $offset);
            }
        }

        return $query;
    }

    private static function isEscaped(string $query, int $offset): bool
    {
        return $offset > 0 && $query[$offset - 1] === '\\';
    }

    private static function replacePlaceholders(
        string $statement,
        string $driver,
    ): string {
        // SQLite natively accepts ? and :name placeholders, so the
        // statement is used as-is.
        if ($driver === 'sqlite') {
            return $statement;
        }

        // MySQL EXPLAIN only reliably accepts literals, so PDO
        // placeholders are replaced with 1. An integer (unlike NULL) is
        // also accepted in LIMIT clauses, where EXPLAIN rejects NULL.
        $statement = str_replace('?', '1', $statement);

        return (string) preg_replace('/(?<!:):[a-zA-Z_]\w*/', '1', $statement);
    }
}
