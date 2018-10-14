FROM alpine:3.8 as base


ENV TIMEZONE UTC
ENV PHP_VER  7

RUN apk add --no-cache \
        php"$PHP_VER" \
        php"$PHP_VER"-mysqli \
        php"$PHP_VER"-fpm \
        php"$PHP_VER"-mbstring \
        php"$PHP_VER"-sockets \
        php"$PHP_VER"-xdebug \
        php"$PHP_VER"-intl \
        php"$PHP_VER"-mysqli \
        php"$PHP_VER"-curl \
        php"$PHP_VER"-ftp \
        php"$PHP_VER"-session \
        php"$PHP_VER"-gd \
        php"$PHP_VER"-json \
        php"$PHP_VER"-ctype \
        php"$PHP_VER"-xml \
        php"$PHP_VER"-dom \
        php"$PHP_VER"-iconv \
        php"$PHP_VER"-pdo \
        php"$PHP_VER"-pdo_mysql \
        php"$PHP_VER"-openssl \
        php"$PHP_VER"-phar \
        php"$PHP_VER"-zlib \
        php"$PHP_VER"-bcmath \
        php"$PHP_VER"-tokenizer \
        php"$PHP_VER"-simplexml \
        php"$PHP_VER"-fileinfo \
        openssh-client \
        openssl \
        composer \
        ca-certificates

RUN echo "${TIMEZONE}" > /etc/timezone \
    && sed -i "s|;*daemonize\s*=\s*yes|daemonize = no|g" /etc/php7/php-fpm.conf \
    && sed -i "s|;*listen\s*=\s*127.0.0.1:9000|listen = 9000|g" /etc/php7/php-fpm.d/www.conf \
    && sed -i "s|;*listen\s*=\s*/||g" /etc/php7/php-fpm.d/www.conf \
    && sed -i "s|;*date.timezone =.*|date.timezone = ${TIMEZONE}|i" /etc/php7/php.ini

WORKDIR /var/www/gocook

COPY bin /home/gocook/bin


CMD ["/home/gocook/bin/start.sh"]

ARG version
LABEL com.advr.version $version

FROM base as dev

ENV SYMFONY_ENV dev


FROM base as prod

ENV SYMFONY_ENV prod

#COPY bin /home/gocook/bin
#COPY src /var/www/gocook
#COPY --from=composer /vendor /var/www/gocook/vendor
#COPY --from=composer /usr/local/bin/composer /usr/local/bin/composer
