// JavaScript Document
var scrollheight = 0;
var request = null;
$(function() {

	var postscript_word_count = 255;

	// 买家提示字数检查
	$(".postscript").blur(function() {
		if ($(this).val().length > postscript_word_count) {
			$.msg("买家留言至多不能超过" + postscript_word_count + "个字！");
			$(this).focus();
		}
	});

	// 新增收货地址弹框
	$("body").on('click', '.addr-add', function() {
		$.go('/user/address/add.html?back_url=/checkout/user-address.html');
	});

	$("body").on('click', '.new-addr-add', function() {
		$.go('/user/address/add.html?back_url=/checkout.html');
	});

	$("body").on('click', '.addr-coupon-oprate', function() {
		$('.addr-coupon').hide();
		$('.bg').hide();
	})

	// 编辑收货址
	$("body").on('click', '.addr-modify', function() {
		var address_id = $(this).attr('data');
		$.go('/user/address/edit.html?address_id=' + address_id + '&back_url=/checkout/user-address.html');
	});

	// 删除收货地址
	$("body").on('click', '.address-delete', function() {

		var obj = $(this);
		var address_id = $(this).data('address_id');
		var box = $(this).parents(".address-add-box");
		$.confirm("您确定要删除此记录吗？", function() {
			$.get('/user/address/del', {
				address_id: address_id
			}, function(result) {
				console.info(result);
				if (result.code == 0) {
					box.remove();
					if (result.data == 0) {
						window.location.reload();
					}
				}
				$.msg(result.message);
			}, "json");
		});
		return false;
	});

	// 设置收货地址为默认
	$("body").on('click', '.set-deftip', function() {
		var obj = $(this);
		if (obj.hasClass('addl-red')) {
			return;
		}
		$.loading.start();
		var address_id = obj.data('address-id');
		$.get('/user/address/set-default', {
			address_id: address_id
		}, function(result) {
			$.loading.stop();
			if (result.code == 0) {
				$('.set-deftip').removeClass('addl-red').addClass('addl-hui');
				obj.addClass('addl-red').removeClass('addl-hui');
			}
			$.msg(result.message);
		}, "json");

		return false;
	});

	// 选择收货地址
	$("body").on('click', '.address-box', function() {
		var address_id = $(this).data('address-id');
		$(this).siblings().removeClass("active");
		$(this).addClass("active");
		changeAddress(address_id);
	})

	// 设置最佳送货时间
	$("body").on('click', '.best-time-li', function() {
		var $radio = $(this).find("input[type=radio]");
		var $flag = $radio.is(":checked");
		if (!$flag) {
			$radio.prop("checked", 'checked');
			var send_time_id = $radio.val();
			var send_time = $radio.data('set-time');
			// 指定送货时间，去掉后面的日期
			$(".best-time-desc").html('');
			// 指定送货时间，去掉已经选的日期
			$(".set_time").removeClass('current');
			setBestTime(send_time_id, send_time);
			$("#set_time_blcok").next().slideToggle();
			$("#set_time_blcok").removeClass('active');
		}
	});

	$(".best-time").change(function() {
		var send_time_id = $(this).val();
		var send_time = $(this).data('set-time');
		$(".best-time-desc").html('');
		// $("#set_best_time").prop("checked", 'checked');
		// 指定送货时间，去掉已经选的日期
		$(".set_time").removeClass('current');
		setBestTime(send_time_id, send_time);
		$("#set_time_blcok").next().slideToggle();
		$("#set_time_blcok").removeClass('active');
	});

	// 设置最佳送货时间范围
	$("body").on('click', '.set_time', function() {
		$(".set_time").removeClass('current');
		$(this).addClass('current');

		$("#set_best_time").prop("checked", 'checked');
		$("#set_best_time").parent().parent().addClass('active');

		var send_time_id = $("#set_best_time").val();
		var send_time = $(this).data('set-time');
		setBestTime(send_time_id, send_time);
		close_seltimebox_coupon();
		$("#set_time_blcok").next().slideToggle();
		$("#set_time_blcok").removeClass('active');
	})

	// 点击自定义送货时间
	$("body").on('click', '#set_best_time_box', function() {
		seltimebox_coupon();
		return false;
	});

	// 设置店铺配送方式
	$('.shipping-select-box li').click(function() {
		var shop_id = $(this).data("shop-id");
		var shipping_id = $(this).data("id");
		var name = $(this).data("name");
		var price = $(this).data("price");
		var price_format = $(this).data("price-format");
		scrollheight = $(document).scrollTop();

		if (shipping_id == 1) {
			$(".logistics-choosen-" + shop_id).removeClass('pickup-bomb-hide').addClass('pickup-bomb-show');
			$(".postage-info-" + shop_id).html('您可以选择离您最近的自提点上门提货，到店自提免运费');
			$(".mask-div").show();
			$("body").css("top", "-" + scrollheight + "px");
			$("body").addClass("visibly");
		} else {
			$(this).addClass("active").siblings().removeClass("active");
			$('.logistics-store-list-' + shop_id).find('.logistics-radio').removeAttr("checked");
			$(".logistics-choosen-" + shop_id).removeClass('pickup-bomb-show').addClass('pickup-bomb-hide');
			if (price > 0) {
				if (price_format) {
					$(".postage-info-" + shop_id).html('<em class="price-color">' + price_format + '</em>');
				} else {
					$(".postage-info-" + shop_id).html('<em class="price-color">' + price + '</em>');
				}
			} else {
				$(".postage-info-" + shop_id).html('<em class="price-color">免运费</em>');
			}
			$("#pickup_address_" + shop_id).hide();
			var shipping_list = [{
				shop_id: shop_id,
				shipping_id: shipping_id,
			}];
			changePayment({
				shipping_list: shipping_list,
				refresh: 1
			});
		}
	});

	// 提货人弹层
	$('.consignee-name a').click(function() {
		var footHeight = $('.choose-foot').height();
		var consigneeHeight = $('.consignee-list').height();
		$(".consignee-popup").animate({
			height: footHeight + consigneeHeight + 68
		}, [10000]);
		$('.consignee-popup .choose-foot').show()
		$(".consignee-bg").show();
		scrollheight = $(document).scrollTop();
		$("body").css("top", "-" + scrollheight + "px");
		$("body").addClass("visibly");
		setTimeout(function() {
			setTimeout(function() {
				$('.consignee-close').addClass('show');
			}, 300);
		}, 150)
	});

	// 提货人层关闭
	$('.consignee-close').click(function() {
		$('.consignee-bg').hide();
		$('.consignee-popup .choose-foot').hide()
		$("body").css("top", "auto");
		$("body").removeClass("visibly");
		$(window).scrollTop(scrollheight);
		$('.consignee-popup').animate({
			height: 0
		}, [10000]);
		$('.consignee-close').removeClass('show');
	});

	// 选择提货地址
	$('.consignee-address a').click(function() {
		var shop_id = $(this).data('id');
		$(".logistics-choosen-" + shop_id).removeClass('pickup-bomb-hide').addClass('pickup-bomb-show');
		$(".postage-info-" + shop_id).html('');
		$(".mask-div").show();
		$("body").css("top", "-" + scrollheight + "px");
		$("body").addClass("visibly");
	});

	// 选择提货人
	$("body").on('click', '.consignee-list li', function() {
		var value = $(this).data('text');

		if (typeof (is_comstore_app) != 'undefined' && is_comstore_app) {
			$(this).find($('.consignee-seleted')).prop('checked', true);
			$(this).siblings().find($('.consignee-seleted')).prop('checked', false);

			$(".consignee-name").html($(this).data("name") + "，" + $(this).data("tel"));

			$("#consignee_id").val($(this).data("id"));
			$("#consignee_name").val($(this).data("name"));
			$("#consignee_tel").val($(this).data("tel"));
		}

		$.loading.start();

		$.post("/checkout/change-consignee", {
			consignee_id: $(this).data('id')
		}, function(result) {
			if (result.code == 0) {

				if (typeof (is_comstore_app) == 'undefined') {
					$(".consignee-name a span").html(value)
				}

				$('.consignee-close').trigger("click");
			} else {
				$.msg(result.message);
			}
		}, "json").always(function() {
			$.loading.stop();
		});
	});

	// 提货时间弹层
	$('.consignee-time a').click(function() {
		pickuptimebox_coupon();
		return false;
	})
	// 提货时间层关闭
	$('.consignee-close').click(function() {
		$('.consignee-bg').hide();
		$('.consignee-popup .choose-foot').hide()
		$("body").css("top", "auto");
		$("body").removeClass("visibly");
		$(window).scrollTop(scrollheight);
		$('.consignee-popup').animate({
			height: 0
		}, [10000]);
		$('.consignee-close').removeClass('show');
	})
	// 选择提货时间
	$("body").on('click', '.consignee-time-list li', function() {
		var text = $(this).data('text');
		var value = $(this).data('value');

		if (typeof (is_comstore_app) != 'undefined' && is_comstore_app) {
			$(this).find($('.consignee-seleted')).prop('checked', true);
			$(this).siblings().find($('.consignee-seleted')).prop('checked', false);

			$(".select-consignee-time").html(text);

			$("#consignee-time").val(text);
		}

		$.loading.start();

		$.post("/checkout/change-consignee-time", {
			consignee_time: text
		}, function(result) {
			if (result.code == 0) {

				if (typeof (is_comstore_app) == 'undefined') {
					$(".consignee-name a span").html(value)
				}

				$('.consignee-close').trigger("click");
			} else {
				$.msg(result.message);
			}
		}, "json").always(function() {
			$.loading.stop();
		});
	});

	// 选择自提点
	$(".logistics-radio").click(function() {
		var pickup_id = $(this).data("pickup_id");
		var pickup_name = $(this).data("pickup_name");
		var shop_id = $(this).data("shop_id");
		var shipping_id = $(this).data("id");
		var multi_store_id = $(this).data('multi_store_id');
		$("#pickup_address_" + shop_id).show();
		$("#pickup_address_" + shop_id).find("#pickup_name").html(pickup_name);
		if (multi_store_id) {
			$(".consignee-address a span").html(pickup_name);
		}
		$(".logistics-choosen-" + shop_id).removeClass('pickup-bomb-show').addClass('pickup-bomb-hide');
		$(".mask-div").hide();
		$("body").css("top", "auto");
		$("body").removeClass("visibly");
		$(".shipping-select-box li").removeClass("active");
		$("#postage-box-" + shipping_id + "-" + shop_id).addClass("active");
		$(window).scrollTop(scrollheight);
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
	});

	// 自提点修改
	$("body").on('click', '.pickup-edit', function() {
		$(".logistics-choosen-" + $(this).data('shop_id')).removeClass('pickup-bomb-hide').addClass('pickup-bomb-show');
		$(".mask-div").show();
		scrollheight = $(document).scrollTop();
		$("body").css("top", "-" + scrollheight + "px");
		$("body").addClass("visibly");
	});
	// 自提点选择弹框关闭事件
	$("body").on('click', '.pickup-bomb-btn a,.mask-div', function() {
		close_pickup_bomb();
		close_seltimebox_coupon();
	});

	function close_pickup_bomb() {
		$('.pickup-bomb-box').removeClass('pickup-bomb-show').addClass('pickup-bomb-hide');
		$(".mask-div").hide();
		$("body").css("top", "auto");
		$("body").removeClass("visibly");
		$(window).scrollTop(scrollheight);
	}
	// 设置店铺使用红包
	$('#shop_bonus_select_box li').click(function() {
		var $radio = $(this).find("input[type=radio]"), $flag = $radio.is(":checked");
		if (!$flag) {
			$radio.prop("checked", true);
			var bonus_list = [{
				shop_id: $radio.parents('ul').data('shop-id'),
				bonus_id: $radio.val()
			}];
			changePayment({
				bonus_list: bonus_list
			});
		}
		$('#shop_bonus_message').html($(this).find('span').html());
		$("#shop_bonus_select_box").slideUp();
		$(".order-detail .shop-bonus").removeClass('active');
	});

	$(".bonus_class").change(function() {

		var bonus_list = [{
			shop_id: $(this).data('shop-id'),
			bonus_id: $(this).val()
		}];

		changePayment({
			bonus_list: bonus_list
		});
	});

	// 设置店铺储值卡
	$('#shop_store_card_select_box li').click(function() {
		var $radio = $(this).find("input[type=radio]"), $flag = $radio.is(":checked");
		if (!$flag) {
			$radio.prop("checked", true);
			var store_card_list = [{
				shop_id: $radio.parents('ul').data('shop-id'),
				card_id: $radio.val()
			}];
			changePayment({
				store_card_list: store_card_list
			});
		}
		$('#shop_store_card_message').html($(this).find('span').html());
		$("#shop_store_card_select_box").slideToggle();
		$("#shop_store_card_select_box").removeClass('active');
	});

	$(".store_card_class").change(function() {

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

		$(this).siblings().find("label").removeClass("current");
		$(this).find("label").toggleClass("current");

		$(this).siblings().find("[name='checkbox']").removeAttr("checked");

		var user_bonus_id = 0;

		if ($(this).find("label").hasClass("current")) {
			user_bonus_id = $(this).data("user-bonus-id");
		}

		var bonus_list = [{
			shop_id: 0,
			bonus_id: user_bonus_id
		}];

		changePayment({
			bonus_list: bonus_list
		});

		$("#system_bonus_select_box").slideToggle();
		$("#system_bonus_select_box").removeClass('active');
	});

	// 发票选中事件
	$("body").on('click', '#invoice', function() {
		invoice_coupon();
	});
	// 修改发票内容事件
	$("body").on('click', '.inv-info .modify', function() {
		invoice_coupon();
	});

	// 发票选弹框关闭事件
	$("body").on('click', '.invoice-coupon-oprate', function() {
		close_coupon_box();
		// $("#invoice").attr("checked", false);
		// $('.inv-info').html('');
	});

	// 发票标题点击切换选中状态
	$("body").on('click', '.invoice-title', function() {
		$(this).addClass('invoice-item-selected').siblings().removeClass('invoice-item-selected');
		if ($('#add-invoice').hasClass('invoice-item-selected')) {
			$('#save-invoice').removeClass('hide').find('.company-name').removeAttr('readonly').val('').focus();
		} else {
			$('#save-invoice').addClass('hide');
			$('#add-invoice').val('');
		}
		// 选中单选按钮
		$(this).find(":radio").prop("checked", true);
	});
	// 发票内容
	$("body").on('click', '.invoice-type', function() {
		$(this).addClass('invoice-item-selected').siblings().removeClass('invoice-item-selected');
		// 选中单选按钮
		$(this).find(":radio").prop("checked", true);
	});

	// 保存发票设置
	$("body").on('click', '.inv_submit', function() {
		// get_invoice();
		changeInvoice();
	});

	// 取消发票
	$("body").on('click', '.inv_cancle', function() {
		close_coupon_box();
		// $("#invoice").attr("checked", false);
		// $('.inv-info').html('');
	});

	// 选择发票类型
	$("body").on('click', '.tab-nav-item', function() {
		if ($(this).hasClass('disabled') == false) {
			$(this).addClass('tab-item-selected').siblings().removeClass('tab-item-selected');
			var invoice_type = $(this).data('invoice-type');
			$('.form-horizontal').hide();
			$("#invoice_type_" + invoice_type).show();
		}
	});

	// 支付方式积分选中事件
	$("body").on('change', '#integral_enable', function() {
		changePayment();
	});

	// 改变积分值事件
	$("body").on('blur', '#pay_point', function() {
		changePayment();
	});

	// 支付方式余额选中事件
	$("body").on('change', '#balance_enable', function() {
		changePayment();
	});

	// 改变余额值事件
	$("body").on('blur', '#balance', function() {
		if ($("#balance_enable").is(":checked")) {
			changePayment();
		}
	});

	// 设置支付方式
	$("body").on('click', '.payment-tab li', function() {
		var $radio = $(this).find("input[type=radio]");
		// $flag = $radio.is(":checked");
		$radio.prop("checked", true);
		changePayment();
	});

	$(".pay-code").change(function() {
		changePayment();
	});

	// 社区团团长配送服务费
	$("#cs_delivery_enable").change(function() {
		if ($(this).is(":checked")) {
			$(".consignee-address").show();
			$(".consignee-time-li").hide();
		} else {
			$(".consignee-address").hide();
			$(".consignee-time-li").show();
		}
		changePayment();
	});

	// 移除支付方式提示背景类
	$("body").on('click', '#pay_bank', function() {
		$(this).removeClass('bgcolor');
	});

	// 支付密码返回
	$('.back-checkout').click(function() {
		$('.balance-password-box').removeClass('show').addClass('hide');
	});

	// 结算页面提交
	$("body").on('click', '.gopay', function() {
		// 检测配送方式
		// if ($('.shipping-select-box').find('li.active').length == 0) {
		//	$.msg('请选择配送方式');
		//	return;
		//}
		var target = $(this);

		if ($(target).data("loading")) {
			return;
		}
		$.loading.start('正在生成订单，请稍后...');

		var data = {};

		var is_valid = true;

		// 到店购标识码
		if (typeof (rc_id) != 'undefined') {
			data.rc_id = rc_id;
		}
		if (typeof (shop_id) != 'undefined') {
			data.shop_id = shop_id;
		}
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
		});

		// 送货时间
		if ($('.delivery-time-box').length > 0 && $('.delivery-time-box').find('input:radio[name="best_time"]:checked').length == 0) {
			$.msg("请选择送货时间！");
			is_valid = false;
		}

		if (is_valid == false) {
			return;
		}

		data.postscript = postscript;

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
		// 自提点信息验证
		// if($('li[data-name="到店自提 "]').hasClass('active')){
		if ($('#shipping_type').val() > 0) {
			if ($('#selected_pick_man').text() == '选择提货人') {
				$.msg('请选择提货人');
				return;
			}
			if ($('#selected_pick_address').text() == '选择提货地址') {
				$.msg('请选择提货地址');
				return;
			}
		}

		// 送货时间
		if ($('.delivery-time-box').length > 0 && $('.delivery-time-box').find('input:radio[name="best_time"]:checked').length == 0) {
			$.msg("请选择送货时间！");
			is_valid = false;
		}

		// 社区团代码
		if (typeof (is_comstore_app) != 'undefined' && is_comstore_app) {

			// 提货人门牌号
			if ($("#cs_delivery_enable").prop("checked")) {
				data.cs_delivery_enable = 1;
				data.consignee_house = $("#consignee_house").val();
				// 检查门牌号
				if ($.trim(data.consignee_house) == "") {
					$.msg("门牌号不能为空!");
					$("#consignee_house").focus();
					is_valid = false;
				}
			}else{
				
				if ($('#selected_pick_time').text() == '请选择取货时间') {
					$.msg("请选择提货时间");
					is_valid = false;
				}
			}
		}

		if (is_valid == false) {
			return;
		}
		// 买家留言
		data.postscript = postscript;

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

		$.post('/checkout/submit', data, function(result) {
			if (result.code == 0) {
				$.go(result.data)
			} else if (result.code == 106) {
				$.msg(result.message, {
					time: 3000
				}, function() {
					$.go(result.data);
				});
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
			} else if (result.code == 111) {
				$.msg(result.message, {
					time: 3000
				}, function() {
					$.go(result.data);
				});
			} else if (result.code == 112) {
				// $(".SZY-BALANCE-PASSWORD").find("#balance_password").addClass("error").focus();
				$.msg(result.message, {
					time: 3000
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
			} else {
				$("#" + result.data).addClass('bgcolor');
				$.msg(result.message);
			}

			if (result.code != 112) {
				$('.balance-password-box').removeClass('show').addClass('hide');
			}

		}, 'json').always(function() {
			$(target).data("loading", false).html("确认交易");
		});
	});

	$("#invoice_type_1").find("[name='inv_company']").on('input', function() {
		if ($(this).val() == '') {
			$.validator.showError($(this), "单位名称不能为空");
		} else {
			$.validator.clearError($(this));
		}
	});

	$("#invoice_type_1").find("[name='inv_taxpayers']").on('input', function() {
		if ($(this).val() == '') {
			$.validator.showError($(this), "纳税人识别号不能为空");
		} else {
			$.validator.clearError($(this));
		}
	});

});

