<?php

namespace Otp\Controller\Limit;

use Otp\Controller\LayoutController;
use Otp\Model\Limit;
use Otp\Model\LimitQuery;
use Otp\Model\Map\LimitTableMap;

class EmailController extends LayoutController
{
    public function post()
    {
        $ips = $this->f('ips');
        $emails = $this->f('emails');

        if (is_array($ips)) {
            LimitQuery::create()
                ->filterByChannel(LimitTableMap::COL_CHANNEL_EMAIL)
                ->filterByMeasure(LimitTableMap::COL_MEASURE_IP)
                ->delete();

            foreach ($ips as $item) {
                $minutes = $item['minutes'] ?? null;
                $rate = $item['rate'] ?? null;

                if ($minutes > 0 && $rate > 0) {
                    $limit = new Limit();
                    $limit->setRate((int) $rate);
                    $limit->setMinutes((int) $minutes);
                    $limit->setMeasure(LimitTableMap::COL_MEASURE_IP);
                    $limit->setChannel(LimitTableMap::COL_CHANNEL_EMAIL);
                    $limit->save();
                }
            }
        }

        if (is_array($emails)) {
            LimitQuery::create()
                ->filterByChannel(LimitTableMap::COL_CHANNEL_EMAIL)
                ->filterByMeasure(LimitTableMap::COL_MEASURE_TARGET)
                ->delete();

            foreach ($emails as $item) {
                $minutes = $item['minutes'] ?? null;
                $rate = $item['rate'] ?? null;

                if ($minutes > 0 && $rate > 0) {
                    $limit = new Limit();
                    $limit->setRate((int)$rate);
                    $limit->setMinutes((int)$minutes);
                    $limit->setMeasure(LimitTableMap::COL_MEASURE_TARGET);
                    $limit->setChannel(LimitTableMap::COL_CHANNEL_EMAIL);
                    $limit->save();
                }
            }
        }
    }
}
