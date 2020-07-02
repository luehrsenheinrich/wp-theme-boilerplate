#!/bin/bash
set -euo pipefail
set -m

. /mariadb-entrypoint.sh "mysqld" &

. /wp-entrypoint.sh "apache2-foreground" &

fg %1
