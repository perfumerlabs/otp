<?php

namespace Otp\Controller;

class ErrorController extends LayoutController
{
    public function badRequest($message)
    {
        $this->getExternalResponse()->setStatusCode(400);

        $this->setErrorMessage($message);
    }

    public function internalServerError(\Throwable $e)
    {
        $this->getExternalResponse()->setStatusCode(500);

        $this->setErrorMessage($e->getMessage());

        error_log($e->getMessage());
    }
}
