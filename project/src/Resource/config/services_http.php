<?php

return [
    'fast_router' => [
        'shared' => true,
        'init' => function(\Perfumer\Component\Container\Container $container) {
            return \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
                $r->addRoute('POST', '/sms', 'sms.post');
                $r->addRoute('POST', '/email', 'email.post');
                $r->addRoute('GET', '/sms/check', 'sms/check.get');
                $r->addRoute('GET', '/email/check', 'email/check.get');
                $r->addRoute('POST', '/limit/sms', 'limit/sms.post');
                $r->addRoute('POST', '/limit/email', 'limit/email.post');
            });
        }
    ],

    'otp.router' => [
        'shared' => true,
        'class' => 'Perfumer\\Framework\\Router\\Http\\FastRouteRouter',
        'arguments' => ['#gateway.http', '#fast_router', [
            'data_type' => 'json',
            'allowed_actions' => ['get', 'post'],
        ]]
    ],

    'otp.request' => [
        'class' => 'Perfumer\\Framework\\Proxy\\Request',
        'arguments' => ['$0', '$1', '$2', '$3', [
            'prefix' => 'Otp\\Controller',
            'suffix' => 'Controller'
        ]]
    ]
];
