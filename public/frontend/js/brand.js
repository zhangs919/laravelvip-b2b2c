// JavaScript Document
function goods_banner_control() {
	var num01 = 0;
	var gg_lis = $('#goods-banner li').length;
	$('#goods-banner').width(230 * gg_lis);
	$('.scrright').click(function() {
		num01++;
		if (num01 > (gg_lis - 5)) {
			num01 = gg_lis - 5;
		}
		$('#goods-banner').animate({
			left: -num01 * 230
		}, 200);
	})
	$('.scrleft').click(function() {
		num01--;
		if (num01 < 0) {
			num01 = 0;
		}
		$('#goods-banner').animate({
			left: -num01 * 230
		}, 200);
	})

}
goods_banner_control();

$(function() {
	var oNav = $('.all-brands');// 导航壳
	var aNav = oNav.find('li');// 导航
	var aDiv = $('.brand-list .brand-floor');// 楼层
	var oTop = $('.go-top');
	// 回到顶部
	$(window).scroll(function() {
		var winH = $(window).height();// 可视窗口高度
		var iTop = $(window).scrollTop();// 鼠标滚动的距离

		if (iTop >= 430) {
			oNav.css({
				"position": "fixed"
			});
			// 鼠标滑动式改变
			aDiv.each(function() {
				if (winH + iTop - $(this).offset().top > winH / 2) {
					aNav.removeClass('on');
					aNav.eq($(this).index()).addClass('on');
				}
			})
		} else {
			oNav.css({
				"position": "absolute"
			});
		}
	})
	// 点击top回到顶部
	oTop.click(function() {
		$('body,html').animate({
			"scrollTop": 0
		}, 500)
	})
	// 点击回到当前楼层
	aNav.click(function() {
		var t = aDiv.eq($(this).index()).offset().top;
		$('body,html').animate({
			"scrollTop": t
		}, 500);
		$(this).addClass('on').siblings().removeClass('on');
	});
})