// ajax显示用户的发货地址列表
function showAddress() {
	top.location.reload();
}

/**
 * 重载用户地址
 */
function reloadUserAddress() {
	$.go('/checkout/user-address.html');
}

// 设置最佳送货时间
function setBestTime(send_time_id, send_time) {
	$.post('/checkout/change-best-time', {
		send_time_id: send_time_id,
		send_time: send_time
	}, function(result) {
		if (result.code == 0) {
			if (send_time.length > 0) {
				$("#best_time_message").html(send_time);
			}
		}
	}, "json");
}

// 调用发货地址添加地址显示层
function showAddressHtml() {
	$.ajax({
		type: 'GET',
		url: '/user/address/add',
		dataType: 'json',
		async: false,
		beforeSend: function() {
			$.loading.start();
		},
		success: function(result) {
			if (result.code == 0) {
				$('#edit-address-div').html(result.data);
				$.loading.stop();
			}
		}
	});
}

// 取消添加地址
function cancel() {
	$('.addr-coupon').hide();
	$('.bg').hide();
	showAddress();
}

// 修改收货地址
function edit(address_id) {
	$.ajax({
		type: 'GET',
		url: '/user/address/edit',
		data: {
			address_id: address_id
		},
		async: false,
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				$('#edit-address-div').html(result.data);
			}
		}
	});
}

