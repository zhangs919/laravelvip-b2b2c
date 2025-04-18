/**
 * 常用操作插件
 */

(function($) {
	var szy_tag = $("meta[name='szy_tag']").attr("content");
	
	$.baseurl = function(path, tag) {
		
		if (tag == undefined) {
			tag = szy_tag;
		}
		
		if (path && tag && path.indexOf("/") == 0 && path.indexOf("/" + tag) == -1) {
			return "/" + tag + path;
		}
		
		if (path && path.indexOf(window.location.origin) == 0 && path.indexOf("/" + tag) == -1) {
			// return window.location.origin + "/" + tag +
			// path.substring(window.location.origin.length);
		}
		
		return path;
	}

	$.initTag = function() {
		if (szy_tag) {
			$("a,area").not("[szy_tag_compiled]").each(function() {
				var href = $(this).attr("href");
				
				$(this).attr("href", $.baseurl(href, szy_tag));
				
				$(this).attr("szy_tag_compiled", 1);
			});
			
			$("form").not("[szy_tag_compiled]").each(function() {
				var action = $(this).attr("action");
				
				$(this).attr("action", $.baseurl(action, szy_tag));
				
				$(this).attr("szy_tag_compiled", 1);
			});
		}
	}

	if (szy_tag) {
		$().ready(function() {
			$.initTag();
		});
	}

	/**
	 * 防抖函数
	 * @param fn
	 * @param delay
	 * @returns {(function(): void)|*}
	 */
	$.debounce = function(fn, delay) {
		//借助闭包
		var timer = null;
		return function () {
			if (timer) {
				//进入该分支语句，说明当前正在一个计时过程中，并且又触发了相同事件。所以要取消当前的计时，重新开始计时
				clearTimeout(timer);
			}
			// 进入该分支说明当前并没有在计时，那么就开始一个计时
			timer = setTimeout(fn, delay);
		}
	}

	/**
	 * 节流函数
	 * @param fn
	 * @param delay
	 * @returns {(function(): (boolean|undefined))|*}
	 */
	$.throttle = function(fn, delay){
		var valid = true;
		return function() {
			if(!valid){
				//休息时间 暂不接客
				return false;
			}
			// 工作时间，执行函数并且在间隔期内把状态位设为无效
			valid = false;
			setTimeout(function() {
				fn();
				valid = true;
			}, delay);
		}
	}

	if (layer) {
		layer.config({
			moveType: 1,
			scrollbar: true,
			shadeClose: false,
			// 控制出场动画：0-6
			anim: 0,
			shift: 0,
			tips: [2, '#FF9900'],
			// 触发拖动的元素，false表示不允许拖动
			move: '.layui-layer-title',
			path: '/js/layer/'
		// extend: 'extend/layer.ext.js'
		// 可以控制标题栏是否显示
		// title: false
		});
	}
	
	// 可以统一控制是否全屏显示
	if (top.layer) {
		// layer = top.layer;
	}
	
	$.closeDialog = function(index) {
		if (layer) {
			if(index == undefined) {
				index = $(".layui-layer:last").attr("times");
			}
			layer.close(index);
		}
	}
	// layer.closeAll(); //疯狂模式，关闭所有层
	// layer.closeAll('dialog'); //关闭信息框
	// layer.closeAll('page'); //关闭所有页面层
	// layer.closeAll('iframe'); //关闭所有的iframe层
	// layer.closeAll('loading'); //关闭加载层
	// layer.closeAll('tips'); //关闭所有的tips层
	$.closeAll = function(type) {
		if (layer) {
			layer.closeAll(type);
		}
	}

	/**
	 * 打开一个模式窗口
	 */
	$.open = function(options) {
		
		if (isNaN(options.width) == false) {
			options.width = options.width + "px";
		}
		
		if (isNaN(options.height) == false) {
			options.height = options.height + "px";
		}
		
		if (!options.area) {
			if (options.width != undefined && options.height != undefined) {
				options.area = [options.width, options.height];
			} else if (options.width != undefined) {
				options.area = options.width;
			}
		}
		
		if (options.ajax) {
			// 默认值
			if (options.type == undefined) {
				options.type = 1;
			}
			
			var ajax_default = {
				method: "GET",
				data: {},
				dataType: "JSON",
				async: true,
			};
			
			options.ajax = $.extend({}, ajax_default, options.ajax);

			$.loading.start();
			
			return $.ajax({
				url: options.ajax.url,
				type: options.ajax.method,
				async: options.ajax.async,
				dataType: options.ajax.dataType,
				data: options.ajax.data
			}).done(function(result) {
				if (result.code == 0) {
					options.content = result.data;
					if (layer) {
						var index = layer.open(options);
					}
				} else if (result.message) {
					$.msg(result.message, {
						time: 5000
					});
				}
			}).always(function () {
				$.loading.stop();
			});
		} else {
			if (layer) {
				return layer.open(options);
			}
		}
	}

	/**
	 * 信息提示
	 * 
	 * @param message
	 *            提示消息
	 * @param options
	 *            提示消息
	 * @param end
	 *            无论是确认还是取消，只要层被销毁了，end都会执行，不携带任何参数。
	 */
	$.msg = function(content, options, end) {
		if (layer) {
			
			if ($.isFunction(options)) {
				end = options;
				options = {};
			}
			
			options = $.extend({
				time: 2000
			}, options);
			
			// if (content == "") {
			// 	console.log("空的内容", window.location.href);
			// 	return;
			// }
			
			return layer.msg(content, options, function() {
				if ($.isFunction(end)) {
					end.call(layer);
				}
			});
			
		} else {
			alert("缺少组件：" + content);
		}
	};
	
	/**
	 * 信息提示
	 * 
	 * @param message
	 *            提示消息
	 * @param options
	 *            提示消息
	 * @param yes
	 *            点击确定按钮的回调函数
	 */
	$.alert = function(content, options, yes) {
		if (layer) {
			var type = $.isFunction(options);
			if (type) {
				yes = options;
			}
			
			if ($.isFunction(options)) {
				yes = options;
				options = {};
			}
			
			options = $.extend({
				// 隐藏滚动条
				scrollbar: true,
				// 隐藏关闭按钮
				closeBtn: 0
			}, options);
			
			return layer.alert(content, options, function(index) {
				if (yes == undefined || !$.isFunction(yes)) {
					layer.close(index);
				} else if ($.isFunction(yes) && yes.call(layer, index) != false) {
					layer.close(index);
				}
			});
		} else {
			alert("缺少组件：" + content);
		}
	}

	$.confirm = function(content, options, yes, cancel) {
		if (layer) {
			var type = $.isFunction(options);
			if (type) {
				cancel = yes;
				yes = options;
				options = {};
			}
			
			options = $.extend({
				// 隐藏滚动条
				scrollbar: true,
				// 隐藏关闭按钮
				closeBtn: 0
			}, options);
			
			return layer.confirm(content, options, function(index) {
				if ($.isFunction(yes) && yes.call(layer, index) != false) {
					layer.close(index);
				}
			}, function(index) {
				if ($.isFunction(cancel) && cancel.call(layer, index) != false) {
					layer.close(index);
				}
			});
			
		} else {
			return confirm("缺少组件：" + content);
		}
	}

	/**
	 * 提示
	 */
	$.tips = function(content, follow, options) {
		if (layer) {
			
			if (!options) {
				options = {};
			}
			
			if (options.tips) {
				if (!$.isArray(options.tips)) {
					options.tips = [options.tips, '#FF8800'];
				}
			} else {
				options.tips = [2, '#FF8800'];
			}
			return layer.tips(content, follow, options);
		} else {
			return alert("缺少组件");
		}
	};
	
	/**
	 * 改变标题
	 */
	$.title = function(title, index) {
		if (layer) {
			layer.title(title, index);
		}
	};
	
	function loopWindows(win, callback) {
		if (win) {
			if (callback(win) == true) {
				if (win.parent !== win) {
					return loopWindows(win.parent, callback);
				}
			}
		}
		return true;
	}
	
	/**
	 * 加载
	 */
	$.loading = {
		// 开始加载
		start: function() {
			// 获取网站图标
			var icon = $("link[rel='icon']").attr("href");
			// 缓载主题
			var loading_class = "layer-msg-loading SZY-LAYER-LOADING";
			// 缓载颜色
			var color = "#fff";
			
			// 读取Cookie
			var arr, reg = new RegExp("(^| )loading_style=([^;]*)(;|$)");
			if (icon != undefined) {
				if (arr = document.cookie.match(reg)) {
					if (unescape(arr[2]) == 1) {
						loading_class = "layer-msg-loading-simple SZY-LAYER-LOADING";
						// 读取Cookie
						var arr, reg = new RegExp("(^| )loading_color=([^;]*)(;|$)");
						if (arr = document.cookie.match(reg)) {
							color = unescape(arr[2]);
						}
					}
				}
			}
			
			var html = '<div class="loader-inner ball-clip-rotate"><div style="border-color:' + color + '; border-bottom-color: transparent; width: 30px; height: 30px; animation: rotate 0.45s 0s linear infinite; "></div>' + (icon != undefined ? '<img style="width: 16px; height: 16px;" src="' + icon + '" />' : '') + '</div>';
			
			var index = $.msg(html, {
				time: 0,
				skin: "layui-layer-hui " + loading_class,
				fixed: true,
				anim: -1,
				shade: [0.2, '#F3F3F3'],
				area: ["60px", "60px"],
				success: function(object, index) {
					$(object).removeClass("layui-layer-msg");
				}
			});
			$.loading.index = index;
		},
		// 停止加载
		stop: function() {
			$(".SZY-LAYER-LOADING").each(function() {
				var index = $(this).attr("times");
				layer.close(index);
			});
		}
	};
	
	$.prompt = function(options, yes) {
		if (layer) {
			
			if ($.isFunction(options)) {
				yes = options;
				options = {};
			}
			
			layer.ready(function() {
				layer.prompt(options, function(value, index, element) {
					if ($.isFunction(yes) && yes.call(layer, value, index, element)) {
						layer.close(index);
					}
				});
			});
		} else {
			return alert("缺少组件");
		}
	}

	$.tabDialog = function(options) {
		if (layer) {
			layer.ready(function() {
				layer.tab(options);
			});
		}
	}

	var lastUuid = 0;
	
	$.uuid = function() {
		return (new Date()).getTime() * 1000 + (lastUuid++) % 1000;
	}

	$.word_limit = function(words, length, suffix) {
		if (words) {
			if (words.length > length) {
				words = words.substring(0, length);
				
				if (suffix) {
					words = words + suffix;
				}
			}
		}
		return words;
	}

	String.prototype.startWith = function(str) {
		var reg = new RegExp("^" + str);
		return reg.test(this);
	}

	String.prototype.endWith = function(str) {
		var reg = new RegExp(str + "$");
		return reg.test(this);
	}

	$.fn.reverse = function() {
		return $($.makeArray(this).reverse());
	}

	// 合并赋值
	$.mergeSetValue = function(object, name, value, merge) {
		// 相同的name不进行替换，而是进行合并，合并成为一个数组
		if (merge == false) {
			object[name] = value;
		} else {
			// 相同的name不进行替换，而是进行合并，合并成为一个数组
			if (object[name]) {
				if ($.isArray(object[name])) {
					object[name].push(value);
				} else {
					object[name] = [object[name], value];
				}
			} else {
				object[name] = value;
			}
		}
	}

	// 解析变量
	$.resolveVarName = function(object, name, value, merge) {
		// 识别是否符合格式：A[A][]、A[A]、A[A][A]、A[]
		// 不符合则当成字符串，符合则解析成对象
		if (new RegExp("^[a-zA-Z_][a-zA-Z0-9_]+(\\[\\])?((\\[[a-zA-Z0-9_]+\\]))*(\\[\\])?$").test(name)) {
			// 识别出[A]部分
			var subNames = name.match(new RegExp("\\[[a-zA-Z0-9_]+\\]", "g"));
			
			// 如果不包含“[”则直接赋值返回
			if (name.indexOf("[") < 0) {
				// 相同的name不进行替换，而是进行合并，合并成为一个数组
				$.mergeSetValue(object, name, value, merge);
				return object;
			}
			
			// 识别出变量名
			var var_name = name.substring(0, name.indexOf("["));
			
			if (object[var_name] == undefined) {
				object[var_name] = {};
			}
			
			// 设置临时变量
			var temp = object[var_name];
			
			for (i in subNames) {
				
				// 非数字跳过，否则IE8下会有错误
				if (isNaN(i)) {
					continue;
				}
				
				var subName = subNames[i];
				
				subName = subName.substring(1, subName.length - 1);
				
				if (i == subNames.length - 1) {
					// 如果是以[]结尾则代表为数组
					if (new RegExp("\\[\\]$").test(name)) {
						if ($.isArray(temp[subName]) == false) {
							temp[subName] = [];
						}
						temp[subName].push(value);
					} else {
						if (temp[subName] == undefined) {
							temp[subName] = {};
						}
						// 相同的name不进行替换，而是进行合并，合并成为一个数组
						$.mergeSetValue(temp, subName, value, merge);
					}
					
				} else {
					if (temp[subName] == undefined) {
						temp[subName] = {};
					}
				}
				temp = temp[subName];
			}
			
			if (subNames == null || subNames.length == 0) {
				// 如果是以[]结尾则代表为数组
				if (new RegExp("\\[\\]$").test(name)) {
					if ($.isArray(object[var_name]) == false) {
						object[var_name] = [];
					}
					object[var_name].push(value);
				} else {
					if (object[var_name] == undefined) {
						object[var_name] = {};
					}
					// 相同的name不进行替换，而是进行合并，合并成为一个数组
					$.mergeSetValue(object, var_name, value, merge);
				}
			}
			
			return object;
		} else {
			// 相同的name不进行替换，而是进行合并，合并成为一个数组
			$.mergeSetValue(object, name, value, merge);
			return object;
		}
	}

	/**
	 * 将表单序列号为JSON对象
	 * 
	 * @param merge
	 *            相同name的元素是否进行合并，默认不进行合并，true-进行合并 false-不进行合并
	 */
	$.fn.serializeJson = function(merge) {
		
		if (merge == undefined || merge == null) {
			merge = false;
		}
		
		var serializeObj = {};
		var array = [];
		
		// 判断当前元素是否为input元素
		if ($(this).is(":input")) {
			array = $(this).serializeArray();
		} else {
			array = $(this).find(":input").serializeArray();
		}
		
		$(array).each(function() {
			$.resolveVarName(serializeObj, this.name, this.value, merge);
		});
		return serializeObj;
	};
	
	// ---------------------------------------------------------------------------------------------------
	
	/**
	 * @return string|undefined the CSRF parameter name. Undefined is returned
	 *         if CSRF validation is not enabled.
	 */
	$.getCsrfParam = function() {
		return $('meta[name=csrf-param]').attr('content');
	}

	/**
	 * @return string|undefined the CSRF token. Undefined is returned if CSRF
	 *         validation is not enabled.
	 */
	$.getCsrfToken = function() {
		return $('meta[name=csrf-token]').attr('content');
	}

	// 判断是否为微信
	$.isWeiXin = function() {
		var ua = window.navigator.userAgent.toLowerCase();
		if (ua.match(/MicroMessenger/i) == 'micromessenger') {
			return true;
		}
		return false;
	}

	// 将JSON转换为CSV文件并下载，必须引入文件 json2csv.js
	$.toCSV = function (csv_data) {
		// 字符型关键词
		var textKeys = ['sn', 'barcode', 'code', 'mobile', 'tel'];

		if($.isArray(csv_data.textKeys)) {
			textKeys = csv_data.textKeys;
		}

		// 导出
		JSonToCSV.setDataConver({
			data: csv_data.list,
			fileName: csv_data.filename,
			columns: {
				title: csv_data.titles,
				key: csv_data.keys,
				formatter: function(n, v) {
					return v;
				},
				append: function (row, k, v) {
					var showText = false;

					if(typeof v === 'string') {
						for(var i = 0; i < textKeys.length; i++) {
							if(k.indexOf(textKeys[i]) !== -1) {
								showText = true;
								break;
							}
						}
					}

					if(showText) {
						row += '="' + v + '",';
					}else{
						row += '"' + v + '",';
					}

					return row;
				}
			}
		});
	}

	/**
	 * 重写post提交，自动补充csrf参数
	 */
	var _post = $.post;
	$.post = function(url, data, callback, type) {
		// 绑定csrf参数
		if (data && data[$.getCsrfParam()] == undefined) {
			data[$.getCsrfParam()] = $.getCsrfToken();
		}
		
		if (type == undefined) {
			type = "string";
		}
		
		return _post(url, data, callback, type);
	};
	
	// 备份jquery的ajax方法
	var _ajax = $.ajax;
	
	// 重写jquery的ajax方法
	$.ajax = function(opt) {
		// 备份opt中error和success方法
		var fn = {
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				if (XMLHttpRequest.status != 0) {
					try {
						var result = $.parseJSON($.trim(XMLHttpRequest.responseText));
						if (result && result.message) {
							$.msg(result.message);
						}
					} catch (e) {
						console.error("-------------------------------")
						console.error("Ajax访问发生错误：" + XMLHttpRequest.status);
						console.error(opt);
						console.error(result);
						console.error(e);
						console.error("-------------------------------")
					}
				}
			},
			success: function(data, textStatus) {
			}
		}
		if (opt.error) {
			fn.error = opt.error;
		}
		if (opt.success) {
			fn.success = opt.success;
		}
		if (szy_tag && opt.url && opt.url.indexOf("/") == 0 && opt.url.indexOf("/" + szy_tag) == -1) {
			opt.url = "/" + szy_tag + opt.url;
		}
		// 扩展增强处理
		var _opt = $.extend(opt, {
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				// 错误方法增强处理
				fn.error(XMLHttpRequest, textStatus, errorThrown);
			},
			success: function(data, textStatus) {
				if (data && data.code == 99 && $.login && $.isFunction($.login.show)) {
					// 打开登录窗口
					$.login.show(function() {
						$.ajax(opt);
					});
				} else {
					// 成功回调方法增强处理
					fn.success(data, textStatus);
				}
			}
		});
		
		if (opt.data == undefined) {
			opt.data = {};
		}
		
		if (opt.type == undefined) {
			opt.type = "GET";
		}
		
		var type = opt.type.toLowerCase();
		
		// 绑定csrf参数
		if (type == 'post' && opt.data[$.getCsrfParam()] == undefined) {
			opt.data[$.getCsrfParam()] = $.getCsrfToken();
		}
		
		if (type == undefined) {
			type = "string";
		}
		
		return _ajax(_opt).always(function() {
			$.initTag();
			$.loading.stop();
		});
	};
	
	/**
	 * Sets the CSRF token in the meta elements. This method is provided so that
	 * you can update the CSRF token with the latest one you obtain from the
	 * server.
	 * 
	 * @param name
	 *            the CSRF token name
	 * @param value
	 *            the CSRF token value
	 */
	$.setCsrfToken = function(name, value) {
		$('meta[name=csrf-param]').attr('content', name);
		$('meta[name=csrf-token]').attr('content', value)
	}

	/**
	 * Updates all form CSRF input fields with the latest CSRF token. This
	 * method is provided to avoid cached forms containing outdated CSRF tokens.
	 */
	$.refreshCsrfToken = function() {
		var token = $.getCsrfToken();
		if (token) {
			$('form input[name="' + $.getCsrfParam() + '"]').val(token);
		}
	}

	var clickableSelector = 'a, button, input[type="submit"], input[type="button"], input[type="reset"], input[type="image"]';
	var changeableSelector = 'select, input, textarea';
	
	function initDataMethods() {
		var handler = function(event) {
			var $this = $(this), method = $this.data('method'), message = $this.data('confirm');
			
			if (method === undefined && message === undefined) {
				return true;
			}
			
			if (message !== undefined) {
				$.confirm(message, {}, function() {
					handleAction($this);
				});
			} else {
				handleAction($this);
			}
			event.stopImmediatePropagation();
			return false;
		};
		// handle data-confirm and data-method for clickable and changeable
		// elements
		$(document).on('click', clickableSelector, handler).on('change', changeableSelector, handler);
	}
	
	function handleAction(obj) {
		var method = $(obj).data('method'), $form = $(obj).closest('form'), action = obj.attr('href'), params = obj.data('params');
		
		if (method === undefined) {
			if (action && action != '#') {
				window.location = action;
			} else if ($(obj).is(':submit') && $form.length) {
				$form.trigger('submit');
			}
			return;
		}else if(action && $(obj).data("ajax")) {
			$.loading.start();
			$.ajax({
				url: action,
				type: method,
				data: params,
				dataType: "JSON",
				success: function(result) {
					if(result.code == 0) {
						$.msg(result.message, function() {
							if(typeof tablelist != "undefined") {
								tablelist.load();
							}
						});
					}else if(result.message){
						$.msg(result.message);
					}
				}
			}).always(function () {
				$.loading.stop();
			});
			return;
		}
		
		var newForm = !$form.length;
		if (newForm) {
			if (!action) {
				action = window.location.href;
			}
			$form = $('<form method="' + method + '"></form>');
			$form.attr('action', action);
			var target = $(obj).attr('target');
			if (target) {
				$form.attr('target', target);
			}
			if (!method.match(/(get|post)/i)) {
				$form.append('<input name="_method" value="' + method + '" type="hidden">');
				method = 'POST';
			}
			if (!method.match(/(get|head|options)/i)) {
				var csrfParam = $.getCsrfParam();
				if (csrfParam) {
					$form.append('<input name="' + csrfParam + '" value="' + $.getCsrfToken() + '" type="hidden">');
				}
			}
			$form.hide().appendTo('body');
		}
		
		var activeFormData = $form.data('yiiActiveForm');
		if (activeFormData) {
			// remember who triggers the form submission. This is used by
			// yii.activeForm.js
			activeFormData.submitObject = $(obj);
		}
		
		// temporarily add hidden inputs according to data-params
		if (params && $.isPlainObject(params)) {
			$.each(params, function(idx, obj) {
				$form.append('<input name="' + idx + '" value="' + $(obj) + '" type="hidden">');
			});
		}
		
		var oldMethod = $form.attr('method');
		$form.attr('method', method);
		var oldAction = null;
		if (action && action != '#') {
			oldAction = $form.attr('action');
			$form.attr('action', action);
		}
		
		$form.trigger('submit');
		
		if (oldAction != null) {
			$form.attr('action', oldAction);
		}
		$form.attr('method', oldMethod);
		
		// remove the temporarily added hidden inputs
		if (params && $.isPlainObject(params)) {
			$.each(params, function(idx, obj) {
				$('input[name="' + idx + '"]', $form).remove();
			});
		}
		
		if (newForm) {
			$form.remove();
		}
	}
	
	$().ready(function() {
		initDataMethods();
	});
	
	// 记录当前滚动条位置
	$.fixedScorll = {
		write: function(key, element) {
			
			if (!key) {
				alert("固定滚动条必须输入一个COOKIE名称");
				return;
			}
			
			var scrollPos;
			if (typeof window.pageYOffset != 'undefined') {
				scrollPos = window.pageYOffset;
			} else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
				scrollPos = document.documentElement.scrollTop;
			} else if (typeof document.body != 'undefined') {
				scrollPos = document.body.scrollTop;
			}
			// 存储滚动条位置到cookies中
			document.cookie = "SZY_GOODS_SCROLLTOP=" + scrollPos;
		},
		read: function(key, clear) {
			if (!key) {
				alert("固定滚动条必须输入一个COOKIE名称");
				return;
			}
			// cookies中不为空，则读取滚动条位置
			var arr = document.cookie.match(/SZY_GOODS_SCROLLTOP=([^;]+)(;|$)/);
			if (arr) {
				document.documentElement.scrollTop = parseInt(arr[1]);
				document.body.scrollTop = parseInt(arr[1]);
			}
			if (clear != false) {
				// 读完Cookie就立即删除掉
				document.cookie = "SZY_GOODS_SCROLLTOP=0";
			}
			
		}
	};
	
	// 如果登录模块已存在则不覆盖
	if ($.login == undefined) {
		// 登录模块
		$.login = {
			// 打开登录对话框
			show: function(params, callback) {
				
				$.loading.start();
				
				var data = {};
				
				if ($.isFunction(params)) {
					callback = params;
					params = {};
				}
				
				if (params) {
					data = $.extend(true, data, params);
				}
				
				if ($.isFunction(callback)) {
					$.login.success = callback;
				}
				
				$.open({
					id: "SZY_LOGIN_LAYER_DIALOG",
					type: 1,
					title: '您尚未登录',
					ajax: {
						url: '/login.html',
						data: data,
						success: function(result) {
							$("body").append(result.data);
						}
					}
				}).done(function() {
					$.loading.stop();
				});
			},
			// 关闭登录对话框
			// @param boolean destroy 是否销毁登录窗口
			close: function(destroy) {
				var index = $("#SZY_LOGIN_LAYER_DIALOG").parents(".layui-layer").attr("times");
				$.closeDialog(index);
			},
			// 登录成功处理函数
			success: function(back_url) {
				if (back_url && typeof (back_url) == 'string') {
					$.go(back_url);
				} else {
					$.go(window.location.href);
				}
			}
		};
	}
	
	/**
	 * 跳转页面
	 * 
	 * @param url
	 *            跳转的链接，为空则刷新当前页面
	 */
	$.go = function(url, target, show_loading) {
		
		if (url == undefined) {
			url = window.location.href;
		}
		
		szy_tag_temp = $("meta[name='szy_tag']").attr("content");
		
		if (szy_tag_temp && url && url.indexOf("/" + szy_tag_temp) == -1 && url.indexOf("/") == 0) {
			url = "/" + szy_tag_temp + url;
		}
		
		if (show_loading !== false) {
			// 开启缓载效果
			$.loading.start();
		}
		
		var id = $.uuid();
		var element = $("<a id='" + id + "' style='display: none;'></a>");
		$(element).attr("href", url);
		if (target) {
			$(element).attr("target", target);
			// 停止缓载效果
			$.loading.stop();
		}
		$("body").append(element);
		if (document.getElementById(id)) {
			document.getElementById(id).click();
		}
	};
	
	/**
	 * 导出 canvas 为 PNG 图片并下载
	 * 
	 * @param dom
	 *            canvasDom canvas 的 dom 对象
	 * @param string
	 *            filename 下载后的文件名
	 */
	$.exportCanvasAsPNG = function(canvasDom, filename) {
		var canvasElement = canvasDom;
		
		var MIME_TYPE = "image/png";
		
		var imgURL = canvasElement.toDataURL(MIME_TYPE);
		
		var dlLink = document.createElement('a');
		dlLink.download = filename;
		dlLink.href = imgURL;
		dlLink.dataset.downloadurl = [MIME_TYPE, dlLink.download, dlLink.href].join(':');
		
		document.body.appendChild(dlLink);
		dlLink.click();
		document.body.removeChild(dlLink);
	}

	/**
	 * 下载指定的字符串内容
	 * 
	 * @param string
	 *            filename 下载后的文件名
	 * @param string
	 *            content 下载内容
	 * @param stringToArrayBuffer
	 *            是否将字符串转字符流，默认为false
	 * @param contentToBlob
	 *            是否将下载内容转换为Blob对象处理，默认为true
	 * @return boolean
	 */
	$.download = function(filename, content, stringToArrayBuffer, contentToBlob) {
		
		var eleLink = document.createElement('a');
		eleLink.download = filename;
		eleLink.style.display = 'none';
		
		if (contentToBlob === false) {
			eleLink.href = content;
		} else {
			
			if (stringToArrayBuffer == true) {
				content = $.stringToArrayBuffer(content);
			}
			
			// 字符内容转变成blob地址
			var blob = new Blob([content]);
			eleLink.href = URL.createObjectURL(blob);
		}
		
		// 触发点击
		document.body.appendChild(eleLink);
		eleLink.click();
		// 然后移除
		document.body.removeChild(eleLink);
		return true;
	};
	
	/**
	 * 字符串转字符流
	 * 
	 * @param string
	 *            s 字符串
	 * @return 字符流
	 */
	$.stringToArrayBuffer = function(s) {
		var buf = new ArrayBuffer(s.length);
		var view = new Uint8Array(buf);
		for (var i = 0; i != s.length; ++i) {
			view[i] = s.charCodeAt(i) & 0xFF;
		}
		return buf;
	};
	
	/**
	 * 将网址加入收藏
	 */
	$.addFavorite = function(url, title) {
		if ($.browser.msie) {
			try {
				window.external.addFavorite(url, title);
				return true;
			} catch (a) {
				
			}
		} else {
			if ($.browser.mozilla) {
				try {
					window.sidebar.addPanel(title, url, "");
					return true;
				} catch (a) {
				}
			}
		}
		
		$.alert("请按键盘 <b>CTRL</b>键 + <b>D</b> 把『" + title + "』放入收藏夹！");
		
		return false
	};
	
})(jQuery);

