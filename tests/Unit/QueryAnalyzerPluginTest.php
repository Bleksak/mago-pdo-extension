<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Mago\Analyzer\Hooks\PdoQueryExplainHook;
use Bleksak\MagoPdoExtension\Mago\Analyzer\QueryAnalyzerPlugin;
use Mago\Sdk\Analyzer\FileAnalysisRequirement;
use Mago\Sdk\Analyzer\MethodTarget;
use Mago\Sdk\Analyzer\PluginRegistry;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function array_map;

#[CoversClass(QueryAnalyzerPlugin::class)]
final class QueryAnalyzerPluginTest extends TestCase
{
    public function testDefinition(): void
    {
        $definition = new QueryAnalyzerPlugin()->getDefinition();

        self::assertSame('pdo/query-analyzer', $definition->identifier);
        self::assertSame('Query Analyzer', $definition->name);
    }

    public function testRegistersExplainHook(): void
    {
        $registry = new PluginRegistry();

        new QueryAnalyzerPlugin()->register($registry);

        $hook = $registry->getMethodCallAnalysisHooks()[0] ?? null;

        self::assertInstanceOf(PdoQueryExplainHook::class, $hook);
    }

    public function testHookTargetsAndRequirements(): void
    {
        $registry = new PluginRegistry();

        new QueryAnalyzerPlugin()->register($registry);

        $hook = $registry->getMethodCallAnalysisHooks()[0] ?? null;
        self::assertInstanceOf(PdoQueryExplainHook::class, $hook);

        self::assertSame(
            ['PDO::query', 'PDO::prepare', 'PDO::exec'],
            array_map(
                static fn(MethodTarget $target): string => (
                    $target->class . '::' . $target->method
                ),
                $hook->getTargets(),
            ),
        );
        self::assertSame(
            [FileAnalysisRequirement::ArgumentTypes],
            $hook->getRequirements(),
        );
    }
}
