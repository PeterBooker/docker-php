#!/bin/sh

cd /var/www/adminer
if [[ ! -e adminer.php ]]; then
    wget https://github.com/vrana/adminer/releases/download/v4.7.1/adminer-4.7.1.php -O index.php
fi

exec "$@"