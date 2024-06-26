FROM php:8.2-apache
RUN a2enmod rewrite
ARG user
ARG uid
RUN apt update && apt install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev
RUN yes '' | pecl install mongodb && docker-php-ext-enable mongodb
RUN apt clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY README.md /var/www/html
RUN cd /var/www/html
WORKDIR /var/www/html
#RUN composer install