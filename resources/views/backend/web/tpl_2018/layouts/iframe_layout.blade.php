
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? '云商城平台管理中心'}}</title>
    <!-- 禁止搜索引擎收录 -->
    <meta name="robots" content="noarchive">
    <meta name="baidspider" content="noarchive">
    <meta name="googlebot" content="noarchive">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=1.2"/>
    <!-- ================== END BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/loading/loaders.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/index/index.css?v=1.2"/>

    {{--自定义样式 整体改版--}}
    <link href="/css/custom.css?v={{ time() }}" rel="stylesheet">
    {{--自定义样式 整体改版--}}

    <!--[if lt IE 9]>
    <script src="/assets/d2eace91/js/html5shiv.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/respond.min.js?v=1.2"></script>
    <![endif]-->
    <script src="/assets/d2eace91/js/jquery.js?v=1.2"></script>
</head>
<body class="pace-done" id="c1">
<!--[if IE]>
<div class="ie-warning">什么？您还在使用 Internet Explorer (IE) 浏览器？ 很遗憾，我们已不再支持IE浏览器。事实上，升级到以下支持HTML5的浏览器将获得更牛逼的操作体验：<a href="http://www.mozillaonline.com/">Firefox</a> / <a href="http://www.google.com/chrome/?hl=zh-CN">Chrome</a> / <a href="http://www.apple.com.cn/safari/">Safari</a> / <a href="http://www.operachina.com/">Opera</a>，
    赶紧升级浏览器，让操作效率提升80%-120%！
