#!/bin/sh
set -e

echo "🚀 Starting application bootstrap..."

# APP_KEY must be stable across all instances or encrypted cookies / sessions break.
# If not set, generate one and warn
if [ -z "$APP_KEY" ]; then
    echo "⚠️  APP_KEY not set. Generating a new key..."
    php artisan key:generate --force
else
    echo "✓ Using provided APP_KEY"
fi

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "⏳ Waiting for database connection..."
    attempts=0
    until output=$(php artisan migrate:install --force 2>&1); do
        attempts=$((attempts + 1))

        if [ "$attempts" -ge 30 ]; then
            echo "$output"
            echo "❌ Database did not become ready in time."
            exit 1
        fi

        echo "$output"
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

# Clear old cache first
echo "🧹 Clearing old cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Cache routes, config, and views for production
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Application ready!"

# Execute the main command
exec "$@"
