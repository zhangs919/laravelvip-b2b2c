@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/swiper.min.css" rel="stylesheet">
    <link href="/css/brand.css" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')
    <!-- 内容 -->
    <div id="index_content">
        <div class="sort-menu ">
            <ul class="all-brands swiper-wrapper">
                <li class="active swiper-slide"><a href="javascript:void(0);">全部品牌</a></li>
                @foreach($cat_list as $v)
                    <li class="swiper-slide"><a href="javascript:void(0);">{{ $v['cat_name'] }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="brand-floor-con">
            @foreach($cat_list as $v)
                <div class="brand-floor" id="{{ $v['cat_id'] }}">
                    <a href="{{ route('mobile_goods_list', ['cat_id'=>$v['cat_id']]) }}" class="brand-floor-title">{{ $v['cat_name'] }}</a>
                    <ul>
                        @foreach($v['brand_list'] as $brand)
                            <li>
                                <a href="{{ route('mobile_goods_list', ['filter_str' => $v['cat_id'].'-0-0-0-0-0-0-0-0-0-0-'.$brand['brand_id']]) }}" class="brand-con">
                                    <div class="brand-img">
                                        <img src="{{ $brand['brand_logo'] }}">
                                    </div>
                                    <div class="brand-name">{{ $brand['brand_name'] }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <script type="text/javascript">
            (function(){
                var url = location.href;
                if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {
                    if (url.indexOf("?") == -1) {
                        url += "?user_id=";
                    } else {
                        url += "&user_id=";
                    }
                } else {
                    url = location.href.split('#')[0];
                }
                var share_url = "";
                if (share_url == '') {
                    share_url = url;
                }
                if (window.__wxjs_environment !== 'miniprogram') {
                    window.history.replaceState(null, document.title, url);
                }
            })();
        </script>
        <script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
        <script type="text/javascript">
            $().ready(function() {
                // $("body").append('<script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"><\/script>');
                var url = location.href;
                if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {
                    if (url.indexOf("?") == -1) {
                        url += "?user_id=";
                    } else {
                        url += "&user_id=";
                    }
                } else {
                    url = location.href.split('#')[0];
                }
                var share_url = "";
                if (share_url == '') {
                    share_url = url;
                }
                //
                if (isWeiXin()) {
                    $.ajax({
                        url: "/site/get-weixinconfig.html",
                        type: "POST",
                        dataType: "json",
                        data: {
                            url: url
                        },
                        success: function(result) {
                            if (result.code == 0) {
                                wx.config({
                                    debug: false,
                                    appId: result.data.appId,
                                    timestamp: result.data.timestamp,
                                    nonceStr: result.data.nonceStr,
                                    signature: result.data.signature,
									jsApiList: result.data.jsApiList,
                                    // jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'wx-open-launch-weapp'],
                                    // openTagList: ['wx-open-launch-weapp']
                                });
                            }
                        }
                    });
                }
                //
                // 微信JSSDK开发
                wx.ready(function() {
                    // 分享给朋友
                    wx.onMenuShareAppMessage({
                        title: '{{ $seo_title }}', // 标题
                        desc: '{{ $seo_description }}', // 描述
                        imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                        link: url,
                        fail: function (res) {
                            alert(JSON.stringify(res));
                        }
                    });
                    // 分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: '{{ $seo_title }}', // 标题
                        desc: '{{ $seo_description }}', // 描述
                        imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                        link: url,
                        fail: function (res) {
                            alert(JSON.stringify(res));
                        }
                    });
                    // window.history.replaceState(null, document.title, url);
                });
            });
        </script>
        <script type="text/javascript">
            $().ready(function() {
                setTimeout(function() {
                    if (window.__wxjs_environment === 'miniprogram') {
                        var share_info = {
                            title: '{{ $seo_title }}',
                            imgUrl: '{{ get_image_url($seo_image) }}'
                        };
                        wx.miniProgram.postMessage({
                            data: share_info
                        });
                    }
                }, 3000);
            });
        </script>
        <!--底部菜单 start-->
        {{--引入底部菜单--}}
        @include('frontend.web_mobile.modules.library.site_footer_menu')

    </div>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 底部 _end-->
    <script type="text/javascript">
        //
    </script>
    <!-- 积分提醒 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/js/brand.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            // 缓载图片
            $.imgloading.loading();
        });
        //
        $().ready(function () {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('7272') }}",
                type: "add_point_set"
            });
        });

        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        //
    </script>

@stop
