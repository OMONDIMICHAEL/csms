FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    libssl-dev \
    && docker-php-ext-install openssl

# Copy application files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Expose port
EXPOSE 80

# Start PHP server
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]