<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date: 11/17/2015
 * Time: 12:17 PM
 */

require_once("header.php");
?>
<div class="row bg-color5">
    <div class="col-lg-12 height-95vh text-center">
        <h4>Data Map</h4>
        <p class="lead">Google map with a layer of reports data.</p>
    </div>
</div>

<div class="row border-bottom border-color2 border-width-1px">
    <div class="col-lg-12 height-50vh text-center">
        <div>
            <h4>REPORTS TIME-LINE</h4>
            <p>some frequency polygon here...</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 height-40vh text-center">
        <div>
            <h4>TOP STATES</h4>
            <p>some horizontal bar chart here...</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 height-40vh text-center">
        <div>
            <h4>TOP TOWNS</h4>
            <p>some horizontal bar chart here...</p>
        </div>
    </div>
</div>

<div class="row bg-color5">
    <div class="col-lg-12 height-30vh text-center">
        <h4>CALL TO ACTION</h4>
        <p class="lead">
            some text that will move people to start filling in reports
        </p>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1">
        <h4>TRENDING</h4>
        <ul class="list-unstyled">
            <li>report 1</li>
            <li>report 2</li>
            <li>report 3</li>
            <li>report 4</li>
            <li>report 5</li>
        </ul>
    </div>
    <div class="col-lg-4 col-md-4">
        <h4>NEWSROOM</h4>
        <ul class="list-unstyled">
            <li>news 1</li>
            <li>news 2</li>
            <li>news 3</li>
            <li>news 4</li>
            <li>news 5</li>
        </ul>
    </div>
</div>
<div id="home-reports-filter-container" class="border-width-1px border-color1 border-surround mid-padding-all">
    <?php
    require_once("filter-form.php");
    ?>
</div>
<?php
require_once("footer.php");
?>