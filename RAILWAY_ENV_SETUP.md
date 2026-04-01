# Railway Environment Variables Setup

## For Initial Deployment (Skip migrations on startup)

To avoid health check failures during the first deployment, set these variables in Railway:

```env
# Application
APP_NAME=cryptorank
APP_ENV=production
APP_DEBUG=false
APP_URL=https://cryptorank-production.up.railway.app
APP_KEY=base64:2Uhp9ZjhjNCyf+1qZZJdmfDr6H+KbMEnVGeY8udlmxA=

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=info

# Database
DB_CONNECTION=pgsql
DB_HOST=interchange.proxy.rlwy.net
DB_PORT=43364
DB_DATABASE=railway
DB_USERNAME=postgres
DB_PASSWORD=VzzoouoJWeqGZMiNgevNWrprfQjMOCtV

# **IMPORTANT: Skip migrations on startup**
RUN_MIGRATIONS=false
DB_SEED=false

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Queue & Broadcasting
QUEUE_CONNECTION=sync
BROADCAST_CONNECTION=log

# Mail
MAIL_MAILER=log
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME=cryptorank

# File System
FILESYSTEM_DISK=local

# Vite
VITE_APP_NAME=cryptorank
```

## After Successful Deployment

Once the app deploys successfully and the `/health` endpoint responds:

1. **Run migrations manually:**
```bash
railway exec php artisan migrate --force
```

2. **Seed the database (if needed):**
```bash
railway exec php artisan db:seed --force
```

3. **Update Railway variables** to enable migrations on future deployments:
   - Change `RUN_MIGRATIONS=true`
   - Change `DB_SEED=true`

4. **Clear caches:**
```bash
railway exec php artisan cache:clear
railway exec php artisan route:clear
railway exec php artisan view:clear
```

## How to Set Variables in Railway

1. Go to your Railway project dashboard
2. Select the service
3. Click **Variables** tab
4. Add each key-value pair
5. Changes take effect on next deployment

## Why This Approach?

- **Health checks fail** when app takes too long to start
- **Migrations take time**, blocking app startup
- **Database connection delays** can cause timeouts
- **Skipping** on first deploy lets the app start quickly
- **Run manually** after confirming database connectivity
