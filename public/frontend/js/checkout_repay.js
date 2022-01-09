$(function() {

	// 支付方式积分选中事件
	$("body").on('change', '#integral_enable', function() {
		changePayment();
	});

	// 改变积分值事件
	$("body").on('blur', '#integral', function() {
		changePayment();
	});

	// 支付方式余额选中事件
	$("body").on('change', '#balance_enable', function() {
		if ($(this).is(":checked")) {
			$(".SZY-BALANCE-PASSWORD").show();
		} else {
			$(".SZY-BALANCE-PASSWORD").hide();
		}
		changePayment();
	});

	// 支付方式余额选中事件
	$("body").on('blur', '#balance_password', function() {
		if ($(this).val() == '') {
			$(this).addClass("error");
		} else {
			$(this).removeClass("error");
		}
	});

	// 改变余额值事件
	$("body").on('change', '#balance', function() {
		if ($("#balance_enable").is(":checked")) {
			changePayment();
		}
	});

	// 结算页面提交
	$("body").on('click', '.gopay', function() {

		var target = $(this);

		if ($(target).data("loading")) {
			return;
		}

		var data = {};

		data.key = $("#key").val();
		data.order_id = $(this).data("order-id");
		data.order_sn = $("#order_sn").val();
		data.integral_enable = $("#integral_enable").is(":checked");
		data.balance_enable = $("#balance_enable").is(":checked");
		data.balance = $("#balance").val();
		data.integral = $("#integral").val();
		data.pay_code = $(".pay_code:checked").val();

		if ($(target).data("del_gift_id")) {
			data.del_gift_id = $(target).data("del_gift_id");
		}

		// 检查余额支付
		if ($("#balance_enable").is(":checked") && $(".SZY-BALANCE-PASSWORD").size() > 0) {

			var balance_password = $(".SZY-BALANCE-PASSWORD").find("#balance_password").val();

			if (balance_password == '') {
				$(".SZY-BALANCE-PASSWORD").show();
				$(".SZY-BALANCE-PASSWORD").find("#balance_password").addClass("error").focus();
				$.msg("请输入余额支付密码！", {
					time: 5000
				});
				return;
			}

			data.balance_password = balance_password;
		}

		var win_object = window.open();

		$(target).data("loading", true).html("正在提交...");

		var link_color_style = $("#link_color_style").prop("outerHTML");

		if (link_color_style == undefined || link_color_style == null) {
			win_object.document.write('<html><head><title>正在处理，请稍后...</title><meta charset="utf-8" /><meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" /><link type="text/css" rel="stylesheet" href="/css/common.css" /></head><body><div class="loading"><div class="loading-img"><img src="/images/cart-loading.gif"><img src="/images/page-loading.gif"></div></div></body></html>');
		} else {
			win_object.document.write('<html><head><title>正在处理，请稍后...</title><meta charset="utf-8" /><meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" /><link type="text/css" rel="stylesheet" href="/css/common.css" />' + link_color_style + '</head><body><div class="loading"><div class="loading-img"><i class="cart-type-icon"></i><img src="/images/page-loading.gif"></div></div></body></html>');
		}

		$.ajax({
			url: '/checkout/resubmit.html',
			type: 'POST',
			dataType: 'json',
			async: false,
			data: data,
			success: function(result) {
				if (result.code == 0) {
					// 打开页面
					win_object.location = result.data;
					$('.payment-box').show();
					$('.bg').show();
					return;
				}

				// 失败关闭窗口
				win_object.close();

				if (result.code == 106) {
					$.msg(result.message, {
						time: 5000
					}, function() {
						$.go(result.data);
					});
				} else if (result.code == 109) {
					for ( var i in result.data) {
						var goods_id = result.data[i].goods_id;
						$(".goods_" + goods_id).addClass('bgcolor');
					}
					$.msg(result.message, {
						time: 5000
					});
				} else if (result.code == 110) {
					$.msg(result.message, {
						time: 5000
					}, function() {
						$.go(result.data);
					});
				} else if (result.code == 111) {
					$.msg(result.message, {
						time: 5000
					}, function() {
						$.go(result.data);
					});
				} else if (result.code == 112) {
					$(".SZY-BALANCE-PASSWORD").find("#balance_password").addClass("error").focus();
					$.msg(result.message, {
						time: 5000
					});
				} else if (result.code == 113) {
					$.confirm(result.message, {
						closeBtn: 0,
						btn: ['继续提交', '取消']
					}, function() {
						$(target).data("del_gift_id", result.data.del_gift_id);
						$(target).click();
					}, function() {
						$.go('/cart.html');
					});
				} else {
					$("#" + result.data).addClass('bgcolor');
					$.msg(result.message, {
						time: 5000
					});
				}
			}
		}).always(function() {
			$(target).data("loading", false).html("确认交易");
		});
	});

	// 设置支付方式
	$("body").on('click', '.pay_code', function() {
		changePayment();
	})

	// 移除支付方式提示背景类
	$("body").on('click', '#pay_bank', function() {
		$(this).removeClass('bgcolor');
	})

	// 付款信息弹框关闭事件
	$("body").on('click', '.payment-box-oprate', function() {
		$('.payment-box').hide();
		$('.bg').hide();
	})

	// showAddress();

	if ($(".confirm-pay").size() > 0) {
		// 结算页面提交按钮滚动悬浮效果
		b = $(".confirm-pay").offset().top;
		c = $(".confirm-pay").outerHeight();
		$(window).scroll(function(event) {
			resetSubmitPosition(b, c);
		})
	}

});

