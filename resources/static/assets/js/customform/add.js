// -------------------------- 上传附件功能  -------------------------- // 
$('.upload-box').each(function() {
	/**
	 * @param string
	 *            container 外层的包裹的ID
	 * @param string
	 *            ossfile oss提示层的ID
	 * @param string
	 *            selectfiles 选择文件的ID
	 * @param string
	 *            postfiles 开始上传的ID
	 * @param string
	 *            szy_filename 文件名的ID
	 * @param string
	 *            szy_filetext 原始文件名的ID
	 */
	var $self = $(this);
	// container 外层的包裹的ID
	var uploadContainer = $self.find('._container').attr('id');
	// ossfile oss提示层的ID
	var uploadOssFile = $self.find('._ossfile').attr('id');
	// selectfiles 选择文件的ID
	var uploadSelectFiles = $self.find('._selectfiles').attr('id');
	// postfiles 开始上传的ID
	var uploadPostFiles = $self.find('._postfiles').attr('id');
	// szy_filename 文件名的ID
	var szyFilename = $self.find('._filename').attr('id');
	// szy_filetext 文件的ID
	var szyFiletext = $self.find('._filetext').attr('id');
	// 初始化上传组件
	initUploader(uploadContainer, uploadOssFile, uploadSelectFiles, uploadPostFiles, szyFilename, szyFiletext);
});

// 级联地址的详细地址改变监听
var o_address_detail = $('.address_detail');
o_address_detail.blur(function() {
	var self = $(this);
	var detail = $.trim(self.val());
	if (detail != '') {
		var o_region_container = self.parent().prev('.region_container');
		var $questionConent = o_region_container.closest('.question-conent');
		var o_full_address = self.parent().next('.full_address');
		if (o_region_container.length == 1 && o_full_address.length == 1) {
			var o_region_selector = o_region_container.find('.render-selector');
			// 标记地址是否为最后一位
			var isLast = ($questionConent.data('last') == 1)
			if (isLast) {
				var address = [];
				o_region_selector.each(function(i, v) {
					var self = $(this);
					var code = self.val();
					// var text = self.find('option:selected').text();
					if (code != "") {
						address.push(code);
					}
				});
				if (isLast) {
					// var address_text = address.join('');
					// 最后一位
					var address_text = address.pop();
					o_full_address.val(address_text + ' ' + detail);
				}
			}
		}
	} else {
		// 没有填写详细地址则清空内容
		self.closest('.question-conent').find('.full_address').val('');
	}
});

var validates = {
	rules: {},
	messages: {}
};

// 整数
var pattern_int = /^\d+$/;
// 身份证
var pattern_cardnum = /(^\d{15}$)|(^\d{17}(\d|[X|x])$)/;
// 手机号
var pattern_phone = /((^(13|15|18|17|14)\d{9}$)|(^(199|198|166)\d{8}$))/;

// 整数
function isInt(val) {
	return pattern_int.test(val)
}
// 身份证
function isCardNum(val) {
	return pattern_cardnum.test(val);
}
// 手机号
function isPhoneNum(val) {
	return pattern_phone.test(val);
}
/**
 * 根据type，获取对应的校验内容
 * 
 * @paran object data 组件的设置的内容
 */
function typeOfValidate(type, data, index) {
	// 组件类型
	var component_type = data.type;
	// 组件名称
	var component_name = getComponentName(index, data);
	// 校验的规则
	var validate = {};
	// 规则集合
	var rules = {};
	// 提示信息集合
	var messages = {};
	// 数字默认要输入数字
	if (component_type === 'number') {
		rules.number = true;
	}
	// 邮箱基本校验规则
	if (component_type === 'email') {
		rules.email = true;
	}
	// qq号就只有整数
	if (component_type === 'qq' || component_type === 'phone') {
		rules.digits = true;
		if (component_type === 'phone') {
			rules.isPhoneNum = true;
		}
	}

	// 是否必填
	var v_required = data.v_required;
	if (v_required && v_required == 1) {
		rules.required = true;
	}

	// 最少多少字
	var v_minlength = data.v_minlength;
	var v_minlength_con = data.v_minlength_con;
	// 最多多少字
	var v_maxlength = data.v_maxlength;
	var v_maxlength_con = data.v_maxlength_con;
	// 最多最少填写多少字，且必须是数字
	if (v_minlength && v_minlength == 1 && v_minlength_con && isInt(v_minlength_con)) {
		rules.minlength = parseInt(v_minlength_con);
	}
	if (v_maxlength && v_maxlength == 1 && v_maxlength_con && isInt(v_maxlength_con)) {
		rules.maxlength = parseInt(v_maxlength_con);
	}
	// 但是最多必须要大于最少
	if (v_minlength == 1 && isInt(v_minlength_con) && v_maxlength == 1 && isInt(v_maxlength) && parseInt(v_minlength_con) > parseInt(v_maxlength_con)) {
		// 如果最小 > 最大 不合法数字，则去除此校验
		delete rules.maxlength;
		delete rules.minlength;
	}
	// 身份证验证
	var v_resident_cardnum = data.v_resident_cardnum;
	if (v_resident_cardnum && v_resident_cardnum == 1) {
		rules.isCardNum = true;
	}

	// 自定义出错内容
	var v_error_customer = data.v_error_customer;
	var v_error_customer_con = data.v_error_customer_con;
	if (v_error_customer && v_error_customer == 1 && v_error_customer_con != '') {
		if (v_required) {
			messages.required = v_error_customer_con;
		}
	}

	validate['rules'] = rules;
	validate['messages'] = messages;
	return validate;

}

