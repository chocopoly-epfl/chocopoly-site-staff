FROM php:8.1-apache-bullseye

# install php-mysql

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY src /var/www/html

EXPOSE 80
