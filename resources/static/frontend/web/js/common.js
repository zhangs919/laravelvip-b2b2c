$().ready(function() {
	var top_width = $(".header-box ul").width();
	if (top_width < 410) {
		$(".header-box ul").addClass("flip");
	}

	try {
		// 头部导航下拉菜单
		//$('.menu-item .menu').hover(function() {
		//			$(this).find('.menu-bd').toggle();
		//		})

		$('.menu-item .menu').hover(function() {
			$(this).find('.menu-bd').show();
		}, function() {
			$(this).find('.menu-bd').hide();
		});
	} catch (e) {}

	try {
		// 头部搜索 店铺、宝贝选择切换
		// $('.search-type li').click(function() {
		// $(this).addClass('cur').siblings().removeClass('cur');
		// $('#searchtype').val($(this).attr('num'));
		// });
		$('.search-type').hover(function() {
			$(this).css({
				"height": "auto",
				"overflow": "visible"
			});
		}, function() {
			$(this).css({
				"height": 35,
				"overflow": "hidden"
			});
		});
	} catch (e) {}

	try {
		// 全部分类鼠标经过展开收缩效果
		$('.category-box-border .home-category').hover((function() {
			$('.expand-menu').css('display', 'inline-block');
		}), (function() {
			$('.expand-menu').css("display", "none");
		}));
	} catch (e) {}

	try {
		// 当前位置下拉弹框
		$('.breadcrumb .crumbs-nav').hover(function() {
			$(this).toggleClass('curr');
		});
	} catch (e) {}

	try {
		// 左侧分类弹框
		$('.list').each(function() {
			var all_width = [];
			// var dl_width = push(parseInt($(this).find('.subitems dl').text().length));
			var num = $(this).find('.subitems dl').length;
			for (var i = 0; i < num; i++) {
				all_width.push(parseInt($(this).find('.subitems dl').eq(i).find('dt').find('em').text().length));
				$(this).find('.subitems dl').eq(i).find('dt').find('a').outerWidth()
			}
			var max_num = Math.max.apply(null, all_width);
			$(this).find('.subitems dl dt').width(max_num * 15 + 'px');
			if (max_num > 8) {
				$(this).find('.subitems dl dd').width(430);
			} else {
				$(this).find('.subitems dl dd').width(510 - max_num * 12);
			}
		});

		$('.list').hover(function() {
			$(this).find('.categorys').show();
		}, function() {
			$(this).find('.categorys').hide();
		});
	} catch (e) {}

	try {
		// 右侧边栏
		$(window).scroll(function() {
			if ($(this).scrollTop() > $(window).height()) {
				$('.returnTop').show();
			} else {
				$('.returnTop').hide();
			}
		});

		$(".returnTop").click(function() {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		// 点击用户图标弹出登录框
		$('.quick-login .quick-links-a,.quick-login .quick-login-a,.customer-service-online a').click(function() {
			$('.pop-login,.pop-mask').show();
		});
		$('.quick-area').mouseover(function() {
			$(this).find('.quick-sidebar').show();
		});
		$('.quick-area').mouseout(function() {
			$(this).find('.quick-sidebar').hide();
		});
		// 移动图标出现文字
		$(".right-sidebar-panel li").mouseenter(function() {
			$(this).children(".popup").stop().animate({
				left: -92,
				queue: true
			});
			$(this).children(".popup").css("visibility", "visible");
			$(this).children(".ibar_login_box").css("display", "block");
		});
		$(".right-sidebar-panel li").mouseleave(function() {
			$(this).children(".popup").css("visibility", "hidden");
			$(this).children(".popup").stop().animate({
				left: -121,
				queue: true
			});
			$(this).children(".ibar_login_box").css("display", "none");
		});
		// 点击购物车、用户信息以及浏览历史事件
		$('.sidebar-tabs').click(function() {
			if ($('.right-sidebar-main').hasClass('right-sidebar-main-open') && $(this).hasClass('current')) {
				$('.right-sidebar-main').removeClass('right-sidebar-main-open');
				$(this).removeClass('current');
				$('.right-sidebar-panels').eq($(this).index() - 1).removeClass('animate-in').addClass('animate-out').css('z-index', 1);
			} else {
				$(this).addClass('current').siblings('.sidebar-tabs').removeClass('current');
				$('.right-sidebar-main').addClass('right-sidebar-main-open');
				$('.right-sidebar-panels').eq($(this).index() - 1).addClass('animate-in').removeClass('animate-out').css('z-index', 2).siblings('.right-sidebar-panels').removeClass('animate-in').addClass('animate-out').css('z-index', 1);
			}
		});
		$(".right-sidebar-panels").on('click', '.close-panel', function() {
			$('.sidebar-tabs').removeClass('current');
			$('.right-sidebar-main').removeClass('right-sidebar-main-open');
			$('.right-sidebar-panels').removeClass('animate-out');
		});
		$(document).click(function(e) {
			var target = $(e.target);
			if (target.closest('.right-sidebar-con').length == 0) {
				$('.right-sidebar-main').removeClass('right-sidebar-main-open');
				$('.sidebar-tabs').removeClass('current');
				$('.right-sidebar-panels').removeClass;
				$('animate-in').addClass('animate-out').css('z-index', 1);
			}
		});
	} catch (e) {}

	// Ajax快速登录
	$(".ajax-login").click(function() {
		$.login.show();
	});

	// 底部二维码切换
	$(".QR-code li").hover(function() {
		var index = $(this).index();
		$(this).addClass("current").siblings().removeClass("current");
		$(".QR-code .code").eq(index).removeClass("hide").siblings().addClass("hide");
	});

	// 在线客服
	$(".service-online").click(function() {
		var goods_id = $(this).data("goods_id");
		var shop_id = $(this).data("shop_id");
		var order_id = $(this).data("order_id");

		$.openim({
			goods_id: goods_id,
			shop_id: shop_id,
			order_id: order_id
		});
	});

	$(".login-mobile .qrcode").mouseenter(function() {
		$('.login-mobile .qrcode').animate({
			left: "5px"
		});
		$(".qrcode-help").animate({
			'opacity': 1
		});
	});
	$(".login-mobile .qrcode-box").mouseleave(function() {
		$(".qrcode").animate({
			left: "70px"
		});
		$(".qrcode-help").animate({
			'opacity': 0
		});
	});

});

function serviceOnLine(shop_id) {
	$.openim({
		shop_id: shop_id
	});
}
// 动态、普通登录切换
function setTab(name, cursel, n) {
	for (i = 1; i <= n; i++) {
		var menu = $("#" + name + i);
		var con = $("#con_" + name + "_" + i);

		if (i == cursel) {
			$(con).show();
			$(menu).addClass("active");
		} else {
			$(con).hide();
			$(menu).removeClass("active");
		}
	}
}