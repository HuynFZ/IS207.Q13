# ---------- Composer Phase ----------
FROM composer:2.8.12 AS composer-base
WORKDIR /app

COPY composer.json composer.lock artisan ./
COPY bootstrap bootstrap
COPY routes routes

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# ---------- Base PHP Image ----------
FROM php:8.4.13-alpine3.22 AS base
WORKDIR /app

RUN set -eux; \
    apk add --no-cache \
        bash \
        curl \
        libzip-dev \
        oniguruma-dev \
        mysql-client \
    && docker-php-ext-install \
        pdo_mysql \
        bcmath \
        zip

COPY --from=composer-base /usr/bin/composer /usr/bin/composer
COPY --from=composer-base /app/vendor ./vendor

COPY . .

# ---------- Dev Image ----------
FROM base AS dev
ENV APP_ENV=local APP_DEBUG=true
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
