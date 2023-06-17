#!/bin/sh
## for starting project you need to run this bash file
cp .env.example .env
composer install
chmod 775 -R storage/ vendor/
chown -R $USER:www-data storage
chown -R $USER:www-data bootstrap/cache
php artisan storage:link
php artisan key:generate
composer dump-autoload
