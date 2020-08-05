<?php

return [
    'gateway' => [
        'shared' => true,
        'class' => 'Project\\Gateway',
        'arguments' => ['#application', '#gateway.http', '#gateway.console']
    ],

    'queue' => [
        'shared' => true,
        'class' => 'Otp\\Service\\Queue',
        'arguments' => [
            '@otp/queue_url',
            '@otp/sms_url',
            '@otp/email_url',
            '@otp/sms_worker',
            '@otp/email_worker',
        ]
    ]
];