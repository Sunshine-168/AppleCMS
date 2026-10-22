#!/bin/sh
set -e
cd /var/www/html

if [ ! -d vendor ]; then
    composer install --no-interaction --prefer-dist --no-ansi
fi
if [ ! -f .env ]; then
    cp .env.example .env
fi
mkdir -p storage/framework/views storage/framework/cache/data storage/framework/sessions storage/logs storage/app bootstrap/cache database
touch database/database.sqlite
php artisan key:generate --force --ansi >/dev/null 2>&1 || true

if [ "${AUTO_INSTALL:-0}" = "1" ] && [ ! -f storage/app/install.lock ]; then
    php artisan video:install --password="${INSTALL_PASSWORD:-admin123}" --demo --ansi
fi

# 容器里没有 crontab。后台每分钟跑一次，定时采集不用再配。
(while true; do php artisan schedule:run --no-ansi >/dev/null 2>&1 || true; sleep 60; done) &

exec php artisan serve --host=0.0.0.0 --port=8010
