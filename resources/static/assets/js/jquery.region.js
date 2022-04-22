/**
 * 地区公共组件
 * 
 * ============================================================================ 版权所有 2008-2015 秦皇岛商之翼网络科技有限公司，并保留所有权利。 ============================================================================
 * 
 * @author: niqingyang
 * @version 1.0
 * @date 2016-4-12
 * @link http://www.68ecshop.com
 */
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
	var sale_region_cache = [];
	var region_level_names = ['', '省', '市', '区/县', '镇', '街道'];
	var sale_region_level_names = ['', '省', '市', '区/县', '镇', '街道'];

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
			// 获取缓存
			getCache: function(region_code) {
				if (this.sale_scope) {
					if (sale_region_level_names) {
						this.level_names = sale_region_level_names;
					}
					return sale_region_cache[region_code];
				}
				if (region_level_names) {
					this.level_names = region_level_names;
				}
				return region_cache[region_code];
			},
			// 设置缓存
			setCache: function(region_code, list, level_names) {
				if (this.sale_scope) {
					sale_region_cache[region_code] = list;
				} else {
					region_cache[region_code] = list;
				}
				if (level_names) {
					if (this.sale_scope) {
						sale_region_level_names = level_names;
					} else {
						region_level_names = level_names;
					}
				}
			},
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
			// 是否只读
			read_only: false,
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

					if (settings.getCache(region_code) != undefined) {
						settings.render(settings.getCache(region_code), target, region_code);
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
					settings.render(list, target, region_code);

					if (!value_mode) {
						settings.setCache(data.parent_code, list, result.level_names);
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
			render: function(list, target, region_code) {

				var settings = this;
				var container = settings.container;

				if (list == undefined && $(container).find("." + settings.widget_class + "").size() == 0) {
					var select_class = settings.select_class + " " + settings.widget_class + "-init";
					if (this.read_only) {
						var element = $("<select class='" + select_class + "' disabled><option value=''>-请选择-</option></select>")
					} else {
						var element = $("<select class='" + select_class + "'><option value=''>-请选择-</option></select>")
					}

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

				if (list != undefined && list[0].length == 0 && region_code != null && region_code != "") {

					// 已加载到最后一级调用change事件

					$(target).data("is_last", true);

					if ($.isFunction(settings.change)) {

						var names = [];
						var codes = [];
						var data = {};

						$(container).find("." + settings.widget_class + " option:selected").each(function() {
							if ($(this).val() != '') {
								names.push($(this).html());
								codes.push($(this).val());
								data = $(this).data();
							}
						});

						if (codes.length > 0) {
							settings.value = codes[codes.length - 1];
							var result = settings.change.call(settings, settings.value, names, true, data);
						}
					}

					return;
				} else if (list != undefined && list[0].length > 0 && region_code != null && region_code != "") {

					// 未加载到最后一级则继续加载

					$(target).data("is_last", false);

					if ($.isFunction(settings.change)) {

						var names = [];
						var codes = [];
						var data = {};

						$(container).find("." + settings.widget_class + " option:selected").each(function() {
							if ($(this).val() != '') {
								names.push($(this).html());
								codes.push($(this).val());
								data = $(this).data();
							}
						});

						if (codes.length > 0) {
							var result = settings.change.call(settings, codes[codes.length - 1], names, false, data);
						}
					}
				}

				if (list == undefined || list.length == 0 || list[0].length == 0) {
					$(target).data("is_last", true);
					// 如果是值加载模式则出发一次change事件
					// 触发change
					// $(container).find("." + settings.widget_class + ":last").trigger("change", [true]);
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
					if (settings.read_only) {
						var element = $("<select class='" + select_class + "' disabled><option value=''>-请选择-</option></select>");
					} else {
						var element = $("<select class='" + select_class + "'><option value=''>-请选择-</option></select>");
					}

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

						if (item.center) {
							$(option).data("center", item.center);
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
						var data = {};

						$(container).find("." + settings.widget_class + " option:selected").each(function() {
							if ($(this).val() != '') {
								names.push($(this).html());
								codes.push($(this).val());
								data = $(this).data();
							}
						});

						if (codes.length > 0) {
							settings.value = codes[codes.length - 1];
						} else {
							settings.value = "";
						}

						if (value == '') {
							if ($.isFunction(settings.change)) {
								var current_value = codes.length > 0 ? codes[codes.length - 1] : "";
								var result = settings.change.call(settings, current_value, names, is_last, data);
							}
							return;
						}
						// 未到最后一级继续加载
						if (is_last == false) {
							settings.load(value, false, this);
						}
					});
				}
			},
			// 获取当前选择的值的数组
			values: function() {
				var values = [];

				$(container).find("." + this.widget_class + " option:selected").each(function() {
					if ($(this).val() != '') {
						values.push({
							region_code: $(this).val(),
							region_name: $(this).html(),
						});
					}
				});

				return values;
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
						settings.url = '/site/sale-region-list.html';
					} else {
						settings.url = '/site/region-list.html';
					}
				}

				settings.container.find("." + this.widget_class).remove();

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
				settings.url = '/site/sale-region-list.html';
			} else {
				settings.url = '/site/region-list.html';
			}
		}

		// 第一次渲染页面
		// settings.render();

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
			// 获取缓存
			getCache: function(region_code) {
				if (this.sale_scope) {
					return sale_region_cache[region_code];
				}
				return region_cache[region_code];
			},
			// 设置缓存
			setCache: function(region_code, list, level_names) {
				if (this.sale_scope) {
					sale_region_cache[region_code] = list;
				} else {
					region_cache[region_code] = list;
				}
			},
			// 渲染每个元素后的回调函数【废弃】
			// @param element 元素
			// @return 新的element
			select_callback: null,
			// 地区层级名称
			level_names: ['', '省', '市', '区/县', '镇', '街道'],
			// 组件class【废弃】
			widget_class: "region-chooser",
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

					if (settings.getCache(region_code) != undefined) {
						settings.render(settings.getCache(region_code), value_mode, target);
						return;
					}
				}

				// 如果target不为空则说明是点击了超链接项
				if (target != null) {

					// 从缓存中获取数据
					if (settings.getCache(region_code) != undefined) {
						settings.render(settings.getCache(region_code), value_mode, target);
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
							settings.setCache(data.parent_code, list, result.level_names);
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
					html += '<font>';
					html += '请选择';
					html += '<i></i>';
					html += '</font>';
					html += '</div>';
					html += '</div>';
					html += '<div class="region-chooser-box" id="region-chooser-box" style="display: none;">';
					html += '<div class="region-chooser-close"></div>';
					html += '<div class="region-tabs">';
					html += '</div>';
					html += '</div>';
					html += '<div style="clear: both;"></div>';
					html += '</div>';

					$(container).html($.parseHTML(html));

					// 显示隐藏切换事件
					$(container).mouseenter(function() {
						settings.show();
					}).mouseleave(function() {
						if ($(container).data("should-show")) {
							$(container).data("should-show", false);
							return;
						}
						settings.hide();
					});

					// 关闭按钮事件
					$(container).find(".region-chooser-close").click(function() {
						settings.toggle();
					});

					// 单击tab
					$(container).on("click", ".region-tab", function() {
						var region_code = $(this).data("region-code");
						$(container).find(".region-tab").filter(".selected").removeClass("selected");
						$(this).addClass("selected");
						$(container).find(".region-items[data-region-code='" + region_code + "']").show();
						$(container).find(".region-items[data-region-code!='" + region_code + "']").hide();
					});

					// 单击项
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
					$(container).find(".region-tab").filter("[data-region-level='" + region_level + "']").nextAll(".region-tab").remove();
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
					var data = {};

					$(container).find(".region-items").hide();

					if ($(container).find(".region-items").filter("[data-region-code='" + region_code + "']").size() > 0) {
						$(container).find(".region-items").filter("[data-region-code='" + region_code + "']").show();
						if (list[list.length - 1].length == 0) {
							region_name = list[i][0].region_name;
							region_names.push(region_name);
						}
					} else {
						var element = $('<div class="region-items" data-region-level="' + region_level + '" data-region-code="' + region_code + '"></div>');

						for (var j = 0; j < list[i].length; j++) {
							var item = list[i][j];

							var is_selected = false;

							// 如果只有一个选项则默认选中
							if (list[list.length - 1].length == 0) {
								is_selected = true;
							} else if (in_array(item.region_code, values)) {
								is_selected = true;
							}

							var element_item = $('<a href="javascript:void(0);" data-region-level="' + region_level + '" data-region-code="' + item.region_code + '" data-parent-code="' + item.parent_code + '" data-region-name="' + item.region_name + '" data-center="' + (item.center ? item.center : "") + '">' + item.region_name + '</a>');

							if (item.center) {
								$(element_item).data("center", item.center);
							}

							if (is_selected) {
								region_name = item.region_name;
								region_names.push(region_name);
								data = $(element_item).data();
							}

							$(element).append(element_item);
						}

						$(container).find(".region-chooser-box").append(element);
					}

					// 移除选择
					$(container).find(".region-tab").filter(".selected").removeClass("selected");
					// 移除后面的Tab
					$(container).find(".region-tabs").find("[data-region-level='" + region_level + "']").remove();
					// 添加新的Tab
					var tab_element = $('<div class="region-tab selected" data-region-level="' + region_level + '" data-region-code="' + region_code + '" style="display: block"><i></i></div>');
					// 拼接HTML
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
					names = ["请选择"];
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
						settings.show();
						$(container).data("should-show", true);
					} else {
						// 默认最后一级修改标题
						$(container).find(".region").html("<font>" + names.join(" ") + "<i></i></font>");
						// 隐藏
						settings.hide();
					}

					// change事件
					if ($.isFunction(settings.change)) {
						var result = settings.change.call(settings, value, names, is_last, data);
						if (result == false) {
							return;
						}
					}

				}

			},
			// 显示
			show: function() {
				$(this.container).find(".region").addClass("active");
				$(this.container).find(".region-chooser-box").show();
			},
			// 隐藏
			hide: function() {
				$(this.container).find(".region").removeClass("active");
				$(this.container).find(".region-chooser-box").hide();
			},
			// 显示隐藏切换
			toggle: function() {
				var container = this.container;
				if ($(container).find(".region-chooser-box").is(":hidden")) {
					$(container).find(".region-chooser-box").show();
				} else {
					$(container).find(".region-chooser-box").hide();
				}
			},
			reload: function() {
				var settings = this;
				if (settings.url == null) {
					if (settings.sale_scope == true) {
						settings.url = '/site/sale-region-list.html';
					} else {
						settings.url = '/site/region-list.html';
					}
				}

				settings.container.find("." + this.widget_class).remove();

				// 第一次渲染页面
				settings.render();

				if (settings.value != null && settings.value != '') {
					settings.load(settings.value, true, null);
				} else {
					settings.load(settings.parent_code, false, null);
				}
			},
			// 设置显示的内容
			setTitle: function(title) {
				if ($.trim(title) == "") {
					title = "请选择";
				}
				// 默认最后一级修改标题
				$(container).find(".region").html("<font>" + title + "<i></i></font>");
			}
		};

		var container = $(this);

		if (!$(container).hasClass("region-chooser")) {
			$(container).addClass("region-chooser")
		}

		settings = $.extend(true, defaults, settings);
		settings.container = container;

		if (settings.sale_scope == true) {
			settings.url = '/site/sale-region-list.html';
		} else {
			settings.url = '/site/region-list.html';
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