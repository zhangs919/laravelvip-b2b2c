var scrollheight = 0;
// JavaScript Document
$(function() {

	// 商品选择框
	$("body").on('click', '.goods-checkbox', function() {
		var shop_id = $(this).data("shop-id");
		if ($(this).hasClass('select')) {
			$(this).removeClass('select');
			$(this).find(":checkbox").prop("checked", false);
			$('#cart_shop_' + shop_id).find(".shop-checkbox").removeClass('select');// 店铺全选取消
			$('.all-checkbox').removeClass('select');// 全选取消
		} else {
			$(this).addClass('select');
			$(this).find(":checkbox").prop("checked", true);

			if ($("#cart_shop_" + shop_id).find(":checkbox").size() == $("#cart_shop_" + shop_id).find(":checkbox:checked").size()) {
				$("#cart_shop_" + shop_id).find(".shop-checkbox").addClass('select');// 店铺全选选中
			}

			if ($("#cart_list").find(":checkbox").size() == $("#cart_list").find(":checkbox:checked").size()) {
				$('.all-checkbox').addClass('select');// 全选选中
			}
		}
		select();
	});

	$("body").on('click', '.whole-checkbox', function() {
		var shop_id = $(this).data("shop-id");
		var goods_id = $(this).data("goods-id");
		if ($(this).hasClass('select')) {
			$(this).removeClass('select');
			$('.whole-checkbox-' + goods_id).find(":checkbox").prop("checked", false);
			$('#cart_shop_' + shop_id).find(".shop-checkbox").removeClass('select');// 店铺全选取消
			$('.all-checkbox').removeClass('select');// 全选取消
			$('.whole-checkbox-' + goods_id).removeClass('select');// 全选取消
		} else {
			$(this).addClass('select');
			$('.whole-checkbox-' + goods_id).find(":checkbox").prop("checked", true);
			if ($("#cart_shop_" + shop_id).find(":checkbox").size() == $("#cart_shop_" + shop_id).find(":checkbox:checked").size()) {
				$("#cart_shop_" + shop_id).find(".shop-checkbox").addClass('select');// 店铺全选选中
			}
			if ($("#cart_list").find(":checkbox").size() == $("#cart_list").find(":checkbox:checked").size()) {
				$('.all-checkbox').addClass('select');// 全选选中
			}
		}
		select();
	});

	// 店铺选择框
	$("body").on('click', '.shop-checkbox', function() {
		var shop_id = $(this).data("shop-id");
		if ($(this).hasClass('select')) {
			$('#cart_shop_' + shop_id).find('.cart-checkbox').removeClass('select');
			$('#cart_shop_' + shop_id).find(":checkbox").prop("checked", false);
			$('.all-checkbox').removeClass('select');// 全选取消
		} else {
			$('#cart_shop_' + shop_id).find('.cart-checkbox').addClass('select');
			$('#cart_shop_' + shop_id).find(":checkbox").prop("checked", true);
			if ($("#cart_list").find(":checkbox").length == $("#cart_list").find(":checkbox:checked").length) {
				$('.all-checkbox').addClass('select');// 全选选中
			}
		}
		select();
	})

	// 全选框
	$("body").on('click', '.all-checkbox', function() {
		if ($(this).hasClass('select')) {
			$('.cart-checkbox').removeClass('select');
			$("#cart_list").find(":checkbox").prop("checked", false);
		} else {
			$('.cart-checkbox').addClass('select');
			$("#cart_list").find(":checkbox").prop("checked", true);
		}
		select();
	});

	// 清空
	$("#batch_delet").click(function() {
		cart_ids = [];
		if ($("#batch_delet").data('id') == '0') {
			$("#cart_list").find(":checkbox").each(function() {
				cart_ids.push($(this).val());
			});
			$.confirm("您确定要从购物车中移除全部商品吗?", function() {
				$.cart.del(cart_ids, function(result) {
					if (result.code == 0) {
						$(".content").replaceWith(result.data);
						// 重新初始化
						init();
					}
				});
			});
		} else {
			$("#cart_list").find(":checkbox:checked").each(function() {
				cart_ids.push($(this).val());
			});
			$.confirm("您确定要删除选中的商品吗?", function() {
				$.cart.del(cart_ids, function(result) {
					if (result.code == 0) {
						$(".content").replaceWith(result.data);
						// 重新初始化
						init();
					}
				});
			});
		}
	});
	// 删除
	$("body").on('click', '.del', function() {
		var cart_ids = $(this).attr('data-cart-id');
		if (!cart_ids) {
			cart_ids = [];
			$("#cart_list").find(":checkbox:checked").each(function() {
				cart_ids.push($(this).val());
			})
		} else {
			cart_ids = [cart_ids];
		}

		if (cart_ids.length == 0) {
			$.msg("请选择您要移除的商品");
			return;
		}

		$.confirm("您确定要从购物车中移除选中的商品吗?", function() {
			$.cart.del(cart_ids, function(result) {
				if (result.code == 0) {
					$(".content").replaceWith(result.data);
					// 重新初始化
					init();
				}
			});
		})
	});

	$("body").on('click', '.whole-del', function() {
		var cart_ids = $(this).attr('data-cart-id');
		cart_ids = cart_ids.split(',');
		if (cart_ids.length == 0) {
			$.msg("请选择您要移除的商品");
			return;
		}

		$.confirm("您确定要从购物车中移除选中的商品吗?", function() {
			$.cart.del(cart_ids, function(result) {
				if (result.code == 0) {
					$(".content").replaceWith(result.data);
					// 重新初始化
					init();
				}
			});
		})
	});

	// 清空失效商品
	$("body").on('click', '.del-invalid', function() {
		var cart_ids = [];
		$("#invalid-list").find(".SZY-INVALID-LI").each(function() {
			cart_ids.push($(this).data('cart-id'));
		});
		cart_ids = cart_ids.join(',');

		$.confirm("您确定要清空失效商品吗?", function() {
			$.cart.del(cart_ids, function(result) {
				if (result.code == 0) {
					$(".content").replaceWith(result.data);
					// 重新初始化
					init();
				}
			});
		})
	});

	// 优惠券弹框
	$("body").on('click', '.shop-coupon-trigger', function() {
		var shop_id = $(this).data("shop-id");
		var $shop_coupon = $("#select_coupon_" + shop_id);
		$shop_coupon.animate({
			height: '80%'
		}, [10000]);
		var total = 0, h = $(window).height(), top = $shop_coupon.find('.discount-coupon h2').height() || 0, con = $shop_coupon.find('.coupon-list');
		total = 0.8 * h;
		con.height(total - top + 'px');

		$(".mask-div").show();
		scrollheight = $(document).scrollTop();
		$("body").css("top", "-" + scrollheight + "px");
		$("body").addClass("visibly");
		$shop_coupon.find(".flow-goods-list").height($(window).height() - 100);
		$shop_coupon.find(".flow-goods-list").css({
			margin: "0"
		});
		$shop_coupon.find(".flow-goods-list").css({
			overflow: "hidden"
		});
	})

	// 优惠券弹框关闭
	$("body").on('click', '.coupon_close', function() {
		var shop_id = $(this).data("shop-id");
		var $shop_coupon = $("#select_coupon_" + shop_id);
		$(".mask-div").hide();
		$("body").css("top", "auto");
		$("body").removeClass("visibly");
		$(window).scrollTop(scrollheight);
		$shop_coupon.find(".flow-goods-list").removeAttr("style");
		$shop_coupon.animate({
			height: '0'
		}, [10000]);
	});

	// 领取红包
	$("body").on("click", ".bonus-receive", function() {
		var bonus_id = $(this).data("bonus-id");
		var target = $(this);
		$.bonus.receive(bonus_id, function(result) {
			if (result.code == 0) {
				$(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
				$.msg(result.message);
				return;
			} else if (result.code == 130) {
				$(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
			} else if (result.code == 131) {
				$(target).html("已抢光").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
			}
			$.msg(result.message, {
				time: 5000
			});
		});
	});

	// 结算
	$("body").on('click', '.submit-btn', function() {
		submit();
	});

	// 选择商品事件
	function select() {
		$('.SZY-CART-SUBMIT-LOADING').show();
		$('.SZY-CART-SUBMIT').hide();
		var cart_ids = new Array();
		// var shop_ids = new Array();
		$("#cart_list").find("input[type='checkbox']:checked").each(function() {
			cart_ids.push($(this).val());
		});
		var data = {};
		if (typeof (shop_id) != 'undefined' && shop_id > 0) {
			data.shop_id = shop_id
		}
		$.cart.select(cart_ids, data, function(result) {
			if (result.code == 0) {
				$(".content").replaceWith(result.data);
				// 重新初始化
				init();
			}
		});
	}
	select();

	// 初始化
	init();

});

var eventclick; // 防止重复点击

// 商品数量变动
function changeNumber() {

	$(".amount").find(":text").amount({
		min: 1,
		change: function(element, value) {
			
			if ($('.edit-quantity-mask') && $('.edit-quantity-mask').is(':visible')) {
				return;
			}

			var sku_id = $(element).data('sku-id');
			var goods_number = $(element).data('goods-number');
			var cart_id = $(element).data('cart-id');
			var number = value;
			var max = this.max;
			var min = this.min;

			$('.SZY-CART-SUBMIT-LOADING').show();
			$('.SZY-CART-SUBMIT').hide();

			$.cart.changeNumber(sku_id, number, cart_id, function(result) {
				if (result.code == 0) {
					$(".content").replaceWith(result.data);
					// 重新初始化
					init();
					$(element).focus();
				} else if (result.code == 95) {
					// 限够商品
					$(element).val(result.data.max);
				} else {
					$(element).val(goods_number);
				}
			}).always(function() {
				$('.SZY-CART-SUBMIT-LOADING').hide();
				$('.SZY-CART-SUBMIT').show();
			});
		}
	})
}

function init() {
	// 初始加载商品数量变动步进器
	changeNumber();

	// 设置页面上checkbox状态
	if ($("#cart_list").find(":checkbox").size() == $("#cart_list").find(":checkbox:checked").size()) {
		$('.all-checkbox').addClass('select');// 全选选中
	}

	$(".order-body").each(function() {
		if ($(this).find(":checkbox").length == $(this).find(":checkbox:checked").length) {
			$(this).find('.shop-checkbox').addClass('select');// 店铺选中
		}
	});

	if ($("#cart_list").find("input[type='checkbox']").length > 0) {
		if ($("#cart_list").find("input[type='checkbox']:checked").length > 0 && $("#cart_list").find("input[type='checkbox']:checked").length < $("#cart_list").find("input[type='checkbox']").length) {
			$("#batch_delet").html('删除').data('id', '1');
		} else {
			$("#batch_delet").html('清空').data('id', '0');
		}
	} else {
		$("#batch_delet").html('').data('id', '0');
	}
}

// 结算
function submit() {

	var data = {};
	if (typeof (shop_id) != 'undefined' && shop_id > 0) {
		data.shop_id = shop_id
	}

	$.loading.start();

	$.post('/cart/go-checkout.html', data, function(result) {

		$(".item-content").removeClass('bgcolor');

		if (result.code == 0) {
			// 正常提交
			window.location.href = result.data;
		} else if (result.code == 102) {
			// 购物车中商品库存不足
			for ( var i in result.data) {
				$(".goods_" + result.data[i]).addClass('bgcolor');
			}
			$.msg(result.message);
		} else {
			$.msg(result.message);
		}
	}, 'json');

}
