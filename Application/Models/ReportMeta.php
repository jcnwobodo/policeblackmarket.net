<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/24/2015
 * Time:    2:44 AM
 **/

namespace Application\Models;

class ReportMeta extends A_DomainObject
{
    private $report_id;
    private $meta_type;
    private $meta_value;
    const MT_CAT = 'category';
    const MT_RR = 'rel_report';
    const MT_NS = 'news_source';
    const MT_VID = 'video_link';
    const MT_PHOTO = 'photo_upload';

    public function __construct($id=null)
    {
        parent::__construct($id);
    }

    /**
     * @return mixed
     */
    public function getReportId()
    {
        return $this->report_id;
    }

    /**
     * @param mixed $report_id
     * @return ReportMeta
     */
    public function setReportId($report_id)
    {
        $this->report_id = $report_id;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMetaType()
    {
        return $this->meta_type;
    }

    /**
     * @param mixed $meta_type
     * @return ReportMeta
     */
    public function setMetaType($meta_type)
    {
        $this->meta_type = $meta_type;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMetaValue()
    {
        return $this->meta_value;
    }

    /**
     * @param mixed $meta_value
     * @return ReportMeta
     */
    public function setMetaValue($meta_value)
    {
        $this->meta_value = $meta_value;
        $this->markDirty();
        return $this;
    }
}