<?php

namespace Otp\Controller\Email;

use Otp\Controller\LayoutController;
use Otp\Model\Map\OtpTableMap;
use Otp\Model\OtpQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class CheckController extends LayoutController
{
    public function get()
    {
        $email = $this->f('email');
        $password = (string) $this->f('password');

        $this->validateNotEmpty($email, 'email');
        $this->validateNotEmpty($password, 'password');

        $valid = OtpQuery::create()
            ->filterByPassword($password)
            ->filterByTarget($email)
            ->filterByChannel(OtpTableMap::COL_CHANNEL_EMAIL)
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
