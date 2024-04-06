# Use an official PHP runtime as a parent image with Apache
FROM php:7.4-apache

# Install mysqli and any other extensions you need
RUN docker-php-ext-install mysqli

# Expose port 80 to access the application
EXPOSE 80
