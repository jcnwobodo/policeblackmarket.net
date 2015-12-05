<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackmarket
 * Date:    11/17/2015
 * Time:    5:40 PM
 **/

namespace Application\Commands;

use Application\Models\Collections\CategoryCollection;
use Application\Models\Location;
use Application\Models\Report;
use Application\Models\User;
use System\Request\RequestContext;
use Application\Models\Category;
use System\Utilities\DateTime;

class SubmitReportCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $data = array();
        $data['categories'] = Category::getMapper('Category')->findByType('report');
        $data['location-states'] = Location::getMapper('Location')->findByType('state');
        $data['location-lgas'] = Location::getMapper('Location')->findByType('lga');
        $data['location-districts'] = Location::getMapper('Location')->findByType('district');
        $data['page-title'] = "Submit Report";

        $requestContext->setView('page-submit-report.php');
        $requestContext->setResponseData($data);

        if($requestContext->fieldIsSet('submit'))
        {
            $this->doSubmit($requestContext);
        }
    }

    private function doSubmit(RequestContext $requestContext)
    {
        $data = $requestContext->getAllFields();
        $title = $data['report_title'];
        $description = $data['report_description'];
        $date = $data['report_date'];
        $time = $data['report_time'];
        $categories = isset($data['report_categories']) ? $data['report_categories'] : null;
        $location_state = Location::getMapper('Location')->find($data['location_state']);
        $location_lga = Location::getMapper('Location')->find($data['location_lga']);
        $location_district = Location::getMapper('Location')->find($data['location_district']);
        $location_scene = $data['location_scene'];
        $evidence_news = $data['evidence_news'];
        $evidence_video = $data['evidence_video'];
        $evidence_photos = $data['evidence_photos']; //TODO handle photo upload
        $reporter_first_name = $data['reporter_first-name'];
        $reporter_last_name = $data['reporter_last-name'];
        $reporter_email = $data['reporter_email'];
        $reporter_phone = $data['reporter_phone'];

        /*Ensure that mandatory data is supplied, then create a report object*/
        if(
            strlen($title) &&
            strlen($description) &&
            checkdate($date['month'], $date['day'], $date['year']) &&
            DateTime::checktime($time['hour'], $time['minute'], 0) &&
            is_array($categories) &&
            strlen($reporter_email))
        {
            $event_time = new DateTime();
            $report_time = new DateTime($date['year'], $date['month'], $date['day'], $time['hour'], $time['minute'], 0);

            $report_categories = new CategoryCollection();
            foreach($categories as $category)
            {
                $category_obj = Category::getMapper('Category')->find($category);
                if(!is_null($category_obj)) $report_categories->add($category_obj);
            }

            $reporter = User::getMapper('User')->findByEmail($reporter_email);
            if(!is_object($reporter))
            {
                $reporter = new User();
                $reporter->setUsername($reporter_email);
                $reporter->setFirstName($reporter_first_name)->setLastName($reporter_last_name);
                $reporter->setDateOfBirth(new DateTime())->setDateJoined(new DateTime());
                $reporter->setPlaceOfOrigin($location_district)->setPlaceOfResidence($location_district);
                $reporter->setEmail($reporter_email)->setPhone($reporter_phone);
                $reporter->setUserType($reporter::USER_TYPE_USER);
                $reporter->setStatus($reporter::STATUS_INACTIVE);
                $reporter->mapper()->insert($reporter);
            }

            $report = new Report();
            $report->setTitle($title)->setDescription(format_text($description))->setEventTime($event_time)->setReportTime($report_time);
            $report->setCategories($report_categories);
            $report->setLocationState($location_state)->setLocationLga($location_lga)->setLocationDistrict($location_district)->setLocationScene($location_scene);
            $report->setNewsSources($evidence_news)->setVideoLinks($evidence_video);
            //TODO handle uploaded photos
            $report->setReporter($reporter);
            $report->setStatus($report::STATUS_PENDING);
        }
    }
}