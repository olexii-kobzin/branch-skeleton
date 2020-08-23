FROM php:7.4-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    curl \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mbstring zip

RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

RUN chown -R www:www /var/www

USER www

EXPOSE 9000
CMD ["php-fpm"]