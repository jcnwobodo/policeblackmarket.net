<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date: 11/17/2015
 * Time: 12:17 PM
 */

//Obtain a random quote
include_once("includes/_quotes.php");
$quote = getRandomQuote();

require_once("header.php");
?>

    <div class="row full-margin-top">
        <div class="col-md-10 col-md-offset-1 bg-color1 height-40vh">
            <div class="color3">
                <blockquote class="lead">
                    <p class="text-center" style="font-size: 85%"><?= $quote[0]; ?></p>
                    <p class="text-right"><cite><?= $quote[1]; ?></cite></p>
                </blockquote>
                <div class="text-center border-top border-color2 border-width-1px">
                    <p class="lead">
                        Evil persists when and where good men and women decide to fold their hands and do nothing,
                        take action today, expose the evil by reporting today!
                    </p>
                    <p class="btn-group">
                        <a href="<?php home_url('/submit-report'); ?>" class="btn btn-primary">SUBMIT A REPORT</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7 col-md-offset-1 col-sm-8">
            <h4 class="page-header"><span class="glyphicon glyphicon-flag"></span> TRENDING REPORTS</h4>
            <h4 class="page-header"><span class="glyphicon glyphicon-bullhorn"></span> IN THE NEWS &hellip;</h4>
            <h4 class="page-header"><span class="glyphicon glyphicon-info-sign"></span> ABOUT <?= strtoupper(site_info('name',0)); ?></h4>
            <h4 class="page-header"><span class="glyphicon glyphicon-question-sign"></span> HOW IT WORKS</h4>
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