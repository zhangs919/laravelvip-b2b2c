
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title ?? '演示站' }}</title>
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
    <meta name="is_webp" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="m_main_color" content="" />
    <link href="/assets/d2eace91/css/swiper/swiper.min.css?v=3.1" rel="stylesheet" position="1">
    <link href="/css/common.css?v=3.1" rel="stylesheet">
    <link href="/css/iconfont/iconfont.css?v=3.1" rel="stylesheet">
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=2" id="site_style"/>
    @endif
    <link href="/css/login.css?v=3.1" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=1.1"></script>
</head>
<body >
<!-- 内容 -->
<div id="index_content">
    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">手机安全登录</div>
            <div class="header-right">
                <!-- 控制展示更多按钮 -->
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
    <div class="qrcode-login-con">
        <i></i>
        <p class="error-des">二维码已失效</p>
        <p class="error-des">请返回电脑重新扫描</p>
        <a href="javascript:void(0)" class="rescan-btn" id="scanQRCode">重新扫描</a>
    </div>
    <script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    <script type="text/javascript">
        //
    </script>
</div>
{{--引入右上角菜单--}}
@include('layouts.partials.right_top_menu')

<script type="text/javascript">
    //
</script>
<!-- 积分提醒 -->
<!-- 消息提醒 -->
<script type="text/javascript">
    //
</script>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
<script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.history.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=1.1"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.1"></script>
<script src="/assets/d2eace91/js/szy.page.more.js?v=1.1"></script>
<script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js?v=1.1"></script>
<script src="/js/common.js?v=1.1"></script>
<script src="/js/jquery.fly.min.js?v=1.1"></script>
<script src="/js/placeholder.js?v=1.1"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
<script src="/assets/d2eace91/js/message/message.js?v=1.1"></script>
<script src="/assets/d2eace91/js/message/messageWS.js?v=1.1"></script>
<script>
    $().ready(function() {
        var appId = '{{ $wx_share_data['appId'] }}';
        var timestamp = '{{ $wx_share_data['timestamp'] }}';
        var nonceStr = '{{ $wx_share_data['nonceStr'] }}';
        var signature = '{{ $wx_share_data['signature'] }}';
        var errCode = '{{ $errCode }}';
        wx.config({
            debug: false,
            appId: appId,
            timestamp: timestamp,
            nonceStr: nonceStr,
            signature: signature,
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                "onMenuShareTimeline", "scanQRCode"]
        });
        wx.ready(function() {
            // 在这里调用 API
            $("#scanQRCode").click(function() {
                if (errCode != 0) {
                    $.msg("扫码功能需要去后台微信设置里填写正确的信息");
                    return false;
                }
                wx.scanQRCode({
                    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                    scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                    success: function(res) {
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
    });
    //
    $().ready(function() {
        // 缓载图片
        $.imgloading.loading();
    });
    //
    /**
     $().ready(function(){
        WS_AddUser({
            user_id: 'user_{{ $user_info['user_id'] ?? 0 }}',
            url: "{{ get_ws_url('4431') }}",
            type: "add_user"
        });
    });
     **/
    function currentUserId(){
        return '{{ $user_info['user_id'] ?? 0 }}';
    }
    function getIntegralName(){
        return '积分';
    }
    function addPoint(ob) {
        if (ob != null && ob != 'undefined') {
            if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == currentUserId()) {
                $.intergal({
                    point: ob.point,
                    name: getIntegralName()
                });
            }
        }
    }
    //
</script>
</body>
</html>
