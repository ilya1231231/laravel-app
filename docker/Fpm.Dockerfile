FROM php:8.0-fpm

WORKDIR /var/www/laravel-docker


RUN apt-get update \
    && docker-php-ext-install pdo pdo_mysql

COPY ./ /var/www/laravel-docker

RUN chown -R www-data:www-data /var/www/laravel-docker

RUN apt-get install -y nodejs npm

RUN npm install

RUN npm run dev
