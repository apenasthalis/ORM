FROM php:8.3-fpm

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip && \
    docker-php-ext-install pdo pdo_pgsql

COPY ./src /var/www/html/crud

CMD composer install