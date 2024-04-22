#!/bin/bash
echo "Updating Composer packages..."
composer update
composer dump-autoload
