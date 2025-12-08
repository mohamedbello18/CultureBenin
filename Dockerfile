FROM php:8.2-apache

# For Render
ENV PORT=10000

# 1. Install system dependencies + Node.js
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    gnupg \
    ca-certificates \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure Apache for Render port
RUN sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
RUN sed -i "s/:80/:$PORT/g" /etc/apache2/sites-available/*.conf

# 3. Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring gd zip

# 4. Enable Apache modules
RUN a2enmod rewrite

# 5. Copy application
COPY . /var/www/html
WORKDIR /var/www/html

# 6. Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 7. Install npm dependencies if package.json exists
RUN if [ -f "package.json" ]; then \
    npm ci --only=production || echo "npm install failed, continuing..."; \
    fi

# 8. Set permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

CMD ["apache2-foreground"]