</div>
<![endif]-->
<!--顶部菜单-->
<div class="admincp-header" id="main-navbar-top">
    <a class="toggle-left-box">
        <i class="fa fa-bars"></i>
    </a>
    <!--logo信息-->
    <div class="admincp-name">
        <h1 class="logo-image">
            <img src="{{ sysconf('backend_logo') ? get_image_url(sysconf('backend_logo')) : '/oss/images/system/config/website/backend_logo_0.png' }}" />
        </h1>
        <h1 class="logo-text">乐融沃B2B2C商城演示站平台管理中心</h1>
        <h2 class="logo-text-small">Platform Management Center</h2>
        <div id="foldSidebar" data-switch-toggle="state">
            <i class="arrow arrow-left"></i>
        </div>
    </div>
    <!--顶级导航TAB-->
    <div class="module-menu">
        <ul class="nav nav-tabs shop-row">


            @foreach(backend_menu() as $k=>$menu)
                <li class="@if(!empty($active_menus) && $active_menus[0] == $menu['name']) active @endif" data-param="{{ $menu['name'] }}">
                    <a href="#{{ $menu['name'] }}" data-toggle="tab"  >{{ $menu['title'] }}</a>
                    <b class="arrow"></b>
                </li>
            @endforeach


        </ul>
    </div>
    <a class="toggle-right-box" data-toggle="collapse" data-target="#admin-cog">
        <i class="fa fa-cog"></i>
    </a>
    <div class="admincp-header-r animated" id="admin-cog">

        <!--提醒、主题、全部功能、清除缓存、查看店铺、退出-->
        <ul class="operate shop-row">
            <li class="top-menu">
                <a href="http://{{ config('lrw.frontend_domain') }}" class="top_icon homepage" target="_blank" title="查看商城">
                    <i></i>
                    <span>商城</span>
                </a>
            </li>
            <li id="message-box" class="top-menu">
                <a class="top_icon toast" data-toggle="dropdown" title="查看待处理事项">
                    <i></i>
                    <span>提醒</span>
                    <em id="message_logo"  style="display: none">0</em>
                </a>
                <!-- 消息提醒 -->
                <div id="message-panel" class="message-pop-box big-message animated fadeInDown" style="display: none"></div>
            </li>
            <li id="clear_cache" class="top-menu">

                <a href="javascript:void(0);" class="top_icon clear-cache">
                    <i></i>
                    <span>清缓存</span>
                </a>

                <div id="clear_cache_panel" class="manager-menu dropdown-menu colorbg animated fadeInDown">
                    <span class="top-dropdown-bg"></span>
                    <a href="javascript:void(0);" class="close" title="点击关闭">&times;</a>
                    <div class="title">
                        <strong>清理缓存</strong>
                    </div>
                    <form id="cacheForm" action="/index" method="POST">
                        @csrf
                        <ul class="clear-cache-list">

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="common_runtime" />
                                    公共缓存
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="runtime" />
                                    运行时缓存
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="site_index" />
                                    网站首页
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="m_site_index" />
                                    微商城首页
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="shop_index" />
                                    店铺首页
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="m_shop_index" />
                                    微商城店铺首页
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="app_index" />
                                    APP首页
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="app_shop_index" />
                                    APP店铺首页
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="news_index" />
                                    资讯频道首页
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="topic_index" />
                                    专题活动首页
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="config" />
                                    系统配置
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="region" />
                                    地区缓存
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="menus" />
                                    系统菜单
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="auths" />
                                    系统权限
                                </label>
                            </li>

                            <li>
                                <label>
                                    <input type="checkbox" name="codes[]" value="gqrcode" />
                                    商品二维码
                                </label>
                            </li>

                        </ul>
                        <div class="skin-setttings text-r p-t-5">
                            <label class="all-check">
                                <input type="checkbox" id="cache_all">
                                全选
                            </label>
                            <input type="button" id="btn_clear_cache" value="清理缓存" class="btn btn-warning btn-sm" />
                        </div>
                    </form>
                </div>
            </li>
            <!--data-toggle="dropdown"-->
            <li id="change_color" class="top-menu">
                <a class="top_icon style-color">
                    <i></i>
                    <span>皮肤</span>
                </a>
                <div id="change_color_panel" class="manager-menu dropdown-menu colorbg animated fadeInDown">
                    <span class="top-dropdown-bg"></span>
                    <a class="close" title="点击关闭">&times;</a>
                    <div class="title">
                        <strong>皮肤选择</strong>
                    </div>
                    <ul class="inline">
                        <li name="c1" class="color-09c color-1"></li>
                        <li name="c2" class="color-blue color-2"></li>
                        <li name="c3" class="color-green color-3"></li>
                        <li name="c4" class="color-red color-4"></li>
                        <li name="c5" class="color-orange color-5"></li>
                        <li name="c6" class="color-purple color-6"></li>
                        <li name="c7" class="color-dark color-7"></li>
                    </ul>
                    <div class="skin-setttings">
                        <div class="title">
                            <strong>主题设置</strong>
                        </div>
                        <div class="setings-item">
                            <span>左侧菜单</span>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default left-menu-state btn-sm active" data-default="true">
                                    <input type="radio">
                                    展开
                                </label>
                                <label class="btn btn-default left-menu-state btn-sm" data-default="false">
                                    <input type="radio">
                                    收起
                                </label>
                            </div>
                            <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch" style="display: none">
                                <input type="checkbox" id="left_menu_state" name="collapsemenu" class="onoffswitch-checkbox" data-on-text="展开" data-off-text="收起">
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>界面风格</span>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default theme-style btn-sm active" data-default="true">
                                    <input type="radio">
                                    默认
                                </label>
                                <label class="btn btn-default theme-style btn-sm" data-default="false">
                                    <input type="radio">
                                    经典
                                </label>
                            </div>
                            <div class="switch bootstrap-switch bootstrap-switch-mini" style="display: none">
                                <input type="checkbox" id="theme_style" name="fixedsidebar" class="onoffswitch-checkbox" data-on-text="默认" data-off-text="经典">
                            </div>
                        </div>
                    </div>
                </div>
            </li>


            <!--   -->

            <!--            <li class="top-menu">
                            <a class="top_icon work-order" href="http://workorder.laravelvip.com" target="_blank" title="工单">
                                <i></i>
                                <span>工单</span>
                            </a>
                        </li>-->


            <li class="top-menu">
                <a href="/site/logout" data-method="post" title="退出" data-confirm="您确定要退出系统吗？" class="top_icon login-out">
                    <i></i>
                    <span>退出</span>
                </a>
            </li>
        </ul>

        <div style="float: left;display: inline-block;line-height: 48px;margin-right: 15px;font-weight: bold;">
            {{--            <a href="javascript:;" style="color: #e9e9e9;">非商业授权</a>--}}
            <a href="javascript:;" style="color: gold;">商业授权</a>
        </div>

        <!--个人信息-->
        <div id="personal_message" class="manager">
            <div class="manager-btn">
                <dl>
                    <dt class="name"></dt>
                    <dd class="group">{{ $admin->real_name }}</dd>
                </dl>
                <span class="avatar">
						<img alt="" nctype="admin_avatar" src="/assets/d2eace91/images/default/admin.jpg">
					</span>
                <i class="arrow"></i>
            </div>
            <div id="personal_message_panel" class="manager-menu dropdown-menu personal animated fadeInDown">
                <span class="top-dropdown-bg"></span>
                <a class="close" title="点击关闭">&times;</a>
                <div class="title">
                    <strong>最后登录</strong>
                    <a class="edit-password m-l-20 btn btn-warning btn-xs" style="margin-top: -3px;" data-toggle="modal" data-type="edit_password" data-id="60">修改密码</a>
                </div>
                <div class="login-date">
                    {{ $admin->last_time }}

                    <span>（IP：{{ $admin->last_ip ?? '0.0.0.0'}}）</span>

                </div>
                <div class="title" style="display: none">
                    <strong>个人设置</strong>
                    <a class="add-menu pull-right" href="javascript:void(0)" data-toggle="modal" data-target="#allModal">添加菜单</a>
                </div>
                <ul class="shop-row" nctype="quick_link" style="display: none">
                    <li>
                        <a href="javascript:void(0);">清理缓存</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">文章分类</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">文章管理</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">会员协议</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">广告管理</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">资讯设置</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">首页管理</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">导航管理</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">评论管理</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="clear"></div>
