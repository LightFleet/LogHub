FROM php:8.0.5-fpm
WORKDIR "/application"

# Install selected extensions and other stuff
RUN apt-get update
#    apt-get install lsb-release -y && \
#    add-apt-repository ppa:ondrej/php \

#RUN apt-get update \
#    && apt-get -y --no-install-recommends install  build-essential php8.0-pgsql php8.0-mysql php8.0-redis php8.0-xdebug php8.0-bcmath php8.0-imagick php8.0-gd php8.0-imap php8.0-intl php8.0-soap php8.0-yaml \
#    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN #apt-get -y install build-essential

#RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -
#RUN apt-get install npm -y
#
#RUN apt-get install unzip tar -y

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
