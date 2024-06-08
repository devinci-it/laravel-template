#!/bin/bash

set -e
#!/bin/bash

set -e

source ./init.d/utils/hue.sh 

# Run environment checks
./init.d/check-env.sh || exit 1

# Run environment checks
./init.d/check-env.sh || exit 1

# Run Dockerfile checks
./init.d/check-dockerfile.sh || exit 1

# Run docker-compose.yml checks
./init.d/check-docker-compose.sh || exit 1

# Run database initialization checks
./init.d/check-db-init.sh || exit 1

# Run volume checks
./init.d/check-volumes.sh || exit 1

# Run permissions checks
./init.d/check-permissions.sh || exit 1

# If all checks pass, run docker-compose up --build
docker-compose up -d --build
