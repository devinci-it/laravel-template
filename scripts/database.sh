#!/bin/bash

###########################################
# Script Name: setup_db.sh
# Description: This script automates the process of setting up a MySQL database
#              for a Laravel application. It prompts the user to enter the
#              database name, username, and password, then creates the database,
#              user, and grants privileges. It also tests the database connection
#              and provides feedback on the success or failure of the setup.
# Author: devinci-it
###########################################
TEST_MODE="true"

# Color codes
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
RESET='\033[0m'

# Function to display .env configuration
display_env_config() {
    echo "\n${YELLOW}# .env configuration:${RESET}"
    echo "DB_CONNECTION=${GREEN}mysql${RESET}"
    echo "DB_HOST=${GREEN}127.0.0.1${RESET}"
    echo "DB_PORT=${GREEN}3306${RESET}"
    echo "DB_DATABASE=${GREEN}$db_name${RESET}"
    echo "DB_USERNAME=${GREEN}$db_user${RESET}"
    echo "DB_PASSWORD=${GREEN}$db_password${RESET}\n"
}

# Function to clean up (delete) the user and database
cleanup() {
    sudo mysql -u root  -e "DROP DATABASE IF EXISTS $db_name;"
    sudo mysql -u root  -e "DROP USER IF EXISTS '$db_user'@'localhost';"
}

# Check for sudo privileges
if [ "$(id -u)" != "0" ]; then
    echo "${RED}This script must be run with sudo.${RESET}"
    exit 1
fi

# Prompt for sudo password if not already elevated
echo "${YELLOW}Please enter your sudo password if prompted.${RESET}"
sudo -v

# Prompt for database name
echo "\n${YELLOW}Enter the database name:${RESET}"
read -p "> " db_name

# Prompt for database username
echo  "\n${YELLOW}Enter the database username:${RESET}"
read -p "> " db_user



# Check if --force flag is provided
if [ "$1" = "--force" ]; then
    force_flag=true
    # Prompt for database password
    echo "\n${YELLOW}Enter the password for the MySQL user '$db_user' (to be granted privileges for the '$db_name' database):${RESET}"
    stty -echo
    read db_password
    stty echo
    echo
else
    # Prompt for database password
    echo "\n${YELLOW}Enter the database password:${RESET}"
    stty -echo
    read db_password
    stty echo
    echo
fi

# Check if the user exists (only if --force flag is not provided)
if [ "$force_flag" != "true" ]; then
    if sudo mysql -u root -p -e "SELECT User FROM mysql.user WHERE User='$db_user';" | grep -q "$db_user"; then
        echo "${RED}User '$db_user' already exists.${RESET}"
        exit 1
    fi
fi

# Check if the database exists
if sudo mysql -u root -p -e "SHOW DATABASES LIKE '$db_name';" | grep -q "$db_name"; then
    echo "${RED}Database '$db_name' already exists.${RESET}"
    exit 1
fi

# MySQL commands to create database and user
sudo mysql -u root  -e "CREATE DATABASE IF NOT EXISTS $db_name;"
sudo mysql -u root  -e "CREATE USER '$db_user'@'localhost' IDENTIFIED BY '$db_password';"
sudo mysql -u root  -e "GRANT ALL PRIVILEGES ON $db_name.* TO '$db_user'@'localhost';"
sudo mysql -u root  -e "FLUSH PRIVILEGES;"

# Test database connection
echo "${YELLOW}\nTesting database connection...${RESET}"
mysql -u $db_user -p$db_password $db_name -e "SELECT 1;"

# Check if the test query was successful
if [ $? -eq 0 ]; then
    echo "${GREEN}Database setup successful.${RESET}"

    # Check if flag for displaying .env configuration is set
    if [ "$2" = "--env-config" ]; then
        display_env_config
    fi
else
    echo "${RED}Database setup failed.${RESET}"
fi

# Test/debug mode: If TEST_MODE variable is set to true, clean up (delete) the user and database
if [ "$TEST_MODE" = "true" ]; then
    echo "\n${YELLOW}Test/debug mode: Cleaning up...${RESET}"
    cleanup
fi
