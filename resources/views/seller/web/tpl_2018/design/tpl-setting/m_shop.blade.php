@extends('layouts.design_layout')

@section('header_css')
    <link href="/assets/d2eace91/css/design/mobile/design.css?v=12" rel="stylesheet">
    <link href="/assets/d2eace91/css/design/mobile/tplsetting.css?v=20201012" rel="stylesheet">
    <link href="/assets/d2eace91/css/design/mobile/public.css?v=202010122" rel="stylesheet">
    <link href="//{{ config('lrw.mobile_domain') }}/css/dianpu.css?v=20201012" rel="stylesheet">
    <link href="//{{ config('lrw.mobile_domain') }}/css/template.css?v=2.1" rel="stylesheet">
    <link href="//{{ config('lrw.mobile_domain') }}/css/shop_header.css?v=20201012" rel="stylesheet">
    <link href="//{{ config('lrw.mobile_domain') }}/css/iconfont/iconfont.css?v=202010121" rel="stylesheet">
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="//{{ config('lrw.mobile_domain') }}/css/custom/m_site-color-style-0.css?v=2" id="site_style"/>
    @else
        <link rel="stylesheet" href="//{{ config('lrw.mobile_domain') }}/css/color-style.css?v=2" id="site_style"/>
    @endif
    <link href="/assets/d2eace91/js/colour/css/spectrum.css?v=20201012" rel="stylesheet">
    <link href="/assets/d2eace91/js/chosen/chosen.css?v=20201012" rel="stylesheet">
@stop

