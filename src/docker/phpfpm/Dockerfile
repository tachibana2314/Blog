FROM php:7.4-fpm-buster

#app source
WORKDIR /var/www/html
#COPY . /var/www/html


# install dependent packages...
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd \
  && apt-get -y install git libicu-dev libonig-dev libzip-dev unzip locales \
  # && pecl install xdebug \
  && pecl install grpc \
  && apt-get install -y imagemagick libmagickwand-dev \
  && pecl install imagick \
  && docker-php-ext-enable imagick \
  && docker-php-ext-install zip intl pdo_mysql \
  && docker-php-ext-enable grpc

RUN echo "file_uploads = On\n" \
    "memory_limit = -1M\n" \
    "upload_max_filesize = 500M\n" \
    "post_max_size = 500M\n" \
    "max_execution_time = 600\n" \
    > /usr/local/etc/php/conf.d/uploads.ini


# provide root permission to composer
ENV COMPOSER_ALLOW_SUPERUSER 1 \
    COMPOSER_NO_INTERACTION 1

# install composer...
COPY --from=composer:1.9.3 /usr/bin/composer /usr/bin/composer

RUN set -xeu \

# FROM php:7.4.0-fpm-alpine

# # RUN apk add autoconf build-base
# # RUN pecl install xdebug
# # RUN docker-php-ext-enable xdebug

# # Composer
# ENV COMPOSER_ALLOW_SUPERUSER 1
# COPY --from=composer /usr/bin/composer /usr/bin/composer
# RUN set -eux \
#   && composer global require hirak/prestissimo

# # 依存パッケージインストール
# RUN set -eux \
#   && apk add --update --no-cache libzip-dev \
#   && docker-php-ext-install zip pdo_mysql bcmath zip

# # app source
# WORKDIR /var/www/html
# COPY . /var/www/html

# # Composer install実行
# RUN set -eux \
#   && composer install \
#   && chmod -R a=rwX /var/www/html/storage


# RUN apk add --no-cache imagemagick \
#     && apk add --no-cache --virtual .phpize-deps imagemagick-dev build-base autoconf libpng-dev libjpeg-turbo-dev libxml2-dev \
#     && pecl install imagick \
#     && docker-php-ext-enable imagick \
#     && apk del .phpize-deps
