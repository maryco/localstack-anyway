FROM php:8.2-fpm-alpine3.18
COPY php.ini /usr/local/etc/php/

RUN apk update \
  && apk --no-cache add libzip-dev && docker-php-ext-install zip \
  && docker-php-ext-install pcntl pdo_mysql bcmath opcache

#Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') !== trim(file_get_contents('https://composer.github.io/installer.sig'))) { echo 'ERROR: Invalid installer signature' . PHP_EOL; unlink('/tmp/composer-setup.php'); exit(1); }"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin

WORKDIR /var/www/server
