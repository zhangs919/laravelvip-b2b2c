// JavaScript Document
var scrollheight = 0;
// On Click Event
// 自提弹框
$("body").on('click', '.pickup', function() {
	$(".goods-pickup-layer").addClass('show');
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
})
// 自提弹框关闭事件
$("body").on('click', '.goods-pickup-layer .back-goods-info', function() {
	$(".goods-pickup-layer").removeClass('show');
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
})
/* 图文详情切换 */
$('.header-nav li').click(function() {
	$('html,body').animate({
		'scrollTop': 0
	}, 600);
	$(this).addClass('cur').siblings().removeClass('cur');
	$('.user-goods-ka').eq($(this).index()).show().siblings('.user-goods-ka').hide();
})
/* 弹出层 */
/* 分享弹出 */
function bdshare_popup() {
	$(".bdshare-popup-box").show();
	$(".bdshare-popup-box").height($(document).height());
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
}

function colse_bdshare_popup() {
	$(".bdshare-popup-box").hide();
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
}

function select_coupon() {
	$("#select_coupon").animate({
		height: '70%'
	}, [10000]);
	var total = 0,
		h = $(window).height(),
		top = $('.discount-coupon h2').innerHeight() || 0,
		con = $('.coupon-list');
	total = 0.7 * h;
	con.height(total - top + 'px');
	$(".mask-div").show();
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
	setTimeout(function() {
		setTimeout(function() {
			$('.discount-coupon h2 .c-close-attr1').addClass('show');
		}, 300);
	}, 150)
}

function close_choose_coupon() {
	$(".mask-div").hide();
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);

	$('#select_coupon').animate({
		height: '0'
	}, [10000]);
	$('.discount-coupon h2 .c-close-attr1').removeClass('show');
}

function select_spec(event) {
	if ($("#choose_attr .choose-foot .SZY-BUY-SELECT").length > 0) {
		if (event == 'select') {
			$("#choose_attr .choose-foot .SZY-BUY-BUTTON").hide();
			$("#choose_attr .choose-foot .SZY-BUY-SELECT").show();
		} else {
			$("#choose_attr .choose-foot .SZY-BUY-BUTTON").show();
			$("#choose_attr .choose-foot .SZY-BUY-SELECT").hide();
		}
	}
	$("#choose_attr .choose-foot .SZY-BUY-BUTTON").removeClass('add-cart');
	$("#choose_attr .choose-foot .SZY-BUY-BUTTON").removeClass('buy-goods');
	$(".mask-div").show();
	$('#choose_attr').show();
	$('#choose_attr').removeClass('spec-menu-hide').addClass('spec-menu-show');
	$("#choose_attr .choose-foot .SZY-BUY-BUTTON").addClass(event);
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
	setTimeout(function() {
		setTimeout(function() {
			$('.choose-attribute-close').addClass('show');
		}, 300);
	}, 150)

}

function close_choose_spec() {
	$(".mask-div").hide();
	$('#choose_attr').hide();
	$('#choose_attr').removeClass('spec-menu-show').addClass('spec-menu-hide');
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
	$('.choose-attribute-close').removeClass('show');
}

function select_proms() {
	// $('#proms_coupon li .pro-info').each(function() {
	// $(this).width($(this).parent('.pro-item').width() -
	// $(this).siblings('.pro-type').outerWidth() - 10);
	// })
	$("#proms_coupon").animate({
		height: '70%'
	}, [10000]);
	var total = 0,
		h = $(window).height(),
		top = $('.prom-coupon h2').innerHeight() || 0,
		con = $('.coupon-list');
	total = 0.7 * h;
	con.height(total - top + 'px');
	$(".mask-div").show();
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
	setTimeout(function() {
		setTimeout(function() {
			$('.prom-coupon h2 .c-close-attr1').addClass('show');
		}, 300);
	}, 150)
}

function close_choose_proms() {
	$(".mask-div").hide();
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
	$('#proms_coupon').animate({
		height: '0'
	}, [10000]);
	$('.c-close-attr1').removeClass('show');
}

function select_area() {
	$("#select_area").animate({
		height: '70%'
	}, [10000]);
	var total = 0,
		h = $(window).height(),
		top = $('.select_area_box').height() || 0,
		con = $('.area_box');
	total = 0.7 * h;
	con.height(total - top + 'px');
	$(".mask-div").show();
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
}

function close_choose_area() {
	$(".mask-div").hide();
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
	$('#select_area').animate({
		height: '0'
	}, [10000]);
}

function close_region_chooser() {
	$(".mask-div").hide();
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
	$(".region-chooser-box").animate({
		height: '0'
	}, [10000]);
}

function code_coupon() {
	$(".code-bg").show();
	$('.code-mask').show();
	$("body").addClass("visibly");
}

function close_code_coupon() {
	$(".code-bg").hide();
	$('.code-mask').hide();
	$("body").removeClass("visibly");
}
/* 商品评价弹出层 */
$('.goods-comment').click(function() {
	$('.good-comments-box').addClass('show');
});
$('.colse-comments-box').click(function() {
	$('.good-comments-box').removeClass('show');
});
/* 搭配套餐 */
$("body").on('click', '.package-box .package-title', function() {
	$(this).parent('.package-item').removeClass('package-hide').siblings('.package-item').addClass('package-hide');
});

function close_coupon() {
	close_choose_spec();
	close_region_chooser();
	close_code_coupon();
	close_choose_area();
	close_choose_proms();
	close_code_coupon();
	colse_bdshare_popup();
}
// 销量和收藏数切换
$('.sale-collect-nav li').click(function() {
	$(this).addClass('current').siblings().removeClass('current');
	$('.sale-collect-tab').eq($(this).index()).show().siblings('.sale-collect-tab').hide();
});
// 销量和收藏数内滑动切换
$(function() {
	$(".tempWrap").each(function() {
		$(this).swiper({
			paginationClickable: true,
			observer: true,
			observeParents: true,
			preloadImages: true,
			lazyLoading: true,
			updateOnImagesReady: true,
			pagination: $('.pagination', this)
		});
	});
});