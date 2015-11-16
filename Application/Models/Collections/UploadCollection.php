<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/26/2015
 * Time:    4:09 PM
 */

namespace Application\Models\Collections;


class UploadCollection extends Collection
{
    public function targetClass()
    {
        return "Application\\Models\\Upload";
    }
}