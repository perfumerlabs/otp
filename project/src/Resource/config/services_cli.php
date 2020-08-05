<?php

return [
    'email.request' => [
        'class' => 'Perfumer\\Framework\\Proxy\\Request',
        'arguments' => ['$0', '$1', '$2', '$3', [
            'prefix' => 'Otp\\Command',
            'suffix' => 'Command'
        ]]
    ]
];
