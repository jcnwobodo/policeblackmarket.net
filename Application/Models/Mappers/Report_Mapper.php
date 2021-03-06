<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/23/2015
 * Time:    3:11 AM
 **/

namespace Application\Models\Mappers;

use Application\Models;
use System\Models\Collections\Collection;
use System\Models\Mappers\MapperRegistry;
use System\Utilities\DateTime;

class Report_Mapper extends A_Mapper
{
    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare("SELECT * FROM pbm_reports WHERE id=?");
        $this->selectAllStmt = self::$PDO->prepare("SELECT * FROM pbm_reports");
        /**  TODO
         *      selectByCategoryStmt
         *      selectByTimeRangeStmt
         *      selectByLocationStmt
        **/
        $this->selectByStatusStmt = self::$PDO->prepare("SELECT * FROM pbm_reports WHERE status=:post_status ORDER BY id DESC LIMIT :row_count OFFSET :offset");
        $this->updateStmt = self::$PDO->prepare("UPDATE pbm_reports SET title=?, description=?, event_time=?, report_time=?, location_state=?, location_lga=?, location_district=?, location_scene=?, reporter=?, status=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare("INSERT INTO pbm_reports (title, description, event_time, report_time, location_state,location_lga, location_district, location_scene, reporter, status) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $this->deleteStmt = self::$PDO->prepare("DELETE FROM pbm_reports WHERE id=?");
    }

