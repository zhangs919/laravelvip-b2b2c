<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />

    <title>上门自提</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="wap-font-scale" content="no" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta name="is_frontend" content="yes" />
    <meta name="is_web_mobile" content="yes" />
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />
    <!-- #is_wabp_end -->
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="m_main_color" content="#ff0000" />
    <link rel="stylesheet" href="/css/common.css?v=201904182"/>
    <link rel="stylesheet" href="/css/iconfont/iconfont.css?v=201904182"/>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif
    <script src="/assets/d2eace91/js/jquery.js?v=201904182"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=201904182"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=201904182"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=201904182"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=201904182"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=201904182"></script>
    <script src="/js/common.js?v=201904182"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=201904182"></script>
    <script src="/js/swiper.jquery.min.js?v=201904182"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=201904182"></script>
    <!-- 飞入购物车 -->
    <script src="/js/jquery.fly.min.js?v=201904182"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=201904182"></script>


</head>
<body>
<!-- 内容 -->
<div id="index_content">
    <link rel="stylesheet" href="/css/goods.css?v=201904182"/>
    <!-- 自提点 _start -->
    <div id="goods_pickup" class="goods-pickup-layer show">
        <div class="content-info">
            <form method="post" onSubmit="return false;" action="">
                <div class="goods-pickup-header clearfix">
                    <div class="back-goods-info">
                        <a href="javascript:history.back(-1);" class="sb-back" title="返回"></a>
                    </div>
                    <div class="search-form">
                        <input class="search-input logistics-search-input" placeholder="请输入自提点名称/所在地" type="search" name="logistics-search" onkeydown='logistics(event);' />
                        <span class="search-icon"></span>
                    </div>
                    <span class="search-btn js-search-btn color" data-shop_id='{{ $shop_id }}'>搜索</span>
                </div>
            </form>

            <ul class="logistics-store-list">

                @foreach($pickup as $v)
                <!-- -->
                <li class="logistics-item clearfix">
                    <h3>自提点名称：{{ $v['pickup_name'] }}</h3>
                    <div class="logistics-inner">
                        <div class="logistics-img">
                            <img src="{{ get_image_url($v['pickup_images']) }}">
                        </div>
                        <a href="javascript:void(0)" class="logistics-info SZY-MAP-NAV" data-lat="{{ $v['address_lat'] }}" data-lng="{{ $v['address_lng'] }}" data-title="{{ $v['pickup_name'] }}" data-content="{{ $v['pickup_address'] }}">
                            <p class="logistics-address">{{ $v['pickup_address'] }}</p>

                            <p class="pickup-desc">商家推荐：{!! $v['pickup_desc'] !!}</p>

                        </a>

                        <a class="logistics-phone" href="tel:{{ $v['pickup_tel'] }}"></a>

                    </div>
                </li>
                @endforeach

            </ul>

        </div>
    </div>
    <script type="text/javascript">
        $(".search-btn").click(function() {
            var keyword = $(".logistics-search-input").val();
            var shop_id = $(this).data('shop_id');
            $.loading.start();
            $.get("/pickup/" + shop_id + ".html", {
                "keyword": keyword,
            }, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    $(".logistics-store-list").replaceWith(result.data);

                }
            }, "json");
        });
        function logistics(e) {
            if (e.keyCode == 13) {
                var keyword = $(".logistics-search-input").val();
                var shop_id = $('.logistics-search-input').data('shop_id');
                $.post("/goods/search-pickup.html", {
                    "keyword": keyword,
                    "shop_id": shop_id
                }, function(result) {
                    if (result.code == 0) {
                        $(".logistics-store-list").html(result.data);

                    }
                }, "json");
            }
        }
    </script>

    <script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    <script type="text/javascript">
        //一键导航
        var mapclicked = false;
        $('body').on('click', '.SZY-MAP-NAV', function() {
            var shoplat = $(this).data('lat');
            var shoplng = $(this).data('lng');
            var title = $(this).data('title');
            var content = $(this).data('content');
            if (mapclicked == true) {
                return;
            }
            mapclicked = true;
            if (isWeiXin()) {
                $.loading.start();
                var url = location.href.split('#')[0];
                $.ajax({
                    url: "/site/get-weixinconfig.html",
                    type:"POST",
                    data: {
                        url: url
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0) {
                            wx.config({
                                debug: false,
                                appId: result.data.appId,
                                timestamp: result.data.timestamp,
                                nonceStr: result.data.nonceStr,
                                signature: result.data.signature,
                                jsApiList: [
                                    // 所有要调用的 API 都要加到这个列表中
                                    'openLocation', 'getLocation']
                            });
                            wx.openLocation({
                                latitude: shoplat, // 纬度，浮点数，范围为90 ~ -90
                                longitude: shoplng, // 经度，浮点数，范围为180 ~ -180。
                                name: title, // 位置名
                                address: content, // 地址详情说明
                                scale: 15, // 地图缩放级别,整形值,范围从1~28。默认为最大
                                infoUrl: '', // 在查看位置界面底部显示的超链接,可点击跳转
                                cbCompleteFun: function() {
                                    $.loading.stop();
                                }
                            });
                        } else {
                            if (window.__wxjs_environment !== 'miniprogram') {

                                $.go('/index/information/amap?dest=' + shoplng + ',' + shoplat + '&title=' + title);
                            } else {
                                $.msg("导航功能需要去后台微信设置里填写正确的信息");
                            }
                        }
                    }
                });
            } else {
                $.go('/index/information/amap?dest=' + shoplng + ',' + shoplat + '&title=' + title);
            }
            setTimeout(function() {
                mapclicked = false;
            }, 1000);
        });
    </script>
    <!-- 自提点 _end --></div>
{{--引入右上角菜单--}}
@include('layouts.partials.right_top_menu')
<!-- 底部 _end-->
<script type="text/javascript">
    $().ready(function() {
        // 缓载图片
        $.imgloading.loading();
    });
</script>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
</body>
</html>
