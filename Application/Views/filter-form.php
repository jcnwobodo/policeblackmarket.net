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
    <p class="lead">FILTER REPORTS</p>
    <fieldset>
        <legend class="no-margin">CATEGORY</legend>
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
    </fieldset>

    <fieldset>
        <legend class="no-margin">LOCATION</legend>
        <div class="form-group">
            <label for="location_state">State</label>
            <select name="location_state" class="form-control" id="location_state">
                <option value="all">All States</option>
                <option value="enugu">Enugu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="location_lga">Local Government Area</label>
            <select name="location_lga" class="form-control" id="location_lga">
                <option value="all">All LGAs in state</option>
                <option value="nsukka">Nsukka Town</option>
            </select>
        </div>
        <div class="form-group">
            <label for="location_town">Town</label>
            <select name="location_town" class="form-control" id="location_town">
                <option value="all">All Towns in LGA</option>
                <option value="nsukka">Nsukka</option>
            </select>
        </div>
    </fieldset>

    <fieldset>
        <legend class="no-margin">DATE</legend>
        <div class="form-group">
            <label for="start_year">From</label>
            <div class="row">
                <div class="col-sm-6">
                    <select name="start_year" id="start_year" class="form-control">
                        <option value="2015">2015</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <select name="start_month" id="start_month" class="form-control">
                        <option value="1">January</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="start_year">To</label>
            <div class="row">
                <div class="col-sm-6">
                    <select name="stop_year" id="stop_year" class="form-control">
                        <option value="2015">2015</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <select name="stop_month" id="stop_month" class="form-control">
                        <option value="12">December</option>
                    </select>
                </div>
            </div>
        </div>

    </fieldset>

    <button type="submit" class="btn btn-default">Submit</button>
</form>