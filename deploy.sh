#!/bin/bash

echo "🚀 Démarrage du déploiement Laravel..."

# Créer le fichier .env à partir des variables d'environnement
if [ ! -f .env ]; then
    echo "📝 Création du fichier .env..."
    cp .env.example .env
fi

# Générer la clé d'application si elle n'existe pas
if [ -z "$(grep '^APP_KEY=' .env)" ] || [ "$(grep '^APP_KEY=' .env | cut -d= -f2)" = "" ]; then
    echo "🔑 Génération de la clé d'application..."
    php artisan key:generate --force
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
    php artisan event:cache
fi

php artisan serve --host=0.0.0.0 --port=${PORT}

# Installer les assets (si vous utilisez Laravel Mix/Vite)
# echo "📦 Installation des assets..."
npm install --production
npm run build

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