</div>
<div class="admincp-container main-wrapper-design-mode wpst-toolbar-show fold">
    <!--左侧内容-->
    <!--PC端、Paid端导航效果-->
    <div class="admincp-container-left vl-sidebar tab-content">
        <div class="top-border">
            <span class="nav-side"></span>
            <span class="sub-side"></span>
        </div>


        @foreach(backend_menu() as $k=>$menu)
            <div id="{{ $menu['name'] }}" class="nav-tabs tab-pane @if(@$active_menus[0] == $menu['name']) active @endif">
                <ul class="tab-bar">

                    @if(!empty($menu['child']))
                        @foreach($menu['child'] as $k2=>$menu2)
                            <li class="J_ToolbarItem @if(@$active_menus[1] == $menu2['name']) active @endif SZY-MENU-2" href="#{{ $menu2['name'] }}" data-toggle="tab">
                                <div class="wrap J_TGoldData">
                                    <div class="left-line"></div>

                                    <b class="{{ $menu2['icon'] }}"></b>

                                    <div class="v-text">{{ $menu2['title'] }}</div>
                                    <b class="fa fa-caret-left"></b>
                                </div>
                                <!-- 循环收缩的二级菜单 start -->
                                <div class="submenu">
                                    <ul>

                                        @if(!empty($menu2['child']))
                                            @foreach($menu2['child'] as $menu3)
                                                <li>
                                                    <a href="javascript:void(0);" onclick="openMenu('{{ $menu3['url'] }}',this, '{{ @$menu3['target'] }}')" data-menus="{{ $menu['name'] }}|{{ $menu2['name'] }}|{{ $menu3['name'] }}" data-param="{{ $menu3['name'] }}">{{ $menu3['title'] }}</a>
                                                </li>
                                            @endforeach
                                        @endif

                                    </ul>
                                </div>
                                <!-- 循环收缩的二级菜单 END -->
                            </li>
                        @endforeach
                    @endif

                </ul>
                <ul class="toolbar J_ModuleSlides">

                @if(!empty($menu['child']))
                    @foreach($menu['child'] as $k2=>$menu2)
                        <!-- 循环展开的二级菜单 BEGIN -->


                            <li id="{{ $menu2['name'] }}" class="slide tab-pane @if(@$active_menus[1] == $menu2['name']) active @endif">
                                <div class="product-nav-list">
                                    <ul>


                                        @if(!empty($menu2['child']))
                                            @foreach($menu2['child'] as $menu3)
                                                @if(@$active_menus[2] == $menu3['name'])
                                                    <script type="text/javascript">
                                                        $().ready(function() {
                                                            //
                                                            openMenu('{{ $active_url }}', $("[data-menus='{{ implode('|', $active_menus) }}']"), '');
                                                            //
                                                        });
                                                    </script>
                                                @endif
                                                <li class="@if(@$active_menus[2] == $menu3['name']) active @endif">
                                                    <a href="javascript:void(0);" onClick="openMenu('{{ $menu3['url'] }}',this, '{{ @$menu3['target'] }}')" data-menus="{{ $menu['name'] }}|{{ $menu2['name'] }}|{{ $menu3['name'] }}">
                                                        <div class="nav-title">
                                                        {{ $menu3['title'] }}
                                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                                            <em class="arrow-icon  fa fa-angle-right"></em>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif


                                    </ul>
                                </div>
                            </li>
                            <!-- 循环展开的二级菜单 END  -->
                        @endforeach
                    @endif

                </ul>
            </div>
    @endforeach


    <!--展开收起菜单按钮-->
        <div class="navbar-collapse" data-switch-toggle="state">
            <a class="navbar-btn">
                <i class="fa fa-outdent"></i>
            </a>
        </div>
    </div>
    <!--手机端导航效果-->
    <div class="admincp-container-left sm-nav">
        <div class="top-border">
            <span class="nav-side"></span>
        </div>
        <div id="sidebar" class="sidebar-fixed">
            <ul class="sm-nav-box">
                <li>
                    <a class="active" href="javascript:;">
                        <i class="fa fa-home"></i>
                        控制台
                    </a>
                </li>
                @foreach(backend_menu() as $menu)
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-laptop"></i>
                            {{ $menu['name'] }}
                            <i class="more fa fa-angle-right"></i>
                        </a>
                        @if(!empty($menu['child']))
                            <ul class="sm-child">
                                @foreach($menu['child'] as $menu2)
                                    <li class="sm-child-li">
                                        <a href="javascript:;">
                                            {{ $menu2['name'] }}
                                            <i class="more fa fa-angle-right"></i>
                                        </a>
                                        @if(!empty($menu2['child']))
                                            <ul class="sm-three">
                                                @foreach($menu2['child'] as $menu3)
                                                    <li class="@if(@$active_menus[2] == $menu3['name']) active @endif">
                                                        <a href="javascript:void(0);" onclick="openMenu('{{ $menu3['url'] }}',this, '')" data-menus="{{ $menu['name'] }}|{{ $menu2['name'] }}|{{ $menu3['name'] }}">{{ $menu3['title'] }}</a>
                                                    </li>
                                                @endforeach

                                                <div class="clear"></div>
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach

                            </ul>
                        @endif
                    </li>
                @endforeach


            </ul>
        </div>
    </div>
    <!--右侧内容-->
    <div class="admincp-container-right">
        <div class="top-border"></div>
        <iframe id="workspace" frameborder="0" scrolling="yes" style="width: 100%; height: 93%; *height: 580px; _height: 580px; overflow: hidden;"></iframe>
    </div>
