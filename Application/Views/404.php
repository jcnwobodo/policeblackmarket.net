<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/27/2015
 * Time:    10:46 AM
 */

include_once('header.php');
$requestContext = \System\Request\RequestContext::instance();
?>
<div class="content-wrapper height-80vh bg-color2 border3-surround mid-margin-top mid-margin-bottom">
    <div id="content" class="article-wrapper display-inline-block no-margin align-center">

        <article>
            <h1>404 - Page Not Found!</h1>
            <h6>This page could not be found.</h6>
            <p>The page may have moved, the URL may have changed, or it is being accessed by the wrong URL.</p>

            <h3 class="align-left">SEARCH SITE</h3>
            <!--search form-->
            <form  method="get" id="search-form" action="<?= home_url('/attorneys/search'); ?>" class="full-padding-all shadow-color1 width-90pc bg-color4 display-inline-block">
                <input type="text" name="s" id="s" class="width-90pc no-bg no-border display-inline-block color2" placeholder="Search&hellip;"/>
                <input type="submit" name="" value=" " class="no-bg search-icon no-border display-inline-block"/>
            </form>
            <!--/search form-->

            <?php if(is_development())
            {
                ?>
                <p>
                    <?php echo $requestContext->getResponseData(); ?>
                </p>
                <?php
            }
            ?>
        </article>
    </div>
    <div class="sidebar-wrapper display-inline-block no-margin align-left border3-left">
        <aside>
            <?php
            include_once("includes/sidebar-site-map.php");
            include_once("includes/social-connect.php");
            ?>
        </aside>
    </div>
</div>
<?php include_once("footer.php"); ?>