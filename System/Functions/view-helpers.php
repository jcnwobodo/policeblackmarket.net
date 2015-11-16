<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/23/2015
 * Time:    3:05 PM
 */

$requestContext = System\Request\RequestContext::instance();
$post_collection_class = 'Application\\Models\\Collections\\PostCollection';
$post_class = 'Application\\Models\\Post';
$current_post = null;

function have_posts()
{
    global $requestContext, $post_collection_class, $post_class;
    $data = $requestContext->getResponseData();
    if(! is_null($data))
    {
        if(is_object($data) and get_class($data) == $post_class)
        {
            $collection = new $post_collection_class();
            $collection->add($data);
            $requestContext->setResponseData($collection);
            return $collection->valid() != null ? $collection : false;
        }
        elseif(is_object($data) and (get_class($data) == $post_collection_class) and $data->valid() )
        {
            return $data;
        }
    }
    return false;
}

function the_post()
{
    global $requestContext, $post_collection_class, $current_post;
    $data = $requestContext->getResponseData();
    if(is_object($data) and get_class($data) == $post_collection_class)
    {
        $current_post = $data->next();
    }
}

function the_title()
{
    global $post_class, $current_post;
    if(is_object($current_post) and get_class($current_post) == $post_class)
    {
        echo $current_post->getTitle();
    }
}

function has_post_thumbnail()
{
    global $post_class, $current_post;
    if(is_object($current_post) and get_class($current_post) == $post_class)
    {
        return ( ! is_null($current_post->getFeaturedImage()) );
    }
}

function the_post_thumbnail($size)
{
    global $post_class, $current_post;
    $sizes = array(
        'small' => array('120','120'),
        'medium' => array('120','120'),
        'large' => array('120','120')
    );
    if(is_object($current_post) and get_class($current_post) == $post_class)
    {
        //TODO: handle associated upload object to generate file
    }
}

function the_content()
{
    global $post_class, $current_post;
    if(is_object($current_post) and get_class($current_post) == $post_class)
    {
        echo $current_post->getContent();
    }
}

function the_excerpt()
{
    global $post_class, $current_post;
    if(is_object($current_post) and get_class($current_post) == $post_class)
    {
        echo $current_post->getExcerpt();
    }
}

function subwords($string, $start, $length)
{
    $words = explode(' ', $string);
    $return = array();
    $limit = sizeof($words);
    $start = $start <= $limit ? $start : 0;
    $len = $length <= ($limit - $start) ? $length : ($limit - $start);

    for($i = 0, $p = $start; $i < $len; ++$i, ++$p)
    {
        $return[] = $words[$p];
    }
    return implode(' ', $return);
}

function the_date()
{
    global $post_class, $current_post;
    if(is_object($current_post) and get_class($current_post) == $post_class)
    {
        echo $current_post->getDateCreated()->getDateTimeStrF('F d, Y');
    }
}

function the_permalink($echo = true)
{
    global $post_class, $current_post;
    $return = null;
    if(is_object($current_post) and get_class($current_post) == $post_class)
    {
        $return = $current_post->getPamalink();
    }
    if($echo) echo $return; else return $return;
}