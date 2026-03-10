# 🐳 FlareSpark Docker Setup Guide

## Overview
This Docker setup provides a production-ready containerized environment for FlareSpark with:
- **PHP 8.2 FPM** with all required extensions
- **Nginx** web server with optimized configuration
- **PostgreSQL** database support
- **Supervisor** process management
- **Multi-stage builds** for minimal image size
- **Railway-ready** deployment configuration

## 📁 Docker Files Structure

```
docker/
├── entrypoint.sh          # Startup script (migrations, caching)
├── nginx.conf             # Nginx main configuration
├── default.conf           # Nginx virtual host config
├── www.conf               # PHP-FPM configuration
└── supervisord.conf       # Supervisor process manager config

.dockerignore             # Files to exclude from Docker image
Dockerfile                # Multi-stage production build
docker-compose.yml        # Local development setup
railway.toml              # Railway deployment config
```

## 🚀 Local Development with Docker Compose

### Prerequisites
- Docker Desktop installed
- Docker Compose v3.9+

### Quick Start

1. **Set up environment file:**
   ```bash
   cp .env.example .env  # or use existing .env
   ```

2. **Start containers:**
   ```bash
   docker-compose up -d
   ```

3. **View logs:**
   ```bash
   docker-compose logs -f app
   ```

4. **Run artisan commands:**
   ```bash
   docker-compose exec app php artisan tinker
   docker-compose exec app php artisan migrate:fresh --seed
   ```

5. **Access the app:**
   - Application: http://localhost:8000
   - Health check: http://localhost:8000/health
   - Database: localhost:5432

6. **Stop containers:**
   ```bash
   docker-compose down
   ```

### Useful Commands

```bash
# View running containers
docker-compose ps

# Execute command in app container
docker-compose exec app php artisan <command>

# Rebuild containers
docker-compose build --no-cache

# View database
docker-compose exec postgres psql -U postgres -d railway

# Check container logs
docker-compose logs app
docker-compose logs postgres
```

## 🚂 Railway Deployment

### Prerequisites
- Railway CLI installed
- GitHub account with FlareSpark repo
- PostgreSQL service in Railway

### Deployment Steps

1. **Initialize Railway project:**
   ```bash
   railway init
   ```

2. **Link PostgreSQL service:**
   - Add PostgreSQL service in Railway dashboard
   - Get connection string and add to environment variables

3. **Set environment variables in Railway:**
   ```
   APP_NAME=FlareSpark
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:RDg/7dAulHRiFL7SjYBw3ot7OaWcpyZhbPEg4Sswdxk=
   APP_URL=https://your-railway-domain.com
   
   DB_CONNECTION=pgsql
   DB_HOST=${{Postgres.PGHOST}}
   DB_PORT=${{Postgres.PGPORT}}
   DB_DATABASE=${{Postgres.PGDATABASE}}
   DB_USERNAME=${{Postgres.PGUSER}}
   DB_PASSWORD=${{Postgres.PGPASSWORD}}
   ```

4. **Deploy:**
   ```bash
   railway up
   ```

5. **Monitor deployment:**
   - Check Railway dashboard
   - View logs in real-time
   - Health check: `https://your-domain/health`

### Railway.toml Configuration

The `railway.toml` file is pre-configured with:
- **Dockerfile builder** - Uses our multi-stage Docker build
- **Production environment** - APP_ENV=production, APP_DEBUG=false
- **Health checks** - `/health` endpoint every 10s
- **Restart policy** - Auto-restart on failure with 3 retries
- **Start command** - Runs supervisord with proper process management

## 📊 Performance Optimizations

### Docker Image
- ✅ Multi-stage builds (minimal final image size)
- ✅ Alpine Linux (small base image ~5MB → ~250MB final)
- ✅ Production dependencies only (no dev packages)
- ✅ Optimized Composer installation

### PHP-FPM
- ✅ Dynamic process management (4-20 workers)
- ✅ Optimized buffer sizes for high concurrency
- ✅ Request timeout: 60 seconds
- ✅ Max requests: 1000 per process

### Nginx
- ✅ Gzip compression enabled
- ✅ Static file caching (30 days)
- ✅ Worker processes: auto
- ✅ Connection pooling and keepalive

### Laravel
- ✅ Route caching enabled
- ✅ Config caching enabled
- ✅ View caching enabled
- ✅ Production log level (info only)

## 🔒 Security Features

- ✅ Non-root user execution (www-data)
- ✅ Security headers in Nginx (CSP, X-Frame-Options, etc.)
- ✅ Dot files blocked (.env, .git, etc.)
- ✅ Storage directories protected
- ✅ No token/secret exposure in image

## 📝 Database Migrations

Migrations run automatically on container startup via `entrypoint.sh`:

1. Checks if APP_KEY exists (generates if not)
2. Runs `php artisan migrate --force`
3. Optionally seeds database if `DB_SEED=true`
4. Caches routes, config, and views
5. Clears application cache

## 🏥 Health Checks

Docker health check runs every 30 seconds:
```bash
curl -f http://localhost:8000/health || exit 1
```

The `/health` endpoint returns:
```
HTTP 200
healthy
```

## 📦 Image Size

- **Base image:** ~5 MB (Alpine Linux)
- **Final image:** ~250-300 MB (with all dependencies)

To reduce further, consider:
- Using specific Composer packages instead of "dev" packages
- Removing unused Laravel features
- Using S3 for storage instead of local

## 🐛 Troubleshooting

### Container won't start
```bash
docker-compose logs app
docker-compose logs postgres
```

### Database connection failed
- Check PostgreSQL is healthy: `docker-compose ps`
- Verify environment variables: `docker-compose exec app env | grep DB_`
- Check network: `docker network ls`

### Permission denied errors
```bash
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### Out of memory
Increase Docker Desktop memory in settings or modify Supervisor pool size in `docker/www.conf`

## 📖 Additional Resources

- [PHP Docker Official Images](https://hub.docker.com/_/php)
- [Nginx Documentation](https://nginx.org/en/docs/)
- [Laravel Docker Best Practices](https://laravel.com/docs/deployment#using-docker)
- [Railway Documentation](https://docs.railway.app/)
- [Docker Compose Reference](https://docs.docker.com/compose/compose-file/)

---

**Setup Date:** March 10, 2026
**Docker Version:** 3.9+
**PHP Version:** 8.2
**PostgreSQL Version:** 15
