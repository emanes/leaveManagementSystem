# Stage 1: Install PHP cpmposer deps
FROM composer:2 as composer_deps

WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist

# Stage 2: Build asset frontend Node.js
FROM node:18-alpine as node_builder

WORKDIR /
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run dev

# Stage 3: PHP-FPM
FROM php:8.2-fpm-alpine

# Packages installer
RUN apk add --no-cache \
    nginx \
    supervisor \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libintl \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    bcmath \
    gd \
    zip \
    intl \
    exif

# Set Folder
WORKDIR /var/www

# Copy Composer deps and Assets
#COPY --from=composer_deps /app/vendor/ ./vendor/
#COPY --from=node_builder /public/build ./public/build
#COPY --from=node_builder /.env.example ./.env.example

# Copia il resto dell'applicazione
COPY . .

# Set Permission
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Run DB Seed & Migration
Run php

EXPOSE 9000

CMD ["php-fpm"]
