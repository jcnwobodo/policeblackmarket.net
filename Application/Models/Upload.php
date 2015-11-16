<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/26/2015
 * Time:    4:02 PM
 */

namespace Application\Models;

use System\Utilities\DateTime;

class Upload extends DomainObject
{
    private $MIME_type;
    private $upload_time;
    private $location;
    private $guid;
    private $author;

    public function __construct($id=null)
    {
        parent::__construct($id);
    }

    public function getMIMEType()
    {
        return $this->MIME_type;
    }
    public function setMIMEType($MIME_type)
    {
        $this->MIME_type = $MIME_type;
        $this->markDirty();
        return $this;
    }

    public function getUploadTime()
    {
        return $this->upload_time;
    }
    public function setUploadTime(DateTime $upload_time)
    {
        $this->upload_time = $upload_time;
        $this->markDirty();
        return $this;
    }

    public function getLocation()
    {
        return $this->location;
    }
    public function setLocation(Location $location)
    {
        $this->location = $location;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @param mixed $guid
     * @return Upload
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     * @return Upload
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
        return $this;
    }
}