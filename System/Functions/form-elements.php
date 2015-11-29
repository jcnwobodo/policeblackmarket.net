<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/29/2015
 * Time:    6:09 PM
 **/

function drop_num($upperpoint, $lowerpoint, $name, $current, $interval=1, $initial_val=NULL, $attr='class="form-control"')
{
    $return_value = '<select name="'.$name.'" id="'.$name.'" '.$attr.'>';
    if(!is_null($initial_val))
    {
        $return_value .= '<option value="NULL">'.$initial_val.'</option>';
    }
    for($yy = $lowerpoint; $yy <= $upperpoint; $yy+=$interval)
    {
        $return_value .= '<option value='.($yy).' '.selected( (int)$current, $yy).'>&nbsp;'.($yy).'&nbsp;</option>';
    }
    $return_value .= '</select>';
    return $return_value;
}

function drop_years($name, $current_val=null)
{
    return drop_num(date('Y'), 2015, $name, is_null($current_val) ? date('j') : $current_val);
}

function drop_month($name, $current, $atr='class="form-control"')
{
    $months = array('January','Febuary','March','April','May','June','July','August','September','October','November','December');
    $return_value = '<select name="'.$name.'" '.$atr.'>';
    for($yy = 1; $yy <= sizeof($months); $yy++)
    {
        $return_value .= '<option value="'.($yy).'" '.selected($current, $yy).'>&nbsp;['.$yy.']&nbsp;'.$months[$yy-1].'&nbsp;</option>';
    }
    $return_value .= '</select>';
    return $return_value;
}

function drop_month_days($name, $current_val=null)
{
    return drop_num(31, 0, $name, is_null($current_val) ? date('j') : $current_val);
}

function drop_hours($name, $current_val=null, $mode12=true)
{
    return drop_num($mode12?11:23, 0, $name,  is_null($current_val) ? date('g') : $current_val);
}

function drop_minutes($name, $current_val=null)
{
    return drop_num(59, 0, $name, is_null($current_val) ? date('i') : $current_val);
}

function drop_AmPM($name, $current_val=null)
{
    $rv = "<select name='{$name}' class='form-control'>";
    $rv.= "<option value='AM' ".selected($current_val, 'AM').">AM</option>";
    $rv.= "<option value='PM' ".selected($current_val, 'PM').">PM</option>";
    $rv.= "</select>";

    return $rv;
}

function dropSex($name='sex',$selected='NULL',$width='33',$default_value='--select sex--')
{
    $str = '<select name="'.$name.'" id="'.$name.'" style="width:'.$width.'%; display:inline-block;">';
    $str .= '<option value="NULL">'.$default_value.'</option>';
    $str .= '<option value="FEMALE" '.selected('FEMALE',$selected).'>FEMALE</option>';
    $str .= '<option value="MALE" '.selected('MALE',$selected).'>MALE</option>';
    $str .= '</select>';
    return $str;
}
function selected($val1,$val2)
{
    if($val1 == $val2)
    {
        return 'selected="selected"';
    }
    return "";
}

function selected_multi($value, $name)
{
    if(! is_array($name)){$name = array(); }
    if(in_array($value,$name)) return 'selected="selected"';
}
function checked($value,$name)
{
    if(! is_array($name)){$name[] = $name; }
    if(in_array($value,$name)) return 'checked="checked"';
}
