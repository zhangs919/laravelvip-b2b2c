// JavaScript Document
//顶部手机端鼠标经过显示
function show_qcord() {
	var qs = document.getElementById('sn-qrcode');
	qs.style.display = "block";
}
function hide_qcord() {
	var qs = document.getElementById('sn-qrcode');
	qs.style.display = "none";
}

// 面包屑鼠标经过显示
$(function() {
	$('.breadcrumb .crumbs-nav').hover(function() {
		$(this).toggleClass('curr');
	})
	// a标签、input框、按钮点击出现虚线边框问题解决
	$('a,.btn,button,input[type="radio"],input[type="checkbox"]').focus(function() {
		this.blur()
	});

	// 筛选条件色块
	$('.color-value li span').click(function() {
		var seled_num = $(this).parents('ul').find('.selected').length;
		if (seled_num > 0) {
			$(this).parents('dd').find('.select-button').eq(0).attr('class', 'select-button select-button-sumbit');
		} else if (seled_num == 0) {
			$(this).parents('dd').find('.select-button').eq(0).attr('class', 'select-button disabled');
		}
	})
	$('.other-value li input[type="checkbox"]').bind('click', function() {
		var seled_input_num = $(this).parents('ul').find('input[type="checkbox"]:checked').length;
		if (seled_input_num > 0) {
			$(this).parents('dd').find('.select-button').eq(0).attr('class', 'select-button select-button-sumbit');
		} else if (seled_input_num == 0) {
			$(this).parents('dd').find('.select-button').eq(0).attr('class', 'select-button disabled');
		}
	})

	$('.collet-btn').click(function() {
		$('.pop-login,.pop-mask').show();
	})
	var scroll_height = $('#filter').offset().top;
	$(window).scroll(function() {
		var this_scrollTop = $(this).scrollTop();
		if (this_scrollTop > scroll_height) {
			$('#filter').addClass('filter-fixed').css({
				'left': ($(window).width() - $('.filter-fixed').outerWidth()) / 2
			});
		} else {
			$('#filter').removeClass('filter-fixed').css('left', '');
		}
	})
})

/** ********************筛选条件部分************************** */
var attr_group_more_txt = "版本，屏幕尺寸，分辨率";

/** ********************************** */

// 筛选条件品牌
$('#brand-abox li').click(function() {
	var seled_num = $(this).parent().find('.brand-seled').length;
	if (seled_num > 0) {
		$(this).parents('dd').find('.select-button').eq(0).attr('class', 'select-button select-button-sumbit');
	} else if (seled_num == 0) {
		$(this).parents('dd').find('.select-button').eq(0).attr('class', 'select-button disabled');
	}
})

// 列表页对比展示位置
if ($('.main').hasClass('main1210')) {
	$('#compareBox').css({
		'left': Math.ceil(($(window).width() - 990) / 2)
	})
} else {
	$('#compareBox').css({
		'left': 225 + Math.ceil(($(window).width() - 1210) / 2)
	})
}
// 商品列表 收缩展开侧边
$('.category-wrap .slide-aside').click(function() {
	if ($('.category-wrap .aside').width() == 0) {
		$(this).removeClass('left');
		$('.category-wrap .aside').animate({
			'width': 210
		}, 500);
		$('.category-wrap .aside-inner').show().animate({
			'width': 210
		}, 500);
		$('.category-wrap .main').removeClass('main1210').animate({
			'padding-left': 225
		}, 500);
		$('.category-wrap .main').find('.item:nth-child(5n)').removeClass('last');
		$('.category-wrap .main').find('.item:nth-child(4n)').addClass('last');

	} else {
		$(this).addClass('left');
		$('.category-wrap .aside').animate({
			'width': 0
		}, 500);
		$('.category-wrap .aside-inner').animate({
			'width': 0
		}, 500, function() {
			$(this).hide();
		});
		$('.category-wrap .main').addClass('main1210').animate({
			'padding-left': 0
		}, 500);
		$('.category-wrap .main').find('.item:nth-child(4n)').removeClass('last');
		$('.category-wrap .main').find('.item:nth-child(5n)').addClass('last');
	}
	if ($('.main').hasClass('main1210')) {
		$('#compareBox').css({
			'left': Math.ceil(($(window).width() - 990) / 2)
		})
	} else {
		$('#compareBox').css({
			'left': 225 + Math.ceil(($(window).width() - 1210) / 2)
		})
	}
})

