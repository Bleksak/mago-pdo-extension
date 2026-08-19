<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql\MySql;

use Antlr\Antlr4\Runtime\CharStream;
use Antlr\Antlr4\Runtime\CommonToken;
use Antlr\Antlr4\Runtime\IntStream;
use Antlr\Antlr4\Runtime\Lexer;
use Antlr\Antlr4\Runtime\Token;
use Override;
use function in_array;
use function ord;
use function strlen;
use function substr;

/**
 * Base class for the generated {@see \Bleksak\MagoPdoExtension\Sql\MySql\MySQLLexer}.
 *
 * PHP port of Oracle's `MySQLLexerBase.java`. The Oracle MySQL grammar calls
 * these methods from lexer actions: version predicates, SQL-mode predicates,
 * keyword-as-function disambiguation (`COUNT` vs `count`), numeric token
 * classification, and `DOT_SYMBOL` token splicing.
 *
 * @internal
 */
abstract class MySQLLexerBase extends Lexer
{
    private const string LONG_STRING = '2147483647';

    private const int LONG_LENGTH = 10;

    private const string SIGNED_LONG_STRING = '-2147483648';

    private const string LONG_LONG_STRING = '9223372036854775807';

    private const int LONG_LONG_LENGTH = 19;

    private const string SIGNED_LONG_LONG_STRING = '-9223372036854775808';

    private const int SIGNED_LONG_LONG_LENGTH = 19;

    private const string UNSIGNED_LONG_LONG_STRING = '18446744073709551615';

    private const int UNSIGNED_LONG_LONG_LENGTH = 20;

    public int $serverVersion = 80200;

    /**
     * @var list<SqlMode>
     */
    public array $sqlModes = [];

    public bool $supportMle = true;

    /**
     * Character sets recognized by {@see self::checkCharset()}.
     *
     * @var list<string>
     */
    public array $charSets = [];

    protected bool $inVersionComment = false;

    /**
     * @var list<Token>
     */
    private array $pendingTokens = [];

    private bool $justEmittedDot = false;

    public function __construct(?CharStream $input = null)
    {
        parent::__construct($input);

        $this->sqlModes = [];
    }

    public function isSqlModeActive(SqlMode $mode): bool
    {
        return in_array($mode, $this->sqlModes, true);
    }

    #[Override]
    public function reset(): void
    {
        $this->inVersionComment = false;

        parent::reset();
    }

    #[Override]
    public function nextToken(): ?Token
    {
        $pending = array_shift($this->pendingTokens);

        if ($pending !== null) {
            return $pending;
        }

        $next = parent::nextToken();

        $pending = array_shift($this->pendingTokens);

        if ($pending !== null) {
            if ($next !== null) {
                $this->pendingTokens[] = $next;
            }

            return $pending;
        }

        return $next;
    }

    #[Override]
    public function emit(): Token
    {
        $token = parent::emit();

        if ($this->justEmittedDot && $token instanceof CommonToken) {
            $text = $token->getText();

            if ($text !== null) {
                $token->setText(substr($text, 1));
            }

            $token->setStartIndex($token->getStartIndex() + 1);

            $this->justEmittedDot = false;
        }

        return $token;
    }

    protected function checkMySQLVersion(string $text): bool
    {
        if (strlen($text) < 8) {
            return false;
        }

        $version = (int) substr($text, 3);

        if ($version <= $this->serverVersion) {
            $this->inVersionComment = true;

            return true;
        }

        return false;
    }

    protected function determineFunction(int $proposed): int
    {
        $input = $this->input?->LA(1) ?? IntStream::EOF;

        if ($this->isSqlModeActive(SqlMode::IgnoreSpace)) {
            while ($input === ord(' ') || $input === ord("\t")
                || $input === ord("\r") || $input === ord("\n")
            ) {
                $this->input?->consume();

                $this->channel = self::HIDDEN;
                $this->type = MySQLLexer::WHITESPACE;

                $input = $this->input?->LA(1) ?? IntStream::EOF;
            }
        }

        return $input === ord('(') ? $proposed : MySQLLexer::IDENTIFIER;
    }

