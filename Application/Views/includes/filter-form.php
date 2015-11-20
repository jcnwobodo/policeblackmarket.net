<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackmarket
 * Date:    11/17/2015
 * Time:    2:49 PM
 **/
?>
<form>
    <h3 class="">FILTER REPORTS</h3>
    <fieldset>
        <legend class="no-margin full-margin-top small">CATEGORY</legend>
        <div class="form-group-sm checkbox">
            <label>
                <input type="checkbox" value=""> Category 1
            </label>
        </div>
        <div class="form-group-sm checkbox">
            <label>
                <input type="checkbox" value=""> Category 2
            </label>
        </div>
        <div class="form-group-sm checkbox">
            <label>
                <input type="checkbox" value=""> Category 3
            </label>
        </div>
        <div class="form-group-sm checkbox">
            <label>
                <input type="checkbox" value=""> Category 4
            </label>
        </div>
    </fieldset>

    <fieldset>
        <legend class="no-margin full-margin-top small">LOCATION</legend>
        <div class="form-group-sm">
            <div class="row">
                <div class="col-sm-3">
                    <label for="location_state">State</label>
                </div>
                <div class="col-sm-9">
                    <select name="location_state" class="form-control" id="location_state">
                        <option value="all">All States</option>
                        <option value="enugu">Enugu</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group-sm">
            <div class="row">
                <div class="col-sm-3">
                    <label for="location_lga" title="Local Government Area">LGA</label>
                </div>
                <div class="col-sm-9">
                    <select name="location_lga" class="form-control" id="location_lga">
                        <option value="all">All LGAs in state</option>
                        <option value="nsukka">Nsukka Town</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group-sm">
            <div class="row">
                <div class="col-sm-3">
                    <label for="location_town">Town</label>
                </div>
                <div class="col-sm-9">
                    <select name="location_town" class="form-control" id="location_town">
                        <option value="all">All Towns in LGA</option>
                        <option value="nsukka">Nsukka</option>
                    </select>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend class="no-margin full-margin-top small">DATE</legend>
        <div class="form-group-sm">
            <div class="row">
                <div class="col-sm-3">
                    <label for="start_year">From</label>
                </div>
                <div class="col-sm-5">
                    <select name="start_month" id="start_month" class="form-control">
                        <option value="1">January</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select name="start_year" id="start_year" class="form-control">
                        <option value="2015">2015</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group-sm">
            <div class="row">
                <div class="col-sm-3">
                    <label for="stop_year">To</label>
                </div>
                <div class="col-sm-5">
                    <select name="stop_month" id="stop_month" class="form-control">
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select name="stop_year" id="stop_year" class="form-control">
                        <option value="2015">2015</option>
                    </select>
                </div>
            </div>
        </div>

    </fieldset>

    <div class="btn-group full-padding-top">
        <button type="submit" class="btn btn-primary">FILTER REPORTS</button>
        <button type="reset" class="btn btn-default">RESET FILTERS</button>
    </div>
</form>