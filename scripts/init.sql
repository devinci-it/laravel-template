CREATE DATABASE IF NOT EXISTS ${PROJECT_NAME};
GRANT ALL ON ${PROJECT_NAME}.* TO '${PROJECT_NAME}user'@'%' IDENTIFIED BY '${PROJECT_NAME}password';
FLUSH PRIVILEGES;
