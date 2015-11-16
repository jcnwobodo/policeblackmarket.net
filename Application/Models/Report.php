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
}