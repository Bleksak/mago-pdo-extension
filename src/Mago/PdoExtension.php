<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago;

use Mago\Sdk\Extension;

final class PdoExtension
{
    private function __construct() {}

    public static function create(): Extension
    {
        return new Extension(
            identifier: 'bleksak/mago-pdo-extension',
            name: 'PDO Extension',
            version: '0.0.1',
            analyzerPlugins: [],
        );
    }
}
