/**
 * AJAX上传文件：用网上JS代码改造
 * 
 * @author niqingyang<niqy@qq.com>
 * @date 2017-03-25
 */
(function($) {

	var lastUuid = 0;

	function uuid() {
		return (new Date()).getTime() * 1000 + (lastUuid++) % 1000;
	}

	var settings = {
		// 用于文件上传的服务器端请求地址
		url: '/upload/file',
		data: {

		},
		// 一般设置为false
		secureuri: false,
		// 上传文件的表单元素ID
		fileElementId: null,
		// 返回的参数类型，默认JSON
		dataType: 'json',
		success: null,
		error: function(data, status, e)// 服务器响应失败处理函数
		{
			alert(e);
		}
	};
	// 设置csrf
	settings.data[$.getCsrfParam()] = $.getCsrfToken();

	/**
	 * {input type='file-image' model=$model field=''}单图上传及预览功能
	 * 
	 * @param fieldElementId
	 *            存储到数据库中的保存文件路径的元素ID
	 * @param fileElementId
	 *            上传文件的Id
	 */
	$.ajaxFileImageUpload = function(s) {

		s = $.extend(settings, {
			url: '/upload/image',
		}, s);

		s.data.attribute = $("#" + s.fileElementId).attr("name");

		var fileElementId = s.fileElementId;
		var fieldElementId = s.fieldElementId;

		if (!$.isFunction(s.success)) {
			s.success = function(result, status) {
				if (result.code == 0 && result.data) {
					var url = result.data.url;
					var value = result.data.value;
					$("#" + fileElementId + "_image").attr("ref", url);
					$("#" + fieldElementId).val(value);
				} else if (result.message) {
					// 显示错误信息
					if ($.validator) {
						$.validator.showError($("#" + fileElementId), result.message);
					} else {
						alert(result.message);
					}
				}
			}
		}

		$.ajaxFileUpload(s);
	}

	// 这里s是个json对象，传入一些ajax的参数
	$.ajaxFileUpload = function(s) {

		var deferred = $.Deferred();

		// TODO introduce global settings, allowing the client to modify
		// them for all requests, not only timeout
		// 此时的s对象是由$.ajaxSettings和原s对象扩展后的对象

		s = $.extend(settings, s);

		// 设置csrf
		s.data[$.getCsrfParam()] = $.getCsrfToken();

		// 取当前系统时间，目的是得到一个独一无二的数字
		var id = new Date().getTime();
		// 创建动态form
		var form = s.createUploadForm(id, s.fileElementId, (typeof (s.data) == 'undefined' ? false : s.data));
		// 创建动态iframe
		var io = s.createUploadIframe(id, s.secureuri);
		// 动态iframe的id
		var frameId = 'jUploadFrame' + id;
		// 动态form的id
		var formId = 'jUploadForm' + id;
		// Watch for a new set of requests
		// 当jQuery开始一个ajax请求时发生
		if (s.global && !$.active++) {
			// 触发ajaxStart方法
			$.event.trigger("ajaxStart");
		}
		// 请求完成标志
		var requestDone = false;
		// Create the request object
		var xml = {};
		if (s.global) {
			// 触发ajaxSend方法
			$.event.trigger("ajaxSend", [xml, s]);
		}
		// Wait for a response to come back
		// 回调函数
		var uploadCallback = function(isTimeout) {
			// 得到iframe对象
			var io = document.getElementById(frameId);
			try {
				if (io.contentWindow) {
					// 动态iframe所在窗口对象是否存在
					xml.responseText = io.contentWindow.document.body ? io.contentWindow.document.body.innerHTML : null;
					xml.responseXML = io.contentWindow.document.XMLDocument ? io.contentWindow.document.XMLDocument : io.contentWindow.document;
				} else if (io.contentDocument) {
					// 动态iframe的文档对象是否存在
					xml.responseText = io.contentDocument.document.body ? io.contentDocument.document.body.innerHTML : null;
					xml.responseXML = io.contentDocument.document.XMLDocument ? io.contentDocument.document.XMLDocument : io.contentDocument.document;
				}
			} catch (e) {
				s.handleError(s, xml, null, e);
			}
			// xml变量被赋值或者isTimeout ==
			if (xml || isTimeout == "timeout") {
				// "timeout"都表示请求发出，并且有响应请求完成
				requestDone = true;
				var status;
				try {
					// 如果不是“超时”，表示请求成功
					status = isTimeout != "timeout" ? "success" : "error";
					// Make sure that the request was successful or
					// notmodified
					if (status != "error") {
						// process the data (runs the xml through httpData
						// regardless of callback)
						// 根据传送的type类型，返回json对象，此时返回的data就是后台操作后的返回结果
						var data = s.uploadHttpData(xml, s.dataType);
						// If a local callback was specified, fire it and
						// pass it the data
						if (s.success) {
							// 执行上传成功的操作
							s.success(data, status);
						}
						// Fire the global callback
						if (s.global) {
							$.event.trigger("ajaxSuccess", [xml, s]);
						}
					} else {
						s.handleError(s, xml, status);
					}
				} catch (e) {
					status = "error";
					s.handleError(s, xml, status, e);
				} // The request was completed
				if (s.global) {
					// Handle
					$.event.trigger("ajaxComplete", [xml, s]);
				}
				// the
				// global
				// AJAX
				// counter
				if (s.global && !--$.active) {
					// Process result
					$.event.trigger("ajaxStop");
				}
				if (s.complete) {
					s.complete(xml, status);
				}
				// 移除iframe的事件处理程序
				$(io).unbind();
				// 设置超时时间
				setTimeout(function() {
					try {
						// 移除动态iframe
						$(io).remove();
						// 移除动态form
						$(form).remove();
					} catch (e) {
						s.handleError(s, xml, null, e);
					}
				}, 100)
				xml = null;

				// 标识完成
				deferred.resolveWith(s, [data, status]);
			}
		}
		// Timeout checker
		if (s.timeout > 0) {// 超时检测
			// Check to see if the request is still
			setTimeout(function() {
				// happening
				if (!requestDone) {
					// 如果请求仍未完成，就发送超时信号
					uploadCallback("timeout");
				}
			}, s.timeout);
		}
		try {
			var form = $('#' + formId);
			// 传入的ajax页面导向url
			$(form).attr('action', s.url);
			// 设置提交表单方式
			$(form).attr('method', 'POST');
			// 返回的目标iframe，就是创建的动态iframe
			$(form).attr('target', frameId);
			if (form.encoding) {// 选择编码方式
				$(form).attr('encoding', 'multipart/form-data');
			} else {
				$(form).attr('enctype', 'multipart/form-data');
			}
			// 提交form表单
			$(form).submit();
		} catch (e) {
			s.handleError(s, xml, null, e);
		}
		// ajax 请求从服务器加载数据，同时传入回调函数
		$('#' + frameId).load(uploadCallback);
		return deferred.promise();
	};

	// 动态创建上传需要的iframe
	settings.createUploadIframe = function(id, uri) {
		// create frame
		// 给iframe添加一个独一无二的id
		var frameId = 'jUploadFrame' + id;
		var iframeHtml = '<iframe id="' + frameId + '" name="' + frameId + '" style="position:absolute; top:-9999px; left:-9999px"'; // 创建iframe元素
		// 判断浏览器是否支持ActiveX控件
		if (window.ActiveXObject) {
			if (typeof uri == 'boolean') {
				iframeHtml += ' src="' + 'javascript:false' + '"';
			} else if (typeof uri == 'string') {
				iframeHtml += ' src="' + uri + '"';
			}
		}
		iframeHtml += ' />';
		$(iframeHtml).appendTo(document.body); // 将动态iframe追加到body中
		return $('#' + frameId).get(0); // 返回iframe对象
	}

	// 动态创建上传需要的form表单
	settings.createUploadForm = function(id, fileElementId, data) {
		var formId = 'jUploadForm' + id;
		// 给<input type='file' />添加一个独一无二的id
		var fileId = 'jUploadFile' + id;
		// 创建form元素
		var form = jQuery('<form  action="" method="POST" name="' + formId + '" id="' + formId + '" enctype="multipart/form-data" ></form>');
		// 通常为false
		if (data) {
			// 获取CSRF值
			data = $.extend(data, this.getCsrf());
			for ( var i in data) {
				var element_id = uuid();
				// 根据data的内容，创建隐藏域，这部分我还不知道是什么时候用到。估计是传入json的时候，如果默认传一些参数的话要用到。
				var element = $('<input type="hidden" id="' + element_id + '" name="' + i + '" value="" />');
				$(element).val(data[i])
				$(element).appendTo(form);
			}
		}
		// 得到页面中的<input type='file' />对象
		var oldElement = jQuery('#' + fileElementId);
		// 克隆页面中的<input type='file' />对象
		var newElement = jQuery(oldElement).clone();
		// 修改原对象的id
		$(oldElement).attr('id', fileId);
		// 在原对象前插入克隆对象
		$(oldElement).before(newElement);
		// 把原对象插入到动态form的结尾处
		$(oldElement).appendTo(form);
		// set attributes
		// 给动态form添加样式，使其浮动起来，
		$(form).css('position', 'absolute');
		$(form).css('top', '-1200px');
		$(form).css('left', '-1200px');
		// 把动态form插入到body中
		$(form).appendTo('body');

		return form;
	}

	settings.uploadHttpData = function(r, type) {
		var data = !type;
		data = type == "xml" || data ? r.responseXML : r.responseText; // If
		// th type is "script", eval it in global context
		if (type == "script") {
			// Get the JavaScript object, if JSON is used.
			$.globalEval(data);
		}
		if (type == "json") {
			// evaluate scripts within html
			eval("data = " + data);
		}
		if (type == "html") {
			$("<div>").html(data).evalScripts();
		}
		return data;
	};

	settings.handleError = function(s, xhr, status, e) {
		// If a local callback was specified, fire it
		if (s.error) {
			s.error.call(s.context || s, xhr, status, e);
		}

		// Fire the global callback
		if (s.global) {
			(s.context ? $(s.context) : $.event).trigger("ajaxError", [xhr, s, e]);
		}
	};

	/**
	 * @return string|undefined the CSRF parameter name. Undefined is returned if CSRF validation is not enabled.
	 */
	settings.getCsrfParam = function() {
		return $('meta[name=csrf-param]').attr('content');
	}

	/**
	 * @return string|undefined the CSRF token. Undefined is returned if CSRF validation is not enabled.
	 */
	settings.getCsrfToken = function() {
		return $('meta[name=csrf-token]').attr('content');
	}

	/**
	 * 获取Csrf值
	 */
	settings.getCsrf = function() {
		var name = this.getCsrfParam();
		var value = this.getCsrfToken();
		if (name && value) {
			return {
				name: value
			};
		} else {
			return $("[name=_csrf]").val();
		}
	}

})(jQuery);