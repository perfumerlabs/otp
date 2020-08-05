<?php

namespace Otp\Module;

use Perfumer\Framework\Controller\Module;

class CommandModule extends Module
{
    public $name = 'otp';

    public $router = 'router.console';

    public $request = 'otp.request';
}