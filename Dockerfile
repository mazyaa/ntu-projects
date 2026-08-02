# syntax=docker/dockerfile:1

FROM node:22-alpine AS node-build
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM php:8.4-cli-alpine AS composer-build
WORKDIR /app
RUN apk add --no-cache git unzip libzip-dev \
    && docker-php-ext-install zip
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader --no-interaction

FROM php:8.4-cli-alpine
RUN docker-php-ext-install pdo_mysql
WORKDIR /app
COPY . .
COPY --from=composer-build /app/vendor /app/vendor
COPY --from=node-build /app/public/build /app/public/build
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
EXPOSE 8000
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
