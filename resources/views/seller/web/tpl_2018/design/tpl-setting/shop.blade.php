@extends('layouts.design_layout')

@section('header_css')
    <link href="//{{ config('lrw.frontend_domain') }}/css/common.css?v=20201012" rel="stylesheet">
    <link href="//{{ config('lrw.frontend_domain') }}/css/shop_index.css?v=20201012" rel="stylesheet">
    <link href="//{{ config('lrw.frontend_domain') }}/css/template.css?v=20201012" rel="stylesheet">
    <link href="/assets/d2eace91/css/design/tplsetting.css?v=20201012" rel="stylesheet">
    <link href="/assets/d2eace91/css/design/design.css?v=20201012" rel="stylesheet">
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="//{{ config('lrw.frontend_domain') }}/css/custom/site-color-style-0.css?v=2" id="site_style"/>
    @else
        <link rel="stylesheet" href="//{{ config('lrw.frontend_domain') }}/css/color-style.css?v=2" id="site_style"/>
    @endif
    <link href="/assets/d2eace91/js/colour/css/spectrum.css?v=20201012" rel="stylesheet">
    <link href="/assets/d2eace91/js/chosen/chosen.css?v=20201012" rel="stylesheet">

{{--    <link href="http://{{ config('lrw.frontend_domain') }}/css/common.css" rel="stylesheet">--}}
{{--    <link href="http://{{ config('lrw.frontend_domain') }}/css/shop_index.css" rel="stylesheet">--}}
{{--    <link href="http://{{ config('lrw.frontend_domain') }}/css/template.css?v=1" rel="stylesheet">--}}
{{--    <link href="/assets/d2eace91/css/design/tplsetting.css" rel="stylesheet">--}}
{{--    <link href="/assets/d2eace91/css/design/design.css" rel="stylesheet">--}}
{{--    <link href="http://{{ config('lrw.frontend_domain') }}/css/color-style.css?v=1" rel="stylesheet">--}}

@stop

