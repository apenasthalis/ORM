FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip && \
    docker-php-ext-install pdo pdo_pgsql

COPY ./src /var/www/html/crud

RUN set -eux; \
    EXPECTED_HASH="$(curl -s https://composer.github.io/installer.sig)"; \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
    ACTUAL_HASH="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"; \
    if [ "$EXPECTED_HASH" != "$ACTUAL_HASH" ]; then \
        echo 'ERROR: Invalid installer hash'; \
        rm composer-setup.php; \
        exit 1; \
    fi; \
    php composer-setup.php --quiet; \
    rm composer-setup.php; \
    mv composer.phar /usr/local/bin/composer

    WORKDIR /var/www/html/crud
   # Inicializa o Composer e instala as dependências
RUN composer init --no-interaction --name="meu-projeto/app" && \
composer require psr/log # Exemplo de dependência

# Instala as dependências do Composer
RUN composer install

    
    # Define o diretório de trabalho padrão para o contêiner
    WORKDIR /var/www/html
