#!/bin/bash

set -e

echo "🚀 Starting Laravel deployment..."

# Optimize application for production
if [ "$APP_ENV" = "production" ]; then
    echo "⚡ Optimizing for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
fi

echo "✅ Deployment script finished successfully."
