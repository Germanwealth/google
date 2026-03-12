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
    until php artisan migrate:status >/dev/null 2>&1; do
        attempts=$((attempts + 1))

        if [ "$attempts" -ge 30 ]; then
            echo "❌ Database did not become ready in time."
            exit 1
        fi

        sleep 2
    done

    echo "📦 Running database migrations..."
    php artisan migrate --force
else
    echo "⏭️ Skipping migrations because RUN_MIGRATIONS=${RUN_MIGRATIONS}"
fi

if [ "${DB_SEED:-false}" = "true" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force
else
    echo "⏭️ Skipping database seeding."
fi

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
