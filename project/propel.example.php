<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'otp' => [
                    'adapter' => 'pgsql',
                    'dsn' => 'pgsql:host=db;port=5432;dbname=otp',
                    'user' => 'postgres',
                    'password' => 'postgres',
                    'settings' => [
                        'charset' => 'utf8',
                        'queries' => [
                            'utf8' => "SET NAMES 'UTF8'",
                            'schema' => "SET search_path TO public"
                        ]
                    ],
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'otp',
            'connections' => ['otp']
        ],
        'generator' => [
            'defaultConnection' => 'otp',
            'connections' => ['otp']
        ]
    ]
];
