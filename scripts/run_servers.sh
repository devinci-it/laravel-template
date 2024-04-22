#!/bin/bash
echo "Starting servers..."
php artisan serve &
npm run watch
