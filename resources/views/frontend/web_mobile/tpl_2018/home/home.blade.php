@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/template.css?v=2" rel="stylesheet">
    <link href="/css/index.css?v=2" rel="stylesheet">
    <link href="/css/swiper.min.css" rel="stylesheet">
    <link href="/css/online.css" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')

    <!-- 站点 -->
    <div class="app-download" @if(!sysconf('m_app_download'))style="display: none"@endif>
        <div class="app-download-tip-box">
            <div class="app-download-tip">
                <a href="javascript:void(0);" class="colse-download-tip">
                    <i></i>
                </a>
                <div class="tip-info">

                    <img src="{{ get_image_url(sysconf('m_app_icon')) }}">

                    <div class="tip-text">
                        <h4>享受更加流畅的商城体验</h4>
                        <p>赶快下载{{ sysconf('site_name') }}APP</p>
                    </div>
                </div>
                <a class="download-btn" href="#" data-ios="{{ sysconf('app_ios_update_url') }}"
                   data-android="{{ sysconf('app_android_update_url') }}">立即下载</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //
    </script>

    {{--判断站点功能是否开启 todo 后期还需判断是否存在可用站点--}}
    @if(sysconf('site_open'))
        <header class="header-con header-con2">
            <div class="header">
                <div class="header-content">
                    <!--站点 start-->
                    <div class="SZY-SUBSITE">
                        <a class="city" href="/subsite/change.html">选择站点</a>
                    </div>
                    <div class="box-search">
                        <a class="react" href="javascript:void(0)">
                            <i class="icon-search iconfont">&#xe600;</i>
                            <span class="single-line"> 请输入要搜索的关键字 </span>
                        </a>
                    </div>
                    <div class="nav-wap-right">
                        <div class="qrcode SZY-SCANQRCODE-RIGHT"></div>
                        <a href="/user/message/internal.html">
                            <em class="top-right">
                                <i class="message-num SZY-INTERNAL-COUNT">4</i>
                            </em>
                            <span class="bottom-nav">消息</span>
                        </a>
                    </div>
                    <!--站点 end-->
                </div>
            </div>
            <div style="height: 50px; line-height: 50px;" id="bottom_div"></div>
        </header>
    @else
        <header class="header-con header-con2">
            <div class="header">
                <div class="header-content">
                    <div class="qrcode SZY-SCANQRCODE-LEFT"><a href="/category.html"><em class="top-left"></em><span
                                    class="bottom-nav">分类</span></a></div>
                    <div class="box-search">
                        <a class="react" href="javascript:void(0)">
                            <i class="icon-search iconfont"></i>
                            <span class="single-line">搜索商品/店铺</span>
                        </a>
                    </div>
                    <div class="nav-wap-right">
                        <a href="/user/message/internal.html">
                            <em class="top-right">
                                <i class="message-num SZY-INTERNAL-COUNT">0</i>
                            </em>
                            <span class="bottom-nav">消息</span>
                        </a>
                    </div>
                </div>
            </div>
            <div style="height: 50px; line-height: 50px;" id="bottom_div"></div>
        </header>
    @endif
    <!--搜索内容start-->
    <section id="search_content">
        <div class="search-header">
            <div class="search-left">
                <a href="javascript:void(0)" class="sb-back" title="返回"></a>
            </div>
            <div class="search-middle">
                <div class="search-info">
                    <div class="search-type">
                        <div class="search-type-txt">商品</div>
                        <div class="search-type-info">
                            <ul class="search-type-ul">
                                <li id="select_goods">
                                    <i class="iconfont">&#xe63f;</i>
                                    商品
                                </li>
                                <li id="select_shop">
                                    <i class="iconfont">&#xe601;</i>
                                    店铺
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-box">
                        <form id="headerSearchForm" method="get" name="" action="/search.html" onSubmit="">
                            <input type='hidden' name='type' id="searchtype" value="">
                            <input type="text" class="text" id="keyword" name="keyword" tabindex="9" autocomplete="off"
                                   data-searchwords="榨汁机" data-placeholder="榨出营养,喝出健康" placeholder="榨出营养,喝出健康" value="">
                            <a href="javascript:void(0)" class="submit"></a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="search-right">
                <a href="javascript:void(0)" class="clear_input submit" style="display: block;">搜索</a>
            </div>
        </div>
        <div class="search-con">
            <div id="search_goods">
                <section class="hot-search">
                    <h3>
                        历史记录
                        <i class="delete-btn iconfont" id="clear">&#xe61b;</i>
                    </h3>
                    <ul class="history-results SZY-SEARCH-RECORD">
                    </ul>
                </section>
            </div>
            <!---热门搜索热搜词显示--->
            <section class="recently-search">
                <h3>热门搜索</h3>

                <ul>

                    <li>
                        <a href="search.html?keyword=乐融沃" title="乐融沃">乐融沃</a>
                    </li>

                </ul>

            </section>
        </div>
        <a class="colse-search-btn" href="javascript:void(0)"></a>
    </section>
    <script type="text/javascript">
        //
    </script><!--搜索内容end-->
    <script type="text/javascript">
        // 头部导航
        if ($(window).scrollTop() > 100 || $('body').hasClass('visibly')) {
            $(".header-con .header,.header-con .header .header-content .box-search, .app-download-tip-box").addClass("current");
        } else {
            $(".header-con .header,.app-download-tip-box").removeClass("current");
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() > 100 || $('body').hasClass('visibly')) {
                $(".header-con .header,.header-con .header .header-content .box-search, .app-download-tip-box").addClass("current");
            } else {
                $(".header-con .header,.app-download-tip-box").removeClass("current");
            }
        });
        $('.box-search').click(function () {
            $('#search_content').addClass("show");
            $('#index_content').hide();
            $('.header').hide();
            $("input[name='keyword']").focus();
        });
        $('.sb-back').click(function () {
            $('#search_content').removeClass('show');
            $('#index_content').show();
            $('.header').show();
            $("input[name='keyword']").blur();
        });
        $('.colse-search-btn').click(function () {
            $('#search_content').removeClass('show');
            $('#index_content').show();
            $('.header').show();
            $("input[name='keyword']").blur();
        });
        //
    </script>

    <!-- 内容 -->
    <div id="index_content">
        <script type="text/javascript">
            //
        </script>
        <!-- 微商城首页模板文件 -->
        <div class="template-one">
            <!--模块内容-->
            <!-- #tpl_region_start -->

        {!! $tplHtml !!}

        <!-- #tpl_region_end -->
        </div>

        <!-- 签到提醒弹框 -->
        @if($sign_in_entry)
        <div class="sign-frame">
            <div class="sign-layer-box hide" style="display: block;">
                <div class="title">
                    <em class="left"></em><span>签到送好礼</span><em class="right"></em>
                </div>
                <div class="sign-pic">
                    <img src="/images/sign-layer.png" alt="签到">
                    <a href="javascript:;" class="sign-btn" id="signin-pop-go">立即签到</a>
                </div>
                <a href="javascript:;" class="close-btn">
                    <i class="iconfont"></i>
                </a>
            </div>
            <div class="mask1-div" style="display: block;"></div>
        </div>
        @endif
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
    </div>
    <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
    <script type="text/javascript">
        //
    </script>

    {{--引入底部版权--}}
{{--    @include('frontend.web_mobile.modules.library.copy_right')--}}

    <script type="text/javascript">
        //
    </script>
    <!--底部菜单 start-->
    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')


    <!-- 云客服 -->
    <div class="yikf-form site_yikf_form" id="yikf-kefu"
         style='display:none;background:url({{ get_image_url(sysconf('m_aliim_icon')) }}) no-repeat; background-size: cover;'>
        {{--<form id='yikf-form'class="yikf-item" action="https://1737.kf.yunmall.xxxx.com/index/index/home?business_id=xxxxxx&groupid=&shop_id=0&goods_id=0" method="post" >--}}
        <form id='yikf-form' class="yikf-item"
              action="https://{{ config('lrw.kf_domain') }}/index/index/home?business_id=23423423423423423&groupid=&shop_id=0&goods_id=0"
              method="post">
            <input type="hidden" name="visiter_id" value=''>
            <input type="hidden" name="visiter_name" value=''>
            <input type="hidden" name="avatar" value=''>
            <input type="hidden" name="domain" value=''>
        </form>
    </div>
    <script type="text/javascript">
        //
    </script>
    <!-- 消息提醒 -->
    <!-- 积分提醒 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <!-- 扫码设置 -->
    <!-- 如果微信浏览器开启扫码功能 -->
    <script type="text/javascript">
        //
    </script>
	<script type="text/javascript">
		{{--(function() {--}}
		{{--	var url = location.href;--}}
		{{--	if ("{{ $user_info['user_id'] ?? '' }}" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {--}}
		{{--		if (url.indexOf("?") == -1) {--}}
		{{--			url += "?user_id={{ $user_info['user_id'] ?? 0 }}";--}}
		{{--		} else {--}}
		{{--			url += "&user_id={{ $user_info['user_id'] ?? 0 }}";--}}
		{{--		}--}}
		{{--	} else {--}}
		{{--		url = location.href.split('#')[0];--}}
		{{--	}--}}
		{{--	var share_url = "";--}}
		{{--	if (share_url == '') {--}}
		{{--		share_url = url;--}}
		{{--	}--}}

		{{--})();--}}
	</script>
    <!-- 第三方流量统计 -->
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <script src="/assets/d2eace91/min/js/core.min.js?v=22"></script>
{{--    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=202003261806"></script>--}}
{{--    <script src="/assets/d2eace91/js/layer/layer.js?v=202003261806"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.cookie.js?v=202003261806"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.history.js?v=202003261806"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.method.js?v=202003261806"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.widget.js?v=202003261806"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.modal.js?v=202003261806"></script>--}}
{{--    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=202003261806"></script>--}}
{{--    <script src="/assets/d2eace91/js/szy.page.more.js?v=202003261806"></script>--}}

    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/index.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=32"></script>
    <script src="/assets/d2eace91/js/geolocation/amap.js"></script>
    <script src="//res2.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
	<script type="text/javascript">
		$().ready(function() {
			// $("body").append('<script src="//res.wx.qq.com/open/js/jweixin-1.3.2.js"><\/script>');
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
			console.log("share_url "+ share_url)
			console.log("url "+ url)
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
								// jsApiList: ['updateTimelineShareData', 'updateAppMessageShareData','scanQRCode'],
								// openTagList: []
								// jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'],
								// openTagList: ['wx-open-launch-weapp']
							});
						}
					}
				});
			}
			//
			// 微信JSSDK开发
			wx && wx.ready(function() {
				var share_from = $("input[name=share_from]").val();
				// 分享给朋友
				wx.onMenuShareAppMessage({
					title: '{{ $seo_title }}', // 标题
					desc: '{{ $seo_description }}', // 描述
					imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
					link: share_url,
					fail: function(res) {
						alert(JSON.stringify(res));
					},
					success: function(res) {
						if (share_from == 'gameplay') {
							$.post("/user/gameplay/share", {
								gameplay_id: '',
								order_id:''
							}, function(result) {
								// window.location.reload();
							}, 'json')
						}
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
					},
					success: function(res) {
						if (share_from == 'gameplay') {
							$.post("/user/gameplay/share", {
								gameplay_id: '',
								order_id:''
							}, function(result) {
								// window.location.reload();
							}, 'json')
						}
					}
				});
				// 小程序分享
				wx && $.isFunction(wx.miniProgram.getEnv) && wx.miniProgram.getEnv(function(res) {
					if (res.miniprogram) {
						if (share_from == 'gameplay') {
							$.post("/user/gameplay/share", {
								gameplay_id: '',
								order_id:''
							}, function(result) {
								// window.location.reload();
							}, 'json')
						}
						wx.miniProgram.postMessage({
							data: {
								title: '{{ $seo_title }}', // 标题
								imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
							}
						});
					}
				});
				// window.history.replaceState(null, document.title, url);
			});
			// 返回定位选项卡历史位置——————————————————————————START
			$('body').on('click', ".tab-loction li", function (res){
				var parent_id = $(this).parents('.tab-loction').parent().parent().prop('id');
				$('#' + parent_id + ' .tab-loction li').each(function (n,j){
					if($(this).hasClass('active'))
					{
						localStorage.setItem("History_tab", [parent_id, n]);
					}
				})
			});
			var history_tab = localStorage.getItem('History_tab');
			if(history_tab && history_tab != '' && typeof(history_tab) != 'undefined' && typeof(history_tab) != 'null')
			{
				var history_arr = history_tab.split(',');
				var history_uid = history_arr[0];
				var history_li = history_arr[1];
				//;
				var obj = $("#" + history_uid + " .tab-loction li");
				console.log(obj)
				console.log(history_uid);
				console.log(history_li);
				if(obj.eq(history_li).length > 0)
				{
					obj.removeClass('active');
					var floor_li = $("#" + history_uid + " div.tab-con");
					localStorage.setItem("History_tab", '')
					floor_li.hide();
					floor_li.eq(history_li).show()
					console.log(history_li)
					obj.eq(history_li).addClass('active')
				}
			}
			//——————————————————————————END————————————————————————
		});
	</script>
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script src="//webapi.amap.com/maps?v=1.4.15&amp;key={{ sysconf('amap_js_key') }}"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>

    <script>

        $().ready(function () {
            // 缓载图片
            $.imgloading.settings.threshold = 1000;
            $.imgloading.loading();
        });
    </script>

    {{--todo 以下script是页面装修模板用到的，从页面装修数据中判断，独立放到一个地方，后面再改--}}
    @include('frontend.web_mobile.modules.library.mobile_design_scripts')

    <script>

        /*签到script start*/
        $(document).ready(function () {
            //关闭弹层
            $('.close-btn').click(function () {
                $('.sign-layer-box').hide();
                $('.mask1-div').hide();
                set_signin_cookie();
            });
            $('#signin-pop-go').click(function () {
                set_signin_cookie();
                $.go('/user/sign-in/info.html?auto=1');
                /*$.loading.start();
                $.post('/user/sign-in/go.html', {}, function (result) {
                $.msg(result.message, {
                    time: 3000
                },function () {
                    set_signin_cookie();
                    $.go('/user/sign-in/info.html');
                });
            }, 'json');*/
            })
        })

        //设置cookie有效期第二天凌晨
        function set_signin_cookie() {
            //设置第二天凌晨
            var nextday = new Date();
            nextday.setTime(new Date().getTime() + (1000 * 60 * 60 * 24));
            nextday.setHours(0);
            nextday.setMinutes(0);
            nextday.setSeconds(0);
            nextday.setMilliseconds(0);
            $.cookie("signin", 1, {
                path: '/',
                expires: nextday
            });
        }
        /*签到script end*/


        //
        @if(!$webStatic){{--静态页面关闭时 显示--}}
        $.templateloading();
        @endif
        //

		$(document).ready(function() {
			$(".submit").click(function() {
				if ($("#searchtype").val() == '') {
					var keywords = $("#headerSearchForm").find("#keyword").val();
					if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
						keywords = $("#headerSearchForm").find("#keyword").data("searchwords");
					}
					$("#headerSearchForm").find("#keyword").val(keywords);
				} else {
					var keywords = $("#headerSearchForm").find("#keyword").val();
					if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
						$("#headerSearchForm").find("#keyword").val('');
					}
				}
				$("#headerSearchForm").submit();
			});
			//搜索记录
			$.get('/index/information/search-record', function(result) {
				var sr = '';
				$.each($(result.data), function(index, val) {
					if (val != '') {
						sr += '<li><a href="/search?keyword=' + val + '">' + val + '</a></li>';
					}
				});
				if (sr != '') {
					$('#search_goods').show();
					$('.SZY-SEARCH-RECORD').html(sr);
				} else {
					$('#search_goods').hide();
				}
			}, 'json');
			//清空
			$('#clear').click(function() {
				var url = '/search/clear-record.html';
				$.confirm("您确认删除所有的历史记录？", function() {
					$.post(url, {}, function(result) {
						if (result.code == 0) {
							$(".history-results").empty();
							$('#search_goods').hide();
						}
					}, 'json');
				});
			});
			$('.search-type-txt').click(function() {
				$('.search-type-info').toggle();
			});
			$('#select_goods').on('click', function() {
				if ($('#searchtype').val() != '') {
					$("input[name='keyword']").val('');
					$("input[name='keyword']").attr('placeholder', $("input[name='keyword']").data('placeholder'));
				}
				$('#searchtype').val('');
				$('.search-type-txt').html("商品");
				$('.search-type-info').hide();
				$("input[name='keyword']").focus();
			});
			$('#select_shop').on('click', function() {
				if ($('#searchtype').val() != '1') {
					$("input[name='keyword']").val('');
					$("input[name='keyword']").attr('placeholder', '');
				}
				$('#searchtype').val('1');
				$('.search-type-txt').html("店铺");
				$('.search-type-info').hide();
				$("input[name='keyword']").focus();
			});
		});
		//
		$(function(){
			wx && $.isFunction(wx.miniProgram.getEnv) && wx.miniProgram.getEnv(function(res) {
				if (res.miniprogram) {
					$('.service-online').hide();
				} else {
					$('.service-online').show();
				}
			});
		});
		//
		$().ready(function() {
			//首先将#back-to-top隐藏
			//$("#back-to-top").addClass('hide');
			//当滚动条的位置处于距顶部1000像素以下时，跳转链接出现，否则消失
			$(window).scroll(function() {
				if ($(window).scrollTop() > 600) {
					$('body').find(".back-to-top").removeClass('hide');
				} else {
					$('body').find(".back-to-top").addClass('hide');
				}
			});
			//当点击跳转链接后，回到页面顶部位置
			$(".back-to-top").click(function() {
				$('body,html').animate({
					scrollTop: 0
				}, 600);
				return false;
			});
		});
		//
		@if(sysconf('new_order_remind_open'))
		{{--首页新订单提醒--}}
		function newOrderRemind(ob) {
			if (ob != null && ob != 'undefined') {
				if($(".app-download").is(":hidden")){
					var message = '<div class="bubble-container show"><div class="bubble-item"><div class="bubble-image" style="background-image: url(' + ob.headimg + ')"></div><div class="bubble-text">' + ob.user_name + '在1秒前下单了</div></div></div>';
				}else{
					var message = '<div class="bubble-container bubble-container-down show"><div class="bubble-item"><div class="bubble-image" style="background-image: url(' + ob.headimg + ')"></div><div class="bubble-text">' + ob.user_name + '在1秒前下单了</div></div></div>';
				}
				$('body').append(message);
				setTimeout(function() {
					$('body').find('.bubble-container').remove();
				}, 5000);
			}
		}
		var second = 5000;
		$().ready(function(){
			//
			// 模拟新订单提醒
			$.get('/site/get-new-order-list.html', {}, function(result) {
				if (result.code == 0) {
					remind(result);
				}
			}, 'JSON');
			//
		});
		function remind(result) {
			var count = result.count;
			var num = randomNum(0, count - 1);
			var ob = result.data[num];
			setTimeout(function() {
				newOrderRemind(ob);
				remind(result);
			}, second);
			second = randomNum(5000, 30000)
		}
		function randomNum(minNum, maxNum) {
			switch (arguments.length) {
				case 1:
					return parseInt(Math.random() * minNum + 1, 10);
					break;
				case 2:
					return parseInt(Math.random() * (maxNum - minNum + 1) + minNum, 10);
					break;
				default:
					return 0;
					break;
			}
		}
		@endif

		//
		/**
		 $().ready(function(){
        WS_AddUser({
            user_id: 'user_1',
            url: "wss://push.lrw.com:4431/",
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
		$().ready(function() {
			// 缓载图片
			$.imgloading.settings.threshold = 1000;
			$.imgloading.loading();
		});
		//
		//获取微信配置信息
		var scan_code = true;
		var url = location.href.split('#')[0];
		$(function() {
			if (isWeiXin()) {
				if ($('.SZY-SCANQRCODE-LEFT')) {
					$('.SZY-SCANQRCODE-LEFT').html('<a href="javascript:void(0)" class="SZY-SCAN-QR-CODE"><em class="top-icon"></em><span class="bottom-nav">扫码</span></a>');
				}
				if ($('.SZY-SCANQRCODE-RIGHT')) {
					$('.SZY-SCANQRCODE-RIGHT').html('<a href="javascript:void(0)" class="SZY-SCAN-QR-CODE"><em class="top-icon"></em><span class="bottom-nav">扫码</span></a>');
				}
				$.ajax({
					url: "/site/get-weixinconfig.html",
					type: "POST",
					data: {
						url: url
					},
					dataType: 'json',
					success: function(result) {
						if (result.code == 0) {
							setTimeout(function(){
								wx.config({
									debug: false,
									appId: result.data.appId,
									timestamp: result.data.timestamp,
									nonceStr: result.data.nonceStr,
									signature: result.data.signature,
									jsApiList: result.data.jsApiList,
									// jsApiList: ["onMenuShareTimeline", "onMenuShareAppMessage", "scanQRCode"],
									// jsApiList: [
									// 	// 所有要调用的 API 都要加到这个列表中
									// 	"updateTimelineShareData", "updateAppMessageShareData", "scanQRCode"]
								});
								wx.ready(function() {
									// 在这里调用 API
									$(".SZY-SCAN-QR-CODE").click(function() {
										if (result.errCode != 0) {
											$.msg("扫码功能需要去后台微信设置里填写正确的信息");
											return false;
										}
										if (scan_code == false) {
											return false;
										}
										scan_code = false;
										setTimeout(function() {
											scan_code = true;
										}, 3000);
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
							},1000);
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
		});
		//
		$().ready(function() {
			// 统一定位处理
			$.geolocation({
				callback: function() {
				}
			});
		});
		//
	</script>
@stop
