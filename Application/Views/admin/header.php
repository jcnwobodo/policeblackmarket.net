<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    11/29/2015
 * Time:    1:06 PM
 **/

$rc = \System\Request\RequestContext::instance();
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

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php home_url('/Assets/css/style.css'); ?>" type="text/css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php home_url('/Assets/css/dashboard.css'); ?>" type="text/css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-inverse bg-color1 navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">POLICE BLACK-MARKET</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li <?= $s = ($rc->isRequestUrl('') ? 'class="active"': ''); ?>><a href="<?php home_url('/');?>">HOME</a></li>
                <li <?= $s = ($rc->isRequestUrl('submit-report') ? 'class="active"': ''); ?>><a href="<?php home_url('/submit-report/');?>">SUBMIT REPORT</a></li>
                <li <?= $s = ($rc->isRequestUrl('reports') ? 'class="active"': ''); ?>><a href="<?php home_url('/reports/');?>">REPORTS</a></li>
                <li <?= $s = ($rc->isRequestUrl('how-it-works') ? 'class="active"': ''); ?>><a href="<?php home_url('/how-it-works/');?>">HOW IT WORKS</a></li>
                <li <?= $s = ($rc->isRequestUrl('news') ? 'class="active"': ''); ?>><a href="<?php home_url('/news/');?>">NEWS</a></li>
                <li <?= $s = ($rc->isRequestUrl('contact') ? 'class="active"': ''); ?>><a href="<?php home_url('/contact/');?>">CONTACT</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container-fluid">
