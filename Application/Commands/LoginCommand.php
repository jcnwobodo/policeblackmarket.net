<?php
namespace Application\Commands;

use System\Request\RequestContext;
use System\Auth\AccessManager;
use Application\Models\AccessLevel;

class LoginCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $possible_session = $requestContext->getSession();
        if(! is_null($possible_session))
        {
            $requestContext->redirect(home_url('/'.AccessLevel::getDefaultCommand($possible_session->getUserType()), false));
        }
        $requestContext->setView('page-login.php');
        if($requestContext->fieldIsSet('login'))
        {
            $this->doLogin($requestContext);
        }
    }

	private function doLogin(RequestContext $requestContext)
    {
        $username = $requestContext->getField('username');
        $password = $requestContext->getField('password');
        $manager = AccessManager::instance();
		if($manager->login( $username, $password ))
        {
            $command = AccessLevel::getDefaultCommand($requestContext->getSession()->getUserType());
            $redirect = $requestContext->fieldIsSet('redirect') ? $requestContext->getField('redirect') : home_url('/'.$command.'/', false);
            $requestContext->redirect($redirect);
        }
        $requestContext->setFlashData( $manager->getMessage() );
	}
}