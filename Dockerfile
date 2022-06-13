FROM php:8.1-cli-alpine3.15 as build
RUN apk upgrade
RUN apk add bash
RUN apk add curl
RUN apk add mc
RUN apk add git

RUN git config --global --add safe.directory /emagia

# install composer, because we'll need it :)
RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-3.1.4 \
    && docker-php-ext-enable xdebug

COPY . /emagia
