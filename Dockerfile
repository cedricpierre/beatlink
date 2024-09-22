FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive
ARG MYSQL_CLIENT="mysql-client"
ARG POSTGRES_VERSION=15

# Install dependencies
RUN apt update
RUN apt install -y software-properties-common
RUN add-apt-repository -y ppa:ondrej/php
RUN apt update
RUN apt install -y php8.3\
    php8.3-cli\
    php8.3-common\
    php8.3-fpm\
    php8.3-mysql\
    php8.3-pgsql\
    php8.3-zip\
    php8.3-gd\
    php8.3-mbstring\
    php8.3-curl\
    php8.3-xml\
    php8.3-bcmath\
    php8.3-pdo

RUN apt-get update \
    && apt-get install -y $MYSQL_CLIENT \
    && apt-get install -y postgresql-client-$POSTGRES_VERSION \

# Install php-fpm
RUN apt install -y php8.3-fpm php8.3-cli

# Install composer
RUN apt install -y curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install nodejs
RUN apt install -y ca-certificates gnupg
RUN mkdir -p /etc/apt/keyrings
RUN curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg
ENV NODE_MAJOR=20
RUN echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list
RUN apt update
RUN apt install -y nodejs
RUN npm install -g npm
# Install nginx
RUN apt install -y nginx
COPY ./docker/8.3/nginx.conf /etc/nginx/sites-available/default

COPY . /var/www/html
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

RUN rm -rf node_modules \
    && rm package-lock.json

RUN composer install

RUN npm i && npm run build

RUN chmod 777 -R storage

EXPOSE 80/tcp

COPY ./docker/8.3/start.sh start.sh

RUN chmod +x start.sh

CMD ["sh", "start.sh"]
