FROM php:8.0-fpm

# ENV
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_NO_INTERACTION 1
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV PATH=/var/www/rito_backend/vendor/bin:${PATH}

# Setup wait-for-it
COPY wait-for-it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it

# Packages & PHP Extensions
RUN apt-get update && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip netcat libxml2-dev libpq-dev libzip-dev && \
    pecl install apcu && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql && \
    docker-php-ext-enable apcu pdo_pgsql sodium && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Setup the Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Set user
RUN usermod -u 1000 www-data
USER www-data

# Copy files and set workdir
COPY --chown=www-data:www-data . /var/www/rito_backend
WORKDIR /var/www/rito_backend/