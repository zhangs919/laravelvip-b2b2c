// JavaScript Document

var request = null;

var b = 0;
var c = 0;
if ($(".confirm-pay").size() > 0) {
	b = $(".confirm-pay").offset().top;
	c = $(".confirm-pay").outerHeight();
}

$(function() {
	

	var postscript_word_count = 255;

	// 买家提示字数检查
	$(".postscript").blur(function() {
		if ($(this).val().length > postscript_word_count) {
			$.msg("买家留言至多不能超过" + postscript_word_count + "个字！");
			$(this).focus();
		}
	});

	// 移除收货地址提示背景类
	$("body").on('click', '#addressinfo', function() {
		$(this).removeClass('bgcolor');
	})

	// 新增收货地址弹框
	$("body").on('click', '.addr-add', function() {

		// 设置添加收货地址回调函数
		$("body").data("add_address_callback", function(address_id) {
			changeAddress(address_id);
		});

		$('.addr-box').show();
		$('.bg').show();
		showAddressHtml();
	})

	$("body").on('click', '.addr-box-oprate', function() {
		$('.addr-box').hide();
		$('.bg').hide();
	})

	// 编辑收货址
	$("body").on('click', '.address-edit', function() {
		$('.addr-box').show();
		$('.bg').show();
		var address_id = $(this).data('address-id');
		var active_address_id = $(".address-list").find(".address-box").filter(".active").data("address-id");
		//是否为跨境订单
		var is_cross_border=$('#is_has_cross_border_goods').val();
			
		$.get('/user/address/edit.html', {
			address_id: address_id,
			checkout: 1,
			is_cross_border:is_cross_border
		}, function(result) {
			if (result.code == 0) {
				$('#edit-address-div').html(result.data);
				$("#btn_validate").click(function() {
					reloadUserAddress();
				});
			}
		}, "json");

		return false;
	})

	// 删除收货地址
	$("body").on('click', '.address-delete', function() {
		var address_id = $(this).data('address-id');
		var active_address_id = $(".address-list").find(".address-box").filter(".active").data("address-id");

		var box = $(this).parents(".address-box");
		$.confirm("您确定要删除此收货地址吗？", function() {
			$.get('/user/address/del.html', {
				address_id: address_id
			}, function(result) {
				if (result.code == 0) {
					if (active_address_id == address_id) {
						changeAddress(0);
					} else {
						reloadUserAddress();
					}

				}
				$.msg(result.message);
			}, "json");
		});
		return false;
	})

	// 设置收货地址为默认
	$("body").on('click', '.address-default', function() {
		var address_id = $(this).data('address-id');
		$.get('/user/address/set-default', {
			address_id: address_id
		}, function(result) {
			if (result.code == 0) {
				reloadUserAddress();
			}
			$.msg(result.message);
		}, "json");

		return false;
	})

	// 选择收货地址
	$("body").on('click', '.address-box', function() {
		var address_id = $(this).data('address-id');
		$(this).siblings().removeClass("active");
		$(this).addClass("active");
		changeAddress(address_id);
	})

	// 更多收货地址展开收缩效果
	$("body").on('click', '.addr-more', function() {
		// $(this).find('i').toggleClass('active');
		// $(this).find('span').html($(this).find('i').hasClass('active') ?
		// "收起收货地址" : "展开收货地址");
		// $('.address-more').toggle();
		$('.address-more').show();
		$(this).parent('.addr-more-btn').hide();
	});

	// 设置最佳送货时间
	$("#set_best_time").click(function() {
		return false;
	});

	// 设置最佳送货时间
	$("body").on('click', '.best_time', function() {
		if ($(this).is(":checked")) {
			var send_time_id = $(this).val();
			var send_time = '';

			$(".box").removeClass('active').removeClass('active2');
			// 指定送货时间，去掉后面的日期
			$(".best-time-desc").html('');
			// 指定送货时间，去掉已经选的日期
			$(".set_time").removeClass('current');
			$(this).parent().parent().addClass('active');
			setBestTime(send_time_id, send_time);
		}
	});

	// 设置最佳送货时间范围
	$("body").on('click', '.set_time', function() {
		$(".set_time").removeClass('current');
		$(this).addClass('current');

		$(".box").removeClass('active');
		$("#set_best_time").prop('checked', true);
		$("#set_best_time").parent().parent().addClass('active');

		var send_time_id = $("#set_best_time").val();
		var send_time = $(this).attr('data');

		setBestTime(send_time_id, send_time);
	})

	// 设置店铺配送方式（已作废）
	$("body").on('change', '.shipping-select', function() {

		var shipping_list = [{
			shop_id: $(this).data("shop-id"),
			shipping_id: $(this).val(),
		}];

		changePayment({
			shipping_list: shipping_list
		});

	})

	// 设置店铺配送方式
	$("body").on('click', '.postage-box', function() {

		var shop_id = $(this).data("shop-id");
		var shipping_id = $(this).data("id");
		var name = $(this).data("name");
		var price = $(this).data("price");
		var price_format = $(this).data("price-format");

		if ($(this).data("id") == 1) {
			// 自提点选择
			$(".logistics-choosen-" + shop_id).show();
			$(".bg").show();
		} else {

			$(".postage-box-" + shop_id).removeClass("active");
			$("#postage-box-" + shipping_id + "-" + shop_id).addClass("active");

			var shipping_list = [{
				shop_id: shop_id,
				shipping_id: shipping_id
			}];

			// 普通快递
			$(".logistics-choosen-" + shop_id).find(":input:radio").prop("checked", false);
			$(".logistics-choosen-" + shop_id).hide();
			// 运费
			if (price_format) {
				$(".postage-info-" + shop_id).html(name + price_format).show();
			} else {
				$(".postage-info-" + shop_id).html(name + '￥' + price).show();
			}
			$(".postage-down-" + shop_id).html('');
			$(".pickup-address").hide();
			$(".bg").hide();

			// 改变配送方式
			changePayment({
				shipping_list: shipping_list,
				refresh: 1
			});
		}
	})

	// 选中自提点
	$("body").on('click', ".logistics-radio", function() {
		var shop_id = $(this).data("shop_id");
		var shipping_id = $(this).data("id");
		var pickup_id = $(this).data("pickup_id");
		var pickup_name = $(this).data("pickup_name");

		$(".logistics-choosen-" + shop_id).hide();
		$(".bg").hide();

		if ($(".logistics-choosen-" + shop_id).find(":input:radio:checked").size() > 0) {

			$(".postage-box-" + shop_id).removeClass("active");
			$("#postage-box-" + shipping_id + "-" + shop_id).addClass("active");

			$("#pickup_name").html(pickup_name);
			$("#pickup_id").html(pickup_id);

			$(".postage-info-" + shop_id).html('免运费').show();
			$(".pickup-address").show();

			var shipping_list = [{
				shop_id: shop_id,
				shipping_id: 1,
				pickup_id: pickup_id
			}];

			// 改变配送方式
			changePayment({
				shipping_list: shipping_list,
				refresh: 1
			});
		}
	});

	// 自提点搜索
	$("body").on('click', '.btn-primary', function() {
		var keyword = $(".logistics-search-input").val();
		var shop_id = $(this).data('shop_id');
		$.post("/checkout/search-pickup.html", {
			"keyword": keyword,
			"shop_id": shop_id
		}, function(result) {
			if (result.code == 0) {
				$(".logistics-store-list-" + shop_id).html(result.data);
			}
		}, "json");
	})

	$("body").on('click', '.pickup-edit', function() {
		$(".logistics-choosen-" + $(this).data("shop-id")).show();
		// $(".postage-info-" +
		// $(this).data("shop-id")).html('您可以选择离您最近的自提点上门提货，到店自提免运费');
		$(".bg").show();
	});

	$("body").on('click', '.postage-box-pickup', function() {
		var pickup_id = $(this).data("id");
	})

	// 自提点选择弹框关闭事件
	$("body").on('click', '.box-oprate', function() {

		$('.bomb-box').hide();
		$('.bg').hide();
	})

	// 设置店铺使用红包
	$("body").on('change', '.shop-bonus', function() {
		var bonus_list = [{
			shop_id: $(this).data('shop-id'),
			bonus_id: $(this).val()
		}];

		changePayment({
			bonus_list: bonus_list
		});
	});

	// 设置店铺储值卡
	$("body").on('change', '.shop-store-card', function() {
		var store_card_list = [{
			shop_id: $(this).data('shop-id'),
			card_id: $(this).val()
		}];

		changePayment({
			store_card_list: store_card_list
		});
	});

	// 设置系统使用红包
	$("body").on('click', '.system-bonus', function() {

		$(this).parent("li").siblings().removeClass("current");
		$(this).parent("li").toggleClass("current");

		var user_bonus_id = 0;

		if ($(this).parent("li").hasClass("current")) {
			user_bonus_id = $(this).data("user-bonus-id");
		}

		var bonus_list = [{
			shop_id: 0,
			bonus_id: user_bonus_id
		}];

		changePayment({
			bonus_list: bonus_list
		});
	})

	// 修改发票内容事件
	$("body").on('click', '.inv-info .modify', function() {
		$('.invoice-box').show();
		$('.bg').show();
	})

	// 发票选弹框关闭事件
	$("body").on('click', '.invoice-box-oprate', function() {
		$('.invoice-box').hide();
		$('.bg').hide();
	})

	// 发票标题点击切换选中状态
	$("body").on('click', '.invoice-title', function() {
		$(this).addClass('invoice-item-selected').siblings().removeClass('invoice-item-selected');
		if ($('#add-invoice').hasClass('invoice-item-selected')) {
			$('#save-invoice').removeClass('hide').find('input').removeAttr('readonly').val('').focus();
		} else {
			$('#save-invoice').addClass('hide');
			$('#add-invoice').val('');
		}
		// 选中单选按钮
		$('.invoice-title').find(":radio").prop("checked", false);
		$(this).find(":radio").prop("checked", true);
	})

	// 普通发票内容切换
	$("body").on('click', '.invoice-type', function() {
		$(this).addClass('invoice-item-selected').siblings().removeClass('invoice-item-selected');
		// 选中单选按钮
		$(this).find(":radio").prop("checked", true);
	})

	// 保存发票设置
	$("body").on('click', '.inv_submit', function() {
		changeInvoice();
	})

	// 取消发票
	$("body").on('click', '.inv_cancle', function() {
		$('.invoice-box').hide();
		$('.bg').hide();
	})

	// 选择发票类型
	$("body").on('click', '.tab-nav-item', function() {
		if ($(this).hasClass('disabled') == false) {
			$(this).addClass('tab-item-selected').siblings().removeClass('tab-item-selected');
			var invoice_type = $(this).data('invoice-type');
			$("form[id^='invoice_type_']").hide();  
			$("#invoice_type_" + invoice_type).show();
		}
	})

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
	$("body").on('blur', '#balance', function() {
		if ($("#balance_enable").is(":checked")) {
			changePayment();
		}
	})

	// 订单返现弹框关闭事件
	$("body").on('click', '.order-cashback .close', function() {
		$('.order-cashback').hide();
		$('.bg').hide();
	})
	
	// 满减送弹窗关闭事件
	$("body").on('click', '.full-reduction .close', function() {
		$('.full-reduction').hide();
		$('.bg').hide();
	})

	// 结算页面提交
	$("body").on('click', '.gopay', function() {
		// 判断配送方式是否选中
		// var checkShiped = $('.postage-out-box .postage-box').filter('.active').length;
		// if (0 == checkShiped) {
		// 	$.msg('请选择配送方式');
		// 	return;
		// }

		var target = $(this);

		if ($(target).data("loading")) {
			return;
		}

		var data = {};

		var is_valid = true;

		// 店铺买家留言
		var postscript = new Object();
		$(".postscript").each(function() {
			var shop_id = $(this).data("shop-id");
			postscript[shop_id] = $(this).val();

			if ($(this).val().length > postscript_word_count) {
				$.msg("买家留言至多不能超过" + postscript_word_count + "个字！");
				$(this).focus();
				is_valid = false;
				return false;
			}
		})

		// 送货时间
		if ($('.delivery-time').length > 0 && $('.delivery-time').find('input:radio[name="best_time"]:checked').length == 0) {
			$.msg("请选择送货时间！");
			is_valid = false;
		}

		if (is_valid == false) {
			return;
		}

		data.postscript = postscript;

		// 收货地址检查
		if ($(".address-list").size() > 0) {
			var active_address_id = $(".address-list").find(".address-box").filter(".active").data("address-id");

			var check_address = $(".address-list").data("check-address");

			if (check_address == 1 && (active_address_id == null || active_address_id == undefined)) {
				$("#addressinfo").addClass('bgcolor');
				$("body,html").animate({
					scrollTop: 0
				}, 200);
				$.msg("请选择收货地址");
				return;
			}
		}

		// 检查用户自定义信息
		if ($("#user_information").size() > 0) {
			var ui_valid = true;
			var user_information = [];

			if (typeof (ui_error_msg) != 'undefined') {
				ui_error_msg = [];
			}
			$.each($('.user-information-input'), function() {
				if (validUserInformation($(this)) == false) {
					ui_valid = false;
				}
				if ($(this).val() != '') {
					user_information.push({
						'name': $(this).data('name'),
						'type': $(this).data('type'),
						'value': $(this).val()
					});
				}
				// 构造数据
			});
			if (ui_valid == false) {
				if (typeof (ui_error_msg) != 'undefined') {
					$.msg(ui_error_msg.join("<br/>"));
				}
				return;
			}

			data.user_information = user_information;
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

		var link_color_style = $("#link_color_style").prop("outerHTML");

		if (link_color_style == undefined || link_color_style == null) {
			win_object.document.write('<html><head><title>正在处理，请稍后...</title><meta charset="utf-8" /><meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" /><link type="text/css" rel="stylesheet" href="/css/common.css" /></head><body><div class="loading"><div class="loading-img"><img src="/images/cart-loading.gif"><img src="/images/page-loading.gif"></div></div></body></html>');
		} else {
			win_object.document.write('<html><head><title>正在处理，请稍后...</title><meta charset="utf-8" /><meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" /><link type="text/css" rel="stylesheet" href="/css/common.css" />' + link_color_style + '</head><body><div class="loading"><div class="loading-img"><i class="cart-type-icon"></i><img src="/images/page-loading.gif"></div></div></body></html>');
		}

		$(target).data("loading", true).html("正在提交...");

		$.ajax({
			url: '/checkout/submit.html',
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
						$(target).click();
					}, function() {
						$.go('/cart.html');
					});
				} else if (result.code == 114) {
					$.msg(result.message, {
						time: 5000
					}, function() {
						$.go('/checkout.html');
					});
				} else if(result.code == 115){
					$.msg(result.message, {
						time: 5000
					});
				} else{
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

	// 平台红包使用取消勾选
	// $('.platform-item').hover(function(){
	// if($(this).parent("li").hasClass("platform-current")){
	// $(this).find(".item-cancel").toggleClass("hide");
	// }else{
	// $(".item-cancel").addClass("hide");
	// }
	// })
	// 平台红包—限品类
	$(".range-use").hover(function() {
		$(this).find(".platform-type-tips").toggleClass("hide");
	});
	// 平台红包点击收缩效果
	$('.platform-box .title').on('click', function() {
		$(this).find('.arrow').toggleClass('active').parent('.title').next('.platform-list').slideToggle("normal", function() {
			resetSubmitPosition();
		});
		resetSubmitPosition();
	});

	if ($(".address-list").find(".active").data("address-position") == "," && $(".address-list").find(".active").data("region_code_mode") == 0) {
		$.alert("为了更快速、更精确的将商品送达您的手中，请编辑您选择的收货地址，并在地图中精确定位您收货位置", function() {
			$(".address-list").find(".active").find(".address-edit").click();
		});
	} else if ($(".address-list").find(".address-box").size() == 0 && $(".address-list").data("check-address") == 1) {
		$(".address").find(".addr-add").click();
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
		var f = $('.site-footer').height();
		b - d - e + c - 10 > 0 ? ($(".confirm-pay").addClass("bottom")) : ($(".confirm-pay").removeClass("bottom"));
	}
}

/**
 * 重载用户地址
 */
function reloadUserAddress() {
	$.get('/checkout/user-address', {}, function(result) {
		if (result.code == 0) {
			$("#user_address_list").replaceWith($.parseHTML(result.data));
		}
	}, "json");
}

// 设置最佳送货时间
function setBestTime(send_time_id, send_time) {
	$.post('/checkout/change-best-time', {
		send_time_id: send_time_id,
		send_time: send_time
	}, function(result) {
		if (result.code == 0) {
			if (send_time.length > 0) {
				$('.seltimebox').parent().find("font").html(send_time);
				$('.seltimebox').parent().removeClass('active').addClass('active2');
			}
		}
	}, "json");
}

// 调用发货地址添加地址显示层
function showAddressHtml() {
	//是否为跨境订单
	var is_cross_border=$('#is_has_cross_border_goods').val();
	$.get('/user/address/add.html', {
		checkout: 1,
		is_cross_border:is_cross_border
	}, function(result) {
		if (result.code == 0) {
			$('#edit-address-div').html(result.data);
		} else {
			$.msg(result.message, {
				time: 5000
			});
		}
	}, 'JSON');
}

// 取消添加地址
function cancel() {
	$('.addr-box').hide();
	$('.bg').hide();
}

// 设置本次订单的收货地址
function changeAddress(address_id) {
	$.post('/checkout/change-address', {
		address_id: address_id
	}, function(result) {
		if (result.code == 0) {
			// 更新是否检查收货地址
			setCheckAddress(result.check_address);

			$.go(window.location.href);
		} else {
			$.msg(result.message, {
				time: 5000
			})
		}
	}, 'json');
}

// 设置本次订单的自提点
function changePickup(pickup_id, shop_id) {
	$.post('/checkout/change-pickup', {
		pickup_id: pickup_id,
		shop_id: shop_id
	}, function(result) {
		if (result.code == 0) {
			// setTimeout(function() {
			// $.go(window.location.href);
			// }, 2000);

			// 更新是否检查收货地址
			setCheckAddress(result.check_address);

			// 计算提交按钮的位置
			resetSubmitPosition();
		} else {
			$.msg(result.message, {
				time: 5000
			})
		}
	}, 'json');
}

// 设置店铺配送方式
function changeShipping(shipping_id, shop_id) {
	$.post('/checkout/change-shipping', {
		shop_id: shop_id,
		ship_id: shipping_id
	}, function(result) {
		if (result.code == 0) {

			// 更新是否检查收货地址
			setCheckAddress(result.check_address);

			// 渲染支付信息
			renderPayment(result.user_info, result.order, result.shop_orders, false, false);
		}
	}, "json");
}

// 设置店铺红包活动
function set_shop_bonus(bonus_id, shop_id) {
	$.ajax({
		type: 'GET',
		url: '/checkout/default/set-shop-bonus',
		data: {
			shop_id: shop_id,
			bonus_id: bonus_id
		},
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				$("#shop_count_" + shop_id).html(result.data.shop_count);
				$("#order_amount").html(result.data.count)
				$("#pay_balance").html(result.data.pay_balance)
				$("#pay_paypoint").html(result.data.pay_point)
				$("#pay_count").html(result.data.pay_count)
				$("#checkout_amount").html(result.data.checkout_amount)
			}
		}
	});
}

// 变更设置支付信息
function changePayment(data) {

	if (request != null && $.isFunction(request.abort)) {
		// 终止请求
		request.abort();
	}

	var integral_enable = $("#integral_enable").is(":checked");
	var balance_enable = $("#balance_enable").is(":checked");
	var balance = $("#balance").val();
	var integral = $("#integral").val();
	var integral_amount = $('#integral_amount').val();
	var pay_code = $(".pay_code:checked").val();

	if (!data) {
		data = {}
	}
	
	// 判断普通快递和上门自提切换的时候，如果有限购的商品提示图片，则判断其是显示还是隐藏
	if ($(".no-support").size() > 0 && data.shipping_list && $.isArray(data.shipping_list)) {
		for (var i = 0; i < data.shipping_list.length; i++) {
			var shop_id = data.shipping_list[i].shop_id;
			var shipping_id = data.shipping_list[i].shipping_id;
			var pickup_id = data.shipping_list[i].pickup_id;

			if (shop_id > 0 && pickup_id > 0) {
				// 隐藏不支持配送的图片
				$(".no-support[data-shop-id='" + shop_id + "']").hide();
			} else {
				// 隐藏不支持配送的图片
				$(".no-support[data-shop-id='" + shop_id + "']").show();
			}
		}
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
	
	// 加载等待效果
	$.loading.start();

	request = $.post("/checkout/change-payment", {
		integral: integral,
		integral_amount: integral_amount,
		integral_enable: integral_enable ? 1 : 0,
		balance: balance_enable ? balance : 0,
		balance_enable: balance_enable ? 1 : 0,
		pay_code: pay_code,
		shipping_list: data.shipping_list,
		bonus_list: data.bonus_list,
		store_card_list: data.store_card_list
	}, function(result) {
		var user_info = result.user_info;
		var order = result.order;
		var shop_orders = result.shop_orders;
		var pickup_id = result.pickup_id;
		if (result.code == 0) {
			if (data.refresh) {
				$('#pay_bank').html(result.pay_bank_html);
			}

			// 更新是否检查收货地址
			setCheckAddress(result.check_address);

			// 渲染支付信息
			renderPayment(user_info, order, shop_orders, balance_enable, integral_enable, result.pay_list, pickup_id);

			if (result.message != null && $.trim(result.message).length > 0) {
				$.msg(result.message);
			}
		} else {
			$.msg(result.message);
		}
	}, "json").always(function(){
		$.loading.stop();
	});

	if (balance_enable) {
		$(".SZY-BALANCE-INFO").css("display", "inline-block");
	} else {
		$(".SZY-BALANCE-INFO").css("display", "none");
	}
}

function renderPayment(user_info, order, shop_orders, balance_enable, integral_enable, pay_list, pickup_id) {
	$("#balance").val(order.balance);

	$(".pay_code[value='" + order.pay_code + "']").prop("checked", true);

	// 支付方式设置
	if ($.isArray(pay_list)) {
		for (var i = 0; i < pay_list.length; i++) {
			var item = pay_list[i];

			var target = $(".pay_code[value='" + item.code + "']");

			if (item.disabled == 0) {
				$(target).parents("li").show();
			} else {
				$(target).parents("li").hide();
			}

			if (item.checked == "checked") {
				$(target).prop("checked", true);
			}

			if (item.tips != undefined && item.tips != null && item.tips != "") {
				$(target).parents("li").find(".pay-tips").show();
				$(target).parents("li").find(".pay-tips-name").html("<i></i>" + item.tips);
			} else {
				$(target).parents("li").find(".pay-tips").hide();
			}
		}
	}

	$(".SZY-ORDER-BALANCE").not(":input").html(order.balance_format);

	$(".SZY-USER-BALANCE").html(user_info.balance_format);
	// 剩余应付金额
	$(".SZY-ORDER-MONEY-PAY").html(order.money_pay_format);
	// 订单总金额
	$(".SZY-ORDER-AMOUNT").html(order.order_amount_format);
	// 红包总金额
	$(".SZY-ORDER-BONUS-AMOUNT").html(order.total_bonus_amount_format);

	$(".SZY-ORDER-INTEGRAL").html("-" + order.integral_amount_format);
	// 储值卡总金额
	if (order.shop_store_card_amount > 0) {
		$(".SZY-ORDER-STORE-CARD").show();
		$(".SZY-ORDER-STORE-CARD-AMOUNT").html(order.shop_store_card_amount_format);
	} else {
		$(".SZY-ORDER-STORE-CARD").hide();
	}
	// 积分抵扣
	if (order.integral_amount > 0) {
		$(".SZY-ORDER-INTEGRAL").removeClass('hide');
	} else {
		$(".SZY-ORDER-INTEGRAL").addClass('hide');
	}
	$(".SZY-ORDER-INTEGRAL-AMOUNT").html(order.integral_amount_format);
	// 货到付款加价
	if (order.is_cod == 1 && parseFloat(order.cash_more) > 0) {
		$(".SZY-ORDER-CASH-MORE-AMOUNT").show();
	} else {
		$(".SZY-ORDER-CASH-MORE-AMOUNT").hide();
	}
	// 额外配送费
	if (pickup_id > 0) {
		$(".SZY-ORDER-SHIPPING-FEE-AMOUNT").hide();
	} else {
		$(".SZY-ORDER-SHIPPING-FEE-AMOUNT").show();
	}
	// 总运费
	$(".SZY-SHIPPING-FEE-AMOUNT").html(order.shipping_fee_format);

	if (shop_orders && $.isArray(shop_orders)) {
		for (var i = 0; i < shop_orders.length; i++) {
			// 订单总金额
			$(".SZY-SHOP-ORDER-AMOUNT-" + shop_orders[i].shop_id).html(shop_orders[i].order_amount_format);
			// 红包金额
			$(".SZY-SHOP-BONUS-AMOUNT-" + shop_orders[i].shop_id).html("- " + shop_orders[i].shop_bonus_amount_format);
			// 储值卡金额
			$(".SZY-SHOP-STORE-CARD-AMOUNT-" + shop_orders[i].shop_id).html("- " + shop_orders[i].shop_store_card_amount_format);

			$("#surplus_amount_" + shop_orders[i].shop_id).val(shop_orders[i].shop_store_card_amount);
		}
	}

	if (order) {
		$(".SZY-BONUS-NAME").html(order.bonus_name);
		$(".SZY-BONUS-AMOUNT").html("- " + order.bonus_amount_format);
		if (order.bonus_id > 0) {
			$(".SZY-BONUS-AMOUNT-CONTAINER").show();
		} else {
			$(".SZY-BONUS-AMOUNT-CONTAINER").hide();
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
		// 余额支付是否被选中
		if (order.balance > 0) {
			$("#balance_enable").prop("checked", true);
		} else {
			$("#balance_enable").prop("checked", false);
		}
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
	
	if (pickup_id > 0) {
		$(".SZY-SHOP-OTHER-SHIPPING-FEE").hide();
	} else {
		$(".SZY-SHOP-OTHER-SHIPPING-FEE").show();
	}

	// 计算提交按钮的位置
	resetSubmitPosition();
}

// 发票调用
function show_invoice() {
	$.ajax({
		type: 'GET',
		url: '/checkout/default/show-invoice',
		data: {},
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				$(".invoice-coupon").html(result.data);
			}
		}
	});
}

// 发票内容获取
function changeInvoice() {

	var invoice = {};
	var inv_type = $('.tab-item-selected').data('invoice-type');

	if (inv_type == 1) {
		// 普通发票
		invoice = $("#invoice_type_1").serializeJson();
		if (invoice.inv_title != "个人") {
			if ($.trim(invoice.inv_company) == "") {
				$.msg("单位名称不能为空");
				$("#invoice_type_1").find("[name='inv_company']").focus();
				return;
			} else if ($.trim(invoice.inv_taxpayers) == "") {
				$.msg("纳税人识别号不能为空");
				$("#invoice_type_1").find("[name='inv_taxpayers']").focus();
				return;
			} else {
				invoice.inv_title = $.trim(invoice.inv_company);
			}
		}
	} else if (inv_type == 2) {
		var validator = $("#invoice_type_2").validate();
		if (!validator.form()) {
			return;
		}
		invoice = $("#invoice_type_2").serializeJson();
	}

	$.post('/checkout/change-invoice', invoice, function(result) {
		if (result.code == 0) {
			if (result.data == null || result.data == '') {
				result.data = [];
			}
			var html = "<span>" + result.data.join("</span><span>") + "</span>"
			$('.inv-info').find("span").remove();
			$('.inv-info').prepend(html);

			// 成功后关闭
			$('.invoice-box').hide();
			$('.bg').hide();
		} else {
			$.msg(result.message, {
				time: 5000
			});
		}
	}, "json");

	return invoice;
}

function setCheckAddress(check_address) {

	if (check_address === undefined) {
		return;
	}

	$(".address-list").data("check-address", check_address);

	if (check_address == 1) {
		if ($(".address-list").size() > 0) {

			var active_address_id = $(".address-list").find(".address-box").filter(".active").data("address-id");

			if (active_address_id == null || active_address_id == undefined) {
				$("#addressinfo").addClass('bgcolor');
				$("body,html").animate({
					scrollTop: 0
				}, 200);
				$.msg("请选择收货地址");
			}
		}
	} else {
		$("#addressinfo").removeClass('bgcolor');
	}
}