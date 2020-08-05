<?php

namespace Otp\Controller;

use Perfumer\Framework\Controller\ViewController;
use Perfumer\Framework\Router\Http\FastRouteRouterControllerHelpers;
use Perfumer\Framework\View\StatusViewControllerHelpers;

class LayoutController extends ViewController
{
    use FastRouteRouterControllerHelpers;
    use StatusViewControllerHelpers;
}
