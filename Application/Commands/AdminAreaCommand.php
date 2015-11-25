<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    11/1/2015
 * Time:    5:14 PM
 */

namespace Application\Commands;

use System\Request\RequestContext;
use Application\Models\User;

class AdminAreaCommand extends SecureCommand
{
    public function execute(RequestContext $requestContext)
    {
        if($this->securityPass($requestContext, User::USER_TYPE_ADMIN, 'admin-area'))
        {
            parent::execute($requestContext);
        }
    }

    protected function doExecute(RequestContext $requestContext)
    {
        $requestContext->setView('admin/dashboard.php');
    }
}