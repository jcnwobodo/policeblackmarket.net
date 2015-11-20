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
        $data = $requestContext->getResponseData();
        $post_type = $data->getPostType();
        $possible_view1 = $post_type == 'page' ? 'page-view.php' : 'post-view.php';
        $possible_views = array('single.php', $possible_view1);
        foreach($possible_views as $possible_view)
        {
            if($requestContext->viewExists($possible_view)) $requestContext->setView($possible_view);
        }
    }
}