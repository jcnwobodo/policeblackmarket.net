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
use Application\Models\Comment;
use System\Request\RequestContext;

class NewsCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $data = array();
        if(strlen($requestContext->getRequestUrlParam(1)))
        {
            $news_post = Post::getMapper('Post')->findByPamalink($requestContext->getRequestUrlParam(1));
            if(is_object($news_post) and $news_post->getStatus() == Post::STATUS_PUBLISHED)
            {

                if($requestContext->fieldIsSet('post_comment'))
                {
                    $requestContext->setResponseData($data);
                    PostsCommand::handleCommentPost($requestContext, $news_post->getId());
                    $data = $requestContext->getResponseData();
                }

                $comments = Comment::getMapper('Comment')->findByPost($news_post->getId());

                $data['posts'] = $news_post;
                $data['comments'] = $comments;
                $data['page-title'] = $news_post->getTitle();
                $requestContext->setView('page-news-single.php');
                $requestContext->setResponseData($data);
                return;
            }
        }

        $published_news = Post::getMapper('Post')->findTypeByStatus(Post::TYPE_NEWS, Post::STATUS_PUBLISHED);
        $data['news'] = $published_news;
        $data['page-title'] = "News";
        $requestContext->setView('page-news-list.php');
        $requestContext->setResponseData($data);
    }
}