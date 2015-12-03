<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 10:50 PM
 */

namespace System\Utilities;

class DateTime
{
    private $year;
	private $month;
	private $day;
    private $hour;
    private $minute;
    private $seconds;

    public function __construct($year=null, $month=null, $day=null, $hour=null, $minute=null, $seconds=null)
    {
        if(is_null($year) and is_null($month) and is_null($day))
        {
            $year = date("Y");
            $month = date("m");
            $day = date("d");
        }
        $this->setDate($year, $month, $day);

        $hour = is_null($hour) or ($hour < 0 or $hour > 23) ? date("h") : $hour;
        $minute = is_null($minute) or ($minute < 0 or $minute > 59) ? date("i") : $minute;
        $seconds = is_null($seconds) or ($seconds < 0 or $seconds > 59) ? date("s") : $seconds;

        $this->setTime($hour, $minute, $seconds);
    }
    public static function getDateTimeObjFromInt($dateTimeInt)
    {
        $year = date("Y", $dateTimeInt);
        $month = date("m", $dateTimeInt);
        $day = date("d", $dateTimeInt);
        $hour = date("h", $dateTimeInt);
        $minute = date("i", $dateTimeInt);
        $seconds = date("s", $dateTimeInt);

        return new self($year, $month, $day, $hour, $minute, $seconds);
    }

    public function setDate($year, $month, $day)
    {
        if(checkdate((int)$month, (int)$day, (int)$year) == true)
        {
            $this->year = $year;
            $this->month = $month;
            $this->day = $day;
        }
        else
        {
            throw new \Exception("Invalid date supplied: ".$month."-".$day."-".$year);
        }
    }
    public function setTime($hour, $minute, $seconds)
    {
        if($this::checktime((int)$hour, (int)$minute, (int)$seconds) == true)
        {
            $this->hour = $hour;
            $this->minute = $minute;
            $this->seconds = $seconds;
        }
        else
        {
            throw new \Exception("Invalid time supplied: ".$hour."-".$minute."-".$seconds);
        }
    }

    public function getDateTimeInt()
    {
        return mktime($this->hour,$this->minute,$this->seconds,$this->month,$this->day,$this->year);
    }
    public function getDateTimeStr($date_separator="-", $time_seperator=":")
    {
        return (string)$this->getYear().$date_separator.$this->getMonth().$date_separator.$this->getDay().'|'.
            $this->getHour().$time_seperator.$this->getMinute().$time_seperator.$this->getSeconds();
    }
    public function getDateTimeStrF($format)
    {
        return date($format, $this->getDateTimeInt());
    }

    public function getYear()
    {
        return $this->year;
    }
    public function getMonth()
    {
        return $this->month;
    }
    public function getDay()
    {
        return $this->day;
    }
    public function getHour()
    {
        return $this->hour;
    }
    public function getMinute()
    {
        return $this->minute;
    }
    public function getSeconds()
    {
        return $this->seconds;
    }

    public static function checktime($hour=0, $minute=0, $seconds=0)
    {
        if (($hour >= 0 and $hour <= 23) and ($minute >= 0 and $minute <= 59) and ($seconds >= 0 and $seconds <= 59))
        {
            return true;
        }
        return false;
    }
}