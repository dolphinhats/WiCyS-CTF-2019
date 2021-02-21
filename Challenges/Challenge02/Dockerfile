FROM php:7.2-apache

WORKDIR "/var/www/html/"

COPY . /var/www/html/

RUN apt-get update && apt-get install -y iputils-ping curl \
    && apt-get install -y cron


RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf \
    && sed -i 's/^Listen 80/ Listen 8002/g' /etc/apache2/ports.conf \
    && sed -i 's/^\#ServerName www\.example\.com/ ServerName localhost\:8002/g' /etc/apache2/sites-enabled/000-default.conf \ 
    && sed -i.old '1s;^;<VirtualHost *:8002>;' /etc/apache2/sites-enabled/000-default.conf \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/ \
    && chmod -R 733 /var/www/html/tmp/ \
    && chmod -R 000 /tmp \ 
    && useradd -G www-data ctf_warrior  
EXPOSE 8002
USER ctf_warrior