<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    11/1/2015
 * Time:    5:14 PM
 */

namespace Application\Commands;

use System\Request\RequestContext;
use Application\Models\User;
use Application\Models\Comment;
use Application\Models\Location;
use Application\Models\Report;

class AdminAreaCommand extends SecureCommand
{
    public function execute(RequestContext $requestContext)
    {
        if($this->securityPass($requestContext, User::USER_TYPE_ADMIN, 'admin-area'))
        {
            parent::execute($requestContext);
        }
    }

    protected function doExecute(RequestContext $requestContext)
    {
        $approved_reports = Report::getMapper('Report')->findByStatus(Report::STATUS_APPROVED);
        $pending_reports = Report::getMapper('Report')->findByStatus(Report::STATUS_PENDING);
        $deleted_reports = Report::getMapper('Report')->findByStatus(Report::STATUS_DELETED);

        $approved_locations = Location::getMapper('Location')->findByStatus(Location::STATUS_APPROVED);
        $pending_locations = Location::getMapper('Location')->findByStatus(Location::STATUS_PENDING);

        $approved_comments = Comment::getMapper('Comment')->findByStatus(Comment::STATUS_APPROVED);
        $pending_comments = Comment::getMapper('Comment')->findByStatus(Comment::STATUS_PENDING);
        $deleted_comments = Comment::getMapper('Comment')->findByStatus(Comment::STATUS_DELETED);

        $data = array();
        $data['num_pending_reports'] = $pending_reports ? $pending_reports->size() : 0;
        $data['num_approved_reports'] = $approved_reports ? $approved_reports->size() : 0;
        $data['num_deleted_reports'] = $deleted_reports ? $deleted_reports->size() : 0;
        $data['num_approved_locations'] = $approved_locations ? $approved_locations->size() : 0;
        $data['num_pending_locations'] = $pending_locations ? $pending_locations->size() : 0;
        $data['num_approved_comments'] = $approved_comments ? $approved_comments->size() : 0;
        $data['num_pending_comments'] = $pending_comments ? $pending_comments->size() : 0;
        $data['num_deleted_comments'] = $deleted_comments ? $deleted_comments->size() : 0;

        $requestContext->setResponseData($data);
        $requestContext->setView('admin/dashboard.php');
    }
}