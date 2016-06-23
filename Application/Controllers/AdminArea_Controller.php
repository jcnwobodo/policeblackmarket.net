<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    11/1/2015
 * Time:    5:14 PM
 */

namespace Application\Controllers;

use Application\Models\Category;
use Application\Models\Post;
use System\Models\DomainObjectWatcher;
use System\Request\RequestContext;
use Application\Models\User;
use Application\Models\Comment;
use Application\Models\Location;
use Application\Models\Report;
use System\Utilities\DateTime;

class AdminArea_Controller extends A_SecurePage_Controller
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
        $status = $requestContext->fieldIsSet('status',INPUT_GET) ? $requestContext->getField('status',INPUT_GET) : 'pending';
        $action = $requestContext->fieldIsSet('action',INPUT_POST) ? $requestContext->getField('action',INPUT_POST) : null;
        $reports_ids = $requestContext->fieldIsSet('report-ids',INPUT_POST) ? $requestContext->getField('report-ids',INPUT_POST) : array();

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
        $status = $requestContext->fieldIsSet('status',INPUT_GET) ? $requestContext->getField('status',INPUT_GET) : 'pending';
        $action = $requestContext->fieldIsSet('action',INPUT_POST) ? $requestContext->getField('action',INPUT_POST) : null;
        $comment_ids = $requestContext->fieldIsSet('comment-ids',INPUT_POST) ? $requestContext->getField('comment-ids',INPUT_POST) : array();

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
        $type = $requestContext->fieldIsSet('type',INPUT_GET) ? $requestContext->getField('type',INPUT_GET) : 'district';
        $status = $requestContext->fieldIsSet('status',INPUT_GET) ? $requestContext->getField('status',INPUT_GET) : 'approved';
        $action = $requestContext->fieldIsSet('action',INPUT_POST) ? $requestContext->getField('action',INPUT_POST) : null;
        $location_ids = $requestContext->fieldIsSet('location-ids',INPUT_POST) ? $requestContext->getField('location-ids',INPUT_POST) : array();

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
        $type = (
            $requestContext->fieldIsSet('type',INPUT_GET)
            && in_array($requestContext->getField('type',INPUT_GET), $types))
                ? $requestContext->getField('type',INPUT_GET) : 'district';
        $data['type'] = $type;

        $fields = $requestContext->getAllFields(INPUT_POST);
        switch(strtolower($type))
        {
            case(Location::TYPE_STATE) : {
                if($requestContext->fieldIsSet('add',INPUT_POST))
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

                if($requestContext->fieldIsSet('add',INPUT_POST))
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

                if($requestContext->fieldIsSet('add',INPUT_POST))
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
        $type = $requestContext->fieldIsSet('type',INPUT_GET) ? $requestContext->getField('type',INPUT_GET) : 'report';
        $status = $requestContext->fieldIsSet('status',INPUT_GET) ? $requestContext->getField('status',INPUT_GET) : 'approved';
        $action = $requestContext->fieldIsSet('action',INPUT_POST) ? $requestContext->getField('action',INPUT_POST) : null;
        $category_ids = $requestContext->fieldIsSet('category-ids',INPUT_POST) ? $requestContext->getField('category-ids',INPUT_POST) : array();

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
        $types = array('report', 'news');
        $type = ( $requestContext->fieldIsSet('type',INPUT_GET)
            && in_array($requestContext->getField('type',INPUT_GET), $types))
                ? $requestContext->getField('type',INPUT_GET) : 'report';
        $data['type'] = $type;

        $fields = $requestContext->getAllFields(INPUT_POST);
        switch(strtolower($type))
        {
            case(Category::TYPE_REPORT) : {
                $existing_categories = Category::getMapper('Category')->findTypeByStatus(Category::TYPE_REPORT, Category::STATUS_APPROVED);
                $data['categories'] = $existing_categories;

                if($requestContext->fieldIsSet('add',INPUT_POST))
                {
                    $caption = $fields['category-caption'];
                    $guid = strtolower($fields['category-guid']);
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
            case(Category::TYPE_NEWS) : {
                $existing_categories = Category::getMapper('Category')->findTypeByStatus(Category::TYPE_NEWS, Category::STATUS_APPROVED);
                $data['categories'] = $existing_categories;


                if($requestContext->fieldIsSet('add',INPUT_POST))
                {
                    $caption = $fields['category-caption'];
                    $guid = strtolower($fields['category-guid']);
                    $parent = Category::getMapper('Category')->find($fields['category-parent']);

                    if(strlen($caption) and strlen($guid))
                    {
                        $new_category = new Category();
                        $new_category->setGuid($guid);
                        if(is_object($parent)) $new_category->setParent($parent);
                        $new_category->setCaption($caption);
                        $new_category->setType(Category::TYPE_NEWS);
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

    protected function AddNewsPost(RequestContext $requestContext)
    {
        $data = array();

        $data['mode'] = 'create-post';
        $data['page-title'] = "Create News-Post";
        $news_categories = Category::getMapper('Category')->findTypeByStatus(Category::TYPE_NEWS, Category::STATUS_APPROVED);
        $data['categories'] = $news_categories;

        $requestContext->setResponseData($data);
        $requestContext->setView('admin/news-post-editor.php');

        if($requestContext->fieldIsSet($data['mode'], INPUT_POST))
        {
            $this->processNewsPostEditor($requestContext);
        }
    }

    protected function UpdateNewsPost(RequestContext $requestContext)
    {
        $data = array();

        $data['mode'] = 'update-post';
        $data['page-title'] = "Update News-Post";
        $news_categories = Category::getMapper('Category')->findTypeByStatus(Category::TYPE_NEWS, Category::STATUS_APPROVED);
        $data['categories'] = $news_categories;

        if($requestContext->fieldIsSet('post-id',INPUT_GET))
        {
            $post = Post::getMapper('Post')->find($requestContext->getField('post-id'));
            $fields = array();
            $fields['post-title'] = $post->getTitle();
            $fields['post-url'] = $post->getGuid();
            $fields['post-content'] = remove_text_formatting($post->getContent());
            $fields['post-excerpt'] = remove_text_formatting($post->getExcerpt());
            $fields['post-category'] = $post->getCategory()->getId();
            $fields['post-date']['month'] = $post->getDateCreated()->getMonth();
            $fields['post-date']['day'] = $post->getDateCreated()->getDay();
            $fields['post-date']['year'] = $post->getDateCreated()->getYear();
            $fields['post-time']['hour'] = date('g', $post->getDateCreated()->getDateTimeInt() );
            $fields['post-time']['minute'] = date('i', $post->getDateCreated()->getDateTimeInt() );
            $fields['post-time']['am_pm'] = date('A', $post->getDateCreated()->getDateTimeInt() );
            $data['post-id'] = $fields['post-id'] = $post->getId();
            $data['fields'] = $fields;
        }

        $requestContext->setResponseData($data);
        $requestContext->setView('admin/news-post-editor.php');

        if($requestContext->fieldIsSet($data['mode'], INPUT_POST))
        {
            $this->processNewsPostEditor($requestContext);
        }

    }

    protected function ManageNewsPosts(RequestContext $requestContext)
    {
        $status = $requestContext->fieldIsSet('status', INPUT_GET) ? $requestContext->getField('status', INPUT_GET) : 'published';
        $action = $requestContext->fieldIsSet('action',INPUT_POST) ? $requestContext->getField('action',INPUT_POST) : null;
        $post_ids = $requestContext->fieldIsSet('post-ids',INPUT_POST) ? $requestContext->getField('post-ids',INPUT_POST) : array();

        switch(strtolower($action))
        {
            case 'delete' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->setStatus(Post::STATUS_DELETED);
                }
            } break;
            case 'restore' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->setStatus(Post::STATUS_DRAFT);
                }
            } break;
            case 'publish' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->setStatus(Post::STATUS_PUBLISHED);
                }
            } break;
            case 'un-publish' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->setStatus(Post::STATUS_DRAFT);
                }
            } break;
            case 'delete permanently' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->markDelete();
                }
            } break;
            default : {}
        }
        DomainObjectWatcher::instance()->performOperations();

        switch($status)
        {
            case 'published' : {
                $posts = Post::getMapper('Post')->findTypeByStatus(Post::TYPE_NEWS, Post::STATUS_PUBLISHED);
            } break;
            case 'draft' : {
                $posts = Post::getMapper('Post')->findTypeByStatus(Post::TYPE_NEWS, Post::STATUS_DRAFT);
            } break;
            case 'deleted' : {
                $posts = Post::getMapper('Post')->findTypeByStatus(Post::TYPE_NEWS, Post::STATUS_DELETED);
            } break;
            default : {
                $posts = Post::getMapper('Post')->findAll();
            }
        }

        $data = array();
        $data['status'] = $status;
        $data['posts'] = $posts;
        $data['page-title'] = ucwords($status)." News Posts";
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/manage-news-posts.php');
    }

    private function processNewsPostEditor(RequestContext $requestContext)
    {
        $data = $requestContext->getResponseData();
        $fields = $requestContext->getAllFields(INPUT_POST);

        $title = $fields['post-title'];
        $guid = strtolower( str_replace(array(' '), array('-'), $fields['post-url']) );
        $content = $fields['post-content'];
        $excerpt = $fields['post-excerpt'];
        $category = Category::getMapper('Category')->find($fields['post-category']);
        $date = $fields['post-date'];
        $time = $fields['post-time'];
        $time['hour'] = (strtolower($time['am_pm'])=='pm' and $time['hour']!=12)? ($time['hour']+12) : $time['hour'];
        $time['hour'] = (strtolower($time['am_pm'])=='am' and $time['hour']==12)? 0 : $time['hour'];

        if(
            strlen($title)
            and strlen($guid)
            and strlen($content)
            and is_object($category)
            and checkdate($date['month'], $date['day'], $date['year'])
            and DateTime::checktime($time['hour'], $time['minute'])
        )
        {
            $post = $data['mode'] == 'create-post' ? new Post() : Post::getMapper('Post')->find($data['post-id']);
            if(is_object($post))
            {
                $post->setPostType(Post::TYPE_NEWS);
                $post->setGuid($guid);
                $post->setTitle($title);
                $post->setContent(format_text($content));
                $post->setExcerpt(format_text($excerpt));
                $post->setCategory($category);
                $post->setAuthor($requestContext->getSession()->getSessionUser());
                $post->setDateCreated(new DateTime(mktime($time['hour'],$time['minute'],0,$date['month'],$date['day'],$date['year'])));
                $post->setLastUpdate(new DateTime());

                DomainObjectWatcher::instance()->performOperations();
                $requestContext->setFlashData($data['mode'] == 'create-post' ? "Post created successfully" : "Post updated successfully");

                $data['status'] = 1;
                $data['post-id'] = $post->getId();
                $data['mode'] = 'update-post';
                $data['fields'] = &$fields;
            }
        }else{
            $requestContext->setFlashData('Mandatory field(s) not set or invalid input detected');
            $data['status'] = 0;
        }
        $requestContext->setResponseData($data);
    }

    protected function AddPage(RequestContext $requestContext)
    {
        $data = array();

        $data['mode'] = 'create-page';
        $data['page-title'] = "Create Page";

        $requestContext->setResponseData($data);
        $requestContext->setView('admin/page-editor.php');

        if($requestContext->fieldIsSet($data['mode'],INPUT_POST))
        {
            $this->processPageEditor($requestContext);
        }
    }

    protected function UpdatePage(RequestContext $requestContext)
    {
        $data = array();

        $data['mode'] = 'update-page';
        $data['page-title'] = "Update Page";

        $page = $requestContext->fieldIsSet('page-id',INPUT_GET) ? Post::getMapper('Post')->find($requestContext->getField('page-id',INPUT_GET)) : null;
        $fields = array();
        if(is_object($page))
        {
            $fields['page-title'] = $page->getTitle();
            $fields['page-url'] = $page->getGuid();
            $fields['page-content'] = remove_text_formatting($page->getContent());
            $fields['page-excerpt'] = remove_text_formatting($page->getExcerpt());
            $fields['page-date']['month'] = $page->getDateCreated()->getMonth();
            $fields['page-date']['day'] = $page->getDateCreated()->getDay();
            $fields['page-date']['year'] = $page->getDateCreated()->getYear();
            $fields['page-time']['hour'] = date('g', $page->getDateCreated()->getDateTimeInt() );
            $fields['page-time']['minute'] = date('i', $page->getDateCreated()->getDateTimeInt() );
            $fields['page-time']['am_pm'] = date('A', $page->getDateCreated()->getDateTimeInt() );
            $data['page-id'] = $fields['page-id'] = $page->getId();
        }
        $data['fields'] = $fields;

        $requestContext->setResponseData($data);
        $requestContext->setView('admin/page-editor.php');

        if($requestContext->fieldIsSet($data['mode'], INPUT_POST))
        {
            $this->processPageEditor($requestContext);
        }

    }

    protected function ManagePages(RequestContext $requestContext)
    {
        $status = $requestContext->fieldIsSet('status', INPUT_GET) ? $requestContext->getField('status', INPUT_GET) : 'published';
        $action = $requestContext->fieldIsSet('action', INPUT_POST) ? $requestContext->getField('action', INPUT_POST) : null;
        $post_ids = $requestContext->fieldIsSet('page-ids', INPUT_POST) ? $requestContext->getField('page-ids', INPUT_POST) : array();

        switch(strtolower($action))
        {
            case 'delete' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->setStatus(Post::STATUS_DELETED);
                }
            } break;
            case 'restore' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->setStatus(Post::STATUS_DRAFT);
                }
            } break;
            case 'publish' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->setStatus(Post::STATUS_PUBLISHED);
                }
            } break;
            case 'un-publish' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->setStatus(Post::STATUS_DRAFT);
                }
            } break;
            case 'delete permanently' : {
                foreach($post_ids as $post_id)
                {
                    $post_obj = Post::getMapper('Post')->find($post_id);
                    if(is_object($post_obj)) $post_obj->markDelete();
                }
            } break;
            default : {}
        }
        DomainObjectWatcher::instance()->performOperations();

        switch($status)
        {
            case 'published' : {
                $posts = Post::getMapper('Post')->findTypeByStatus(Post::TYPE_PAGE, Post::STATUS_PUBLISHED);
            } break;
            case 'draft' : {
                $posts = Post::getMapper('Post')->findTypeByStatus(Post::TYPE_PAGE, Post::STATUS_DRAFT);
            } break;
            case 'deleted' : {
                $posts = Post::getMapper('Post')->findTypeByStatus(Post::TYPE_PAGE, Post::STATUS_DELETED);
            } break;
            default : {
                $posts = Post::getMapper('Post')->findAll();
            }
        }

        $data = array();
        $data['status'] = $status;
        $data['pages'] = $posts;
        $data['page-title'] = ucwords($status)." Pages";
        $requestContext->setResponseData($data);
        $requestContext->setView('admin/manage-pages.php');
    }

    private function processPageEditor(RequestContext $requestContext)
    {
        $data = $requestContext->getResponseData();
        $fields = $requestContext->getAllFields(INPUT_POST);

        $title = $fields['page-title'];
        $guid = strtolower( str_replace(array(' '), array('-'), $fields['page-url']) );
        $content = $fields['page-content'];
        $excerpt = $fields['page-excerpt'];
        $date = $fields['page-date'];
        $time = $fields['page-time'];
        $time['hour'] = (strtolower($time['am_pm'])=='pm' and $time['hour']!=12)? ($time['hour']+12) : $time['hour'];
        $time['hour'] = (strtolower($time['am_pm'])=='am' and $time['hour']==12)? 0 : $time['hour'];

        if(
            strlen($title)
            and strlen($guid)
            and strlen($content)
            and checkdate($date['month'], $date['day'], $date['year'])
            and DateTime::checktime($time['hour'], $time['minute'])
        )
        {
            $post = $data['mode'] == 'create-page' ? new Post() : Post::getMapper('Post')->find($data['page-id']);
            if(is_object($post))
            {
                $post->setPostType(Post::TYPE_PAGE);
                $post->setGuid($guid);
                $post->setTitle($title);
                $post->setContent(format_text($content));
                $post->setExcerpt(format_text($excerpt));
                $post->setAuthor($requestContext->getSession()->getSessionUser());
                $post->setDateCreated(new DateTime(mktime($time['hour'],$time['minute'],0,$date['month'],$date['day'],$date['year']) ));
                $post->setLastUpdate(new DateTime());

                DomainObjectWatcher::instance()->performOperations();
                $requestContext->setFlashData($data['mode'] == 'create-page' ? "Page created successfully" : "Page updated successfully");

                $data['status'] = 1;
                $data['page-id'] = $post->getId();
                $data['mode'] = 'update-page';
                $data['fields'] = &$fields;
            }
        }else{
            $requestContext->setFlashData('Mandatory field(s) not set or invalid input detected');
            $data['status'] = 0;
        }
        $requestContext->setResponseData($data);
    }
}