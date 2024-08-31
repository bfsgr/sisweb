#!/bin/bash

cd /var/www/html

# wait for mysql to start
while ! mysqladmin ping -h"mysql" --silent; do
    sleep 1
done

# migrate database
php artisan migrate --force

php artisan db:seed --force

# start the server
apachectl -D FOREGROUND
