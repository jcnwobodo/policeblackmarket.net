<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/24/2015
 * Time:    3:50 PM
 */

namespace Application\Models\Collections;

class PostCollection extends Collection
{
    public function targetClass()
    {
        return "Application\\Models\\Post";
    }
}