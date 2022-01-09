//页面加载等待
/*
 var pageloading = ["loading-img-8"];  
 var n = Math.floor(Math.random() * pageloading.length + 1)-1;  
 var pageclass = pageloading[n];
 var divnum = pageclass.substr(pageclass.length-1,1);
 document.write('<div class="page-loading-box">');
 document.write('<div class="'+pageclass+'">');
 for(var i=0; i< parseInt(divnum); i++){
 document.write('<div></div>');
 }
 document.write('</div></div>');
 document.onreadystatechange = function() {
 if (document.readyState == "complete") {
 $('.page-loading-box').remove();
 }
 }
 */

$().ready(function() {
	var menu = $('#menu');
	var $nav = $('.show-menu-info');
	$(window).on("scroll", function() {
		menu.removeClass('show');
	});

	// 弹出菜单
	$('body').on('click', '.show-menu', function(e) {
		if (e.stopPropagation) {
			e.stopPropagation();
		} else {
			e.cancelBubble = true;
		}
		var bd_top = $(document).scrollTop();
		if (menu.css('opacity') == '0') {
			menu.addClass('show');
		} else {
			menu.removeClass('show');
		}
	});
	// 右侧弹出菜单
	$('.right-menu-btn').click(function() {
		if ($(this).parents('.right-menu-box').hasClass('active')) {
			$(this).parents('.right-menu-box').removeClass('active');
		} else {
			$(this).parents('.right-menu-box').addClass('active');
		}
	});
	// 滑动触发
	try {
		document.createEvent("TouchEvent");
		// console.info("支持TouchEvent事件！");
		// 绑定事件
		document.addEventListener('touchmove', function(event) {
			menu.removeClass('show');
		}, false);

		$(document).bind('click', function() {
			menu.removeClass('show');
		});

	} catch (e) {
		// console.info("不支持TouchEvent事件！" + e.message);
		$(document).bind('click', function() {
			menu.removeClass('show');
		});
	}

	// mobile端监听input输入框方法
	$.fn.watch = function(callback) {
		return this.each(function() {
			// 缓存以前的值
			$.data(this, 'originVal', $(this).val());

			if ($(this).attr('type') == 'hidden') {
				return;
			}
			if ($(this).val() != "" && $(this).parent('.form-control-box').find('.num-clear').size() == 0 && $(this).attr("readonly") != 'readonly') {
				if ($(this).attr('type') == 'password') {
					$(this).parent('.form-control-box').append('<span class="password-type show-password"></span>');
				}
				$(this).parent('.form-control-box').append('<span class="num-clear"><i class="iconfont">&#xe621;</i></span>');
			}
			// event
			$(this).on('input', function() {
				var originVal = $(this, 'originVal');
				var currentVal = $(this).val();

				if (originVal !== currentVal) {
					$.data(this, 'originVal', $(this).val());
					if (currentVal != '' && $(this).parent('.form-control-box').find('.num-clear').size() == 0 && $(this).attr("readonly") != 'readonly') {
						if ($(this).attr('type') == 'password') {
							$(this).parent('.form-control-box').append('<span class="password-type show-password"></span>');
						}
						$(this).parent('.form-control-box').append('<span class="num-clear"><i class="iconfont">&#xe621;</i></span>');
					}

					if (currentVal == '' && $(this).parent('.form-control-box').find('.num-clear').size() > 0) {
						$(this).parent('.form-control-box').find('.show-password').remove();
						$(this).parent('.form-control-box').find('.num-clear').remove();
					}
					if ($.isFunction(callback)) {
						callback($(this));
					}
				}
			});
		});
	};
	$('body').on('click', '.num-clear', function() {
		$(this).parent('.form-control-box').find('input').val('').focus();
		$(this).prev('.show-password').remove();
		$(this).remove();
	});

	$('body').on('click', '.show-password', function() {
		if ($(this).hasClass('on')) {
			$(this).prev('input').attr('type', 'password');
			$(this).removeClass('on');
		} else {
			$(this).prev('input').attr('type', 'text');
			$(this).addClass('on');
		}
	});

	// 在线客服
	$('body').on('click', '.service-online', function() {
		var goods_id = $(this).data("goods_id");
		var shop_id = $(this).data("shop_id");
		var order_id = $(this).data("order_id");

		$.openim({
			goods_id: goods_id,
			shop_id: shop_id,
			order_id: order_id
		});
	});

	var nowtime = Date.parse(new Date());
	$.each($('body').find(".settime"), function() {
		var time = $(this).data('end_time') * 1000 - nowtime;
		$(this).countdown({
			time: time,
			leadingZero: true,
			htmlTemplate: "<span>%{d}天%{h}时%{m}分%{s}秒</span>",
			onComplete: function(event) {
				$(this).html("活动已结束！");
			}
		});
	});
	// 重写登录模块
	$.login = {
		// 打开登录对话框
		show: function() {
			// 微商城端直接跳到登录页面
			$.go("/login.html");
		},
		// 登录成功处理函数
		success: function() {
			$.go(window.location.href);
		}
	};

	if ($('.nav-list-container')) {
		$.each($('.nav-list-container'), function(i, val) {
			if ($(this).find('ul').length <= 1) {
				$(this).find('.swiper-pagination').addClass('hide');
			}
		});
	}
});
(function () {

　　if (typeof WeixinJSBridge == "object" && typeof WeixinJSBridge.invoke == "function") {

　　handleFontSize();

　　} else {
　　if (document.addEventListener) {

　　　　document.addEventListener("WeixinJSBridgeReady", handleFontSize, false);

　　} else if (document.attachEvent) {

　　　　document.attachEvent("WeixinJSBridgeReady", handleFontSize);

　　　　document.attachEvent("onWeixinJSBridgeReady", handleFontSize);

　　}

}

function handleFontSize() {

　　// 设置网页字体为默认大小
　　WeixinJSBridge.invoke('setFontSizeCallback', {

　　'fontSize': 0

　　});


　　// 重写设置网页字体大小的事件
　　WeixinJSBridge.on('menu:setfont', function () {

　　　　WeixinJSBridge.invoke('setFontSizeCallback', {

　　　　　　'fontSize': 0

　　　　});

　　});

　　}

})();

	function isWeiXin(){
	  // window.navigator.userAgent属性包含了浏览器类型、版本、操作系统类型、浏览器引擎类型等信息，这个属性可以用来判断浏览器类型
	  var ua = window.navigator.userAgent.toLowerCase();
	  // 通过正则表达式匹配ua中是否含有MicroMessenger字符串
	  if(ua.match(/MicroMessenger/i) == 'micromessenger'){
		  return true;
	  }else{
		  return false;
	  }
	}