<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

use Bleksak\MagoPdoExtension\Mago\Analyzer\ExplainableQuery;

use function ctype_alnum;
use function ctype_alpha;
use function ltrim;
use function preg_match;
use function str_contains;
use function str_ends_with;
use function str_starts_with;
use function strcasecmp;
use function strlen;
use function strtolower;
use function substr;
use function trim;

/**
 * Parses a conservative subset of SELECT statements.
 *
 * Only single-table SELECT queries are supported. Anything the parser
 * cannot understand yields null so callers can fall back to unrefined
 * types instead of risking a wrong one.
 *
 * @internal
 */
final class SelectParser
{
    public static function parse(string $sql): ?SelectQuery
    {
        $statement = trim(ExplainableQuery::firstStatement($sql));

        $matches = [];

        if (preg_match('/^SELECT\s+(.*)$/is', $statement, $matches) !== 1) {
            return null;
        }

        $rest = $matches[1] ?? null;

        if ($rest === null) {
            return null;
        }

        $from = self::topLevelKeyword($rest, 'FROM');

        if ($from === null) {
            return null;
        }

        [$fromStart, $fromEnd] = $from;

        $columnList = trim(substr($rest, 0, $fromStart));
        $table = self::parseTable(ltrim(substr($rest, $fromEnd)));

        if ($table === null) {
            return null;
        }

        $columns = self::parseColumnList($columnList, $table);

        if ($columns === null) {
            return null;
        }

        return new SelectQuery($table, $columns);
    }

    /**
     * @return array{0: int, 1: int}|null Start and end offsets of the keyword.
     */
    private static function topLevelKeyword(
        string $sql,
        string $keyword,
    ): ?array {
        $length = strlen($sql);
        $keywordLength = strlen($keyword);
        $depth = 0;
        $inSingle = false;
        $inDouble = false;
        $inBacktick = false;

        for ($offset = 0; $offset < $length; $offset++) {
            $char = $sql[$offset];

            if (
                $char === "'"
                && !$inDouble
                && !$inBacktick
                && !self::isEscaped($sql, $offset)
            ) {
                $inSingle = !$inSingle;

                continue;
            }

            if (
                $char === '"'
                && !$inSingle
                && !$inBacktick
                && !self::isEscaped($sql, $offset)
            ) {
                $inDouble = !$inDouble;

                continue;
            }

            if ($char === '`' && !$inSingle && !$inDouble) {
                $inBacktick = !$inBacktick;

                continue;
            }

            if ($inSingle || $inDouble || $inBacktick) {
                continue;
            }

            if ($char === '(') {
                $depth++;

                continue;
            }

            if ($char === ')') {
                $depth--;

                continue;
            }

            if ($depth !== 0 || !ctype_alpha($char)) {
                continue;
            }

            $wordEnd = $offset;

            while ($wordEnd < $length) {
                $next = $sql[$wordEnd];

                if (!ctype_alnum($next) && $next !== '_') {
                    break;
                }

                $wordEnd++;
            }

            if (
                ($wordEnd - $offset) === $keywordLength
                && strtolower(substr(
                    $sql,
                    $offset,
                    $keywordLength,
                )) === strtolower($keyword)
            ) {
                return [$offset, $wordEnd];
            }

            $offset = $wordEnd - 1;
        }

        return null;
    }

    private static function parseTable(string $clause): ?string
    {
        $matches = [];

        if (
            preg_match('/^(`?)([A-Za-z_][A-Za-z0-9_]*)\1/', $clause, $matches)
            !== 1
        ) {
            return null;
        }

        $whole = $matches[0] ?? null;
        $name = $matches[2] ?? null;

        if ($whole === null || $name === null) {
            return null;
        }

        $rest = ltrim(substr($clause, strlen($whole)));

        if (
            str_starts_with($rest, '(')
            || str_starts_with($rest, ',')
            || preg_match('/\b(?:JOIN|UNION)\b/i', $rest)
        ) {
            return null;
        }

        return $name;
    }

    /**
     * @return list<SelectedColumn>|null
     */
    private static function parseColumnList(
        string $columnList,
        string $table,
    ): ?array {
        $columns = [];

        foreach (self::splitTopLevel($columnList) as $part) {
            $column = self::parseColumn(trim($part), $table);

            if ($column === null) {
                return null;
            }

            $columns[] = $column;
        }

        if ($columns === []) {
            return null;
        }

        return $columns;
    }

