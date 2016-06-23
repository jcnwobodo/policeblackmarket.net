<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date: 11/17/2015
 * Time: 12:17 PM
 */

$rc = \System\Request\RequestContext::instance();
$data = $rc->getResponseData();

//Obtain a random quote
include_once("includes/_quotes.php");
$quote = getRandomQuote();

require_once("header.php");
?>

    <div class="row full-margin-top">
        <div class="col-md-10 col-md-offset-1 bg-color1 height-40vh">
            <div class="color3">
                <blockquote class="lead">
                    <span class="text-center" style="font-size: 90%"><?= $quote[0]; ?></span>
                    <span class="text-right" style="font-size: 80%"><cite><?= $quote[1]; ?></cite></span>
                </blockquote>
                <div class="text-center border-top border-color2 border-width-1px">
                    <p class="lead">
                        Evil persists when and where good men and women decide to fold their hands and do nothing,
                        take action today, expose the evil by reporting today!
                    </p>
                    <p class="btn-group">
                        <a href="<?php home_url('/submit-report'); ?>" class="btn btn-primary btn-lg">SUBMIT A REPORT</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7 col-md-offset-1 col-sm-8">
            <?php
            if(is_object($data['reports']) and $data['reports']->size())
            {
            ?>
                <h4 class="page-header"><span class="glyphicon glyphicon-flag"></span> TRENDING REPORTS</h4>
            <?php
            foreach($data['reports'] as $report)
            {
            ?>
            <div class="full-margin-bottom full-margin-top">
                <h5 class="page-header no-margin"><strong><?= $report->getTitle(); ?></strong></h5>
                <div class="row">
                    <div class="col-sm-9">
                        <p class="text-left"><?= sub_words($report->getDescription(), 0, 50); ?> &hellip;</p>
                    </div>
                    <div class="col-sm-3">
                        <p class="img-thumbnail tiny-padding-all mid-margin-top">image</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-left">
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
            ?>

            <?php
            if(is_object($data['news']) and $data['news']->size())
            {
            ?>
            <h4 class="page-header"><span class="glyphicon glyphicon-bullhorn"></span> IN THE NEWS &hellip;</h4>
            <?php
            foreach($data['news'] as $post)
            {
            ?>
            <div class="full-margin-bottom">
                <h5 class="page-header no-margin"><strong><?= $post->getTitle(); ?></strong></h5>
                <div class="row">
                    <div class="col-sm-9">
                        <p class="text-justify"><?= $post->getExcerpt(); ?></p>
                    </div>
                    <div class="col-sm-3">
                        <p class="img-thumbnail tiny-padding-all mid-margin-top">image</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-left">
                        <div class="btn-group btn-group-xs">
                            <a href="#" class="btn"><span class="glyphicon glyphicon-calendar"></span> <?= $post->getDateCreated()->getDateTimeStr(); ?></a>
                            <a href="<?php home_url('/news/'.$post->getGuid()); ?>" class="btn"><span class="glyphicon glyphicon-play"></span> Read More</a>
                            <a href="<?php home_url('/news/'.$post->getGuid().'#comments'); ?>" class="btn"><span class="glyphicon glyphicon-comment"></span> Post Comment</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            }
            ?>

            <?php
            if(is_object($data['about']))
            {
                $page = $data['about'];
                ?>
                <h4 class="page-header"><span class="glyphicon glyphicon-info-sign"></span> ABOUT <?= strtoupper(site_info('name',0)); ?></h4>
                <div class="full-margin-bottom full-margin-top">
                    <p class="text-left"><?= sub_words($page->getContent(), 0, 100); ?></p>
                    <div class="btn-group btn-group-xs text-left">
                        <a href="<?php home_url('/'.$page->getGuid().'/'); ?>" class="btn"><span class="glyphicon glyphicon-play"></span> Learn More</a>
                    </div>
                </div>
                <?php
            }
            ?>

            <?php
            if(is_object($data['how-it-works']))
            {
                $page = $data['how-it-works'];
                ?>
                <h4 class="page-header"><span class="glyphicon glyphicon-question-sign"></span> HOW IT WORKS</h4>
                <div class="full-margin-bottom full-margin-top">
                    <p class="text-left"><?= sub_words($page->getContent(), 0, 100); ?></p>
                    <div class="btn-group btn-group-xs text-left">
                        <a href="<?php home_url('/page/'.$page->getGuid().'/'); ?>" class="btn"><span class="glyphicon glyphicon-play"></span> Learn More</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="col-md-3 col-sm-4">
            <?php include_once("includes/social-connect.php"); ?>
        </div>
    </div>

    <div class="row full-margin-bottom">
        <div class="col-md-5 col-md-offset-1 col-sm-6">
        </div>
        <div class="col-md-5 col-sm-6">
        </div>
    </div>
<?php
require_once("footer.php");
?>