@section('content')

    <!-- 装修js -->
    <!--前台css-->
    <!--整站改色 _start-->
    <!--整站改色 _end-->
    <!--顶部topbar-->
    <div class="module-topBar">
        <div class="module-topBar-inner">
            <a class="topBar-logo">
                <img src="{{ get_image_url(sysconf('seller_center_logo')) }}" />
            </a>
            <div class="topBar-navbar">
                <a class="SZY-SHOP-STYLE" href="javascript:void(0);" data-group="m_shop_style">
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
                    <a href="/design/tpl-setting/setup?page=shop" class="set-btn" title="电脑端装修">
                        <span class="icon se-btn-pc"></span>
                        电脑端装修
                    </a>
                    <a href="javascript:void(0)" class="set-btn active" title="微商城装修">
                        <span class="icon se-btn-weixin"></span>
                        微商城装修
                    </a>
                    <a href="/design/tpl-setting/setup?page=app_shop" class="set-btn" title="APP端装修">
                        <span class="icon se-btn-app"></span>
                        APP端装修
                    </a>
                </div>
                <div class="page-operation-btns">
                    <a class="page-btn page-preview-btn SZY-TPL-BACKUP" href="javascript:void(0);">模板备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-USE" data-id="{{ $shop_info['shop']['shop_id'] }}" href="javascript:void(0);">使用备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-PREVIEW" href="javascript:void(0);">预览 </a>
                    <a class="page-btn page-preview-btn SZY-TPL-RELEASE" href="javascript:void(0);">发布 </a>
                </div>
                <div class="other-more">
                    <a class="icon pg-hd">
                        <span></span>
                    </a>
                    <div class="more-set" style="display: none;">
                        <span class="top-dropdown-bg"></span>
                        <ul>
                            <li>
                                <a class="other-help" target="_blank" href="#">
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
    <div class="mobile_design_container">
        <!--左侧start-->
        <div class="mobile_design_left">
            <div class="panelMenuContainer">模块列表</div>
            <div class="panelContentContainer">
                <div class="panelItemContainer" id="panelItme1">
                    <fieldset class="panelItemBox">
                        <legend>广告模板</legend>
                        <ul class="panelModuleIconContainer">
                            <li class="drag" id="0" data-code="m_banner" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_banner.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="轮播广告">轮播广告</a>
                            </li>
                            <li class="drag" id="0" data-code="m_hots_pot" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_hots_pot.png" class="mCS_img_loaded">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="热区模板">热区模板</a>
                            </li>
                            <li class="drag" id="0" data-code="m_ad_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="广告版式一">广告版式一</a>
                            </li>
                            <li class="drag" id="0" data-code="m_ad_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="广告版式二">广告版式二</a>
                            </li>
                            <li class="drag" id="0" data-code="m_ad_s3" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s3.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="广告版式三">广告版式三</a>
                            </li>
                            <li class="drag" id="0" data-code="m_ad_s4" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s4.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="广告版式四">广告版式四</a>
                            </li>
                        </ul>
                    </fieldset>
                </div>
                <div class="panelItemContainer" id="panelItme2">
                    <fieldset class="panelItemBox">
                        <legend>商品模板</legend>
                        <ul class="panelModuleIconContainer">
                            <li class="drag" id="0" data-code="m_goods_floor_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_floor_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="楼层版式一">楼层版式一</a>
                            </li>
                            <li class="drag" id="0" data-code="m_goods_floor_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_floor_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="楼层版式二">楼层版式二</a>
                            </li>
                            <li class="drag" id="0" data-code="m_goods_promotion" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_promotion.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="楼层版式三">楼层版式三</a>
                            </li>
                        </ul>
                    </fieldset>
                </div>
                <div class="panelItemContainer" id="panelItme3">
                    <fieldset class="panelItemBox">
                        <legend>通用模板</legend>
                        <ul class="panelModuleIconContainer">
                            <li class="drag" id="0" data-code="m_goods_title_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_title_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="标题版式一">标题版式一</a>
                            </li>
                            <li class="drag" id="0" data-code="m_ad_title_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_title_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="标题版式二">标题版式二</a>
                            </li>
                            <li class="drag" id="0" data-code="m_ad_title_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_title_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="标题版式三">标题版式三</a>
                            </li>
                            <li class="drag" id="0" data-code="m_nav_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_nav_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="导航版式一">导航版式一</a>
                            </li>
                            <li class="drag" id="0" data-code="m_nav_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_nav_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="导航版式二">导航版式二</a>
                            </li>
                            <li class="drag" id="0" data-code="m_blank_line" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_blank_line.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="空白分割条">空白分割条</a>
                            </li>
                            <li class="drag" id="0" data-code="m_custom_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_custom_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="自定义模板">自定义模板</a>
                            </li>
                            <li class="drag" id="0" data-code="m_tab_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_tab_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="选项卡模板">选项卡模板</a>
                            </li>
                            <li class="drag" id="0" data-code="m_video" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_video.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="视频模板">视频模板</a>
                            </li>
                        </ul>
                    </fieldset>
                </div>
                <div class="panelItemContainer" id="panelItme4">
                    <fieldset class="panelItemBox">
                        <legend>分页模板</legend>
                        <ul class="panelModuleIconContainer">
                            <li class="drag" id="0" data-code="m_goods_list" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_list.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="滚动商品">滚动商品</a>
                            </li>
                        </ul>
                    </fieldset>
                </div>
                <div class="panelItemContainer" id="panelItme6">
                    <fieldset class="panelItemBox">
                        <legend>资讯模板</legend>
                        <ul class="panelModuleIconContainer">
                            <li class="drag" id="0" data-code="m_news_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_news_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="资讯版式一">资讯版式一</a>
                            </li>
                            <li class="drag" id="0" data-code="m_news_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_news_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="资讯版式二">资讯版式二</a>
                            </li>
                        </ul>
                    </fieldset>
                </div>
                <div class="panelItemContainer" id="panelItme8">
                    <fieldset class="panelItemBox">
                        <legend>营销模板</legend>
                        <ul class="panelModuleIconContainer">
                            <li class="drag" id="0" data-code="m_activity_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_activity_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="团购活动">团购活动</a>
                            </li>
                            <li class="drag" id="0" data-code="m_activity_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_activity_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="拼团活动">拼团活动</a>
                            </li>
                            <li class="drag" id="0" data-code="m_bonus_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_bonus_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="红包版式一">红包版式一</a>
                            </li>
                        </ul>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="leftSide">
            <div class="leftSideCenter">模块列表</div>
        </div>
        <!--左侧end-->
        <!--右侧start-->
        <div class="mobile_design_center">
            <div class="mobile_list">
                <div class="special-top"></div>
                <div class="special-item">
                    <!-- 引用头文件 -->
                    <div class="SZY-SHOP-HEADER">
                        <a href="javascript:void(0)" class="SZY-SET-HEAD shop-header-selector content-selector" title="编辑" data-url='/shop/config/index.html?group=m_shop_header' data-title='店铺头部设置'></a>

                        {{--引入店铺头部--}}
                        @include('frontend.web_mobile.tpl_2018.shop.partials._shop_top_box')

                        <div class="shop-nav clearfix">
                            <ul class="nav-ul">
                                <li class="current">
                                    <a href="javascript:void(0)">
                                        <i class="iconfont">&#xe601;</i>
                                        <span>店铺首页</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="javascript:void(0)">
                                        <i class="SZY-SHOP-GOODS-COUNT">0</i>
                                        <span>全部商品</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="javascript:void(0)">
                                        <i class="SZY-SHOP-BONUS-COUNT">0</i>
                                        <span>店铺红包</span>
                                    </a>
                                </li>
                            </ul>
                        </div></div>
                    <div class="SZY-TEMPLATE-MAIN-CONTAINER dropzone"></div>
                    <!--底部菜单 start-->
                    <div style="height: 45px;"></div>
                    <div class="shop-footer">
                        <div class="shop-footer-l">
                            <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" title="编辑" data-url="/design/navigation/list?nav_page=m_shop&nav_position=3" data-title="导航设置">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>
                            <a href="{{ shop_prefix_url($shop_info['shop']['shop_id'],'mobile_shop_info') }}">
                                <i class="shop-nav-icon"></i>
                                <span>首页</span>
                            </a>
                        </div>
                        <ul>
                            <!-- -->
                            <li>
                                <a href="/shop/{{ $shop_info['shop']['shop_id'] }}/list.html">
                <span>
                    <i class="shop-index"></i>
                    全部商品
                </span>
                                </a>
                            </li>
                            <li>
                                <a href="/shop/{{ $shop_info['shop']['shop_id'] }}/info.html">
                <span>
                    <i class="shop-index"></i>
                    店铺详情
                </span>
                                </a>
                            </li>
                            <li>
                                <!-- 微商城客服调用qq -->
                                <a href="javascript:void(0)" onClick="$.msg('卖家没有设置联系电话')">
                <span>
                    <i class="shop-index"></i>
                    联系客服
                </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="classify-content SZY-SHOP-CATEGORY-LIST hide"></div>
                </div>
                <div class="special-footer"></div>
            </div>
        </div>
        <div class="mobile_design_right">
            <div class="design_right_box">
                <ul class="designSidebar">
                    <li class="mobiTemColumn active">
                        <a>模板助手</a>
                    </li>
                    @if(!empty($theme_list))
                        <li class="mobiTemColumn">
                            <a>主题</a>
                        </li>
                    @endif
                </ul>
                <div class="design_right_body">
                    <!--模块设置-->
                    <div class="template_set design_right_child">
                        <table id="mobile_helper">
                            <thead class="template_set_top">
                            <tr height="40">
                                <td>模块名称</td>
                                <td>是否开启</td>
                                <td>操作</td>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr height="40">
                                <td class="tcheck w30">
                                    <input class="checkBox table-list-checkbox all-checkbox" value="" type="checkbox">
                                </td>
                                <td colspan="3">
                                    <div class="pull-left">
                                        <a href="javascript:void(0)" class="batch-delete">批量删除</a>
                                        <a href="javascript:void(0)" class="batch-valid" data-value="1">批量显示</a>
                                        <a href="javascript:void(0)" class="batch-valid" data-value="0">批量隐藏</a>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="template_select design_right_child" style="display: none">
                        @if(!empty($theme_list))
                            @foreach($theme_list as $theme)
                                <li class="SZY-THEME-TPL @if(@$m_theme_id == $theme['back_id']){{ 'current' }}@endif" data-id="{{ $theme['back_id'] }}" data-img="{{ $theme['img'] }}">
                                <span class="template_select_bg">
                                    <img src="{{ $theme['img'] }}" class="mCS_img_loaded">
                                </span>
                                    <span class="template_select_name">{{ $theme['name'] }}</span>
                                    <div class="mask-div"></div>
                                    <a href="javascript:;" class="template_select_handle"></a>
                                </li>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>


