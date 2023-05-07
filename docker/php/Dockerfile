FROM php:8.1.18-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    libonig-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mbstring exif pcntl bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./src /hash-game

RUN adduser -u 1000 --shell /bin/bash admin
RUN chown -R admin:admin /hash-game
RUN chmod 755 /hash-game

USER admin
WORKDIR /hash-game