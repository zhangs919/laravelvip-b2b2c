//欢迎页js
//刷新面板	
$("[data-click=panel-reload]").click(function(e) {
	e.preventDefault();
	var t = $(this).closest(".panel");
	if (!$(t).hasClass("panel-loading")) {
		var n = $(t).find(".panel-body");
		var r = '<div class="panel-loader"><span class="spinner-small fa-spin"></span></div>';
		$(t).addClass("panel-loading");
		$(n).prepend(r);
		setTimeout(function() {
			$(t).removeClass("panel-loading");
			$(t).find(".panel-loader").remove()
		}, 2e3)
	}
});

// 收起展开面板
$("[data-click=panel-toggle]").click(function(e) {
	e.preventDefault();
	$(this).closest(".panel").find(".panel-body").slideToggle()
});

// 关闭删除面板
$("[data-click=panel-close]").click(function(e) {
	e.preventDefault();
	$(this).closest(".panel").remove()
});