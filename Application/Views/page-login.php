<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/20/2015
 * Time:    2:55 PM
 **/

$response_data = \System\Request\RequestContext::instance()->getFlashData();
include_once('header.php');
?>
<form action="<?php home_url('/login/')?>" enctype="multipart/form-data" method="post">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 height-90vh">
            <div class="lead"><h2>Admin Login</h2></div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="username">Username</label>
                    </div>
                    <div class="col-md-9">
                        <input name="username" id="username" type="text" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-md-9">
                        <input name="password" id="password" type="password" class="form-control"/>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 text-danger"><?php print_r($response_data); ?></div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-9 col-md-offset-3">
                        <input name="login" value="login" type="hidden">
                        <button type="submit" class="btn btn-primary">
                            Login
                            <span class="glyphicon-log-in"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php include_once("footer.php"); ?>
