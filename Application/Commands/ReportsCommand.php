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
                    $requestContext->setResponseData($data);
                    PostsCommand::handleCommentPost($requestContext, $report->getId());
                    $data = $requestContext->getResponseData();
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