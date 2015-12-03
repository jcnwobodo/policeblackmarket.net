<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackmarket
 * Date:    11/16/2015
 * Time:    8:29 PM
 */

namespace Application\Models;

use System\Utilities\DateTime;
use Application\Models\Collections\CategoryCollection;
use Application\Models\Collections\ReportCollection;
use Application\Models\Collections\UploadCollection;

class Report extends DomainObject
{
    private $title;
    private $description;
    private $event_time;
    private $report_time;
    private $categories; //meta
    private $location_state;
    private $location_lga;
    private $location_district;
    private $location_scene;
    private $related_reports; //meta
    private $news_sources; //meta
    private $video_links; //meta
    private $photos; //meta
    private $status; // pending || approved

    public function __construct($id=null)
    {
        parent::__construct($id);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Report
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Report
     */
    public function setDescription($description)
    {
        $this->description = $description;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventTime()
    {
        return $this->event_time;
    }

    /**
     * @param mixed $event_time
     * @return Report
     * @description set the time of reported event as provided by the reporter
     */
    public function setEventTime(DateTime $event_time)
    {
        $this->event_time = $event_time;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReportTime()
    {
        return $this->report_time;
    }

    /**
     * @param mixed $report_time
     * @return Report
     * @description set the time of reporting (according to server time)
     */
    public function setReportTime(DateTime $report_time)
    {
        $this->report_time = $report_time;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     * @return Report
     */
    public function setCategories(CategoryCollection $categories)
    {
        $this->categories = $categories;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocationState()
    {
        return $this->location_state;
    }

    /**
     * @param mixed $location_state
     * @return Report
     */
    public function setLocationState(Location $location_state)
    {
        $this->location_state = $location_state;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocationLga()
    {
        return $this->location_lga;
    }

    /**
     * @param mixed $location_lga
     * @return Report
     */
    public function setLocationLga($location_lga)
    {
        $this->location_lga = $location_lga;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocationDistrict()
    {
        return $this->location_district;
    }

    /**
     * @param mixed $location_district
     * @return Report
     */
    public function setLocationDistrict($location_district)
    {
        $this->location_district = $location_district;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocationScene()
    {
        return $this->location_scene;
    }

    /**
     * @param mixed $location_scene
     * @return Report
     */
    public function setLocationScene($location_scene)
    {
        $this->location_scene = $location_scene;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelatedReports()
    {
        return $this->related_reports;
    }

    /**
     * @param mixed $related_reports
     * @return Report
     */
    public function setRelatedReports(ReportCollection $related_reports)
    {
        $this->related_reports = $related_reports;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewsSources()
    {
        return $this->news_sources;
    }

    /**
     * @param mixed $news_sources
     * @return Report
     */
    public function setNewsSources(array $news_sources)
    {
        $this->news_sources = $news_sources;
        return $this;
    }

    public function addNewsSource($news_source)
    {
        $this->news_sources[] = $news_source;
    }

    /**
     * @return mixed
     */
    public function getVideoLinks()
    {
        return $this->video_links;
    }

    /**
     * @param mixed $video_links
     * @return Report
     */
    public function setVideoLinks(array $video_links)
    {
        $this->video_links = $video_links;
        return $this;
    }

    public function addVideoLink($video_link)
    {
        $this->video_links[] = $video_link;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhotos()
    {
        if(! isset($this->photos)) $this->photos = new UploadCollection();
        return $this->photos;
    }

    /**
     * @param mixed $photos
     * @return Report
     */
    public function setPhotos(UploadCollection $photos)
    {
        $this->photos = $photos;
        return $this;
    }

    public function addPhoto($photo)
    {
        $this->getPhotos()->add($photo);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Report
     */
    public function setStatus($status)
    {
        $this->status = $status;
        $this->markDirty();
        return $this;
    }
}