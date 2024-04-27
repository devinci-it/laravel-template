#!/bin/bash

# Get the directory of the script
BASE_DIR="$(dirname "$0")"

while true; do
    clear
    # Display banner
    echo "============================================================="
    echo "        Welcome to Your Menu Script                          "
    echo "============================================================="

    # Interactive menu script:
    # This script presents an interactive menu to the user
    # and runs the appropriate script based on their choice.
    # Options include updating npm packages, updating Composer packages,
    # clearing cache, building assets, running servers, and quitting.

    echo "Please select an option:"
    echo "1. Update npm packages"
    echo "2. Update Composer packages"
    echo "3. Clear cache"
    echo "4. Build assets"
    echo "5. Run servers"
    echo "6. Quit"
    read -p "Enter your choice: " choice

    case $choice in
        1) "$BASE_DIR/update_npm.sh" ;;
        2) "$BASE_DIR/update_composer.sh" ;;
        3) "$BASE_DIR/clear_cache.sh" ;;
        4) "$BASE_DIR/build_assets.sh" ;;
        5) "$BASE_DIR/run_servers.sh" ;;
        6) echo "Exiting script. Goodbye!"; exit ;;
        *) echo "Invalid option" ;;
    esac
done
