<?php

declare(strict_types=1);

/**
 * Parity check: PmaSelectParser vs legacy SelectParser on the same SQL.
 *
 * Usage: php tools/spike-parity.php
 */

use Bleksak\MagoPdoExtension\Sql\PmaSelectParser;
use Bleksak\MagoPdoExtension\Sql\SelectParser;

require dirname(__DIR__) . '/vendor/autoload.php';

require __DIR__ . '/benchmark/bench-queries.php';

$pairs = benchQueries();

$pairs[] = [
    'name' => 'adversarial/derived',
    'sql' => 'SELECT id FROM (SELECT id FROM users) AS t',
];
$pairs[] = [
    'name' => 'adversarial/no-from',
    'sql' => 'SELECT 1',
];
$pairs[] = [
    'name' => 'adversarial/insert',
    'sql' => "INSERT INTO users (name) VALUES ('a')",
];
$pairs[] = [
    'name' => 'adversarial/empty',
    'sql' => '',
];

// Intentional divergences: PMA accepts what the regex parser rejects.
// Asserted separately, not part of the parity count.
$divergences = [
    [
        'name' => 'divergence/comma-join',
        'sql' => 'SELECT * FROM users, orders',
        'tables' => ['users', 'orders'],
    ],
    [
        'name' => 'divergence/right-join',
        'sql' => 'SELECT u.name FROM users u RIGHT JOIN orders o ON o.user_id = u.id',
        'tables' => ['users', 'orders'],
    ],
    [
        'name' => 'divergence/full-join',
        'sql' => 'SELECT u.name FROM users u FULL JOIN orders o ON o.user_id = u.id',
        'tables' => ['users', 'orders'],
    ],
];

$mismatches = 0;

foreach ($pairs as $query) {
    $name = $query['name'];
    $sql = $query['sql'];

    $a = SelectParser::parse($sql);
    $b = PmaSelectParser::parse($sql);

    $norm = static function (?object $q): array {
        if ($q === null) {
            return ['NULL'];
        }

        $tables = array_map(
            static fn (object $t): array => [$t->name, $t->alias, $t->leftJoined],
            $q->tables,
        );
        $columns = array_map(
            static function (object $c): array {
                return [
                    $c->key,
                    $c->kind->name,
                    $c->column,
                    $c->qualifiedBy,
                    $c->literalInt,
                    $c->literalString,
                    $c->hasElse,
                    $c->operands === null ? null : array_map(
                        static fn (object $o): array => [
                            $o->key,
                            $o->kind->name,
                            $o->column,
                            $o->qualifiedBy,
                            $o->literalInt,
                            $o->literalString,
                            $o->operands,
                        ],
                        $c->operands,
                    ),
                ];
            },
            $q->columns,
        );

        return [$tables, $columns];
    };

    $na = $norm($a);
    $nb = $norm($b);

    if ($na === $nb) {
        printf("MATCH  %s\n", $name);
    } else {
        $mismatches++;
        printf("DIFF   %s\n", $name);
        echo "  sql:     $sql\n";
        echo "  regex:   ", json_encode($na), "\n";
        echo "  pma:     ", json_encode($nb), "\n";
    }
}

printf("\n%d mismatches out of %d\n", $mismatches, count($pairs));

foreach ($divergences as $case) {
    $regex = SelectParser::parse($case['sql']);
    $pma = PmaSelectParser::parse($case['sql']);

    if ($regex === null && $pma !== null) {
        $names = array_map(static fn (object $t): string => $t->name, $pma->tables);
        sort($names);
        $expected = $case['tables'];
        sort($expected);

        printf(
            "%s  pma accepts (tables: %s), regex rejects\n",
            $names === $expected ? 'DIVERGE-OK' : 'DIVERGE-BAD',
            implode(', ', $names),
        );
    } else {
        printf(
            "DIVERGE-BAD %s  regex=%s pma=%s\n",
            $case['name'],
            $regex === null ? 'null' : 'parsed',
            $pma === null ? 'null' : 'parsed',
        );
    }
}
