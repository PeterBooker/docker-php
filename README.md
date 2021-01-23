# Docker PHP
Range of PHP Docker images (WordPress, Laravel).

## WordPress

Follows recommendations by the WordPress [Hosting Handbook](https://make.wordpress.org/hosting/handbook/handbook/server-environment/). Created for use with [WPDev](https://github.com/PeterBooker/wpdev) a docker-compose based local development environment for WordPress.

```
peterbooker/phpwp:7.0-fpm
peterbooker/phpwp:7.3-fpm
peterbooker/phpwp:7.4-fpm
peterbooker/phpwp:8.0-fpm
```

I primarily use the `7.4-fpm` tag as it is the most well featured image, with support for `imagemagik`, `redis` and `xdebug`.

## Laravel

Follows the Laravel [Server Requirements](https://laravel.com/docs/5.8/installation#server-requirements). Created for use with [LaravelDev](https://github.com/PeterBooker/laraveldev) a docker-compose based local development environment for Laravel.

```
peterbooker/phplaravel:7.3-fpm
```

## License

Licensed under MIT.