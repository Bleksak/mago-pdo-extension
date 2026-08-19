<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql\MySql;

/**
 * SQL modes that influence the Oracle MySQL grammar's parsing behavior.
 *
 * @internal
 */
enum SqlMode: string
{
    case NoMode = 'NO_MODE';

    case AnsiQuotes = 'ANSI_QUOTES';

    case HighNotPrecedence = 'HIGH_NOT_PRECEDENCE';

    case PipesAsConcat = 'PIPES_AS_CONCAT';

    case IgnoreSpace = 'IGNORE_SPACE';

    case NoBackslashEscapes = 'NO_BACKSLASH_ESCAPES';
}
