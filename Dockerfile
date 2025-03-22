# Offizielles PHP-FPM-Image mit der neuesten Version verwenden
FROM php:8.3-fpm

# Xdebug-Erweiterung installieren
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Konfigurationsdatei für Xdebug erstellen
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Arbeitsverzeichnis setzen
WORKDIR /var/www/html

# Standardbefehl für den Container
CMD ["php-fpm"]
