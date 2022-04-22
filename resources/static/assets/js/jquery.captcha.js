/**
 * 在YII2基础上进行的修改
 * 
 * @author niqingyang <niqy@qq.com>
 */
(function($) {
	$.fn.captcha = function(method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.niiCaptcha');
			return false;
		}
	};

	var defaults = {
		refreshUrl: undefined,
		hashKey: undefined
	};

	// 防止频繁提交访问的限制
	var is_done = true;

	var methods = {
		init: function(options) {
			return this.each(function() {
				var $e = $(this);
				var settings = $.extend({}, defaults, options || {});
				$e.data('niiCaptcha', {
					settings: settings
				});

				$e.on('click.niiCaptcha', function() {
					// 判断是否已经处理完，防止重复提交
					if (is_done) {
						methods.refresh.apply($e);
					}
					return false;
				});

			});
		},

		refresh: function() {
			// 标识出未处理完
			is_done = false;
			var $e = this;
			var settings = this.data('niiCaptcha').settings;
			$.ajax({
				url: $e.data('niiCaptcha').settings.refreshUrl,
				dataType: 'json',
				cache: false,
				success: function(data) {
					$e.attr('src', data.url);
					$('body').data(settings.hashKey, [data.hash1, data.hash2]);
					// 标识已处理完
					is_done = true;
				}
			});
		},

		destroy: function() {
			return this.each(function() {
				$(window).unbind('.niiCaptcha');
				$(this).removeData('niiCaptcha');
			});
		},

		data: function() {
			return this.data('niiCaptcha');
		}
	};
})(window.jQuery);
$().ready(function() {

	$("body").on('click', ".captcha-image", function() {
		if ($(this).data("init") == true) {
			return;
		}

		var id = $(this).attr("id");

		var options = [];

		if ($("[data-captcha-id='" + id + "']").size > 0) {
			options = $("[data-captcha-id='" + id + "']").html();
		} else if ($(this).siblings("script").size() > 0) {
			options = $("[data-captcha-id='" + id + "']").html();
		}

		if (options && options.length > 0) {
			options = $.parseJSON(options);
		}

		$(this).captcha(options);

		$(this).data("init", true);
		
		$(this).click();
	});
});