(function($) {
	/**
	 * 求集合的笛卡尔之积
	 * 
	 * @param list
	 *            必须为数组，否则返回空数组
	 * @return 结果集
	 */
	$.toDkezj = function(list) {
		
		if ($.isArray(list) == false || list.length == 0) {
			return [];
		}
		
		if (list.length == 1) {
			
			var temp_list = [];
			
			for (var i = 0; i < list[0].length; i++) {
				temp_list.push([list[0][i]]);
			}
			
			return temp_list;
		}
		
		var result = new Array();// 结果保存到这个数组
		function dkezj(index, temp_result) {
			if (index >= list.length) {
				result.push(temp_result);
				return;
			}
			var temp_array = list[index];
			if (!temp_result) {
				temp_result = new Array();
			}
			for (var i = 0; i < temp_array.length; i++) {
				var cur_result = temp_result.slice(0, temp_result.length);
				cur_result.push(temp_array[i]);
				dkezj(index + 1, cur_result);
			}
		}
		
		dkezj(0);
		
		return result;
	};
	
	/**
	 * 求数组内的全排序
	 */
	$.toPermute = function(input) {
		var permArr = [], usedChars = [];
		function main(input) {
			var i, ch;
			for (i = 0; i < input.length; i++) {
				ch = input.splice(i, 1)[0];
				usedChars.push(ch);
				if (input.length == 0) {
					permArr.push(usedChars.slice());
				}
				main(input);
				input.splice(i, 0, ch);
				usedChars.pop();
			}
			return permArr
		}
		return main(input);
	};
})(jQuery);

