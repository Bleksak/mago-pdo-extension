<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Mago\Linter\Rules\PdoUnrunnableQueryRule;
use Mago\Sdk\Reporting\Level;
use Mago\Sdk\Syntax\NodeKind;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(PdoUnrunnableQueryRule::class)]
final class PdoUnrunnableQueryRuleTest extends TestCase
{
    public function testDefinition(): void
    {
        $definition = new PdoUnrunnableQueryRule()->getDefinition();

        self::assertSame('pdo/unrunnable-query', $definition->code);
        self::assertSame(Level::Error, $definition->defaultLevel);
        self::assertTrue($definition->defaultEnabled);
        self::assertSame(
            [NodeKind::MethodCall, NodeKind::NullSafeMethodCall],
            $definition->targets,
        );
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function literalProvider(): iterable
    {
        yield 'single quoted' => [
            "'SELECT * FROM users'",
            'SELECT * FROM users',
        ];
        yield 'double quoted' => [
            '"SELECT * FROM users"',
            'SELECT * FROM users',
        ];
        yield 'escaped single quote' => [
            "'SELECT * FROM t WHERE name = \\''",
            "SELECT * FROM t WHERE name = '",
        ];
        yield 'single quoted keeps backslashes' => ["'C:\\temp'", 'C:\\temp'];
        yield 'single quoted keeps escapes' => ["'SELECT \\n'", 'SELECT \\n'];
        yield 'double quoted escapes' => ['"\\n\\t\\$\\""', "\n\t\$\""];
        yield 'byte string stays verbatim' => ["b'\\n'", '\\n'];
        yield 'empty string' => ["''", ''];
    }

    #[DataProvider('literalProvider')]
    public function testDecodeLiteral(string $raw, string $expected): void
    {
        self::assertSame(
            $expected,
            PdoUnrunnableQueryRule::decodeLiteral($raw),
        );
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function undecodableProvider(): iterable
    {
        yield 'no quotes' => ['SELECT * FROM users'];
        yield 'unclosed' => ["'SELECT * FROM users"];
        yield 'double quoted hex escape' => ['"\\x41"'];
        yield 'double quoted unknown escape' => ['"\\z"'];
        yield 'u prefix' => ["u'SELECT'"];
    }

    #[DataProvider('undecodableProvider')]
    public function testDecodeLiteralReturnsNullForUndecodable(string $raw): void
    {
        self::assertNull(PdoUnrunnableQueryRule::decodeLiteral($raw));
    }
}
