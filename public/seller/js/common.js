$().ready(function() {
	// 数据采集中查看商家采集信息
	$("body").on("click", "#shopcollectinfo", function() {
		$.loading.start();
		$.post('/goods/cloud/ajax-collect-info', {}, function(result) {
			if (result.code == 0) {
				$.open({
					type: 1,
					title: '采集信息', // 样式类名
					closeBtn: 1, // 不显示关闭按钮
					shadeClose: false, // 开启遮罩关闭
					area: ['600px', '300px'], // 宽高
					// scrollbar: false,
					content: result.data
				});

			} else {
				$.msg(result.message, {
					time: 5000
				});
			}
		}, "JSON");
	})
})

// 动态、普通登录切换
function setTab(name, cursel, n) {
	for (i = 1; i <= n; i++) {
		var menu = $("#" + name + i);
		var con = $("#con_" + name + "_" + i);

		if (i == cursel) {
			$(con).show();
			$(menu).addClass("active");
		} else {
			$(con).hide();
			$(menu).removeClass("active");
		}
	}
}

function CloseNLRAF(a) {
	if (a) {
		$.cookie("NLRAF", "true", {
			path: "/",
			expires: 30
		});
	} else {
		$.cookie("NLRAF", "true", {
			path: "/"
		});
	}
	$("body").removeClass("afpc-fixed");
	$(".afpc").removeClass("show");
}

$().ready(function() {
	// 顶部弹出收藏
	if ($.cookie("NLRAF") == null) {
		if ($(".afpc").size() > 0) {
			$("body").addClass("afpc-fixed");
			$(".afpc").addClass("show");
		}
	}
	
	// 右侧帮助
	$('.help-icon-handle').click(function() {
		if ($('.help-container').hasClass('unfold')) {
			$('.help-container').addClass('fold').removeClass('unfold');
		} else {
			$('.help-container').addClass('unfold').removeClass('fold');
		}
	});
});
