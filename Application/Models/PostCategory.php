<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/27/2015
 * Time:    11:44 AM
 */

namespace Application\Models;

class PostCategory extends DomainObject
{
    private $pamalink;
    private $parent;
    private $caption;

    public function __construct($id=null)
    {
        parent::__construct($id);
    }

    public function getPamalink()
    {
        return $this->pamalink;
    }
    public function setPamalink($pamalink)
    {
        $this->pamalink = $pamalink;
        $this->markDirty();
        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }
    public function setParent(PostCategory $parent)
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
}