(function(window) {
	if (!Function.prototype.bind) {
		Function.prototype.bind = function(obj) {
			var slice = [].slice,
				args = slice.call(arguments, 1),
				self = this,
				nop = function() {},
				bound = function() {
					return self.apply(this instanceof nop ? this : (obj || {}), args.concat(slice.call(arguments)))
				};
			nop.prototype = self.prototype;
			bound.prototype = new nop();
			return bound
		}
	}
	if (typeof window.Code === "undefined") {
		window.Code = {}
	}
	window.Code.Util = {
		registerNamespace: function() {
			var args = arguments,
				obj = null,
				i, j, ns, nsParts, root, argsLen, nsPartsLens;
			for (i = 0, argsLen = args.length; i < argsLen; i++) {
				ns = args[i];
				nsParts = ns.split(".");
				root = nsParts[0];
				if (typeof window[root] === "undefined") {
					window[root] = {}
				}
				obj = window[root];
				for (j = 1, nsPartsLens = nsParts.length; j < nsPartsLens; ++j) {
					obj[nsParts[j]] = obj[nsParts[j]] || {};
					obj = obj[nsParts[j]]
				}
			}
		},
		coalesce: function() {
			var i, j;
			for (i = 0, j = arguments.length; i < j; i++) {
				if (!this.isNothing(arguments[i])) {
					return arguments[i]
				}
			}
			return null
		},
		extend: function(destination, source, overwriteProperties) {
			var prop;
			if (this.isNothing(overwriteProperties)) {
				overwriteProperties = true
			}
			if (destination && source && this.isObject(source)) {
				for (prop in source) {
					if (this.objectHasProperty(source, prop)) {
						if (overwriteProperties) {
							destination[prop] = source[prop]
						} else {
							if (typeof destination[prop] === "undefined") {
								destination[prop] = source[prop]
							}
						}
					}
				}
			}
		},
		clone: function(obj) {
			var retval = {};
			this.extend(retval, obj);
			return retval
		},
		isObject: function(obj) {
			return obj instanceof Object
		},
		isFunction: function(obj) {
			return ({}).toString.call(obj) === "[object Function]"
		},
		isArray: function(obj) {
			return obj instanceof Array
		},
		isLikeArray: function(obj) {
			return typeof obj.length === 'number'
		},
		isNumber: function(obj) {
			return typeof obj === "number"
		},
		isString: function(obj) {
			return typeof obj === "string"
		},
		isNothing: function(obj) {
			if (typeof obj === "undefined" || obj === null) {
				return true
			}
			return false
		},
		swapArrayElements: function(arr, i, j) {
			var temp = arr[i];
			arr[i] = arr[j];
			arr[j] = temp
		},
		trim: function(val) {
			return val.replace(/^\s\s*/, '').replace(/\s\s*$/, '')
		},
		toCamelCase: function(val) {
			return val.replace(/(\-[a-z])/g, function($1) {
				return $1.toUpperCase().replace('-', '')
			})
		},
		toDashedCase: function(val) {
			return val.replace(/([A-Z])/g, function($1) {
				return "-" + $1.toLowerCase()
			})
		},
		arrayIndexOf: function(obj, array, prop) {
			var i, j, retval, arrayItem;
			retval = -1;
			for (i = 0, j = array.length; i < j; i++) {
				arrayItem = array[i];
				if (!this.isNothing(prop)) {
					if (this.objectHasProperty(arrayItem, prop)) {
						if (arrayItem[prop] === obj) {
							retval = i;
							break
						}
					}
				} else {
					if (arrayItem === obj) {
						retval = i;
						break
					}
				}
			}
			return retval
		},
		objectHasProperty: function(obj, propName) {
			if (obj.hasOwnProperty) {
				return obj.hasOwnProperty(propName)
			} else {
				return ('undefined' !== typeof obj[propName])
			}
		}
	}
}(window));
(function(window, Util) {
	Util.Browser = {
		ua: null,
		version: null,
		safari: null,
		webkit: null,
		opera: null,
		msie: null,
		chrome: null,
		mozilla: null,
		android: null,
		blackberry: null,
		iPad: null,
		iPhone: null,
		iPod: null,
		iOS: null,
		is3dSupported: null,
		isCSSTransformSupported: null,
		isTouchSupported: null,
		isGestureSupported: null,
		_detect: function() {
			this.ua = window.navigator.userAgent;
			this.version = (this.ua.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || []);
			this.safari = (/Safari/gi).test(window.navigator.appVersion);
			this.webkit = /webkit/i.test(this.ua);
			this.opera = /opera/i.test(this.ua);
			this.msie = /msie/i.test(this.ua) && !this.opera;
			this.chrome = /Chrome/i.test(this.ua);
			this.firefox = /Firefox/i.test(this.ua);
			this.fennec = /Fennec/i.test(this.ua);
			this.mozilla = /mozilla/i.test(this.ua) && !/(compatible|webkit)/.test(this.ua);
			this.android = /android/i.test(this.ua);
			this.blackberry = /blackberry/i.test(this.ua);
			this.iOS = (/iphone|ipod|ipad/gi).test(window.navigator.platform);
			this.iPad = (/ipad/gi).test(window.navigator.platform);
			this.iPhone = (/iphone/gi).test(window.navigator.platform);
			this.iPod = (/ipod/gi).test(window.navigator.platform);
			var testEl = document.createElement('div');
			this.is3dSupported = !Util.isNothing(testEl.style.WebkitPerspective);
			this.isCSSTransformSupported = (!Util.isNothing(testEl.style.WebkitTransform) || !Util.isNothing(testEl.style.MozTransform) || !Util.isNothing(testEl.style.transformProperty));
			this.isTouchSupported = this.isEventSupported('touchstart');
			this.isGestureSupported = this.isEventSupported('gesturestart')
		},
		_eventTagNames: {
			'select': 'input',
			'change': 'input',
			'submit': 'form',
			'reset': 'form',
			'error': 'img',
			'load': 'img',
			'abort': 'img'
		},
		isEventSupported: function(eventName) {
			var el = document.createElement(this._eventTagNames[eventName] || 'div'),
				isSupported;
			eventName = 'on' + eventName;
			isSupported = Util.objectHasProperty(el, eventName);
			if (!isSupported) {
				el.setAttribute(eventName, 'return;');
				isSupported = typeof el[eventName] === 'function'
			}
			el = null;
			return isSupported
		},
		isLandscape: function() {
			return (Util.DOM.windowWidth() > Util.DOM.windowHeight())
		}
	};
	Util.Browser._detect()
}(window, window.Code.Util));
(function(window, Util) {
	Util.extend(Util, {
		Events: {
			add: function(obj, type, handler) {
				this._checkHandlersProperty(obj);
				if (type === 'mousewheel') {
					type = this._normaliseMouseWheelType()
				}
				if (typeof obj.__eventHandlers[type] === 'undefined') {
					obj.__eventHandlers[type] = []
				}
				obj.__eventHandlers[type].push(handler);
				if (this._isBrowserObject(obj)) {
					obj.addEventListener(type, handler, false)
				}
			},
			remove: function(obj, type, handler) {
				this._checkHandlersProperty(obj);
				if (type === 'mousewheel') {
					type = this._normaliseMouseWheelType()
				}
				if (obj.__eventHandlers[type] instanceof Array) {
					var i, j, handlers = obj.__eventHandlers[type];
					if (Util.isNothing(handler)) {
						if (this._isBrowserObject(obj)) {
							for (i = 0, j = handlers.length; i < j; i++) {
								obj.removeEventListener(type, handlers[i], false)
							}
						}
						obj.__eventHandlers[type] = [];
						return
					}
					for (i = 0, j = handlers.length; i < j; i++) {
						if (handlers[i] === handler) {
							handlers.splice(i, 1);
							break
						}
					}
					if (this._isBrowserObject(obj)) {
						obj.removeEventListener(type, handler, false);
						return
					}
				}
			},
			fire: function(obj, type) {
				var i, j, event, listeners, listener, args = Array.prototype.slice.call(arguments).splice(2),
					isNative;
				if (type === 'mousewheel') {
					type = this._normaliseMouseWheelType()
				}
				if (this._isBrowserObject(obj)) {
					if (typeof type !== "string") {
						throw 'type must be a string for DOM elements';
					}
					isNative = this._NATIVE_EVENTS[type];
					event = document.createEvent(isNative ? "HTMLEvents" : "UIEvents");
					event[isNative ? 'initEvent' : 'initUIEvent'](type, true, true, window, 1);
					if (args.length < 1) {
						obj.dispatchEvent(event);
						return
					}
				}
				this._checkHandlersProperty(obj);
				if (typeof type === "string") {
					event = {
						type: type
					}
				} else {
					event = type
				}
				if (!event.target) {
					event.target = obj
				}
				if (!event.type) {
					throw new Error("Event object missing 'type' property.");
				}
				if (obj.__eventHandlers[event.type] instanceof Array) {
					listeners = obj.__eventHandlers[event.type];
					args.unshift(event);
					for (i = 0, j = listeners.length; i < j; i++) {
						listener = listeners[i];
						if (!Util.isNothing(listener)) {
							listener.apply(obj, args)
						}
					}
				}
			},
			getMousePosition: function(event) {
				var retval = {
					x: 0,
					y: 0
				};
				if (event.pageX) {
					retval.x = event.pageX
				} else if (event.clientX) {
					retval.x = event.clientX + (document.documentElement.scrollLeft || document.body.scrollLeft)
				}
				if (event.pageY) {
					retval.y = event.pageY
				} else if (event.clientY) {
					retval.y = event.clientY + (document.documentElement.scrollTop || document.body.scrollTop)
				}
				return retval
			},
			getTouchEvent: function(event) {
				return event
			},
			getWheelDelta: function(event) {
				var delta = 0;
				if (!Util.isNothing(event.wheelDelta)) {
					delta = event.wheelDelta / 120
				} else if (!Util.isNothing(event.detail)) {
					delta = -event.detail / 3
				}
				return delta
			},
			domReady: function(handler) {
				document.addEventListener('DOMContentLoaded', handler, false)
			},
			_checkHandlersProperty: function(obj) {
				if (Util.isNothing(obj.__eventHandlers)) {
					Util.extend(obj, {
						__eventHandlers: {}
					})
				}
			},
			_isBrowserObject: function(obj) {
				if (obj === window || obj === window.document) {
					return true
				}
				return this._isElement(obj) || this._isNode(obj)
			},
			_isElement: function(obj) {
				return (typeof window.HTMLElement === "object" ? obj instanceof window.HTMLElement : typeof obj === "object" && obj.nodeType === 1 && typeof obj.nodeName === "string")
			},
			_isNode: function(obj) {
				return (typeof window.Node === "object" ? obj instanceof window.Node : typeof obj === "object" && typeof obj.nodeType === "number" && typeof obj.nodeName === "string")
			},
			_normaliseMouseWheelType: function() {
				if (Util.Browser.isEventSupported('mousewheel')) {
					return 'mousewheel'
				}
				return 'DOMMouseScroll'
			},
			_NATIVE_EVENTS: {
				click: 1,
				dblclick: 1,
				mouseup: 1,
				mousedown: 1,
				contextmenu: 1,
				mousewheel: 1,
				DOMMouseScroll: 1,
				mouseover: 1,
				mouseout: 1,
				mousemove: 1,
				selectstart: 1,
				selectend: 1,
				keydown: 1,
				keypress: 1,
				keyup: 1,
				orientationchange: 1,
				touchstart: 1,
				touchmove: 1,
				touchend: 1,
				touchcancel: 1,
				gesturestart: 1,
				gesturechange: 1,
				gestureend: 1,
				focus: 1,
				blur: 1,
				change: 1,
				reset: 1,
				select: 1,
				submit: 1,
				load: 1,
				unload: 1,
				beforeunload: 1,
				resize: 1,
				move: 1,
				DOMContentLoaded: 1,
				readystatechange: 1,
				error: 1,
				abort: 1,
				scroll: 1
			}
		}
	})
}(window, window.Code.Util));
(function(window, Util) {
	Util.extend(Util, {
		DOM: {
			setData: function(el, key, value) {
				if (Util.isLikeArray(el)) {
					var i, len;
					for (i = 0, len = el.length; i < len; i++) {
						Util.DOM._setData(el[i], key, value)
					}
				} else {
					Util.DOM._setData(el, key, value)
				}
			},
			_setData: function(el, key, value) {
				Util.DOM.setAttribute(el, 'data-' + key, value)
			},
			getData: function(el, key, defaultValue) {
				return Util.DOM.getAttribute(el, 'data-' + key, defaultValue)
			},
			removeData: function(el, key) {
				if (Util.isLikeArray(el)) {
					var i, len;
					for (i = 0, len = el.length; i < len; i++) {
						Util.DOM._removeData(el[i], key)
					}
				} else {
					Util.DOM._removeData(el, key)
				}
			},
			_removeData: function(el, key) {
				Util.DOM.removeAttribute(el, 'data-' + key)
			},
			isChildOf: function(childEl, parentEl) {
				if (parentEl === childEl) {
					return false
				}
				while (childEl && childEl !== parentEl) {
					childEl = childEl.parentNode
				}
				return childEl === parentEl
			},
			find: function(selectors, contextEl) {
				if (Util.isNothing(contextEl)) {
					contextEl = window.document
				}
				var els = contextEl.querySelectorAll(selectors),
					retval = [],
					i, j;
				for (i = 0, j = els.length; i < j; i++) {
					retval.push(els[i])
				}
				return retval
			},
			createElement: function(type, attributes, content) {
				var attribute, retval = document.createElement(type);
				for (attribute in attributes) {
					if (Util.objectHasProperty(attributes, attribute)) {
						retval.setAttribute(attribute, attributes[attribute])
					}
				}
				retval.innerHTML = content || '';
				return retval
			},
			appendChild: function(childEl, parentEl) {
				parentEl.appendChild(childEl)
			},
			insertBefore: function(newEl, refEl, parentEl) {
				parentEl.insertBefore(newEl, refEl)
			},
			appendText: function(text, parentEl) {
				Util.DOM.appendChild(document.createTextNode(text), parentEl)
			},
			appendToBody: function(childEl) {
				this.appendChild(childEl, document.body)
			},
			removeChild: function(childEl, parentEl) {
				parentEl.removeChild(childEl)
			},
			removeChildren: function(parentEl) {
				if (parentEl.hasChildNodes()) {
					while (parentEl.childNodes.length >= 1) {
						parentEl.removeChild(parentEl.childNodes[parentEl.childNodes.length - 1])
					}
				}
			},
			hasAttribute: function(el, attributeName) {
				return !Util.isNothing(el.getAttribute(attributeName))
			},
			getAttribute: function(el, attributeName, defaultValue) {
				var retval = el.getAttribute(attributeName);
				if (Util.isNothing(retval) && !Util.isNothing(defaultValue)) {
					retval = defaultValue
				}
				return retval
			},
			setAttribute: function(el, attributeName, value) {
				if (Util.isLikeArray(el)) {
					var i, len;
					for (i = 0, len = el.length; i < len; i++) {
						Util.DOM._setAttribute(el[i], attributeName, value)
					}
				} else {
					Util.DOM._setAttribute(el, attributeName, value)
				}
			},
			_setAttribute: function(el, attributeName, value) {
				el.setAttribute(attributeName, value)
			},
			removeAttribute: function(el, attributeName) {
				if (Util.isLikeArray(el)) {
					var i, len;
					for (i = 0, len = el.length; i < len; i++) {
						Util.DOM._removeAttribute(el[i], attributeName)
					}
				} else {
					Util.DOM._removeAttribute(el, attributeName)
				}
			},
			_removeAttribute: function(el, attributeName) {
				if (this.hasAttribute(el, attributeName)) {
					el.removeAttribute(attributeName)
				}
			},
			addClass: function(el, className) {
				if (Util.isLikeArray(el)) {
					var i, len;
					for (i = 0, len = el.length; i < len; i++) {
						Util.DOM._addClass(el[i], className)
					}
				} else {
					Util.DOM._addClass(el, className)
				}
			},
			_addClass: function(el, className) {
				var currentClassValue = Util.DOM.getAttribute(el, 'class', ''),
					re = new RegExp('(?:^|\\s+)' + className + '(?:\\s+|$)');
				if (!re.test(currentClassValue)) {
					if (currentClassValue !== '') {
						currentClassValue = currentClassValue + ' '
					}
					currentClassValue = currentClassValue + className;
					Util.DOM.setAttribute(el, 'class', currentClassValue)
				}
			},
			removeClass: function(el, className) {
				if (Util.isLikeArray(el)) {
					var i, len;
					for (i = 0, len = el.length; i < len; i++) {
						Util.DOM._removeClass(el[i], className)
					}
				} else {
					Util.DOM._removeClass(el, className)
				}
			},
			_removeClass: function(el, className) {
				var currentClassValue = Util.DOM.getAttribute(el, 'class', ''),
					classes = Util.trim(currentClassValue).split(' '),
					newClassVal = '',
					i, j;
				for (i = 0, j = classes.length; i < j; i++) {
					if (classes[i] !== className) {
						if (newClassVal !== '') {
							newClassVal += ' '
						}
						newClassVal += classes[i]
					}
				}
				if (newClassVal === '') {
					Util.DOM.removeAttribute(el, 'class')
				} else {
					Util.DOM.setAttribute(el, 'class', newClassVal)
				}
			},
			hasClass: function(el, className) {
				var re = new RegExp('(?:^|\\s+)' + className + '(?:\\s+|$)');
				return re.test(Util.DOM.getAttribute(el, 'class', ''))
			},
			setStyle: function(el, style, value) {
				if (Util.isLikeArray(el)) {
					var i, len;
					for (i = 0, len = el.length; i < len; i++) {
						Util.DOM._setStyle(el[i], style, value)
					}
				} else {
					Util.DOM._setStyle(el, style, value)
				}
			},
			_setStyle: function(el, style, value) {
				var prop, val;
				if (Util.isObject(style)) {
					for (prop in style) {
						if (Util.objectHasProperty(style, prop)) {
							if (prop === 'width') {
								Util.DOM.width(el, style[prop])
							} else if (prop === 'height') {
								Util.DOM.height(el, style[prop])
							} else {
								el.style[prop] = style[prop]
							}
						}
					}
				} else {
					el.style[style] = value
				}
			},
			getStyle: function(el, styleName) {
				var retval = window.getComputedStyle(el, '').getPropertyValue(styleName);
				if (retval === '') {
					retval = el.style[styleName]
				}
				return retval
			},
			hide: function(el) {
				if (Util.isLikeArray(el)) {
					var i, len;
					for (i = 0, len = el.length; i < len; i++) {
						Util.DOM._hide(el[i])
					}
				} else {
					Util.DOM._hide(el)
				}
			},
			_hide: function(el) {
				Util.DOM.setData(el, 'ccl-disp', Util.DOM.getStyle(el, 'display'));
				Util.DOM.setStyle(el, 'display', 'none')
			},
			show: function(el) {
				if (Util.isLikeArray(el)) {
					var i, len;
					for (i = 0, len = el.length; i < len; i++) {
						Util.DOM._show(el[i])
					}
				} else {
					Util.DOM._show(el)
				}
			},
			_show: function(el) {
				if (Util.DOM.getStyle(el, 'display') === 'none') {
					var oldDisplayValue = Util.DOM.getData(el, 'ccl-disp', 'block');
					if (oldDisplayValue === 'none' || oldDisplayValue === '') {
						oldDisplayValue = 'block'
					}
					Util.DOM.setStyle(el, 'display', oldDisplayValue)
				}
			},
			width: function(el, value) {
				if (!Util.isNothing(value)) {
					if (Util.isNumber(value)) {
						value = value + 'px'
					}
					el.style.width = value
				}
				return this._getDimension(el, 'width')
			},
			outerWidth: function(el) {
				var retval = Util.DOM.width(el);
				retval += parseInt(Util.DOM.getStyle(el, 'padding-left'), 10) + parseInt(Util.DOM.getStyle(el, 'padding-right'), 10);
				retval += parseInt(Util.DOM.getStyle(el, 'margin-left'), 10) + parseInt(Util.DOM.getStyle(el, 'margin-right'), 10);
				retval += parseInt(Util.DOM.getStyle(el, 'border-left-width'), 10) + parseInt(Util.DOM.getStyle(el, 'border-right-width'), 10);
				return retval
			},
			height: function(el, value) {
				if (!Util.isNothing(value)) {
					if (Util.isNumber(value)) {
						value = value + 'px'
					}
					el.style.height = value
				}
				return this._getDimension(el, 'height')
			},
			_getDimension: function(el, dimension) {
				var retval = window.parseInt(window.getComputedStyle(el, '').getPropertyValue(dimension)),
					styleBackup;
				if (isNaN(retval)) {
					styleBackup = {
						display: el.style.display,
						left: el.style.left
					};
					el.style.display = 'block';
					el.style.left = '-1000000px';
					retval = window.parseInt(window.getComputedStyle(el, '').getPropertyValue(dimension));
					el.style.display = styleBackup.display;
					el.style.left = styleBackup.left
				}
				return retval
			},
			outerHeight: function(el) {
				var retval = Util.DOM.height(el);
				retval += parseInt(Util.DOM.getStyle(el, 'padding-top'), 10) + parseInt(Util.DOM.getStyle(el, 'padding-bottom'), 10);
				retval += parseInt(Util.DOM.getStyle(el, 'margin-top'), 10) + parseInt(Util.DOM.getStyle(el, 'margin-bottom'), 10);
				retval += parseInt(Util.DOM.getStyle(el, 'border-top-width'), 10) + parseInt(Util.DOM.getStyle(el, 'border-bottom-width'), 10);
				return retval
			},
			documentWidth: function() {
				return Util.DOM.width(document.documentElement)
			},
			documentHeight: function() {
				return Util.DOM.height(document.documentElement)
			},
			documentOuterWidth: function() {
				return Util.DOM.width(document.documentElement)
			},
			documentOuterHeight: function() {
				return Util.DOM.outerHeight(document.documentElement)
			},
			bodyWidth: function() {
				return Util.DOM.width(document.body)
			},
			bodyHeight: function() {
				return Util.DOM.height(document.body)
			},
			bodyOuterWidth: function() {
				return Util.DOM.outerWidth(document.body)
			},
			bodyOuterHeight: function() {
				return Util.DOM.outerHeight(document.body)
			},
			windowWidth: function() {
				return window.innerWidth
			},
			windowHeight: function() {
				return window.innerHeight
			},
			windowScrollLeft: function() {
				return window.pageXOffset
			},
			windowScrollTop: function() {
				return window.pageYOffset
			}
		}
	})
}(window, window.Code.Util));
(function(window, Util) {
	Util.extend(Util, {
		Animation: {
			_applyTransitionDelay: 50,
			_transitionEndLabel: (window.document.documentElement.style.webkitTransition !== undefined) ? "webkitTransitionEnd" : "transitionend",
			_transitionEndHandler: null,
			_transitionPrefix: (window.document.documentElement.style.webkitTransition !== undefined) ? "webkitTransition" : (window.document.documentElement.style.MozTransition !== undefined) ? "MozTransition" : "transition",
			_transformLabel: (window.document.documentElement.style.webkitTransform !== undefined) ? "webkitTransform" : (window.document.documentElement.style.MozTransition !== undefined) ? "MozTransform" : "transform",
			_getTransitionEndHandler: function() {
				if (Util.isNothing(this._transitionEndHandler)) {
					this._transitionEndHandler = this._onTransitionEnd.bind(this)
				}
				return this._transitionEndHandler
			},
			stop: function(el) {
				if (Util.Browser.isCSSTransformSupported) {
					var property = el.style[this._transitionPrefix + 'Property'],
						callbackLabel = (property !== '') ? 'ccl' + property + 'callback' : 'cclallcallback',
						style = {};
					Util.Events.remove(el, this._transitionEndLabel, this._getTransitionEndHandler());
					if (Util.isNothing(el.callbackLabel)) {
						delete el.callbackLabel
					}
					style[this._transitionPrefix + 'Property'] = '';
					style[this._transitionPrefix + 'Duration'] = '';
					style[this._transitionPrefix + 'TimingFunction'] = '';
					style[this._transitionPrefix + 'Delay'] = '';
					style[this._transformLabel] = '';
					Util.DOM.setStyle(el, style)
				} else if (!Util.isNothing(window.jQuery)) {
					window.jQuery(el).stop(true, true)
				}
			},
			fadeIn: function(el, speed, callback, timingFunction, opacity) {
				opacity = Util.coalesce(opacity, 1);
				if (opacity <= 0) {
					opacity = 1
				}
				if (speed <= 0) {
					Util.DOM.setStyle(el, 'opacity', opacity);
					if (!Util.isNothing(callback)) {
						callback(el);
						return
					}
				}
				var currentOpacity = Util.DOM.getStyle(el, 'opacity');
				if (currentOpacity >= 1) {
					Util.DOM.setStyle(el, 'opacity', 0)
				}
				if (Util.Browser.isCSSTransformSupported) {
					this._applyTransition(el, 'opacity', opacity, speed, callback, timingFunction)
				} else if (!Util.isNothing(window.jQuery)) {
					window.jQuery(el).fadeTo(speed, opacity, callback)
				}
			},
			fadeTo: function(el, opacity, speed, callback, timingFunction) {
				this.fadeIn(el, speed, callback, timingFunction, opacity)
			},
			fadeOut: function(el, speed, callback, timingFunction) {
				if (speed <= 0) {
					Util.DOM.setStyle(el, 'opacity', 0);
					if (!Util.isNothing(callback)) {
						callback(el);
						return
					}
				}
				if (Util.Browser.isCSSTransformSupported) {
					this._applyTransition(el, 'opacity', 0, speed, callback, timingFunction)
				} else {
					window.jQuery(el).fadeTo(speed, 0, callback)
				}
			},
			slideBy: function(el, x, y, speed, callback, timingFunction) {
				var style = {};
				x = Util.coalesce(x, 0);
				y = Util.coalesce(y, 0);
				timingFunction = Util.coalesce(timingFunction, 'ease-out');
				style[this._transitionPrefix + 'Property'] = 'all';
				style[this._transitionPrefix + 'Delay'] = '0';
				if (speed === 0) {
					style[this._transitionPrefix + 'Duration'] = '';
					style[this._transitionPrefix + 'TimingFunction'] = ''
				} else {
					style[this._transitionPrefix + 'Duration'] = speed + 'ms';
					style[this._transitionPrefix + 'TimingFunction'] = Util.coalesce(timingFunction, 'ease-out');
					Util.Events.add(el, this._transitionEndLabel, this._getTransitionEndHandler())
				}
				style[this._transformLabel] = (Util.Browser.is3dSupported) ? 'translate3d(' + x + 'px, ' + y + 'px, 0px)' : 'translate(' + x + 'px, ' + y + 'px)';
				if (!Util.isNothing(callback)) {
					el.cclallcallback = callback
				}
				Util.DOM.setStyle(el, style);
				if (speed === 0) {
					window.setTimeout(function() {
						this._leaveTransforms(el)
					}.bind(this), this._applyTransitionDelay)
				}
			},
			resetTranslate: function(el) {
				var style = {};
				style[this._transformLabel] = style[this._transformLabel] = (Util.Browser.is3dSupported) ? 'translate3d(0px, 0px, 0px)' : 'translate(0px, 0px)';
				Util.DOM.setStyle(el, style)
			},
			_applyTransition: function(el, property, val, speed, callback, timingFunction) {
				var style = {};
				timingFunction = Util.coalesce(timingFunction, 'ease-in');
				style[this._transitionPrefix + 'Property'] = property;
				style[this._transitionPrefix + 'Duration'] = speed + 'ms';
				style[this._transitionPrefix + 'TimingFunction'] = timingFunction;
				style[this._transitionPrefix + 'Delay'] = '0';
				Util.Events.add(el, this._transitionEndLabel, this._getTransitionEndHandler());
				Util.DOM.setStyle(el, style);
				if (!Util.isNothing(callback)) {
					el['ccl' + property + 'callback'] = callback
				}
				window.setTimeout(function() {
					Util.DOM.setStyle(el, property, val)
				}, this._applyTransitionDelay)
			},
			_onTransitionEnd: function(e) {
				Util.Events.remove(e.currentTarget, this._transitionEndLabel, this._getTransitionEndHandler());
				this._leaveTransforms(e.currentTarget)
			},
			_leaveTransforms: function(el) {
				var property = el.style[this._transitionPrefix + 'Property'],
					callbackLabel = (property !== '') ? 'ccl' + property + 'callback' : 'cclallcallback',
					callback, transform = Util.coalesce(el.style.webkitTransform, el.style.MozTransform, el.style.transform),
					transformMatch, transformExploded, domX = window.parseInt(Util.DOM.getStyle(el, 'left'), 0),
					domY = window.parseInt(Util.DOM.getStyle(el, 'top'), 0),
					transformedX, transformedY, style = {};
				if (transform !== '') {
					if (Util.Browser.is3dSupported) {
						transformMatch = transform.match(/translate3d\((.*?)\)/)
					} else {
						transformMatch = transform.match(/translate\((.*?)\)/)
					}
					if (!Util.isNothing(transformMatch)) {
						transformExploded = transformMatch[1].split(', ');
						transformedX = window.parseInt(transformExploded[0], 0);
						transformedY = window.parseInt(transformExploded[1], 0)
					}
				}
				style[this._transitionPrefix + 'Property'] = '';
				style[this._transitionPrefix + 'Duration'] = '';
				style[this._transitionPrefix + 'TimingFunction'] = '';
				style[this._transitionPrefix + 'Delay'] = '';
				Util.DOM.setStyle(el, style);
				window.setTimeout(function() {
					if (!Util.isNothing(transformExploded)) {
						style = {};
						style[this._transformLabel] = '';
						style.left = (domX + transformedX) + 'px';
						style.top = (domY + transformedY) + 'px';
						Util.DOM.setStyle(el, style)
					}
					if (!Util.isNothing(el[callbackLabel])) {
						callback = el[callbackLabel];
						delete el[callbackLabel];
						callback(el)
					}
				}.bind(this), this._applyTransitionDelay)
			}
		}
	})
}(window, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.Util.TouchElement');
	Util.TouchElement.EventTypes = {
		onTouch: 'CodeUtilTouchElementOnTouch'
	};
	Util.TouchElement.ActionTypes = {
		touchStart: 'touchStart',
		touchMove: 'touchMove',
		touchEnd: 'touchEnd',
		touchMoveEnd: 'touchMoveEnd',
		tap: 'tap',
		doubleTap: 'doubleTap',
		swipeLeft: 'swipeLeft',
		swipeRight: 'swipeRight',
		swipeUp: 'swipeUp',
		swipeDown: 'swipeDown',
		gestureStart: 'gestureStart',
		gestureChange: 'gestureChange',
		gestureEnd: 'gestureEnd'
	}
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.Util.TouchElement');
	Util.TouchElement.TouchElementClass = klass({
		el: null,
		captureSettings: null,
		touchStartPoint: null,
		touchEndPoint: null,
		touchStartTime: null,
		doubleTapTimeout: null,
		touchStartHandler: null,
		touchMoveHandler: null,
		touchEndHandler: null,
		mouseDownHandler: null,
		mouseMoveHandler: null,
		mouseUpHandler: null,
		mouseOutHandler: null,
		gestureStartHandler: null,
		gestureChangeHandler: null,
		gestureEndHandler: null,
		swipeThreshold: null,
		swipeTimeThreshold: null,
		doubleTapSpeed: null,
		dispose: function() {
			var prop;
			this.removeEventHandlers();
			for (prop in this) {
				if (Util.objectHasProperty(this, prop)) {
					this[prop] = null
				}
			}
		},
		initialize: function(el, captureSettings) {
			this.el = el;
			this.captureSettings = {
				swipe: false,
				move: false,
				gesture: false,
				doubleTap: false,
				preventDefaultTouchEvents: true
			};
			Util.extend(this.captureSettings, captureSettings);
			this.swipeThreshold = 50;
			this.swipeTimeThreshold = 250;
			this.doubleTapSpeed = 250;
			this.touchStartPoint = {
				x: 0,
				y: 0
			};
			this.touchEndPoint = {
				x: 0,
				y: 0
			}
		},
		addEventHandlers: function() {
			if (Util.isNothing(this.touchStartHandler)) {
				this.touchStartHandler = this.onTouchStart.bind(this);
				this.touchMoveHandler = this.onTouchMove.bind(this);
				this.touchEndHandler = this.onTouchEnd.bind(this);
				this.mouseDownHandler = this.onMouseDown.bind(this);
				this.mouseMoveHandler = this.onMouseMove.bind(this);
				this.mouseUpHandler = this.onMouseUp.bind(this);
				this.mouseOutHandler = this.onMouseOut.bind(this);
				this.gestureStartHandler = this.onGestureStart.bind(this);
				this.gestureChangeHandler = this.onGestureChange.bind(this);
				this.gestureEndHandler = this.onGestureEnd.bind(this)
			}
			Util.Events.add(this.el, 'touchstart', this.touchStartHandler);
			if (this.captureSettings.move) {
				Util.Events.add(this.el, 'touchmove', this.touchMoveHandler)
			}
			Util.Events.add(this.el, 'touchend', this.touchEndHandler);
			Util.Events.add(this.el, 'mousedown', this.mouseDownHandler);
			if (Util.Browser.isGestureSupported && this.captureSettings.gesture) {
				Util.Events.add(this.el, 'gesturestart', this.gestureStartHandler);
				Util.Events.add(this.el, 'gesturechange', this.gestureChangeHandler);
				Util.Events.add(this.el, 'gestureend', this.gestureEndHandler)
			}
		},
		removeEventHandlers: function() {
			Util.Events.remove(this.el, 'touchstart', this.touchStartHandler);
			if (this.captureSettings.move) {
				Util.Events.remove(this.el, 'touchmove', this.touchMoveHandler)
			}
			Util.Events.remove(this.el, 'touchend', this.touchEndHandler);
			Util.Events.remove(this.el, 'mousedown', this.mouseDownHandler);
			if (Util.Browser.isGestureSupported && this.captureSettings.gesture) {
				Util.Events.remove(this.el, 'gesturestart', this.gestureStartHandler);
				Util.Events.remove(this.el, 'gesturechange', this.gestureChangeHandler);
				Util.Events.remove(this.el, 'gestureend', this.gestureEndHandler)
			}
		},
		getTouchPoint: function(touches) {
			return {
				x: touches[0].pageX,
				y: touches[0].pageY
			}
		},
		fireTouchEvent: function(e) {
			var action, distX = 0,
				distY = 0,
				dist = 0,
				self, endTime, diffTime;
			distX = this.touchEndPoint.x - this.touchStartPoint.x;
			distY = this.touchEndPoint.y - this.touchStartPoint.y;
			dist = Math.sqrt((distX * distX) + (distY * distY));
			if (this.captureSettings.swipe) {
				endTime = new Date();
				diffTime = endTime - this.touchStartTime;
				if (diffTime <= this.swipeTimeThreshold) {
					if (window.Math.abs(distX) >= this.swipeThreshold) {
						Util.Events.fire(this, {
							type: Util.TouchElement.EventTypes.onTouch,
							target: this,
							point: this.touchEndPoint,
							action: (distX < 0) ? Util.TouchElement.ActionTypes.swipeLeft : Util.TouchElement.ActionTypes.swipeRight,
							targetEl: e.target,
							currentTargetEl: e.currentTarget
						});
						return
					}
					if (window.Math.abs(distY) >= this.swipeThreshold) {
						Util.Events.fire(this, {
							type: Util.TouchElement.EventTypes.onTouch,
							target: this,
							point: this.touchEndPoint,
							action: (distY < 0) ? Util.TouchElement.ActionTypes.swipeUp : Util.TouchElement.ActionTypes.swipeDown,
							targetEl: e.target,
							currentTargetEl: e.currentTarget
						});
						return
					}
				}
			}
			if (dist > 1) {
				Util.Events.fire(this, {
					type: Util.TouchElement.EventTypes.onTouch,
					target: this,
					action: Util.TouchElement.ActionTypes.touchMoveEnd,
					point: this.touchEndPoint,
					targetEl: e.target,
					currentTargetEl: e.currentTarget
				});
				return
			}
			if (!this.captureSettings.doubleTap) {
				Util.Events.fire(this, {
					type: Util.TouchElement.EventTypes.onTouch,
					target: this,
					point: this.touchEndPoint,
					action: Util.TouchElement.ActionTypes.tap,
					targetEl: e.target,
					currentTargetEl: e.currentTarget
				});
				return
			}
			if (Util.isNothing(this.doubleTapTimeout)) {
				this.doubleTapTimeout = window.setTimeout(function() {
					this.doubleTapTimeout = null;
					Util.Events.fire(this, {
						type: Util.TouchElement.EventTypes.onTouch,
						target: this,
						point: this.touchEndPoint,
						action: Util.TouchElement.ActionTypes.tap,
						targetEl: e.target,
						currentTargetEl: e.currentTarget
					})
				}.bind(this), this.doubleTapSpeed);
				return
			} else {
				window.clearTimeout(this.doubleTapTimeout);
				this.doubleTapTimeout = null;
				Util.Events.fire(this, {
					type: Util.TouchElement.EventTypes.onTouch,
					target: this,
					point: this.touchEndPoint,
					action: Util.TouchElement.ActionTypes.doubleTap,
					targetEl: e.target,
					currentTargetEl: e.currentTarget
				})
			}
		},
		onTouchStart: function(e) {
			if (this.captureSettings.preventDefaultTouchEvents) {
				e.preventDefault()
			}
			Util.Events.remove(this.el, 'mousedown', this.mouseDownHandler);
			var touchEvent = Util.Events.getTouchEvent(e),
				touches = touchEvent.touches;
			if (touches.length > 1 && this.captureSettings.gesture) {
				this.isGesture = true;
				return
			}
			this.touchStartTime = new Date();
			this.isGesture = false;
			this.touchStartPoint = this.getTouchPoint(touches);
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.touchStart,
				point: this.touchStartPoint,
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			})
		},
		onTouchMove: function(e) {
			if (this.captureSettings.preventDefaultTouchEvents) {
				e.preventDefault()
			}
			if (this.isGesture && this.captureSettings.gesture) {
				return
			}
			var touchEvent = Util.Events.getTouchEvent(e),
				touches = touchEvent.touches;
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.touchMove,
				point: this.getTouchPoint(touches),
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			})
		},
		onTouchEnd: function(e) {
			if (this.isGesture && this.captureSettings.gesture) {
				return
			}
			if (this.captureSettings.preventDefaultTouchEvents) {
				e.preventDefault()
			}
			var touchEvent = Util.Events.getTouchEvent(e),
				touches = (!Util.isNothing(touchEvent.changedTouches)) ? touchEvent.changedTouches : touchEvent.touches;
			this.touchEndPoint = this.getTouchPoint(touches);
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.touchEnd,
				point: this.touchEndPoint,
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			});
			this.fireTouchEvent(e)
		},
		onMouseDown: function(e) {
			e.preventDefault();
			Util.Events.remove(this.el, 'touchstart', this.mouseDownHandler);
			Util.Events.remove(this.el, 'touchmove', this.touchMoveHandler);
			Util.Events.remove(this.el, 'touchend', this.touchEndHandler);
			if (this.captureSettings.move) {
				Util.Events.add(this.el, 'mousemove', this.mouseMoveHandler)
			}
			Util.Events.add(this.el, 'mouseup', this.mouseUpHandler);
			Util.Events.add(this.el, 'mouseout', this.mouseOutHandler);
			this.touchStartTime = new Date();
			this.isGesture = false;
			this.touchStartPoint = Util.Events.getMousePosition(e);
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.touchStart,
				point: this.touchStartPoint,
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			})
		},
		onMouseMove: function(e) {
			e.preventDefault();
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.touchMove,
				point: Util.Events.getMousePosition(e),
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			})
		},
		onMouseUp: function(e) {
			e.preventDefault();
			if (this.captureSettings.move) {
				Util.Events.remove(this.el, 'mousemove', this.mouseMoveHandler)
			}
			Util.Events.remove(this.el, 'mouseup', this.mouseUpHandler);
			Util.Events.remove(this.el, 'mouseout', this.mouseOutHandler);
			this.touchEndPoint = Util.Events.getMousePosition(e);
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.touchEnd,
				point: this.touchEndPoint,
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			});
			this.fireTouchEvent(e)
		},
		onMouseOut: function(e) {
			var relTarget = e.relatedTarget;
			if (this.el === relTarget || Util.DOM.isChildOf(relTarget, this.el)) {
				return
			}
			e.preventDefault();
			if (this.captureSettings.move) {
				Util.Events.remove(this.el, 'mousemove', this.mouseMoveHandler)
			}
			Util.Events.remove(this.el, 'mouseup', this.mouseUpHandler);
			Util.Events.remove(this.el, 'mouseout', this.mouseOutHandler);
			this.touchEndPoint = Util.Events.getMousePosition(e);
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.touchEnd,
				point: this.touchEndPoint,
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			});
			this.fireTouchEvent(e)
		},
		onGestureStart: function(e) {
			e.preventDefault();
			var touchEvent = Util.Events.getTouchEvent(e);
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.gestureStart,
				scale: touchEvent.scale,
				rotation: touchEvent.rotation,
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			})
		},
		onGestureChange: function(e) {
			e.preventDefault();
			var touchEvent = Util.Events.getTouchEvent(e);
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.gestureChange,
				scale: touchEvent.scale,
				rotation: touchEvent.rotation,
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			})
		},
		onGestureEnd: function(e) {
			e.preventDefault();
			var touchEvent = Util.Events.getTouchEvent(e);
			Util.Events.fire(this, {
				type: Util.TouchElement.EventTypes.onTouch,
				target: this,
				action: Util.TouchElement.ActionTypes.gestureEnd,
				scale: touchEvent.scale,
				rotation: touchEvent.rotation,
				targetEl: e.target,
				currentTargetEl: e.currentTarget
			})
		}
	})
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.Image');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.Image.EventTypes = {
		onLoad: 'onLoad',
		onError: 'onError'
	}
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.Image');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.Image.ImageClass = klass({
		refObj: null,
		imageEl: null,
		src: null,
		caption: null,
		metaData: null,
		imageLoadHandler: null,
		imageErrorHandler: null,
		dispose: function() {
			var prop, i;
			this.shrinkImage();
			for (prop in this) {
				if (Util.objectHasProperty(this, prop)) {
					this[prop] = null
				}
			}
		},
		initialize: function(refObj, src, caption, metaData) {
			this.refObj = refObj;
			this.originalSrc = src;
			this.src = src;
			this.caption = caption;
			this.metaData = metaData;
			this.imageEl = new window.Image();
			this.imageLoadHandler = this.onImageLoad.bind(this);
			this.imageErrorHandler = this.onImageError.bind(this)
		},
		load: function() {
			this.imageEl.originalSrc = Util.coalesce(this.imageEl.originalSrc, '');
			if (this.imageEl.originalSrc === this.src) {
				if (this.imageEl.isError) {
					Util.Events.fire(this, {
						type: PhotoSwipe.Image.EventTypes.onError,
						target: this
					})
				} else {
					Util.Events.fire(this, {
						type: PhotoSwipe.Image.EventTypes.onLoad,
						target: this
					})
				}
				return
			}
			this.imageEl.isError = false;
			this.imageEl.isLoading = true;
			this.imageEl.naturalWidth = null;
			this.imageEl.naturalHeight = null;
			this.imageEl.isLandscape = false;
			this.imageEl.onload = this.imageLoadHandler;
			this.imageEl.onerror = this.imageErrorHandler;
			this.imageEl.onabort = this.imageErrorHandler;
			this.imageEl.originalSrc = this.src;
			this.imageEl.src = this.src
		},
		shrinkImage: function() {
			if (Util.isNothing(this.imageEl)) {
				return
			}
			if (this.imageEl.src.indexOf(this.src) > -1) {
				this.imageEl.src = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';
				if (!Util.isNothing(this.imageEl.parentNode)) {
					Util.DOM.removeChild(this.imageEl, this.imageEl.parentNode)
				}
			}
		},
		onImageLoad: function(e) {
			this.imageEl.onload = null;
			this.imageEl.naturalWidth = Util.coalesce(this.imageEl.naturalWidth, this.imageEl.width);
			this.imageEl.naturalHeight = Util.coalesce(this.imageEl.naturalHeight, this.imageEl.height);
			this.imageEl.isLandscape = (this.imageEl.naturalWidth > this.imageEl.naturalHeight);
			this.imageEl.isLoading = false;
			Util.Events.fire(this, {
				type: PhotoSwipe.Image.EventTypes.onLoad,
				target: this
			})
		},
		onImageError: function(e) {
			this.imageEl.onload = null;
			this.imageEl.onerror = null;
			this.imageEl.onabort = null;
			this.imageEl.isLoading = false;
			this.imageEl.isError = true;
			Util.Events.fire(this, {
				type: PhotoSwipe.Image.EventTypes.onError,
				target: this
			})
		}
	})
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.Cache');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.Cache.Mode = {
		normal: 'normal',
		aggressive: 'aggressive'
	};
	PhotoSwipe.Cache.Functions = {
		getImageSource: function(el) {
			return el.href
		},
		getImageCaption: function(el) {
			if (el.nodeName === "IMG") {
				return Util.DOM.getAttribute(el, 'alt')
			}
			var i, j, childEl;
			for (i = 0, j = el.childNodes.length; i < j; i++) {
				childEl = el.childNodes[i];
				if (el.childNodes[i].nodeName === 'IMG') {
					return Util.DOM.getAttribute(childEl, 'alt')
				}
			}
		},
		getImageMetaData: function(el) {
			return {}
		}
	}
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.Cache');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.Cache.CacheClass = klass({
		images: null,
		settings: null,
		dispose: function() {
			var prop, i, j;
			if (!Util.isNothing(this.images)) {
				for (i = 0, j = this.images.length; i < j; i++) {
					this.images[i].dispose()
				}
				this.images.length = 0
			}
			for (prop in this) {
				if (Util.objectHasProperty(this, prop)) {
					this[prop] = null
				}
			}
		},
		initialize: function(images, options) {
			var i, j, cacheImage, image, src, caption, metaData;
			this.settings = options;
			this.images = [];
			for (i = 0, j = images.length; i < j; i++) {
				image = images[i];
				src = this.settings.getImageSource(image);
				caption = this.settings.getImageCaption(image);
				metaData = this.settings.getImageMetaData(image);
				this.images.push(new PhotoSwipe.Image.ImageClass(image, src, caption, metaData))
			}
		},
		getImages: function(indexes) {
			var i, j, retval = [],
				cacheImage;
			for (i = 0, j = indexes.length; i < j; i++) {
				cacheImage = this.images[indexes[i]];
				if (this.settings.cacheMode === PhotoSwipe.Cache.Mode.aggressive) {
					cacheImage.cacheDoNotShrink = true
				}
				retval.push(cacheImage)
			}
			if (this.settings.cacheMode === PhotoSwipe.Cache.Mode.aggressive) {
				for (i = 0, j = this.images.length; i < j; i++) {
					cacheImage = this.images[i];
					if (!Util.objectHasProperty(cacheImage, 'cacheDoNotShrink')) {
						cacheImage.shrinkImage()
					} else {
						delete cacheImage.cacheDoNotShrink
					}
				}
			}
			return retval
		}
	})
}(window, window.klass, window.Code.Util, window.Code.PhotoSwipe.Image));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.DocumentOverlay');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.DocumentOverlay.CssClasses = {
		documentOverlay: 'ps-document-overlay'
	}
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.DocumentOverlay');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.DocumentOverlay.DocumentOverlayClass = klass({
		el: null,
		settings: null,
		initialBodyHeight: null,
		dispose: function() {
			var prop;
			Util.Animation.stop(this.el);
			Util.DOM.removeChild(this.el, this.el.parentNode);
			for (prop in this) {
				if (Util.objectHasProperty(this, prop)) {
					this[prop] = null
				}
			}
		},
		initialize: function(options) {
			this.settings = options;
			this.el = Util.DOM.createElement('div', {
				'class': PhotoSwipe.DocumentOverlay.CssClasses.documentOverlay
			}, '');
			Util.DOM.setStyle(this.el, {
				display: 'block',
				position: 'absolute',
				left: 0,
				top: 0,
				zIndex: this.settings.zIndex
			});
			Util.DOM.hide(this.el);
			if (this.settings.target === window) {
				Util.DOM.appendToBody(this.el)
			} else {
				Util.DOM.appendChild(this.el, this.settings.target)
			}
			Util.Animation.resetTranslate(this.el);
			this.initialBodyHeight = Util.DOM.bodyOuterHeight()
		},
		resetPosition: function() {
			var width, height, top;
			if (this.settings.target === window) {
				width = Util.DOM.windowWidth();
				height = Util.DOM.bodyOuterHeight() * 2;
				top = (this.settings.jQueryMobile) ? Util.DOM.windowScrollTop() + 'px' : '0px';
				if (height < 1) {
					height = this.initialBodyHeight
				}
				if (Util.DOM.windowHeight() > height) {
					height = Util.DOM.windowHeight()
				}
			} else {
				width = Util.DOM.width(this.settings.target);
				height = Util.DOM.height(this.settings.target);
				top = '0px'
			}
			Util.DOM.setStyle(this.el, {
				width: width,
				height: height,
				top: top
			})
		},
		fadeIn: function(speed, callback) {
			this.resetPosition();
			Util.DOM.setStyle(this.el, 'opacity', 0);
			Util.DOM.show(this.el);
			Util.Animation.fadeIn(this.el, speed, callback)
		}
	})
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.Carousel');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.Carousel.EventTypes = {
		onSlideByEnd: 'PhotoSwipeCarouselOnSlideByEnd',
		onSlideshowStart: 'PhotoSwipeCarouselOnSlideshowStart',
		onSlideshowStop: 'PhotoSwipeCarouselOnSlideshowStop'
	};
	PhotoSwipe.Carousel.CssClasses = {
		carousel: 'ps-carousel',
		content: 'ps-carousel-content',
		item: 'ps-carousel-item',
		itemLoading: 'ps-carousel-item-loading',
		itemError: 'ps-carousel-item-error'
	};
	PhotoSwipe.Carousel.SlideByAction = {
		previous: 'previous',
		current: 'current',
		next: 'next'
	}
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.Carousel');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.Carousel.CarouselClass = klass({
		el: null,
		contentEl: null,
		settings: null,
		cache: null,
		slideByEndHandler: null,
		currentCacheIndex: null,
		isSliding: null,
		isSlideshowActive: null,
		lastSlideByAction: null,
		touchStartPoint: null,
		touchStartPosition: null,
		imageLoadHandler: null,
		imageErrorHandler: null,
		slideshowTimeout: null,
		dispose: function() {
			var prop, i, j;
			for (i = 0, j = this.cache.images.length; i < j; i++) {
				Util.Events.remove(this.cache.images[i], PhotoSwipe.Image.EventTypes.onLoad, this.imageLoadHandler);
				Util.Events.remove(this.cache.images[i], PhotoSwipe.Image.EventTypes.onError, this.imageErrorHandler)
			}
			this.stopSlideshow();
			Util.Animation.stop(this.el);
			Util.DOM.removeChild(this.el, this.el.parentNode);
			for (prop in this) {
				if (Util.objectHasProperty(this, prop)) {
					this[prop] = null
				}
			}
		},
		initialize: function(cache, options) {
			var i, totalItems, itemEl;
			this.cache = cache;
			this.settings = options;
			this.slideByEndHandler = this.onSlideByEnd.bind(this);
			this.imageLoadHandler = this.onImageLoad.bind(this);
			this.imageErrorHandler = this.onImageError.bind(this);
			this.currentCacheIndex = 0;
			this.isSliding = false;
			this.isSlideshowActive = false;
			if (this.cache.images.length < 3) {
				this.settings.loop = false
			}
			this.el = Util.DOM.createElement('div', {
				'class': PhotoSwipe.Carousel.CssClasses.carousel
			}, '');
			Util.DOM.setStyle(this.el, {
				display: 'block',
				position: 'absolute',
				left: 0,
				top: 0,
				overflow: 'hidden',
				zIndex: this.settings.zIndex
			});
			Util.DOM.hide(this.el);
			this.contentEl = Util.DOM.createElement('div', {
				'class': PhotoSwipe.Carousel.CssClasses.content
			}, '');
			Util.DOM.setStyle(this.contentEl, {
				display: 'block',
				position: 'absolute',
				left: 0,
				top: 0
			});
			Util.DOM.appendChild(this.contentEl, this.el);
			totalItems = (cache.images.length < 3) ? cache.images.length : 3;
			for (i = 0; i < totalItems; i++) {
				itemEl = Util.DOM.createElement('div', {
					'class': PhotoSwipe.Carousel.CssClasses.item + ' ' + PhotoSwipe.Carousel.CssClasses.item + '-' + i
				}, '');
				Util.DOM.setAttribute(itemEl, 'style', 'float: left;');
				Util.DOM.setStyle(itemEl, {
					display: 'block',
					position: 'relative',
					left: 0,
					top: 0,
					overflow: 'hidden'
				});
				if (this.settings.margin > 0) {
					Util.DOM.setStyle(itemEl, {
						marginRight: this.settings.margin + 'px'
					})
				}
				Util.DOM.appendChild(itemEl, this.contentEl)
			}
			if (this.settings.target === window) {
				Util.DOM.appendToBody(this.el)
			} else {
				Util.DOM.appendChild(this.el, this.settings.target)
			}
		},
		resetPosition: function() {
			var width, height, top, itemWidth, itemEls, contentWidth, i, j, itemEl, imageEl;
			if (this.settings.target === window) {
				width = Util.DOM.windowWidth();
				height = Util.DOM.windowHeight();
				top = Util.DOM.windowScrollTop() + 'px'
			} else {
				width = Util.DOM.width(this.settings.target);
				height = Util.DOM.height(this.settings.target);
				top = '0px'
			}
			itemWidth = (this.settings.margin > 0) ? width + this.settings.margin : width;
			itemEls = Util.DOM.find('.' + PhotoSwipe.Carousel.CssClasses.item, this.contentEl);
			contentWidth = itemWidth * itemEls.length;
			Util.DOM.setStyle(this.el, {
				top: top,
				width: width,
				height: height
			});
			Util.DOM.setStyle(this.contentEl, {
				width: contentWidth,
				height: height
			});
			for (i = 0, j = itemEls.length; i < j; i++) {
				itemEl = itemEls[i];
				Util.DOM.setStyle(itemEl, {
					width: width,
					height: height
				});
				imageEl = Util.DOM.find('img', itemEl)[0];
				if (!Util.isNothing(imageEl)) {
					this.resetImagePosition(imageEl)
				}
			}
			this.setContentLeftPosition()
		},
		resetImagePosition: function(imageEl) {
			if (Util.isNothing(imageEl)) {
				return
			}
			var src = Util.DOM.getAttribute(imageEl, 'src'),
				scale, newWidth, newHeight, newTop, newLeft, maxWidth = Util.DOM.width(this.el),
				maxHeight = Util.DOM.height(this.el);
			if (this.settings.imageScaleMethod === 'fitNoUpscale') {
				newWidth = imageEl.naturalWidth;
				newHeight = imageEl.naturalHeight;
				if (newWidth > maxWidth) {
					scale = maxWidth / newWidth;
					newWidth = Math.round(newWidth * scale);
					newHeight = Math.round(newHeight * scale)
				}
				if (newHeight > maxHeight) {
					scale = maxHeight / newHeight;
					newHeight = Math.round(newHeight * scale);
					newWidth = Math.round(newWidth * scale)
				}
			} else {
				if (imageEl.isLandscape) {
					scale = maxWidth / imageEl.naturalWidth
				} else {
					scale = maxHeight / imageEl.naturalHeight
				}
				newWidth = Math.round(imageEl.naturalWidth * scale);
				newHeight = Math.round(imageEl.naturalHeight * scale);
				if (this.settings.imageScaleMethod === 'zoom') {
					scale = 1;
					if (newHeight < maxHeight) {
						scale = maxHeight / newHeight
					} else if (newWidth < maxWidth) {
						scale = maxWidth / newWidth
					}
					if (scale !== 1) {
						newWidth = Math.round(newWidth * scale);
						newHeight = Math.round(newHeight * scale)
					}
				} else if (this.settings.imageScaleMethod === 'fit') {
					scale = 1;
					if (newWidth > maxWidth) {
						scale = maxWidth / newWidth
					} else if (newHeight > maxHeight) {
						scale = maxHeight / newHeight
					}
					if (scale !== 1) {
						newWidth = Math.round(newWidth * scale);
						newHeight = Math.round(newHeight * scale)
					}
				}
			}
			newTop = Math.round(((maxHeight - newHeight) / 2)) + 'px';
			newLeft = Math.round(((maxWidth - newWidth) / 2)) + 'px';
			Util.DOM.setStyle(imageEl, {
				position: 'absolute',
				width: newWidth,
				height: newHeight,
				top: newTop,
				left: newLeft,
				display: 'block'
			})
		},
		setContentLeftPosition: function() {
			var width, itemEls, left;
			if (this.settings.target === window) {
				width = Util.DOM.windowWidth()
			} else {
				width = Util.DOM.width(this.settings.target)
			}
			itemEls = this.getItemEls();
			left = 0;
			if (this.settings.loop) {
				left = (width + this.settings.margin) * -1
			} else {
				if (this.currentCacheIndex === this.cache.images.length - 1) {
					left = ((itemEls.length - 1) * (width + this.settings.margin)) * -1
				} else if (this.currentCacheIndex > 0) {
					left = (width + this.settings.margin) * -1
				}
			}
			Util.DOM.setStyle(this.contentEl, {
				left: left + 'px'
			})
		},
		show: function(index) {
			this.currentCacheIndex = index;
			this.resetPosition();
			this.setImages(false);
			Util.DOM.show(this.el);
			Util.Animation.resetTranslate(this.contentEl);
			var itemEls = this.getItemEls(),
				i, j;
			for (i = 0, j = itemEls.length; i < j; i++) {
				Util.Animation.resetTranslate(itemEls[i])
			}
			Util.Events.fire(this, {
				type: PhotoSwipe.Carousel.EventTypes.onSlideByEnd,
				target: this,
				action: PhotoSwipe.Carousel.SlideByAction.current,
				cacheIndex: this.currentCacheIndex
			})
		},
		setImages: function(ignoreCurrent) {
			var cacheImages, itemEls = this.getItemEls(),
				nextCacheIndex = this.currentCacheIndex + 1,
				previousCacheIndex = this.currentCacheIndex - 1;
			if (this.settings.loop) {
				if (nextCacheIndex > this.cache.images.length - 1) {
					nextCacheIndex = 0
				}
				if (previousCacheIndex < 0) {
					previousCacheIndex = this.cache.images.length - 1
				}
				cacheImages = this.cache.getImages([previousCacheIndex, this.currentCacheIndex, nextCacheIndex]);
				if (!ignoreCurrent) {
					this.addCacheImageToItemEl(cacheImages[1], itemEls[1])
				}
				this.addCacheImageToItemEl(cacheImages[2], itemEls[2]);
				this.addCacheImageToItemEl(cacheImages[0], itemEls[0])
			} else {
				if (itemEls.length === 1) {
					if (!ignoreCurrent) {
						cacheImages = this.cache.getImages([this.currentCacheIndex]);
						this.addCacheImageToItemEl(cacheImages[0], itemEls[0])
					}
				} else if (itemEls.length === 2) {
					if (this.currentCacheIndex === 0) {
						cacheImages = this.cache.getImages([this.currentCacheIndex, this.currentCacheIndex + 1]);
						if (!ignoreCurrent) {
							this.addCacheImageToItemEl(cacheImages[0], itemEls[0])
						}
						this.addCacheImageToItemEl(cacheImages[1], itemEls[1])
					} else {
						cacheImages = this.cache.getImages([this.currentCacheIndex - 1, this.currentCacheIndex]);
						if (!ignoreCurrent) {
							this.addCacheImageToItemEl(cacheImages[1], itemEls[1])
						}
						this.addCacheImageToItemEl(cacheImages[0], itemEls[0])
					}
				} else {
					if (this.currentCacheIndex === 0) {
						cacheImages = this.cache.getImages([this.currentCacheIndex, this.currentCacheIndex + 1, this.currentCacheIndex + 2]);
						if (!ignoreCurrent) {
							this.addCacheImageToItemEl(cacheImages[0], itemEls[0])
						}
						this.addCacheImageToItemEl(cacheImages[1], itemEls[1]);
						this.addCacheImageToItemEl(cacheImages[2], itemEls[2])
					} else if (this.currentCacheIndex === this.cache.images.length - 1) {
						cacheImages = this.cache.getImages([this.currentCacheIndex - 2, this.currentCacheIndex - 1, this.currentCacheIndex]);
						if (!ignoreCurrent) {
							this.addCacheImageToItemEl(cacheImages[2], itemEls[2])
						}
						this.addCacheImageToItemEl(cacheImages[1], itemEls[1]);
						this.addCacheImageToItemEl(cacheImages[0], itemEls[0])
					} else {
						cacheImages = this.cache.getImages([this.currentCacheIndex - 1, this.currentCacheIndex, this.currentCacheIndex + 1]);
						if (!ignoreCurrent) {
							this.addCacheImageToItemEl(cacheImages[1], itemEls[1])
						}
						this.addCacheImageToItemEl(cacheImages[2], itemEls[2]);
						this.addCacheImageToItemEl(cacheImages[0], itemEls[0])
					}
				}
			}
		},
		addCacheImageToItemEl: function(cacheImage, itemEl) {
			Util.DOM.removeClass(itemEl, PhotoSwipe.Carousel.CssClasses.itemError);
			Util.DOM.addClass(itemEl, PhotoSwipe.Carousel.CssClasses.itemLoading);
			Util.DOM.removeChildren(itemEl);
			Util.DOM.setStyle(cacheImage.imageEl, {
				display: 'none'
			});
			Util.DOM.appendChild(cacheImage.imageEl, itemEl);
			Util.Animation.resetTranslate(cacheImage.imageEl);
			Util.Events.add(cacheImage, PhotoSwipe.Image.EventTypes.onLoad, this.imageLoadHandler);
			Util.Events.add(cacheImage, PhotoSwipe.Image.EventTypes.onError, this.imageErrorHandler);
			cacheImage.load()
		},
		slideCarousel: function(point, action, speed) {
			if (this.isSliding) {
				return
			}
			var width, diffX, slideBy;
			if (this.settings.target === window) {
				width = Util.DOM.windowWidth() + this.settings.margin
			} else {
				width = Util.DOM.width(this.settings.target) + this.settings.margin
			}
			speed = Util.coalesce(speed, this.settings.slideSpeed);
			if (window.Math.abs(diffX) < 1) {
				return
			}
			switch (action) {
			case Util.TouchElement.ActionTypes.swipeLeft:
				slideBy = width * -1;
				break;
			case Util.TouchElement.ActionTypes.swipeRight:
				slideBy = width;
				break;
			default:
				diffX = point.x - this.touchStartPoint.x;
				if (window.Math.abs(diffX) > width / 2) {
					slideBy = (diffX > 0) ? width : width * -1
				} else {
					slideBy = 0
				}
				break
			}
			if (slideBy < 0) {
				this.lastSlideByAction = PhotoSwipe.Carousel.SlideByAction.next
			} else if (slideBy > 0) {
				this.lastSlideByAction = PhotoSwipe.Carousel.SlideByAction.previous
			} else {
				this.lastSlideByAction = PhotoSwipe.Carousel.SlideByAction.current
			}
			if (!this.settings.loop) {
				if ((this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.previous && this.currentCacheIndex === 0) || (this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.next && this.currentCacheIndex === this.cache.images.length - 1)) {
					slideBy = 0;
					this.lastSlideByAction = PhotoSwipe.Carousel.SlideByAction.current
				}
			}
			this.isSliding = true;
			this.doSlideCarousel(slideBy, speed)
		},
		moveCarousel: function(point) {
			if (this.isSliding) {
				return
			}
			if (!this.settings.enableDrag) {
				return
			}
			this.doMoveCarousel(point.x - this.touchStartPoint.x)
		},
		getItemEls: function() {
			return Util.DOM.find('.' + PhotoSwipe.Carousel.CssClasses.item, this.contentEl)
		},
		previous: function() {
			this.stopSlideshow();
			this.slideCarousel({
				x: 0,
				y: 0
			}, Util.TouchElement.ActionTypes.swipeRight, this.settings.nextPreviousSlideSpeed)
		},
		next: function() {
			this.stopSlideshow();
			this.slideCarousel({
				x: 0,
				y: 0
			}, Util.TouchElement.ActionTypes.swipeLeft, this.settings.nextPreviousSlideSpeed)
		},
		slideshowNext: function() {
			this.slideCarousel({
				x: 0,
				y: 0
			}, Util.TouchElement.ActionTypes.swipeLeft)
		},
		startSlideshow: function() {
			this.stopSlideshow();
			this.isSlideshowActive = true;
			this.slideshowTimeout = window.setTimeout(this.slideshowNext.bind(this), this.settings.slideshowDelay);
			Util.Events.fire(this, {
				type: PhotoSwipe.Carousel.EventTypes.onSlideshowStart,
				target: this
			})
		},
		stopSlideshow: function() {
			if (!Util.isNothing(this.slideshowTimeout)) {
				window.clearTimeout(this.slideshowTimeout);
				this.slideshowTimeout = null;
				this.isSlideshowActive = false;
				Util.Events.fire(this, {
					type: PhotoSwipe.Carousel.EventTypes.onSlideshowStop,
					target: this
				})
			}
		},
		onSlideByEnd: function(e) {
			if (Util.isNothing(this.isSliding)) {
				return
			}
			var itemEls = this.getItemEls();
			this.isSliding = false;
			if (this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.next) {
				this.currentCacheIndex = this.currentCacheIndex + 1
			} else if (this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.previous) {
				this.currentCacheIndex = this.currentCacheIndex - 1
			}
			if (this.settings.loop) {
				if (this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.next) {
					Util.DOM.appendChild(itemEls[0], this.contentEl)
				} else if (this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.previous) {
					Util.DOM.insertBefore(itemEls[itemEls.length - 1], itemEls[0], this.contentEl)
				}
				if (this.currentCacheIndex < 0) {
					this.currentCacheIndex = this.cache.images.length - 1
				} else if (this.currentCacheIndex === this.cache.images.length) {
					this.currentCacheIndex = 0
				}
			} else {
				if (this.cache.images.length > 3) {
					if (this.currentCacheIndex > 1 && this.currentCacheIndex < this.cache.images.length - 2) {
						if (this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.next) {
							Util.DOM.appendChild(itemEls[0], this.contentEl)
						} else if (this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.previous) {
							Util.DOM.insertBefore(itemEls[itemEls.length - 1], itemEls[0], this.contentEl)
						}
					} else if (this.currentCacheIndex === 1) {
						if (this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.previous) {
							Util.DOM.insertBefore(itemEls[itemEls.length - 1], itemEls[0], this.contentEl)
						}
					} else if (this.currentCacheIndex === this.cache.images.length - 2) {
						if (this.lastSlideByAction === PhotoSwipe.Carousel.SlideByAction.next) {
							Util.DOM.appendChild(itemEls[0], this.contentEl)
						}
					}
				}
			}
			if (this.lastSlideByAction !== PhotoSwipe.Carousel.SlideByAction.current) {
				this.setContentLeftPosition();
				this.setImages(true)
			}
			Util.Events.fire(this, {
				type: PhotoSwipe.Carousel.EventTypes.onSlideByEnd,
				target: this,
				action: this.lastSlideByAction,
				cacheIndex: this.currentCacheIndex
			});
			if (this.isSlideshowActive) {
				if (this.lastSlideByAction !== PhotoSwipe.Carousel.SlideByAction.current) {
					this.startSlideshow()
				} else {
					this.stopSlideshow()
				}
			}
		},
		onTouch: function(action, point) {
			this.stopSlideshow();
			switch (action) {
			case Util.TouchElement.ActionTypes.touchStart:
				this.touchStartPoint = point;
				this.touchStartPosition = {
					x: window.parseInt(Util.DOM.getStyle(this.contentEl, 'left'), 0),
					y: window.parseInt(Util.DOM.getStyle(this.contentEl, 'top'), 0)
				};
				break;
			case Util.TouchElement.ActionTypes.touchMove:
				this.moveCarousel(point);
				break;
			case Util.TouchElement.ActionTypes.touchMoveEnd:
			case Util.TouchElement.ActionTypes.swipeLeft:
			case Util.TouchElement.ActionTypes.swipeRight:
				this.slideCarousel(point, action);
				break;
			case Util.TouchElement.ActionTypes.tap:
				break;
			case Util.TouchElement.ActionTypes.doubleTap:
				break
			}
		},
		onImageLoad: function(e) {
			var cacheImage = e.target;
			if (!Util.isNothing(cacheImage.imageEl.parentNode)) {
				Util.DOM.removeClass(cacheImage.imageEl.parentNode, PhotoSwipe.Carousel.CssClasses.itemLoading);
				this.resetImagePosition(cacheImage.imageEl)
			}
			Util.Events.remove(cacheImage, PhotoSwipe.Image.EventTypes.onLoad, this.imageLoadHandler);
			Util.Events.remove(cacheImage, PhotoSwipe.Image.EventTypes.onError, this.imageErrorHandler)
		},
		onImageError: function(e) {
			var cacheImage = e.target;
			if (!Util.isNothing(cacheImage.imageEl.parentNode)) {
				Util.DOM.removeClass(cacheImage.imageEl.parentNode, PhotoSwipe.Carousel.CssClasses.itemLoading);
				Util.DOM.addClass(cacheImage.imageEl.parentNode, PhotoSwipe.Carousel.CssClasses.itemError)
			}
			Util.Events.remove(cacheImage, PhotoSwipe.Image.EventTypes.onLoad, this.imageLoadHandler);
			Util.Events.remove(cacheImage, PhotoSwipe.Image.EventTypes.onError, this.imageErrorHandler)
		}
	})
}(window, window.klass, window.Code.Util));
(function(window, klass, Util, TouchElement) {
	Util.registerNamespace('Code.PhotoSwipe.Carousel');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.Carousel.CarouselClass = PhotoSwipe.Carousel.CarouselClass.extend({
		getStartingPos: function() {
			var startingPos = this.touchStartPosition;
			if (Util.isNothing(startingPos)) {
				startingPos = {
					x: window.parseInt(Util.DOM.getStyle(this.contentEl, 'left'), 0),
					y: window.parseInt(Util.DOM.getStyle(this.contentEl, 'top'), 0)
				}
			}
			return startingPos
		},
		doMoveCarousel: function(xVal) {
			var style;
			if (Util.Browser.isCSSTransformSupported) {
				style = {};
				style[Util.Animation._transitionPrefix + 'Property'] = 'all';
				style[Util.Animation._transitionPrefix + 'Duration'] = '';
				style[Util.Animation._transitionPrefix + 'TimingFunction'] = '';
				style[Util.Animation._transitionPrefix + 'Delay'] = '0';
				style[Util.Animation._transformLabel] = (Util.Browser.is3dSupported) ? 'translate3d(' + xVal + 'px, 0px, 0px)' : 'translate(' + xVal + 'px, 0px)';
				Util.DOM.setStyle(this.contentEl, style)
			} else if (!Util.isNothing(window.jQuery)) {
				window.jQuery(this.contentEl).stop().css('left', this.getStartingPos().x + xVal + 'px')
			}
		},
		doSlideCarousel: function(xVal, speed) {
			var animateProps, transform;
			if (speed <= 0) {
				this.slideByEndHandler();
				return
			}
			if (Util.Browser.isCSSTransformSupported) {
				transform = Util.coalesce(this.contentEl.style.webkitTransform, this.contentEl.style.MozTransform, this.contentEl.style.transform, '');
				if (transform.indexOf('translate3d(' + xVal) === 0) {
					this.slideByEndHandler();
					return
				} else if (transform.indexOf('translate(' + xVal) === 0) {
					this.slideByEndHandler();
					return
				}
				Util.Animation.slideBy(this.contentEl, xVal, 0, speed, this.slideByEndHandler, this.settings.slideTimingFunction)
			} else if (!Util.isNothing(window.jQuery)) {
				animateProps = {
					left: this.getStartingPos().x + xVal + 'px'
				};
				if (this.settings.animationTimingFunction === 'ease-out') {
					this.settings.animationTimingFunction = 'easeOutQuad'
				}
				if (Util.isNothing(window.jQuery.easing[this.settings.animationTimingFunction])) {
					this.settings.animationTimingFunction = 'linear'
				}
				window.jQuery(this.contentEl).animate(animateProps, this.settings.slideSpeed, this.settings.animationTimingFunction, this.slideByEndHandler)
			}
		}
	})
}(window, window.klass, window.Code.Util, window.Code.PhotoSwipe.TouchElement));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.Toolbar');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.Toolbar.CssClasses = {
		toolbar: 'ps-toolbar',
		toolbarContent: 'ps-toolbar-content',
		toolbarTop: 'ps-toolbar-top',
		caption: 'ps-caption',
		captionBottom: 'ps-caption-bottom',
		captionContent: 'ps-caption-content',
		close: 'ps-toolbar-close',
		play: 'ps-toolbar-play',
		previous: 'ps-toolbar-previous',
		previousDisabled: 'ps-toolbar-previous-disabled',
		next: 'ps-toolbar-next',
		nextDisabled: 'ps-toolbar-next-disabled'
	};
	PhotoSwipe.Toolbar.ToolbarAction = {
		close: 'close',
		play: 'play',
		next: 'next',
		previous: 'previous',
		none: 'none'
	};
	PhotoSwipe.Toolbar.EventTypes = {
		onTap: 'PhotoSwipeToolbarOnClick',
		onBeforeShow: 'PhotoSwipeToolbarOnBeforeShow',
		onShow: 'PhotoSwipeToolbarOnShow',
		onBeforeHide: 'PhotoSwipeToolbarOnBeforeHide',
		onHide: 'PhotoSwipeToolbarOnHide'
	};
	PhotoSwipe.Toolbar.getToolbar = function() {
		return '<div class="' + PhotoSwipe.Toolbar.CssClasses.close + '"><div class="' + PhotoSwipe.Toolbar.CssClasses.toolbarContent + '"></div></div><div class="' + PhotoSwipe.Toolbar.CssClasses.play + '"><div class="' + PhotoSwipe.Toolbar.CssClasses.toolbarContent + '"></div></div><div class="' + PhotoSwipe.Toolbar.CssClasses.previous + '"><div class="' + PhotoSwipe.Toolbar.CssClasses.toolbarContent + '"></div></div><div class="' + PhotoSwipe.Toolbar.CssClasses.next + '"><div class="' + PhotoSwipe.Toolbar.CssClasses.toolbarContent + '"></div></div>'
	}
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.Toolbar');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.Toolbar.ToolbarClass = klass({
		toolbarEl: null,
		closeEl: null,
		playEl: null,
		previousEl: null,
		nextEl: null,
		captionEl: null,
		captionContentEl: null,
		currentCaption: null,
		settings: null,
		cache: null,
		timeout: null,
		isVisible: null,
		fadeOutHandler: null,
		touchStartHandler: null,
		touchMoveHandler: null,
		clickHandler: null,
		dispose: function() {
			var prop;
			this.clearTimeout();
			this.removeEventHandlers();
			Util.Animation.stop(this.toolbarEl);
			Util.Animation.stop(this.captionEl);
			Util.DOM.removeChild(this.toolbarEl, this.toolbarEl.parentNode);
			Util.DOM.removeChild(this.captionEl, this.captionEl.parentNode);
			for (prop in this) {
				if (Util.objectHasProperty(this, prop)) {
					this[prop] = null
				}
			}
		},
		initialize: function(cache, options) {
			var cssClass;
			this.settings = options;
			this.cache = cache;
			this.isVisible = false;
			this.fadeOutHandler = this.onFadeOut.bind(this);
			this.touchStartHandler = this.onTouchStart.bind(this);
			this.touchMoveHandler = this.onTouchMove.bind(this);
			this.clickHandler = this.onClick.bind(this);
			cssClass = PhotoSwipe.Toolbar.CssClasses.toolbar;
			if (this.settings.captionAndToolbarFlipPosition) {
				cssClass = cssClass + ' ' + PhotoSwipe.Toolbar.CssClasses.toolbarTop
			}
			this.toolbarEl = Util.DOM.createElement('div', {
				'class': cssClass
			}, this.settings.getToolbar());
			Util.DOM.setStyle(this.toolbarEl, {
				left: 0,
				position: 'absolute',
				overflow: 'hidden',
				zIndex: this.settings.zIndex
			});
			if (this.settings.target === window) {
				Util.DOM.appendToBody(this.toolbarEl)
			} else {
				Util.DOM.appendChild(this.toolbarEl, this.settings.target)
			}
			Util.DOM.hide(this.toolbarEl);
			this.closeEl = Util.DOM.find('.' + PhotoSwipe.Toolbar.CssClasses.close, this.toolbarEl)[0];
			if (this.settings.preventHide && !Util.isNothing(this.closeEl)) {
				Util.DOM.hide(this.closeEl)
			}
			this.playEl = Util.DOM.find('.' + PhotoSwipe.Toolbar.CssClasses.play, this.toolbarEl)[0];
			if (this.settings.preventSlideshow && !Util.isNothing(this.playEl)) {
				Util.DOM.hide(this.playEl)
			}
			this.nextEl = Util.DOM.find('.' + PhotoSwipe.Toolbar.CssClasses.next, this.toolbarEl)[0];
			this.previousEl = Util.DOM.find('.' + PhotoSwipe.Toolbar.CssClasses.previous, this.toolbarEl)[0];
			cssClass = PhotoSwipe.Toolbar.CssClasses.caption;
			if (this.settings.captionAndToolbarFlipPosition) {
				cssClass = cssClass + ' ' + PhotoSwipe.Toolbar.CssClasses.captionBottom
			}
			this.captionEl = Util.DOM.createElement('div', {
				'class': cssClass
			}, '');
			Util.DOM.setStyle(this.captionEl, {
				left: 0,
				position: 'absolute',
				overflow: 'hidden',
				zIndex: this.settings.zIndex
			});
			if (this.settings.target === window) {
				Util.DOM.appendToBody(this.captionEl)
			} else {
				Util.DOM.appendChild(this.captionEl, this.settings.target)
			}
			Util.DOM.hide(this.captionEl);
			this.captionContentEl = Util.DOM.createElement('div', {
				'class': PhotoSwipe.Toolbar.CssClasses.captionContent
			}, '');
			Util.DOM.appendChild(this.captionContentEl, this.captionEl);
			this.addEventHandlers()
		},
		resetPosition: function() {
			var width, toolbarTop, captionTop;
			if (this.settings.target === window) {
				if (this.settings.captionAndToolbarFlipPosition) {
					toolbarTop = Util.DOM.windowScrollTop();
					captionTop = (Util.DOM.windowScrollTop() + Util.DOM.windowHeight()) - Util.DOM.height(this.captionEl)
				} else {
					toolbarTop = (Util.DOM.windowScrollTop() + Util.DOM.windowHeight()) - Util.DOM.height(this.toolbarEl);
					captionTop = Util.DOM.windowScrollTop()
				}
				width = Util.DOM.windowWidth()
			} else {
				if (this.settings.captionAndToolbarFlipPosition) {
					toolbarTop = '0';
					captionTop = Util.DOM.height(this.settings.target) - Util.DOM.height(this.captionEl)
				} else {
					toolbarTop = Util.DOM.height(this.settings.target) - Util.DOM.height(this.toolbarEl);
					captionTop = 0
				}
				width = Util.DOM.width(this.settings.target)
			}
			Util.DOM.setStyle(this.toolbarEl, {
				top: toolbarTop + 'px',
				width: width
			});
			Util.DOM.setStyle(this.captionEl, {
				top: captionTop + 'px',
				width: width
			})
		},
		toggleVisibility: function(index) {
			if (this.isVisible) {
				this.fadeOut()
			} else {
				this.show(index)
			}
		},
		show: function(index) {
			Util.Animation.stop(this.toolbarEl);
			Util.Animation.stop(this.captionEl);
			this.resetPosition();
			this.setToolbarStatus(index);
			Util.Events.fire(this, {
				type: PhotoSwipe.Toolbar.EventTypes.onBeforeShow,
				target: this
			});
			this.showToolbar();
			this.setCaption(index);
			this.showCaption();
			this.isVisible = true;
			this.setTimeout();
			Util.Events.fire(this, {
				type: PhotoSwipe.Toolbar.EventTypes.onShow,


				target: this
			})
		},
		setTimeout: function() {
			if (this.settings.captionAndToolbarAutoHideDelay > 0) {
				this.clearTimeout();
				this.timeout = window.setTimeout(this.fadeOut.bind(this), this.settings.captionAndToolbarAutoHideDelay)
			}
		},
		clearTimeout: function() {
			if (!Util.isNothing(this.timeout)) {
				window.clearTimeout(this.timeout);
				this.timeout = null
			}
		},
		fadeOut: function() {
			this.clearTimeout();
			Util.Events.fire(this, {
				type: PhotoSwipe.Toolbar.EventTypes.onBeforeHide,
				target: this
			});
			Util.Animation.fadeOut(this.toolbarEl, this.settings.fadeOutSpeed);
			Util.Animation.fadeOut(this.captionEl, this.settings.fadeOutSpeed, this.fadeOutHandler);
			this.isVisible = false
		},
		addEventHandlers: function() {
			if (Util.Browser.isTouchSupported) {
				if (!Util.Browser.blackberry) {
					Util.Events.add(this.toolbarEl, 'touchstart', this.touchStartHandler)
				}
				Util.Events.add(this.toolbarEl, 'touchmove', this.touchMoveHandler);
				Util.Events.add(this.captionEl, 'touchmove', this.touchMoveHandler)
			}
			Util.Events.add(this.toolbarEl, 'click', this.clickHandler)
		},
		removeEventHandlers: function() {
			if (Util.Browser.isTouchSupported) {
				if (!Util.Browser.blackberry) {
					Util.Events.remove(this.toolbarEl, 'touchstart', this.touchStartHandler)
				}
				Util.Events.remove(this.toolbarEl, 'touchmove', this.touchMoveHandler);
				Util.Events.remove(this.captionEl, 'touchmove', this.touchMoveHandler)
			}
			Util.Events.remove(this.toolbarEl, 'click', this.clickHandler)
		},
		handleTap: function(e) {
			this.clearTimeout();
			var action;
			if (e.target === this.nextEl || Util.DOM.isChildOf(e.target, this.nextEl)) {
				action = PhotoSwipe.Toolbar.ToolbarAction.next
			} else if (e.target === this.previousEl || Util.DOM.isChildOf(e.target, this.previousEl)) {
				action = PhotoSwipe.Toolbar.ToolbarAction.previous
			} else if (e.target === this.closeEl || Util.DOM.isChildOf(e.target, this.closeEl)) {
				action = PhotoSwipe.Toolbar.ToolbarAction.close
			} else if (e.target === this.playEl || Util.DOM.isChildOf(e.target, this.playEl)) {
				action = PhotoSwipe.Toolbar.ToolbarAction.play
			}
			this.setTimeout();
			if (Util.isNothing(action)) {
				action = PhotoSwipe.Toolbar.ToolbarAction.none
			}
			Util.Events.fire(this, {
				type: PhotoSwipe.Toolbar.EventTypes.onTap,
				target: this,
				action: action,
				tapTarget: e.target
			})
		},
		setCaption: function(index) {
			Util.DOM.removeChildren(this.captionContentEl);
			this.currentCaption = Util.coalesce(this.cache.images[index].caption, ' ');
			if (Util.isObject(this.currentCaption)) {
				Util.DOM.appendChild(this.currentCaption, this.captionContentEl)
			} else {
				if (this.currentCaption === '') {
					this.currentCaption = ' '
				}
				Util.DOM.appendText(this.currentCaption, this.captionContentEl)
			}
			this.currentCaption = (this.currentCaption === ' ') ? '' : this.currentCaption;
			this.resetPosition()
		},
		showToolbar: function() {
			Util.DOM.setStyle(this.toolbarEl, {
				opacity: this.settings.captionAndToolbarOpacity
			});
			Util.DOM.show(this.toolbarEl)
		},
		showCaption: function() {
			if (this.currentCaption === '' || this.captionContentEl.childNodes.length < 1) {
				if (!this.settings.captionAndToolbarShowEmptyCaptions) {
					Util.DOM.hide(this.captionEl);
					return
				}
			}
			Util.DOM.setStyle(this.captionEl, {
				opacity: this.settings.captionAndToolbarOpacity
			});
			Util.DOM.show(this.captionEl)
		},
		setToolbarStatus: function(index) {
			if (this.settings.loop) {
				return
			}
			Util.DOM.removeClass(this.previousEl, PhotoSwipe.Toolbar.CssClasses.previousDisabled);
			Util.DOM.removeClass(this.nextEl, PhotoSwipe.Toolbar.CssClasses.nextDisabled);
			if (index > 0 && index < this.cache.images.length - 1) {
				return
			}
			if (index === 0) {
				if (!Util.isNothing(this.previousEl)) {
					Util.DOM.addClass(this.previousEl, PhotoSwipe.Toolbar.CssClasses.previousDisabled)
				}
			}
			if (index === this.cache.images.length - 1) {
				if (!Util.isNothing(this.nextEl)) {
					Util.DOM.addClass(this.nextEl, PhotoSwipe.Toolbar.CssClasses.nextDisabled)
				}
			}
		},
		onFadeOut: function() {
			Util.DOM.hide(this.toolbarEl);
			Util.DOM.hide(this.captionEl);
			Util.Events.fire(this, {
				type: PhotoSwipe.Toolbar.EventTypes.onHide,
				target: this
			})
		},
		onTouchStart: function(e) {
			e.preventDefault();
			Util.Events.remove(this.toolbarEl, 'click', this.clickHandler);
			this.handleTap(e)
		},
		onTouchMove: function(e) {
			e.preventDefault()
		},
		onClick: function(e) {
			e.preventDefault();
			this.handleTap(e)
		}
	})
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.UILayer');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.UILayer.CssClasses = {
		uiLayer: 'ps-uilayer'
	}
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.UILayer');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.UILayer.UILayerClass = Util.TouchElement.TouchElementClass.extend({
		el: null,
		settings: null,
		dispose: function() {
			var prop;
			this.removeEventHandlers();
			Util.DOM.removeChild(this.el, this.el.parentNode);
			for (prop in this) {
				if (Util.objectHasProperty(this, prop)) {
					this[prop] = null
				}
			}
		},
		initialize: function(options) {
			this.settings = options;
			this.el = Util.DOM.createElement('div', {
				'class': PhotoSwipe.UILayer.CssClasses.uiLayer
			}, '');
			Util.DOM.setStyle(this.el, {
				display: 'block',
				position: 'absolute',
				left: 0,
				top: 0,
				overflow: 'hidden',
				zIndex: this.settings.zIndex,
				opacity: 0
			});
			Util.DOM.hide(this.el);
			if (this.settings.target === window) {
				Util.DOM.appendToBody(this.el)
			} else {
				Util.DOM.appendChild(this.el, this.settings.target)
			}
			this.supr(this.el, {
				swipe: true,
				move: true,
				gesture: Util.Browser.iOS,
				doubleTap: true,
				preventDefaultTouchEvents: this.settings.preventDefaultTouchEvents
			})
		},
		resetPosition: function() {
			if (this.settings.target === window) {
				Util.DOM.setStyle(this.el, {
					top: Util.DOM.windowScrollTop() + 'px',
					width: Util.DOM.windowWidth(),
					height: Util.DOM.windowHeight()
				})
			} else {
				Util.DOM.setStyle(this.el, {
					top: '0px',
					width: Util.DOM.width(this.settings.target),
					height: Util.DOM.height(this.settings.target)
				})
			}
		},
		show: function() {
			this.resetPosition();
			Util.DOM.show(this.el);
			this.addEventHandlers()
		},
		addEventHandlers: function() {
			this.supr()
		},
		removeEventHandlers: function() {
			this.supr()
		}
	})
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.ZoomPanRotate');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.ZoomPanRotate.CssClasses = {
		zoomPanRotate: 'ps-zoom-pan-rotate'
	};
	PhotoSwipe.ZoomPanRotate.EventTypes = {
		onTransform: 'PhotoSwipeZoomPanRotateOnTransform'
	}
}(window, window.klass, window.Code.Util));
(function(window, klass, Util) {
	Util.registerNamespace('Code.PhotoSwipe.ZoomPanRotate');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.ZoomPanRotate.ZoomPanRotateClass = klass({
		el: null,
		settings: null,
		containerEl: null,
		imageEl: null,
		transformSettings: null,
		panStartingPoint: null,
		transformEl: null,
		dispose: function() {
			var prop;
			Util.DOM.removeChild(this.el, this.el.parentNode);
			for (prop in this) {
				if (Util.objectHasProperty(this, prop)) {
					this[prop] = null
				}
			}
		},
		initialize: function(options, cacheImage, uiLayer) {
			var parentEl, width, height, top;
			this.settings = options;
			if (this.settings.target === window) {
				parentEl = document.body;
				width = Util.DOM.windowWidth();
				height = Util.DOM.windowHeight();
				top = Util.DOM.windowScrollTop() + 'px'
			} else {
				parentEl = this.settings.target;
				width = Util.DOM.width(parentEl);
				height = Util.DOM.height(parentEl);
				top = '0px'
			}
			this.imageEl = cacheImage.imageEl.cloneNode(false);
			Util.DOM.setStyle(this.imageEl, {
				zIndex: 1
			});
			this.transformSettings = {
				startingScale: 1.0,
				scale: 1.0,
				startingRotation: 0,
				rotation: 0,
				startingTranslateX: 0,
				startingTranslateY: 0,
				translateX: 0,
				translateY: 0
			};
			this.el = Util.DOM.createElement('div', {
				'class': PhotoSwipe.ZoomPanRotate.CssClasses.zoomPanRotate
			}, '');
			Util.DOM.setStyle(this.el, {
				left: 0,
				top: top,
				position: 'absolute',
				width: width,
				height: height,
				zIndex: this.settings.zIndex,
				display: 'block'
			});
			Util.DOM.insertBefore(this.el, uiLayer.el, parentEl);
			if (Util.Browser.iOS) {
				this.containerEl = Util.DOM.createElement('div', '', '');
				Util.DOM.setStyle(this.containerEl, {
					left: 0,
					top: 0,
					width: width,
					height: height,
					position: 'absolute',
					zIndex: 1
				});
				Util.DOM.appendChild(this.imageEl, this.containerEl);
				Util.DOM.appendChild(this.containerEl, this.el);
				Util.Animation.resetTranslate(this.containerEl);
				Util.Animation.resetTranslate(this.imageEl);
				this.transformEl = this.containerEl
			} else {
				Util.DOM.appendChild(this.imageEl, this.el);
				this.transformEl = this.imageEl
			}
		},
		setStartingTranslateFromCurrentTransform: function() {
			var transformValue = Util.coalesce(this.transformEl.style.webkitTransform, this.transformEl.style.MozTransform, this.transformEl.style.transform),
				transformExploded;
			if (!Util.isNothing(transformValue)) {
				transformExploded = transformValue.match(/translate\((.*?)\)/);
				if (!Util.isNothing(transformExploded)) {
					transformExploded = transformExploded[1].split(', ');
					this.transformSettings.startingTranslateX = window.parseInt(transformExploded[0], 10);
					this.transformSettings.startingTranslateY = window.parseInt(transformExploded[1], 10)
				}
			}
		},
		getScale: function(scaleValue) {
			var scale = this.transformSettings.startingScale * scaleValue;
			if (this.settings.minUserZoom !== 0 && scale < this.settings.minUserZoom) {
				scale = this.settings.minUserZoom
			} else if (this.settings.maxUserZoom !== 0 && scale > this.settings.maxUserZoom) {
				scale = this.settings.maxUserZoom
			}
			return scale
		},
		setStartingScaleAndRotation: function(scaleValue, rotationValue) {
			this.transformSettings.startingScale = this.getScale(scaleValue);
			this.transformSettings.startingRotation = (this.transformSettings.startingRotation + rotationValue) % 360
		},
		zoomRotate: function(scaleValue, rotationValue) {
			this.transformSettings.scale = this.getScale(scaleValue);
			this.transformSettings.rotation = this.transformSettings.startingRotation + rotationValue;
			this.applyTransform()
		},
		panStart: function(point) {
			this.setStartingTranslateFromCurrentTransform();
			this.panStartingPoint = {
				x: point.x,
				y: point.y
			}
		},
		pan: function(point) {
			var dx = point.x - this.panStartingPoint.x,
				dy = point.y - this.panStartingPoint.y,
				dxScaleAdjust = dx / this.transformSettings.scale,
				dyScaleAdjust = dy / this.transformSettings.scale;
			this.transformSettings.translateX = this.transformSettings.startingTranslateX + dxScaleAdjust;
			this.transformSettings.translateY = this.transformSettings.startingTranslateY + dyScaleAdjust;
			this.applyTransform()
		},
		zoomAndPanToPoint: function(scaleValue, point) {
			if (this.settings.target === window) {
				this.panStart({
					x: Util.DOM.windowWidth() / 2,
					y: Util.DOM.windowHeight() / 2
				});
				var dx = point.x - this.panStartingPoint.x,
					dy = point.y - this.panStartingPoint.y,
					dxScaleAdjust = dx / this.transformSettings.scale,
					dyScaleAdjust = dy / this.transformSettings.scale;
				this.transformSettings.translateX = (this.transformSettings.startingTranslateX + dxScaleAdjust) * -1;
				this.transformSettings.translateY = (this.transformSettings.startingTranslateY + dyScaleAdjust) * -1
			}
			this.setStartingScaleAndRotation(scaleValue, 0);
			this.transformSettings.scale = this.transformSettings.startingScale;
			this.transformSettings.rotation = 0;
			this.applyTransform()
		},
		applyTransform: function() {
			var rotationDegs = this.transformSettings.rotation % 360,
				translateX = window.parseInt(this.transformSettings.translateX, 10),
				translateY = window.parseInt(this.transformSettings.translateY, 10),
				transform = 'scale(' + this.transformSettings.scale + ') rotate(' + rotationDegs + 'deg) translate(' + translateX + 'px, ' + translateY + 'px)';
			Util.DOM.setStyle(this.transformEl, {
				webkitTransform: transform,
				MozTransform: transform,
				msTransform: transform,
				transform: transform
			});
			Util.Events.fire(this, {
				target: this,
				type: PhotoSwipe.ZoomPanRotate.EventTypes.onTransform,
				scale: this.transformSettings.scale,
				rotation: this.transformSettings.rotation,
				rotationDegs: rotationDegs,
				translateX: translateX,
				translateY: translateY
			})
		}
	})
}(window, window.klass, window.Code.Util));
(function(window, Util) {
	Util.registerNamespace('Code.PhotoSwipe');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.CssClasses = {
		buildingBody: 'ps-building',
		activeBody: 'ps-active'
	};
	PhotoSwipe.EventTypes = {
		onBeforeShow: 'PhotoSwipeOnBeforeShow',
		onShow: 'PhotoSwipeOnShow',
		onBeforeHide: 'PhotoSwipeOnBeforeHide',
		onHide: 'PhotoSwipeOnHide',
		onDisplayImage: 'PhotoSwipeOnDisplayImage',
		onResetPosition: 'PhotoSwipeOnResetPosition',
		onSlideshowStart: 'PhotoSwipeOnSlideshowStart',
		onSlideshowStop: 'PhotoSwipeOnSlideshowStop',
		onTouch: 'PhotoSwipeOnTouch',
		onBeforeCaptionAndToolbarShow: 'PhotoSwipeOnBeforeCaptionAndToolbarShow',
		onCaptionAndToolbarShow: 'PhotoSwipeOnCaptionAndToolbarShow',
		onBeforeCaptionAndToolbarHide: 'PhotoSwipeOnBeforeCaptionAndToolbarHide',
		onCaptionAndToolbarHide: 'PhotoSwipeOnCaptionAndToolbarHide',
		onToolbarTap: 'PhotoSwipeOnToolbarTap',
		onBeforeZoomPanRotateShow: 'PhotoSwipeOnBeforeZoomPanRotateShow',
		onZoomPanRotateShow: 'PhotoSwipeOnZoomPanRotateShow',
		onBeforeZoomPanRotateHide: 'PhotoSwipeOnBeforeZoomPanRotateHide',
		onZoomPanRotateHide: 'PhotoSwipeOnZoomPanRotateHide',
		onZoomPanRotateTransform: 'PhotoSwipeOnZoomPanRotateTransform'
	};
	PhotoSwipe.instances = [];
	PhotoSwipe.activeInstances = [];
	PhotoSwipe.setActivateInstance = function(instance) {
		var index = Util.arrayIndexOf(instance.settings.target, PhotoSwipe.activeInstances, 'target');
		if (index > -1) {
			throw 'Code.PhotoSwipe.activateInstance: Unable to active instance as another instance is already active for this target';
		}
		PhotoSwipe.activeInstances.push({
			target: instance.settings.target,
			instance: instance
		})
	};
	PhotoSwipe.unsetActivateInstance = function(instance) {
		var index = Util.arrayIndexOf(instance, PhotoSwipe.activeInstances, 'instance');
		PhotoSwipe.activeInstances.splice(index, 1)
	};
	PhotoSwipe.attach = function(images, options, id) {
		var i, j, instance, image;
		instance = PhotoSwipe.createInstance(images, options, id);
		for (i = 0, j = images.length; i < j; i++) {
			image = images[i];
			if (!Util.isNothing(image.nodeType)) {
				if (image.nodeType === 1) {
					image.__photoSwipeClickHandler = PhotoSwipe.onTriggerElementClick.bind(instance);
					Util.Events.remove(image, 'click', image.__photoSwipeClickHandler);
					Util.Events.add(image, 'click', image.__photoSwipeClickHandler)
				}
			}
		}
		return instance
	};
	if (window.jQuery) {
		window.jQuery.fn.photoSwipe = function(options, id) {
			return PhotoSwipe.attach(this, options, id)
		}
	}
	PhotoSwipe.detatch = function(instance) {
		var i, j, image;

		for (i = 0, j = instance.originalImages.length; i < j; i++) {
			image = instance.originalImages[i];
			if (!Util.isNothing(image.nodeType)) {
				if (image.nodeType === 1) {
					Util.Events.remove(image, 'click', image.__photoSwipeClickHandler);
					delete image.__photoSwipeClickHandler
				}
			}
		}
		PhotoSwipe.disposeInstance(instance)
	};
	PhotoSwipe.createInstance = function(images, options, id) {
		var i, instance, image;
		if (Util.isNothing(images)) {
			throw 'Code.PhotoSwipe.attach: No images passed.';
		}
		if (!Util.isLikeArray(images)) {
			throw 'Code.PhotoSwipe.createInstance: Images must be an array of elements or image urls.';
		}
		if (images.length < 1) {
			throw 'Code.PhotoSwipe.createInstance: No images to passed.';
		}
		options = Util.coalesce(options, {});
		instance = PhotoSwipe.getInstance(id);
		if (Util.isNothing(instance)) {
			instance = new PhotoSwipe.PhotoSwipeClass(images, options, id);
			PhotoSwipe.instances.push(instance)
		} else {
			throw 'Code.PhotoSwipe.createInstance: Instance with id "' + id + ' already exists."';
		}
		return instance
	};
	PhotoSwipe.disposeInstance = function(instance) {
		var instanceIndex = PhotoSwipe.getInstanceIndex(instance);
		if (instanceIndex < 0) {
			throw 'Code.PhotoSwipe.disposeInstance: Unable to find instance to dispose.';
		}
		instance.dispose();
		PhotoSwipe.instances.splice(instanceIndex, 1);
		instance = null
	};
	PhotoSwipe.onTriggerElementClick = function(e) {
		e.preventDefault();
		var instance = this;
		instance.show(e.currentTarget)
	};
	PhotoSwipe.getInstance = function(id) {
		var i, j, instance;
		for (i = 0, j = PhotoSwipe.instances.length; i < j; i++) {
			instance = PhotoSwipe.instances[i];
			if (instance.id === id) {
				return instance
			}
		}
		return null
	};
	PhotoSwipe.getInstanceIndex = function(instance) {
		var i, j, instanceIndex = -1;
		for (i = 0, j = PhotoSwipe.instances.length; i < j; i++) {
			if (PhotoSwipe.instances[i] === instance) {
				instanceIndex = i;
				break
			}
		}
		return instanceIndex
	}
}(window, window.Code.Util));
(function(window, klass, Util, Cache, DocumentOverlay, Carousel, Toolbar, UILayer, ZoomPanRotate) {
	Util.registerNamespace('Code.PhotoSwipe');
	var PhotoSwipe = window.Code.PhotoSwipe;
	PhotoSwipe.PhotoSwipeClass = klass({
		id: null,
		settings: null,
		isBackEventSupported: null,
		backButtonClicked: null,
		currentIndex: null,
		originalImages: null,
		mouseWheelStartTime: null,
		windowDimensions: null,
		cache: null,
		documentOverlay: null,
		carousel: null,
		uiLayer: null,
		toolbar: null,
		zoomPanRotate: null,
		windowOrientationChangeHandler: null,
		windowScrollHandler: null,
		windowHashChangeHandler: null,
		keyDownHandler: null,
		windowOrientationEventName: null,
		uiLayerTouchHandler: null,
		carouselSlideByEndHandler: null,
		carouselSlideshowStartHandler: null,
		carouselSlideshowStopHandler: null,
		toolbarTapHandler: null,
		toolbarBeforeShowHandler: null,
		toolbarShowHandler: null,
		toolbarBeforeHideHandler: null,
		toolbarHideHandler: null,
		mouseWheelHandler: null,
		zoomPanRotateTransformHandler: null,
		_isResettingPosition: null,
		_uiWebViewResetPositionTimeout: null,
		dispose: function() {
			var prop;
			Util.Events.remove(this, PhotoSwipe.EventTypes.onBeforeShow);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onShow);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onBeforeHide);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onHide);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onDisplayImage);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onResetPosition);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onSlideshowStart);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onSlideshowStop);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onTouch);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onBeforeCaptionAndToolbarShow);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onCaptionAndToolbarShow);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onBeforeCaptionAndToolbarHide);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onCaptionAndToolbarHide);
			Util.Events.remove(this, PhotoSwipe.EventTypes.onZoomPanRotateTransform);
			this.removeEventHandlers();
			if (!Util.isNothing(this.documentOverlay)) {
				this.documentOverlay.dispose()
			}
			if (!Util.isNothing(this.carousel)) {
				this.carousel.dispose()
			}
			if (!Util.isNothing(this.uiLayer)) {
				this.uiLayer.dispose()
			}
			if (!Util.isNothing(this.toolbar)) {
				this.toolbar.dispose()
			}
			this.destroyZoomPanRotate();
			if (!Util.isNothing(this.cache)) {
				this.cache.dispose()
			}
			for (prop in this) {
				if (Util.objectHasProperty(this, prop)) {
					this[prop] = null
				}
			}
		},
		initialize: function(images, options, id) {
			var targetPosition;
			if (Util.isNothing(id)) {
				this.id = 'PhotoSwipe' + new Date().getTime().toString()
			} else {
				this.id = id
			}
			this.originalImages = images;
			if (Util.Browser.android && !Util.Browser.firefox) {
				if (window.navigator.userAgent.match(/Android (\d+.\d+)/).toString().replace(/^.*\,/, '') >= 2.1) {
					this.isBackEventSupported = true
				}
			}
			if (!this.isBackEventSupported) {
				this.isBackEventSupported = Util.objectHasProperty(window, 'onhashchange')
			}
			this.settings = {
				fadeInSpeed: 250,
				fadeOutSpeed: 250,
				preventHide: false,
				preventSlideshow: false,
				zIndex: 1000,
				backButtonHideEnabled: true,
				enableKeyboard: true,
				enableMouseWheel: true,
				mouseWheelSpeed: 350,
				autoStartSlideshow: false,
				jQueryMobile: (!Util.isNothing(window.jQuery) && !Util.isNothing(window.jQuery.mobile)),
				jQueryMobileDialogHash: '&ui-state=dialog',
				enableUIWebViewRepositionTimeout: false,
				uiWebViewResetPositionDelay: 500,
				target: window,
				preventDefaultTouchEvents: true,
				loop: true,
				slideSpeed: 250,
				nextPreviousSlideSpeed: 0,
				enableDrag: true,
				swipeThreshold: 50,
				swipeTimeThreshold: 250,
				slideTimingFunction: 'ease-out',
				slideshowDelay: 3000,
				doubleTapSpeed: 250,
				margin: 20,
				imageScaleMethod: 'fit',
				captionAndToolbarHide: false,
				captionAndToolbarFlipPosition: false,
				captionAndToolbarAutoHideDelay: 5000,
				captionAndToolbarOpacity: 0.8,
				captionAndToolbarShowEmptyCaptions: true,
				getToolbar: PhotoSwipe.Toolbar.getToolbar,
				allowUserZoom: true,
				allowRotationOnUserZoom: false,
				maxUserZoom: 5.0,
				minUserZoom: 0.5,
				doubleTapZoomLevel: 2.5,
				getImageSource: PhotoSwipe.Cache.Functions.getImageSource,
				getImageCaption: PhotoSwipe.Cache.Functions.getImageCaption,
				getImageMetaData: PhotoSwipe.Cache.Functions.getImageMetaData,
				cacheMode: PhotoSwipe.Cache.Mode.normal
			};
			Util.extend(this.settings, options);
			if (this.settings.target !== window) {
				targetPosition = Util.DOM.getStyle(this.settings.target, 'position');
				if (targetPosition !== 'relative' || targetPosition !== 'absolute') {
					Util.DOM.setStyle(this.settings.target, 'position', 'relative')
				}
			}
			if (this.settings.target !== window) {
				this.isBackEventSupported = false;
				this.settings.backButtonHideEnabled = false
			} else {
				if (this.settings.preventHide) {
					this.settings.backButtonHideEnabled = false
				}
			}
			this.cache = new Cache.CacheClass(images, this.settings)
		},
		show: function(obj) {
			var i, j;
			this._isResettingPosition = false;
			this.backButtonClicked = false;
			if (Util.isNumber(obj)) {
				this.currentIndex = obj
			} else {
				this.currentIndex = -1;
				for (i = 0, j = this.originalImages.length; i < j; i++) {
					if (this.originalImages[i] === obj) {
						this.currentIndex = i;
						break
					}
				}
			}
			if (this.currentIndex < 0 || this.currentIndex > this.originalImages.length - 1) {
				throw "Code.PhotoSwipe.PhotoSwipeClass.show: Starting index out of range";
			}
			this.isAlreadyGettingPage = this.getWindowDimensions();
			PhotoSwipe.setActivateInstance(this);
			this.windowDimensions = this.getWindowDimensions();
			if (this.settings.target === window) {
				Util.DOM.addClass(window.document.body, PhotoSwipe.CssClasses.buildingBody)
			} else {
				Util.DOM.addClass(this.settings.target, PhotoSwipe.CssClasses.buildingBody)
			}
			this.createComponents();
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onBeforeShow,
				target: this
			});
			this.documentOverlay.fadeIn(this.settings.fadeInSpeed, this.onDocumentOverlayFadeIn.bind(this))
		},
		getWindowDimensions: function() {
			return {
				width: Util.DOM.windowWidth(),
				height: Util.DOM.windowHeight()
			}
		},
		createComponents: function() {
			this.documentOverlay = new DocumentOverlay.DocumentOverlayClass(this.settings);
			this.carousel = new Carousel.CarouselClass(this.cache, this.settings);
			this.uiLayer = new UILayer.UILayerClass(this.settings);
			if (!this.settings.captionAndToolbarHide) {
				this.toolbar = new Toolbar.ToolbarClass(this.cache, this.settings)
			}
		},
		resetPosition: function() {
			if (this._isResettingPosition) {
				return
			}
			var newWindowDimensions = this.getWindowDimensions();
			if (!Util.isNothing(this.windowDimensions)) {
				if (newWindowDimensions.width === this.windowDimensions.width && newWindowDimensions.height === this.windowDimensions.height) {
					return
				}
			}
			this._isResettingPosition = true;
			this.windowDimensions = newWindowDimensions;
			this.destroyZoomPanRotate();
			this.documentOverlay.resetPosition();
			this.carousel.resetPosition();
			if (!Util.isNothing(this.toolbar)) {
				this.toolbar.resetPosition()
			}
			this.uiLayer.resetPosition();
			this._isResettingPosition = false;
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onResetPosition,
				target: this
			})
		},
		addEventHandler: function(type, handler) {
			Util.Events.add(this, type, handler)
		},
		addEventHandlers: function() {
			if (Util.isNothing(this.windowOrientationChangeHandler)) {
				this.windowOrientationChangeHandler = this.onWindowOrientationChange.bind(this);
				this.windowScrollHandler = this.onWindowScroll.bind(this);
				this.keyDownHandler = this.onKeyDown.bind(this);
				this.windowHashChangeHandler = this.onWindowHashChange.bind(this);
				this.uiLayerTouchHandler = this.onUILayerTouch.bind(this);
				this.carouselSlideByEndHandler = this.onCarouselSlideByEnd.bind(this);
				this.carouselSlideshowStartHandler = this.onCarouselSlideshowStart.bind(this);
				this.carouselSlideshowStopHandler = this.onCarouselSlideshowStop.bind(this);
				this.toolbarTapHandler = this.onToolbarTap.bind(this);
				this.toolbarBeforeShowHandler = this.onToolbarBeforeShow.bind(this);
				this.toolbarShowHandler = this.onToolbarShow.bind(this);
				this.toolbarBeforeHideHandler = this.onToolbarBeforeHide.bind(this);
				this.toolbarHideHandler = this.onToolbarHide.bind(this);
				this.mouseWheelHandler = this.onMouseWheel.bind(this);
				this.zoomPanRotateTransformHandler = this.onZoomPanRotateTransform.bind(this)
			}
			if (Util.Browser.android) {
				this.orientationEventName = 'resize'
			} else if (Util.Browser.iOS && (!Util.Browser.safari)) {
				Util.Events.add(window.document.body, 'orientationchange', this.windowOrientationChangeHandler)
			} else {
				var supportsOrientationChange = !Util.isNothing(window.onorientationchange);
				this.orientationEventName = supportsOrientationChange ? 'orientationchange' : 'resize'
			}
			if (!Util.isNothing(this.orientationEventName)) {
				Util.Events.add(window, this.orientationEventName, this.windowOrientationChangeHandler)
			}
			if (this.settings.target === window) {
				Util.Events.add(window, 'scroll', this.windowScrollHandler)
			}
			if (this.settings.enableKeyboard) {
				Util.Events.add(window.document, 'keydown', this.keyDownHandler)
			}
			if (this.isBackEventSupported && this.settings.backButtonHideEnabled) {
				this.windowHashChangeHandler = this.onWindowHashChange.bind(this);
				if (this.settings.jQueryMobile) {
					window.location.hash = this.settings.jQueryMobileDialogHash
				} else {
					this.currentHistoryHashValue = 'PhotoSwipe' + new Date().getTime().toString();
					window.location.hash = this.currentHistoryHashValue
				}
				Util.Events.add(window, 'hashchange', this.windowHashChangeHandler)
			}
			if (this.settings.enableMouseWheel) {
				Util.Events.add(window, 'mousewheel', this.mouseWheelHandler)
			}
			Util.Events.add(this.uiLayer, Util.TouchElement.EventTypes.onTouch, this.uiLayerTouchHandler);
			Util.Events.add(this.carousel, Carousel.EventTypes.onSlideByEnd, this.carouselSlideByEndHandler);
			Util.Events.add(this.carousel, Carousel.EventTypes.onSlideshowStart, this.carouselSlideshowStartHandler);
			Util.Events.add(this.carousel, Carousel.EventTypes.onSlideshowStop, this.carouselSlideshowStopHandler);
			if (!Util.isNothing(this.toolbar)) {
				Util.Events.add(this.toolbar, Toolbar.EventTypes.onTap, this.toolbarTapHandler);
				Util.Events.add(this.toolbar, Toolbar.EventTypes.onBeforeShow, this.toolbarBeforeShowHandler);
				Util.Events.add(this.toolbar, Toolbar.EventTypes.onShow, this.toolbarShowHandler);
				Util.Events.add(this.toolbar, Toolbar.EventTypes.onBeforeHide, this.toolbarBeforeHideHandler);
				Util.Events.add(this.toolbar, Toolbar.EventTypes.onHide, this.toolbarHideHandler)
			}
		},
		removeEventHandlers: function() {
			if (Util.Browser.iOS && (!Util.Browser.safari)) {
				Util.Events.remove(window.document.body, 'orientationchange', this.windowOrientationChangeHandler)
			}
			if (!Util.isNothing(this.orientationEventName)) {
				Util.Events.remove(window, this.orientationEventName, this.windowOrientationChangeHandler)
			}
			Util.Events.remove(window, 'scroll', this.windowScrollHandler);
			if (this.settings.enableKeyboard) {
				Util.Events.remove(window.document, 'keydown', this.keyDownHandler)
			}
			if (this.isBackEventSupported && this.settings.backButtonHideEnabled) {
				Util.Events.remove(window, 'hashchange', this.windowHashChangeHandler)
			}
			if (this.settings.enableMouseWheel) {
				Util.Events.remove(window, 'mousewheel', this.mouseWheelHandler)
			}
			if (!Util.isNothing(this.uiLayer)) {
				Util.Events.remove(this.uiLayer, Util.TouchElement.EventTypes.onTouch, this.uiLayerTouchHandler)
			}
			if (!Util.isNothing(this.toolbar)) {
				Util.Events.remove(this.carousel, Carousel.EventTypes.onSlideByEnd, this.carouselSlideByEndHandler);
				Util.Events.remove(this.carousel, Carousel.EventTypes.onSlideshowStart, this.carouselSlideshowStartHandler);
				Util.Events.remove(this.carousel, Carousel.EventTypes.onSlideshowStop, this.carouselSlideshowStopHandler)
			}
			if (!Util.isNothing(this.toolbar)) {
				Util.Events.remove(this.toolbar, Toolbar.EventTypes.onTap, this.toolbarTapHandler);
				Util.Events.remove(this.toolbar, Toolbar.EventTypes.onBeforeShow, this.toolbarBeforeShowHandler);
				Util.Events.remove(this.toolbar, Toolbar.EventTypes.onShow, this.toolbarShowHandler);
				Util.Events.remove(this.toolbar, Toolbar.EventTypes.onBeforeHide, this.toolbarBeforeHideHandler);
				Util.Events.remove(this.toolbar, Toolbar.EventTypes.onHide, this.toolbarHideHandler)
			}
		},
		hide: function() {
			if (this.settings.preventHide) {
				return
			}
			if (Util.isNothing(this.documentOverlay)) {
				throw "Code.PhotoSwipe.PhotoSwipeClass.hide: PhotoSwipe instance is already hidden";
			}
			if (!Util.isNothing(this.hiding)) {
				return
			}
			this.clearUIWebViewResetPositionTimeout();
			this.destroyZoomPanRotate();
			this.removeEventHandlers();
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onBeforeHide,
				target: this
			});
			this.uiLayer.dispose();
			this.uiLayer = null;
			if (!Util.isNothing(this.toolbar)) {
				this.toolbar.dispose();
				this.toolbar = null
			}
			this.carousel.dispose();
			this.carousel = null;
			Util.DOM.removeClass(window.document.body, PhotoSwipe.CssClasses.activeBody);
			this.documentOverlay.dispose();
			this.documentOverlay = null;
			this._isResettingPosition = false;
			PhotoSwipe.unsetActivateInstance(this);
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onHide,
				target: this
			});
			this.goBackInHistory()
		},
		goBackInHistory: function() {
			if (this.isBackEventSupported && this.settings.backButtonHideEnabled) {
				if (!this.backButtonClicked) {
					window.history.back()
				}
			}
		},
		play: function() {
			if (this.isZoomActive()) {
				return
			}
			if (!this.settings.preventSlideshow) {
				if (!Util.isNothing(this.carousel)) {
					if (!Util.isNothing(this.toolbar) && this.toolbar.isVisible) {
						this.toolbar.fadeOut()
					}
					this.carousel.startSlideshow()
				}
			}
		},
		stop: function() {
			if (this.isZoomActive()) {
				return
			}
			if (!Util.isNothing(this.carousel)) {
				this.carousel.stopSlideshow()
			}
		},
		previous: function() {
			if (this.isZoomActive()) {
				return
			}
			if (!Util.isNothing(this.carousel)) {
				this.carousel.previous()
			}
		},
		next: function() {
			if (this.isZoomActive()) {
				return
			}
			if (!Util.isNothing(this.carousel)) {
				this.carousel.next()
			}
		},
		toggleToolbar: function() {
			if (this.isZoomActive()) {
				return
			}
			if (!Util.isNothing(this.toolbar)) {
				this.toolbar.toggleVisibility(this.currentIndex)
			}
		},
		fadeOutToolbarIfVisible: function() {
			if (!Util.isNothing(this.toolbar) && this.toolbar.isVisible && this.settings.captionAndToolbarAutoHideDelay > 0) {
				this.toolbar.fadeOut()
			}
		},
		createZoomPanRotate: function() {
			this.stop();
			if (this.canUserZoom() && !this.isZoomActive()) {
				Util.Events.fire(this, PhotoSwipe.EventTypes.onBeforeZoomPanRotateShow);
				this.zoomPanRotate = new ZoomPanRotate.ZoomPanRotateClass(this.settings, this.cache.images[this.currentIndex], this.uiLayer);
				this.uiLayer.captureSettings.preventDefaultTouchEvents = true;
				Util.Events.add(this.zoomPanRotate, PhotoSwipe.ZoomPanRotate.EventTypes.onTransform, this.zoomPanRotateTransformHandler);
				Util.Events.fire(this, PhotoSwipe.EventTypes.onZoomPanRotateShow);
				if (!Util.isNothing(this.toolbar) && this.toolbar.isVisible) {
					this.toolbar.fadeOut()
				}
			}
		},
		destroyZoomPanRotate: function() {
			if (!Util.isNothing(this.zoomPanRotate)) {
				Util.Events.fire(this, PhotoSwipe.EventTypes.onBeforeZoomPanRotateHide);
				Util.Events.remove(this.zoomPanRotate, PhotoSwipe.ZoomPanRotate.EventTypes.onTransform, this.zoomPanRotateTransformHandler);
				this.zoomPanRotate.dispose();
				this.zoomPanRotate = null;
				this.uiLayer.captureSettings.preventDefaultTouchEvents = this.settings.preventDefaultTouchEvents;
				Util.Events.fire(this, PhotoSwipe.EventTypes.onZoomPanRotateHide)
			}
		},
		canUserZoom: function() {
			var testEl, cacheImage;
			if (Util.Browser.msie) {
				testEl = document.createElement('div');
				if (Util.isNothing(testEl.style.msTransform)) {
					return false
				}
			} else if (!Util.Browser.isCSSTransformSupported) {
				return false
			}
			if (!this.settings.allowUserZoom) {
				return false
			}
			if (this.carousel.isSliding) {
				return false
			}
			cacheImage = this.cache.images[this.currentIndex];
			if (Util.isNothing(cacheImage)) {
				return false
			}
			if (cacheImage.isLoading) {
				return false
			}
			return true
		},
		isZoomActive: function() {
			return (!Util.isNothing(this.zoomPanRotate))
		},
		getCurrentImage: function() {
			return this.cache.images[this.currentIndex]
		},
		onDocumentOverlayFadeIn: function(e) {
			window.setTimeout(function() {
				var el = (this.settings.target === window) ? window.document.body : this.settings.target;
				Util.DOM.removeClass(el, PhotoSwipe.CssClasses.buildingBody);
				Util.DOM.addClass(el, PhotoSwipe.CssClasses.activeBody);
				this.addEventHandlers();
				this.carousel.show(this.currentIndex);
				this.uiLayer.show();
				if (this.settings.autoStartSlideshow) {
					this.play()
				} else if (!Util.isNothing(this.toolbar)) {
					this.toolbar.show(this.currentIndex)
				}
				Util.Events.fire(this, {
					type: PhotoSwipe.EventTypes.onShow,
					target: this
				});
				this.setUIWebViewResetPositionTimeout()
			}.bind(this), 250)
		},
		setUIWebViewResetPositionTimeout: function() {
			if (!this.settings.enableUIWebViewRepositionTimeout) {
				return
			}
			if (!(Util.Browser.iOS && (!Util.Browser.safari))) {
				return
			}
			if (!Util.isNothing(this._uiWebViewResetPositionTimeout)) {
				window.clearTimeout(this._uiWebViewResetPositionTimeout)
			}
			this._uiWebViewResetPositionTimeout = window.setTimeout(function() {
				this.resetPosition();
				this.setUIWebViewResetPositionTimeout()
			}.bind(this), this.settings.uiWebViewResetPositionDelay)
		},
		clearUIWebViewResetPositionTimeout: function() {
			if (!Util.isNothing(this._uiWebViewResetPositionTimeout)) {
				window.clearTimeout(this._uiWebViewResetPositionTimeout)
			}
		},
		onWindowScroll: function(e) {
			this.resetPosition()
		},
		onWindowOrientationChange: function(e) {
			this.resetPosition()
		},
		onWindowHashChange: function(e) {
			var compareHash = '#' + ((this.settings.jQueryMobile) ? this.settings.jQueryMobileDialogHash : this.currentHistoryHashValue);
			if (window.location.hash !== compareHash) {
				this.backButtonClicked = true;
				this.hide()
			}
		},
		onKeyDown: function(e) {
			if (e.keyCode === 37) {
				e.preventDefault();
				this.previous()
			} else if (e.keyCode === 39) {
				e.preventDefault();
				this.next()
			} else if (e.keyCode === 38 || e.keyCode === 40) {
				e.preventDefault()
			} else if (e.keyCode === 27) {
				e.preventDefault();
				this.hide()
			} else if (e.keyCode === 32) {
				if (!this.settings.hideToolbar) {
					this.toggleToolbar()
				} else {
					this.hide()
				}
				e.preventDefault()
			} else if (e.keyCode === 13) {
				e.preventDefault();
				this.play()
			}
		},
		onUILayerTouch: function(e) {
			if (this.isZoomActive()) {
				switch (e.action) {
				case Util.TouchElement.ActionTypes.gestureChange:
					this.zoomPanRotate.zoomRotate(e.scale, (this.settings.allowRotationOnUserZoom) ? e.rotation : 0);
					break;
				case Util.TouchElement.ActionTypes.gestureEnd:
					this.zoomPanRotate.setStartingScaleAndRotation(e.scale, (this.settings.allowRotationOnUserZoom) ? e.rotation : 0);
					break;
				case Util.TouchElement.ActionTypes.touchStart:
					this.zoomPanRotate.panStart(e.point);
					break;
				case Util.TouchElement.ActionTypes.touchMove:
					this.zoomPanRotate.pan(e.point);
					break;
				case Util.TouchElement.ActionTypes.doubleTap:
					this.destroyZoomPanRotate();
					this.toggleToolbar();
					break;
				case Util.TouchElement.ActionTypes.swipeLeft:
					this.destroyZoomPanRotate();
					this.next();
					this.toggleToolbar();
					break;
				case Util.TouchElement.ActionTypes.swipeRight:
					this.destroyZoomPanRotate();
					this.previous();
					this.toggleToolbar();
					break
				}
			} else {
				switch (e.action) {
				case Util.TouchElement.ActionTypes.touchMove:
				case Util.TouchElement.ActionTypes.swipeLeft:
				case Util.TouchElement.ActionTypes.swipeRight:
					this.fadeOutToolbarIfVisible();
					this.carousel.onTouch(e.action, e.point);
					break;
				case Util.TouchElement.ActionTypes.touchStart:
				case Util.TouchElement.ActionTypes.touchMoveEnd:
					this.carousel.onTouch(e.action, e.point);
					break;
				case Util.TouchElement.ActionTypes.tap:
					this.toggleToolbar();
					break;
				case Util.TouchElement.ActionTypes.doubleTap:
					if (this.settings.target === window) {
						e.point.x -= Util.DOM.windowScrollLeft();
						e.point.y -= Util.DOM.windowScrollTop()
					}
					var cacheImageEl = this.cache.images[this.currentIndex].imageEl,
						imageTop = window.parseInt(Util.DOM.getStyle(cacheImageEl, 'top'), 10),
						imageLeft = window.parseInt(Util.DOM.getStyle(cacheImageEl, 'left'), 10),
						imageRight = imageLeft + Util.DOM.width(cacheImageEl),
						imageBottom = imageTop + Util.DOM.height(cacheImageEl);
					if (e.point.x < imageLeft) {
						e.point.x = imageLeft
					} else if (e.point.x > imageRight) {
						e.point.x = imageRight
					}
					if (e.point.y < imageTop) {
						e.point.y = imageTop
					} else if (e.point.y > imageBottom) {
						e.point.y = imageBottom
					}
					this.createZoomPanRotate();
					if (this.isZoomActive()) {
						this.zoomPanRotate.zoomAndPanToPoint(this.settings.doubleTapZoomLevel, e.point)
					}
					break;
				case Util.TouchElement.ActionTypes.gestureStart:
					this.createZoomPanRotate();
					break
				}
			}
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onTouch,
				target: this,
				point: e.point,
				action: e.action
			})
		},
		onCarouselSlideByEnd: function(e) {
			this.currentIndex = e.cacheIndex;
			if (!Util.isNothing(this.toolbar)) {
				this.toolbar.setCaption(this.currentIndex);
				this.toolbar.setToolbarStatus(this.currentIndex)
			}
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onDisplayImage,
				target: this,
				action: e.action,
				index: e.cacheIndex
			})
		},
		onToolbarTap: function(e) {
			switch (e.action) {
			case Toolbar.ToolbarAction.next:
				this.next();
				break;
			case Toolbar.ToolbarAction.previous:
				this.previous();
				break;
			case Toolbar.ToolbarAction.close:
				this.hide();
				break;
			case Toolbar.ToolbarAction.play:
				this.play();
				break
			}
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onToolbarTap,
				target: this,
				toolbarAction: e.action,
				tapTarget: e.tapTarget
			})
		},
		onMouseWheel: function(e) {
			var delta = Util.Events.getWheelDelta(e),
				dt = e.timeStamp - (this.mouseWheelStartTime || 0);
			if (dt < this.settings.mouseWheelSpeed) {
				return
			}
			this.mouseWheelStartTime = e.timeStamp;
			if (this.settings.invertMouseWheel) {
				delta = delta * -1
			}
			if (delta < 0) {
				this.next()
			} else if (delta > 0) {
				this.previous()
			}
		},
		onCarouselSlideshowStart: function(e) {
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onSlideshowStart,
				target: this
			})
		},
		onCarouselSlideshowStop: function(e) {
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onSlideshowStop,
				target: this
			})
		},
		onToolbarBeforeShow: function(e) {
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onBeforeCaptionAndToolbarShow,
				target: this
			})
		},
		onToolbarShow: function(e) {
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onCaptionAndToolbarShow,
				target: this
			})
		},
		onToolbarBeforeHide: function(e) {
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onBeforeCaptionAndToolbarHide,
				target: this
			})
		},
		onToolbarHide: function(e) {
			Util.Events.fire(this, {
				type: PhotoSwipe.EventTypes.onCaptionAndToolbarHide,
				target: this
			})
		},
		onZoomPanRotateTransform: function(e) {
			Util.Events.fire(this, {
				target: this,
				type: PhotoSwipe.EventTypes.onZoomPanRotateTransform,
				scale: e.scale,
				rotation: e.rotation,
				rotationDegs: e.rotationDegs,
				translateX: e.translateX,
				translateY: e.translateY
			})
		}
	})
}(window, window.klass, window.Code.Util, window.Code.PhotoSwipe.Cache, window.Code.PhotoSwipe.DocumentOverlay, window.Code.PhotoSwipe.Carousel, window.Code.PhotoSwipe.Toolbar, window.Code.PhotoSwipe.UILayer, window.Code.PhotoSwipe.ZoomPanRotate));