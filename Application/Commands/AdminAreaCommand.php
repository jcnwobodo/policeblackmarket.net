<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    11/1/2015
 * Time:    5:14 PM
 */

namespace Application\Commands;

use Application\Models\Category;
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

        $data['page-title'] = "Admin Dashboard";
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
        $data['page-title'] = ucwords($status)." Reports";
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
        $data['page-title'] = ucwords($status)." Comments";
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/manage-comments.php');
    }

    protected function ManageLocations(RequestContext $requestContext)
    {
        $type = $requestContext->fieldIsSet('type') ? $requestContext->getField('type') : 'district';
        $status = $requestContext->fieldIsSet('status') ? $requestContext->getField('status') : 'approved';
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
        $data['page-title'] = ucwords($status)." Locations (".ucwords($type).")";
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/manage-locations.php');
    }

    protected function AddLocation(RequestContext $requestContext)
    {
        $data = array();
        $types = array('state', 'lga', 'district');
        $type = ( $requestContext->fieldIsSet('type') && in_array($requestContext->getField('type'), $types)) ? $requestContext->getField('type') : 'district';
        $data['type'] = $type;

        $fields = $requestContext->getAllFields();
        switch(strtolower($type))
        {
            case(Location::TYPE_STATE) : {
                if($requestContext->fieldIsSet('add'))
                {
                    //process state-add request
                    $name = $fields['location-name'];
                    $slogan = $fields['location-slogan'];
                    $latitude = $fields['location-coordinates']['latitude'];
                    $longitude = $fields['location-coordinates']['longitude'];

                    if(strlen($name) and strlen($slogan) and is_numeric($latitude) and is_numeric($longitude))
                    {
                        $new_location = new Location();
                        $new_location->setLocationName($name);
                        $new_location->setSlogan($slogan);
                        $new_location->setLatitude($latitude);
                        $new_location->setLongitude($longitude);
                        $new_location->setLocationType(Location::TYPE_STATE);
                        $new_location->setStatus(Location::STATUS_APPROVED);

                        $requestContext->setFlashData("{$name} state added successfully");
                        $data['status'] = 1;
                    }else{
                        $requestContext->setFlashData('Mandatory fields not set');
                        $data['status'] = 0;
                    }
                }
            } break;
            case(Location::TYPE_LGA) : {
                $all_states = Location::getMapper('Location')->findTypeByStatus(Location::TYPE_STATE, Location::STATUS_APPROVED);
                $data['states'] = $all_states;

                if($requestContext->fieldIsSet('add'))
                {
                    //process LGA-add request
                    $name = $fields['location-name'];
                    $slogan = $fields['location-slogan'];
                    $parent_state = Location::getMapper('Location')->find($fields['parent-state']);
                    $latitude = $fields['location-coordinates']['latitude'];
                    $longitude = $fields['location-coordinates']['longitude'];

                    if(strlen($name) and is_object($parent_state) and is_numeric($latitude) and is_numeric($longitude))
                    {
                        $new_location = new Location();
                        $new_location->setParent($parent_state);
                        $new_location->setLocationName($name);
                        $new_location->setSlogan($slogan);
                        $new_location->setLatitude($latitude);
                        $new_location->setLongitude($longitude);
                        $new_location->setLocationType(Location::TYPE_LGA);
                        $new_location->setStatus(Location::STATUS_APPROVED);

                        $requestContext->setFlashData("{$name} LGA added successfully");
                        $data['status'] = 1;
                    }else{
                        $requestContext->setFlashData('Mandatory fields not set');
                        $data['status'] = 0;
                    }
                }
            } break;
            case(Location::TYPE_DISTRICT) : {
                $all_states = Location::getMapper('Location')->findTypeByStatus(Location::TYPE_STATE, Location::STATUS_APPROVED);
                $all_lgas = Location::getMapper('Location')->findTypeByStatus(Location::TYPE_LGA, Location::STATUS_APPROVED);
                $data['states'] = $all_states;
                $data['lgas'] = $all_lgas;

                if($requestContext->fieldIsSet('add'))
                {
                    //process District-add request
                    $name = $fields['location-name'];
                    $slogan = $fields['location-slogan'];
                    $parent_state = Location::getMapper('Location')->find($fields['parent-state']);
                    $parent_lga = Location::getMapper('Location')->find($fields['parent-lga']);
                    $latitude = $fields['location-coordinates']['latitude'];
                    $longitude = $fields['location-coordinates']['longitude'];

                    if(strlen($name) and is_object($parent_state) and is_object($parent_lga) and $parent_lga->getParent() == $parent_state and is_numeric($latitude) and is_numeric($longitude))
                    {
                        $new_location = new Location();
                        $new_location->setParent($parent_lga);
                        $new_location->setLocationName($name);
                        $new_location->setSlogan($slogan);
                        $new_location->setLatitude($latitude);
                        $new_location->setLongitude($longitude);
                        $new_location->setLocationType(Location::TYPE_DISTRICT);
                        $new_location->setStatus(Location::STATUS_APPROVED);

                        $requestContext->setFlashData("District '{$name}' added successfully");
                        $data['status'] = 1;
                    }else{
                        $requestContext->setFlashData('Mandatory fields not set');
                        $data['status'] = 0;
                    }
                }
            }
        }
        DomainObjectWatcher::instance()->performOperations();

        $data['page-title'] = "Add Location (".ucwords($type).")";
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/add-location.php');
    }

    protected function ManageCategories(RequestContext $requestContext)
    {
        $type = $requestContext->fieldIsSet('type') ? $requestContext->getField('type') : 'report';
        $status = $requestContext->fieldIsSet('status') ? $requestContext->getField('status') : 'approved';
        $action = $requestContext->fieldIsSet('action') ? $requestContext->getField('action') : null;
        $category_ids = $requestContext->fieldIsSet('category-ids') ? $requestContext->getField('category-ids') : array();

        switch(strtolower($action))
        {
            case 'delete' : {
                foreach($category_ids as $category_id)
                {
                    $category_obj = Category::getMapper('Category')->find($category_id);
                    if(is_object($category_obj)) $category_obj->setStatus(Category::STATUS_DELETED);
                }
            } break;
            case 'restore' : {
                foreach($category_ids as $category_id)
                {
                    $category_obj = Category::getMapper('Category')->find($category_id);
                    if(is_object($category_obj)) $category_obj->setStatus(Category::STATUS_APPROVED);
                }
            } break;
            case 'delete permanently' : {
                foreach($category_ids as $category_id)
                {
                    $category_obj = Category::getMapper('Category')->find($category_id);
                    if(is_object($category_obj)) $category_obj->markDelete();
                }
            } break;
            default : {}
        }
        DomainObjectWatcher::instance()->performOperations();

        switch($status)
        {
            case 'approved' : {
                $categories = Category::getMapper('Category')->findTypeByStatus($type, Category::STATUS_APPROVED);
            } break;
            case 'deleted' : {
                $categories = Category::getMapper('Category')->findTypeByStatus($type, Category::STATUS_DELETED);
            } break;
            default : {
                $categories = Category::getMapper('Category')->findAll();
            }
        }

        $data = array();
        $data['type'] = $type;
        $data['status'] = $status;
        $data['categories'] = $categories;
        $data['page-title'] = ucwords($status)." Categories (".ucwords($type).")";
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/manage-categories.php');
    }

    protected function AddCategory(RequestContext $requestContext)
    {
        $data = array();
        $types = array('report', 'post');
        $type = ( $requestContext->fieldIsSet('type') && in_array($requestContext->getField('type'), $types)) ? $requestContext->getField('type') : 'report';
        $data['type'] = $type;

        $fields = $requestContext->getAllFields();
        switch(strtolower($type))
        {
            case(Category::TYPE_REPORT) : {
                $existing_categories = Category::getMapper('Category')->findTypeByStatus(Category::TYPE_REPORT, Category::STATUS_APPROVED);
                $data['categories'] = $existing_categories;

                if($requestContext->fieldIsSet('add'))
                {
                    $caption = $fields['category-caption'];
                    $guid = $fields['category-guid'];
                    $parent = Category::getMapper('Category')->find($fields['category-parent']);

                    if(strlen($caption) and strlen($guid))
                    {
                        $new_category = new Category();
                        $new_category->setGuid($guid);
                        if(is_object($parent)) $new_category->setParent($parent);
                        $new_category->setCaption($caption);
                        $new_category->setType(Category::TYPE_REPORT);
                        $new_category->setStatus(Category::STATUS_APPROVED);

                        $requestContext->setFlashData("Category '{$caption}' added successfully");
                        $data['status'] = 1;
                    }else{
                        $requestContext->setFlashData('Mandatory field(s) not set');
                        $data['status'] = 0;
                    }
                }
            } break;
            case(Location::TYPE_DISTRICT) : {
                $existing_categories = Category::getMapper('Category')->findTypeByStatus(Category::TYPE_POST, Category::STATUS_APPROVED);
                $data['categories'] = $existing_categories;


                if($requestContext->fieldIsSet('add'))
                {
                    $caption = $fields['category-caption'];
                    $guid = $fields['category-guid'];
                    $parent = Category::getMapper('Category')->find($fields['category-parent']);

                    if(strlen($caption) and strlen($guid))
                    {
                        $new_category = new Category();
                        $new_category->setGuid($guid);
                        if(is_object($parent)) $new_category->setParent($parent);
                        $new_category->setCaption($caption);
                        $new_category->setType(Category::TYPE_POST);
                        $new_category->setStatus(Category::STATUS_APPROVED);

                        $requestContext->setFlashData("Category '{$caption}' added successfully");
                        $data['status'] = 1;
                    }else{
                        $requestContext->setFlashData('Mandatory fields not set');
                        $data['status'] = 0;
                    }
                }
            }
        }
        DomainObjectWatcher::instance()->performOperations();

        $data['page-title'] = "Add Category (".ucwords($type).")";
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/add-category.php');
    }
}