#!/bin/bash

# Check volume definitions in docker-compose.yml
if grep -q -E '^\s*volumes:' docker-compose.yml; then
    echo "Volume definitions found in docker-compose.yml."
else
    echo "No volume definitions found in docker-compose.yml."
    exit 1
fi

# Additional checks as needed
echo "Volume checks passed."

# If this script is sourced, don't exit
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    exit 0
fi
