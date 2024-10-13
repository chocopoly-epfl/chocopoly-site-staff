FROM php:8.1-apache-bullseye

COPY php.ini $PHP_INI_DIR/conf.d/

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY src /var/www/html

EXPOSE 80
