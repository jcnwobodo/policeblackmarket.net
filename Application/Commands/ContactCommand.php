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
        $subject = $fields['sender-subject'];
        $names = $fields['sender-name'];
        $email = $fields['sender-email'];
        $phone = $fields['sender-phone'];
        $text = "Names: ".$names."\nPhone: ".$phone."\n\nMessage\n".$fields['sender-message'];
        $message = wordwrap(str_replace("\n.", "\n..",$text), 70);
        $send_to = site_info('contact_email', false);

        if(mail($send_to, 'PBM- '.$subject, $message, "From: {$names} &lt;{$email}&gt;\r\n"))
        {
            $response_status = true;
        }
        $requestContext->setResponseData(array('content'=>"", 'status'=>$response_status, 'page-title'=>"Contact"));
    }
}