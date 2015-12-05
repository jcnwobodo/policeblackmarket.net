<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    11/1/2015
 * Time:    5:14 PM
 */

namespace Application\Commands;

use System\Models\DomainObjectWatcher;
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

    protected function ManageReports(RequestContext $requestContext)
    {
        $status = $requestContext->fieldIsSet('status') ? $requestContext->getField('status') : 'pending';
        $action = $requestContext->fieldIsSet('action') ? $requestContext->getField('action') : null;
        $reports_ids = $requestContext->fieldIsSet('report-ids') ? $requestContext->getField('report-ids') : array();

        switch(strtolower($action))
        {
            case 'approve' : {
                foreach($reports_ids as $reports_id)
                {
                    $report_obj = Report::getMapper('Report')->find($reports_id);
                    if(is_object($report_obj)) $report_obj->setStatus(Report::STATUS_APPROVED);
                }
            } break;
            case 'delete' : {
                foreach($reports_ids as $reports_id)
                {
                    $report_obj = Report::getMapper('Report')->find($reports_id);
                    if(is_object($report_obj)) $report_obj->setStatus(Report::STATUS_DELETED);
                }
            } break;
            case 'disapprove' : {
                foreach($reports_ids as $reports_id)
                {
                    $report_obj = Report::getMapper('Report')->find($reports_id);
                    if(is_object($report_obj)) $report_obj->setStatus(Report::STATUS_PENDING);
                }
            } break;
            case 'restore' : {
                foreach($reports_ids as $reports_id)
                {
                    $report_obj = Report::getMapper('Report')->find($reports_id);
                    if(is_object($report_obj)) $report_obj->setStatus(Report::STATUS_APPROVED);
                }
            } break;
            case 'delete permanently' : {
                foreach($reports_ids as $reports_id)
                {
                    $report_obj = Report::getMapper('Report')->find($reports_id);
                    if(is_object($report_obj)) $report_obj->markDelete();
                }
            } break;
            default : {}
        }
        DomainObjectWatcher::instance()->performOperations();

        switch($status)
        {
            case 'pending' : {
                $reports = Report::getMapper('Report')->findByStatus(Report::STATUS_PENDING);
            } break;
            case 'approved' : {
                $reports = Report::getMapper('Report')->findByStatus(Report::STATUS_APPROVED);
            } break;
            case 'deleted' : {
                $reports = Report::getMapper('Report')->findByStatus(Report::STATUS_DELETED);
            } break;
            default : {
                $reports = Report::getMapper('Report')->findAll();
            }
        }

        $data = array();
        $data['status'] = $status;
        $data['reports'] = $reports;
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/manage-reports.php');
    }

    protected function ManageComments(RequestContext $requestContext)
    {
        $status = $requestContext->fieldIsSet('status') ? $requestContext->getField('status') : 'pending';
        $action = $requestContext->fieldIsSet('action') ? $requestContext->getField('action') : null;
        $comment_ids = $requestContext->fieldIsSet('comment-ids') ? $requestContext->getField('comment-ids') : array();

        switch(strtolower($action))
        {
            case 'approve' : {
                foreach($comment_ids as $comment_id)
                {
                    $comment_obj = Comment::getMapper('Comment')->find($comment_id);
                    if(is_object($comment_obj)) $comment_obj->setStatus(Comment::STATUS_APPROVED);
                }
            } break;
            case 'delete' : {
                foreach($comment_ids as $comment_id)
                {
                    $comment_obj = Comment::getMapper('Comment')->find($comment_id);
                    if(is_object($comment_obj)) $comment_obj->setStatus(Comment::STATUS_DELETED);
                }
            } break;
            case 'disapprove' : {
                foreach($comment_ids as $comment_id)
                {
                    $comment_obj = Comment::getMapper('Comment')->find($comment_id);
                    if(is_object($comment_obj)) $comment_obj->setStatus(Comment::STATUS_PENDING);
                }
            } break;
            case 'restore' : {
                foreach($comment_ids as $comment_id)
                {
                    $comment_obj = Comment::getMapper('Comment')->find($comment_id);
                    if(is_object($comment_obj)) $comment_obj->setStatus(Comment::STATUS_APPROVED);
                }
            } break;
            case 'delete permanently' : {
                foreach($comment_ids as $comment_id)
                {
                    $comment_obj = Comment::getMapper('Comment')->find($comment_id);
                    if(is_object($comment_obj)) $comment_obj->markDelete();
                }
            } break;
            default : {}
        }
        DomainObjectWatcher::instance()->performOperations();

        switch($status)
        {
            case 'pending' : {
                $comments = Comment::getMapper('Comment')->findByStatus(Comment::STATUS_PENDING);
            } break;
            case 'approved' : {
                $comments = Comment::getMapper('Comment')->findByStatus(Comment::STATUS_APPROVED);
            } break;
            case 'deleted' : {
                $comments = Comment::getMapper('Comment')->findByStatus(Comment::STATUS_DELETED);
            } break;
            default : {
                $comments = Comment::getMapper('Comment')->findAll();
            }
        }

        $data = array();
        $data['status'] = $status;
        $data['comments'] = $comments;
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/manage-comments.php');
    }

    protected function ManageLocations(RequestContext $requestContext)
    {
        $type = $requestContext->fieldIsSet('type') ? $requestContext->getField('type') : 'district';
        $status = $requestContext->fieldIsSet('status') ? $requestContext->getField('status') : 'pending';
        $action = $requestContext->fieldIsSet('action') ? $requestContext->getField('action') : null;
        $location_ids = $requestContext->fieldIsSet('location-ids') ? $requestContext->getField('location-ids') : array();

        switch(strtolower($action))
        {
            case 'approve' : {
                foreach($location_ids as $location_id)
                {
                    $location_obj = Location::getMapper('Location')->find($location_id);
                    if(is_object($location_obj)) $location_obj->setStatus(Location::STATUS_APPROVED);
                }
            } break;
            case 'delete' : {
                foreach($location_ids as $location_id)
                {
                    $location_obj = Location::getMapper('Location')->find($location_id);
                    if(is_object($location_obj)) $location_obj->setStatus(Location::STATUS_DELETED);
                }
            } break;
            case 'disapprove' : {
                foreach($location_ids as $location_id)
                {
                    $location_obj = Location::getMapper('Location')->find($location_id);
                    if(is_object($location_obj)) $location_obj->setStatus(Location::STATUS_PENDING);
                }
            } break;
            case 'restore' : {
                foreach($location_ids as $location_id)
                {
                    $location_obj = Location::getMapper('Location')->find($location_id);
                    if(is_object($location_obj)) $location_obj->setStatus(Location::STATUS_APPROVED);
                }
            } break;
            case 'delete permanently' : {
                foreach($location_ids as $location_id)
                {
                    $location_obj = Location::getMapper('Location')->find($location_id);
                    if(is_object($location_obj)) $location_obj->markDelete();
                }
            } break;
            default : {}
        }
        DomainObjectWatcher::instance()->performOperations();

        switch($status)
        {
            case 'pending' : {
                $locations = Location::getMapper('Location')->findTypeByStatus($type, Location::STATUS_PENDING);
            } break;
            case 'approved' : {
                $locations = Location::getMapper('Location')->findTypeByStatus($type, Location::STATUS_APPROVED);
            } break;
            case 'deleted' : {
                $locations = Location::getMapper('Location')->findTypeByStatus($type, Location::STATUS_DELETED);
            } break;
            default : {
                $locations = Location::getMapper('Location')->findAll();
            }
        }

        $data = array();
        $data['type'] = $type;
        $data['status'] = $status;
        $data['locations'] = $locations;
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/manage-locations.php');
    }
}