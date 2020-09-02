<?php

namespace Otp\Controller\Sms;

use Otp\Controller\LayoutController;
use Otp\Model\Map\PasswordTableMap;
use Otp\Model\PasswordQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class CheckController extends LayoutController
{
    public function get()
    {
        $phone = $this->f('phone');
        $password = (string) $this->f('password');

        $this->validateNotEmpty($phone, 'phone');
        $this->validateNotEmpty($password, 'password');

        $valid = PasswordQuery::create()
            ->filterByPassword($password)
            ->filterByTarget($phone)
            ->filterByChannel(PasswordTableMap::COL_CHANNEL_SMS)
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
