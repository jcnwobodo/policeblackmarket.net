<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/29/2015
 * Time:    1:19 PM
 **/

$requestContext = \System\Request\RequestContext::instance();
$method = $requestContext->getRequestUrlParam(1);

$group1 = array('manage-reports', 'manage-comments', 'manage-locations', 'add-location', 'manage-categories', 'add-category');
$group2 = array('add-user', 'manage-users');
$group3 = array('add-news-post', 'manage-news-posts');
$group4 = array('add-page','manage-pages');
?>
<div class="col-sm-3 col-md-2 sidebar">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="btn-link">
                        <span class="glyphicon glyphicon-flag"></span> Reports
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse <?= in_array($method, $group1)? 'in': ''; ?>" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body no-padding">
                    <ul class="btn-group btn-group-vertical list-unstyled">
                        <li><a href="<?php home_url('/admin-area/manage-reports/'); ?>" class="btn"><span class="glyphicon glyphicon-flag"></span> Manage Reports</a></li>
                        <li><a href="<?php home_url('/admin-area/manage-comments/'); ?>" class="btn"><span class="glyphicon glyphicon-comment"></span> Moderate Comments</a></li>
                        <li><a href="<?php home_url('/admin-area/manage-locations/'); ?>" class="btn"><span class="glyphicon glyphicon-map-marker"></span> Manage Locations</a></li>
                        <li><a href="<?php home_url('/admin-area/manage-categories/'); ?>" class="btn"><span class="glyphicon glyphicon-tags"></span> Manage Categories</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="btn-link">
                        <span class="glyphicon glyphicon-bullhorn"></span> Newsroom
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse <?= in_array($method, $group3)? 'in': ''; ?>" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body no-padding">
                    <ul class="btn-group btn-group-vertical list-unstyled">
                        <li><a href="<?php home_url('/admin-area/add-news-post/'); ?>" class="btn"><span class="glyphicon glyphicon-plus-sign"></span> New Release</a></li>
                        <li><a href="<?php home_url('/admin-area/manage-news-posts/'); ?>" class="btn"><span class="glyphicon glyphicon-tasks"></span> Manage News Posts</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn-link">
                        <span class="glyphicon glyphicon-user"></span> Community
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse <?= in_array($method, $group2)? 'in': ''; ?>" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body no-padding">
                    <ul class="btn-group btn-group-vertical list-unstyled">
                        <li><a href="<?php home_url('/admin-area/add-user/'); ?>" class="btn"><span class="glyphicon glyphicon-plus-sign"></span> Add User</a></li>
                        <li><a href="<?php home_url('/admin-area/manage-users/'); ?>" class="btn"><span class="glyphicon glyphicon-tasks"></span> Manage Users</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading-4">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4" class="btn-link">
                        <span class="glyphicon glyphicon-file"></span> Pages
                    </a>
                </h4>
            </div>
            <div id="collapse-4" class="panel-collapse collapse <?= in_array($method, $group4)? 'in': ''; ?>" role="tabpanel" aria-labelledby="heading-4">
                <div class="panel-body no-padding">
                    <ul class="btn-group btn-group-vertical list-unstyled">
                        <li><a href="<?php home_url('/admin-area/add-page/'); ?>" class="btn"><span class="glyphicon glyphicon-plus-sign"></span> Add Page</a></li>
                        <li><a href="<?php home_url('/admin-area/manage-pages/'); ?>" class="btn"><span class="glyphicon glyphicon-tasks"></span> Manage Pages</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

