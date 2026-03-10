# 🚂 Railway Deployment Guide for FlareSpark

## Overview
This guide walks you through deploying FlareSpark to Railway with Docker, PostgreSQL, and all modern best practices.

## Prerequisites

### Local Setup
- Git repository pushed to GitHub
- Docker files ready (Dockerfile, railway.toml, .env variables)
- Railway account created at https://railway.app

### Railway Account
1. Sign up at https://railway.app
2. Connect your GitHub account
3. Create a new project

## Step-by-Step Deployment

### 1️⃣ Create Railway Project

```bash
# Option A: Via Railway CLI
railway init
railway link [your-project-id]

# Option B: Via Web Dashboard
# Go to https://railway.app → New Project → GitHub Repository
```

### 2️⃣ Add PostgreSQL Service

**Via Web Dashboard:**
1. Click "Add Service"
2. Select "PostgreSQL"
3. Railway will auto-generate:
   - `PGHOST`: Database host
   - `PGPORT`: Database port
   - `PGDATABASE`: Database name
   - `PGUSER`: Database user
   - `PGPASSWORD`: Database password

**Save these credentials** - you'll need them for environment variables.

### 3️⃣ Configure Environment Variables

Go to **Project Settings → Variables** and add these:

```env
# Application
APP_NAME=FlareSpark
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-railway-domain.up.railway.app
APP_KEY=base64:RDg/7dAulHRiFL7SjYBw3ot7OaWcpyZhbPEg4Sswdxk=

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=info

# Database (Use Railway's PostgreSQL variables)
DB_CONNECTION=pgsql
DB_HOST=${{ Postgres.PGHOST }}
DB_PORT=${{ Postgres.PGPORT }}
DB_DATABASE=${{ Postgres.PGDATABASE }}
DB_USERNAME=${{ Postgres.PGUSER }}
DB_PASSWORD=${{ Postgres.PGPASSWORD }}

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Queue & Broadcasting
QUEUE_CONNECTION=sync
BROADCAST_CONNECTION=log

# Mail
MAIL_MAILER=log
MAIL_FROM_ADDRESS=hello@flarespark.com
MAIL_FROM_NAME=FlareSpark

# File System
FILESYSTEM_DISK=local

# Vite
VITE_APP_NAME=FlareSpark
```

### 4️⃣ Deploy via GitHub Integration

**Option A: Automatic Deployment (Recommended)**

1. Railway dashboard → Project → GitHub Integration
2. Select your repository and branch
3. Railway auto-deploys on every push to main/master

**Option B: Manual Deployment via CLI**

```bash
# Install Railway CLI
npm install -g @railway/cli

# Login
railway login

# Link to your Railway project
railway link [your-project-id]

# Deploy
railway up
```

### 5️⃣ Monitor Deployment

```bash
# Via CLI
railway logs

# Via Web Dashboard
# Project → Deployments → View logs in real-time
```

Expected output:
```
🔑 Generating APP_KEY...
📦 Running database migrations...
⚡ Caching configuration...
✅ Application ready!
INFO  Server running on [http://0.0.0.0:8000]
```

### 6️⃣ Verify Health Check

Once deployed, test the health endpoint:

```bash
curl https://your-railway-domain.up.railway.app/health
# Response: healthy
```

## Environment Variables Reference

### Using Railway Variables

Railway provides these environment variables for PostgreSQL:

| Variable | Example |
|----------|---------|
| `${{ Postgres.PGHOST }}` | `xxx.postgres.railway.internal` |
| `${{ Postgres.PGPORT }}` | `5432` |
| `${{ Postgres.PGDATABASE }}` | `railway` |
| `${{ Postgres.PGUSER }}` | `postgres` |
| `${{ Postgres.PGPASSWORD }}` | `xxx_yyy_zzz` |

### Using External Variables

If your database is external (not Railway PostgreSQL):

```env
DB_HOST=your-external-host.com
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

## Docker Build Process

Railway automatically:

1. **Detects Dockerfile** - Uses railway.toml `builder = "dockerfile"`
2. **Builds image** - Multi-stage build from Alpine base
3. **Runs entrypoint.sh** - Sets up app and migrations
4. **Starts services** - Nginx + PHP-FPM via Supervisor
5. **Health checks** - Monitors /health endpoint

## Troubleshooting

### Deployment Fails at Build

```bash
# Check build logs
railway logs --service [service-name]

