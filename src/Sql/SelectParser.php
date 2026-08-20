<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

use Bleksak\MagoPdoExtension\Mago\Analyzer\ExplainableQuery;

use function array_map;
use function count;
use function ctype_alnum;
use function ctype_alpha;
use function explode;
use function in_array;
use function preg_match;
use function str_contains;
use function str_ends_with;
use function strcasecmp;
use function strlen;
use function strtolower;
use function substr;
use function trim;

/**
 * Parses a conservative subset of SELECT statements.
 *
 * Supported shapes:
 * - SELECT <columns> FROM <table> with INNER, CROSS or LEFT [OUTER] JOIN
 * chains and optional table aliases
 * - * and qualified <table>.* column lists
 * - Bare and qualified column references, aliased with or without AS
 * - Integer, string and NULL literals
 * - COUNT(*) and COUNT(<column>)
 * - CONCAT(<args>) and CONCAT_WS(<args>)
 * - CASE ... END with WHEN/THEN/ELSE branches
 *
 * Anything else — UNION, comma joins, RIGHT/FULL joins, derived tables,
 * subqueries, GROUP BY with aggregates other than COUNT, unknown
 * expressions — yields null so callers can fall back to unrefined types
 * instead of risking a wrong one.
 *
 * @internal
 */
final class SelectParser
{
    private const array FROM_SECTION_ENDINGS = [
        'WHERE',
        'GROUP',
        'HAVING',
        'ORDER',
        'LIMIT',
        'FOR',
    ];

    private const array TABLE_REF_ENDINGS = [
        'ON',
        'LEFT',
        'RIGHT',
        'INNER',
        'CROSS',
        'FULL',
    ];

    public static function parse(string $sql): ?SelectQuery
    {
        $statement = trim(ExplainableQuery::firstStatement($sql));

        if (self::topLevelKeyword($statement, 'UNION') !== null) {
            return null;
        }

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
        $fromSection = substr($rest, $fromEnd);

        $ending = self::topLevelKeywordAny(
            $fromSection,
            self::FROM_SECTION_ENDINGS,
        );

        if ($ending !== null) {
            $fromSection = substr($fromSection, 0, $ending[0]);
        }

        $tables = self::parseTableSection($fromSection);

        if ($tables === null || $tables === []) {
            return null;
        }

        $columns = self::parseColumnList($columnList);

        if ($columns === null) {
            return null;
        }

        return new SelectQuery($tables, $columns);
    }

    /**
     * @return array{0: int, 1: int}|null Start and end offsets of the keyword.
     */
    private static function topLevelKeyword(
        string $sql,
        string $keyword,
    ): ?array {
        return self::topLevelKeywordAny($sql, [$keyword]);
    }

    /**
     * @param list<string> $keywords
     *
     * @return array{0: int, 1: int}|null Start and end offsets of the first matching keyword.
     */
    private static function topLevelKeywordAny(
        string $sql,
        array $keywords,
    ): ?array {
        $lower = array_map('strtolower', $keywords);

        foreach (self::topLevelWords($sql) as $word) {
            if (in_array($word[0], $lower, true)) {
                return [$word[1], $word[2]];
            }
        }

        return null;
    }

    /**
     * All identifier-like words at paren depth zero, outside quotes.
     *
     * @return list<array{0: string, 1: int, 2: int}> Lowercased word, start and end offsets.
     */
    private static function topLevelWords(string $sql): array
    {
        $words = [];
        $length = strlen($sql);
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

            $words[] = [
                strtolower(substr($sql, $offset, $wordEnd - $offset)),
                $offset,
                $wordEnd,
            ];

            $offset = $wordEnd - 1;
        }

