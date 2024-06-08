#! /bin/bash

banner() {
  local message="$1"
  local width=${2:-40}  # Default width is 40 characters

  local border_length=$(( width + 4 ))
  local border=$(printf "%-${border_length}s" "-")

  echo "+${border// /-}+"
  printf "| $(tput bold)%-8s$(tput sgr0) %-$(($width - 7))s |\n" "INFO |" "$message"
  echo "+${border// /-}+"
}
