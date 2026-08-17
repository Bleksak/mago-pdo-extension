<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Mago\Analyzer\QueryAnalyzerPlugin;
use Bleksak\MagoPdoExtension\Mago\PdoExtension;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PdoExtension::class)]
final class PdoExtensionTest extends TestCase
{
    public function testFactoryOwnsStableRegistration(): void
    {
        $extension = PdoExtension::create();

        self::assertSame('bleksak/mago-pdo-extension', $extension->identifier);
        self::assertSame('PDO Extension', $extension->name);
        self::assertSame('0.0.1', $extension->version);
        self::assertCount(1, $extension->analyzerPlugins);

        $plugin = $extension->analyzerPlugins[0] ?? null;

        self::assertInstanceOf(QueryAnalyzerPlugin::class, $plugin);
    }
}
