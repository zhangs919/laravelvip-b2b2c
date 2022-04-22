@extends('layouts.news_layout')

@section('content')


    <header>
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
            </div>
            <div class="header-middle">{{ $article['title'] }}</div>
            <div class="header-right">
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);"></a>
                    </div>
                </aside>
            </div>
        </div>
    </header>
    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>
    <div class="breadcrumb clearfix">
        <a href="/news.html" class="index">资讯首页</a>
        <span class="crumbs-arrow">&gt;</span>
        <a class="last" href="/news/list.html">资讯列表</a>
        <span class="crumbs-arrow">&gt;</span>
        <a class="last" href="/news/list/40.html">食材选配</a>
        <span class="crumbs-arrow">&gt;</span>
        <a class="last" href="/news/185.html">{{ $article['title'] }}</a>
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
            });
        });
    </script>

    <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
    <script type="text/javascript">
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
    </script>
    <!--底部菜单 start-->
    <script src="/js/custom_js.js?v=20180919"></script> <link rel="stylesheet" href="/css/custom_css.css?v=2.0"/>
    <div style="height: 48px; line-height: 48px; clear: both;"></div>
    <div class="footer-nav">









        <ul>


            <li class="">






                <!---->
                <a href="/index.html">
                    <i class=""  style="background-image: url(http://lanse31.oss-cn-beijing.aliyuncs.com/images/backend/gallery/2018/05/01/15251835008896.png);background-size: contain;background-repeat: no-repeat;">

                    </i>
                    <span>首页</span>
                </a>
                <!---->
            </li>



            <li class="">






                <!---->
                <a href="/category.html">
                    <i class=""  style="background-image: url(http://lanse31.oss-cn-beijing.aliyuncs.com/images/backend/gallery/2018/05/01/15251835205197.jpg);background-size: contain;background-repeat: no-repeat;">

                    </i>
                    <span>分类</span>
                </a>
                <!---->
            </li>



            <li class="">






                <!---->
                <a href="http://m.31dup.com/topic/12.html">
                    <i class=""  style="background-image: url(http://lanse31.oss-cn-beijing.aliyuncs.com/images/backend/gallery/2018/05/01/15251835858852.png);background-size: contain;background-repeat: no-repeat;">

                    </i>
                    <span>电商扶贫</span>
                </a>
                <!---->
            </li>



            <li class="">






                <!---->
                <a href="/cart.html">
                    <i class="cartbox"  style="background-image: url(http://lanse31.oss-cn-beijing.aliyuncs.com/images/backend/gallery/2018/05/01/15251835442950.jpg);background-size: contain;background-repeat: no-repeat;">

                        <em class="cart-num SZY-CART-COUNT">0</em>

                    </i>
                    <span>购物车</span>
                </a>
                <!---->
            </li>



            <li class="">






                <!---->
                <a href="/user.html">
                    <i class=""  style="background-image: url(http://lanse31.oss-cn-beijing.aliyuncs.com/images/backend/gallery/2018/05/01/15251835661642.jpg);background-size: contain;background-repeat: no-repeat;">

                    </i>
                    <span>我的</span>
                </a>
                <!---->
            </li>


        </ul>

    </div>


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