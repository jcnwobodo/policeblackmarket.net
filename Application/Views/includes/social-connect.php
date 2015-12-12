<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/19/2015
 * Time:    12:52 PM
 **/

$requestContext = System\Request\RequestContext::instance();
?>
<!--social media-->
<div class="clear-both">
    <h4 class="page-header"><span class="glyphicon glyphicon-envelope"></span> CONTACT US</h4>
    <div class="btn-group btn-group-vertical" style="width: 100%">
        <?php
        $no_contact_button = array('contact');
        if(!in_array($requestContext->getRequestUrlParam(0), $no_contact_button)) { ?>
            <a href="<?php home_url("/contact/")?>" class="btn btn-default btn-left"><span class="glyphicon glyphicon-record"></span> Web Form</a>
        <?php } ?>
        <a href="tel:<?= site_info('contact_phone'); ?>" class="btn btn-default btn-left"><span class="glyphicon glyphicon-phone"></span> <?= site_info('contact_phone'); ?></a>
        <a href="mailto:<?= site_info('contact_email'); ?>" class="btn btn-default btn-left"><span class="glyphicon glyphicon-envelope"></span> <?= site_info('contact_email'); ?></a>
    </div>

    <h4 class="page-header"><span class="glyphicon glyphicon-link"></span> CONNECT WITH US</h4>
    <div class="btn-group btn-group-vertical" style="width: 100%">
        <a href="<?php site_info('facebook_page'); ?>" target="_blank" class="btn btn-default btn-left" title="<?php site_info('name'); ?> on Facebook"><img src="<?php home_url('/Assets/icons/fb.png'); ?>" class="text-icon-large"> Facebook</a>
        <a href="<?php site_info('youtube_channel'); ?>" target="_blank" class="btn btn-default btn-left" title="<?php site_info('name'); ?> on Youtube"><img src="<?php home_url('/Assets/icons/youtube.png'); ?>" class="text-icon-large"> Youtube</a>
        <a href="<?php site_info('google_plus'); ?>" target="_blank" class="btn btn-default btn-left" title="<?php site_info('name'); ?> on Google+"><img src="<?php home_url('/Assets/icons/gp.png'); ?>" class="text-icon-large"> +Google</a>
    </div>

    <h4 class="page-header"><span class="glyphicon glyphicon-bullhorn"></span> STAY UPDATED</h4>
    <div>

    </div>
</div>