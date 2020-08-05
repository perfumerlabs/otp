<?php

namespace Otp\Controller;

use Otp\Model\Map\OtpTableMap;
use Otp\Model\Otp;
use Otp\Service\Queue;

class SmsController extends LayoutController
{
    public function post()
    {
        $phone = $this->f('phone');
        $password = (string) $this->f('password');
        $message = (string) $this->f('message');
        $lifetime = (int) $this->f('lifetime');

        $this->validateNotEmpty($phone, 'phone');
        $this->validateNotEmpty($password, 'password');
        $this->validateNotEmpty($message, 'message');
        $this->validateNotEmpty($lifetime, 'lifetime');

        $otp = new Otp();
        $otp->setChannel(OtpTableMap::COL_CHANNEL_SMS);
        $otp->setExpireAt((new \DateTime())->modify("+$lifetime second"));
        $otp->setTarget($phone);
        $otp->setPassword($password);
        $otp->save();

        error_log("SMS OTP created $password for $phone");

        /** @var Queue $queue */
        $queue = $this->s('queue');
        $queue->sendSms($phone, $message);
    }

    private function validateNotEmpty($var, $name)
    {
        if (!$var) {
            $this->forward('error', 'badRequest', ["\"$name\" parameter must be set"]);
        }
    }
}
