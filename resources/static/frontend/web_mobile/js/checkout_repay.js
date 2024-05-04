$(function() {

	// 支付密码返回
	$('.back-checkout').click(function() {
		$('.balance-password-box').removeClass('show').addClass('hide');
	});
	
	// 支付方式积分选中事件
	$("body").on('change', '#paypoint_stats', function() {
		changePayment();
	});
	
	// 改变积分值事件
	$("body").on('blur', '#integral', function() {
		changePayment();
	});

	// 支付方式余额选中事件
	$("body").on('change', '#balance_enable', function() {
		changePayment();
		/*
		 * $('html, body').animate({ scrollTop: $(document).height() }, 300);
		 */

	});

	// 改变余额值事件
	$("body").on('blur', '#balance', function() {
		if ($("#balance_enable").is(":checked")) {
			changePayment();
		}
	});

	// 设置支付方式
	$("body").on('click', '.payment-tab li', function() {
		var $radio = $(this).find("input[type=radio]"), $flag = $radio.is(":checked");
		if (!$flag) {
			$radio.prop("checked", true);
			changePayment();
		}
	});

	$(".pay-code").change(function() {
		changePayment();
	});
	
	// 结算页面提交
	$("body").on('click', '.gopay', function() {
		var target = $(this);

		if ($(target).data("loading")) {
			return;
		}

		$.loading.start();
		var data = {};

		data.order_id = $(this).data("order-id");
		data.integral_enable = $("#integral_enable").is(":checked");
		data.balance_enable = $("#balance_enable").is(":checked");
		data.balance = $("#balance").val();
		data.integral = $("#integral").val();
		data.pay_code = $(".pay-code:checked").val();
		data.key = $('#payment_key').val();
		
		if ($(target).data("del_gift_id")) {
			data.del_gift_id = $(target).data("del_gift_id");
		}

		// 检查余额弹出框
		if ($("#balance_enable").is(":checked") && $(".SZY-BALANCE-PASSWORD").size() > 0) {
			if ($('.balance-password-box').hasClass('hide')) {
				$('.balance-password-box').removeClass('hide').addClass('show');
				$('#balance_password').focus();
				$.loading.stop();
				return;
			} else {
				var balance_password = $(".SZY-BALANCE-PASSWORD").find("#balance_password").val();
				if (balance_password == '') {
					$(".SZY-BALANCE-PASSWORD").find("#balance_password").addClass("error").focus();
					$.msg("请输入余额支付密码！", {
						time: 5000
					});
					return;
				}
				data.balance_password = balance_password;
			}

		}
		
		if (window.__wxjs_environment === 'miniprogram') {
			data.is_miniprogram = 1;
		}

		$(target).data("loading", true).html("正在提交");

		$.post('/checkout/resubmit.html', data, function(result) {
			if (result.code == 0) {
				$.go(result.data);
			} else if (result.code == 106) {
				$.msg(result.message);
				$.go(result.data);
			} else if (result.code == 109) {
				$.msg(result.message);
				for ( var i in result.data) {
					var goods_id = result.data[i].goods_id;
					if ($(".goods_" + goods_id).find('.no-goods-tip').length == 0) {
						$(".goods_" + goods_id).find('dl').append('<div class="no-goods-tip"></div>');
					}
				}
			} else if (result.code == 110) {
				$.msg(result.message, {
					time: 3000
				}, function() {
					$.go(result.data);
				});
				$.msg(result.message);
			} else if (result.code == 112) {
				$(".SZY-BALANCE-PASSWORD").find("#balance_password").focus();
				$.msg(result.message, {
					time: 3000
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
				$.msg(result.message);
			}

		}, 'json').always(function() {
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
	});

});

// 变更设置支付信息
function changePayment(data) {

	var order_id = $("#order_id").val();

	var integral_enable = $("#integral_enable").is(":checked");
	var balance_enable = $("#balance_enable").is(":checked");
	var balance = $("#balance").val();
	var integral = $("#integral").val();
	var pay_code = $(".pay-code:checked").val();
	var key = $('#payment_key').val();
	
	if (!data) {
		data = {}
	}
	
	/**
	// 余额优先则优先使用余额支付
	if(typeof(balance_first) != "undefined" && balance_first == true){
		// 强制使用余额
		if(balance_enable == 0){
			balance_enable = 1;
			$("#balance_enable").prop("checked", true);
		}
		// 有多少使用多少
		balance = 0;
	}
	**/
	
	$.loading.start();
	
	$(".gopay").data("loading", true).html("请稍等...");

	$.post("/checkout/set-payment.html", {
		order_id: order_id,
		integral: integral,
		integral_enable: integral_enable ? 1 : 0,
		balance: balance,
		balance_enable: balance_enable ? 1 : 0,
		pay_code: pay_code,
		key: key
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
			$.msg(result.message);
		}
	}, "json").always(function(){
		$.loading.stop();
		$(".gopay").data("loading", false).html("立即付款");
	});

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

	if (order.money_pay > 0) {
		$("#balance_money_pay").show();
		$("#paylist").show();
	} else {
		$("#balance_money_pay").hide();
		$("#paylist").hide();
		$("#pay_bank").removeClass('bgcolor');
	}

	if (balance_enable) {
		$(".SZY-BALANCE-INFO").css("display", "inline-block");
		$(".SZY-BALANCE-INFO").html(",使用" + order.balance_format);
	} else {
		$(".SZY-BALANCE-INFO").css("display", "none");
	}
	//增加小程序判断
	if (window.__wxjs_environment === 'miniprogram') {
		$.each($('#paylist li'),function(){
			if(! $(this).hasClass('weixin')){
				$(this).hide();
			}
		});
	}
}
