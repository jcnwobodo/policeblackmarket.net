<?php
namespace Application\Controllers;

use System\Request\RequestContext;
use Application\Utilities\AccessManager;

class Logout_Controller extends A_Controller
{
    protected function doExecute(RequestContext $requestContext)
    {
        $requestContext->setView('page-login.php');

        if(! is_null($requestContext->getSession()))
        {
            $manager = AccessManager::instance();
            $manager->logout($requestContext->getSession()->getSessionId());
            $redirect = $requestContext->fieldIsSet('redirect',INPUT_GET) ? $requestContext->getField('redirect', INPUT_GET) : home_url('/login/', false);
            $requestContext->redirect($redirect);
        }
    }
}