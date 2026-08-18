set dotenv-load := false

# The mago binary from the local dev checkout. Override with MAGO_BIN.
mago := "mago"

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

# Starts the local MySQL container (reusing it when already running).
mysql:
	@podman start mago-pdo-mysql 2>/dev/null || podman run -d --name mago-pdo-mysql -p 127.0.0.1:3306:3306 -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=corpus -e MYSQL_USER=corpus -e MYSQL_PASSWORD=corpus docker.io/library/mysql:8.0
	@for i in $(seq 1 30); do mysql -h 127.0.0.1 -P 3306 -ucorpus -pcorpus -e 'SELECT 1' corpus >/dev/null 2>&1 && break; sleep 2; done

# Removes the local MySQL container.
mysql-down:
	podman rm -f mago-pdo-mysql

# Seeds the MySQL corpus database.
mysql-db: mysql
	php tests/corpus/seed-mysql.php

# Runs the real mago binary against the corpus with the extension host
# verifying queries against MySQL instead of SQLite.
corpus-mysql: mysql-db
	MAGO_PDO_EXTENSION_MYSQL_HOST=127.0.0.1 MAGO_PDO_EXTENSION_MYSQL_PORT=3306 MAGO_PDO_EXTENSION_MYSQL_USER=corpus MAGO_PDO_EXTENSION_MYSQL_PASSWORD=corpus MAGO_PDO_EXTENSION_MYSQL_DATABASE=corpus {{mago}} --workspace tests/corpus analyze --minimum-fail-level warning --reporting-format count

check: validate format-check test lint analyze corpus

# Full check including the MySQL corpus run (requires the local container).
check-mysql: check corpus-mysql
