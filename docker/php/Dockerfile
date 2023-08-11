FROM php:8.1.4-fpm

COPY ./conf/php.ini /usr/local/etc/php/

RUN apt update
RUN apt install -y \
    librabbitmq-dev \
    libpng-dev \
    libzip-dev \
    libxml2-dev \
    libpq-dev \
    libicu-dev \
    && docker-php-ext-install pdo_mysql \    
    && docker-php-ext-install zip exif pcntl

RUN apt-get update && apt-get install -y curl gnupg
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

RUN docker-php-ext-install \
        intl \
        pdo \
        pdo_pgsql \
        xml \
        zip \
        gd \
        soap \
        bcmath \
        sockets

RUN pecl install amqp xdebug

RUN docker-php-ext-enable --ini-name 05-opcache.ini opcache amqp xdebug

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

RUN curl https://cs.symfony.com/download/php-cs-fixer-v2.phar --output /usr/local/bin/php-cs-fixer
RUN chmod +x /usr/local/bin/php-cs-fixer

RUN useradd -ms /sbin/nologin alexander

WORKDIR "/application"
