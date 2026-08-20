<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer;

use Bleksak\MagoPdoExtension\Mago\Analyzer\Providers\PdoQueryReturnTypeProvider;
use Bleksak\MagoPdoExtension\Mago\Analyzer\Providers\PdoStatementFetchReturnTypeProvider;
use Bleksak\MagoPdoExtension\Services\ConnectionProvider;
use Mago\Sdk\Analyzer\Plugin;
use Mago\Sdk\Analyzer\PluginDefinition;
use Mago\Sdk\Analyzer\PluginRegistry;
use Override;

/**
 * Refines the return types of PDO query and statement fetch calls.
 *
 * @api
 */
final class QueryAnalyzerPlugin implements Plugin
{
    #[Override]
    public function getDefinition(): PluginDefinition
    {
        return new PluginDefinition(
            identifier: 'pdo/query-analyzer',
            name: 'Query Analyzer',
            description: 'Analyzes, whether a PDO query is runnable in its current form or not',
        );
    }

    #[Override]
    public function register(PluginRegistry $registry): void
    {
        $connections = new ConnectionProvider();

        $registry->registerMethodReturnTypeProvider(
            new PdoQueryReturnTypeProvider($connections),
        );
        $registry->registerMethodReturnTypeProvider(
            new PdoStatementFetchReturnTypeProvider(),
        );
    }
}
