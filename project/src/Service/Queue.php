<?php

namespace Otp\Service;

use GuzzleHttp\Client;

class Queue
{
    private $queue_url;

    private $sms_url;

    private $email_url;

    private $sms_worker;

    private $email_worker;

    public function __construct(
        $queue_url,
        $sms_url,
        $email_url,
        $sms_worker,
        $email_worker
    )
    {
        $this->queue_url = $queue_url;
        $this->sms_url = $sms_url;
        $this->email_url = $email_url;
        $this->sms_worker = $sms_worker;
        $this->email_worker = $email_worker;
    }

    public function sendSms($phone, $message): bool
    {
        try {
            $client = new Client();
            $client->post($this->queue_url . '/task',
                [
                    'connect_timeout' => 15,
                    'read_timeout'    => 15,
                    'timeout'         => 15,
                    'json' => [
                        'url' => sprintf('%s/sms', $this->sms_url),
                        'method' => 'post',
                        'worker' => $this->sms_worker,
                        'json' => [
                            'phones' => $phone,
                            'message' => $message,
                            'force' => true,
                        ]
                    ]
                ]
            );
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function sendEmail($email, $subject, $text, $html): bool
    {
        try {
            $client = new Client();
            $client->post($this->queue_url . '/task',
                [
                    'connect_timeout' => 15,
                    'read_timeout'    => 15,
                    'timeout'         => 15,
                    'json' => [
                        'url' => sprintf('%s/smtp', $this->email_url),
                        'method' => 'post',
                        'worker' => $this->email_worker,
                        'json' => [
                            'to' => $email,
                            'subject' => $subject,
                            'text' => $text,
                            'html' => $html,
                            'force' => true,
                        ]
                    ]
                ]
            );
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}