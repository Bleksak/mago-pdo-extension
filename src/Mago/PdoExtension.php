<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago;

use Bleksak\MagoPdoExtension\Mago\Analyzer\QueryAnalyzerPlugin;
use Bleksak\MagoPdoExtension\Mago\Linter\Rules\PdoUnrunnableQueryRule;
use Mago\Sdk\Extension;

/**
 * The extension entrypoint loaded by the Mago worker.
 *
 * @api
 */
final class PdoExtension
{
    private function __construct() {}

    public static function create(): Extension
    {
        return new Extension(
            identifier: 'bleksak/mago-pdo-extension',
            name: 'PDO Extension',
            version: '0.0.1',
            linterRules: [new PdoUnrunnableQueryRule()],
            analyzerPlugins: [new QueryAnalyzerPlugin()],
        );
    }
}
