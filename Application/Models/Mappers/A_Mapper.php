<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    11/1/2015
 * Time:    10:33 PM
 */

namespace Application\Models\Mappers;

use \System\Models\Mappers\Mapper as SystemMapper;

abstract class A_Mapper extends SystemMapper
{
    public function __construct()
    {
        parent::__construct();
    }
}