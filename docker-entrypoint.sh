#!/bin/sh
set -e

php artisan package:discover --ansi
php artisan storage:link || true
php artisan migrate --force --seed

exec php -S 0.0.0.0:${PORT:-8000} -t public
