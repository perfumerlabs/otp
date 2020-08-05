<?php

return [
    'propel' => [
        'bin'           => 'vendor/bin/propel',
        'project'       => 'otp',
        'database'      => 'pgsql',
        'dsn'           => 'pgsql:host=PG_HOST;port=PG_PORT;dbname=PG_DATABASE',
        'db_user'       => 'PG_USER',
        'db_password'   => 'PG_PASSWORD',
        'platform'      => 'pgsql',
        'config_dir'    => 'src/Resource/propel/connection',
        'schema_dir'    => 'src/Resource/propel/schema',
        'model_dir'     => 'src/Model',
        'migration_dir' => 'src/Resource/propel/migration',
    ],
    'otp' => [
        'queue_url' => 'OTP_QUEUE_URL',
        'sms_url' => 'OTP_SMS_URL',
        'sms_worker' => 'OTP_SMS_WORKER',
        'email_url' => 'OTP_EMAIL_URL',
        'email_worker' => 'OTP_EMAIL_WORKER',
    ],
];
