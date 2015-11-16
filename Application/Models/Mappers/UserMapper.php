<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/26/2015
 * Time:    4:28 PM
 */

namespace Application\Models\Mappers;

use Application\Models;
use Application\Models\Collections\BillingInformationCollection;
use System\Utilities\DateTime;

class UserMapper extends Mapper
{
    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare(
            "SELECT * FROM site_users WHERE id=?");
        $this->selectAllStmt = self::$PDO->prepare(
            "SELECT * FROM site_users");
        $this->selectByUsernameStmt = self::$PDO->prepare(
            "SELECT * FROM site_users WHERE username=?");
        $this->selectByGenderStmt = self::$PDO->prepare(
            "SELECT * FROM site_users WHERE gender=?");
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE site_users set username=?, password=?, first_name=?, last_name=?, other_names=?, gender=?, date_of_birth=?,
            nationality=?, state_of_origin=?, lga=?, residence_country=?, residence_state=?, residence_city=?,
            residence_street=?, email=?, phone=?, biography=?, office_location=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO site_users (username,password,photo,first_name,last_name,other_names,gender,date_of_birth,nationality,
state_of_origin,lga,
residence_country,residence_state,residence_city,residence_street,email,phone,biography,office_location)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $this->deleteStmt = self::$PDO->prepare(
            "DELETE FROM site_users WHERE id=?");

        $this->selectAllByUserTypeStmt = self::$PDO->prepare(
            "SELECT * FROM site_users INNER JOIN site_users_access_levels ON site_users.id = site_users_access_levels.user_id WHERE
user_type=?;");
        $this->selectRandomByUserTypeStmt = self::$PDO->prepare(
            "SELECT * FROM site_users INNER JOIN site_users_access_levels ON site_users.id = site_users_access_levels.user_id WHERE
user_type=:user_type ORDER BY RAND() LIMIT :num");
    }

    public function findByUsername($username)
    {
        return $this->findHelper($username, $this->selectByUsernameStmt, 'username');
    }

    public function findByGender($gender)
    {
        $this->selectByGenderStmt->execute( array($gender) );
        $raw_data = $this->selectByGenderStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    public function findByUserType($user_type)
    {
        $this->selectAllByUserTypeStmt->execute( array($user_type) );
        $raw_data = $this->selectAllByUserTypeStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    public function findRandomByUserType($user_type, $limit=1)
    {
        $this->selectRandomByUserTypeStmt->bindParam(':user_type', $user_type, \PDO::PARAM_STR);
        $this->selectRandomByUserTypeStmt->bindParam(':num', $limit, \PDO::PARAM_INT);
        $this->selectRandomByUserTypeStmt->execute();
        $raw_data = $this->selectRandomByUserTypeStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    protected function targetClass()
    {
        return "Application\\Models\\Account";
    }

    protected function getCollection( array $raw )
    {
        return new BillingInformationCollection( $raw, $this );
    }

    protected function doCreateObject( array $array )
    {
        $class = $this->targetClass();
        $object = new $class($array['id']);
        $object->setUsername($array['username']);
        $object->setPassword($array['password']);
        $profile_photo = Models\Upload::getMapper('Upload')->find($array['photo']);
        if(! is_null($profile_photo)) $object->setProfilePhoto($profile_photo);
        $object->setFirstName($array['first_name']);
        $object->setLastName($array['last_name']);
        $object->setOtherNames($array['other_names']);
        $object->setGender($array['gender']);
        $object->setDateOfBirth(DateTime::getDateTimeObjFromInt($array['date_of_birth']));
        $object->setNationality($array['nationality']);
        $object->setStateOfOrigin($array['state_of_origin']);
        $object->setLga($array['lga']);
        $object->setResidenceCountry($array['residence_country']);
        $object->setResidenceState($array['residence_state']);
        $object->setResidenceCity($array['residence_city']);
        $object->setResidenceStreet($array['residence_street']);
        $object->setEmail($array['email']);
        $object->setPhone($array['phone']);
        $object->setBiography($array['biography']);
        $office_location = Models\OfficeLocation::getMapper('OfficeLocation')->find($array['office_location']);
        if(! is_null($office_location)) $object->setOfficeLocation($office_location);

        return $object;
    }

    protected function doInsert(Models\DomainObject $object )
    {
        $values = array(
            $object->getUsername(),
            $object->getPassword(),
            $object->getProfilePhoto()->getId(),
            $object->getFirstName(),
            $object->getLastName(),
            $object->getOtherNames(),
            $object->getGender(),
            $object->getDateOfBirth()->getDateTimeInt(),
            $object->getNationality(),
            $object->getStateOfOrigin(),
            $object->getLga(),
            $object->getResidenceCountry(),
            $object->getResidenceState(),
            $object->getResidenceCity(),
            $object->getResidenceStreet(),
            $object->getEmail(),
            $object->getPhone(),
            $object->getBiography(),
            (!is_null($object->getOfficeLocation()) ? $object->getOfficeLocation()->getId() : null)
        );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    protected function doUpdate(Models\DomainObject $object )
    {
        $values = array(
            $object->getUsername(),
            $object->getPassword(),
            $object->getProfilePhoto()->getId(),
            $object->getFirstName(),
            $object->getLastName(),
            $object->getOtherNames(),
            $object->getGender(),
            $object->getDateOfBirth()->getDateTimeInt(),
            $object->getNationality(),
            $object->getStateOfOrigin(),
            $object->getLga(),
            $object->getResidenceCountry(),
            $object->getResidenceState(),
            $object->getResidenceCity(),
            $object->getResidenceStreet(),
            $object->getEmail(),
            $object->getPhone(),
            $object->getBiography(),
            (!is_null($object->getOfficeLocation()) ? $object->getOfficeLocation()->getId() : null ),
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