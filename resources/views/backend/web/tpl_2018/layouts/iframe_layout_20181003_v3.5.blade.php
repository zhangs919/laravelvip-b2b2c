
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
            <img src="/oss/images/system/config/website/backend_logo_0.png" />
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


            <li class="active" data-param="system">
                <a href="#system" data-toggle="tab"  >系统</a>
                <b class="arrow"></b>
            </li>




            <li class="" data-param="mall">
                <a href="#mall" data-toggle="tab"  >商城</a>
                <b class="arrow"></b>
            </li>




            <li class="" data-param="finance">
                <a href="#finance" data-toggle="tab"  >财务</a>
                <b class="arrow"></b>
            </li>





            <li class="" data-param="app">
                <a href="#app" data-toggle="tab"  >APP</a>
                <b class="arrow"></b>
            </li>




            <li class="" data-param="weixin">
                <a href="#weixin" data-toggle="tab"  >微商城</a>
                <b class="arrow"></b>
            </li>



        </ul>
    </div>
    <a class="toggle-right-box" data-toggle="collapse" data-target="#admin-cog">
        <i class="fa fa-cog"></i>
    </a>
    <div class="admincp-header-r animated" id="admin-cog">

        <!--提醒、主题、全部功能、清除缓存、查看店铺、退出-->
        <ul class="operate shop-row">
            <li class="top-menu">
                <a href="http://{{ env('FRONTEND_DOMAIN') }}" class="top_icon homepage" target="_blank" title="查看商城">
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
                        {{ csrf_field() }}
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

            <li class="top-menu">
                <a class="top_icon work-order" href="http://workorder.laravelvip.com" target="_blank" title="工单">
                    <i></i>
                    <span>工单</span>
                </a>
            </li>


            <li class="top-menu">
                <a href="/site/logout" data-method="post" title="退出" data-confirm="您确定要退出系统吗？" class="top_icon login-out">
                    <i></i>
                    <span>退出</span>
                </a>
            </li>
        </ul>
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



        <div id="system" class="nav-tabs tab-pane active">
            <ul class="tab-bar">



                <li class="J_ToolbarItem active SZY-MENU-2" href="#system-index" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-home fa-fw"></b>

                        <div class="v-text">首页</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/index/index/index',this, '')" data-menus="system|system-index|welcome" data-param="welcome">欢迎页</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/index/index/operation-flow',this, '')" data-menus="system|system-index|operation-flow" data-param="operation-flow">新手向导</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/index/index/control-panel',this, '')" data-menus="system|system-index|panel" data-param="panel">控制面板</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#system-setting" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-cogs fa-fw"></b>

                        <div class="v-text">设置</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=website',this, '')" data-menus="system|system-setting|system-setting-website" data-param="system-setting-website">网站设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/admin/list',this, '')" data-menus="system|system-setting|system-setting-admin" data-param="system-setting-admin">管理员设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/region/list',this, '')" data-menus="system|system-setting|system-setting-region" data-param="system-setting-region">地区管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/log/list',this, '')" data-menus="system|system-setting|system-setting-log" data-param="system-setting-log">操作日志</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/clear-data/index',this, '')" data-menus="system|system-setting|system-setting-clear" data-param="system-setting-clear">清测试数据</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#system-api" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-plug fa-fw"></b>

                        <div class="v-text">接口</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=smtp',this, '')" data-menus="system|system-api|system-setting-email" data-param="system-setting-email">邮件设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=sms',this, '')" data-menus="system|system-api|system-setting-sms" data-param="system-setting-sms">短信设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=alioss',this, '')" data-menus="system|system-api|system-setting-alioss" data-param="system-setting-alioss">阿里OSS</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=aliim',this, '')" data-menus="system|system-api|system-setting-aliim" data-param="system-setting-aliim">阿里云旺</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=amap',this, '')" data-menus="system|system-api|system-setting-amap" data-param="system-setting-amap">高德地图</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=website_login',this, '')" data-menus="system|system-api|system-setting-website-login" data-param="system-setting-website-login">第三方登录</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/mall/payment/list',this, '')" data-menus="system|system-api|mall-setting-payment" data-param="mall-setting-payment">支付设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=kdniao',this, '')" data-menus="system|system-api|system-setting-kdniao" data-param="system-setting-kdniao">快递鸟设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=dada',this, '')" data-menus="system|system-api|system-setting-dada" data-param="system-setting-dada">达达配送</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/region/application-service',this, '')" data-menus="system|system-api|system-setting-application-service" data-param="system-setting-application-service">应用服务</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/oauth/oauth/index',this, '')" data-menus="system|system-api|system-setting-oauth" data-param="system-setting-oauth">对接周边系统</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#system-seo" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-paper-plane fa-fw"></b>

                        <div class="v-text">SEO</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_index',this, '')" data-menus="system|system-seo|system-seo-seo_index" data-param="system-seo-seo_index">首页</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_group_buy',this, '')" data-menus="system|system-seo|system-seo-seo_group_buy" data-param="system-seo-seo_group_buy">团购</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_groupon',this, '')" data-menus="system|system-seo|system-seo-seo_groupon" data-param="system-seo-seo_groupon">拼团</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_bargain',this, '')" data-menus="system|system-seo|system-seo-seo_bargain" data-param="system-seo-seo_bargain">砍价</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_brand',this, '')" data-menus="system|system-seo|system-seo-seo_brand" data-param="system-seo-seo_brand">品牌</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_article',this, '')" data-menus="system|system-seo|system-seo-seo_article" data-param="system-seo-seo_article">文章</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_goods',this, '')" data-menus="system|system-seo|system-seo-seo_goods" data-param="system-seo-seo_goods">商品</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_shop',this, '')" data-menus="system|system-seo|system-seo-seo_shop" data-param="system-seo-seo_shop">店铺</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_news',this, '')" data-menus="system|system-seo|system-seo-seo_news" data-param="system-seo-seo_news">资讯频道</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/seo-category/list',this, '')" data-menus="system|system-seo|system-seo-seo_category" data-param="system-seo-seo_category">商品分类</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/seo/sitemap',this, '')" data-menus="system|system-seo|system-seo-seo_map" data-param="system-seo-seo_map">网站地图</a>
                            </li>

                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>


            </ul>
            <ul class="toolbar J_ModuleSlides">

                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="system-index" class="slide tab-pane active">
                    <div class="product-nav-list">
                        <ul>


                            <script type="text/javascript">
                                $().ready(function() {
                                    //
                                    openMenu('/index/index/index', $("[data-menus='system|system-index|welcome']"), '');
                                    //
                                });
                            </script>

                            <li class="active">
                                <a href="javascript:void(0);" onClick="openMenu('/index/index/index',this, '')" data-menus="system|system-index|welcome">
                                    <div class="nav-title">
                                        欢迎页
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/index/index/operation-flow',this, '')" data-menus="system|system-index|operation-flow">
                                    <div class="nav-title">
                                        新手向导
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/index/index/control-panel',this, '')" data-menus="system|system-index|panel">
                                    <div class="nav-title">
                                        控制面板
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="system-setting" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=website',this, '')" data-menus="system|system-setting|system-setting-website">
                                    <div class="nav-title">
                                        网站设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/admin/list',this, '')" data-menus="system|system-setting|system-setting-admin">
                                    <div class="nav-title">
                                        管理员设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/system/index',this, '')" data-menus="system|system-setting|system-setting-system">
                                    <div class="nav-title">
                                        配置管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/shop-config-field/index',this, '')" data-menus="system|system-setting|system-setting-shop">
                                    <div class="nav-title">
                                        店铺配置管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/region/list',this, '')" data-menus="system|system-setting|system-setting-region">
                                    <div class="nav-title">
                                        地区管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/log/list',this, '')" data-menus="system|system-setting|system-setting-log">
                                    <div class="nav-title">
                                        操作日志
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/clear-data/index',this, '')" data-menus="system|system-setting|system-setting-clear">
                                    <div class="nav-title">
                                        清测试数据
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="system-api" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=smtp',this, '')" data-menus="system|system-api|system-setting-email">
                                    <div class="nav-title">
                                        邮件设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=sms',this, '')" data-menus="system|system-api|system-setting-sms">
                                    <div class="nav-title">
                                        短信设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=alioss',this, '')" data-menus="system|system-api|system-setting-alioss">
                                    <div class="nav-title">
                                        阿里OSS
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=aliim',this, '')" data-menus="system|system-api|system-setting-aliim">
                                    <div class="nav-title">
                                        阿里云旺
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=amap',this, '')" data-menus="system|system-api|system-setting-amap">
                                    <div class="nav-title">
                                        高德地图
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=website_login',this, '')" data-menus="system|system-api|system-setting-website-login">
                                    <div class="nav-title">
                                        第三方登录
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/mall/payment/list',this, '')" data-menus="system|system-api|mall-setting-payment">
                                    <div class="nav-title">
                                        支付设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=kdniao',this, '')" data-menus="system|system-api|system-setting-kdniao">
                                    <div class="nav-title">
                                        快递鸟设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=dada',this, '')" data-menus="system|system-api|system-setting-dada">
                                    <div class="nav-title">
                                        达达配送
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/region/application-service',this, '')" data-menus="system|system-api|system-setting-application-service">
                                    <div class="nav-title">
                                        应用服务
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/oauth/oauth/index',this, '')" data-menus="system|system-api|system-setting-oauth">
                                    <div class="nav-title">
                                        对接周边系统
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="system-seo" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=seo_index',this, '')" data-menus="system|system-seo|system-seo-seo_index">
                                    <div class="nav-title">
                                        首页
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=seo_group_buy',this, '')" data-menus="system|system-seo|system-seo-seo_group_buy">
                                    <div class="nav-title">
                                        团购
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=seo_groupon',this, '')" data-menus="system|system-seo|system-seo-seo_groupon">
                                    <div class="nav-title">
                                        拼团
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=seo_bargain',this, '')" data-menus="system|system-seo|system-seo-seo_bargain">
                                    <div class="nav-title">
                                        砍价
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=seo_brand',this, '')" data-menus="system|system-seo|system-seo-seo_brand">
                                    <div class="nav-title">
                                        品牌
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=seo_article',this, '')" data-menus="system|system-seo|system-seo-seo_article">
                                    <div class="nav-title">
                                        文章
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=seo_goods',this, '')" data-menus="system|system-seo|system-seo-seo_goods">
                                    <div class="nav-title">
                                        商品
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=seo_shop',this, '')" data-menus="system|system-seo|system-seo-seo_shop">
                                    <div class="nav-title">
                                        店铺
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=seo_news',this, '')" data-menus="system|system-seo|system-seo-seo_news">
                                    <div class="nav-title">
                                        资讯频道
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/seo-category/list',this, '')" data-menus="system|system-seo|system-seo-seo_category">
                                    <div class="nav-title">
                                        商品分类
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/seo/sitemap',this, '')" data-menus="system|system-seo|system-seo-seo_map">
                                    <div class="nav-title">
                                        网站地图
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>





                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


            </ul>
        </div>




        <div id="mall" class="nav-tabs tab-pane ">
            <ul class="tab-bar">



                <li class="J_ToolbarItem  SZY-MENU-2" href="#mall-setting" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-cogs fa-fw"></b>

                        <div class="v-text">设置</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=mall',this, '')" data-menus="mall|mall-setting|mall-setting-index" data-param="mall-setting-index">商城设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=default_image',this, '')" data-menus="mall|mall-setting|mall-setting-image" data-param="mall-setting-image">图片设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/mall/search/default-search',this, '')" data-menus="mall|mall-setting|mall-setting-search" data-param="mall-setting-search">搜索设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/mall/message-template/list',this, '')" data-menus="mall|mall-setting|mall-setting-message" data-param="mall-setting-message">消息模板</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/mall/shipping/list',this, '')" data-menus="mall|mall-setting|mall-setting-express" data-param="mall-setting-express">快递公司</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/mall/print-spec/list',this, '')" data-menus="mall|mall-setting|mall-setting-pring" data-param="mall-setting-pring">打印设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/mall/contract/audit-list',this, '')" data-menus="mall|mall-setting|mall-setting-contract" data-param="mall-setting-contract">消费保障</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=cash',this, '')" data-menus="mall|mall-setting|mall-setting-cash" data-param="mall-setting-cash">收银系统</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/mall/self-pickup/list',this, '')" data-menus="mall|mall-setting|mall-setting-pickup" data-param="mall-setting-pickup">上门自提</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mall-goods" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-shopping-cart fa-fw"></b>

                        <div class="v-text">商品</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=goods',this, '')" data-menus="mall|mall-goods|mall-goods-setting" data-param="mall-goods-setting">商品设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/goods/default/list',this, '')" data-menus="mall|mall-goods|mall-goods-manage" data-param="mall-goods-manage">商品管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/goods/cloud/list',this, '')" data-menus="mall|mall-goods|mall-cloud-goods-manage" data-param="mall-cloud-goods-manage">云端产品库</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/goods/lib-goods/list',this, '')" data-menus="mall|mall-goods|mall-lib-goods-manage" data-param="mall-lib-goods-manage">本地商品库</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/goods/lib-category/list',this, '')" data-menus="mall|mall-goods|mall-lib-category" data-param="mall-lib-category">商品库商品分类</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/goods/category/list',this, '')" data-menus="mall|mall-goods|mall-goods-category" data-param="mall-goods-category">分类管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/goods/brand/list',this, '')" data-menus="mall|mall-goods|mall-goods-brand" data-param="mall-goods-brand">品牌管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/goods/goods-type/list',this, '')" data-menus="mall|mall-goods|mall-goods-type-list" data-param="mall-goods-type-list">商品类型</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/goods/image-dir/list',this, '')" data-menus="mall|mall-goods|mall-goods-gallery" data-param="mall-goods-gallery">图片空间</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mall-trade" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-legal fa-fw"></b>

                        <div class="v-text">交易</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=trade&tabs=trade,integral',this, '')" data-menus="mall|mall-trade|mall-trade-setting" data-param="mall-trade-setting">交易设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/trade/order/list',this, '')" data-menus="mall|mall-trade|mall-trade-order" data-param="mall-trade-order">商品订单</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/dashboard/freebuy/list',this, '')" data-menus="mall|mall-trade|mall-freebuy-order" data-param="mall-freebuy-order">自由购订单</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/dashboard/reachbuy/list',this, '')" data-menus="mall|mall-trade|mall-reachbuy-order" data-param="mall-reachbuy-order">堂内点餐订单</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/trade/refund/list',this, '')" data-menus="mall|mall-trade|mall-trade-refund" data-param="mall-trade-refund">退款管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/trade/complaint/list',this, '')" data-menus="mall|mall-trade|mall-trade-complaint" data-param="mall-trade-complaint">投诉管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/trade/service/evaluate-buyer-list',this, '')" data-menus="mall|mall-trade|mall-trade-service" data-param="mall-trade-service">评价管理</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mall-shop" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-institution fa-fw"></b>

                        <div class="v-text">店铺</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/shop-setting/index',this, '')" data-menus="mall|mall-shop|mall-shop-setting" data-param="mall-shop-setting">开店设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/shop/index?is_supply=0',this, '')" data-menus="mall|mall-shop|mall-shop-list" data-param="mall-shop-list">入驻零售商</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/self-shop/index?is_supply=0',this, '')" data-menus="mall|mall-shop|mall-self-shop-list" data-param="mall-self-shop-list">自营零售商</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/recommend-shop/list',this, '')" data-menus="mall|mall-shop|mall-shop-recommend-shop" data-param="mall-shop-recommend-shop">推荐开店</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/recommend-msg/list',this, '')" data-menus="mall|mall-shop|mall-recommend-shop-msg" data-param="mall-recommend-shop-msg">预上线店铺留言</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/shop-credit/index',this, '')" data-menus="mall|mall-shop|mall-shop-credit" data-param="mall-shop-credit">店铺信誉</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/shop-class/index',this, '')" data-menus="mall|mall-shop|mall-shop-class" data-param="mall-shop-class">店铺分类</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=desc_conform',this, '')" data-menus="mall|mall-shop|mall-shop-mark" data-param="mall-shop-mark">店铺评分</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/collect/list',this, '')" data-menus="mall|mall-shop|mall-shop-collect" data-param="mall-shop-collect">采集控制</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/store/list',this, '')" data-menus="mall|mall-shop|mall-shop-store" data-param="mall-shop-store">网点控制</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/logistics/list',this, '')" data-menus="mall|mall-shop|mall-shop-logistics" data-param="mall-shop-logistics">物流众包授权</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/cash-oauth/list',this, '')" data-menus="mall|mall-shop|mall-shop-cash-oauth" data-param="mall-shop-cash-oauth">收银系统授权</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/shop/dada/list',this, '')" data-menus="mall|mall-shop|mall-shop-dada" data-param="mall-shop-dada">达达配送授权</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mall-user" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-user fa-fw"></b>

                        <div class="v-text">会员</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=user',this, '')" data-menus="mall|mall-user|mall-user-set" data-param="mall-user-set">会员设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/user/user/list',this, '')" data-menus="mall|mall-user|mall-user-list" data-param="mall-user-list">会员列表</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/user/user-rank/list',this, '')" data-menus="mall|mall-user|mall-user-rank-list" data-param="mall-user-rank-list">会员等级</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/user/shop/list',this, '')" data-menus="mall|mall-user|mall-user-shop-list" data-param="mall-user-shop-list">店铺会员等级</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mall-distrib" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-share-alt fa-fw"></b>

                        <div class="v-text">分销</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=distrib',this, '')" data-menus="mall|mall-distrib|distrib-set" data-param="distrib-set">分销返利设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/distrib/distrib-goods/list',this, '')" data-menus="mall|mall-distrib|distrib-goods-list" data-param="distrib-goods-list">分销商品列表</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/distrib/distributor/list',this, '')" data-menus="mall|mall-distrib|distrib-distributor-list" data-param="distrib-distributor-list">分销商列表</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/distrib/distrib-order/list',this, '')" data-menus="mall|mall-distrib|distrib-order-list" data-param="distrib-order-list">分销订单列表</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mall-dashboard" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-tags fa-fw"></b>

                        <div class="v-text">营销</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/dashboard/center/index',this, '')" data-menus="mall|mall-dashboard|mall-dashboard-center" data-param="mall-dashboard-center">营销中心</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('dashboard/shop-auth/index',this, '')" data-menus="mall|mall-dashboard|mall-dashboard-auth" data-param="mall-dashboard-auth">店铺营销权限</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mall-article" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-file-text-o fa-fw"></b>

                        <div class="v-text">文章</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/article/article-cat/list',this, '')" data-menus="mall|mall-article|mall-article-article-category" data-param="mall-article-article-category">文章分类</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/article/article/list',this, '')" data-menus="mall|mall-article|mall-article-article-list" data-param="mall-article-article-list">文章列表</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mall-design" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-paint-brush fa-fw"></b>

                        <div class="v-text">装修</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup',this, '_blank')" data-menus="mall|mall-design|mall-design-setup" data-param="mall-design-setup">首页装修</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=news',this, '_blank')" data-menus="mall|mall-design|news-design-setup" data-param="news-design-setup">资讯频道装修</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/design/navigation/list?nav_page=site&show_all=1',this, '')" data-menus="mall|mall-design|site-navigation" data-param="site-navigation">商城导航</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=login_bg',this, '')" data-menus="mall|mall-design|mall-personal-setting" data-param="mall-personal-setting">个性化设置</a>
                            </li>




                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/mall/copyright-auth/list',this, '')" data-menus="mall|mall-design|mall-copyright-auth" data-param="mall-copyright-auth">资质导航</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/mall/links/list',this, '')" data-menus="mall|mall-design|mall-setting-links" data-param="mall-setting-links">友情链接</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>


            </ul>
            <ul class="toolbar J_ModuleSlides">

                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mall-setting" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=mall',this, '')" data-menus="mall|mall-setting|mall-setting-index">
                                    <div class="nav-title">
                                        商城设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=default_image',this, '')" data-menus="mall|mall-setting|mall-setting-image">
                                    <div class="nav-title">
                                        图片设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/mall/search/default-search',this, '')" data-menus="mall|mall-setting|mall-setting-search">
                                    <div class="nav-title">
                                        搜索设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/mall/message-template/list',this, '')" data-menus="mall|mall-setting|mall-setting-message">
                                    <div class="nav-title">
                                        消息模板
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/mall/shipping/list',this, '')" data-menus="mall|mall-setting|mall-setting-express">
                                    <div class="nav-title">
                                        快递公司
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/mall/print-spec/list',this, '')" data-menus="mall|mall-setting|mall-setting-pring">
                                    <div class="nav-title">
                                        打印设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/mall/contract/audit-list',this, '')" data-menus="mall|mall-setting|mall-setting-contract">
                                    <div class="nav-title">
                                        消费保障
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=cash',this, '')" data-menus="mall|mall-setting|mall-setting-cash">
                                    <div class="nav-title">
                                        收银系统
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/mall/self-pickup/list',this, '')" data-menus="mall|mall-setting|mall-setting-pickup">
                                    <div class="nav-title">
                                        上门自提
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mall-goods" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=goods',this, '')" data-menus="mall|mall-goods|mall-goods-setting">
                                    <div class="nav-title">
                                        商品设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/goods/default/list',this, '')" data-menus="mall|mall-goods|mall-goods-manage">
                                    <div class="nav-title">
                                        商品管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/goods/cloud/list',this, '')" data-menus="mall|mall-goods|mall-cloud-goods-manage">
                                    <div class="nav-title">
                                        云端产品库
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/goods/lib-goods/list',this, '')" data-menus="mall|mall-goods|mall-lib-goods-manage">
                                    <div class="nav-title">
                                        本地商品库
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/goods/lib-category/list',this, '')" data-menus="mall|mall-goods|mall-lib-category">
                                    <div class="nav-title">
                                        商品库商品分类
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/goods/category/list',this, '')" data-menus="mall|mall-goods|mall-goods-category">
                                    <div class="nav-title">
                                        分类管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/goods/brand/list',this, '')" data-menus="mall|mall-goods|mall-goods-brand">
                                    <div class="nav-title">
                                        品牌管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/goods/goods-type/list',this, '')" data-menus="mall|mall-goods|mall-goods-type-list">
                                    <div class="nav-title">
                                        商品类型
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/goods/image-dir/list',this, '')" data-menus="mall|mall-goods|mall-goods-gallery">
                                    <div class="nav-title">
                                        图片空间
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mall-trade" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=trade&tabs=trade,integral',this, '')" data-menus="mall|mall-trade|mall-trade-setting">
                                    <div class="nav-title">
                                        交易设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/trade/order/list',this, '')" data-menus="mall|mall-trade|mall-trade-order">
                                    <div class="nav-title">
                                        商品订单
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/dashboard/freebuy/list',this, '')" data-menus="mall|mall-trade|mall-freebuy-order">
                                    <div class="nav-title">
                                        自由购订单
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/dashboard/reachbuy/list',this, '')" data-menus="mall|mall-trade|mall-reachbuy-order">
                                    <div class="nav-title">
                                        堂内点餐订单
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/trade/refund/list',this, '')" data-menus="mall|mall-trade|mall-trade-refund">
                                    <div class="nav-title">
                                        退款管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/trade/complaint/list',this, '')" data-menus="mall|mall-trade|mall-trade-complaint">
                                    <div class="nav-title">
                                        投诉管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/trade/service/evaluate-buyer-list',this, '')" data-menus="mall|mall-trade|mall-trade-service">
                                    <div class="nav-title">
                                        评价管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mall-shop" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/shop-setting/index',this, '')" data-menus="mall|mall-shop|mall-shop-setting">
                                    <div class="nav-title">
                                        开店设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/shop/index?is_supply=0',this, '')" data-menus="mall|mall-shop|mall-shop-list">
                                    <div class="nav-title">
                                        入驻零售商
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/self-shop/index?is_supply=0',this, '')" data-menus="mall|mall-shop|mall-self-shop-list">
                                    <div class="nav-title">
                                        自营零售商
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/recommend-shop/list',this, '')" data-menus="mall|mall-shop|mall-shop-recommend-shop">
                                    <div class="nav-title">
                                        推荐开店
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/recommend-msg/list',this, '')" data-menus="mall|mall-shop|mall-recommend-shop-msg">
                                    <div class="nav-title">
                                        预上线店铺留言
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/shop-credit/index',this, '')" data-menus="mall|mall-shop|mall-shop-credit">
                                    <div class="nav-title">
                                        店铺信誉
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/shop-class/index',this, '')" data-menus="mall|mall-shop|mall-shop-class">
                                    <div class="nav-title">
                                        店铺分类
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=desc_conform',this, '')" data-menus="mall|mall-shop|mall-shop-mark">
                                    <div class="nav-title">
                                        店铺评分
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/collect/list',this, '')" data-menus="mall|mall-shop|mall-shop-collect">
                                    <div class="nav-title">
                                        采集控制
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/store/list',this, '')" data-menus="mall|mall-shop|mall-shop-store">
                                    <div class="nav-title">
                                        网点控制
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/logistics/list',this, '')" data-menus="mall|mall-shop|mall-shop-logistics">
                                    <div class="nav-title">
                                        物流众包授权
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/cash-oauth/list',this, '')" data-menus="mall|mall-shop|mall-shop-cash-oauth">
                                    <div class="nav-title">
                                        收银系统授权
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/shop/dada/list',this, '')" data-menus="mall|mall-shop|mall-shop-dada">
                                    <div class="nav-title">
                                        达达配送授权
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mall-user" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=user',this, '')" data-menus="mall|mall-user|mall-user-set">
                                    <div class="nav-title">
                                        会员设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/user/user/list',this, '')" data-menus="mall|mall-user|mall-user-list">
                                    <div class="nav-title">
                                        会员列表
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/user/user-rank/list',this, '')" data-menus="mall|mall-user|mall-user-rank-list">
                                    <div class="nav-title">
                                        会员等级
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/user/shop/list',this, '')" data-menus="mall|mall-user|mall-user-shop-list">
                                    <div class="nav-title">
                                        店铺会员等级
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mall-distrib" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=distrib',this, '')" data-menus="mall|mall-distrib|distrib-set">
                                    <div class="nav-title">
                                        分销返利设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/distrib/distrib-goods/list',this, '')" data-menus="mall|mall-distrib|distrib-goods-list">
                                    <div class="nav-title">
                                        分销商品列表
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/distrib/distributor/list',this, '')" data-menus="mall|mall-distrib|distrib-distributor-list">
                                    <div class="nav-title">
                                        分销商列表
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/distrib/distrib-order/list',this, '')" data-menus="mall|mall-distrib|distrib-order-list">
                                    <div class="nav-title">
                                        分销订单列表
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mall-dashboard" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/dashboard/center/index',this, '')" data-menus="mall|mall-dashboard|mall-dashboard-center">
                                    <div class="nav-title">
                                        营销中心
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('dashboard/shop-auth/index',this, '')" data-menus="mall|mall-dashboard|mall-dashboard-auth">
                                    <div class="nav-title">
                                        店铺营销权限
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mall-article" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/article/article-cat/list',this, '')" data-menus="mall|mall-article|mall-article-article-category">
                                    <div class="nav-title">
                                        文章分类
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/article/article/list',this, '')" data-menus="mall|mall-article|mall-article-article-list">
                                    <div class="nav-title">
                                        文章列表
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mall-design" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/design/tpl-setting/setup',this, '_blank')" data-menus="mall|mall-design|mall-design-setup">
                                    <div class="nav-title">
                                        首页装修
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/design/tpl-setting/setup?page=news',this, '_blank')" data-menus="mall|mall-design|news-design-setup">
                                    <div class="nav-title">
                                        资讯频道装修
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/design/navigation/list?nav_page=site&show_all=1',this, '')" data-menus="mall|mall-design|site-navigation">
                                    <div class="nav-title">
                                        商城导航
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=login_bg',this, '')" data-menus="mall|mall-design|mall-personal-setting">
                                    <div class="nav-title">
                                        个性化设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>






                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/mall/copyright-auth/list',this, '')" data-menus="mall|mall-design|mall-copyright-auth">
                                    <div class="nav-title">
                                        资质导航
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/mall/links/list',this, '')" data-menus="mall|mall-design|mall-setting-links">
                                    <div class="nav-title">
                                        友情链接
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


            </ul>
        </div>




        <div id="finance" class="nav-tabs tab-pane ">
            <ul class="tab-bar">



                <li class="J_ToolbarItem  SZY-MENU-2" href="#finance-capital" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-money fa-fw"></b>

                        <div class="v-text">资金</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/mall-account/list',this, '')" data-menus="finance|finance-capital|finance-mall-account-list" data-param="finance-mall-account-list">商城账户</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/user-account/list',this, '')" data-menus="finance|finance-capital|finance-user-account-list" data-param="finance-user-account-list">会员账户</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/recharge/list',this, '')" data-menus="finance|finance-capital|finance-recharge-list" data-param="finance-recharge-list">充值管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/deposit/list',this, '')" data-menus="finance|finance-capital|finance-deposit-list" data-param="finance-deposit-list">提现管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/cashier/stats',this, '')" data-menus="finance|finance-capital|finance-stats" data-param="finance-stats">神码统计</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#finance-bill" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-clipboard fa-fw"></b>

                        <div class="v-text">账单</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/bill/system-shop-bill',this, '')" data-menus="finance|finance-bill|finance-shop-bill" data-param="finance-shop-bill">店铺账单</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#finance-statistics" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-line-chart fa-fw"></b>

                        <div class="v-text">统计</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/data-profiling/index',this, '')" data-menus="finance|finance-statistics|data-profiling-default" data-param="data-profiling-default">数据概况</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/shops-statistics/index',this, '')" data-menus="finance|finance-statistics|finance-shops-statistics" data-param="finance-shops-statistics">店铺统计</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/users-statistics/index',this, '')" data-menus="finance|finance-statistics|finance-users-statistics" data-param="finance-users-statistics">会员统计</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/sales-analyse/index',this, '')" data-menus="finance|finance-statistics|finance-sales-analyse" data-param="finance-sales-analyse">销售分析</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/industry-analyse/index',this, '')" data-menus="finance|finance-statistics|finance-industry-analyse" data-param="finance-industry-analyse">行业分析</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/finance/finance-statistics/index',this, '')" data-menus="finance|finance-statistics|finance-sales-statistics" data-param="finance-sales-statistics">财务统计</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>


            </ul>
            <ul class="toolbar J_ModuleSlides">

                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="finance-capital" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/mall-account/list',this, '')" data-menus="finance|finance-capital|finance-mall-account-list">
                                    <div class="nav-title">
                                        商城账户
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/user-account/list',this, '')" data-menus="finance|finance-capital|finance-user-account-list">
                                    <div class="nav-title">
                                        会员账户
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/recharge/list',this, '')" data-menus="finance|finance-capital|finance-recharge-list">
                                    <div class="nav-title">
                                        充值管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/deposit/list',this, '')" data-menus="finance|finance-capital|finance-deposit-list">
                                    <div class="nav-title">
                                        提现管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/cashier/stats',this, '')" data-menus="finance|finance-capital|finance-stats">
                                    <div class="nav-title">
                                        神码统计
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="finance-bill" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/bill/system-shop-bill',this, '')" data-menus="finance|finance-bill|finance-shop-bill">
                                    <div class="nav-title">
                                        店铺账单
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="finance-statistics" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/data-profiling/index',this, '')" data-menus="finance|finance-statistics|data-profiling-default">
                                    <div class="nav-title">
                                        数据概况
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/shops-statistics/index',this, '')" data-menus="finance|finance-statistics|finance-shops-statistics">
                                    <div class="nav-title">
                                        店铺统计
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/users-statistics/index',this, '')" data-menus="finance|finance-statistics|finance-users-statistics">
                                    <div class="nav-title">
                                        会员统计
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/sales-analyse/index',this, '')" data-menus="finance|finance-statistics|finance-sales-analyse">
                                    <div class="nav-title">
                                        销售分析
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/industry-analyse/index',this, '')" data-menus="finance|finance-statistics|finance-industry-analyse">
                                    <div class="nav-title">
                                        行业分析
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/finance/finance-statistics/index',this, '')" data-menus="finance|finance-statistics|finance-sales-statistics">
                                    <div class="nav-title">
                                        财务统计
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


            </ul>
        </div>





        <div id="app" class="nav-tabs tab-pane ">
            <ul class="tab-bar">



                <li class="J_ToolbarItem  SZY-MENU-2" href="#app-setting" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-cogs fa-fw"></b>

                        <div class="v-text">设置</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_setting',this, '')" data-menus="app|app-setting|app-setting-store" data-param="app-setting-store">商店设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_guide',this, '')" data-menus="app|app-setting|app-setting-guide" data-param="app-setting-guide">引导图片</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/app/push-message/index',this, '')" data-menus="app|app-setting|app_push_message" data-param="app_push_message">消息推送</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_setting_basic',this, '')" data-menus="app|app-setting|mobile-setting-basic" data-param="mobile-setting-basic">基本设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_setting_login',this, '')" data-menus="app|app-setting|mobile-setting-login" data-param="mobile-setting-login">登录设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_setting_index',this, '')" data-menus="app|app-setting|mobile-setting-index" data-param="mobile-setting-index">首页设置</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#app-renovation" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-magic fa-fw"></b>

                        <div class="v-text">装修</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=app',this, '_blank')" data-menus="app|app-renovation|app-setting-template" data-param="app-setting-template">首页装修</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#app-seller" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-flag fa-fw"></b>

                        <div class="v-text">商家</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_seller_setting',this, '')" data-menus="app|app-seller|app-seller-setting" data-param="app-seller-setting">商家设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/app/seller-push-message/index',this, '')" data-menus="app|app-seller|app-seller-push-message" data-param="app-seller-push-message">消息推送</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#app-store" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-map-marker fa-fw"></b>

                        <div class="v-text">网点</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_store_setting',this, '')" data-menus="app|app-store|app-store-setting" data-param="app-store-setting">网点设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/app/store-push-message/index',this, '')" data-menus="app|app-store|app-store-push-message" data-param="app-store-push-message">消息推送</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>


            </ul>
            <ul class="toolbar J_ModuleSlides">

                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="app-setting" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=app_setting',this, '')" data-menus="app|app-setting|app-setting-store">
                                    <div class="nav-title">
                                        商店设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=app_guide',this, '')" data-menus="app|app-setting|app-setting-guide">
                                    <div class="nav-title">
                                        引导图片
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/app/push-message/index',this, '')" data-menus="app|app-setting|app_push_message">
                                    <div class="nav-title">
                                        消息推送
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=app_setting_basic',this, '')" data-menus="app|app-setting|mobile-setting-basic">
                                    <div class="nav-title">
                                        基本设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=app_setting_login',this, '')" data-menus="app|app-setting|mobile-setting-login">
                                    <div class="nav-title">
                                        登录设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=app_setting_index',this, '')" data-menus="app|app-setting|mobile-setting-index">
                                    <div class="nav-title">
                                        首页设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="app-renovation" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/design/tpl-setting/setup?page=app',this, '_blank')" data-menus="app|app-renovation|app-setting-template">
                                    <div class="nav-title">
                                        首页装修
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="app-seller" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=app_seller_setting',this, '')" data-menus="app|app-seller|app-seller-setting">
                                    <div class="nav-title">
                                        商家设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/app/seller-push-message/index',this, '')" data-menus="app|app-seller|app-seller-push-message">
                                    <div class="nav-title">
                                        消息推送
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="app-store" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=app_store_setting',this, '')" data-menus="app|app-store|app-store-setting">
                                    <div class="nav-title">
                                        网点设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/app/store-push-message/index',this, '')" data-menus="app|app-store|app-store-push-message">
                                    <div class="nav-title">
                                        消息推送
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


            </ul>
        </div>




        <div id="weixin" class="nav-tabs tab-pane ">
            <ul class="tab-bar">



                <li class="J_ToolbarItem  SZY-MENU-2" href="#mobile-setting" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-cog fa-fw"></b>

                        <div class="v-text">设置</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=mobile_setting_basic',this, '')" data-menus="weixin|mobile-setting|mobile-setting-basic" data-param="mobile-setting-basic">基本设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=mobile_setting_login',this, '')" data-menus="weixin|mobile-setting|mobile-setting-login" data-param="mobile-setting-login">登录设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=mobile_setting_index',this, '')" data-menus="weixin|mobile-setting|mobile-setting-index" data-param="mobile-setting-index">首页设置</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mobile-weixin" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-weixin fa-fw"></b>

                        <div class="v-text">微信</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=weixin',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-config" data-param="mobile-weixin-config">微信设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=weixin_bind',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin_bind" data-param="mobile-weixin_bind">微信绑定</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/weixin/menu/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-menu" data-param="mobile-weixin-menu">自定义菜单</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/weixin/keyword/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-keyword" data-param="mobile-weixin-keyword">关键词回复</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/weixin/user/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-user" data-param="mobile-weixin-user">粉丝管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/weixin/qcode/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-qcode" data-param="mobile-weixin-qcode">二维码管理</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/weixin/material/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-material" data-param="mobile-weixin-material">微信素材</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/weixin/push/index',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-push" data-param="mobile-weixin-push">消息推送</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=weixin_poster',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin_poster" data-param="mobile-weixin_poster">微信海报设置</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=weixin_programs',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin_programs" data-param="mobile-weixin_programs">微信小程序设置</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>




                <li class="J_ToolbarItem  SZY-MENU-2" href="#mobile-design" data-toggle="tab">
                    <div class="wrap J_TGoldData">
                        <div class="left-line"></div>

                        <b class="fa fa-magic fa-fw"></b>

                        <div class="v-text">装修</div>
                        <b class="fa fa-caret-left"></b>
                    </div>
                    <!-- 循环收缩的二级菜单 start -->
                    <div class="submenu">
                        <ul>

                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=m_site',this, '_blank')" data-menus="weixin|mobile-design|mobile-design-setup" data-param="mobile-design-setup">首页装修</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=m_news',this, '_blank')" data-menus="weixin|mobile-design|mobile-news-design" data-param="mobile-news-design">资讯频道装修</a>
                            </li>


                            <li>
                                <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=m_goods',this, '_blank')" data-menus="weixin|mobile-design|mobile-goods-design" data-param="mobile-goods-design">商品详情页装修</a>
                            </li>


                        </ul>
                    </div>
                    <!-- 循环收缩的二级菜单 END -->
                </li>


            </ul>
            <ul class="toolbar J_ModuleSlides">

                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mobile-setting" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=mobile_setting_basic',this, '')" data-menus="weixin|mobile-setting|mobile-setting-basic">
                                    <div class="nav-title">
                                        基本设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=mobile_setting_login',this, '')" data-menus="weixin|mobile-setting|mobile-setting-login">
                                    <div class="nav-title">
                                        登录设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=mobile_setting_index',this, '')" data-menus="weixin|mobile-setting|mobile-setting-index">
                                    <div class="nav-title">
                                        首页设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mobile-weixin" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=weixin',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-config">
                                    <div class="nav-title">
                                        微信设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=weixin_bind',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin_bind">
                                    <div class="nav-title">
                                        微信绑定
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/weixin/menu/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-menu">
                                    <div class="nav-title">
                                        自定义菜单
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/weixin/keyword/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-keyword">
                                    <div class="nav-title">
                                        关键词回复
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/weixin/user/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-user">
                                    <div class="nav-title">
                                        粉丝管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/weixin/qcode/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-qcode">
                                    <div class="nav-title">
                                        二维码管理
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/weixin/material/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-material">
                                    <div class="nav-title">
                                        微信素材
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/weixin/push/index',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-push">
                                    <div class="nav-title">
                                        消息推送
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=weixin_poster',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin_poster">
                                    <div class="nav-title">
                                        微信海报设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/system/config/index?group=weixin_programs',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin_programs">
                                    <div class="nav-title">
                                        微信小程序设置
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


                <!-- 循环展开的二级菜单 BEGIN -->


                <li id="mobile-design" class="slide tab-pane ">
                    <div class="product-nav-list">
                        <ul>



                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/design/tpl-setting/setup?page=m_site',this, '_blank')" data-menus="weixin|mobile-design|mobile-design-setup">
                                    <div class="nav-title">
                                        首页装修
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/design/tpl-setting/setup?page=m_news',this, '_blank')" data-menus="weixin|mobile-design|mobile-news-design">
                                    <div class="nav-title">
                                        资讯频道装修
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>




                            <li class="">
                                <a href="javascript:void(0);" onClick="openMenu('/design/tpl-setting/setup?page=m_goods',this, '_blank')" data-menus="weixin|mobile-design|mobile-goods-design">
                                    <div class="nav-title">
                                        商品详情页装修
                                        <!--第三级菜单new图标添加，需判断<i class="new-icon"><img src="../assets/d2eace91/images/common/new.gif"></i>-->
                                        <em class="arrow-icon  fa fa-angle-right"></em>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <!-- 循环展开的二级菜单 END  -->


            </ul>
        </div>


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
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        系统
                        <i class="more fa fa-angle-right"></i>
                    </a>
                    <ul class="sm-child">
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                首页
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/index/index/index',this, '')" data-menus="system|system-index|welcome">欢迎页</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/index/index/operation-flow',this, '')" data-menus="system|system-index|operation-flow">新手向导</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/index/index/control-panel',this, '')" data-menus="system|system-index|panel">控制面板</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                设置
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=website',this, '')" data-menus="system|system-setting|system-setting-website">网站设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/admin/list',this, '')" data-menus="system|system-setting|system-setting-admin">管理员设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/system/index',this, '')" data-menus="system|system-setting|system-setting-system">配置管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/shop-config-field/index',this, '')" data-menus="system|system-setting|system-setting-shop">店铺配置管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/region/list',this, '')" data-menus="system|system-setting|system-setting-region">地区管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/log/list',this, '')" data-menus="system|system-setting|system-setting-log">操作日志</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/clear-data/index',this, '')" data-menus="system|system-setting|system-setting-clear">清测试数据</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                接口
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=smtp',this, '')" data-menus="system|system-api|system-setting-email">邮件设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=sms',this, '')" data-menus="system|system-api|system-setting-sms">短信设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=alioss',this, '')" data-menus="system|system-api|system-setting-alioss">阿里OSS</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=aliim',this, '')" data-menus="system|system-api|system-setting-aliim">阿里云旺</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=amap',this, '')" data-menus="system|system-api|system-setting-amap">高德地图</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=website_login',this, '')" data-menus="system|system-api|system-setting-website-login">第三方登录</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/mall/payment/list',this, '')" data-menus="system|system-api|mall-setting-payment">支付设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=kdniao',this, '')" data-menus="system|system-api|system-setting-kdniao">快递鸟设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=dada',this, '')" data-menus="system|system-api|system-setting-dada">达达配送</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/region/application-service',this, '')" data-menus="system|system-api|system-setting-application-service">应用服务</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/oauth/oauth/index',this, '')" data-menus="system|system-api|system-setting-oauth">对接周边系统</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                SEO
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_index',this, '')" data-menus="system|system-seo|system-seo-seo_index">首页</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_group_buy',this, '')" data-menus="system|system-seo|system-seo-seo_group_buy">团购</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_groupon',this, '')" data-menus="system|system-seo|system-seo-seo_groupon">拼团</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_bargain',this, '')" data-menus="system|system-seo|system-seo-seo_bargain">砍价</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_brand',this, '')" data-menus="system|system-seo|system-seo-seo_brand">品牌</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_article',this, '')" data-menus="system|system-seo|system-seo-seo_article">文章</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_goods',this, '')" data-menus="system|system-seo|system-seo-seo_goods">商品</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_shop',this, '')" data-menus="system|system-seo|system-seo-seo_shop">店铺</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=seo_news',this, '')" data-menus="system|system-seo|system-seo-seo_news">资讯频道</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/seo/sitemap',this, '')" data-menus="system|system-seo|system-seo-seo_map">网站地图</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/seo-category/list',this, '')" data-menus="system|system-seo|system-seo-seo_category">商品分类</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        商城
                        <i class="more fa fa-angle-right"></i>
                    </a>
                    <ul class="sm-child">
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                设置
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=mall',this, '')" data-menus="mall|mall-setting|mall-setting-index">商城设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=default_image',this, '')" data-menus="mall|mall-setting|mall-setting-image">图片设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/mall/search/default-search',this, '')" data-menus="mall|mall-setting|mall-setting-search">搜索设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/mall/message-template/list',this, '')" data-menus="mall|mall-setting|mall-setting-message">消息模板</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/mall/shipping/list',this, '')" data-menus="mall|mall-setting|mall-setting-express">快递公司</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/mall/print-spec/list',this, '')" data-menus="mall|mall-setting|mall-setting-pring">打印设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/mall/contract/audit-list',this, '')" data-menus="mall|mall-setting|mall-setting-contract">消费保障</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=cash',this, '')" data-menus="mall|mall-setting|mall-setting-cash">收银系统</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/mall/self-pickup/list',this, '')" data-menus="mall|mall-setting|mall-setting-pickup">上门自提</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                商品
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=goods',this, '')" data-menus="mall|mall-goods|mall-goods-setting">商品设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/goods/default/list',this, '')" data-menus="mall|mall-goods|mall-goods-manage">商品管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/goods/cloud/list',this, '')" data-menus="mall|mall-goods|mall-cloud-goods-manage">云端产品库</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/goods/lib-goods/list',this, '')" data-menus="mall|mall-goods|mall-lib-goods-manage">本地商品库</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/goods/lib-category/list',this, '')" data-menus="mall|mall-goods|mall-lib-category">商品库商品分类</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/goods/category/list',this, '')" data-menus="mall|mall-goods|mall-goods-category">分类管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/goods/brand/list',this, '')" data-menus="mall|mall-goods|mall-goods-brand">品牌管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/goods/goods-type/list',this, '')" data-menus="mall|mall-goods|mall-goods-type-list">商品类型</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/goods/image-dir/list',this, '')" data-menus="mall|mall-goods|mall-goods-gallery">图片空间</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                交易
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=trade&tabs=trade,integral',this, '')" data-menus="mall|mall-trade|mall-trade-setting">交易设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/trade/order/list',this, '')" data-menus="mall|mall-trade|mall-trade-order">商品订单</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/dashboard/freebuy/list',this, '')" data-menus="mall|mall-trade|mall-freebuy-order">自由购订单</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/dashboard/reachbuy/list',this, '')" data-menus="mall|mall-trade|mall-reachbuy-order">堂内点餐订单</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/trade/refund/list',this, '')" data-menus="mall|mall-trade|mall-trade-refund">退款管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/trade/complaint/list',this, '')" data-menus="mall|mall-trade|mall-trade-complaint">投诉管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/trade/service/evaluate-buyer-list',this, '')" data-menus="mall|mall-trade|mall-trade-service">评价管理</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                店铺
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/shop-setting/index',this, '')" data-menus="mall|mall-shop|mall-shop-setting">开店设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/shop/index?is_supply=0',this, '')" data-menus="mall|mall-shop|mall-shop-list">入驻零售商</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/self-shop/index?is_supply=0',this, '')" data-menus="mall|mall-shop|mall-self-shop-list">自营零售商</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/recommend-shop/list',this, '')" data-menus="mall|mall-shop|mall-shop-recommend-shop">推荐开店</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/recommend-msg/list',this, '')" data-menus="mall|mall-shop|mall-recommend-shop-msg">预上线店铺留言</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/shop-credit/index',this, '')" data-menus="mall|mall-shop|mall-shop-credit">店铺信誉</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/shop-class/index',this, '')" data-menus="mall|mall-shop|mall-shop-class">店铺分类</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=desc_conform',this, '')" data-menus="mall|mall-shop|mall-shop-mark">店铺评分</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/collect/list',this, '')" data-menus="mall|mall-shop|mall-shop-collect">采集控制</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/store/list',this, '')" data-menus="mall|mall-shop|mall-shop-store">网点控制</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/logistics/list',this, '')" data-menus="mall|mall-shop|mall-shop-logistics">物流众包授权</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/cash-oauth/list.html',this, '')" data-menus="mall|mall-shop|mall-shop-cash-oauth">收银系统授权</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/shop/dada/list.html',this, '')" data-menus="mall|mall-shop|mall-shop-dada">达达配送授权</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                会员
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=user',this, '')" data-menus="mall|mall-user|mall-user-set">会员设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/user/user/list.html',this, '')" data-menus="mall|mall-user|mall-user-list">会员列表</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/user/user-rank/list',this, '')" data-menus="mall|mall-user|mall-user-rank-list">会员等级</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/user/shop/list',this, '')" data-menus="mall|mall-user|mall-user-shop-list">店铺会员等级</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                分销
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=distrib',this, '')" data-menus="mall|mall-distrib|distrib-set">分销返利设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/distrib/distrib-goods/list',this, '')" data-menus="mall|mall-distrib|distrib-goods-list">分销商品列表</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/distrib/distributor/list',this, '')" data-menus="mall|mall-distrib|distrib-distributor-list">分销商列表</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/distrib/distrib-order/list',this, '')" data-menus="mall|mall-distrib|distrib-order-list">分销订单列表</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                营销
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/dashboard/center/index',this, '')" data-menus="mall|mall-dashboard|mall-dashboard-center">营销中心</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('dashboard/shop-auth/index',this, '')" data-menus="mall|mall-dashboard|mall-dashboard-auth">店铺营销权限</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                文章
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/article/article-cat/list',this, '')" data-menus="mall|mall-article|mall-article-article-category">文章分类</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/article/article/list',this, '')" data-menus="mall|mall-article|mall-article-article-list">文章列表</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                装修
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup',this, '_blank')" data-menus="mall|mall-design|mall-design-setup">首页装修</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=news',this, '_blank')" data-menus="mall|mall-design|news-design-setup">资讯频道装修</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/design/navigation/list?nav_page=site&show_all=1',this, '')" data-menus="mall|mall-design|site-navigation">商城导航</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=login_bg',this, '')" data-menus="mall|mall-design|mall-personal-setting">个性化设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/design/nav-category/list',this, '')" data-menus="mall|mall-design|nav-category">分类导航</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/design/nav-banner/list',this, '')" data-menus="mall|mall-design|nav-focuspic">首页焦点图</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/mall/copyright-auth/list',this, '')" data-menus="mall|mall-design|mall-copyright-auth">资质导航</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/mall/links/list',this, '')" data-menus="mall|mall-design|mall-setting-links">友情链接</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        财务
                        <i class="more fa fa-angle-right"></i>
                    </a>
                    <ul class="sm-child">
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                资金
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/mall-account/list',this, '')" data-menus="finance|finance-capital|finance-mall-account-list">商城账户</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/user-account/list',this, '')" data-menus="finance|finance-capital|finance-user-account-list">会员账户</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/recharge/list',this, '')" data-menus="finance|finance-capital|finance-recharge-list">充值管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/deposit/list',this, '')" data-menus="finance|finance-capital|finance-deposit-list">提现管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/cashier/stats',this, '')" data-menus="finance|finance-capital|finance-stats">神码统计</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                账单
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/bill/system-shop-bill',this, '')" data-menus="finance|finance-bill|finance-shop-bill">店铺账单</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                统计
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/data-profiling/index',this, '')" data-menus="finance|finance-statistics|data-profiling-default">数据概况</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/shops-statistics/index',this, '')" data-menus="finance|finance-statistics|finance-shops-statistics">店铺统计</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/users-statistics/index',this, '')" data-menus="finance|finance-statistics|finance-users-statistics">会员统计</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/sales-analyse/index',this, '')" data-menus="finance|finance-statistics|finance-sales-analyse">销售分析</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/industry-analyse/index',this, '')" data-menus="finance|finance-statistics|finance-industry-analyse">行业分析</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/finance/finance-statistics/index',this, '')" data-menus="finance|finance-statistics|finance-sales-statistics">财务统计</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        资讯频道
                        <i class="more fa fa-angle-right"></i>
                    </a>
                    <ul class="sm-child">
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                装修
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">

                                <div class="clear"></div>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        APP
                        <i class="more fa fa-angle-right"></i>
                    </a>
                    <ul class="sm-child">
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                设置
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_setting',this, '')" data-menus="app|app-setting|app-setting-store">商店设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_guide',this, '')" data-menus="app|app-setting|app-setting-guide">引导图片</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/app/push-message/index',this, '')" data-menus="app|app-setting|app_push_message">消息推送</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_setting_basic',this, '')" data-menus="app|app-setting|mobile-setting-basic">基本设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_setting_login',this, '')" data-menus="app|app-setting|mobile-setting-login">登录设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_setting_index',this, '')" data-menus="app|app-setting|mobile-setting-index">首页设置</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                装修
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=app',this, '_blank')" data-menus="app|app-renovation|app-setting-template">首页装修</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                商家
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_seller_setting',this, '')" data-menus="app|app-seller|app-seller-setting">商家设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/app/seller-push-message/index',this, '')" data-menus="app|app-seller|app-seller-push-message">消息推送</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                网点
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=app_store_setting',this, '')" data-menus="app|app-store|app-store-setting">网点设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/app/store-push-message/index',this, '')" data-menus="app|app-store|app-store-push-message">消息推送</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        微商城
                        <i class="more fa fa-angle-right"></i>
                    </a>
                    <ul class="sm-child">
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                设置
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=mobile_setting_basic',this, '')" data-menus="weixin|mobile-setting|mobile-setting-basic">基本设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=mobile_setting_login',this, '')" data-menus="weixin|mobile-setting|mobile-setting-login">登录设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=mobile_setting_index',this, '')" data-menus="weixin|mobile-setting|mobile-setting-index">首页设置</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                微信
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=weixin',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-config">微信设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=weixin_bind',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin_bind">微信绑定</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/weixin/menu/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-menu">自定义菜单</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/weixin/keyword/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-keyword">关键词回复</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/weixin/user/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-user">粉丝管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/weixin/qcode/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-qcode">二维码管理</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/weixin/material/list',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-material">微信素材</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/weixin/push/index',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin-push">消息推送</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=weixin_poster',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin_poster">微信海报设置</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/system/config/index?group=weixin_programs',this, '')" data-menus="weixin|mobile-weixin|mobile-weixin_programs">微信小程序设置</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>
                        <li class="sm-child-li">
                            <a href="javascript:;">
                                装修
                                <i class="more fa fa-angle-right"></i>
                            </a>
                            <ul class="sm-three">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=m_site',this, '_blank')" data-menus="weixin|mobile-design|mobile-design-setup">首页装修</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=m_news',this, '_blank')" data-menus="weixin|mobile-design|mobile-news-design">资讯频道装修</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0);" onclick="openMenu('/design/tpl-setting/setup?page=m_goods',this, '_blank')" data-menus="weixin|mobile-design|mobile-goods-design">商品详情页装修</a>
                                </li>

                                <div class="clear"></div>
                            </ul>
                        </li>

                    </ul>
                </li>

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

<script src="/backend/js/main.js?v=1.2"></script>


<div id="attention" class="modal-body" style="display: none">
    <div class="f14 p-10">
        <p class="m-b-5">
            欢迎使用小京东+商城系统，请优先配置/开启
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
                <a class="fb" style="color: #FFFF00" href="http://seller.68dsw.com/index.html" target="_blank">前往卖家中心</a>
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
         'user_id': 'system_1',
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
            $("#workspace").attr("src", "/user/user/list.html");
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
</script>
</html>
