<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer;

use Mago\Sdk\Analyzer\Plugin;

;
use Mago\Sdk\Analyzer\PluginDefinition;
use Mago\Sdk\Analyzer\PluginRegistry;

final class QueryAnalyzerPlugin implements Plugin
{
    public function getDefinition(): PluginDefinition
    {
        return new PluginDefinition(
            identifier: 'pdo/query-analyzer',
            name: 'Query Analyzer',
            description: 'Analyzes, whether a PDO query is runnable in its current form or not',
        );
    }

    public function register(PluginRegistry $registry): void {
    }
}
