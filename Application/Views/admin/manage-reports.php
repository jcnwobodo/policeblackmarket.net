<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    12/2/2015
 * Time:    5:39 AM
 **/

$rc = \System\Request\RequestContext::instance();
$data = $rc->getResponseData();

require_once("header.php");
?>
<div class="row">
    <?php
    require_once("sidebar.php");
    ?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Manage Reports</h1>
        <div class="btn-group pull-right">
            <a href="<?php home_url('/'.$rc->getRequestUrlParam(0).'/'.$rc->getRequestUrlParam(1).'/?status=approved'); ?>" class="btn btn-success">Approved</a>
            <a href="<?php home_url('/'.$rc->getRequestUrlParam(0).'/'.$rc->getRequestUrlParam(1).'/?status=pending'); ?>" class="btn btn-primary">Pending</a>
            <a href="<?php home_url('/'.$rc->getRequestUrlParam(0).'/'.$rc->getRequestUrlParam(1).'/?status=deleted'); ?>" class="btn btn-danger">Deleted</a>
        </div>


        <?php
        if(is_object($data['reports']) and $data['reports']->size())
        {
            ?>
            <form method="post">
                <div class="table-responsive clear-both">
                    <table class="table table-stripped table-bordered table-hover full-margin-top">
                        <thead>
                        <tr>
                            <td colspan="5" class="lead"><?= ucwords($data['status']); ?> Reports</td>
                        </tr>
                        <tr>
                            <td>SN</td>
                            <td>Title</td>
                            <td>Date/Time</td>
                            <td>Location</td>
                            <td>&hellip;</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sn = 0;
                        foreach($data['reports'] as $report)
                        {
                            ?>
                            <tr>
                                <td><?= ++$sn; ?></td>
                                <td><?= $report->getTitle(); ?></td>
                                <td><?= $report->getEventTime()->getDateTimeStr(); ?></td>
                                <td><?= $report->getLocationDistrict()->getLocationName().", ".$report->getLocationLga()->getLocationName().", ".$report->getLocationState()->getLocationName(); ?></td>
                                <td><input type="checkbox" name="report-ids[]" value="<?= $report->getId(); ?>"></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="btn-group pull-right">
                    <?php
                    switch($data['status'])
                    {
                        case 'pending' : {
                            ?>
                            <input name="action" type="submit" class="btn btn-success" value="Approve">
                            <input name="action" type="submit" class="btn btn-danger" value="Delete">
                            <?php
                        } break;
                        case 'approved' : {
                            ?>
                            <input name="action" type="submit" class="btn btn-primary" value="Disapprove">
                            <input name="action" type="submit" class="btn btn-danger" value="Delete">
                            <?php
                        } break;
                        case 'deleted' : {
                            ?>
                            <input name="action" type="submit" class="btn btn-success" value="Restore">
                            <input name="action" type="submit" class="btn btn-danger" value="Delete Permanently">
                            <?php
                        } break;
                        default : {
                            ?>
                            <input name="action" type="submit" class="btn btn-success" value="Approve">
                            <input name="action" type="submit" class="btn btn-default" value="Disapprove">
                            <input name="action" type="submit" class="btn btn-danger" value="Delete">
                            <input name="action" type="submit" class="btn btn-success" value="Restore">
                            <?php
                        }
                    }
                    ?>
                </div>
            </form>
            <?php
        }
        else
        {
            ?>
            <div class="clear-both text-center text-danger">
                <p class="lead">There are currently no <?= $data['status']; ?> reports.</p>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
require_once("footer.php");
?>