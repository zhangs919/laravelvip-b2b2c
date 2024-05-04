@extends('layouts.news_layout')

@section('content')


    <!-- 引入头部文件 -->
    @include('frontend.web_mobile.modules.library.news_index_nav')

    <div class="article-list-con" id="table_list">

        <div class="tablelist-append">


            @include('news.partials._list')


        </div>
        <!-- 分页 -->
        <div id="pagination" class="page">
            <div class="more-loader-spinner">
                <div class="is-loaded">
                    <div class="loaded-bg">我是有底线的</div>
                </div>
            </div>
            <script data-page-json="true" type="text" id="page_json">
                {!! $json_page !!}
            </script>
        </div>

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
            wx && wx.ready(function() {
                // 分享给朋友
                wx.onMenuShareAppMessage({
                    title: '{{ $seo_title }}', // 标题
                    desc: '{{ $seo_description }}', // 描述
                    imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                    link: share_url,
                    fail: function(res) {
                        alert(JSON.stringify(res));
                    }
                });
                // 分享到朋友圈
                wx.onMenuShareTimeline({
                    title: '{{ $seo_title }}', // 标题
                    desc: '{{ $seo_description }}', // 描述
                    imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                    link: share_url,
                    fail: function(res) {
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
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/iscroll-probe.min.js"></script>
    <script src="/js/index.js"></script>
    <script src="/js/news.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script>
        // 滚动加载数据
        $(window).on('scroll', function() {
            if ($(document).scrollTop() + $(window).height() > $(document).height() - 50) {
                $.pagemore();
            }
        });
        //
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#articleSearchForm").serializeJson()
            });
        });
        //
        $().ready(function() {
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
        //
    </script>

@stop
