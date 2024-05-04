// JavaScript Document
var scrollheight = 0;
// On Click Event
// 自提弹框
//$("body").on('click', '.pickup', function() {
//	$(".goods-pickup-layer").addClass('show');
//	scrollheight = $(document).scrollTop();
//	$("body").css("top", "-" + scrollheight + "px");
//	$("body").addClass("visibly");
//});
//// 自提弹框关闭事件
//$("body").on('click', '.goods-pickup-layer .back-goods-info', function() {
//	$(".goods-pickup-layer").removeClass('show');
//	$("body").css("top", "auto");
//	$("body").removeClass("visibly");
//	$(window).scrollTop(scrollheight);
//});
/* 图文/* 图文详情切换 */
//$('.header-nav li').click(function() {
//	$('html,body').animate({
//		'scrollTop': 0
//	}, 600);
//	$(this).addClass('cur').siblings().removeClass('cur');
//	$('.user-goods-ka').eq($(this).index()).show().siblings('.user-goods-ka').hide();
//})
/* 弹出层 */

function select_coupon() {
	$('#select_coupon').removeClass('spec-menu-hide').addClass('spec-menu-show');
	var total = 0,
		h = $(window).height(),
		top = $('.discount-coupon h2').innerHeight() || 0,
		con = $('.coupon-list');
	total = 0.7 * h;
	$(".mask-div").show();
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
	setTimeout(function() {
		$('.discount-coupon .choose-attribute-close').addClass('show');
	}, 300);
}

function close_choose_coupon() {
	$(".mask-div").hide();
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
	$('.discount-coupon .choose-attribute-close').removeClass('show');
	$('#select_coupon').addClass('spec-menu-hide').removeClass('spec-menu-show');
}

function close_bargain_rule() {
	$(".mask-div").hide();
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
	$('.popup-bargainrule').hide();
}

function service_layer_show() {
	var total = 0,
		h = $(window).height(),
		top = $('.service-box-header h2').innerHeight() || 0,
		ft = $('.service-layer-foot').innerHeight() || 0,
		con = $('.service-list');
	total = $('.service-con-layer').height();
	con.height(total - top - ft + 'px');
	$(".mask-div").show();
	$('.service-con-layer').addClass('layer-show');
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
}

function close_service_layer() {
	$('.service-con-layer').removeClass('layer-show');
	$(".mask-div").hide();
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
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
		$('.choose-attribute-close').addClass('show');
	}, 300);

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
	$('#proms_coupon').removeClass('spec-menu-hide').addClass('spec-menu-show');
	$('#proms_coupon').show();
	$(".mask-div").show();
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
	setTimeout(function() {
		$('.prom-coupon .choose-attribute-close').addClass('show');
	}, 300);
}

function close_choose_proms() {
	$(".mask-div").hide();
	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);
	$('#proms_coupon').removeClass('spec-menu-show').addClass('spec-menu-hide');
	$('#proms_coupon').hide();
	$('.choose-attribute-close').removeClass('show');
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
	$('.region-chooser-box').removeClass('region-chooser-show');
	$('.region-chooser-close').removeClass('show');
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
	if ($(this).parent('.package-item').hasClass('package-hide')) {
		$(this).parent('.package-item').removeClass('package-hide').siblings('.package-item').addClass('package-hide');
	} else {
		$(this).parent('.package-item').addClass('package-hide');
	}
});

function close_coupon() {
	close_choose_coupon();
	close_choose_spec();
	close_region_chooser();
	close_code_coupon();
	close_choose_area();
	close_choose_proms();
	close_code_coupon();
	colse_bdshare_popup();
	close_service_layer();
	colse_share_select();
	close_bargain_rule();
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
			lazyLoadingInPrevNext: true,
			updateOnImagesReady: true,
			pagination: $('.pagination', this)
		});
		var number = $(this).find(".swiper-wrapper .swiper-slide").size();
		if (number == 1) {
			//一张图片则隐藏锚节点 
			$(this).children(".swiper-pagination-bullets").css("display", "none");
		}
	});
});
	/* 选择用户中心地址 */
	$("body").on('click', '.address-select', function() {
		$('.mask-div').show();
		$('.user-address-select').addClass('address-select-show');
		scrollheight = $(document).scrollTop();
		$("body").css("top", "-" + scrollheight + "px");
		$("body").addClass("visibly");
		setTimeout(function() {
			$('.address-select-close').addClass('show');
		}, 500);
	});
	$("body").on('click', '.user-address-ul li', function() {
		$(this).addClass('current color').siblings().removeClass('current color');
	});
	function colse_address_select(){
		$(".mask-div").hide();
		$("body").css("top", "auto");
		$("body").removeClass("visibly");
		$(window).scrollTop(scrollheight);
		$('.user-address-select').removeClass('address-select-show');
		$('.address-select-close').removeClass('show');	
	}
	$("body").on('click', '.address-select-close', function() {
		colse_address_select();
	});
