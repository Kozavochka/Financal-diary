FROM php:8.3-fpm as php

#RUN apt-get update -y
#RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN apt-get update \
    && apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        zlib1g-dev \
        libpq-dev \
        libzip-dev

RUN pecl install xhprof

#RUN docker-php-ext-install pdo pdo_mysql zip bcmath gd
RUN apt update && \
    apt -y --no-install-recommends install libonig-dev libxml2-dev zlib1g-dev libzip-dev libcurl4-openssl-dev && \
    docker-php-ext-install mysqli bcmath mbstring xml ctype zip pdo_mysql curl filter && \
    docker-php-ext-install pdo_pgsql
#Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis xhprof opcache

WORKDIR /var/www
COPY . .
RUN chmod 777 .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#ENV PORT=8000

