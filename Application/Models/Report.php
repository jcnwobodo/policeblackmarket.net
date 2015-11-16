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
use \Application\Models\Collections\UploadCollection;

class Report extends DomainObject
{
    private $title;
    private $description;
    private $event_time;
    private $report_time;
    private $categories;
    private $location;
    private $related_reports;
    private $news_sources;
    private $video_links;
    private $photos;

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
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return Report
     */
    public function setLocation($location)
    {
        $this->location = $location;
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
    public function setRelatedReports($related_reports)
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
    public function setNewsSources($news_sources)
    {
        $this->news_sources = $news_sources;
        return $this;
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
    public function setVideoLinks($video_links)
    {
        $this->video_links = $video_links;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhotos()
    {
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
}