function resetSubmitPosition(bb, cc) {
	if ($(".confirm-pay").size() > 0) {
		if (bb == undefined || cc == undefined) {
			b = $(".confirm-pay").offset().top;
			c = $(".confirm-pay").outerHeight();
		} else {
			b = bb;
			c = cc;
		}
		var d = $(window).height();
		var e = $(window).scrollTop();
		b - d - e + c - 10 > 0 ? ($(".confirm-pay").addClass("bottom")) : ($(".confirm-pay").removeClass("bottom"));
	}
}

var request = null;

// 变更设置支付信息
function changePayment(data) {

	if (request != null && $.isFunction(request.abort)) {
		// 终止请求
		request.abort();
	}

	var key = $("#key").val();
	var order_id = $("#order_id").val();
	var order_sn = $("#order_sn").val();

	var integral_enable = $("#integral_enable").is(":checked");
	var balance_enable = $("#balance_enable").is(":checked");
	var balance = $("#balance").val();
	var integral = $("#integral").val();
	var pay_code = $(".pay_code:checked").val();

	if (!data) {
		data = {}
	}

	request = $.post("/checkout/set-payment.html", {
		key: key,
		order_id: order_id,
		order_sn: order_sn,
		integral: integral,
		integral_enable: integral_enable ? 1 : 0,
		balance: balance,
		balance_enable: balance_enable ? 1 : 0,
		pay_code: pay_code,
	}, function(result) {
		var user_info = result.user_info;
		var order = result.order;
		var shop_orders = result.shop_orders;
		if (result.code == 0) {

			// 渲染支付信息
			renderPayment(user_info, order, shop_orders, balance_enable, integral_enable);

			if (result.message != null && $.trim(result.message).length > 0) {
				$.msg(result.message);
			}
		} else {
			$.msg(result.message, function() {
				$.go();
			});
		}
	}, "json");

	if (balance_enable) {
		$(".SZY-BALANCE-INFO").css("display", "inline-block");
	} else {
		$(".SZY-BALANCE-INFO").css("display", "none");
	}

	return request;
}

function renderPayment(user_info, order, shop_orders, balance_enable, integral_enable) {
	$("#balance").val(order.balance);

	$(".SZY-ORDER-BALANCE").not(":input").html(order.balance_format);

	$(".SZY-USER-BALANCE").html(user_info.balance_format);
	// 剩余应付金额
	$(".SZY-ORDER-MONEY-PAY").html(order.money_pay_format);
	// 订单总金额
	$(".SZY-ORDER-AMOUNT").html(order.order_amount_format);

	if (shop_orders && $.isArray(shop_orders)) {
		for (var i = 0; i < shop_orders.length; i++) {
			// 订单总金额
			$(".SZY-SHOP-ORDER-AMOUNT-" + shop_orders[i].shop_id).html(shop_orders[i].order_amount_format);
			// 红包金额
			$(".SZY-SHOP-BONUS-AMOUNT-" + shop_orders[i].shop_id).html("- " + shop_orders[i].shop_bonus_amount_format);
		}
	}

	// 应付款金额或者使用的余额大于0则展示支付列表
	if (order.money_pay > 0 || order.balance > 0) {
		$(".pay-type").show();
	} else {
		$(".pay-type").hide();
	}

	if (order.money_pay > 0) {
		$("#balance_money_pay").show();
		$("#paylist").show();
		$("#other_pay").show();
	} else {
		$("#balance_money_pay").hide();
		$("#paylist").hide();
		$("#other_pay").hide();
		$("#pay_bank").removeClass('bgcolor');
	}

	// 余额支付判断
	if (order.money_pay > 0 || order.balance > 0) {
		$("#pay_balance").show();
	} else {
		$("#pay_balance").hide();
		$("#balance_enable").prop("checked", false);
		$(".SZY-BALANCE-PASSWORD").hide();
		balance_enable = false;
	}

	if (balance_enable) {
		$(".SZY-BALANCE-INFO").css("display", "inline-block");
	} else {
		$(".SZY-BALANCE-INFO").css("display", "none");
	}

	// 计算提交按钮的位置
	resetSubmitPosition();
}
