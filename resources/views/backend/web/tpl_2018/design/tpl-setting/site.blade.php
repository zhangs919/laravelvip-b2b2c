@extends('layouts.design_layout')

@section('header_js')

    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.2"></script>
    <!-- 装修js -->
    <script src="/assets/d2eace91/js/jquery.design.js?v=1.2"></script>
    <!--选色插件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=1.2"/>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/moduleEditTool.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/swiper.min.css?v=1.6"/>
    <script src="/assets/d2eace91/js/design/swiper.jquery.min.js?v=1.6"></script>

@stop

@section('content')

    <!-- 加载图标库 -->
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.6"/>

    <!-- 公共css -->
    <link rel="stylesheet" href="http://{{ config('lrw.frontend_domain') }}/css/common.css?v=1.6"/>

    <link rel="stylesheet" href="http://{{ config('lrw.frontend_domain') }}/css/index.css?v=1.6"/>
    <link rel="stylesheet" href="http://{{ config('lrw.frontend_domain') }}/css/template.css?v=20180702"/>


    <!-- 风格样式 -->
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="http://{{ config('lrw.frontend_domain') }}/css/custom/site-color-style-0.css?v={{ time() }}" id="site_style"/>
    @else
        <link rel="stylesheet" href="http://{{ config('lrw.frontend_domain') }}/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->

    <link rel="stylesheet" href="/assets/d2eace91/css/design/tplsetting.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/design.css?v=1.6"/>



    <!--顶部topbar-->
    <div class="module-topBar">
        <div class="module-topBar-inner">
            <a class="topBar-logo"> <img src="{{ get_image_url(sysconf('backend_logo')) }}" /></a>
            <div class="page-title">
                <label>商城首页装修</label>
                <span></span>
            </div>
            <div class="page-title-nav" style="display: none">
                <span class="top-dropdown-bg"></span>
                <div class="bv-header">
                    <h5>页面管理</h5>
                    <span class="bv-header-close">×</span>
                </div>
                <div class="bv-container">
                    <ul>
                        <!--为选中的li加selected样式-->
                        <li class="selected" data-url="/design/tpl-setting/setup?page=site">
                            <div class="menu-list-item">
                                <i class="page-bgimage"></i>
                                商城首页装修
                                <div class="set-btn">
                                    <span class="arrow">›</span>
                                </div>
                            </div>
                        </li>


                        <li class="" data-url="/design/tpl-setting/setup?page=news">
                            <div class="menu-list-item">
                                <i class="page-bgimage"></i>
                                资讯频道装修
                                <div class="set-btn">
                                    <span class="arrow">›</span>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="topBar-navbar">
                <a class="SZY-SITE-STYLE" href="javascript:void(0);">
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

                    <a href="/design/tpl-setting/setup?page=m_site" class="set-btn" title="微商城装修">
                        <span class="icon se-btn-weixin"></span>
                        <span class="title">微商城装修</span>
                    </a>


                    <a href="/design/tpl-setting/setup?page=app" class="set-btn" title="APP端装修">
                        <span class="icon se-btn-app"></span>
                        <span class="title">APP端装修</span>
                    </a>

                </div>
                <div class="page-operation-btns">
                    <a class="page-btn page-preview-btn" id="show_nav" href="javascript:void(0);"> 隐藏导航 </a>
                    <a class="page-btn page-preview-btn SZY-TPL-BACKUP" href="javascript:void(0);">模板备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-USE" data-id="0" href="javascript:void(0);">使用备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-PREVIEW" href="javascript:void(0);">预览 </a>
                    <a class="page-btn page-preview-btn SZY-TPL-RELEASE" href="javascript:void(0);">发布 </a>
                </div>
                <div class="other-more">
                    <a class="icon pg-hd"><span></span></a>
                    <div class="more-set" style="display: none;">
                        <span class="top-dropdown-bg"></span>
                        <ul>
                            <li>
                                <a class="other-help" target="_blank" href="http://help.laravelvip.com/"><i></i>帮助中心</a>
                            </li>
                            <li>
                                <a class="other-exit"><i></i>退出设计</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--模块内容-->
    <div class="module-main unfold template-one"  style="padding-bottom:100px;">

        <!-- 顶部导航模块_start -->
        <div class="SZY-TPL-HEADER m-t-5">
            <!--页面css/js-->
            <link rel="stylesheet" href="http://{{ config('lrw.frontend_domain') }}/css/index.css?v=1.6"/>
            <script src="http://{{ config('lrw.frontend_domain') }}/js/index.js?v=1.2"></script>
            <script src="http://{{ config('lrw.frontend_domain') }}/js/tabs.js?v=1.2"></script>
            <script src="http://{{ config('lrw.frontend_domain') }}/js/bubbleup.js?v=1.2"></script>
            <script src="http://{{ config('lrw.frontend_domain') }}/js/jquery.hiSlider.js?v=1.2"></script>
            <script src="http://{{ config('lrw.frontend_domain') }}/js/index_tab.js?v=1.2"></script>
            <script src="http://{{ config('lrw.frontend_domain') }}/js/jump.js?v=1.2"></script>
            <script src="http://{{ config('lrw.frontend_domain') }}/js/nav.js?v=1.2"></script>

            <!-- 分类导航设置  _start -->
            <!-- 分类导航设置  _end -->

            <!-- 判断url链接 -->
            <div class="category-box">
                <div class="w1210">
                    <div class="home-category bg-color fl">
                        <a href="javascript:void(0)" class="menu-event" title="查看全部商品分类">
                            <i></i>
                            全部商品分类
                        </a>





                    </div>
                    <div class="all-category fl" id="nav">

                        <a href="javascript:void(0)" class="selector SZY-TPL-SETTING" data-url='/design/navigation/list?nav_page=site&nav_position=2' data-title='商城导航设置' data-tpl='' data-container='.SZY-TPL-HEADER'>
                            <i class="fa fa-edit"></i>
                            编辑商城导航
                        </a>


                        <ul>



                            @foreach($navigation as $v)
                                <li class="@if($v['nav_layout'] == 1) fl @else fr @endif">
                                    <a class="nav " href="javascript:void(0)"  title="{{ $v['nav_name'] }}">{{ $v['nav_name'] }}</a>
                                    <!-- 导航小标签 _start -->

                                    @if(!empty($v['nav_icon']))
                                        <span class="nav-icon">
                                            <img src="{{ get_image_url($v['nav_icon']) }}" />
                                        </span>
                                    @endif

                                <!-- 导航小标签 _end -->
                                </li>
                            @endforeach



                        </ul>
                        <div class="wrap-line">
                            <span style="left: 15px;"></span>
                        </div>
                    </div>


                    <div class="category-layer category-layer2">

                        <a href="javascript:void(0)" class="selector SZY-TPL-SETTING" data-url='/design/nav-category/list?nav_page=site' data-title='分类导航设置' data-tpl='' data-container='.SZY-TPL-HEADER'>
                            <i class="fa fa-edit"></i>
                            编辑分类导航
                        </a>

                        <span class="category-layer-bg"></span>

                        @foreach($nav_category as $item)
                        <div class="list">
                            <dl class="cat">
                                <dt class="cat-name">
                                    <i class="iconfont">{!! $item->nav_icon !!}</i>

                                    @foreach($item->nav_json as $k=>$v)
                                        @if($k > 0) &nbsp; @endif<a href='javascript:void(0)' title='{{ $v->name }}'>{{ $v->name }}</a>
                                    @endforeach

                                </dt>
                                <i class="right-arrow">&gt;</i>

                                @if(count($item->nav_relate_cat_left) > 0)
                                <dd>
                                    @foreach($item->nav_relate_cat_left as $nav_relate_left)
                                    <a href="javascript:void(0)" title="{{ $nav_relate_left->cat_name }}">{{ $nav_relate_left->cat_name }}</a>
                                    @endforeach

                                </dd>
                                @endif

                            </dl>
                            <div class="categorys">
                                <div class="item-left fl">
                                    <!-- 推荐分类 -->

                                    @foreach($item->nav_words as $nav_word)
                                        <div class="item-channels">
                                            <div class="channels">
                                                <a href="javascript:void(0)" title="{{ $nav_word->words_name }}"> {{ $nav_word->words_name }} </a>
                                            </div>
                                        </div>
                                    @endforeach


                                    <div class="subitems">

                                        @foreach($item->nav_relate_cat_right as $v)
                                            <dl class="fore1">
                                                <dt>
                                                    <a  href="{{ route('pc_goods_list', ['filter_str' => $v->cat_id]) }}" target="_blank"  title="{{ $v->cat_name }}">
                                                        <em>{{ $v->cat_name }}</em>
                                                        <i>&gt;</i>
                                                    </a>
                                                </dt>
                                                <dd>

                                                    @if(!empty($v->child))
                                                        @foreach($v->child as $child)
                                                            <a href="{{ route('pc_goods_list', ['filter_str' => $child->cat_id]) }}" target="_blank"  title="{{ $child->cat_name }}">{{ $child->cat_name }}</a>
                                                        @endforeach
                                                    @endif

                                                </dd>
                                            </dl>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="item-right fr">
                                    <!-- 品牌logo -->
                                    <div class="item-brands">
                                        <div class="brands-inner">

                                            @foreach($item->nav_brand as $nav_brand)
                                                <a href="javascript:void(0)" title="{{ $nav_brand->brand_name }}">
                                                    <img src="{{ $nav_brand->brand_logo }}" width="87.5" height="35" />
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- 分类广告图片 -->


                                    <div class="item-promotions">
                                        @foreach($item->nav_ad as $nav_ad)
                                            <a href="javascript:void(0)" class="img-link">
                                                <img src="{{ $nav_ad->ad_image }}" width="180" />
                                            </a>
                                        @endforeach
                                    </div>


                                </div>
                            </div>
                        </div>
                        @endforeach



                    </div>


                    <!-- 带有二级分类的分类导航 _start -->

                    <!-- 带有二级分类的分类导航 _end -->
                </div>
            </div>
            <div class="template-one">

                <!-- banner模块 _start -->
                <div class="banner">

                    <a href="javascript:void(0)" class="selector SZY-TPL-SETTING" data-url='/design/nav-banner/list?nav_page=site' data-title='焦点图设置' data-tpl='' data-container='.SZY-TPL-HEADER'>
                        <i class="fa fa-edit"></i>
                        编辑焦点图
                    </a>

                    <!-- banner轮播 _start -->
                    <ul id="fullScreenSlides" class="full-screen-slides">

                        @foreach($nav_banner as $v)
                            <li style="background: url('{{ get_image_url($v->banner_image) }}') center center no-repeat;  display:list-item; ">
                                <a href="{{ $v->banner_link ?? 'javascript:void(0)'}}"   title="{{ $v->banner_name }}">{{ $v->banner_name ?? '&nbsp;'}}</a>
                            </li>
                        @endforeach

                    </ul>

                    <ul class="full-screen-slides-pagination">

                        @foreach($nav_banner as $k=>$v)
                            <li @if($k == 0) class="current" @endif>
                                <a href="javascript:void(0);">{{ $k }}</a>
                            </li>
                        @endforeach

                    </ul>
                    <!-- banner轮播 _end -->

                    <div class="right-sidebar no-nav-data SZY-TEMPLATE-NAV-CONTAINER">



                    </div>

                    <!-- banner背景图 _start -->
                    <!-- <div class="banner-bg">
                         <a href="" target="_blank" class="banner-bg-img" style="background: url(Array) no-repeat 50% 0;"></a>
                     </div>-->


                    <!-- banner背景图 _end -->
                </div>
                <!-- banner模块 _end -->
            </div>
            <!-- 顶部导航模块_end -->
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
        <div class="helper-icon">
		<span>
			<i class="fa fa-send-o"></i>
			模板助手
		</span>
        </div>
        <div id="helper_tool" class="helper-wrap">
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
            <a class="floatPanel-addNewModule SZY-SITE-TEMPLET"><i></i><span>模板</span></a>
            <a class="floatPanel_setSiteStyle SZY-SITE-STYLE"><i></i><span>样式</span></a>
        </div>
        <div class="floatPanel" style="display: none;">
            <div class="floatPanelNav">
                <ul>


                    <li><a href="javascript:void(0);" data-key='1'>广告模板</a></li>



                    <li><a href="javascript:void(0);" data-key='2'>商品模板</a></li>



                    <li><a href="javascript:void(0);" data-key='3'>通用模板</a></li>





                    <li><a href="javascript:void(0);" data-key='5'>导航模板</a></li>


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

                                <li class="drag" id="0" data-code="ad_suspend">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/ad_suspend.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="悬浮广告">悬浮广告</a>
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

                                <li class="drag" id="0" data-code="market_goods_floor_s3">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s3.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十四">楼层版式十四</a>
                                </li>

                                <li class="drag" id="0" data-code="market_goods_floor_s4">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s4.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十五">楼层版式十五</a>
                                </li>

                                <li class="drag" id="0" data-code="market_goods_floor_s5">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s5.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十六">楼层版式十六</a>
                                </li>

                                <li class="drag" id="0" data-code="market_goods_floor_s6">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s6.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十七">楼层版式十七</a>
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

                                <li class="drag" id="0" data-code="article_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/article_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="文章版式">文章版式</a>
                                </li>

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

                                <li class="drag" id="0" data-code="shop_street">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_street.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="店铺版式一">店铺版式一</a>
                                </li>

                                <li class="drag" id="0" data-code="shop_street_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_street_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="店铺版式二">店铺版式二</a>
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

                            <ul>

                                <li class="nav-drag" id="0" data-code="nav_activity_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/nav_activity_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="活动版式一">活动版式一</a>
                                </li>

                                <li class="nav-drag" id="0" data-code="nav_custom_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/nav_custom_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="自定义模板">自定义模板</a>
                                </li>

                                <li class="nav-drag" id="0" data-code="nav_login">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/nav_login.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="登录版式">登录版式</a>
                                </li>

                                <li class="nav-drag" id="0" data-code="nav_notice_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/nav_notice_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="公告版式一">公告版式一</a>
                                </li>

                                <li class="nav-drag" id="0" data-code="nav_notice_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/nav_notice_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="公告版式二">公告版式二</a>
                                </li>

                                <li class="nav-drag" id="0" data-code="nav_quick_service">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/nav_quick_service.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="快捷服务">快捷服务</a>
                                </li>

                                <li class="nav-drag" id="0" data-code="nav_shop_apply">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/nav_shop_apply.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="入驻模板">入驻模板</a>
                                </li>

                            </ul>

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
    <script src="/assets/d2eace91/js/jquery-ui.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/design/tplsetting.js?v=1.2"></script>

    <script type="text/javascript">
        //初始化数据
        var chk_value =[];
        var data = [];
        var data_m = {};
        var page = "site";
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

                if(value.type == '5')
                {
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

    </script>



    <script type="text/javascript">
        /*********外边js start**********/
        $().ready(function() {
            $("[data-toggle='popover']").popover();
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

            $('body').on('click','.sort-tpls',function(){
                setSortTpls($(this).data('uid'),$(this).data('sort'));
            });

            $('body').on('click','.is-valid-tpls',function(){
                setIsValidTpls($(this).data('uid'));
            });

            $('body').on('click','.del-tpls',function(){
                delTpls($(this).data('uid'));
            });

        });
    </script>


    <script type="text/javascript">
        // 退出设计器
        $("body").on('click', '.other-exit', function() {
            layer.confirm('您确定要退出设计器吗？', {
                btn: ['确定','取消']
            }, function(){
                window.opener=null;
                window.open('','_self');
                window.close();
            }, function(){
            });
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function() {
            $(".panelItemContent ").mCustomScrollbar();
            $(".panel-collapse .panel-body").mCustomScrollbar();
            $(".time-remain").each(function(i) {
                var time = $(this).data("time");
                $(this).countdown({
                    time: time,
                    htmlTemplate: '<span><em class="bg-color">%{d}</em> 天 <em class="bg-color">%{h}</em> 小时 <em class="bg-color">%{m}</em> 分 <em class="bg-color">%{s}</em> 秒</span>',
                    leadingZero: true,
                    onComplete: function(event) {
                        $(this).html("活动已经结束啦!");
                    }
                });
            });
            /*左侧浮动切换*/
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
    </script>

@stop

@section('outside_body_script')

    <script type="text/javascript">
        /*********外边js start**********/
        $().ready(function() {
            $(".colorPicker").colorpicker();
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
                $('#foldSidebar').addClass('styleDesignArrowUp').removeClass('styleDesignArrowDown');
            }
            /*鼠标滑过切换tab*/
            function change_tabs(a, b, c) {
                $(a).click(function() {
                    $(this).addClass(c).siblings().removeClass(c);
                    $(b).eq($(this).data('key')-1).show().siblings().hide();
                })
            }
            change_tabs(".topBar-navbar a", ".quickDress .panel", 'active');
            //切换不同页面装修
            $('.top-set-btn').click(function(){
                if($(this).find('.set-btn-box').hasClass('hide')){
                    $(this).find('.set-btn-box').removeClass('hide');
                }else{
                    $(this).find('.set-btn-box').addClass('hide')
                }
            });
            $(".top-set-btn").mouseleave (function(){
                $(this).find('.set-btn-box').addClass('hide')
            });
        });

    </script>

    <script type="text/javascript">
        $(function(){
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
                    $.designselector(this_obj);
                }, 300);
            });

            $('body').on('click','.SZY-TPL-SETTING',function(){
                var uid = $(this).data('uid');
                var url = $(this).data('url');
                var title = $(this).data('title');
                var tpl = $(this).data('tpl');
                var container = $(this).data('container');
                if($(this).data('modal') && $(this).data('modal') == '1'){
                    $.loading.start();
                    modal = $.modal($(this));
                    if (modal) {
                        modal.show();
                        $.loading.stop();
                    } else {
                        modal = $.modal({
                            title: title,
                            trigger: $(this),
                            ajax: {
                                url: url,
                            },

                        });
                    }
                }else{
                    $.open({
                        type: 2,
                        area: ['1100px', '610px'],
                        //btn: true,
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
                                if(tpl){
                                    ajaxRender(page, tpl, container);
                                }else{
                                    window.location.reload();
                                }
                            }
                        }
                    });
                }
            });

            $('body').on('click','.SZY-THEME-TPL',function(){
                var id = $(this).data("id");
                $.confirm("确定使用此主题模板吗？ 注意：此操作不可恢复！", function() {
                    $.loading.start();
                    $.ajax({
                        url: '/site/tpl-backup',
                        dataType: 'json',
                        data: {
                            action: 'usetpl',
                            id: id,
                            topic_id: topic_id
                        },
                        success: function(result) {
                            $.msg(result.message,{
                                time:2000
                            },function(){
                                window.location.reload();
                            });
                            //refreshTpl(page);
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
                    $.post('set-static',{
                        code: page
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

            //选择页面显示隐藏js
            $('.page-title').click(function() {
                $('.page-title-nav').show();
            });
            $('.bv-header-close').click(function() {
                $('.page-title-nav').hide();
            });
            $('.bv-container li').click(function(){
                $.go($(this).data('url'));
            });

        });
    </script>

@stop
