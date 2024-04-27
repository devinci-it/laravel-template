#!/bin/bash

# Unset npm_config_prefix to avoid conflicts with nvm
#unset npm_config_prefix

# Source the nvm initialization script to make nvm commands available
. $HOME/.nvm/nvm.sh

# Use the default Node.js version specified by nvm
nvm use default

# Install any missing dependencies
npm install

# Update dependencies to their latest versions
npm update

# Add any additional commands to start your application
# For example, you can start your application with node:
#node your_app.js
