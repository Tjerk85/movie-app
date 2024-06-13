FROM php:8.3-fpm-alpine3.19

ARG BUILD_GID=1000
ARG BUILD_UID=1000

# Install packages
RUN apk --update --no-cache add wget \
    curl \
    git \
    grep \
    build-base \
    libmcrypt-dev \
    libxml2-dev \
    imagemagick-dev \
    pcre-dev \
    libtool \
    make \
    autoconf \
    g++ \
    cyrus-sasl-dev \
    libgsasl-dev \
    nano \
    libpng-dev \
    libzip-dev \
    openldap-dev \
    shadow \
    patch \
    chromium

RUN apk update && apk add nodejs-current npm

RUN groupdel dialout
RUN groupmod -g ${BUILD_GID} www-data
RUN usermod -s /bin/sh -g ${BUILD_GID} -u ${BUILD_UID} www-data

# Install php modules
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mcrypt redis pdo_mysql opcache gd zip exif bcmath sodium zip intl

# todo: https://github.com/Imagick/imagick/issues/643 for imagick issue with php 8.3

RUN curl -L -o /tmp/imagick.tar.gz https://github.com/Imagick/imagick/archive/7088edc353f53c4bc644573a79cdcd67a726ae16.tar.gz \
    && tar --strip-components=1 -xf /tmp/imagick.tar.gz \
    && phpize \
    && ./configure \
    && make \
    && make install \
    && echo "extension=imagick.so" > /usr/local/etc/php/conf.d/ext-imagick.ini \
    && rm -rf /tmp/* \

# todo end

RUN apk update && \
    apk add mysql-client

RUN apk add --update linux-headers

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal" >> \
/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install Yarn
RUN npm install -g yarn

# Set the locale
ENV MUSL_LOCALE_DEPS cmake make musl-dev gcc gettext-dev libintl
ENV MUSL_LOCPATH /usr/share/i18n/locales/musl
RUN apk add --no-cache \
    $MUSL_LOCALE_DEPS \
    && wget https://gitlab.com/rilian-la-te/musl-locales/-/archive/master/musl-locales-master.zip \
    && unzip musl-locales-master.zip \
      && cd musl-locales-master \
      && cmake -DLOCALE_PROFILE=OFF -D CMAKE_INSTALL_PREFIX:PATH=/usr . && make && make install \
      && cd .. && rm -r musl-locales-master
ENV LANG=nl_NL.UTF-8 \
    LANGUAGE=nl_NL.UTF-8 \
    LC_TIME=nl_NL.UTF-8 \
    LC_ALL=nl_NL.UTF-8

# Cleanup
RUN rm -R /var/cache/apk \
 && apk del --purge autoconf g++ make

# Copy configuration
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Copy files to working directory
RUN mkdir -p /var/www/html && chown -R www-data:www-data /var/www/html

USER www-data

EXPOSE 9000
CMD ["php-fpm"]
