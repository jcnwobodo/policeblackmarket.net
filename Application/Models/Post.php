<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/24/2015
 * Time:    12:51 PM
 */

namespace Application\Models;

use System\Utilities\DateTime;

class Post extends DomainObject
{
    private $parent;
    private $post_type;
    private $guid;
    private $title;
    private $content;
    private $excerpt;
    private $featured_image = null;
    private $category = null;
    private $author;
    private $date_created;
    private $last_update;
    private $status;

    private $states = array('Deleted'=>0, 'Published'=>1, 'Draft'=>2);

    public function __construct($id=null)
    {
        parent::__construct($id);
    }

    public function getParent()
    {
        return $this->parent;
    }
    public function setParent($parent)
    {
        $this->parent = $parent;
        $this->markDirty();
        return $this;
    }

    public function getPostType()
    {
        return $this->post_type;
    }
    public function setPostType($post_type)
    {
        $this->post_type = $post_type;
        $this->markDirty();
        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }
    public function setTemplate($template)
    {
        $this->template = $template;
        $this->markDirty();
        return $this;
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

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
        $this->markDirty();
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
        $this->markDirty();
        return $this;
    }

    public function getExcerpt()
    {
        return (strlen($this->excerpt) ? $this->excerpt."&hellip;" : subwords($this->content,0,50)."&hellip;" );
    }
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
        $this->markDirty();
        return $this;
    }

    public function getFeaturedImage()
    {
        return $this->featured_image;
    }
    public function setFeaturedImage(Upload $featured_image)
    {
        $this->featured_image = $featured_image;
        $this->markDirty();
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory(Category $category)
    {
        $this->category = $category;
        $this->markDirty();
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }
    public function setAuthor(Account $author)
    {
        $this->author = $author;
        $this->markDirty();
        return $this;
    }

    public function getDateCreated()
    {
        return $this->date_created;
    }
    public function setDateCreated(DateTime $date_created)
    {
        $this->date_created = $date_created;
        $this->markDirty();
        return $this;
    }

    public function getLastUpdate()
    {
        return $this->last_update;
    }
    public function setLastUpdate(DateTime $last_update)
    {
        $this->last_update = $last_update;
        $this->markDirty();
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
        $this->markDirty();
        return $this;
    }
    public function delete()
    {
        $this->setStatus($this->states['Deleted']);
    }
    public function publish()
    {
        $this->setStatus($this->states['Published']);
    }
    public function markDraft()
    {
        $this->setStatus($this->states['Draft']);
    }
    public function isDeleted()
    {
        return ($this->getStatus() == $this->states['Deleted']);
    }
    public function isPublished()
    {
        return ($this->getStatus() == $this->states['Published']);
    }
    public function isDraft()
    {
        return ($this->getStatus() == $this->states['Draft']);
    }
}