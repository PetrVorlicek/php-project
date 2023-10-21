FROM php:8.2-apache

# Install necessary packages
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Allow apache router
RUN a2enmod rewrite && service apache2 restart

COPY ./html /var/www/html
EXPOSE 80
WORKDIR /var/www/html

