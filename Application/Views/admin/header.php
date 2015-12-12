<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/29/2015
 * Time:    1:06 PM
 **/

$rc = \System\Request\RequestContext::instance();
$page_title = isset($rc->getResponseData()['page-title']) ? $rc->getResponseData()['page-title'] : 'Home';
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

    <!-- Custom styles for this template -->
    <link href="<?php home_url('/Assets/css/dashboard.css'); ?>" type="text/css" rel="stylesheet">

</head>

<body class="bg-color3">

<nav class="navbar navbar-inverse bg-color1 navbar-fixed-top">
    <div class="container-fluid">
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
                <li <?= $s = ($rc->isRequestUrl('admin-area') ? 'class="active"': ''); ?>><a href="<?php home_url('/admin-area/');?>"><span class="glyphicon glyphicon-cog"></span> ADMIN-AREA</a></li>
                <li <?= $s = ($rc->isRequestUrl('account-setting') ? 'class="active"': ''); ?>><a href="<?php home_url('/account-settings/');?>"><span class="glyphicon glyphicon-user"></span> MY ACCOUNT</a></li>
                <li <?= $s = ($rc->isRequestUrl('logout') ? 'class="active"': ''); ?>><a href="<?php home_url('/logout/');?>"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container-fluid">
