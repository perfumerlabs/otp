#!/usr/bin/env bash

set -x \
&& rm -rf /etc/nginx \
&& rm -rf /etc/supervisor \
&& mkdir /run/php

set -x \
&& cp -r "/usr/share/container_config/nginx" /etc/nginx \
&& cp -r "/usr/share/container_config/supervisor" /etc/supervisor

OTP_HOST_SED=${OTP_HOST//\//\\\/}
OTP_HOST_SED=${OTP_HOST_SED//\./\\\.}
OTP_QUEUE_URL_SED=${OTP_QUEUE_URL//\//\\\/}
OTP_QUEUE_URL_SED=${OTP_QUEUE_URL_SED//\./\\\.}
OTP_SMS_URL_SED=${OTP_SMS_URL//\//\\\/}
OTP_SMS_URL_SED=${OTP_SMS_URL_SED//\./\\\.}
OTP_EMAIL_URL_SED=${OTP_EMAIL_URL//\//\\\/}
OTP_EMAIL_URL_SED=${OTP_EMAIL_URL_SED//\./\\\.}
PG_HOST_SED=${PG_HOST//\//\\\/}
PG_HOST_SED=${PG_HOST_SED//\./\\\.}
PG_PASSWORD_SED=${PG_PASSWORD//\//\\\/}
PG_PASSWORD_SED=${PG_PASSWORD_SED//\./\\\.}

sed -i "s/error_log = \/var\/log\/php7.4-fpm.log/error_log = \/dev\/stdout/g" /etc/php/7.4/fpm/php-fpm.conf
sed -i "s/;error_log = syslog/error_log = \/dev\/stdout/g" /etc/php/7.4/fpm/php.ini
sed -i "s/;error_log = syslog/error_log = \/dev\/stdout/g" /etc/php/7.4/cli/php.ini
sed -i "s/log_errors = Off/log_errors = On/g" /etc/php/7.4/cli/php.ini
sed -i "s/log_errors = Off/log_errors = On/g" /etc/php/7.4/fpm/php.ini
sed -i "s/log_errors_max_len = 1024/log_errors_max_len = 0/g" /etc/php/7.4/cli/php.ini
sed -i "s/user = www-data/user = otp/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/group = www-data/group = otp/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm = dynamic/pm = static/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm.max_children = 5/pm.max_children = ${PHP_PM_MAX_CHILDREN}/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;pm.max_requests = 500/pm.max_requests = ${PHP_PM_MAX_REQUESTS}/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/listen.owner = www-data/listen.owner = otp/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/listen.group = www-data/listen.group = otp/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;catch_workers_output = yes/catch_workers_output = yes/g" /etc/php/7.4/fpm/pool.d/www.conf

if [ $DEV != 'true' ]; then
  sed -i "s/\$this->addResources(__DIR__ \. '\/\.\.\/env\.php');//g" /opt/otp/src/Application.php
  sed -i "s/OTP_QUEUE_URL/$OTP_QUEUE_URL_SED/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/OTP_SMS_URL/$OTP_SMS_URL_SED/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/OTP_SMS_WORKER/$OTP_SMS_WORKER/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/OTP_EMAIL_URL/$OTP_EMAIL_URL_SED/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/OTP_EMAIL_WORKER/$OTP_EMAIL_WORKER/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/PG_HOST/$PG_HOST_SED/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/PG_PORT/$PG_PORT/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/PG_SCHEMA/$PG_SCHEMA/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/PG_DATABASE/$PG_DATABASE/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/PG_USER/$PG_USER/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/PG_PASSWORD/$PG_PASSWORD_SED/g" /opt/otp/src/Resource/config/resources_shared.php
  sed -i "s/PG_HOST/$PG_HOST_SED/g" /opt/otp/src/Resource/propel/connection/propel.php
  sed -i "s/PG_PORT/$PG_PORT/g" /opt/otp/src/Resource/propel/connection/propel.php
  sed -i "s/PG_DATABASE/$PG_DATABASE/g" /opt/otp/src/Resource/propel/connection/propel.php
  sed -i "s/PG_SCHEMA/$PG_SCHEMA/g" /opt/otp/src/Resource/propel/connection/propel.php
  sed -i "s/PG_USER/$PG_USER/g" /opt/otp/src/Resource/propel/connection/propel.php
  sed -i "s/PG_PASSWORD/$PG_PASSWORD_SED/g" /opt/otp/src/Resource/propel/connection/propel.php
fi

if [ $DEV = 'true' ]; then
  set -x \
  && cd /opt/otp \
  && cp env.example.php env.php \
  && cp propel.example.php propel.php
fi

set -x \
&& cd /opt/otp \
&& sudo -u otp php cli framework propel/migrate

touch /node_status_inited