// 身份证验证
jQuery.validator.addMethod("isCardNum", function(value, element, param) {
	value = $.trim(value);
	if (value != '') {
		return isCardNum(value);
	}
	return true;
}, $.validator.format("请输入正确身份证号码"));
// 手机号码验证
jQuery.validator.addMethod("isPhoneNum", function(value, element, param) {
	value = $.trim(value);
	if (value != '') {
		return isPhoneNum(value);
	}
	return true;
}, $.validator.format("请输入正确手机号"));

// 遍历日期组件
if (form_datas) {
	var form_datas_len = form_datas.length;
	for (var i = 0; i < form_datas_len; i++) {
		// 获取当前组件的数据内容
		var component = form_datas[i];
		// 获取当前组件的类型
		var type = component.type;
		// 初始化组件对应的数据
		initPreviewComponents(i, type, component);
		// 生成校验规则
		var validate = typeOfValidate(type, component, i);

		var component_name = getComponentName(i, component);
		var rules = validate.rules;
		var messages = validate.messages;

		validates['rules'][component_name] = rules;
		validates['messages'][component_name] = messages;
	}
}

// 表单
var o_add_form = $('#add_form');
// 提交事件
var prevent = {
	errorPlacement: function(error, element) {
		// 需要将提示信息放在总内容的后面
		var target_element = $(element).closest('.question-conent');

		var error_id = $(error).attr("id");
		var error_msg = $(error).text();
		var element_id = $(error).attr("for");

		// radio 和 checkbox 移除 当前的error
		var $element = $(element);
		if ($element.is(":radio") || $element.is(":checkbox")) {
			$element.closest('ul').find('input').removeClass('error');
		}

		if ($.trim(error_msg).length == 0) {
			$(error).remove();
			return;
		}

		var error_html = $("<span id=\"" + error_id + "\" data-error-id=\"" + error_id + "\" class=\"form-control-error\"><i class=\"fa fa-warning\"></i>" + error_msg + "</span>");

		$(error_html).click(function() {
			$(element).focus();
		});

		var control_box = $(element).parents(".form-control-box");
		if ($(control_box).size() > 0) {
			if ($(control_box).first().parent().find(".form-control-error").size() > 0) {

				$(control_box).first().parent().find(".form-control-error").replaceWith(error_html);
			} else {
				$(control_box).first().after(error_html);
			}
			return;
		}

		// 防止ID为jquery里的规则查不出来表单元素对象
		var error_dom = null;
		if ($(element).parents("form").size() > 0) {
			error_dom = $(element).parents("form").find("[id='" + error_id + "']");
		} else {
			error_dom = document.getElementById("[id='" + error_id + "']");
		}
		if ($(error_dom).size() > 0) {
			if ($(error_dom).text() == error_msg) {
				return;
			}
			$(error_dom).remove();
		}

		if ($(element).is(":file")) {
			$(element).parent().parent().after(error_html).attr("style", "float: left;");
		} else if ($(element).prop("tagName") == "SELECT" && $(element).hasClass("chosen-select")) {
			if ($(element).data('chosen') && $(element).data('chosen').container) {
				$($(element).data('chosen').container).css("float", "left");
			}
			target_element.after(error_html);
		} else {
			target_element.after(error_html);
		}

	},
}
// 合并内容
$.extend(validates, prevent);
// 数据校验
var validator = o_add_form.validate(validates);
$('.form-submit').find('a').click(function() {
	if (!validator.form()) {
		return;
	}
	$.loading.start();
	var data = $('#add_form').serialize();
	$.post('/customform/form/add.html?id=' + form_id, data, function(res) {
		if (res.code == -1) {
			$.msg(res.message);
		} else {
			// 提交成功
			$.open({
				type: 1,
				title: false,
				closeBtn: 0,
				area: ['80%'],
				content: $('.form-end')
			});
		}
	}, 'JSON').always(function() {
		$.loading.stop();
	});
	return false;
});

/**
 * 获取索引获取当前ID
 * 
 * @param int
 *            index 当前组件的索引顺序
 */
function getComponentID(index) {
	return 'c' + index;
}
/**
 * 获取组件对象
 * 
 * @param int
 *            index 当前组件的索引顺序
 */
function getComponentObj(index) {
	var id = getComponentID(index);
	return $('#' + id);
}

/**
 * 获取组件的name 规则是 组件类型_组件索引
 * 
 * @param int
 *            index 组件所在索引
 * @param object
 *            data 组件的数据
 */
function getComponentName(index, data) {
	var type = data.type;
	var muti = '';
	if (type === 'checkbox') {
		muti = '[]';
	}
	return type + '_' + index + muti;
}
// 分享二维码
$(".FshareBtn").click(function() {
	$(".shareMask").addClass("show");
	$(".F-main").addClass("form-disabled");
});
$(".shareMask").click(function() {
	$(".shareMask").removeClass("show");
	$(".F-main").removeClass("form-disabled");
});
/**
 * 打开信息窗体
 */
function openMapWindowInfo(text, map, marker) {
	if (text != "") {
		// 构建信息窗体中显示的内容
		var info = [];
		info.push("<div style='font-size:12px;'>" + text + "</div>");
		infoWindow = new AMap.InfoWindow({
			offset: new AMap.Pixel(2, -25),
			content: info.join("<br/>")
		// 使用默认信息窗体框样式，显示信息内容
		});
		infoWindow.open(map, marker.getPosition());
	}
}