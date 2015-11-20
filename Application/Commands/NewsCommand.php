<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/20/2015
 * Time:    1:07 PM
 **/

namespace Application\Commands;

use System\Request\RequestContext;

class NewsCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $requestContext->setView('page-news.php');
        //TODO implement news request processor
    }
}