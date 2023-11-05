FROM php:8.2-apache

# Install necessary packages
RUN apt-get update && apt-get install -y \
  libpq-dev \
  git \
  && docker-php-ext-install pdo_pgsql

# Copy Apache dependencies
COPY ./html /var/www/html

# Copy Racket dependencies
COPY ./websocket /var/www/websocket
COPY ./start.sh /start.sh
COPY ./composer.json /var/www/websocket/composer.json
COPY ./vendor /var/www/websocket/vendor

# Install Ratchet
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Apache, Ratchet ports
EXPOSE 80 8091

# Allow apache router
RUN a2enmod rewrite && service apache2 restart


WORKDIR /var/www/html

# Run Ratchet
CMD sh /start.sh && /usr/sbin/apache2ctl -D FOREGROUND 
