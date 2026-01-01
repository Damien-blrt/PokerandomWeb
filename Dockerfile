FROM php:8.2-apache

# Activer mod_rewrite (AltoRouter en a besoin)
RUN a2enmod rewrite

# Changer le DocumentRoot vers /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copier le projet
COPY . /var/www/html/

EXPOSE 80
