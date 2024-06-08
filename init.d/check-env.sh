#!/bin/bash

# Check if .env file exists
if [ ! -f .env ]; then
    echo ".env file not found. Please create a .env file."
    exit 1
fi

# Check if required variables are set
if grep -q -E '^\s*(DB_DATABASE|DB_USERNAME|DB_PASSWORD|MYSQL_ROOT_PASSWORD)=' .env; then
    echo "Required variables found in .env file."
else
    echo "Required variables (DB_DATABASE, DB_USERNAME, DB_PASSWORD, MYSQL_ROOT_PASSWORD) not found in .env file."
    exit 1
fi

echo "Environment checks passed."

# If this script is sourced, don't exit
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    exit 0
fi
