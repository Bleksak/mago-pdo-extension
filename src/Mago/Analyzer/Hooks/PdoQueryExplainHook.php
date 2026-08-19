<?php

declare(strict_types=1);

namespace Bleksak\MagoPdoExtension\Mago\Analyzer\Hooks;

use Bleksak\MagoPdoExtension\Mago\Analyzer\ExplainableQuery;
use Bleksak\MagoPdoExtension\Services\ConnectionProvider;
use Mago\Sdk\Analyzer\FileAnalysisRequirement;
use Mago\Sdk\Analyzer\MethodCallAnalysisHook;
use Mago\Sdk\Analyzer\MethodTarget;
use Mago\Sdk\Analyzer\NodeAnalysisContext;
use Mago\Sdk\Reporting\Issue;
use Mago\Sdk\Reporting\Level;
use Override;
use PDO;
use PDOException;

/**
 * Verifies that literal PDO queries are runnable against the configured database.
 *
 * SQLite statements are checked with EXPLAIN; MySQL statements with a
 * server-side prepare, which compiles them without executing them.
 *
 * Queries built dynamically cannot be checked and are skipped. Statements the check
 * does not support (DDL, PRAGMA, SET, ...) are skipped as well.
 *
 * @internal
 */
final class PdoQueryExplainHook implements MethodCallAnalysisHook
{
    public function __construct(
        private readonly ConnectionProvider $connections,
    ) {}

    /**
     * @return non-empty-list<MethodTarget>
     */
    #[Override]
    public function getTargets(): array
    {
        return [
            MethodTarget::exact('PDO', 'query'),
            MethodTarget::exact('PDO', 'prepare'),
            MethodTarget::exact('PDO', 'exec'),
        ];
    }

    /**
     * @return list<FileAnalysisRequirement>
     */
    #[Override]
    public function getRequirements(): array
    {
        return [FileAnalysisRequirement::ArgumentTypes];
    }

    #[Override]
    public function analyze(NodeAnalysisContext $context): void
    {
        $connection = $this->connections->get();
        $query = ($context->argumentTypes[0] ?? null)?->getLiteralString();

        if ($connection === null || $query === null) {
            return;
        }

        $driver = (string) $connection->getAttribute(PDO::ATTR_DRIVER_NAME);
        $statement = ExplainableQuery::fromQuery($query);

        if ($statement === null) {
            return;
        }

        $context->cancellation->throwIfCancelled();

        try {
            if ($driver === 'mysql') {
                // A server-side prepare compiles the statement without
                // executing it, and accepts native placeholders as-is.
                $connection->prepare($statement);
            } else {
                $explain = $connection->query("EXPLAIN {$statement}");

                if ($explain !== false) {
                    $explain->closeCursor();
                }
            }
        } catch (PDOException $exception) {
            $context->report(
                Level::Error,
                'unrunnable-query',
                Issue::new(
                    "This query is not runnable: {$exception->getMessage()}",
                    $context->node->span,
                )->withHelp(
                    'The statement was checked against the configured database.',
                ),
            );
        }
    }
}