# Common issues:
# 1. Missing Dockerfile
# 2. Corrupted docker files
# 3. Insufficient build timeout

# Solution: Delete docker/ folder, rebuild locally, push to GitHub
```

### Database Connection Error

```
ERROR: Database connection failed
```

**Fix:**
1. Verify PostgreSQL service is added in Railway
2. Check DB_HOST is using ${{ Postgres.PGHOST }}
3. Ensure DB_PASSWORD is correctly set
4. Test locally: `docker-compose up -d`

### App Running but 502 Bad Gateway

**Cause:** Nginx/PHP-FPM communication issue

**Fix:**
1. Check logs: `railway logs`
2. Verify Supervisor is running both services
3. Check /health endpoint: Returns 200?

### Migrations Not Running

**Check:**
```bash
railway exec php artisan migrate:status
```

**If migration table missing:**
```bash
railway exec php artisan migrate --force
```

### App Out of Memory

**Solution:**
- Increase Railway plan to more memory
- Or optimize Laravel config in `docker/www.conf`

## Rollback Deployment

If something goes wrong:

```bash
# Via CLI
railway rollback [deployment-id]

# Via Dashboard
# Project → Deployments → Click previous deployment
```

## Performance Optimization

### Caching

All caching is enabled in entrypoint.sh:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Database Connection Pooling

PostgreSQL automatically handles connection pooling. For high traffic:
- Use `QUEUE_CONNECTION=database` instead of sync
- Implement queue workers for heavy tasks

### Static File Caching

Nginx caches static assets for 30 days:
```nginx
expires 30d;
add_header Cache-Control "public, immutable";
```

## Monitoring & Logging

### View Logs

```bash
# Real-time logs
railway logs --follow

# Specific service logs
railway logs --service app
railway logs --service postgres

# Last N lines
railway logs --tail 100
```

### Custom Logging

Laravel logs go to `storage/logs/`. Configure in `.env`:

```env
LOG_CHANNEL=single          # Single file
LOG_CHANNEL=daily           # One file per day
LOG_CHANNEL=stack           # Multiple channels
LOG_LEVEL=info              # info, warning, error, critical
```

## Security Best Practices

✅ **Implemented:**
- APP_DEBUG=false in production
- Non-root Docker user execution
- Security headers in Nginx
- HTTPS enforced (Railway auto-SSL)
- Database credentials in variables (not in code)

⚠️ **Additional:**
- Rotate APP_KEY periodically
- Use strong DB_PASSWORD
- Enable VPN/whitelist IPs if needed
- Set up rate limiting for API endpoints

## Scaling

### Vertical Scaling
- Upgrade Railway plan (more CPU/RAM)
- App automatically restarts

### Horizontal Scaling
- Add multiple service instances
- Configure load balancing in Railway dashboard

### Database Optimization
- Enable query logging: `railway exec php artisan migrate --add-index`
- Monitor slow queries in Railway PostgreSQL logs

## Continuous Integration

### Auto-Deploy on Push

Railway automatically deploys on GitHub push. To disable:

1. Project Settings → GitHub Integration
2. Uncheck "Automatic Deployments"

### Deployment Hooks

Before/After deployment scripts (optional):
```bash
# In railway.toml
[deploy]
startCommand = "supervisord -c /etc/supervisord.conf"
```

## Backup & Recovery

### PostgreSQL Backups

Railway auto-backs up PostgreSQL daily. To restore:

```bash
# Export current data
railway exec pg_dump -U postgres railway > backup.sql

# Restore from backup
railway exec psql -U postgres railway < backup.sql
```

## Next Steps

1. ✅ Deploy to Railway
2. 📊 Monitor logs and metrics
3. 🔐 Set up monitoring/alerts
4. 📈 Optimize based on performance metrics
5. 🚀 Scale as needed

## Support & Resources

- **Railway Docs:** https://docs.railway.app
- **Laravel Deployment:** https://laravel.com/docs/deployment
- **Docker Docs:** https://docs.docker.com
- **PostgreSQL Docs:** https://www.postgresql.org/docs/

---

**Updated:** March 10, 2026
**Docker Version:** 3.9+
**PHP Version:** 8.2-FPM
**PostgreSQL Version:** 15
