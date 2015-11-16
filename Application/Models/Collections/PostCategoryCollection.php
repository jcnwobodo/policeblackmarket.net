<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/27/2015
 * Time:    11:55 AM
 */

namespace Application\Models\Collections;

class PostCategoryCollection extends Collection
{
    public function targetClass()
    {
        return "Application\\Models\\PostCategory";
    }
}