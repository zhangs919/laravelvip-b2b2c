/**
 * 数据表格插件
 * 
 * ============================================================================ 版权所有 2008-2015 秦皇岛商之翼网络科技有限公司，并保留所有权利。 ============================================================================
 * 
 * @author: niqingyang
 * @version 1.0
 * @date 2015-11-19
 * @link http://www.68ecshop.com
 */

(function($) {

	var is_ajax_loading = false;

	var settings = {
		selector: null,
		// 加载的数据默认为替换，通过修改append为true后可拼接到容器后面
		append: false,
		// 获取数据的地址
		url: null,
		// 默认的控制器Action，请勿调用此参数，通过URL会满足您所有的需求
		action: null,
		// 提交方式默认为GET提交
		method: 'GET',
		// 获取URL，如果没有传值url属性为空则调用当前路径的下的query.html
		getUrl: function() {

			var localurl = location.pathname.substring(0, location.pathname.lastIndexOf("/") + 1);
			var url = '';

			if (this.url && this.url.indexOf("./") == 0) {
				url = localurl + this.url.substring(1);
			} else if (this.url && this.url.indexOf("/") != 0) {
				url = localurl + this.url;
			} else if (this.url == undefined || this.url == null || $.trim(this.url) == '') {
				url = location.href;
			} else {
				url = this.url;
			}

			return url;
		},
		// 提交参数
		params: new Object(),
		colModel: [],
		// 是否允许多选
		multiselect: true,
		// 只有在multiselect设置为ture时起作用，定义使用那个key来做多选。shiftKey，altKey，ctrlKey
		multikey: "ctrlKey",
		// 只有当multiselect = true.起作用，当multiboxonly 为ture时只有选择checkbox才会起作用
		multiboxonly: false,
		// multiselect为ture，且点击头部的checkbox时才会触发此事件。
		// values：所有选中复选框的value集合，为一个数组。checked：boolean变量说明checkbox的选择状态，true选中false不选中。
		// 无论checkbox是否选择，values始终有值
		onSelectAll: null,
		// 当选择行时触发此事件。value：当前行所选中的复选框的value；checked：选择状态，当multiselect
		// 为true时此参数才可用
		onSelectRow: null,
		// 排序列的名称，此参数会被传到后台
		sortname: null,
		// 排序顺序，升序或者降序（asc or desc）
		sortorder: null,
		// 默认排序
		defsort: "asc",
		// 当点击排序列但是数据还未进行变化时触发此事件。field：待排序的字段；sort：排序状态,desc或者asc
		onSort: null,
		// 行被选中的样式
		rowClass: "active",
		// 表格的选择器，默认为原始选择器，可以修改自定义
		selector: $(this).selector,
		// Ajax后执行的事件
		// @param data Ajax后台传来的数据
		// @return boolean true-渲染页面 false-不渲染页面 不返回则默认为需要渲染页面
		callback: null,
		// Ajax前对提交的数据进行预处理，得到处理后返回的数据提交
		// @param data Ajax待提交的数据
		// @return data 返回提交的数据
		dataCallback: null,
		// 排序
		sort: function(sortname, sortorder) {
			return sort.call(this, $(this.selector), sortname, sortorder);
		},
		// 加载数据
		load: function(params, options) {
			return load.call(this, params, options);
		},
		// 加载数据
		append: function(params, options, filter) {
			append.call(this, params, options, filter);
		},
		// 加载事件，每次加载前都会执行此事件，将传人的参数与内部参数进行合并
		// @param params 请求提交的数据
		onLoad: null,
		// 分页
		// 定义翻页用的导航栏，必须是有效的html元素。翻页工具栏可以放置在html页面任意位置
		// 默认会调用id=pagination的元素
		// 如果分页元素内包含[data-page-json=true]则会读取其内容
		pager: "#pagination",
		page_id: "#pagination",
		pagekey: 'page',
		// 分页模式：0-默认ajax、1-点击刷新页面、2-链接刷新页面
		page_mode: 0,
		page: {
			// 当前页码
			cur_page: 1,
			// 每页显示的记录数
			page_size: 10,
			// 总记录数
			record_count: 0,
			// 总页数
			page_count: 0
		},
		// 当返回的数据行数为0时显示的信息
		emptyrecords: '<i class="fa fa-exclamation-circle"></i>没有符合条件的记录',
		// 跳转到某一页
		// JS会对所有带有属性[data-go-page]的元素绑定此函数
		go: function(page, page_size, options) {
			if (!page_size) {
				page_size = this.page_size;
			}
			go.call(this, $(this.selector), page, page_size, options);
		},
		// 跳转到首页
		firstPage: function(options) {
			this.go(1, this.page_size, options);
		},
		// 跳转到最后一页
		lastPage: function(options) {
			this.go(this.page_count, this.page_size, options);
		},
		// 上一页
		prePage: function(options) {
			var page = 1;
			if (this.cur_page > 1) {
				page = this.cur_page - 1;
			}
			this.go(page, this.page_size, options);
		},
		// 下一页
		nextPage: function(options) {
			var page = 1;
			if (this.cur_page < this.page_count) {
				page = this.cur_page + 1;
			}
			this.go(page, this.page_size, options);
		},
		// 移除数据
		remove: function(options) {
			remove.call(this, options);
		},
		ajax: function(options) {
			ajax.call(this, options);
		},
		// 重置
		reset: function(html, append, filter) {
			if (html != undefined && html != null) {

				if (append == undefined) {
					append = false;
				}

				if (append == true) {
					// 替换
					if (filter) {
						var element = $($.parseHTML(html)).find(filter).html();
						$(this.selector).find(filter).append(element);
					} else {
						$(this.selector).append(html);
					}
				} else {
					// 替换
					$(this.selector).replaceWith(html).remove();
				}

				var tablelist = $(this.selector).tablelist(this);

				// 重新初始化
				$.extend(true, this, tablelist);

				$.tablelists(this.page_id, this);
			}

			return this;
		},
		// 获取选中的复选框的value值
		checkedValues: function() {
			var values = [];
			$(this.selector).find(".table-list-checkbox").each(function() {
				if ($(this).is(":checked")) {
					values.push($(this).val());
				}
			});
			return values;
		},
		// 改变开关状态
		changeSwitch: function(object, value) {
			changeSwitch(object, value);
		}
	};

	/**
	 * 根据分页ID获取表格对象
	 * 
	 * @param page_id
	 *            不为空则获取指定的控件对象，为空则获取全部的控件数组
	 * @return 控件或者undefined
	 */
	$.tablelists = function(page_id, tablelist) {

		if (tablelist == undefined) {
			if ($("body").data("tablelists") && page_id != undefined) {
				return $("body").data("tablelists")[page_id];
			}
			return $("body").data("tablelists");
		}

		if (!$("body").data("tablelists")) {
			$("body").data("tablelists", {});
		}

		$("body").data("tablelists")[page_id] = tablelist;
	}

	$.fn.tablelist = function(options) {

		settings.selector = $(this).selector;
		settings = $.extend(true, settings, options);

		// var index = 0;
		// $(this).each(function() {
		// var settings_ = $.extend([], settings);
		// settings_.index = index;
		// init.call(this, this, settings_);
		// index++;
		// });

		var settings_ = $.extend({}, settings);

		init.call($(this).get(0), $(this).get(0), settings_);

		$.tablelists(settings.page_id, settings_);

		return settings_;
	}

	// 初始化表格
	function init(table, settings) {

		$(table).data("tablelist", settings);

		if (settings.multiselect) {
			// 遍历所有单元格
			$(table).find("tr").each(function(event) {

				$(this).find("th:first").find(":checkbox").addClass("table-list-checkbox-all").attr("title", "全选/全不选");
				if ($(this).parents("tfoot").size() == 0) {
					$(this).find("td:first").find(":checkbox").addClass("table-list-checkbox");
				} else {
					$(this).find("td:first").find(":checkbox").addClass("table-list-checkbox-all").attr("title", "全选/全不选");
				}

				// 按住ctrl、shif或者alt键实现单击行选中复选框的效果
				if (settings.multiboxonly == false) {
					if (settings.multikey == "ctrlKey" || settings.multikey == "shiftKey" || settings.multikey == "altKey") {
						$(this).click(function(e) {
							if (e[settings.multikey]) {
								var checkbox = $(this).find("td:first").find(":checkbox");
								if (checkbox) {
									checkbox.click();
								}
							}
						});
					}
				}
			});

			// 单击列表复选框
			$(".table-list-checkbox").click(function() {
				if ($(".table-list-checkbox:checked").size() == $(".table-list-checkbox").size()) {
					$(".table-list-checkbox-all").prop("checked", true);
					$(this).parents("tr").attr("data-selected", true);
				} else {
					$(".table-list-checkbox-all").prop("checked", false);
					$(this).parents("tr:first").removeAttr("data-selected");
				}

				if ($(this).is(":checked")) {
					$(this).parents("tr").addClass(settings.rowClass);
				} else {
					$(this).parents("tr").removeClass(settings.rowClass);
				}

				// 点击行选择复选框或者单击复选框时才会触发onSelectRow事件
				if ($.isFunction(settings.onSelectRow)) {
					var values = new Array();
					$(".table-list-checkbox:checked").each(function() {
						values.push($(this).val());
					});

					var value = $(this).val();
					var checked = $(this).is(":checked");
					settings.onSelectRow(value, checked);
				}
			});

			// 单击头部复选框 - 如果是下班就不选中
			$(".table-list-checkbox-all").click(function(e) {
				// 判断当前的状态
				var checked = $(this).is(":checked");
				var $allCbs = $(".table-list-checkbox");
				// 设置全选框的状态
				$(this).prop("checked", checked);
				// 如果全选的checkbox被选中
				if (checked) {
					// 遍历所有的checkbox筛选已经被禁止的选项
					$allCbs.each(function() {
						var that = $(this);
						var disabled = $(this).prop('disabled');
						if (!disabled) {
							that.prop("checked", checked);
							that.closest("tr").addClass(settings.rowClass);
						}
					});
				} else {
					// 全选被取消,则取消所有已经被checked的checkbox
					$allCbs.prop('checked', checked);
					$allCbs.parents("tr").removeClass(settings.rowClass);
				}

				// 点击头部复选框才会触发onSelectAll事件
				if ($.isFunction(settings.onSelectAll)) {
					var values = new Array();
					$(".table-list-checkbox:checked").each(function() {
						values.push($(this).val());
					});
					settings.onSelectAll(values, checked);
				}
			});
		}

		/**
		 * 排序请求
		 */
		$(table).find("[data-sortname]").each(function() {
			var sortname = $(this).attr("data-sortname");

			if (sortname.length == 0) {
				$(this).css({
					cursor: "default"
				});
				return;
			}

			$(this).css({
				cursor: "pointer"
			});

			var text = $(this).text();
			// 如果当前配置中的排序为当前单元格并且排序非空则显示排序样式
			if (sortname == settings.sortname && settings.sortorder != null) {
				$(this).html(text + "<span class='sort " + settings.sortorder + "'></span>");
				if (settings.sortorder == "desc") {
					$(this).attr("data-sortorder", "asc");
				} else {
					$(this).attr("data-sortorder", "desc");
				}
			} else {
				$(this).html(text + "<span class='sort'></span>");

				var sortorder = $(this).attr("data-sortorder");

				if (!sortorder || (sortorder.toLowerCase() != 'asc' && sortorder.toLowerCase() != 'desc')) {
					$(this).attr("data-sortorder", settings.defsort);
				}
			}

			$(this).click(function() {

				var sortname = $(this).attr("data-sortname");

				var sortorder = $(this).attr("data-sortorder");

				sort.call(settings, table, sortname, sortorder);

			});

		});

		/**
		 * 鼠标悬浮在表头时的激活样式
		 * 
		 * $(this).find("tr:first>th").mouseover(function() { $(this).addClass("active"); var sortname = $(this).attr("data-sortname"); var sortorder = $(this).attr("data-sortorder"); if (sortname != null) { $(this).css({ cursor: "pointer" }); if($(table).hasClass("table-list-sort-new") && sortname == settings.sortname){ $(this).find("span").removeClass("asc").removeClass("desc").addClass(settings.sortorder); }else{ $(this).find("span").removeClass("asc").removeClass("desc").addClass(sortorder); } } else { $(this).css({ cursor: "default" }); } }).mouseout(function() { $(this).removeClass("active"); var sortname = $(this).attr("data-sortname"); if (sortname != null) { if(sortname == settings.sortname){ $(this).find("span").removeClass("asc").removeClass("desc").addClass(settings.sortorder);
		 * }else{ $(this).find("span").removeClass("desc").removeClass("asc"); } } $(table).removeClass("table-list-sort-new"); });
		 */

		$(table).find("tr:first>th").mouseover(function() {
			$(this).addClass("active");
			var sortname = $(this).attr("data-sortname");
			var sortorder = $(this).attr("data-sortorder");
			if (sortname != null) {
				$(this).css({
					cursor: "pointer"
				});
			} else {
				$(this).css({
					cursor: "default"
				});
			}
		}).mouseout(function() {
			var sortname = $(this).attr("data-sortname");
			if (sortname == null || sortname == '' || sortname != settings.sortname) {
				$(this).removeClass("active");
			}
			// $(table).removeClass("table-list-sort-new");
		});

		$(table).find("tr:first>th>span").mouseover(function(e) {
			return true;
		}).mouseout(function(e) {
			return true;
		});

		// 开关控制
		$(table).find("span.table-editor").css("cursor", "pointer");
		$(table).find("span.table-editor").attr("title", "点击进行编辑");
		$(table).find("span.table-editor").click(function() {

			if ($(this).data("editor-mode")) {
				return;
			}

			var type = $(this).data("editor-type");

			if (type == undefined) {
				type = "text";
			}

			var value = $.trim($(this).html());

			$(this).data("editor-value", value);

			var element = null;

			if (type == "text") {
				element = $('<input type="text" class="form-control small" />');
			} else if (type == "textarea") {
				element = $('<textarea class="form-control ipt"></textarea>');
			} else if (type == "select") {
				var html = '<select class="form-control">';

				if ($(this).data("editor-items")) {
					try {
						var items = $.parseJSON($(this).data("editor-items"));

						for ( var key in items) {
							html += '<option value="' + key + '">"' + items[key] + '"</option>';
						}

					} catch (e) {
						console.error(e);
					}
				}

				html += '</select>';

				element = $(html);
			}

			element.val(value);

			$(this).html("");
			$(this).append(element);

			$(element).focus();

			var target = this;

			$(element).blur(function() {
				var value = $(target).data("editor-value");
				var current_value = $.trim($(this).val());

				var callback = $(target).data("editor-callback");

				if (callback && $.isFunction(callback)) {
					callback.call();
				}

				$(target).html(current_value);

				$(target).data("editor-mode", false);
			});

			$(this).data("editor-mode", true);
		});

		/**
		 * 分页初始化
		 */
		if (settings.page_mode == 2) {
			$(settings.page_id).find("[data-go-page]").each(function() {
				if ($(this).is(":disabled")) {
					return;
				}
				var cur_page = $(this).data("go-page");

				var url = settings.getUrl();
				if (url.indexOf("?") != -1) {
					var params = url.substring(url.indexOf("?") + 1);
					params = params.split("&");

					if (url.indexOf("page[cur_page]=") != -1) {
						for (var i = 0; i < params.length; i++) {
							var key = params[i].split("=")[0];

							if (key == 'page[cur_page]') {
								params[i] = 'page[cur_page]=' + cur_page;
								is_exist = true;
							}
						}
					} else {
						params.push('page[cur_page]=' + cur_page);
					}

					params = params.join("&");

					url = url.substring(0, url.indexOf("?")) + "?" + params;
				} else {
					url = url + "?page[cur_page]=" + cur_page;
				}

				$(this).attr("href", url);
			});
		} else {
			$(settings.page_id).find("[data-go-page]").click(function() {
				if ($(this).is(":disabled")) {
					return;
				}
				var page = $(this).attr("data-go-page");

				if (settings.page_mode == 1) {
					settings.go(page);
				} else {
					go.call(settings, table, page);
				}
			});
		}

		var page_json = $(settings.page_id).find("[data-page-json]").html();
		if (page_json) {
			var page = $.parseJSON(page_json);
			settings.cur_page = page.cur_page;
			settings.page_count = page.page_count;
			settings.record_count = page.record_count;
			settings.page_size = page.page_size;
			// 赋值
			settings.pagekey = page.page_key;
			settings.page = $.extend(true, settings.page, page);

			if (page.record_count == 0 && settings.emptyrecords != false) {
				var colspan = $(table).find("thead").find("th").size();
				var empty_data_html = '<tr><td class="no-data" colspan="' + colspan + '">' + settings.emptyrecords + '</td></tr>';
				$(table).find("tbody").html(empty_data_html);
			}
			// 更新工具栏的总计路数
			$("[data-total-record]").html(page.record_count);
		}

		$(settings.page_id).find("[data-page-size]").change(function() {
			var page_size = $(this).val();
			var params = {
				page: {
					cur_page: 1,
					page_size: page_size,
					page_id: settings.page_id,
					page_size_list: settings.page.page_size_list
				}
			};
			load.call(settings, params);
		});

		// 开关控制
		$("span.ico-switch[data-action]").click(function() {

			var click = $(this).data("click");

			// 自定义点击事件
			try {
				click = eval(click);
				if ($.isFunction(click)) {
					click.call(settings, this, $(this).attr("value"));
					return;
				}
			} catch (e) {
			}

			// 防止频繁点击重复提交
			var request = $(this).data("ajax");
			var callback = $(this).data("callback");

			if (request) {
				request.abort();
			}

			var action = $(this).attr("data-action");
			var refresh = $(this).attr("refresh");
			if (action == '') {
				return false;
			}

			var localurl = location.pathname.substring(0, location.pathname.lastIndexOf("/") + 1);
			var url = '';

			if (action && action.indexOf("./") == 0) {
				url = localurl + action.substring(1);
			} else if (action && action.indexOf("/") != 0) {
				url = localurl + action;
			} else if (action == undefined || action == null || $.trim(action) == '') {
				url = localurl + action;
			} else {
				url = action;
			}

			var method = "GET";

			var params = $(this).attr("data-params");

			if (params) {
				params = $.parseJSON(params);
				if (!params['_csrf']) {
					params._csrf = $("[name='_csrf']:first").val();
				}
				method = "POST";
			} else {
				params = {};
			}
			
			$.loading.start();

			var object = this;

			request = ajax({
				url: url,
				type: method,
				data: params,
				success: function(result) {

					if (result.code == 0) {
						var value = result.data;
						changeSwitch($(object), value);

						if (callback) {
							try {
								callback = eval(callback);
								if ($.isFunction(callback)) {
									callback.call(settings, result, object, value);
								}
							} catch (e) {
							}
						}
					} else if (result.message) {
						if ($.isFunction($.msg)) {
							$.msg(result.message, {
								icon: 'error'
							});
						} else {
							alert(result.message);
						}
					}

					ajaxCallback.call(settings, result);

					if (refresh == 1) {
						$.go(window.location.href);
					}
				}
			}).always(function() {
				$.loading.stop();
			});

			$(this).data("ajax", request);
		});
	}

	/**
	 * 
	 * @param table
	 *            表格对象
	 * @param sortname
	 *            排序字段
	 * @param sortorder
	 *            排序顺序
	 */
	function sort(table, sortname, sortorder) {

		// 判断Ajax是否正在加载，防止重复提交
		if (is_ajax_loading) {
			return;
		}

		var settings = this;

		settings.sortname = sortname;
		settings.sortorder = sortorder;

		// Ajax请求开始
		is_ajax_loading = true;

		var target = $(table).find("[data-sortname='" + sortname + "']");

		if (target.size() > 0) {
			// 页面效果
			$(target).siblings("[data-sortname]").find("span").removeClass("asc").removeClass("desc");
			$(target).html($(target).text() + "<span class='sort " + sortorder + "'></span>");
		}

		if (!settings.params) {
			settings.params = new Object();
		}

		var params = {
			sortname: sortname,
			sortorder: sortorder,

			page: {
				// 当前页数
				cur_page: settings.page.cur_page ? settings.page.cur_page : 1,
				// 每页记录数
				page_size: settings.page.page_size ? settings.page.page_size : 10,
				// 分页ID
				page_id: settings.page_id,
				// 每页显示的记录数列表
				page_size_list: settings.page.page_size_list
			}
		};

		// 加载
		return load.call(settings, params);
	}

	/**
	 * 
	 * @param table
	 *            表格对象
	 * @param page_number
	 *            跳转的页数，从1开始
	 * @param page_size
	 *            每页显示的记录数，必须大于0
	 */
	function go(table, page_number, page_size, options) {

		// 判断Ajax是否正在加载，防止重复提交
		if (is_ajax_loading) {
			return;
		}

		var settings = this;

		var params = {
			page: {
				cur_page: page_number ? page_number : 1,
				page_size: page_size ? page_size : settings.page.page_size,
				page_id: settings.page_id,
				// 每页显示的记录数列表
				page_size_list: settings.page.page_size_list
			}
		};

		if (settings.page_mode == 2) {
			var cur_page = page_number;

			if (isNaN(cur_page)) {
				cur_page = 1;
			}

			var url = settings.getUrl();
			if (url.indexOf("?") != -1) {
				var params = url.substring(url.indexOf("?") + 1);
				params = params.split("&");

				if (url.indexOf("page[cur_page]=") != -1) {
					for (var i = 0; i < params.length; i++) {
						var key = params[i].split("=")[0];

						if (key == 'page[cur_page]') {
							params[i] = 'page[cur_page]=' + cur_page;
							is_exist = true;
						}
					}
				} else {
					params.push('page[cur_page]=' + cur_page);
				}

				params = params.join("&");

				url = url.substring(0, url.indexOf("?")) + "?" + params;
			} else {
				url = url + "?page[cur_page]=" + cur_page;
			}

			window.location.href = url;

		} else {
			if (settings.page_mode == 1) {

			} else {
				load.call(settings, params, options);
			}
		}
	}

	/**
	 * 加载数据
	 * 
	 * @param params
	 *            ajax提交请求数据的参数
	 * @param options
	 *            ajax提交配置
	 */
	function append(params, options, filter) {
		var settings = this;
		load.call(this, params, options, true, filter);
	}

	/**
	 * 加载数据
	 * 
	 * @param params
	 *            ajax提交请求数据的参数
	 * @param options
	 *            ajax提交配置
	 */
	function load(params, options, append, filter) {
		var settings = this;

		settings.params[settings.pagekey] = {
			page_id: settings.page_id,
			cur_page: settings.page.cur_page,
			page_size: settings.page.page_size
		}

		var defaults = {
			url: settings.getUrl(),
			method: settings.method,
			callback: settings.callback
		};

		if ($.isFunction(options)) {
			options = {
				callback: options
			};
		}

		options = $.extend(true, defaults, options);

		if (settings.sortname) {
			settings.params['sortname'] = settings.sortname;
		}
		if (settings.sortorder) {
			settings.params['sortorder'] = settings.sortorder;
		}
		if (append) {
			settings.params['showloading'] = false;
		} else {
			settings.params['showloading'] = true;
		}

		if (params) {
			settings.params = $.extend(false, settings.params, params);
		}

		// Ajax开始加载
		is_ajax_loading = true;

		return ajax.call(settings, {
			url: options.url,
			type: options.method,
			data: settings.params,
			success: function(result) {
				// 加载页面
				if (result.code == 0) {
					settings.reset(result.data, append, filter);
				} else if (result.message && result.message != "") {
					$.msg(result.message);
				}
				ajaxCallback.call(settings, result, options.callback);
			}
		}).done(function(result) {
			// Ajax加载结束
			is_ajax_loading = false;
		});
	}

	/**
	 * 改变开关状态
	 */
	function changeSwitch(object, value) {
		var values = $(object).attr("data-value");
		if (values) {
			try {
				values = $.parseJSON(values);
			} catch (e) {
			}
		}
		var labels = $(object).attr("data-label");
		if (labels) {
			try {
				labels = $.parseJSON(labels);
			} catch (e) {
			}
		}
		var clazzs = $(object).attr("data-class");
		if (clazzs) {
			try {
				clazzs = $.parseJSON(clazzs);
			} catch (e) {
			}
		}

		if (value == undefined) {
			value = $(object).attr("value");
		}

		if (values && labels && clazzs) {

			if ($(object).hasClass("open")) {
				$(object).removeClass("open");
			} else {
				$(object).addClass("open");
			}

			var index;
			var new_value;

			$.each(values, function(i, v) {
				if (value == v) {
					index = i;
					$(object).attr("value", v);
					return false;
				}
			});

			var label = labels[index];
			var clazz = clazzs[index];

			$(object).html("<i class='" + clazz + "'></i>" + label);
		}
	}

	// AJAX删除
	// @param options {callback: 回调函数}
	function remove(options) {

		var settings = this;

		var icons = {
			// 警告
			'warning': 0,
			// 成功
			'success': 1,
			// 错误
			'error': 2,
			// 信息
			'info': 0
		};

		var defaults = {
			url: url,
			type: 'POST',
			data: {

			},
			dataType: 'json',
			success: function(result) {
				if (result.code == 0) {
					var value = result.data;

					var icon = result.data && result.data.icon && icons[result.data.icon] ? icons[result.data.icon] : 1;

					// 删除成功后则重新加载
					settings.load({}, {
						callback: function(load_result) {
							// 回调函数
							ajaxCallback.call(settings, result, options.callback);
						}
					});

					// 如果有提示信息则显示
					if (result.message && $.trim(result.message) != '') {
						if ($.isFunction($.msg)) {
							$.msg(result.message, {
								icon: icon
							});
						} else {
							alert(result.message);
						}
					}
				} else if (result.message) {

					// 回调函数
					ajaxCallback.call(settings, result, options.callback);

					// 显示错误消息
					if ($.isFunction($.alert)) {

						var icon = result.data && result.data.icon && icons[result.data.icon] ? icons[result.data.icon] : 2;

						$.alert(result.message, {
							icon: icon
						});
					} else {
						alert(result.message);
					}
				}

				// Ajax加载结束
				is_ajax_loading = false;
			}
		};

		options = $.extend(true, defaults, options);

		// POST提交需要获取CSRF
		if (options.type.toLowerCase() == 'post' && options.data['_csrf'] == undefined) {
			if ($("[name='_csrf']").size() > 0) {
				options.data['_csrf'] = $("[name='_csrf']:first").val();
			} else {
				var name = $.getCsrfParam();
				var value = $.getCsrfToken();
				options.data[name] = value;
			}
		}

		var localurl = location.pathname.substring(0, location.pathname.lastIndexOf("/") + 1);
		var url = options.url;

		if (url && url.indexOf("./") == 0) {
			url = localurl + url.substring(1);
		} else if (url && url.indexOf("/") != 0) {
			url = localurl + url;
		} else if (url == undefined || url == null || $.trim(url) == '') {
			url = localurl + url;
		}

		var confirm = options.confirm;

		if (confirm == undefined) {
			// 防止频繁点击重复提交
			if (is_ajax_loading) {
				return;
			}

			ajax.call(settings, options);
		} else {
			if ($.isFunction($.confirm)) {
				$.confirm(confirm, {
					icon: 3
				}, function(index) {
					ajax.call(settings, options);
				});
			} else if (confirm(confirm)) {
				ajax.call(settings, options);
			}
		}
	}

	/**
	 * AJAX
	 */
	function ajax(options) {

		var config = {
			type: "GET",
			async: true,
			data: {},
			dataType: "json",
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				// Ajax请求结束
				is_ajax_loading = false;

				try {
					var result = $.parseJSON(XMLHttpRequest.responseText);
					if (result && result.message) {
						$.msg(result.message);
					}
				} catch (e) {
					console.error(e);
					// 先去掉弹框
					// $.msg("失败" + XMLHttpRequest.status);
				}

			}
		};

		if (this.page) {
			config.data.page = {
				cur_page: this.page.cur_page,
				page_size: this.page.page_size
			};

			if (this.page.page_id != 'pagination') {
				config.data.page.page_id = this.page.page_id;
			}
		}

		options = $.extend(true, config, options);

		if (this && $.isFunction(this.dataCallback)) {
			options.data = this.dataCallback(options.data);
		}

		try {
			// 删除Key
			delete options.data.page.page_size_list;
		} catch (e) {
		}

		// POST提交需要获取CSRF
		if (options.type.toLowerCase() == 'post' && options.data['_csrf'] == undefined) {
			if ($("[name='_csrf']").size() > 0) {
				options.data['_csrf'] = $("[name='_csrf']:first").val();
			} else {
				var name = $.getCsrfParam();
				var value = $.getCsrfToken();
				options.data[name] = value;
			}
		}
		if (options.data['showloading'] == true) {
			// 开始加载
			$.loading.start();
		}
		return $.ajax(options).always(function() {
			// 加载结束
			$.loading.stop();
		});

	}

	/**
	 * Ajax回调函数
	 * 
	 * @param result
	 *            Ajax后返回的数据
	 * @param callback
	 *            Ajax后的回调函数
	 * 
	 */
	function ajaxCallback(result, callback) {

		var settings = this;

		if ($.isFunction(callback)) {
			callback.call(settings, result);
		} else if ($.isFunction(settings.callback)) {
			settings.callback.call(settings, result);
		}

		$.loading.stop();
	}

	/**
	 * @return string|undefined the CSRF parameter name. Undefined is returned if CSRF validation is not enabled.
	 */
	$.getCsrfParam = function() {
		return $('meta[name=csrf-param]').attr('content');
	}

	/**
	 * @return string|undefined the CSRF token. Undefined is returned if CSRF validation is not enabled.
	 */
	$.getCsrfToken = function() {
		return $('meta[name=csrf-token]').attr('content');
	}
})(jQuery);