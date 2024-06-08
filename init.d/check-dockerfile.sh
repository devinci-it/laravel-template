#!/bin/bash

set -e

# Check Dockerfile
if [ ! -f Dockerfile ]; then
    echo "Dockerfile not found."
    exit 1
fi

echo "Dockerfile checks passed."

# If this script is sourced, don't exit
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    exit 0
fi


# check-dockerfile.sh
