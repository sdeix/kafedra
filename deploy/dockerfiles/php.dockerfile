FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel



RUN docker-php-ext-install pdo pdo_mysql;

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer



