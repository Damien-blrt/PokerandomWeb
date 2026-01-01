FROM php:8.2-apache

# Activer mod_rewrite
RUN a2enmod rewrite

# Changer le DocumentRoot vers /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Installer composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier juste composer.json et composer.lock pour profiter du cache Docker
COPY composer.json composer.lock ./

# Installer les dépendances dans l'image
RUN composer install --no-dev --optimize-autoloader

# Copier le reste du projet
COPY . .

EXPOSE 80
