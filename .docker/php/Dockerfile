FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip
# install other ext
RUN docker-php-ext-configure gd --with-freetype --with-webp --with-jpeg && docker-php-ext-install gd
# install other ext
RUN pecl install redis && docker-php-ext-enable redis

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# añadir usuario para la aplicacion laravel
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# copiar los permisos del directorio de la aplicación
COPY --chown=www:www . /var/www

# cambiar usuario actual a www
USER www

# abrir puerto 9000 y empezar proceso php-fpm server
EXPOSE 9000
CMD ["php-fpm"]