(function($) {
	/**
	 * jQuery.toJSON Converts the given argument into a JSON representation.
	 * 
	 * @param o
	 *            {Mixed} The json-serializable *thing* to be converted
	 * 
	 * If an object has a toJSON prototype, that will be used to get the
	 * representation. Non-integer/string keys are skipped in the object, as are
	 * keys that point to a function.
	 * 
	 */
	$.toJSON = typeof JSON === 'object' && JSON.stringify ? JSON.stringify : function(o) {
		if (o === null) {
			return 'null';
		}
		
		var pairs, k, name, val, type = $.type(o);
		
		if (type === 'undefined') {
			return undefined;
		}
		
		// Also covers instantiated Number and Boolean objects,
		// which are typeof 'object' but thanks to $.type, we
		// catch them here. I don't know whether it is right
		// or wrong that instantiated primitives are not
		// exported to JSON as an {"object":..}.
		// We choose this path because that's what the browsers did.
		if (type === 'number' || type === 'boolean') {
			return String(o);
		}
		if (type === 'string') {
			return $.quoteString(o);
		}
		if (typeof o.toJSON === 'function') {
			return $.toJSON(o.toJSON());
		}
		if (type === 'date') {
			var month = o.getUTCMonth() + 1, day = o.getUTCDate(), year = o.getUTCFullYear(), hours = o.getUTCHours(), minutes = o.getUTCMinutes(), seconds = o.getUTCSeconds(), milli = o.getUTCMilliseconds();
			
			if (month < 10) {
				month = '0' + month;
			}
			if (day < 10) {
				day = '0' + day;
			}
			if (hours < 10) {
				hours = '0' + hours;
			}
			if (minutes < 10) {
				minutes = '0' + minutes;
			}
			if (seconds < 10) {
				seconds = '0' + seconds;
			}
			if (milli < 100) {
				milli = '0' + milli;
			}
			if (milli < 10) {
				milli = '0' + milli;
			}
			return '"' + year + '-' + month + '-' + day + 'T' + hours + ':' + minutes + ':' + seconds + '.' + milli + 'Z"';
		}
		
		pairs = [];
		
		if ($.isArray(o)) {
			for (k = 0; k < o.length; k++) {
				pairs.push($.toJSON(o[k]) || 'null');
			}
			return '[' + pairs.join(',') + ']';
		}
		
		// Any other object (plain object, RegExp, ..)
		// Need to do typeof instead of $.type, because we also
		// want to catch non-plain objects.
		if (typeof o === 'object') {
			for (k in o) {
				// Only include own properties,
				// Filter out inherited prototypes
				if (hasOwn.call(o, k)) {
					// Keys must be numerical or string. Skip others
					type = typeof k;
					if (type === 'number') {
						name = '"' + k + '"';
					} else if (type === 'string') {
						name = $.quoteString(k);
					} else {
						continue;
					}
					type = typeof o[k];
					
					// Invalid values like these return undefined
					// from toJSON, however those object members
					// shouldn't be included in the JSON string at all.
					if (type !== 'function' && type !== 'undefined') {
						val = $.toJSON(o[k]);
						pairs.push(name + ':' + val);
					}
				}
			}
			return '{' + pairs.join(',') + '}';
		}
	};
})(jQuery);

