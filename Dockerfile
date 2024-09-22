# Use the official PHP 8.3 FPM image with Nginx
FROM php:8.3-fpm

# Install dependencies for Nginx and PHP
RUN apt-get update && apt-get install -y \
    nginx

# Configure PHP-FPM to listen on 9000
RUN sed -i 's|listen = /var/run/php/php8.3-fpm.sock|listen = 9000|' /usr/local/etc/php-fpm.d/www.conf

# Configure Nginx
COPY ./docker/nginx.conf /etc/nginx/nginx.conf

# Copy project files
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Recreate config.json if it exists
RUN [ -f config.json ] && rm config.json; touch config.json

# Set config file permissions
RUN chmod -R 777 config.json

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Set up the smarty temp directory
RUN mkdir -p /tmp/smarty && chmod -R 777 /tmp/smarty

# Expose port 80
EXPOSE 80

# Start both PHP-FPM and Nginx
CMD ["bash", "-c", "service nginx start && php-fpm"]