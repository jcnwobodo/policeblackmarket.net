<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackmarket
 * Date:    11/17/2015
 * Time:    5:40 PM
 **/

namespace Application\Commands;

use System\Request\RequestContext;

class SubmitReportCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $requestContext->setView('page-submit-report.php');
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