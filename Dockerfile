FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y  \
    libmcrypt-dev \
    sqlite3 \
    default-mysql-client \
    libsqlite3-dev \
    libonig-dev \
    libzip-dev \
    zip \
    nodejs \
    npm

RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY app app
COPY bootstrap bootstrap
COPY config config
COPY database database
COPY lang lang
COPY public public
COPY resources resources
COPY routes routes
COPY storage storage
COPY composer.json .
COPY composer.lock .
COPY package.json .
COPY package-lock.json .
COPY vite.config.js .
COPY artisan .
COPY .env.production .env
COPY .htaccess .

RUN chown -R www-data:www-data /var/www/html

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

USER www-data

RUN composer install
RUN npm config set cache /var/www/html/.npm
RUN npm install
RUN npm run build

RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan event:cache
RUN php artisan route:cache
RUN php artisan view:cache

COPY entrypoint.sh /usr/local/bin/

EXPOSE 80

CMD ["bash", "/usr/local/bin/entrypoint.sh"]
