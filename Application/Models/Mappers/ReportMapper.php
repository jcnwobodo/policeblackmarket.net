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
use System\Models\Mappers\MapperRegistry;
use System\Utilities\DateTime;
use Application\Models\Collections\ReportCollection;

class ReportMapper extends Mapper
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
        $this->updateStmt = self::$PDO->prepare("UPDATE pbm_reports SET title=?, description=?, event_time=?, report_time=?, location=?, status=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare("INSERT INTO pbm_reports (title, description, event_time, report_time, location, status) VALUES (?,?,?,?,?,?)");
        $this->deleteStmt = self::$PDO->prepare("DELETE FROM pbm_reports WHERE id=?");
    }

    protected function targetClass()
    {
        return "Application\\Models\\Report";
    }

    protected function getCollection(array $raw)
    {
        return new ReportCollection($raw, $this);
    }

    protected function doCreateObject(array $array)
    {
        $class = $this->targetClass();
        $object = new $class($array['id']);
        $object->setTitle($array['title']);
        $object->setDescription($array['description']);
        $object->setEventTime(DateTime::getDateTimeObjFromInt($array['event_time']));
        $object->setReportTime(DateTime::getDateTimeObjFromInt($array['report_time']));
        $location = Models\Location::getMapper("Location")->find($array['location']);
        if(! is_null($location)) $object->setLocation($location);
        $object->setStatus($array['status']);
        $this->setReportMeta($object);

        return $object;
    }

    protected function doInsert(Models\DomainObject $object)
    {
        $values = array(
            $object->getTitle(),
            $object->getDescription(),
            $object->getEventTime()->getDateTimeInt(),
            $object->getReportTime()->getDateTimeInt(),
            $object->getLocation()->getId(),
            $object->getStatus()
        );
        $this->insertStmt->execute($values);
        $id = self::$PDO->lastInsertId();
        $object->setId($id);
        $this->updateReportMeta($object);
    }

    protected function doUpdate(Models\DomainObject $object)
    {
        $values = array(
            $object->getTitle(),
            $object->getDescription(),
            $object->getEventTime()->getDateTimeInt(),
            $object->getReportTime()->getDateTimeInt(),
            $object->getStatus(),
            $object->getId()
        );
        $this->updateStmt->execute($values);
        $this->updateReportMeta($object);
    }

    protected function doDelete(Models\DomainObject $object)
    {
        $values = array($object->getId());
        $this->deleteReportMeta($object);
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
        $categories_collection = new Models\Collections\CategoryCollection();
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
            }
        }
    }

    private function setRelatedReports(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $rel_reports_meta = $report_meta_mapper->findReportMeta($report, Models\ReportMeta::MT_RR);
        $reports_collection = new Models\Collections\ReportMetaCollection();
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
                $meta_object = new Models\ReportMeta();
                $meta_object->setReportId($report->getId());
                $meta_object->setMetaType(Models\ReportMeta::MT_NS);
                $meta_object->setMetaValue($news_link);
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
                $meta_object = new Models\ReportMeta();
                $meta_object->setReportId($report->getId());
                $meta_object->setMetaType(Models\ReportMeta::MT_VID);
                $meta_object->setMetaValue($video_link);
            }
        }
    }

    private function setReportPhotos(Models\Report $report)
    {
        $report_meta_mapper = MapperRegistry::getMapper('ReportMeta');
        $report_photo_mapper = MapperRegistry::getMapper("Upload");
        $report_photos_meta = $report_meta_mapper->findReportMeta($report, Models\ReportMeta::MT_PHOTO);
        $photo_collection = new Models\Collections\UploadCollection();
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