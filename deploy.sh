#!/bin/bash

echo "🚀 Démarrage du déploiement Laravel..."

# Vérifier si .env existe, sinon le créer depuis .env.example
if [ ! -f .env ]; then
    echo "📝 Création du fichier .env depuis .env.example..."
    cp .env.example .env
fi

# S'assurer que le fichier .env a un APP_KEY
if ! grep -q "^APP_KEY=" .env; then
    echo "APP_KEY=" >> .env
fi

# Générer la clé d'application si elle n'existe pas ou est vide
APP_KEY_VALUE=$(grep "^APP_KEY=" .env | cut -d= -f2)
if [ -z "$APP_KEY_VALUE" ] || [ "$APP_KEY_VALUE" = "" ]; then
    echo "🔑 Génération de la clé d'application..."
    php artisan key:generate --force
fi

# Installer les dépendances npm (si package.json existe)
if [ -f "package.json" ]; then
    echo "📦 Installation des dépendances npm..."
    npm ci --only=production
fi

# Build les assets (si nécessaire)
if [ -f "package.json" ] && [ -f "vite.config.js" -o -f "webpack.mix.js" ]; then
    echo "🔨 Build des assets..."
    npm run build
fi

# Nettoyer le cache
echo "🧹 Nettoyage du cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimiser l'application (production seulement)
if [ "${APP_ENV:-production}" = "production" ]; then
    echo "⚡ Optimisation pour la production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Définir les permissions
echo "🔒 Configuration des permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache public

# Dans deploy.sh, ajoutez avant de démarrer Apache:
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

# Démarrer Apache en premier plan
echo "🌍 Démarrage du serveur web..."
exec apache2-foreground
