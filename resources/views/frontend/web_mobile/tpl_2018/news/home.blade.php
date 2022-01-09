@extends('layouts.news_layout')

@section('content')


    <!-- 引入头部文件 -->
    @include('frontend.web_mobile.modules.library.news_index_nav')

    <!-- 手机端资讯频道模板文件  -->
    <!--模块内容-->
    <!-- #tpl_region_start -->

    {!! $tplHtml !!}

    <!-- #tpl_region_end -->

    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        $().ready(function() {
            $.get("/index/information/is-weixin.html", function(result) {
                if (result.code == 0) {
                    var url = location.href.split('#')[0];

                    var share_url = "";

                    if (share_url == '') {
                        share_url = url;
                    }

                    $.ajax({
                        type: "GET",
                        url: "/site/index",
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
                                    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage']
                                });

                            }
                        }
                    });

                    // 微信JSSDK开发
                    wx.ready(function() {
                        // 分享给朋友
                        wx.onMenuShareAppMessage({
                            title: '', // 标题
                            desc: '{{ sysconf('site_name') }}', // 描述
                            imgUrl: '{{ get_oss_host() }}', // 分享的图标
                            link: share_url,
                            fail: function(res) {
                                alert(JSON.stringify(res));
                            }
                        });

                        // 分享到朋友圈
                        wx.onMenuShareTimeline({
                            title: '', // 标题
                            desc: '{{ sysconf('site_name') }}', // 描述
                            imgUrl: '{{ get_oss_host() }}', // 分享的图标
                            link: share_url,
                            fail: function(res) {
                                alert(JSON.stringify(res));
                            }
                        });
                    });
                }
            }, 'json');
        });
    </script>


    <script type="text/javascript">
        $().ready(function() {
            //图片缓载
            $.imgloading.loading();
        });
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <!-- 底部 _end-->

@stop