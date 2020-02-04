FROM php:7.3-fpm-alpine

ARG user_uid

RUN apk add --update --no-cache --virtual build-dependencies git cmake make musl-dev gcc gettext-dev libintl && \
    cd /tmp && git clone https://github.com/rilian-la-te/musl-locales.git && cd /tmp/musl-locales && cmake . && make && make install && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    apk del build-dependencies && \
    rm -rf /tmp/* /var/cache/apk/*

RUN apk update && apk add --no-cache \
    bash \
    zip \
    wget \
    unzip \
    openssl \
    sqlite \
    sqlite-dev \
    freetype \
    freetype-dev && \
    rm -rf /tmp/* /var/cache/apk/* && \
    docker-php-ext-configure gd \
        --with-gd \
        --with-freetype-dir=/usr/include/ && \
    NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
    docker-php-ext-install -j${NPROC} \
        pdo \
        mbstring \
        tokenizer \
        bcmath && \
    apk del --no-cache \
        sqlite-dev && \
    rm -rf /tmp/* /var/cache/apk/*

RUN \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer && \
    apk del --no-cache wget

RUN if [ "$user_uid" != "0" ]; \
    then echo "Setting User ID and group ID"; \
    apk --no-cache add shadow && \
    usermod -u ${user_uid? invalid argument} www-data && \
    groupmod -g ${user_uid? invalid argument} www-data; \
    fi

USER www-data

WORKDIR /var/www/
