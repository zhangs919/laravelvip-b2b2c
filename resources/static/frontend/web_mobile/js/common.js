// 页面过渡效果

$.pageLoading = function(settings) {

	var defaults = {
		callback: null,
		fase: 1000,
		// 组件渲染
		render: function() {
			var html = '<div class="page-loading SZY-PAGE-LOADING">';
			html += '<div class="loading-spinner">';
			html += '<span class="spinner-items">';
			html += '<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>';
			html += '</span></div></div>';
			$('html').append(html);
			
			// 防止未被清除
			setTimeout(function() {
				if ($('.SZY-PAGE-LOADING').length > 0) {
					$('.SZY-PAGE-LOADING').remove();
				}
			}, 5000);
			
		},
	}

	settings = $.extend(true, defaults, settings);

	// 渲染
	settings.render();

	if (isWeiXin()) {

		document.addEventListener("WeixinJSBridgeReady", function() {

			$('.SZY-PAGE-LOADING').show().fadeOut(settings.fase, function() {
				$(this).remove();
			});
			// 回调
			if ($.isFunction(settings.callback)) {
				settings.callback.call(settings);
			}
		}, false);
	} else {

		window.onload = function() {
			$('.SZY-PAGE-LOADING').show().fadeOut(settings.fase, function() {
				$(this).remove();
			});

			// 回调
			if ($.isFunction(settings.callback)) {
				settings.callback.call(settings);
			}
		}
	}
}

$.pageLoading({
	fase: 200
});


$().ready(function() {

	// 重写loading方法
	$.loading = {
		// 开始加载
		start: function(msg) {

			var html = '<div class="handle-loading SZY-LAYER-LOADING">';
				html += '<div class="loading-spinner">';
				html += '<span class="spinner-items">';
				html += '<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>';
				html += '</span></div>';

				if(msg != '' && msg != 'undefined' && msg != undefined && msg != null){
					html += '<p class="loading-des">'+msg+'</p>';
				}
				html += '</div>'

			$('html').append(html);

		},
		// 停止加载
		stop: function() {
			$(".SZY-LAYER-LOADING").remove();
		}
	};


	$.go = function(url) {

		if (url == undefined) {
			url = window.location.href;
		}
		window.location.href = url;
	};

	// 重写msg方法
	var szy_msg_time = '';

	$.msg = function(content, options, end) {

		if ($('.SZY-LAYER-MSG').length > 0) {
			$('.SZY-LAYER-MSG').show().fadeOut(300, function() {
				$(this).remove();
			});
			clearTimeout(szy_msg_time);
		}

		$.loading.stop();

		if ($.isFunction(options)) {
			end = options;
			options = {};
		}

		options = $.extend({
			time: 2000,
			icon_type: 0
		}, options);

		var icon_html = '';

		if (options.icon_type == 1) {
			icon_html = '<i class="iconfont icon-success"></i>';
		}

		var html = '<div style="display:none" class="toast SZY-LAYER-MSG">' + icon_html + '<div class="toast-content">' + content + '</div></div>'

		$('html').append(html);

		$('.SZY-LAYER-MSG').hide().fadeIn(300);

		return szy_msg_time = setTimeout(function() {
			$('.SZY-LAYER-MSG').show().fadeOut(300, function() {
				$(this).remove();
			});
			if ($.isFunction(end)) {
				end.call(layer);
			}
		}, options.time);

	};
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

	// 重写按钮位置互换
	$.confirm = function(content, options, yes, cancel) {
		if (layer) {
			var type = $.isFunction(options);
			if (type) {
				cancel = yes;
				yes = options;
				options = {};
			}

			options = $.extend({
				// 隐藏滚动条
				scrollbar : true
			}, options);

			options.success = function(layer){
				if(layer.find('.layui-layer-btn a').eq(1)){
					layer.find('.layui-layer-btn a').eq(1).insertBefore(layer.find('.layui-layer-btn a').eq(0));
				}
			}

			return layer.confirm(content, options, function(index) {

				if (($.isFunction(cancel) && cancel.call(layer, index) != false) || cancel == undefined) {
					layer.close(index);
				}
			}, function(index) {
				if ($.isFunction(yes) && yes.call(layer, index) != false) {
					layer.close(index);
				}
			});

		} else {
			return confirm("缺少组件：" + content);
		}
	};

});

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

	if ($('.nav-list-container')) {
		$.each($('.nav-list-container'), function(i, val) {
			if ($(this).find('ul').length <= 1) {
				$(this).find('.swiper-pagination').addClass('hide');
			}
		});
	}
});
(function() {

	　　
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
		　　
		WeixinJSBridge.on('menu:setfont', function() {

			　　　　
			WeixinJSBridge.invoke('setFontSizeCallback', {

				　　　　　　
				'fontSize': 0

				　　　　
			});

			　　
		});

		　　
	}

})();

