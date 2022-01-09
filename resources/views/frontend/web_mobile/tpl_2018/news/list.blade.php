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

            </div>
            <script data-page-json="true" type="text" id="page_json">
                {!! $json_page !!}
            </script>
        </div>

    </div>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        $().ready(function() {
            var url = location.href.split('#')[0];

            var share_url = "";

            if (share_url == '') {
                share_url = url;
            }

            $.ajax({
                type: "GET",
                url: "/index/information/get-weixinconfig.html",
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
                    title: '三一良品-农村电商平台-农村网购、正品价优、物流直达村委会！', // 标题
                    desc: '这些健康的文章正是您所需要的！', // 描述
                    imgUrl: 'http://lanse31.oss-cn-beijing.aliyuncs.com/images/system/config/seo_index/seo_index_image_0.jpg', // 分享的图标
                    link: share_url,
                    fail: function(res) {
                        alert(JSON.stringify(res));
                    }
                });

                // 分享到朋友圈
                wx.onMenuShareTimeline({
                    title: '三一良品-农村电商平台-农村网购、正品价优、物流直达村委会！', // 标题
                    desc: '这些健康的文章正是您所需要的！', // 描述
                    imgUrl: 'http://lanse31.oss-cn-beijing.aliyuncs.com/images/system/config/seo_index/seo_index_image_0.jpg', // 分享的图标
                    link: share_url,
                    fail: function(res) {
                        alert(JSON.stringify(res));
                    }
                });
            });
        });
    </script>

    <!--  滚动加载 -->
    <script src="/assets/d2eace91/js/szy.page.more.js?v=20180919"></script>
    <script type="text/javascript">
        // 滚动加载数据
        $(window).on('scroll', function() {
            if ($(document).scrollTop() + $(window).height() > $(document).height() - 10) {
                $.pagemore();
            }
        });
    </script>
    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#articleSearchForm").serializeJson()
            });
        });
    </script>


    <script type="text/javascript">
        $().ready(function() {
            //图片缓载
            $.imgloading.loading();

            $('body').find(".add-cart").click(function(event) {
                var goods_id = $(this).data("goods_id");
                var image_url = $(this).data("image_url");
                $.cart.add(goods_id, 1, {
                    is_sku: false,
                    event: event,
                    image_url: image_url,
                    callback: function(){
                        var attr_list = $('.attr-list').height();
                        $('.attr-list').css({
                            "overflow":"hidden"
                        });
                        if(attr_list >= 200){
                            $('.attr-list').addClass("attr-list-border");
                            $('.attr-list').css({
                                "overflow-y":"auto"
                            });
                        }
                    }
                });
                return false;
            });

        });
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <!-- 底部 _end-->

@stop