// 删除收货地址
function del(address_id) {
	$.ajax({
		type: 'GET',
		url: '/user/address/del',
		data: {
			address_id: address_id
		},
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				// showAddress();
				top.location.reload();
			}
			$.msg(result.message);
		}
	});
}

// 设置本次订单的收货地址
function changeAddress(address_id) {
	$.post('/checkout/change-address', {
		address_id: address_id
	}, function(result) {
		if (result.code == 0) {
			$.go('/checkout.html');
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
			// 计算提交按钮的位置
			// resetSubmitPosition();
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

// 积分支付
function set_pay_point(isopen) {
	$.ajax({
		type: 'GET',
		url: '/checkout/default/set-pay-point',
		data: {
			enabled: isopen,
			pay_point: $("#pay_point").val()
		},
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				$("#pay_paypoint").html(result.data.pay_point)
				$("#pay_count").html(result.data.pay_count)
				$("#pay_bank").html(result.data.pay_bank)
				$("#checkout_amount").html(result.data.checkout_amount)
				if (result.message) {
					$.msg(result.message);
				}
			}
		}
	});
}

// 余额支付
function set_balance(isopen) {
	$.ajax({
		type: 'GET',
		url: '/checkout/default/set-balance',
		data: {
			enabled: isopen,
			balance: $("#balance").val()
		},
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				$("#pay_balance").html(result.data.pay_balance);
				$("#pay_count").html(result.data.pay_count);
				$("#pay_bank").html(result.data.pay_bank);

				$("#checkout_amount").html(result.data.checkout_amount);
				if (result.message) {
					$.msg(result.message);
				}
			}
		}
	});
}

