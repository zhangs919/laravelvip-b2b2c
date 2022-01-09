//换肤记录cookies
$(".inline >li").click(function() {
	$("body").attr("id", $(this).attr('name'));
	$.cookie("theme", $(this).attr('name'), {
		expires: 365
	});// 设置cookie变量theme，cookie有效时长是1天
})
var favCss = $.cookie("theme");
if (favCss) {// 假如cookie值存在，直接设置id值以显示背景色
	var a = document.getElementsByName(favCss);
	$(a).addClass("active");
	$("body").attr("id", favCss);
}

var menu_state = $.cookie('left_menu_state');

menu_state = (menu_state == "true" || menu_state == true) ? true : false;

if (menu_state) {
	$('.admincp-container').addClass('unfold').removeClass('fold');
	$('#foldSidebar i').addClass('arrow arrow-left').removeClass('arrow arrow-right');

	$(".left-menu-state[data-default=true]").addClass("active");
	$(".left-menu-state[data-default=false]").removeClass("active");
} else {
	$('.admincp-container').addClass('fold').removeClass('unfold');
	$('#foldSidebar i').addClass('arrow arrow-right').removeClass('arrow arrow-left');

	$(".left-menu-state[data-default=true]").removeClass("active");
	$(".left-menu-state[data-default=false]").addClass("active");
}

// 主题点击收起展开导航菜单
$(".left-menu-state").click(function() {
	var state = $(this).data("default");

	if (state == "true" || state == true) {
		$('.admincp-container').addClass('unfold').removeClass('fold');
		$('#foldSidebar i').addClass('arrow arrow-left').removeClass('arrow arrow-right');
	} else {
		$('.admincp-container').addClass('fold').removeClass('unfold');
		$('#foldSidebar i').addClass('arrow arrow-right').removeClass('arrow arrow-left');
	}
	$.cookie('left_menu_state', state, {
		expires: 365
	});
});

var theme_style = $.cookie('theme_style');

theme_style = (theme_style == "false" || theme_style == false) ? false : true;

$("#theme_style").bootstrapSwitch({
	state: theme_style
});

if (theme_style) {
	$("body").removeClass("style-original");
	$(document.getElementById('workspace').contentWindow.document).find("body").removeClass("style-original");

	$(".theme-style[data-default=true]").addClass("active");
	$(".theme-style[data-default=false]").removeClass("active");
} else {
	$("body").addClass("style-original");
	$(document.getElementById('workspace').contentWindow.document).find("body").addClass("style-original");

	$(".theme-style[data-default=true]").removeClass("active");
	$(".theme-style[data-default=false]").addClass("active");
}

// 风格切换
$(".theme-style").click(function() {
	var state = $(this).data("default");

	if (state == "true" || state == true) {
		$("body").removeClass("style-original");
		var workspace = document.getElementById('workspace');
		if (workspace) {
			$(workspace.contentWindow.document).find("body").removeClass("style-original");
		}
	} else {
		$("body").addClass("style-original");
		var workspace = document.getElementById('workspace');
		if (workspace) {
			$(workspace.contentWindow.document).find("body").addClass("style-original");
		}
	}
	$.cookie('theme_style', state, {
		expires: 365
	});
});

// 顶部导航展示形式切换
$('#foldSidebar i').click(function() {
	if ($('.admincp-container').hasClass('unfold')) {
		$('.admincp-container').addClass('fold').removeClass('unfold');
		$('#foldSidebar i').addClass('arrow arrow-right').removeClass('arrow arrow-left');
	} else {
		$('.admincp-container').addClass('unfold').removeClass('fold');
		$('#foldSidebar i').addClass('arrow arrow-left').removeClass('arrow arrow-right');
	}
});
// 侧边导航展示形式切换，现已隐藏
$('.navbar-collapse > a').click(function() {
	if ($('.admincp-container').hasClass('unfold')) {
		$('.admincp-container').addClass('fold').removeClass('unfold');

		$('.navbar-btn i').addClass('fa-indent').removeClass('fa-outdent');

	} else {
		$('.admincp-container').addClass('unfold').removeClass('fold');

		$('.navbar-btn i').addClass('fa-outdent').removeClass('fa-indent');
	}
});
// 手机显示展开收起导航按钮切换
$('.toggle-left-box').click(function() {
	if ($('.admincp-container').hasClass('sm')) {
		$('.admincp-container').removeClass('sm');
	} else {
		$('.admincp-container').addClass('sm');
	}
});

