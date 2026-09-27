FROM php:8.3-fpm-bookworm AS build

RUN apt-get update && apt-get install -y --no-install-recommends \
        curl \
        git \
        unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libxml2-dev \
        libzip-dev \
        $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        exif \
        gd \
        mbstring \
        opcache \
        pcntl \
        pdo_mysql \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --no-scripts

COPY . .
RUN composer dump-autoload --no-dev --optimize --no-interaction


FROM php:8.3-fpm-bookworm AS runtime

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr

RUN apt-get update && apt-get install -y --no-install-recommends \
        curl \
        gettext-base \
        nginx \
        libfreetype6 \
        libjpeg62-turbo \
        libonig5 \
        libpng16-16 \
        libxml2 \
        libzip4 \
    && rm -f /etc/nginx/sites-enabled/default \
    && rm -rf /var/lib/apt/lists/*

COPY --from=build /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=build /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

RUN printf '%s\n' \
        'opcache.enable=1' \
        'opcache.memory_consumption=128' \
        'opcache.interned_strings_buffer=16' \
        'opcache.max_accelerated_files=20000' \
        'opcache.validate_timestamps=0' \
        > /usr/local/etc/php/conf.d/opcache-recommended.ini

WORKDIR /var/www

COPY --from=build --chown=www-data:www-data /var/www /var/www
COPY .render/nginx.conf /etc/nginx/templates/default.conf.template
COPY docker/entrypoint.sh /usr/local/bin/laravel-entrypoint

RUN mkdir -p \
        storage/app/public \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
        public/img/profiles \
        public/img/logos \
        public/img/qr \
        public/img/gallery \
        public/img/bg \
        public/audio \
    && chown -R www-data:www-data storage bootstrap/cache public/img public/audio \
    && chmod -R ug+rwX storage bootstrap/cache public/img public/audio \
    && chmod +x /usr/local/bin/laravel-entrypoint

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/laravel-entrypoint"]