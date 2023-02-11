FROM php:8.2-fpm-alpine



RUN apk add --no-cache $PHPIZE_DEPS \
  bash \
  wget \
  git \
  unzip \
  rabbitmq-c-dev \
  php-pdo \
  libpq-dev \
  php-pdo_pgsql \
  && docker-php-ext-install \
  pdo \
  pdo_pgsql \
&& pecl install amqp \
&& docker-php-ext-enable amqp \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

