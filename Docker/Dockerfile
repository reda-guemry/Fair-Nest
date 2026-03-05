

FROM php:8.4-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \ 
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip



COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html



RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
&& apt-get install -y nodejs

RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html/storage

EXPOSE 9000

CMD ["php-fpm"]


