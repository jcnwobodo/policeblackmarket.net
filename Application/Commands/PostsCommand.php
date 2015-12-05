<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/27/2015
 * Time:    1:55 PM
 */

namespace Application\Commands;

use System\Request\RequestContext;

class PostsCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $data = array();
        $data['post'] = $requestContext->getResponseData();
        $data['page-title'] = $data['post']->getTitle();
        $post_type = $data['post']->getPostType();
        $possible_view1 = $post_type == 'page' ? 'page-view.php' : 'page-news-single.php';
        $possible_views = array('single.php', $possible_view1);
        foreach($possible_views as $possible_view)
        {
            if($requestContext->viewExists($possible_view)) $requestContext->setView($possible_view);
        }
        $requestContext->setResponseData($data);
    }
}