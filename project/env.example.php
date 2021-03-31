<?php

return [
    'propel' => [
        'bin'           => 'vendor/bin/propel',
        'project'       => 'otp',
        'database'      => 'pgsql',
        'dsn'           => 'pgsql:host=db;port=5432;dbname=otp',
        'db_user'       => 'postgres',
        'db_password'   => 'postgres',
        'db_schema'     => 'public',
        'platform'      => 'pgsql',
        'config_dir'    => './',
        'schema_dir'    => 'src/Resource/propel/schema',
        'model_dir'     => 'src/Model',
        'migration_dir' => 'src/Resource/propel/migration',
        'migration_table' => 'otp_propel_migration',
    ],
];