(function($) {
	// 倒计时
	$.fn.countdown = function(options) {
		
		var defaults = {
			// 间隔时间，单位：毫秒
			time: 0,
			// 更新时间，默认为1000毫秒
			updateTime: 1000,
			// 显示模板
			htmlTemplate: "%{d} 天 %{h} 小时 %{m} 分 %{s} 秒",
			minus: false,
			onChange: null,
			onComplete: null,
			leadingZero: false
		};
		var opts = {};
		var rDate = /(%\{d\}|%\{h\}|%\{m\}|%\{s\})/g;
		var rDays = /%\{d\}/;
		var rHours = /%\{h\}/;
		var rMins = /%\{m\}/;
		var rSecs = /%\{s\}/;
		// 最大时间单位：day、hour
		var maxUnit = "day";
		var day2H = false;
		var complete = false;
		var template;
		var floor = Math.floor;
		var onChange = null;
		var onComplete = null;
		
		var now = new Date();
		
		$.extend(opts, defaults, options);
		
		if (opts.maxUnit == "hour" && opts.htmlTemplate == defaults.htmlTemplate) {
			opts.htmlTemplate = " %{h} 小时 %{m} 分 %{s} 秒";
		}
		
		template = opts.htmlTemplate;
		return this.each(function() {
			
			var interval = opts.time - (new Date().getTime() - now.getTime());
			
			var $this = $(this);
			var timer;
			var msPerDay = 864E5; // 24 * 60 * 60 * 1000
			var timeLeft = interval;
			var e_daysLeft = timeLeft / msPerDay;
			var daysLeft = floor(e_daysLeft);
			var e_hrsLeft = (e_daysLeft - daysLeft) * 24; // Gets remainder
			// and * 24
			var hrsLeft = floor(e_hrsLeft);
			var minsLeft = floor((e_hrsLeft - hrsLeft) * 60);
			var e_minsleft = (e_hrsLeft - hrsLeft) * 60; // Gets remainder
			// and * 60
			var secLeft = floor((e_minsleft - minsLeft) * 60);
			var time = "";
			
			if (opts.onChange) {
				$this.bind("change", opts.onChange);
			}
			
			if (opts.onComplete) {
				$this.bind("complete", opts.onComplete);
			}
			
			if (opts.leadingZero) {
				
				if (daysLeft < 10) {
					daysLeft = "0" + daysLeft;
				}
				
				if (hrsLeft < 10) {
					hrsLeft = "0" + hrsLeft;
				}
				
				if (minsLeft < 10) {
					minsLeft = "0" + minsLeft;
				}
				
				if (secLeft < 10) {
					secLeft = "0" + secLeft;
				}
			}
			
			// Set initial time
			if (interval >= 0 || opts.minus) {
				
				if (opts.maxUnit == 'hour') {
					time = template.replace(rHours, daysLeft * 24 + hrsLeft).replace(rMins, minsLeft).replace(rSecs, secLeft);
				} else {
					time = template.replace(rDays, daysLeft).replace(rHours, hrsLeft).replace(rMins, minsLeft).replace(rSecs, secLeft);
				}
			} else {
				time = template.replace(rDate, "00");
				complete = true;
			}
			
			timer = window.setInterval(function() {
				
				var interval = opts.time - (new Date().getTime() - now.getTime());
				
				var TodaysDate = new Date();
				var CountdownDate = new Date(opts.date);
				var msPerDay = 864E5; // 24 * 60 * 60 * 1000
				var timeLeft = interval;
				var e_daysLeft = timeLeft / msPerDay;
				var daysLeft = floor(e_daysLeft);
				var e_hrsLeft = (e_daysLeft - daysLeft) * 24; // Gets
				// remainder and
				// * 24
				var hrsLeft = floor(e_hrsLeft);
				var minsLeft = floor((e_hrsLeft - hrsLeft) * 60);
				var e_minsleft = (e_hrsLeft - hrsLeft) * 60; // Gets
				// remainder and
				// * 60
				var secLeft = floor((e_minsleft - minsLeft) * 60);
				var time = "";
				
				if (opts.leadingZero) {
					
					if (daysLeft < 10) {
						daysLeft = "0" + daysLeft;
					}
					
					if (hrsLeft < 10) {
						hrsLeft = "0" + hrsLeft;
					}
					
					if (minsLeft < 10) {
						minsLeft = "0" + minsLeft;
					}
					
					if (secLeft < 10) {
						secLeft = "0" + secLeft;
					}
				}
				
				if (interval >= 0 || opts.minus) {
					if (opts.maxUnit == 'hour') {
						time = template.replace(rHours, daysLeft * 24 + hrsLeft).replace(rMins, minsLeft).replace(rSecs, secLeft);
					} else {
						time = template.replace(rDays, daysLeft).replace(rHours, hrsLeft).replace(rMins, minsLeft).replace(rSecs, secLeft);
					}
					
				} else {
					time = template.replace(rDate, "00");
					complete = true;
				}
				
				$this.html(time);
				
				$this.trigger('change', [timer]);
				
				if (complete) {
					
					$this.trigger('complete');
					clearInterval(timer);
				}
				
			}, opts.updateTime);
			
			$this.html(time);
			
			if (complete) {
				$this.trigger('complete');
				clearInterval(timer);
			}
		});
	};
})(jQuery);

