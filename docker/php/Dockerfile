FROM composer

FROM php:8.1.0-fpm

WORKDIR /var/www/

ENV ACCEPT_EULA=Y

########################################################################################################################
# Install system dependencies
########################################################################################################################
RUN apt-get update && \
    export DEBIAN_FRONTEND=noninteractive && \
    apt-get install -y --no-install-recommends \
    apt-utils \
    curl \
    libicu-dev \
    libcurl4-gnutls-dev \
    libpng-dev \
    libssl-dev \
    libxml2-dev \
    libpq-dev \
    openssl \
    tcpdump \
    telnet \
    unzip \
    wget && \
    rm -rf /var/lib/apt/lists/*

########################################################################################################################
# Install Docker-PHP Extensions, php 8.x and it's dependencies
########################################################################################################################
RUN docker-php-ext-install pdo \
    pdo_pgsql


########################################################################################################################
# Install Composer
########################################################################################################################
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


########################################################################################################################
# Laravel logs permission
########################################################################################################################
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 755 /var/www/storage /var/www/bootstrap/cache

RUN chown -Rf www-data:www-data storage/log

CMD ["php-fpm"]
