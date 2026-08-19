<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql\MySql;

use function explode;
use function strtoupper;
use function trim;

/**
 * Parses a MySQL `sql_mode` string into the grammar's mode flags.
 *
 * @internal
 */
final class SqlModes
{
    private function __construct() {}

    /**
     * @return list<SqlMode>
     */
    public static function fromString(string $modes): array
    {
        $result = [];

        foreach (explode(',', strtoupper($modes)) as $mode) {
            $mode = trim($mode);

            switch ($mode) {
                case 'ANSI':
                case 'DB2':
                case 'MAXDB':
                case 'MSSQL':
                case 'ORACLE':
                case 'POSTGRESQL':
                    $result[] = SqlMode::AnsiQuotes;
                    $result[] = SqlMode::PipesAsConcat;
                    $result[] = SqlMode::IgnoreSpace;
                    break;
                case 'ANSI_QUOTES':
                    $result[] = SqlMode::AnsiQuotes;
                    break;
                case 'PIPES_AS_CONCAT':
                    $result[] = SqlMode::PipesAsConcat;
                    break;
                case 'NO_BACKSLASH_ESCAPES':
                    $result[] = SqlMode::NoBackslashEscapes;
                    break;
                case 'IGNORE_SPACE':
                    $result[] = SqlMode::IgnoreSpace;
                    break;
                case 'HIGH_NOT_PRECEDENCE':
                case 'MYSQL323':
                case 'MYSQL40':
                    $result[] = SqlMode::HighNotPrecedence;
                    break;
            }
        }

        return $result;
    }
}
