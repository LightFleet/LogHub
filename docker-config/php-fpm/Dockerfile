FROM php:8.0.5-fpm
WORKDIR "/application"

RUN apt-get update

RUN apt-get install unzip tar -y

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
