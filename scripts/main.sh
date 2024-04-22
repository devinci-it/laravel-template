#!/bin/bash

# Interactive menu script:
# This script presents an interactive menu to the user
# and runs the appropriate script based on their choice.
# Options include updating npm packages, updating Composer packages,
# clearing cache, building assets, and running servers.

echo "Please select an option:"
echo "1. Update npm packages"
echo "2. Update Composer packages"
echo "3. Clear cache"
echo "4. Build assets"
echo "5. Run servers"
read -p "Enter your choice: " choice

case $choice in
    1) ./update_npm.sh ;;
    2) ./update_composer.sh ;;
    3) ./clear_cache.sh ;;
    4) ./build_assets.sh ;;
    5) ./run_servers.sh ;;
    *) echo "Invalid option" ;;
esac
