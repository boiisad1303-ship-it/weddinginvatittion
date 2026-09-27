#!/bin/sh
set -eu

cd /var/www
PORT="${PORT:-80}"
export PORT

if [ ! -e public/storage ] && [ ! -L public/storage ]; then
    php artisan storage:link
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache

if [ "${RUN_DB_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force
fi

if [ "${RUN_DB_SEEDER:-false}" = "true" ]; then
    php artisan db:seed --force
fi

envsubst '${PORT}' < /etc/nginx/templates/default.conf.template > /etc/nginx/conf.d/default.conf
nginx -t

php-fpm -D
exec nginx -g 'daemon off;'