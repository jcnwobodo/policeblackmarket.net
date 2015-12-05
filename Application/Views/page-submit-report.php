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

$fields = $requestContext->getAllFields();

require_once("header.php");
?>
<div class="row full-margin-bottom">
    <form method="post">
        <div class="col-md-10 col-md-offset-1 full-margin-top">
            <h1 class="page-header"><span class="glyphicon glyphicon-pencil"></span> Write a Report</h1>
            <div class="form-group form-group-sm">
                <div class="row">
                    <div class="col-sm-2">
                        <label for="report_title">Report Title</label>
                    </div>
                    <div class="col-sm-10">
                        <input name="report_title" id="report_title" required type="text" maxlength="255" class="form-control" value="<?= isset($fields['report_title']) ? $fields['report_title'] : ''; ?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1">

            <!--report's info-->
            <fieldset>
                <legend><span class="glyphicon glyphicon-flag"></span> Report Particulars</legend>
                <div class="form-group form-group-sm">
                    <label for="report_description"><span class="glyphicon glyphicon-edit"></span> Description</label>
                    <textarea name="report_description" id="report_description" required class="form-control height-50vh"><?= isset($fields['report_description']) ? $fields['report_description'] : ''; ?></textarea>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="report_date"><span class="glyphicon glyphicon-calendar"></span> Date</label>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-xs-5">
                                    <?= drop_month('report_date[month]', isset($fields['report_date']['month']) ? $fields['report_date']['month'] : null ); ?>
                                </div>
                                <div class="col-xs-3">
                                    <?= drop_month_days('report_date[day]', isset($fields['report_date']['day']) ? $fields['report_date']['day'] : null ); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?= drop_years('report_date[year]', isset($fields['report_date']['year']) ? $fields['report_date']['year'] : null ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="report_time"><span class="glyphicon glyphicon-time"></span> Time</label>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-xs-4">
                                    <?= drop_hours('report_time[hour]', isset($fields['report_time']['hour']) ? $fields['report_time']['hour'] : null); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?= drop_minutes('report_time[minute]', isset($fields['report_time']['minute']) ? $fields['report_time']['minute'] : null); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?= drop_AmPM('report_time[am_pm]',  isset($fields['report_time']['am_pm']) ? $fields['report_time']['am_pm'] : date('A')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="report_categories"><span class="glyphicon glyphicon-tags"></span> Categories</label>
                        </div>
                        <div class="col-sm-9">
                            <?php
                            foreach($categories as $category)
                            {
                            ?>
                            <div class="checkbox">
                                <label>
                                    <input name="report_categories[]" type="checkbox" value="<?= $category->getId(); ?>" <?= checked($category->getId(), isset($fields['report_categories'])?$fields['report_categories']:array()); ?>> <?= $category->getCaption(); ?>
                                </label>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>

        </div>
        <div class="col-md-5">

            <!--location-->
            <fieldset>
                <legend><span class="glyphicon glyphicon-map-marker"> Location</span></legend>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="location_state">State</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="location_state" class="form-control" id="location_state" required>
                                <?php
                                foreach($location_states as $state)
                                {
                                    ?>
                                    <option value="<?= $state->getId(); ?>" <?= selected($state->getId(), isset($fields['location_state']) ? $fields['location_state'] : null); ?>><?= $state->getLocationName(); ?></option>
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
                            <select name="location_lga" class="form-control" id="location_lga" required>
                                <?php
                                foreach($location_lgas as $lga)
                                {
                                    ?>
                                    <option value="<?= $lga->getId(); ?>" <?= selected($lga->getId(), isset($fields['location_lga']) ? $fields['location_lga'] : null )?>><?= $lga->getLocationName(); ?></option>
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
                            <select name="location_district" class="form-control" id="location_district" required>
                                <?php
                                foreach($location_districts as $district)
                                {
                                    ?>
                                    <option value="<?= $district->getId(); ?>" <?= selected($district->getId(), isset($fields['location_district']) ? $fields['location_district'] : null)?>><?= $district->getLocationName(); ?></option>
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
                            <input name="location_scene" id="location_scene" required type="text" maxlength="255" class="form-control" placeholder="e.g. No. 10 New Street, Town-name" value="<?= isset($fields['location_scene']) ? $fields['location_scene'] : ''; ?>"/>
                        </div>
                    </div>
                </div>
            </fieldset>

            <!--supporting evidences-->
            <fieldset>
                <legend><span class="glyphicon glyphicon-paperclip"></span> Supporting Evidences</legend>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="evidence_photos1"><span class="glyphicon glyphicon-camera"></span> Photo</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="evidence_photos[]" id="evidence_photos1" type="file"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="evidence_video1"><span class="glyphicon glyphicon-facetime-video"></span> Video Link</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="evidence_video[]" id="evidence_video1" type="url" class="form-control" placeholder="http://" value="<?= isset($fields['evidence_video'][0]) ? $fields['evidence_video'][0] : ''; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="evidence_news1">News Source</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="evidence_news[]" id="evidence_news1" type="url" class="form-control" placeholder="http://site1.com/item" value="<?= isset($fields['evidence_news'][0]) ? $fields['evidence_news'][0] : ''; ?>"/>
                        </div>
                    </div>
                </div>
            </fieldset>

            <!--reporter's info-->
            <fieldset>
                <legend><span class="glyphicon glyphicon-user"></span> Reporter's Data</legend>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="reporter_first-name">First Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="reporter_first-name" id="reporter_first-name" required type="text" class="form-control" value="<?= isset($fields['reporter_first-name']) ? $fields['reporter_first-name'] : ''; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="reporter_last-name">Last Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="reporter_last-name" id="reporter_last-name" required type="text" class="form-control" value="<?= isset($fields['reporter_last-name']) ? $fields['reporter_last-name'] : ''; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="reporter_email">Email Address</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="reporter_email" id="reporter_email" required type="email" class="form-control" value="<?= isset($fields['reporter_email']) ? $fields['reporter_email'] : ''; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="reporter_phone">Phone</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="reporter_phone" id="reporter_phone" required type="tel" class="form-control" value="<?= isset($fields['reporter_phone']) ? $fields['reporter_phone'] : ''; ?>">
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="btn-group-lg pull-right">
                    <button name="submit" id="submit-but" type="submit" class="btn btn-primary">
                        Submit Report <span class="glyphicon glyphicon-send"></span>
                    </button>
            </div>
        </div>
    </form>
</div>
<?php
require_once("footer.php");
?>