(function($) {
	/**
	 * 当表单元素仅存在一个输入框的时候回车会触发表单的提交事件, 禁止此事件
	 */
	$.stopEnterEvent = function(target) {
		$(target).keydown(function(event) {
			if (event.keyCode == 13) {
				return false;
			}
		})
	}

	/**
	 * 进度监控接口
	 */
	$.progress = function(options) {
		var defaults = {
			// 监听的URL
			url: null,
			// AJAX类型，默认为Get提交
			type: "GET",
			// Key
			key: null,
			// Get提交的数据
			data: null,
			// 索引
			index: false,
			// 是否开启自动请求进度功能
			progress: true,
			// 默认提醒接受到的消息
			defaultMsg: true,
			// 结束后是否自动关闭进度窗口
			endClose: true,
			// 开始的回调函数
			start: null,
			// 变化的回调函数
			change: null,
			// 结束的回调函数
			end: null,
			//数据类型
			ajaxContentType:"application/x-www-form-urlencoded"
		};
		
		options = $.extend(defaults, options);
		
		var data = $.extend({
			key: options.key
		}, options.data);
		
		var index = options.index;
		
		if (!index) {
			index = $.open({
				title: '正在发起请求...',
				btn: [],
				closeBtn: 0,
				content: '<div class="progress progress-striped active upload"><div class="progress-bar progress-bar-success" style="width: 0%;">0%</div></div>'
			});
			
			options.index = index;
		}
		
		// 是否已经结束
		var is_over = false;
		// 响应结果
		var response_result = null;
		// 同步请求是否已结束
		var sync_request_over = false;
		// 结束回调是否已经执行过
		var end_callback_executed = false;
		// 当前状态：0-未接收到数据 1-接收到数据
		var receive_status = 0;

		// url为空则直接返回index
		if (options.url != null) {
			var success = function (result) {
				if (result.code == 0) {

					// 结束
					is_over = true;

					// 提醒消息
					if (options.defaultMsg) {
						$.msg(result.message, {
							time: 3000
						});
					}

					// 回调函数
					if (end_callback_executed == false && $.isFunction(options.end)) {
						end_callback_executed = true;
						options.end.call(options, result);
					}
				} else if (result.code == 1) {
					// 正在上传中
					$.title(result.message, index);
				} else {
					// 出错
					// 回调函数
					if (end_callback_executed == false) {
						end_callback_executed = true;
						if ($.isFunction(options.end)) {
							options.end.call(options, result);
						} else {
							$.alert(result.message, function () {
								$.closeDialog(index);
							});
						}
					}

					// 结束
					is_over = true;
				}

				if (end_callback_executed == false && $.isFunction(options.start)) {
					options.start.call(options, result);
					// 关闭窗口
					$.closeDialog(index);
				}

				// 同步请求已结束
				sync_request_over = true;
				response_result = result;
			};

			var datas = data;
			//如果为json格式转换下
			if (options.ajaxContentType == 'application/json') {
				datas = JSON.stringify(datas)
			}
			$.ajax({
				url: options.url,
				data: datas,
				type: options.type.toUpperCase(),
				contentType: options.ajaxContentType,
				dataType: "JSON",
				success: success,
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// 同步请求已结束
					sync_request_over = true;
					// 记录日志
					console.log("AJAX请求发生错误：", {
						textStatus: textStatus,
						errorThrown: errorThrown
					});
				}
			});
		}

		// 定时请求进度
		if (options.progress) {
			
			var functionName = "funcion_" + $.uuid();
			
			window[functionName] = function(index) {
				if (is_over == true) {

					var end_callback = function () {
						// 关闭窗口
						$.closeDialog(index);
						// 结束回调
						if (end_callback_executed == false) {
							end_callback_executed = true;
							if($.isFunction(options.end)) {
								options.end.call(options, response_result ? response_result : {
									code: 0,
									message: '操作完成~~'
								});
							}
						}
					}

					if(sync_request_over) { // 同步请求如果已结束直接进行判断
						end_callback()
					}else{
						// 回调函数
						// 延迟 3s，尽量等待同步请求结束
						setTimeout(function() {
							end_callback()
						}, 3000);
					}
					return;
				}
				
				$.get('/site/progress.html', {
					key: options.key
				}, function(result) {
					if (result.code == 0) {
						if (result.data != undefined && result.data != null) {
							
							receive_status = 1;
							
							if (result.data.message) {
								$.title(result.data.message, index);
							}
							
							if (result.data.index && result.data.count && result.data.progress) {
								
								if (!result.data.message) {
									if (isNaN(result.data.total) == false && result.data.total > 0) {
										$.title('当前进度[' + result.data.total + ']-[' + result.data.index + '/' + result.data.count + ']', index);
									} else {
										$.title('当前进度[' + result.data.index + '/' + result.data.count + ']', index);
									}
								}
								
								$(".upload").find(".progress-bar").css("width", result.data.progress);
								$(".upload").find(".progress-bar").html(result.data.progress);
							}
							
							if (result.data.index != undefined && result.data.index == result.data.count) {
								
								if (result.data.total == undefined || result.data.total == null) {
									result.data.total = 0;
								}
								
								// 总进度条的数量
								if (result.data.total == 0) {
									// 结束
									is_over = true;
								}
							}
						} else if (receive_status == 1) {
							// 结束
							is_over = true;
						}
						
						if(is_over) {
							if (options.endClose) {
								// 关闭窗口
								$.closeDialog(index);
							}
						}else{
							// 回调函数
							if ($.isFunction(options.change)) {

								if (result.data == undefined || result.data == null) {
									result.data = {};
								}

								options.change.call(options, result);
							}
							// 继续回调
							setTimeout("window." + functionName + "(" + index + ")", 1000);
						}
					} else {
						// 结束
						is_over = true;
					}

					if(is_over) {
						response_result = result;
						var end_callback = function () {
							if (end_callback_executed == false) {
								end_callback_executed = true;
								if($.isFunction(options.end)) {
									options.end.call(options, result);
								}else{
									// 提醒消息
									if (options.defaultMsg) {
										if(result.message) {
											$.alert(result.message);
										}else if(result.code == 0) {
											$.alert('操作完成');
										}
									}
								}
							}
						}

						if(sync_request_over) { // 同步请求如果已结束直接进行判断
							end_callback()
						}else{
							// 回调函数
							// 延迟 3s，尽量等待同步请求结束
							setTimeout(function() {
								end_callback()
							}, 3000);
						}
					}
				}, "JSON");
			}

			// 发起请求
			setTimeout("window." + functionName + "(" + index + ")", 1000);
		}
		

		return index;
	}
})(jQuery);

