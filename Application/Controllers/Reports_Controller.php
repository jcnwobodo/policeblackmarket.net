<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/19/2015
 * Time:    10:34 AM
 **/

namespace Application\Controllers;

use Application\Models\Comment;
use System\Request\RequestContext;
use Application\Models\Report;
use Application\Models\User;
use System\Utilities\DateTime;

class Reports_Controller extends A_Controller
{
    protected function doExecute(RequestContext $requestContext)
    {
        $data = array();
        if($requestContext->fieldIsSet('id', INPUT_GET))
        {
            $report = Report::getMapper('Report')->find($requestContext->getField('id', INPUT_GET));
            if(is_object($report) and $report->getStatus() == Report::STATUS_APPROVED)
            {
                if($requestContext->fieldIsSet('post_comment', INPUT_POST))
                {
                    $requestContext->setResponseData($data);
                    Posts_Controller::handleCommentPost($requestContext, $report->getId());
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