function isWeiXin() {
	// window.navigator.userAgent属性包含了浏览器类型、版本、操作系统类型、浏览器引擎类型等信息，这个属性可以用来判断浏览器类型
	var ua = window.navigator.userAgent.toLowerCase();
	// 通过正则表达式匹配ua中是否含有MicroMessenger字符串
	if (ua.match(/MicroMessenger/i) == 'micromessenger') {
		return true;
	} else {
		return false;
	}
}

if (IsPC()) {
	$(window).scroll(function() {
		if ($(".tabmenu-new").length > 0) {
			if ($(window).scrollTop() <= 50 || ($('.order-box').height() - $(window).height() > 100)) {
				$(".header-top-nav").show();
				$(".tabmenu-new").removeClass('fixed-menu');
			} else {
				$(".header-top-nav").hide();
				$(".tabmenu-new").addClass('fixed-menu');
			}
		}
	});
} else {
	$(document).bind("touchmove", function(event) {
		$(window).scroll(function() {
			if ($(".tabmenu-new").length > 0) {
				if ($(window).scrollTop() <= 50) {
					$(".header-top-nav").show();
					$(".tabmenu-new").removeClass('fixed-menu');
				} else {
					$(".header-top-nav").hide();
					$(".tabmenu-new").addClass('fixed-menu');
				}
			}
		});
	});
}

function IsPC() {
	var userAgentInfo = navigator.userAgent;
	var Agents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
	var flag = true;
	for (var v = 0; v < Agents.length; v++) {
		if (userAgentInfo.indexOf(Agents[v]) > 0) {
			flag = false;
			break;
		}
	}
	return flag;
}

// 小程序跳转
var min_nav_click = false;

function minNavTo(link) {

	$.loading.start();

	link = link.split('|');

	if (isWeiXin()) {
		wx.ready(function() {
			if (window.__wxjs_environment === 'miniprogram') {
				if (min_nav_click == false) {
					min_nav_click = true;
					wx.miniProgram.navigateTo({
						url: '/pages/navigator/navigator?appid=' + link[1] + '&path=' + link[2],

						complete: function() {
							min_nav_click = false;
							$.loading.stop();
						}

					});
				}
			} else {
				$.go(link[3]);
			}
		});
	} else {
		$.go(link[3]);
	}
}

function sessionStorageTemplateClear (){
	if(sessionStorage){
		$.each(sessionStorage,function(i,v){
			if(i.indexOf('template_') == 0){
				sessionStorage.removeItem(i);
			}
		});
	}
}


// 判断设备类型 0苹果1安卓
function equipment_type(m) {
	var u = navigator.userAgent,
		app = navigator.appVersion;
	if (/AppleWebKit.*Mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))) {
		if (window.location.href.indexOf("?mobile") < 0) {
			try {
				if (/iPhone|mac|iPod|iPad/i.test(navigator.userAgent)) {
					return '0';
				} else {
					return '1';
				}
			} catch (e) {}
		}
	} else if (u.indexOf('iPad') > -1) {
		return '0';
	} else {
		return '1';
	}
}