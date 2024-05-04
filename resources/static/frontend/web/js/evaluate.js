$(function() {
	var int = 0;
	// 店铺评分
	$(".btn-eval-shop").click(function() {

		var form = $(this).parents("form");

		var data = $(form).serializeJson();

		data.order_id = $(this).data("order-id");

		if ($.trim(data.service_desc_score) == "") {
			$.msg("请对店铺服务态度进行评价");
			return;
		} else if ($.trim(data.send_desc_score) == "") {
			$.msg("请对店铺发货速度进行评价");
			return;
		} else if ($.trim(data.logistics_speed_score) == "") {
			$.msg("请对店铺物流服务进行评价");
			return;
		}

		$.loading.start();

		$.post("/user/evaluate/eval-shop.html", data, function(result) {
			if (result.code == 0) {
				$(form).parents(".comment-shop").replaceWith($.parseHTML(result.data, true));
				$.msg(result.message, {
					time: 3000
				});
			} else {
				$.msg(result.message, {
					time: 5000
				});
			}
		}, "JSON").always(function() {
			$.loading.stop();
		});
	});

	// 追评
	$("body").on("click", ".btn-append", function() {

		var form = $(this).parents("form");

		var data = $(form).serializeJson();

		data.record_id = $(this).data("record-id");

		if ($.trim(data.content) == "" && $.trim(data.images) == "") {
			$(form).find(".comment-content-error").show();
			return;
		} else {
			$(form).find(".comment-content-error").hide();
		}

		// 检查数据
		if (data.content.length > 400) {
			$(form).find(".comment-content").focus();
			$.msg("请将评价商品内容限制在400字以内");
			return;
		}

		$.loading.start();

		$.post("/user/evaluate/eval-goods.html", data, function(result) {
			if (result.code == 0) {
				$(form).parents(".comment-goods").replaceWith($.parseHTML(result.data, true));
				$.msg(result.message, {
					time: 3000
				});
			} else {
				$.msg(result.message, {
					time: 5000
				});
			}
		}, "JSON").always(function() {
			$.loading.stop();
		});
	});

	// 发表评价
	$("body").on("click", ".btn-submit", function() {

		var form = $(this).parents("form");

		var data = $(form).serializeJson();

		data.record_id = $(this).data("record-id");

		// 检查数据
		if (data.score == "") {
			$(form).find(".comment-score-error").show();
			return;
		} else {
			$(form).find(".comment-score-error").hide();
		}

		if (data.content.length > 400) {
			$(form).find(".comment-content").focus();
			$.msg("请将评价商品内容限制在400字以内");
			return;
		}

		if ($.trim(data.content) == "" && $.trim(data.images) == "") {
			$(form).find(".comment-content-error").show();
			return;
		} else {
			$(form).find(".comment-content-error").hide();
		}

		$.loading.start();

		$.post("/user/evaluate/eval-goods.html", data, function(result) {
			if (result.code == 0) {
				$(form).parents(".comment-goods").replaceWith($.parseHTML(result.data, true));
				$.msg(result.message, {
					time: 3000
				});
			} else {
				$.msg(result.message, {
					time: 5000
				});
			}
		}, "JSON").always(function() {
			$.loading.stop();
		});
	});

	// 回复卖家
	$("body").on("click", ".reply", function() {
		var comment_id = $(this).data("comment-id");
       var _this=$(this);
		$.loading.start();

		$.open({
			type: 1,
			title: '回复卖家',
			ajax: {
				url: '/user/evaluate/reply.html',
				data: {
					comment_id: comment_id
				}
			},
			btn: ['确定', '取消'],
			yes: function(index, obj) {

				var data = $(obj).serializeJson();

				if ($.trim(data.content) == 0) {
					$(obj).find(".comment-content").focus();
					$.msg("请输入回复内容！");
					return;
				} else if ($.trim(data.content).length > 400) {
					$(obj).find(".comment-content").focus();
					$.msg("恢复内容不能超过400个字！");
					return;
				}

				$.post("/user/evaluate/reply.html", data, function(result) {
					if (result.code == 0) {
						$.closeDialog(index);
						$.msg(result.message);
						_this.remove();
					} else {
						$.msg(result.message, {
							time: 5000
						});
					}
				}, "JSON");
			}
		}).always(function() {
			$.loading.stop();
		});
	});
})