/**
 * 打印
 */
(function($) {
	var opt;
	
	$.browser = {};
	$.browser.mozilla = /firefox/.test(navigator.userAgent.toLowerCase());
	$.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
	$.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
	$.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
	
	$.fn.jqprint = function(options) {
		opt = $.extend({}, $.fn.jqprint.defaults, options);
		
		var $element = (this instanceof jQuery) ? this : $(this);
		
		if (opt.operaSupport && $.browser.opera) {
			var tab = window.open("", "jqPrint-preview");
			tab.document.open();
			
			var doc = tab.document;
		} else {
			var $iframe = $("<iframe  />");
			
			if (!opt.debug) {
				$iframe.css({
					position: "absolute",
					width: "0px",
					height: "0px",
					left: "-600px",
					top: "-600px"
				});
			}
			
			$iframe.appendTo("body");
			var doc = $iframe[0].contentWindow.document;
		}
		
		if (opt.importCSS) {
			if ($("link[media=print]").length > 0) {
				$("link[media=print]").each(function() {
					doc.write("<link type='text/css' rel='stylesheet' href='" + $(this).attr("href") + "' media='print' />");
				});
			} else {
				$("link").each(function() {
					doc.write("<link type='text/css' rel='stylesheet' href='" + $(this).attr("href") + "' />");
				});
			}
		}
		
		if (opt.printContainer) {
			doc.write($element.outer());
		} else {
			$element.each(function() {
				doc.write($(this).html());
			});
		}
		
		doc.close();
		
		(opt.operaSupport && $.browser.opera ? tab : $iframe[0].contentWindow).focus();
		setTimeout(function() {
			(opt.operaSupport && $.browser.opera ? tab : $iframe[0].contentWindow).print();
			if (tab) {
				tab.close();
			}
		}, 1000);
	}

	$.fn.jqprint.defaults = {
		debug: false,
		importCSS: true,
		printContainer: true,
		operaSupport: true
	};
	
	// Thanks to 9__, found at http://users.livejournal.com/9__/380664.html
	jQuery.fn.outer = function() {
		return $($('<div></div>').html(this.clone())).html();
	}

	$(function() {
		if ($.base64) {
			$.base64.utf8encode = true;
		}
	});
})(jQuery);

