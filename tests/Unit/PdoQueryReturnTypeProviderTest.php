<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Mago\Analyzer\Providers\PdoQueryReturnTypeProvider;
use Bleksak\MagoPdoExtension\Services\ConnectionProvider;
use Closure;
use Mago\Sdk\Analyzer\Argument;
use Mago\Sdk\Analyzer\Codebase;
use Mago\Sdk\Analyzer\Invocation;
use Mago\Sdk\Analyzer\InvocationKind;
use Mago\Sdk\Analyzer\ReturnTypeProviderContext;
use Mago\Sdk\Analyzer\Type;
use Mago\Sdk\Analyzer\Type\NamedObjectType;
use Mago\Sdk\Analyzer\Type\ScalarType;
use Mago\Sdk\Analyzer\Type\ScalarTypeKind;
use Mago\Sdk\Analyzer\TypeComparator;
use Mago\Sdk\CancellationTokenInterface;
use Mago\Sdk\PHPVersion;
use Mago\Sdk\Span;
use Override;
use PDO;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

use function putenv;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;

#[CoversClass(PdoQueryReturnTypeProvider::class)]
final class PdoQueryReturnTypeProviderTest extends TestCase
{
    private const array ENV_VARS = [
        'MAGO_PDO_EXTENSION_SQLITE_PATH',
        'MAGO_PDO_EXTENSION_MYSQL_HOST',
        'MAGO_PDO_EXTENSION_MYSQL_PORT',
        'MAGO_PDO_EXTENSION_MYSQL_USER',
        'MAGO_PDO_EXTENSION_MYSQL_PASSWORD',
        'MAGO_PDO_EXTENSION_MYSQL_DATABASE',
    ];

    private ?string $databaseFile = null;

    #[Override]
    protected function setUp(): void
    {
        foreach (self::ENV_VARS as $name) {
            putenv($name);
        }

        $this->databaseFile = (string) tempnam(
            sys_get_temp_dir(),
            'mago-pdo-extension-provider-',
        );

        $pdo = new PDO('sqlite:' . $this->databaseFile);
        $pdo->exec('CREATE TABLE users (
            id INTEGER PRIMARY KEY,
            name TEXT NOT NULL,
            email TEXT
        )');

        putenv('MAGO_PDO_EXTENSION_SQLITE_PATH=' . $this->databaseFile);
    }

    #[Override]
    protected function tearDown(): void
    {
        foreach (self::ENV_VARS as $name) {
            putenv($name);
        }

        if ($this->databaseFile !== null) {
            unlink($this->databaseFile);
        }
    }

    public function testVerifiedSelectRefinesToNonFalsyStatement(): void
    {
        $type = $this->provider()->getReturnType($this->context(
            'query',
            'SELECT name FROM users',
        ));

        self::assertNotNull($type);
        self::assertFalse(self::hasFalseAtomic($type));

        $statement = self::statement($type);
        self::assertNotNull($statement);
        self::assertSame('PDOStatement', $statement->name);
        self::assertNotNull($statement->parameters);
        self::assertCount(1, $statement->parameters);
    }

    public function testVerifiedPrepareRefinesToNonFalsyStatement(): void
    {
        $type = $this->provider()->getReturnType($this->context(
            'prepare',
            'SELECT name FROM users WHERE id = ?',
        ));

        self::assertNotNull($type);
        self::assertFalse(self::hasFalseAtomic($type));

        $statement = self::statement($type);
        self::assertNotNull($statement);
        self::assertNotNull($statement->parameters);
    }

    public function testVerifiedDmlRefinesToPlainNonFalsyStatement(): void
    {
        $type = $this->provider()->getReturnType($this->context(
            'prepare',
            'UPDATE users SET name = ? WHERE id = ?',
        ));

        self::assertNotNull($type);
        self::assertFalse(self::hasFalseAtomic($type));

        $statement = self::statement($type);
        self::assertNotNull($statement);
        self::assertSame([], $statement->parameters ?? null);
    }

    public function testUnverifiedQueryStaysSilent(): void
    {
        $type = $this->provider()->getReturnType($this->context(
            'query',
            'SELECT no_such_column FROM users',
        ));

        self::assertNull($type);
    }

    public function testNonExplainableQueryStaysSilent(): void
    {
        $type = $this->provider()->getReturnType($this->context(
            'query',
            'PRAGMA table_info(users)',
        ));

        self::assertNull($type);
    }

    public function testDynamicQueryStaysSilent(): void
    {
        $type = $this->provider()->getReturnType($this->context(
            'query',
            'SELECT name FROM users',
            literal: false,
        ));

        self::assertNull($type);
    }

    public function testOldPhpKeepsFalseInUnion(): void
    {
        $type = $this->provider()->getReturnType($this->context(
            'query',
            'SELECT name FROM users',
            PHPVersion::fromParts(8, 0),
        ));

        self::assertNotNull($type);
        self::assertTrue(self::hasFalseAtomic($type));
    }

    public function testMissingConnectionStaysSilent(): void
    {
        foreach (self::ENV_VARS as $name) {
            putenv($name);
        }

        $type = $this->provider()->getReturnType($this->context(
            'query',
            'SELECT name FROM users',
        ));

        self::assertNull($type);
    }

    private function provider(): PdoQueryReturnTypeProvider
    {
        return new PdoQueryReturnTypeProvider(new ConnectionProvider());
    }

    private function context(
        string $method,
        string $query,
        ?PHPVersion $phpVersion = null,
        bool $literal = true,
    ): ReturnTypeProviderContext {
        return new ReturnTypeProviderContext(
            $phpVersion ?? PHPVersion::fromParts(8, 4),
            new ReflectionClass(Codebase::class)->newInstanceWithoutConstructor(),
            new Invocation(
                InvocationKind::InstanceMethod,
                $method,
                'PDO',
                Type::namedObject('PDO'),
                new Span(0, 10),
                [
                    new Argument(
                        null,
                        false,
                        false,
                        new Span(0, 10),
                        $query,
                        $literal ? Type::literalString($query) : Type::string(),
                    ),
                ],
            ),
            new ReflectionClass(TypeComparator::class)->newInstanceWithoutConstructor(),
            new class implements CancellationTokenInterface {
                #[Override]
                public function isCancelled(): bool
                {
                    return false;
                }

                #[Override]
                public function throwIfCancelled(): void {}

                #[Override]
                public function subscribe(Closure $callback): int
                {
                    return 0;
                }

                #[Override]
                public function unsubscribe(int $subscription): void {}
            },
        );
    }

    private static function hasFalseAtomic(Type $type): bool
    {
        foreach ($type->atomicTypes as $atomic) {
            if (
                $atomic instanceof ScalarType
                && $atomic->kind === ScalarTypeKind::Boolean
                && $atomic->refinement === false
            ) {
                return true;
            }
        }

        return false;
    }

    private static function statement(?Type $type): ?NamedObjectType
    {
        if ($type === null) {
            return null;
        }

        foreach ($type->atomicTypes as $atomic) {
            if (
                $atomic instanceof NamedObjectType
                && $atomic->name === 'PDOStatement'
            ) {
                return $atomic;
            }
        }

        return null;
    }
}
