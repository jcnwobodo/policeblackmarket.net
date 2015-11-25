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
use System\Utilities\DateTime;
use Application\Models\Collections\CommentCollection;

class CommentMapper extends Mapper
{
    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare(
            "SELECT * FROM site_comments WHERE id=?");
        $this->selectAllStmt = self::$PDO->prepare(
            "SELECT * FROM site_comments");
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE site_comments set parent=?, post_id=?, comment_author=?, comment_time=?, comment_type=?, content=?, status=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO site_comments (parent, post_id, comment_author, comment_time, comment_type, content, status) VALUES (?,?,?,?,?,?,?)");
        $this->deleteStmt = self::$PDO->prepare(
            "DELETE FROM site_comments WHERE id=?");
    }

    protected function targetClass()
    {
        return "Application\\Models\\Comment";
    }

    protected function getCollection( array $raw )
    {
        return new CommentCollection( $raw, $this );
    }

    protected function doCreateObject( array $array )
    {
        $class = $this->targetClass();
        $object = new $class($array['id']);
        $parent = $this->find($array['parent']);
        if(! is_null($parent)) $object->setParent($parent);
        $object->setPostId($array['post_id']);
        $object->setCommentAuthor($array['comment_author']);
        $object->setCommentTime(DateTime::getDateTimeObjFromInt($array['comment_time']));
        $object->setCommentType($array['comment_type']);
        $object->setContent($array['content']);
        $object->setStatus($array['status']);

        return $object;
    }

    protected function doInsert(Models\DomainObject $object )
    {
        $parent_id = is_object($object->getParent()) ? $object->getParent()->getId() : NULL;
        $values = array(
            $parent_id,
            $object->getPostId(),
            $object->getCommentAuthor(),
            $object->getCommentTime()->getDateTimeInt(),
            $object->getCommentType(),
            $object->getContent(),
            $object->getStatus()
        );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    protected function doUpdate(Models\DomainObject $object )
    {
        $parent_id = is_object($object->getParent()) ? $object->getParent()->getId() : NULL;
        $values = array(
            $parent_id,
            $object->getPostId(),
            $object->getCommentAuthor(),
            $object->getCommentTime()->getDateTimeInt(),
            $object->getCommentType(),
            $object->getContent(),
            $object->getStatus(),
            $object->getId()
        );
        $this->updateStmt->execute( $values );
    }

    protected function doDelete(Models\DomainObject $object )
    {
        $values = array( $object->getId() );
        $this->deleteStmt->execute( $values );
    }

    protected function selectStmt()
    {
        return $this->selectStmt;
    }

    protected function selectAllStmt()
    {
        return $this->selectAllStmt;
    }
}