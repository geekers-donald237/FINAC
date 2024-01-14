# Utilisez une image de PHP avec Apache
FROM php:8.2-apache

# Installez les dépendances nécessaires
RUN apt-get update \
    && apt-get install -y \
        git \
        zip \
        unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le composer.json et composer.lock
COPY composer.json composer.lock ./

# Installer les dépendances Composer
RUN composer install --no-scripts --no-autoloader


# Copier le reste des fichiers
COPY . .

# Charger l'autoloader et générer les fichiers d'environnement
RUN composer dump-autoload
RUN php artisan key:generate

#installer mysl
RUN docker-php-ext-install pdo_mysql

#Ajouter le pilote a l'image docker
RUN docker-php-ext-install mysqli pdo pdo_mysql

## launch data base migrations and seeders
#RUN php artisan migrate --seed

# Exposer le port 80
EXPOSE 80

# Commande pour démarrer le serveur Apache
CMD ["apache2-foreground"]
