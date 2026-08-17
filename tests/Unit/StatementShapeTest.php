<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Mago\Analyzer\Providers\StatementShape;
use Mago\Sdk\Analyzer\Type;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function array_map;

#[CoversClass(StatementShape::class)]
final class StatementShapeTest extends TestCase
{
    public function testEncodeDecodeRoundTrip(): void
    {
        $columns = [
            ['key' => 'id', 'type' => Type::int()],
            [
                'key' => 'name',
                'type' => Type::union(Type::string(), Type::null()),
            ],
        ];

        $shape = StatementShape::encode($columns);
        $receiver = Type::union(
            Type::namedObject('PDOStatement', $shape),
            Type::false(),
        );

        $decoded = StatementShape::decode($receiver);

        self::assertNotNull($decoded);

        self::assertSame(
            [
                ['key' => 'id', 'type' => 'int'],
                ['key' => 'name', 'type' => 'string|null'],
            ],
            array_map(self::describeColumn(...), $decoded),
        );
    }

    public function testDecodeWithoutParametersReturnsNull(): void
    {
        $decoded = StatementShape::decode(Type::namedObject('PDOStatement'));

        self::assertNull($decoded);
    }

    public function testDecodeOtherClassReturnsNull(): void
    {
        $shape = StatementShape::encode([
            ['key' => 'id', 'type' => Type::int()],
        ]);

        $decoded = StatementShape::decode(Type::namedObject(
            'OtherStatement',
            $shape,
        ));

        self::assertNull($decoded);
    }

    public function testDecodeMixedReturnsNull(): void
    {
        self::assertNull(StatementShape::decode(Type::mixed()));
    }

    public function testDecodeNullReturnsNull(): void
    {
        self::assertNull(StatementShape::decode(null));
    }

    public function testEncodeProducesNamedObjectCompatibleShape(): void
    {
        $shape = StatementShape::encode([
            ['key' => 'name', 'type' => Type::string()],
        ]);

        self::assertIsArray($shape->atomicTypes);
        self::assertCount(1, $shape->atomicTypes);
    }

    /**
     * @param array{key: string, type: Type} $column
     * @return array{key: string, type: string}
     */
    private static function describeColumn(array $column): array
    {
        return [
            'key' => $column['key'],
            'type' => (string) $column['type'],
        ];
    }
}
