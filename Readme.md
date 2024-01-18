### Configuration de Docker pour Laravel Localement

#### Étape 1: Installation de Docker

Assurez-vous que Docker est installé sur votre machine. Vous pouvez télécharger Docker sur [le site officiel de Docker](https://www.docker.com/get-started).

#### Étape 2: Initialisation d'un Projet Laravel

```bash
composer create-project --prefer-dist laravel/laravel nom-du-projet
cd nom-du-projet
```

#### Étape 3: Configuration des Fichiers Docker

Créez un fichier `Dockerfile` à la racine du projet :

```dockerfile
# Utilisez une image Laravel prête à l'emploi
FROM php:8.1-fpm-alpine

# Installez les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql sockets

# Installez Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

# Copiez les fichiers du projet dans le conteneur
WORKDIR /app
COPY . .

# Installez les dépendances du projet
RUN composer install
```

Créez un fichier `docker-compose.yml` à la racine du projet :

```yaml
version: '3.8'

services:
    app:
        container_name: nom-du-projet
        build:
            context: .
            dockerfile: Dockerfile
        command: 'php artisan serve --host=0.0.0.0'
        volumes:
            - .:/app
        ports:
            - 8000:8000
```

#### Étape 4: Construction et Exécution des Conteneurs

```bash
docker-compose up --build
```

Votre application Laravel sera accessible à l'adresse `http://localhost:8000`.

### Déploiement sur un Serveur Distant

#### Étape 1: Configuration du Serveur

Assurez-vous que votre serveur distant a Docker installé et une connexion SSH configurée.

#### Étape 2: Copie des Fichiers

Utilisez `scp` pour copier les fichiers de votre projet Laravel vers le serveur distant :

```bash
scp -r -P PORT_DU_SSH . debian@ADRESSE_IP_SERVEUR:/home/debian/nom-du-projet
```

#### Étape 3: Connexion au Serveur

Connectez-vous au serveur via SSH :

```bash
ssh -p PORT_DU_SSH debian@ADRESSE_IP_SERVEUR
```

#### Étape 4: Construction et Exécution des Conteneurs sur le Serveur

```bash
cd /home/debian/nom-du-projet
docker-compose up --build -d
```

Votre application Laravel sera maintenant accessible à l'adresse du serveur distant.

### Remarques Importantes

- Assurez-vous que le port spécifié dans `docker-compose.yml` est accessible sur le serveur.
- Configurez l'environnement de production dans Laravel avant de déployer en production.
- Pour une utilisation en production, envisagez d'utiliser un serveur web comme Nginx ou Apache en conjonction avec PHP-FPM.

N'oubliez pas d'ajuster ces étapes en fonction de votre configuration spécifique.

sudo docker-compose exec finac php artisan migrate --database=mysql --force

sudo systemctl stop apache2.service

docker-compose up --build -d

lancer les migrations