/* 浏览历史与猜你喜欢 */
function clear_history() {
	Ajax.call('user.php', 'act=clear_history', clear_history_Response, 'GET', 'TEXT', 1, 1);
}
function clear_history_Response(res) {
	document.getElementById('history_list').innerHTML = '您已清空最近浏览过的商品';
}

// 鼠标经过浏览历史与猜你喜欢切换js
$('.browse-history .browse-history-tab .tab-span').mouseover(function() {
	$(this).addClass('color').siblings('.tab-span').removeClass('color');
	$('.browse-history-line').stop().animate({
		'left': $(this).position().left,
		'width': $(this).outerWidth()
	}, 500);
	$('.browse-history-other').find('a').eq($(this).index()).removeClass('none').siblings('a').addClass('none');
	$('.browse-history-inner ul').eq($(this).index()).removeClass('none').siblings('ul').addClass('none');
})
var history_num = 0;
var history_li = $('.browse-history .recommend-panel li');
var history_slide_w = history_li.outerWidth() * 6;
var history_slide_num = Math.ceil(history_li.length / 6);
$('.browse-history .history-recommend-change').click(function() {
	history_num++;
	if (history_num > (history_slide_num - 1)) {
		history_num = 0;
	}
	$('.browse-history .recommend-panel').css({
		'left': -history_num * history_slide_w
	});
})

function toggleGoods(goods_id, sku_id, obj) {
	$.collect.toggleGoods(goods_id, sku_id, function(callback) {
		if (callback.code == 0) {
			$(obj).toggleClass("curr");
			if ($(obj).children().next().html() == "已收藏") {
				$(obj).children().next().html("收藏");
			} else {
				$(obj).children().next().html("已收藏");

			}

			if ($(obj).parent().attr("class") == "action") {
				if ($.trim($(obj).html()) == "已收藏") {
					$(obj).html("收藏");
				} else {
					$(obj).html("已收藏");
				}
			}
		}
	}, false);
}

// 列表页规格图片鼠标经过效
$(function() {
	$('.list-grid .item').each(function() {
		var num01 = 0;
		var num = $(this).find('.img-main li').length;
		if (num > 5) {
			$(this).find('.img-scroll').addClass('scrolled');
			$(this).find('.img-main').width(34 * num);
			$(this).find('.img-next').click(function() {
				num01++;
				$(this).siblings('.img-prev').removeClass('disabled');
				if (num01 == (num - 5)) {
					$(this).addClass('disabled');
				}
				if (num01 > (num - 5)) {
					num01 = num - 5;
				}
				if (num < 6) {
					num01 = 0;
					$(this).addClass('disabled');
					$(this).siblings('.img-prev').addClass('disabled');
				}
				$(this).siblings('.img-wrap').find('.img-main').animate({
					left: -num01 * 34
				}, 200);
			})
			$(this).find('.img-prev').click(function() {
				num01--;
				if (num01 == 0) {
					$(this).siblings('.img-next').removeClass('disabled');
					$(this).addClass('disabled');
				}
				if (num01 < 0) {
					num01 = 0;
				}
				$(this).siblings('.img-wrap').find('.img-main').animate({
					left: -num01 * 34
				}, 200);
			})
		}
	})
})

function sildeImg(num) {
	$(".img-scroll li").hover(function() {
		var src = $(this).find('img').data("src");
		$(this).parents(".img-scroll").prev().find("img").attr("src", src);
		$(this).find("a").addClass("curr").parent().siblings().find("a").removeClass("curr");
	});
}
