<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer;

use function preg_match;
use function strlen;
use function substr;
use function trim;

/**
 * Extracts a checkable statement from a raw PDO query literal.
 *
 * The result is the first statement of the query, limited to statement
 * types the extension verifies: it is checked for runnability against the
 * database with EXPLAIN (SQLite) or a server-side prepare (MySQL).
 *
 * Placeholders are kept as-is: both check mechanisms accept native `?`
 * and `:name` placeholders.
 *
 * @internal
 */
final class ExplainableQuery
{
    private const string SQL_PREFIX = '/^\s*(?:SELECT|INSERT|UPDATE|DELETE|REPLACE|WITH)\b/i';

    public static function fromQuery(string $query): ?string
    {
        $statement = trim(self::firstStatement($query));

        if ($statement === '' || !preg_match(self::SQL_PREFIX, $statement)) {
            return null;
        }

        return $statement;
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
}
