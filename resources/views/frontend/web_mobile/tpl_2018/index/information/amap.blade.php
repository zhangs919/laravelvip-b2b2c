<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="wap-font-scale" content="no" />
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />

    <meta name="is_webp" content="yes" />
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
    <header>
        <div class="header">
            <div class="header-left">
                <a class="sb-back" style="display: none" href="javascript:history.back(-1)" title="返回"></a>
            </div>
            <div class="header-middle">{{ $title }}</div>
            <div class="header-right">
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0)"></a>
                    </div>
                </aside>
            </div>
        </div>
    </header>
    <style type="text/css">
        .layer-div-position {
            position: fixed;
            left: 5px;
            top: 51px;
            height: 60px;
            width: 60px;
            z-index: 2;
        }
    </style>
    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>
    <iframe src="" id="mapiframe" name="mapiframe" frameborder="0" width="100%"></iframe>
    <script type="text/javascript">
        var domain = "http://";
        if (sessionStorage.geolocation) {
            var data = $.parseJSON(sessionStorage.geolocation);
            $('#mapiframe').attr('src', domain + 'm.amap.com/navigation/carmap/saddr=' + data.lng + ',' + data.lat + ',我的位置&daddr={{ $dest }},{{ $title }}&sort=dist');
        } else {
            $('#mapiframe').attr('src', domain + 'm.amap.com/navi/?map&dest={{ $dest }}&destName={{ $title }}&naviBy=car&key={{ sysconf('amap_js_key') }}');
        }
    </script>
    <script type="text/javascript">
        var ifm = document.getElementById("mapiframe");
        ifm.height = document.documentElement.clientHeight - 50;
        if (!/*@cc_on!@*/0) { //如果不是IE，IE的条件注释
            ifm.onload = function() {
                var appendHtml = '<div class="layer-div-position"></div>';
                $('body').append(appendHtml);
            };
        } else {
            ifm.onreadystatechange = function() { // IE下的节点都有onreadystatechange这个事件
                if (iframe.readyState == "complete") {
                    var appendHtml = '<div class="layer-div-position"></div>';
                    $('body').append(appendHtml);
                }
            };
        }
        $('body').on('click', '.layer-div-position', function() {
            window.history.back(-1);
        });
    </script>
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