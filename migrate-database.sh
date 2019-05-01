#!/usr/bin/env bash
set -e 

echo "Migrating database..."
php artisan migrate --force
