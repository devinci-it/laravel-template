#!/bin/bash

# Function to print a formatted banner
banner() {
  local message="$1"
  local width=${2:-40}  # Default width is 40 characters
  
  local border_length=$(( width + 4 ))
  local border=$(printf "%-${border_length}s" "-")
  
  echo "+${border// /-}+"
  printf "| %-${width}s |\n" "`date`"
  printf "| $(tput bold)%-8s$(tput sgr0) %-$(($width - 8))s |\n" "INFO |" "$message"
  echo "+${border// /-}+"
}

# Function to print colored messages
print_color_message() {
  local message="$1"
  local color="$2"
  local bold="$3"
  
  # Define colors
  local default="\033[0m"
  
  case "$color" in
      "red")
          color="\033[31m"
          ;;
      "green")
          color="\033[32m"
          ;;
      "yellow")
          color="\033[33m"
          ;;
      "blue")
          color="\033[34m"
          ;;
      "purple")
          color="\033[35m"
          ;;
      "cyan")
          color="\033[36m"
          ;;
      *)
          color="$default"
          ;;
  esac
  
  if [ "$bold" = "true" ]; then
      echo -e "${color}${message}${default}"
  else
      echo -e "${color}${message}${default}"
  fi
}

# Check if docker-compose.yml exists
check_docker_compose_yaml() {
  if [ ! -f "docker-compose.yml" ]; then
      banner "Error" 50
      print_color_message "docker-compose.yml not found." "red" "true"
      exit 1
  fi
  
  banner "Docker Compose YAML Check" 50
  print_color_message "docker-compose.yml exists." "green" "true"
}

# Check for specific services in docker-compose.yml
check_services() {
  local services=("laravel-dev" "vite" "mariadb")
  
  for service in "${services[@]}"; do
      if ! grep -q "^\s*${service}:" docker-compose.yml; then
          banner "Error" 50
          print_color_message "Service '${service}' not found in docker-compose.yml." "red" "true"
          exit 1
      fi
  done
  
  banner "Services Check" 50
  print_color_message "All required services are defined in docker-compose.yml." "green" "true"
}

# Check for required environment variables in docker-compose.yml
check_env_vars() {
  local required_env_vars=("DB_DATABASE" "DB_USERNAME" "DB_PASSWORD" "MYSQL_ROOT_PASSWORD")
  
 for var in "${required_env_vars[@]}"; do
      if ! grep -q "^\s*-\s*${var}=\${${var}}" docker-compose.yml; then
          banner "Error" 50
          print_color_message "Required environment variable '${var}' not found or not in the correct format in docker-compose.yml." "red" "true"
          exit 1
      fi
  done
  banner "Environment Variables Check" 50
  print_color_message "All required environment variables are defined in docker-compose.yml." "green" "true"
}

# Main function to execute checks
main() {
  check_docker_compose_yaml
  check_services
  check_env_vars
}

# Run the main function
main
