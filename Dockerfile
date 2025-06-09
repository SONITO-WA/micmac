# Utiliser l'image PHP avec Apache
FROM php:8.1-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Activer mod_rewrite pour Apache
RUN a2enmod rewrite

# Copier les fichiers du site dans le conteneur
COPY . /var/www/html/

# Donner les bonnes permissions
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/

# Exposer le port 80
EXPOSE 80

# Commande par défaut
CMD ["apache2-foreground"]