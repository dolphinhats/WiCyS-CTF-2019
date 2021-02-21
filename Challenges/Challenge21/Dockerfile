FROM php:7.2-apache

WORKDIR "/var/www/html/"

COPY . /var/www/html/

RUN apt-get update -y && apt-get install build-essential curl -y 
RUN g++ main.cpp main.h -o main -fno-stack-protector



RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && sed -i 's/^Listen 80/ Listen 8006/g' /etc/apache2/ports.conf \
    && sed -i 's/^\#ServerName www\.example\.com/ ServerName localhost\:8006/g' /etc/apache2/sites-enabled/000-default.conf \
    && sed -i.old '1s;^;<VirtualHost *:8006>;' /etc/apache2/sites-enabled/000-default.conf \ 
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/ \
    && chmod 000 main.h \
    && chmod -R 000 /tmp \
    && useradd -G www-data ctf_warrior
EXPOSE 8006
USER ctf_warrior

