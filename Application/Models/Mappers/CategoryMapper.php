<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/27/2015
 * Time:    11:56 AM
 */

namespace Application\Models\Mappers;

use Application\Models;
use Application\Models\Collections\CategoryCollection;

class CategoryMapper extends Mapper
{
    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare(
            "SELECT * FROM site_categories WHERE id=?");
        $this->selectAllStmt = self::$PDO->prepare(
            "SELECT * FROM site_categories");
        $this->selectByPamalinkStmt = self::$PDO->prepare(
            "SELECT * FROM site_categories WHERE guid=?");
        $this->selectByParentStmt = self::$PDO->prepare(
            "SELECT * FROM site_categories WHERE parent=?");
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE site_categories set guid=?, parent=?, caption=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO site_categories (guid,parent,caption)VALUES(?,?,?)");
        $this->deleteStmt = self::$PDO->prepare(
            "DELETE FROM site_categories WHERE id=?");
    }

    public function findByPamalink($pamalink)
    {
        return $this->findHelper($pamalink, $this->selectByPamalinkStmt, 'guid');
    }

    public function findByParent($parent_id)
    {
        $this->selectByParentStmt->execute( array($parent_id) );
        $raw_data = $this->selectByParentStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    public function findByAuthor($user_id)
    {
        $this->selectByAuthorStmt->execute( array($user_id) );
        $raw_data = $this->selectByAuthorStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    protected function targetClass()
    {
        return "Application\\Models\\Category";
    }

    protected function getCollection( array $raw )
    {
        return new CategoryCollection( $raw, $this );
    }

    protected function doCreateObject( array $array )
    {
        $class = $this->targetClass();
        $object = new $class($array['id']);
        $object->setPamalink($array['guid']);

        //parent category
        $parent_category = Models\Category::getMapper("Category")->find($array['parent']);
        if( ! is_null($parent_category)) $object->setParent($parent_category);

        $object->setCaption($array['caption']);

        return $object;
    }

    protected function doInsert(Models\DomainObject $object )
    {
        $values = array(
            $object->getPamalink(),
            $object->getParent(),
            $object->getCaption()
        );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    protected function doUpdate(Models\DomainObject $object )
    {
        $values = array(
            $object->getPamalink(),
            $object->getParent(),
            $object->getCaption(),
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