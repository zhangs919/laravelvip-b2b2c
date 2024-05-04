// JavaScript Document
$(function() {
	// 收藏商品
	$('body').on('click', '.goods_edit_btn', function() {
		if ($(this).html() == "编辑") {
			$(".blank-div-footer").show();
			$(".colect-goods-footer").show();
			$('.collect-goods-box').addClass('collect-goods-edit');
			$('.agree-checkbox').show();
			$(".shopcar").hide();
			$('.collect-goods-list').find('.cart-box').hide();
			$('.collect-goods-list').find('a').css("pointer-events", "none");
			$(this).html("完成");
		} else {
			$(".blank-div-footer").hide();
			$(".colect-goods-footer").hide();
			$('.collect-goods-box').removeClass('collect-goods-edit');
			$('.agree-checkbox').hide();
			$(".shopcar").show();
			$('.collect-goods-list').find('.cart-box').show();
			$('.collect-goods-list').find('a').removeAttr("style");
			$(this).html("编辑");
		}
	});

	$('body').on('click', '.collect-goods-list li', function() {

		var $num = parseInt($('.goods-seleted').find('em').text());
		if ($(this).find('.agree-checkbox').hasClass('checked')) {
			$('.goods-seleted').find('em').text($num - 1);
			$(this).find('.agree-checkbox').removeClass('checked');
		} else {
			$('.goods-seleted').find('em').text($num + 1);
			$(this).find('.agree-checkbox').addClass('checked');
		}
		var flag = true;
		$.each($('.collect-goods-list .agree-checkbox'), function() {
			if (!$(this).hasClass('checked')) {
				flag = false;
			}
		});
		if (flag) {
			$('.goods-check-all').addClass('select');
		} else {
			$('.goods-check-all').removeClass('select');
		}

	});
	// 收藏店铺
	$('body').on('click', '.shop-edit-btn', function() {
		if ($(this).html() == "编辑") {
			$('.shop_info').addClass('shop-info-eidt');
			$('.collect-shop-list').addClass('collect-shop-edit');
			$(".blank-div-footer").show();
			$('.colect-shop-footer').show();
			$('.agree-checkbox').show();
			$('.collect-shop-box').find('a').css("pointer-events", "none");
			$(this).html("完成");
		} else {
			$('.shop_info').removeClass('shop-info-eidt');
			$('.collect-shop-list').removeClass('collect-shop-edit');
			$(".blank-div-footer").hide();
			$('.colect-shop-footer').hide();
			$('.agree-checkbox').hide();
			$('.collect-shop-box').find('a').removeAttr("style");
			$(this).html("编辑");
		}
	});
	// ------- 收藏二手物品 编辑/完成 ------- //
	// 编辑状态的class标识
	var editClass = 'is_edit_status';
	$('body').on('click', '.collect-edit-btn', function() {
		var $self = $(this);
		if (!$self.hasClass(editClass)) {
			$self.addClass(editClass);
			// 底部box
			$(".colect-used-footer").show();
			// collect-used-edit
			$('.order-list-goods').addClass('collect-used-edit');
			// 同意 checkbox
			$('.agree-checkbox').show();
			$('.order-list-goods').find('a').css("pointer-events", "none");
			$self.text('完成');
		} else {
			$self.removeClass(editClass);
			// 底部box
			$(".colect-used-footer").hide();
			// collect-used-edit
			$('.order-list-goods').removeClass('collect-used-edit');
			// 同意 checkbox
			$('.agree-checkbox').hide();
			$('.order-list-goods').find('a').removeAttr("style");
			$self.text('编辑');
		}
	});

	$('body').on('click', '.collect-shop-box li', function() {
		var $num = parseInt($('.shop-seleted').find('em').text());
		if ($(this).find('.agree-checkbox').hasClass('checked')) {
			$('.shop-seleted').find('em').text($num - 1);
			$(this).find('.agree-checkbox').removeClass('checked');
		} else {
			$('.shop-seleted').find('em').text($num + 1);
			$(this).find('.agree-checkbox').addClass('checked');
		}
		var flag = true;
		$.each($('.collect-shop-box .agree-checkbox'), function() {
			if (!$(this).hasClass('checked')) {
				flag = false;
			}
		});
		if (flag) {
			$('.shop-check-all').addClass('select');
		} else {
			$('.shop-check-all').removeClass('select');
		}
	});
});

function select_coupon_category() {
	$("#recharge_category_coupon").animate({
		height: '70%'
	}, [10000]);
	var total = 0, h = $(window).height(), top = $('.discount-coupon h2').height() || 0, con = $('.coupon-list');
	total = 0.7 * h;
	con.height(total - top + 'px');
	$(".mask-div").show();
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
}

function close_choose_category_coupon() {
	$(".mask-div").hide();

	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);

	$('#recharge_category_coupon').animate({
		height: '0'
	}, [10000]);
}

function select_coupon_goods() {
	$("#recharge_goods_coupon").animate({
		height: '70%'
	}, [10000]);
	var total = 0, h = $(window).height(), top = $('.discount-coupon h2').height() || 0, con = $('.coupon-list');
	total = 0.7 * h;
	con.height(total - top + 'px');
	$(".mask-div").show();
	scrollheight = $(document).scrollTop();
	$("body").css("top", "-" + scrollheight + "px");
	$("body").addClass("visibly");
}

function close_choose_goods_coupon() {
	$(".mask-div").hide();

	$("body").css("top", "auto");
	$("body").removeClass("visibly");
	$(window).scrollTop(scrollheight);

	$('#recharge_goods_coupon').animate({
		height: '0'
	}, [10000]);
}