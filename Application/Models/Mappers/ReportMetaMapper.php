<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/24/2015
 * Time:    2:51 AM
 **/

namespace Application\Models\Mappers;

use Application\Models;
use Application\Models\Collections\ReportMetaCollection;

class ReportMetaMapper extends Mapper
{
    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare(
            "SELECT * FROM pbm_reports_meta WHERE id=?");
        $this->selectAllStmt = self::$PDO->prepare(
            "SELECT * FROM pbm_reports_meta");
        $this->selectReportMetaStmt = self::$PDO->prepare(
            "SELECT * FROM pbm_reports_meta WHERE report_id=? AND meta_type=?");
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE pbm_reports_meta SET report_id=?, meta_type=?, meta_value=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO pbm_reports_meta (report_id, meta_type, meta_value) VALUES (?,?,?)");
        $this->deleteStmt = self::$PDO->prepare(
            "DELETE FROM pbm_reports_meta WHERE id=?");
        $this->deleteReportMetaStmt = self::$PDO->prepare(
            "DELETE FROM pbm_reports_meta WHERE report_id=? AND meta_type=?");
        $this->deleteAllReportMetaStmt = self::$PDO->prepare(
            "DELETE FROM pbm_reports_meta WHERE report_id=?");
    }

    public function findReportMeta(Models\Report $report, $meta_type)
    {
        $this->selectReportMetaStmt->execute( array($report->getId(), $meta_type) );
        $raw_data = $this->selectReportMetaStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    public function deleteReportMeta(Models\Report $report, $meta_type)
    {
        $this->deleteReportMetaStmt->execute( array($report->getId(), $meta_type) );
    }

    public function deleteAllReportMeta(Models\Report $report)
    {
        $this->deleteAllReportMetaStmt->execute( array($report->getId()) );
    }

    protected function targetClass()
    {
        return "Application\\Models\\ReportMeta";
    }

    protected function getCollection(array $raw)
    {
        return new ReportMetaCollection($raw, $this);
    }

    protected function doCreateObject(array $array)
    {
        $class = $this->targetClass();
        $object = new $class($array['id']);
        $object->setReportId($array['report_id'])->setMetaType($array['meta_type'])->setMetaValue($array['meta_value']);

        return $object;
    }

    protected function doInsert(Models\DomainObject $object)
    {
        $values = array(
            $object->getReportId(),
            $object->getMetaType(),
            $object->getMetaValue()
        );
        $this->insertStmt->execute($values);
        $id = self::$PDO->lastInsertId();
        $object->setId($id);
    }

    protected function doUpdate(Models\DomainObject $object)
    {
        $values = array(
            $object->getReportId(),
            $object->getMetaType(),
            $object->getMetaValue(),
            $object->getId()
        );
        $this->updateStmt->execute($values);
    }

    protected function doDelete(Models\DomainObject $object)
    {
        $values = array($object->getId());
        $this->deleteStmt->execute($values);
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