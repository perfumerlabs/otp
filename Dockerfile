FROM ubuntu:bionic

LABEL authors="Ilyas Makashev <mehmatovec@gmail.com>"

ENV TZ 'UTC'

RUN set -x \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone \
    && apt-get update \
    && apt-get install -y \
        ca-certificates \
        wget \
        locales \
        gnupg2 \
    && rm -rf /var/lib/apt/lists/* \
    && useradd -s /bin/bash -m otp \
    && echo "deb http://nginx.org/packages/ubuntu/ bionic nginx" > /etc/apt/sources.list.d/nginx.list \
    && echo "deb-src http://nginx.org/packages/ubuntu/ bionic nginx" >> /etc/apt/sources.list.d/nginx.list \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu bionic main" > /etc/apt/sources.list.d/php.list \
    && echo "deb-src http://ppa.launchpad.net/ondrej/php/ubuntu bionic main" >> /etc/apt/sources.list.d/php.list \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys ABF5BD827BD9BF62 \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C \
    && apt update \
    && apt install -y \
        nginx \
        php7.4 \
        php7.4-cli \
        php7.4-common \
        php7.4-curl \
        php7.4-fpm \
        php7.4-json \
        php7.4-opcache \
        php7.4-pgsql \
        php7.4-xml \
        supervisor \
        vim \
        iputils-ping \
        curl \
        git \
        zip \
        sudo \
        apt-transport-https

COPY project /opt/otp
COPY nginx /usr/share/container_config/nginx
COPY supervisor /usr/share/container_config/supervisor
COPY init.sh /usr/local/bin/init.sh
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

RUN set -x\
    && chown -R otp:otp /opt/otp \
    && cd /opt/otp \
    && sudo -u otp php composer.phar install --no-dev --prefer-dist \
    && chmod +x /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/init.sh

ENV PG_REAL_HOST ''
ENV PG_HOST postgresql
ENV PG_PORT 5432
ENV PG_DATABASE otp
ENV PG_SCHEMA public
ENV PG_USER postgres
ENV PG_PASSWORD postgres
ENV OTP_QUEUE_URL ''
ENV OTP_SMS_URL ''
ENV OTP_SMS_WORKER ''
ENV OTP_CALL_WORKER ''
ENV OTP_EMAIL_URL ''
ENV OTP_EMAIL_WORKER ''
ENV PHP_PM_MAX_CHILDREN 10
ENV PHP_PM_MAX_REQUESTS 500
ENV DEV false

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]