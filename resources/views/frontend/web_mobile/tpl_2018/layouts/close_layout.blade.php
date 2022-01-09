<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>水果</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="wap-font-scale" content="no" />
    <meta name="Keywords" content="{{ sysconf('site_name') }}" />
    <meta name="Description" content="{{ sysconf('site_name') }}" />
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="@if(sysconf('is_webp')){{ 'yes' }}@else{{ 'no' }}@endif" />
    <!-- #is_wabp_end -->
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!--公用css-->
    <link rel="stylesheet" href="/mobile/css/common.css?v=2018112301"/>
    <link rel="stylesheet" href="/mobile/css/upgrade.css?v=2018112301"/>

</head>
<body style="background: #fff;">


<div class="mobile-close">
    <img src="@if(!empty(sysconf('m_site_close_image'))) {{ get_image_url(sysconf('m_site_close_image')) }} @else /mobile/images/mobile_close.gif @endif">

</div>
<!---->
</body>
</html>