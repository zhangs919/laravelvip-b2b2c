/**
 * 检查业务信息是否已经发生改变
 * @param string type shop-店铺 multistore-门店 user-用户
 * @returns {boolean}
 */
function checkInfoChanged(type) {
	var szy_id = $("meta[name='szy_current_" + type + "_id']").attr("content");
	if (szy_id > 0 && szy_id != $.cookie("szy_current_" + type + "_id")) {
		return true;
	}
	return false;
}

/**
 * 检查店铺是否已经发生改变
 *
 * @returns {boolean}
 */
function shopIsChanged() {
	return checkInfoChanged('shop');
}

/**
 * 检查店铺是否已经发生改变
 *
 * @returns {boolean}
 */
function multiStoreIsChanged() {
	return checkInfoChanged('multistore');
}

String.prototype.trim = function () {
	return this.replace(/(^\s*)|(\s*$)/g, "");
}
String.prototype.ltrim = function () {
	return this.replace(/(^\s*)/g, "");
}
String.prototype.rtrim = function () {
	return this.replace(/(\s*$)/g, "");
}

// 日期格式化
Date.prototype.format = function(){
	function add0(m) {
		return m < 10 ? '0' + m : m
	}

	var y = this.getFullYear();
	var m = this.getMonth() + 1;
	var d = this.getDate();
	var h = this.getHours();
	var mm = this.getMinutes();
	var s = this.getSeconds();

	return y + '-' + add0(m) + '-' + add0(d) + ' ' + add0(h) + ':' + add0(mm) + ':' + add0(s);
}

$(function () {

	var changed_tips_map = {
		"shop": "您已切换店铺，当前页面信息可能已经过时，请关闭页面重新处理！",
		"multistore": "您已切换门店，当前页面信息可能已经过时，请关闭页面重新处理！",
	};

	var szy_id = null;
	var szy_key = null;
	var szy_type = null;
	var szy_types = ['shop', 'multistore'];
	var szy_changed_tips = null;

	for (var i = 0; i < szy_types.length; i++) {
		szy_key = "szy_current_" + szy_types[i] + "_id";
		szy_id = $("meta[name='" + szy_key + "']").attr("content");
		if (szy_id > 0) {
			szy_type = szy_types[i];
			szy_changed_tips = changed_tips_map[szy_type];
			break;
		}else{
			szy_key = null;
		}
	}

	if (szy_id > 0) {
		$.cookie(szy_key, szy_id, {
			path: "/"
		});
		$("form").submit(function (e) {
			// 检查信息是否已改变
			if (checkInfoChanged(szy_type)) {
				$.msg(szy_changed_tips);
				//阻止事件冒泡  ，可阻止父类事件的发生
				e.stopPropagation();
				return false;
			}
		});

		/**
		 * 重写post提交，自动补充csrf参数
		 */
		var _post = $.post;

		$.post = function (url, data, callback, type) {
			// 检查信息是否已改变
			if (checkInfoChanged(szy_type)) {
				$.msg(szy_changed_tips);
				return;
			}
			return _post(url, data, callback, type);
		};

		// 备份jquery的ajax方法
		var _ajax = $.ajax;

		// 重写jquery的ajax方法
		$.ajax = function (opt) {
			// 检查信息是否已改变
			if (checkInfoChanged(szy_type)) {
				$.msg(szy_changed_tips);
				return;
			}
			return _ajax(opt);
		}
	}

	// 20220418@niqingyang - 页面中输入框自动去掉两边空白字符
	$("body").on("blur", ":input", function() {
		var value = $(this).val();
		if(value && typeof value == 'string' && $(this).attr("type") != "file") {
			$(this).val(value.trim());
		}
	});
})

// 页面过渡效果
$.pageLoading = function (settings) {
	var defaults = {
		callback: null,
		fase: 1000,
		// 组件渲染
		render: function () {
			var html = '<div class="page-loading SZY-PAGE-LOADING">';
			html += '<div class="loading-spinner">';
			html += '<span class="spinner-items">';
			html += '<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>';
			html += '</span></div></div>';
			$('html').append(html);

			// 防止未被清除
			setTimeout(function () {
				if ($('.SZY-PAGE-LOADING').length > 0) {
					$('.SZY-PAGE-LOADING').remove();
				}
			}, 5000);

		},
	}

	settings = $.extend(true, defaults, settings);

	// 渲染
	settings.render();

	if (isWeiXin()) {

		document.addEventListener("WeixinJSBridgeReady", function () {

			$('.SZY-PAGE-LOADING').show().fadeOut(settings.fase, function () {
				$(this).remove();
			});
			// 回调
			if ($.isFunction(settings.callback)) {
				settings.callback.call(settings);
			}
		}, false);
	} else {

		window.onload = function () {
			$('.SZY-PAGE-LOADING').show().fadeOut(settings.fase, function () {
				$(this).remove();
			});

			// 回调
			if ($.isFunction(settings.callback)) {
				settings.callback.call(settings);
			}
		}
	}
}

$.getTemplateSessionStorageKey = function (uid) {
	var szy_tag = ($("meta[name='szy_tag']").length > 0) ? $("meta[name='szy_tag']").attr("content") : '';

	if (szy_tag) {
		return 'template_' + uid + '_' + szy_tag;
	}

	return 'template_' + uid;
}

