<?php

namespace Otp\Controller\Sms;

use Otp\Controller\LayoutController;
use Otp\Model\Map\OtpTableMap;
use Otp\Model\OtpQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class CheckController extends LayoutController
{
    public function get()
    {
        $phone = $this->f('phone');
        $password = (string) $this->f('password');

        $this->validateNotEmpty($phone, 'phone');
        $this->validateNotEmpty($password, 'password');

        $valid = OtpQuery::create()
            ->filterByPassword($password)
            ->filterByTarget($phone)
            ->filterByChannel(OtpTableMap::COL_CHANNEL_SMS)
            ->filterByExpireAt(new \DateTime(), Criteria::GREATER_THAN)
            ->exists();

        $this->setStatus($valid);
    }

    private function validateNotEmpty($var, $name)
    {
        if (!$var) {
            $this->forward('error', 'badRequest', ["\"$name\" parameter must be set"]);
        }
    }
}
