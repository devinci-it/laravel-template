#!/bin/bash

# Define colors
COLOR_DEFAULT='\033[0m'         # No Color
BOLD='\033[1m'                  # Bold

# Define Nord color palette for bold text
COLOR_INFO_BOLD='\033[1;94m'         # rgb(94, 129, 172) - Informational messages
COLOR_MUTE_BOLD='\033[1;32m'         # rgb(143, 188, 187) - Muted messages
COLOR_ERROR_BOLD='\033[1;31m'        # rgb(191, 97, 106) - Error messages
COLOR_WARNING_BOLD='\033[1;33m'      # rgb(235, 203, 139) - Warning messages
COLOR_ACCENT_BOLD='\033[1;38;5;67m'  # rgb(94, 129, 172) - Accent color

# Define Nord color palette for non-bold text
COLOR_INFO='\033[0;94m'         # rgb(94, 129, 172) - Informational messages
COLOR_MUTE='\033[0;32m'         # rgb(143, 188, 187) - Muted messages
COLOR_ERROR='\033[0;31m'        # rgb(191, 97, 106) - Error messages
COLOR_WARNING='\033[0;33m'      # rgb(235, 203, 139) - Warning messages
COLOR_ACCENT='\033[0;38;5;67m'  # rgb(94, 129, 172) - Accent color

# Function to echo colored message based on type and boldness
print_color_message() {
    local message="$1"
    local type="$2"
    local bold="$3"
    
    local color_code=""
    if [[ "$bold" == true ]]; then
        case "$type" in
            "info")
                color_code=$COLOR_INFO_BOLD
                ;;
            "mute")
                color_code=$COLOR_MUTE_BOLD
                ;;
            "error")
                color_code=$COLOR_ERROR_BOLD
                ;;
            "warning")
                color_code=$COLOR_WARNING_BOLD
                ;;
            "accent")
                color_code=$COLOR_ACCENT_BOLD
                ;;
            *)
                color_code=$COLOR_DEFAULT
                ;;
        esac
    else
        case "$type" in
            "info")
                color_code=$COLOR_INFO
                ;;
            "mute")
                color_code=$COLOR_MUTE
                ;;
            "error")
                color_code=$COLOR_ERROR
                ;;
            "warning")
                color_code=$COLOR_WARNING
                ;;
            "accent")
                color_code=$COLOR_ACCENT
                ;;
            *)
                color_code=$COLOR_DEFAULT
                ;;
        esac
    fi

    echo -e "${color_code}${message}${COLOR_DEFAULT}"
}
