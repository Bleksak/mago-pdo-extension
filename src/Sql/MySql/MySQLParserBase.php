<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql\MySql;

use Antlr\Antlr4\Runtime\Parser;
use Antlr\Antlr4\Runtime\TokenStream;
use function in_array;

/**
 * Base class for the generated {@see \Bleksak\MagoPdoExtension\Sql\MySql\MySQLParser}.
 *
 * PHP port of Oracle's `MySQLParserBase.java`. The Oracle MySQL grammar is
 * parameterized by the server version and the active SQL modes; the grammar's
 * semantic predicates call these methods.
 *
 * @internal
 */
abstract class MySQLParserBase extends Parser
{
    public int $serverVersion = 80200;

    /**
     * @var list<SqlMode>
     */
    public array $sqlModes = [];

    public bool $supportMle = true;

    public function __construct(TokenStream $input)
    {
        parent::__construct($input);

        $this->sqlModes = [];
    }

    public function isSqlModeActive(SqlMode $mode): bool
    {
        return in_array($mode, $this->sqlModes, true);
    }

    public function isPureIdentifier(): bool
    {
        return $this->isSqlModeActive(SqlMode::AnsiQuotes);
    }

    public function isTextStringLiteral(): bool
    {
        return !$this->isSqlModeActive(SqlMode::AnsiQuotes);
    }

    public function isStoredRoutineBody(): bool
    {
        return $this->serverVersion >= 80032 && $this->supportMle;
    }

    public function isSelectStatementWithInto(): bool
    {
        return $this->serverVersion >= 80024 && $this->serverVersion < 80031;
    }

    public function isServerVersionGe80004(): bool
    {
        return $this->serverVersion >= 80004;
    }

    public function isServerVersionGe80011(): bool
    {
        return $this->serverVersion >= 80011;
    }

    public function isServerVersionGe80013(): bool
    {
        return $this->serverVersion >= 80013;
    }

    public function isServerVersionGe80014(): bool
    {
        return $this->serverVersion >= 80014;
    }

    public function isServerVersionGe80016(): bool
    {
        return $this->serverVersion >= 80016;
    }

    public function isServerVersionGe80017(): bool
    {
        return $this->serverVersion >= 80017;
    }

    public function isServerVersionGe80018(): bool
    {
        return $this->serverVersion >= 80018;
    }

    public function isServerVersionGe80019(): bool
    {
        return $this->serverVersion >= 80019;
    }

    public function isServerVersionGe80024(): bool
    {
        return $this->serverVersion >= 80024;
    }

    public function isServerVersionGe80025(): bool
    {
        return $this->serverVersion >= 80025;
    }

    public function isServerVersionGe80027(): bool
    {
        return $this->serverVersion >= 80027;
    }

    public function isServerVersionGe80031(): bool
    {
        return $this->serverVersion >= 80031;
    }

    public function isServerVersionGe80032(): bool
    {
        return $this->serverVersion >= 80032;
    }

    public function isServerVersionGe80100(): bool
    {
        return $this->serverVersion >= 80100;
    }

    public function isServerVersionGe80200(): bool
    {
        return $this->serverVersion >= 80200;
    }

    public function isServerVersionLt80011(): bool
    {
        return $this->serverVersion < 80011;
    }

    public function isServerVersionLt80012(): bool
    {
        return $this->serverVersion < 80012;
    }

    public function isServerVersionLt80014(): bool
    {
        return $this->serverVersion < 80014;
    }

    public function isServerVersionLt80016(): bool
    {
        return $this->serverVersion < 80016;
    }

    public function isServerVersionLt80017(): bool
    {
        return $this->serverVersion < 80017;
    }

    public function isServerVersionLt80024(): bool
    {
        return $this->serverVersion < 80024;
    }

    public function isServerVersionLt80025(): bool
    {
        return $this->serverVersion < 80025;
    }

    public function isServerVersionLt80031(): bool
    {
        return $this->serverVersion < 80031;
    }
}
