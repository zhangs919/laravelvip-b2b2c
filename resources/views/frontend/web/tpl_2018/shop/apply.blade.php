<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站'}}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站'}}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站'}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/css/common.css"/>
    <link rel="stylesheet" href="/css/apply.css"/>
</head>
<body>
<!--开店流程头部-->
<div class="header">
    <div class="logo-info">
        <a href="{{ route('pc_home') }}" class="logo">
            <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
        </a>
    </div>
    <ul class="header_menu">
        <li class="current">
            <a class="joinin" href="/shop/apply/index.html">
                <i></i>
                商家入驻申请
            </a>
        </li>
        <li>
            <a class="login" href="{{ route('seller_home') }}" target="_blank">
                <i></i>
                商家管理中心
            </a>
        </li>
        <li>
            <a class="faq" href="/help/shop.html" target="_blank">
                <i></i>
                商家帮助指南
            </a>
        </li>
    </ul>
</div>
<div class="header_line">
    <span></span>
</div>
<!--banner-->
<div class="bannerBox">
    <div class="banner-slider">
        <ul class="slider-pannel">

            @foreach($shop_apply_banner_img as $v)
            <li>
                <a href="javascript:void(0);" style="background:url({{ get_image_url($v) }}) center center;"></a>
            </li>
            @endforeach

        </ul>
        <div class="slider-div">
            <ul class="slider-nav">
            </ul>
        </div>

        <span class="arrow-left"></span>
        <span class="arrow-right"></span>
        <p class="join-button">

            <a class="btn btn-primary btn-larger" href="/shop/apply/agreement.html">立即入驻</a>

        </p>
    </div>
</div>

<!--问题帮助及信息公告-->
<div class="index-center">
    <div class="wrapper">



        @foreach($pc_shop_guest_list_asc as $v)
        <div class="info-box">
            <div class="title">
                <p>{{ $v['title'] }}</p>
                <div class="title-sub">{{ \Illuminate\Support\Str::substr($v['summary'],0,15) }}</div>
            </div>
            <a class="btn btn-primary btn-larger" href="/article/{{ $v['article_id'] }}.html" target="_blank">查询</a>
        </div>
        @endforeach








        <div class="info-box">
            <div class="title">
                <p>我的入驻进度？</p>
                <div class="title-sub">欢迎入驻本商城，了解我的入驻进度</div>
            </div>
            <a class="btn btn-primary btn-larger" href="/shop/apply/progress.html">查看入驻进度</a>
            <!--查看入驻进度按钮已转移到banner上面显示-->
        </div>
        <div class="info-box info-list">
            <div class="title">
                <h2>信息公告</h2>
            </div>
            <div class="mess-list">
                <ul>


                    @foreach($info_notice_list as $v)
                    <li>
                        <a href="/article/{{ $v['article_id'] }}.html" target="_blank">{{ $v['title'] }}</a>
                    </li>
                    @endforeach


                </ul>
            </div>
        </div>
    </div>
</div>
<div class="main">
    <div class="w1210">
        <!--入驻流程-->
        <p class="index-title">入驻流程</p>
        <div class="joinin-index-step">
				<span class="step one">
					<i></i>
					签署入驻协议
				</span>
            <span class="arrow"></span>
            <span class="step two">
					<i></i>
					商家信息提交
				</span>
            <span class="arrow"></span>
            <span class="step three">
					<i></i>
					平台审核资质
				</span>
            <span class="arrow"></span>
            <span class="step four">
					<i></i>
					商家缴纳费用
				</span>
            <span class="arrow"></span>
            <span class="step five">
					<i></i>
					店铺开通
				</span>
        </div>
        <!--入驻指南-->
    </div>
</div>
<div class="w1210 clearfix">


    @foreach($pc_shop_guest_list_desc as $v)
    <div class="main-box">
        <img src="{{ $v['article_thumb'] }}">
        <div class="info-content">
            <div class="sui-titlex">
                <div class="sui-title-info">{{ $v['title'] }}</div>
            </div>
            <p>{{ \Illuminate\Support\Str::substr($v['summary'],0,55) }}</p>
            <div class="sui-title-more">
                <a href="/article/{{ $v['article_id'] }}.html" target="_blank">查看详情 &gt;</a>
            </div>
        </div>
    </div>
    @endforeach


</div>
<!--底部信息-->

{{-- include short_footer --}}
@include('layouts.partials.short_footer')


<script src="/js/jquery-1.9.1.min.js?v=20180428"></script>
<script src="/js/jquery.superslide.2.1.1.js?v=20180428"></script>
<script src="/js/common.js?v=20180428"></script>
<script src="/js/apply_index.js?v=20180428"></script>
</body>
</html>
