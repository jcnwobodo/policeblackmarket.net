<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    11/1/2015
 * Time:    11:04 PM
 */

$__autoload = array(
    "Application/Config/config.php",
    "System/Functions/site-info.php",
    "System/Functions/view-helpers.php",
    "System/Functions/functions-lib.php",
    "System/Functions/form-elements.php"
);

foreach($__autoload as $file)
{
    if(is_file($file))
    {
        require_once($file);
    }
    else
    {
        echo "<br/>File '".$file."' not found" ;
        exit;
    }
}

function __autoload( $class )
{
    if ( preg_match( '/\\\\/', $class ) )
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $class );
        $path .= ".php";
    }
    if(!is_file($path))
    {
        echo "<br/>File (<u>$path</u>) not found" ;
        exit;
    }
    require_once($path);
}