FROM php:8.2-apache
COPY ./html /var/www/html
EXPOSE 80
WORKDIR /var/www/html

