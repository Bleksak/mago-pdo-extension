# Implementing SQLite query analysis in PHP

Goal: given an arbitrary SQLite `SELECT`, report the type and **nullability** of
every result column — including aliased columns, which PDO cannot resolve (see
`DATA.md` for why: `getColumnMeta()` returns the alias in `name` and exposes no
origin-column key, so the `PRAGMA table_info` lookup has no key to match on).

Approach: parse the SQL with an ANTLR-generated parser, resolve result columns
back to their source tables, then combine schema facts from `PRAGMA table_info`
with nullability inference over the parse tree.

Every command and number below was executed and verified.

## Libraries

| Component | What it is | Needed by |
|---|---|---|
| [antlr/grammars-v4 `sql/sqlite`](https://github.com/antlr/grammars-v4/tree/master/sql/sqlite) | `SQLiteLexer.g4` (245 lines) + `SQLiteParser.g4` (945 lines), MIT (Bart Kiers) | you, at build time |
| ANTLR tool `antlr4-4.13.2-complete.jar` | Java code generator, 2.1 MB | you, at build time |
| [antlr/antlr4-php-runtime](https://github.com/antlr/antlr-php-runtime) | PHP 8+ runtime, v0.10.0, BSD-style | **end users, at runtime** |

**End users do not need Java or ANTLR.** Verified: with `antlr.jar`, both `.g4`
files and all `.interp`/`.tokens` artifacts deleted, the generated parser runs
identically. The generated code and the runtime contain no `exec`/`shell_exec`/
`proc_open`. Commit the generated PHP to the repo and declare the runtime as an
ordinary Composer dependency.

## Step 1 — generate the parser

```bash
VER=4.13.2
curl -sSLo antlr.jar https://repo1.maven.org/maven2/org/antlr/antlr4/$VER/antlr4-$VER-complete.jar
curl -sSLO https://raw.githubusercontent.com/antlr/grammars-v4/master/sql/sqlite/SQLiteLexer.g4
curl -sSLO https://raw.githubusercontent.com/antlr/grammars-v4/master/sql/sqlite/SQLiteParser.g4

java -jar antlr.jar -Dlanguage=PHP -package YourNs\\Sqlite -o gen SQLiteLexer.g4 SQLiteParser.g4
```

Produces four PHP files to commit (~19.8k lines total):

```
gen/SQLiteLexer.php              1,089 lines
gen/SQLiteParser.php            18,715 lines
gen/SQLiteParserListener.php
gen/SQLiteParserBaseListener.php
```

The `.interp` and `.tokens` files are for ANTLR tooling only (`grun`) — not
needed at runtime.

Keep this as a `composer` script or Makefile target, not a manual step, so
regenerating after a grammar update is one command.

## Step 2 — wire up the runtime

```json
{
  "require": { "antlr/antlr4-php-runtime": "^0.10" },
  "autoload": { "psr-4": { "YourNs\\Sqlite\\": "gen/" } }
}
```

Parsing entry point:

```php
use Antlr\Antlr4\Runtime\{CommonTokenStream, InputStream};

$lexer  = new SQLiteLexer(InputStream::fromString($sql));
$parser = new SQLiteParser(new CommonTokenStream($lexer));
$parser->removeErrorListeners();
$parser->addErrorListener($yourCollectingListener);   // report, don't print
$tree = $parser->parse();                             // entry rule is `parse`
```

Placeholders (`?`, `:name`) parse fine — no substitution needed. This is the
advantage over the `CREATE VIEW` / `CTAS` trick, which DDL rejects with params.

## Step 3 — collect sources and result columns

Walk the tree with a listener over three rules:

- `table_or_subquery` → build `alias => real table` (`FROM u AS x` ⇒ `x => u`)
- `join_operator` → detect `LEFT`/`LEFT OUTER`, marking the right-hand source
  as outer-join nullable
- `result_column` → `column_alias()` gives the label; classify the `expr` as a
  bare column reference or an expression

Verified reference implementation (from the working spike):

```php
/** find all descendant nodes of a given context class */
function descend(ParserRuleContext $n, string $cls): array {
    $out = [];
    for ($i = 0; $i < $n->getChildCount(); $i++) {
        $ch = $n->getChild($i);
        if ($ch instanceof $cls) $out[] = $ch;
        if ($ch instanceof ParserRuleContext) $out = [...$out, ...descend($ch, $cls)];
    }
    return $out;
}

public function enterResult_column(Result_columnContext $ctx): void {
    $alias = $ctx->column_alias()?->getText();
    $expr  = $ctx->expr();
    if ($expr === null) { $this->columns[] = ['kind' => 'star', 'label' => $ctx->getText()]; return; }

    $cols = descend($expr, Column_nameContext::class);
    $tbls = descend($expr, Table_nameContext::class);
    // bare column reference: exactly one column, and expr text is just [tbl.]col
    $bare = count($cols) === 1 && $expr->getText() ===
        (($tbls ? $tbls[0]->getText() . '.' : '') . $cols[0]->getText());

    $this->columns[] = $bare
        ? ['kind' => 'column', 'label' => $alias ?? $cols[0]->getText(),
           'qualifier' => $tbls ? $tbls[0]->getText() : null, 'column' => $cols[0]->getText()]
        : ['kind' => 'expression', 'label' => $alias ?? $expr->getText(), 'expr' => $expr->getText()];
}

public function enterTable_or_subquery(Table_or_subqueryContext $ctx): void {
    if (($t = $ctx->table_name()?->getText()) !== null)
        $this->sources[$ctx->table_alias()?->getText() ?? $t] = $t;
}
```

Verified output for
`SELECT t.req AS a, t.opt AS b, x.label AS c, t.num*2 AS d, COUNT(*) AS e, x.* FROM t LEFT JOIN u AS x ON x.uid = t.id WHERE t.id > ? GROUP BY t.req`:

```
syntax errors: 0
FROM sources (alias => real table):  t => t,  x => u
LEFT JOINs: LEFTJOIN
result columns:
  #0 a   <- t.req    [real table: t]
  #1 b   <- t.opt    [real table: t]
  #2 c   <- x.label  [real table: u]
  #3 d   <- expression t.num*2   refs: num
  #4 e   <- expression COUNT(*)  refs: none
  #5 x.* (star expansion)
```

**Gotcha — `expr` is a precedence cascade.** The grammars-v4 grammar models
expressions as `expr` → `expr_or` → `expr_and` → … → `expr_base`, not as
SQLite's own left-recursive rule. So `ExprContext` has **no** `column_name()`
accessor and you must descend the subtree (the code above). Java/Python examples
found online assume the flat shape and will not transfer.

**Gotcha — the PHP runtime API differs.** There is no `getChildren()`; use
`getChildCount()` / `getChild($i)`, or `getTypedRuleContexts()`.

## Step 4 — load schema facts

Per table named in the source map:

```php
$pdo->query("PRAGMA table_info({$table})");   // cid, name, type, notnull, dflt_value, pk
```

- `notnull = 1` ⇒ column cannot be NULL
- `PRAGMA table_xinfo` if you need generated/hidden columns
- **`INTEGER PRIMARY KEY` reports `notnull = 0`** despite being the rowid alias
  and unable to hold NULL. Special-case `pk = 1` with `type = INTEGER` on a
  rowid table; `WITHOUT ROWID` tables behave differently, so check
  `sqlite_master.sql` or `PRAGMA index_list` when it matters.
- Cache per (database file, schema version) — read `PRAGMA schema_version` to
  invalidate cheaply.

## Step 5 — infer nullability

SQLite performs **no** nullability analysis (unlike MySQL, which hands you a
computed `not_null` flag per result column — see `DATA.md`). This step is the
actual work, and it is why a parser is unavoidable here.

Bottom-up over the expression tree:

| Node | Result |
|---|---|
| bare column ref | `notnull` from `PRAGMA table_info` |
| column from the nullable side of a `LEFT JOIN` | nullable, **overriding** a `NOT NULL` declaration |
| literal | not null, except the `NULL` literal |
| arithmetic / concatenation / comparison | nullable if **any** operand is nullable |
| `COALESCE(a, …, z)` / `IFNULL(a, b)` | not null iff the **last** argument is not null |
| `CASE` | not null iff every branch is not null **and** an `ELSE` exists |
| `COUNT(...)` | never null |
| `SUM`/`AVG`/`MIN`/`MAX`/`GROUP_CONCAT` | nullable (empty group yields NULL) |
| scalar subquery in the select list | always nullable (no rows ⇒ NULL) |
| `IIF`/`NULLIF` | `NULLIF` always nullable; `IIF` per-branch like `CASE` |
| compound select (`UNION`, `UNION ALL`, …) | per position: nullable if **any** arm is nullable |
| subquery / CTE in `FROM` | recurse, treat the result as a derived table of already-computed nullability |
| window functions | follow the underlying aggregate's rule |

Order matters: resolve the source column's declared nullability first, then
apply outer-join weakening, then propagate through the expression.

Track outer-join nullability **per source**, not per query: in
`a LEFT JOIN b LEFT JOIN c`, only `b` and `c` are weakened. A `RIGHT`/`FULL`
join (SQLite 3.39+) weakens the other side / both.

## Step 6 — star expansion

`*` and `tbl.*` need the schema, not the parser: expand in `FROM`-clause order
using `PRAGMA table_info` per source, applying the same outer-join weakening.
The parser tells you a star is present and which qualifier it carries.

## Performance

Measured on the generated parser, 500 iterations of a join + group + order query:

```
6.06 ms/query   165 queries/sec   16 MB peak RSS
```

Acceptable for static analysis if results are cached per file; not suitable for
a hot path. Reuse one lexer/parser instance where possible and cache parse
results keyed by a hash of the SQL text.

### Warm cache (cold-start elimination)

The ANTLR runtime keeps its DFA and prediction-context caches as statics on
`MySQLParser`: shared process-wide, but empty in a fresh process, where the
first parse of each query *shape* costs ~1 s of full ATN simulation. A fresh
process therefore pays ~8–12 s for a typical 27-query corpus pass.

`gen/mysql-warm-cache.bin` (committed) serializes those statics after
warming them with the curated shape set in
`tools/warmup/warm-queries.php`. `MySqlSelectParser::parse()` hydrates the
statics from it once per process before the first parse (mysql driver only —
SQLite projects pay nothing). Measured cold pass: **~12 s → ~2.3 s**.

- Rebuild after a grammar regeneration: `just warm-cache` (needs Java, ~10 s).
- The blob is stamped with a sha256 of the grammar's serialized ATN
  (`SERIALIZED_ATN`); a grammar change makes the hash mismatch, and
  hydration silently falls back to the cold path.
- Hydration needs PHP 8.1+ (`unserialize()` `max_depth` for the ~9k-state
  ATN graph) and must happen before the first `MySQLParser` is constructed —
  which `parse()` guarantees as the only construction site in this package.
- Coverage is by decision path, not text: one warm-up entry covers every
  query with the same structure. Uncovered shapes (e.g. 20-branch CASE,
  36-column query-builder output) still cost ~0.6 s once per process;
  add them to `tools/warmup/warm-queries.php` and rebuild when they show up.
- Benchmark both regimes: `just bench` (hydrated) vs
  `just bench --no-warm-cache` (cold baseline).

## Validation strategy

The grammars-v4 grammar is community-maintained and **not** derived from
SQLite's own `parse.y`, so it can diverge. Guard against that:

1. Collect a corpus of the real queries your analyzer will see.
2. Assert the parser reports 0 syntax errors across the corpus — a parse failure
   on valid SQL is a grammar gap, not a user error.
3. Cross-check inference against runtime truth where possible: execute the query
   and compare your verdict with observed NULLs, or compare against MySQL's
   `flags` for the equivalent schema (MySQL's answers were verified correct for
   `LEFT JOIN`, `SUM`, `COALESCE` and literals).
4. Treat `parse.y` as the tiebreaker on grammar disputes:
   `https://raw.githubusercontent.com/sqlite/sqlite/master/src/parse.y`
   (the Fossil repo at `sqlite.org/src/...` blocks automated fetches). Copy the
   `%left`/`%right`/`%nonassoc` precedence declarations verbatim if you ever
   hand-write expression parsing.

Reference docs: [syntax diagrams](https://sqlite.org/syntaxdiagrams.html) (~80
hyperlinked rules with "used by" back-references), [SQL as understood by
SQLite](https://sqlite.org/lang.html), plus `datatype3.html` (type affinity),
`nulls.html`, `lang_select.html` and `quirks.html` for semantics.

## Alternative considered and rejected

Wrapping the query in a `TEMP VIEW` or `CREATE TABLE … AS SELECT` and reading
`PRAGMA table_info` of the result — verified to **fail**: SQLite drops
`NOT NULL` entirely, reporting `notnull = 0` for every column, including ones
whose source is `NOT NULL`. The generated DDL was
`CREATE TABLE ct(a TEXT,b TEXT,c TEXT,d)`. This is why parsing is required.

FFI into `libsqlite3` (`sqlite3_column_origin_name`, exported by the system
library, requires `SQLITE_ENABLE_COLUMN_METADATA`) would resolve alias → source
column without a parser, but gives only *declared* nullability — no outer-join
or expression awareness — and needs FFI enabled on every user's PHP build.

## Milestones

1. Generation pipeline + committed generated parser; parse corpus with 0 errors.
2. Source map + result-column extraction (Step 3) — the alias problem is solved
   at this point.
3. `PRAGMA table_info` schema cache with the `INTEGER PRIMARY KEY` special case.
4. Nullability for bare columns + outer-join weakening — covers most real queries.
5. Expression rules (Step 5 table), aggregates and `COALESCE`/`CASE` first.
6. Compound selects, subqueries in `FROM`, CTEs.
7. Star expansion.