    /**
     * Splits a column list on top-level commas.
     *
     * @return list<string>
     */
    private static function splitTopLevel(string $columnList): array
    {
        $parts = [];
        $current = '';
        $length = strlen($columnList);
        $depth = 0;
        $inSingle = false;
        $inDouble = false;
        $inBacktick = false;

        for ($offset = 0; $offset < $length; $offset++) {
            $char = $columnList[$offset];

            if (
                $char === "'"
                && !$inDouble
                && !$inBacktick
                && !self::isEscaped($columnList, $offset)
            ) {
                $inSingle = !$inSingle;

                $current .= $char;

                continue;
            }

            if (
                $char === '"'
                && !$inSingle
                && !$inBacktick
                && !self::isEscaped($columnList, $offset)
            ) {
                $inDouble = !$inDouble;

                $current .= $char;

                continue;
            }

            if ($char === '`' && !$inSingle && !$inDouble) {
                $inBacktick = !$inBacktick;

                $current .= $char;

                continue;
            }

            if ($inSingle || $inDouble || $inBacktick) {
                $current .= $char;

                continue;
            }

            if ($char === '(') {
                $depth++;
            }

            if ($char === ')') {
                $depth--;
            }

            if ($char === ',' && $depth === 0) {
                $parts[] = $current;

                $current = '';

                continue;
            }

            $current .= $char;
        }

        $parts[] = $current;

        return $parts;
    }

    private static function parseColumn(
        string $raw,
        string $table,
    ): ?SelectedColumn {
        if ($raw === '') {
            return null;
        }

        [$expression, $alias] = self::splitAlias($raw);

        if ($expression === '*') {
            return new SelectedColumn($alias ?? '*', SelectedColumnKind::Star);
        }

        $matches = [];

        if (
            preg_match(
                '/^`?([A-Za-z_][A-Za-z0-9_]*)`?\.\*$/',
                $expression,
                $matches,
            ) === 1
        ) {
            $prefix = $matches[1] ?? null;

            if ($prefix === null || $prefix !== $table) {
                return null;
            }

            return new SelectedColumn($alias ?? '*', SelectedColumnKind::Star);
        }

        if (preg_match('/^[+-]?\d+$/', $expression, $matches)) {
            return new SelectedColumn(
                $alias ?? $expression,
                SelectedColumnKind::LiteralInt,
                literalInt: (int) $expression,
            );
        }

        $matches = [];

        if (preg_match("/^'([^']*)'$/s", $expression, $matches) === 1) {
            return new SelectedColumn(
                $alias ?? $expression,
                SelectedColumnKind::LiteralString,
                literalString: $matches[1] ?? '',
            );
        }

        if (strcasecmp($expression, 'NULL') === 0) {
            return new SelectedColumn(
                $alias ?? 'NULL',
                SelectedColumnKind::LiteralNull,
            );
        }

        $matches = [];

        if (
            preg_match(
                '/^COUNT\s*\(\s*(\*|`?[A-Za-z_][A-Za-z0-9_]*`?)\s*\)$/i',
                $expression,
                $matches,
            ) === 1
        ) {
            $inner = $matches[1] ?? '*';

            return new SelectedColumn(
                $alias ?? $expression,
                SelectedColumnKind::Count,
                column: $inner === '*' ? null : self::unquote($inner),
            );
        }

        $matches = [];

        if (
            preg_match(
                '/^`?([A-Za-z_][A-Za-z0-9_]*)`?(?:\.`?([A-Za-z_][A-Za-z0-9_]*)`?)?$/',
                $expression,
                $matches,
            ) === 1
        ) {
            $first = $matches[1] ?? null;
            $second = $matches[2] ?? null;

            if ($first === null) {
                return null;
            }

            $column = $second ?? $first;

            if ($second !== null && $first !== $table) {
                return null;
            }

            return new SelectedColumn(
                $alias ?? $column,
                SelectedColumnKind::Column,
                column: $column,
            );
        }

        return new SelectedColumn(
            $alias ?? trim($expression),
            SelectedColumnKind::Expression,
        );
    }

    /**
     * Splits a trailing alias off a column expression.
     *
     * @return array{0: string, 1: ?string} Expression and alias, if any.
     */
    private static function splitAlias(string $raw): array
    {
        $trimmed = trim($raw);

        $matches = [];

        if (
            preg_match(
                '/^(.*\S)\s+AS\s+(`?[A-Za-z_][A-Za-z0-9_]*`?)\s*$/i',
                $trimmed,
                $matches,
            ) === 1
        ) {
            $expression = $matches[1] ?? null;
            $alias = $matches[2] ?? null;

            if ($expression === null || $alias === null) {
                return [$trimmed, null];
            }

            return [trim($expression), self::unquote($alias)];
        }

        $matches = [];

        if (
            preg_match(
                '/^(.*\S)\s+(`?[A-Za-z_][A-Za-z0-9_]*`?)\s*$/s',
                $trimmed,
                $matches,
            ) === 1
        ) {
            $expression = $matches[1] ?? null;
            $alias = $matches[2] ?? null;

            if ($expression === null || $alias === null) {
                return [$trimmed, null];
            }

            $expression = trim($expression);

            if (
                !str_contains($expression, '.')
                && (str_ends_with($expression, ')') || $expression[0] === "'")
            ) {
                return [$expression, self::unquote($alias)];
            }
        }

        return [$trimmed, null];
    }

    private static function unquote(string $identifier): string
    {
        return trim($identifier, '`');
    }

    private static function isEscaped(string $sql, int $offset): bool
    {
        return $offset > 0 && $sql[$offset - 1] === '\\';
    }
}
