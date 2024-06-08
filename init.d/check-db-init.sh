#!/bin/bash

# Check if init.sql exists
if [ ! -f scripts/init.sql ]; then
    echo "init.sql not found."
    exit 1
fi

echo "Database initialization checks passed."

# If this script is sourced, don't exit
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    exit 0
fi