</div>

<!-- 右下角提醒 -->
<div class="message-pop-box small-message down">
    <div class="message-title">
        <h5>
            <i class="news-icon"></i>
            消息提醒
        </h5>
        <a class="close" href="javascript:;">×</a>
    </div>
    <div class="message-info">
        <div class="message-icon"></div>
        <h5>
            <span id="message-pop-text"></span>
        </h5>
        <a id="message-pop-url" class="btn btn-primary btn-sm message-btn" href="javascript:;" src_name="order">立即处理</a>
    </div>
</div>



<!-- ================== BEGIN BASE  STYLE ================== -->
<script src="/assets/d2eace91/js/jquery.cookie.js?v=1.2"></script>
<script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=1.2"></script>
<script src="/assets/d2eace91/js/common.js?v=1.2"></script>
<script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=1.2"></script>
<script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=1.2"></script>
<script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=1.2"></script>
<!-- ================== END BASE CSS STYLE ================== -->
<script src="/assets/d2eace91/js/yii.js?v=1.2"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>

<script src=/js/main.js?v=1.2"></script>


<div id="attention" class="modal-body" style="display: none">
    <div class="f14 p-10">
        <p class="m-b-5">
            欢迎使用乐融沃商城系统，请优先配置/开启
            <a class="c-red" href="/system/config/index?group=alioss" target="_blank">阿里OSS对象存储服务</a>
            ，让您的数据更安全可靠，数据掌握在自己手中。
        </p>
        <p class="m-b-5">如因未配置/开启阿里OSS，造成的数据丢失，由您自行负责！！快去配置吧~</p>
        <p class="m-b-5">
            如何申请以及配置阿里OSS，请参考
            <a class="c-red" href="http://help.laravelvip.com/info/112.html" target="_blank">阿里OSS配置教程</a>
            。
        </p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
    </div>
