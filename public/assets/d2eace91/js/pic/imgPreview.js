/**
 * 
 * 68Shop 图片预览插件
 * 
 * 如果需要点击查看大图的功能，需要引入相关layer.js，否则会打开新标签页
 * 
 * ============================================================================ 版权所有 2008-2015 秦皇岛商之翼网络科技有限公司，并保留所有权利。 网站地址: http://www.68ecshop.com ============================================================================
 * 
 * @author : niqingyang
 * @version 1.0
 * @link http://www.68ecshop.com
 */
(function($) {

	function preview(target) {
		if ($(target).data("preview-click") != undefined && ($(target).data("preview-click") == false || $(target).data("preview-click") == 'false')) {
			return;
		}

		var layer_index = $("body").data("layer-index");

		if (layer_index) {
			$.closeDialog(layer_index);
		}

		// 点击查看原图
		var ref = $(target).attr("ref");
		var file = $(target).attr("data-file");
		var photos = $(target).data("photos");
		var src = ref;

		try {
			if (file && file != '') {
				file = $("#" + file);
			}
		} catch (e) {
		}

		if (file && typeof file == 'object') {
			var file = $(file).get(0);
			if (file.files && file.files[0]) {
				src = $("#imgpreview").find("img").attr("src");
			} else {
				src = ref;
			}
		} else if (ref && ref != '') {
			src = ref;
		}

		var width = $("#imgpreview").width();
		var height = $("#imgpreview").height();

		if ($.isFunction($.open)) {

			var width = $("#imgpreview").width();
			var height = $("#imgpreview").height();

			var max_width = $(window).width() - 50;
			var max_height = $(window).height() - 50;

			var image = new Image();
			image.src = src;

			$(image).on("load", function() {
				var content_html;

				if (photos == undefined || isNaN(photos)) {
					content_html = "<p class='imagepreview'><img id='imgpreview_handle' src='" + src + "' style='max-width: " + max_width + "px;max-height: " + max_height + "px;'/></p>";
				} else {
					content_html = "<a class='view-arrow " + (max_width > 1000 ? "max_width" : "") + " prev imagepreview-prev'></a><p class='imagepreview'><img id='imgpreview_handle' src='" + src + "' style='max-width: " + max_width + "px;max-height: " + max_height + "px;'/></p><a class='view-arrow  " + (max_width > 1000 ? "max_width" : "") + "  next imagepreview-next'></a>";
				}

				var index = top.$.open({
					type: 1,
					title: false,
					move: "#imgpreview_handle",
					scrollbar: true,
					closeBtn: 1,
					area: [max_width, max_height],
					skin: 'layui-layer-nobg layui-layer-imagepreview', // 没有背景色
					shadeClose: true,
					content: content_html,
					success: function(object, index) {
						$(object).find(".imagepreview-prev").click(function() {

							var o = $("body").find("[data-photos='" + (photos - 1) + "']");

							if (o.size() == 0) {
								$.msg("已经是没有更多图片了！");
							} else {
								preview(o);
							}

						});
						$(object).find(".imagepreview-next").click(function() {
							var o = $("body").find("[data-photos='" + (photos + 1) + "']");

							if (o.size() == 0) {
								$.msg("已经是没有更多图片了！");
							} else {
								preview(o);
							}
						});
					}
				});

				$("body").data("layer-index", index);
			});
		} else {
			window.open(ref);
		}
	}

	$.fn.imagePreview = function() {
		$(this).hover(function() {

			if ($(this).data("preview-hover") != undefined && ($(this).data("preview-hover") == false || $(this).data("preview-hover") == 'false')) {
				return;
			}

			// $.tips("点击查看大图", this, {tips: 4, time: 800});

			var w = $(this).children().width();
			var title = $(this).attr("title");
			var ref = $(this).attr("ref");

			var file = $(this).attr("data-file");
			try {
				if (file && file != '') {
					file = $("#" + file);
				}
			} catch (e) {
			}

			var b = title && title != "" ? "<br/>" + title : "";

			if (file && typeof file == 'object') {
				file = $(file).get(0);
				if (file.files && file.files[0]) {

					$(this).append("<p id='imgpreview'><img />" + b + "</p>");
					var image = $("#imgpreview").find("img").get(0);

					image.onload = function() {

					}
					var reader = new FileReader();
					reader.onload = function(evt) {
						image.src = evt.target.result;
						$(image).data("src", evt.target.result);
					}
					reader.readAsDataURL(file.files[0]);
					return;
				}
			}
			if (ref != '') {
				$(this).append("<p id='imgpreview'><img src='" + ref + "' />" + b + "</p>");
				$("#imgpreview").css("left", (w + 10) + "px").fadeIn("fast");
			} else {
				$(this).attr("ref", "/images/default/goods.gif");
				$(this).append("<p id='imgpreview'><img src='/images/default/goods.gif'/>" + b + "</p>");
				$("#imgpreview").css("left", (w + 10) + "px").fadeIn("fast");
			}

		}, function() {
			$("#imgpreview").remove();
		}).mousemove(function() {
			var w = $(this).children().width();
			$("#imgpreview").css("left", (w + 10) + "px").fadeIn("fast")
		}).click(function() {

			preview(this);

		});
	}
})(jQuery);

$(document).ready(function() {
	// 绑定鼠标悬浮事件
	$("body").on("mouseover", "a.preview", function() {
		// 判断元素是否绑定了预览图片的事件
		if ($(this).data("imagepreview") == undefined) {
			$(this).data("imagepreview", true);
			$(this).imagePreview();
			$(this).mouseover();
		}
	});
});

// 入驻店铺前台注册时上传图片用
$.fn.extend({
	uploadPreview: function(opts) {
		var _self = this, _this = $(this);
		opts = jQuery.extend({
			Img: "img-pr",
			Width: 100,
			Height: 100,
			ImgType: ["gif", "jpeg", "jpg", "bmp", "png"],
			Callback: function() {
			}
		}, opts || {});
		_self.getObjectURL = function(file) {
			var url = null;
			if (window.createObjectURL != undefined) {
				url = window.createObjectURL(file);
			} else if (window.URL != undefined) {
				url = window.URL.createObjectURL(file);
			} else if (window.webkitURL != undefined) {
				url = window.webkitURL.createObjectURL(file);
			}
			return url;
		};
		_this.change(function() {
			if (this.value) {
				if (!RegExp("\.(" + opts.ImgType.join("|") + ")$", "i").test(this.value.toLowerCase())) {
					$.alert("选择文件错误,图片类型必须是" + opts.ImgType.join("，") + "中的一种", {
						icon: 2
					});
					this.value = "";
					return false
				}
				$("#" + opts.Img + " .fild-box").hide();
				$("#" + opts.Img + " .image-wrap a").show();
				$("#" + opts.Img + " .image-wrap img").attr('src', _self.getObjectURL(this.files[0]));
				$("#" + opts.Img + " .image-wrap input").val(_self.getObjectURL(this.files[0]));

				opts.Callback();
			}
		});

		$("body").on("click", "#" + opts.Img + " .image-wrap a", function() {
			$("#" + opts.Img + " .fild-box").show();
			$("#" + opts.Img + " .image-wrap a").hide();
			$("#" + opts.Img + " .image-wrap img").removeAttr("src");
			$("#" + opts.Img + " .image-wrap input").val("");
		});

	}
});