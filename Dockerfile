# Use the official PHP image with Apache
FROM php:7.4-apache

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo_mysql

# Clear out the local repository of retrieved package files
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Set the working directory to the root of your PHP application
WORKDIR /var/www/html

# Copy your application code and Composer files to the container
COPY ./www/ ./
COPY composer.json ./
COPY composer.lock* ./

# Install Composer dependencies
RUN composer install --no-scripts --no-autoloader

# Require Faker
# Including this in your composer.json beforehand is better.
RUN composer require fakerphp/faker

# After installing dependencies, dump the autoloader to optimize autoload files
RUN composer dump-autoload --optimize

# Confirm that vendor/autoload.php exists
RUN if [ ! -f vendor/autoload.php ]; then echo "The autoload file is not found"; exit 1; fi

# Fix permissions for the Apache user
RUN chown -R www-data:www-data .

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache server in the foreground
CMD ["apache2-foreground"]
