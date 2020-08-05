<?php

namespace Otp\Module;

use Perfumer\Framework\Controller\Module;

class ControllerModule extends Module
{
    public $name = 'otp';

    public $router = 'otp.router';

    public $request = 'otp.request';

    public $components = [
        'view' => 'view.status'
    ];
}