@stop

@section('footer_script')
    <script type="text/javascript">
        //
    </script>

    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/min/js/scrollBar.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/min/js/core.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/min/js/app.common.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/common.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/jquery.design.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/design/TouchSlide.1.1.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/design/tplsetting_mobile.js?v=2.1"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/colour/js/spectrum.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/colour/js/docs.js?v=2.1"></script>
    <script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=2.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/jquery.base64.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=2.1"></script>
    <script>
        $(function(){
            $('.panelContentContainer').mCustomScrollbar();
            $('.design_right_body').mCustomScrollbar();
            $('.panelContentContainer').mCustomScrollbar('scrollTo', 'top');
            $('.designSidebar li').click(function(){
                $(this).addClass("active").siblings().removeClass('active');
                $(this).parents('.design_right_box').find(".design_right_child").hide().eq($(this).index()).show();
            });
            $(".other-more").click(function() {
                $(".more-set").slideToggle(100);
            }).mouseleave(function() {
                $(".more-set").hide();
            });
        })
        //
        //初始化数据
        var chk_value =[];
        var data = [];
        var data_m = {};
        var page = "m_shop";
        //加载数据
        $(function(){
            @if(@$m_theme_id == 0)
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
                    $handle.append($('<a class="upMove-btn" href="javascript:;"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>'));
                    $handle.append($('<a class="downMove-btn" href="javascript:;"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>'));
                    $handle.append($('<a class="hide-btn" href="javascript:;"><div class="selector-box"><div class="arrow"></div><i class="' + is_valid_class + '"></i>' + value.format_is_valid + '</div></a>'));
                    $handle.append($('<a class="deletes-btn" href="javascript:;""><div class="selector-box"><div class="arrow"></div><i class="fa fa-trash-o"></i>删除</div></a>'));
                    $el.append($handle);
                    $(".SZY-TEMPLATE-NAV-CONTAINER").append($el);
                }else{
                    var $handle = $('<div class="operateEdit"></div>');
                    $handle.append($('<a class="decor-btn upMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>').click(function () { setSortTpls(value.uid,'up'); }));
                    $handle.append($('<a class="decor-btn downMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>').click(function () { setSortTpls(value.uid,'down'); }));
                    $handle.append($('<a class="decor-btn '+is_eye_valid_class+'"><div class="selector-box"><div class="arrow"></div><i class="' + is_valid_class + '"></i>' + value.format_is_valid + '</div></a>').click(function () { setIsValidTpls(value.uid); }));
                    $handle.append($('<a class="decor-btn deletes-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-trash-o"></i>删除</div></a>').click(function () { delTpls(value.uid); }));
                    $el.append($handle);
                    $('.SZY-TEMPLATE-MAIN-CONTAINER').append($el);
                }
            });
            $.loading.stop();
            getHelper();
            //图片缓载
            $.imgloading.loading();
            @else
                $('.designSidebar li').eq(1).click();
                var theme_img = "{{ $theme_img }}";
                $('.mobile_design_center .special-item').html('<img src="'+theme_img+'" />');
            @endif
        });
        //
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
                var comstore_group_id = "0";
                try{
                    if(hiddenNavbar&&typeof(hiddenNavbar)=="function"){
                        hiddenNavbar();
                    }
                }catch(e){
                }
                var this_obj = $(this);
                this_obj.data('comstore_group_id', comstore_group_id);
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
                }
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