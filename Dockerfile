# ===== Build Stage =====
FROM php:8.2-fpm-alpine AS builder

# Install system dependencies
RUN apk add --no-cache \
    build-base \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    zlib-dev \
    libxml2-dev \
    curl \
    git \
    supervisor

# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
    gd \
    pdo \
    pdo_pgsql \
    bcmath \
    ctype \
    curl \
    dom \
    fileinfo \
    json \
    mbstring \
    tokenizer \
    xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock* ./

# Install PHP dependencies (optimize for production)
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

# ===== Production Stage =====
FROM php:8.2-fpm-alpine

# Install runtime dependencies only
RUN apk add --no-cache \
    postgresql-libs \
    libpng \
    libjpeg-turbo \
    libwebp \
    zlib \
    libxml2 \
    curl \
    supervisor \
    nginx

# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
    gd \
    pdo \
    pdo_pgsql \
    bcmath \
    ctype \
    curl \
    dom \
    fileinfo \
    json \
    mbstring \
    tokenizer \
    xml

# Configure PHP for production
RUN echo "memory_limit = 256M" > /usr/local/etc/php/conf.d/production.ini && \
    echo "max_execution_time = 60" >> /usr/local/etc/php/conf.d/production.ini && \
    echo "upload_max_filesize = 50M" >> /usr/local/etc/php/conf.d/production.ini && \
    echo "post_max_size = 50M" >> /usr/local/etc/php/conf.d/production.ini

# Set working directory
WORKDIR /var/www/html

# Copy application files from builder
COPY --from=builder /var/www/html/vendor ./vendor
COPY --chown=www-data:www-data . .

# Create necessary directories with proper permissions
RUN mkdir -p storage/app/private storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap \
    && chmod -R 775 storage bootstrap/cache

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/conf.d/default.conf

# Copy PHP-FPM configuration
COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf

# Copy Supervisor configuration
COPY docker/supervisord.conf /etc/supervisord.conf

# Copy entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Create non-root user for app execution
RUN addgroup -g 1000 appuser && \
    adduser -D -u 1000 -G appuser appuser

# Set environment variables
ENV APP_ENV=production
ENV COMPOSER_ALLOW_SUPERUSER=1

# Expose port
EXPOSE 8080

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
    CMD curl -f http://localhost:8000/health || exit 1

# Run entrypoint script
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
