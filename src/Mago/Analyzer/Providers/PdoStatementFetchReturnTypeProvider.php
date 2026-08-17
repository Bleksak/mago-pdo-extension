<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer\Providers;

use Mago\Sdk\Analyzer\Argument;
use Mago\Sdk\Analyzer\MethodReturnTypeProvider;
use Mago\Sdk\Analyzer\MethodTarget;
use Mago\Sdk\Analyzer\ReturnTypeProviderContext;
use Mago\Sdk\Analyzer\Type;
use Mago\Sdk\Analyzer\Type\ArrayItem;
use Mago\Sdk\Analyzer\Type\ArrayKey;
use Mago\Sdk\Analyzer\Type\ArrayKeyKind;
use Mago\Sdk\Analyzer\Type\KeyedArrayType;
use Mago\Sdk\Analyzer\Type\ObjectProperty;
use Mago\Sdk\Analyzer\Type\ObjectShapeType;
use Override;
use PDO;

use function count;
use function strtolower;

/**
 * Refines the return types of PDOStatement fetch methods based on the
 * result shape encoded by PdoQueryReturnTypeProvider.
 *
 * The provider stays silent (returns null) when the receiver carries no
 * encoded shape, so unrefined native types are used as a fallback.
 *
 * @internal
 */
final class PdoStatementFetchReturnTypeProvider implements
    MethodReturnTypeProvider
{
    #[Override]
    public function getTargets(): array
    {
        return [
            MethodTarget::exact('PDOStatement', 'fetch'),
            MethodTarget::exact('PDOStatement', 'fetchColumn'),
            MethodTarget::exact('PDOStatement', 'fetchAll'),
        ];
    }

    #[Override]
    public function getReturnType(ReturnTypeProviderContext $context): ?Type
    {
        $columns = StatementShape::decode($context->invocation->receiverType);

        if ($columns === null) {
            return null;
        }

        $invocation = $context->invocation;

        // Invocation names are lowercased by the analyzer.
        return match (strtolower($invocation->name)) {
            'fetch' => self::fetch($columns, $invocation->getArgument(0)),
            'fetchall' => self::fetchAll($columns, $invocation->getArgument(0)),
            'fetchcolumn' => self::fetchColumn(
                $columns,
                $invocation->getArgument(0),
            ),
            default => null,
        };
    }

    /**
     * @param list<array{key: string, type: Type}> $columns
     */
    private static function fetch(
        array $columns,
        ?Argument $modeArgument,
    ): ?Type {
        $mode = self::literalInt($modeArgument);

        if ($mode === false) {
            return null;
        }

        $shape = self::shape($columns, $mode ?? PDO::FETCH_ASSOC);

        if ($shape === null) {
            return null;
        }

        return Type::union($shape, Type::false());
    }

    /**
     * @param list<array{key: string, type: Type}> $columns
     */
    private static function fetchAll(
        array $columns,
        ?Argument $modeArgument,
    ): ?Type {
        $mode = self::literalInt($modeArgument);

        if ($mode === false) {
            return null;
        }

        $shape = self::shape($columns, $mode ?? PDO::FETCH_ASSOC);

        return $shape === null ? null : Type::list($shape);
    }

    /**
     * @param list<array{key: string, type: Type}> $columns
     */
    private static function fetchColumn(
        array $columns,
        ?Argument $indexArgument,
    ): ?Type {
        $index = self::literalInt($indexArgument);

        if ($index === false) {
            return null;
        }

        $index ??= 0;

        if ($index < 0 || $index >= count($columns)) {
            return null;
        }

        $entry = $columns[$index] ?? null;

        if ($entry === null) {
            return null;
        }

        return Type::union($entry['type'], Type::false());
    }

    /**
     * Resolves a literal int argument.
     *
     * Returns null when the argument is absent, false when it is present
     * but not a resolvable literal, and the literal itself otherwise.
     */
    private static function literalInt(?Argument $argument): int|false|null
    {
        if ($argument === null) {
            return null;
        }

        return $argument->type?->getLiteralInt() ?? false;
    }

    /**
     * @param list<array{key: string, type: Type}> $columns
     */
    private static function shape(array $columns, int $mode): ?Type
    {
        $items = [];
        $properties = [];

        foreach ($columns as $index => $column) {
            if ($mode === PDO::FETCH_OBJ) {
                $properties[] = new ObjectProperty(
                    $column['key'],
                    false,
                    $column['type'],
                );

                continue;
            }

            if (
                $mode !== PDO::FETCH_ASSOC
                && $mode !== PDO::FETCH_NUM
                && $mode !== PDO::FETCH_BOTH
            ) {
                return null;
            }

            $stringKey = new ArrayKey(ArrayKeyKind::String, $column['key']);
            $intKey = new ArrayKey(ArrayKeyKind::Integer, $index);

            if ($mode === PDO::FETCH_ASSOC || $mode === PDO::FETCH_BOTH) {
                $items[] = new ArrayItem($stringKey, false, $column['type']);
            }

            if ($mode === PDO::FETCH_NUM || $mode === PDO::FETCH_BOTH) {
                $items[] = new ArrayItem($intKey, false, $column['type']);
            }
        }

        if ($mode === PDO::FETCH_OBJ) {
            return Type::fromAtomic(new ObjectShapeType($properties, false));
        }

        if ($mode === PDO::FETCH_NUM) {
            $keyType = Type::int();
        } elseif ($mode === PDO::FETCH_ASSOC) {
            $keyType = Type::string();
        } else {
            $keyType = Type::union(Type::string(), Type::int());
        }

        return Type::fromAtomic(
            new KeyedArrayType($items, $keyType, Type::mixed(), false),
        );
    }
}
