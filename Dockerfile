FROM php:7.4.22-fpm-alpine

# Update app and set timezone
RUN apk update && apk add --no-cache tzdata \
    && cp /usr/share/zoneinfo/UTC /etc/localtime \
    && echo "UTC" > /etc/timezone

# Install dependencies
RUN apk add --update --no-cache autoconf g++ make openssl-dev libpng-dev libzip-dev nginx \
    && docker-php-ext-install gd zip bcmath sockets mysqli pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Redis
RUN pecl install redis && docker-php-ext-enable redis

# Install MongoDB
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Configure NGINX
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /home/source/main
