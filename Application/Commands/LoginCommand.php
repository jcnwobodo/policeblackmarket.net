<?php
namespace Application\Commands;

use System\Models\DomainObjectHelper;
use System\Models\DomainObjectWatcher;
use System\Request\RequestContext;
use System\Auth\AccessManager;
use Application\Models\User;

class LoginCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $possible_session = $requestContext->getSession();
        if(! is_null($possible_session))
        {
            $redirect_url = home_url( '/'.User::getDefaultCommand($possible_session->getUserType()), false );
            //print_r($redirect_url); exit;
            $requestContext->redirect($redirect_url);//);
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
        $logged_in = $manager->login($username, $password);

		if( $logged_in )
        {
            $session = $requestContext->getSession();
            if(is_object($session))
            {
                $command = User::getDefaultCommand($session->getUserType());
                $redirect = $requestContext->fieldIsSet('redirect') ? $requestContext->getField('redirect') : home_url('/'.$command.'/', false);
                $requestContext->redirect($redirect);
            }
            $requestContext->setFlashData("something bad has happened");
        }
        //$requestContext->setFlashData( $manager->getMessage() );
	}
}