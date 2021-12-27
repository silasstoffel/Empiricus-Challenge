#!/bin/sh

cd /var/www

echo "[Start]: Run migrations"

php artisan migrate --seed

echo "[Finish] Finish migrations"
