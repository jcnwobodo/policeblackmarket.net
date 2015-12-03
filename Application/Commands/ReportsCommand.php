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
use Application\Models\Report;

class ReportsCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $approved_reports = Report::getMapper('Report')->findByStatus(Report::STATUS_APPROVED);

        $data = array();
        $data['reports'] = $approved_reports;

        $requestContext->setResponseData($data);
        $requestContext->setView('page-reports.php');
    }
}