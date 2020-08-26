<?php

namespace Otp\Controller;

class ErrorController extends LayoutController
{
    public function badRequest($message, $status_code = null)
    {
        $this->getExternalResponse()->setStatusCode(400);

        $this->setStatusCode($status_code);

        $this->setErrorMessage($message);
    }

    public function internalServerError(\Throwable $e)
    {
        $this->getExternalResponse()->setStatusCode(500);

        $this->setErrorMessage($e->getMessage());

        error_log($e->getMessage());
    }
}