    protected function determineNumericType(string $text): int
    {
        $length = strlen($text) - 1;

        if ($length < self::LONG_LENGTH) {
            return MySQLLexer::INT_NUMBER;
        }

        $negative = false;
        $index = 0;

        if ($text[$index] === '+') {
            ++$index;
            --$length;
        } elseif ($text[$index] === '-') {
            ++$index;
            --$length;
            $negative = true;
        }

        while ($text[$index] === '0' && $length > 0) {
            ++$index;
            --$length;
        }

        if ($length < self::LONG_LENGTH) {
            return MySQLLexer::INT_NUMBER;
        }

        $compare = '';
        $smaller = 0;
        $bigger = 0;

        if ($negative) {
            if ($length === self::LONG_LENGTH) {
                $compare = substr(self::SIGNED_LONG_STRING, 1);
                $smaller = MySQLLexer::INT_NUMBER;
                $bigger = MySQLLexer::LONG_NUMBER;
            } elseif ($length < self::SIGNED_LONG_LONG_LENGTH) {
                return MySQLLexer::LONG_NUMBER;
            } elseif ($length > self::SIGNED_LONG_LONG_LENGTH) {
                return MySQLLexer::DECIMAL_NUMBER;
            } else {
                $compare = substr(self::SIGNED_LONG_LONG_STRING, 1);
                $smaller = MySQLLexer::LONG_NUMBER;
                $bigger = MySQLLexer::DECIMAL_NUMBER;
            }
        } else {
            if ($length === self::LONG_LENGTH) {
                $compare = self::LONG_STRING;
                $smaller = MySQLLexer::INT_NUMBER;
                $bigger = MySQLLexer::LONG_NUMBER;
            } elseif ($length < self::LONG_LONG_LENGTH) {
                return MySQLLexer::LONG_NUMBER;
            } elseif ($length > self::LONG_LONG_LENGTH) {
                if ($length > self::UNSIGNED_LONG_LONG_LENGTH) {
                    return MySQLLexer::DECIMAL_NUMBER;
                }

                $compare = self::UNSIGNED_LONG_LONG_STRING;
                $smaller = MySQLLexer::ULONGLONG_NUMBER;
                $bigger = MySQLLexer::DECIMAL_NUMBER;
            } else {
                $compare = self::LONG_LONG_STRING;
                $smaller = MySQLLexer::LONG_NUMBER;
                $bigger = MySQLLexer::ULONGLONG_NUMBER;
            }
        }

        return substr($text, $index) <= $compare ? $smaller : $bigger;
    }

    protected function checkCharset(string $text): int
    {
        return in_array($text, $this->charSets, true)
            ? MySQLLexer::UNDERSCORE_CHARSET
            : MySQLLexer::IDENTIFIER;
    }

    public function emitDot(): void
    {
        $length = strlen($this->getText());

        $this->pendingTokens[] = $this->factory->createEx(
            $this->tokenFactorySourcePair,
            MySQLLexer::DOT_SYMBOL,
            '.',
            $this->channel,
            $this->tokenStartCharIndex,
            $this->tokenStartCharIndex,
            $this->getLine(),
            $this->getCharPositionInLine() - $length,
        );

        ++$this->tokenStartCharPositionInLine;

        $this->justEmittedDot = true;
    }

    public function isMasterCompressionAlgorithm(): bool
    {
        return $this->serverVersion >= 80018 && $this->isServerVersionLt80024();
    }

    public function isServerVersionGe80011(): bool
    {
        return $this->serverVersion >= 80011;
    }

    public function isServerVersionGe80013(): bool
    {
        return $this->serverVersion >= 80013;
    }

    public function isServerVersionLt80014(): bool
    {
        return $this->serverVersion < 80014;
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

    public function isServerVersionLt80021(): bool
    {
        return $this->serverVersion < 80021;
    }

    public function isServerVersionGe80021(): bool
    {
        return $this->serverVersion >= 80021;
    }

    public function isServerVersionLt80022(): bool
    {
        return $this->serverVersion < 80022;
    }

    public function isServerVersionGe80022(): bool
    {
        return $this->serverVersion >= 80022;
    }

    public function isServerVersionLt80023(): bool
    {
        return $this->serverVersion < 80023;
    }

    public function isServerVersionGe80023(): bool
    {
        return $this->serverVersion >= 80023;
    }

    public function isServerVersionLt80024(): bool
    {
        return $this->serverVersion < 80024;
    }

    public function isServerVersionGe80024(): bool
    {
        return $this->serverVersion >= 80024;
    }

    public function isServerVersionLt80031(): bool
    {
        return $this->serverVersion < 80031;
    }

    public function doLogicalOr(): void
    {
        $this->type = $this->isSqlModeActive(SqlMode::PipesAsConcat)
            ? MySQLLexer::CONCAT_PIPES_SYMBOL
            : MySQLLexer::LOGICAL_OR_OPERATOR;
    }

    public function doIntNumber(): void
    {
        $this->type = $this->determineNumericType($this->getText());
    }

    public function doAdddate(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::ADDDATE_SYMBOL);
    }

