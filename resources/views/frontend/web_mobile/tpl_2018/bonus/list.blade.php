@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/group_buy.css" rel="stylesheet">
    <link href="/css/bonus_message.css?v=20201012" rel="stylesheet">

@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')

    <!---团购首页头部--->
    <header>
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">
                红包集市
            </div>
            <div class="header-right">
                <!-- 控制展示更多按钮 -->
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0)">
                            <i class="iconfont">&#xe6cd;</i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </header>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')


	@if(!empty($slide_list))
		<!-- banner模块 _star -->
		<!-- banner _star -->
		<div class="swiper-container">
			<div class="swiper-wrapper">
				@foreach($slide_list as $item)
					<div class="swiper-slide">
						<a href="{{ $item['link'] ?? '#' }}">
							<img src="{{ get_image_url($item['img']) }}">
						</a>
					</div>
				@endforeach
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<script type="text/javascript">
			//
		</script>
		<!-- banner模块 _end -->
	@endif

    <!-- 活动展示 _star -->
	@if($guide_ad)
		<!-- 引导广告图 -->
		<div class="guide-pic-box">
			<img src="{{ $guide_ad }}">
			<!-- -->
		</div>
	@endif

    @include('bonus.partials._list')

    <!-- 分享 -->
    <script type="text/javascript">
        (function() {
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
            /*  不明白为什么这么写   如果有问题在处理  20200810sunlizhi
            if (window.__wxjs_environment !== 'miniprogram') {
                window.history.replaceState(null, document.title, url);
            }
            */
        })();
    </script>
    <script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    <script type="text/javascript">
        $().ready(function() {
            // $("body").append('<script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"><\/script>');
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
            console.log(share_url);
            console.log("");
            console.log("------------------------")
            //
            if (isWeiXin()) {
                $.ajax({
                    type: "GET",
                    url: "/site/get-weixinconfig.html",
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
                    title: '{{ $share['seo_title'] }}', // 标题
                    desc: '{{ $share['seo_discription'] }}', // 描述
                    imgUrl: '{{ get_image_url($share['seo_image'], 'no_default') }}', // 分享的图标
                    link: share_url,
                    fail: function(res) {
                        alert(JSON.stringify(res));
                    }
                });
                // 分享到朋友圈
                wx.onMenuShareTimeline({
                    title: '{{ $share['seo_title'] }}', // 标题
                    desc: '{{ $share['seo_discription'] }}', // 描述
                    imgUrl: '{{ get_image_url($share['seo_image'], 'no_default') }}', // 分享的图标
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
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <!-- 活动展示 _end -->
    <!-- 底部 _star-->
    <div  class="footer-nav-blank"></div>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/min/js/core.min.js?v=20201016"></script>
    <script src="/js/app.frontend.mobile.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script>
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "227";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "230";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "229";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "228";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "254";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "251";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "250";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "249";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "248";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "244";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "243";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "242";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604308694000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function(event) {
                }
            });
        });
        //
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
            bonusCountdown();
            $('body').on('click', '.send', function() {
                var bonus_id = $(this).data('bonus_id');
                var shop_id = "0";
                $.loading.start();
                $.post("/activity/bonus/index.html", {
                    bonus_id: bonus_id
                }, function(result) {
                    if (result.code == 0) {
                        tablelist.load();
                        $.msg(result.message, {
                            time: 3000
                        });
                    } else {
                        $.msg(result.message, {
                            time: 3000
                        });
                    }
                }, 'json').always(function() {
                    $.loading.stop();
                });
            });
        });
        function bonusCountdown() {
            $('.bonus-countdown').each(function() {
                var time = $(this).data('time');
                $(this).countdown({
                    time: time,
                    leadingZero: true,
                    htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                    onComplete: function(event) {
                    }
                });
                $(this).removeClass('bonus-countdown');
            });
        }
        //
        // 滚动加载数据
        $(window).on('scroll', function() {
            if (($(document).scrollTop() + $(window).height()) > ($(document).height() - 50)) {
                if ($.isFunction($.pagemore)) {
                    $.pagemore({
                        callback: function(result) {
                            bonusCountdown();
                            $.imgloading.loading();
                        }
                    });
                }
            }
        });
        //
        var swiper;
        $(function(){
            swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                loop : true,
                paginationClickable: true,
                autoplay: 3000,
                autoplayDisableOnInteraction: false
            })
        });
        //
        $().ready(function() {
            updateEndTime();
        });
        //倒计时函数
        function updateEndTime() {
            var date = new Date();
            var time = date.getTime(); //当前时间距1970年1月1日之间的毫秒数
            $(".settime").each(function(i) {
                var endDate = this.getAttribute("endTime"); //结束时间字符串
                //转换为时间日期类型
                var endDate1 = eval('new Date(' + endDate.replace(/\d+(?=-[^-]+$)/, function(a) {
                    return parseInt(a, 10) - 1;
                }).match(/\d+/g) + ')');
                var endTime = endDate1.getTime(); //结束时间毫秒数
                var lag = (endTime - time) / 1000; //当前时间和结束时间之间的秒数
                if (lag > 0) {
                    var second = Math.floor(lag % 60);
                    var minite = Math.floor((lag / 60) % 60);
                    var hour = Math.floor((lag / 3600) % 24);
                    var day = Math.floor((lag / 3600) / 24);
                    $(this).html(day + "天" + hour + "时" + minite + "分" + second + "秒");
                } else
                    $(this).html("团购已经结束啦！");
            });
            setTimeout("updateEndTime()", 1000);
        }
        //
        $().ready(function() {
        })
        //
    </script>

@stop
