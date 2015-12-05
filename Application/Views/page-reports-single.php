<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    12/3/2015
 * Time:    7:03 PM
 **/

$requestContest = \System\Request\RequestContext::instance();
$data = $requestContest->getResponseData();
$report = $data['reports'];
$comments = $data['comments'];

require_once("header.php");
?>
<div class="row full-padding-bottom">
    <div class="col-md-7 col-md-offset-1">
        <h2 class="page-header"><?= site_info('name'); ?> Report</h2>
        <article>
            <h3><?= $report->getTitle(); ?></h3>
            <p>
                <span class="glyphicon glyphicon-calendar"></span> <?= $report->getEventTime()->getDateTimeStr(); ?> |
                <span class="glyphicon glyphicon-map-marker"></span> <?= $report->getLocation(); ?>
            </p>
            <div class="text-justify"><?= $report->getDescription(); ?></div>
        </article>
        <div id="comments">
            <form method="post" action="<?php home_url('/reports/?id='.$report->getId().'#comments'); ?>">
                <fieldset><legend>Comments</legend></fieldset>
                <?php
                if(is_object($comments) and $comments->size())
                {
                    foreach($comments as $comment)
                    {
                        ?>
                        <div class="full-margin-bottom border-bottom border-color3 border-width-1px">
                            <div class="row">
                                <p class="col-xs-6"><span class="glyphicon glyphicon-user"></span> <?= $comment->getCommentAuthor()->getFirstName(); ?></p>
                                <p class="col-xs-6 text-right"><span class="glyphicon glyphicon-calendar"> </span> <?= $comment->getCommentTime()->getDateTimeStr(); ?></p>
                            </div>
                            <p><span class="glyphicon glyphicon-comment"></span> <?= $comment->getContent(); ?></p>
                        </div>
                        <?php
                    }
                    ?><p class="lead">Your voice counts! Post a reply.</p><?php
                }
                else
                {
                    ?><p class="lead">Be the first person to comment on this report!</p><?php
                }
                ?>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-xs-3"><label for="author_name">Name</label></div>
                        <div class="col-xs-9"><input name="author_name" id="author_name" type="text" class="form-control" placeholder="your name" required/></div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-xs-3"><label for="author_email">Email</label></div>
                        <div class="col-xs-9"><input name="author_email" id="author_email" type="text" class="form-control" placeholder="your-email@domain.com" required/></div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3"><label for="author_comment">Comment</label></div>
                        <div class="col-sm-9"><textarea name="author_comment" id="author_comment" class="form-control height-10vh" placeholder="what's on your mind?" required></textarea></div>
                    </div>
                </div>
                <div class="text-center mid-margin-bottom <?= $data['status'] ? 'text-success bg-success' : 'text-danger bg-danger';?>"><?= $requestContest->getFlashData(); ?></div>
                <div class="form-group form-group-sm pull-right">
                    <input name="post_comment" id="post_comment" type="submit" value="Submit Comment" class="btn btn-primary">
                </div>
                <span class="clear-both"></span>
            </form>
        </div>
    </div>
    <div class="col-md-3">
        sidebar
    </div>
</div>
<?php
require_once("footer.php");
?>