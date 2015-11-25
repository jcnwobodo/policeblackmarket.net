<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/24/2015
 * Time:    2:49 AM
 **/

namespace Application\Models\Collections;


class ReportMetaCollection extends Collection
{
    public function targetClass()
    {
        return "Application\\Models\\ReportMeta";
    }
}