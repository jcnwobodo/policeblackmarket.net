<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/19/2015
 * Time:    10:34 AM
 **/

namespace Application\Commands;

use Application\Models\Comment;
use System\Request\RequestContext;
use Application\Models\Report;
use Application\Models\User;
use System\Utilities\DateTime;

class ReportsCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $data = array();
        if($requestContext->fieldIsSet('id'))
        {
            $report = Report::getMapper('Report')->find($requestContext->getField('id'));
            if(is_object($report) and $report->getStatus() == Report::STATUS_APPROVED)
            {
                if($requestContext->fieldIsSet('post_comment'))
                {
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
                        $comment_author->setPlaceOfOrigin($report->getLocationDistrict())->setPlaceOfResidence($report->getLocationDistrict());
                        $comment_author->setEmail($author_email);
                        $comment_author->setUserType($comment_author::USER_TYPE_USER);
                        $comment_author->setStatus($comment_author::STATUS_INACTIVE);
                        $comment_author->mapper()->insert($comment_author);
                    }

                    if(strlen($author_name) and strlen($author_email) and strlen($author_comment))
                    {
                        $comment = new Comment();
                        $comment->setPostId($report->getId());
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
                }

                $comments = Comment::getMapper('Comment')->findByPost($report->getId());

                $data['reports'] = $report;
                $data['comments'] = $comments;
                $data['page-title'] = $report->getTitle();
                $requestContext->setView('page-reports-single.php');
                $requestContext->setResponseData($data);
                return;
            }
        }

        $approved_reports = Report::getMapper('Report')->findByStatus(Report::STATUS_APPROVED);
        $data['reports'] = $approved_reports;
        $data['page-title'] = "Reports";
        $requestContext->setView('page-reports-list.php');
        $requestContext->setResponseData($data);
    }
}