<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer\Providers;

use Mago\Sdk\Analyzer\Type;
use Mago\Sdk\Analyzer\Type\ArrayItem;
use Mago\Sdk\Analyzer\Type\ArrayKey;
use Mago\Sdk\Analyzer\Type\ArrayKeyKind;
use Mago\Sdk\Analyzer\Type\KeyedArrayType;
use Mago\Sdk\Analyzer\Type\NamedObjectType;

use function count;
use function is_array;
use function is_string;

/**
 * Encodes a SELECT result shape into a PDOStatement type parameter and
 * decodes it back from a statement receiver type.
 *
 * The encoded shape is the FETCH_ASSOC row shape; other fetch modes are
 * derived from it when decoding.
 *
 * @internal
 */
final class StatementShape
{
    public const string STATEMENT_CLASS = 'PDOStatement';

    /**
     * @param list<array{key: string, type: Type}> $columns
     */
    public static function encode(array $columns): Type
    {
        $items = [];

        foreach ($columns as $column) {
            $items[] = new ArrayItem(
                new ArrayKey(ArrayKeyKind::String, $column['key']),
                false,
                $column['type'],
            );
        }

        return Type::fromAtomic(
            new KeyedArrayType($items, Type::string(), Type::mixed(), false),
        );
    }

    /**
     * @return list<array{key: string, type: Type}>|null
     */
    public static function decode(?Type $receiverType): ?array
    {
        foreach ($receiverType->atomicTypes ?? [] as $atomic) {
            if (!$atomic instanceof NamedObjectType) {
                continue;
            }

            if ($atomic->name !== self::STATEMENT_CLASS) {
                continue;
            }

            $parameters = $atomic->parameters;

            if (!is_array($parameters) || count($parameters) !== 1) {
                continue;
            }

            foreach ($parameters[0]->atomicTypes as $inner) {
                if (!$inner instanceof KeyedArrayType) {
                    continue;
                }

                if ($inner->knownItems === null) {
                    continue;
                }

                $columns = [];

                foreach ($inner->knownItems as $item) {
                    if (!is_string($item->key->value)) {
                        return null;
                    }

                    $columns[] = [
                        'key' => $item->key->value,
                        'type' => $item->type,
                    ];
                }

                return $columns;
            }
        }

        return null;
    }
}