@section('content')

    <!--页面css/js-->
    <!-- 公共css -->
    <!-- 装修js -->
    <!-- 装修css -->
    <!--整站改色 _start-->
    <!--整站改色 _end-->
    <!--顶部topbar-->
    <div class="module-topBar">
        <div class="module-topBar-inner">
            <a class="topBar-logo">
                <img src="{{ get_image_url(sysconf('seller_center_logo')) }}" />
            </a>
            <div class="topBar-navbar hide">
                <a class="SZY-SHOP-STYLE" href="javascript:void(0);" data-group="shop_style">
                    <div class="topBar-button">
                        <span class="title">自定义风格</span>
                    </div>
                </a>
            </div>
            <div class="topBar-navbar">
                <a class="SZY-WEB-STATIC @if(!$webStatic){{ 'active' }}@endif" href="javascript:void(0);" data-value="{{ $webStatic }}">
                    <div class="topBar-button">
                        <span class="title">@if($webStatic){{ '关闭静态页面' }}@else{{ '开启静态页面' }}@endif</span>
                    </div>
                </a>
            </div>
            <div class="topBar-navbar-r">
                <div class="top-set-btn displayMode">
                    <a class="set-btn active" href="javascript:void(0);" title="电脑端装修">
                        <span class="icon se-btn-pc"></span>
                        <span class="title">电脑端装修</span>
                    </a>
                    <a href="/design/tpl-setting/setup?page=m_shop" class="set-btn" title="微商城装修">
                        <span class="icon se-btn-weixin"></span>
                        <span class="title">微商城装修</span>
                    </a>
                    <a href="/design/tpl-setting/setup?page=app_shop" class="set-btn" title="APP端装修">
                        <span class="icon se-btn-app"></span>
                        <span class="title">APP端装修</span>
                    </a>
                </div>
                <div class="page-operation-btns">
                    <a class="page-btn page-preview-btn" id="show_nav" href="javascript:void(0);">隐藏导航</a>
                    <a class="page-btn page-preview-btn SZY-TPL-BACKUP" href="javascript:void(0);">模板备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-USE" data-id="{{ $shop_info['shop']['shop_id'] }}" href="javascript:void(0);">使用备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-PREVIEW" href="javascript:void(0);">预览 </a>
                    <a class="page-btn page-preview-btn SZY-TPL-RELEASE" href="javascript:void(0);"> 发布 </a>
                </div>
                <div class="other-more">
                    <a class="icon pg-hd">
                        <span></span>
                    </a>
                    <div class="more-set" style="display: none;">
                        <span class="top-dropdown-bg"></span>
                        <ul>
                            <li>
                                <a class="other-help" target="_blank" href="http://help.laravelvip.com/">
                                    <i></i>
                                    帮助中心
                                </a>
                            </li>
                            <li>
                                <a class="other-exit">
                                    <i></i>
                                    退出设计
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--模块内容-->
    <div class="module-main unfold template-one" style="padding-bottom: 100px;">
        <!-- 顶部导航模块_start -->
        <div class="SZY-TPL-HEADER">
            <!-- 引入头部 -->
            <!-- 引入头部文件 -->
            {{--店铺头部--}}
            @include('frontend.web.tpl_2018.layouts.partials.shop_header')

        </div>
        <!-- 数据模块 -->
        <div class="SZY-TEMPLATE-MAIN-CONTAINER dropzone"></div>
        <!--鼠标放在页面显示的存放位置样式-->
        <div class="position-box" style="display: none">
            <span class="text-c">放在这里</span>
        </div>
    </div>
    <!-- 右侧浮动内容 Begin -->
    <div class="helper-fixed">
        <div class="helper-icon" style="right: -40px;">
        <span>
            <i class="fa fa-send-o"></i>
            模板助手
        </span>
        </div>
        <div id="helper_tool" class="helper-wrap" style="right: 0px;">
            <div class="help-header">
                模板助手
                <i class="fa fa-times-circle"></i>
            </div>
            <div class="panel-group" id="accordion">
                <div id="helper_tool_nav" class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                模板导航（
                                <em class="count">0</em>
                                ）
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <ul class="list">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 右侧浮动内容 End -->
    <!--左侧模板展示浮动-->
    <div class="panelIconContainer">
        <div class="floatPanelIconBox ">
            <a class="floatPanel-addNewModule SZY-SITE-TEMPLET">
                <i></i>
                <span>模板</span>
            </a>
            <a class="floatPanel_setSiteStyle SZY-SHOP-STYLE" data-group="shop_style">
                <i></i>
                <span>样式</span>
            </a>
        </div>
        <div class="floatPanel" style="display: none;">
            <div class="floatPanelNav">
                <ul>
                    <li>
                        <a href="javascript:void(0);" data-key='1'>广告模板</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-key='2'>商品模板</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-key='3'>通用模板</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-key='8'>营销模板</a>
                    </li>
                </ul>
            </div>
            <div class="panelContentContainer">
                <div class="panelItem-box panelItem-box1">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">
                            <ul>
                                <li class="drag" id="0" data-code="ad_one_column">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/ad_one_column.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="一栏广告">一栏广告</a>
                                </li>
                                <li class="drag" id="0" data-code="hots_pot">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/hots_pot.png" class="mCS_img_loaded">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="热区模板">热区模板</a>
                                </li>
                                <li class="drag" id="0" data-code="ad_five_column">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/ad_five_column.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="五栏广告">五栏广告</a>
                                </li>
                                <li class="drag" id="0" data-code="ad_six_column">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/ad_six_column.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="六栏广告">六栏广告</a>
                                </li>
                                <li class="drag" id="0" data-code="ad_groups">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/ad_groups.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="广告组">广告组</a>
                                </li>
                                <li class="drag" id="0" data-code="shop_floor_ad1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_ad1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="2-2栏广告">2-2栏广告</a>
                                </li>
                                <li class="drag" id="0" data-code="shop_floor_ad2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_ad2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="分层广告">分层广告</a>
                                </li>
                                <li class="drag" id="0" data-code="shop_floor_category_ad1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_category_ad1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="七栏广告">七栏广告</a>
                                </li>
                                <li class="drag" id="0" data-code="shop_floor_category_ad2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_category_ad2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="1-7栏广告">1-7栏广告</a>
                                </li>
                                <li class="drag" id="0" data-code="shop_focus">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_focus.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="广告轮播图">广告轮播图</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panelItem-box panelItem-box2">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">
                            <ul>
                                <li class="drag" id="0" data-code="goods_floor">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式一">楼层版式一</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_floor_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式二">楼层版式二</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_floor_s3">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s3.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式三">楼层版式三</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_floor_s4">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s4.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式四">楼层版式四</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_floor_s5">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s5.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式五">楼层版式五</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_floor_s6">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s6.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式六">楼层版式六</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_floor_s7">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s7.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式七">楼层版式七</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_floor_s8">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s8.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式八">楼层版式八</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_floor_s9">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s9.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式九">楼层版式九</a>
                                </li>
                                <li class="drag" id="0" data-code="shop_floor_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十">楼层版式十</a>
                                </li>
                                <li class="drag" id="0" data-code="shop_floor_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十一">楼层版式十一</a>
                                </li>
                                <li class="drag" id="0" data-code="market_goods_floor_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十二">楼层版式十二</a>
                                </li>
                                <li class="drag" id="0" data-code="market_goods_floor_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十三">楼层版式十三</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_promotion">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_promotion.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="促销版式一">促销版式一</a>
                                </li>
                                <li class="drag" id="0" data-code="goods_promotion_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_promotion_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="促销版式二">促销版式二</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panelItem-box panelItem-box3">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">
                            <ul>
                                <li class="drag" id="0" data-code="brand_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/brand_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="品牌版式一">品牌版式一</a>
                                </li>
                                <li class="drag" id="0" data-code="custom_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/custom_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="自定义模板">自定义模板</a>
                                </li>
                                <li class="drag" id="0" data-code="lc_title_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/lc_title_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="标题版式一">标题版式一</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panelItem-box panelItem-box4">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">
                        </div>
                    </div>
                </div>
                <div class="panelItem-box panelItem-box5">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">
                        </div>
                    </div>
                </div>
                <div class="panelItem-box panelItem-box6">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">
                        </div>
                    </div>
                </div>
                <div class="panelItem-box panelItem-box7">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">
                        </div>
                    </div>
                </div>
                <div class="panelItem-box panelItem-box8">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">
                            <ul>
                                <li class="drag" id="0" data-code="bonus_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/bonus_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="红包版式一">红包版式一</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .modal-body {
            padding: 15px;
        }
        .modal-body .btn.btn-primary {
            line-height: 20px;
        }
        .modal-body .simple-form-field .btn {
            line-height: 16px !important;
        }
        .modal-body .btn.btn-sm {
            padding: 2px 9px !important;
        }
        .modal-body .choose-goods-list .btn.btn-xs {
            padding: 1px 4px !important;
            font-size: 11px !important;
        }
    </style>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        // {jsBlock}
        // 退出设计器
        $("body").on('click', '.other-exit', function() {
            layer.confirm('您确定要退出设计器吗？', {
                btn: ['确定','取消']
            }, function(){
                window.opener=null;
                window.open('','_self');
                window.close();
            }, function(){
                //
            });
        });
        // {/jsBlock}
    </script>
    <script type="text/javascript">
        // {jsBlock}
        $(document).ready(function() {
            $(".panelItemContent ").mCustomScrollbar();
            $(".bv-container").mCustomScrollbar();
            /*鼠标滑过切换tab*/
            function change_tabs(a,b,c){
                $(a).click(function(){
                    var k = $(this).find('a').data('key');
                    var name = $(this).find('a').text();
                    $(this).addClass(c).siblings().removeClass(c);
                    var d = b+k;
                    $(b).hide();
                    $(d).find('h3').text(name);
                    $(d).show();
                });
            }
            change_tabs(".floatPanelNav li",".panelContentContainer .panelItem-box",'active');
            $('.floatPanelNav li').eq(0).click();
        });
        $('body').on('click','.SZY-SITE-TEMPLET',function() {
            $(".floatPanel").show();
            $(".floatPanelIconBox").hide();
        });
        $('body').on('click','.closeFunPanel',function() {
            $(".floatPanelIconBox").show();
            $(".floatPanel").hide();
        });
        $(".other-more").click(function() {
            $(".more-set").slideToggle(100);
        }).mouseleave(function() {
            $(".more-set").hide();
        });
        // {/jsBlock}
    </script>




