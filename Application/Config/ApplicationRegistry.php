<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (phoenixlabs.ng@gmail.com)
 * Project: BareBones PHP Framework
 * Date:    1/7/2016
 * Time:    8:11 PM
 **/

namespace Application\Config;

class ApplicationRegistry
{
    static private $instance;
    static private $dsn = "mysql:dbname=www_police_black_market;host=localhost";
    static private $db_user = "root";
    static private $db_user_password = "db-key";
    static private $site_info = array(
        'charset'               => "UTF-8",
        'host-name'             => "127.0.0.1",
        'cookie-name'           => "PBM_SESSION_ID",
        'site-url'              => "http://127.0.0.1/_www/Leapscope/PoliceBlackMarket.Net",
        'deployment-path'       => '_www/Leapscope/PoliceBlackMarket.Net',
        'views-directory'       => 'Application/Views',
        'stylesheet-url'        => "Assets/css/style.css",
        'name'                  => "Police Black-Market",
        'short-name'            => "Police Black-Market",
        'tag-line'              => "",
        'contact-email'         => "info@policeblackmarket.net",
        'contact-phone'         => "+2348133621591",
        'webmail-url'           => "http://mailbox.policeblackmarket.net/",
        'facebook-page'         => "http://facebook.com/#",
        'youtube-channel'       => "#",
        'twitter-handle'        => "#",
        'google-plus'           => "#",
        'designer-url'          => "https://ng.linkedin.com/in/jcnwobodo",
        'designer-name'         => "C. Joseph (Fibonacci)",
        'development-mode'      => false
    );

    private function __construct(){}

    static function instance()
    {
        if(!isset(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    static function getDSN()
    {
        return self::$dsn;
    }

    static function getDbUser()
    {
        return self::$db_user;
    }

    static function getDbUserPassword()
    {
        return self::$db_user_password;
    }

    static function siteInfo()
    {
        return self::$site_info;
    }
}