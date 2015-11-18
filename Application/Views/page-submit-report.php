<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/17/2015
 * Time:    5:49 PM
 **/

require_once("header.php");
?>
<div class="row">
    <form>
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
                            <input name="report_date" id="report_date" type="text" maxlength="10" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="report_time">Time</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="report_time" id="report_time" type="text" maxlength="10" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="report_categories">Categories</label>
                        </div>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value=""> Category 1
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value=""> Category 2
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value=""> Category 3
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value=""> Category 4
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value=""> Category 5
                                </label>
                            </div>
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
        </div>
        <div class="col-md-5">
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
                                <option value="enugu">Enugu</option>
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
                                <option value="nsk-lga">Nsukka LGA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="location_town">Town</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="location_town" class="form-control" id="location_town">
                                <option value="nsukka">Nsukka Town</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="scene">Scene</label>
                    <textarea name="scene" id="scene" placeholder="Describe the scene of the event (if applicable)" class="form-control height-10vh"></textarea>
                </div>
            </fieldset>

            <!--supporting evidences-->
            <fieldset>
                <legend>Supporting Evidences</legend>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="evidence_news">News Source</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="evidence_news" id="evidence_news" type="url" class="form-control" placeholder="http://"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="evidence_video">Video Link</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="evidence_video" id="evidence_video" type="url" class="form-control" placeholder="http://"/>
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