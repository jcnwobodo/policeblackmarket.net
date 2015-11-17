<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/27/2015
 * Time:    11:44 AM
 */

namespace Application\Models;

class Category extends DomainObject
{
    private $guid;
    private $parent;
    private $caption;
    private $type; // report || post

    public function __construct($id=null)
    {
        parent::__construct($id);
    }

    public function getGuid()
    {
        return $this->guid;
    }
    public function setGuid($guid)
    {
        $this->guid = $guid;
        $this->markDirty();
        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }
    public function setParent(Category $parent)
    {
        $this->parent = $parent;
        $this->markDirty();
        return $this;
    }

    public function getCaption()
    {
        return $this->caption;
    }
    public function setCaption($caption)
    {
        $this->caption = $caption;
        $this->markDirty();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Category
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}