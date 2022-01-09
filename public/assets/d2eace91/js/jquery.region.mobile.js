/**
 * 地区公共组件
 * 
 * ============================================================================
 * 版权所有 2008-2015 秦皇岛商之翼网络科技有限公司，并保留所有权利。
 * ============================================================================
 * 
 * @author: niqingyang
 * @version 1.0
 * @date 2016-4-12
 * @link http://www.68ecshop.com
 */
var scrollheight = 0;
(function($) {

	function resolveRegionCode(region_code) {
		var codes = [];
		codes.push(region_code);
		while (region_code.indexOf(",") != -1) {
			region_code = region_code.substring(0, region_code.lastIndexOf(","));
			codes.push(region_code);
		}
		codes = codes.reverse();
		return codes;
	}

	function in_array(search, array) {
		for ( var i in array) {
			if (array[i] == search) {
				return true;
			}
		}
		return false;
	}

	// 缓存
	var region_cache = [];

	/**
	 * 多级联动地区选择器
	 */
	$.fn.regionselector = function(settings) {

		var defaults = {
			url: null,
			// 选择器的容器
			container: container,
			// 控件的样式
			select_class: '',
			// 【弃用】多个select下拉框间的分隔符
			separator: null,
			// 当前选择器的值，也用于初始化
			value: null,
			// 地区是否必须全部选全
			check_all: true,
			// 上级代码，默认为null，为null则不指定
			parent_code: null,
			// 是否查询经营范围的地区列表
			sale_scope: false,
			// 组件值发生变化时触发的事件，ajax之前的回调函数
			// @param value 用户选择的值，可以根据用户选择的值赋值给某个隐藏域货做其他处理
			// @param names 用户选择的所有地区名称的列表，如果用户选择的为空则返回空数组
			// @param is_last 是否为最后一级
			change: null,
			// 双击内容项事件
			// @param option 双击的项对象
			// @param names 用户选择的所有地区名称的列表，如果用户选择的为空则返回空数组
			dblclick: null,
			// 组件值发生变化时ajax之后的回调函数
			callback: null,
			// 是否缓存每次ajax加载的结果
			cache: true,
			// 渲染每个元素后的回调函数
			// @param element 元素
			// @return 新的element
			select_callback: null,
			// 加载每个option时的回调函数
			// @param element 元素
			option_callback: null,
			// 地区层级名称
			level_names: ['', '省', '市', '区/县', '镇', '街道'],
			// 组件class
			widget_class: 'render-selector',
			// 加载数据
			// @param region_code 地区代码
			// @param value_mode 是否为加载值模式，默认为false，默认为加载下一级
			// @param target 触发加载事件的元素对象，一般为change事件的触发对象
			load: function(region_code, value_mode, target) {
				var settings = this;
				var container = settings.container;

				var data = {};

				if (value_mode == true) {
					data.region_code = region_code;
				} else {
					data.parent_code = region_code;

					if (region_cache[region_code] != undefined) {
						settings.render(region_cache[region_code], target);
						return;
					}
				}

				$.get(this.url, data, function(result) {

					if (result.code != 0) {
						return;
					}

					var list = result.data;
					settings.level_names = result.level_names;

					if ($.isFunction(settings.callback)) {
						var result = settings.callback.call(settings, list);
						if (result == false) {
							return;
						}
					}

					// 渲染组件
					settings.render(list, target);

					if (!value_mode) {
						region_cache[data.parent_code] = list;
					} else {

						$(target).data("is_last", false);
						// 如果是值加载模式则出发一次change事件
						$(container).find("." + settings.widget_class + ":last").trigger("change", [false]);
					}

				}, "json");
			},
			// 渲染组件
			// @param list 地区列表数组，可以包含多个地区列表，每个列表对应一个下拉选框
			// @param target 触发change事件的元素对象
			render: function(list, target) {

				var settings = this;
				var container = settings.container;

				if (list == undefined && $(container).find("." + settings.widget_class + "").size() == 0) {
					var select_class = settings.select_class + " " + settings.widget_class + "-init";

					var element = $("<select class='" + select_class + "'><option value=''>-请选择-</option></select>")

					$(container).append(element);

					// 渲染页面回调函数
					if ($.isFunction(settings.select_callback)) {
						settings.select_callback.call(settings, element);
					}

					return;
				}

				// 移除
				$(container).find("." + settings.widget_class + "-init").remove();

				if (target != null && $.isFunction(settings.before_change)) {
					settings.before_change.call(settings, target);
				}

				if (list.length == 0 || list[0].length == 0) {
					$(target).data("is_last", true);
					// 如果是值加载模式则出发一次change事件
					// 触发change
					// $(container).find("." + settings.widget_class +
					// ":last").trigger("change", [true]);
					return;
				}

				var values = [];

				if (settings.value != undefined && settings.value != null && settings.value.length > 0) {
					values = resolveRegionCode(settings.value)
				}

				for (var i = 0; i < list.length; i++) {

					if (list[i].length == 0) {
						continue;
					}

					var select_class = settings.select_class;

					if ($(container).find("." + settings.widget_class).size() != 0) {
						select_class = 'm-l-5 ' + select_class;
					}

					select_class = select_class + " " + settings.widget_class;

					var element = $("<select class='" + select_class + "'><option value=''>-请选择-</option></select>");

					var parent_code = null;
					var level = null;

					for (var j = 0; j < list[i].length; j++) {
						var item = list[i][j];

						var is_selected = false;

						// 如果只有一个选项则默认选中
						if (in_array(item.region_code, values)) {
							is_selected = true;
						}

						var option = $("<option value='" + item.region_code + "'>" + item.region_name + "</option>");

						if (is_selected) {
							$(option).attr("selected", "selected");
						}

						$(element).append(option);

						if (parent_code == null) {
							parent_code = item.parent_code;
						}
						if (level == null) {
							level = item.region_code.split(",").length;
						}

						// 回调函数
						if ($.isFunction(settings.option_callback)) {
							settings.option_callback.call(settings, option);
						}

					}

					$(element).data("parent-code", parent_code);
					$(element).data("level", level);

					$(container).append(element);

					if ($.isFunction(settings.dblclick)) {
						$(element).find("option").dblclick(function(event) {
							var names = [];
							$(container).find("." + settings.widget_class + " option:selected").each(function() {
								if ($(this).val() != '') {
									names.push($(this).html());
								}
							});
							if (!$(this).is(":disabled")) {
								settings.dblclick.call(settings, $(this), names);
							}

						});
					}

					// 渲染页面回调函数
					if ($.isFunction(settings.select_callback)) {
						settings.select_callback.call(settings, element);
					}

					// 绑定change事件
					$(element).on("change", function(event, is_last) {

						if (is_last == undefined) {
							is_last = false;
						}

						$(element).data("is_last", is_last);

						var value = $(this).val();

						if (value == '') {
							if ($.isFunction(settings.before_change)) {
								settings.before_change.call(settings, this);
							}
						}

						var names = [];
						var codes = [];

						$(container).find("." + settings.widget_class + " option:selected").each(function() {
							if ($(this).val() != '') {
								names.push($(this).html());
								codes.push($(this).val());
							}
						});

						if (codes.length > 0) {
							settings.value = codes[codes.length - 1];
						} else {
							settings.value = "";
						}

						if ($.isFunction(settings.change)) {

							var current_value = value;
							// 不需要全选
							if (settings.check_all == false && codes.length > 0) {
								current_value = codes[codes.length - 1];
							}

							var result = settings.change.call(settings, current_value, names, is_last);
							if (result == false) {
								return;
							}
						}

						if (value == '') {
							return;
						}

						if (is_last == false) {
							settings.load(value, false, this);
						}

					});
				}

				// $(container).find("." +
				// settings.widget_class).last().change();
			},
			// 获取当前选择的值的数组
			values: function() {

				var settings = this;
				var container = settings.container;

				var codes = [];

				$(container).find("." + settings.widget_class + " option:selected").each(function() {
					if ($(this).val() != '') {
						codes.push({
							region_code: $(this).val(),
							region_name: $(this).html()
						});
					}
				});

				return codes;
			},
			// 在value值发生改变后，进行加载前执行，主要用于移除响应的元素
			before_change: function(element) {
				// 移除后面的元素
				$(element).nextAll("." + settings.widget_class).remove();
			},
			reload: function() {
				var settings = this;
				if (settings.url == null) {
					if (settings.sale_scope == true) {
						settings.url = '/site/sale-region-list';
					} else {
						settings.url = '/site/region-list';
					}
				}

				settings.container.remove("." + this.widget_class);

				// 第一次渲染页面
				settings.render();

				if (settings.value != null && settings.value != '') {
					settings.load(settings.value, true, null);
				} else {
					settings.load(settings.parent_code, false, null);
				}
			}
		};

		var container = $(this).first();
		settings = $.extend(true, defaults, settings);
		settings.container = $(this).first();

		if (settings.url == null) {
			if (settings.sale_scope == true) {
				settings.url = '/site/sale-region-list';
			} else {
				settings.url = '/site/region-list';
			}
		}

		// 第一次渲染页面
		settings.render();

		if (settings.value != null && settings.value != '') {
			settings.load(settings.value, true, null);
		} else {
			settings.load(settings.parent_code, false, null);
		}

		return settings;
	};

	/**
	 * 多级联动地区选择器（多选）
	 */
	$.fn.regionpicker = function(settings) {

		var defaults = {
			widget_class: "region-picker",
			dblclick: null,
			select_callback: function(element) {
				$(element).wrap('<div class="region-picker-list ' + this.widget_class + '"></div>');
				if ($(element).hasClass(settings.widget_class + "-init")) {

				} else {
					var level = $(element).data("level");
					var level_name = this.level_names[level];
					$(element).before('<label>' + level_name + '：</label>');
				}
				$(element).attr("size", 10);
			},
			// 在value值发生改变后，进行加载前执行，主要用于移除响应的元素
			before_change: function(element) {
				// 移除后面的元素
				$(element).parents("div").nextAll(".region-picker-list").remove();
			},
		};

		if (!$(this).hasClass("region-picker-list-box")) {
			$(this).addClass("region-picker-list-box");
		}

		settings = $.extend(true, defaults, settings);

		return $(this).regionselector(settings);
	};

	/**
	 * 多级联动地区选择器（单选）
	 */
	$.fn.regionchooser = function(settings) {

		var defaults = {
			url: null,
			// 选择器的容器
			container: null,
			// 是否显示选择地区列表
			list_show: true,
			// 控件的样式
			select_class: '',
			// 【弃用】多个select下拉框间的分隔符
			separator: null,
			// 当前选择器的值，也用于初始化
			value: null,
			// 上级代码，默认为null，为null则不指定
			parent_code: null,
			// 是否查询经营范围的地区列表
			sale_scope: false,
			// 组件值发生变化时触发的事件，ajax之前的回调函数
			// @param value 用户选择的值，可以根据用户选择的值赋值给某个隐藏域货做其他处理
			// @param names 用户选择的所有地区名称的列表，如果用户选择的为空则返回空数组
			// @param is_last 是否为最后一级
			change: null,
			// 组件值发生变化时ajax之后的回调函数【废弃】
			callback: null,
			// 是否缓存每次ajax加载的结果
			cache: true,
			// 渲染每个元素后的回调函数【废弃】
			// @param element 元素
			// @return 新的element
			select_callback: null,
			// 地区层级名称
			level_names: ['', '省', '市', '区/县', '镇', '街道'],
			// 组件class【废弃】
			widget_class: "region-chooser",
			// 加载数据
			is_loading: true,
			// @param region_code 地区代码
			// @param value_mode 是否为加载值模式，默认为false，默认为加载下一级
			// @param target 触发加载事件的元素对象，一般为change事件的触发对象
			load: function(region_code, value_mode, target) {
				if (region_code == null) {
					// 定位失败
					 return;
				}

				var settings = this;
				var container = settings.container;

				var data = {};

				if (value_mode == true) {
					data.region_code = region_code;
				} else {
					data.parent_code = region_code;

					if (region_cache[region_code] != undefined) {
						settings.render(region_cache[region_code], value_mode, target);

						return;
					}
				}

				// 如果target不为空则说明是点击了超链接项
				if (target != null) {

					// 从缓存中获取数据
					if (region_cache[region_code] != undefined) {
						settings.render(region_cache[region_code], value_mode, target);

						return;
					}

					return $.get(settings.url, {
						parent_code: region_code
					}, function(result) {

						if (result.code != 0) {
							return;
						}

						var list = result.data;
						settings.level_names = result.level_names;

						if ($.isFunction(settings.callback)) {
							var result = settings.callback.call(settings, list);
							if (result == false) {
								return;
							}
						}

						// 渲染组件
						settings.render(list, value_mode, target);

						if (!value_mode) {
							region_cache[data.parent_code] = list;
						} else {
							$(target).data("is_last", false);
							// 如果是值加载模式则触发一次change事件
							$(container).find("." + settings.widget_class + ":last").trigger("change", [false]);
						}
					}, "json");
				}

				// 加载数据
				return $.get(settings.url, data, function(result) {

					if (result.code != 0) {
						$.msg(result.message);
						return;
					}

					if (result.level_names) {
						settings.level_names = result.level_names;
					}

					// 第一次渲染页面
					settings.render(result.data, value_mode);

					settings.is_loading = false;

				}, "json");
			},
			// 渲染组件
			// @param list 地区列表数组，可以包含多个地区列表，每个列表对应一个下拉选框
			// @param value_mode 是否为加载值模式，默认为false，默认为加载下一级
			// @param target 触发change事件的元素对象
			render: function(list, value_mode, target) {

				var settings = this;
				var container = settings.container;

				if (list == undefined) {
					var html = '<div class="region-chooser-selected">';
					html += '<div class="region">';
					html += '<font color="#999">';
					html += '请选择收货地址';
					//html += '<i class="iconfont">&#xe607;</i>';
					html += '</font>';
					html += '</div>';
					html += '</div>';
					html += '<section class="f_block region-chooser-box" style="height: 0; overflow: hidden;"  id="region-chooser-box">';
					html += '<div class="select_area_box">';
					html += ' <h2>地区选择<a class="c_close_attr2 region-chooser-close" href="javascript:void(0)"></a></h2>';
					html += '<div class="region-tabs">';
					html += '</div>';
					html += '</div>';
					html += '<div style="clear: both;"></div>';
					html += '</div>';

					html += '</section>';
					$(container).html($.parseHTML(html));

					// 显示隐藏切换事件
					$(".region-chooser-selected").parents('.region-box').click(function() {
						if (settings.is_loading) {
							return;
						}
						if (settings.list_show) {
							settings.show();
						}
					});

					// 关闭按钮事件
					$(container).find(".region-chooser-close").click(function(event) {
						settings.toggle();
						event.stopPropagation();
					});

					// 单击tab
					$(container).off("click", ".region-tab");
					$(container).on("click", ".region-tab", function() {
						var region_code = $(this).data("region-code");
						$(container).find(".region-tab").filter(".selected").removeClass("selected");
						$(this).addClass("selected");
						$(this).nextAll(".region-tab").remove();
						$(container).find(".region-items").hide();
						$(container).find(".region-items").filter("[data-region-code='" + region_code + "']").show();
					});

					// 单击项
					$(container).off("click", ".region-items a");
					$(container).on("click", ".region-items a", function() {
						// 防止快速重复点击快要ajax获取数据
						if ($(this).data("loading")) {
							return;
						}

						$(this).data("loading", true);
						var region_code = $(this).data("region-code");
						settings.load(region_code, false, $(this));
						return false;
					});

					return;
				}

				if (target != undefined && target != null) {
					var region_code = $(target).data("region-code");
					var parent_code = $(target).data("parent-code");
					var region_level = $(target).data("region-level");
					var region_name = $(target).data("region-name");
					$(container).find(".region-tab").filter("[data-region-level='" + region_level + "']").html(region_name + "<i></i>");
					$(container).find(".region-tab").filter("[data-region-level='" + region_level + "']").data("region-name", region_name);
				}

				var values = [];
				var region_names = [];

				if (settings.value != undefined && settings.value != null && settings.value.length > 0) {
					values = resolveRegionCode(settings.value)
				}

				for (var i = 0; i < list.length; i++) {

					if (list[i].length == 0) {
						continue;
					}

					var region_code = list[i][0].parent_code;
					var region_level = list[i][0].level;
					var region_name = null;

					$(container).find(".region-items").hide();

					if ($(container).find(".region-items").filter("[data-region-code='" + region_code + "']").size() > 0) {
						$(container).find(".region-items").filter("[data-region-code='" + region_code + "']").show();
						if (list[i].length == 1) {
							region_name = null;
						}
					} else {
						var element = $('<div class="region-items" data-region-level="' + region_level + '" data-region-code="' + region_code + '"></div>');

						for (var j = 0; j < list[i].length; j++) {
							var item = list[i][j];

							var is_selected = false;

							// 如果只有一个选项则默认选中

							if (list[i].length == 1) {
								is_selected = true;
							} else if (in_array(item.region_code, values)) {
								is_selected = true;
							}

							if (is_selected) {
								region_name = item.region_name;
								region_names.push(region_name);
							}

							$(element).append('<a href="javascript:void(0);" data-region-level="' + region_level + '" data-region-code="' + item.region_code + '" data-parent-code="' + item.parent_code + '" data-region-name="' + item.region_name + '">' + item.region_name + '</a>');
						}

						$(container).find(".region-chooser-box").append(element);
						var total = 0, h = $(window).height(), top = $('.select_area_box').height() || 0, con = (container).find(".region-items");
						total = 0.8 * h;
						con.height(total - top + 'px');
					}

					$(container).find(".region-tab").filter(".selected").removeClass("selected");

					var tab_element = $('<div class="region-tab selected" data-region-level="' + region_level + '" data-region-code="' + region_code + '" style="display: block"><i></i></div>');

					$(container).find(".region-tabs").append(tab_element);

					if (region_name == null) {
						var level = region_code.split(",").length + 1;
						if (region_code == '0') {
							level = 1;
						}
						var level_name = settings.level_names[level];
						region_name = "请选择"
						if (level_name) {
							region_name += level_name;
						}
						$(tab_element).html(region_name + "<i></i>");

					} else {
						$(tab_element).html(region_name + "<i></i>");
						$(tab_element).data("region-name", region_name);
					}
				}

				var value = null;

				if (value_mode) {
					value = settings.value;
				} else {
					value = region_code;
				}

				var names = [];
				$(container).find(".region-tab").each(function() {
					if ($(this).data("region-name")) {
						names.push($(this).data("region-name"));
					}
				});

				if (names.length == 0) {
					names = ["请选择收货地址"];
				}

				var is_last = false;

				if (list.length == 0 || list[list.length - 1].length == 0) {
					is_last = true;
					// 默认最后一级修改标题
					$(container).find(".region").html("<font>" + names.join(" ") + "<i></i></font>");
				}

				// 防止快速重复点击ajax获取数据
				if (target != undefined || target != null || value_mode) {

					$(target).data("loading", false);

					if ((target != undefined || target != null) && !is_last) {
						// 显示
						// settings.show();
						$(container).data("should-show", true);
					} else {

						if (names.length == list.length) {
							is_last = true;
						}
						// 默认最后一级修改标题
						$(container).find(".region").html("<font>" + names.join(" ") + "<i></i></font>");
						// 隐藏
						if (!this.__init__) {
							this.__init__ = true;
						} else {
							this.hide();
						}
					}

					// change事件
					if ($.isFunction(settings.change)) {
						var result = settings.change.call(settings, value, names, is_last);
						if (result == false) {
							return;
						}
					}
				}
			},
			// 显示
			show: function() {

				$(this.container).find(".region-chooser-box").animate({
					height: '80%'
				}, [10000]);
				var total = 0, h = $(window).height(), top = $('.select_area_box').height() || 0, con = $('.region-items');
				total = 0.8 * h;
				con.height(total - top + 'px');
				$(".mask-div").show();
				scrollheight = $(document).scrollTop();
				$("body").css("top", "-" + scrollheight + "px");
				$("body").addClass("visibly");

				// 关闭回调函数
				if ($.isFunction(this.show_callback)) {
					this.show_callback.call(this);
				}
			},
			// 隐藏
			hide: function() {
				$(".mask-div").hide();
				$("body").css("top", "auto");
				$("body").removeClass("visibly");
				if (this.list_show) {
					$(window).scrollTop(scrollheight);
				}
				$(this.container).find(".region-chooser-box").animate({
					height: '0'
				}, [10000]);

				// 关闭回调函数
				if ($.isFunction(this.hide_callback)) {
					this.hide_callback.call(this);
				}
			},
			// 显示隐藏切换
			toggle: function() {
				var container = this.container;
				if ($(container).find(".region-chooser-box").height() == 0) {
					this.show();
				} else {
					this.hide();
				}
			},
			reload: function() {
				var settings = this;
				if (settings.url == null) {
					if (settings.sale_scope == true) {
						settings.url = '/site/sale-region-list';
					} else {
						settings.url = '/site/region-list';
					}
				}
				// 第一次渲染页面
				settings.render();

				if (settings.value != null && settings.value != '') {
					settings.load(settings.value, true, null);
				} else {
					settings.load(settings.parent_code, false, null);
				}
				settings.is_loading = false;
			},
			// 设置显示文字
			setLabel: function(label) {
				if (!label || $.trim(label) == "") {
					label = "请选择收货地址";
				}
				$(this.container).find(".region-chooser-selected").find(".region").find("font").html(label + "<i class='iconfont'>&#xe607;</i>")
			},
			// 显示事件
			show_callback: null,
			// 隐藏事件
			hide_callback: null,
		};

		var container = $(this);

		if (!$(container).hasClass("region-chooser")) {
			$(container).addClass("region-chooser")
		}

		settings = $.extend(true, defaults, settings);
		settings.container = container;

		if (settings.sale_scope == true) {
			settings.url = '/site/sale-region-list';
		} else {
			settings.url = '/site/region-list';
		}

		// 第一次渲染页面
		settings.render();

		if (settings.value != null && settings.value != '') {
			settings.load(settings.value, true, null);
		} else {
			settings.load(settings.parent_code, false, null);
		}

		return settings;
	};
})(jQuery);