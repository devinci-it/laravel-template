#!/bin/bash

# Check file permissions, especially for storage directories
if [ ! -w storage/logs/laravel.log ]; then
    echo "Permission denied for storage/logs/laravel.log."
    exit 1
fi

echo "Permissions checks passed."

# If this script is sourced, don't exit
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    exit 0
fi
