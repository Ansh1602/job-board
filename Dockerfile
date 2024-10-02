# Use the official PHP image as a base
FROM php:7.4-apache

# Install necessary libraries
RUN apt-get update && apt-get install -y \
    libssl-dev \
    && docker-php-ext-install pdo_mysql

# Copy the application code to the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]