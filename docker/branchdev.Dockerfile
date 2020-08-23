FROM php:7.4-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libonig-dev libzip-dev curl zip unzip \
    git wget libfreetype6-dev libjpeg62-turbo-dev \
    libmcrypt-dev libpng-dev zlib1g-dev libicu-dev \
    g++ libmagickwand-dev --no-install-recommends libxml2-dev \
    && pecl install mcrypt-1.0.3\
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring  \
    && docker-php-ext-install zip \
    && docker-php-ext-enable mcrypt \
    && pecl install xdebug-2.9.6 \
    && docker-php-ext-enable xdebug

ADD ./app/docker/php/xdebug/php.ini /usr/local/etc/php/php.ini

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

RUN chown -R www:www /var/www

USER www

EXPOSE 9000
CMD ["php-fpm"]