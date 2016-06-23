<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/20/2015
 * Time:    1:17 PM
 **/

$requestContext = \System\Request\RequestContext::instance();
$data = $requestContext->getResponseData();
$fields = $requestContext->getAllFields(INPUT_POST);

include_once('header.php');
?>
    <form method="post" enctype="multipart/form-data" action="<?php home_url('/contact/send/'); ?>">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2 class="page-header"><span class="glyphicon glyphicon-envelope"></span> Get in touch with us</h2>

                <?php if(isset($data['status'])){ ?>
                    <div class="text-center mid-margin-bottom lead <?= $data['status'] ? 'text-success bg-success' : 'text-danger bg-danger';?>">
                        <?= $requestContext->getFlashData(); ?>
                    </div>
                <?php } ?>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="subject"><span class="glyphicon glyphicon-flag"></span> Subject</label>
                        </div>
                        <div class="col-md-9">
                            <input name="subject" id="subject" required type="text" class="form-control" placeholder="Subject of discussion" value="<?= isset($fields['subject'])?$fields['subject']:'';?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="name"><span class="glyphicon glyphicon-user"></span> Name</label>
                        </div>
                        <div class="col-md-9">
                            <input name="name" id="name" required type="text" class="form-control" placeholder="Your Name" value="<?= isset($fields['name'])?$fields['name']:'';?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
                        </div>
                        <div class="col-md-9">
                            <input name="email" id="email" required type="email" class="form-control" placeholder="your-email@website.com" value="<?= isset($fields['email'])?$fields['email']:'';?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="phone" class="text-nowrap"><span class="glyphicon glyphicon-phone"></span> Phone</label>
                        </div>
                        <div class="col-md-9">
                            <input name="phone" id="phone" required type="tel" class="form-control" placeholder="08012345678" value="<?= isset($fields['phone'])?$fields['phone']:'';?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="message"><span class="glyphicon glyphicon-pencil"></span> Message</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="message" id="message" required class="form-control" placeholder="Your message ..." style="height: 13em;"><?= isset($fields['message'])?$fields['message']:'';?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p class="text-right">
                        <button name="send" id="send" type="submit" class="btn btn-lg btn-primary">
                            <span class="glyphicon glyphicon-send"></span> Send Mail
                        </button>
                    </p>
                </div>
            </div>
        </div>
        <div class="row full-margin-bottom">
            <hr/>
            <div class="col-md-10 col-md-offset-1">
                <?php include_once("includes/social-connect.php"); ?>
            </div>
        </div>
    </form>
<?php include_once("footer.php"); ?>