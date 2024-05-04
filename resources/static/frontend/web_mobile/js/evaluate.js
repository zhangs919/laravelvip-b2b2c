$(function() {
	var int = 0;
	$("#raty_star").click(function() {
		var $this = $(this);
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
				$.msg(result.message, {
					time: 3000
				},function(){
					window.location.reload();
				});
				$this.remove();
			} else {
				$.msg(result.message, {
					time: 5000
				});
			}
		}, "JSON");

	});

	$("body").on("click", ".comment-submit", function() {
		var obj = $(this);
		if($(obj).hasClass('loading')){
			return;
		}
		
		$.loading.start();
		
		$(obj).addClass('loading');
		
		var form = $(obj).parents("form");

		var data = $(form).serializeJson();

		data.record_id = $(this).data("record-id");

		// 检查数据
		if (data.score == "") {
			$.msg("请选择评价等级");
			$(obj).removeClass('loading');
			return;
		}

		if ($.trim(data.images) == "" && $.trim(data.content) == "") {
			$.msg("请先添加评论或上传图片再提交");
			$(this).removeClass('loading');
			return;
		}

		if (data.content.length > 400) {
			$(form).find(".comment-input").focus();
			$.msg("请将评价商品内容限制在400字以内");
			$(obj).removeClass('loading');
			return;
		}
		$.post("/user/evaluate/eval-goods.html", data, function(result) {
			if (result.code == 0) {
				$.loading.stop();
				$.msg(result.message, {
					time: 3000,
					icon_type: 1
				},function(){
					window.location.reload();// 刷新当前页面.
				});
				
			} else {
				$.msg(result.message, {
					time: 5000
				});
				$(obj).removeClass('loading');
			}
		}, 'json');
	});
	$("body").on("click", ".reply", function() {
		var this_reply = $(this);

		var modal = $.modal({
			title: '回复卖家',
			content: $('#modal_box').html(),
		});
		modal.addButton({
			text: '发表回复',
			click: function() {
				var text = $(modal.container).find(".comment-cotnent").val();
				if (text == "") {
					$.msg("请输入回复内容");
				} else {
					$(this).attr("disabled", true);
					layer.load();
					var comment_id = $(modal.container).find("#comment_id").val();
					$.post('/user/evaluate/reply', {
						reply_text: text,
						comment: comment_id
					}, function(result) {
						if (result.code == 0) {
							this_reply.remove();
							modal.hide();
						} else {

							$(this).attr("disabled", false);
						}
						$.msg(result.message);
						layer.closeAll("loading");
					}, 'json');

				}
			}
		});
	});
})
