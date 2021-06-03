<?php

namespace Otp\Controller;

use Otp\Model\LimitQuery;
use Otp\Model\Map\LimitTableMap;
use Otp\Model\Map\PasswordTableMap;
use Otp\Model\Password;
use Otp\Model\PasswordQuery;
use Otp\Service\Queue;
use Propel\Runtime\ActiveQuery\Criteria;

class CallController extends LayoutController
{
    public function post()
    {
        $ip = $this->f('ip');
        $phone = $this->f('phone');
        $password = (string) $this->f('password');
        $lifetime = (int) $this->f('lifetime');

        $this->validateNotEmpty($phone, 'phone');
        $this->validateNotEmpty($password, 'password');
        $this->validateNotEmpty($lifetime, 'lifetime');

        $limits = LimitQuery::create()
            ->filterByChannel(LimitTableMap::COL_CHANNEL_CALL)
            ->find();

        $has_ip_limits = false;

        foreach ($limits as $limit) {
            if ($limit->getMeasure() === LimitTableMap::COL_MEASURE_IP) {
                $has_ip_limits = true;
            }
        }

        // no need to require ip if there is no rules for limiting requests by ip
        if ($has_ip_limits) {
            $this->validateNotEmpty($ip, 'ip');
        }

        $passed = true;
        $not_passed_measure = null;
        $not_passed_rate = 0;
        $not_passed_minutes = 0;

        foreach ($limits as $limit) {
            $not_passed_rate = $limit->getRate();
            $not_passed_minutes = $limit->getMinutes();
            $not_passed_measure = $limit->getMeasure() === 'ip' ? $limit->getMeasure() : 'phone';

            if ($limit->getMeasure() === LimitTableMap::COL_MEASURE_IP) {
                $count = PasswordQuery::create()
                    ->filterByChannel(PasswordTableMap::COL_CHANNEL_CALL)
                    ->filterByCreatedAt((new \DateTime())->modify("-$not_passed_minutes minute"), Criteria::GREATER_EQUAL)
                    ->filterByIp($ip)
                    ->count();
            } else {
                $count = PasswordQuery::create()
                    ->filterByChannel(PasswordTableMap::COL_CHANNEL_CALL)
                    ->filterByCreatedAt((new \DateTime())->modify("-$not_passed_minutes minute"), Criteria::GREATER_EQUAL)
                    ->filterByTarget($phone)
                    ->count();
            }

            $passed = ($count < $not_passed_rate);

            if ($passed === false) {
                break;
            }
        }

        if ($passed) {
            $otp = new Password();
            $otp->setChannel(PasswordTableMap::COL_CHANNEL_CALL);
            $otp->setExpireAt((new \DateTime())->modify("+$lifetime second"));
            $otp->setTarget($phone);
            $otp->setIp($ip);
            $otp->setPassword($password);
            $otp->save();

            error_log("SMS OTP created $password for $phone");

            $password = str_split($password);
            $message = '';
            foreach ($password as $key => $item){
                $message .= $item;
                if($key !== count($password) - 1){
                    $message .= ' ';
                }
            }

            /** @var Queue $queue */
            $queue = $this->s('queue');
            $queue->sendCall($phone, $message);
        } else {
            error_log("SMS OTP for $phone did not pass limits: $not_passed_measure - $not_passed_rate in $not_passed_minutes minutes");

            $status_code = $not_passed_measure === 'ip' ? 'ip_limit' : 'phone_limit';

            $this->forward('error', 'badRequest', ["Limits are reached: $not_passed_measure - $not_passed_rate in $not_passed_minutes minutes", $status_code]);
        }
    }

    private function validateNotEmpty($var, $name)
    {
        if (!$var) {
            $this->forward('error', 'badRequest', ["\"$name\" parameter must be set"]);
        }
    }
}
