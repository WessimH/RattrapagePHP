# Use an official PHP runtime as a parent image with Apache
FROM php:7.4-apache

# Update package lists and install dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nano \
    wget

# Install mysqli and any other extensions you need
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    docker-php-ext-enable mysqli pdo pdo_mysql

# Set the COMPOSER_ALLOW_SUPERUSER environment variable
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Ensure the /var/www/html/ directory exists
RUN mkdir -p /var/www/html/

# Copy your project files to the container
COPY www/ /var/www/html/

# Set the working directory to your project's directory
WORKDIR /var/www/html
RUN composer install
# Use Composer to install project dependencies, including Faker
RUN composer require fakerphp/faker

# Fix permissions for the project directory
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expose port 80 to access the application
EXPOSE 80
