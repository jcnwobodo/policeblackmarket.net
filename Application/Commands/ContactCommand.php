<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/27/2015
 * Time:    11:29 AM
 */

namespace Application\Commands;

use System\Request\RequestContext;

class ContactCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $requestContext->setView('page-contact.php');
        $requestContext->setResponseData(array('content'=>"", 'status'=>null, 'page-title'=>"Contact"));
    }

    public function send(RequestContext $requestContext)
    {
        $requestContext->setView('page-contact.php');
        $response_status = false;

        $fields = $requestContext->getAllFields();
        $names = $fields['names'];
        $email = $fields['email'];
        $phone = $fields['phone'];
        $company = $fields['company'];
        $address = $fields['address'];
        $text = "Company: ".$company."\nAddress: ".$address."\nPhone: ".$phone."\n\nMessage\n".$fields['message'];
        $message = wordwrap(str_replace("\n.", "\n..",$text), 70);
        $send_to = site_info('contact_email', false);

        if(mail($send_to, 'Website Message From: '.$names, $message, "From: {$names}<{$email}>\r\n"))
        {
            $response_status = true;
        }
        $requestContext->setResponseData(array('content'=>"", 'status'=>$response_status, 'page-title'=>"Contact"));
    }
}