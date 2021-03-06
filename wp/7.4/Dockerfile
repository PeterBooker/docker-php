FROM php:7.4-fpm-alpine

LABEL maintainer="Peter Booker <mail@peterbooker.com>"

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    curl-dev \
    imagemagick-dev \
    libtool \
    libxml2-dev \
    postgresql-dev \
    sqlite-dev

RUN apk add --no-cache \
    curl \
    git \
    imagemagick \
    mysql-client \
    postgresql-libs \
    libintl \
    libpng \
    libpng-dev \
    icu \
    icu-dev \
    libzip-dev

RUN apk add --no-cache \
    freetype \
    libpng \
    libjpeg-turbo \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    && docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/ \
    && docker-php-ext-install gd

RUN docker-php-source extract && \
    pecl install imagick xdebug redis && \
    docker-php-ext-enable imagick xdebug redis && \
    docker-php-source delete && \
    docker-php-ext-install pcntl zip intl mysqli pdo pdo_mysql && \
    rm -rf /tmp/*

RUN { \
    echo 'opcache.memory_consumption = 128'; \
    echo 'opcache.interned_strings_buffer = 8'; \
    echo 'opcache.max_accelerated_files = 4000'; \
    echo 'opcache.revalidate_freq = 2'; \
    echo 'opcache.fast_shutdown = 1'; \
    echo 'opcache.enable_cli = 1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN { \
    echo 'upload_max_filesize = 128M'; \
    echo 'post_max_size = 128M'; \
    echo 'memory_limit = 1G'; \
    echo 'max_execution_time = 600'; \
    echo 'max_input_vars = 5000'; \
    } > /usr/local/etc/php/conf.d/0-upload_large_dumps.ini

RUN { \
    echo 'zend_extension = xdebug'; \
    echo 'xdebug.mode = develop,debug'; \
    echo 'xdebug.start_with_request = yes'; \
    echo 'xdebug.client_port = 9003'; \
    echo 'xdebug.client_host = host.docker.internal'; \
    } > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apk del -f .build-deps

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

VOLUME /var/www/html

CMD ["php-fpm"]

EXPOSE 9000 9003
