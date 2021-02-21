FROM php:7.2-apache

WORKDIR "/var/www/html/"

COPY . /var/www/html/

RUN apt-get update && apt-get install -y curl

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
