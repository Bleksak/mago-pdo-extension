<?php

declare(strict_types=1);

/**
 * Spike: how does PMA represent tricky select-list items?
 *
 * Usage: php tools/spike-pma2.php
 */

use PhpMyAdmin\SqlParser\Components\Expression;
use PhpMyAdmin\SqlParser\Lexer;
use PhpMyAdmin\SqlParser\Parser;

require dirname(__DIR__) . '/vendor/autoload.php';

$queries = [
    'SELECT 1',
    "SELECT 'x'",
    'SELECT NULL',
    'SELECT *, id FROM users',
    'SELECT u.* FROM users u',
    'SELECT COUNT(*) AS n FROM users',
    'SELECT COUNT(DISTINCT id) FROM users',
    'SELECT CONCAT(first, last) AS full_name FROM users',
    "SELECT CASE WHEN id > 5 THEN 'big' ELSE 'small' END AS size FROM users",
    'SELECT CASE id WHEN 1 THEN \'one\' WHEN 2 THEN \'two\' ELSE \'other\' END FROM users',
    'SELECT COALESCE(a, b) FROM users',
    'SELECT id + 1 FROM users',
    'SELECT -id FROM users',
    'SELECT CAST(id AS CHAR) FROM users',
    'SELECT (SELECT MAX(total) FROM orders WHERE user_id = users.id) FROM users',
    'SELECT SUM(total) FROM orders GROUP BY user_id',
    'SELECT `name` FROM users WHERE id = ?',
    'SELECT IF(active, 1, 0) FROM users',
    'SELECT id FROM users WHERE name LIKE ? AND active = 1',
    'SELECT id FROM users WHERE id IN (SELECT user_id FROM orders)',
];

$dump = function (object $obj, int $depth = 0): string {
    $pad = str_repeat('  ', $depth);
    $out = '';
    $class = get_class($obj);

    foreach (get_object_vars($obj) as $name => $value) {
        if ($value === null || $value === [] || $value === '') {
            continue;
        }

        if (is_scalar($value)) {
            $out .= sprintf("%s%s = %s\n", $pad, $name, var_export($value, true));
        } elseif (is_object($value)) {
            if ($depth < 2) {
                $out .= "$pad$name =>\n" . $dump($value, $depth + 1);
            } else {
                $out .= "$pad$name = (object " . get_class($value) . ")\n";
            }
        } else {
            $out .= $pad . $name . ' = [' . count($value) . " items]\n";
        }
    }

    return $out;
};

foreach ($queries as $sql) {
    echo "=== $sql\n";

    try {
        $lexer = new Lexer($sql);
        $parser = new Parser($lexer->list);
        $parser->parse();

        if ($parser->errors !== []) {
            echo '  ERRORS: ', $parser->errors[0]->getMessage(), "\n";
            continue;
        }

        $stmt = $parser->statements[0] ?? null;

        if ($stmt === null) {
            echo "  no statement\n";
            continue;
        }

        foreach ($stmt->expr ?? [] as $i => $item) {
            echo "  [{$i}] ", get_class($item), "\n";
            echo '  ', $dump($item), "\n";
        }
    } catch (Throwable $e) {
        echo '  EXCEPTION: ', $e->getMessage(), "\n";
    }
}