// 装修模板加载
$.templateloading = function (settings) {
	var clearTime;
	var floor_template = $('body').find('.floor-template');
	var szy_tag = ($("meta[name='szy_tag']").length > 0) ? $("meta[name='szy_tag']").attr("content") : '';
	var defaults = {
		url: '/site/ajax-render.html',
		data: null,
		// 加载数据
		load: function (obj) {
			var uid = $(obj).attr('id') || $(obj).data('uid');
			var tpl_file = $(obj).attr('tpl_file') || $(obj).data('tpl_file');
			var is_last = $(obj).attr('is_last') || $(obj).data('is_last');

			// console.log(uid, tpl_file, obj)

			if (tpl_file && uid) {
				return $.ajax({
					type: 'get',
					url: settings.url,
					dataType: 'json',
					data: {
						uid: uid,
						tpl_file: tpl_file,
						is_last: is_last
					},
					success: function (result) {
						if (result.code == 0) {

							// 通过JS版本号可强制更新模板数据
							if (result.js_version) {
								var js_version = sessionStorage.getItem('JS_VERSION');
								if (result.js_version != js_version) {
									sessionStorage.setItem('JS_VERSION', result.js_version);
								}
							}

							// 缓存数据
							if (result.refresh_type == 0) {
								sessionStorage.setItem($.getTemplateSessionStorageKey(uid), result.data);
							}

							var content = $("<div class='floor-template-loaded'>" + result.data + "</div>");
							$(content).data("uid", uid);
							$(content).data("tpl_file", tpl_file);
							$(content).data("is_last", is_last);
							// 渲染函数
							$(content).data("render", function () {
								return settings.load($(content));
							});
							// 替换
							$(obj).replaceWith(content);

							// 图片缓载
							if ($.imgloading && $.isFunction($.imgloading.loading)) {
								$.imgloading.loading();
							} else {
								$(function () {
									$.imgloading.loading();
								});
							}
						} else {
							$(obj).remove();
							console.info(result.message);
						}
					}
				});
			}

			return null;
		},
		// 模板加载
		loadTemplate: function (arr) {
			var is_last = false;

			// 通过JS版本号可强制更新模板数据
			var js_version = $("meta[name='js_version']").attr("content");
			var js_version_changed = js_version != sessionStorage.getItem('JS_VERSION');

			for (var i = 0, len = arr.length; i < len; i++) {

				var target = arr[i];

				// 判断是否已经缓存
				var cachekey = $.getTemplateSessionStorageKey($(arr[i]).attr('id'));
				if (js_version_changed == false && sessionStorage.getItem(cachekey)) {

					var content = $("<div class='floor-template-loaded'>" + sessionStorage.getItem(cachekey) + "</div>");
					$(content).data("uid", $(target).attr('id'));
					$(content).data("tpl_file", $(target).attr('tpl_file'));
					$(content).data("is_last", $(target).attr('is_last'));
					// 渲染函数
					$(content).data("render", function () {
						return settings.load($(content));
					});
					// 替换
					$(target).replaceWith(content);

					// 图片缓载
					if ($.imgloading && $.isFunction($.imgloading.loading)) {
						setTimeout(function () {
							$.imgloading.loading()
						}, 50);
					} else {
						$(function () {
							$.imgloading.loading();
						});
					}
					continue;
				}

				if ($(target).offset().top >= ($(window).scrollTop() - 500) && $(target).offset().top < ($(window).scrollTop() + $(window).height() + 500) && !target.isLoad) {
					target.isLoad = true;
					(function (i) {
						$("body").queue(function () {
							var result = settings.load(arr[i]);

							setTimeout(function () {
								$("body").dequeue();
							}, 300)
						})
					})(i);
				}
			}
		},
	};

	settings = $.extend(true, defaults, settings);

	settings.loadTemplate(floor_template);

	window.onscroll = function () { // 滚动条滚动触发
		clearTimeout(clearTime);
		clearTime = setTimeout(function () {
			settings.loadTemplate(floor_template);
		}, 500);
	};
}

// 判断是否为微信
$.isWeiXin = function () {
	var ua = window.navigator.userAgent.toLowerCase();
	if (ua.match(/MicroMessenger/i) == 'micromessenger') {
		return true;
	}
	return false;
}

// 判断是否为微信
function isWeiXin() {
	return $.isWeiXin();
}

// 验证整数
function validateInteger(obj) {
	obj.value = obj.value.replace(/\D|^0/g, '');
	if (obj.value > 255) {
		obj.value = 255;
	}
}

// 清理模板缓存
function sessionStorageTemplateClear() {
	if (sessionStorage) {
		$.each(sessionStorage, function (i, v) {
			if (i.indexOf('template_') == 0) {
				sessionStorage.removeItem(i);
			}
		});
	}
}

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

$(function () {
	// 图片缓载
	if ($.imgloading && $.isFunction($.imgloading.loading)) {
		$.imgloading.loading();
	}

	// 监听用户请求事件
	$(window).bind("szy.after.request.user.info", function (event, data) {

		if (data.order_enable == 0) {
			$.ajax({
				type: 'get',
				url: '/shop/index/out-openhour-order-enable.html',
				dataType: 'json',
				success: function (result) {
					if (result.code == 0) {
						$.open({
							title: false,
							closeBtn: 0,
							type: 1,
							area: '100% !important',
							offset: 'b',
							shade: 0,
							content: result.data,
						});
					}
				}
			});
		}

		//选择门店弹窗
		if (data.multi_store_after_login != undefined && data.multi_store_after_login.is_show && $("#multistore_err_close_off_sale").length == 0) {
			$.open({
				type: 1,
				area: '70%',
				content: data.multi_store_selection
			});
		}
	});

	// 日历控件关闭自动提示
	$(".form_datetime").attr("autocomplete", "off");
	$("#start_time").attr("autocomplete", "off");
	$("#end_time").attr("autocomplete", "off");
});

// cookie
(function () {
	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch (e) {
		}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {

		// Write

		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setTime(+t + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path ? '; path=' + options.path : '',
				options.domain ? '; domain=' + options.domain : '',
				options.secure ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};
})();
