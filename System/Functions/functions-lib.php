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

function format_text($raw_text)
{
    $paragraphs = explode("\n", $raw_text);
    $formatted_text = '<p>'.implode('</p><p>', $paragraphs).'</p>';

    return $formatted_text;
}

function remove_text_formatting($formatted_text)
{
    $raw_text = str_replace("</p><p>","\n", $formatted_text);
    $raw_text = str_replace(array("<p>","</p>"), array("",""), $raw_text);
    return $raw_text;
}