    public function doBitAnd(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::BIT_AND_SYMBOL);
    }

    public function doBitOr(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::BIT_OR_SYMBOL);
    }

    public function doBitXor(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::BIT_XOR_SYMBOL);
    }

    public function doCast(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::CAST_SYMBOL);
    }

    public function doCount(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::COUNT_SYMBOL);
    }

    public function doCurdate(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::CURDATE_SYMBOL);
    }

    public function doCurrentDate(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::CURDATE_SYMBOL);
    }

    public function doCurrentTime(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::CURTIME_SYMBOL);
    }

    public function doCurtime(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::CURTIME_SYMBOL);
    }

    public function doDateAdd(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::DATE_ADD_SYMBOL);
    }

    public function doDateSub(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::DATE_SUB_SYMBOL);
    }

    public function doExtract(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::EXTRACT_SYMBOL);
    }

    public function doGroupConcat(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::GROUP_CONCAT_SYMBOL);
    }

    public function doMax(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::MAX_SYMBOL);
    }

    public function doMid(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::SUBSTRING_SYMBOL);
    }

    public function doMin(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::MIN_SYMBOL);
    }

    public function doNot(): void
    {
        $this->type = $this->isSqlModeActive(SqlMode::HighNotPrecedence)
            ? MySQLLexer::NOT2_SYMBOL
            : MySQLLexer::NOT_SYMBOL;
    }

    public function doNow(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::NOW_SYMBOL);
    }

    public function doPosition(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::POSITION_SYMBOL);
    }

    public function doSessionUser(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::USER_SYMBOL);
    }

    public function doStddevSamp(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::STDDEV_SAMP_SYMBOL);
    }

    public function doStddev(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::STD_SYMBOL);
    }

    public function doStddevPop(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::STD_SYMBOL);
    }

    public function doStd(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::STD_SYMBOL);
    }

    public function doSubdate(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::SUBDATE_SYMBOL);
    }

    public function doSubstr(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::SUBSTRING_SYMBOL);
    }

    public function doSubstring(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::SUBSTRING_SYMBOL);
    }

    public function doSum(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::SUM_SYMBOL);
    }

    public function doSysdate(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::SYSDATE_SYMBOL);
    }

    public function doSystemUser(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::USER_SYMBOL);
    }

    public function doTrim(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::TRIM_SYMBOL);
    }

    public function doVariance(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::VARIANCE_SYMBOL);
    }

    public function doVarPop(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::VARIANCE_SYMBOL);
    }

    public function doVarSamp(): void
    {
        $this->type = $this->determineFunction(MySQLLexer::VAR_SAMP_SYMBOL);
    }

    public function doUnderscoreCharset(): void
    {
        $this->type = $this->checkCharset($this->getText());
    }

    public function doDollarQuotedStringText(): bool
    {
        return $this->serverVersion >= 80034 && $this->supportMle;
    }

    public function isVersionComment(): bool
    {
        return $this->checkMySQLVersion($this->getText());
    }

    public function isBackTickQuotedId(): bool
    {
        return !$this->isSqlModeActive(SqlMode::NoBackslashEscapes);
    }

    public function isDoubleQuotedText(): bool
    {
        return !$this->isSqlModeActive(SqlMode::NoBackslashEscapes);
    }

    public function isSingleQuotedText(): bool
    {
        return !$this->isSqlModeActive(SqlMode::NoBackslashEscapes);
    }

    public function startInVersionComment(): void
    {
        $this->inVersionComment = true;
    }

    public function endInVersionComment(): void
    {
        $this->inVersionComment = false;
    }

    public function isInVersionComment(): bool
    {
        return $this->inVersionComment;
    }
}