// 支付方式设置
function set_pay_code(pay_code) {
	$.ajax({
		type: 'GET',
		url: '/checkout/default/set-pay-code',
		data: {
			pay_code: pay_code
		},
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				$("#pay_balance").html(result.data.pay_balance)
				$("#pay_count").html(result.data.pay_count)
				$("#pay_bank").html(result.data.pay_bank)
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
	var pay_code = $(".pay-code:checked").val();
	// 团长配送费用是否启用
	var cs_delivery_enable = $("#cs_delivery_enable").is(":checked") ? 1 : 0;
	if (!data) {
		data = {}
	}

	// 判断普通快递和上门自提切换的时候，如果有限购的商品提示图片，则判断其是显示还是隐藏
	if ($(".no-goods-tip").size() > 0 && data.shipping_list && $.isArray(data.shipping_list)) {
		for (var i = 0; i < data.shipping_list.length; i++) {
			var shop_id = data.shipping_list[i].shop_id;
			var shipping_id = data.shipping_list[i].shipping_id;
			var pickup_id = data.shipping_list[i].pickup_id;

			if (shop_id > 0 && pickup_id > 0) {
				// 隐藏不支持配送的图片
				$(".no-goods-tip[data-shop-id='" + shop_id + "']").hide();
			} else {
				// 隐藏不支持配送的图片
				$(".no-goods-tip[data-shop-id='" + shop_id + "']").show();
			}
		}
	}

	if (data.show_msg == undefined) {
		data.show_msg = true;
	}

	/**
	 * // 余额优先则优先使用余额支付 if (typeof(balance_first) != "undefined" &&
	 * balance_first == true) { // 强制使用余额 if (balance_enable == 0) {
	 * balance_enable = 1; $("#balance_enable").prop("checked", true); } //
	 * 有多少使用多少 balance = 0; }
	 */

	$.loading.start();

	request = $.post("/checkout/change-payment", {
		integral: integral,
		integral_amount: integral_amount,
		integral_enable: integral_enable ? 1 : 0,
		balance: balance_enable ? balance : 0,
		balance_enable: balance_enable ? 1 : 0,
		cs_delivery_enable: cs_delivery_enable ? 1 : 0,
		pay_code: pay_code,
		shipping_list: data.shipping_list,
		bonus_list: data.bonus_list,
		store_card_list: data.store_card_list,
		consignee_id: data.consignee_id,
	}, function(result) {
		var user_info = result.user_info;
		var order = result.order;
		var shop_orders = result.shop_orders;
		var pickup_id = result.pickup_id;
		if (balance_enable) {
			$(".SZY-BALANCE-INFO").css("display", "inline");
			$(".SZY-BALANCE-INFO").html(",使用&nbsp;<em class='price-color'>" + order.balance_format + '</em>');
		} else {
			$(".SZY-BALANCE-INFO").css("display", "none");
		}
		if (result.code == 0) {

			if (data.refresh) {
				$('#pay_bank').html(result.pay_bank_html);
			}
			// 渲染支付信息
			renderPayment(user_info, order, shop_orders, balance_enable, integral_enable, result.pay_list, pickup_id);

			if (result.message != null && $.trim(result.message).length > 0 && data.show_msg) {
				$.msg(result.message);
			}
		} else {
			$.msg(result.message);

		}
		$.loading.stop();
	}, "json");
}

function renderPayment(user_info, order, shop_orders, balance_enable, integral_enable, pay_list, pickup_id) {
	$("#balance").val(order.balance);
	// 支付方式设置
	if ($.isArray(pay_list)) {
		for (var i = 0; i < pay_list.length; i++) {
			var item = pay_list[i];

			var target = $('#pac_code_' + item.id);

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

	$(".SZY-ORDER-BALANCE").not(":input").html("-" + order.balance_format);

	$(".SZY-USER-BALANCE").html(user_info.balance_format);
	// 剩余应付金额
	$(".SZY-ORDER-MONEY-PAY").html(order.money_pay_format);
	// 订单总金额
	$(".SZY-ORDER-AMOUNT").html(order.order_amount_format);
	// 红包总金额
	$(".SZY-ORDER-BONUS-AMOUNT").html("-" + order.total_bonus_amount_format);
	// 积分抵扣
	$(".SZY-ORDER-INTEGRAL").html("-" + order.integral_amount_format);
	// 团长配送费用
	$(".SZY-CS-DELIVERY-AMOUNT").html("+" + order.cs_delivery_fee_format);
	// 储值卡总金额
	if (order.shop_store_card_amount > 0) {
		$(".SZY-ORDER-STORE-CARD").show();
		$(".SZY-ORDER-STORE-CARD-AMOUNT").html('-' + order.shop_store_card_amount_format);
	} else {
		$(".SZY-ORDER-STORE-CARD").hide();
	}

	// 货到付款加价
	// if (order.is_cod == 1 && parseInt(order.cash_more) > 0) {
	// $(".SZY-ORDER-CASH-MORE-AMOUNT").show();
	// } else {
	// $(".SZY-ORDER-CASH-MORE-AMOUNT").hide();
	// }
	// 额外配送费
	if (pickup_id > 0) {
		$(".SZY-ORDER-SHIPPING-FEE-AMOUNT").hide();
	} else {
		$(".SZY-ORDER-SHIPPING-FEE-AMOUNT").show();
	}
	$(".SZY-SHIPPING-FEE-AMOUNT").html("+" + order.shipping_fee_format);

	if (shop_orders && $.isArray(shop_orders)) {
		for (var i = 0; i < shop_orders.length; i++) {
			// 订单总金额
			$(".SZY-SHOP-ORDER-AMOUNT-" + shop_orders[i].shop_id).html(shop_orders[i].order_amount_format);
			// 红包金额
			$(".SZY-SHOP-BONUS-AMOUNT-" + shop_orders[i].shop_id).html("-" + shop_orders[i].shop_bonus_amount_format);
			// 储值卡金额
			$(".SZY-SHOP-STORE-CARD-AMOUNT-" + shop_orders[i].shop_id).html("-" + shop_orders[i].shop_store_card_amount_format);
			// 运费
			$(".SZY-SHOP-SHIPPING-FEE-" + shop_orders[i].shop_id).html("+" + shop_orders[i].shipping_fee_format);
			if (shop_orders[i].shipping_fee > 0) {
				$(".SZY-SHOP-SHIPPING-FEE-" + shop_orders[i].shop_id).parents('.bagging-con').removeClass('hide');
			} else {
				$(".SZY-SHOP-SHIPPING-FEE-" + shop_orders[i].shop_id).parents('.bagging-con').addClass('hide');
			}
		}
	}

	if (order) {
		$(".SZY-BONUS-AMOUNT-CONTAINER").html(order.bonus_name);
		if (order.bonus_id > 0) {
			$(".SZY-BONUS-AMOUNT-CONTAINER").show();
		} else {
			$(".SZY-BONUS-AMOUNT-CONTAINER").hide();
		}
	}
	if (order.order_amount > 0) {
		$(".pay-type").show();
	} else {
		$(".pay-type").hide();
	}

	if (order.money_pay > 0) {
		$("#balance_money_pay").show();
		$("#other_pay").show();
		if ($("#paylist").is(':hidden')) {
			$("#paylist").show(function() {
				// $('html,body').animate({
				// scrollTop: $(document).height()
				// }, 500);
			});
		}

	} else {
		$("#balance_money_pay").hide();
		$("#paylist").hide();
		$("#other_pay").hide();
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
		$(".SZY-BALANCE-INFO").css("display", "inline");
	} else {
		$(".SZY-BALANCE-INFO").css("display", "none");
	}

	if (pickup_id > 0) {
		$(".SZY-SHOP-OTHER-SHIPPING-FEE").hide();
	} else {
		$(".SZY-SHOP-OTHER-SHIPPING-FEE").show();
	}

	// 增加小程序判断
	if (window.__wxjs_environment === 'miniprogram') {
		$.each($('#paylist li'), function() {
			if (!$(this).hasClass('weixin') && !$(this).hasClass('cash-on-delivery')) {
				$(this).hide();
			}
		});
	}
}

// 发票调用
function show_invoice() {
	$.ajax({
		type: 'GET',
		url: '/checkout/default/show-invoice',
		data: {},
		dataType: 'json',
		success: function(result) {
			// console.info(result);
			if (result.code == 0) {
				$(".invoice-coupon").html(result.data);
			}
		}
	});
}
// 下拉切换
$('.order-blcok').click(function() {
	$(this).next().slideToggle();
	$(this).toggleClass("active")
});

// 发票内容获取
function changeInvoice() {

	var invoice = {};
	var inv_type = $('.tab-item-selected').data('invoice-type');

	if (inv_type == 1) {
		// 普通发票
		invoice = $("#invoice_type_1").serializeJson();
		if (invoice.inv_title != "个人") {
			var flag = true;
			if ($.trim(invoice.inv_company) == "") {
				$.validator.showError($("#invoice_type_1").find("[name='inv_company']"), "单位名称不能为空");
				$("#invoice_type_1").find("[name='inv_company']").focus();
				flag = false;
			}
			if ($.trim(invoice.inv_taxpayers) == "") {
				$.validator.showError($("#invoice_type_1").find("[name='inv_taxpayers']"), "纳税人识别号不能为空");
				$("#invoice_type_1").find("[name='inv_taxpayers']").focus();
				flag = false;
			}
			if (flag == false) {
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
			$('.inv-info').html(html);
		} else {
			$.msg(result.message, {
				time: 5000
			});
		}
	}, "json");

	$('.invoice-box').hide();
	$('.bg').hide();
	close_coupon_box();
	return invoice;

}

function hideNav() {
	$(".confirm-pay").hide();
	var start = $('body').height();
	setTimeout(function() {
		if (start == $('body').height()) {
			showNav();
		} else {
			hideNav();
		}
	}, 400);

}

function showNav() {
	$(".confirm-pay").show();
}

function balanceOnfocus() {
	var start = $('body').height();
	setTimeout(function() {
		if (start == $('body').height()) {
			changePayment();
			showNav();
		} else {
			balanceOnfocus();
			hideNav();
		}
	}, 2000);

}
// 修改配送方式（是否自提）
function changeShippingType(type) {
	$.post('/checkout/change-shipping-type', {
		type: type
	}, function(rs) {
		if (rs.code >= 0) {
			renderShippingType(type, rs.data);
			return true;
		} else {
			$.msg(rs.message);
			$('.shipping-select-box li').eq(0).trigger("click");
			return false;
		}
	}, 'json')
}

function renderShippingType(type, data) {
	var shop_id = $("#shop_id").val();
	var order = data.order;
	if (type == 0) {
		$(".postage-info").show();
	} else {
		$(".postage-info").hide('');
	}

	$("#balance").val(order.balance);

	$(".SZY-ORDER-BALANCE").not(":input").html("-" + order.balance_format);

	$(".SZY-SHOP-ORDER-AMOUNT-" + shop_id).text(order.order_amount_format);

	// 剩余应付金额
	$(".SZY-ORDER-MONEY-PAY").html(order.money_pay_format);
	// 订单总金额
	$(".SZY-ORDER-AMOUNT").html(order.order_amount_format);
	// 红包总金额
	$(".SZY-ORDER-BONUS-AMOUNT").html("-" + order.total_bonus_amount_format);
	// 团长配送费用
	$(".SZY-CS-DELIVERY-AMOUNT").html("+" + order.cs_delivery_fee_format);

	// 储值卡总金额
	if (order.shop_store_card_amount > 0) {
		$(".SZY-ORDER-STORE-CARD").show();
		$(".SZY-ORDER-STORE-CARD-AMOUNT").html('-' + order.shop_store_card_amount_format);
	} else {
		$(".SZY-ORDER-STORE-CARD").hide();
	}

	// 货到付款加价
	// if (order.is_cod == 1 && parseInt(order.cash_more) > 0) {
	// $(".SZY-ORDER-CASH-MORE-AMOUNT").show();
	// } else {
	// $(".SZY-ORDER-CASH-MORE-AMOUNT").hide();
	// }
	$(".SZY-SHIPPING-FEE-AMOUNT").html("+" + order.shipping_fee_format);
	// 货到付款是否支持
	if (type == 1 || data.cod_enable === false) {
		$('.cash-on-delivery').hide();
	} else {
		$('.cash-on-delivery').show();
	}

	if (order) {
		$(".SZY-BONUS-AMOUNT-CONTAINER").html(order.bonus_name);
		if (order.bonus_id > 0) {
			$(".SZY-BONUS-AMOUNT-CONTAINER").show();
		} else {
			$(".SZY-BONUS-AMOUNT-CONTAINER").hide();
		}
	}
	if (order.order_amount > 0) {
		$(".pay-type").show();
	} else {
		$(".pay-type").hide();
	}

	if (order.money_pay > 0) {
		$("#balance_money_pay").show();
		$("#other_pay").show();
		if ($("#paylist").is(':hidden')) {
			$("#paylist").show(function() {
				// $('html,body').animate({
				// scrollTop: $(document).height()
				// }, 500);
			});
		}

	} else {
		$("#balance_money_pay").hide();
		$("#paylist").hide();
		$("#other_pay").hide();
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

	// 增加小程序判断
	if (window.__wxjs_environment === 'miniprogram') {
		$.each($('#paylist li'), function() {
			if (!$(this).hasClass('weixin') && !$(this).hasClass('cash-on-delivery')) {
				$(this).hide();
			}
		});
	}

}