</div>
<!--帮助指南-->
<div class="usage-guide-help hide">
    <div class="usage-guide-mask"></div>
    <div class="usage-guide-steps goods-manage">
        <div class="item-main">
            <span>商品管理</span>
            <em class="arrow-icon  fa fa-angle-right"></em>
        </div>
        <div class="item-description arrow-left">
            <p>
                发布商品，请前往卖家中心进行发布，更多功能需在卖家中心进行体验，
                <a class="fb" style="color: #FFFF00" href="http://{{ config('lrw.seller_domain') }}" target="_blank">前往卖家中心</a>
                进行了解吧！
            </p>
            <div class="btns">
                <a class="ant-btn closes-btn">了解</a>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    var is_top = true;
    (function($) {
        $(window).load(function() {
            $(".product-nav-list").mCustomScrollbar();
            $(".dialog_content").mCustomScrollbar();
            $(".theme-config .setings-item").mCustomScrollbar();
            $(".sidebar-fixed").mCustomScrollbar();
            $(".submenu ul").mCustomScrollbar();
        });
    })(jQuery);
    $().ready(function() {
        $("body").on("click", ".edit-password", function() {
            $.loading.start();
            $.open({
                // 标题
                title: "修改密码",
                width: "450px",
                // ajax加载的设置
                ajax: {
                    url: '/system/admin/edit-password',
                },
            }).always(function(){
                $.loading.stop();
            });
        });
        $("body").on("click", ".sitemap", function() {
            var modal = $.modal($(this));

            if (modal) {
                modal.show();
            } else {
                var modal = $.modal({
                    title: '管理中心全部功能菜单',
                    width: 1050,
                    trigger: this,
                    content: $('#all-menu').html(),
                    id: 'all-modal',
                });
            }

        });
    });
    /*全部菜单鼠标滑过切换tab*/
    function mouseover_tabs(a, c) {
        $('body').on('mouseover', a, function() {
            $(this).addClass(c).siblings().removeClass(c);
            $(this).parents('.admincp-map-nav').next().find('.tab-pane').eq($(this).index()).addClass('in active').siblings().removeClass('in active');
        })
    }
    mouseover_tabs(".admincp-map-nav li", 'active');
</script>
<!--//2017-12-8 去掉改功能
 <script type="text/javascript">
    $().ready(function() {
        /* 判断是否启用弹框 */
         $.ajax({
            url: '/index/index/show-message',
            dataType: 'json',
            success: function(data) {
                if (data.data == 0) {
                    $.open({
                        title: "商城指引",
                        ajax: {
                            url: '/index/index/mall-guide.html',
                        },
                        width: "1080px",
                        height:"540px",
                    });
                }
            }
        });
    });
</script> -->
</body>
<!-- 加载消息监听js-->
<script src="/assets/d2eace91/js/message/message.js?v=1.2"></script>
<script src="/assets/d2eace91/js/message/messageWS.js?v=1.2"></script>
<script type="text/javascript">

    WS_AddSys({
        'user_id': 'system_{{ $admin->user_id ?? 0 }}',
//        'url': "ws://push.laravelvip.com:8181",
        'url': "{{ get_ws_url('8181') }}",
        'type': "add_user"
    });

    //右下角消息提醒弹窗js
    function open_message_box(message) {
        if (typeof message == "undefined") {
            message = "";
        }
        $('#message-pop-text').html(message.content);
        if (message.type == "register_user")
        {
            $('#message-pop-url').attr("src_name", "user");
        }
        else
        {
            $('#message-pop-url').attr("src_name", "order");
        }
        $('.small-message').removeClass('down').addClass('up');
    }
    $('.small-message .close').click(function() {
        $('.small-message').removeClass('up').addClass('down');
    });
    $('#message-pop-url').on("click", function() {
        if ($("#message-pop-url").attr("src_name") == "user")
        {
            $("#workspace").attr("src", "/user/user/list");
        }
        else
        {
            $("#workspace").attr("src", "/trade/order/list");
        }
        $('.small-message').removeClass('up').addClass('down');
    });
    /*帮助指南*/
    if ($('.admincp-container').hasClass('fold')) {
        $('.usage-guide-help .goods-manage').addClass('fold');
    };
    $('.usage-guide-help .closes-btn').click(function() {
        $('.usage-guide-help').addClass('hide');
    });

    // 设置菜单默认展开
    $.cookie('left_menu_state', true, {
        expires: 365
    });
</script>
</html>