// 导航三级折叠
$(".sm-nav-box > li > a").click(function() {
	$(this).addClass("active").parents().siblings().find("a").removeClass("active");
	$(this).parents().siblings().find(".sm-child").hide(300);
	$(this).siblings(".sm-child").toggle(300);
})
$(".sm-child > li > a").click(function() {
	$(this).addClass("active").parents().siblings().find("a").removeClass("active");
	$(this).parents().siblings().find(".sm-three").hide(300);
	$(this).siblings(".sm-three").toggle(300);
})

// 加载对象
var loading = {
	// 显示加载进度条
	start: function() {
		// Pace.restart();
		// $("#page-load").show();
		$.loading.start();
	},
	// 停止加载进度条
	stop: function() {
		// Pace.stop();
		// $("#page-load").hide();
		$.loading.stop();
	}
};

var bind_click = false;

// iframe加载完成后调用事件
$("#workspace").load(function() {
	loading.stop();
	if (bind_click == false) {
		if (this.contentWindow && this.contentWindow.document) {
			$(this.contentWindow.document).click(function() {
				$(window).click();
			});
			bind_click = true;
		}
	}
});

$(window).click(function() {
	// 关闭菜单
	$("[data-toggle='dropdown']").each(function() {
		if ($(this).attr("aria-expanded") == "true") {
			$(this).dropdown('toggle');
		}
	});
});

$(".SZY-MENU-2").click(function() {
	if ($(this).find(".submenu").find("li").size() == 1) {
		try {
			$(this).find(".submenu").find("li").find("a").click();
			var id = $(this).attr("href");
			$(id).siblings("li").removeClass("active");
			$(id).addClass("active");
			return false;
		} catch (e) {
		}
	}
});

// 防止弹出两次窗口
$(".SZY-MENU-2 li a").click(function() {
	return false;
});

// ifream跳转左侧导航选中
function openMenu(url, obj, target) {

	if ($(obj).hasClass("SZY-MENU-2") && $(obj).find(".submenu").find("li").size() == 1) {
		obj = $(obj).find(".submenu").find("[data-menus]");
	}

	if (obj) {
		var lastmenus = $(obj).attr("data-menus");

		try {
			var menus = lastmenus.split("|");
			$(".nav-tabs").find("[data-param='" + menus[0] + "']").find("a").click();
		} catch (e) {
		}

		$(".SZY-MENU-2").removeClass("active");
		$(obj).parents(".SZY-MENUS").addClass("active");
		$(".submenu,.product-nav-list,.sm-three").find("li").removeClass('active');
		$(".submenu,.product-nav-list,.sm-three").find("li").find("[data-menus='" + lastmenus + "']").parents('li').addClass('active');
	}

	// $.post(url, function(data){
	// $("#workspace").html(data);
	// loading.stop();
	// })

	if (url == "" || url == "/" || url == "/index" || url == "/index.html") {
		$(".SZY-MENU-2:first").find("li").find("a:first").click();
		return;
	}

	if (target == '_blank') {
		window.open(url);
	} else {

		if (lastmenus) {
			$.cookie("lastmenus", lastmenus, {
				expires: 7
			});
		}

        // url = '/laravelmall/html/backend_v2' + url + '.html'; // todo 静态html新增 上线后注释掉
		loading.start();
		$("#workspace").attr("src", url);
	}
}

