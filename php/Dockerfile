FROM php:8.1-fpm

ENV BUILD_DEPS 'autoconf git gcc g++ make bash'

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli
RUN apt-get update
RUN apt-get install -y iputils-ping net-tools
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libpq-dev
RUN apt-get install -y  libsasl2-dev\
                        libssl-dev\
                        libzip-dev\
                        zip unzip git
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN pecl install -o -f redis mcrypt-1.0.6 \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis
RUN apt-get update && apt-get install -y --no-install-recommends\
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-enable mcrypt
RUN docker-php-ext-install zip
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql pgsql bcmath