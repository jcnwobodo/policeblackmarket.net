<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/19/2015
 * Time:    12:08 PM
 **/

$requestContest = \System\Request\RequestContext::instance();
$data = $requestContest->getResponseData();
$post = $data['post'];

require_once("header.php");
?>
<div class="row full-padding-top full-padding-bottom">
    <div class="col-md-7 col-md-offset-1 height-80vh">
        <h3 class="page-header"><?= $post->getTitle(); ?></h3>
        <p class="text-left lead"><?= $post->getExcerpt(); ?></p>
        <p class="text-justify"><?= $post->getContent(); ?></p>
    </div>
    <div class="col-md-3">
        <?php include_once("includes/social-connect.php"); ?>
    </div>
</div>
<?php
require_once("footer.php");
?>