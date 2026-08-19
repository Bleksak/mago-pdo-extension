# Vendored MySQL grammar

Oracle's ANTLR4 MySQL grammar, derived from the MySQL server's own Yacc
grammar (via the MySQL Shell for VS Code project). It covers MySQL 8.0+ and
is the only actively maintained MySQL grammar in `grammars-v4` (the
Positive Technologies grammar is deprecated).

| Item | Value |
|---|---|
| Upstream | `https://github.com/antlr/grammars-v4/tree/master/sql/mysql/Oracle` |
| Vendored at commit | `76c99cdd04e19b9bbe30877c6d391c92ea81b082` (2026-08-08) |
| Files | `MySQLLexer.g4`, `MySQLParser.g4` |
| License | BSD-3-Clause, Copyright (c) 2025, Oracle and/or its affiliates |
| ANTLR tool | `4.13.2` (`tools/antlr.jar`, downloaded on demand, not committed) |
| PHP runtime | `antlr/antlr4-php-runtime` `^0.10` |

The grammar is "target agnostic": the `.g4` files reference support classes
(`MySQLLexerBase`, `MySQLParserBase`, `SqlMode(s)`) that must be provided per
target. The PHP implementations live in `src/Sql/MySql/`, in the same
namespace as the generated code.

Regenerate the parser (one command, requires Java):

```sh
just gen-mysql-grammar
```

The generated output in `gen/` is committed. End users do not need Java or
ANTLR.
