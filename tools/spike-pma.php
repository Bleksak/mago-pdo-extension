<?php

declare(strict_types=1);

/**
 * Spike: how does phpmyadmin/sql-parser fare on the corpus + ladder queries?
 *
 * Usage: php tools/spike-pma.php [ast]
 */

use PhpMyAdmin\SqlParser\Lexer;
use PhpMyAdmin\SqlParser\Parser;

require dirname(__DIR__) . '/vendor/autoload.php';

/** @return list<array{name: string, sql: string}> */
function corpusQueries(): array
{
    $dir = dirname(__DIR__) . '/tests/corpus/src';
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
        $out[] = ['name' => sprintf('corpus/%02d', $index + 1), 'sql' => $sql];
    }

    return $out;
}

/** @return list<array{name: string, sql: string}> */
function ladderQueries(): array
{
    return [
        ['name' => 'ladder/tiny', 'sql' => 'SELECT 1'],
        [
            'name' => 'ladder/simple',
            'sql' => 'SELECT name FROM users WHERE id = ?',
        ],
        [
            'name' => 'ladder/expression',
            'sql' => 'SELECT name, id * 2 AS double_id FROM users WHERE id = ?',
        ],
        [
            'name' => 'ladder/star',
            'sql' => 'SELECT * FROM users',
        ],
        [
            'name' => 'ladder/join',
            'sql' => 'SELECT u.name, o.total FROM users u INNER JOIN orders o ON o.user_id = u.id WHERE u.active = 1',
        ],
        [
            'name' => 'ladder/left-join',
            'sql' => 'SELECT u.name, o.total FROM users u LEFT JOIN orders o ON o.user_id = u.id',
        ],
        [
            'name' => 'ladder/group',
            'sql' => 'SELECT user_id, COUNT(*) AS n, SUM(total) FROM orders GROUP BY user_id',
        ],
        [
            'name' => 'ladder/order-limit',
            'sql' => 'SELECT id, name FROM users ORDER BY name DESC LIMIT 10',
        ],
        [
            'name' => 'ladder/like',
            'sql' => 'SELECT id FROM users WHERE name LIKE ? AND active = 1',
        ],
        [
            'name' => 'ladder/coalesce',
            'sql' => 'SELECT COALESCE(middle_name, \'x\') AS m FROM users WHERE id = ?',
        ],
        [
            'name' => 'ladder/in-subquery',
            'sql' => 'SELECT id FROM users WHERE id IN (SELECT user_id FROM orders WHERE total > ?)',
        ],
        [
            'name' => 'ladder/exists',
            'sql' => 'SELECT id FROM users u WHERE EXISTS (SELECT 1 FROM orders o WHERE o.user_id = u.id)',
        ],
        [
            'name' => 'ladder/scalar-subquery',
            'sql' => 'SELECT id, (SELECT MAX(total) FROM orders WHERE user_id = users.id) AS max_total FROM users',
        ],
        [
            'name' => 'ladder/derived-table',
            'sql' => 'SELECT t.id FROM (SELECT id, name FROM users WHERE active = 1) AS t WHERE t.name = ?',
        ],
        [
            'name' => 'ladder/cte',
            'sql' => 'WITH active AS (SELECT id FROM users WHERE active = 1) SELECT id FROM active',
        ],
        [
            'name' => 'ladder/union',
            'sql' => 'SELECT id FROM users WHERE active = 1 UNION ALL SELECT id FROM users WHERE id > ?',
        ],
        [
            'name' => 'ladder/case',
            'sql' => 'SELECT CASE WHEN id > ? THEN \'big\' WHEN id > 0 THEN \'mid\' ELSE \'small\' END AS size FROM users',
        ],
        [
            'name' => 'ladder/function',
            'sql' => 'SELECT UPPER(name) FROM users WHERE LENGTH(name) > ?',
        ],
        ['name' => 'ladder/insert', 'sql' => 'INSERT INTO users (name, email) VALUES (?, ?)'],
        ['name' => 'ladder/update', 'sql' => 'UPDATE users SET name = ? WHERE id = ?'],
        ['name' => 'ladder/delete', 'sql' => 'DELETE FROM users WHERE id = ?'],
        [
            'name' => 'ladder/generated-36col',
            'sql' => 'SELECT ' . implode(', ', array_map(
                static fn (int $i): string => 't' . ($i % 3) . '.col' . $i . ' AS c' . $i,
                range(0, 35),
            )) . ' FROM t0 JOIN t1 ON t1.a = t0.a JOIN t2 ON t2.a = t0.a WHERE t0.id = ?',
        ],
    ];
}

$dataset = [...corpusQueries(), ...ladderQueries()];

$total = 0.0;
$failures = 0;

foreach ($dataset as $query) {
    $start = microtime(true);

    try {
        $lexer = new Lexer($query['sql']);
        $parser = new Parser($lexer->list);
        $parser->parse();
        $errors = $parser->errors;
        $statements = $parser->statements;
    } catch (Throwable $e) {
        $errors = [$e];
        $statements = [];
    }

    $elapsed = microtime(true) - $start;
    $total += $elapsed;

    $ok = count($errors) === 0 && count($statements) === 1;

    if ($ok === false) {
        $failures++;
        $first = $errors[0] ?? null;
        $reason = $first === null
            ? sprintf('%d statements', count($statements))
            : $first->getMessage();
        printf("FAIL  %-28s %8.1f us  %s\n", $query['name'], $elapsed * 1e6, $reason);
    } else {
        printf("ok    %-28s %8.1f us\n", $query['name'], $elapsed * 1e6);
    }

    if (($query['name'] === 'ladder/join' || $query['name'] === 'ladder/group') && in_array('ast', $argv, true)) {
        echo "\n--- AST for {$query['name']} ---\n";
        $stmt = $statements[0];
        echo get_class($stmt), "\n";

        if ($stmt->expr !== []) {
            foreach ($stmt->expr as $field) {
                if ($field instanceof \PhpMyAdmin\SqlParser\Components\Field) {
                    printf(
                        "field: table=%s column=%s alias=%s expr=%s\n",
                        var_export($field->table, true),
                        var_export($field->column, true),
                        var_export($field->alias, true),
                        var_export($field->expr, true),
                    );
                } else {
                    printf("field: other class=%s vars=%s\n", get_class($field), json_encode(get_object_vars($field)));
                }
            }
        }

        if ($stmt->from !== []) {
            foreach ($stmt->from as $table) {
                printf("from: class=%s vars=%s\n", get_class($table), json_encode(get_object_vars($table)));
            }
        }

        echo "\n";
    }
}

printf(
    "\n%d/%d parsed clean, total %.3f s, avg %.1f us\n",
    count($dataset) - $failures,
    count($dataset),
    $total,
    $total / count($dataset) * 1e6,
);
