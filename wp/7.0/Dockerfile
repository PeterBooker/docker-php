FROM php:7.0-fpm-alpine

LABEL maintainer="Peter Booker <mail@peterbooker.com>"

RUN apk add --no-cache --virtual .build-deps \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev

RUN docker-php-ext-install \
    bcmath \
    mbstring \
    pdo \
    pdo_mysql \
    mysqli \
    opcache \
    exif

RUN docker-php-ext-enable \
    bcmath \
    mbstring \
    pdo \
    pdo_mysql \
    mysqli \
    opcache \
    exif

RUN apk add --no-cache --update \
    php7-xml \
    php7-xmlreader \
    php7-ftp \
    php7-json \
    php7-curl \
    php7-sockets \
    php7-zlib \
    php7-phar \
    php7-openssl \
    php7-zip \
    php7-dev \
    php7-exif \
    php7-fileinfo \
    mysql-client

RUN apk add --no-cache autoconf g++ make \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del autoconf g++ make \
    && rm -rf /tmp/* /var/cache/apk/*

RUN apk add --update --no-cache autoconf g++ libtool make pcre-dev imagemagick imagemagick-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apk del autoconf g++ libtool make \
    && rm -rf /tmp/* /var/cache/apk/*

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

RUN apk del --purge \
    *-dev

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

VOLUME /var/www/html

CMD ["php-fpm"]

EXPOSE 9000
