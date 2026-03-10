# 🚀 FlareSpark Docker Quick Reference

## 📋 File Structure

```
flarespark/
├── Dockerfile              # Production Docker image (multi-stage)
├── docker-compose.yml      # Local development setup
├── .dockerignore            # Files excluded from Docker image
├── docker/
│   ├── entrypoint.sh       # Container startup script
│   ├── nginx.conf          # Nginx configuration
│   ├── default.conf        # Virtual host config
│   ├── www.conf            # PHP-FPM config
│   └── supervisord.conf    # Process manager config
├── railway.toml            # Railway deployment config
├── .env.example            # Environment template
├── DOCKER_SETUP.md         # Detailed Docker guide
└── RAILWAY_DEPLOYMENT.md   # Railway deployment guide
```

## ⚡ Quick Commands

### Local Development

```bash
# First time setup
./docker-setup.sh

# Start services
docker-compose up -d

# Stop services
docker-compose down

# View logs
docker-compose logs -f app

# Run artisan command
docker-compose exec app php artisan migrate:fresh --seed

# Shell access
docker-compose exec app /bin/sh

# Database shell
docker-compose exec postgres psql -U postgres -d railway
```

### Railway Deployment

```bash
# Initial setup
npm install -g @railway/cli
railway login
railway init

# Deploy
railway up

# View logs
railway logs --follow

# Execute command
railway exec php artisan migrate:status

# Environment variables
railway variables
```

## 🔧 Configuration

### Environment Variables (.env)

```env
# Required for Docker
APP_NAME=FlareSpark
APP_ENV=production
APP_KEY=base64:RDg/7dAulHRiFL7SjYBw3ot7OaWcpyZhbPEg4Sswdxk=
APP_DEBUG=false
APP_URL=http://localhost:8000

# Database (Local Docker)
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=railway
DB_USERNAME=postgres
DB_PASSWORD=secret

# Database (Railway Cloud)
# Use ${{ Postgres.PGHOST }} instead of hardcoded values
```

### Docker Ports

- **Nginx:** 8000 (public)
- **PHP-FPM:** 9000 (internal)
- **PostgreSQL:** 5432 (internal)
- **Supervisor:** N/A (no exposed port)

## 🐳 Docker Image Details

- **Base Image:** `php:8.2-fpm-alpine`
- **Final Size:** ~250-300 MB
- **Build Time:** ~3-5 minutes (first build)
- **User:** www-data (non-root)
- **Processes:** Nginx + PHP-FPM + Supervisor

## 🏥 Health Monitoring

```bash
# Check container health
docker-compose ps

# Health check endpoint
curl http://localhost:8000/health
# Response: healthy

# View Docker logs
docker logs flarespark-app
docker logs flarespark-db
```

## 📊 Performance Settings

| Setting | Value | Purpose |
|---------|-------|---------|
| PHP Memory Limit | 256M | Sufficient for Laravel |
| PHP Execution Timeout | 60s | API request timeout |
| FPM Max Children | 20 | Max concurrent requests |
| FPM Start Servers | 4 | Initial worker count |
| Nginx Workers | auto | CPU-optimized |
| Gzip Compression | on | Reduce bandwidth |
| Cache Duration | 30 days | Static assets |

## 🔒 Security Features

- ✅ Non-root container execution
- ✅ APP_DEBUG=false in production
- ✅ Security headers in Nginx
- ✅ HTTPS on Railway (auto SSL)
- ✅ Secrets in environment variables
- ✅ No hard-coded credentials in image

## 🐛 Troubleshooting

| Issue | Solution |
|-------|----------|
| Container won't start | `docker-compose logs app` |
| Database connection error | Check DB_HOST and credentials |
| 502 Bad Gateway | Check Nginx/PHP-FPM logs |
| Out of memory | Increase Docker memory limit |
| Port already in use | `lsof -i :8000` and kill process |
| Permission denied | `docker-compose exec app chown -R www-data:www-data storage` |

## 🚀 Deployment Checklist

- [ ] PostgreSQL service added in Railway
- [ ] All environment variables set
- [ ] APP_KEY generated and saved
- [ ] Database credentials verified locally
- [ ] Docker builds successfully: `docker build -t flarespark .`
- [ ] Local compose works: `docker-compose up`
- [ ] Health check passes: `/health` endpoint
- [ ] Migrations run: `docker-compose exec app php artisan migrate:status`
- [ ] GitHub repository connected to Railway
- [ ] Automatic deployments enabled
- [ ] Logs monitored after deployment

## 📈 Monitoring & Maintenance

### Daily
- Check application logs: `railway logs`
- Monitor error rates
- Test `/health` endpoint

### Weekly
- Review database size
- Check slow query logs
- Monitor resource usage

### Monthly
- Update dependencies: `composer update`
- Backup database
- Review security logs
- Optimize queries if needed

## 🎯 Optimization Tips

1. **Enable Query Caching**
   ```php
   CACHE_DRIVER=redis
   ```

2. **Use Database Connection Pooling**
   ```env
   QUEUE_CONNECTION=database
   ```

3. **Optimize Image Size**
   - Remove unused extensions
   - Use Alpine Linux (done ✓)
   - Remove dev dependencies (done ✓)

4. **Enable Gzip Compression**
   - Handled by Nginx (done ✓)

5. **Cache Static Assets**
   - 30-day cache (done ✓)

## 📚 Documentation Files

| File | Purpose |
|------|---------|
| DOCKER_SETUP.md | Complete Docker guide |
| RAILWAY_DEPLOYMENT.md | Railway deployment steps |
| .env.example | Environment template |
| docker-setup.sh | Automated setup script |

## 🆘 Getting Help

1. Check `DOCKER_SETUP.md` for detailed guide
2. Check `RAILWAY_DEPLOYMENT.md` for deployment help
3. View Docker logs: `docker-compose logs app`
4. View Railway logs: `railway logs --follow`
5. Check Docker status: `docker-compose ps`

## 📞 Quick Contact

- **Docker Issues:** Refer to DOCKER_SETUP.md
- **Railway Issues:** Refer to RAILWAY_DEPLOYMENT.md
- **Database Issues:** `docker-compose exec postgres psql -U postgres`
- **PHP Issues:** `docker-compose exec app php artisan tinker`

---

**Last Updated:** March 10, 2026
**Status:** ✅ Production Ready
**Tested:** ✅ Local + Cloud Deployment
