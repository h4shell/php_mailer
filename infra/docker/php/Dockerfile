FROM php:latest

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y git unzip p7zip-full

COPY php.ini /usr/local/etc/php/
COPY entrypoint.sh /usr/bin/