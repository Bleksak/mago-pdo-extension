<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Sql\MySqlSelectParser;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function array_map;
use function dirname;
use function escapeshellarg;
use function exec;
use function file_get_contents;
use function file_put_contents;
use function implode;
use function serialize;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;
use function unserialize;

/**
 * Exercises the ANTLR warm cache across real process boundaries via
 * tools/warmup/selftest.php: hydration only matters between processes, so
 * each scenario runs in a fresh PHP process.
 *
 * @covers MySqlSelectParser
 */
#[CoversClass(MySqlSelectParser::class)]
final class WarmCacheTest extends TestCase
{
    public function testFreshBlobHydratesAFreshProcess(): void
    {
        $blob = $this->tempBlob();

        $this->selftest('build', $blob, '4');
        $out = $this->selftest('use', $blob);

        self::assertStringContainsString('hydrated=yes', $out);
        self::assertStringContainsString('cols=3', $out);

        unlink($blob);
    }

    public function testStaleGrammarHashIsRejected(): void
    {
        $blob = $this->tempBlob();
        $this->selftest('build', $blob, '4');

        // Flip the ATN hash the way a grammar regeneration would.
        $data = unserialize((string) file_get_contents($blob), [
            'max_depth' => 1_000_000,
        ]);
        self::assertIsArray($data);
        $data['atnHash'] = 'stale-grammar';
        $stale = $blob . '-stale';
        file_put_contents($stale, serialize($data));

        $out = $this->selftest('use', $stale);

        self::assertStringContainsString('hydrated=no', $out);
        self::assertStringContainsString('cols=3', $out);

        unlink($blob);
        unlink($stale);
    }

    public function testCorruptBlobFallsBackToColdPath(): void
    {
        $blob = $this->tempBlob();
        file_put_contents($blob, 'not a cache');

        $out = $this->selftest('use', $blob);

        self::assertStringContainsString('hydrated=no', $out);
        self::assertStringContainsString('cols=3', $out);

        unlink($blob);
    }

    private function tempBlob(): string
    {
        return tempnam(sys_get_temp_dir(), 'warm-cache') . '.bin';
    }

    /**
     * Runs the self-test in a fresh PHP process and returns its output.
     *
     * @param list<string> $args
     */
    private function selftest(string ...$args): string
    {
        $command =
            escapeshellarg(PHP_BINARY)
            . ' '
            . escapeshellarg(dirname(__DIR__, 2) . '/tools/warmup/selftest.php')
            . ' '
            . implode(' ', array_map('escapeshellarg', $args))
            . ' 2>&1';

        exec($command, $output, $code);

        self::assertSame(
            0,
            $code,
            'selftest failed: ' . implode("\n", $output),
        );

        return implode("\n", $output);
    }
}
