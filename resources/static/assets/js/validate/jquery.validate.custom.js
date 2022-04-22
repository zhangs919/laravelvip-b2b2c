/**
 * 
 * 68Shop 表单验证插件
 * 
 * ============================================================================ 版权所有 2008-2015 秦皇岛商之翼网络科技有限公司，并保留所有权利。 网站地址: http://www.68ecshop.com ============================================================================
 * 
 * @author : niqingyang
 * @version 1.0
 * @link http://www.68ecshop.com
 */
(function($) {
	if ($.validator == undefined) {
		return;
	}

	var pub = {
		isEmpty: function(value) {
			return value === null || value === undefined || value == [] || value === '';
		}
	};

	var deferredArray = function() {
		var array = [];
		array.add = function(callback) {
			this.push(new $.Deferred(callback));
		};
		return array;
	};

	$.extend($.validator.messages, {
		integer: $.validator.format("只能输入一个整数")
	});

	/**
	 * 初始化validator默认值
	 */
	$.validator.setDefaults({
		errorPlacement: function(error, element) {
			var error_id = $(error).attr("id");
			var error_msg = $(error).text();
			var element_id = $(error).attr("for");

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
				$(element).after(error_html);
			} else {
				$(element).after(error_html);
			}

		},
		// 触发校验的方式，可选值有keyup(每次按键时)，blur(当控件失去焦点时)
		event: "keyup",
		// 如果这个参数为true，那么表单不会提交，只进行检查，调试时十分方便.
		debug: false,
		ignore: "",
		errorClass: 'error',
		focusInvalid: true,
		onkeyup: function(element, event) {
			var rules = this.settings.rules[$(element).attr("name")];
			// 如果未设置默认值验证则在失去焦点是检查如果值为空则设置默认值
			// 如果存在非空校验则先进行非空校验
			if (!(rules && rules['default'])) {
				$(element).valid();
			}

			// 触发其他元素验证
			var trigger = $(element).data("rule-trigger");

			if (trigger) {
				if (typeof trigger == 'string') {
					trigger = trigger.split(",");
				} else if (typeof trigger == 'object') {
					trigger = [trigger];
				}

				if ($.isArray(trigger)) {
					for (var i = 0; i < trigger.length; i++) {
						$(trigger[i]).valid();
					}
				}
			}

		},
		// 失去焦点验证
		onfocusout: function(element) {
			if (!this.checkable(element) && (element.name in this.submitted || !this.optional(element))) {
				
				this.element(element);
				
				// 触发其他元素验证
				var trigger = $(element).data("rule-trigger");

				if (trigger) {
					if (typeof trigger == 'string') {
						trigger = trigger.split(",");
					} else if (typeof trigger == 'object') {
						trigger = [trigger];
					}

					if ($.isArray(trigger)) {
						for (var i = 0; i < trigger.length; i++) {
							$(trigger[i]).valid();
						}
					}
				}
			}
		},
		// 点击验证
		onclick: function(element) {

			// Click on selects, radiobuttons and checkboxes
			if (element.name in this.submitted) {
				this.element(element);

				// Or option elements, check parent select in that case
			} else if (element.parentNode.name in this.submitted) {
				this.element(element.parentNode);
			}
			
			// 触发其他元素验证
			var trigger = $(element).data("rule-trigger");

			if (trigger) {
				if (typeof trigger == 'string') {
					trigger = trigger.split(",");
				} else if (typeof trigger == 'object') {
					trigger = [trigger];
				}

				if ($.isArray(trigger)) {
					for (var i = 0; i < trigger.length; i++) {
						$(trigger[i]).valid();
					}
				}
			}
		},
		// 成功后移除错误提示
		success: function(error) {
			var error_id = $(error).attr("id");
			var element_id = $(error).attr("for");
			$("[id='" + error_id + "']").remove();
		},
		deferreds: deferredArray()
	});

	/**
	 * 显示错误信息
	 * 
	 * @param element
	 *            表单元素对象
	 * @param message
	 *            错误消息
	 */
	$.validator.showError = function(element, message) {
		var elementID = $(element).attr("id");
		var error = $("<label>").attr("id", elementID + "-error").addClass("error").html(message || "");
		$.validator.defaults.errorPlacement(error, element);
	};

	/**
	 * 移除显示的错误信息
	 * 
	 * @param element
	 *            表单元素对象
	 */
	$.validator.clearError = function(element) {
		var error_id = $(element).attr("id") + "-error";
		// 防止ID为jquery里的规则查不出来表单元素对象
		var error_dom = null;
		if ($(element).parents("form").size() > 0) {
			error_dom = $(element).parents("form").find("[id='" + error_id + "']");
		} else {
			error_dom = document.getElementById("[id='" + error_id + "']");
		}
		$(element).removeClass("error");
		if ($(error_dom).size() > 0) {
			$(error_dom).remove();
		}
	};

	/**
	 * 获取元素值，如果元素绑定了default验证，则获取当前最新的值，否则获取value
	 */
	function getValue(value, element, options) {
		var rules = this.settings.rules[$(element).attr("name")];
		if (rules && rules['default']) {
			return $(element).val();
		}
		return value;
	}

	/**
	 * 自定义函数验证
	 */
	$.validator.addMethod("callback", function(value, element, options) {
		try {
			options = eval(options);
			if ($.isFunction(options)) {
				return options.call(this, element, value) ? true : false;
			}
		} catch (e) {
		}
		return false;

	});

	/**
	 * 条件验证器，可根据条件验证多个规则
	 * 
	 * @param array
	 *            options [{min: {}, ...},{},{}]
	 */
	$.validator.addMethod("when", function(value, element, options) {
		
		if($.isArray(options) == false){
			console.error("validator “when” options must be a Array");
			return false;
		}
		
		var context = this;
		
		var valid = true, validator = this, errorList = [];
		
		for(var i = 0; i < options.length; i++){
			
			if(!options[i].when){
				continue;
			}
			
			var when = options[i].when;
			
			if($.isFunction(when) == false){
				// 动态创建函数
				eval("when = " + when);
			}
			
			if($.isFunction(when) == false){
				console.error("validator “when” options.when must be a function");
				return false;
			}
			
			var rules = {};
			var messages = options[i].messages;
			
			for(var method in options[i]){
				if(method != "messages" && method != "when"){
					rules[method] = options[i][method];
				}
			}
			
			if(when.call(this, value, element)){
				valid = this.element(element, rules, messages) && valid;
				
				if(!valid){
					// 动态修改“when”的 message
					if(!this.settings.messages[element.name]){
						// 初始化
						this.settings.messages[element.name] = {};
					}
					this.settings.messages[element.name]["when"] = this.errorMap[element.name];
					errorList = errorList.concat(this.errorList);
					this.errorList = errorList;
					break;
				}
			}
		}
		
		return valid;
	});
	
	/**
	 * Default默认值设置
	 */
	$.validator.addMethod("default", function(value, element, options) {
		if (value == undefined || value == null || value == '') {
			$(element).val(options);
		}
		return true;
	});

	/**
	 * 必填
	 */
	$.validator.addMethod("required", function(value, element, options) {

		// 获取值
		value = getValue.call(this, value, element, options);

		if (typeof options == 'object') {
			var valid = false;
			if (options.requiredValue === undefined) {
				var isString = typeof value == 'string' || value instanceof String;
				if (options.strict && value !== undefined || !options.strict && !pub.isEmpty(isString ? $.trim(value) : value)) {
					valid = true;
				}

				if (options.strict && value !== undefined) {
					valid = true;
				}

				if (!options.strict && !pub.isEmpty(isString ? $.trim(value) : value)) {
					valid = true;
				}

				if (!this.depend(options, element)) {
					return "dependency-mismatch";
				}
				if (element.nodeName.toLowerCase() === "select") {
					// could be an array for select-multiple or a string, both
					// are fine this way
					var val = $(element).val();
					valid = val && val.length > 0;
				}
				if (this.checkable(element)) {
					valid = this.getLength(value, element) > 0;
				}

			} else if (!options.strict && value == options.requiredValue || options.strict && value === options.requiredValue) {
				valid = true;
			}

			return valid;
		} else {
			if (!this.depend(options, element)) {
				return "dependency-mismatch";
			}
			if (element.nodeName.toLowerCase() === "select") {
				// could be an array for select-multiple or a string, both
				// are fine this way
				var val = $(element).val();
				return val && val.length > 0;
			}
			if (this.checkable(element)) {
				return this.getLength(value, element) > 0;
			}
			return value.length > 0;
		}

	}, "不能为空！");

	/**
	 * Boolean验证
	 */
	$.validator.addMethod("boolean", function(value, element, options) {

		// 获取值
		value = getValue.call(this, value, element, options);

		if (typeof options == 'object') {
			var valid = !options.strict && (value == options.trueValue || value == options.falseValue) || options.strict && (value === options.trueValue || value === options.falseValue);

			return valid;
		} else {
			return typeof value == 'boolean';
		}
	});

	/**
	 * Exist校验器
	 */
	$.validator.addMethod("ajax", function(value, element, options) {

		if (!options) {
			console.error("无效的exist验证器参数！");
			return;
		}

		// 获取值
		value = getValue.call(this, value, element, options);

		if (value == undefined || value == null || value == '') {
			value = '';
		}

		if (this.optional(element)) {
			return "dependency-mismatch";
		}

		var previous = this.previousValue(element), validator, data;

		if (!this.settings.messages[element.name]) {
			this.settings.messages[element.name] = {};
		}
		previous.originalMessage = this.settings.messages[element.name].remote;
		this.settings.messages[element.name].remote = previous.message;

		if (previous.old === value) {
			return previous.valid;
		}

		previous.old = value;
		validator = this;
		this.startRequest(element);

		var url = options.url;
		var model = options.model;
		var params = options.params;

		var data = {
			'model': options.model,
			'attribute': options.attribute,
			'scenario': options.scenario
		};

		data[element.name] = value;
		
		for (var i in params) {
			
			if($.isPlainObject(params[i])){
				
				for(var name in params[i]){
					
					var item = params[i][name];
					
					if($.isPlainObject(item)){
						// 选择器对象
						if(item.selector && $(item.selector).val() !== undefined){
							data[name] = $(item.selector).val();
						}else if(item.selector == undefined){
							console.error("AJAX验证参数有误，参数params中selector对象数据格式错误：");
							console.error(params);
							console.error("------------------------");
						}
					}else if($.isFunction(item)){
						
						// 自定义函数
						var elementVlaue = item.call(this, value, element, options);
						
						if(elementVlaue != undefined){
							data[name] = elementVlaue;
						}
						
					}else{
						// 直接值
						data[name] = item;
					}
				}
				
			}else{
				
				var elementName = params[i];
				var elementVlaue = $("[name='" + elementName + "']").val();
				data[elementName] = elementVlaue == undefined ? "" : elementVlaue;
				
			}
		}
		
		$.ajax({
			url: url,
			mode: "abort",
			port: "validate" + element.name,
			dataType: "json",
			data: data,
			context: validator.currentForm,
			success: function(response) {

				// var valid = response === true || response === "true", errors,
				// message, submitted;

				var valid = response.code == 0 || response == true || response === "true", errors, message, submitted;

				validator.settings.messages[element.name].remote = previous.originalMessage;
				if (valid) {
					submitted = validator.formSubmitted;
					validator.prepareElement(element);
					validator.formSubmitted = submitted;
					validator.successList.push(element);
					delete validator.invalid[element.name];
					validator.showErrors();
				} else {
					setMessage.call(validator, element, 'ajax', response.message);
					errors = {};
					message = response.message || validator.defaultMessage(element, "ajax");
					errors[element.name] = previous.message = $.isFunction(message) ? message(value) : message;
					validator.invalid[element.name] = true;
					validator.showErrors(errors);
				}
				previous.valid = valid;
				validator.stopRequest(element, valid);

				var callback = $(element).data("rule-ajax-callback");

				if ($.isFunction(callback)) {
					callback.call(element, response);
				}
			}
		});
		return "pending";

	});

	/**
	 * 字符串验证
	 */
	$.validator.addMethod("string", function(value, element, options) {
		// 获取值
		value = getValue.call(this, value, element, options);

		return typeof value == 'string';
	});

	/**
	 * 字符串验证：最小长度
	 */
	$.validator.addMethod("minlength", function(value, element, options) {
		// 获取值
		value = getValue.call(this, value, element, options);
		var length = $.isArray(value) ? value.length : this.getLength(value, element);
		return this.optional(element) || length >= options;
	});

	/**
	 * 字符串验证：最大长度
	 */
	$.validator.addMethod("maxlength", function(value, element, options) {
		// 获取值
		value = getValue.call(this, value, element, options);
		var length = $.isArray(value) ? value.length : this.getLength(value, element);
		return this.optional(element) || length <= options;
	});

	/**
	 * 字符串验证：指定长度
	 */
	$.validator.addMethod("length", function(value, element, options) {
		// 获取值
		value = getValue.call(this, value, element, options);
		var length = $.isArray(value) ? value.length : this.getLength(value, element);
		return this.optional(element) || length == options;
	});

	/**
	 * 数字
	 */
	$.validator.addMethod("number", function(value, element, options) {
		// return this.optional(element) ||
		// value.match(/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/);
		// 获取值
		value = getValue.call(this, value, element, options);
		if($.isPlainObject(options) == false || !options.pattern){
			options = {
				pattern: /^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/,
			};
		}
		if(typeof options.pattern == 'string'){
			if(options.pattern.indexOf("/") == 0){
				options.pattern = options.pattern.substring(1);
			}
			if(options.pattern.lastIndexOf("/") == options.pattern.length - 1){
				options.pattern = options.pattern.substring(0, options.pattern.length - 1);
			}
		}
		
		if(this.optional(element) || value.match(options.pattern)){
			
			$(element).one("blur", function(){
				var val = $.trim($(this).val());
				if(val != "" && !isNaN(val)){
					$(this).val(parseFloat(val));
				}
			});
			
			return true;
		}
		
		return false;
	});
	
	/**
	 * 小数位数
	 */
	$.validator.addMethod("decimal", function(value, element, options) {
		// 获取值
		value = getValue.call(this, value, element, options);
		
		options = parseInt(options);
		
		if(isNaN(options)){
			console.error("验证规则“decimal”的参数“"+options+"”不是一个有效的整数！");
		}
		
		var decimal = value.substring(value.lastIndexOf(".") + 1);
		
		return this.optional(element) || isNaN(options) || value.indexOf(".") < 1 || decimal.length <= options;
	});
	
	/**
	 * 数字：整数
	 */
	$.validator.addMethod("integer", function(value, element, options) {
		// return this.optional(element) || value.match(/^\s*[+-]?\d+\s*$/);
		// 获取值
		value = getValue.call(this, value, element, options);
		
		if(this.optional(element) || /^\s*[+-]?\d+\s*$/.test(value)){
			
			$(element).one("blur", function(){
				var val = $.trim($(this).val());
				if(val != "" && !isNaN(val)){
					$(this).val(parseFloat(val));
				}
			});
			
			return true;
		}
		
		return false;
	});

	/**
	 * 数字：最大值
	 */
	$.validator.addMethod("max", function(value, element, options) {
		// 获取值
		value = getValue.call(this, value, element, options);
		return this.optional(element) || value <= options;
	});

	/**
	 * 数字：最小值
	 */
	$.validator.addMethod("min", function(value, element, options) {
		// 获取值
		value = getValue.call(this, value, element, options);
		return this.optional(element) || value >= options;
	});

	/**
	 * 在范围内，对应YII的range
	 */
	$.validator.addMethod("in", function(value, element, options) {

		if (!options.allowArray && $.isArray(value)) {
			return false;
		}

		var range = options.range ? options.range : options;

		var inArray = true;

		$.each($.isArray(value) ? value : [value], function(i, v) {
			if ($.inArray(v, range) == -1) {
				inArray = false;
				return false;
			} else {
				return true;
			}
		});

		return inArray;
	});

	/**
	 * 不在范围内，对应YII的range
	 */
	$.validator.addMethod("notin", function(value, element, options) {

		if (!options.allowArray && $.isArray(value)) {
			return false;
		}

		var range = options.range ? options.range : options;

		var inArray = true;

		$.each($.isArray(value) ? value : [value], function(i, v) {
			if ($.inArray(v, range) == -1) {
				inArray = false;
				return false;
			} else {
				return true;
			}
		});

		return !inArray;
	});

	/**
	 * 正则表达式，对应YII的regular
	 */
	$.validator.addMethod("match", function(value, element, options) {
		if (!options) {
			console.error("无效的正则表达式验证器参数！");
			return;
		}

		// 获取值
		value = getValue.call(this, value, element, options);

		if (options.skipOnEmpty && pub.isEmpty(value)) {
			return true;
		}
		if (!options.not && !value.match(options.pattern) || options.not && value.match(options.pattern)) {
			return false;
		}
		return true;
	});

	/**
	 * 正则表达式，对应YII的regular
	 */
	$.validator.addMethod("username", function(value, element, options) {
		if (!options) {
			console.error("无效的正则表达式验证器参数！");
			return;
		}

		// 获取值
		value = getValue.call(this, value, element, options);

		if (options.skipOnEmpty && pub.isEmpty(value)) {
			return true;
		}
		if (!value.match(options.pattern)) {
			return false;
		}
		return true;
	});

	/**
	 * 正则表达式，对应YII的regular
	 */
	$.validator.addMethod("password", function(value, element, options) {
		if (!options) {
			console.error("无效的正则表达式验证器参数！");
			return;
		}

		// 获取值
		value = getValue.call(this, value, element, options);

		if (options.skipOnEmpty && pub.isEmpty(value)) {
			return true;
		}
		if (!options.not && !value.match(options.pattern) || options.not && value.match(options.pattern)) {
			return false;
		}
		return true;
	});

	/**
	 * 邮箱验证，对应YII的email
	 */
	$.validator.addMethod("email", function(value, element, options) {

		// 获取值
		value = getValue.call(this, value, element, options);

		if (typeof options == 'object') {

			if (options.skipOnEmpty && pub.isEmpty(value)) {
				return true;
			}

			var valid = true;

			if (options.enableIDN) {
				var regexp = /^(.*<?)(.*)@(.*)(>?)$/, matches = regexp.exec(value);
				if (matches === null) {
					valid = false;
				} else {
					value = matches[1] + punycode.toASCII(matches[2]) + '@' + punycode.toASCII(matches[3]) + matches[4];
				}
			}

			if (!valid || !(value.match(options.pattern) || (options.allowName && value.match(options.fullPattern)))) {
				return false;
			}

			return true;
		} else {
			return this.optional(element) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(value);
		}

	});

	/**
	 * URL验证，对应YII的url
	 */
	$.validator.addMethod("url", function(value, element, options) {

		// 获取值
		value = getValue.call(this, value, element, options);

		if (typeof options == 'object') {

			if (options.skipOnEmpty && pub.isEmpty(value)) {
				return true;
			}

			if (options.defaultScheme && !value.match(/:\/\//)) {
				value = options.defaultScheme + '://' + value;
			}

			var valid = true;

			if (options.enableIDN) {
				var regexp = /^([^:]+):\/\/([^\/]+)(.*)$/, matches = regexp.exec(value);
				if (matches === null) {
					valid = false;
				} else {
					value = matches[1] + '://' + punycode.toASCII(matches[2]) + matches[3];
				}
			}

			if (!valid || !value.match(options.pattern)) {
				return false;
			}

			return true;
		} else {
			return this.optional(element) || /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(value);
		}
	});

	/**
	 * trim，对应YII的trim， 不做数据验证，仅仅是把数据进行trim
	 */
	$.validator.addMethod("trim", function(value, element, options) {
		var value = $(element).val();
		if (!options.skipOnEmpty || !pub.isEmpty(value)) {
			$(element).val($.trim(value));
		}
		return true;
	});

	/**
	 * 地区代码验证
	 */
	$.validator.addMethod("region", function(value, element, options) {

		// 获取值
		value = getValue.call(this, value, element, options);

		if (typeof options == 'object') {

			if (options.skipOnEmpty && pub.isEmpty(value)) {
				return true;
			}

			var valid = true;

			var level = value.split(",").length;

			if (options.min == null) {
				var is_last = $(element).data("is_last");

				if (is_last != undefined) {
					if (is_last) {
						return true;
					} else {
						return false;
					}
				}
			} else if (options.min > 0 && level < options.min) {
				// 先验证是否为最后一级
				var is_last = $(element).data("is_last");

				if (is_last != undefined) {
					if (is_last) {
						return true;
					}
				}

				return false;
			}

			return true;
		} else {
			return true;
		}

	});

	/**
	 * 验证码captcha，对应YII的captcha
	 */
	$.validator.addMethod("captcha", function(value, element, options) {

		if (!options) {
			console.error("无效的captcha验证器参数！");
			return;
		}

		// 获取值
		value = getValue.call(this, value, element, options);

		if (options.skipOnEmpty && pub.isEmpty(value)) {
			return;
		}

		// CAPTCHA may be updated via AJAX and the updated hash is stored in
		// body data
		var hash = $('body').data(options.hashKey);
		if (hash == null) {
			hash = options.hash;
		} else {
			hash = hash[options.caseSensitive ? 0 : 1];
		}
		var v = options.caseSensitive ? value : value.toLowerCase();
		for (var i = v.length - 1, h = 0; i >= 0; --i) {
			h += v.charCodeAt(i);
		}
		if (h != hash) {
			return false;
		}
		return true;
	});

	/**
	 * trigger，用于设置触发其他验证器发生验证的验证规则
	 */
	$.validator.addMethod("trigger", function(value, element, options) {
		if (!options) {
			console.error("无效的trigger验证器参数！");
			return;
		}
		return true;
	});

	/**
	 * compare，对应YII的compare
	 */
	$.validator.addMethod("compare", function(value, element, options) {

		if (!options) {
			console.error("无效的compare验证器参数！");
			return;
		}

		// 获取值
		value = getValue.call(this, value, element, options);

		if (options.skipOnEmpty && pub.isEmpty(value)) {
			return true;
		}

		var compareValue, valid = true;
		if (options.compareAttribute === undefined) {
			compareValue = options.compareValue;
		} else {

			var compare_element = $('#' + options.compareAttribute);

			if ($(element).data("compare-to")) {
				compare_element = $($(element).data("compare-to"));
			}

			compareValue = $(compare_element).val();
			if ($(compare_element).size() == 0) {
				console.error("元素 ID:" + options.compareAttribute + " 不存在！");
				return false;
			}
		}

		if (options.type === 'number') {
			value = parseFloat(value);
			compareValue = parseFloat(compareValue);
		} else if (options.type === 'date') {
			value = new Date(value.replace(/-/g, '/')).getTime();
			compareValue = new Date(compareValue.replace(/-/g, '/')).getTime();
		}

		switch (options.operator) {
			case '==':
				valid = value == compareValue;
				break;
			case '===':
				valid = value === compareValue;
				break;
			case '!=':
				valid = value != compareValue;
				break;
			case '!==':
				valid = value !== compareValue;
				break;
			case '>':
				valid = value > compareValue;
				break;
			case '>=':
				valid = value >= compareValue;
				break;
			case '<':
				valid = value < compareValue;
				break;
			case '<=':
				valid = value <= compareValue;
				break;
			default:
				valid = false;
				break;
		}

		$(element).data("is-compared", true);

		if (valid) {
			try {
				// 移除错误样式
				$(element).remveClass("error");
				if ($('#' + options.compareAttribute).data("is-compared") != true) {
					$('#' + options.compareAttribute).valid();
				}
			} catch (e) {
			}
		} else {
			$(element).data("is-compared", false);
		}

		return valid;
	});

	/**
	 * file，对应YII的file
	 */
	$.validator.addMethod("file", function(value, element, options) {

		if (!options || typeof options != 'object') {
			if (this.settings.debug) {
				console.error("无效的file验证器参数！");
			}
			return true;
		}

		var files = getUploadedFiles.call(this, element, options);

		if (files == false) {
			return false;
		}

		var validator = this;
		var valid = true;
		$.each(files, function(i, file) {
			valid = validateFile.call(validator, file, element, options);
			if (valid == false) {
				return false;
			}
		});
		return valid;
	});

	/**
	 * image，对应YII的image
	 */
	$.validator.addMethod("image", function(value, element, options) {

		if (!options) {
			console.error("无效的image验证器参数！");
			return;
		}

		var files = getUploadedFiles.call(this, element, options);

		if (files == false) {
			return false;
		}

		var validator = this;

		var deferreds = deferredArray();

		$.each(files, function(i, file) {
			if (!validateFile.call(validator, file, element, options)) {
				return false;
			}

			// Skip image validation if FileReader API is not available
			if (typeof FileReader === "undefined") {
				return true;
			}

			var def = $.Deferred(), fr = new FileReader(), img = new Image();

			img.onload = function() {
				if (options.minWidth && this.width < options.minWidth) {
					var message = options.underWidth.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}

				if (options.maxWidth && this.width > options.maxWidth) {
					var message = options.overWidth.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}

				if (options.minHeight && this.height < options.minHeight) {
					var message = options.underHeight.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}

				if (options.maxHeight && this.height > options.maxHeight) {
					var message = options.overHeight.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}
				// 成功
				def.resolve(true);
			};

			img.onerror = function() {
				var message = options.notImage.replace(/\{file\}/g, file.name);
				def.resolve(false, message);
			};

			fr.onload = function() {
				img.src = fr.result;
			};

			// Resolve deferred if there was error while reading data
			fr.onerror = function() {
				def.resolve(false, options.message);
			};

			fr.readAsDataURL(file);

			deferreds.push(def);

		});

		if (this.optional(element)) {
			return "dependency-mismatch";
		}

		var previous = this.previousValue(element);

		if (!this.settings.messages[element.name]) {
			this.settings.messages[element.name] = {};
		}

		previous.originalMessage = this.settings.messages[element.name].remote;
		this.settings.messages[element.name].remote = previous.message;

		if (previous.old === value) {
			return previous.valid;
		}

		previous.old = value;
		this.startRequest(element);

		$.when.apply(this, deferreds).always(function(valid, message) {

			var errors, submitted;

			if (valid) {
				submitted = validator.formSubmitted;
				validator.prepareElement(element);
				validator.formSubmitted = submitted;
				validator.successList.push(element);
				delete validator.invalid[element.name];
				validator.showErrors();
			} else {
				errors = {};
				errors[element.name] = previous.message = $.isFunction(message) ? message(value) : message;
				validator.invalid[element.name] = true;
				validator.showErrors(errors);
			}
			previous.valid = valid;
			validator.stopRequest(element, valid);
		})

		return "pending";
	});
	
	/**
	 * video，对应YII的video
	 */
	$.validator.addMethod("video", function(value, element, options) {

		if (!options) {
			console.error("无效的video验证器参数！");
			return;
		}

		var files = getUploadedFiles.call(this, element, options);

		if (files == false) {
			return false;
		}

		var validator = this;

		var deferreds = deferredArray();

		$.each(files, function(i, file) {
			if (!validateFile.call(validator, file, element, options)) {
				return false;
			}

			// Skip image validation if FileReader API is not available
			if (typeof FileReader === "undefined") {
				return true;
			}

			var def = $.Deferred(), fr = new FileReader(), video = document.createElement("VIDEO");

			var windowURL = window.URL || window.webkitURL;

			var url = windowURL.createObjectURL(file);

			video.src = url;
			
			$(video).on("loadedmetadata", function() {
				
				if (options.maxDuration && this.duration > options.maxDuration) {
					var message = options.overDuration.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}
				
				if (options.minDuration && this.duration > options.minDuration) {
					var message = options.underDuration.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}
				
				if (options.minWidth && this.videoWidth < options.minWidth) {
					var message = options.underWidth.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}

				if (options.maxWidth && this.videoWidth > options.maxWidth) {
					var message = options.overWidth.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}

				if (options.minHeight && this.videoHeight < options.minHeight) {
					var message = options.underHeight.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}

				if (options.maxHeight && this.videoHeight > options.maxHeight) {
					var message = options.overHeight.replace(/\{file\}/g, file.name);
					def.resolve(false, message);
					return;
				}
				
				if(options.ratio){
					if ($.isArray(options.ratio) == false) {
						options.ratio = [options.ratio];
					}

					function maxDivisor(m, n) {
						m = parseInt(m);
						n = parseInt(n);

						if (m == 0 && n == 0) {
							return false;
						}
						var min = Math.min(m, n);
						while (min >= 1) {
							if (m % min == 0) {
								if (n % min == 0) {
									return min;
								}
							}
							min -= 1;
						}
						return min;
					}
					
					// 计算显示比例
					var divisor = maxDivisor(this.videoWidth, this.videoHeight);
					var ratio = (this.videoWidth / divisor) + ":" + (this.videoHeight / divisor);

					if (options.ratio && $.inArray(ratio, options.ratio) == -1) {
						var message = options.invalidRatio.replace(/\{file\}/g, file.name);
						message = message.replace(/\{limit\}/g, options.ratio.join("、"));
						def.resolve(false, message);
						return;
					}
				}
				
				// 成功
				def.resolve(true);
			});

			$(video).on("error", function() {
				var message = options.notVideo.replace(/\{file\}/g, file.name);
				def.resolve(false, message);
			});

			deferreds.push(def);

		});

		if (this.optional(element)) {
			return "dependency-mismatch";
		}

		var previous = this.previousValue(element);

		if (!this.settings.messages[element.name]) {
			this.settings.messages[element.name] = {};
		}

		previous.originalMessage = this.settings.messages[element.name].remote;
		this.settings.messages[element.name].remote = previous.message;

		if (previous.old === value) {
			return previous.valid;
		}

		previous.old = value;
		this.startRequest(element);

		$.when.apply(this, deferreds).always(function(valid, message) {

			var errors, submitted;

			if (valid) {
				submitted = validator.formSubmitted;
				validator.prepareElement(element);
				validator.formSubmitted = submitted;
				validator.successList.push(element);
				delete validator.invalid[element.name];
				validator.showErrors();
			} else {
				errors = {};
				errors[element.name] = previous.message = $.isFunction(message) ? message(value) : message;
				validator.invalid[element.name] = true;
				validator.showErrors(errors);
			}
			previous.valid = valid;
			validator.stopRequest(element, valid);
		})

		return "pending";
	});

	function getUploadedFiles(element, options) {
		// Skip validation if File API is not available
		if (typeof File === "undefined") {
			return true;
		}

		var files = $(element).get(0).files;

		if (!files) {
			setMessage.call(this, element, 'file', options.message);
			return false;
		}

		if (files.length === 0) {
			if (!options.skipOnEmpty) {
				setMessage.call(this, element, 'file', options.uploadRequired);
				return false;
			}
		}

		if (options.maxFiles && options.maxFiles < files.length) {
			setMessage.call(this, element, 'file', options.tooMany);
			return false;
		}

		return files;
	}

	function validateFile(file, element, options) {

		if (options.extensions && options.extensions.length > 0) {
			var index, ext;

			index = file.name.lastIndexOf('.');

			if (!~index) {
				ext = '';
			} else {
				ext = file.name.substr(index + 1, file.name.length).toLowerCase();
			}

			if (!~options.extensions.indexOf(ext)) {
				setMessage.call(this, element, 'file', options.wrongExtension.replace(/\{file\}/g, file.name));
				return false;
			}
		}

		if (options.mimeTypes && options.mimeTypes.length > 0) {
			if (!~options.mimeTypes.indexOf(file.type)) {
				setMessage.call(this, element, 'file', options.wrongMimeType.replace(/\{file\}/g, file.name));
				return false;
			}
		}

		if (options.maxSize && options.maxSize < file.size) {
			setMessage.call(this, element, 'file', options.tooBig.replace(/\{file\}/g, file.name));
			return false;
		}

		if (options.minSize && options.minSize > file.size) {
			setMessage.call(this, element, 'file', options.tooSmall.replace(/\{file\}/g, file.name));
			return false;
		}
		return true;
	}

	// 设置消息
	function setMessage(element, method, message) {
		this.settings.messages[element.name][method] = message;
	}

	// 显示错误信息
	function showError(element, method, options, message) {
		this.formatAndAdd(element, {
			method: 'image',
			parameters: options
		});

		this.invalid[element.name] = true;

		$(element).attr("aria-invalid", true);
		if (!this.numberOfInvalids()) {
			// Hide error containers on last error
			this.toHide = this.toHide.add(this.containers);
		}

		var errors = {};
		errors[element.name] = message;
		this.showErrors(errors);
	}

	/**
	 * 添加验证器
	 * 
	 * @param rules
	 *            验证规则的集合
	 * @param attribute
	 *            目前只支持“name”和“id”两种，可以根据“name”或者“id”对表单元素进行绑定验证规则，默认为根据“name”进行绑定验证规则
	 * 
	 */
	$.validator.addRules = function(rules, options) {

		if (typeof rules == 'string') {
			try {
				rules = $.parseJSON(rules);
			} catch (e) {
				rules = eval(rules);
			}
		}

		var defaults = {
			attribute: "name",
			form: undefined
		};

		options = $.extend(defaults, options);

		for (var i = 0; i < rules.length; i++) {
			try {
				var id = rules[i].id;
				var name = rules[i].name;
				var attribute = rules[i].attribute;
				var rule = rules[i].rules;

				var element;

				if (options.mapping) {
					if (options.mapping[attribute] && options.mapping[attribute]['id']) {
						id = options.mapping[attribute]['id'];
					}
					if (options.mapping[attribute] && options.mapping[attribute]['name']) {
						name = options.mapping[attribute]['name'];
					}
				}

				if (options.attribute == 'id') {
					element = "#" + id;
				} else {
					element = "[name='" + name + "']:input";
				}

				if (options.form) {
					element = $(options.form).find(element);
				} else if ($.isFunction($(element).rules)) {
					element = $(element);
				}

				// 自动生成trigger验证器
				if (rule.compare && rule.compare.compareAttribute) {
					$("#" + rule.compare.compareAttribute).data("rule-trigger", element);
				}else if(rule.trigger && rule.trigger.selector){
					$(element).data("rule-trigger", $(rule.trigger.selector));
					continue;
				}
				
				if(rule.when){// 带条件判断的验证
					var data = $(element).data("rule-when") || [];
					data.push(rule);
					$(element).data("rule-when", data);
				}else{// 一般的验证规则
					$(element).rules("add", rule);
				}
			} catch (e) {
				console.error(rules[i]);
			}
		}
	}

	/**
	 * 添加验证器
	 * 
	 * @param rules
	 *            验证规则的集合
	 * @param attribute
	 *            目前只支持“name”和“id”两种，可以根据“name”或者“id”对表单元素进行绑定验证规则，默认为根据“name”进行绑定验证规则
	 * 
	 */
	$.fn.addRule = function(rule) {
		if (typeof rule == 'string') {
			try {
				rule = $.trim(rule);
				rule = $.parseJSON(rule);
			} catch (e) {
				rule = eval(rule);
			}
		}

		var rules = [];

		if ($.isArray(rule)) {
			rules = rule;
		} else {
			rules = [rule];
		}

		for (var i = 0; i < rules.length; i++) {
			$(this).each(function() {
				var rule = rules[i];
				
				// 自动生成trigger验证器
				if (rule.compare && rule.compare.compareAttribute) {
					$("#" + rule.compare.compareAttribute).data("rule-trigger", $(this));
				}else if(rule.trigger && rule.trigger.selector){
					$(this).data("rule-trigger", $(rule.trigger.selector));
					return;
				}
				
				if(rule.when){// 带条件判断的验证
					var data = $(this).data("rule-when") || [];
					data.push(rule);
					$(this).data("rule-when", data);
				}else{// 一般的验证规则
					$(this).rules("add", rule);
				}
			});
		}
	}
})(jQuery);