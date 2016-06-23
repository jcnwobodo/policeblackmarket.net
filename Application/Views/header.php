<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (phoenixlabs.ng@gmail.com)
 * Project: BareBones PHP Framework
 * Date:    1/7/2016
 * Time:    8:11 PM
 **/

$requestContext = $rc = \System\Request\RequestContext::instance();
$data = $requestContext->getResponseData();
$page_title = isset($data['page-title']) ? $data['page-title'] : site_info('name',0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="J. C. Nwobodo">
    <link rel="icon" href="<?php home_url('/Assets/favicon.ico'); ?>">

    <title><?= $page_title; ?> -<?php site_info('name'); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php home_url('/Assets/css/style.css'); ?>" type="text/css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-inverse bg-color1 no-margin text-nowrap" style="border-radius: 0%">
    <div class="container-fluid width-controller">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php home_url('/'); ?>"><span class="glyphicon glyphicon-eye-close"></span> <?= strtoupper(site_info('name',0)); ?></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li <?= $s = ($rc->isRequestUrl('') ? 'class="active"': ''); ?>><a href="<?php home_url('/');?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li <?= $s = ($rc->isRequestUrl('submit-report') ? 'class="active"': ''); ?>><a href="<?php home_url('/submit-report/');?>"><span class="glyphicon glyphicon-pencil"></span> SUBMIT REPORT</a></li>
                <li <?= $s = ($rc->isRequestUrl('reports') ? 'class="active"': ''); ?>><a href="<?php home_url('/reports/');?>"><span class="glyphicon glyphicon-flag"></span> REPORTS</a></li>
                <li <?= $s = ($rc->isRequestUrl('page/how-it-works') ? 'class="active"': ''); ?>><a href="<?php home_url('/page/how-it-works/');?>"><span class="glyphicon glyphicon-flash"></span> HOW IT WORKS</a></li>
                <li <?= $s = ($rc->isRequestUrl('news') ? 'class="active"': ''); ?>><a href="<?php home_url('/news/');?>"><span class="glyphicon glyphicon-bullhorn"></span> NEWS</a></li>
                <li <?= $s = ($rc->isRequestUrl('contact') ? 'class="active"': ''); ?>><a href="<?php home_url('/contact/');?>"><span class="glyphicon glyphicon-envelope"></span> CONTACT</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="main-container container-fluid width-controller">
    <!--rest of the body-->