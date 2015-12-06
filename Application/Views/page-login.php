<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/20/2015
 * Time:    2:55 PM
 **/

$requestContext = \System\Request\RequestContext::instance();
$response_data = $requestContext->getFlashData();
include_once('header.php');
?>
<form action="<?php home_url('/login/')?>" enctype="multipart/form-data" method="post">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 height-90vh">
            <h2 class="page-header"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Admin Login</h2>

            <?php
            if($requestContext->fieldIsSet('login'))
            {
                ?>
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 text-danger bg-danger text-center lead"><?php print_r($response_data); ?></div>
                </div>
                <?php
            }
            ?>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                    </div>
                    <div class="col-md-9">
                        <input name="username" id="username" type="text" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="password"><span class="glyphicon glyphicon-lock"></span> Password</label>
                    </div>
                    <div class="col-md-9">
                        <input name="password" id="password" type="password" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="btn-group pull-right">
                        <button name="login" id="login" type="submit" class="btn btn-primary">
                            Login
                            <span class="glyphicon glyphicon-log-in"></span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
<?php include_once("footer.php"); ?>
