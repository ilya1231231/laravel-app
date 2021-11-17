FROM php:8.0-fpm

WORKDIR /var/www/laravel-docker

COPY ./ /var/www/laravel-docker

RUN apt-get update \
    && docker-php-ext-install pdo pdo_mysql \
