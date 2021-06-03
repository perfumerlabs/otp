<?php

return [
    'propel' => [
        'bin'           => 'vendor/bin/propel',
        'project'       => 'otp',
        'database'      => 'pgsql',
        'dsn'           => 'pgsql:host=PG_HOST;port=PG_PORT;dbname=PG_DATABASE',
        'db_schema'     => 'PG_SCHEMA',
        'db_user'       => 'PG_USER',
        'db_password'   => 'PG_PASSWORD',
        'platform'      => 'pgsql',
        'config_dir'    => 'src/Resource/propel/connection',
        'schema_dir'    => 'src/Resource/propel/schema',
        'model_dir'     => 'src/Model',
        'migration_dir' => 'src/Resource/propel/migration',
        'migration_table' => 'otp_propel_migration',
    ],
    'pg' => [
        'real_host' => 'PG_REAL_HOST',
        'host' => 'PG_HOST',
        'port' => 'PG_PORT',
        'database' => 'PG_DATABASE',
        'schema' => 'PG_SCHEMA',
        'user' => 'PG_USER',
        'password' => 'PG_PASSWORD',
    ],
    'otp' => [
        'queue_url' => 'OTP_QUEUE_URL',
        'sms_url' => 'OTP_SMS_URL',
        'sms_worker' => 'OTP_SMS_WORKER',
        'call_worker' => 'OTP_CALL_WORKER',
        'email_url' => 'OTP_EMAIL_URL',
        'email_worker' => 'OTP_EMAIL_WORKER',
    ],
];
