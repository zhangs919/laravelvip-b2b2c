<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>{{ sysconf('site_name') }}</title>
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="wap-font-scale" content="no" />
    <meta name="Keywords" content="{{ sysconf('site_name') }}" />
    <meta name="Description" content="{{ sysconf('site_name') }}" />

    <meta name="is_webp" content="@if(sysconf('is_webp')){{ 'yes' }}@else{{ 'no' }}@endif" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/mobile/css/common.css?v=20180702"/>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/mobile/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/mobile/css/color-style.css?v=1.2" id="site_style"/>
    @endif
    <!--整站改色 _end-->
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/mobile/js/common.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
    <!-- 飞入购物车 -->
    <script src="/mobile/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
</head>
<body>
<!-- 内容 -->
<div id="index_content">
    <link rel="stylesheet" href="/mobile/css/common.css?v=20180702"/>
    <link rel="stylesheet" href="/mobile/css/error.css?v=20180702"/>
    <header>
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
            </div>
            <div class="header-middle">系统提示</div>
            <div class="header-right"></div>
        </div>
    </header>
    <div class="no-data-div">
        <div class="error-tip-img"></div>
        <dl>

            {{--手机端暂不支持帮助中心--}}
            <dt>@if($exception->getMessage() != ''){{ $exception->getMessage()}}@else页面未找到。@endif</dt>

        </dl>
        <a href="javascript:window.history.go(-1);" class="no-data-btn">返回上一页</a>
    </div>

    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')

</div>
<div class="show-menu-info" id="menu">
    <ul>
        <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
        <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
        <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
        <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
    </ul>
</div>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
<!-- 底部 _end-->
<script type="text/javascript">
    $().ready(function(){
        // 缓载图片
        $.imgloading.loading();
    });
</script>
</body>
</html>