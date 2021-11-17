FROM node

WORKDIR /var/www/laravel-docker/1

RUN npm install \
    && export NODE_OPTIONS=--openssl-legacy-provider \
    && npm run dev
