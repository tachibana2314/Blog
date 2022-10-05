cd /usr/share/nginx/html/chateraise-web

composer install
composer dump-autoload

chmod -R 777 storage

php /usr/share/nginx/html/chateraise-web/artisan cache:clear
php /usr/share/nginx/html/chateraise-web/artisan config:clear
php /usr/share/nginx/html/chateraise-web/artisan view:clear

rm -rf /usr/share/nginx/html/chateraise-web/bootstrap/cache/*.php
rm -rf /usr/share/nginx/html/chateraise-web/storage/framework/cache/*.php
rm -rf /usr/share/nginx/html/chateraise-web/storage/framework/views/*.php

php artisan migrate --force
