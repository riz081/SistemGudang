# Stage 1: Build Stage
FROM php:8.2-fpm-alpine as build

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    oniguruma-dev \
    postgresql-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_pgsql \
    && apk del libpng-dev libjpeg-turbo-dev freetype-dev libxml2-dev oniguruma-dev \
    && rm -rf /var/cache/apk/*

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# Stage 2: Production Stage
FROM php:8.2-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    oniguruma-dev \
    postgresql-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_pgsql \
    && apk del libpng-dev libjpeg-turbo-dev freetype-dev libxml2-dev oniguruma-dev \
    && rm -rf /var/cache/apk/*

# Set working directory
WORKDIR /var/www/html

# Copy application directory from build stage
COPY --from=build /var/www/html /var/www/html

# Copy PHP configuration
COPY php.ini /usr/local/etc/php/

# Run database migrations
CMD ["php-fpm"]
