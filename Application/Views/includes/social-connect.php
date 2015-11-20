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
<div class="float-none clear-both align-center">
    <h4 class="page-title">CONNECT WITH US</h4>
    <p>
        <a href="<?php site_info('facebook_page'); ?>" target="_blank" title="<?php site_info('name'); ?> on Facebook">
            <img src="<?php home_url('/Views/assets/icons/fb.png'); ?>" class="text-icon-large">
        </a>
        <a href="<?php site_info('youtube_channel'); ?>" target="_blank" title="<?php site_info('name'); ?> on Youtube">
            <img src="<?php home_url('/Views/assets/icons/youtube.png'); ?>" class="text-icon-large">
        </a>
        <a href="<?php site_info('google_plus'); ?>" target="_blank" title="<?php site_info('name'); ?> on Google+">
            <img src="<?php home_url('/Views/assets/icons/gp.png'); ?>" class="text-icon-large">
        </a>
    </p>
    <?php
    $no_contact_button = array('contact','contact/','');
    if(!in_array($requestContext->getRequestUrl(), $no_contact_button))
    {
        ?>
        <p>
            <a href="<?php home_url("/contact")?>" class="button-link margin-auto">CONTACTS US</a>
        </p>
        <?php
    }
    ?>
</div>