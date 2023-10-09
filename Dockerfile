FROM php:8.2-apache
COPY . /var/www/html
EXPOSE 80
WORKDIR /usr/src/app

#docker run -p 8080:80 --name php-container -d php-project