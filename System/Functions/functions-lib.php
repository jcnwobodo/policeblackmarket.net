<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    11/4/2015
 * Time:    11:24 PM
 */

function recursive_implode($glue, $pieces)
{
    $build = array();
    foreach($pieces as $piece)
    {
        $build[] = is_array($piece) ? recursive_implode($glue, $piece) : ( is_object($piece) ? print_r($piece,true) : $piece);
    }
    return implode($glue, $build);
}
