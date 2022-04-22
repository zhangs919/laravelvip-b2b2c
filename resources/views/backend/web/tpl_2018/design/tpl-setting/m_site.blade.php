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
    <link rel="stylesheet" href="/assets/d2eace91/css/design/moduleEditTool.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/swiper.min.css?v=1.2"/>
    <script src="/assets/d2eace91/js/design/swiper.jquery.min.js?v=1.2"></script>

@stop

@section('content')

    <script src="/assets/d2eace91/js/design/TouchSlide.1.1.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/bubbleup.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/index_tab.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/jquery-hdscroll.js?v=20180418"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/public.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/index.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/design.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/tplsetting.css?v=1.6"/>

    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="http://{{ env('MOBILE_DOMAIN') }}/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="http://{{ env('MOBILE_DOMAIN') }}/css/color-style.css?v=1.2" id="site_style"/>
    @endif
    <!--整站改色 _end-->
    <!-- GPS获取坐标 -->
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_web_key') }}"></script>
    <script src="/assets/d2eace91/js/geolocation/amap.js?v=1.2"></script>


    <!--顶部topbar-->
    <div class="module-topBar">
        <div class="module-topBar-inner">
            <a class="topBar-logo">
                <img src="{{ get_image_url(sysconf('backend_logo')) }}" />
            </a>
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
                        <li class="" data-url="/design/tpl-setting/setup?page=m_site">
                            <div class="menu-list-item">
                                <i class="page-bgimage"></i>
                                商城首页装修
                                <div class="set-btn">
                                    <span class="arrow">›</span>
                                </div>
                            </div>
                        </li>


                        <li class="" data-url="/design/tpl-setting/setup?page=m_news">
                            <div class="menu-list-item">
                                <i class="page-bgimage"></i>
                                资讯频道装修
                                <div class="set-btn">
                                    <span class="arrow">›</span>
                                </div>
                            </div>
                        </li>

                        <li class="" data-url="/design/tpl-setting/setup?page=m_goods">
                            <div class="menu-list-item">
                                <i class="page-bgimage"></i>
                                商品详情页装修
                                <div class="set-btn">
                                    <span class="arrow">›</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="topBar-navbar">
                <a class="SZY-SITE-STYLE" href="javascript:void(0);" data-group="mobile_site_style">
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
                    <a href="/design/tpl-setting/setup?page=site" class="set-btn" title="电脑端装修">
                        <span class="icon se-btn-pc"></span>
                        <span class="title">电脑端装修</span>
                    </a>

                    <a href="javascript:void(0);" class="set-btn active" title="微商城装修">
                        <span class="icon se-btn-weixin"></span>
                        <span class="title">微商城装修</span>
                    </a>


                    <a href="/design/tpl-setting/setup?page=app" class="set-btn" title="APP端装修">
                        <span class="icon se-btn-app"></span>
                        <span class="title">APP端装修</span>
                    </a>

                </div>
                <div class="page-operation-btns">
                    <a class="page-btn page-preview-btn SZY-TPL-BACKUP" href="javascript:void(0);">模板备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-USE" data-id="0" href="javascript:void(0);">使用备份</a>
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
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_banner.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="轮播广告">轮播广告</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="广告版式一">广告版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="广告版式二">广告版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s3" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s3.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="广告版式三">广告版式三</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s4" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s4.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="广告版式四">广告版式四</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s5" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s5.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="悬浮广告">悬浮广告</a>
                            </li>

                        </ul>
                    </fieldset>
                </div>



                <div class="panelItemContainer" id="panelItme2">
                    <fieldset class="panelItemBox">
                        <legend>商品模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_goods_floor_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_floor_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="楼层版式一">楼层版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_goods_floor_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_floor_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="楼层版式二">楼层版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_goods_promotion" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_promotion.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="楼层版式三">楼层版式三</a>
                            </li>

                        </ul>
                    </fieldset>
                </div>



                <div class="panelItemContainer" id="panelItme3">
                    <fieldset class="panelItemBox">
                        <legend>通用模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_goods_title_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_title_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="标题版式一">标题版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_title_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_title_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="标题版式二">标题版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_title_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_title_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="标题版式三">标题版式三</a>
                            </li>

                            <li class="drag" id="0" data-code="m_nav_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_nav_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="导航版式一">导航版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_nav_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_nav_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="导航版式二">导航版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_article" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_article.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="商城公告">商城公告</a>
                            </li>

                            <li class="drag" id="0" data-code="m_article_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_article_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="自定义公告">自定义公告</a>
                            </li>

                            <li class="drag" id="0" data-code="m_blank_line" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_blank_line.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="空白分割条">空白分割条</a>
                            </li>

                            <li class="drag" id="0" data-code="m_custom_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_custom_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="自定义模板">自定义模板</a>
                            </li>

                            <li class="drag" id="0" data-code="m_shop_street" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_shop_street.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="店铺版式一">店铺版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_tab_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_tab_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="选项卡模板">选项卡模板</a>
                            </li>

                        </ul>
                    </fieldset>
                </div>



                <div class="panelItemContainer" id="panelItme4">
                    <fieldset class="panelItemBox">
                        <legend>分页模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_goods_list" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_list.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="滚动商品">滚动商品</a>
                            </li>

                            <li class="drag" id="0" data-code="m_near_shop" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_near_shop.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="附近店铺">附近店铺</a>
                            </li>

                        </ul>
                    </fieldset>
                </div>





                <div class="panelItemContainer" id="panelItme6">
                    <fieldset class="panelItemBox">
                        <legend>资讯模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_news_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_news_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="资讯版式一">资讯版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_news_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_news_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="资讯版式二">资讯版式二</a>
                            </li>

                        </ul>
                    </fieldset>
                </div>





                <div class="panelItemContainer" id="panelItme8">
                    <fieldset class="panelItemBox">
                        <legend>营销模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_activity_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_activity_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="团购活动">团购活动</a>
                            </li>

                            <li class="drag" id="0" data-code="m_activity_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_activity_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="拼团活动">拼团活动</a>
                            </li>

                        </ul>
                    </fieldset>
                </div>



            </div>
        </div>
        <!--左侧end-->
        <!--右侧start-->

        <div class="mobile_design_center">
            <div class="mobile_list">
                <div class="special-top"></div>
                <div class="special-item ">
                    <header class="header bg-color">
                        <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" data-url='/system/config/index.html?group=mobile_setting_header' data-modal="1" data-title='头部设置'>
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                        <div class="search-box-cover" style="opacity: 0;"></div>
                        <div class="search-box">
                            <div class="search-tb">
                                <div class="nav_left">
                                    <em class="top_left ub_img"></em>
                                    <span class="bottom_nav">分类</span>
                                </div>
                                <div class="box-search">
                                    <a class="react" href="#">
                                        <i class="icon-search iconfont">&#xe600;</i>
                                        <span class="single-line"> 请输入要搜索的关键字 </span>
                                    </a>
                                </div>
                                <div class="nav_right">
                                    <em class="top_right ub_img">
                                        <i class="message_num">0</i>
                                    </em>
                                    <span class="bottom_nav">消息</span>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div style="height: 50px; line-height: 50px;"></div>
                    <div class="SZY-TEMPLATE-MAIN-CONTAINER dropzone"></div>
                    <!--底部菜单 start-->
                    <div class="SZY-TPL-FOOTER footer-nav-box">

                        {{--引入底部菜单--}}
                        @include('frontend.web_mobile.modules.library.site_footer_menu')

                    </div>
                    <!--底部菜单 end-->
                    <a href="#" id="back-to-top" class="gotop">
                        <img src="/assets/d2eace91/images/design/mobile/topup.png">
                    </a>
                </div>
                <div class="special-footer"></div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                //首先将#back-to-top隐藏
                $("#back-to-top").show();
                $(function () {
                    $("#back-to-top").click(function(){
                        $('body,html').animate(
                            {
                                scrollTop:0
                            }
                            ,600);
                        return false;
                    });
                });
            });
        </script>
        <div class="mobile_design_right">
            <div class="design_right_box">
                <ul class="designSidebar">
                    <li class="mobiTemColumn active">
                        <a>模板助手</a>
                    </li>

                    @if(!empty($tpl_backup_theme))
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
                                <td class="w30">
                                </td>
                                <td><span class="columnNameTextHead">模块名称</span></td>
                                <td>是否显示</td>
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

                        @if(!empty($tpl_backup_theme))
                            @foreach($tpl_backup_theme as $theme)
                                <li class="SZY-THEME-TPL" data-id="{{ $theme['back_id'] }}">
                                <span class="template_select_bg">
                                    <img src="{{ $theme['img'] }}">
                                </span>
                                    <span class="template_select_name">{{ $theme['name'] }}</span>
                                </li>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/d2eace91/js/jquery-ui.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/design/tplsetting_mobile.js?v=1.2"></script>

    <script type="text/javascript">
        //初始化数据
        var chk_value =[];
        var data = [];
        var data_m = {};
        var page = "m_site";
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
            getHelper('');
            //图片缓载
            $.imgloading.loading();

        });

    </script>
    <script language="javascript">
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
        $('.panelContentContainer').mCustomScrollbar();
        $('.design_right_body').mCustomScrollbar();
        $('.panelContentContainer').mCustomScrollbar('scrollTo', 'top');
        //$('.special-item').mCustomScrollbar({
        //			  callbacks:{
        //			    onScroll:function(){
        //			    	//滚动后显示
        //			    	$("img.lazy").lazyload();
        //			    	$("#back-to-top").fadeIn(500);
        //			    },
        //			    onTotalScrollBack:function(){
        //			    	//回到顶部隐藏
        //			    	$("#back-to-top").fadeOut(500);
        //			    },
        //			    whileScrolling:function(){
        //			    		$('.footer-nav-box').css({
        //							'position':'absolute',
        //							'top':Math.abs(parseInt($(this).find('.mCSB_container').css('top')))+436
        //						}),
        //			    		$('.header').css({
        //							'position':'absolute',
        //							'top':Math.abs(parseInt($(this).find('.mCSB_container').css('top')))
        //						})
        //						$('.gotop').css({
        //							'position':'absolute',
        //							'top':Math.abs(parseInt($(this).find('.mCSB_container').css('top')))+380
        //						})
        //			    },
        //		 }
        //	});
        $('.designSidebar li').click(function(){
            $(this).addClass("active").siblings().removeClass('active');
            $(this).parents('.design_right_box').find(".design_right_child").hide().eq($(this).index()).show();
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