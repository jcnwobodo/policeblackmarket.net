<?php
namespace System\Auth;

use Application\Models;
use System\Request\RequestContext;
use System\Utilities\DateTime;

//handles all aspects of authentication and authorization
class AccessManager
{
    private static $instance;
    private $message = null;
    const SESSION_COOKIE_NAME = "SESSION_ID";

    private function __construct(){}
    public static function instance()
    {
        if( ! isset(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function login($username, $password)
    {
        $UserMapper = Models\User::getMapper("User");
        $UserObj = $UserMapper->findByUsername($username);

        if(is_null($UserObj))
        {
            $this->setMessage("User $username does not exist.");
            return false;
        }
        elseif($UserObj->getPassword() !== $password)
        {
            $this->setMessage("Invalid password for user $username");
            return false;
        }
        elseif(is_object($UserObj))
        {
            $this->startSession($UserObj);
            return true;
        }
        else//an internal error has probably occurred
        {
            $this->setMessage("Login attempt failed. Please try again later. If problem persists, contact the site administrator.");
            return false;
        }
    }
    public function validateSession(RequestContext $requestContext)
    {
        $session_id = $requestContext->getCookie(self::SESSION_COOKIE_NAME);
        if(! is_null($session_id))
        {
            $session = Models\Session::getMapper('Session')->findBySessionId($session_id);
            if(!is_null($session) and $session->getStatus() == $session::ON_STATE)
            {
                $session->setLastActivityTime(new DateTime());
                $requestContext->setSession($session);
            }
        }
    }
    public function logout($session_id)
    {
        $session = Models\Session::getMapper('Session')->findBySessionId($session_id);
        if(! is_null($session))
        {
            $session->setStatus($session::OFF_STATE);
        }
    }

    private function startSession($UserObj)
    {
        $session_id = $this->getUniqueId();
        $user_type = $this->getUserType($UserObj);

        if(!is_null($user_type) and setrawcookie(self::SESSION_COOKIE_NAME,$session_id,0,'/',home_url()))
        {
            $session = new Models\Session();
            $session->setSessionId($session_id);
            $session->setSessionUser($UserObj)->setUserType($user_type);
            $session->setStartTime(new DateTime())->setLastActivityTime(new DateTime());
            $session->setUserAgent($_SERVER['HTTP_USER_AGENT'])->setIpAddress($_SERVER['REMOTE_ADDR']);
            $session->setStatus($session::ON_STATE);

            //TODO log this event

            RequestContext::instance()->setSession($session);
            return true;
        }
        elseif(is_null($user_type))
        {
            $this->setMessage("An internal error has occurred, try again later.");
            //TODO log this error
        }
        else//cookie could not be set
        {
            $this->setMessage("Cookies could not be set. Please check your browser settings.");
        }
        return false;
    }

    public function getUniqueId($prefix="")
    {
        return uniqid($prefix, true);
    }
    public function getUserType($UserObj)
    {
        $user_type = null;
        $default_access_level = Models\AccessLevel::getMapper('AccessLevel')->findUserDefault($UserObj->getId());
        $last_session = Models\Session::getMapper("Session")->findByUserId($UserObj->getId())->current();
        $all_access_levels = Models\AccessLevel::getMapper('AccessLevel')->findAll();
        if(!is_null($default_access_level))
        {
            $user_type = $default_access_level->getUserType();
        }
        elseif(!is_null($last_session))
        {
            $user_type = $last_session->getUserType();
        }
        else
        {
            $user_type = $all_access_levels->current()->getUserType();
        }
        return $user_type;
    }

    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}