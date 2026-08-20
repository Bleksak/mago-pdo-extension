<?php

declare(strict_types=1);



/**
 * @return list<array{name: string, sql: string}>
 */
function corpusQueries(): array
{
    $dir = dirname(__DIR__, 2) . '/tests/corpus/src';
    $queries = [];

    foreach (glob($dir . '/*.php') as $file) {
        $source = (string) file_get_contents($file);

        if (
            preg_match_all(
                '/\'(SELECT|INSERT|UPDATE|DELETE|REPLACE|WITH)\b[^\']*\'/is',
                $source,
                $matches,
            ) === 0
        ) {
            continue;
        }

        foreach ($matches[0] as $raw) {
            $sql = substr($raw, 1, -1);

            if (in_array($sql, $queries, true) === false) {
                $queries[] = $sql;
            }
        }
    }

    $out = [];

    foreach ($queries as $index => $sql) {
        $out[] = [
            'name' => sprintf('corpus/%02d', $index + 1),
            'sql' => $sql,
        ];
    }

    return $out;
}

/**
 * A synthetic complexity ladder. Tables do not need to exist: parsing is
 * pure, and the corpus schema (users, orders) is reused for realism.
 *
 * @return list<array{name: string, sql: string}>
 */
function ladderQueries(): array
{
    $big = generatedQuery(6, 6);
    $case = pathologicalCase();

    return [
        ['name' => 'ladder/tiny', 'sql' => 'SELECT 1'],
        [
            'name' => 'ladder/simple',
            'sql' => 'SELECT id, name, email FROM users WHERE id = ?',
        ],
        [
            'name' => 'ladder/expression',
            'sql' => "SELECT u.name, o.total * 1.1 AS vat_total, o.total - 1 AS discounted, u.email "
                . 'FROM users u INNER JOIN orders o ON o.user_id = u.id WHERE u.id = ?',
        ],
        [
            'name' => 'ladder/case',
            'sql' => "SELECT u.id, CASE WHEN o.total > 100 THEN 'big' WHEN o.total > 50 THEN 'mid' "
                . "ELSE 'small' END AS size, u.name FROM users u LEFT JOIN orders o ON o.user_id = u.id",
        ],
        [
            'name' => 'ladder/subquery-where',
            'sql' => 'SELECT id, name FROM users WHERE id IN (SELECT user_id FROM orders WHERE total > ?)',
        ],
        [
            'name' => 'ladder/derived',
            'sql' => 'SELECT s.name, s.order_count FROM (SELECT u.name, COUNT(*) AS order_count '
                . 'FROM users u LEFT JOIN orders o ON o.user_id = u.id GROUP BY u.name) AS s',
        ],
        [
            'name' => 'ladder/cte',
            'sql' => 'WITH recent AS (SELECT id, total FROM orders WHERE total > 10) '
                . 'SELECT r.id, u.name FROM recent r INNER JOIN users u ON u.id = r.id',
        ],
        [
            'name' => 'ladder/union',
            'sql' => 'SELECT id, name FROM users WHERE id = ? '
                . "UNION ALL SELECT id, 'anon' FROM users WHERE id IS NULL",
        ],
        ['name' => 'ladder/scalar-subquery', 'sql' => 'SELECT (SELECT MAX(o2.total) FROM orders o2 '
            . 'WHERE o2.user_id = u.id) AS biggest, u.name FROM users u'],
        ['name' => 'ladder/generated-36col', 'sql' => $big],
        ['name' => 'ladder/pathological-case', 'sql' => $case],
    ];
}

/**
 * Simulates query-builder output: N joined tables, M selected columns per
 * table, a long WHERE clause, GROUP BY and ORDER BY.
 */
function generatedQuery(int $tables, int $colsPerTable): string
{
    $select = [];

    for ($t = 1; $t <= $tables; $t++) {
        for ($c = 1; $c <= $colsPerTable; $c++) {
            $column = "t{$t}.c{$c}";

            if ($c % 3 === 1) {
                $select[] = $column;
            } elseif ($c % 3 === 2) {
                $select[] = "{$column} AS x{$t}_{$c}";
            } else {
                $select[] = "{$column} * 2 + t1.c1 AS x{$t}_{$c}";
            }
        }
    }

    $from = 'FROM t1';

    for ($t = 2; $t <= $tables; $t++) {
        $from .= " INNER JOIN t{$t} ON t{$t}.id = t1.id AND t{$t}.t1_id = t1.id";
    }

    $where = ['t1.c1 = ?', "t2.c2 = 'literal'"];

    for ($t = 1; $t <= $tables; $t++) {
        $where[] = "t{$t}.c3 IS NOT NULL";
    }

    return sprintf(
        'SELECT %s %s WHERE %s GROUP BY t1.c1 ORDER BY t1.c1 DESC LIMIT 100',
        implode(', ', $select),
        $from,
        implode(' AND ', $where),
    );
}

/**
 * A select list of many CASE branches and function calls: deep expression
 * trees with many siblings.
 */
function pathologicalCase(): string
{
    $branches = '';

    for ($i = 1; $i <= 20; $i++) {
        $branches .= "WHEN c{$i} > {$i} THEN 'v{$i}' ";
    }

    $select = [
        "CASE {$branches}ELSE 'none' END AS bucket",
        "COALESCE(c1, c2, c3, 'fallback') AS coalesced",
        'CONCAT(c1, c2, c3, c4, c5) AS merged',
        '(SELECT MAX(c1) FROM t1 WHERE t1.id = t2.id) AS sub',
        'COUNT(*) AS n',
        'AVG(c2) AS avg_c2',
        'u.name',
        'o.total',
    ];

    return sprintf(
        'SELECT %s FROM t1 INNER JOIN t2 ON t2.id = t1.id INNER JOIN users u ON u.id = t1.id '
            . 'INNER JOIN orders o ON o.user_id = t1.id WHERE t1.c1 = ? GROUP BY t1.c1',
        implode(', ', $select),
    );
}

// ---------------------------------------------------------------------------
// Measurement
// ---------------------------------------------------------------------------


/**
 * @return list<array{name: string, sql: string}>
 */
function benchQueries(): array
{
    return [...corpusQueries(), ...ladderQueries()];
}
