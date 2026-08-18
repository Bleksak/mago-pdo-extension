<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Dto\SqliteConnectionDto;
use Bleksak\MagoPdoExtension\Services\PdoFactory;
use Override;
use PDO;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function chdir;
use function file_exists;
use function getcwd;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;

#[CoversClass(PdoFactory::class)]
final class PdoFactoryTest extends TestCase
{
    private string $originalDirectory;

    #[Override]
    protected function setUp(): void
    {
        $this->originalDirectory = (string) getcwd();
    }

    #[Override]
    protected function tearDown(): void
    {
        chdir($this->originalDirectory);
    }

    public function testConnectsUsingRelativePath(): void
    {
        $file = (string) tempnam(
            sys_get_temp_dir(),
            'mago-pdo-extension-factory-',
        );

        try {
            chdir(sys_get_temp_dir());

            $pdo = (new PdoFactory())(new SqliteConnectionDto(basename($file)));

            self::assertInstanceOf(PDO::class, $pdo);
        } finally {
            chdir($this->originalDirectory);

            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    public function testConnectsUsingAbsolutePath(): void
    {
        $file = (string) tempnam(
            sys_get_temp_dir(),
            'mago-pdo-extension-factory-',
        );

        try {
            $pdo = (new PdoFactory())(new SqliteConnectionDto($file));

            self::assertInstanceOf(PDO::class, $pdo);
        } finally {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    public function testMissingFileReturnsNull(): void
    {
        $pdo = (new PdoFactory())(
            new SqliteConnectionDto('/nonexistent/mago-pdo.sqlite'),
        );

        self::assertNull($pdo);
    }
}
