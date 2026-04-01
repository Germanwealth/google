#!/bin/sh
set -e

echo "🚀 Starting application bootstrap..."

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate --force
fi

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "⏳ Waiting for database connection..."
    attempts=0
    until php artisan migrate:status 2>&1; do
        attempts=$((attempts + 1))

        if [ "$attempts" -ge 30 ]; then
            echo "❌ Database did not become ready in time."
            exit 1
        fi

        echo "  Attempt $attempts/30 - Waiting for database..."
        sleep 2
    done

    echo "📦 Running database migrations..."
    php artisan migrate --force || (echo "❌ Migration failed!"; exit 1)
else
    echo "⏭️ Skipping migrations because RUN_MIGRATIONS=${RUN_MIGRATIONS}"
fi

if [ "${DB_SEED:-true}" = "true" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force
else
    echo "⏭️ Skipping seeding because DB_SEED=${DB_SEED}"
fi

# Create socket directory and set permissions for PHP-FPM
echo "🔧 Creating PHP-FPM socket directory..."
mkdir -p /var/run
chown -R www-data:www-data /var/run

# Cache routes, config, and views for production
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear old cache
php artisan cache:clear

echo "✅ Application ready!"

# Execute the main command
exec "$@"
