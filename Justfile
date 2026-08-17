set dotenv-load := false

# The mago binary from the local dev checkout. Override with MAGO_BIN.
mago := shell('printenv MAGO_BIN || echo /home/bleksak/dev/mago/target/release/mago')

validate:
	composer validate --no-check-publish

test:
	vendor/bin/phpunit --configuration phpunit.xml

lint:
	{{mago}} --config mago.toml lint

analyze:
	{{mago}} --config mago.toml analyze

format:
	{{mago}} --config mago.toml format

format-check:
	{{mago}} --config mago.toml format --check

# Seeds the SQLite database the extension host verifies queries against.
corpus-db:
	php tests/corpus/seed.php

# Runs the real mago binary against the corpus with the extension host
# attached. Exits non-zero when an expected diagnostic is missing or a new
# one appears.
corpus: corpus-db
	MAGO_PDO_EXTENSION_SQLITE_PATH={{justfile_directory()}}/tests/corpus/.corpus.sqlite {{mago}} --workspace tests/corpus analyze --minimum-fail-level warning --reporting-format count

check: validate format-check test lint analyze corpus
