<?php
namespace System\Controller;

use System\Request\RequestContext;
use Application\Models\Exceptions;

abstract class Command
{
    public function execute(RequestContext $requestContext)
    {
        $method = $requestContext->getRequestUrlParam(1);
        if(method_exists($this, $method) and is_callable($this->$method($requestContext)))
        {
            $this->$method($requestContext);
        }
        else
        {
            $this->doExecute($requestContext);
        }
    }
    protected abstract function doExecute(RequestContext $requestContext);
} 