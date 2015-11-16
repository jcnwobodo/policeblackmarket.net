<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/26/2015
 * Time:    4:10 PM
 */

namespace Application\Models\Mappers;

use Application\Models;
use Application\Models\Collections\UploadCollection;
use System\Utilities\DateTime;

class UploadMapper extends Mapper
{
    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare(
            "SELECT * FROM site_uploads WHERE id=?");
        $this->selectAllStmt = self::$PDO->prepare(
            "SELECT * FROM site_uploads");
        $this->selectByTypeStmt = self::$PDO->prepare(
            "SELECT * FROM site_uploads WHERE MIME_type=?");
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE site_uploads SET MIME_type=?, upload_time=?, location=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO site_uploads (MIME_type,upload_time,location)VALUES(?,?,?)");
        $this->deleteStmt = self::$PDO->prepare(
            "DELETE FROM site_uploads WHERE id=?");
    }

    public function findByMIMEType($mime_type)
    {
        $this->selectByTypeStmt->execute( array($mime_type) );
        $raw_data = $this->selectByTypeStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    protected function targetClass()
    {
        return "Application\\Models\\Upload";
    }

    protected function getCollection( array $raw )
    {
        return new UploadCollection( $raw, $this );
    }

    protected function doCreateObject( array $array )
    {
        $class = $this->targetClass();
        $object = new $class($array['id']);
        $object->setMIMEType($array['MIME_type']);
        $object->setUploadTime(DateTime::getDateTimeObjFromInt($array['upload_time']));
        $object->setLocation($array['location']);

        return $object;
    }

    protected function doInsert(Models\DomainObject $object )
    {
        $values = array(
            $object->getMIMEType(),
            $object->getUploadTime()->getDateTimeInt(),
            $object->getLocation()
        );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    protected function doUpdate(Models\DomainObject $object )
    {
        $values = array(
            $object->getMIMEType(),
            $object->getUploadTime()->getDateTimeInt(),
            $object->getLocation(),
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