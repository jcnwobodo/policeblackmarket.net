<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/20/2015
 * Time:    1:10 PM
 **/

$data = \System\Request\RequestContext::instance()->getResponseData();

require_once("header.php");
?>
    <div class="row full-padding-bottom">
        <div class="col-md-7 col-md-offset-1">
            <h1 class="page-header"><span class="glyphicon glyphicon-bullhorn"></span> <?= site_info('name', false).' Press Room'; ?></h1>
            <?php
            if(is_object($data['news']) and $data['news']->size())
            {
                foreach($data['news'] as $post)
                {
                    ?>
                    <div class="full-margin-bottom">
                        <div class="row">
                            <div class="col-xs-12 lead"><?= $post->getTitle(); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="img-thumbnail">image</div>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-justify"><?= $post->getExcerpt(); ?> &hellip;</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <div class="btn-group btn-group-xs">
                                    <span class="btn"><span class="glyphicon glyphicon-calendar"></span> <?= $report->getReportTime()->getDateTimeStr(); ?></span>
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
                ?><p class="lead height-60vh">No posts yet, check again soon.</p><?php
            }
            ?>
        </div>
        <div class="col-md-3">
            <?php include_once("includes/sidebar-news.php"); ?>
        </div>
    </div>
<?php
require_once("footer.php");
?>