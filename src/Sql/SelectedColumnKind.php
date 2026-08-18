<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

/**
 * The kind of a selected column in a parsed SELECT statement.
 *
 * @internal
 */
enum SelectedColumnKind
{
    case Star;
    case Column;
    case Count;
    case Concat;
    case Case;
    case LiteralInt;
    case LiteralString;
    case LiteralNull;
    case Expression;
}
