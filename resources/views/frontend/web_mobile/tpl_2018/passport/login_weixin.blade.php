<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="wap-font-scale" content="no">
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!--登录页css-->
    <!--登录页css-->
    <link href="/css/iconfont/iconfont.css?v=20201012" rel="stylesheet">
    <link href="/css/common.css?v=20201012" rel="stylesheet">
    <link href="/css/login.css?v=20201012" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=20201016"></script>
</head>
<body class="con-bg">
<!-- 微信登录 -->
<div class="weixin-login-con">
    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">登录</div>
            <div class="header-right">
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);">
                            <i class="iconfont">&#xe6cd;</i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </header>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <div class="weixin-login-text">
        <span>微信一键登录，更方便</span>
    </div>
    <div class="weixin-login-logo">
        <img src="/images/weixin_other_login.png">
    </div>
    <div class="weixin-login-bottom">
        <a href="/login/website-login?type=mobile_weixin" class="btn-submit">
            <i></i>
            微信登录
        </a>
    </div>
    <!--其他登录方式-->
    <div class="other-login-con">
        <p class="other-login-dese last-p">或选择以下方式登录</p>
        <div class="other-login-list ub">
            <a href="/login/website-login?type=qq" class="ub-f1 qq-login">
                <span class="qq"></span>
                <em>QQ</em>
            </a>
            <a href="/login.html?type=mobile" class="ub-f1">
                <span class="user-name"></span>
                <em>账号密码</em>
            </a>
        </div>
    </div>
</div>
<script src="/js/app.frontend.mobile.min.js?v=20201016"></script>
<script src="/js/login.js?v=20201016"></script>
<script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js?v=20201016"></script>

<script>
    $().ready(function() {
        // 清除模板缓存
        sessionStorageTemplateClear();
    });
    //
</script>
</body>
<script type="text/javascript">
    //
</script>
</html>
