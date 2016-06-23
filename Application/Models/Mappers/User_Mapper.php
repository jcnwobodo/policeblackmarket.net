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
use System\Utilities\DateTime;

class User_Mapper extends A_Mapper
{
    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare("SELECT * FROM site_users WHERE id=?");
        $this->selectAllStmt = self::$PDO->prepare("SELECT * FROM site_users");
        $this->selectByUsernameStmt = self::$PDO->prepare("SELECT * FROM site_users WHERE username=?");
        $this->selectByEmailStmt = self::$PDO->prepare("SELECT * FROM site_users WHERE username=?");
        $this->selectByGenderStmt = self::$PDO->prepare("SELECT * FROM site_users WHERE gender=?");
        $this->updateStmt = self::$PDO->prepare("UPDATE site_users SET username=?, password=?, user_type=?, status=?, first_name=?, last_name=?, nickname=?, gender=?, date_of_birth=?,
            date_joined=?, place_of_origin=?, place_of_residence=?, email=?, phone=?,
            photo=?, biography=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare("INSERT INTO site_users (username,password,user_type,status,first_name,last_name,nickname,gender,date_of_birth,date_joined,place_of_origin,place_of_residence,email,phone,photo,biography) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $this->deleteStmt = self::$PDO->prepare("DELETE FROM site_users WHERE id=?");
        $this->selectByUserTypeStmt = self::$PDO->prepare("SELECT * FROM site_users WHERE user_type=?;");
    }

    public function findByUsername($username)
    {
        return $this->findHelper($username, $this->selectByUsernameStmt, 'username');
    }

    public function findByEmail($email)
    {
        return $this->findHelper($email, $this->selectByEmailStmt, 'email');
    }

    public function findByGender($gender)
    {
        $this->selectByGenderStmt->execute( array($gender) );
        $raw_data = $this->selectByGenderStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    public function findByUserType($user_type)
    {
        $this->selectByUserTypeStmt->execute( array($user_type) );
        $raw_data = $this->selectByUserTypeStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    public function targetClass()
    {
        return "Application\\Models\\User";
    }

    protected function doCreateObject( array $array )
    {
        $class = $this->targetClass();
        $object = new $class($array['id']);
        $object->setUsername($array['username']);
        $object->setPassword($array['password']);
        $object->setUserType($array['user_type']);
        $object->setStatus($array['status']);
        $object->setFirstName($array['first_name']);
        $object->setLastName($array['last_name']);
        $object->setNickname($array['nickname']);
        $object->setGender($array['gender']);
        $object->setDateOfBirth(DateTime::getDateTimeObjFromInt($array['date_of_birth']));
        $object->setDateJoined(DateTime::getDateTimeObjFromInt($array['date_joined']));

        $place_of_origin = Models\Location::getMapper('Location')->find($array['place_of_origin']);
        if(! is_null($place_of_origin)) $object->setPlaceOfOrigin($place_of_origin);

        $place_of_residence = Models\Location::getMapper('Location')->find($array['place_of_residence']);
        if(! is_null($place_of_residence)) $object->setPlaceOfResidence($place_of_residence);

        $object->setEmail($array['email']);
        $object->setPhone($array['phone']);

        $profile_photo = Models\Upload::getMapper('Upload')->find($array['photo']);
        if(! is_null($profile_photo)) $object->setProfilePhoto($profile_photo);

        $object->setBiography($array['biography']);

        return $object;
    }

    protected function doInsert(Models\A_DomainObject $object )
    {
        $values = array(
            $object->getUsername(),
            $object->getPassword(),
            $object->getUserType(),
            $object->getStatus(),
            $object->getFirstName(),
            $object->getLastName(),
            $object->getNickname(),
            $object->getGender(),
            $object->getDateOfBirth()->getDateTimeInt(),
            $object->getDateJoined()->getDateTimeInt(),
            is_object($object->getPlaceOfOrigin()) ? $object->getPlaceOfOrigin()->getId() : NULL,
            is_object($object->getPlaceOfResidence()) ? $object->getPlaceOfResidence()->getId() : NULL,
            $object->getEmail(),
            $object->getPhone(),
            is_object($object->getPhoto()) ? $object->getPhoto()->getId() : NULL,
            $object->getBiography()
        );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    protected function doUpdate(Models\A_DomainObject $object )
    {
        $values = array(
            $object->getUsername(),
            $object->getPassword(),
            $object->getUserType(),
            $object->getStatus(),
            $object->getFirstName(),
            $object->getLastName(),
            $object->getNickname(),
            $object->getGender(),
            $object->getDateOfBirth()->getDateTimeInt(),
            $object->getDateJoined()->getDateTimeInt(),
            $object->getPlaceOfOrigin()->getId(),
            $object->getPlaceOfResidence()->getId(),
            $object->getEmail(),
            $object->getPhone(),
            is_object($object->getPhoto()) ? $object->getPhoto()->getId() : null,
            $object->getBiography(),
            $object->getId()
        );
        $this->updateStmt->execute( $values );
    }

    protected function doDelete(Models\A_DomainObject $object )
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