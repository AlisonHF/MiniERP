FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli && a2enmod rewrite

WORKDIR /var/www/html

EXPOSE 80

RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Necessário para o htaccess
CMD ["sh", "-c", "chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs && apache2-foreground"]
