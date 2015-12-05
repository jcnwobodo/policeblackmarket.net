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
                <h2 class="page-header"><span class="glyphicon glyphicon-envelope"></span> Get in touch with us</h2>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sender-name"><span class="glyphicon glyphicon-user"></span> Name</label>
                        </div>
                        <div class="col-md-9">
                            <input name="sender-name" id="sender-name" required type="text" class="form-control" placeholder="Your Name"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sender-email"><span class="glyphicon glyphicon-envelope"></span> Email Address</label>
                        </div>
                        <div class="col-md-9">
                            <input name="sender-email" id="sender-email" required type="email" class="form-control" placeholder="youremail@website.com"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sender-phone" class="text-nowrap"><span class="glyphicon glyphicon-phone"></span> Mobile Number</label>
                        </div>
                        <div class="col-md-9">
                            <input name="sender-phone" id="sender-phone" required type="tel" class="form-control" placeholder="08012345678"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sender-message"><span class="glyphicon glyphicon-pencil"></span> Message</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="sender-message" id="sender-message" required class="form-control height-40vh" placeholder="Your message ..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="btn-group-lg pull-right">
                    <button name="send" id="send" type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-envelope"></span> Send Message
                    </button>
                </div>
            </div>
        </div>
    </form>
<?php include_once("footer.php"); ?>