/**
 * 初始化表格复选框全选的功能
 */
(function($) {
	$.fn.tableCheckbox = function(options) {
		
		var defaults = {
			checkboxAllClass: "checkbox-all",
			checkboxItemClass: "checkbox-item",
		}

		var target = this;
		
		var settings = {
			values: function() {
				var values = [];
				$(target).each(function() {
					var options = $(this).data("tableCheckbox");
					
					if (options) {
						var checkboxEls = $(this).find(":checkbox").filter("." + options.checkboxItemClass);
						
						$(checkboxEls).filter(":checked").each(function() {
							values.push($(this).val());
						});
					}
				});
				return values;
			},
			// 值发生改变的事件
			onChange: null
		}

		if (options == "values") {
			return settings.values();
		} else if (options == "destory") {
			$(target).each(function() {
				$(this).data("tableCheckbox", undefined);
			});
			return true;
		}
		
		if (options == undefined) {
			options = {};
		}
		
		if ($.isPlainObject(options)) {
			
			options = $.extend({}, defaults, settings, options);
			
			$(target).each(function() {
				
				if ($(this).data("tableCheckbox")) {
					return;
				}
				
				var checkboxEls = $(this).find(":checkbox").filter("." + options.checkboxItemClass);
				var checkboxAllEls = $(this).find(":checkbox").filter("." + options.checkboxAllClass);
				
				$(checkboxEls).click(function(e) {
					if ($(this).prop("checked")) {
						if ($(checkboxEls).filter(":checked").size() == $(checkboxEls).size()) {
							$(checkboxAllEls).prop("checked", true);
						}
					} else {
						$(checkboxAllEls).prop("checked", false);
					}
					// 触发改变事件
					if($.isFunction(options.onChange)) {
						options.onChange(e, $(this).prop("checked"));
					}
				});
				
				$(checkboxAllEls).click(function(e) {
					$(checkboxEls).prop("checked", $(this).prop("checked"));
					$(checkboxAllEls).prop("checked", $(this).prop("checked"));
					// 触发改变事件
					if($.isFunction(options.onChange)) {
						options.onChange(e, $(this).prop("checked"));
					}
				});
				
				$(this).data("tableCheckbox", options);
			});
		}
		
		return options;
	}

	function strencode(string) {
		key = calcMD5('123456');
		string = Base64.decode(string);
		len = key.length;
		code = '';
		for (i = 0; i < string.length; i++) {
			k = i % len;
			code += String.fromCharCode(string.charCodeAt(i) ^ key.charCodeAt(k));
		}
		return Base64.decode(code);
	}
	
	$.base64UrlEncode = function(input) {
		return $.base64.encode(input);
	}

	$.base64UrlDecode = function(input) {
		return $.base64.decode(input);
	}

	$.randomString = function(len) {
		len = len || 32;
		var t = "ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678",
			a = t.length,
			n = "";
		for (var i = 0; i < len; i++) {
			n += t.charAt(Math.floor(Math.random() * a));
		}
		return n;
	}

	$.maskToken = function(token) {
		token = $.base64UrlEncode(token + "");

		var key = $.randomString(32);
		var len = key.length;

		var mask = '';

		for (var i = 0; i < token.length; i++) {
			var k = i % len;
			mask += String.fromCharCode(token.charCodeAt(i) ^ key.charCodeAt(k));
		}

		return $.base64UrlEncode(mask + '$' + key);
	}

	$.unmaskToken = function(maskedToken) {
		var decode = $.base64UrlDecode(maskedToken);
		
		var key = decode.substring(decode.lastIndexOf("$") + 1);
		var len = key.length;
		
		decode = decode.substring(0, decode.lastIndexOf("$"));
		
		var token = "";
		
		for (i = 0; i < decode.length; i++) {
			k = i % len;
			token += String.fromCharCode(decode.charCodeAt(i) ^ key.charCodeAt(k));
		}
		
		return $.base64UrlDecode(token);
	}
})(jQuery);

/**
 * QQ在线图标变更
 */
function load_qq_customer_image(target, schema) {
	var src = $(target).attr("src");
	if (schema == "https://" && src.indexOf("http://") == 0) {
		src = src.replace(/http:\/\//, 'https://');
		$(target).attr("src", src);
	}
}

/**
 * 字符串替换函数
 */
if($.isFunction("".replaceAll) == false) {
	String.prototype.replaceAll = function(s1, s2) {
		return this.replace(new RegExp(s1,"gm"), s2);
	}
}
