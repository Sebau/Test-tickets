FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    libonig-dev libxml2-dev \
    curl git libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip

RUN a2enmod rewrite

COPY . /var/www/html


WORKDIR /var/www/html


RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

EXPOSE 80