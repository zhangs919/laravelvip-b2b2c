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
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/css/common.css?v=20180702"/>
    <link rel="stylesheet" href="/css/swiper.min.css?v=20180702"/>
    <link rel="stylesheet" href="/css/topic_activity.css?v=20180702"/>
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/js/common.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
    <script src="/js/swiper.jquery.min.js?v=20180813"></script>
    <script src="/js/index.js?v=20180813"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif
</head>
<body>
<!-- 内容 -->


<script src="http://webapi.amap.com/maps?v=1.4.6&key={{ sysconf('amap_js_key') }}"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="/assets/d2eace91/js/geolocation/amap.js?v=20180813"></script>
<div class="topic-box" {!! $bgStyle !!}>
    <!-- #tpl_region_start -->

    {!! $tplHtml !!}

    <!-- #tpl_region_end -->
</div>



<!--底部菜单 start-->

<!-- 扫码设置 -->
<!-- 如果微信浏览器开启扫码功能 -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    //获取微信配置信息
    var url = location.href.split('#')[0];
    $.get('/index/information/is-weixin.html', function(result) {
        if (result.code == 0) {
            if ($('.SZY-SCANQRCODE-LEFT')) {
                $('.SZY-SCANQRCODE-LEFT').html('<a href="javascript:void(0)" class="SZY-SCAN-QR-CODE"><em class="top-icon"></em><span class="bottom-nav">扫码</span></a>');
            }
            if ($('.SZY-SCANQRCODE-RIGHT')) {
                $('.SZY-SCANQRCODE-RIGHT').html('<a href="javascript:void(0)" class="SZY-SCAN-QR-CODE"><em class="top-icon"></em><span class="bottom-nav">扫码</span></a>');
            }

            $.ajax({
                url: "/index/information/get-weixinconfig.html",
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
                                "onMenuShareTimeline", "onMenuShareAppMessage", "scanQRCode"]
                        });

                        wx.ready(function() {
                            // 分享给朋友
                            wx.onMenuShareAppMessage({
                                title: '{{ $topic_info->topic_name }}', // 标题
                                desc: '{{ $topic_info->describe }}', // 描述
                                imgUrl: '{{ get_image_url($topic_info->share_image) }}', // 分享的图标
                                link: url,
                                fail: function(res) {
                                    alert(JSON.stringify(res));
                                }
                            });

                            // 分享到朋友圈
                            wx.onMenuShareTimeline({
                                title: '{{ $topic_info->topic_name }}', // 标题
                                desc: '{{ $topic_info->describe }}', // 描述
                                imgUrl: '{{ get_image_url($topic_info->share_image) }}', // 分享的图标
                                link: url,
                                fail: function(res) {
                                    alert(JSON.stringify(res));
                                }
                            });
                            // 在这里调用 API
                            $(".SZY-SCAN-QR-CODE").click(function() {
                                if (result.errCode != 0) {
                                    $.msg("扫码功能需要去后台微信设置里填写正确的信息");
                                    return false;
                                }
                                wx.scanQRCode({
                                    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                                    scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                                    success: function(res) {
                                        //alert(JSON.stringify(res));
                                        //过滤结果,非本站的二维码不可以扫描
                                        $.get('/index/information/go', {
                                            url: res.resultStr
                                        }, function(result) {
                                            if (result.code == 0) {
                                                $.go(result.data.url);
                                            } else {
                                                $.msg(result.message);
                                            }
                                        }, 'json');
                                    }
                                });
                            });
                        });
                    }
                }
            });

        } else {
            if ($('.SZY-SCANQRCODE-LEFT')) {
                $('.SZY-SCANQRCODE-LEFT').html('<a href="/category.html"><em class="top-left"></em><span class="bottom-nav">分类</span></a>');
            }
            if ($('.SZY-SCANQRCODE-RIGHT')) {
                $('.SZY-SCANQRCODE-RIGHT').html('');
            }
            $(".SZY-SCAN-QR-CODE").click(function() {
                $.msg('请在微信下使用扫码');
            });
        }
    }, 'json');
</script>

<!-- 第三方流量统计 -->
<div style="display: none;">
    {{--第三方统计代码--}}
    {!! sysconf('stats_code_wap') !!}
</div>
<!-- 底部 _end-->
<!-- 飞入购物车 -->
<script src="/js/jquery.fly.min.js?v=20180813"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>

<script type="text/javascript">
    $().ready(function(){
        // 缓载图片
        $.imgloading.loading();
    });
    //图片预加载
    document.onreadystatechange = function() {
        if (document.readyState == "complete") {
            $.imgloading.setting({
                threshold: 1000
            });
        }
    }
</script>
<div class="show-menu-info" id="menu">
    <ul>
        <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
        <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
        <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
        <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
    </ul>
</div>
</body>
</html>