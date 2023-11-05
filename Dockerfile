FROM php:8.2-apache

# Install necessary packages
RUN apt-get update && apt-get install -y \
  libpq-dev \
  git \
  net-tools \
  && docker-php-ext-install pdo_pgsql \
  && docker-php-ext-install sockets

# Copy Apache configuration file into the Docker image
COPY ./start.sh /start.sh
COPY ./html /var/www/html
COPY ./websocket /var/www/websocket

# Copy composer.json into the Docker image and install dependencies
COPY ./composer.json /var/www/websocket/composer.json
COPY ./vendor /var/www/websocket/vendor

# Install Ratchet
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Apache, Ratchet ports
EXPOSE 80 8091

# Allow apache router
RUN a2enmod rewrite && a2enmod proxy \
   && a2enmod proxy_http \
   && a2enmod proxy_wstunnel \
   && service apache2 restart

# Run Ratchet

WORKDIR /var/www/html
