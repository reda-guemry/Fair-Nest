

<<<<<<< HEAD
FROM php:8.2-fpm 
=======
FROM php:8.4-fpm
>>>>>>> feature/Message

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

<<<<<<< HEAD
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html/storage
=======
>>>>>>> feature/Message


RUN composer install --no-interaction --prefer-dist --optimize-autoloader

<<<<<<< HEAD
=======
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
&& apt-get install -y nodejs

RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html/storage


>>>>>>> feature/Message
EXPOSE 9000

CMD ["php-fpm"]


<<<<<<< HEAD
=======

>>>>>>> feature/Message
