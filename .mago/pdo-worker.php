<?php

declare(strict_types=1);

use Bleksak\MagoPdoExtension\Mago\PdoExtension;
use Mago\Sdk\Worker;

require dirname(__DIR__, 4) . '/vendor/autoload.php';

new Worker(PdoExtension::create())->run();
