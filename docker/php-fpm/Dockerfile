FROM php:8.1.7-fpm

ARG APP_DEBUG
ARG TZ

RUN apt update && apt install --no-install-recommends --no-install-suggests -y \
    git \
    curl \
    htop \
    libmemcached-dev \
    cron\
    unzip \
    nano \
    libicu-dev \
    zlib1g-dev \
    libssl-dev \
    pkg-config \
    libzip-dev \
    libpq-dev \
    librabbitmq-dev \
    libssh-dev

RUN apt clean && rm -rf /var/lib/apt/lists/*

RUN set -xe \
    && docker-php-ext-configure \
        intl \
    && docker-php-ext-install \
        intl \
        opcache \
        zip \
        pdo \
        pdo_mysql \
        bcmath \
        sockets \
    && pecl install \
        apcu \
        redis \
        memcached \
        amqp \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable \
        apcu \
        redis \
        memcached \
        amqp

RUN if [ "$APP_DEBUG" = "true" ] ; then pecl install xdebug ; docker-php-ext-enable xdebug ; fi

COPY php.ini /usr/local/etc/php/php.ini
RUN sed -i -e "s#TIMEZONE#$TZ#g" /usr/local/etc/php/php.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN mkdir -p /var/www/.composer && chown -R www-data /var/www/.composer

WORKDIR /var/www/highload

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
