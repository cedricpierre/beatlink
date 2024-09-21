FROM php:8.2-apache-buster

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions @composer-2.6.5 bcmath mbstring pdo_mysql pdo_pgsql sodium mysqli zip exif pcntl gd memcached

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring
RUN docker-php-ext-enable intl mbstring

RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_mysql

RUN curl -sL https://deb.nodesource.com/setup_18.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install nodejs -yq
RUN node -v

RUN sed -i "s/Listen 80/Listen 8080/" /etc/apache2/ports.conf

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV PHP_MEMORY_LIMIT=1024M

COPY . /var/www/html

WORKDIR /var/www/html

RUN composer install --optimize-autoloader

RUN php artisan config:cache && \
    php artisan cache:clear && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    chmod 777 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

RUN npm ci