// 更新后台主框架消息弹窗
function update_message() {
	// 是否重新获取数据
	if ($("#message-panel").html().length > 0) {
		// if (parseInt($("#counts_all").val()) != 0) {
		var time_step = 5; // 最小刷新间隔，单位：秒
		var this_time = new Date();
		if ((parseInt($("#counts_time").val()) + parseInt(time_step)) > parseInt(this_time.getTime() / 1000)) {
			return true;
		}
		// }
	}
	$.ajax({
		type: 'GET',
		url: '/site/update-message',
		data: {},
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				$("#message-panel").html(result.data);
			} else if (result.code == 1) {
			} else {
				$.msg(result.message);
			}
		}
	});
}

function message_click(object_type) {
	$.ajax({
		type: 'POST',
		url: '/site/message-update',
		data: {
			'object_type': object_type
		},
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				if (result.data.message_logo_counts <= 0) {
					$("#message_logo").hide();
				}
				$("#message_logo").html(result.data.message_logo_counts);
				$("#workspace").attr("src", result.data.url);
			} else {
				$.msg(result.message);
			}
		}
	});
}

loading.stop();
$("#personal_message").mouseenter(function() {
	window.focus();
	$("#personal_message_panel").show();
}).mouseleave(function() {
	$("#personal_message_panel").hide();
}).find(".close").click(function() {
	$("#personal_message_panel").hide();
});
$("#change_color").mouseenter(function() {
	window.focus();
	$("#change_color_panel").show();
}).mouseleave(function() {
	$("#change_color_panel").hide();
}).find(".close").click(function() {
	$("#change_color_panel").hide();
});
$("#message-box").mouseenter(function() {
	update_message();
	window.focus();
	$("#message-panel").show();
}).mouseleave(function() {
	$("#message-panel").hide();
}).find(".close").click(function() {
	$("#message-panel").hide();
});
$("#clear_cache").mouseenter(function() {
	window.focus();
	$("#clear_cache_panel").show();
}).mouseleave(function() {
	$("#clear_cache_panel").hide();
}).find(".close").click(function() {
	$("#clear_cache_panel").hide();
});

// 清理缓存
$("#btn_clear_cache").click(function() {

	var data = $("#cacheForm").serializeJson();

	if (!data.codes || !$.isArray(data.codes) || data.codes.length == 0) {
		$.msg('请选择要清理的缓存！');
		return;
	}

	data.codes = data.codes.join(",");

	var target = this;

	if ($(target).data("loading")) {
		return;
	}

	$(target).data("loading", true);

	$.loading.start();

	$.post('/system/cache/clear', data, function(result) {
		if (result.code == 0) {
			$.msg(result.message);
		} else {
			$.msg(result.message, {
				time: 5000
			});
		}
	}, "json").always(function() {
		$.loading.stop();
		$(target).data("loading", false);
	});
});

$("#cache_all").click(function() {
	$("#cacheForm").find(":checkbox").prop("checked", $(this).prop("checked"));
});
$("#cacheForm").find(":checkbox").click(function() {
	if (!$(this).prop("checked")) {
		$("#cache_all").prop("checked", false);
	} else if ($("#cacheForm").find(":checkbox").not("#cache_all").size() == $("#cacheForm").find(":checkbox:checked").size()) {
		$("#cache_all").prop("checked", true);
	}
})

// 屏蔽F5，自动重载iframe
$(document).keydown(function(e) {
	e = window.event || e;
	var keycode = e.keyCode || e.which;
	if (keycode == 116) {
		// 重载iframe
		$('#workspace').attr("src", $('#workspace').attr("src"));
		if (window.event) {// ie
			try {
				e.keyCode = 0;
			} catch (e) {
			}
			e.returnValue = false;
		} else {// ff
			e.preventDefault();
		}
		return false;
	}
});