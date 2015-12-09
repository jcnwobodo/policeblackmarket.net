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
<div class="row height-50vh">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="page-header"><span class="glyphicon glyphicon-bullhorn"></span> <?= site_info('name', false).' Press Room'; ?></h2>
            <?php
            if(is_object($data['news']) and $data['news']->size())
            {
                foreach($data['news'] as $post)
                {
                    ?>
                    <div class="full-margin-bottom border-width-1px border-color1 border-bottom">
                        <div><h3 class="page-header"><span class="glyphicon glyphicon-file"></span> <?= $post->getTitle(); ?></h3></div>
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
            else
            {
                ?><p class="lead height-60vh">No posts yet, check again soon.</p><?php
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