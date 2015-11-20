<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/19/2015
 * Time:    10:34 AM
 **/

namespace Application\Commands;

use System\Request\RequestContext;

class ReportsCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $requestContext->setView('page-reports.php');
        if($requestContext->fieldIsSet('submit'))
        {
            $this->doSubmit($requestContext);
        }
    }

    private function doSubmit(RequestContext $requestContext)
    {
        //TODO implement actual report processing algorithm
    }
}