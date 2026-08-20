<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Linter\Rules;

use Bleksak\MagoPdoExtension\Mago\Analyzer\ExplainableQuery;
use Bleksak\MagoPdoExtension\Services\ConnectionProvider;
use Mago\Sdk\Linter\LintContext;
use Mago\Sdk\Linter\Rule;
use Mago\Sdk\Linter\RuleDefinition;
use Mago\Sdk\Reporting\Issue;
use Mago\Sdk\Reporting\Level;
use Mago\Sdk\Syntax\CallExpression;
use Mago\Sdk\Syntax\NodeKind;
use Override;
use PDO;
use PDOException;

use function in_array;
use function strlen;
use function strtolower;
use function substr;

/**
 * Flags PDO query(), prepare(), and exec() calls whose literal SQL fails
 * EXPLAIN against the configured database.
 *
 * Linter rules only see syntax, so instance calls are matched by method
 * name on any receiver. Queries built dynamically (variables, string
 * interpolation, ...) cannot be checked and are skipped, as are statements
 * EXPLAIN does not support (DDL, PRAGMA, SET, ...).
 *
 * @internal
 */
final class PdoUnrunnableQueryRule implements Rule
{
    private const array PDO_METHODS = ['query', 'prepare', 'exec'];

    public function __construct(
        private readonly ConnectionProvider $connections = new ConnectionProvider(),
    ) {}

    #[Override]
    public function getDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            code: 'pdo/unrunnable-query',
            name: 'Unrunnable PDO query',
            description: 'Flags PDO query, prepare, and exec calls whose literal SQL fails EXPLAIN against the configured database',
            defaultLevel: Level::Error,
            defaultEnabled: true,
            targets: [
                NodeKind::MethodCall,
                NodeKind::NullSafeMethodCall,
            ],
        );
    }

    #[Override]
    public function lint(LintContext $context): void
    {
        $file = $context->file;
        $call = CallExpression::fromNode($file, $context->node);
        $method = $call->getName($file);

        if (
            $method === null
            || !in_array(strtolower($method), self::PDO_METHODS, true)
        ) {
            return;
        }

        $argument = $call->arguments[0] ?? null;

        // Concatenated and interpolated strings are CompositeString nodes;
        // only a plain Literal can be resolved to a definite statement.
        if (
            $argument === null
            || $argument->value->kind !== NodeKind::Literal
        ) {
            return;
        }

        $raw = $file->getText($argument->value);
        $query = self::decodeLiteral($raw);

        if ($query === null) {
            return;
        }

        $connection = $this->connections->get();

        if ($connection === null) {
            return;
        }

        $driver = (string) $connection->getAttribute(PDO::ATTR_DRIVER_NAME);
        $statement = ExplainableQuery::fromQuery($query, $driver);

        if ($statement === null) {
            return;
        }

        $context->cancellation->throwIfCancelled();

        try {
            $explain = $connection->query("EXPLAIN {$statement}");

            if ($explain !== false) {
                $explain->closeCursor();
            }
        } catch (PDOException $exception) {
            $context->report(Issue::new(
                "This query is not runnable: {$exception->getMessage()}",
                $context->node->span,
            )->withHelp(
                'The statement was checked with EXPLAIN against the configured database.',
            ));
        }
    }

    /**
     * Decodes the value of a raw PHP string literal, quotes included.
     *
     * Returns null when the literal cannot be decoded to a definite value
     * (unknown escape sequence or malformed quoting), so the caller skips
     * the check instead of explaining a wrong statement.
     */
    public static function decodeLiteral(string $raw): ?string
    {
        $bodyStart = 0;
        $verbatim = false;

        if ($raw !== '') {
            $prefix = $raw[0];

            if ($prefix === 'b' || $prefix === 'B') {
                $verbatim = true;
                $bodyStart = 1;
            } elseif ($prefix === 'u' || $prefix === 'U') {
                // Unicode escapes change the decoding, so bail.
                return null;
            }
        }

        $quote = $raw[$bodyStart] ?? '';

        if ($quote !== "'" && $quote !== '"' || substr($raw, -1) !== $quote) {
            return null;
        }

        $body = substr($raw, $bodyStart + 1, -1);
        $decoded = '';
        $length = strlen($body);

        for ($offset = 0; $offset < $length; $offset++) {
            $char = $body[$offset];

            if ($char !== '\\') {
                $decoded .= $char;

                continue;
            }

            $next = $body[$offset + 1] ?? '';
            $offset++;

            if ($next === $quote || $next === '\\') {
                $decoded .= $next;

                continue;
            }

            if ($verbatim || $quote === "'") {
                // Single-quoted and byte strings keep other backslash
                // sequences as-is.
                $decoded .= '\\' . $next;

                continue;
            }

            $escape = match ($next) {
                'n' => "\n",
                'r' => "\r",
                't' => "\t",
                'v' => "\v",
                'e' => "\x1B",
                'f' => "\f",
                '0' => "\0",
                '$' => '$',
                default => null,
            };

            if ($escape === null) {
                // \xHH, \u{...}, or a literal backslash sequence: bail
                // instead of guessing.
                return null;
            }

            $decoded .= $escape;
        }

        return $decoded;
    }
}
