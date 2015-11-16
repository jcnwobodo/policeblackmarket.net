<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date: 10/4/2015
 * Time: 12:17 PM
 */

include_once('header.php');
?>
<div class="z-index2 align-left mid-padding-top">
    <div class="align-left bg-color2 color3">
        <div class="bg-color4 color2">
            <h3 class="tiny-padding-all">Welcome to <?php site_info('name'); ?></h3>
        </div>
        <div class="bg-color2">
            <div class="tiny-padding-top align-center">
                <article>
                <?php include_once("includes/homepage_slider.php"); ?>
                </article>
            </div>
        </div>
        <div class="height-15vh text-large color3">
            <div class="align-center full-padding-all">
                <aside class="mid-padding-all">
                    <blockquote cite="Barr. JMCC Ogbuka">
                        <p>
                            The only condition for the preservation of the institute of the rule of law as a guarantee for the enjoyment
                            of liberty, freedom and justice by the people under our constitution is the existence of men possessed of
                            <b>unlimited erudition</b>, <b>robust intellect</b> and <b>a fearless spirit of incorruptible conscience</b>.
                            Upon this tripod of virtue is founded the BAR and BENCH of every great nation or state.
                        </p>
                        <p class="align-right">
                            <cite>Barr JMCC Ogbuka</cite>
                        </p>
                    </blockquote>
                    <p class="text-x-large color3">
                        WELCOME TO THE HOUSE OF LAWS CHAMBERS
                    </p>
                </aside>
            </div>
        </div>
        <div class="height-15vh text-large bg-color5 color4">
            <div class="align-center full-padding-all">
                <h2 class="align-left mid-padding-all page-title">About Us</h2>
                <aside class="mid-padding-all">
                    <p>
                        <?php
                        $about_page = \Application\Models\Post::getMapper('Post')->findByPamalink('about');
                        echo $about_page->getExcerpt();
                        ?>
                    </p>
                    <p class="align-right">
                        <a href="<?php home_url('/'.$about_page->getPamalink());?>" class="border-surround border-color4 border-width-1px tiny-padding-all bg-color2">Learn More</a>
                    </p>
                </aside>
            </div>
        </div>

        <div class="height-15vh text-large bg-color2 color1">
            <div class="align-center full-padding-all">
                <h2 class="align-left mid-padding-all page-title">Practice Areas</h2>
                <aside class="mid-padding-all">
                    <p>
                        Our experience in legal practice span across various areas, from Human Rights Enforcement/Defense to Constitutional Law.
                    </p>
                    <p class="align-right">
                        <a href="<?php home_url('/practice-areas');?>" class="border-surround border-color4 border-width-1px tiny-padding-all bg-color2">Learn More</a>
                    </p>
                </aside>
            </div>
        </div>
        <div class="bg-color5 color4">
            <?php include_once('includes/social-connect.php'); ?>
        </div>
    </div>
</div>

<!--featured content-->
<!--
<div id="featured-widget-area" class="mid-padding-top">
    <div class="bg-color2 color4 align-center mid-padding-bottom">
        <div class="bg-color4 align-left">
            <h6 class="tiny-padding-left color2">What we do</h6>
        </div>
        <div class="display-inline-block width-30pc mid-margin-all align-left tiny-padding-all">
            some text
        </div>
        <div class="display-inline-block width-30pc mid-margin-all align-left tiny-padding-all">
            some text
        </div>
        <div class="display-inline-block width-30pc mid-margin-all align-left tiny-padding-all">
            some text
        </div>
    </div>
</div>
-->
<?php include_once("footer.php"); ?>