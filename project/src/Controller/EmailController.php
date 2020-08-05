<?php

namespace Otp\Controller;

use Otp\Model\Map\OtpTableMap;
use Otp\Model\Otp;
use Otp\Service\Queue;

class EmailController extends LayoutController
{
    public function post()
    {
        $email = $this->f('email');
        $password = (string) $this->f('password');
        $subject = (string) $this->f('subject');
        $text = $this->f('text');
        $html = $this->f('html');
        $lifetime = (int) $this->f('lifetime');

        $this->validateNotEmpty($email, 'email');
        $this->validateNotEmpty($password, 'password');
        $this->validateNotEmpty($subject, 'subject');
        $this->validateNotEmpty($lifetime, 'lifetime');

        $otp = new Otp();
        $otp->setChannel(OtpTableMap::COL_CHANNEL_EMAIL);
        $otp->setExpireAt((new \DateTime())->modify("+$lifetime second"));
        $otp->setTarget($email);
        $otp->setPassword($password);
        $otp->save();

        error_log("Email OTP created $password for $email");

        /** @var Queue $queue */
        $queue = $this->s('queue');
        $queue->sendEmail($email, $subject, $text, $html);
    }

    private function validateNotEmpty($var, $name)
    {
        if (!$var) {
            $this->forward('error', 'badRequest', ["\"$name\" parameter must be set"]);
        }
    }
}
