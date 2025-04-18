// JavaScript Document
/*
 * Lazy Load - jQuery plugin for lazy loading images
 *
 * Copyright (c) 2007-2012 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   http://www.appelsiini.net/projects/lazyload
 *
 * Version:  1.8.0
 *
 */
(function($, window) {
	var $window = $(window);

	$.fn.lazyload = function(options) {
		var elements = this;
		var $container;
		var settings = {
			threshold: 0,
			failure_limit: 0,
			event: "scroll",
			effect: "show",
			container: window,
			default_data_attribute: "original",
			data_attribute: "original",
			skip_invisible: true,
			appear: null,
			load: null,
		};

		function update() {
			var counter = 0;

			elements.each(function() {
				var $this = $(this);
				if (settings.skip_invisible && !$this.is(":visible")) {
					return;
				}
				if ($.abovethetop(this, settings) || $.leftofbegin(this, settings)) {
					/* Nothing. */
				} else if (!$.belowthefold(this, settings) && !$.rightoffold(this, settings)) {
					$this.trigger("appear");
				} else {
					if (++counter > settings.failure_limit) {
						return false;
					}
				}
			});

		}

		if (options) {
			/* Maintain BC for a couple of versions. */
			if (undefined !== options.failurelimit) {
				options.failure_limit = options.failurelimit;
				delete options.failurelimit;
			}
			if (undefined !== options.effectspeed) {
				options.effect_speed = options.effectspeed;
				delete options.effectspeed;
			}

			$.extend(settings, options);
		}

		if ($(elements).filter("[data-original-webp]").length > 0) {
			elements = $(elements).filter("[data-" + settings.data_attribute + "]");
		} else {
			elements = $(elements).filter("[data-" + settings.default_data_attribute + "]");
			settings.data_attribute = settings.default_data_attribute;
		}

		/* Cache container as jQuery as object. */
		$container = (settings.container === undefined || settings.container === window) ? $window : $(settings.container);

		/* Fire one scroll event per scroll. Not one scroll event per image. */
		if (0 === settings.event.indexOf("scroll")) {
			$container.bind(settings.event, function(event) {
				return update();
			});
		}

		this.each(function() {
			var self = this;
			var $self = $(self);

			self.loaded = false;

			/* When appear is triggered load original image. */
			$self.one("appear", function() {
				if (!this.loaded) {
					if (settings.appear) {
						var elements_left = elements.length;
						settings.appear.call(self, elements_left, settings);
					}
					$("<img />").bind("load", function() {

						$self.attr("src", $self.data(settings.data_attribute))[settings.effect](settings.effect_speed);
						self.loaded = true;

						/*
						 * Remove image from array so it is not looped next
						 * time.
						 */
						var temp = $.grep(elements, function(element) {
							return !element.loaded;
						});
						elements = $(temp);

						if (settings.load) {
							var elements_left = elements.length;
							settings.load.call(self, elements_left, settings);
						}

					}).attr("src", $self.data(settings.data_attribute));
				}
			});

			/* When wanted event is triggered load original image */
			/* by triggering appear. */
			if (0 !== settings.event.indexOf("scroll")) {
				$self.bind(settings.event, function(event) {
					if (!self.loaded) {
						$self.trigger("appear");
					}
				});
			}
		});

		/* Check if something appears when window is resized. */
		$window.bind("resize", function(event) {
			update();
		});

		/* Force initial check if images should appear. */
		update();

		return this;
	};

	/* Convenience methods in jQuery namespace. */
	/* Use as $.belowthefold(element, {threshold : 100, container : window}) */

	$.belowthefold = function(element, settings) {
		var fold;

		if (settings.container === undefined || settings.container === window) {
			fold = $window.height() + $window.scrollTop();
		} else {
			fold = $(settings.container).offset().top + $(settings.container).height();
		}

		return fold <= $(element).offset().top - settings.threshold;
	};

	$.rightoffold = function(element, settings) {
		var fold;

		if (settings.container === undefined || settings.container === window) {
			fold = $window.width() + $window.scrollLeft();
		} else {
			fold = $(settings.container).offset().left + $(settings.container).width();
		}

		return fold <= $(element).offset().left - settings.threshold;
	};

	$.abovethetop = function(element, settings) {
		var fold;

		if (settings.container === undefined || settings.container === window) {
			fold = $window.scrollTop();
		} else {
			fold = $(settings.container).offset().top;
		}

		return fold >= $(element).offset().top + settings.threshold + $(element).height();
	};

	$.leftofbegin = function(element, settings) {
		var fold;

		if (settings.container === undefined || settings.container === window) {
			fold = $window.scrollLeft();
		} else {
			fold = $(settings.container).offset().left;
		}

		return fold >= $(element).offset().left + settings.threshold + $(element).width();
	};

	$.inviewport = function(element, settings) {
		return !$.rightofscreen(element, settings) && !$.leftofscreen(element, settings) && !$.belowthefold(element, settings) && !$.abovethetop(element, settings);
	};

	/* Custom selectors for your convenience. */
	/* Use as $("img:below-the-fold").something() */

	$.extend($.expr[':'], {
		"below-the-fold": function(a) {
			return $.belowthefold(a, {
				threshold: 0
			});
		},
		"above-the-top": function(a) {
			return !$.belowthefold(a, {
				threshold: 0
			});
		},
		"right-of-screen": function(a) {
			return $.rightoffold(a, {
				threshold: 0
			});
		},
		"left-of-screen": function(a) {
			return !$.rightoffold(a, {
				threshold: 0
			});
		},
		"in-viewport": function(a) {
			return !$.inviewport(a, {
				threshold: 0
			});
		},
		/* Maintain BC for couple of versions. */
		"above-the-fold": function(a) {
			return !$.belowthefold(a, {
				threshold: 0
			});
		},
		"right-of-fold": function(a) {
			return $.rightoffold(a, {
				threshold: 0
			});
		},
		"left-of-fold": function(a) {
			return !$.rightoffold(a, {
				threshold: 0
			});
		}
	});

	// 图片缓载
	$.imgloading = {
		settings: {
			threshold: 200,
			failure_limit: 100,
			skip_invisible: false,
			effect: 'fadeIn',
			data_attribute: ($("meta[name='is_webp']").length > 0 && $("meta[name='is_webp']").attr('content') == 'yes' && iswebp()) ? "original-webp" : "original",
		},
		setting: function(settings) {
			$.imgloading.settings = $.extend(true, {}, $.imgloading.settings, settings);
		},

		loading: function() {
			var settings = $.imgloading.settings;
			$("img.lazy").lazyload({
				skip_invisible: settings.skip_invisible,
				effect: settings.effect,
				failure_limit: settings.failure_limit,
				threshold: settings.threshold,
				data_attribute: settings.data_attribute,
				load: function() {
					$(this).removeClass('lazy');
					// 删除背景图片
					$(this).parents('.SZY-PIC-BG').eq(0).css("background", "");
					if ($(this).hasClass('square')) {
						if ($(this).height() != $(this).width()) {
							$(this).height($(this).width());
						} else {
							$(this).removeClass('square');
						}
					}
				}
			});
		}
	};

	function iswebp() {
		try {
			return(document.createElement('canvas').toDataURL('image/webp').indexOf('data:image/webp') == 0);
		} catch (err) {
			return false;
		}
	}
})(jQuery, window);