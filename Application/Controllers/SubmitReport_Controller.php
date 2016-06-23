<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackmarket
 * Date:    11/17/2015
 * Time:    5:40 PM
 **/

namespace Application\Controllers;

use Application\Models\Location;
use Application\Models\Report;
use Application\Models\Upload;
use Application\Models\User;
use System\Models\Collections\Collection;
use System\Request\RequestContext;
use Application\Models\Category;
use System\Utilities\DateTime;
use System\Utilities\UploadHandler;

class SubmitReport_Controller extends A_Controller
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

        if($requestContext->fieldIsSet('submit', INPUT_POST))
        {
            $this->doSubmit($requestContext);
        }
    }

    private function doSubmit(RequestContext $requestContext)
    {
        $data = $requestContext->getResponseData();
        $data['status'] = false;

        $fields = $requestContext->getAllFields(INPUT_POST);
        $files = $requestContext->getAllFiles();
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
        $evidence_photos = strlen($_FILES['evidence_photos1']['name']) ? $_FILES['evidence_photos1'] : null;
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
            $time['hour'] = (strtolower($time['am_pm'])=='pm' and $time['hour']!=12)? ($time['hour']+12) : $time['hour'];
            $time['hour'] = (strtolower($time['am_pm'])=='am' and $time['hour']==12)? 0 : $time['hour'];
            $event_time = new DateTime(mktime($time['hour'],$time['minute'],0,$date['month'],$date['day'],$date['year']));
            $report_time = new DateTime();

            $reporter = User::getMapper('User')->findByEmail($reporter_email);
            if(!is_object($reporter))
            {
                $reporter = new User();
                $reporter->setUsername($reporter_email);
                $reporter->setPassword('password');
                $reporter->setFirstName($reporter_first_name)->setLastName($reporter_last_name);
                $reporter->setDateOfBirth(new DateTime())->setDateJoined(new DateTime());
                $reporter->setPlaceOfOrigin($location_district)->setPlaceOfResidence($location_district);
                $reporter->setEmail($reporter_email)->setPhone($reporter_phone);
                $reporter->setUserType($reporter::USER_TYPE_USER);
                $reporter->setStatus($reporter::STATUS_INACTIVE);
                $reporter->mapper()->insert($reporter);
            }

            //Handle photo upload
            $photo_handled = true;
            $photo_collection = new Collection(Upload::getMapper('Upload'));
            //TODO enhance code to support multiple file upload
            if(!is_null($evidence_photos))
            {
                $photo_handled = false;
                $uploader = new UploadHandler('evidence_photos1', uniqid('reports_'));
                $uploader->setAllowedExtensions(array('jpg','png','gif'));
                $uploader->setUploadDirectory("Uploads".DIRECTORY_SEPARATOR.date('Y')."-".date('M'));
                $uploader->setMaxUploadSize(3);
                $uploader->doUpload();
                if($uploader->getUploadStatus())
                {
                    $photo = new Upload();
                    $photo->setAuthor($reporter);
                    $photo->setUploadTime(new DateTime());
                    $photo->setLocation($uploader->getUploadDirectory());
                    $photo->setFileName($uploader->getOutputFileName().".".$uploader->getFileExtension());
                    $photo->setFileSize($uploader->getFileSize());

                    $photo_collection->add($photo);
                    $photo_handled = true;
                }
                else
                {
                    $data['status'] = false;
                    $requestContext->setFlashData("Error Uploading Photo - ".$uploader->getStatusMessage());
                }
            }


            if($photo_handled)
            {
                $category_mapper = Category::getMapper('Category');
                $report_categories = new Collection($category_mapper);
                foreach($categories as $category)
                {
                    $category_obj = $category_mapper->find($category);
                    if(!is_null($category_obj)) $report_categories->add($category_obj);
                }

                $report = new Report();
                $report->setTitle($title);
                $report->setDescription(format_text($description));
                $report->setEventTime($event_time);
                $report->setReportTime($report_time);
                $report->setCategories($report_categories);
                $report->setLocationState($location_state);
                $report->setLocationLga($location_lga);
                $report->setLocationDistrict($location_district);
                $report->setLocationScene($location_scene);
                $report->setPhotos($photo_collection);
                $report->setNewsSources($evidence_news);
                $report->setVideoLinks($evidence_video);
                $report->setReporter($reporter);
                $report->setStatus($report::STATUS_PENDING);

                $requestContext->setFlashData("Your report has been received and shall be reviewed within 24hrs.");
                $data['status'] = true;
            }
        }
        else{
            $requestContext->setFlashData("You need to supply valid data before you can proceed with report submission.");
        }

        $requestContext->setResponseData($data);
    }
}