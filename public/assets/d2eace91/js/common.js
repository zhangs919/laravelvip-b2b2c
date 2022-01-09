// JavaScript Document
$().ready(function() {

	try {
		// jquery-ui提示工具，需要引用jquery-ui.js配合使用，可以跟随鼠标使用
		// $( document ).tooltip({ track: true });
		// 提示工具初始化
		$("[data-toggle='tooltip']").tooltip();
	} catch (e) {
		// console.warn("初始化“提示工具”发生错误：" + e);
	}
	try {
		// chosen带搜索的select框
		$('.chosen-select').chosen();
	} catch (e) {
		// console.warn("初始化“chosen”发生错误：" + e);
	}
	try {
		$('.bootstrap-switch [type="checkbox"]').bootstrapSwitch({
			radioAllOff: true,
			onSwitchChange: function(event, state) {
				$(event.target).prop("checked", state);
				$(event.target).change();
			}
		});

		$("[data-switch-toggle]").on("click", function() {
			var type = $(this).data("switch-toggle");
			return $("#switch-" + type).bootstrapSwitch("toggle" + type.charAt(0).toUpperCase() + type.slice(1));
		});
	} catch (e) {
		// console.warn("初始化“bootstrap-switch”发生错误：" + e);
	}
	try {
	} catch (e) {
	}
	try {
		// 温馨提示收缩展开效果
		$('body').on('click','.explain-checkZoom',function() {
			if ($(this).parents('.explanation').hasClass('up')) {
				$(this).parents('.explanation').removeClass('up').addClass('down');
				$(this).parents(".explanation").find(".explain-panel").slideToggle(200);
			} else {
				$(this).parents('.explanation').addClass('up').removeClass('down');
				$(this).parents(".explanation").find(".explain-panel").slideToggle(200);
			}
		});
	} catch (e) {
		// console.warn("初始化“温馨提示收缩展开效果”发生错误：" + e);
	}

	try {
		// 搜索收起展开更多
		searchMore();
	} catch (e) {
		// console.info(e);
	}

	try {

		// 颜色取值
		// $(".colorPicker").colorpicker();

		// bootstrap 带搜索的select框
		// $('.selectpicker').selectpicker();
		// 文本框添加标签
		// $('.tagplayer').tagsinput();

		// switch开关工具

		// 单复选框样式
		$('input.icheck').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue',
			increaseArea: '20%' // optional
		});
		// 列表是否显示列滚动条
		$(".edit-table ul").mCustomScrollbar();
		// 弹框
		popover();
		// 回到顶部

		// 刷新表格数据
		refurbish();

	} catch (e) {
	}
	try {
		// a标签、input框、按钮点击出现虚线边框问题解决
		$('a,.btn,.checkBox,button,.selectpicker,input[type="radio"],input[type="checkbox"],input[type="button"]').focus(function() {
			this.blur()
		});
	} catch (e) {
	}
	try {
		// 展开收缩效果
		$(".col-sm-8").find(".click-fade").click(function() {
			$(this).siblings(".edit").show();
		});
		$(".col-sm-8").find('.fa-times-circle').click(function() {
			$(this).parents(".edit").hide();
		});
	} catch (e) {
	}
	try {
		/**
		 * 密码框上眼睛的控制
		 */
		$('body').on('click', ".pwd-toggle", function() {
			var id = $(this).data("id");
			if ($('.pwd-toggle').hasClass('fa-eye')) {
				$('.pwd-toggle').removeClass('fa-eye');
				$('.pwd-toggle').addClass('fa-eye-slash');
				$('#' + id).attr("type", "password");
			} else {
				$('.pwd-toggle').addClass('fa-eye');
				$('.pwd-toggle').removeClass('fa-eye-slash');
				$('#' + id).attr("type", "text");
			}
		});
	} catch (e) {
		// console.info(e);
	}

	// 鼠标经过弹框js
	try {
		/**
		 * $(".popover-box").hover(function() {
		 * $(this).find(".popover-info").fadeIn('fast'); }, function() {
		 * $(this).find(".popover-info").fadeOut('fast'); });
		 */
		// 鼠标经过弹框js
		$("body").on("mouseover", ".popover-box", function() {
			$(this).find(".popover-info").show();
		});
		$("body").on("mouseout", ".popover-box", function() {
			$(this).find(".popover-info").hide();
		});

	} catch (e) {

	}

	try {
		if ($.isFunction($.loading.start)) {
			$("body").on("click", ".click-loading", function() {
				$.loading.start();
			});
		}
	} catch (e) {
	}

	// IE低版本下，文本框placeholder显示js start
	try {
		var doc = document, inputs = doc.getElementsByTagName('input'), supportPlaceholder = 'placeholder' in doc.createElement('input'),

		placeholder = function(input) {
			var text = input.getAttribute('placeholder'), defaultValue = input.defaultValue;
			if (defaultValue == '') {
				input.value = text
			}
			input.onfocus = function() {
				if (input.value === text) {
					this.value = ''
				}
			};
			input.onblur = function() {
				if (input.value === '') {
					this.value = text
				}
			}
		};

		if (!supportPlaceholder) {
			for (var i = 0, len = inputs.length; i < len; i++) {
				var input = inputs[i], text = input.getAttribute('placeholder');
				if (input.type === 'text' && text) {
					placeholder(input)
				}
			}
		}

	} catch (e) {
	}

	// 表单第一项获取焦点
	$("form").find(":input").not(":hidden").not(".form_datetime").first().focus();

	// IE低版本下，文本框placeholder显示js end
});

