#!/bin/bash

# Install the latest version of Node.js using NVM
nvm install node

# Update NPM to the latest version
npm install -g npm@latest
echo "Updating npm packages..."
npm install
npm update
