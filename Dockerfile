FROM php:8.0.3-apache

RUN mkdir /var/www/app
COPY . /var/www/app

COPY app.conf /etc/apache2/sites-available/app.conf
RUN a2dissite 000-default.conf
RUN a2ensite app.conf
RUN a2enmod rewrite
