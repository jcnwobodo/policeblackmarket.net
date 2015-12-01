<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    11/1/2015
 * Time:    10:34 PM
 */

namespace Application\Models;

use System\Models\DomainObject as SystemDomainObject;

abstract class DomainObject extends SystemDomainObject
{
    const STATUS_PENDING = 2;
    const STATUS_APPROVED = 1;
    const STATUS_DELETED = 0;

    public function __construct($id=null)
    {
        parent::__construct($id);
    }
}