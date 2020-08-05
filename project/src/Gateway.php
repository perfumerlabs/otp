<?php

namespace Project;

use Perfumer\Framework\Gateway\CompositeGateway;

class Gateway extends CompositeGateway
{
    protected function configure(): void
    {
        $this->addModule('otp', 'OTP_HOST', null, 'http');
        $this->addModule('otp', 'otp',      null, 'cli');
    }
}
