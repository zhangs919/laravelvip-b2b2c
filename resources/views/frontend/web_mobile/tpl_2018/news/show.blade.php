@extends('layouts.news_layout')

@section('content')
    <header>
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">{{ $article['title'] }}</div>
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
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <div class="breadcrumb clearfix">
        <a href="/news.html" class="index">资讯首页</a>
        <span class="crumbs-arrow">&gt;</span>
        <a class="last" href="/news/list/{{ $cat['cat_id'] }}.html">{{ $cat['cat_name'] }}</a>
        <span class="crumbs-arrow">&gt;</span>
        <a class="last" href="/news/{{ $article['article_id'] }}.html">{{ $article['title'] }}</a>
    </div>
    <div class="article-info">
        <div class="article-detail">
            {!! $article['content'] !!}
        </div>
    </div>
    <div class="info-page">
        @if(!empty($article_pre))
            <a href="{{ route('mobile_show_news', ['article_id'=>$article_pre['article_id']]) }}" class="pre">上一篇</a>
        @endif
        @if(!empty($article_next))
            <a href="{{ route('mobile_show_news', ['article_id'=>$article_next['article_id']]) }}" class="next">下一篇</a>
        @endif
    </div>
    <!-- 分享 -->
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
    <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
    <script type="text/javascript">
        //
    </script>
    <!--底部菜单 start-->
    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')

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
        $().ready(function(){
            //首先将#back-to-top隐藏
            //$("#back-to-top").addClass('hide');
            //当滚动条的位置处于距顶部1000像素以下时，跳转链接出现，否则消失
            $(function ()
            {
                $(window).scroll(function()
                {
                    if ($(window).scrollTop()>600)
                    {
                        $('body').find(".back-to-top").removeClass('hide');
                    }
                    else
                    {
                        $('body').find(".back-to-top").addClass('hide');
                    }
                });
                //当点击跳转链接后，回到页面顶部位置
                $(".back-to-top").click(function()
                {
                    $('body,html').animate(
                        {
                            scrollTop:0
                        }
                        ,600);
                    return false;
                });
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
