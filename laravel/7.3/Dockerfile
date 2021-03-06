FROM php:7.3-fpm-alpine

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
    && docker-php-ext-install iconv \
    && docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN pecl install imagick \
    && pecl install redis

RUN docker-php-ext-enable imagick \
    && docker-php-ext-enable redis

RUN docker-php-ext-install \
    curl \
    iconv \
    mbstring \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    pdo_sqlite \
    pcntl \
    tokenizer \
    xml \
    zip \
    gd \
    intl

RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN { \
    echo 'upload_max_filesize = 128M'; \
    echo 'post_max_size = 128M'; \
    echo 'memory_limit = 1G'; \
    echo 'max_execution_time = 600'; \
    echo 'max_input_vars = 5000'; \
    } > /usr/local/etc/php/conf.d/0-upload_large_dumps.ini

RUN apk del -f .build-deps

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

VOLUME /var/www/html

ENTRYPOINT ["php-fpm"]

EXPOSE 9000
