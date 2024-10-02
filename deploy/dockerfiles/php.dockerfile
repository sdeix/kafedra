FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel



RUN docker-php-ext-install pdo pdo_mysql

RUN chmod -R 777 storage/
RUN chmod -R 777 storage
RUN sudo chmod -R 777 storage/