@stop

@section('footer_script')
    <script type="text/javascript">
        //
    </script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/min/js/scrollBar.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/min/js/core.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/min/js/app.common.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/common.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/jquery.design.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/design/TouchSlide.1.1.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/design/shop_index.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/design/bubbleup.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/design/index_tab.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/design/jump.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/design/common.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/design/tplsetting.js?v=20201016"></script>
    <script src="//{{ config('lrw.frontend_domain') }}/js/app.frontend.index.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20201016"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/colour/js/spectrum.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/colour/js/docs.js?v=20201016"></script>
    <script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=20201016"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/jquery.base64.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=20201016"></script>
    <script>
        function search_all() {
            document.getElementById('search-form').action = "{{ route('pc_global_search') }}";
            document.getElementById("search-form").submit();
        }
        function search_me() {
            document.getElementById('search-form').action = "{{ route('pc_shop_search', ['shop_id' => $shop_info['shop']['shop_id']]) }}";
            document.getElementById("search-form").submit();
        }
        function toggleShop(shop_id, obj) {
            $.collect.toggleShop(shop_id, function(result) {
                if (result.code == 0) {
                    $(".collect-count").html(result.collect_count);
                    $(obj).parent().toggleClass("fav-shop-box-select");
                    if ($(obj).html() == "关注本店") {
                        $(obj).html("取消关注");
                        $(".collect-tip").html("已关注");
                    } else {
                        $(obj).html("关注本店");
                        $(".collect-tip").html("关注");
                    }
                    if(result.show_collect_count == 1 && result.collect_count > 0){
                        $(".collect-tip").show();
                        $(".collect-count").show();
                    }else{
                        $(".collect-tip").hide();
                        $(".collect-count").hide();
                    }
                }
            }, true);
        }
        //
        //初始化数据
        var chk_value =[];
        var data = [];
        var data_m = {};
        var page = "shop";
        var NAV_CAT_TPL = "5";
        //加载数据
        $(function(){
            $.loading.start();
            $.each({!! $jsonData !!}, function(index, value) {
                var $el = $(value.file);
                var is_valid_class = '';
                var is_eye_valid_class = '';
                if(value.is_valid>0){
                    is_valid_class = 'fa fa-check-circle-o';
                    is_eye_valid_class = 'hide-btn';
                }else{
                    is_valid_class = 'fa fa-times-circle-o';
                    is_eye_valid_class = 'show-btn';
                }
                if(value.type == '5'){
                    var $handle = $('<div class="operateEdit"></div>');
                    $handle.append($('<a class="decor-btn sort-tpls upMove-btn"  data-uid="'+value.uid+'"  data-sort="up"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>'));
                    $handle.append($('<a class="decor-btn sort-tpls downMove-btn" data-uid="'+value.uid+'" data-sort="down"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>'));
                    $handle.append($('<a class="decor-btn is-valid-tpls hide-btn"  data-uid="'+value.uid+'"><div class="selector-box"><div class="arrow"></div><i class="'+is_valid_class+'"></i>隐藏</div></a>'));
                    $handle.append($('<a class="decor-btn del-tpls deletes-btn"  data-uid="'+value.uid+'"><div class="selector-box"><div class="arrow"></div><i class="fa fa-trash-o"></i>删除</div></a>'));
                    $el.append($handle);
                    $(".SZY-TEMPLATE-NAV-CONTAINER").append($el);
                }else{
                    var $handle = $('<div class="operateEdit"></div>');
                    $handle.append($('<a class="decor-btn upMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>').click(function () { setSortTpls(value.uid,'up'); }));
                    $handle.append($('<a class="decor-btn downMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>').click(function () { setSortTpls(value.uid,'down'); }));
                    $handle.append($('<a class="decor-btn '+is_eye_valid_class+'"><div class="selector-box"><div class="arrow"></div><i class="'+is_valid_class+'"></i>'+value.format_is_valid+'</div></a>').click(function () { setIsValidTpls(value.uid); }));
                    $handle.append($('<a class="decor-btn deletes-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-trash-o"></i>删除</div></a>').click(function () { delTpls(value.uid); }));
                    $el.append($handle);
                    $('.SZY-TEMPLATE-MAIN-CONTAINER').append($el);
                }
            });
            $.loading.stop();
            getHelper();
            //图片缓载
            $.imgloading.loading();
        });
        //
        /*********外边js start**********/
        $().ready(function() {
            $(".colorPicker").colorpicker();
            $(".panel-collapse .panel-body").mCustomScrollbar();
        });
        // 顶部导航展示形式切换
        $('#foldSidebar').click(function() {
            if ($('.module-main').hasClass('unfold')) {
                $('.module-main').addClass('fold').removeClass('unfold');
                $('.quickDress').removeClass('hide');
                $('#foldSidebar').addClass('styleDesignArrowUp').removeClass('styleDesignArrowDown');
            } else {
                $('.module-main').addClass('unfold').removeClass('fold');
                $('.quickDress').addClass('hide');
                $('#foldSidebar').addClass('styleDesignArrowDown').removeClass('styleDesignArrowUp');
            }
        });
        $('.topBar-navbar a').click(function() {
            $('.module-main').addClass('fold').removeClass('unfold');
            $('.quickDress').removeClass('hide');
            $('#foldSidebar').addClass('styleDesignArrowUp').removeClass('styleDesignArrowDown');
        });
        //隐藏下拉导航
        function hiddenNavbar(){
            $('.module-main').addClass('unfold').removeClass('fold');
            $('.quickDress').addClass('hide');
            $('#foldSidebar').addClass('styleDesignArrowDown').removeClass('styleDesignArrowUp');
        }
        $("#show_nav").click(function(){
            var $nav = $(".SZY-TPL-HEADER");
            if($nav.css('display')=='none'){
                $nav.slideDown();
                $(this).text('隐藏导航');
            }else{
                $nav.slideUp();
                $(this).text('显示导航');
            }
        });
        //
        $(function(){
            updateEndTime();
        });
        //倒计时函数
        function updateEndTime(){
            var date = new Date();
            var time = date.getTime() + 8*60*60*1000;
            $(".time-remain").each(function(i){
                var endDate =this.getAttribute("end_time"); //结束时间字符串
                //转换为时间日期类型
                var endTime  = new Date(endDate).getTime()
                var lag = (endTime - time) / 1000; //当前时间和结束时间之间的秒数
                if(lag > 0){
                    var second = Math.floor(lag % 60);
                    var minite = Math.floor((lag / 60) % 60);
                    var hour = Math.floor((lag / 3600) % 24);
                    var day = Math.floor((lag / 3600) / 24);
                    $(this).find('span').find("#d").html(day);
                    $(this).find('span').find("#h").html(hour);
                    $(this).find('span').find("#m").html(minite);
                    $(this).find('span').find("#s").html(second);
                }
                else
                    $(this).find('span').html("活动已经结束啦！");
            });
            setTimeout("updateEndTime()",1000);
        }
        //
        $().ready(function() {
        })
        //
        $(function(){
            $('.top-set-btn').click(function(){
                if($(this).find('.set-btn-box').hasClass('hide')){
                    $(this).find('.set-btn-box').removeClass('hide');
                }else{
                    $(this).find('.set-btn-box').addClass('hide')
                }
            });
            $('body').on('click','.SZY-TPL-SELECTOR',function(){
                try{
                    if(hiddenNavbar&&typeof(hiddenNavbar)=="function"){
                        hiddenNavbar();
                    }
                }catch(e){
                }
                var this_obj = $(this);
                delay_till_last(this_obj.uid, function() {
                    //构造数据
                    $.designselector(this_obj,function(layero){
                        var wh = $(window).height() - 120;
                        $(layero).find('.layui-layer-content').css('max-height', wh);
                        $(layero).find('.layui-layer-content').addClass('custom-layer-content');
                    });
                }, 300);
            });
            $('body').on('click','.SZY-TPL-SETTING',function(){
                var uid = $(this).data('uid');
                var url = $(this).data('url');
                var title = $(this).data('title');
                var tpl = $(this).data('tpl');
                var container = $(this).data('container');
                $.open({
                    type: 2,
                    area: ['1120px', '610px'],
                    btn: true,
                    fix: true,
                    maxmin: true,
                    title: title,
                    content: url,
                    end: function(result) {
                        if(uid != undefined){
                            refreshTpl(page, uid);
                        }else{
                            //window.location.reload();
                            //刷新
                            ajaxRender(page, tpl, container);
                        }
                    }
                });
            });
            $('body').on('click','.SZY-SET-HEAD',function(){
                var url = $(this).data('url');
                var title = $(this).data('title');
                var tpl = $(this).data('tpl');
                $.get(url,{ is_layer:1 },function(result){
                    if(result.code == 0){
                        $.open({
                            type: 1,
                            area: ['800px', '550px'],
                            btn: true,
                            btn: ['确认','取消'],
                            btnAlign: 'c',
                            fix: true,
                            maxmin: true,
                            title: title,
                            content: result.data,
                            yes:function(index, layero){
                                layero.find('#btn_submit').trigger("click");
                            }
                        });
                    }else{
                        $.msg(result.message);
                    }
                },'json');
            });
            $('body').on('click','.SZY-THEME-TPL',function(){
                var id = $(this).data("id");
                var img = $(this).data('img');
                var is_current = $(this).hasClass('current');
                var msg = '确定使用此主题模板吗？ 注意：此操作不可恢复！';
                if(is_current){
                    msg = '确定取消此主题模板吗？ 注意：此操作不可恢复！';
                }
                $.confirm(msg, function() {
                    $.loading.start();
                    $.ajax({
                        url: '/site/tpl-backup',
                        dataType: 'json',
                        data: {
                            action: 'usetpl',
                            id: id,
                            topic_id: topic_id,
                            page: page
                        },
                        success: function(result) {
                            $.msg(result.message,{
                                time:2000
                            },function(){
                                window.location.reload();
                            });
                        }
                    });
                });
            });
            $('body').on('click','.SZY-WEB-STATIC',function(){
                var target = $(this);
                var value = $(target).data('value');
                var text = '';
                if(value == 1){
                    text = '关闭静态页面？';
                }else{
                    text = '开启静态页面？';
                }
                $.confirm("确定"+text, function() {
                    $.post('set-static.html',{
                        code: page,
                        topic_id: topic_id
                    },function(result){
                        $.msg(result.message);
                        $(target).data('value' ,result.data);
                        if(result.data == 1){
                            $(target).find('.title').html('关闭静态页面');
                        }else{
                            $(target).find('.title').html('开启静态页面');
                        }
                    },'json');
                });
            });
        });
        //
    </script>

@stop
