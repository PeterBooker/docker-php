FROM devilbox/php-fpm:8.1-work

LABEL maintainer="Peter Booker <mail@peterbooker.com>"

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

VOLUME /var/www/html

CMD ["php-fpm"]

EXPOSE 9000 9003
