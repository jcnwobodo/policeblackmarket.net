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
use System\Utilities\DateTime;
use Application\Models\User;
use Application\Models\Comment;

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

    public static function handleCommentPost(RequestContext $requestContext, $post_id)
    {
        $data = $requestContext->getResponseData();
        $author_name = $requestContext->getField('author_name');
        $author_email = $requestContext->getField('author_email');
        $author_comment = $requestContext->getField('author_comment');

        $comment_author = User::getMapper('User')->findByEmail($author_email);
        if(!is_object($comment_author))
        {
            $comment_author = new User();
            $comment_author->setUsername($author_email);
            $comment_author->setFirstName($author_name)->setLastName('');
            $comment_author->setDateOfBirth(new DateTime())->setDateJoined(new DateTime());
            $comment_author->setEmail($author_email);
            $comment_author->setUserType($comment_author::USER_TYPE_USER);
            $comment_author->setStatus($comment_author::STATUS_INACTIVE);
            $comment_author->mapper()->insert($comment_author);
        }

        if(strlen($author_name) and strlen($author_email) and strlen($author_comment))
        {
            $comment = new Comment();
            $comment->setPostId($post_id);
            $comment->setCommentAuthor($comment_author);
            $comment->setCommentTime(new DateTime());
            $comment->setCommentType(Comment::COMMENT_TYPE_REPORT);
            $comment->setContent($author_comment);
            $comment->setStatus(Comment::STATUS_APPROVED);
            $comment->mapper()->insert($comment);

            $requestContext->setFlashData('Your comment has been submitted successfully.');
            $data['status'] = 1;
        }
        else
        {
            $requestContext->setFlashData('Please supply all fields');
            $data['status'] = 0;
        }

        $requestContext->setResponseData($data);
    }
}