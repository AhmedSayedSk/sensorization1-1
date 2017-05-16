#!/bin/bash
set -e 

echo "Migrating database & seeding 'php artisan migrate:refresh --seed --force'..."
php artisan migrate:refresh --seed --force
