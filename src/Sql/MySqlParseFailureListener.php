<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Sql;

use Antlr\Antlr4\Runtime\Atn\ATNConfigSet;
use Antlr\Antlr4\Runtime\Dfa\DFA;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\Parser;
use Antlr\Antlr4\Runtime\Recognizer;
use Antlr\Antlr4\Runtime\Utils\BitSet;
use Override;
/**
 * Records that the parser recovered from at least one syntax error.
 *
 * @internal
 */
final class MySqlParseFailureListener extends BaseErrorListener
{
    public bool $failed = false;

    #[Override]
    public function syntaxError(
        Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?RecognitionException $exception,
    ): void {
        $this->failed = true;
    }

    #[Override]
    public function reportAmbiguity(
        Parser $recognizer,
        DFA $dfa,
        int $startIndex,
        int $stopIndex,
        bool $exact,
        ?BitSet $ambigAlts,
        ATNConfigSet $configs,
    ): void {
        // Ambiguity is reported, not fatal.
    }

    #[Override]
    public function reportAttemptingFullContext(
        Parser $recognizer,
        DFA $dfa,
        int $startIndex,
        int $stopIndex,
        ?BitSet $conflictingAlts,
        ATNConfigSet $configs,
    ): void {
        // Full-context attempts are reported, not fatal.
    }

    #[Override]
    public function reportContextSensitivity(
        Parser $recognizer,
        DFA $dfa,
        int $startIndex,
        int $stopIndex,
        int $prediction,
        ATNConfigSet $configs,
    ): void {
        // Context sensitivity is reported, not fatal.
    }
}
