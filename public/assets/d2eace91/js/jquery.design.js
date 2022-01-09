/**
 * AJAX装修组件
 * 
 * ============================================================================
 * 版权所有 2008-2015 秦皇岛商之翼网络科技有限公司，并保留所有权利。
 * ============================================================================
 * 
 * @author: sunlizhi
 * @version 1.0
 * @date 2015-11-19
 * @link http://www.68ecshop.com
 */

(function($) {

	var title = new Array();
	title[99] = '样式选择器';
	title[1] = '文章选择器';
	title[2] = '商品选择器';
	title[3] = '图片选择器';
	title[4] = '标题选择器';
	title[5] = '品牌选择器';
	title[6] = '分类选择器';
	title[7] = '活动选择器';
	title[8] = '导航选择器';
	title[9] = '店铺选择器';
	title[10] = '自定义选择器';
	title[11] = '红包选择器';
	title[12] = '文本选择器';

	/**
	 * 调用选择器
	 */
	$.designselector = function(obj) {
		var this_obj = obj
		obj = obj.data();
		var defaults = {
			url: '/design/tpl-setting/add-data',
			// 个人设置属性 自定义属性 在选择器中控制模块的显示
			// title_open_colorpicker: 0, // 颜色模块
			// title_short_name: 0, // 标题缩写模块
			// title_open_link: 0, // 标题连接模块
			// title_open_title: 0, // 标题模块
			// title_is_floor : 0, //楼层
			// goods_open_title : 0 , //商品选择器标题
			length: 10,
			width: 800,
			number: 1,
			// 回调函数
			callback: null,
		};

		var this_title = title[obj.type];

		obj = $.extend(true, defaults, obj);
		// 自定义模板使用modal有问题 暂时使用layer
		if (obj.type == 10) {
			$.ajax({
				url: obj.url,
				dataType: 'json',
				data: {
					data: obj,
					page: page,
				},
				beforeSend: function() {
					$.loading.start();
				},
				success: function(result) {
					$.open({
						type: 1,
						area: '900',
						btn: false,
						zIndex: 1000,
						fix: true,
						maxmin: true,
						title: title[obj.type],
						content: result.data,
						success: function(layero) {
							$.loading.stop();
						}
					});
				}
			});
			return;
		}

		if (obj.title) {
			this_title = title[obj.type] + '-' + obj.title;
		}
		var modal = $.modal(this_obj);
		var target = this_obj;
		if (modal) {
			modal.show();
		} else {
			$.modal({
				title: this_title,
				trigger: this_obj,
				width: obj.width,
				ajax: {
					url: obj.url,
					data: {
						data: obj,
						page: page,
					// personal_setting: obj.personal_setting
					},
				},

			});
		}
	}

	// 模板数据处理
	$.designadddata = function(settings) {
		var defaults = {
			url: '/design/tpl-setting/save-tpls',
			callback: null
		};
		settings = $.extend(true, defaults, settings);
		$.ajax({
			type: 'post',
			url: 'save-tpls',
			dataType: 'json',
			data: settings.data,
			success: function(result) {
				if (result.code == 0) {
					$.msg(result.message);
					var modal = $.modal($("#" + settings.data.uuid));
					if (modal) {
						modal.hide();
					}
					// 回调刷新
					refreshTpl(result.data.page, result.data.uid);
				} else {
					$.msg(result.message);
				}

				if ($.isFunction(settings.callback)) {
					settings.callback.call(settings, settings.data);
				}
			}
		});
	}

})(jQuery);