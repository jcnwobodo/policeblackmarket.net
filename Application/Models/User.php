<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackmarket
 * Date:    11/16/2015
 * Time:    10:40 PM
 */

namespace Application\Models;

use System\Utilities\DateTime;

class User extends DomainObject
{
    private $username;
    private $password;
    private $first_name;
    private $last_name;
    private $nickname;
    private $gender;
    private $date_of_birth;
    private $date_joined;
    private $place_of_origin;
    private $place_of_residence;
    private $email;
    private $phone;
    private $photo;
    private $biography;

    public function __construct($id=null)
    {
        parent::__construct($id);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     * @return User
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     * @return User
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    /**
     * @param mixed $date_of_birth
     * @return User
     */
    public function setDateOfBirth(DateTime $date_of_birth)
    {
        $this->date_of_birth = $date_of_birth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateJoined()
    {
        return $this->date_joined;
    }

    /**
     * @param mixed $date_joined
     * @return User
     */
    public function setDateJoined($date_joined)
    {
        $this->date_joined = $date_joined;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfOrigin()
    {
        return $this->place_of_origin;
    }

    /**
     * @param mixed $place_of_origin
     * @return User
     */
    public function setPlaceOfOrigin(Location $place_of_origin)
    {
        $this->place_of_origin = $place_of_origin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfResidence()
    {
        return $this->place_of_residence;
    }

    /**
     * @param mixed $place_of_residence
     * @return User
     */
    public function setPlaceOfResidence(Location $place_of_residence)
    {
        $this->place_of_residence = $place_of_residence;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @param mixed $biography
     * @return User
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
        return $this;
    }
}