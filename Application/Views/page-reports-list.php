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
<div class="row height-50vh">
    <div class="col-md-10 col-md-offset-1">
        <h2 class="page-header"><span class="glyphicon glyphicon-flag"></span> <?php site_info('name'); ?> Reports</h2>
        <?php
        if(is_object($data['reports']) and $data['reports']->size())
        {
            foreach($data['reports'] as $report)
            {
                ?>
                <div class="full-margin-bottom border-width-1px border-color1 border-bottom">
                    <div><h3 class="page-header"><?= $report->getTitle(); ?></h3></div>
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
                                <a href="#" class="btn"><span class="glyphicon glyphicon-calendar"></span> <?= $report->getEventTime()->getDateTimeStr(); ?></a>
                                <a href="<?php home_url('/reports/?id='.$report->getId()); ?>" class="btn"><span class="glyphicon glyphicon-play"></span> Read More</a>
                                <a href="<?php home_url('/reports/?id='.$report->getId().'#comments'); ?>" class="btn"><span class="glyphicon glyphicon-comment"></span> Post Comment</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        else
        {
            ?>
            <div class="height-70vh">
                <p class="lead">No reports yet, be the first person ever to submit a report on <?= site_info('name'); ?></p>
                <div class="btn-group-lg pull-right">
                    <a href="<?= home_url('/submit-report'); ?>" class="btn btn-primary">
                        SUBMIT REPORT <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="row full-margin-bottom">
        <div class="col-md-10 col-md-offset-1">
            <?php include_once("includes/social-connect.php"); ?>
        </div>
    </div>
<?php
require_once("footer.php");
?>