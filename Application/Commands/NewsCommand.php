<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/20/2015
 * Time:    1:07 PM
 **/

namespace Application\Commands;

use Application\Models\Post;
use System\Request\RequestContext;

class NewsCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $data = array();
        if(strlen($requestContext->getRequestUrlParam(1)))
        {
            $news_post = Post::getMapper('Post')->find($requestContext->getRequestUrlParam(1));
            if(is_object($news_post) and $news_post->getStatus() == Post::STATUS_APPROVED)
            {
                $data['news'] = $news_post;
                $requestContext->setView('page-news-single.php');
                $requestContext->setResponseData($data);
                return;
            }
        }

        $published_news = Post::getMapper('Post')->findByType(Post::TYPE_NEWS);
        $data['news'] = $published_news;
        $requestContext->setView('page-news-list.php');
        $requestContext->setResponseData($data);
    }
}