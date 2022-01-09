/*! jQuery UI - v1.12.0-beta.1 - 2016-02-17
 * http://jqueryui.com
 * Includes: widget.js, position.js, data.js, disable-selection.js, focusable.js, form-reset-mixin.js, jquery-1-7.js, keycode.js, labels.js, scroll-parent.js, tabbable.js, unique-id.js, widgets/draggable.js, widgets/resizable.js, widgets/accordion.js, widgets/autocomplete.js, widgets/button.js, widgets/checkboxradio.js, widgets/controlgroup.js, widgets/dialog.js, widgets/menu.js, widgets/mouse.js, widgets/progressbar.js, widgets/slider.js, widgets/spinner.js
 * Copyright jQuery Foundation and other contributors; Licensed MIT */

(function(factory) {
	if (typeof define === "function" && define.amd) {

		// AMD. Register as an anonymous module.
		define(["jquery"], factory);
	} else {

		// Browser globals
		factory(jQuery);
	}
}(function($) {

	$.ui = $.ui || {};

	var version = $.ui.version = "1.12.0-beta.1";

	/*
	 * ! jQuery UI Widget 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Widget
	// >>group: Core
	// >>description: Provides a factory for creating stateful widgets with a
	// common API.
	// >>docs: http://api.jqueryui.com/jQuery.widget/
	// >>demos: http://jqueryui.com/widget/
	var widgetUuid = 0;
	var widgetSlice = Array.prototype.slice;

	$.cleanData = (function(orig) {
		return function(elems) {
			var events, elem, i;
			for (i = 0; (elem = elems[i]) != null; i++) {
				try {

					// Only trigger remove when necessary to save time
					events = $._data(elem, "events");
					if (events && events.remove) {
						$(elem).triggerHandler("remove");
					}

					// Http://bugs.jquery.com/ticket/8235
				} catch (e) {
				}
			}
			orig(elems);
		};
	})($.cleanData);

	$.widget = function(name, base, prototype) {
		var existingConstructor, constructor, basePrototype;

		// ProxiedPrototype allows the provided prototype to remain unmodified
		// so that it can be used as a mixin for multiple widgets (#8876)
		var proxiedPrototype = {};

		var namespace = name.split(".")[0];
		name = name.split(".")[1];
		var fullName = namespace + "-" + name;

		if (!prototype) {
			prototype = base;
			base = $.Widget;
		}

		if ($.isArray(prototype)) {
			prototype = $.extend.apply(null, [{}].concat(prototype));
		}

		// Create selector for plugin
		$.expr[":"][fullName.toLowerCase()] = function(elem) {
			return !!$.data(elem, fullName);
		};

		$[namespace] = $[namespace] || {};
		existingConstructor = $[namespace][name];
		constructor = $[namespace][name] = function(options, element) {

			// Allow instantiation without "new" keyword
			if (!this._createWidget) {
				return new constructor(options, element);
			}

			// Allow instantiation without initializing for simple inheritance
			// must use "new" keyword (the code above always passes args)
			if (arguments.length) {
				this._createWidget(options, element);
			}
		};

		// Extend with the existing constructor to carry over any static
		// properties
		$.extend(constructor, existingConstructor, {
			version: prototype.version,

			// Copy the object used to create the prototype in case we need to
			// redefine the widget later
			_proto: $.extend({}, prototype),

			// Track widgets that inherit from this widget in case this widget
			// is
			// redefined after a widget inherits from it
			_childConstructors: []
		});

		basePrototype = new base();

		// We need to make the options hash a property directly on the new
		// instance
		// otherwise we'll modify the options hash on the prototype that we're
		// inheriting from
		basePrototype.options = $.widget.extend({}, basePrototype.options);
		$.each(prototype, function(prop, value) {
			if (!$.isFunction(value)) {
				proxiedPrototype[prop] = value;
				return;
			}
			proxiedPrototype[prop] = (function() {
				function _super() {
					return base.prototype[prop].apply(this, arguments);
				}

				function _superApply(args) {
					return base.prototype[prop].apply(this, args);
				}

				return function() {
					var __super = this._super;
					var __superApply = this._superApply;
					var returnValue;

					this._super = _super;
					this._superApply = _superApply;

					returnValue = value.apply(this, arguments);

					this._super = __super;
					this._superApply = __superApply;

					return returnValue;
				};
			})();
		});
		constructor.prototype = $.widget.extend(basePrototype, {

			// TODO: remove support for widgetEventPrefix
			// always use the name + a colon as the prefix, e.g.,
			// draggable:start
			// don't prefix for widgets that aren't DOM-based
			widgetEventPrefix: existingConstructor ? (basePrototype.widgetEventPrefix || name) : name
		}, proxiedPrototype, {
			constructor: constructor,
			namespace: namespace,
			widgetName: name,
			widgetFullName: fullName
		});

		// If this widget is being redefined then we need to find all widgets
		// that
		// are inheriting from it and redefine all of them so that they inherit
		// from
		// the new version of this widget. We're essentially trying to replace
		// one
		// level in the prototype chain.
		if (existingConstructor) {
			$.each(existingConstructor._childConstructors, function(i, child) {
				var childPrototype = child.prototype;

				// Redefine the child widget using the same prototype that was
				// originally used, but inherit from the new version of the base
				$.widget(childPrototype.namespace + "." + childPrototype.widgetName, constructor, child._proto);
			});

			// Remove the list of existing child constructors from the old
			// constructor
			// so the old child constructors can be garbage collected
			delete existingConstructor._childConstructors;
		} else {
			base._childConstructors.push(constructor);
		}

		$.widget.bridge(name, constructor);

		return constructor;
	};

	$.widget.extend = function(target) {
		var input = widgetSlice.call(arguments, 1);
		var inputIndex = 0;
		var inputLength = input.length;
		var key;
		var value;

		for (; inputIndex < inputLength; inputIndex++) {
			for (key in input[inputIndex]) {
				value = input[inputIndex][key];
				if (input[inputIndex].hasOwnProperty(key) && value !== undefined) {

					// Clone objects
					if ($.isPlainObject(value)) {
						target[key] = $.isPlainObject(target[key]) ? $.widget.extend({}, target[key], value) :

						// Don't extend strings, arrays, etc. with objects
						$.widget.extend({}, value);

						// Copy everything else by reference
					} else {
						target[key] = value;
					}
				}
			}
		}
		return target;
	};

	$.widget.bridge = function(name, object) {
		var fullName = object.prototype.widgetFullName || name;
		$.fn[name] = function(options) {
			var isMethodCall = typeof options === "string";
			var args = widgetSlice.call(arguments, 1);
			var returnValue = this;

			if (isMethodCall) {
				this.each(function() {
					var methodValue;
					var instance = $.data(this, fullName);

					if (options === "instance") {
						returnValue = instance;
						return false;
					}

					if (!instance) {
						return $.error("cannot call methods on " + name + " prior to initialization; " + "attempted to call method '" + options + "'");
					}

					if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
						return $.error("no such method '" + options + "' for " + name + " widget instance");
					}

					methodValue = instance[options].apply(instance, args);

					if (methodValue !== instance && methodValue !== undefined) {
						returnValue = methodValue && methodValue.jquery ? returnValue.pushStack(methodValue.get()) : methodValue;
						return false;
					}
				});
			} else {

				// Allow multiple hashes to be passed on init
				if (args.length) {
					options = $.widget.extend.apply(null, [options].concat(args));
				}

				this.each(function() {
					var instance = $.data(this, fullName);
					if (instance) {
						instance.option(options || {});
						if (instance._init) {
							instance._init();
						}
					} else {
						$.data(this, fullName, new object(options, this));
					}
				});
			}

			return returnValue;
		};
	};

	$.Widget = function( /* options, element */) {
	};
	$.Widget._childConstructors = [];

	$.Widget.prototype = {
		widgetName: "widget",
		widgetEventPrefix: "",
		defaultElement: "<div>",

		options: {
			classes: {},
			disabled: false,

			// Callbacks
			create: null
		},

		_createWidget: function(options, element) {
			element = $(element || this.defaultElement || this)[0];
			this.element = $(element);
			this.uuid = widgetUuid++;
			this.eventNamespace = "." + this.widgetName + this.uuid;

			this.bindings = $();
			this.hoverable = $();
			this.focusable = $();
			this.classesElementLookup = {};

			if (element !== this) {
				$.data(element, this.widgetFullName, this);
				this._on(true, this.element, {
					remove: function(event) {
						if (event.target === element) {
							this.destroy();
						}
					}
				});
				this.document = $(element.style ?

				// Element within the document
				element.ownerDocument :

				// Element is window or document
				element.document || element);
				this.window = $(this.document[0].defaultView || this.document[0].parentWindow);
			}

			this.options = $.widget.extend({}, this.options, this._getCreateOptions(), options);

			this._create();

			if (this.options.disabled) {
				this._setOptionDisabled(this.options.disabled);
			}

			this._trigger("create", null, this._getCreateEventData());
			this._init();
		},

		_getCreateOptions: function() {
			return {};
		},

		_getCreateEventData: $.noop,

		_create: $.noop,

		_init: $.noop,

		destroy: function() {
			var that = this;

			this._destroy();
			$.each(this.classesElementLookup, function(key, value) {
				that._removeClass(value, key);
			});

			// We can probably remove the unbind calls in 2.0
			// all event bindings should go through this._on()
			this.element.off(this.eventNamespace).removeData(this.widgetFullName);
			this.widget().off(this.eventNamespace).removeAttr("aria-disabled");

			// Clean up events and states
			this.bindings.off(this.eventNamespace);
		},

		_destroy: $.noop,

		widget: function() {
			return this.element;
		},

		option: function(key, value) {
			var options = key;
			var parts;
			var curOption;
			var i;

			if (arguments.length === 0) {

				// Don't return a reference to the internal hash
				return $.widget.extend({}, this.options);
			}

			if (typeof key === "string") {

				// Handle nested keys, e.g., "foo.bar" => { foo: { bar: ___ } }
				options = {};
				parts = key.split(".");
				key = parts.shift();
				if (parts.length) {
					curOption = options[key] = $.widget.extend({}, this.options[key]);
					for (i = 0; i < parts.length - 1; i++) {
						curOption[parts[i]] = curOption[parts[i]] || {};
						curOption = curOption[parts[i]];
					}
					key = parts.pop();
					if (arguments.length === 1) {
						return curOption[key] === undefined ? null : curOption[key];
					}
					curOption[key] = value;
				} else {
					if (arguments.length === 1) {
						return this.options[key] === undefined ? null : this.options[key];
					}
					options[key] = value;
				}
			}

			this._setOptions(options);

			return this;
		},

		_setOptions: function(options) {
			var key;

			for (key in options) {
				this._setOption(key, options[key]);
			}

			return this;
		},

		_setOption: function(key, value) {
			if (key === "classes") {
				this._setOptionClasses(value);
			}

			this.options[key] = value;

			if (key === "disabled") {
				this._setOptionDisabled(value);
			}

			return this;
		},

		_setOptionClasses: function(value) {
			var classKey, elements, currentElements;

			for (classKey in value) {
				currentElements = this.classesElementLookup[classKey];
				if (value[classKey] === this.options.classes[classKey] || !currentElements || !currentElements.length) {
					continue;
				}

				// We are doing this to create a new jQuery object because the
				// _removeClass() call
				// on the next line is going to destroy the reference to the
				// current elements being
				// tracked. We need to save a copy of this collection so that we
				// can add the new classes
				// below.
				elements = $(currentElements.get());
				this._removeClass(currentElements, classKey);

				// We don't use _addClass() here, because that uses
				// this.options.classes
				// for generating the string of classes. We want to use the
				// value passed in from
				// _setOption(), this is the new value of the classes option
				// which was passed to
				// _setOption(). We pass this value directly to _classes().
				elements.addClass(this._classes({
					element: elements,
					keys: classKey,
					classes: value,
					add: true
				}));
			}
		},

		_setOptionDisabled: function(value) {
			this._toggleClass(this.widget(), this.widgetFullName + "-disabled", null, !!value);

			// If the widget is becoming disabled, then nothing is interactive
			if (value) {
				this._removeClass(this.hoverable, null, "ui-state-hover");
				this._removeClass(this.focusable, null, "ui-state-focus");
			}
		},

		enable: function() {
			return this._setOptions({
				disabled: false
			});
		},

		disable: function() {
			return this._setOptions({
				disabled: true
			});
		},

		_classes: function(options) {
			var full = [];
			var that = this;

			options = $.extend({
				element: this.element,
				classes: this.options.classes || {}
			}, options);

			function processClassString(classes, checkOption) {
				var current, i;
				for (i = 0; i < classes.length; i++) {
					current = that.classesElementLookup[classes[i]] || $();
					if (options.add) {
						current = $($.unique(current.get().concat(options.element.get())));
					} else {
						current = $(current.not(options.element).get());
					}
					that.classesElementLookup[classes[i]] = current;
					full.push(classes[i]);
					if (checkOption && options.classes[classes[i]]) {
						full.push(options.classes[classes[i]]);
					}
				}
			}

			if (options.keys) {
				processClassString(options.keys.match(/\S+/g) || [], true);
			}
			if (options.extra) {
				processClassString(options.extra.match(/\S+/g) || []);
			}

			return full.join(" ");
		},

		_removeClass: function(element, keys, extra) {
			return this._toggleClass(element, keys, extra, false);
		},

		_addClass: function(element, keys, extra) {
			return this._toggleClass(element, keys, extra, true);
		},

		_toggleClass: function(element, keys, extra, add) {
			add = (typeof add === "boolean") ? add : extra;
			var shift = (typeof element === "string" || element === null), options = {
				extra: shift ? keys : extra,
				keys: shift ? element : keys,
				element: shift ? this.element : element,
				add: add
			};
			options.element.toggleClass(this._classes(options), add);
			return this;
		},

		_on: function(suppressDisabledCheck, element, handlers) {
			var delegateElement;
			var instance = this;

			// No suppressDisabledCheck flag, shuffle arguments
			if (typeof suppressDisabledCheck !== "boolean") {
				handlers = element;
				element = suppressDisabledCheck;
				suppressDisabledCheck = false;
			}

			// No element argument, shuffle and use this.element
			if (!handlers) {
				handlers = element;
				element = this.element;
				delegateElement = this.widget();
			} else {
				element = delegateElement = $(element);
				this.bindings = this.bindings.add(element);
			}

			$.each(handlers, function(event, handler) {
				function handlerProxy() {

					// Allow widgets to customize the disabled handling
					// - disabled as an array instead of boolean
					// - disabled class as method for disabling individual parts
					if (!suppressDisabledCheck && (instance.options.disabled === true || $(this).hasClass("ui-state-disabled"))) {
						return;
					}
					return (typeof handler === "string" ? instance[handler] : handler).apply(instance, arguments);
				}

				// Copy the guid so direct unbinding works
				if (typeof handler !== "string") {
					handlerProxy.guid = handler.guid = handler.guid || handlerProxy.guid || $.guid++;
				}

				var match = event.match(/^([\w:-]*)\s*(.*)$/);
				var eventName = match[1] + instance.eventNamespace;
				var selector = match[2];

				if (selector) {
					delegateElement.on(eventName, selector, handlerProxy);
				} else {
					element.on(eventName, handlerProxy);
				}
			});
		},

		_off: function(element, eventName) {
			eventName = (eventName || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace;
			element.off(eventName).off(eventName);

			// Clear the stack to avoid memory leaks (#10056)
			this.bindings = $(this.bindings.not(element).get());
			this.focusable = $(this.focusable.not(element).get());
			this.hoverable = $(this.hoverable.not(element).get());
		},

		_delay: function(handler, delay) {
			function handlerProxy() {
				return (typeof handler === "string" ? instance[handler] : handler).apply(instance, arguments);
			}
			var instance = this;
			return setTimeout(handlerProxy, delay || 0);
		},

		_hoverable: function(element) {
			this.hoverable = this.hoverable.add(element);
			this._on(element, {
				mouseenter: function(event) {
					this._addClass($(event.currentTarget), null, "ui-state-hover");
				},
				mouseleave: function(event) {
					this._removeClass($(event.currentTarget), null, "ui-state-hover");
				}
			});
		},

		_focusable: function(element) {
			this.focusable = this.focusable.add(element);
			this._on(element, {
				focusin: function(event) {
					this._addClass($(event.currentTarget), null, "ui-state-focus");
				},
				focusout: function(event) {
					this._removeClass($(event.currentTarget), null, "ui-state-focus");
				}
			});
		},

		_trigger: function(type, event, data) {
			var prop, orig;
			var callback = this.options[type];

			data = data || {};
			event = $.Event(event);
			event.type = (type === this.widgetEventPrefix ? type : this.widgetEventPrefix + type).toLowerCase();

			// The original event may come from any element
			// so we need to reset the target on the new event
			event.target = this.element[0];

			// Copy original event properties over to the new event
			orig = event.originalEvent;
			if (orig) {
				for (prop in orig) {
					if (!(prop in event)) {
						event[prop] = orig[prop];
					}
				}
			}

			this.element.trigger(event, data);
			return !($.isFunction(callback) && callback.apply(this.element[0], [event].concat(data)) === false || event.isDefaultPrevented());
		}
	};

	$.each({
		show: "fadeIn",
		hide: "fadeOut"
	}, function(method, defaultEffect) {
		$.Widget.prototype["_" + method] = function(element, options, callback) {
			if (typeof options === "string") {
				options = {
					effect: options
				};
			}

			var hasOptions;
			var effectName = !options ? method : options === true || typeof options === "number" ? defaultEffect : options.effect || defaultEffect;

			options = options || {};
			if (typeof options === "number") {
				options = {
					duration: options
				};
			}

			hasOptions = !$.isEmptyObject(options);
			options.complete = callback;

			if (options.delay) {
				element.delay(options.delay);
			}

			if (hasOptions && $.effects && $.effects.effect[effectName]) {
				element[method](options);
			} else if (effectName !== method && element[effectName]) {
				element[effectName](options.duration, options.easing, callback);
			} else {
				element.queue(function(next) {
					$(this)[method]();
					if (callback) {
						callback.call(element[0]);
					}
					next();
				});
			}
		};
	});

	var widget = $.widget;

	/*
	 * ! jQuery UI Position 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 * 
	 * http://api.jqueryui.com/position/
	 */

	// >>label: Position
	// >>group: Core
	// >>description: Positions elements relative to other elements.
	// >>docs: http://api.jqueryui.com/position/
	// >>demos: http://jqueryui.com/position/
	(function() {
		var cachedScrollbarWidth, supportsOffsetFractions, max = Math.max, abs = Math.abs, round = Math.round, rhorizontal = /left|center|right/, rvertical = /top|center|bottom/, roffset = /[\+\-]\d+(\.[\d]+)?%?/, rposition = /^\w+/, rpercent = /%$/, _position = $.fn.position;

		// Support: IE <=9 only
		supportsOffsetFractions = function() {
			var element = $("<div>").css("position", "absolute").appendTo("body").offset({
				top: 1.5,
				left: 1.5
			}), support = element.offset().top === 1.5;

			element.remove();

			supportsOffsetFractions = function() {
				return support;
			};

			return support;
		};

		function getOffsets(offsets, width, height) {
			return [parseFloat(offsets[0]) * (rpercent.test(offsets[0]) ? width / 100 : 1), parseFloat(offsets[1]) * (rpercent.test(offsets[1]) ? height / 100 : 1)];
		}

		function parseCss(element, property) {
			return parseInt($.css(element, property), 10) || 0;
		}

		function getDimensions(elem) {
			var raw = elem[0];
			if (raw.nodeType === 9) {
				return {
					width: elem.width(),
					height: elem.height(),
					offset: {
						top: 0,
						left: 0
					}
				};
			}
			if ($.isWindow(raw)) {
				return {
					width: elem.width(),
					height: elem.height(),
					offset: {
						top: elem.scrollTop(),
						left: elem.scrollLeft()
					}
				};
			}
			if (raw.preventDefault) {
				return {
					width: 0,
					height: 0,
					offset: {
						top: raw.pageY,
						left: raw.pageX
					}
				};
			}
			return {
				width: elem.outerWidth(),
				height: elem.outerHeight(),
				offset: elem.offset()
			};
		}

		$.position = {
			scrollbarWidth: function() {
				if (cachedScrollbarWidth !== undefined) {
					return cachedScrollbarWidth;
				}
				var w1, w2, div = $("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"), innerDiv = div.children()[0];

				$("body").append(div);
				w1 = innerDiv.offsetWidth;
				div.css("overflow", "scroll");

				w2 = innerDiv.offsetWidth;

				if (w1 === w2) {
					w2 = div[0].clientWidth;
				}

				div.remove();

				return(cachedScrollbarWidth = w1 - w2);
			},
			getScrollInfo: function(within) {
				var overflowX = within.isWindow || within.isDocument ? "" : within.element.css("overflow-x"), overflowY = within.isWindow || within.isDocument ? "" : within.element.css("overflow-y"), hasOverflowX = overflowX === "scroll" || (overflowX === "auto" && within.width < within.element[0].scrollWidth), hasOverflowY = overflowY === "scroll" || (overflowY === "auto" && within.height < within.element[0].scrollHeight);
				return {
					width: hasOverflowY ? $.position.scrollbarWidth() : 0,
					height: hasOverflowX ? $.position.scrollbarWidth() : 0
				};
			},
			getWithinInfo: function(element) {
				var withinElement = $(element || window), isWindow = $.isWindow(withinElement[0]), isDocument = !!withinElement[0] && withinElement[0].nodeType === 9, hasOffset = !isWindow && !isDocument;
				return {
					element: withinElement,
					isWindow: isWindow,
					isDocument: isDocument,
					offset: hasOffset ? $(element).offset() : {
						left: 0,
						top: 0
					},
					scrollLeft: withinElement.scrollLeft(),
					scrollTop: withinElement.scrollTop(),
					width: withinElement.outerWidth(),
					height: withinElement.outerHeight()
				};
			}
		};

		$.fn.position = function(options) {
			if (!options || !options.of) {
				return _position.apply(this, arguments);
			}

			// Make a copy, we don't want to modify arguments
			options = $.extend({}, options);

			var atOffset, targetWidth, targetHeight, targetOffset, basePosition, dimensions, target = $(options.of), within = $.position.getWithinInfo(options.within), scrollInfo = $.position.getScrollInfo(within), collision = (options.collision || "flip").split(" "), offsets = {};

			dimensions = getDimensions(target);
			if (target[0].preventDefault) {

				// Force left top to allow flipping
				options.at = "left top";
			}
			targetWidth = dimensions.width;
			targetHeight = dimensions.height;
			targetOffset = dimensions.offset;

			// Clone to reuse original targetOffset later
			basePosition = $.extend({}, targetOffset);

			// Force my and at to have valid horizontal and vertical positions
			// if a value is missing or invalid, it will be converted to center
			$.each(["my", "at"], function() {
				var pos = (options[this] || "").split(" "), horizontalOffset, verticalOffset;

				if (pos.length === 1) {
					pos = rhorizontal.test(pos[0]) ? pos.concat(["center"]) : rvertical.test(pos[0]) ? ["center"].concat(pos) : ["center", "center"];
				}
				pos[0] = rhorizontal.test(pos[0]) ? pos[0] : "center";
				pos[1] = rvertical.test(pos[1]) ? pos[1] : "center";

				// Calculate offsets
				horizontalOffset = roffset.exec(pos[0]);
				verticalOffset = roffset.exec(pos[1]);
				offsets[this] = [horizontalOffset ? horizontalOffset[0] : 0, verticalOffset ? verticalOffset[0] : 0];

				// Reduce to just the positions without the offsets
				options[this] = [rposition.exec(pos[0])[0], rposition.exec(pos[1])[0]];
			});

			// Normalize collision option
			if (collision.length === 1) {
				collision[1] = collision[0];
			}

			if (options.at[0] === "right") {
				basePosition.left += targetWidth;
			} else if (options.at[0] === "center") {
				basePosition.left += targetWidth / 2;
			}

			if (options.at[1] === "bottom") {
				basePosition.top += targetHeight;
			} else if (options.at[1] === "center") {
				basePosition.top += targetHeight / 2;
			}

			atOffset = getOffsets(offsets.at, targetWidth, targetHeight);
			basePosition.left += atOffset[0];
			basePosition.top += atOffset[1];

			return this.each(function() {
				var collisionPosition, using, elem = $(this), elemWidth = elem.outerWidth(), elemHeight = elem.outerHeight(), marginLeft = parseCss(this, "marginLeft"), marginTop = parseCss(this, "marginTop"), collisionWidth = elemWidth + marginLeft + parseCss(this, "marginRight") + scrollInfo.width, collisionHeight = elemHeight + marginTop + parseCss(this, "marginBottom") + scrollInfo.height, position = $.extend({}, basePosition), myOffset = getOffsets(offsets.my, elem.outerWidth(), elem.outerHeight());

				if (options.my[0] === "right") {
					position.left -= elemWidth;
				} else if (options.my[0] === "center") {
					position.left -= elemWidth / 2;
				}

				if (options.my[1] === "bottom") {
					position.top -= elemHeight;
				} else if (options.my[1] === "center") {
					position.top -= elemHeight / 2;
				}

				position.left += myOffset[0];
				position.top += myOffset[1];

				// If the browser doesn't support fractions, then round for
				// consistent results
				if (!supportsOffsetFractions()) {
					position.left = round(position.left);
					position.top = round(position.top);
				}

				collisionPosition = {
					marginLeft: marginLeft,
					marginTop: marginTop
				};

				$.each(["left", "top"], function(i, dir) {
					if ($.ui.position[collision[i]]) {
						$.ui.position[collision[i]][dir](position, {
							targetWidth: targetWidth,
							targetHeight: targetHeight,
							elemWidth: elemWidth,
							elemHeight: elemHeight,
							collisionPosition: collisionPosition,
							collisionWidth: collisionWidth,
							collisionHeight: collisionHeight,
							offset: [atOffset[0] + myOffset[0], atOffset[1] + myOffset[1]],
							my: options.my,
							at: options.at,
							within: within,
							elem: elem
						});
					}
				});

				if (options.using) {

					// Adds feedback as second argument to using callback, if
					// present
					using = function(props) {
						var left = targetOffset.left - position.left, right = left + targetWidth - elemWidth, top = targetOffset.top - position.top, bottom = top + targetHeight - elemHeight, feedback = {
							target: {
								element: target,
								left: targetOffset.left,
								top: targetOffset.top,
								width: targetWidth,
								height: targetHeight
							},
							element: {
								element: elem,
								left: position.left,
								top: position.top,
								width: elemWidth,
								height: elemHeight
							},
							horizontal: right < 0 ? "left" : left > 0 ? "right" : "center",
							vertical: bottom < 0 ? "top" : top > 0 ? "bottom" : "middle"
						};
						if (targetWidth < elemWidth && abs(left + right) < targetWidth) {
							feedback.horizontal = "center";
						}
						if (targetHeight < elemHeight && abs(top + bottom) < targetHeight) {
							feedback.vertical = "middle";
						}
						if (max(abs(left), abs(right)) > max(abs(top), abs(bottom))) {
							feedback.important = "horizontal";
						} else {
							feedback.important = "vertical";
						}
						options.using.call(this, props, feedback);
					};
				}

				elem.offset($.extend(position, {
					using: using
				}));
			});
		};

		$.ui.position = {
			fit: {
				left: function(position, data) {
					var within = data.within, withinOffset = within.isWindow ? within.scrollLeft : within.offset.left, outerWidth = within.width, collisionPosLeft = position.left - data.collisionPosition.marginLeft, overLeft = withinOffset - collisionPosLeft, overRight = collisionPosLeft + data.collisionWidth - outerWidth - withinOffset, newOverRight;

					// Element is wider than within
					if (data.collisionWidth > outerWidth) {

						// Element is initially over the left side of within
						if (overLeft > 0 && overRight <= 0) {
							newOverRight = position.left + overLeft + data.collisionWidth - outerWidth - withinOffset;
							position.left += overLeft - newOverRight;

							// Element is initially over right side of within
						} else if (overRight > 0 && overLeft <= 0) {
							position.left = withinOffset;

							// Element is initially over both left and right
							// sides of within
						} else {
							if (overLeft > overRight) {
								position.left = withinOffset + outerWidth - data.collisionWidth;
							} else {
								position.left = withinOffset;
							}
						}

						// Too far left -> align with left edge
					} else if (overLeft > 0) {
						position.left += overLeft;

						// Too far right -> align with right edge
					} else if (overRight > 0) {
						position.left -= overRight;

						// Adjust based on position and margin
					} else {
						position.left = max(position.left - collisionPosLeft, position.left);
					}
				},
				top: function(position, data) {
					var within = data.within, withinOffset = within.isWindow ? within.scrollTop : within.offset.top, outerHeight = data.within.height, collisionPosTop = position.top - data.collisionPosition.marginTop, overTop = withinOffset - collisionPosTop, overBottom = collisionPosTop + data.collisionHeight - outerHeight - withinOffset, newOverBottom;

					// Element is taller than within
					if (data.collisionHeight > outerHeight) {

						// Element is initially over the top of within
						if (overTop > 0 && overBottom <= 0) {
							newOverBottom = position.top + overTop + data.collisionHeight - outerHeight - withinOffset;
							position.top += overTop - newOverBottom;

							// Element is initially over bottom of within
						} else if (overBottom > 0 && overTop <= 0) {
							position.top = withinOffset;

							// Element is initially over both top and bottom of
							// within
						} else {
							if (overTop > overBottom) {
								position.top = withinOffset + outerHeight - data.collisionHeight;
							} else {
								position.top = withinOffset;
							}
						}

						// Too far up -> align with top
					} else if (overTop > 0) {
						position.top += overTop;

						// Too far down -> align with bottom edge
					} else if (overBottom > 0) {
						position.top -= overBottom;

						// Adjust based on position and margin
					} else {
						position.top = max(position.top - collisionPosTop, position.top);
					}
				}
			},
			flip: {
				left: function(position, data) {
					var within = data.within, withinOffset = within.offset.left + within.scrollLeft, outerWidth = within.width, offsetLeft = within.isWindow ? within.scrollLeft : within.offset.left, collisionPosLeft = position.left - data.collisionPosition.marginLeft, overLeft = collisionPosLeft - offsetLeft, overRight = collisionPosLeft + data.collisionWidth - outerWidth - offsetLeft, myOffset = data.my[0] === "left" ? -data.elemWidth : data.my[0] === "right" ? data.elemWidth : 0, atOffset = data.at[0] === "left" ? data.targetWidth : data.at[0] === "right" ? -data.targetWidth : 0, offset = -2 * data.offset[0], newOverRight, newOverLeft;

					if (overLeft < 0) {
						newOverRight = position.left + myOffset + atOffset + offset + data.collisionWidth - outerWidth - withinOffset;
						if (newOverRight < 0 || newOverRight < abs(overLeft)) {
							position.left += myOffset + atOffset + offset;
						}
					} else if (overRight > 0) {
						newOverLeft = position.left - data.collisionPosition.marginLeft + myOffset + atOffset + offset - offsetLeft;
						if (newOverLeft > 0 || abs(newOverLeft) < overRight) {
							position.left += myOffset + atOffset + offset;
						}
					}
				},
				top: function(position, data) {
					var within = data.within, withinOffset = within.offset.top + within.scrollTop, outerHeight = within.height, offsetTop = within.isWindow ? within.scrollTop : within.offset.top, collisionPosTop = position.top - data.collisionPosition.marginTop, overTop = collisionPosTop - offsetTop, overBottom = collisionPosTop + data.collisionHeight - outerHeight - offsetTop, top = data.my[1] === "top", myOffset = top ? -data.elemHeight : data.my[1] === "bottom" ? data.elemHeight : 0, atOffset = data.at[1] === "top" ? data.targetHeight : data.at[1] === "bottom" ? -data.targetHeight : 0, offset = -2 * data.offset[1], newOverTop, newOverBottom;
					if (overTop < 0) {
						newOverBottom = position.top + myOffset + atOffset + offset + data.collisionHeight - outerHeight - withinOffset;
						if (newOverBottom < 0 || newOverBottom < abs(overTop)) {
							position.top += myOffset + atOffset + offset;
						}
					} else if (overBottom > 0) {
						newOverTop = position.top - data.collisionPosition.marginTop + myOffset + atOffset + offset - offsetTop;
						if (newOverTop > 0 || abs(newOverTop) < overBottom) {
							position.top += myOffset + atOffset + offset;
						}
					}
				}
			},
			flipfit: {
				left: function() {
					$.ui.position.flip.left.apply(this, arguments);
					$.ui.position.fit.left.apply(this, arguments);
				},
				top: function() {
					$.ui.position.flip.top.apply(this, arguments);
					$.ui.position.fit.top.apply(this, arguments);
				}
			}
		};

	})();

	var position = $.ui.position;

	/*
	 * ! jQuery UI :data 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: :data
	// >>group: Core
	// >>description: Selects elements which have data stored under the
	// specified key.
	// >>docs: http://api.jqueryui.com/data-selector/
	var data = $.extend($.expr[":"], {
		data: $.expr.createPseudo ? $.expr.createPseudo(function(dataName) {
			return function(elem) {
				return !!$.data(elem, dataName);
			};
		}) :

		// Support: jQuery <1.8
		function(elem, i, match) {
			return !!$.data(elem, match[3]);
		}
	});

	/*
	 * ! jQuery UI Disable Selection 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: disableSelection
	// >>group: Core
	// >>description: Disable selection of text content within the set of
	// matched elements.
	// >>docs: http://api.jqueryui.com/disableSelection/
	// This file is deprecated
	var disableSelection = $.fn.extend({
		disableSelection: (function() {
			var eventType = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";

			return function() {
				return this.on(eventType + ".ui-disableSelection", function(event) {
					event.preventDefault();
				});
			};
		})(),

		enableSelection: function() {
			return this.off(".ui-disableSelection");
		}
	});

	/*
	 * ! jQuery UI Focusable 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: focusable
	// >>group: Core
	// >>description: Selects elements which can be focused.
	// >>docs: http://api.jqueryui.com/focusable-selector/
	// Selectors
	$.ui.focusable = function(element, hasTabindex) {
		var map, mapName, img, nodeName = element.nodeName.toLowerCase();
		if ("area" === nodeName) {
			map = element.parentNode;
			mapName = map.name;
			if (!element.href || !mapName || map.nodeName.toLowerCase() !== "map") {
				return false;
			}
			img = $("img[usemap='#" + mapName + "']");
			return img.length > 0 && img.is(":visible");
		}
		return (/^(input|select|textarea|button|object)$/.test(nodeName) ? !element.disabled : "a" === nodeName ? element.href || hasTabindex : hasTabindex) && $(element).is(":visible") && visible($(element));
	};

	// Support: IE 8 only
	// IE 8 doesn't resolve inherit to visible/hidden for computed values
	function visible(element) {
		var visibility = element.css("visibility");
		while (visibility === "inherit") {
			element = element.parent();
			visibility = element.css("visibility");
		}
		return visibility !== "hidden";
	}

	$.extend($.expr[":"], {
		focusable: function(element) {
			return $.ui.focusable(element, $.attr(element, "tabindex") != null);
		}
	});

	var focusable = $.ui.focusable;

	// Support: IE8 Only
	// IE8 does not support the form attribute and when it is supplied. It
	// overwrites the form prop
	// with a string, so we need to find the proper form.
	var form = $.fn.form = function() {
		return typeof this[0].form === "string" ? this.closest("form") : $(this[0].form);
	};

	/*
	 * ! jQuery UI Form Reset Mixin 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Form Reset Mixin
	// >>group: Core
	// >>description: Refresh input widgets when their form is reset
	// >>docs: http://api.jqueryui.com/form-reset-mixin/
	var formResetMixin = $.ui.formResetMixin = {
		_formResetHandler: function() {
			var form = $(this);

			// Wait for the form reset to actually happen before refreshing
			setTimeout(function() {
				var instances = form.data("ui-form-reset-instances");
				$.each(instances, function() {
					this.refresh();
				});
			});
		},

		_bindFormResetHandler: function() {
			this.form = this.element.form();
			if (!this.form.length) {
				return;
			}

			var instances = this.form.data("ui-form-reset-instances") || [];
			if (!instances.length) {

				// We don't use _on() here because we use a single event handler
				// per form
				this.form.on("reset.ui-form-reset", this._formResetHandler);
			}
			instances.push(this);
			this.form.data("ui-form-reset-instances", instances);
		},

		_unbindFormResetHandler: function() {
			if (!this.form.length) {
				return;
			}

			var instances = this.form.data("ui-form-reset-instances");
			instances.splice($.inArray(this, instances), 1);
			if (instances.length) {
				this.form.data("ui-form-reset-instances", instances);
			} else {
				this.form.removeData("ui-form-reset-instances").off("reset.ui-form-reset");
			}
		}
	};

	/*
	 * ! jQuery UI Support for jQuery core 1.7.x 1.12.0-beta.1
	 * http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 * 
	 */

	// >>label: jQuery 1.7 Support
	// >>group: Core
	// >>description: Support version 1.7.x of jQuery core
	// Support: jQuery 1.7 only
	// Not a great way to check versions, but since we only support 1.7+ and
	// only
	// need to detect <1.8, this is a simple check that should suffice. Checking
	// for "1.7." would be a bit safer, but the version string is 1.7, not 1.7.0
	// and we'll never reach 1.70.0 (if we do, we certainly won't be supporting
	// 1.7 anymore). See #11197 for why we're not using feature detection.
	if ($.fn.jquery.substring(0, 3) === "1.7") {

		// Setters for .innerWidth(), .innerHeight(), .outerWidth(),
		// .outerHeight()
		// Unlike jQuery Core 1.8+, these only support numeric values to set the
		// dimensions in pixels
		$.each(["Width", "Height"], function(i, name) {
			var side = name === "Width" ? ["Left", "Right"] : ["Top", "Bottom"], type = name.toLowerCase(), orig = {
				innerWidth: $.fn.innerWidth,
				innerHeight: $.fn.innerHeight,
				outerWidth: $.fn.outerWidth,
				outerHeight: $.fn.outerHeight
			};

			function reduce(elem, size, border, margin) {
				$.each(side, function() {
					size -= parseFloat($.css(elem, "padding" + this)) || 0;
					if (border) {
						size -= parseFloat($.css(elem, "border" + this + "Width")) || 0;
					}
					if (margin) {
						size -= parseFloat($.css(elem, "margin" + this)) || 0;
					}
				});
				return size;
			}

			$.fn["inner" + name] = function(size) {
				if (size === undefined) {
					return orig["inner" + name].call(this);
				}

				return this.each(function() {
					$(this).css(type, reduce(this, size) + "px");
				});
			};

			$.fn["outer" + name] = function(size, margin) {
				if (typeof size !== "number") {
					return orig["outer" + name].call(this, size);
				}

				return this.each(function() {
					$(this).css(type, reduce(this, size, true, margin) + "px");
				});
			};
		});

		$.fn.addBack = function(selector) {
			return this.add(selector == null ? this.prevObject : this.prevObject.filter(selector));
		};
	}

	;
	/*
	 * ! jQuery UI Keycode 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Keycode
	// >>group: Core
	// >>description: Provide keycodes as keynames
	// >>docs: http://api.jqueryui.com/jQuery.ui.keyCode/
	var keycode = $.ui.keyCode = {
		BACKSPACE: 8,
		COMMA: 188,
		DELETE: 46,
		DOWN: 40,
		END: 35,
		ENTER: 13,
		ESCAPE: 27,
		HOME: 36,
		LEFT: 37,
		PAGE_DOWN: 34,
		PAGE_UP: 33,
		PERIOD: 190,
		RIGHT: 39,
		SPACE: 32,
		TAB: 9,
		UP: 38
	};

	// Internal use only
	var escapeSelector = $.ui.escapeSelector = (function() {
		var selectorEscape = /([!"#$%&'()*+,./:;<=>?@[\]^`{|}~])/g;
		return function(selector) {
			return selector.replace(selectorEscape, "\\$1");
		};
	})();

	/*
	 * ! jQuery UI Labels 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: labels
	// >>group: Core
	// >>description: Find all the labels associated with a given input
	// >>docs: http://api.jqueryui.com/labels/
	var labels = $.fn.labels = function() {
		var ancestor, selector, id, labels, ancestors;

		// Check control.labels first
		if (this[0].labels && this[0].labels.length) {
			return this.pushStack(this[0].labels);
		}

		// Support: IE <= 11, FF <= 37, Android <= 2.3 only
		// Above browsers do not support control.labels. Everything below is to
		// support them
		// as well as document fragments. control.labels does not work on
		// document fragments
		labels = this.eq(0).parents("label");

		// Look for the label based on the id
		id = this.attr("id");
		if (id) {

			// We don't search against the document in case the element
			// is disconnected from the DOM
			ancestor = this.eq(0).parents().last();

			// Get a full set of top level ancestors
			ancestors = ancestor.add(ancestor.length ? ancestor.siblings() : this.siblings());

			// Create a selector for the label based on the id
			selector = "label[for='" + $.ui.escapeSelector(id) + "']";

			labels = labels.add(ancestors.find(selector).addBack(selector));

		}

		// Return whatever we have found for labels
		return this.pushStack(labels);
	};

	/*
	 * ! jQuery UI Scroll Parent 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: scrollParent
	// >>group: Core
	// >>description: Get the closest ancestor element that is scrollable.
	// >>docs: http://api.jqueryui.com/scrollParent/
	var scrollParent = $.fn.scrollParent = function(includeHidden) {
		var position = this.css("position"), excludeStaticParent = position === "absolute", overflowRegex = includeHidden ? /(auto|scroll|hidden)/ : /(auto|scroll)/, scrollParent = this.parents().filter(function() {
			var parent = $(this);
			if (excludeStaticParent && parent.css("position") === "static") {
				return false;
			}
			return overflowRegex.test(parent.css("overflow") + parent.css("overflow-y") + parent.css("overflow-x"));
		}).eq(0);

		return position === "fixed" || !scrollParent.length ? $(this[0].ownerDocument || document) : scrollParent;
	};

	/*
	 * ! jQuery UI Tabbable 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: focusable
	// >>group: Core
	// >>description: Selects elements which can be tabbed to.
	// >>docs: http://api.jqueryui.com/tabbable-selector/
	var tabbable = $.extend($.expr[":"], {
		tabbable: function(element) {
			var tabIndex = $.attr(element, "tabindex"), hasTabindex = tabIndex != null;
			return (!hasTabindex || tabIndex >= 0) && $.ui.focusable(element, hasTabindex);
		}
	});

	/*
	 * ! jQuery UI Unique ID 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: uniqueId
	// >>group: Core
	// >>description: Functions to generate and remove uniqueId's
	// >>docs: http://api.jqueryui.com/uniqueId/
	var uniqueId = $.fn.extend({
		uniqueId: (function() {
			var uuid = 0;

			return function() {
				return this.each(function() {
					if (!this.id) {
						this.id = "ui-id-" + (++uuid);
					}
				});
			};
		})(),

		removeUniqueId: function() {
			return this.each(function() {
				if (/^ui-id-\d+$/.test(this.id)) {
					$(this).removeAttr("id");
				}
			});
		}
	});

	// This file is deprecated
	var ie = $.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());

	/*
	 * ! jQuery UI Mouse 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Mouse
	// >>group: Widgets
	// >>description: Abstracts mouse-based interactions to assist in creating
	// certain widgets.
	// >>docs: http://api.jqueryui.com/mouse/
	var mouseHandled = false;
	$(document).on("mouseup", function() {
		mouseHandled = false;
	});

	var widgetsMouse = $.widget("ui.mouse", {
		version: "1.12.0-beta.1",
		options: {
			cancel: "input, textarea, button, select, option",
			distance: 1,
			delay: 0
		},
		_mouseInit: function() {
			var that = this;

			this.element.on("mousedown." + this.widgetName, function(event) {
				return that._mouseDown(event);
			}).on("click." + this.widgetName, function(event) {
				if (true === $.data(event.target, that.widgetName + ".preventClickEvent")) {
					$.removeData(event.target, that.widgetName + ".preventClickEvent");
					event.stopImmediatePropagation();
					return false;
				}
			});

			this.started = false;
		},

		// TODO: make sure destroying one instance of mouse doesn't mess with
		// other instances of mouse
		_mouseDestroy: function() {
			this.element.off("." + this.widgetName);
			if (this._mouseMoveDelegate) {
				this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate);
			}
		},

		_mouseDown: function(event) {

			// don't let more than one widget handle mouseStart
			if (mouseHandled) {
				return;
			}

			this._mouseMoved = false;

			// We may have missed mouseup (out of window)
			(this._mouseStarted && this._mouseUp(event));

			this._mouseDownEvent = event;

			var that = this, btnIsLeft = (event.which === 1),

			// event.target.nodeName works around a bug in IE 8 with
			// disabled inputs (#7620)
			elIsCancel = (typeof this.options.cancel === "string" && event.target.nodeName ? $(event.target).closest(this.options.cancel).length : false);
			if (!btnIsLeft || elIsCancel || !this._mouseCapture(event)) {
				return true;
			}

			this.mouseDelayMet = !this.options.delay;
			if (!this.mouseDelayMet) {
				this._mouseDelayTimer = setTimeout(function() {
					that.mouseDelayMet = true;
				}, this.options.delay);
			}

			if (this._mouseDistanceMet(event) && this._mouseDelayMet(event)) {
				this._mouseStarted = (this._mouseStart(event) !== false);
				if (!this._mouseStarted) {
					event.preventDefault();
					return true;
				}
			}

			// Click event may never have fired (Gecko & Opera)
			if (true === $.data(event.target, this.widgetName + ".preventClickEvent")) {
				$.removeData(event.target, this.widgetName + ".preventClickEvent");
			}

			// These delegates are required to keep context
			this._mouseMoveDelegate = function(event) {
				return that._mouseMove(event);
			};
			this._mouseUpDelegate = function(event) {
				return that._mouseUp(event);
			};

			this.document.on("mousemove." + this.widgetName, this._mouseMoveDelegate).on("mouseup." + this.widgetName, this._mouseUpDelegate);

			event.preventDefault();

			mouseHandled = true;
			return true;
		},

		_mouseMove: function(event) {

			// Only check for mouseups outside the document if you've moved
			// inside the document
			// at least once. This prevents the firing of mouseup in the case of
			// IE<9, which will
			// fire a mousemove event if content is placed under the cursor. See
			// #7778
			// Support: IE <9
			if (this._mouseMoved) {

				// IE mouseup check - mouseup happened when mouse was out of
				// window
				if ($.ui.ie && (!document.documentMode || document.documentMode < 9) && !event.button) {
					return this._mouseUp(event);

					// Iframe mouseup check - mouseup occurred in another
					// document
				} else if (!event.which) {

					// Support: Safari <=8 - 9
					// Safari sets which to 0 if you press any of the following
					// keys
					// during a drag (#14461)
					if (event.originalEvent.altKey || event.originalEvent.ctrlKey || event.originalEvent.metaKey || event.originalEvent.shiftKey) {
						this.ignoreMissingWhich = true;
					} else if (!this.ignoreMissingWhich) {
						return this._mouseUp(event);
					}
				}
			}

			if (event.which || event.button) {
				this._mouseMoved = true;
			}

			if (this._mouseStarted) {
				this._mouseDrag(event);
				return event.preventDefault();
			}

			if (this._mouseDistanceMet(event) && this._mouseDelayMet(event)) {
				this._mouseStarted = (this._mouseStart(this._mouseDownEvent, event) !== false);
				(this._mouseStarted ? this._mouseDrag(event) : this._mouseUp(event));
			}

			return !this._mouseStarted;
		},

		_mouseUp: function(event) {
			this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate);

			if (this._mouseStarted) {
				this._mouseStarted = false;

				if (event.target === this._mouseDownEvent.target) {
					$.data(event.target, this.widgetName + ".preventClickEvent", true);
				}

				this._mouseStop(event);
			}

			if (this._mouseDelayTimer) {
				clearTimeout(this._mouseDelayTimer);
				delete this._mouseDelayTimer;
			}

			this.ignoreMissingWhich = false;
			mouseHandled = false;
			event.preventDefault();
		},

		_mouseDistanceMet: function(event) {
			return(Math.max(Math.abs(this._mouseDownEvent.pageX - event.pageX), Math.abs(this._mouseDownEvent.pageY - event.pageY)) >= this.options.distance);
		},

		_mouseDelayMet: function( /* event */) {
			return this.mouseDelayMet;
		},

		// These are placeholder methods, to be overriden by extending plugin
		_mouseStart: function( /* event */) {
		},
		_mouseDrag: function( /* event */) {
		},
		_mouseStop: function( /* event */) {
		},
		_mouseCapture: function( /* event */) {
			return true;
		}
	});

	// $.ui.plugin is deprecated. Use $.widget() extensions instead.
	var plugin = $.ui.plugin = {
		add: function(module, option, set) {
			var i, proto = $.ui[module].prototype;
			for (i in set) {
				proto.plugins[i] = proto.plugins[i] || [];
				proto.plugins[i].push([option, set[i]]);
			}
		},
		call: function(instance, name, args, allowDisconnected) {
			var i, set = instance.plugins[name];

			if (!set) {
				return;
			}

			if (!allowDisconnected && (!instance.element[0].parentNode || instance.element[0].parentNode.nodeType === 11)) {
				return;
			}

			for (i = 0; i < set.length; i++) {
				if (instance.options[set[i][0]]) {
					set[i][1].apply(instance.element, args);
				}
			}
		}
	};

	var safeActiveElement = $.ui.safeActiveElement = function(document) {
		var activeElement;

		// Support: IE 9 only
		// IE9 throws an "Unspecified error" accessing document.activeElement
		// from an <iframe>
		try {
			activeElement = document.activeElement;
		} catch (error) {
			activeElement = document.body;
		}

		// Support: IE 9 - 11 only
		// IE may return null instead of an element
		// Interestingly, this only seems to occur when NOT in an iframe
		if (!activeElement) {
			activeElement = document.body;
		}

		// Support: IE 11 only
		// IE11 returns a seemingly empty object in some cases when accessing
		// document.activeElement from an <iframe>
		if (!activeElement.nodeName) {
			activeElement = document.body;
		}

		return activeElement;
	};

	var safeBlur = $.ui.safeBlur = function(element) {

		// Support: IE9 - 10 only
		// If the <body> is blurred, IE will switch windows, see #9420
		if (element && element.nodeName.toLowerCase() !== "body") {
			$(element).trigger("blur");
		}
	};

	/*
	 * ! jQuery UI Draggable 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Draggable
	// >>group: Interactions
	// >>description: Enables dragging functionality for any element.
	// >>docs: http://api.jqueryui.com/draggable/
	// >>demos: http://jqueryui.com/draggable/
	// >>css.structure: ../../themes/base/draggable.css
	$.widget("ui.draggable", $.ui.mouse, {
		version: "1.12.0-beta.1",
		widgetEventPrefix: "drag",
		options: {
			addClasses: true,
			appendTo: "parent",
			axis: false,
			connectToSortable: false,
			containment: false,
			cursor: "auto",
			cursorAt: false,
			grid: false,
			handle: false,
			helper: "original",
			iframeFix: false,
			opacity: false,
			refreshPositions: false,
			revert: false,
			revertDuration: 500,
			scope: "default",
			scroll: true,
			scrollSensitivity: 20,
			scrollSpeed: 20,
			snap: false,
			snapMode: "both",
			snapTolerance: 20,
			stack: false,
			zIndex: false,

			// Callbacks
			drag: null,
			start: null,
			stop: null
		},
		_create: function() {

			if (this.options.helper === "original") {
				this._setPositionRelative();
			}
			if (this.options.addClasses) {
				this._addClass("ui-draggable");
			}
			this._setHandleClassName();

			this._mouseInit();
		},

		_setOption: function(key, value) {
			this._super(key, value);
			if (key === "handle") {
				this._removeHandleClassName();
				this._setHandleClassName();
			}
		},

		_destroy: function() {
			if ((this.helper || this.element).is(".ui-draggable-dragging")) {
				this.destroyOnClear = true;
				return;
			}
			this._removeHandleClassName();
			this._mouseDestroy();
		},

		_mouseCapture: function(event) {
			var o = this.options;

			this._blurActiveElement(event);

			// Among others, prevent a drag on a resizable-handle
			if (this.helper || o.disabled || $(event.target).closest(".ui-resizable-handle").length > 0) {
				return false;
			}

			// Quit if we're not on a valid handle
			this.handle = this._getHandle(event);
			if (!this.handle) {
				return false;
			}

			this._blockFrames(o.iframeFix === true ? "iframe" : o.iframeFix);

			return true;

		},

		_blockFrames: function(selector) {
			this.iframeBlocks = this.document.find(selector).map(function() {
				var iframe = $(this);

				return $("<div>").css("position", "absolute").appendTo(iframe.parent()).outerWidth(iframe.outerWidth()).outerHeight(iframe.outerHeight()).offset(iframe.offset())[0];
			});
		},

		_unblockFrames: function() {
			if (this.iframeBlocks) {
				this.iframeBlocks.remove();
				delete this.iframeBlocks;
			}
		},

		_blurActiveElement: function(event) {

			// Only need to blur if the event occurred on the draggable itself,
			// see #10527
			if (!this.handleElement.is(event.target)) {
				return;
			}

			// Blur any element that currently has focus, see #4261
			$.ui.safeBlur($.ui.safeActiveElement(this.document[0]));
		},

		_mouseStart: function(event) {

			var o = this.options;

			// Create and append the visible helper
			this.helper = this._createHelper(event);

			this._addClass(this.helper, "ui-draggable-dragging");

			// Cache the helper size
			this._cacheHelperProportions();

			// If ddmanager is used for droppables, set the global draggable
			if ($.ui.ddmanager) {
				$.ui.ddmanager.current = this;
			}

			/*
			 * - Position generation - This block generates everything position
			 * related - it's the core of draggables.
			 */

			// Cache the margins of the original element
			this._cacheMargins();

			// Store the helper's css position
			this.cssPosition = this.helper.css("position");
			this.scrollParent = this.helper.scrollParent(true);
			this.offsetParent = this.helper.offsetParent();
			this.hasFixedAncestor = this.helper.parents().filter(function() {
				return $(this).css("position") === "fixed";
			}).length > 0;

			// The element's absolute position on the page minus margins
			this.positionAbs = this.element.offset();
			this._refreshOffsets(event);

			// Generate the original position
			this.originalPosition = this.position = this._generatePosition(event, false);
			this.originalPageX = event.pageX;
			this.originalPageY = event.pageY;

			// Adjust the mouse offset relative to the helper if "cursorAt" is
			// supplied
			(o.cursorAt && this._adjustOffsetFromHelper(o.cursorAt));

			// Set a containment if given in the options
			this._setContainment();

			// Trigger event + callbacks
			if (this._trigger("start", event) === false) {
				this._clear();
				return false;
			}

			// Recache the helper size
			this._cacheHelperProportions();

			// Prepare the droppable offsets
			if ($.ui.ddmanager && !o.dropBehaviour) {
				$.ui.ddmanager.prepareOffsets(this, event);
			}

			this._mouseDrag(event, true); // Execute the drag once - this
			// causes the helper not to be
			// visible before getting its
			// correct position

			// If the ddmanager is used for droppables, inform the manager that
			// dragging has started (see #5003)
			if ($.ui.ddmanager) {
				$.ui.ddmanager.dragStart(this, event);
			}

			return true;
		},

		_refreshOffsets: function(event) {
			this.offset = {
				top: this.positionAbs.top - this.margins.top,
				left: this.positionAbs.left - this.margins.left,
				scroll: false,
				parent: this._getParentOffset(),
				relative: this._getRelativeOffset()
			};

			this.offset.click = {
				left: event.pageX - this.offset.left,
				top: event.pageY - this.offset.top
			};
		},

		_mouseDrag: function(event, noPropagation) {

			// reset any necessary cached properties (see #5009)
			if (this.hasFixedAncestor) {
				this.offset.parent = this._getParentOffset();
			}

			// Compute the helpers position
			this.position = this._generatePosition(event, true);
			this.positionAbs = this._convertPositionTo("absolute");

			// Call plugins and callbacks and use the resulting position if
			// something is returned
			if (!noPropagation) {
				var ui = this._uiHash();
				if (this._trigger("drag", event, ui) === false) {
					this._mouseUp(new $.Event("mouseup", event));
					return false;
				}
				this.position = ui.position;
			}

			this.helper[0].style.left = this.position.left + "px";
			this.helper[0].style.top = this.position.top + "px";

			if ($.ui.ddmanager) {
				$.ui.ddmanager.drag(this, event);
			}

			return false;
		},

		_mouseStop: function(event) {

			// If we are using droppables, inform the manager about the drop
			var that = this, dropped = false;
			if ($.ui.ddmanager && !this.options.dropBehaviour) {
				dropped = $.ui.ddmanager.drop(this, event);
			}

			// if a drop comes from outside (a sortable)
			if (this.dropped) {
				dropped = this.dropped;
				this.dropped = false;
			}

			if ((this.options.revert === "invalid" && !dropped) || (this.options.revert === "valid" && dropped) || this.options.revert === true || ($.isFunction(this.options.revert) && this.options.revert.call(this.element, dropped))) {
				$(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() {
					if (that._trigger("stop", event) !== false) {
						that._clear();
					}
				});
			} else {
				if (this._trigger("stop", event) !== false) {
					this._clear();
				}
			}

			return false;
		},

		_mouseUp: function(event) {
			this._unblockFrames();

			// If the ddmanager is used for droppables, inform the manager that
			// dragging has stopped (see #5003)
			if ($.ui.ddmanager) {
				$.ui.ddmanager.dragStop(this, event);
			}

			// Only need to focus if the event occurred on the draggable itself,
			// see #10527
			if (this.handleElement.is(event.target)) {

				// The interaction is over; whether or not the click resulted in
				// a drag, focus the element
				this.element.trigger("focus");
			}

			return $.ui.mouse.prototype._mouseUp.call(this, event);
		},

		cancel: function() {

			if (this.helper.is(".ui-draggable-dragging")) {
				this._mouseUp(new $.Event("mouseup", {
					target: this.element[0]
				}));
			} else {
				this._clear();
			}

			return this;

		},

		_getHandle: function(event) {
			return this.options.handle ? !!$(event.target).closest(this.element.find(this.options.handle)).length : true;
		},

		_setHandleClassName: function() {
			this.handleElement = this.options.handle ? this.element.find(this.options.handle) : this.element;
			this._addClass(this.handleElement, "ui-draggable-handle");
		},

		_removeHandleClassName: function() {
			this._removeClass(this.handleElement, "ui-draggable-handle");
		},

		_createHelper: function(event) {

			var o = this.options, helperIsFunction = $.isFunction(o.helper), helper = helperIsFunction ? $(o.helper.apply(this.element[0], [event])) : (o.helper === "clone" ? this.element.clone().removeAttr("id") : this.element);

			if (!helper.parents("body").length) {
				helper.appendTo((o.appendTo === "parent" ? this.element[0].parentNode : o.appendTo));
			}

			// Http://bugs.jqueryui.com/ticket/9446
			// a helper function can return the original element
			// which wouldn't have been set to relative in _create
			if (helperIsFunction && helper[0] === this.element[0]) {
				this._setPositionRelative();
			}

			if (helper[0] !== this.element[0] && !(/(fixed|absolute)/).test(helper.css("position"))) {
				helper.css("position", "absolute");
			}

			return helper;

		},

		_setPositionRelative: function() {
			if (!(/^(?:r|a|f)/).test(this.element.css("position"))) {
				this.element[0].style.position = "relative";
			}
		},

		_adjustOffsetFromHelper: function(obj) {
			if (typeof obj === "string") {
				obj = obj.split(" ");
			}
			if ($.isArray(obj)) {
				obj = {
					left: +obj[0],
					top: +obj[1] || 0
				};
			}
			if ("left" in obj) {
				this.offset.click.left = obj.left + this.margins.left;
			}
			if ("right" in obj) {
				this.offset.click.left = this.helperProportions.width - obj.right + this.margins.left;
			}
			if ("top" in obj) {
				this.offset.click.top = obj.top + this.margins.top;
			}
			if ("bottom" in obj) {
				this.offset.click.top = this.helperProportions.height - obj.bottom + this.margins.top;
			}
		},

		_isRootNode: function(element) {
			return (/(html|body)/i).test(element.tagName) || element === this.document[0];
		},

		_getParentOffset: function() {

			// Get the offsetParent and cache its position
			var po = this.offsetParent.offset(), document = this.document[0];

			// This is a special case where we need to modify a offset
			// calculated on start, since the following happened:
			// 1. The position of the helper is absolute, so it's position is
			// calculated based on the next positioned parent
			// 2. The actual offset parent is a child of the scroll parent, and
			// the scroll parent isn't the document, which means that
			// the scroll is included in the initial calculation of the offset
			// of the parent, and never recalculated upon drag
			if (this.cssPosition === "absolute" && this.scrollParent[0] !== document && $.contains(this.scrollParent[0], this.offsetParent[0])) {
				po.left += this.scrollParent.scrollLeft();
				po.top += this.scrollParent.scrollTop();
			}

			if (this._isRootNode(this.offsetParent[0])) {
				po = {
					top: 0,
					left: 0
				};
			}

			return {
				top: po.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
				left: po.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
			};

		},

		_getRelativeOffset: function() {
			if (this.cssPosition !== "relative") {
				return {
					top: 0,
					left: 0
				};
			}

			var p = this.element.position(), scrollIsRootNode = this._isRootNode(this.scrollParent[0]);

			return {
				top: p.top - (parseInt(this.helper.css("top"), 10) || 0) + (!scrollIsRootNode ? this.scrollParent.scrollTop() : 0),
				left: p.left - (parseInt(this.helper.css("left"), 10) || 0) + (!scrollIsRootNode ? this.scrollParent.scrollLeft() : 0)
			};

		},

		_cacheMargins: function() {
			this.margins = {
				left: (parseInt(this.element.css("marginLeft"), 10) || 0),
				top: (parseInt(this.element.css("marginTop"), 10) || 0),
				right: (parseInt(this.element.css("marginRight"), 10) || 0),
				bottom: (parseInt(this.element.css("marginBottom"), 10) || 0)
			};
		},

		_cacheHelperProportions: function() {
			this.helperProportions = {
				width: this.helper.outerWidth(),
				height: this.helper.outerHeight()
			};
		},

		_setContainment: function() {

			var isUserScrollable, c, ce, o = this.options, document = this.document[0];

			this.relativeContainer = null;

			if (!o.containment) {
				this.containment = null;
				return;
			}

			if (o.containment === "window") {
				this.containment = [$(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, $(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, $(window).scrollLeft() + $(window).width() - this.helperProportions.width - this.margins.left, $(window).scrollTop() + ($(window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top];
				return;
			}

			if (o.containment === "document") {
				this.containment = [0, 0, $(document).width() - this.helperProportions.width - this.margins.left, ($(document).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top];
				return;
			}

			if (o.containment.constructor === Array) {
				this.containment = o.containment;
				return;
			}

			if (o.containment === "parent") {
				o.containment = this.helper[0].parentNode;
			}

			c = $(o.containment);
			ce = c[0];

			if (!ce) {
				return;
			}

			isUserScrollable = /(scroll|auto)/.test(c.css("overflow"));

			this.containment = [(parseInt(c.css("borderLeftWidth"), 10) || 0) + (parseInt(c.css("paddingLeft"), 10) || 0), (parseInt(c.css("borderTopWidth"), 10) || 0) + (parseInt(c.css("paddingTop"), 10) || 0), (isUserScrollable ? Math.max(ce.scrollWidth, ce.offsetWidth) : ce.offsetWidth) - (parseInt(c.css("borderRightWidth"), 10) || 0) - (parseInt(c.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (isUserScrollable ? Math.max(ce.scrollHeight, ce.offsetHeight) : ce.offsetHeight) - (parseInt(c.css("borderBottomWidth"), 10) || 0) - (parseInt(c.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom];
			this.relativeContainer = c;
		},

		_convertPositionTo: function(d, pos) {

			if (!pos) {
				pos = this.position;
			}

			var mod = d === "absolute" ? 1 : -1, scrollIsRootNode = this._isRootNode(this.scrollParent[0]);

			return {
				top: (pos.top + // The absolute mouse position
				this.offset.relative.top * mod + // Only for relative
				// positioned nodes:
				// Relative offset from
				// element to offset parent
				this.offset.parent.top * mod - // The offsetParent's offset
				// without borders (offset +
				// border)
				((this.cssPosition === "fixed" ? -this.offset.scroll.top : (scrollIsRootNode ? 0 : this.offset.scroll.top)) * mod)),
				left: (pos.left + // The absolute mouse position
				this.offset.relative.left * mod + // Only for relative
				// positioned nodes:
				// Relative offset from
				// element to offset parent
				this.offset.parent.left * mod - // The offsetParent's offset
				// without borders (offset +
				// border)
				((this.cssPosition === "fixed" ? -this.offset.scroll.left : (scrollIsRootNode ? 0 : this.offset.scroll.left)) * mod))
			};

		},

		_generatePosition: function(event, constrainPosition) {

			var containment, co, top, left, o = this.options, scrollIsRootNode = this._isRootNode(this.scrollParent[0]), pageX = event.pageX, pageY = event.pageY;

			// Cache the scroll
			if (!scrollIsRootNode || !this.offset.scroll) {
				this.offset.scroll = {
					top: this.scrollParent.scrollTop(),
					left: this.scrollParent.scrollLeft()
				};
			}

			/*
			 * - Position constraining - Constrain the position to a mix of
			 * grid, containment.
			 */

			// If we are not dragging yet, we won't check for options
			if (constrainPosition) {
				if (this.containment) {
					if (this.relativeContainer) {
						co = this.relativeContainer.offset();
						containment = [this.containment[0] + co.left, this.containment[1] + co.top, this.containment[2] + co.left, this.containment[3] + co.top];
					} else {
						containment = this.containment;
					}

					if (event.pageX - this.offset.click.left < containment[0]) {
						pageX = containment[0] + this.offset.click.left;
					}
					if (event.pageY - this.offset.click.top < containment[1]) {
						pageY = containment[1] + this.offset.click.top;
					}
					if (event.pageX - this.offset.click.left > containment[2]) {
						pageX = containment[2] + this.offset.click.left;
					}
					if (event.pageY - this.offset.click.top > containment[3]) {
						pageY = containment[3] + this.offset.click.top;
					}
				}

				if (o.grid) {

					// Check for grid elements set to 0 to prevent divide by 0
					// error causing invalid argument errors in IE (see ticket
					// #6950)
					top = o.grid[1] ? this.originalPageY + Math.round((pageY - this.originalPageY) / o.grid[1]) * o.grid[1] : this.originalPageY;
					pageY = containment ? ((top - this.offset.click.top >= containment[1] || top - this.offset.click.top > containment[3]) ? top : ((top - this.offset.click.top >= containment[1]) ? top - o.grid[1] : top + o.grid[1])) : top;

					left = o.grid[0] ? this.originalPageX + Math.round((pageX - this.originalPageX) / o.grid[0]) * o.grid[0] : this.originalPageX;
					pageX = containment ? ((left - this.offset.click.left >= containment[0] || left - this.offset.click.left > containment[2]) ? left : ((left - this.offset.click.left >= containment[0]) ? left - o.grid[0] : left + o.grid[0])) : left;
				}

				if (o.axis === "y") {
					pageX = this.originalPageX;
				}

				if (o.axis === "x") {
					pageY = this.originalPageY;
				}
			}

			return {
				top: (pageY - // The absolute mouse position
				this.offset.click.top - // Click offset (relative to the
				// element)
				this.offset.relative.top - // Only for relative positioned
				// nodes: Relative offset from
				// element to offset parent
				this.offset.parent.top + // The offsetParent's offset without
				// borders (offset + border)
				(this.cssPosition === "fixed" ? -this.offset.scroll.top : (scrollIsRootNode ? 0 : this.offset.scroll.top))),
				left: (pageX - // The absolute mouse position
				this.offset.click.left - // Click offset (relative to the
				// element)
				this.offset.relative.left - // Only for relative positioned
				// nodes: Relative offset from
				// element to offset parent
				this.offset.parent.left + // The offsetParent's offset without
				// borders (offset + border)
				(this.cssPosition === "fixed" ? -this.offset.scroll.left : (scrollIsRootNode ? 0 : this.offset.scroll.left)))
			};

		},

		_clear: function() {
			this._removeClass(this.helper, "ui-draggable-dragging");
			if (this.helper[0] !== this.element[0] && !this.cancelHelperRemoval) {
				this.helper.remove();
			}
			this.helper = null;
			this.cancelHelperRemoval = false;
			if (this.destroyOnClear) {
				this.destroy();
			}
		},

		// From now on bulk stuff - mainly helpers

		_trigger: function(type, event, ui) {
			ui = ui || this._uiHash();
			$.ui.plugin.call(this, type, [event, ui, this], true);

			// Absolute position and offset (see #6884 ) have to be recalculated
			// after plugins
			if (/^(drag|start|stop)/.test(type)) {
				this.positionAbs = this._convertPositionTo("absolute");
				ui.offset = this.positionAbs;
			}
			return $.Widget.prototype._trigger.call(this, type, event, ui);
		},

		plugins: {},

		_uiHash: function() {
			return {
				helper: this.helper,
				position: this.position,
				originalPosition: this.originalPosition,
				offset: this.positionAbs
			};
		}

	});

	$.ui.plugin.add("draggable", "connectToSortable", {
		start: function(event, ui, draggable) {
			var uiSortable = $.extend({}, ui, {
				item: draggable.element
			});

			draggable.sortables = [];
			$(draggable.options.connectToSortable).each(function() {
				var sortable = $(this).sortable("instance");

				if (sortable && !sortable.options.disabled) {
					draggable.sortables.push(sortable);

					// RefreshPositions is called at drag start to refresh the
					// containerCache
					// which is used in drag. This ensures it's initialized and
					// synchronized
					// with any changes that might have happened on the page
					// since initialization.
					sortable.refreshPositions();
					sortable._trigger("activate", event, uiSortable);
				}
			});
		},
		stop: function(event, ui, draggable) {
			var uiSortable = $.extend({}, ui, {
				item: draggable.element
			});

			draggable.cancelHelperRemoval = false;

			$.each(draggable.sortables, function() {
				var sortable = this;

				if (sortable.isOver) {
					sortable.isOver = 0;

					// Allow this sortable to handle removing the helper
					draggable.cancelHelperRemoval = true;
					sortable.cancelHelperRemoval = false;

					// Use _storedCSS To restore properties in the sortable,
					// as this also handles revert (#9675) since the draggable
					// may have modified them in unexpected ways (#8809)
					sortable._storedCSS = {
						position: sortable.placeholder.css("position"),
						top: sortable.placeholder.css("top"),
						left: sortable.placeholder.css("left")
					};

					sortable._mouseStop(event);

					// Once drag has ended, the sortable should return to using
					// its original helper, not the shared helper from draggable
					sortable.options.helper = sortable.options._helper;
				} else {

					// Prevent this Sortable from removing the helper.
					// However, don't set the draggable to remove the helper
					// either as another connected Sortable may yet handle the
					// removal.
					sortable.cancelHelperRemoval = true;

					sortable._trigger("deactivate", event, uiSortable);
				}
			});
		},
		drag: function(event, ui, draggable) {
			$.each(draggable.sortables, function() {
				var innermostIntersecting = false, sortable = this;

				// Copy over variables that sortable's _intersectsWith uses
				sortable.positionAbs = draggable.positionAbs;
				sortable.helperProportions = draggable.helperProportions;
				sortable.offset.click = draggable.offset.click;

				if (sortable._intersectsWith(sortable.containerCache)) {
					innermostIntersecting = true;

					$.each(draggable.sortables, function() {

						// Copy over variables that sortable's _intersectsWith
						// uses
						this.positionAbs = draggable.positionAbs;
						this.helperProportions = draggable.helperProportions;
						this.offset.click = draggable.offset.click;

						if (this !== sortable && this._intersectsWith(this.containerCache) && $.contains(sortable.element[0], this.element[0])) {
							innermostIntersecting = false;
						}

						return innermostIntersecting;
					});
				}

				if (innermostIntersecting) {

					// If it intersects, we use a little isOver variable and set
					// it once,
					// so that the move-in stuff gets fired only once.
					if (!sortable.isOver) {
						sortable.isOver = 1;

						// Store draggable's parent in case we need to reappend
						// to it later.
						draggable._parent = ui.helper.parent();

						sortable.currentItem = ui.helper.appendTo(sortable.element).data("ui-sortable-item", true);

						// Store helper option to later restore it
						sortable.options._helper = sortable.options.helper;

						sortable.options.helper = function() {
							return ui.helper[0];
						};

						// Fire the start events of the sortable with our passed
						// browser event,
						// and our own helper (so it doesn't create a new one)
						event.target = sortable.currentItem[0];
						sortable._mouseCapture(event, true);
						sortable._mouseStart(event, true, true);

						// Because the browser event is way off the new appended
						// portlet,
						// modify necessary variables to reflect the changes
						sortable.offset.click.top = draggable.offset.click.top;
						sortable.offset.click.left = draggable.offset.click.left;
						sortable.offset.parent.left -= draggable.offset.parent.left - sortable.offset.parent.left;
						sortable.offset.parent.top -= draggable.offset.parent.top - sortable.offset.parent.top;

						draggable._trigger("toSortable", event);

						// Inform draggable that the helper is in a valid drop
						// zone,
						// used solely in the revert option to handle
						// "valid/invalid".
						draggable.dropped = sortable.element;

						// Need to refreshPositions of all sortables in the case
						// that
						// adding to one sortable changes the location of the
						// other sortables (#9675)
						$.each(draggable.sortables, function() {
							this.refreshPositions();
						});

						// Hack so receive/update callbacks work (mostly)
						draggable.currentItem = draggable.element;
						sortable.fromOutside = draggable;
					}

					if (sortable.currentItem) {
						sortable._mouseDrag(event);

						// Copy the sortable's position because the draggable's
						// can potentially reflect
						// a relative position, while sortable is always
						// absolute, which the dragged
						// element has now become. (#8809)
						ui.position = sortable.position;
					}
				} else {

					// If it doesn't intersect with the sortable, and it
					// intersected before,
					// we fake the drag stop of the sortable, but make sure it
					// doesn't remove
					// the helper by using cancelHelperRemoval.
					if (sortable.isOver) {

						sortable.isOver = 0;
						sortable.cancelHelperRemoval = true;

						// Calling sortable's mouseStop would trigger a revert,
						// so revert must be temporarily false until after
						// mouseStop is called.
						sortable.options._revert = sortable.options.revert;
						sortable.options.revert = false;

						sortable._trigger("out", event, sortable._uiHash(sortable));
						sortable._mouseStop(event, true);

						// Restore sortable behaviors that were modfied
						// when the draggable entered the sortable area (#9481)
						sortable.options.revert = sortable.options._revert;
						sortable.options.helper = sortable.options._helper;

						if (sortable.placeholder) {
							sortable.placeholder.remove();
						}

						// Restore and recalculate the draggable's offset
						// considering the sortable
						// may have modified them in unexpected ways. (#8809,
						// #10669)
						ui.helper.appendTo(draggable._parent);
						draggable._refreshOffsets(event);
						ui.position = draggable._generatePosition(event, true);

						draggable._trigger("fromSortable", event);

						// Inform draggable that the helper is no longer in a
						// valid drop zone
						draggable.dropped = false;

						// Need to refreshPositions of all sortables just in
						// case removing
						// from one sortable changes the location of other
						// sortables (#9675)
						$.each(draggable.sortables, function() {
							this.refreshPositions();
						});
					}
				}
			});
		}
	});

	$.ui.plugin.add("draggable", "cursor", {
		start: function(event, ui, instance) {
			var t = $("body"), o = instance.options;

			if (t.css("cursor")) {
				o._cursor = t.css("cursor");
			}
			t.css("cursor", o.cursor);
		},
		stop: function(event, ui, instance) {
			var o = instance.options;
			if (o._cursor) {
				$("body").css("cursor", o._cursor);
			}
		}
	});

	$.ui.plugin.add("draggable", "opacity", {
		start: function(event, ui, instance) {
			var t = $(ui.helper), o = instance.options;
			if (t.css("opacity")) {
				o._opacity = t.css("opacity");
			}
			t.css("opacity", o.opacity);
		},
		stop: function(event, ui, instance) {
			var o = instance.options;
			if (o._opacity) {
				$(ui.helper).css("opacity", o._opacity);
			}
		}
	});

	$.ui.plugin.add("draggable", "scroll", {
		start: function(event, ui, i) {
			if (!i.scrollParentNotHidden) {
				i.scrollParentNotHidden = i.helper.scrollParent(false);
			}

			if (i.scrollParentNotHidden[0] !== i.document[0] && i.scrollParentNotHidden[0].tagName !== "HTML") {
				i.overflowOffset = i.scrollParentNotHidden.offset();
			}
		},
		drag: function(event, ui, i) {

			var o = i.options, scrolled = false, scrollParent = i.scrollParentNotHidden[0], document = i.document[0];

			if (scrollParent !== document && scrollParent.tagName !== "HTML") {
				if (!o.axis || o.axis !== "x") {
					if ((i.overflowOffset.top + scrollParent.offsetHeight) - event.pageY < o.scrollSensitivity) {
						scrollParent.scrollTop = scrolled = scrollParent.scrollTop + o.scrollSpeed;
					} else if (event.pageY - i.overflowOffset.top < o.scrollSensitivity) {
						scrollParent.scrollTop = scrolled = scrollParent.scrollTop - o.scrollSpeed;
					}
				}

				if (!o.axis || o.axis !== "y") {
					if ((i.overflowOffset.left + scrollParent.offsetWidth) - event.pageX < o.scrollSensitivity) {
						scrollParent.scrollLeft = scrolled = scrollParent.scrollLeft + o.scrollSpeed;
					} else if (event.pageX - i.overflowOffset.left < o.scrollSensitivity) {
						scrollParent.scrollLeft = scrolled = scrollParent.scrollLeft - o.scrollSpeed;
					}
				}

			} else {

				if (!o.axis || o.axis !== "x") {
					if (event.pageY - $(document).scrollTop() < o.scrollSensitivity) {
						scrolled = $(document).scrollTop($(document).scrollTop() - o.scrollSpeed);
					} else if ($(window).height() - (event.pageY - $(document).scrollTop()) < o.scrollSensitivity) {
						scrolled = $(document).scrollTop($(document).scrollTop() + o.scrollSpeed);
					}
				}

				if (!o.axis || o.axis !== "y") {
					if (event.pageX - $(document).scrollLeft() < o.scrollSensitivity) {
						scrolled = $(document).scrollLeft($(document).scrollLeft() - o.scrollSpeed);
					} else if ($(window).width() - (event.pageX - $(document).scrollLeft()) < o.scrollSensitivity) {
						scrolled = $(document).scrollLeft($(document).scrollLeft() + o.scrollSpeed);
					}
				}

			}

			if (scrolled !== false && $.ui.ddmanager && !o.dropBehaviour) {
				$.ui.ddmanager.prepareOffsets(i, event);
			}

		}
	});

	$.ui.plugin.add("draggable", "snap", {
		start: function(event, ui, i) {

			var o = i.options;

			i.snapElements = [];

			$(o.snap.constructor !== String ? (o.snap.items || ":data(ui-draggable)") : o.snap).each(function() {
				var $t = $(this), $o = $t.offset();
				if (this !== i.element[0]) {
					i.snapElements.push({
						item: this,
						width: $t.outerWidth(),
						height: $t.outerHeight(),
						top: $o.top,
						left: $o.left
					});
				}
			});

		},
		drag: function(event, ui, inst) {

			var ts, bs, ls, rs, l, r, t, b, i, first, o = inst.options, d = o.snapTolerance, x1 = ui.offset.left, x2 = x1 + inst.helperProportions.width, y1 = ui.offset.top, y2 = y1 + inst.helperProportions.height;

			for (i = inst.snapElements.length - 1; i >= 0; i--) {

				l = inst.snapElements[i].left - inst.margins.left;
				r = l + inst.snapElements[i].width;
				t = inst.snapElements[i].top - inst.margins.top;
				b = t + inst.snapElements[i].height;

				if (x2 < l - d || x1 > r + d || y2 < t - d || y1 > b + d || !$.contains(inst.snapElements[i].item.ownerDocument, inst.snapElements[i].item)) {
					if (inst.snapElements[i].snapping) {
						(inst.options.snap.release && inst.options.snap.release.call(inst.element, event, $.extend(inst._uiHash(), {
							snapItem: inst.snapElements[i].item
						})));
					}
					inst.snapElements[i].snapping = false;
					continue;
				}

				if (o.snapMode !== "inner") {
					ts = Math.abs(t - y2) <= d;
					bs = Math.abs(b - y1) <= d;
					ls = Math.abs(l - x2) <= d;
					rs = Math.abs(r - x1) <= d;
					if (ts) {
						ui.position.top = inst._convertPositionTo("relative", {
							top: t - inst.helperProportions.height,
							left: 0
						}).top;
					}
					if (bs) {
						ui.position.top = inst._convertPositionTo("relative", {
							top: b,
							left: 0
						}).top;
					}
					if (ls) {
						ui.position.left = inst._convertPositionTo("relative", {
							top: 0,
							left: l - inst.helperProportions.width
						}).left;
					}
					if (rs) {
						ui.position.left = inst._convertPositionTo("relative", {
							top: 0,
							left: r
						}).left;
					}
				}

				first = (ts || bs || ls || rs);

				if (o.snapMode !== "outer") {
					ts = Math.abs(t - y1) <= d;
					bs = Math.abs(b - y2) <= d;
					ls = Math.abs(l - x1) <= d;
					rs = Math.abs(r - x2) <= d;
					if (ts) {
						ui.position.top = inst._convertPositionTo("relative", {
							top: t,
							left: 0
						}).top;
					}
					if (bs) {
						ui.position.top = inst._convertPositionTo("relative", {
							top: b - inst.helperProportions.height,
							left: 0
						}).top;
					}
					if (ls) {
						ui.position.left = inst._convertPositionTo("relative", {
							top: 0,
							left: l
						}).left;
					}
					if (rs) {
						ui.position.left = inst._convertPositionTo("relative", {
							top: 0,
							left: r - inst.helperProportions.width
						}).left;
					}
				}

				if (!inst.snapElements[i].snapping && (ts || bs || ls || rs || first)) {
					(inst.options.snap.snap && inst.options.snap.snap.call(inst.element, event, $.extend(inst._uiHash(), {
						snapItem: inst.snapElements[i].item
					})));
				}
				inst.snapElements[i].snapping = (ts || bs || ls || rs || first);

			}

		}
	});

	$.ui.plugin.add("draggable", "stack", {
		start: function(event, ui, instance) {
			var min, o = instance.options, group = $.makeArray($(o.stack)).sort(function(a, b) {
				return (parseInt($(a).css("zIndex"), 10) || 0) - (parseInt($(b).css("zIndex"), 10) || 0);
			});

			if (!group.length) {
				return;
			}

			min = parseInt($(group[0]).css("zIndex"), 10) || 0;
			$(group).each(function(i) {
				$(this).css("zIndex", min + i);
			});
			this.css("zIndex", (min + group.length));
		}
	});

	$.ui.plugin.add("draggable", "zIndex", {
		start: function(event, ui, instance) {
			var t = $(ui.helper), o = instance.options;

			if (t.css("zIndex")) {
				o._zIndex = t.css("zIndex");
			}
			t.css("zIndex", o.zIndex);
		},
		stop: function(event, ui, instance) {
			var o = instance.options;

			if (o._zIndex) {
				$(ui.helper).css("zIndex", o._zIndex);
			}
		}
	});

	var widgetsDraggable = $.ui.draggable;

	/*
	 * ! jQuery UI Resizable 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Resizable
	// >>group: Interactions
	// >>description: Enables resize functionality for any element.
	// >>docs: http://api.jqueryui.com/resizable/
	// >>demos: http://jqueryui.com/resizable/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/resizable.css
	// >>css.theme: ../../themes/base/theme.css
	$.widget("ui.resizable", $.ui.mouse, {
		version: "1.12.0-beta.1",
		widgetEventPrefix: "resize",
		options: {
			alsoResize: false,
			animate: false,
			animateDuration: "slow",
			animateEasing: "swing",
			aspectRatio: false,
			autoHide: false,
			classes: {
				"ui-resizable-se": "ui-icon ui-icon-gripsmall-diagonal-se"
			},
			containment: false,
			ghost: false,
			grid: false,
			handles: "e,s,se",
			helper: false,
			maxHeight: null,
			maxWidth: null,
			minHeight: 10,
			minWidth: 10,

			// See #7960
			zIndex: 90,

			// Callbacks
			resize: null,
			start: null,
			stop: null
		},

		_num: function(value) {
			return parseFloat(value) || 0;
		},

		_isNumber: function(value) {
			return !isNaN(parseFloat(value));
		},

		_hasScroll: function(el, a) {

			if ($(el).css("overflow") === "hidden") {
				return false;
			}

			var scroll = (a && a === "left") ? "scrollLeft" : "scrollTop", has = false;

			if (el[scroll] > 0) {
				return true;
			}

			// TODO: determine which cases actually cause this to happen
			// if the element doesn't have the scroll set, see if it's possible
			// to
			// set the scroll
			el[scroll] = 1;
			has = (el[scroll] > 0);
			el[scroll] = 0;
			return has;
		},

		_create: function() {

			var n, i, handle, axis, hname, margins, that = this, o = this.options;
			this._addClass("ui-resizable");

			$.extend(this, {
				_aspectRatio: !!(o.aspectRatio),
				aspectRatio: o.aspectRatio,
				originalElement: this.element,
				_proportionallyResizeElements: [],
				_helper: o.helper || o.ghost || o.animate ? o.helper || "ui-resizable-helper" : null
			});

			// Wrap the element if it cannot hold child nodes
			if (this.element[0].nodeName.match(/^(canvas|textarea|input|select|button|img)$/i)) {

				this.element.wrap($("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
					position: this.element.css("position"),
					width: this.element.outerWidth(),
					height: this.element.outerHeight(),
					top: this.element.css("top"),
					left: this.element.css("left")
				}));

				this.element = this.element.parent().data("ui-resizable", this.element.resizable("instance"));

				this.elementIsWrapper = true;

				margins = {
					marginTop: this.originalElement.css("marginTop"),
					marginRight: this.originalElement.css("marginRight"),
					marginBottom: this.originalElement.css("marginBottom"),
					marginLeft: this.originalElement.css("marginLeft")
				};

				this.element.css(margins);
				this.originalElement.css("margin", 0);

				// support: Safari
				// Prevent Safari textarea resize
				this.originalResizeStyle = this.originalElement.css("resize");
				this.originalElement.css("resize", "none");

				this._proportionallyResizeElements.push(this.originalElement.css({
					position: "static",
					zoom: 1,
					display: "block"
				}));

				// Support: IE9
				// avoid IE jump (hard set the margin)
				this.originalElement.css(margins);

				this._proportionallyResize();
			}

			this.handles = o.handles || (!$(".ui-resizable-handle", this.element).length ? "e,s,se" : {
				n: ".ui-resizable-n",
				e: ".ui-resizable-e",
				s: ".ui-resizable-s",
				w: ".ui-resizable-w",
				se: ".ui-resizable-se",
				sw: ".ui-resizable-sw",
				ne: ".ui-resizable-ne",
				nw: ".ui-resizable-nw"
			});

			this._handles = $();
			if (this.handles.constructor === String) {

				if (this.handles === "all") {
					this.handles = "n,e,s,w,se,sw,ne,nw";
				}

				n = this.handles.split(",");
				this.handles = {};

				for (i = 0; i < n.length; i++) {

					handle = $.trim(n[i]);
					hname = "ui-resizable-" + handle;
					axis = $("<div>");
					this._addClass(axis, "ui-resizable-handle " + hname);

					axis.css({
						zIndex: o.zIndex
					});

					this.handles[handle] = ".ui-resizable-" + handle;
					this.element.append(axis);
				}

			}

			this._renderAxis = function(target) {

				var i, axis, padPos, padWrapper;

				target = target || this.element;

				for (i in this.handles) {

					if (this.handles[i].constructor === String) {
						this.handles[i] = this.element.children(this.handles[i]).first().show();
					} else if (this.handles[i].jquery || this.handles[i].nodeType) {
						this.handles[i] = $(this.handles[i]);
						this._on(this.handles[i], {
							"mousedown": that._mouseDown
						});
					}

					if (this.elementIsWrapper && this.originalElement[0].nodeName.match(/^(textarea|input|select|button)$/i)) {

						axis = $(this.handles[i], this.element);

						padWrapper = /sw|ne|nw|se|n|s/.test(i) ? axis.outerHeight() : axis.outerWidth();

						padPos = ["padding", /ne|nw|n/.test(i) ? "Top" : /se|sw|s/.test(i) ? "Bottom" : /^e$/.test(i) ? "Right" : "Left"].join("");

						target.css(padPos, padWrapper);

						this._proportionallyResize();
					}

					this._handles = this._handles.add(this.handles[i]);
				}
			};

			// TODO: make renderAxis a prototype function
			this._renderAxis(this.element);

			this._handles = this._handles.add(this.element.find(".ui-resizable-handle"));
			this._handles.disableSelection();

			this._handles.on("mouseover", function() {
				if (!that.resizing) {
					if (this.className) {
						axis = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i);
					}
					that.axis = axis && axis[1] ? axis[1] : "se";
				}
			});

			if (o.autoHide) {
				this._handles.hide();
				this._addClass("ui-resizable-autohide");
				$(this.element).on("mouseenter", function() {
					if (o.disabled) {
						return;
					}
					that._removeClass("ui-resizable-autohide");
					that._handles.show();
				}).on("mouseleave", function() {
					if (o.disabled) {
						return;
					}
					if (!that.resizing) {
						that._addClass("ui-resizable-autohide");
						that._handles.hide();
					}
				});
			}

			this._mouseInit();
		},

		_destroy: function() {

			this._mouseDestroy();

			var wrapper, _destroy = function(exp) {
				$(exp).removeData("resizable").removeData("ui-resizable").off(".resizable").find(".ui-resizable-handle").remove();
			};

			// TODO: Unwrap at same DOM position
			if (this.elementIsWrapper) {
				_destroy(this.element);
				wrapper = this.element;
				this.originalElement.css({
					position: wrapper.css("position"),
					width: wrapper.outerWidth(),
					height: wrapper.outerHeight(),
					top: wrapper.css("top"),
					left: wrapper.css("left")
				}).insertAfter(wrapper);
				wrapper.remove();
			}

			this.originalElement.css("resize", this.originalResizeStyle);
			_destroy(this.originalElement);

			return this;
		},

		_mouseCapture: function(event) {
			var i, handle, capture = false;

			for (i in this.handles) {
				handle = $(this.handles[i])[0];
				if (handle === event.target || $.contains(handle, event.target)) {
					capture = true;
				}
			}

			return !this.options.disabled && capture;
		},

		_mouseStart: function(event) {

			var curleft, curtop, cursor, o = this.options, el = this.element;

			this.resizing = true;

			this._renderProxy();

			curleft = this._num(this.helper.css("left"));
			curtop = this._num(this.helper.css("top"));

			if (o.containment) {
				curleft += $(o.containment).scrollLeft() || 0;
				curtop += $(o.containment).scrollTop() || 0;
			}

			this.offset = this.helper.offset();
			this.position = {
				left: curleft,
				top: curtop
			};

			this.size = this._helper ? {
				width: this.helper.width(),
				height: this.helper.height()
			} : {
				width: el.width(),
				height: el.height()
			};

			this.originalSize = this._helper ? {
				width: el.outerWidth(),
				height: el.outerHeight()
			} : {
				width: el.width(),
				height: el.height()
			};

			this.sizeDiff = {
				width: el.outerWidth() - el.width(),
				height: el.outerHeight() - el.height()
			};

			this.originalPosition = {
				left: curleft,
				top: curtop
			};
			this.originalMousePosition = {
				left: event.pageX,
				top: event.pageY
			};

			this.aspectRatio = (typeof o.aspectRatio === "number") ? o.aspectRatio : ((this.originalSize.width / this.originalSize.height) || 1);

			cursor = $(".ui-resizable-" + this.axis).css("cursor");
			$("body").css("cursor", cursor === "auto" ? this.axis + "-resize" : cursor);

			this._addClass("ui-resizable-resizing");
			this._propagate("start", event);
			return true;
		},

		_mouseDrag: function(event) {

			var data, props, smp = this.originalMousePosition, a = this.axis, dx = (event.pageX - smp.left) || 0, dy = (event.pageY - smp.top) || 0, trigger = this._change[a];

			this._updatePrevProperties();

			if (!trigger) {
				return false;
			}

			data = trigger.apply(this, [event, dx, dy]);

			this._updateVirtualBoundaries(event.shiftKey);
			if (this._aspectRatio || event.shiftKey) {
				data = this._updateRatio(data, event);
			}

			data = this._respectSize(data, event);

			this._updateCache(data);

			this._propagate("resize", event);

			props = this._applyChanges();

			if (!this._helper && this._proportionallyResizeElements.length) {
				this._proportionallyResize();
			}

			if (!$.isEmptyObject(props)) {
				this._updatePrevProperties();
				this._trigger("resize", event, this.ui());
				this._applyChanges();
			}

			return false;
		},

		_mouseStop: function(event) {

			this.resizing = false;
			var pr, ista, soffseth, soffsetw, s, left, top, o = this.options, that = this;

			if (this._helper) {

				pr = this._proportionallyResizeElements;
				ista = pr.length && (/textarea/i).test(pr[0].nodeName);
				soffseth = ista && this._hasScroll(pr[0], "left") ? 0 : that.sizeDiff.height;
				soffsetw = ista ? 0 : that.sizeDiff.width;

				s = {
					width: (that.helper.width() - soffsetw),
					height: (that.helper.height() - soffseth)
				};
				left = (parseFloat(that.element.css("left")) + (that.position.left - that.originalPosition.left)) || null;
				top = (parseFloat(that.element.css("top")) + (that.position.top - that.originalPosition.top)) || null;

				if (!o.animate) {
					this.element.css($.extend(s, {
						top: top,
						left: left
					}));
				}

				that.helper.height(that.size.height);
				that.helper.width(that.size.width);

				if (this._helper && !o.animate) {
					this._proportionallyResize();
				}
			}

			$("body").css("cursor", "auto");

			this._removeClass("ui-resizable-resizing");

			this._propagate("stop", event);

			if (this._helper) {
				this.helper.remove();
			}

			return false;

		},

		_updatePrevProperties: function() {
			this.prevPosition = {
				top: this.position.top,
				left: this.position.left
			};
			this.prevSize = {
				width: this.size.width,
				height: this.size.height
			};
		},

		_applyChanges: function() {
			var props = {};

			if (this.position.top !== this.prevPosition.top) {
				props.top = this.position.top + "px";
			}
			if (this.position.left !== this.prevPosition.left) {
				props.left = this.position.left + "px";
			}
			if (this.size.width !== this.prevSize.width) {
				props.width = this.size.width + "px";
			}
			if (this.size.height !== this.prevSize.height) {
				props.height = this.size.height + "px";
			}

			this.helper.css(props);

			return props;
		},

		_updateVirtualBoundaries: function(forceAspectRatio) {
			var pMinWidth, pMaxWidth, pMinHeight, pMaxHeight, b, o = this.options;

			b = {
				minWidth: this._isNumber(o.minWidth) ? o.minWidth : 0,
				maxWidth: this._isNumber(o.maxWidth) ? o.maxWidth : Infinity,
				minHeight: this._isNumber(o.minHeight) ? o.minHeight : 0,
				maxHeight: this._isNumber(o.maxHeight) ? o.maxHeight : Infinity
			};

			if (this._aspectRatio || forceAspectRatio) {
				pMinWidth = b.minHeight * this.aspectRatio;
				pMinHeight = b.minWidth / this.aspectRatio;
				pMaxWidth = b.maxHeight * this.aspectRatio;
				pMaxHeight = b.maxWidth / this.aspectRatio;

				if (pMinWidth > b.minWidth) {
					b.minWidth = pMinWidth;
				}
				if (pMinHeight > b.minHeight) {
					b.minHeight = pMinHeight;
				}
				if (pMaxWidth < b.maxWidth) {
					b.maxWidth = pMaxWidth;
				}
				if (pMaxHeight < b.maxHeight) {
					b.maxHeight = pMaxHeight;
				}
			}
			this._vBoundaries = b;
		},

		_updateCache: function(data) {
			this.offset = this.helper.offset();
			if (this._isNumber(data.left)) {
				this.position.left = data.left;
			}
			if (this._isNumber(data.top)) {
				this.position.top = data.top;
			}
			if (this._isNumber(data.height)) {
				this.size.height = data.height;
			}
			if (this._isNumber(data.width)) {
				this.size.width = data.width;
			}
		},

		_updateRatio: function(data) {

			var cpos = this.position, csize = this.size, a = this.axis;

			if (this._isNumber(data.height)) {
				data.width = (data.height * this.aspectRatio);
			} else if (this._isNumber(data.width)) {
				data.height = (data.width / this.aspectRatio);
			}

			if (a === "sw") {
				data.left = cpos.left + (csize.width - data.width);
				data.top = null;
			}
			if (a === "nw") {
				data.top = cpos.top + (csize.height - data.height);
				data.left = cpos.left + (csize.width - data.width);
			}

			return data;
		},

		_respectSize: function(data) {

			var o = this._vBoundaries, a = this.axis, ismaxw = this._isNumber(data.width) && o.maxWidth && (o.maxWidth < data.width), ismaxh = this._isNumber(data.height) && o.maxHeight && (o.maxHeight < data.height), isminw = this._isNumber(data.width) && o.minWidth && (o.minWidth > data.width), isminh = this._isNumber(data.height) && o.minHeight && (o.minHeight > data.height), dw = this.originalPosition.left + this.originalSize.width, dh = this.position.top + this.size.height, cw = /sw|nw|w/.test(a), ch = /nw|ne|n/.test(a);
			if (isminw) {
				data.width = o.minWidth;
			}
			if (isminh) {
				data.height = o.minHeight;
			}
			if (ismaxw) {
				data.width = o.maxWidth;
			}
			if (ismaxh) {
				data.height = o.maxHeight;
			}

			if (isminw && cw) {
				data.left = dw - o.minWidth;
			}
			if (ismaxw && cw) {
				data.left = dw - o.maxWidth;
			}
			if (isminh && ch) {
				data.top = dh - o.minHeight;
			}
			if (ismaxh && ch) {
				data.top = dh - o.maxHeight;
			}

			// Fixing jump error on top/left - bug #2330
			if (!data.width && !data.height && !data.left && data.top) {
				data.top = null;
			} else if (!data.width && !data.height && !data.top && data.left) {
				data.left = null;
			}

			return data;
		},

		_getPaddingPlusBorderDimensions: function(element) {
			var i = 0, widths = [], borders = [element.css("borderTopWidth"), element.css("borderRightWidth"), element.css("borderBottomWidth"), element.css("borderLeftWidth")], paddings = [element.css("paddingTop"), element.css("paddingRight"), element.css("paddingBottom"), element.css("paddingLeft")];

			for (; i < 4; i++) {
				widths[i] = (parseFloat(borders[i]) || 0);
				widths[i] += (parseFloat(paddings[i]) || 0);
			}

			return {
				height: widths[0] + widths[2],
				width: widths[1] + widths[3]
			};
		},

		_proportionallyResize: function() {

			if (!this._proportionallyResizeElements.length) {
				return;
			}

			var prel, i = 0, element = this.helper || this.element;

			for (; i < this._proportionallyResizeElements.length; i++) {

				prel = this._proportionallyResizeElements[i];

				// TODO: Seems like a bug to cache this.outerDimensions
				// considering that we are in a loop.
				if (!this.outerDimensions) {
					this.outerDimensions = this._getPaddingPlusBorderDimensions(prel);
				}

				prel.css({
					height: (element.height() - this.outerDimensions.height) || 0,
					width: (element.width() - this.outerDimensions.width) || 0
				});

			}

		},

		_renderProxy: function() {

			var el = this.element, o = this.options;
			this.elementOffset = el.offset();

			if (this._helper) {

				this.helper = this.helper || $("<div style='overflow:hidden;'></div>");

				this._addClass(this.helper, this._helper);
				this.helper.css({
					width: this.element.outerWidth(),
					height: this.element.outerHeight(),
					position: "absolute",
					left: this.elementOffset.left + "px",
					top: this.elementOffset.top + "px",
					zIndex: ++o.zIndex
				// TODO: Don't modify option
				});

				this.helper.appendTo("body").disableSelection();

			} else {
				this.helper = this.element;
			}

		},

		_change: {
			e: function(event, dx) {
				return {
					width: this.originalSize.width + dx
				};
			},
			w: function(event, dx) {
				var cs = this.originalSize, sp = this.originalPosition;
				return {
					left: sp.left + dx,
					width: cs.width - dx
				};
			},
			n: function(event, dx, dy) {
				var cs = this.originalSize, sp = this.originalPosition;
				return {
					top: sp.top + dy,
					height: cs.height - dy
				};
			},
			s: function(event, dx, dy) {
				return {
					height: this.originalSize.height + dy
				};
			},
			se: function(event, dx, dy) {
				return $.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [event, dx, dy]));
			},
			sw: function(event, dx, dy) {
				return $.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [event, dx, dy]));
			},
			ne: function(event, dx, dy) {
				return $.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [event, dx, dy]));
			},
			nw: function(event, dx, dy) {
				return $.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [event, dx, dy]));
			}
		},

		_propagate: function(n, event) {
			$.ui.plugin.call(this, n, [event, this.ui()]);
			(n !== "resize" && this._trigger(n, event, this.ui()));
		},

		plugins: {},

		ui: function() {
			return {
				originalElement: this.originalElement,
				element: this.element,
				helper: this.helper,
				position: this.position,
				size: this.size,
				originalSize: this.originalSize,
				originalPosition: this.originalPosition
			};
		}

	});

	/*
	 * Resizable Extensions
	 */

	$.ui.plugin.add("resizable", "animate", {

		stop: function(event) {
			var that = $(this).resizable("instance"), o = that.options, pr = that._proportionallyResizeElements, ista = pr.length && (/textarea/i).test(pr[0].nodeName), soffseth = ista && that._hasScroll(pr[0], "left") ? 0 : that.sizeDiff.height, soffsetw = ista ? 0 : that.sizeDiff.width, style = {
				width: (that.size.width - soffsetw),
				height: (that.size.height - soffseth)
			}, left = (parseFloat(that.element.css("left")) + (that.position.left - that.originalPosition.left)) || null, top = (parseFloat(that.element.css("top")) + (that.position.top - that.originalPosition.top)) || null;

			that.element.animate($.extend(style, top && left ? {
				top: top,
				left: left
			} : {}), {
				duration: o.animateDuration,
				easing: o.animateEasing,
				step: function() {

					var data = {
						width: parseFloat(that.element.css("width")),
						height: parseFloat(that.element.css("height")),
						top: parseFloat(that.element.css("top")),
						left: parseFloat(that.element.css("left"))
					};

					if (pr && pr.length) {
						$(pr[0]).css({
							width: data.width,
							height: data.height
						});
					}

					// Propagating resize, and updating values for each
					// animation step
					that._updateCache(data);
					that._propagate("resize", event);

				}
			});
		}

	});

	$.ui.plugin.add("resizable", "containment", {

		start: function() {
			var element, p, co, ch, cw, width, height, that = $(this).resizable("instance"), o = that.options, el = that.element, oc = o.containment, ce = (oc instanceof $) ? oc.get(0) : (/parent/.test(oc)) ? el.parent().get(0) : oc;

			if (!ce) {
				return;
			}

			that.containerElement = $(ce);

			if (/document/.test(oc) || oc === document) {
				that.containerOffset = {
					left: 0,
					top: 0
				};
				that.containerPosition = {
					left: 0,
					top: 0
				};

				that.parentData = {
					element: $(document),
					left: 0,
					top: 0,
					width: $(document).width(),
					height: $(document).height() || document.body.parentNode.scrollHeight
				};
			} else {
				element = $(ce);
				p = [];
				$(["Top", "Right", "Left", "Bottom"]).each(function(i, name) {
					p[i] = that._num(element.css("padding" + name));
				});

				that.containerOffset = element.offset();
				that.containerPosition = element.position();
				that.containerSize = {
					height: (element.innerHeight() - p[3]),
					width: (element.innerWidth() - p[1])
				};

				co = that.containerOffset;
				ch = that.containerSize.height;
				cw = that.containerSize.width;
				width = (that._hasScroll(ce, "left") ? ce.scrollWidth : cw);
				height = (that._hasScroll(ce) ? ce.scrollHeight : ch);

				that.parentData = {
					element: ce,
					left: co.left,
					top: co.top,
					width: width,
					height: height
				};
			}
		},

		resize: function(event) {
			var woset, hoset, isParent, isOffsetRelative, that = $(this).resizable("instance"), o = that.options, co = that.containerOffset, cp = that.position, pRatio = that._aspectRatio || event.shiftKey, cop = {
				top: 0,
				left: 0
			}, ce = that.containerElement, continueResize = true;

			if (ce[0] !== document && (/static/).test(ce.css("position"))) {
				cop = co;
			}

			if (cp.left < (that._helper ? co.left : 0)) {
				that.size.width = that.size.width + (that._helper ? (that.position.left - co.left) : (that.position.left - cop.left));

				if (pRatio) {
					that.size.height = that.size.width / that.aspectRatio;
					continueResize = false;
				}
				that.position.left = o.helper ? co.left : 0;
			}

			if (cp.top < (that._helper ? co.top : 0)) {
				that.size.height = that.size.height + (that._helper ? (that.position.top - co.top) : that.position.top);

				if (pRatio) {
					that.size.width = that.size.height * that.aspectRatio;
					continueResize = false;
				}
				that.position.top = that._helper ? co.top : 0;
			}

			isParent = that.containerElement.get(0) === that.element.parent().get(0);
			isOffsetRelative = /relative|absolute/.test(that.containerElement.css("position"));

			if (isParent && isOffsetRelative) {
				that.offset.left = that.parentData.left + that.position.left;
				that.offset.top = that.parentData.top + that.position.top;
			} else {
				that.offset.left = that.element.offset().left;
				that.offset.top = that.element.offset().top;
			}

			woset = Math.abs(that.sizeDiff.width + (that._helper ? that.offset.left - cop.left : (that.offset.left - co.left)));

			hoset = Math.abs(that.sizeDiff.height + (that._helper ? that.offset.top - cop.top : (that.offset.top - co.top)));

			if (woset + that.size.width >= that.parentData.width) {
				that.size.width = that.parentData.width - woset;
				if (pRatio) {
					that.size.height = that.size.width / that.aspectRatio;
					continueResize = false;
				}
			}

			if (hoset + that.size.height >= that.parentData.height) {
				that.size.height = that.parentData.height - hoset;
				if (pRatio) {
					that.size.width = that.size.height * that.aspectRatio;
					continueResize = false;
				}
			}

			if (!continueResize) {
				that.position.left = that.prevPosition.left;
				that.position.top = that.prevPosition.top;
				that.size.width = that.prevSize.width;
				that.size.height = that.prevSize.height;
			}
		},

		stop: function() {
			var that = $(this).resizable("instance"), o = that.options, co = that.containerOffset, cop = that.containerPosition, ce = that.containerElement, helper = $(that.helper), ho = helper.offset(), w = helper.outerWidth() - that.sizeDiff.width, h = helper.outerHeight() - that.sizeDiff.height;

			if (that._helper && !o.animate && (/relative/).test(ce.css("position"))) {
				$(this).css({
					left: ho.left - cop.left - co.left,
					width: w,
					height: h
				});
			}

			if (that._helper && !o.animate && (/static/).test(ce.css("position"))) {
				$(this).css({
					left: ho.left - cop.left - co.left,
					width: w,
					height: h
				});
			}
		}
	});

	$.ui.plugin.add("resizable", "alsoResize", {

		start: function() {
			var that = $(this).resizable("instance"), o = that.options;

			$(o.alsoResize).each(function() {
				var el = $(this);
				el.data("ui-resizable-alsoresize", {
					width: parseFloat(el.width()),
					height: parseFloat(el.height()),
					left: parseFloat(el.css("left")),
					top: parseFloat(el.css("top"))
				});
			});
		},

		resize: function(event, ui) {
			var that = $(this).resizable("instance"), o = that.options, os = that.originalSize, op = that.originalPosition, delta = {
				height: (that.size.height - os.height) || 0,
				width: (that.size.width - os.width) || 0,
				top: (that.position.top - op.top) || 0,
				left: (that.position.left - op.left) || 0
			};

			$(o.alsoResize).each(function() {
				var el = $(this), start = $(this).data("ui-resizable-alsoresize"), style = {}, css = el.parents(ui.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];

				$.each(css, function(i, prop) {
					var sum = (start[prop] || 0) + (delta[prop] || 0);
					if (sum && sum >= 0) {
						style[prop] = sum || null;
					}
				});

				el.css(style);
			});
		},

		stop: function() {
			$(this).removeData("ui-resizable-alsoresize");
		}
	});

	$.ui.plugin.add("resizable", "ghost", {

		start: function() {

			var that = $(this).resizable("instance"), cs = that.size;

			that.ghost = that.originalElement.clone();
			that.ghost.css({
				opacity: 0.25,
				display: "block",
				position: "relative",
				height: cs.height,
				width: cs.width,
				margin: 0,
				left: 0,
				top: 0
			});

			that._addClass(that.ghost, "ui-resizable-ghost");

			// DEPRECATED
			// TODO: remove after 1.12
			if ($.uiBackCompat !== false && typeof that.options.ghost === "string") {

				// Ghost option
				that.ghost.addClass(this.options.ghost);
			}

			that.ghost.appendTo(that.helper);

		},

		resize: function() {
			var that = $(this).resizable("instance");
			if (that.ghost) {
				that.ghost.css({
					position: "relative",
					height: that.size.height,
					width: that.size.width
				});
			}
		},

		stop: function() {
			var that = $(this).resizable("instance");
			if (that.ghost && that.helper) {
				that.helper.get(0).removeChild(that.ghost.get(0));
			}
		}

	});

	$.ui.plugin.add("resizable", "grid", {

		resize: function() {
			var outerDimensions, that = $(this).resizable("instance"), o = that.options, cs = that.size, os = that.originalSize, op = that.originalPosition, a = that.axis, grid = typeof o.grid === "number" ? [o.grid, o.grid] : o.grid, gridX = (grid[0] || 1), gridY = (grid[1] || 1), ox = Math.round((cs.width - os.width) / gridX) * gridX, oy = Math.round((cs.height - os.height) / gridY) * gridY, newWidth = os.width + ox, newHeight = os.height + oy, isMaxWidth = o.maxWidth && (o.maxWidth < newWidth), isMaxHeight = o.maxHeight && (o.maxHeight < newHeight), isMinWidth = o.minWidth && (o.minWidth > newWidth), isMinHeight = o.minHeight && (o.minHeight > newHeight);

			o.grid = grid;

			if (isMinWidth) {
				newWidth += gridX;
			}
			if (isMinHeight) {
				newHeight += gridY;
			}
			if (isMaxWidth) {
				newWidth -= gridX;
			}
			if (isMaxHeight) {
				newHeight -= gridY;
			}

			if (/^(se|s|e)$/.test(a)) {
				that.size.width = newWidth;
				that.size.height = newHeight;
			} else if (/^(ne)$/.test(a)) {
				that.size.width = newWidth;
				that.size.height = newHeight;
				that.position.top = op.top - oy;
			} else if (/^(sw)$/.test(a)) {
				that.size.width = newWidth;
				that.size.height = newHeight;
				that.position.left = op.left - ox;
			} else {
				if (newHeight - gridY <= 0 || newWidth - gridX <= 0) {
					outerDimensions = that._getPaddingPlusBorderDimensions(this);
				}

				if (newHeight - gridY > 0) {
					that.size.height = newHeight;
					that.position.top = op.top - oy;
				} else {
					newHeight = gridY - outerDimensions.height;
					that.size.height = newHeight;
					that.position.top = op.top + os.height - newHeight;
				}
				if (newWidth - gridX > 0) {
					that.size.width = newWidth;
					that.position.left = op.left - ox;
				} else {
					newWidth = gridX - outerDimensions.width;
					that.size.width = newWidth;
					that.position.left = op.left + os.width - newWidth;
				}
			}
		}

	});

	var widgetsResizable = $.ui.resizable;

	/*
	 * ! jQuery UI Accordion 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Accordion
	// >>group: Widgets
	// >>description: Displays collapsible content panels for presenting
	// information in a limited amount of space.
	// >>docs: http://api.jqueryui.com/accordion/
	// >>demos: http://jqueryui.com/accordion/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/accordion.css
	// >>css.theme: ../../themes/base/theme.css
	var widgetsAccordion = $.widget("ui.accordion", {
		version: "1.12.0-beta.1",
		options: {
			active: 0,
			animate: {},
			classes: {
				"ui-accordion-header": "ui-corner-top",
				"ui-accordion-header-collapsed": "ui-corner-all",
				"ui-accordion-content": "ui-corner-bottom"
			},
			collapsible: false,
			event: "click",
			header: "> li > :first-child, > :not(li):even",
			heightStyle: "auto",
			icons: {
				activeHeader: "ui-icon-triangle-1-s",
				header: "ui-icon-triangle-1-e"
			},

			// Callbacks
			activate: null,
			beforeActivate: null
		},

		hideProps: {
			borderTopWidth: "hide",
			borderBottomWidth: "hide",
			paddingTop: "hide",
			paddingBottom: "hide",
			height: "hide"
		},

		showProps: {
			borderTopWidth: "show",
			borderBottomWidth: "show",
			paddingTop: "show",
			paddingBottom: "show",
			height: "show"
		},

		_create: function() {
			var options = this.options;

			this.prevShow = this.prevHide = $();
			this._addClass("ui-accordion", "ui-widget ui-helper-reset");
			this.element.attr("role", "tablist");

			// Don't allow collapsible: false and active: false / null
			if (!options.collapsible && (options.active === false || options.active == null)) {
				options.active = 0;
			}

			this._processPanels();

			// handle negative values
			if (options.active < 0) {
				options.active += this.headers.length;
			}
			this._refresh();
		},

		_getCreateEventData: function() {
			return {
				header: this.active,
				panel: !this.active.length ? $() : this.active.next()
			};
		},

		_createIcons: function() {
			var icon, children, icons = this.options.icons;

			if (icons) {
				icon = $("<span>");
				this._addClass(icon, "ui-accordion-header-icon", "ui-icon " + icons.header);
				icon.prependTo(this.headers);
				children = this.active.children(".ui-accordion-header-icon");
				this._removeClass(children, icons.header)._addClass(children, null, icons.activeHeader)._addClass(this.headers, "ui-accordion-icons");
			}
		},

		_destroyIcons: function() {
			this._removeClass(this.headers, "ui-accordion-icons");
			this.headers.children(".ui-accordion-header-icon").remove();
		},

		_destroy: function() {
			var contents;

			// Clean up main element
			this.element.removeAttr("role");

			// Clean up headers
			this.headers.removeAttr("role aria-expanded aria-selected aria-controls tabIndex").removeUniqueId();

			this._destroyIcons();

			// Clean up content panels
			contents = this.headers.next().css("display", "").removeAttr("role aria-hidden aria-labelledby").removeUniqueId();

			if (this.options.heightStyle !== "content") {
				contents.css("height", "");
			}
		},

		_setOption: function(key, value) {
			if (key === "active") {

				// _activate() will handle invalid values and update
				// this.options
				this._activate(value);
				return;
			}

			if (key === "event") {
				if (this.options.event) {
					this._off(this.headers, this.options.event);
				}
				this._setupEvents(value);
			}

			this._super(key, value);

			// Setting collapsible: false while collapsed; open first panel
			if (key === "collapsible" && !value && this.options.active === false) {
				this._activate(0);
			}

			if (key === "icons") {
				this._destroyIcons();
				if (value) {
					this._createIcons();
				}
			}
		},

		_setOptionDisabled: function(value) {
			this._super(value);

			this.element.attr("aria-disabled", value);

			// Support: IE8 Only
			// #5332 / #6059 - opacity doesn't cascade to positioned elements in
			// IE
			// so we need to add the disabled class to the headers and panels
			this._toggleClass(null, "ui-state-disabled", !!value);
			this._toggleClass(this.headers.add(this.headers.next()), null, "ui-state-disabled", !!value);
		},

		_keydown: function(event) {
			if (event.altKey || event.ctrlKey) {
				return;
			}

			var keyCode = $.ui.keyCode, length = this.headers.length, currentIndex = this.headers.index(event.target), toFocus = false;

			switch (event.keyCode) {
				case keyCode.RIGHT:
				case keyCode.DOWN:
					toFocus = this.headers[(currentIndex + 1) % length];
					break;
				case keyCode.LEFT:
				case keyCode.UP:
					toFocus = this.headers[(currentIndex - 1 + length) % length];
					break;
				case keyCode.SPACE:
				case keyCode.ENTER:
					this._eventHandler(event);
					break;
				case keyCode.HOME:
					toFocus = this.headers[0];
					break;
				case keyCode.END:
					toFocus = this.headers[length - 1];
					break;
			}

			if (toFocus) {
				$(event.target).attr("tabIndex", -1);
				$(toFocus).attr("tabIndex", 0);
				$(toFocus).trigger("focus");
				event.preventDefault();
			}
		},

		_panelKeyDown: function(event) {
			if (event.keyCode === $.ui.keyCode.UP && event.ctrlKey) {
				$(event.currentTarget).prev().trigger("focus");
			}
		},

		refresh: function() {
			var options = this.options;
			this._processPanels();

			// Was collapsed or no panel
			if ((options.active === false && options.collapsible === true) || !this.headers.length) {
				options.active = false;
				this.active = $();

				// active false only when collapsible is true
			} else if (options.active === false) {
				this._activate(0);

				// was active, but active panel is gone
			} else if (this.active.length && !$.contains(this.element[0], this.active[0])) {

				// all remaining panel are disabled
				if (this.headers.length === this.headers.find(".ui-state-disabled").length) {
					options.active = false;
					this.active = $();

					// activate previous panel
				} else {
					this._activate(Math.max(0, options.active - 1));
				}

				// was active, active panel still exists
			} else {

				// make sure active index is correct
				options.active = this.headers.index(this.active);
			}

			this._destroyIcons();

			this._refresh();
		},

		_processPanels: function() {
			var prevHeaders = this.headers, prevPanels = this.panels;

			this.headers = this.element.find(this.options.header);
			this._addClass(this.headers, "ui-accordion-header ui-accordion-header-collapsed", "ui-state-default");

			this.panels = this.headers.next().filter(":not(.ui-accordion-content-active)").hide();
			this._addClass(this.panels, "ui-accordion-content", "ui-helper-reset ui-widget-content");

			// Avoid memory leaks (#10056)
			if (prevPanels) {
				this._off(prevHeaders.not(this.headers));
				this._off(prevPanels.not(this.panels));
			}
		},

		_refresh: function() {
			var maxHeight, options = this.options, heightStyle = options.heightStyle, parent = this.element.parent();

			this.active = this._findActive(options.active);
			this._addClass(this.active, "ui-accordion-header-active", "ui-state-active")._removeClass(this.active, "ui-accordion-header-collapsed");
			this._addClass(this.active.next(), "ui-accordion-content-active");
			this.active.next().show();

			this.headers.attr("role", "tab").each(function() {
				var header = $(this), headerId = header.uniqueId().attr("id"), panel = header.next(), panelId = panel.uniqueId().attr("id");
				header.attr("aria-controls", panelId);
				panel.attr("aria-labelledby", headerId);
			}).next().attr("role", "tabpanel");

			this.headers.not(this.active).attr({
				"aria-selected": "false",
				"aria-expanded": "false",
				tabIndex: -1
			}).next().attr({
				"aria-hidden": "true"
			}).hide();

			// Make sure at least one header is in the tab order
			if (!this.active.length) {
				this.headers.eq(0).attr("tabIndex", 0);
			} else {
				this.active.attr({
					"aria-selected": "true",
					"aria-expanded": "true",
					tabIndex: 0
				}).next().attr({
					"aria-hidden": "false"
				});
			}

			this._createIcons();

			this._setupEvents(options.event);

			if (heightStyle === "fill") {
				maxHeight = parent.height();
				this.element.siblings(":visible").each(function() {
					var elem = $(this), position = elem.css("position");

					if (position === "absolute" || position === "fixed") {
						return;
					}
					maxHeight -= elem.outerHeight(true);
				});

				this.headers.each(function() {
					maxHeight -= $(this).outerHeight(true);
				});

				this.headers.next().each(function() {
					$(this).height(Math.max(0, maxHeight - $(this).innerHeight() + $(this).height()));
				}).css("overflow", "auto");
			} else if (heightStyle === "auto") {
				maxHeight = 0;
				this.headers.next().each(function() {
					maxHeight = Math.max(maxHeight, $(this).css("height", "").height());
				}).height(maxHeight);
			}
		},

		_activate: function(index) {
			var active = this._findActive(index)[0];

			// Trying to activate the already active panel
			if (active === this.active[0]) {
				return;
			}

			// Trying to collapse, simulate a click on the currently active
			// header
			active = active || this.active[0];

			this._eventHandler({
				target: active,
				currentTarget: active,
				preventDefault: $.noop
			});
		},

		_findActive: function(selector) {
			return typeof selector === "number" ? this.headers.eq(selector) : $();
		},

		_setupEvents: function(event) {
			var events = {
				keydown: "_keydown"
			};
			if (event) {
				$.each(event.split(" "), function(index, eventName) {
					events[eventName] = "_eventHandler";
				});
			}

			this._off(this.headers.add(this.headers.next()));
			this._on(this.headers, events);
			this._on(this.headers.next(), {
				keydown: "_panelKeyDown"
			});
			this._hoverable(this.headers);
			this._focusable(this.headers);
		},

		_eventHandler: function(event) {
			var activeChildren, clickedChildren, options = this.options, active = this.active, clicked = $(event.currentTarget), clickedIsActive = clicked[0] === active[0], collapsing = clickedIsActive && options.collapsible, toShow = collapsing ? $() : clicked.next(), toHide = active.next(), eventData = {
				oldHeader: active,
				oldPanel: toHide,
				newHeader: collapsing ? $() : clicked,
				newPanel: toShow
			};

			event.preventDefault();

			if (

			// click on active header, but not collapsible
			(clickedIsActive && !options.collapsible) ||

			// allow canceling activation
			(this._trigger("beforeActivate", event, eventData) === false)) {
				return;
			}

			options.active = collapsing ? false : this.headers.index(clicked);

			// When the call to ._toggle() comes after the class changes
			// it causes a very odd bug in IE 8 (see #6720)
			this.active = clickedIsActive ? $() : clicked;
			this._toggle(eventData);

			// Switch classes
			// corner classes on the previously active header stay after the
			// animation
			this._removeClass(active, "ui-accordion-header-active", "ui-state-active");
			if (options.icons) {
				activeChildren = active.children(".ui-accordion-header-icon");
				this._removeClass(activeChildren, null, options.icons.activeHeader)._addClass(activeChildren, null, options.icons.header);
			}

			if (!clickedIsActive) {
				this._removeClass(clicked, "ui-accordion-header-collapsed")._addClass(clicked, "ui-accordion-header-active", "ui-state-active");
				if (options.icons) {
					clickedChildren = clicked.children(".ui-accordion-header-icon");
					this._removeClass(clickedChildren, null, options.icons.header)._addClass(clickedChildren, null, options.icons.activeHeader);
				}

				this._addClass(clicked.next(), "ui-accordion-content-active");
			}
		},

		_toggle: function(data) {
			var toShow = data.newPanel, toHide = this.prevShow.length ? this.prevShow : data.oldPanel;

			// Handle activating a panel during the animation for another
			// activation
			this.prevShow.add(this.prevHide).stop(true, true);
			this.prevShow = toShow;
			this.prevHide = toHide;

			if (this.options.animate) {
				this._animate(toShow, toHide, data);
			} else {
				toHide.hide();
				toShow.show();
				this._toggleComplete(data);
			}

			toHide.attr({
				"aria-hidden": "true"
			});
			toHide.prev().attr({
				"aria-selected": "false",
				"aria-expanded": "false"
			});

			// if we're switching panels, remove the old header from the tab
			// order
			// if we're opening from collapsed state, remove the previous header
			// from the tab order
			// if we're collapsing, then keep the collapsing header in the tab
			// order
			if (toShow.length && toHide.length) {
				toHide.prev().attr({
					"tabIndex": -1,
					"aria-expanded": "false"
				});
			} else if (toShow.length) {
				this.headers.filter(function() {
					return parseInt($(this).attr("tabIndex"), 10) === 0;
				}).attr("tabIndex", -1);
			}

			toShow.attr("aria-hidden", "false").prev().attr({
				"aria-selected": "true",
				"aria-expanded": "true",
				tabIndex: 0
			});
		},

		_animate: function(toShow, toHide, data) {
			var total, easing, duration, that = this, adjust = 0, boxSizing = toShow.css("box-sizing"), down = toShow.length && (!toHide.length || (toShow.index() < toHide.index())), animate = this.options.animate || {}, options = down && animate.down || animate, complete = function() {
				that._toggleComplete(data);
			};

			if (typeof options === "number") {
				duration = options;
			}
			if (typeof options === "string") {
				easing = options;
			}

			// fall back from options to animation in case of partial down
			// settings
			easing = easing || options.easing || animate.easing;
			duration = duration || options.duration || animate.duration;

			if (!toHide.length) {
				return toShow.animate(this.showProps, duration, easing, complete);
			}
			if (!toShow.length) {
				return toHide.animate(this.hideProps, duration, easing, complete);
			}

			total = toShow.show().outerHeight();
			toHide.animate(this.hideProps, {
				duration: duration,
				easing: easing,
				step: function(now, fx) {
					fx.now = Math.round(now);
				}
			});
			toShow.hide().animate(this.showProps, {
				duration: duration,
				easing: easing,
				complete: complete,
				step: function(now, fx) {
					fx.now = Math.round(now);
					if (fx.prop !== "height") {
						if (boxSizing === "content-box") {
							adjust += fx.now;
						}
					} else if (that.options.heightStyle !== "content") {
						fx.now = Math.round(total - toHide.outerHeight() - adjust);
						adjust = 0;
					}
				}
			});
		},

		_toggleComplete: function(data) {
			var toHide = data.oldPanel, prev = toHide.prev();

			this._removeClass(toHide, "ui-accordion-content-active");
			this._removeClass(prev, "ui-accordion-header-active")._addClass(prev, "ui-accordion-header-collapsed");

			// Work around for rendering bug in IE (#5421)
			if (toHide.length) {
				toHide.parent()[0].className = toHide.parent()[0].className;
			}
			this._trigger("activate", null, data);
		}
	});

	/*
	 * ! jQuery UI Menu 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Menu
	// >>group: Widgets
	// >>description: Creates nestable menus.
	// >>docs: http://api.jqueryui.com/menu/
	// >>demos: http://jqueryui.com/menu/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/menu.css
	// >>css.theme: ../../themes/base/theme.css
	var widgetsMenu = $.widget("ui.menu", {
		version: "1.12.0-beta.1",
		defaultElement: "<ul>",
		delay: 300,
		options: {
			icons: {
				submenu: "ui-icon-caret-1-e"
			},
			items: "> *",
			menus: "ul",
			position: {
				my: "left top",
				at: "right top"
			},
			role: "menu",

			// Callbacks
			blur: null,
			focus: null,
			select: null
		},

		_create: function() {
			this.activeMenu = this.element;

			// Flag used to prevent firing of the click handler
			// as the event bubbles up through nested menus
			this.mouseHandled = false;
			this.element.uniqueId().attr({
				role: this.options.role,
				tabIndex: 0
			});

			this._addClass("ui-menu", "ui-widget ui-widget-content");
			this._on({

				// Prevent focus from sticking to links inside menu after
				// clicking
				// them (focus should always stay on UL during navigation).
				"mousedown .ui-menu-item": function(event) {
					event.preventDefault();
				},
				"click .ui-menu-item": function(event) {
					var target = $(event.target);
					if (!this.mouseHandled && target.not(".ui-state-disabled").length) {
						this.select(event);

						// Only set the mouseHandled flag if the event will
						// bubble, see #9469.
						if (!event.isPropagationStopped()) {
							this.mouseHandled = true;
						}

						// Open submenu on click
						if (target.has(".ui-menu").length) {
							this.expand(event);
						} else if (!this.element.is(":focus") && $($.ui.safeActiveElement(this.document[0])).closest(".ui-menu").length) {

							// Redirect focus to the menu
							this.element.trigger("focus", [true]);

							// If the active item is on the top level, let it
							// stay active.
							// Otherwise, blur the active item since it is no
							// longer visible.
							if (this.active && this.active.parents(".ui-menu").length === 1) {
								clearTimeout(this.timer);
							}
						}
					}
				},
				"mouseenter .ui-menu-item": function(event) {

					// Ignore mouse events while typeahead is active, see
					// #10458.
					// Prevents focusing the wrong item when typeahead causes a
					// scroll while the mouse
					// is over an item in the menu
					if (this.previousFilter) {
						return;
					}

					var actualTarget = $(event.target).closest(".ui-menu-item"), target = $(event.currentTarget);

					// Ignore bubbled events on parent items, see #11641
					if (actualTarget[0] !== target[0]) {
						return;
					}

					// Remove ui-state-active class from siblings of the newly
					// focused menu item
					// to avoid a jump caused by adjacent elements both having a
					// class with a border
					this._removeClass(target.siblings().children(".ui-state-active"), null, "ui-state-active");
					this.focus(event, target);
				},
				mouseleave: "collapseAll",
				"mouseleave .ui-menu": "collapseAll",
				focus: function(event, keepActiveItem) {

					// If there's already an active item, keep it active
					// If not, activate the first item
					var item = this.active || this.element.find(this.options.items).eq(0);

					if (!keepActiveItem) {
						this.focus(event, item);
					}
				},
				blur: function(event) {
					this._delay(function() {
						if (!$.contains(this.element[0], $.ui.safeActiveElement(this.document[0]))) {
							this.collapseAll(event);
						}
					});
				},
				keydown: "_keydown"
			});

			this.refresh();

			// Clicks outside of a menu collapse any open menus
			this._on(this.document, {
				click: function(event) {
					if (this._closeOnDocumentClick(event)) {
						this.collapseAll(event);
					}

					// Reset the mouseHandled flag
					this.mouseHandled = false;
				}
			});
		},

		_destroy: function() {
			var items = this.element.find(".ui-menu-item").removeAttr("role aria-disabled"), submenus = items.children(".ui-menu-item-wrapper").removeUniqueId().removeAttr("tabIndex role aria-haspopup");

			// Destroy (sub)menus
			this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeAttr("role aria-labelledby aria-expanded aria-hidden aria-disabled " + "tabIndex").removeUniqueId().show();

			submenus.children().each(function() {
				var elem = $(this);
				if (elem.data("ui-menu-submenu-caret")) {
					elem.remove();
				}
			});
		},

		_keydown: function(event) {
			var match, prev, character, skip, preventDefault = true;

			switch (event.keyCode) {
				case $.ui.keyCode.PAGE_UP:
					this.previousPage(event);
					break;
				case $.ui.keyCode.PAGE_DOWN:
					this.nextPage(event);
					break;
				case $.ui.keyCode.HOME:
					this._move("first", "first", event);
					break;
				case $.ui.keyCode.END:
					this._move("last", "last", event);
					break;
				case $.ui.keyCode.UP:
					this.previous(event);
					break;
				case $.ui.keyCode.DOWN:
					this.next(event);
					break;
				case $.ui.keyCode.LEFT:
					this.collapse(event);
					break;
				case $.ui.keyCode.RIGHT:
					if (this.active && !this.active.is(".ui-state-disabled")) {
						this.expand(event);
					}
					break;
				case $.ui.keyCode.ENTER:
				case $.ui.keyCode.SPACE:
					this._activate(event);
					break;
				case $.ui.keyCode.ESCAPE:
					this.collapse(event);
					break;
				default:
					preventDefault = false;
					prev = this.previousFilter || "";
					character = String.fromCharCode(event.keyCode);
					skip = false;

					clearTimeout(this.filterTimer);

					if (character === prev) {
						skip = true;
					} else {
						character = prev + character;
					}

					match = this._filterMenuItems(character);
					match = skip && match.index(this.active.next()) !== -1 ? this.active.nextAll(".ui-menu-item") : match;

					// If no matches on the current filter, reset to the last
					// character pressed
					// to move down the menu to the first item that starts with
					// that character
					if (!match.length) {
						character = String.fromCharCode(event.keyCode);
						match = this._filterMenuItems(character);
					}

					if (match.length) {
						this.focus(event, match);
						this.previousFilter = character;
						this.filterTimer = this._delay(function() {
							delete this.previousFilter;
						}, 1000);
					} else {
						delete this.previousFilter;
					}
			}

			if (preventDefault) {
				event.preventDefault();
			}
		},

		_activate: function(event) {
			if (!this.active.is(".ui-state-disabled")) {
				if (this.active.children("[aria-haspopup='true']").length) {
					this.expand(event);
				} else {
					this.select(event);
				}
			}
		},

		refresh: function() {
			var menus, items, newSubmenus, newItems, newWrappers, that = this, icon = this.options.icons.submenu, submenus = this.element.find(this.options.menus);

			this._toggleClass("ui-menu-icons", null, !!this.element.find(".ui-icon").length);

			// Initialize nested menus
			newSubmenus = submenus.filter(":not(.ui-menu)").hide().attr({
				role: this.options.role,
				"aria-hidden": "true",
				"aria-expanded": "false"
			}).each(function() {
				var menu = $(this), item = menu.prev(), submenuCaret = $("<span>").data("ui-menu-submenu-caret", true);

				that._addClass(submenuCaret, "ui-menu-icon", "ui-icon " + icon);
				item.attr("aria-haspopup", "true").prepend(submenuCaret);
				menu.attr("aria-labelledby", item.attr("id"));
			});

			this._addClass(newSubmenus, "ui-menu", "ui-widget ui-widget-content ui-front");

			menus = submenus.add(this.element);
			items = menus.find(this.options.items);

			// Initialize menu-items containing spaces and/or dashes only as
			// dividers
			items.not(".ui-menu-item").each(function() {
				var item = $(this);
				if (that._isDivider(item)) {
					that._addClass(item, "ui-menu-divider", "ui-widget-content");
				}
			});

			// Don't refresh list items that are already adapted
			newItems = items.not(".ui-menu-item, .ui-menu-divider");
			newWrappers = newItems.children().not(".ui-menu").uniqueId().attr({
				tabIndex: -1,
				role: this._itemRole()
			});
			this._addClass(newItems, "ui-menu-item")._addClass(newWrappers, "ui-menu-item-wrapper");

			// Add aria-disabled attribute to any disabled menu item
			items.filter(".ui-state-disabled").attr("aria-disabled", "true");

			// If the active item has been removed, blur the menu
			if (this.active && !$.contains(this.element[0], this.active[0])) {
				this.blur();
			}
		},

		_itemRole: function() {
			return {
				menu: "menuitem",
				listbox: "option"
			}[this.options.role];
		},

		_setOption: function(key, value) {
			if (key === "icons") {
				var icons = this.element.find(".ui-menu-icon");
				this._removeClass(icons, null, this.options.icons.submenu)._addClass(icons, null, value.submenu);
			}
			this._super(key, value);
		},

		_setOptionDisabled: function(value) {
			this._super(value);

			this.element.attr("aria-disabled", String(value));
			this._toggleClass(null, "ui-state-disabled", !!value);
		},

		focus: function(event, item) {
			var nested, focused, activeParent;
			this.blur(event, event && event.type === "focus");

			this._scrollIntoView(item);

			this.active = item.first();

			focused = this.active.children(".ui-menu-item-wrapper");
			this._addClass(focused, null, "ui-state-active");

			// Only update aria-activedescendant if there's a role
			// otherwise we assume focus is managed elsewhere
			if (this.options.role) {
				this.element.attr("aria-activedescendant", focused.attr("id"));
			}

			// Highlight active parent menu item, if any
			activeParent = this.active.parent().closest(".ui-menu-item").children(".ui-menu-item-wrapper");
			this._addClass(activeParent, null, "ui-state-active");

			if (event && event.type === "keydown") {
				this._close();
			} else {
				this.timer = this._delay(function() {
					this._close();
				}, this.delay);
			}

			nested = item.children(".ui-menu");
			if (nested.length && event && (/^mouse/.test(event.type))) {
				this._startOpening(nested);
			}
			this.activeMenu = item.parent();

			this._trigger("focus", event, {
				item: item
			});
		},

		_scrollIntoView: function(item) {
			var borderTop, paddingTop, offset, scroll, elementHeight, itemHeight;
			if (this._hasScroll()) {
				borderTop = parseFloat($.css(this.activeMenu[0], "borderTopWidth")) || 0;
				paddingTop = parseFloat($.css(this.activeMenu[0], "paddingTop")) || 0;
				offset = item.offset().top - this.activeMenu.offset().top - borderTop - paddingTop;
				scroll = this.activeMenu.scrollTop();
				elementHeight = this.activeMenu.height();
				itemHeight = item.outerHeight();

				if (offset < 0) {
					this.activeMenu.scrollTop(scroll + offset);
				} else if (offset + itemHeight > elementHeight) {
					this.activeMenu.scrollTop(scroll + offset - elementHeight + itemHeight);
				}
			}
		},

		blur: function(event, fromFocus) {
			if (!fromFocus) {
				clearTimeout(this.timer);
			}

			if (!this.active) {
				return;
			}

			this._removeClass(this.active.children(".ui-menu-item-wrapper"), null, "ui-state-active");
			this.active = null;

			this._trigger("blur", event, {
				item: this.active
			});
		},

		_startOpening: function(submenu) {
			clearTimeout(this.timer);

			// Don't open if already open fixes a Firefox bug that caused a .5
			// pixel
			// shift in the submenu position when mousing over the caret icon
			if (submenu.attr("aria-hidden") !== "true") {
				return;
			}

			this.timer = this._delay(function() {
				this._close();
				this._open(submenu);
			}, this.delay);
		},

		_open: function(submenu) {
			var position = $.extend({
				of: this.active
			}, this.options.position);

			clearTimeout(this.timer);
			this.element.find(".ui-menu").not(submenu.parents(".ui-menu")).hide().attr("aria-hidden", "true");

			submenu.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(position);
		},

		collapseAll: function(event, all) {
			clearTimeout(this.timer);
			this.timer = this._delay(function() {

				// If we were passed an event, look for the submenu that
				// contains the event
				var currentMenu = all ? this.element : $(event && event.target).closest(this.element.find(".ui-menu"));

				// If we found no valid submenu ancestor, use the main menu to
				// close all sub menus anyway
				if (!currentMenu.length) {
					currentMenu = this.element;
				}

				this._close(currentMenu);

				this.blur(event);
				this.activeMenu = currentMenu;
			}, this.delay);
		},

		// With no arguments, closes the currently active menu - if nothing is
		// active
		// it closes all menus. If passed an argument, it will search for menus
		// BELOW
		_close: function(startMenu) {
			if (!startMenu) {
				startMenu = this.active ? this.active.parent() : this.element;
			}

			var active = startMenu.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find(".ui-state-active").not(".ui-menu-item-wrapper");
			this._removeClass(active, null, "ui-state-active");
		},

		_closeOnDocumentClick: function(event) {
			return !$(event.target).closest(".ui-menu").length;
		},

		_isDivider: function(item) {

			// Match hyphen, em dash, en dash
			return !/[^\-\u2014\u2013\s]/.test(item.text());
		},

		collapse: function(event) {
			var newItem = this.active && this.active.parent().closest(".ui-menu-item", this.element);
			if (newItem && newItem.length) {
				this._close();
				this.focus(event, newItem);
			}
		},

		expand: function(event) {
			var newItem = this.active && this.active.children(".ui-menu ").find(this.options.items).first();

			if (newItem && newItem.length) {
				this._open(newItem.parent());

				// Delay so Firefox will not hide activedescendant change in
				// expanding submenu from AT
				this._delay(function() {
					this.focus(event, newItem);
				});
			}
		},

		next: function(event) {
			this._move("next", "first", event);
		},

		previous: function(event) {
			this._move("prev", "last", event);
		},

		isFirstItem: function() {
			return this.active && !this.active.prevAll(".ui-menu-item").length;
		},

		isLastItem: function() {
			return this.active && !this.active.nextAll(".ui-menu-item").length;
		},

		_move: function(direction, filter, event) {
			var next;
			if (this.active) {
				if (direction === "first" || direction === "last") {
					next = this.active[direction === "first" ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1);
				} else {
					next = this.active[direction + "All"](".ui-menu-item").eq(0);
				}
			}
			if (!next || !next.length || !this.active) {
				next = this.activeMenu.find(this.options.items)[filter]();
			}

			this.focus(event, next);
		},

		nextPage: function(event) {
			var item, base, height;

			if (!this.active) {
				this.next(event);
				return;
			}
			if (this.isLastItem()) {
				return;
			}
			if (this._hasScroll()) {
				base = this.active.offset().top;
				height = this.element.height();
				this.active.nextAll(".ui-menu-item").each(function() {
					item = $(this);
					return item.offset().top - base - height < 0;
				});

				this.focus(event, item);
			} else {
				this.focus(event, this.activeMenu.find(this.options.items)[!this.active ? "first" : "last"]());
			}
		},

		previousPage: function(event) {
			var item, base, height;
			if (!this.active) {
				this.next(event);
				return;
			}
			if (this.isFirstItem()) {
				return;
			}
			if (this._hasScroll()) {
				base = this.active.offset().top;
				height = this.element.height();
				this.active.prevAll(".ui-menu-item").each(function() {
					item = $(this);
					return item.offset().top - base + height > 0;
				});

				this.focus(event, item);
			} else {
				this.focus(event, this.activeMenu.find(this.options.items).first());
			}
		},

		_hasScroll: function() {
			return this.element.outerHeight() < this.element.prop("scrollHeight");
		},

		select: function(event) {

			// TODO: It should never be possible to not have an active item at
			// this
			// point, but the tests don't trigger mouseenter before click.
			this.active = this.active || $(event.target).closest(".ui-menu-item");
			var ui = {
				item: this.active
			};
			if (!this.active.has(".ui-menu").length) {
				this.collapseAll(event, true);
			}
			this._trigger("select", event, ui);
		},

		_filterMenuItems: function(character) {
			var escapedCharacter = character.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"), regex = new RegExp("^" + escapedCharacter, "i");

			return this.activeMenu.find(this.options.items)

			// Only match on items, not dividers or other content (#10571)
			.filter(".ui-menu-item").filter(function() {
				return regex.test($.trim($(this).children(".ui-menu-item-wrapper").text()));
			});
		}
	});

	/*
	 * ! jQuery UI Autocomplete 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Autocomplete
	// >>group: Widgets
	// >>description: Lists suggested words as the user is typing.
	// >>docs: http://api.jqueryui.com/autocomplete/
	// >>demos: http://jqueryui.com/autocomplete/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/autocomplete.css
	// >>css.theme: ../../themes/base/theme.css
	$.widget("ui.autocomplete", {
		version: "1.12.0-beta.1",
		defaultElement: "<input>",
		options: {
			appendTo: null,
			autoFocus: false,
			delay: 300,
			minLength: 1,
			position: {
				my: "left top",
				at: "left bottom",
				collision: "none"
			},
			source: null,

			// Callbacks
			change: null,
			close: null,
			focus: null,
			open: null,
			response: null,
			search: null,
			select: null
		},

		requestIndex: 0,
		pending: 0,

		_create: function() {

			// Some browsers only repeat keydown events, not keypress events,
			// so we use the suppressKeyPress flag to determine if we've already
			// handled the keydown event. #7269
			// Unfortunately the code for & in keypress is the same as the up
			// arrow,
			// so we use the suppressKeyPressRepeat flag to avoid handling
			// keypress
			// events when we know the keydown event was used to modify the
			// search term. #7799
			var suppressKeyPress, suppressKeyPressRepeat, suppressInput, nodeName = this.element[0].nodeName.toLowerCase(), isTextarea = nodeName === "textarea", isInput = nodeName === "input";

			// Textareas are always multi-line
			// Inputs are always single-line, even if inside a contentEditable
			// element
			// IE also treats inputs as contentEditable
			// All other element types are determined by whether or not they're
			// contentEditable
			this.isMultiLine = isTextarea || !isInput && this.element.prop("isContentEditable");

			this.valueMethod = this.element[isTextarea || isInput ? "val" : "text"];
			this.isNewMenu = true;

			this._addClass("ui-autocomplete-input");
			this.element.attr("autocomplete", "off");

			this._on(this.element, {
				keydown: function(event) {
					if (this.element.prop("readOnly")) {
						suppressKeyPress = true;
						suppressInput = true;
						suppressKeyPressRepeat = true;
						return;
					}

					suppressKeyPress = false;
					suppressInput = false;
					suppressKeyPressRepeat = false;
					var keyCode = $.ui.keyCode;
					switch (event.keyCode) {
						case keyCode.PAGE_UP:
							suppressKeyPress = true;
							this._move("previousPage", event);
							break;
						case keyCode.PAGE_DOWN:
							suppressKeyPress = true;
							this._move("nextPage", event);
							break;
						case keyCode.UP:
							suppressKeyPress = true;
							this._keyEvent("previous", event);
							break;
						case keyCode.DOWN:
							suppressKeyPress = true;
							this._keyEvent("next", event);
							break;
						case keyCode.ENTER:

							// when menu is open and has focus
							if (this.menu.active) {

								// #6055 - Opera still allows the keypress to
								// occur
								// which causes forms to submit
								suppressKeyPress = true;
								event.preventDefault();
								this.menu.select(event);
							}
							break;
						case keyCode.TAB:
							if (this.menu.active) {
								this.menu.select(event);
							}
							break;
						case keyCode.ESCAPE:
							if (this.menu.element.is(":visible")) {
								if (!this.isMultiLine) {
									this._value(this.term);
								}
								this.close(event);

								// Different browsers have different default
								// behavior for escape
								// Single press can mean undo or clear
								// Double press in IE means clear the whole form
								event.preventDefault();
							}
							break;
						default:
							suppressKeyPressRepeat = true;

							// search timeout should be triggered before the
							// input value is changed
							this._searchTimeout(event);
							break;
					}
				},
				keypress: function(event) {
					if (suppressKeyPress) {
						suppressKeyPress = false;
						if (!this.isMultiLine || this.menu.element.is(":visible")) {
							event.preventDefault();
						}
						return;
					}
					if (suppressKeyPressRepeat) {
						return;
					}

					// Replicate some key handlers to allow them to repeat in
					// Firefox and Opera
					var keyCode = $.ui.keyCode;
					switch (event.keyCode) {
						case keyCode.PAGE_UP:
							this._move("previousPage", event);
							break;
						case keyCode.PAGE_DOWN:
							this._move("nextPage", event);
							break;
						case keyCode.UP:
							this._keyEvent("previous", event);
							break;
						case keyCode.DOWN:
							this._keyEvent("next", event);
							break;
					}
				},
				input: function(event) {
					if (suppressInput) {
						suppressInput = false;
						event.preventDefault();
						return;
					}
					this._searchTimeout(event);
				},
				focus: function() {
					this.selectedItem = null;
					this.previous = this._value();
				},
				blur: function(event) {
					if (this.cancelBlur) {
						delete this.cancelBlur;
						return;
					}

					clearTimeout(this.searching);
					this.close(event);
					this._change(event);
				}
			});

			this._initSource();
			this.menu = $("<ul>").appendTo(this._appendTo()).menu({

				// disable ARIA support, the live region takes care of that
				role: null
			}).hide().menu("instance");

			this._addClass(this.menu.element, "ui-autocomplete", "ui-front");
			this._on(this.menu.element, {
				mousedown: function(event) {

					// prevent moving focus out of the text field
					event.preventDefault();

					// IE doesn't prevent moving focus even with
					// event.preventDefault()
					// so we set a flag to know when we should ignore the blur
					// event
					this.cancelBlur = true;
					this._delay(function() {
						delete this.cancelBlur;

						// Support: IE 8 only
						// Right clicking a menu item or selecting text from the
						// menu items will
						// result in focus moving out of the input. However,
						// we've already received
						// and ignored the blur event because of the cancelBlur
						// flag set above. So
						// we restore focus to ensure that the menu closes
						// properly based on the user's
						// next actions.
						if (this.element[0] !== $.ui.safeActiveElement(this.document[0])) {
							this.element.trigger("focus");
						}
					});
				},
				menufocus: function(event, ui) {
					var label, item;

					// support: Firefox
					// Prevent accidental activation of menu items in Firefox
					// (#7024 #9118)
					if (this.isNewMenu) {
						this.isNewMenu = false;
						if (event.originalEvent && /^mouse/.test(event.originalEvent.type)) {
							this.menu.blur();

							this.document.one("mousemove", function() {
								$(event.target).trigger(event.originalEvent);
							});

							return;
						}
					}

					item = ui.item.data("ui-autocomplete-item");
					if (false !== this._trigger("focus", event, {
						item: item
					})) {

						// use value to match what will end up in the input, if
						// it was a key event
						if (event.originalEvent && /^key/.test(event.originalEvent.type)) {
							this._value(item.value);
						}
					}

					// Announce the value in the liveRegion
					label = ui.item.attr("aria-label") || item.value;
					if (label && $.trim(label).length) {
						this.liveRegion.children().hide();
						$("<div>").text(label).appendTo(this.liveRegion);
					}
				},
				menuselect: function(event, ui) {
					var item = ui.item.data("ui-autocomplete-item"), previous = this.previous;

					// Only trigger when focus was lost (click on menu)
					if (this.element[0] !== $.ui.safeActiveElement(this.document[0])) {
						this.element.trigger("focus");
						this.previous = previous;

						// #6109 - IE triggers two focus events and the second
						// is asynchronous, so we need to reset the previous
						// term synchronously and asynchronously :-(
						this._delay(function() {
							this.previous = previous;
							this.selectedItem = item;
						});
					}

					if (false !== this._trigger("select", event, {
						item: item
					})) {
						this._value(item.value);
					}

					// reset the term after the select event
					// this allows custom select handling to work properly
					this.term = this._value();

					this.close(event);
					this.selectedItem = item;
				}
			});

			this.liveRegion = $("<div>", {
				role: "status",
				"aria-live": "assertive",
				"aria-relevant": "additions"
			}).appendTo(this.document[0].body);

			this._addClass(this.liveRegion, null, "ui-helper-hidden-accessible");

			// Turning off autocomplete prevents the browser from remembering
			// the
			// value when navigating through history, so we re-enable
			// autocomplete
			// if the page is unloaded before the widget is destroyed. #7790
			this._on(this.window, {
				beforeunload: function() {
					this.element.removeAttr("autocomplete");
				}
			});
		},

		_destroy: function() {
			clearTimeout(this.searching);
			this.element.removeAttr("autocomplete");
			this.menu.element.remove();
			this.liveRegion.remove();
		},

		_setOption: function(key, value) {
			this._super(key, value);
			if (key === "source") {
				this._initSource();
			}
			if (key === "appendTo") {
				this.menu.element.appendTo(this._appendTo());
			}
			if (key === "disabled" && value && this.xhr) {
				this.xhr.abort();
			}
		},

		_isEventTargetInWidget: function(event) {
			var menuElement = this.menu.element[0];

			return event.target === this.element[0] || event.target === menuElement || $.contains(menuElement, event.target);
		},

		_closeOnClickOutside: function(event) {
			if (!this._isEventTargetInWidget(event)) {
				this.close();
			}
		},

		_appendTo: function() {
			var element = this.options.appendTo;

			if (element) {
				element = element.jquery || element.nodeType ? $(element) : this.document.find(element).eq(0);
			}

			if (!element || !element[0]) {
				element = this.element.closest(".ui-front, dialog");
			}

			if (!element.length) {
				element = this.document[0].body;
			}

			return element;
		},

		_initSource: function() {
			var array, url, that = this;
			if ($.isArray(this.options.source)) {
				array = this.options.source;
				this.source = function(request, response) {
					response($.ui.autocomplete.filter(array, request.term));
				};
			} else if (typeof this.options.source === "string") {
				url = this.options.source;
				this.source = function(request, response) {
					if (that.xhr) {
						that.xhr.abort();
					}
					that.xhr = $.ajax({
						url: url,
						data: request,
						dataType: "json",
						success: function(data) {
							response(data);
						},
						error: function() {
							response([]);
						}
					});
				};
			} else {
				this.source = this.options.source;
			}
		},

		_searchTimeout: function(event) {
			clearTimeout(this.searching);
			this.searching = this._delay(function() {

				// Search if the value has changed, or if the user retypes the
				// same value (see #7434)
				var equalValues = this.term === this._value(), menuVisible = this.menu.element.is(":visible"), modifierKey = event.altKey || event.ctrlKey || event.metaKey || event.shiftKey;

				if (!equalValues || (equalValues && !menuVisible && !modifierKey)) {
					this.selectedItem = null;
					this.search(null, event);
				}
			}, this.options.delay);
		},

		search: function(value, event) {
			value = value != null ? value : this._value();

			// Always save the actual value, not the one passed as an argument
			this.term = this._value();

			if (value.length < this.options.minLength) {
				return this.close(event);
			}

			if (this._trigger("search", event) === false) {
				return;
			}

			return this._search(value);
		},

		_search: function(value) {
			this.pending++;
			this._addClass("ui-autocomplete-loading");
			this.cancelSearch = false;

			this.source({
				term: value
			}, this._response());
		},

		_response: function() {
			var index = ++this.requestIndex;

			return $.proxy(function(content) {
				if (index === this.requestIndex) {
					this.__response(content);
				}

				this.pending--;
				if (!this.pending) {
					this._removeClass("ui-autocomplete-loading");
				}
			}, this);
		},

		__response: function(content) {
			if (content) {
				content = this._normalize(content);
			}
			this._trigger("response", null, {
				content: content
			});
			if (!this.options.disabled && content && content.length && !this.cancelSearch) {
				this._suggest(content);
				this._trigger("open");
			} else {

				// use ._close() instead of .close() so we don't cancel future
				// searches
				this._close();
			}
		},

		close: function(event) {
			this.cancelSearch = true;
			this._close(event);
		},

		_close: function(event) {

			// Remove the handler that closes the menu on outside clicks
			this._off(this.document, "mousedown");

			if (this.menu.element.is(":visible")) {
				this.menu.element.hide();
				this.menu.blur();
				this.isNewMenu = true;
				this._trigger("close", event);
			}
		},

		_change: function(event) {
			if (this.previous !== this._value()) {
				this._trigger("change", event, {
					item: this.selectedItem
				});
			}
		},

		_normalize: function(items) {

			// assume all items have the right format when the first item is
			// complete
			if (items.length && items[0].label && items[0].value) {
				return items;
			}
			return $.map(items, function(item) {
				if (typeof item === "string") {
					return {
						label: item,
						value: item
					};
				}
				return $.extend({}, item, {
					label: item.label || item.value,
					value: item.value || item.label
				});
			});
		},

		_suggest: function(items) {
			var ul = this.menu.element.empty();
			this._renderMenu(ul, items);
			this.isNewMenu = true;
			this.menu.refresh();

			// Size and position menu
			ul.show();
			this._resizeMenu();
			ul.position($.extend({
				of: this.element
			}, this.options.position));

			if (this.options.autoFocus) {
				this.menu.next();
			}

			// Listen for interactions outside of the widget (#6642)
			this._on(this.document, {
				mousedown: "_closeOnClickOutside"
			});
		},

		_resizeMenu: function() {
			var ul = this.menu.element;
			ul.outerWidth(Math.max(

			// Firefox wraps long text (possibly a rounding bug)
			// so we add 1px to avoid the wrapping (#7513)
			ul.width("").outerWidth() + 1, this.element.outerWidth()));
		},

		_renderMenu: function(ul, items) {
			var that = this;
			$.each(items, function(index, item) {
				that._renderItemData(ul, item);
			});
		},

		_renderItemData: function(ul, item) {
			return this._renderItem(ul, item).data("ui-autocomplete-item", item);
		},

		_renderItem: function(ul, item) {
			return $("<li>").append($("<div>").text(item.label)).appendTo(ul);
		},

		_move: function(direction, event) {
			if (!this.menu.element.is(":visible")) {
				this.search(null, event);
				return;
			}
			if (this.menu.isFirstItem() && /^previous/.test(direction) || this.menu.isLastItem() && /^next/.test(direction)) {

				if (!this.isMultiLine) {
					this._value(this.term);
				}

				this.menu.blur();
				return;
			}
			this.menu[direction](event);
		},

		widget: function() {
			return this.menu.element;
		},

		_value: function() {
			return this.valueMethod.apply(this.element, arguments);
		},

		_keyEvent: function(keyEvent, event) {
			if (!this.isMultiLine || this.menu.element.is(":visible")) {
				this._move(keyEvent, event);

				// Prevents moving cursor to beginning/end of the text field in
				// some browsers
				event.preventDefault();
			}
		}
	});

	$.extend($.ui.autocomplete, {
		escapeRegex: function(value) {
			return value.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
		},
		filter: function(array, term) {
			var matcher = new RegExp($.ui.autocomplete.escapeRegex(term), "i");
			return $.grep(array, function(value) {
				return matcher.test(value.label || value.value || value);
			});
		}
	});

	// Live region extension, adding a `messages` option
	// NOTE: This is an experimental API. We are still investigating
	// a full solution for string manipulation and internationalization.
	$.widget("ui.autocomplete", $.ui.autocomplete, {
		options: {
			messages: {
				noResults: "No search results.",
				results: function(amount) {
					return amount + (amount > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate.";
				}
			}
		},

		__response: function(content) {
			var message;
			this._superApply(arguments);
			if (this.options.disabled || this.cancelSearch) {
				return;
			}
			if (content && content.length) {
				message = this.options.messages.results(content.length);
			} else {
				message = this.options.messages.noResults;
			}
			this.liveRegion.children().hide();
			$("<div>").text(message).appendTo(this.liveRegion);
		}
	});

	var widgetsAutocomplete = $.ui.autocomplete;

	/*
	 * ! jQuery UI Controlgroup 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Controlgroup
	// >>group: Widgets
	// >>description: Visually groups form control widgets
	// >>docs: http://api.jqueryui.com/controlgroup/
	// >>demos: http://jqueryui.com/controlgroup/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/controlgroup.css
	// >>css.theme: ../../themes/base/theme.css
	var widgetsControlgroup = $.widget("ui.controlgroup", {
		version: "1.12.0-beta.1",
		defaultElement: "<div>",
		options: {
			direction: "horizontal",
			disabled: null,
			onlyVisible: true,
			items: {
				"button": "input[type=button], input[type=submit], input[type=reset], button, a",
				"controlgroupLabel": ".ui-controlgroup-label",
				"checkboxradio": "input[type='checkbox'], input[type='radio']",
				"selectmenu": "select",
				"spinner": ".ui-spinner-input"
			}
		},

		_create: function() {
			this._enhance();
		},

		// To support the enhanced option in jQuery Mobile, we isolate DOM
		// manipulation
		_enhance: function() {
			this.element.attr("role", "toolbar");
			this.refresh();
		},

		_destroy: function() {
			this._callChildMethod("destroy");
			this.childWidgets.removeData("ui-controlgroup-data");
			this.element.removeAttr("role");
			if (this.options.items.controlgroupLabel) {
				this.element.find(this.options.items.controlgroupLabel).find(".ui-controlgroup-label-contents").contents().unwrap();
			}
		},

		_initWidgets: function() {
			var that = this, childWidgets = [];

			// First we iterate over each of the items options
			$.each(this.options.items, function(widget, selector) {
				var labels;
				var options = {};

				// Make sure the widget has a selector set
				if (!selector) {
					return;
				}

				if (widget === "controlgroupLabel") {
					labels = that.element.find(selector);
					labels.each(function() {
						$(this).contents().wrapAll("<span class='ui-controlgroup-label-contents'></span>");
					});
					that._addClass(labels, null, "ui-widget ui-widget-content ui-state-default");
					childWidgets = childWidgets.concat(labels.get());
					return;
				}

				// Make sure the widget actually exists
				if (!$.fn[widget]) {
					return;
				}

				// We assume everything is in the middle to start because we
				// can't determine
				// first / last elements until all enhancments are done.
				if (that["_" + widget + "Options"]) {
					options = that["_" + widget + "Options"]("middle");
				}

				// Find instances of this widget inside controlgroup and init
				// them
				that.element.find(selector)[widget](options).each(function() {
					var element = $(this);

					// Store an instance of the controlgroup to be able to
					// reference
					// from the outermost element for changing options and
					// refresh
					var widgetElement = element[widget]("widget");
					$.data(widgetElement[0], "ui-controlgroup-data", element[widget]("instance"));

					childWidgets.push(widgetElement[0]);
				});
			});

			this.childWidgets = $($.unique(childWidgets));
			this._addClass(this.childWidgets, "ui-controlgroup-item");
		},

		_callChildMethod: function(method) {
			this.childWidgets.each(function() {
				var element = $(this), data = element.data("ui-controlgroup-data");
				if (data && data[method]) {
					data[method]();
				}
			});
		},

		_updateCornerClass: function(element, position) {
			var remove = "ui-corner-top ui-corner-bottom ui-corner-left ui-corner-right";
			var add = this._buildSimpleOptions(position, "label").classes.label;

			this._removeClass(element, null, remove);
			this._addClass(element, null, add);
		},

		_buildSimpleOptions: function(position, key) {
			var direction = this.options.direction === "vertical";
			var result = {
				classes: {}
			};
			result.classes[key] = {
				"middle": null,
				"first": "ui-corner-" + (direction ? "top" : "left"),
				"last": "ui-corner-" + (direction ? "bottom" : "right")
			}[position];

			return result;
		},

		_spinnerOptions: function(position) {
			var options = this._buildSimpleOptions(position, "ui-spinner");

			options.classes["ui-spinner-up"] = "";
			options.classes["ui-spinner-down"] = "";

			return options;
		},

		_buttonOptions: function(position) {
			return this._buildSimpleOptions(position, "ui-button");
		},

		_checkboxradioOptions: function(position) {
			return this._buildSimpleOptions(position, "ui-checkboxradio-label");
		},

		_selectmenuOptions: function(position) {
			var direction = this.options.direction === "vertical";
			return {
				width: direction ? "auto" : false,
				classes: {
					middle: {
						"ui-selectmenu-button-open": null,
						"ui-selectmenu-button-closed": null
					},
					first: {
						"ui-selectmenu-button-open": "ui-corner-" + (direction ? "top" : "tl"),
						"ui-selectmenu-button-closed": "ui-corner-" + (direction ? "top" : "left")
					},
					last: {
						"ui-selectmenu-button-open": direction ? null : "ui-corner-tr",
						"ui-selectmenu-button-closed": "ui-corner-" + (direction ? "bottom" : "right")
					}

				}[position]
			};
		},

		_setOption: function(key, value) {
			if (key === "direction") {
				this._removeClass("ui-controlgroup-" + this.options.direction);
			}

			this._super(key, value);
			if (key === "disabled") {
				this._callChildMethod(value ? "disable" : "enable");
				return;
			}

			this.refresh();
		},

		refresh: function() {
			var children, that = this;

			this._addClass("ui-controlgroup ui-controlgroup-" + this.options.direction);

			if (this.options.direction === "horizontal") {
				this._addClass(null, "ui-helper-clearfix");
			}
			this._initWidgets();

			children = this.childWidgets;

			// We filter here because we need to track all childWidgets not just
			// the visible ones
			if (this.options.onlyVisible) {
				children = children.filter(":visible");
			}

			if (children.length) {

				// We do this last because we need to make sure all enhancment
				// is done
				// before determining first and last
				$.each(["first", "last"], function(index, value) {
					var instance = children[value]().data("ui-controlgroup-data");

					if (instance && that["_" + instance.widgetName + "Options"]) {
						instance.element[instance.widgetName](that["_" + instance.widgetName + "Options"](value));
					} else {
						that._updateCornerClass(children[value](), value);
					}
				});

				// Finally call the refresh method on each of the child widgets.
				this._callChildMethod("refresh");
			}
		}
	});

	/*
	 * ! jQuery UI Checkboxradio 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Checkboxradio
	// >>group: Widgets
	// >>description: Enhances a form with multiple themeable checkboxes or
	// radio buttons.
	// >>docs: http://api.jqueryui.com/checkboxradio/
	// >>demos: http://jqueryui.com/checkboxradio/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/button.css
	// >>css.structure: ../../themes/base/checkboxradio.css
	// >>css.theme: ../../themes/base/theme.css
	$.widget("ui.checkboxradio", [$.ui.formResetMixin, {
		version: "1.12.0-beta.1",
		options: {
			disabled: null,
			label: null,
			icon: true,
			classes: {
				"ui-checkboxradio-label": "ui-corner-all",
				"ui-checkboxradio-icon": "ui-corner-all"
			}
		},

		_getCreateOptions: function() {
			var disabled, labels;
			var that = this;
			var options = this._super() || {};

			// We read the type here, because it makes more sense to throw a
			// element type error first,
			// rather then the error for lack of a label. Often if its the wrong
			// type, it
			// won't have a label (e.g. calling on a div, btn, etc)
			this._readType();

			labels = this.element.labels();

			// If there are multiple labels, use the last one
			this.label = $(labels[labels.length - 1]);
			if (!this.label.length) {
				$.error("No label found for checkboxradio widget");
			}

			this.originalLabel = "";

			// We need to get the label text but this may also need to make sure
			// it does not contain the
			// input itself.
			this.label.contents().not(this.element).each(function() {

				// The label contents could be text, html, or a mix. We concat
				// each element to get a string
				// representation of the label, without the input as part of it.
				that.originalLabel += this.nodeType === 3 ? $(this).text() : this.outerHTML;
			});

			// Set the label option if we found label text
			if (this.originalLabel) {
				options.label = this.originalLabel;
			}

			disabled = this.element[0].disabled;
			if (disabled != null) {
				options.disabled = disabled;
			}
			return options;
		},

		_create: function() {
			var checked = this.element[0].checked;

			this._bindFormResetHandler();

			if (this.options.disabled == null) {
				this.options.disabled = this.element[0].disabled;
			}

			this._setOption("disabled", this.options.disabled);
			this._addClass("ui-checkboxradio", "ui-helper-hidden-accessible");
			this._addClass(this.label, "ui-checkboxradio-label", "ui-button ui-widget");

			if (this.type === "radio") {
				this._addClass(this.label, "ui-checkboxradio-radio-label");
			}

			if (this.options.label && this.options.label !== this.originalLabel) {
				this._updateLabel();
			} else if (this.originalLabel) {
				this.options.label = this.originalLabel;
			}

			this._enhance();

			if (checked) {
				this._addClass(this.label, "ui-checkboxradio-checked", "ui-state-active");
				this._addClass(this.icon, null, "ui-state-hover");
			}

			this._on({
				change: "_toggleClasses",
				focus: function() {
					this._addClass(this.label, null, "ui-state-focus ui-visual-focus");
				},
				blur: function() {
					this._removeClass(this.label, null, "ui-state-focus ui-visual-focus");
				}
			});
		},

		_readType: function() {
			var nodeName = this.element[0].nodeName.toLowerCase();
			this.type = this.element[0].type;
			if (nodeName !== "input" || !/radio|checkbox/.test(this.type)) {
				$.error("Can't create checkboxradio on element.nodeName=" + nodeName + " and element.type=" + this.type);
			}
		},

		// Support jQuery Mobile enhanced option
		_enhance: function() {
			this._updateIcon(this.element[0].checked);
		},

		widget: function() {
			return this.label;
		},

		_getRadioGroup: function() {
			var group;
			var name = this.element[0].name;
			var nameSelector = "input[name='" + $.ui.escapeSelector(name) + "']";

			if (!name) {
				return $([]);
			}

			if (this.form.length) {
				group = $(this.form[0].elements).filter(nameSelector);
			} else {

				// Not inside a form, check all inputs that also are not inside
				// a form
				group = $(nameSelector).filter(function() {
					return $(this).form().length === 0;
				});
			}

			return group.not(this.element);
		},

		_toggleClasses: function() {
			var checked = this.element[0].checked;
			this._toggleClass(this.label, "ui-checkboxradio-checked", "ui-state-active", checked);

			if (this.options.icon && this.type === "checkbox") {

				// We add ui-state-highlight to change the icon color
				this._toggleClass(this.icon, null, "ui-icon-check ui-state-highlight", checked)._toggleClass(this.icon, null, "ui-icon-blank", !checked);
			}
			if (this.type === "radio") {
				this._getRadioGroup().each(function() {
					var instance = $(this).checkboxradio("instance");

					if (instance) {
						instance._removeClass(instance.label, "ui-checkboxradio-checked", "ui-state-active");
					}
				});
			}
		},

		_destroy: function() {
			this._unbindFormResetHandler();

			if (this.icon) {
				this.icon.remove();
				this.iconSpace.remove();
			}
		},

		_setOption: function(key, value) {

			// We don't allow the value to be set to nothing
			if (key === "label" && !value) {
				return;
			}

			this._super(key, value);

			if (key === "disabled") {
				this._toggleClass(this.label, null, "ui-state-disabled", value);
				this.element[0].disabled = value;

				// Don't refresh when setting disabled
				return;
			}
			this.refresh();
		},

		_updateIcon: function(checked) {
			var toAdd = "ui-icon ui-icon-background ";

			if (this.options.icon) {
				if (!this.icon) {
					this.icon = $("<span>");
					this.iconSpace = $("<span> </span>");
					this._addClass(this.iconSpace, "ui-checkboxradio-icon-space");
				}

				if (this.type === "checkbox") {
					toAdd += checked ? "ui-icon-check ui-state-highlight" : "ui-icon-blank";
					this._removeClass(this.icon, null, checked ? "ui-icon-blank" : "ui-icon-check");
				} else {
					toAdd += "ui-icon-blank";
				}
				this._addClass(this.icon, "ui-checkboxradio-icon", toAdd);
				if (!checked) {
					this._removeClass(this.icon, null, "ui-icon-check ui-state-highlight");
				}
				this.icon.prependTo(this.label).after(this.iconSpace);
			} else if (this.icon !== undefined) {
				this.icon.remove();
				this.iconSpace.remove();
				delete this.icon;
			}
		},

		_updateLabel: function() {

			// Remove the contents of the label ( minus the icon, icon space,
			// and input )
			this.label.contents().not(this.element.add(this.icon).add(this.iconSpace)).remove();
			this.label.append(this.options.label);
		},

		refresh: function() {
			var checked = this.element[0].checked, isDisabled = this.element[0].disabled;

			this._updateIcon(checked);
			this._toggleClass(this.label, "ui-checkboxradio-checked", "ui-state-active", checked);
			if (this.options.label !== null) {
				this._updateLabel();
			}

			if (isDisabled !== this.options.disabled) {
				this._setOptions({
					"disabled": isDisabled
				});
			}
		}

	}]);

	var widgetsCheckboxradio = $.ui.checkboxradio;

	/*
	 * ! jQuery UI Button 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Button
	// >>group: Widgets
	// >>description: Enhances a form with themeable buttons.
	// >>docs: http://api.jqueryui.com/button/
	// >>demos: http://jqueryui.com/button/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/button.css
	// >>css.theme: ../../themes/base/theme.css
	$.widget("ui.button", {
		version: "1.12.0-beta.1",
		defaultElement: "<button>",
		options: {
			classes: {
				"ui-button": "ui-corner-all"
			},
			disabled: null,
			icon: null,
			iconPosition: "beginning",
			label: null,
			showLabel: true
		},

		_getCreateOptions: function() {
			var disabled,

			// This is to support cases like in jQuery Mobile where the base
			// widget does have
			// an implementation of _getCreateOptions
			options = this._super() || {};

			this.isInput = this.element.is("input");

			disabled = this.element[0].disabled;
			if (disabled != null) {
				options.disabled = disabled;
			}

			this.originalLabel = this.isInput ? this.element.val() : this.element.html();
			if (this.originalLabel) {
				options.label = this.originalLabel;
			}

			return options;
		},

		_create: function() {
			if (!this.option.showLabel & !this.options.icon) {
				this.options.showLabel = true;
			}

			// We have to check the option again here even though we did in
			// _getCreateOptions,
			// because null may have been passed on init which would override
			// what was set in
			// _getCreateOptions
			if (this.options.disabled == null) {
				this.options.disabled = this.element[0].disabled || false;
			}

			this.hasTitle = !!this.element.attr("title");

			// Check to see if the label needs to be set or if its already
			// correct
			if (this.options.label && this.options.label !== this.originalLabel) {
				if (this.isInput) {
					this.element.val(this.options.label);
				} else {
					this.element.html(this.options.label);
				}
			}
			this._addClass("ui-button", "ui-widget");
			this._setOption("disabled", this.options.disabled);
			this._enhance();

			if (this.element.is("a")) {
				this._on({
					"keyup": function(event) {
						if (event.keyCode === $.ui.keyCode.SPACE) {
							event.preventDefault();

							// Support: PhantomJS <= 1.9, IE 8 Only
							// If a native click is available use it so we
							// actually cause navigation
							// otherwise just trigger a click event
							if (this.element[0].click) {
								this.element[0].click();
							} else {
								this.element.trigger("click");
							}
						}
					}
				});
			}
		},

		_enhance: function() {
			if (!this.element.is("button")) {
				this.element.attr("role", "button");
			}

			if (this.options.icon) {
				this._updateIcon("icon", this.options.icon);
				this._updateTooltip();
			}
		},

		_updateTooltip: function() {
			this.title = this.element.attr("title");

			if (!this.options.showLabel && !this.title) {
				this.element.attr("title", this.options.label);
			}
		},

		_updateIcon: function(option, value) {
			var icon = option !== "iconPosition", position = icon ? this.options.iconPosition : value, displayBlock = position === "top" || position === "bottom";

			// Create icon
			if (!this.icon) {
				this.icon = $("<span>");

				this._addClass(this.icon, "ui-button-icon", "ui-icon");

				if (!this.options.showLabel) {
					this._addClass("ui-button-icon-only");
				}
			} else if (icon) {

				// If we are updating the icon remove the old icon class
				this._removeClass(this.icon, null, this.options.icon);
			}

			// If we are updating the icon add the new icon class
			if (icon) {
				this._addClass(this.icon, null, value);
			}

			this._attachIcon(position);

			// If the icon is on top or bottom we need to add the
			// ui-widget-icon-block class and remove
			// the iconSpace if there is one.
			if (displayBlock) {
				this._addClass(this.icon, null, "ui-widget-icon-block");
				if (this.iconSpace) {
					this.iconSpace.remove();
				}
			} else {

				// Position is beginning or end so remove the
				// ui-widget-icon-block class and add the
				// space if it does not exist
				if (!this.iconSpace) {
					this.iconSpace = $("<span> </span>");
					this._addClass(this.iconSpace, "ui-button-icon-space");
				}
				this._removeClass(this.icon, null, "ui-wiget-icon-block");
				this._attachIconSpace(position);
			}
		},

		_destroy: function() {
			this.element.removeAttr("role");

			if (this.icon) {
				this.icon.remove();
			}
			if (this.iconSpace) {
				this.iconSpace.remove();
			}
			if (!this.hasTitle) {
				this.element.removeAttr("title");
			}
		},

		_attachIconSpace: function(iconPosition) {
			this.icon[/^(?:end|bottom)/.test(iconPosition) ? "before" : "after"](this.iconSpace);
		},

		_attachIcon: function(iconPosition) {
			this.element[/^(?:end|bottom)/.test(iconPosition) ? "append" : "prepend"](this.icon);
		},

		_setOptions: function(options) {
			var newShowLabel = options.showLabel === undefined ? this.options.showLabel : options.showLabel, newIcon = options.icon === undefined ? this.options.icon : options.icon;

			if (!newShowLabel && !newIcon) {
				options.showLabel = true;
			}
			this._super(options);
		},

		_setOption: function(key, value) {
			if (key === "icon") {
				if (value) {
					this._updateIcon(key, value);
				} else if (this.icon) {
					this.icon.remove();
					if (this.iconSpace) {
						this.iconSpace.remove();
					}
				}
			}

			if (key === "iconPosition") {
				this._updateIcon(key, value);
			}

			// Make sure we can't end up with a button that has neither text nor
			// icon
			if (key === "showLabel") {
				this._toggleClass("ui-button-icon-only", null, !value);
				this._updateTooltip();
			}

			if (key === "label") {
				if (this.isInput) {
					this.element.val(value);
				} else {

					// If there is an icon, append it, else nothing then append
					// the value
					// this avoids removal of the icon when setting label text
					this.element.html(value);
					if (this.icon) {
						this._attachIcon(this.options.iconPosition);
						this._attachIconSpace(this.options.iconPosition);
					}
				}
			}

			this._super(key, value);

			if (key === "disabled") {
				this._toggleClass(null, "ui-state-disabled", value);
				this.element[0].disabled = value;
				if (value) {
					this.element.blur();
				}
			}
		},

		refresh: function() {

			// Make sure to only check disabled if its an element that supports
			// this otherwise
			// check for the disabled class to determine state
			var isDisabled = this.element.is("input, button") ? this.element[0].disabled : this.element.hasClass("ui-button-disabled");

			if (isDisabled !== this.options.disabled) {
				this._setOptions({
					disabled: isDisabled
				});
			}

			this._updateTooltip();
		}
	});

	// DEPRECATED
	if ($.uiBackCompat !== false) {

		// Text and Icons options
		$.widget("ui.button", $.ui.button, {
			options: {
				text: true,
				icons: {
					primary: null,
					secondary: null
				}
			},

			_create: function() {
				if (this.options.showLabel && !this.options.text) {
					this.options.showLabel = this.options.text;
				}
				if (!this.options.showLabel && this.options.text) {
					this.options.text = this.options.showLabel;
				}
				if (!this.options.icon && (this.options.icons.primary || this.options.icons.secondary)) {
					if (this.options.icons.primary) {
						this.options.icon = this.options.icons.primary;
					} else {
						this.options.icon = this.options.icons.secondary;
						this.options.iconPosition = "end";
					}
				} else if (this.options.icon) {
					this.options.icons.primary = this.options.icon;
				}
				this._super();
			},

			_setOption: function(key, value) {
				if (key === "text") {
					this._super("showLabel", value);
					return;
				}
				if (key === "showLabel") {
					this.options.text = value;
				}
				if (key === "icon") {
					this.options.icons.primary = value;
				}
				if (key === "icons") {
					if (value.primary) {
						this._super("icon", value.primary);
						this._super("iconPosition", "beginning");
					} else if (value.secondary) {
						this._super("icon", value.secondary);
						this._super("iconPosition", "end");
					}
				}
				this._superApply(arguments);
			}
		});

		$.fn.button = (function(orig) {
			return function() {
				if (!this.length || (this.length && this[0].tagName !== "INPUT") || (this.length && this[0].tagName === "INPUT" && (this.attr("type") !== "checkbox" && this.attr("type") !== "radio"))) {
					return orig.apply(this, arguments);
				}
				if (!$.ui.checkboxradio) {
					$.error("Checkboxradio widget missing");
				}
				if (arguments.length === 0) {
					return this.checkboxradio({
						"icon": false
					});
				}
				return this.checkboxradio.apply(this, arguments);
			};
		})($.fn.button);

		$.fn.buttonset = function() {
			if (!$.ui.controlgroup) {
				$.error("Controlgroup widget missing");
			}
			if (arguments[0] === "option" && arguments[1] === "items" && arguments[2]) {
				return this.controlgroup.apply(this, [arguments[0], "items.button", arguments[2]]);
			}
			if (arguments[0] === "option" && arguments[1] === "items") {
				return this.controlgroup.apply(this, [arguments[0], "items.button"]);
			}
			if (typeof arguments[0] === "object" && arguments[0].items) {
				arguments[0].items = {
					button: arguments[0].items
				};
			}
			return this.controlgroup.apply(this, arguments);
		};
	}

	var widgetsButton = $.ui.button;

	/*
	 * ! jQuery UI Dialog 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Dialog
	// >>group: Widgets
	// >>description: Displays customizable dialog windows.
	// >>docs: http://api.jqueryui.com/dialog/
	// >>demos: http://jqueryui.com/dialog/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/dialog.css
	// >>css.theme: ../../themes/base/theme.css
	$.widget("ui.dialog", {
		version: "1.12.0-beta.1",
		options: {
			appendTo: "body",
			autoOpen: true,
			buttons: [],
			classes: {
				"ui-dialog": "ui-corner-all",
				"ui-dialog-titlebar": "ui-corner-all"
			},
			closeOnEscape: true,
			closeText: "Close",
			draggable: true,
			hide: null,
			height: "auto",
			maxHeight: null,
			maxWidth: null,
			minHeight: 150,
			minWidth: 150,
			modal: false,
			position: {
				my: "center",
				at: "center",
				of: window,
				collision: "fit",

				// Ensure the titlebar is always visible
				using: function(pos) {
					var topOffset = $(this).css(pos).offset().top;
					if (topOffset < 0) {
						$(this).css("top", pos.top - topOffset);
					}
				}
			},
			resizable: true,
			show: null,
			title: null,
			width: 300,

			// Callbacks
			beforeClose: null,
			close: null,
			drag: null,
			dragStart: null,
			dragStop: null,
			focus: null,
			open: null,
			resize: null,
			resizeStart: null,
			resizeStop: null
		},

		sizeRelatedOptions: {
			buttons: true,
			height: true,
			maxHeight: true,
			maxWidth: true,
			minHeight: true,
			minWidth: true,
			width: true
		},

		resizableRelatedOptions: {
			maxHeight: true,
			maxWidth: true,
			minHeight: true,
			minWidth: true
		},

		_create: function() {
			this.originalCss = {
				display: this.element[0].style.display,
				width: this.element[0].style.width,
				minHeight: this.element[0].style.minHeight,
				maxHeight: this.element[0].style.maxHeight,
				height: this.element[0].style.height
			};
			this.originalPosition = {
				parent: this.element.parent(),
				index: this.element.parent().children().index(this.element)
			};
			this.originalTitle = this.element.attr("title");
			if (this.options.title == null && this.originalTitle != null) {
				this.options.title = this.originalTitle;
			}

			// Dialogs can't be disabled
			if (this.options.disabled) {
				this.options.disabled = false;
			}

			this._createWrapper();

			this.element.show().removeAttr("title").appendTo(this.uiDialog);

			this._addClass("ui-dialog-content", "ui-widget-content");

			this._createTitlebar();
			this._createButtonPane();

			if (this.options.draggable && $.fn.draggable) {
				this._makeDraggable();
			}
			if (this.options.resizable && $.fn.resizable) {
				this._makeResizable();
			}

			this._isOpen = false;

			this._trackFocus();
		},

		_init: function() {
			if (this.options.autoOpen) {
				this.open();
			}
		},

		_appendTo: function() {
			var element = this.options.appendTo;
			if (element && (element.jquery || element.nodeType)) {
				return $(element);
			}
			return this.document.find(element || "body").eq(0);
		},

		_destroy: function() {
			var next, originalPosition = this.originalPosition;

			this._untrackInstance();
			this._destroyOverlay();

			this.element.removeUniqueId().css(this.originalCss)

			// Without detaching first, the following becomes really slow
			.detach();

			this.uiDialog.remove();

			if (this.originalTitle) {
				this.element.attr("title", this.originalTitle);
			}

			next = originalPosition.parent.children().eq(originalPosition.index);

			// Don't try to place the dialog next to itself (#8613)
			if (next.length && next[0] !== this.element[0]) {
				next.before(this.element);
			} else {
				originalPosition.parent.append(this.element);
			}
		},

		widget: function() {
			return this.uiDialog;
		},

		disable: $.noop,
		enable: $.noop,

		close: function(event) {
			var that = this;

			if (!this._isOpen || this._trigger("beforeClose", event) === false) {
				return;
			}

			this._isOpen = false;
			this._focusedElement = null;
			this._destroyOverlay();
			this._untrackInstance();

			if (!this.opener.filter(":focusable").trigger("focus").length) {

				// Hiding a focused element doesn't trigger blur in WebKit
				// so in case we have nothing to focus on, explicitly blur the
				// active element
				// https://bugs.webkit.org/show_bug.cgi?id=47182
				$.ui.safeBlur($.ui.safeActiveElement(this.document[0]));
			}

			this._hide(this.uiDialog, this.options.hide, function() {
				that._trigger("close", event);
			});
		},

		isOpen: function() {
			return this._isOpen;
		},

		moveToTop: function() {
			this._moveToTop();
		},

		_moveToTop: function(event, silent) {
			var moved = false, zIndices = this.uiDialog.siblings(".ui-front:visible").map(function() {
				return +$(this).css("z-index");
			}).get(), zIndexMax = Math.max.apply(null, zIndices);

			if (zIndexMax >= +this.uiDialog.css("z-index")) {
				this.uiDialog.css("z-index", zIndexMax + 1);
				moved = true;
			}

			if (moved && !silent) {
				this._trigger("focus", event);
			}
			return moved;
		},

		open: function() {
			var that = this;
			if (this._isOpen) {
				if (this._moveToTop()) {
					this._focusTabbable();
				}
				return;
			}

			this._isOpen = true;
			this.opener = $($.ui.safeActiveElement(this.document[0]));

			this._size();
			this._position();
			this._createOverlay();
			this._moveToTop(null, true);

			// Ensure the overlay is moved to the top with the dialog, but only
			// when
			// opening. The overlay shouldn't move after the dialog is open so
			// that
			// modeless dialogs opened after the modal dialog stack properly.
			if (this.overlay) {
				this.overlay.css("z-index", this.uiDialog.css("z-index") - 1);
			}

			this._show(this.uiDialog, this.options.show, function() {
				that._focusTabbable();
				that._trigger("focus");
			});

			// Track the dialog immediately upon openening in case a focus event
			// somehow occurs outside of the dialog before an element inside the
			// dialog is focused (#10152)
			this._makeFocusTarget();

			this._trigger("open");
		},

		_focusTabbable: function() {

			// Set focus to the first match:
			// 1. An element that was focused previously
			// 2. First element inside the dialog matching [autofocus]
			// 3. Tabbable element inside the content element
			// 4. Tabbable element inside the buttonpane
			// 5. The close button
			// 6. The dialog itself
			var hasFocus = this._focusedElement;
			if (!hasFocus) {
				hasFocus = this.element.find("[autofocus]");
			}
			if (!hasFocus.length) {
				hasFocus = this.element.find(":tabbable");
			}
			if (!hasFocus.length) {
				hasFocus = this.uiDialogButtonPane.find(":tabbable");
			}
			if (!hasFocus.length) {
				hasFocus = this.uiDialogTitlebarClose.filter(":tabbable");
			}
			if (!hasFocus.length) {
				hasFocus = this.uiDialog;
			}
			hasFocus.eq(0).trigger("focus");
		},

		_keepFocus: function(event) {
			function checkFocus() {
				var activeElement = $.ui.safeActiveElement(this.document[0]), isActive = this.uiDialog[0] === activeElement || $.contains(this.uiDialog[0], activeElement);
				if (!isActive) {
					this._focusTabbable();
				}
			}
			event.preventDefault();
			checkFocus.call(this);

			// support: IE
			// IE <= 8 doesn't prevent moving focus even with
			// event.preventDefault()
			// so we check again later
			this._delay(checkFocus);
		},

		_createWrapper: function() {
			this.uiDialog = $("<div>").hide().attr({

				// Setting tabIndex makes the div focusable
				tabIndex: -1,
				role: "dialog"
			}).appendTo(this._appendTo());

			this._addClass(this.uiDialog, "ui-dialog", "ui-widget ui-widget-content ui-front");
			this._on(this.uiDialog, {
				keydown: function(event) {
					if (this.options.closeOnEscape && !event.isDefaultPrevented() && event.keyCode && event.keyCode === $.ui.keyCode.ESCAPE) {
						event.preventDefault();
						this.close(event);
						return;
					}

					// Prevent tabbing out of dialogs
					if (event.keyCode !== $.ui.keyCode.TAB || event.isDefaultPrevented()) {
						return;
					}
					var tabbables = this.uiDialog.find(":tabbable"), first = tabbables.filter(":first"), last = tabbables.filter(":last");

					if ((event.target === last[0] || event.target === this.uiDialog[0]) && !event.shiftKey) {
						this._delay(function() {
							first.trigger("focus");
						});
						event.preventDefault();
					} else if ((event.target === first[0] || event.target === this.uiDialog[0]) && event.shiftKey) {
						this._delay(function() {
							last.trigger("focus");
						});
						event.preventDefault();
					}
				},
				mousedown: function(event) {
					if (this._moveToTop(event)) {
						this._focusTabbable();
					}
				}
			});

			// We assume that any existing aria-describedby attribute means
			// that the dialog content is marked up properly
			// otherwise we brute force the content as the description
			if (!this.element.find("[aria-describedby]").length) {
				this.uiDialog.attr({
					"aria-describedby": this.element.uniqueId().attr("id")
				});
			}
		},

		_createTitlebar: function() {
			var uiDialogTitle;

			this.uiDialogTitlebar = $("<div>");
			this._addClass(this.uiDialogTitlebar, "ui-dialog-titlebar", "ui-widget-header ui-helper-clearfix");
			this._on(this.uiDialogTitlebar, {
				mousedown: function(event) {

					// Don't prevent click on close button (#8838)
					// Focusing a dialog that is partially scrolled out of view
					// causes the browser to scroll it into view, preventing the
					// click event
					if (!$(event.target).closest(".ui-dialog-titlebar-close")) {

						// Dialog isn't getting focus when dragging (#8063)
						this.uiDialog.trigger("focus");
					}
				}
			});

			// Support: IE
			// Use type="button" to prevent enter keypresses in textboxes from
			// closing the
			// dialog in IE (#9312)
			this.uiDialogTitlebarClose = $("<button type='button'></button>").button({
				label: $("<a>").text(this.options.closeText).html(),
				icon: "ui-icon-closethick",
				showLabel: false
			}).appendTo(this.uiDialogTitlebar);

			this._addClass(this.uiDialogTitlebarClose, "ui-dialog-titlebar-close");
			this._on(this.uiDialogTitlebarClose, {
				click: function(event) {
					event.preventDefault();
					this.close(event);
				}
			});

			uiDialogTitle = $("<span>").uniqueId().prependTo(this.uiDialogTitlebar);
			this._addClass(uiDialogTitle, "ui-dialog-title");
			this._title(uiDialogTitle);

			this.uiDialogTitlebar.prependTo(this.uiDialog);

			this.uiDialog.attr({
				"aria-labelledby": uiDialogTitle.attr("id")
			});
		},

		_title: function(title) {
			if (this.options.title) {
				title.text(this.options.title);
			} else {
				title.html("&#160;");
			}
		},

		_createButtonPane: function() {
			this.uiDialogButtonPane = $("<div>");
			this._addClass(this.uiDialogButtonPane, "ui-dialog-buttonpane", "ui-widget-content ui-helper-clearfix");

			this.uiButtonSet = $("<div>").appendTo(this.uiDialogButtonPane);
			this._addClass(this.uiButtonSet, "ui-dialog-buttonset");

			this._createButtons();
		},

		_createButtons: function() {
			var that = this, buttons = this.options.buttons;

			// If we already have a button pane, remove it
			this.uiDialogButtonPane.remove();
			this.uiButtonSet.empty();

			if ($.isEmptyObject(buttons) || ($.isArray(buttons) && !buttons.length)) {
				this._removeClass(this.uiDialog, "ui-dialog-buttons");
				return;
			}

			$.each(buttons, function(name, props) {
				var click, buttonOptions;
				props = $.isFunction(props) ? {
					click: props,
					text: name
				} : props;

				// Default to a non-submitting button
				props = $.extend({
					type: "button"
				}, props);

				// Change the context for the click callback to be the main
				// element
				click = props.click;
				buttonOptions = {
					icon: props.icon,
					iconPosition: props.iconPosition,
					showLabel: props.showLabel
				};

				delete props.click;
				delete props.icon;
				delete props.iconPosition;
				delete props.showLabel;

				$("<button></button>", props).button(buttonOptions).appendTo(that.uiButtonSet).on("click", function() {
					click.apply(that.element[0], arguments);
				});
			});
			this._addClass(this.uiDialog, "ui-dialog-buttons");
			this.uiDialogButtonPane.appendTo(this.uiDialog);
		},

		_makeDraggable: function() {
			var that = this, options = this.options;

			function filteredUi(ui) {
				return {
					position: ui.position,
					offset: ui.offset
				};
			}

			this.uiDialog.draggable({
				cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
				handle: ".ui-dialog-titlebar",
				containment: "document",
				start: function(event, ui) {
					that._addClass($(this), "ui-dialog-dragging");
					that._blockFrames();
					that._trigger("dragStart", event, filteredUi(ui));
				},
				drag: function(event, ui) {
					that._trigger("drag", event, filteredUi(ui));
				},
				stop: function(event, ui) {
					var left = ui.offset.left - that.document.scrollLeft(), top = ui.offset.top - that.document.scrollTop();

					options.position = {
						my: "left top",
						at: "left" + (left >= 0 ? "+" : "") + left + " " + "top" + (top >= 0 ? "+" : "") + top,
						of: that.window
					};
					that._removeClass($(this), "ui-dialog-dragging");
					that._unblockFrames();
					that._trigger("dragStop", event, filteredUi(ui));
				}
			});
		},

		_makeResizable: function() {
			var that = this, options = this.options, handles = options.resizable,

			// .ui-resizable has position: relative defined in the stylesheet
			// but dialogs have to use absolute or fixed positioning
			position = this.uiDialog.css("position"), resizeHandles = typeof handles === "string" ? handles : "n,e,s,w,se,sw,ne,nw";

			function filteredUi(ui) {
				return {
					originalPosition: ui.originalPosition,
					originalSize: ui.originalSize,
					position: ui.position,
					size: ui.size
				};
			}

			this.uiDialog.resizable({
				cancel: ".ui-dialog-content",
				containment: "document",
				alsoResize: this.element,
				maxWidth: options.maxWidth,
				maxHeight: options.maxHeight,
				minWidth: options.minWidth,
				minHeight: this._minHeight(),
				handles: resizeHandles,
				start: function(event, ui) {
					that._addClass($(this), "ui-dialog-resizing");
					that._blockFrames();
					that._trigger("resizeStart", event, filteredUi(ui));
				},
				resize: function(event, ui) {
					that._trigger("resize", event, filteredUi(ui));
				},
				stop: function(event, ui) {
					var offset = that.uiDialog.offset(), left = offset.left - that.document.scrollLeft(), top = offset.top - that.document.scrollTop();

					options.height = that.uiDialog.height();
					options.width = that.uiDialog.width();
					options.position = {
						my: "left top",
						at: "left" + (left >= 0 ? "+" : "") + left + " " + "top" + (top >= 0 ? "+" : "") + top,
						of: that.window
					};
					that._removeClass($(this), "ui-dialog-resizing");
					that._unblockFrames();
					that._trigger("resizeStop", event, filteredUi(ui));
				}
			}).css("position", position);
		},

		_trackFocus: function() {
			this._on(this.widget(), {
				focusin: function(event) {
					this._makeFocusTarget();
					this._focusedElement = $(event.target);
				}
			});
		},

		_makeFocusTarget: function() {
			this._untrackInstance();
			this._trackingInstances().unshift(this);
		},

		_untrackInstance: function() {
			var instances = this._trackingInstances(), exists = $.inArray(this, instances);
			if (exists !== -1) {
				instances.splice(exists, 1);
			}
		},

		_trackingInstances: function() {
			var instances = this.document.data("ui-dialog-instances");
			if (!instances) {
				instances = [];
				this.document.data("ui-dialog-instances", instances);
			}
			return instances;
		},

		_minHeight: function() {
			var options = this.options;

			return options.height === "auto" ? options.minHeight : Math.min(options.minHeight, options.height);
		},

		_position: function() {

			// Need to show the dialog to get the actual offset in the position
			// plugin
			var isVisible = this.uiDialog.is(":visible");
			if (!isVisible) {
				this.uiDialog.show();
			}
			this.uiDialog.position(this.options.position);
			if (!isVisible) {
				this.uiDialog.hide();
			}
		},

		_setOptions: function(options) {
			var that = this, resize = false, resizableOptions = {};

			$.each(options, function(key, value) {
				that._setOption(key, value);

				if (key in that.sizeRelatedOptions) {
					resize = true;
				}
				if (key in that.resizableRelatedOptions) {
					resizableOptions[key] = value;
				}
			});

			if (resize) {
				this._size();
				this._position();
			}
			if (this.uiDialog.is(":data(ui-resizable)")) {
				this.uiDialog.resizable("option", resizableOptions);
			}
		},

		_setOption: function(key, value) {
			var isDraggable, isResizable, uiDialog = this.uiDialog;

			if (key === "disabled") {
				return;
			}

			this._super(key, value);

			if (key === "appendTo") {
				this.uiDialog.appendTo(this._appendTo());
			}

			if (key === "buttons") {
				this._createButtons();
			}

			if (key === "closeText") {
				this.uiDialogTitlebarClose.button({

					// Ensure that we always pass a string
					label: $("<a>").text("" + this.options.closeText).html()
				});
			}

			if (key === "draggable") {
				isDraggable = uiDialog.is(":data(ui-draggable)");
				if (isDraggable && !value) {
					uiDialog.draggable("destroy");
				}

				if (!isDraggable && value) {
					this._makeDraggable();
				}
			}

			if (key === "position") {
				this._position();
			}

			if (key === "resizable") {

				// currently resizable, becoming non-resizable
				isResizable = uiDialog.is(":data(ui-resizable)");
				if (isResizable && !value) {
					uiDialog.resizable("destroy");
				}

				// Currently resizable, changing handles
				if (isResizable && typeof value === "string") {
					uiDialog.resizable("option", "handles", value);
				}

				// Currently non-resizable, becoming resizable
				if (!isResizable && value !== false) {
					this._makeResizable();
				}
			}

			if (key === "title") {
				this._title(this.uiDialogTitlebar.find(".ui-dialog-title"));
			}
		},

		_size: function() {

			// If the user has resized the dialog, the .ui-dialog and
			// .ui-dialog-content
			// divs will both have width and height set, so we need to reset
			// them
			var nonContentHeight, minContentHeight, maxContentHeight, options = this.options;

			// Reset content sizing
			this.element.show().css({
				width: "auto",
				minHeight: 0,
				maxHeight: "none",
				height: 0
			});

			if (options.minWidth > options.width) {
				options.width = options.minWidth;
			}

			// Reset wrapper sizing
			// determine the height of all the non-content elements
			nonContentHeight = this.uiDialog.css({
				height: "auto",
				width: options.width
			}).outerHeight();
			minContentHeight = Math.max(0, options.minHeight - nonContentHeight);
			maxContentHeight = typeof options.maxHeight === "number" ? Math.max(0, options.maxHeight - nonContentHeight) : "none";

			if (options.height === "auto") {
				this.element.css({
					minHeight: minContentHeight,
					maxHeight: maxContentHeight,
					height: "auto"
				});
			} else {
				this.element.height(Math.max(0, options.height - nonContentHeight));
			}

			if (this.uiDialog.is(":data(ui-resizable)")) {
				this.uiDialog.resizable("option", "minHeight", this._minHeight());
			}
		},

		_blockFrames: function() {
			this.iframeBlocks = this.document.find("iframe").map(function() {
				var iframe = $(this);

				return $("<div>").css({
					position: "absolute",
					width: iframe.outerWidth(),
					height: iframe.outerHeight()
				}).appendTo(iframe.parent()).offset(iframe.offset())[0];
			});
		},

		_unblockFrames: function() {
			if (this.iframeBlocks) {
				this.iframeBlocks.remove();
				delete this.iframeBlocks;
			}
		},

		_allowInteraction: function(event) {
			if ($(event.target).closest(".ui-dialog").length) {
				return true;
			}

			// TODO: Remove hack when datepicker implements
			// the .ui-front logic (#8989)
			return !!$(event.target).closest(".ui-datepicker").length;
		},

		_createOverlay: function() {
			if (!this.options.modal) {
				return;
			}

			// We use a delay in case the overlay is created from an
			// event that we're going to be cancelling (#2804)
			var isOpening = true;
			this._delay(function() {
				isOpening = false;
			});

			if (!this.document.data("ui-dialog-overlays")) {

				// Prevent use of anchors and inputs
				// Using _on() for an event handler shared across many instances
				// is
				// safe because the dialogs stack and must be closed in reverse
				// order
				this._on(this.document, {
					focusin: function(event) {
						if (isOpening) {
							return;
						}

						if (!this._allowInteraction(event)) {
							event.preventDefault();
							this._trackingInstances()[0]._focusTabbable();
						}
					}
				});
			}

			this.overlay = $("<div>").appendTo(this._appendTo());

			this._addClass(this.overlay, null, "ui-widget-overlay ui-front");
			this._on(this.overlay, {
				mousedown: "_keepFocus"
			});
			this.document.data("ui-dialog-overlays", (this.document.data("ui-dialog-overlays") || 0) + 1);
		},

		_destroyOverlay: function() {
			if (!this.options.modal) {
				return;
			}

			if (this.overlay) {
				var overlays = this.document.data("ui-dialog-overlays") - 1;

				if (!overlays) {
					this._off(this.document, "focusin");
					this.document.removeData("ui-dialog-overlays");
				} else {
					this.document.data("ui-dialog-overlays", overlays);
				}

				this.overlay.remove();
				this.overlay = null;
			}
		}
	});

	// DEPRECATED
	// TODO: switch return back to widget declaration at top of file when this
	// is removed
	if ($.uiBackCompat !== false) {

		// Backcompat for dialogClass option
		$.widget("ui.dialog", $.ui.dialog, {
			options: {
				dialogClass: ""
			},
			_createWrapper: function() {
				this._super();
				this.uiDialog.addClass(this.options.dialogClass);
			},
			_setOption: function(key, value) {
				if (key === "dialogClass") {
					this.uiDialog.removeClass(this.options.dialogClass).addClass(value);
				}
				this._superApply(arguments);
			}
		});
	}

	var widgetsDialog = $.ui.dialog;

	/*
	 * ! jQuery UI Progressbar 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Progressbar
	// >>group: Widgets
	// >>description: Displays a status indicator for loading state, standard
	// percentage, and other progress indicators.
	// >>docs: http://api.jqueryui.com/progressbar/
	// >>demos: http://jqueryui.com/progressbar/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/progressbar.css
	// >>css.theme: ../../themes/base/theme.css
	var widgetsProgressbar = $.widget("ui.progressbar", {
		version: "1.12.0-beta.1",
		options: {
			classes: {
				"ui-progressbar": "ui-corner-all",
				"ui-progressbar-value": "ui-corner-left",
				"ui-progressbar-complete": "ui-corner-right"
			},
			max: 100,
			value: 0,

			change: null,
			complete: null
		},

		min: 0,

		_create: function() {

			// Constrain initial value
			this.oldValue = this.options.value = this._constrainedValue();

			this.element.attr({

				// Only set static values; aria-valuenow and aria-valuemax are
				// set inside _refreshValue()
				role: "progressbar",
				"aria-valuemin": this.min
			});
			this._addClass("ui-progressbar", "ui-widget ui-widget-content");

			this.valueDiv = $("<div>").appendTo(this.element);
			this._addClass(this.valueDiv, "ui-progressbar-value", "ui-widget-header");
			this._refreshValue();
		},

		_destroy: function() {
			this.element.removeAttr("role aria-valuemin aria-valuemax aria-valuenow");

			this.valueDiv.remove();
		},

		value: function(newValue) {
			if (newValue === undefined) {
				return this.options.value;
			}

			this.options.value = this._constrainedValue(newValue);
			this._refreshValue();
		},

		_constrainedValue: function(newValue) {
			if (newValue === undefined) {
				newValue = this.options.value;
			}

			this.indeterminate = newValue === false;

			// Sanitize value
			if (typeof newValue !== "number") {
				newValue = 0;
			}

			return this.indeterminate ? false : Math.min(this.options.max, Math.max(this.min, newValue));
		},

		_setOptions: function(options) {

			// Ensure "value" option is set after other values (like max)
			var value = options.value;
			delete options.value;

			this._super(options);

			this.options.value = this._constrainedValue(value);
			this._refreshValue();
		},

		_setOption: function(key, value) {
			if (key === "max") {

				// Don't allow a max less than min
				value = Math.max(this.min, value);
			}
			this._super(key, value);
		},

		_setOptionDisabled: function(value) {
			this._super(value);

			this.element.attr("aria-disabled", value);
			this._toggleClass(null, "ui-state-disabled", !!value);
		},

		_percentage: function() {
			return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min);
		},

		_refreshValue: function() {
			var value = this.options.value, percentage = this._percentage();

			this.valueDiv.toggle(this.indeterminate || value > this.min).width(percentage.toFixed(0) + "%");

			this._toggleClass(this.valueDiv, "ui-progressbar-complete", null, value === this.options.max)._toggleClass("ui-progressbar-indeterminate", null, this.indeterminate);

			if (this.indeterminate) {
				this.element.removeAttr("aria-valuenow");
				if (!this.overlayDiv) {
					this.overlayDiv = $("<div>").appendTo(this.valueDiv);
					this._addClass(this.overlayDiv, "ui-progressbar-overlay");
				}
			} else {
				this.element.attr({
					"aria-valuemax": this.options.max,
					"aria-valuenow": value
				});
				if (this.overlayDiv) {
					this.overlayDiv.remove();
					this.overlayDiv = null;
				}
			}

			if (this.oldValue !== value) {
				this.oldValue = value;
				this._trigger("change");
			}
			if (value === this.options.max) {
				this._trigger("complete");
			}
		}
	});

	/*
	 * ! jQuery UI Slider 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Slider
	// >>group: Widgets
	// >>description: Displays a flexible slider with ranges and accessibility
	// via keyboard.
	// >>docs: http://api.jqueryui.com/slider/
	// >>demos: http://jqueryui.com/slider/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/slider.css
	// >>css.theme: ../../themes/base/theme.css
	var widgetsSlider = $.widget("ui.slider", $.ui.mouse, {
		version: "1.12.0-beta.1",
		widgetEventPrefix: "slide",

		options: {
			animate: false,
			classes: {
				"ui-slider": "ui-corner-all",
				"ui-slider-handle": "ui-corner-all",

				// Note: ui-widget-header isn't the most fittingly semantic
				// framework class for this
				// element, but worked best visually with a variety of themes
				"ui-slider-range": "ui-corner-all ui-widget-header"
			},
			distance: 0,
			max: 100,
			min: 0,
			orientation: "horizontal",
			range: false,
			step: 1,
			value: 0,
			values: null,

			// Callbacks
			change: null,
			slide: null,
			start: null,
			stop: null
		},

		// Number of pages in a slider
		// (how many times can you page up/down to go through the whole range)
		numPages: 5,

		_create: function() {
			this._keySliding = false;
			this._mouseSliding = false;
			this._animateOff = true;
			this._handleIndex = null;
			this._detectOrientation();
			this._mouseInit();
			this._calculateNewMax();

			this._addClass("ui-slider ui-slider-" + this.orientation, "ui-widget ui-widget-content");

			this._refresh();

			this._animateOff = false;
		},

		_refresh: function() {
			this._createRange();
			this._createHandles();
			this._setupEvents();
			this._refreshValue();
		},

		_createHandles: function() {
			var i, handleCount, options = this.options, existingHandles = this.element.find(".ui-slider-handle"), handle = "<span tabindex='0'></span>", handles = [];

			handleCount = (options.values && options.values.length) || 1;

			if (existingHandles.length > handleCount) {
				existingHandles.slice(handleCount).remove();
				existingHandles = existingHandles.slice(0, handleCount);
			}

			for (i = existingHandles.length; i < handleCount; i++) {
				handles.push(handle);
			}

			this.handles = existingHandles.add($(handles.join("")).appendTo(this.element));

			this._addClass(this.handles, "ui-slider-handle", "ui-state-default");

			this.handle = this.handles.eq(0);

			this.handles.each(function(i) {
				$(this).data("ui-slider-handle-index", i);
			});
		},

		_createRange: function() {
			var options = this.options;

			if (options.range) {
				if (options.range === true) {
					if (!options.values) {
						options.values = [this._valueMin(), this._valueMin()];
					} else if (options.values.length && options.values.length !== 2) {
						options.values = [options.values[0], options.values[0]];
					} else if ($.isArray(options.values)) {
						options.values = options.values.slice(0);
					}
				}

				if (!this.range || !this.range.length) {
					this.range = $("<div>").appendTo(this.element);

					this._addClass(this.range, "ui-slider-range");
				} else {
					this._removeClass(this.range, "ui-slider-range-min ui-slider-range-max");

					// Handle range switching from true to min/max
					this.range.css({
						"left": "",
						"bottom": ""
					});
				}
				if (options.range === "min" || options.range === "max") {
					this._addClass(this.range, "ui-slider-range-" + options.range);
				}
			} else {
				if (this.range) {
					this.range.remove();
				}
				this.range = null;
			}
		},

		_setupEvents: function() {
			this._off(this.handles);
			this._on(this.handles, this._handleEvents);
			this._hoverable(this.handles);
			this._focusable(this.handles);
		},

		_destroy: function() {
			this.handles.remove();
			if (this.range) {
				this.range.remove();
			}

			this._mouseDestroy();
		},

		_mouseCapture: function(event) {
			var position, normValue, distance, closestHandle, index, allowed, offset, mouseOverHandle, that = this, o = this.options;

			if (o.disabled) {
				return false;
			}

			this.elementSize = {
				width: this.element.outerWidth(),
				height: this.element.outerHeight()
			};
			this.elementOffset = this.element.offset();

			position = {
				x: event.pageX,
				y: event.pageY
			};
			normValue = this._normValueFromMouse(position);
			distance = this._valueMax() - this._valueMin() + 1;
			this.handles.each(function(i) {
				var thisDistance = Math.abs(normValue - that.values(i));
				if ((distance > thisDistance) || (distance === thisDistance && (i === that._lastChangedValue || that.values(i) === o.min))) {
					distance = thisDistance;
					closestHandle = $(this);
					index = i;
				}
			});

			allowed = this._start(event, index);
			if (allowed === false) {
				return false;
			}
			this._mouseSliding = true;

			this._handleIndex = index;

			this._addClass(closestHandle, null, "ui-state-active");
			closestHandle.trigger("focus");

			offset = closestHandle.offset();
			mouseOverHandle = !$(event.target).parents().addBack().is(".ui-slider-handle");
			this._clickOffset = mouseOverHandle ? {
				left: 0,
				top: 0
			} : {
				left: event.pageX - offset.left - (closestHandle.width() / 2),
				top: event.pageY - offset.top - (closestHandle.height() / 2) - (parseInt(closestHandle.css("borderTopWidth"), 10) || 0) - (parseInt(closestHandle.css("borderBottomWidth"), 10) || 0) + (parseInt(closestHandle.css("marginTop"), 10) || 0)
			};

			if (!this.handles.hasClass("ui-state-hover")) {
				this._slide(event, index, normValue);
			}
			this._animateOff = true;
			return true;
		},

		_mouseStart: function() {
			return true;
		},

		_mouseDrag: function(event) {
			var position = {
				x: event.pageX,
				y: event.pageY
			}, normValue = this._normValueFromMouse(position);

			this._slide(event, this._handleIndex, normValue);

			return false;
		},

		_mouseStop: function(event) {
			this._removeClass(this.handles, null, "ui-state-active");
			this._mouseSliding = false;

			this._stop(event, this._handleIndex);
			this._change(event, this._handleIndex);

			this._handleIndex = null;
			this._clickOffset = null;
			this._animateOff = false;

			return false;
		},

		_detectOrientation: function() {
			this.orientation = (this.options.orientation === "vertical") ? "vertical" : "horizontal";
		},

		_normValueFromMouse: function(position) {
			var pixelTotal, pixelMouse, percentMouse, valueTotal, valueMouse;

			if (this.orientation === "horizontal") {
				pixelTotal = this.elementSize.width;
				pixelMouse = position.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0);
			} else {
				pixelTotal = this.elementSize.height;
				pixelMouse = position.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0);
			}

			percentMouse = (pixelMouse / pixelTotal);
			if (percentMouse > 1) {
				percentMouse = 1;
			}
			if (percentMouse < 0) {
				percentMouse = 0;
			}
			if (this.orientation === "vertical") {
				percentMouse = 1 - percentMouse;
			}

			valueTotal = this._valueMax() - this._valueMin();
			valueMouse = this._valueMin() + percentMouse * valueTotal;

			return this._trimAlignValue(valueMouse);
		},

		_uiHash: function(index, value, values) {
			var uiHash = {
				handle: this.handles[index],
				handleIndex: index,
				value: value !== undefined ? value : this.value()
			};

			if (this._hasMultipleValues()) {
				uiHash.value = value !== undefined ? value : this.values(index);
				uiHash.values = values || this.values();
			}

			return uiHash;
		},

		_hasMultipleValues: function() {
			return this.options.values && this.options.values.length;
		},

		_start: function(event, index) {
			return this._trigger("start", event, this._uiHash(index));
		},

		_slide: function(event, index, newVal) {
			var allowed, otherVal, currentValue = this.value(), newValues = this.values();

			if (this._hasMultipleValues()) {
				otherVal = this.values(index ? 0 : 1);
				currentValue = this.values(index);

				if (this.options.values.length === 2 && this.options.range === true) {
					newVal = index === 0 ? Math.min(otherVal, newVal) : Math.max(otherVal, newVal);
				}

				newValues[index] = newVal;
			}

			if (newVal === currentValue) {
				return;
			}

			allowed = this._trigger("slide", event, this._uiHash(index, newVal, newValues));

			// A slide can be canceled by returning false from the slide
			// callback
			if (allowed === false) {
				return;
			}

			if (this._hasMultipleValues()) {
				this.values(index, newVal);
			} else {
				this.value(newVal);
			}
		},

		_stop: function(event, index) {
			this._trigger("stop", event, this._uiHash(index));
		},

		_change: function(event, index) {
			if (!this._keySliding && !this._mouseSliding) {

				// store the last changed value index for reference when handles
				// overlap
				this._lastChangedValue = index;
				this._trigger("change", event, this._uiHash(index));
			}
		},

		value: function(newValue) {
			if (arguments.length) {
				this.options.value = this._trimAlignValue(newValue);
				this._refreshValue();
				this._change(null, 0);
				return;
			}

			return this._value();
		},

		values: function(index, newValue) {
			var vals, newValues, i;

			if (arguments.length > 1) {
				this.options.values[index] = this._trimAlignValue(newValue);
				this._refreshValue();
				this._change(null, index);
				return;
			}

			if (arguments.length) {
				if ($.isArray(arguments[0])) {
					vals = this.options.values;
					newValues = arguments[0];
					for (i = 0; i < vals.length; i += 1) {
						vals[i] = this._trimAlignValue(newValues[i]);
						this._change(null, i);
					}
					this._refreshValue();
				} else {
					if (this._hasMultipleValues()) {
						return this._values(index);
					} else {
						return this.value();
					}
				}
			} else {
				return this._values();
			}
		},

		_setOption: function(key, value) {
			var i, valsLength = 0;

			if (key === "range" && this.options.range === true) {
				if (value === "min") {
					this.options.value = this._values(0);
					this.options.values = null;
				} else if (value === "max") {
					this.options.value = this._values(this.options.values.length - 1);
					this.options.values = null;
				}
			}

			if ($.isArray(this.options.values)) {
				valsLength = this.options.values.length;
			}

			this._super(key, value);

			switch (key) {
				case "orientation":
					this._detectOrientation();
					this._removeClass("ui-slider-horizontal ui-slider-vertical")._addClass("ui-slider-" + this.orientation);
					this._refreshValue();
					if (this.options.range) {
						this._refreshRange(value);
					}

					// Reset positioning from previous orientation
					this.handles.css(value === "horizontal" ? "bottom" : "left", "");
					break;
				case "value":
					this._animateOff = true;
					this._refreshValue();
					this._change(null, 0);
					this._animateOff = false;
					break;
				case "values":
					this._animateOff = true;
					this._refreshValue();

					// Start from the last handle to prevent unreachable handles
					// (#9046)
					for (i = valsLength - 1; i >= 0; i--) {
						this._change(null, i);
					}
					this._animateOff = false;
					break;
				case "step":
				case "min":
				case "max":
					this._animateOff = true;
					this._calculateNewMax();
					this._refreshValue();
					this._animateOff = false;
					break;
				case "range":
					this._animateOff = true;
					this._refresh();
					this._animateOff = false;
					break;
			}
		},

		_setOptionDisabled: function(value) {
			this._super(value);

			this._toggleClass(null, "ui-state-disabled", !!value);
		},

		// internal value getter
		// _value() returns value trimmed by min and max, aligned by step
		_value: function() {
			var val = this.options.value;
			val = this._trimAlignValue(val);

			return val;
		},

		// internal values getter
		// _values() returns array of values trimmed by min and max, aligned by
		// step
		// _values( index ) returns single value trimmed by min and max, aligned
		// by step
		_values: function(index) {
			var val, vals, i;

			if (arguments.length) {
				val = this.options.values[index];
				val = this._trimAlignValue(val);

				return val;
			} else if (this._hasMultipleValues()) {

				// .slice() creates a copy of the array
				// this copy gets trimmed by min and max and then returned
				vals = this.options.values.slice();
				for (i = 0; i < vals.length; i += 1) {
					vals[i] = this._trimAlignValue(vals[i]);
				}

				return vals;
			} else {
				return [];
			}
		},

		// Returns the step-aligned value that val is closest to, between
		// (inclusive) min and max
		_trimAlignValue: function(val) {
			if (val <= this._valueMin()) {
				return this._valueMin();
			}
			if (val >= this._valueMax()) {
				return this._valueMax();
			}
			var step = (this.options.step > 0) ? this.options.step : 1, valModStep = (val - this._valueMin()) % step, alignValue = val - valModStep;

			if (Math.abs(valModStep) * 2 >= step) {
				alignValue += (valModStep > 0) ? step : (-step);
			}

			// Since JavaScript has problems with large floats, round
			// the final value to 5 digits after the decimal point (see #4124)
			return parseFloat(alignValue.toFixed(5));
		},

		_calculateNewMax: function() {
			var max = this.options.max, min = this._valueMin(), step = this.options.step, aboveMin = Math.floor((+(max - min).toFixed(this._precision())) / step) * step;
			max = aboveMin + min;
			this.max = parseFloat(max.toFixed(this._precision()));
		},

		_precision: function() {
			var precision = this._precisionOf(this.options.step);
			if (this.options.min !== null) {
				precision = Math.max(precision, this._precisionOf(this.options.min));
			}
			return precision;
		},

		_precisionOf: function(num) {
			var str = num.toString(), decimal = str.indexOf(".");
			return decimal === -1 ? 0 : str.length - decimal - 1;
		},

		_valueMin: function() {
			return this.options.min;
		},

		_valueMax: function() {
			return this.max;
		},

		_refreshRange: function(orientation) {
			if (orientation === "vertical") {
				this.range.css({
					"width": "",
					"left": ""
				});
			}
			if (orientation === "horizontal") {
				this.range.css({
					"height": "",
					"bottom": ""
				});
			}
		},

		_refreshValue: function() {
			var lastValPercent, valPercent, value, valueMin, valueMax, oRange = this.options.range, o = this.options, that = this, animate = (!this._animateOff) ? o.animate : false, _set = {};

			if (this._hasMultipleValues()) {
				this.handles.each(function(i) {
					valPercent = (that.values(i) - that._valueMin()) / (that._valueMax() - that._valueMin()) * 100;
					_set[that.orientation === "horizontal" ? "left" : "bottom"] = valPercent + "%";
					$(this).stop(1, 1)[animate ? "animate" : "css"](_set, o.animate);
					if (that.options.range === true) {
						if (that.orientation === "horizontal") {
							if (i === 0) {
								that.range.stop(1, 1)[animate ? "animate" : "css"]({
									left: valPercent + "%"
								}, o.animate);
							}
							if (i === 1) {
								that.range[animate ? "animate" : "css"]({
									width: (valPercent - lastValPercent) + "%"
								}, {
									queue: false,
									duration: o.animate
								});
							}
						} else {
							if (i === 0) {
								that.range.stop(1, 1)[animate ? "animate" : "css"]({
									bottom: (valPercent) + "%"
								}, o.animate);
							}
							if (i === 1) {
								that.range[animate ? "animate" : "css"]({
									height: (valPercent - lastValPercent) + "%"
								}, {
									queue: false,
									duration: o.animate
								});
							}
						}
					}
					lastValPercent = valPercent;
				});
			} else {
				value = this.value();
				valueMin = this._valueMin();
				valueMax = this._valueMax();
				valPercent = (valueMax !== valueMin) ? (value - valueMin) / (valueMax - valueMin) * 100 : 0;
				_set[this.orientation === "horizontal" ? "left" : "bottom"] = valPercent + "%";
				this.handle.stop(1, 1)[animate ? "animate" : "css"](_set, o.animate);

				if (oRange === "min" && this.orientation === "horizontal") {
					this.range.stop(1, 1)[animate ? "animate" : "css"]({
						width: valPercent + "%"
					}, o.animate);
				}
				if (oRange === "max" && this.orientation === "horizontal") {
					this.range.stop(1, 1)[animate ? "animate" : "css"]({
						width: (100 - valPercent) + "%"
					}, o.animate);
				}
				if (oRange === "min" && this.orientation === "vertical") {
					this.range.stop(1, 1)[animate ? "animate" : "css"]({
						height: valPercent + "%"
					}, o.animate);
				}
				if (oRange === "max" && this.orientation === "vertical") {
					this.range.stop(1, 1)[animate ? "animate" : "css"]({
						height: (100 - valPercent) + "%"
					}, o.animate);
				}
			}
		},

		_handleEvents: {
			keydown: function(event) {
				var allowed, curVal, newVal, step, index = $(event.target).data("ui-slider-handle-index");

				switch (event.keyCode) {
					case $.ui.keyCode.HOME:
					case $.ui.keyCode.END:
					case $.ui.keyCode.PAGE_UP:
					case $.ui.keyCode.PAGE_DOWN:
					case $.ui.keyCode.UP:
					case $.ui.keyCode.RIGHT:
					case $.ui.keyCode.DOWN:
					case $.ui.keyCode.LEFT:
						event.preventDefault();
						if (!this._keySliding) {
							this._keySliding = true;
							this._addClass($(event.target), null, "ui-state-active");
							allowed = this._start(event, index);
							if (allowed === false) {
								return;
							}
						}
						break;
				}

				step = this.options.step;
				if (this._hasMultipleValues()) {
					curVal = newVal = this.values(index);
				} else {
					curVal = newVal = this.value();
				}

				switch (event.keyCode) {
					case $.ui.keyCode.HOME:
						newVal = this._valueMin();
						break;
					case $.ui.keyCode.END:
						newVal = this._valueMax();
						break;
					case $.ui.keyCode.PAGE_UP:
						newVal = this._trimAlignValue(curVal + ((this._valueMax() - this._valueMin()) / this.numPages));
						break;
					case $.ui.keyCode.PAGE_DOWN:
						newVal = this._trimAlignValue(curVal - ((this._valueMax() - this._valueMin()) / this.numPages));
						break;
					case $.ui.keyCode.UP:
					case $.ui.keyCode.RIGHT:
						if (curVal === this._valueMax()) {
							return;
						}
						newVal = this._trimAlignValue(curVal + step);
						break;
					case $.ui.keyCode.DOWN:
					case $.ui.keyCode.LEFT:
						if (curVal === this._valueMin()) {
							return;
						}
						newVal = this._trimAlignValue(curVal - step);
						break;
				}

				this._slide(event, index, newVal);
			},
			keyup: function(event) {
				var index = $(event.target).data("ui-slider-handle-index");

				if (this._keySliding) {
					this._keySliding = false;
					this._stop(event, index);
					this._change(event, index);
					this._removeClass($(event.target), null, "ui-state-active");
				}
			}
		}
	});

	/*
	 * ! jQuery UI Spinner 1.12.0-beta.1 http://jqueryui.com
	 * 
	 * Copyright jQuery Foundation and other contributors Released under the MIT
	 * license. http://jquery.org/license
	 */

	// >>label: Spinner
	// >>group: Widgets
	// >>description: Displays buttons to easily input numbers via the keyboard
	// or mouse.
	// >>docs: http://api.jqueryui.com/spinner/
	// >>demos: http://jqueryui.com/spinner/
	// >>css.structure: ../../themes/base/core.css
	// >>css.structure: ../../themes/base/spinner.css
	// >>css.theme: ../../themes/base/theme.css
	function spinnerModifer(fn) {
		return function() {
			var previous = this.element.val();
			fn.apply(this, arguments);
			this._refresh();
			if (previous !== this.element.val()) {
				this._trigger("change");
			}
		};
	}

	$.widget("ui.spinner", {
		version: "1.12.0-beta.1",
		defaultElement: "<input>",
		widgetEventPrefix: "spin",
		options: {
			classes: {
				"ui-spinner": "ui-corner-all",
				"ui-spinner-down": "ui-corner-br",
				"ui-spinner-up": "ui-corner-tr"
			},
			culture: null,
			icons: {
				down: "ui-icon-triangle-1-s",
				up: "ui-icon-triangle-1-n"
			},
			incremental: true,
			max: null,
			min: null,
			numberFormat: null,
			page: 10,
			step: 1,

			change: null,
			spin: null,
			start: null,
			stop: null
		},

		_create: function() {

			// handle string values that need to be parsed
			this._setOption("max", this.options.max);
			this._setOption("min", this.options.min);
			this._setOption("step", this.options.step);

			// Only format if there is a value, prevents the field from being
			// marked
			// as invalid in Firefox, see #9573.
			if (this.value() !== "") {

				// Format the value, but don't constrain.
				this._value(this.element.val(), true);
			}

			this._draw();
			this._on(this._events);
			this._refresh();

			// Turning off autocomplete prevents the browser from remembering
			// the
			// value when navigating through history, so we re-enable
			// autocomplete
			// if the page is unloaded before the widget is destroyed. #7790
			this._on(this.window, {
				beforeunload: function() {
					this.element.removeAttr("autocomplete");
				}
			});
		},

		_getCreateOptions: function() {
			var options = this._super();
			var element = this.element;

			$.each(["min", "max", "step"], function(i, option) {
				var value = element.attr(option);
				if (value != null && value.length) {
					options[option] = value;
				}
			});

			return options;
		},

		_events: {
			keydown: function(event) {
				if (this._start(event) && this._keydown(event)) {
					event.preventDefault();
				}
			},
			keyup: "_stop",
			focus: function() {
				this.previous = this.element.val();
			},
			blur: function(event) {
				if (this.cancelBlur) {
					delete this.cancelBlur;
					return;
				}

				this._stop();
				this._refresh();
				if (this.previous !== this.element.val()) {
					this._trigger("change", event);
				}
			},
			mousewheel: function(event, delta) {
				if (!delta) {
					return;
				}
				if (!this.spinning && !this._start(event)) {
					return false;
				}

				this._spin((delta > 0 ? 1 : -1) * this.options.step, event);
				clearTimeout(this.mousewheelTimer);
				this.mousewheelTimer = this._delay(function() {
					if (this.spinning) {
						this._stop(event);
					}
				}, 100);
				event.preventDefault();
			},
			"mousedown .ui-spinner-button": function(event) {
				var previous;

				// We never want the buttons to have focus; whenever the user is
				// interacting with the spinner, the focus should be on the
				// input.
				// If the input is focused then this.previous is properly set
				// from
				// when the input first received focus. If the input is not
				// focused
				// then we need to set this.previous based on the value before
				// spinning.
				previous = this.element[0] === $.ui.safeActiveElement(this.document[0]) ? this.previous : this.element.val();
				function checkFocus() {
					var isActive = this.element[0] === $.ui.safeActiveElement(this.document[0]);
					if (!isActive) {
						this.element.trigger("focus");
						this.previous = previous;

						// support: IE
						// IE sets focus asynchronously, so we need to check if
						// focus
						// moved off of the input because the user clicked on
						// the button.
						this._delay(function() {
							this.previous = previous;
						});
					}
				}

				// Ensure focus is on (or stays on) the text field
				event.preventDefault();
				checkFocus.call(this);

				// Support: IE
				// IE doesn't prevent moving focus even with
				// event.preventDefault()
				// so we set a flag to know when we should ignore the blur event
				// and check (again) if focus moved off of the input.
				this.cancelBlur = true;
				this._delay(function() {
					delete this.cancelBlur;
					checkFocus.call(this);
				});

				if (this._start(event) === false) {
					return;
				}

				this._repeat(null, $(event.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, event);
			},
			"mouseup .ui-spinner-button": "_stop",
			"mouseenter .ui-spinner-button": function(event) {

				// button will add ui-state-active if mouse was down while
				// mouseleave and kept down
				if (!$(event.currentTarget).hasClass("ui-state-active")) {
					return;
				}

				if (this._start(event) === false) {
					return false;
				}
				this._repeat(null, $(event.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, event);
			},

			// TODO: do we really want to consider this a stop?
			// shouldn't we just stop the repeater and wait until mouseup before
			// we trigger the stop event?
			"mouseleave .ui-spinner-button": "_stop"
		},

		// Support mobile enhanced option and make backcompat more sane
		_enhance: function() {
			this.uiSpinner = this.element.attr("autocomplete", "off").wrap("<span>").parent()

			// Add buttons
			.append("<a></a><a></a>");
		},

		_draw: function() {
			this._enhance();

			this._addClass(this.uiSpinner, "ui-spinner", "ui-widget ui-widget-content");
			this._addClass("ui-spinner-input");

			this.element.attr("role", "spinbutton");

			// Button bindings
			this.buttons = this.uiSpinner.children("a").attr("tabIndex", -1).attr("aria-hidden", true).button({
				classes: {
					"ui-button": ""
				}
			});

			// TODO: Right now button does not support classes this is already
			// updated in button PR
			this._removeClass(this.buttons, "ui-corner-all");

			this._addClass(this.buttons.first(), "ui-spinner-button ui-spinner-up");
			this._addClass(this.buttons.last(), "ui-spinner-button ui-spinner-down");
			this.buttons.first().button({
				"icon": this.options.icons.up,
				"showLabel": false
			});
			this.buttons.last().button({
				"icon": this.options.icons.down,
				"showLabel": false
			});

			// IE 6 doesn't understand height: 50% for the buttons
			// unless the wrapper has an explicit height
			if (this.buttons.height() > Math.ceil(this.uiSpinner.height() * 0.5) && this.uiSpinner.height() > 0) {
				this.uiSpinner.height(this.uiSpinner.height());
			}
		},

		_keydown: function(event) {
			var options = this.options, keyCode = $.ui.keyCode;

			switch (event.keyCode) {
				case keyCode.UP:
					this._repeat(null, 1, event);
					return true;
				case keyCode.DOWN:
					this._repeat(null, -1, event);
					return true;
				case keyCode.PAGE_UP:
					this._repeat(null, options.page, event);
					return true;
				case keyCode.PAGE_DOWN:
					this._repeat(null, -options.page, event);
					return true;
			}

			return false;
		},

		_start: function(event) {
			if (!this.spinning && this._trigger("start", event) === false) {
				return false;
			}

			if (!this.counter) {
				this.counter = 1;
			}
			this.spinning = true;
			return true;
		},

		_repeat: function(i, steps, event) {
			i = i || 500;

			clearTimeout(this.timer);
			this.timer = this._delay(function() {
				this._repeat(40, steps, event);
			}, i);

			this._spin(steps * this.options.step, event);
		},

		_spin: function(step, event) {
			var value = this.value() || 0;

			if (!this.counter) {
				this.counter = 1;
			}

			value = this._adjustValue(value + step * this._increment(this.counter));

			if (!this.spinning || this._trigger("spin", event, {
				value: value
			}) !== false) {
				this._value(value);
				this.counter++;
			}
		},

		_increment: function(i) {
			var incremental = this.options.incremental;

			if (incremental) {
				return $.isFunction(incremental) ? incremental(i) : Math.floor(i * i * i / 50000 - i * i / 500 + 17 * i / 200 + 1);
			}

			return 1;
		},

		_precision: function() {
			var precision = this._precisionOf(this.options.step);
			if (this.options.min !== null) {
				precision = Math.max(precision, this._precisionOf(this.options.min));
			}
			return precision;
		},

		_precisionOf: function(num) {
			var str = num.toString(), decimal = str.indexOf(".");
			return decimal === -1 ? 0 : str.length - decimal - 1;
		},

		_adjustValue: function(value) {
			var base, aboveMin, options = this.options;

			// Make sure we're at a valid step
			// - find out where we are relative to the base (min or 0)
			base = options.min !== null ? options.min : 0;
			aboveMin = value - base;

			// - round to the nearest step
			aboveMin = Math.round(aboveMin / options.step) * options.step;

			// - rounding is based on 0, so adjust back to our base
			value = base + aboveMin;

			// Fix precision from bad JS floating point math
			value = parseFloat(value.toFixed(this._precision()));

			// Clamp the value
			if (options.max !== null && value > options.max) {
				return options.max;
			}
			if (options.min !== null && value < options.min) {
				return options.min;
			}

			return value;
		},

		_stop: function(event) {
			if (!this.spinning) {
				return;
			}

			clearTimeout(this.timer);
			clearTimeout(this.mousewheelTimer);
			this.counter = 0;
			this.spinning = false;
			this._trigger("stop", event);
		},

		_setOption: function(key, value) {
			var prevValue, first, last;

			if (key === "culture" || key === "numberFormat") {
				prevValue = this._parse(this.element.val());
				this.options[key] = value;
				this.element.val(this._format(prevValue));
				return;
			}

			if (key === "max" || key === "min" || key === "step") {
				if (typeof value === "string") {
					value = this._parse(value);
				}
			}
			if (key === "icons") {
				first = this.buttons.first().find(".ui-icon");
				this._removeClass(first, null, this.options.icons.up);
				this._addClass(first, null, value.up);
				last = this.buttons.last().find(".ui-icon");
				this._removeClass(last, null, this.options.icons.down);
				this._addClass(last, null, value.down);
			}

			this._super(key, value);
		},

		_setOptionDisabled: function(value) {
			this._super(value);

			this._toggleClass(this.uiSpinner, null, "ui-state-disabled", !!value);
			this.element.prop("disabled", !!value);
			this.buttons.button(value ? "disable" : "enable");
		},

		_setOptions: spinnerModifer(function(options) {
			this._super(options);
		}),

		_parse: function(val) {
			if (typeof val === "string" && val !== "") {
				val = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(val, 10, this.options.culture) : +val;
			}
			return val === "" || isNaN(val) ? null : val;
		},

		_format: function(value) {
			if (value === "") {
				return "";
			}
			return window.Globalize && this.options.numberFormat ? Globalize.format(value, this.options.numberFormat, this.options.culture) : value;
		},

		_refresh: function() {
			this.element.attr({
				"aria-valuemin": this.options.min,
				"aria-valuemax": this.options.max,

				// TODO: what should we do with values that can't be parsed?
				"aria-valuenow": this._parse(this.element.val())
			});
		},

		isValid: function() {
			var value = this.value();

			// Null is invalid
			if (value === null) {
				return false;
			}

			// If value gets adjusted, it's invalid
			return value === this._adjustValue(value);
		},

		// Update the value without triggering change
		_value: function(value, allowAny) {
			var parsed;
			if (value !== "") {
				parsed = this._parse(value);
				if (parsed !== null) {
					if (!allowAny) {
						parsed = this._adjustValue(parsed);
					}
					value = this._format(parsed);
				}
			}
			this.element.val(value);
			this._refresh();
		},

		_destroy: function() {
			this.element.prop("disabled", false).removeAttr("autocomplete role aria-valuemin aria-valuemax aria-valuenow");

			this.uiSpinner.replaceWith(this.element);
		},

		stepUp: spinnerModifer(function(steps) {
			this._stepUp(steps);
		}),
		_stepUp: function(steps) {
			if (this._start()) {
				this._spin((steps || 1) * this.options.step);
				this._stop();
			}
		},

		stepDown: spinnerModifer(function(steps) {
			this._stepDown(steps);
		}),
		_stepDown: function(steps) {
			if (this._start()) {
				this._spin((steps || 1) * -this.options.step);
				this._stop();
			}
		},

		pageUp: spinnerModifer(function(pages) {
			this._stepUp((pages || 1) * this.options.page);
		}),

		pageDown: spinnerModifer(function(pages) {
			this._stepDown((pages || 1) * this.options.page);
		}),

		value: function(newVal) {
			if (!arguments.length) {
				return this._parse(this.element.val());
			}
			spinnerModifer(this._value).call(this, newVal);
		},

		widget: function() {
			return this.uiSpinner;
		}
	});

	// DEPRECATED
	// TODO: switch return back to widget declaration at top of file when this
	// is removed
	if ($.uiBackCompat !== false) {

		// Backcompat for spinner html extension points
		$.widget("ui.spinner", $.ui.spinner, {
			_enhance: function() {
				this.uiSpinner = this.element.attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent()

				// Add buttons
				.append(this._buttonHtml());
			},
			_uiSpinnerHtml: function() {
				return "<span>";
			},

			_buttonHtml: function() {
				return "<a></a><a></a>";
			}
		});
	}

	var widgetsSpinner = $.ui.spinner;

}));