// 表单回显数据, 覆盖index.js的内容
var o_header_img = $('#header_img');
$('#imagegroup_container').imagegroup({
	host: image_url_host,
	size: $(this).data("size"),
	values: o_header_img.val().split("|"),
	gallery: true,
	// 回调函数
	callback: function(data) {
		var url = '';
		if (data.src) {
			url = data.src;
		}
		o_header_img.val(url);
		$.validator.clearError(o_header_img);
	},
	// 移除的回调函数
	remove: function(value, values) {
		o_header_img.val("");
	}
});
var o_body_img = $('#bg_img');
$('#bg_img_container').imagegroup({
	host: image_url_host,
	size: $(this).data("size"),
	values: o_body_img.val().split("|"),
	gallery: true,
	// 回调函数
	callback: function(data) {
		var url = '';
		if (data.src) {
			url = data.src;
		}
		o_body_img.val(url);
		$.validator.clearError(o_body_img);
	},
	// 移除的回调函数
	remove: function(value, values) {
		o_body_img.val("");
	}
});
// ----- 地区级联插件 ----- //
var o_region_container = $('#region_container');
var o_address_code = $("#address_code");

var selector_setting = {
	value: '',
	sale_scope: 0,
	widget_class: 'render-selector',
	select_class: "form-control m-t-5",
	change: function(value, names, is_last) {
		o_address_code.val(value);
		// 遍历获取所有的内容 - 设置地址文本
		var selectors = o_region_container.find('.render-selector');
		var texts = [];
		var len = selectors.length;
		if (len <= 3 && len > 0) {
			selectors.each(function(i, v) {
				var self = $(this);
				var text = self.find('option:selected').text();
				var val = self.val();
				if (val == '') {
					text = '';
				}
				texts.push(text);
			});
		}
		var o_address_text = $('#address_text');
		o_address_text.val(texts.join('-'));
	},
	// 在将组件添加到页面之后就会被调用
	select_callback: function() {
		// 检测当前select数量的个数, 因为可能会有更多级, 只保留3级联动
		var len = o_region_container.find('.render-selector').length;
		if (len > 2) {
			o_region_container.find('.render-selector:gt(2)').remove();
		}
	}
}
o_region_container.regionselector(selector_setting);
// ----- 默认时间插件 ----- //
var default_time_setting = {
	language: 'zh-CN',
	weekStart: 1,
	todayBtn: 1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	forceParse: 0,
	showMeridian: 1,
	minView: 2,
	maxView: 4,
	format: "yyyy-mm-dd"
};
var o_default_time = $('#default_time');
o_default_time.datetimepicker(default_time_setting).on('changeDate', function(ev) {
	$(this).trigger("blur");
});
// ----- 时间显示级别 ----- //
$('#time_level').change(function() {
	// 获取当前的时间级别
	var self = $(this);
	var level = self.val();
	// 清空上面的时间
	o_default_time.val('');
	// 获取当前时间级别对应的设置
	var special_setting = time_level[level];
	if (special_setting && typeof special_setting === 'object') {
		// 合并后的配置
		$.extend(default_time_setting, special_setting);
		o_default_time.datetimepicker('remove');
		o_default_time.datetimepicker(default_time_setting);
	}
});
// 右侧编辑内容，对齐选择js
var o_layout = $('#layout');
var o_layout_items = $('.fGroupItem');
o_layout_items.find("li").click(function() {
	var self = $(this);
	self.addClass("selected").siblings().removeClass("selected");
	var layout = self.data('layout');
	o_layout.val(layout);
});