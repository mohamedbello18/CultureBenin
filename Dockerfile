FROM php:8.2-apache

# 1. Variables d'environnement
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV COMPOSER_ALLOW_SUPERUSER=1

# 2. Mettre à jour et installer les dépendances
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
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 3. Installer les extensions PHP
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

# 4. Activer mod_rewrite pour Apache
RUN a2enmod rewrite headers

# 5. Configurer Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Créer le dossier de l'application
WORKDIR /var/www/html

# 8. Copier les fichiers de l'application
COPY . .

# 9. Installer les dépendances Composer (sans dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 10. Définir les permissions
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage
RUN chmod -R 775 /var/www/html/bootstrap/cache

# 11. Exposer le port
EXPOSE 80

# 12. Script de démarrage
COPY deploy.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/deploy.sh
ENTRYPOINT ["deploy.sh"]