// 返回顶部js
$(window).scroll(function() {
	var position = $(window).scrollTop();
	if (position >= 200) {
		$('.scroll-to-top').addClass('active')
	} else {
		$('.scroll-to-top').removeClass('active')
	}
});

// 搜索条件隐藏显示
function searchMore() {
	$('#searchMore').click(function() {
		if ($('.search-term .toggle').hasClass('hide')) {
			$('#searchMore').text('收起筛选条件');
			$(".search-term .toggle").removeClass('hide');
		} else {
			$('.search-term .toggle').addClass('hide');
			$('#searchMore').text('更多筛选条件');
		}
	});
}

// 列表头部点击刷新按钮
function refurbish() {
	$(".operate .reload").click(function() {
		$(".reload").find(".fa-refresh").addClass('fa-spin s02');
		setTimeout(function() {
			$(".reload i").removeClass('fa-spin s02');
		}, 800)
	});
}

// 列表是否按钮点击切换js
function switchBtn(id, text_id) {
	// 定义显示文字数组
	var textArray = new Array();
	textArray[0] = new Array('是', '否');
	textArray[1] = new Array('开启', '关闭');
	textArray[2] = new Array('允许', '拒绝');
	// 获取当前文字
	var curre = textArray[text_id];
	// alert(curre[0]);
	var obj = "#" + id;
	var text = text;
	if ($(obj).hasClass('open')) {
		$(obj).removeClass('open');
		$(obj).html('<i class="fa fa-toggle-off"></i>' + curre[1]);
	} else {
		$(obj).addClass('open');
		$(obj).html('<i class="fa fa-toggle-on"></i>' + curre[0]);
	}
}

// 鼠标经过弹框js
function popover() {
	$(".popover-box").hover(function() {
		$(this).find(".popover-info").fadeIn('fast');
	}, function() {
		$(this).find(".popover-info").fadeOut('fast');
	});
}

/**
 * 插件 倪庆洋 2012-05-28
 */

ajax = {}
/**
 * AJAX的参数，默认type:"POST", async:false, dataType:"json"
 * 用户仅需要定义url,data,success等参数，也支持覆盖
 * 
 * @param {Object}
 *            options {type:"POST", async:false, dataType:"json",
 *            error:function(data){ top.Dialog.alert("失败"+data.status); }};
 */
ajax.post = function(options) {
	var settings = {
		type: "POST",
		async: true,
		dataType: "json",
		error: function(data) {
			alert("失败" + data.status);
		}
	};
	settings = $.extend(settings, options);
	$.ajax(settings);
}

ajax.get = function(options) {
	var settings = {
		type: "GET",
		async: true,
		dataType: "json",
		error: function(data) {
			alert("失败" + data.status);
		}
	};
	settings = $.extend(settings, options);
	$.ajax(settings);
}

/**
 * 地区列表三级联动
 * 
 * @param url
 * @param child_id
 * @param parent_code
 */

function AjaxRegion(url, child_id, parent_code) {
	// 定义对象
	var obj = $("#" + child_id);
	// 获取地区列表
	$.ajax({
		type: 'get',
		url: url,
		data: {
			parent_code: parent_code
		},
		dataType: 'json',
		success: function(result) {
			if (result.code == '0') {

				var data = result.data;
				leve_text = regionLevel(data.level + 1)

				obj.html("<option value=''>" + leve_text + "</option>");
				$(data.list).each(function(i, n) {
					obj.append("<option value='" + n.region_code + "'>" + n.region_name + "</option>")
				})
			} else {
				$.msg('请求失败！', {
					icon: 2
				})
			}
		},
		error: function() {
			$.msg('数据异常！', {
				icon: 2
			})
		}
	})
}

function regionLevel(level) {
	var text_array = new Array('国家', '省', '市', '区/县', '乡镇/街道');
	return text_array[level];
}

//验证整数
function validateInteger(obj) {
	var number = obj.value;
	obj.value = obj.value.replace(/[^\d\.]/g,'');
}
