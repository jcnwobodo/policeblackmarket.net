<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/20/2015
 * Time:    1:17 PM
 **/

$response_data = \System\Request\RequestContext::instance()->getResponseData();
include_once('header.php');
?>
    <form>
        <div class="row full-margin-bottom">
            <div class="col-md-10 col-md-offset-1 height-90vh">
                <h2 class="page-header">Get in touch with us</h2>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sender-name">Name</label>
                        </div>
                        <div class="col-md-9">
                            <input name="sender-name" id="sender-name" class="form-control" placeholder="Your Name"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sender-email">Email Address</label>
                        </div>
                        <div class="col-md-9">
                            <input name="sender-email" id="sender-email" class="form-control" placeholder="youremail@website.com"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sender-phone" class="text-nowrap">Mobile Number</label>
                        </div>
                        <div class="col-md-9">
                            <input name="sender-phone" id="sender-phone" class="form-control" placeholder="+234..."/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sender-location">Location</label>
                        </div>
                        <div class="col-md-9">
                            <input name="sender-location" id="sender-location" type="text" class="form-control" placeholder="your location"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sender-message">Message</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="sender-message" id="sender-message" class="form-control height-30vh" placeholder="Your message ..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="btn-group-lg pull-right">
                    <button name="send" id="send" type="submit" class="btn btn-primary">
                        Send <span class="glyphicon glyphicon-send"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
<?php include_once("footer.php"); ?>