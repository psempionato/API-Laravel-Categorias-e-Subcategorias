FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libpq-dev libzip-dev unzip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_pgsql zip && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN groupadd -fg 1000 www \
&& useradd -p teste -ms /bin/bash -g 1000 -u 1000 www

RUN chown -R www:www /var/www/html

USER www

COPY . /var/www/html

EXPOSE 8000