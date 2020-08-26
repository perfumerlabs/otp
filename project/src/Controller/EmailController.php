<?php

namespace Otp\Controller;

use Otp\Model\LimitQuery;
use Otp\Model\Map\LimitTableMap;
use Otp\Model\Map\OtpTableMap;
use Otp\Model\Otp;
use Otp\Model\OtpQuery;
use Otp\Service\Queue;
use Propel\Runtime\ActiveQuery\Criteria;

class EmailController extends LayoutController
{
    public function post()
    {
        $ip = $this->f('ip');
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

        $limits = LimitQuery::create()
            ->filterByChannel(LimitTableMap::COL_CHANNEL_EMAIL)
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
            $not_passed_measure = $limit->getMeasure() === 'ip' ? $limit->getMeasure() : 'email';

            if ($limit->getMeasure() === LimitTableMap::COL_MEASURE_IP) {
                $count = OtpQuery::create()
                    ->filterByChannel(OtpTableMap::COL_CHANNEL_EMAIL)
                    ->filterByCreatedAt((new \DateTime())->modify("-$not_passed_minutes minute"), Criteria::GREATER_EQUAL)
                    ->filterByIp($ip)
                    ->count();
            } else {
                $count = OtpQuery::create()
                    ->filterByChannel(OtpTableMap::COL_CHANNEL_EMAIL)
                    ->filterByCreatedAt((new \DateTime())->modify("-$not_passed_minutes minute"), Criteria::GREATER_EQUAL)
                    ->filterByTarget($email)
                    ->count();
            }

            $passed = $count < $not_passed_rate;

            if ($passed === false) {
                break;
            }
        }

        if ($passed) {
            $otp = new Otp();
            $otp->setChannel(OtpTableMap::COL_CHANNEL_EMAIL);
            $otp->setExpireAt((new \DateTime())->modify("+$lifetime second"));
            $otp->setTarget($email);
            $otp->setIp($ip);
            $otp->setPassword($password);
            $otp->save();

            error_log("Email OTP created $password for $email");

            /** @var Queue $queue */
            $queue = $this->s('queue');
            $queue->sendEmail($email, $subject, $text, $html);
        } else {
            error_log("Email OTP for $email did not pass limits: $not_passed_measure - $not_passed_rate in $not_passed_minutes minutes");

            $status_code = $not_passed_measure === 'ip' ? 'ip_limit' : 'email_limit';

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