    public function findByStatus($post_status, $row_count=10, $offset=0)
    {
        $this->selectByStatusStmt->bindParam(':post_status', $post_status, \PDO::PARAM_STR);
        $this->selectByStatusStmt->bindParam(':row_count', $row_count, \PDO::PARAM_INT);
        $this->selectByStatusStmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $this->selectByStatusStmt->execute();
        $raw_data = $this->selectByStatusStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    public function targetClass()
    {
        return "Application\\Models\\Report";
    }

    protected function doCreateObject(array $array)
    {
        $class = $this->targetClass();
        $object = new $class($array['id']);
        $object->setTitle($array['title']);
        $object->setDescription($array['description']);
        $object->setEventTime(DateTime::getDateTimeObjFromInt($array['event_time']));
        $object->setReportTime(DateTime::getDateTimeObjFromInt($array['report_time']));
        $location_state = Models\Location::getMapper("Location")->find($array['location_state']);
        if(! is_null($location_state)) $object->setLocationState($location_state);
        $location_lga = Models\Location::getMapper("Location")->find($array['location_lga']);
        if(! is_null($location_lga)) $object->setLocationLga($location_lga);
        $location_district = Models\Location::getMapper("Location")->find($array['location_district']);
        if(! is_null($location_district)) $object->setLocationDistrict($location_district);
        $object->setLocationScene($array['location_scene']);
        $reporter = Models\User::getMapper('User')->find($array['reporter']);
        $object->setReporter($reporter);
        $object->setStatus($array['status']);
        $this->setReportMeta($object);

        return $object;
    }

    protected function doInsert(Models\A_DomainObject $object)
    {
        $values = array(
            $object->getTitle(),
            $object->getDescription(),
            $object->getEventTime()->getDateTimeInt(),
            $object->getReportTime()->getDateTimeInt(),
            $object->getLocationState()->getId(),
            $object->getLocationLga()->getId(),
            $object->getLocationDistrict()->getId(),
            $object->getLocationScene(),
            $object->getReporter()->getId(),
            $object->getStatus()
        );
        $this->insertStmt->execute($values);
        $id = self::$PDO->lastInsertId();
        $object->setId($id);
        $this->updateReportMeta($object);
    }

    protected function doUpdate(Models\A_DomainObject $object)
    {
        $values = array(
            $object->getTitle(),
            $object->getDescription(),
            $object->getEventTime()->getDateTimeInt(),
            $object->getReportTime()->getDateTimeInt(),
            $object->getLocationState()->getId(),
            $object->getLocationLga()->getId(),
            $object->getLocationDistrict()->getId(),
            $object->getLocationScene(),
            $object->getReporter()->getId(),
            $object->getStatus(),
            $object->getId()
        );
        $this->updateStmt->execute($values);
        $this->updateReportMeta($object);
    }

    protected function doDelete(Models\A_DomainObject $object)
    {
        $values = array($object->getId());
        $this->deleteReportMeta($object);
        $this->deleteReportComments($object);
        $this->deleteStmt->execute($values);
    }

    protected function selectStmt()
    {
        return $this->selectStmt;
    }

    protected function selectAllStmt()
    {
        return $this->selectAllStmt;
    }

    /*Report Meta Processing*/
    public function setReportMeta(Models\Report $report)
    {
        $this->setReportCategories($report);
        $this->setRelatedReports($report);
        $this->setNewsSourceLinks($report);
        $this->setReportVideoLinks($report);
        $this->setReportPhotos($report);
    }
    public function deleteReportMeta(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $report_meta_mapper->deleteAllReportMeta($report);
    }
    public function deleteReportComments(Models\Report $report)
    {
        $comment_mapper = MapperRegistry::getMapper('Comment');
        $comment_mapper->deleteByPostId($report->getId());
    }
    public function updateReportMeta(Models\Report $report)
    {
        $this->updateReportCategories($report);
        $this->updateRelatedReports($report);
        $this->updateNewsSourceLinks($report);
        $this->updateVideoLinks($report);
        $this->updateReportPhotos($report);
    }

    private function setReportCategories(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $category_mapper = MapperRegistry::getMapper("Category");
        $categories_meta = $report_meta_mapper->findReportMeta($report, Models\ReportMeta::MT_CAT);
        $categories_collection = new Collection($category_mapper);
        foreach($categories_meta as $category_meta)
        {
            $category_object = $category_mapper->find($category_meta->getMetaValue());
            if(is_object($category_object)) $categories_collection->add($category_object);
        }
        $report->setCategories($categories_collection);
        return $this;
    }
    private function updateReportCategories(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $report_meta_mapper->deleteReportMeta($report, Models\ReportMeta::MT_CAT);
        $categories = $report->getCategories();
        if(is_object($categories))
        {
            foreach($categories as $category)
            {
                $meta_object = new Models\ReportMeta();
                $meta_object->setReportId($report->getId());
                $meta_object->setMetaType(Models\ReportMeta::MT_CAT);
                $meta_object->setMetaValue($category->getId());
                $meta_object->markNew();
            }
        }
    }

    private function setRelatedReports(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $rel_reports_meta = $report_meta_mapper->findReportMeta($report, Models\ReportMeta::MT_RR);
        $reports_collection = new Collection($report->mapper());
        foreach($rel_reports_meta as $report_meta)
        {
            $report_object = $this->find($report_meta->getMetaValue());
            if(is_object($report_object)) $reports_collection->add($report_object);
        }
        $report->setRelatedReports($reports_collection);
        return $this;
    }
    private function updateRelatedReports(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $report_meta_mapper->deleteReportMeta($report, Models\ReportMeta::MT_RR);
        $related_reports = $report->getRelatedReports();
        if(is_object($related_reports))
        {
            foreach($related_reports as $related_report)
            {
                $meta_object = new Models\ReportMeta();
                $meta_object->setReportId($report->getId());
                $meta_object->setMetaType(Models\ReportMeta::MT_RR);
                $meta_object->setMetaValue($related_report->getId());
            }
        }
    }

    private function setNewsSourceLinks(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $news_source_meta = $report_meta_mapper->findReportMeta($report, Models\ReportMeta::MT_NS);
        $news_source_links = array();
        foreach($news_source_meta as $news_source)
        {
            $news_source_links[] = $news_source->getMetaValue();
        }
        $report->setNewsSources($news_source_links);
        return $this;
    }
    private function updateNewsSourceLinks(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $report_meta_mapper->deleteReportMeta($report, Models\ReportMeta::MT_NS);
        $news_links = $report->getNewsSources();
        if(is_array($news_links))
        {
            foreach($news_links as $news_link)
            {
                if(strlen($news_link))
                {
                    $meta_object = new Models\ReportMeta();
                    $meta_object->setReportId($report->getId());
                    $meta_object->setMetaType(Models\ReportMeta::MT_NS);
                    $meta_object->setMetaValue($news_link);
                }
            }
        }
    }

    private function setReportVideoLinks(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $video_links_meta = $report_meta_mapper->findReportMeta($report, Models\ReportMeta::MT_VID);
        $video_links = array();
        foreach($video_links_meta as $video_link)
        {
            $video_links[] = $video_link->getMetaValue();
        }
        $report->setVideoLinks($video_links);
        return $this;
    }
    private function updateVideoLinks(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $report_meta_mapper->deleteReportMeta($report, Models\ReportMeta::MT_VID);
        $video_links = $report->getVideoLinks();
        if(is_array($video_links))
        {
            foreach($video_links as $video_link)
            {
                if(strlen($video_link))
                {
                    $meta_object = new Models\ReportMeta();
                    $meta_object->setReportId($report->getId());
                    $meta_object->setMetaType(Models\ReportMeta::MT_VID);
                    $meta_object->setMetaValue($video_link);
                }
            }
        }
    }

    private function setReportPhotos(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $report_photo_mapper = MapperRegistry::getMapper("Upload");
        $report_photos_meta = $report_meta_mapper->findReportMeta($report, Models\ReportMeta::MT_PHOTO);
        $photo_collection = new Collection($report_photo_mapper);
        foreach($report_photos_meta as $report_photo_meta)
        {
            $upload_object = $report_photo_mapper->find($report_photo_meta->getMetaValue());
            if(is_object($upload_object)) $photo_collection->add($upload_object);
        }
        $report->setPhotos($photo_collection);
        return $this;
    }
    private function updateReportPhotos(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $report_meta_mapper->deleteReportMeta($report, Models\ReportMeta::MT_PHOTO);
        $report_photos = $report->getPhotos();
        if(is_object($report_photos))
        {
            foreach($report_photos as $report_photo)
            {
                $meta_object = new Models\ReportMeta();
                $meta_object->setReportId($report->getId());
                $meta_object->setMetaType(Models\ReportMeta::MT_PHOTO);
                $meta_object->setMetaValue($report_photo->getId());
            }
        }
    }
}