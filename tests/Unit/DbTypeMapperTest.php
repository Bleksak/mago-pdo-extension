<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Tests;

use Bleksak\MagoPdoExtension\Services\DbTypeMapper;
use Bleksak\MagoPdoExtension\Sql\ColumnInfo;
use Mago\Sdk\Analyzer\Type;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function strval;

#[CoversClass(DbTypeMapper::class)]
final class DbTypeMapperTest extends TestCase
{
    public function testMapsMysqlIntegerTypes(): void
    {
        $mapper = new DbTypeMapper('mysql');

        foreach ([
            'INT',
            'TINYINT(1)',
            'SMALLINT',
            'BIGINT UNSIGNED',
        ] as $dbType) {
            $type = $mapper->columnType(new ColumnInfo('id', $dbType, false));

            self::assertSame('int', strval($type), $dbType);
        }
    }

    public function testMapsMysqlFloatingPointTypes(): void
    {
        $mapper = new DbTypeMapper('mysql');

        foreach (['FLOAT', 'DOUBLE'] as $dbType) {
            $type = $mapper->columnType(new ColumnInfo(
                'total',
                $dbType,
                false,
            ));

            self::assertSame('float', strval($type), $dbType);
        }
    }

    public function testMapsMysqlStringLikeTypes(): void
    {
        $mapper = new DbTypeMapper('mysql');

        foreach ([
            'VARCHAR(100)',
            'TEXT',
            'DECIMAL(10,2)',
            'DATETIME',
            'JSON',
            'BLOB',
        ] as $dbType) {
            $type = $mapper->columnType(new ColumnInfo(
                'value',
                $dbType,
                false,
            ));

            self::assertSame('string', strval($type), $dbType);
        }
    }

    public function testMapsUnknownMysqlTypeToMixed(): void
    {
        $mapper = new DbTypeMapper('mysql');

        $type = $mapper->columnType(new ColumnInfo(
            'value',
            'FROBNICATE(1)',
            false,
        ));

        self::assertSame('mixed', strval($type));
    }

    public function testMapsMysqlNullability(): void
    {
        $mapper = new DbTypeMapper('mysql');

        $nullable = $mapper->columnType(new ColumnInfo(
            'email',
            'VARCHAR(255)',
            true,
        ));
        $required = $mapper->columnType(new ColumnInfo(
            'email',
            'VARCHAR(255)',
            false,
        ));

        self::assertSame('string|null', strval($nullable));
        self::assertSame('string', strval($required));
    }

    public function testMapsSqliteIntegerAffinity(): void
    {
        $mapper = new DbTypeMapper('sqlite');

        foreach ([
            'INTEGER',
            'INT',
            'TINYINT',
            'MEDIUMINT UNSIGNED',
        ] as $dbType) {
            $type = $mapper->columnType(new ColumnInfo('id', $dbType, false));

            self::assertSame('int', strval($type), $dbType);
        }
    }

    public function testMapsSqliteTextAffinity(): void
    {
        $mapper = new DbTypeMapper('sqlite');

        foreach (['TEXT', 'VARCHAR(50)', 'CHAR(3)', ''] as $dbType) {
            $type = $mapper->columnType(new ColumnInfo('name', $dbType, false));

            self::assertSame('string', strval($type), $dbType);
        }
    }

    public function testMapsSqliteRealAffinity(): void
    {
        $mapper = new DbTypeMapper('sqlite');

        foreach (['REAL', 'FLOAT', 'DOUBLE PRECISION'] as $dbType) {
            $type = $mapper->columnType(new ColumnInfo(
                'total',
                $dbType,
                false,
            ));

            self::assertSame('float', strval($type), $dbType);
        }
    }

    public function testMapsSqliteNumericAffinity(): void
    {
        $mapper = new DbTypeMapper('sqlite');

        foreach (['NUMERIC', 'DECIMAL(10,2)', 'BOOLEAN'] as $dbType) {
            $type = $mapper->columnType(new ColumnInfo(
                'value',
                $dbType,
                false,
            ));

            self::assertSame('int|float', strval($type), $dbType);
        }
    }

    public function testMapsSqliteNullability(): void
    {
        $mapper = new DbTypeMapper('sqlite');

        $type = $mapper->columnType(new ColumnInfo('email', 'TEXT', true));

        self::assertSame('string|null', strval($type));
    }

    public function testUnknownDriverMapsToMixed(): void
    {
        $mapper = new DbTypeMapper('pgsql');

        $type = $mapper->columnType(new ColumnInfo('id', 'integer', false));

        self::assertSame('mixed', strval($type));
    }

    public function testTypeIsReturnedUntouchedWhenNotNullable(): void
    {
        $mapper = new DbTypeMapper('sqlite');

        $type = $mapper->columnType(new ColumnInfo('id', 'INTEGER', false));

        self::assertInstanceOf(Type::class, $type);
    }
}
