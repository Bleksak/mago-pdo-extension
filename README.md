# Mago PDO Extension

A Mago analyzer extension that verifies PDO queries are runnable in their current form by
executing `EXPLAIN` against a configured database.

## How it works

The `pdo/query-analyzer` plugin registers a method-call hook targeting
`PDO::query()`, `PDO::prepare()`, and `PDO::exec()`. For every call whose first argument is a
**literal** SQL string, the extension:

1. extracts the first top-level statement (only it executes anyway),
2. skips statements `EXPLAIN` cannot handle (DDL, `PRAGMA`, `SET`, …),
3. normalizes PDO placeholders (`?`, `:name`) when the driver needs it,
4. runs `EXPLAIN <statement>` against the configured database and reports
   `pdo/query-analyzer/unrunnable-query` when it fails.

Dynamically built queries and unexplainable statements are skipped silently.

Driver differences: SQLite accepts `EXPLAIN` for `SELECT` and DML, so all of them are checked.
MySQL only accepts `EXPLAIN` for `SELECT`, so DML is skipped there rather than reported.

## Configuration

The extension reads its verification connection from the **worker** environment (it never
touches the host environment):

| Variable | Description |
| --- | --- |
| `MAGO_PDO_EXTENSION_SQLITE_PATH` | Path to a SQLite database file. Takes priority. |
| `MAGO_PDO_EXTENSION_MYSQL_HOST` | MySQL host. Enables MySQL when set. |
| `MAGO_PDO_EXTENSION_MYSQL_PORT` | MySQL port. |
| `MAGO_PDO_EXTENSION_MYSQL_USER` | MySQL user. |
| `MAGO_PDO_EXTENSION_MYSQL_PASSWORD` | MySQL password. |
| `MAGO_PDO_EXTENSION_MYSQL_DATABASE` | MySQL database (schema). |

Without a valid configuration the plugin stays silent.

## Testing

Two layers, mirroring the [mago-extension-template](https://github.com/carthage-software/mago-extension-template):

1. **Unit tests** (`tests/Unit/`, PHPUnit) — cover the statement extraction/normalization
   logic, the connection provider, and plugin registration.

   ```sh
   just test
   ```

2. **Corpus** (`tests/corpus/`) — a small PHP project analyzed by the real `mago` binary with
   the extension host attached (`tests/corpus/worker.php`). Fixtures declare expected
   diagnostics with `@mago-expect analysis:pdo/query-analyzer/unrunnable-query`; runnable and
   skipped queries assert silence. The corpus database is seeded by `tests/corpus/seed.php`.

   ```sh
   just corpus
   ```

Everything in one command (composer validate, unit tests, lint, analyze, corpus):

```sh
just check
```

The `mago` binary is taken from the local dev checkout
(`../mago/target/release/mago`); override with `MAGO_BIN`.
