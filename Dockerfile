FROM php:8.1.1-fpm 
#fpm imagem + leve
RUN apt-get update && apt-get install -y git

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www