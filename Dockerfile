# ******************************************************************************
# * Base Image and Environment Setup
# ******************************************************************************
FROM php:8.3 AS builder

# ******************************************************************************
# * Arguments and Environment Variables
# ******************************************************************************
ARG PROJECT_NAME=myapp
ENV APP_NAME=${PROJECT_NAME}
ENV MYSQL_USER=${PROJECT_NAME}user
ENV MYSQL_PASSWORD=${PROJECT_NAME}password
ENV MYSQL_DATABASE=${PROJECT_NAME}

# ******************************************************************************
# * Installing Dependencies
# ******************************************************************************
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql mbstring exif pcntl bcmath opcache

# ******************************************************************************
# * Installing Composer
# ******************************************************************************
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
    && rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); exit(1); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Add Composer to PATH
ENV PATH="/usr/local/bin:${PATH}"

# ******************************************************************************
# * Setting Working Directory and Copying Application Code
# ******************************************************************************
WORKDIR /var/www

# Copy the entire application directory
COPY . .

# ******************************************************************************
# * Installing Laravel Project and Dependencies
# ******************************************************************************
# Ensure that the vendor directory exists before attempting to install dependencies
RUN composer install --ignore-platform-reqs --no-plugins --no-scripts

# Create storage and bootstrap/cache directories
RUN mkdir -p storage bootstrap/cache

# Adjust ownership and permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# ******************************************************************************
# * Stage 2: Build Vite
# ******************************************************************************
FROM node:latest AS vite

WORKDIR /var/www

# Copy Laravel application from the builder stage
COPY --from=builder /var/www .

# Install nvm and node
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash \
    && export NVM_DIR="$HOME/.nvm" \
    && . "$NVM_DIR/nvm.sh" \
    && nvm install v20.14.0 \
    && npm install -g npm@latest \
    && npm install

# ******************************************************************************
# * Stage 3: MariaDB
# ******************************************************************************
FROM mariadb:latest AS mariadb

# Environment variables
ARG MYSQL_USER
ARG MYSQL_PASSWORD
ARG MYSQL_DATABASE

# Copy the database initialization script
COPY scripts/init.sql /docker-entrypoint-initdb.d/init.sql

# Set permissions on the script
RUN chmod 755 /docker-entrypoint-initdb.d/init.sql

# Set up the initial MariaDB configuration
RUN sed -i 's/MYSQL_USER/'"$MYSQL_USER"'/g' /docker-entrypoint-initdb.d/init.sql
RUN sed -i 's/MYSQL_PASSWORD/'"$MYSQL_PASSWORD"'/g' /docker-entrypoint-initdb.d/init.sql
RUN sed -i 's/MYSQL_DATABASE/'"$MYSQL_DATABASE"'/g' /docker-entrypoint-initdb.d/init.sql

# ******************************************************************************
# * Stage 4: Final application image
# ******************************************************************************
FROM php:8.3

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql mbstring exif pcntl bcmath opcache

# ******************************************************************************
# * Setting Working Directory and Copying Application Code
# ******************************************************************************
WORKDIR /var/www

# Copy Laravel application files from the builder stage
COPY --from=builder /var/www .

# Expose ports and setup command to start the application
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
