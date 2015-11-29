<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/17/2015
 * Time:    5:49 PM
 **/

$requestContext = \System\Request\RequestContext::instance();

$data = $requestContext->getResponseData();
$categories = $data['categories'];
$location_states = $data['location-states'];
$location_lgas = $data['location-lgas'];
$location_districts = $data['location-districts'];

require_once("header.php");
?>
<div class="row">
    <form method="post">
        <div class="col-md-10 col-md-offset-1 full-margin-top">
            <div class="form-group form-group-sm">
                <div class="row">
                    <div class="col-sm-2">
                        <label for="report_title">Title</label>
                    </div>
                    <div class="col-sm-10">
                        <input name="report_title" id="report_title" type="text" maxlength="255" class="form-control"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1">

            <!--report's info-->
            <fieldset>
                <legend>Report Particulars</legend>
                <div class="form-group form-group-sm">
                    <label for="report_description">Description</label>
                    <textarea name="report_description" id="report_description" class="form-control height-20vh"></textarea>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="report_date">Date</label>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-5">
                                    <?= drop_month('report_date[month]', date('n')); ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= drop_month_days('report_date[day]'); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= drop_years('report_date[year]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="report_time">Time</label>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= drop_hours('report_time[hour]'); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= drop_minutes('report_time[minute]'); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= drop_AmPM('report_time[am_pm]', date('A')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="report_categories">Categories</label>
                        </div>
                        <div class="col-sm-9">
                            <?php
                            foreach($categories as $category)
                            {
                            ?>
                            <div class="checkbox">
                                <label>
                                    <input name="report_categories[]" type="checkbox" value="<?= $category->getId(); ?>"> <?= $category->getCaption(); ?>
                                </label>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>

            <!--location-->
            <fieldset>
                <legend>Location</legend>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="location_state">State</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="location_state" class="form-control" id="location_state">
                                <?php
                                foreach($location_states as $state)
                                {
                                    ?>
                                    <option value="<?= $state->getId(); ?>"><?= $state->getLocationName(); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="location_lga" title="Local Government Area">LGA</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="location_lga" class="form-control" id="location_lga">
                                <?php
                                foreach($location_lgas as $lga)
                                {
                                    ?>
                                    <option value="<?= $lga->getId(); ?>"><?= $lga->getLocationName(); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="location_district">District</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="location_district" class="form-control" id="location_district">
                                <?php
                                foreach($location_districts as $district)
                                {
                                    ?>
                                    <option value="<?= $district->getId(); ?>"><?= $district->getLocationName(); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="location_scene">Scene</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="location_scene" id="location_scene" type="text" maxlength="255" class="form-control" placeholder="e.g. No. 10 New Street, Town-name"/>
                        </div>
                    </div>
                </div>
            </fieldset>

        </div>
        <div class="col-md-5">

            <!--supporting evidences-->
            <fieldset>
                <legend>Supporting Evidences</legend>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="evidence_news1">News Source</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="evidence_news[]" id="evidence_news1" type="url" class="form-control" placeholder="http://"/>
                            <input name="evidence_news[]" id="evidence_news2" type="url" class="form-control" placeholder="http://"/>
                            <input name="evidence_news[]" id="evidence_news3" type="url" class="form-control" placeholder="http://"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="evidence_video1">Video Link</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="evidence_video[]" id="evidence_video1" type="url" class="form-control" placeholder="http://"/>
                            <input name="evidence_video[]" id="evidence_video2" type="url" class="form-control" placeholder="http://"/>
                            <input name="evidence_video[]" id="evidence_video3" type="url" class="form-control" placeholder="http://"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="evidence_photos1">Photos</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="evidence_photos[]" id="evidence_photos1" type="file"/>
                            <input name="evidence_photos[]" id="evidence_photos2" type="file"/>
                            <input name="evidence_photos[]" id="evidence_photos3" type="file"/>
                            <input name="evidence_photos[]" id="evidence_photos4" type="file"/>
                            <input name="evidence_photos[]" id="evidence_photos5" type="file"/>
                        </div>
                    </div>
                </div>
            </fieldset>

            <!--reporter's info-->
            <fieldset>
                <legend>Reporter's Data (Optional)</legend>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="reporter_first-name">First Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="reporter_first-name" id="reporter_first-name" type="text" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="reporter_last-name">Last Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="reporter_last-name" id="reporter_last-name" type="text" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="reporter_email">Email Address</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="reporter_email" id="reporter_email" type="email" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="reporter_phone">Phone</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="reporter_phone" id="reporter_phone" type="tel" class="form-control">
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="btn-group pull-right">
                    <input name="submit" id="submit-but" type="submit" value="SUBMIT REPORT" class="form-control btn-primary">
            </div>
        </div>
    </form>
</div>
<?php
require_once("footer.php");
?>