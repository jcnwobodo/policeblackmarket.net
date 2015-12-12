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
        $data['categories'] = Category::getMapper('Category')->findTypeByStatus(Category::TYPE_REPORT, Category::STATUS_APPROVED);
        $data['location-states'] = Location::getMapper('Location')->findTypeByStatus(Location::TYPE_STATE, Location::STATUS_APPROVED);
        $data['location-lgas'] = Location::getMapper('Location')->findTypeByStatus(Location::TYPE_LGA, Location::STATUS_APPROVED);
        $data['location-districts'] = Location::getMapper('Location')->findTypeByStatus(Location::TYPE_DISTRICT, Location::STATUS_APPROVED);
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
        $data = $requestContext->getResponseData();
        $data['status'] = false;

        $fields = $requestContext->getAllFields();
        $title = $fields['report_title'];
        $description = $fields['report_description'];
        $date = $fields['report_date'];
        $time = $fields['report_time'];
        $categories = isset($fields['report_categories']) ? $fields['report_categories'] : null;
        $location_state = Location::getMapper('Location')->find($fields['location_state']);
        $location_lga = Location::getMapper('Location')->find($fields['location_lga']);
        $location_district = Location::getMapper('Location')->find($fields['location_district']);
        $location_scene = $fields['location_scene'];
        $evidence_news = $fields['evidence_news'];
        $evidence_video = $fields['evidence_video'];
        $evidence_photos = $fields['evidence_photos']; //TODO handle photo upload
        $reporter_first_name = $fields['reporter_first-name'];
        $reporter_last_name = $fields['reporter_last-name'];
        $reporter_email = $fields['reporter_email'];
        $reporter_phone = $fields['reporter_phone'];

        /*Ensure that mandatory data is supplied, then create a report object*/
        if(
            strlen($title) and
            strlen($description) and
            checkdate($date['month'], $date['day'], $date['year']) and
            DateTime::checktime($time['hour'], $time['minute'], 0) and
            is_array($categories) and
            strlen($reporter_email) and
            $location_district->getParent() == $location_lga and $location_lga->getParent() == $location_state
        )
        {
            $event_time = new DateTime();
            $report_time = new DateTime(new DateTime(mktime($time['hour'],$time['minute'],0,$date['month'],$date['day'],$date['year']) ));

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

            $requestContext->setFlashData("Your report has been received and shall be reviewed within 24hrs.");
            $data['status'] = true;
        }
        else{
            $requestContext->setFlashData("You need to supply valid data before you can proceed with report submission.");
        }

        $requestContext->setResponseData($data);
    }
}