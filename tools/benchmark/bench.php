<?php

declare(strict_types=1);

/**
 * Benchmark: PmaSelectParser (phpmyadmin/sql-parser) vs legacy SelectParser.
 *
 * Two regimes:
 *
 *   COLD PASS   each query parsed once, in order — approximates the real
 *               analyzer cost in a fresh process.
 *   STEADY      interleaved round-robin, per-query medians over --iters
 *               rounds; forced GC every 5th round outside the timed window.
 *
 * Usage: php tools/benchmark/bench.php [--filter <substr>] [--iters <n>]
 *                                      [--no-cold] [--no-steady] [--json]
 */

use Bleksak\MagoPdoExtension\Sql\PmaSelectParser;
use Bleksak\MagoPdoExtension\Sql\SelectParser;
use PhpMyAdmin\SqlParser\Lexer;
use PhpMyAdmin\SqlParser\Parser;

require dirname(__DIR__, 2) . '/vendor/autoload.php';
require __DIR__ . '/bench-queries.php';

$opts = ['iters' => 300, 'filter' => null, 'cold' => true, 'steady' => true, 'json' => false];

for ($i = 1; $i < count($argv); ++$i) {
    $arg = $argv[$i];

    match ($arg) {
        '--no-cold' => $opts['cold'] = false,
        '--no-steady' => $opts['steady'] = false,
        '--json' => $opts['json'] = true,
        default => null,
    };

    if ($arg === '--filter' && ($argv[$i + 1] ?? null) !== null) {
        $opts['filter'] = $argv[++$i];
    }

    if ($arg === '--iters' && ($argv[$i + 1] ?? null) !== null) {
        $opts['iters'] = (int) $argv[++$i];
    }
}

$dataset = array_values(array_filter(
    benchQueries(),
    static fn (array $q): bool => $opts['filter'] === null
        || str_contains($q['name'], $opts['filter'])
        || str_contains($q['sql'], $opts['filter']),
));

if ($dataset === []) {
    fwrite(STDERR, "no queries matched\n");
    exit(1);
}

$now = static fn (): float => microtime(true);

/**
 * The full PMA path: lex + parse + model build, as the provider uses it.
 */
$pmaParse = static function (string $sql): bool {
    $select = PmaSelectParser::parse($sql);

    return $select !== null;
};

/**
 * PMA phases. total_us is the production path (one PmaSelectParser::parse);
 * lexer_us/parser_us come from a separate lex+parse run of the same SQL and
 * approximate the internal split, so classify = total - lexer - parser.
 */
$pmaPhases = static function (string $sql) use ($now): array {
    $t0 = $now();
    $ok = PmaSelectParser::parse($sql) !== null;
    $total = $now() - $t0;

    $t1 = $now();
    $lexer = new Lexer($sql);
    $t2 = $now();
    $parser = new Parser($lexer->list);
    $parser->parse();
    $t3 = $now();

    return [
        'total_us' => $total * 1e6,
        'lexer_us' => ($t2 - $t1) * 1e6,
        'parser_us' => ($t3 - $t2) * 1e6,
        'ok' => $ok,
    ];
};

$results = [];

if ($opts['cold']) {
    printf("COLD PASS (fresh process, each query once)\n");
    printf("%-28s %10s %10s\n", 'query', 'legacy us', 'pma us');

    $coldTotal = ['legacy' => 0.0, 'pma' => 0.0];

    foreach ($dataset as $query) {
        $t0 = $now();
        $legacyOk = SelectParser::parse($query['sql']) !== null;
        $legacy = ($now() - $t0) * 1e6;

        $t0 = $now();
        $pmaOk = $pmaParse($query['sql']);
        $pma = ($now() - $t0) * 1e6;

        $coldTotal['legacy'] += $legacy;
        $coldTotal['pma'] += $pma;
        $results[$query['name']] = ['cold' => ['legacy_us' => $legacy, 'pma_us' => $pma]];

        if (!$opts['json']) {
            printf(
                "%-28s %10.1f %10.1f%s\n",
                $query['name'],
                $legacy,
                $pma,
                ($legacyOk === $pmaOk) ? '' : '  <-- parse result differs',
            );
        }
    }

    if (!$opts['json']) {
        printf(
            "cold pass total: legacy %.2f s   pma %.2f s\n",
            $coldTotal['legacy'] / 1e6,
            $coldTotal['pma'] / 1e6,
        );
    }
}

if ($opts['steady']) {
    gc_collect_cycles();

    $samples = [];
    $iters = $opts['iters'];

    for ($round = 0; $round < $iters; ++$round) {
        foreach ($dataset as $query) {
            $sql = $query['sql'];

            $t0 = $now();
            $legacyOk = SelectParser::parse($sql) !== null;
            $legacy = ($now() - $t0) * 1e6;

            $phases = $pmaPhases($sql);

            $samples[$query['name']][] = [
                'legacy_us' => $legacy,
                'pma_us' => $phases['total_us'],
                'lexer_us' => $phases['lexer_us'],
                'parser_us' => $phases['parser_us'],
                'ok' => $legacyOk && $phases['ok'],
            ];

            if (($round + 1) % 5 === 0) {
                gc_collect_cycles();
            }
        }
    }

    if (!$opts['json']) {
        printf("\nSTEADY STATE (medians over %d rounds)\n", $iters);
        printf("%-28s %10s %10s %9s %9s %10s\n", 'query', 'legacy us', 'pma us', 'lex us', 'par us', 'classify us');
    }

    $steadyTotal = ['legacy' => 0.0, 'pma' => 0.0];

    foreach ($dataset as $query) {
        $all = $samples[$query['name']] ?? [];

        $median = static function (string $key) use ($all): float {
            $values = array_map(static fn (array $row): float => $row[$key], $all);
            sort($values);

            return $values[intdiv(count($values), 2)] ?? 0.0;
        };

        $row = [
            'legacy_us' => $median('legacy_us'),
            'pma_us' => $median('pma_us'),
            'lexer_us' => $median('lexer_us'),
            'parser_us' => $median('parser_us'),
        ];
        $row['classify_us'] = $row['pma_us'] - $row['lexer_us'] - $row['parser_us'];

        $results[$query['name']] = [...($results[$query['name']] ?? []), 'steady' => $row];
        $steadyTotal['legacy'] += $row['legacy_us'];
        $steadyTotal['pma'] += $row['pma_us'];

        if (!$opts['json']) {
            printf(
                "%-28s %10.1f %10.1f %9.1f %9.1f %10.1f\n",
                $query['name'],
                $row['legacy_us'],
                $row['pma_us'],
                $row['lexer_us'],
                $row['parser_us'],
                $row['classify_us'],
            );
        }
    }

    if (!$opts['json']) {
        printf(
            "steady total: legacy %.2f ms   pma %.2f ms\n",
            $steadyTotal['legacy'] / 1e3,
            $steadyTotal['pma'] / 1e3,
        );
    }
}

if ($opts['json']) {
    echo json_encode([
        'generated' => date('c'),
        'php' => PHP_VERSION,
        'iters' => $opts['iters'],
        'results' => $results,
    ], JSON_PRETTY_PRINT), "\n";
}
