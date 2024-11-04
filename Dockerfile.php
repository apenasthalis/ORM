FROM php:8.3-fpm

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip && \
    docker-php-ext-install pdo pdo_pgsql

# Define o diretório de trabalho
WORKDIR /var/www/html/crud

# Copia todos os arquivos do diretório atual para o container
COPY . .

# Executa o Composer para instalar dependências
RUN composer install