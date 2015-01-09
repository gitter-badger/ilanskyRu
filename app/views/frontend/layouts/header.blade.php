<!DOCTYPE html>
<html lang="ru" ng-app="ilansky">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <title>
        @if ($__env->yieldContent('title') != '') @yield('title') |  @endif {{ Options::get_option('title') }}
    </title>
    <base href="{{{ route('index') }}}">
    <meta name="keywords" content="{{ Options::get_option('keywords') }}" />
    <meta name="description" content="{{ Options::get_option('description') }}">
    <meta name="author" content="Daniil V. Savenkoff (http://www.savenkoff.com/)">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/ilansky.css" rel="stylesheet" media="screen">
    <!-- Цветовая тема -->
    <link href="theme/css/skins/{{ Options::get_option('skin') }}.css" rel="stylesheet" media="screen" class="skin">
    <!-- Иконки -->
    <link rel="shortcut icon" href="imgs/icons/favicon_{{ Options::get_option('skin') }}.ico">
    <!-- Библиотеки предзагрузки страницы -->
    <script src="libs/modernizr.custom.59262.js"></script>
</head>
<body>
<!-- layout-->
<div id="layout">
    <!-- Header-->
    <header>
        <!-- End headerbox-->
        <div class="headerbox">
            <div class="container">
                <div class="row">
                    <!-- Logo-->
                    <div class="col-md-3 logo">
                        <a href="/" title="{{ Options::get_option('title') }}">
                            <img src="imgs/logos/logo_green.png" alt="{{ Options::get_option('title') }}" class="logo_img">
                        </a>
                    </div>
                    <!-- End Logo-->

                    <!-- Adds Header-->
                    <div class="col-md-9 adds">
                        <a href="/" target="_blank">
                            <img src="imgs/rkl/banner728x90_green.jpg" alt="Размещение рекламы на сайте" class="img-responsive">
                        </a>
                    </div>
                    <!-- End Adds Header-->
                </div>
            </div>
        </div>
        <!-- End headerbox-->
        <!-- Верхнее меню-->
        @include('frontend.layouts.mainmenu')
    </header>
    <!-- End Header-->
