# docker/php/Dockerfile
FROM php:8.2-fpm-alpine

# Install common PHP extensions required for web development
RUN apk add --no-cache \
    autoconf \
    g++ \
    make \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zlib-dev \
    mysql-client \
    git \
    composer \
    nodejs \
    npm \
    icu-dev \
    libxml2-dev \
    curl-dev \
    sqlite-dev \
    sqlite \
    oniguruma-dev \
    ;

# Install PHP extensions
# IMPORTANT: 'pdo_sqlite' and 'sqlite3' are removed from this list,
# as they are typically bundled/pre-installed in php:fpm-alpine and cause conflicts when re-installed.
RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    gd \
    zip \
    intl \
    curl \
    mbstring \
    soap \
    xml \
    ;

# Optional: Install Xdebug for debugging (uncomment if needed)
# RUN pecl install xdebug \
#     && docker-php-ext-enable xdebug \
#     && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.idekey=VSCODE" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini