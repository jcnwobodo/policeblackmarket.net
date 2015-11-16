<!DOCTYPE html>
<html>
<head>
    <title><?php site_info('name'); ?></title>
    <meta charset="<?php site_info('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php stylesheet_url(); ?>" rel="stylesheet"/>
</head>

<body class="no-padding no-margin">
<div class="height-100vh margin-auto bg-color1 modal-thick">
    <div class="width-95pc margin-auto">
    <div id="masthead" class="bg-color2 color1 align-center mid-padding-top tiny-padding-bottom">
        <div id="logo-container" class="display-inline-block vertical-middle width-15pc align-center">
            <p id="header-logo" class="logo-big margin-auto">
                <a href="<?php site_info('site_url')?>" class="color-inherit">
                    <img src="<?php home_url('/Assets/images/logo.png'); ?>" alt="Logo" title="<?php site_info('name'); ?> Homepage" class="width-85pc margin-auto"/>
                </a>
            </p>
        </div>
        <div id="text-container" class="display-inline-block width-80pc vertical-middle">
            <div id="header-col2" class="display-inline-block width-60pc align-left">
                <a href="<?php site_info('site_url')?>" class="color-inherit">
                    <h1><?php site_info('name')?></h1>
                    <h6><?php site_info('description')?></h6>
                    <h6 class="color3"><?php site_info('motto')?></h6>
                </a>
            </div>
            <div id="header-col3" class="display-inline-block width-35pc align-left color4 text-small">
                <p>
                    LEGAL PRACTITIONERS, ARBITRATORS, CONSTITUTIONAL AND PEOPLES RIGHTS ADVOCATES
                </p>
            </div>
        </div>

        <div class="align-right">
            <label for="toggle-menu" id="toggle-button" class="bg-color4 border2-surround color2 display-mobile-only">Menu</label>
            <input type="checkbox" id="toggle-menu" role="button" class="display-none">
            <div class="header-menu align-left mid-margin-top border-width-2px border-top border-color4">
                <ul class="menu">
                    <li><a href="<?php site_info('site_url')?>">HOME</a></li>
                    <li><a href="<?php site_info('site_url')?>/about">ABOUT US</a></li>
                    <li><a href="<?php site_info('site_url')?>/practice-areas">PRACTICE AREAS</a></li>
                    <li><a href="<?php site_info('site_url')?>/lawyers">LAWYERS</a></li>
                    <!--<li><a href="<?php site_info('site_url')?>/clients">CLIENTELE</a></li>-->
                    <li><a href="<?php site_info('site_url')?>/publications">PUBLICATIONS</a></li>
                    <li><a href="<?php site_info('site_url')?>/category/news">NEWS</a></li>
                    <li><a href="<?php site_info('site_url')?>/contact">CONTACT US</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--/masthead-->
