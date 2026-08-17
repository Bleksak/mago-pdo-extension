# Mago PDO Extension

A Mago analyzer extension that verifies PDO queries are runnable in their current form by
executing `EXPLAIN` against a configured database, and refines the return types of PDO query
and fetch calls with the exact row shapes of the configured schema.

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

Both SQLite and MySQL accept `EXPLAIN` for `SELECT`, `INSERT`, `UPDATE`, `DELETE`, `REPLACE`, and
CTEs, so all of them are checked on either driver. The only driver difference is placeholder
normalization: SQLite accepts `?` and `:name` inline, while other drivers (MySQL, …) need them
replaced with `NULL` because `EXPLAIN` runs through `PDO::query()`, not a prepared statement.

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

## Return type inference

When a database is configured, the plugin also registers return type providers for
`PDO::query()`, `PDO::prepare()`, `PDOStatement::fetch()`, `PDOStatement::fetchColumn()`, and
`PDOStatement::fetchAll()`. For single-table `SELECT` statements with a literal SQL argument, the
statement is typed as a parameterized `PDOStatement` carrying the exact row shape:

```php
$statement = $pdo->query('SELECT id, name, email FROM users');
// $statement: PDOStatement<array{id: int, name: string, email: string|null}>|false

$row = $statement->fetch(); // array{id: int, name: string, email: string|null}|false
```

How it works:

1. the `SELECT` is parsed into a table and column list (only single-table statements without
   joins, unions, or derived tables are refined),
2. the table schema is introspected from the configured database (`PRAGMA table_info` for
   SQLite, `information_schema.COLUMNS` for MySQL) and memoized,
3. column types are mapped to the PHP types PDO actually returns: MySQL follows the declared
   type, SQLite follows its column affinity rules,
4. the row shape is encoded into a named object parameter on the statement's return type, and
   decoded again when `fetch()`/`fetchColumn()`/`fetchAll()` is called on that statement.

`SELECT *` is expanded through the schema, `COUNT(*)` becomes `int`, `fetch(PDO::FETCH_OBJ)`
returns the object shape, and `fetchAll()` returns `list<row>`.

The inference is an over-approximation by design: `WHERE` clauses are not evaluated, so a row
always contains every column of the table, `null` only where the schema allows it, and
`false`/empty outcomes are included wherever PDO can return them. Anything unrecognized falls
back to the native (unrefined) types, so the extension never reports a wrong type.

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
   skipped queries assert silence. The corpus also exercises return type inference:
   `TypedQueries.php` asserts the inferred row shapes with typed expect helpers (plus one
   deliberate `@mago-expect analysis:invalid-argument` control), so an inference regression
   surfaces as a missing or wrong type. The corpus database is seeded by
   `tests/corpus/seed.php` (SQLite) and `tests/corpus/seed-mysql.php` (MySQL).

   ```sh
   just corpus        # against the local SQLite database
   just corpus-mysql  # against a local MySQL 8.0 podman container
   ```

   `just corpus-mysql` manages the container itself (`just mysql` starts/reuses it,
   `just mysql-down` removes it). Everything in one command:

   ```sh
   just check        # SQLite corpus
   just check-mysql  # also runs the MySQL corpus (requires the container)
   ```

The `mago` binary is taken from the local dev checkout
(`../mago/target/release/mago`); override with `MAGO_BIN`.