        return $words;
    }

    /**
     * @return list<SourceTable>|null
     */
    private static function parseTableSection(string $section): ?array
    {
        $joins = self::joinOccurrences($section);

        $tables = [];
        $position = 0;
        $previousType = null;

        foreach ($joins as $join) {
            $range = substr($section, $position, $join['start'] - $position);
            $position = $join['end'];

            $table = self::parseTableRef($range, $previousType);

            if ($table === null) {
                return null;
            }

            $tables[] = $table;
            $previousType = $join['type'];
        }

        $table = self::parseTableRef(
            substr($section, $position),
            $previousType,
        );

        if ($table === null) {
            return null;
        }

        $tables[] = $table;

        return $tables;
    }

    /**
     * Top-level JOIN keywords with the join type that precedes them.
     *
     * @return list<array{start: int, end: int, type: string}>
     */
    private static function joinOccurrences(string $section): array
    {
        $joins = [];
        $words = self::topLevelWords($section);

        foreach ($words as $index => $word) {
            if ($word[0] !== 'join') {
                continue;
            }

            $first = $words[$index - 1] ?? null;
            $second = $words[$index - 2] ?? null;

            $type = 'inner';

            if ($first !== null) {
                $type =
                    $first[0] === 'outer' && $second !== null
                        ? $second[0]
                        : $first[0];
            }

            $joins[] = [
                'start' => $word[1],
                'end' => $word[2],
                'type' => $type,
            ];
        }

        return $joins;
    }

    /**
     * @param string|null $joinType The join type joining this table, if any.
     */
    private static function parseTableRef(
        string $range,
        ?string $joinType,
    ): ?SourceTable {
        if (
            $joinType !== null
            && in_array($joinType, ['right', 'full'], true)
        ) {
            return null;
        }

        $boundary = self::topLevelKeywordAny($range, self::TABLE_REF_ENDINGS);
        $ref = $boundary === null
            ? trim($range)
            : trim(substr($range, 0, $boundary[0]));

        if ($ref === '' || str_contains($ref, ',')) {
            return null;
        }

        $matches = [];

        if (
            preg_match(
                '/^`?([A-Za-z_][A-Za-z0-9_]*)`?(?:\s+(?:AS\s+)?`?([A-Za-z_][A-Za-z0-9_]*)`?)?$/i',
                $ref,
                $matches,
            ) !== 1
        ) {
            return null;
        }

        $name = $matches[1] ?? null;

        if ($name === null) {
            return null;
        }

        return new SourceTable(
            $name,
            $matches[2] ?? null,
            $joinType === 'left',
        );
    }

    /**
     * @return list<SelectedColumn>|null
     */
    private static function parseColumnList(string $columnList): ?array
    {
        $columns = [];

        foreach (self::splitTopLevel($columnList) as $part) {
            $column = self::parseColumn(trim($part));

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

    private static function parseColumn(string $raw): ?SelectedColumn
    {
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

            if ($prefix === null) {
                return null;
            }

            return new SelectedColumn(
                $alias ?? '*',
                SelectedColumnKind::Star,
                qualifiedBy: $prefix,
            );
        }

        $column = self::parseExpression($expression);

        if ($column === null) {
            return null;
        }

        $column->key = $alias ?? $column->key;

        return $column;
    }

    /**
     * Classifies a single expression. The key is a placeholder that the
     * caller replaces when an alias applies.
     */
    private static function parseExpression(string $expression): ?SelectedColumn
    {
        $matches = [];

        if (preg_match('/^[+-]?\d+$/', $expression, $matches) === 1) {
            return new SelectedColumn(
                $expression,
                SelectedColumnKind::LiteralInt,
                literalInt: (int) $expression,
            );
        }

        if (preg_match("/^'([^']*)'$/s", $expression, $matches) === 1) {
            return new SelectedColumn(
                $expression,
                SelectedColumnKind::LiteralString,
                literalString: $matches[1] ?? '',
            );
        }

        if (strcasecmp($expression, 'NULL') === 0) {
            return new SelectedColumn('NULL', SelectedColumnKind::LiteralNull);
        }

        if (
            preg_match(
                '/^COUNT\s*\(\s*(\*|`?[A-Za-z_][A-Za-z0-9_]*`?(?:\.`?[A-Za-z_][A-Za-z0-9_]*`?)?)\s*\)$/i',
                $expression,
                $matches,
            ) === 1
        ) {
            $inner = $matches[1] ?? '*';
            $innerColumn = $inner === '*'
                ? null
                : self::unquote(
                    explode('.', $inner)[count(explode('.', $inner)) - 1] ?? '',
                );

            return new SelectedColumn(
                $expression,
                SelectedColumnKind::Count,
                column: $innerColumn,
            );
        }

        if (
            preg_match(
                '/^(?:CONCAT|CONCAT_WS)\s*\((.*)\)$/is',
                $expression,
                $matches,
            ) === 1
        ) {
            $operands = self::parseOperandList($matches[1] ?? '');

            if ($operands === null) {
                return null;
            }

            return new SelectedColumn(
                $expression,
                SelectedColumnKind::Concat,
                operands: $operands,
            );
        }

        if (
            preg_match('/^CASE\s+(.*)\s*END$/is', $expression, $matches) === 1
        ) {
            $branches = self::parseCaseBranches($matches[1] ?? '');

            if ($branches === null) {
                return null;
            }

            return new SelectedColumn(
                $expression,
                SelectedColumnKind::Case,
                operands: $branches[0],
                hasElse: $branches[1],
            );
        }

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

            return new SelectedColumn(
                $column,
                SelectedColumnKind::Column,
                column: $column,
                qualifiedBy: $second === null ? null : $first,
            );
        }

        return new SelectedColumn(
            trim($expression),
            SelectedColumnKind::Expression,
        );
    }

    /**
     * @return list<SelectedColumn>|null
     */
    public static function parseOperandList(string $list): ?array
    {
        $operands = [];

        foreach (self::splitTopLevel($list) as $part) {
            $part = trim($part);

            if ($part === '') {
                return null;
            }

            $operand = self::parseExpression($part);

            if ($operand === null) {
                return null;
            }

            $operands[] = $operand;
        }

        if ($operands === []) {
            return null;
        }

        return $operands;
    }

    /**
     * @return array{0: list<SelectedColumn>, 1: bool}|null Branches and whether an ELSE exists.
     */
    private static function parseCaseBranches(string $body): ?array
    {
        $keywords = self::topLevelKeywordList($body, ['when', 'then', 'else']);

        $branches = [];
        $hasElse = false;
        $position = 0;
        $count = count($keywords);

        while ($position < $count) {
            $keyword = $keywords[$position] ?? null;

            if ($keyword === null) {
                break;
            }

            if ($keyword[0] === 'when') {
                $then = $keywords[$position + 1] ?? null;

                if ($then === null || $then[0] !== 'then') {
                    return null;
                }

                $next = $keywords[$position + 2] ?? null;
                $branchEnd = $next === null ? strlen($body) : $next[1];
                $operand = self::parseExpression(trim(substr(
                    $body,
                    $then[2],
                    $branchEnd - $then[2],
                )));

                if ($operand === null) {
                    return null;
                }

                $branches[] = $operand;
                $position += 2;

                continue;
            }

            if ($keyword[0] === 'else') {
                if ($position !== ($count - 1)) {
                    return null;
                }

                $operand = self::parseExpression(trim(substr(
                    $body,
                    $keyword[2],
                )));

                if ($operand === null) {
                    return null;
                }

                $branches[] = $operand;
                $hasElse = true;
                $position++;

                continue;
            }

            return null;
        }

        if ($branches === []) {
            return null;
        }

        return [$branches, $hasElse];
    }

    /**
     * @param list<string> $keywords
     *
     * @return list<array{0: string, 1: int, 2: int}>
     */
    private static function topLevelKeywordList(
        string $sql,
        array $keywords,
    ): array {
        $result = [];

        foreach (self::topLevelWords($sql) as $word) {
            if (in_array($word[0], $keywords, true)) {
                $result[] = $word;
            }
        }

        return $result;
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
                '/^(.*\S)\s+AS\s+(`?[A-Za-z_][A-Za-z0-9_]*`?)\s*$/is',
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
