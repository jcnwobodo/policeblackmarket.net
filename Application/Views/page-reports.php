<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/19/2015
 * Time:    10:38 AM
 **/

$data = \System\Request\RequestContext::instance()->getResponseData();

require_once("header.php");
?>
<div class="row full-padding-bottom">
    <div class="col-md-10 col-md-offset-1">
        <h1 class="page-header">Reports</h1>
        <?php
        foreach($data['reports'] as $report)
        {
            ?>
            <div class="full-margin-bottom">
                <div class="row">
                    <div class="col-xs-12 lead"><?= $report->getTitle(); ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="img-thumbnail">image</div>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-justify"><?= subwords($report->getDescription(), 0, 80); ?> &hellip;</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <div class="btn-group btn-group-xs">
                            <a href="<?php home_url('/reports/id='.$report->getId()); ?>" class="btn">Read More</a>
                            <a href="<?php home_url('/reports/id='.$report->getId().'#comments'); ?>" class="btn">Post Comment</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <!--
    <div class="col-md-4">
        <?php include_once("includes/filter-form.php"); ?>
    </div>
    -->
</div>
<?php
require_once("footer.php");
?>