FROM php:8.2-apache

# 1. Variables d'environnement
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV NODE_VERSION=18

# 2. Mettre à jour et installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    gnupg \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 3. Installer Node.js 18 (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# 4. Vérifier les installations
RUN node --version && npm --version

# 5. Installer les extensions PHP
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    sockets

# 6. Activer mod_rewrite pour Apache
RUN a2enmod rewrite headers

# 7. Configurer Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 8. Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 9. Créer le dossier de l'application
WORKDIR /var/www/html

# 10. Copier les fichiers de l'application
COPY . .

# 11. Installer les dépendances Composer (sans dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 12. Installer les dépendances Node.js et build les assets si nécessaire
RUN if [ -f "package.json" ]; then \
    echo "📦 Installing Node.js dependencies..." && \
    npm ci --only=production && \
    if [ -f "vite.config.js" ] || [ -f "webpack.mix.js" ]; then \
        echo "🚀 Building assets..." && \
        npm run build; \
    fi; \
fi

# 13. Définir les permissions
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage
RUN chmod -R 775 /var/www/html/bootstrap/cache

# 14. Nettoyer les caches npm pour réduire la taille de l'image
RUN if [ -d "node_modules" ]; then \
    npm cache clean --force; \
fi

# 15. Exposer le port
EXPOSE 80

# 16. Script de démarrage
COPY deploy.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/deploy.sh
ENTRYPOINT ["deploy.sh"]
