(function() {
	if (window.magicJS) {
		return
	}
	var a = {
		version: "2.3.11",
		UUID: 0,
		storage: {},
		$uuid: function(b) {
			return (b.$J_UUID || (b.$J_UUID = ++$J.UUID))
		},
		getStorage: function(b) {
			return ($J.storage[b] || ($J.storage[b] = {}))
		},
		$F: function() {},
		$false: function() {
			return false
		},
		defined: function(b) {
			return (undefined != b)
		},
		exists: function(b) {
			return !!(b)
		},
		j1: function(b) {
			if (!$J.defined(b)) {
				return false
			}
			if (b.$J_TYPE) {
				return b.$J_TYPE
			}
			if ( !! b.nodeType) {
				if (1 == b.nodeType) {
					return "element"
				}
				if (3 == b.nodeType) {
					return "textnode"
				}
			}
			if (b.length && b.item) {
				return "collection"
			}
			if (b.length && b.callee) {
				return "arguments"
			}
			if ((b instanceof window.Object || b instanceof window.Function) && b.constructor === $J.Class) {
				return "class"
			}
			if (b instanceof window.Array) {
				return "array"
			}
			if (b instanceof window.Function) {
				return "function"
			}
			if (b instanceof window.String) {
				return "string"
			}
			if ($J.v.trident) {
				if ($J.defined(b.cancelBubble)) {
					return "event"
				}
			} else {
				if (b instanceof window.Event || b === window.event || b.constructor == window.MouseEvent) {
					return "event"
				}
			}
			if (b instanceof window.Date) {
				return "date"
			}
			if (b instanceof window.RegExp) {
				return "regexp"
			}
			if (b === window) {
				return "window"
			}
			if (b === document) {
				return "document"
			}
			return typeof(b)
		},
		extend: function(h, g) {
			if (!(h instanceof window.Array)) {
				h = [h]
			}
			for (var f = 0, c = h.length; f < c; f++) {
				if (!$J.defined(h)) {
					continue
				}
				for (var d in (g || {})) {
					try {
						h[f][d] = g[d]
					} catch (b) {}
				}
			}
			return h[0]
		},
		implement: function(g, f) {
			if (!(g instanceof window.Array)) {
				g = [g]
			}
			for (var d = 0, b = g.length; d < b; d++) {
				if (!$J.defined(g[d])) {
					continue
				}
				if (!g[d].prototype) {
					continue
				}
				for (var c in (f || {})) {
					if (!g[d].prototype[c]) {
						g[d].prototype[c] = f[c]
					}
				}
			}
			return g[0]
		},
		nativize: function(d, c) {
			if (!$J.defined(d)) {
				return d
			}
			for (var b in (c || {})) {
				if (!d[b]) {
					d[b] = c[b]
				}
			}
			return d
		},
		$try: function() {
			for (var c = 0, b = arguments.length; c < b; c++) {
				try {
					return arguments[c]()
				} catch (d) {}
			}
			return null
		},
		$A: function(d) {
			if (!$J.defined(d)) {
				return $j([])
			}
			if (d.toArray) {
				return $j(d.toArray())
			}
			if (d.item) {
				var c = d.length || 0,
					b = new Array(c);
				while (c--) {
					b[c] = d[c]
				}
				return $j(b)
			}
			return $j(Array.prototype.slice.call(d))
		},
		now: function() {
			return new Date().getTime()
		},
		detach: function(g) {
			var d;
			switch ($J.j1(g)) {
			case "object":
				d = {};
				for (var f in g) {
					d[f] = $J.detach(g[f])
				}
				break;
			case "array":
				d = [];
				for (var c = 0, b = g.length; c < b; c++) {
					d[c] = $J.detach(g[c])
				}
				break;
			default:
				return g
			}
			return d
		},
		$: function(c) {
			if (!$J.defined(c)) {
				return null
			}
			if (c.$J_EXTENDED) {
				return c
			}
			switch ($J.j1(c)) {
			case "array":
				c = $J.nativize(c, $J.extend($J.Array, {
					$J_EXTENDED: true
				}));
				c.j14 = c.forEach;
				return c;
				break;
			case "string":
				var b = document.getElementById(c);
				if ($J.defined(b)) {
					return $J.$(b)
				}
				return null;
				break;
			case "window":
			case "document":
				$J.$uuid(c);
				c = $J.extend(c, $J.Doc);
				break;
			case "element":
				$J.$uuid(c);
				c = $J.extend(c, $J.Element);
				break;
			case "event":
				c = $J.extend(c, $J.Event);
				break;
			case "textnode":
				return c;
				break;
			case "function":
			case "array":
			case "date":
			default:
				break
			}
			return $J.extend(c, {
				$J_EXTENDED: true
			})
		},
		$new: function(b, d, c) {
			return $j($J.doc.createElement(b)).setProps(d).j6(c)
		}
	};
	window.magicJS = window.$J = a;
	window.$j = a.$;
	$J.Array = {
		$J_TYPE: "array",
		indexOf: function(f, g) {
			var b = this.length;
			for (var c = this.length, d = (g < 0) ? Math.max(0, c + g) : g || 0; d < c; d++) {
				if (this[d] === f) {
					return d
				}
			}
			return -1
		},
		contains: function(b, c) {
			return this.indexOf(b, c) != -1
		},
		forEach: function(b, f) {
			for (var d = 0, c = this.length; d < c; d++) {
				if (d in this) {
					b.call(f, this[d], d, this)
				}
			}
		},
		filter: function(b, h) {
			var g = [];
			for (var f = 0, c = this.length; f < c; f++) {
				if (f in this) {
					var d = this[f];
					if (b.call(h, this[f], f, this)) {
						g.push(d)
					}
				}
			}
			return g
		},
		map: function(b, g) {
			var f = [];
			for (var d = 0, c = this.length; d < c; d++) {
				if (d in this) {
					f[d] = b.call(g, this[d], d, this)
				}
			}
			return f
		}
	};
	$J.implement(String, {
		$J_TYPE: "string",
		j21: function() {
			return this.replace(/^\s+|\s+$/g, "")
		},
		trimLeft: function() {
			return this.replace(/^\s+/g, "")
		},
		trimRight: function() {
			return this.replace(/\s+$/g, "")
		},
		j20: function(b) {
			return (this.toString() === b.toString())
		},
		icompare: function(b) {
			return (this.toLowerCase().toString() === b.toLowerCase().toString())
		},
		k: function() {
			return this.replace(/-\D/g, function(b) {
				return b.charAt(1).toUpperCase()
			})
		},
		dashize: function() {
			return this.replace(/[A-Z]/g, function(b) {
				return ("-" + b.charAt(0).toLowerCase())
			})
		},
		j22: function(c) {
			return parseInt(this, c || 10)
		},
		toFloat: function() {
			return parseFloat(this)
		},
		j23: function() {
			return !this.replace(/true/i, "").j21()
		},
		has: function(c, b) {
			b = b || "";
			return (b + this + b).indexOf(b + c + b) > -1
		}
	});
	a.implement(Function, {
		$J_TYPE: "function",
		j19: function() {
			var c = $J.$A(arguments),
				b = this,
				d = c.shift();
			return function() {
				return b.apply(d || null, c.concat($J.$A(arguments)))
			}
		},
		j18: function() {
			var c = $J.$A(arguments),
				b = this,
				d = c.shift();
			return function(f) {
				return b.apply(d || null, $j([f || window.event]).concat(c))
			}
		},
		j32: function() {
			var c = $J.$A(arguments),
				b = this,
				d = c.shift();
			return window.setTimeout(function() {
				return b.apply(b, c)
			}, 0)
		},
		j33: function() {
			var c = $J.$A(arguments),
				b = this;
			return function() {
				return b.j32.apply(b, c)
			}
		},
		interval: function() {
			var c = $J.$A(arguments),
				b = this,
				d = c.shift();
			return window.setInterval(function() {
				return b.apply(b, c)
			}, d || 0)
		}
	});
	$J.v = {
		features: {
			xpath: !! (document.evaluate),
			air: !! (window.runtime),
			query: !! (document.querySelector)
		},
		engine: (window.opera) ? "presto" : !! (window.ActiveXObject) ? "trident" : (!navigator.taintEnabled) ? "webkit" : (undefined != document.getBoxObjectFor || null != window.mozInnerScreenY) ? "gecko" : "unknown",
		version: "",
		platform: ($J.defined(window.orientation)) ? "ipod" : (navigator.platform.match(/mac|win|linux/i) || ["other"])[0].toLowerCase(),
		backCompat: document.compatMode && "backcompat" == document.compatMode.toLowerCase(),
		getDoc: function() {
			return (document.compatMode && "backcompat" == document.compatMode.toLowerCase()) ? document.body : document.documentElement
		},
		ready: false,
		onready: function() {
			if ($J.v.ready) {
				return
			}
			$J.v.ready = true;
			$J.body = $j(document.body);
			$j(document).raiseEvent("domready")
		}
	};
	(function() {
		function b() {
			return !!(arguments.callee.caller)
		}
		$J.v.version = ("presto" == $J.v.engine) ? !! (window.applicationCache) ? 260 : !! (window.localStorage) ? 250 : ($J.v.features.query) ? 220 : ((b()) ? 211 : ((document.getElementsByClassName) ? 210 : 200)) : ("trident" == $J.v.engine) ? !! (window.XMLHttpRequest && window.postMessage) ? 6 : ((window.XMLHttpRequest) ? 5 : 4) : ("webkit" == $J.v.engine) ? (($J.v.features.xpath) ? (($J.v.features.query) ? 525 : 420) : 419) : ("gecko" == $J.v.engine) ? !! document.readyState ? 192 : !! (window.localStorage) ? 191 : ((document.getElementsByClassName) ? 190 : 181) : "";
		$J.v[$J.v.engine] = $J.v[$J.v.engine + $J.v.version] = true;
		if (window.chrome) {
			$J.v.chrome = true
		}
	})();
	$J.Element = {
		j13: function(b) {
			return this.className.has(b, " ")
		},
		j2: function(b) {
			if (b && !this.j13(b)) {
				this.className += (this.className ? " " : "") + b
			}
			return this
		},
		j3: function(b) {
			b = b || ".*";
			this.className = this.className.replace(new RegExp("(^|\\s)" + b + "(?:\\s|$)"), "$1").j21();
			return this
		},
		j4: function(b) {
			return this.j13(b) ? this.j3(b) : this.j2(b)
		},
		j5: function(c) {
			c = (c == "float" && this.currentStyle) ? "styleFloat" : c.k();
			var b = null;
			if (this.currentStyle) {
				b = this.currentStyle[c]
			} else {
				if (document.defaultView && document.defaultView.getComputedStyle) {
					css = document.defaultView.getComputedStyle(this, null);
					b = css ? css.getPropertyValue([c.dashize()]) : null
				}
			}
			if (!b) {
				b = this.style[c]
			}
			if ("opacity" == c) {
				return $J.defined(b) ? parseFloat(b) : 1
			}
			if (/^(border(Top|Bottom|Left|Right)Width)|((padding|margin)(Top|Bottom|Left|Right))$/.test(c)) {
				b = parseInt(b) ? b : "0px"
			}
			return ("auto" == b ? null : b)
		},
		j6Prop: function(c, b) {
			try {
				if ("opacity" == c) {
					this.g(b);
					return this
				}
				if ("float" == c) {
					this.style[("undefined" === typeof(this.style.styleFloat)) ? "cssFloat" : "styleFloat"] = b;
					return this
				}
				this.style[c.k()] = b + (("number" == $J.j1(b) && !$j(["zIndex", "zoom"]).contains(c.k())) ? "px" : "")
			} catch (d) {}
			return this
		},
		j6: function(c) {
			for (var b in c) {
				this.j6Prop(b, c[b])
			}
			return this
		},
		j30s: function() {
			var b = {};
			$J.$A(arguments).j14(function(c) {
				b[c] = this.j5(c)
			}, this);
			return b
		},
		g: function(g, c) {
			c = c || false;
			g = parseFloat(g);
			if (c) {
				if (g == 0) {
					if ("hidden" != this.style.visibility) {
						this.style.visibility = "hidden"
					}
				} else {
					if ("visible" != this.style.visibility) {
						this.style.visibility = "visible"
					}
				}
			}
			if ($J.v.trident) {
				if (!this.currentStyle || !this.currentStyle.hasLayout) {
					this.style.zoom = 1
				}
				try {
					var d = this.filters.item("DXImageTransform.Microsoft.Alpha");
					d.enabled = (1 != g);
					d.opacity = g * 100
				} catch (b) {
					this.style.filter += (1 == g) ? "" : "progid:DXImageTransform.Microsoft.Alpha(enabled=true,opacity=" + g * 100 + ")"
				}
			}
			this.style.opacity = g;
			return this
		},
		setProps: function(b) {
			for (var c in b) {
				this.setAttribute(c, "" + b[c])
			}
			return this
		},
		hide: function() {
			return this.j6({
				display: "none",
				visibility: "hidden"
			})
		},
		show: function() {
			return this.j6({
				display: "block",
				visibility: "visible"
			})
		},
		j7: function() {
			return {
				width: this.offsetWidth,
				height: this.offsetHeight
			}
		},
		j10: function() {
			return {
				top: this.scrollTop,
				left: this.scrollLeft
			}
		},
		j11: function() {
			var b = this,
				c = {
					top: 0,
					left: 0
				};
			do {
				c.left += b.scrollLeft || 0;
				c.top += b.scrollTop || 0;
				b = b.parentNode
			} while (b);
			return c
		},
		j8: function() {
			if ($J.defined(document.documentElement.getBoundingClientRect)) {
				var c = this.getBoundingClientRect(),
					f = $j(document).j10(),
					h = $J.v.getDoc();
				return {
					top: c.top + f.y - h.clientTop,
					left: c.left + f.x - h.clientLeft
				}
			}
			var g = this,
				d = t = 0;
			do {
				d += g.offsetLeft || 0;
				t += g.offsetTop || 0;
				g = g.offsetParent
			} while (g && !(/^(?:body|html)$/i).test(g.tagName));
			return {
				top: t,
				left: d
			}
		},
		j9: function() {
			var c = this.j8();
			var b = this.j7();
			return {
				top: c.top,
				bottom: c.top + b.height,
				left: c.left,
				right: c.left + b.width
			}
		},
		update: function(d) {
			try {
				this.innerHTML = d
			} catch (b) {
				this.innerText = d
			}
			return this
		},
		remove: function() {
			return (this.parentNode) ? this.parentNode.removeChild(this) : this
		},
		kill: function() {
			$J.$A(this.childNodes).j14(function(b) {
				if (3 == b.nodeType) {
					return
				}
				$j(b).kill()
			});
			this.remove();
			this.clearEvents();
			if (this.$J_UUID) {
				$J.storage[this.$J_UUID] = null;
				delete $J.storage[this.$J_UUID]
			}
			return null
		},
		append: function(d, c) {
			c = c || "bottom";
			var b = this.firstChild;
			("top" == c && b) ? this.insertBefore(d, b) : this.appendChild(d);
			return this
		},
		j43: function(d, c) {
			var b = $j(d).append(this, c);
			return this
		},
		enclose: function(b) {
			this.append(b.parentNode.replaceChild(this, b));
			return this
		},
		hasChild: function(b) {
			if (!(b = $j(b))) {
				return false
			}
			return (this == b) ? false : (this.contains && !($J.v.webkit419)) ? (this.contains(b)) : (this.compareDocumentPosition) ? !! (this.compareDocumentPosition(b) & 16) : $J.$A(this.byTag(b.tagName)).contains(b)
		}
	};
	$J.Element.j30 = $J.Element.j5;
	$J.Element.j31 = $J.Element.j6;
	if (!window.Element) {
		window.Element = $J.$F;
		if ($J.v.engine.webkit) {
			window.document.createElement("iframe")
		}
		window.Element.prototype = ($J.v.engine.webkit) ? window["[[DOMElement.prototype]]"] : {}
	}
	$J.implement(window.Element, {
		$J_TYPE: "element"
	});
	$J.Doc = {
		j7: function() {
			if ($J.v.presto925 || $J.v.webkit419) {
				return {
					width: self.innerWidth,
					height: self.innerHeight
				}
			}
			return {
				width: $J.v.getDoc().clientWidth,
				height: $J.v.getDoc().clientHeight
			}
		},
		j10: function() {
			return {
				x: self.pageXOffset || $J.v.getDoc().scrollLeft,
				y: self.pageYOffset || $J.v.getDoc().scrollTop
			}
		},
		j12: function() {
			var b = this.j7();
			return {
				width: Math.max($J.v.getDoc().scrollWidth, b.width),
				height: Math.max($J.v.getDoc().scrollHeight, b.height)
			}
		}
	};
	$J.extend(document, {
		$J_TYPE: "document"
	});
	$J.extend(window, {
		$J_TYPE: "window"
	});
	$J.extend([$J.Element, $J.Doc], {
		j40: function(f, c) {
			var b = $J.getStorage(this.$J_UUID),
				d = b[f];
			if (undefined != c && undefined == d) {
				d = b[f] = c
			}
			return ($J.defined(d) ? d : null)
		},
		j41: function(d, c) {
			var b = $J.getStorage(this.$J_UUID);
			b[d] = c;
			return this
		},
		j42: function(c) {
			var b = $J.getStorage(this.$J_UUID);
			delete b[c];
			return this
		}
	});
	if (!(window.HTMLElement && window.HTMLElement.prototype && window.HTMLElement.prototype.getElementsByClassName)) {
		$J.extend([$J.Element, $J.Doc], {
			getElementsByClassName: function(b) {
				return $J.$A(this.getElementsByTagName("*")).filter(function(d) {
					try {
						return (1 == d.nodeType && d.className.has(b, " "))
					} catch (c) {}
				})
			}
		})
	}
	$J.extend([$J.Element, $J.Doc], {
		byClass: function() {
			return this.getElementsByClassName(arguments[0])
		},
		byTag: function() {
			return this.getElementsByTagName(arguments[0])
		}
	});
	$J.Event = {
		$J_TYPE: "event",
		stop: function() {
			if (this.stopPropagation) {
				this.stopPropagation()
			} else {
				this.cancelBubble = true
			}
			if (this.preventDefault) {
				this.preventDefault()
			} else {
				this.returnValue = false
			}
			return this
		},
		j15: function() {
			return {
				x: this.pageX || this.clientX + $J.v.getDoc().scrollLeft,
				y: this.pageY || this.clientY + $J.v.getDoc().scrollTop
			}
		},
		getTarget: function() {
			var b = this.target || this.srcElement;
			while (b && 3 == b.nodeType) {
				b = b.parentNode
			}
			return b
		},
		getRelated: function() {
			var c = null;
			switch (this.type) {
			case "mouseover":
				c = this.relatedTarget || this.fromElement;
				break;
			case "mouseout":
				c = this.relatedTarget || this.toElement;
				break;
			default:
				return c
			}
			try {
				while (c && 3 == c.nodeType) {
					c = c.parentNode
				}
			} catch (b) {
				c = null
			}
			return c
		},
		getButton: function() {
			if (!this.which && this.button !== undefined) {
				return (this.button & 1 ? 1 : (this.button & 2 ? 3 : (this.button & 4 ? 2 : 0)))
			}
			return this.which
		}
	};
	$J._event_add_ = "addEventListener";
	$J._event_del_ = "removeEventListener";
	$J._event_prefix_ = "";
	if (!document.addEventListener) {
		$J._event_add_ = "attachEvent";
		$J._event_del_ = "detachEvent";
		$J._event_prefix_ = "on"
	}
	$J.extend([$J.Element, $J.Doc], {
		a: function(f, d) {
			var h = ("domready" == f) ? false : true,
				c = this.j40("events", {});
			c[f] = c[f] || [];
			if (c[f].hasOwnProperty(d.$J_EUID)) {
				return this
			}
			if (!d.$J_EUID) {
				d.$J_EUID = Math.floor(Math.random() * $J.now())
			}
			var b = this,
				g = function(i) {
					return d.call(b)
				};
			if ("domready" == f) {
				if ($J.v.ready) {
					d.call(this);
					return this
				}
			}
			if (h) {
				g = function(i) {
					i = $J.extend(i || window.e, {
						$J_TYPE: "event"
					});
					return d.call(b, $j(i))
				};
				this[$J._event_add_]($J._event_prefix_ + f, g, false)
			}
			c[f][d.$J_EUID] = g;
			return this
		},
		j26: function(f) {
			var h = ("domready" == f) ? false : true,
				c = this.j40("events");
			if (!c || !c[f]) {
				return this
			}
			var g = c[f],
				d = arguments[1] || null;
			if (f && !d) {
				for (var b in g) {
					if (!g.hasOwnProperty(b)) {
						continue
					}
					this.j26(f, b)
				}
				return this
			}
			d = ("function" == $J.j1(d)) ? d.$J_EUID : d;
			if (!g.hasOwnProperty(d)) {
				return this
			}
			if ("domready" == f) {
				h = false
			}
			if (h) {
				this[$J._event_del_]($J._event_prefix_ + f, g[d], false)
			}
			delete g[d];
			return this
		},
		raiseEvent: function(f, c) {
			var j = ("domready" == f) ? false : true,
				i = this,
				h;
			if (!j) {
				var d = this.j40("events");
				if (!d || !d[f]) {
					return this
				}
				var g = d[f];
				for (var b in g) {
					if (!g.hasOwnProperty(b)) {
						continue
					}
					g[b].call(this)
				}
				return this
			}
			if (i === document && document.createEvent && !el.dispatchEvent) {
				i = document.documentElement
			}
			if (document.createEvent) {
				h = document.createEvent(f);
				h.initEvent(c, true, true)
			} else {
				h = document.createEventObject();
				h.eventType = f
			}
			if (document.createEvent) {
				i.dispatchEvent(h)
			} else {
				i.fireEvent("on" + c, h)
			}
			return h
		},
		clearEvents: function() {
			var b = this.j40("events");
			if (!b) {
				return this
			}
			for (var c in b) {
				this.j26(c)
			}
			this.j42("events");
			return this
		}
	});
	(function() {
		if ($J.v.webkit && $J.v.version < 420) {
			(function() {
				($j(["loaded", "complete"]).contains(document.readyState)) ? $J.v.onready() : arguments.callee.j32(50)
			})()
		} else {
			if ($J.v.trident && window == top) {
				(function() {
					($J.$try(function() {
						$J.v.getDoc().doScroll("left");
						return true
					})) ? $J.v.onready() : arguments.callee.j32(50)
				})()
			} else {
				$j(document).a("DOMContentLoaded", $J.v.onready);
				$j(window).a("load", $J.v.onready)
			}
		}
	})();
	$J.Class = function() {
		var g = null,
			c = $J.$A(arguments);
		if ("class" == $J.j1(c[0])) {
			g = c.shift()
		}
		var b = function() {
				for (var j in this) {
					this[j] = $J.detach(this[j])
				}
				if (this.constructor.$parent) {
					this.$parent = {};
					var n = this.constructor.$parent;
					for (var l in n) {
						var i = n[l];
						switch ($J.j1(i)) {
						case "function":
							this.$parent[l] = $J.Class.wrap(this, i);
							break;
						case "object":
							this.$parent[l] = $J.detach(i);
							break;
						case "array":
							this.$parent[l] = $J.detach(i);
							break
						}
					}
				}
				var h = (this.init) ? this.init.apply(this, arguments) : this;
				delete this.caller;
				return h
			};
		if (!b.prototype.init) {
			b.prototype.init = $J.$F
		}
		if (g) {
			var f = function() {};
			f.prototype = g.prototype;
			b.prototype = new f;
			b.$parent = {};
			for (var d in g.prototype) {
				b.$parent[d] = g.prototype[d]
			}
		} else {
			b.$parent = null
		}
		b.constructor = $J.Class;
		b.prototype.constructor = b;
		$J.extend(b.prototype, c[0]);
		$J.extend(b, {
			$J_TYPE: "class"
		});
		return b
	};
	a.Class.wrap = function(b, c) {
		return function() {
			var f = this.caller;
			var d = c.apply(b, arguments);
			return d
		}
	};
	$J.FX = new $J.Class({
		options: {
			fps: 50,
			duration: 500,
			transition: function(b) {
				return -(Math.cos(Math.PI * b) - 1) / 2
			},
			onStart: $J.$F,
			onComplete: $J.$F,
			onBeforeRender: $J.$F
		},
		styles: null,
		init: function(c, b) {
			this.el = $j(c);
			this.options = $J.extend(this.options, b);
			this.timer = false
		},
		start: function(b) {
			this.styles = b;
			this.state = 0;
			this.curFrame = 0;
			this.startTime = $J.now();
			this.finishTime = this.startTime + this.options.duration;
			this.timer = this.loop.j19(this).interval(Math.round(1000 / this.options.fps));
			this.options.onStart.call();
			return this
		},
		stop: function(b) {
			b = $J.defined(b) ? b : false;
			if (this.timer) {
				clearInterval(this.timer);
				this.timer = false
			}
			if (b) {
				this.render(1);
				this.options.onComplete.j32(10)
			}
			return this
		},
		calc: function(d, c, b) {
			return (c - d) * b + d
		},
		loop: function() {
			var c = $J.now();
			if (c >= this.finishTime) {
				if (this.timer) {
					clearInterval(this.timer);
					this.timer = false
				}
				this.render(1);
				this.options.onComplete.j32(10);
				return this
			}
			var b = this.options.transition((c - this.startTime) / this.options.duration);
			this.render(b);

		},
		render: function(b) {
			var c = {};
			for (var d in this.styles) {
				if ("opacity" === d) {
					c[d] = Math.round(this.calc(this.styles[d][0], this.styles[d][1], b) * 100) / 100
				} else {
					c[d] = Math.round(this.calc(this.styles[d][0], this.styles[d][1], b))
				}
			}
			this.options.onBeforeRender(c);
			this.set(c)
		},
		set: function(b) {
			return this.el.j6(b)
		}
	});
	$J.FX.Transition = {
		linear: function(b) {
			return b
		},
		sineIn: function(b) {
			return -(Math.cos(Math.PI * b) - 1) / 2
		},
		sineOut: function(b) {
			return 1 - $J.FX.Transition.sineIn(1 - b)
		},
		expoIn: function(b) {
			return Math.pow(2, 8 * (b - 1))
		},
		expoOut: function(b) {
			return 1 - $J.FX.Transition.expoIn(1 - b)
		},
		quadIn: function(b) {
			return Math.pow(b, 2)
		},
		quadOut: function(b) {
			return 1 - $J.FX.Transition.quadIn(1 - b)
		},
		cubicIn: function(b) {
			return Math.pow(b, 3)
		},
		cubicOut: function(b) {
			return 1 - $J.FX.Transition.cubicIn(1 - b)
		},
		backIn: function(c, b) {
			b = b || 1.618;
			return Math.pow(c, 2) * ((b + 1) * c - b)
		},
		backOut: function(c, b) {
			return 1 - $J.FX.Transition.backIn(1 - c)
		},
		elasticIn: function(c, b) {
			b = b || [];
			return Math.pow(2, 10 * --c) * Math.cos(20 * c * Math.PI * (b[0] || 1) / 3)
		},
		elasticOut: function(c, b) {
			return 1 - $J.FX.Transition.elasticIn(1 - c, b)
		},
		bounceIn: function(f) {
			for (var d = 0, c = 1; 1; d += c, c /= 2) {
				if (f >= (7 - 4 * d) / 11) {
					return c * c - Math.pow((11 - 6 * d - 11 * f) / 4, 2)
				}
			}
		},
		bounceOut: function(b) {
			return 1 - $J.FX.Transition.bounceIn(1 - b)
		},
		none: function(b) {
			return 0
		}
	};
	$J.PFX = new $J.Class($J.FX, {
		init: function(b, c) {
			this.el_arr = b;
			this.options = $J.extend(this.options, c);
			this.timer = false
		},
		start: function(b) {
			this.$parent.start([]);
			this.styles_arr = b;
			return this
		},
		render: function(b) {
			for (var c = 0; c < this.el_arr.length; c++) {
				this.el = $j(this.el_arr[c]);
				this.styles = this.styles_arr[c];
				this.$parent.render(b)
			}
		}
	});
	$J.win = $j(window);
	$J.doc = $j(document)
})();
$J.$Ff = function() {
	return false
};
var MagicZoom = {
	version: "3.1.24",
	options: {},
	defaults: {
		opacity: 100,
		opacityReverse: false,
		smoothingSpeed: 0,	//平滑显示的速度
		fps: 0,				//帧
		zoomWidth: 423,		//图片放大后的宽度 
		zoomHeight: 423,	//图片放大后的高度 
		zoomDistance: 15,	//图片放大后距离左侧商品图片的距离 
		zoomPosition: "right",	//图片放大后针对商品图片的位置 
		dragMode: false,
		moveOnClick: false,
		alwaysShowZoom: false,
		preservePosition: false,
		x: -1,
		y: -1,
		clickToActivate: false,
		clickToInitialize: false,
		smoothing: false,	//是否平滑显示
		showTitle: "top",
		thumbChange: "mouseover",  	//相册选择切换方式 "click"、"mouseover"
		zoomFade: false,			//图片放大的过程是否淡入淡出 
		zoomFadeInSpeed: 0,			//图片放大的过程淡入速度 
		zoomFadeOutSpeed: 0,		//图片放大的过程淡出速度 
		hotspots: "",
		preloadSelectorsSmall: false,	//小负荷选择器
		preloadSelectorsBig: false,		//大负荷选择器
		showLoading: true,
		loadingMsg: "Loading zoom..",
		loadingOpacity: 100,
		loadingPositionX: -1,
		loadingPositionY: -1,
		selectorsMouseoverDelay: 0,
		selectorsEffect: "false",
		selectorsEffectSpeed: 0,
		fitZoomWindow: false,
		entireImage: false,
		enableRightClick: false
	},
	z40: $j([/^(opacity)(\s+)?:(\s+)?(\d+)$/i, /^(opacity-reverse)(\s+)?:(\s+)?(true|false)$/i, /^(smoothing\-speed)(\s+)?:(\s+)?(\d+)$/i, /^(fps)(\s+)?:(\s+)?(\d+)$/i, /^(zoom\-width)(\s+)?:(\s+)?(\d+)(px)?/i, /^(zoom\-height)(\s+)?:(\s+)?(\d+)(px)?/i, /^(zoom\-distance)(\s+)?:(\s+)?(\d+)(px)?/i, /^(zoom\-position)(\s+)?:(\s+)?(right|left|top|bottom|custom|inner)$/i, /^(drag\-mode)(\s+)?:(\s+)?(true|false)$/i, /^(move\-on\-click)(\s+)?:(\s+)?(true|false)$/i, /^(always\-show\-zoom)(\s+)?:(\s+)?(true|false)$/i, /^(preserve\-position)(\s+)?:(\s+)?(true|false)$/i, /^(x)(\s+)?:(\s+)?([\d.]+)(px)?/i, /^(y)(\s+)?:(\s+)?([\d.]+)(px)?/i, /^(click\-to\-activate)(\s+)?:(\s+)?(true|false)$/i, /^(click\-to\-initialize)(\s+)?:(\s+)?(true|false)$/i, /^(smoothing)(\s+)?:(\s+)?(true|false)$/i, /^(show\-title)(\s+)?:(\s+)?(true|false|top|bottom)$/i, /^(thumb\-change)(\s+)?:(\s+)?(click|mouseover)$/i, /^(zoom\-fade)(\s+)?:(\s+)?(true|false)$/i, /^(zoom\-fade\-in\-speed)(\s+)?:(\s+)?(\d+)$/i, /^(zoom\-fade\-out\-speed)(\s+)?:(\s+)?(\d+)$/i, /^(hotspots)(\s+)?:(\s+)?([a-z0-9_\-:\.]+)$/i, /^(preload\-selectors\-small)(\s+)?:(\s+)?(true|false)$/i, /^(preload\-selectors\-big)(\s+)?:(\s+)?(true|false)$/i, /^(show\-loading)(\s+)?:(\s+)?(true|false)$/i, /^(loading\-msg)(\s+)?:(\s+)?([^;]*)$/i, /^(loading\-opacity)(\s+)?:(\s+)?(\d+)$/i, /^(loading\-position\-x)(\s+)?:(\s+)?(\d+)(px)?/i, /^(loading\-position\-y)(\s+)?:(\s+)?(\d+)(px)?/i, /^(selectors\-mouseover\-delay)(\s+)?:(\s+)?(\d+)$/i, /^(selectors\-effect)(\s+)?:(\s+)?(dissolve|fade|false)$/i, /^(selectors\-effect\-speed)(\s+)?:(\s+)?(\d+)$/i, /^(fit\-zoom\-window)(\s+)?:(\s+)?(true|false)$/i, /^(entire\-image)(\s+)?:(\s+)?(true|false)$/i, /^(enable\-right\-click)(\s+)?:(\s+)?(true|false)$/i]),
	zooms: $j([]),
	z1: function(b) {
		for (var a = 0; a < MagicZoom.zooms.length; a++) {
			if (MagicZoom.zooms[a].z28) {
				MagicZoom.zooms[a].pause()
			} else {
				if (MagicZoom.zooms[a].options.clickToInitialize && MagicZoom.zooms[a].initMouseEvent) {
					MagicZoom.zooms[a].initMouseEvent = b
				}
			}
		}
	},
	stop: function(a) {
		if (a.zoom) {
			a.zoom.stop();
			return true
		}
		return false
	},
	start: function(a) {
		if (!a.zoom) {
			var b = null;
			while (b = a.firstChild) {
				if (b.tagName == "IMG") {
					break
				}
				a.removeChild(b)
			}
			while (b = a.lastChild) {
				if (b.tagName == "IMG") {
					break
				}
				a.removeChild(b)
			}
			if (!a.firstChild || a.firstChild.tagName != "IMG") {
				throw "Invalid Magic Zoom"
			}
			MagicZoom.zooms.push(new MagicZoom.zoom(a));

		} else {

			a.zoom.start()
		}
	},
	update: function(d, a, c, b) {
		if (d.zoom) {
			d.zoom.update(a, c, b);
			return true
		}
		return false
	},
	refresh: function() {
		$J.$A(window.document.getElementsByTagName("A")).j14(function(a) {
			if (/MagicZoom/.test(a.className)) {
				if (MagicZoom.stop(a)) {
					MagicZoom.start.j32(100, a)
				} else {
					MagicZoom.start(a)
				}
			}
		}, this)
	},
	getXY: function(a) {
		if (a.zoom) {
			return {
				x: a.zoom.options.x,
				y: a.zoom.options.y
			}
		}
	},
	x7: function(c) {
		var b, a;
		b = "";
		for (a = 0; a < c.length; a++) {
			b += String.fromCharCode(14 ^ c.charCodeAt(a))
		}
		return b
	}
};
MagicZoom.z50 = function() {
	this.init.apply(this, arguments)
};
MagicZoom.z50.prototype = {
	init: function(a) {
		this.cb = null;
		this.z2 = null;
		this.onErrorHandler = this.onError.j18(this);
		this.z3 = null;
		this.width = 0;
		this.height = 0;
		this.border = {
			left: 0,
			right: 0,
			top: 0,
			bottom: 0
		};
		this.padding = {
			left: 0,
			right: 0,
			top: 0,
			bottom: 0
		};
		this.ready = false;
		this._tmpp = null;
		if ("string" == $J.j1(a)) {
			this._tmpp = $J.$new("div").j6({
				position: "absolute",
				top: "-10000px",
				width: "1px",
				height: "1px",
				overflow: "hidden"
			}).j43($J.body);
			this.self = $J.$new("img").j43(this._tmpp);
			this.z4();
			this.self.src = a
		} else {
			this.self = $j(a);
			this.z4()
		}
	},
	_cleanup: function() {
		if (this._tmpp) {
			if (this.self.parentNode == this._tmpp) {
				this.self.remove().j6({
					position: "static",
					top: "auto"
				})
			}
			this._tmpp.kill();
			this._tmpp = null
		}
	},
	onError: function(a) {
		if (a) {
			$j(a).stop()
		}
		if (this.cb) {
			this._cleanup();
			this.cb.call(this, false)
		}
		this.unload()
	},
	z4: function(a) {
		this.z2 = null;
		if (a == true || !(this.self.src && (this.self.complete || this.self.readyState == "complete"))) {
			this.z2 = function(b) {
				if (b) {
					$j(b).stop()
				}
				if (this.ready) {
					return
				}
				this.ready = true;
				this.z6();
				if (this.cb) {
					this._cleanup();
					this.cb.call()
				}
			}.j18(this);
			this.self.a("load", this.z2);
			$j(["abort", "error"]).j14(function(b) {
				this.self.a(b, this.onErrorHandler)
			}, this)
		} else {
			this.ready = true
		}
	},
	update: function(a) {
		this.unload();
		if (this.self.src.has(a)) {
			this.ready = true
		} else {
			this.z4(true);
			this.self.src = a
		}
	},
	z6: function() {
		this.width = this.self.width;
		this.height = this.self.height;
		if (this.width == 0 && this.height == 0 && $J.v.webkit) {
			this.width = this.self.naturalWidth;
			this.height = this.self.naturalHeight
		}
		$j(["Left", "Right", "Top", "Bottom"]).j14(function(a) {
			this.padding[a.toLowerCase()] = this.self.j30("padding" + a).j22();
			this.border[a.toLowerCase()] = this.self.j30("border" + a + "Width").j22()
		}, this);
		if ($J.v.presto || ($J.v.trident && !$J.v.backCompat)) {
			this.width -= this.padding.left + this.padding.right;
			this.height -= this.padding.top + this.padding.bottom
		}
	},
	getBox: function() {
		var a = null;
		a = this.self.j9();
		return {
			top: a.top + this.border.top,
			bottom: a.bottom - this.border.bottom,
			left: a.left + this.border.left,
			right: a.right - this.border.right
		}
	},
	z5: function() {
		if (this.z3) {
			this.z3.src = this.self.src;
			this.self = null;
			this.self = this.z3
		}
	},
	load: function(a) {
		if (this.ready) {
			if (!this.width) {
				this.z6()
			}
			this._cleanup();
			a.call()
		} else {
			this.cb = a
		}
	},
	unload: function() {
		if (this.z2) {
			this.self.j26("load", this.z2)
		}
		$j(["abort", "error"]).j14(function(a) {
			this.self.j26(a, this.onErrorHandler)
		}, this);
		this.z2 = null;
		this.cb = null;
		this.width = null;
		this.ready = false;
		this._new = false
	}
};
MagicZoom.zoom = function() {
	this.construct.apply(this, arguments)
};
MagicZoom.zoom.prototype = {
	construct: function(b, a) {
		this.z25 = -1;
		this.z28 = false;
		this.ddx = 0;
		this.ddy = 0;
		this.options = $J.detach(MagicZoom.defaults);
		if (b) {
			this.c = $j(b)
		}
		this.z37(this.c.rel);
		if (a) {
			this.z37(a)
		}
		this.z48 = null;
		if (b) {
			this.z7 = this.mousedown.j18(this);
			this.z8 = this.mouseup.j18(this);
			this.z9 = this.show.j19(this, false);
			this.z10 = this.z26.j19(this);
			this.z46Bind = this.z46.j18(this);
			this.c.a("click", function(c) {
				if (!$J.v.trident) {
					this.blur()
				}
				$j(c).stop();
				return false
			});
			this.c.a("mousedown", this.z7);
			this.c.a("mouseup", this.z8);
			this.c.unselectable = "on";
			this.c.style.MozUserSelect = "none";
			this.c.onselectstart = $J.$Ff;
			if (!this.options.enableRightClick) {
				this.c.oncontextmenu = $J.$Ff
			}
			this.c.j6({
				position: "relative",
				display: "inline-block",
				textDecoration: "none",
				outline: "0",
				cursor: "hand"
			});
			if ($J.v.gecko181 || $J.v.presto) {
				this.c.j6({
					display: "block"
				})
			}
			if (this.c.j5("textAlign") == "center") {
				this.c.j6({
					margin: "auto auto"
				})
			}
			this.c.zoom = this
		} else {
			this.options.clickToInitialize = false
		}
		if (!this.options.clickToInitialize) {
			this.z11()
		}
	},
	z11: function() {
		var b, i, h, c, a;
		i = document;
		i = i.location;
		i = i.host;
		if (i.indexOf(MagicZoom.x7("coigmzaablav mac")) == -1) {}
		if (!this.q) {
			this.q = new MagicZoom.z50(this.c.firstChild);
			this.w = new MagicZoom.z50(this.c.href)
		} else {
			this.w.update(this.c.href)
		}
		if (!this.e) {
			this.e = {
				self: $j(document.createElement("DIV")).j2("MagicZoomBigImageCont").j6({
					overflow: "hidden",
					zIndex: 100,
					top: "-100000px",
					position: "absolute",
					width: this.options.zoomWidth + "px",
					height: this.options.zoomHeight + "px"
				}),
				zoom: this,
				z17: "0px"
			};
			this.e.hide = function() {
				if (this.self.style.top != "-100000px" && !this.zoom.x.z39) {
					this.z17 = this.self.style.top;
					this.self.style.top = "-100000px"
				}
			};
			this.e.z18 = this.e.hide.j19(this.e);
			if ($J.v.trident) {
				b = $j(document.createElement("IFRAME"));
				b.src = "javascript:''";
				b.j6({
					left: "0px",
					top: "0px",
					position: "absolute"
				}).frameBorder = 0;
				this.e.z19 = this.e.self.appendChild(b)
			}
			this.e.z44 = $j(document.createElement("DIV")).j2("MagicZoomHeader").j6({
				position: "relative",
				zIndex: 10,
				left: "0px",
				top: "0px",
				padding: "3px"
			}).hide();
			i = document.createElement("DIV");
			i.style.overflow = "hidden";
			i.appendChild(this.w.self);
			this.w.self.j6({
				padding: "0px",
				margin: "0px",
				border: "0px"
			});
			if (this.options.showTitle == "bottom") {
				this.e.self.appendChild(i);
				this.e.self.appendChild(this.e.z44)
			} else {
				this.e.self.appendChild(this.e.z44);
				this.e.self.appendChild(i)
			}
			if (this.options.zoomPosition == "custom" && $j(this.c.id + "-big")) {
				$j(this.c.id + "-big").appendChild(this.e.self)
			} else {
				this.c.appendChild(this.e.self)
			}
			if ("undefined" !== typeof(a)) {
				this.e.g = $j(document.createElement("div")).j6({
					color: a[1],
					fontSize: a[2] + "px",
					fontWeight: a[3],
					fontFamily: "Tahoma",
					position: "absolute",
					width: a[5],
					textAlign: a[4],
					left: "0px"
				}).update(MagicZoom.x7(a[0]));
				this.e.self.appendChild(this.e.g)
			}
		}
		if (this.options.showTitle != "false" && this.options.showTitle != false && this.c.title != "" && this.options.zoomPosition != "inner") {
			c = this.e.z44;
			while (h = c.firstChild) {
				c.removeChild(h)
			}
			this.e.z44.appendChild(document.createTextNode(this.c.title));
			this.e.z44.show()
		} else {
			this.e.z44.hide()
		}
		this.c.z51 = this.c.title;
		this.c.title = "";
		this.q.load(this.z12.j19(this))
	},
	z12: function(a) {
		if (!a && a !== undefined) {
			return
		}
		if (!this.options.opacityReverse) {
			this.q.self.g(1)
		}
		this.c.j6({
			width: this.q.width + "px"
		});
		if (this.options.showLoading) {
			this.z20 = setTimeout(this.z10, 0)
		}
		if (this.options.hotspots != "" && $j(this.options.hotspots)) {
			this.z21()
		}
		if (this.c.id != "") {
			this.z22()
		}
		this.w.load(this.z13.j19(this))
	},
	z13: function(c) {
		var b, a;
		if (!c && c !== undefined) {
			clearTimeout(this.z20);
			if (this.options.showLoading && this.o) {
				this.o.hide()
			}
			return
		}
		a = this.q.self.j9();
		b = this.e.z44.j7();
		if (this.options.fitZoomWindow || this.options.entireImage) {
			if ((this.w.width < this.options.zoomWidth) || this.options.entireImage) {
				this.options.zoomWidth = this.w.width
			}
			if ((this.w.height < this.options.zoomHeight) || this.options.entireImage) {
				this.options.zoomHeight = this.w.height + b.height
			}
		}
		if (this.options.showTitle == "bottom") {
			this.w.self.parentNode.style.height = (this.options.zoomHeight - b.height) + "px"
		}
		this.e.self.j6({
			height: this.options.zoomHeight + "px",
			width: this.options.zoomWidth + "px"
		}).g(1);
		if ($J.v.trident) {
			this.e.z19.j6({
				width: this.options.zoomWidth + "px",
				height: this.options.zoomHeight + "px"
			})
		}
		switch (this.options.zoomPosition) {
		case "custom":
			break;
		case "right":
			this.e.self.style.left = a.right - a.left + this.options.zoomDistance + "px";
			this.e.z17 = "0px";
			break;
		case "left":
			this.e.self.style.left = "-" + (this.options.zoomDistance + this.options.zoomWidth) + "px";
			this.e.z17 = "0px";
			break;
		case "top":
			this.e.self.style.left = "0px";
			this.e.z17 = "-" + (this.options.zoomDistance + this.options.zoomHeight) + "px";
			break;
		case "bottom":
			this.e.self.style.left = "0px";
			this.e.z17 = a.bottom - a.top + this.options.zoomDistance + "px";
			break;
		case "inner":
			this.e.self.j6({
				left: "0px",
				height: this.q.height + "px",
				width: this.q.width + "px"
			});
			this.options.zoomWidth = this.q.width;
			this.options.zoomHeight = this.q.height;
			this.e.z17 = "0px";
			break
		}
		this.zoomViewHeight = this.options.zoomHeight - b.height;
		if (this.e.g) {
			this.e.g.j6({
				top: this.options.showTitle == "bottom" ? "0px" : ((this.options.zoomHeight - 20) + "px")
			})
		}
		this.w.self.j6({
			position: "relative",
			borderWidth: "0px",
			padding: "0px",
			left: "0px",
			top: "0px"
		});
		this.z23();
		if (this.options.alwaysShowZoom) {
			if (this.options.x == -1) {
				this.options.x = this.q.width / 2
			}
			if (this.options.y == -1) {
				this.options.y = this.q.height / 2
			}
			this.show()
		} else {
			if (this.options.zoomFade) {
				this.r = new $J.FX(this.e.self)
			}
			this.e.self.j6({
				top: "-100000px"
			})
		}
		if (this.options.showLoading && this.o) {
			this.o.hide()
		}
		this.c.a("mousemove", this.z46Bind);
		this.c.a("mouseout", this.z46Bind);
		if (!this.options.clickToActivate || this.options.clickToInitialize) {
			this.z28 = true
		}
		if (this.options.clickToInitialize && this.initMouseEvent) {
			this.z46(this.initMouseEvent)
		}
		this.z25 = $J.now()
	},
	z26: function() {
		if (this.w.ready) {
			return
		}
		this.o = $j(document.createElement("DIV")).j2("MagicZoomLoading").g(this.options.loadingOpacity / 100).j6({
			display: "block",
			overflow: "hidden",
			position: "absolute",
			visibility: "hidden",
			"z-index": 20,
			"max-width": (this.q.width - 4)
		});
		this.o.appendChild(document.createTextNode(this.options.loadingMsg));
		this.c.appendChild(this.o);
		var a = this.o.j7();
		this.o.j6({
			left: (this.options.loadingPositionX == -1 ? ((this.q.width - a.width) / 2) : (this.options.loadingPositionX)) + "px",
			top: (this.options.loadingPositionY == -1 ? ((this.q.height - a.height) / 2) : (this.options.loadingPositionY)) + "px"
		});
		this.o.show()
	},
	z22: function() {
		var d, c, a, f;
		this.selectors = $j([]);
		$J.$A(document.getElementsByTagName("A")).j14(function(b) {
			d = new RegExp("^" + this.c.id + "$");
			c = new RegExp("zoom\\-id(\\s+)?:(\\s+)?" + this.c.id + "($|;)");
			if (d.test(b.rel) || c.test(b.rel)) {
				if (!$j(b).z36) {
					b.z36 = function(g) {
						if (!$J.v.trident) {
							this.blur()
						}
						$j(g).stop();
						return false
					};
					b.a("click", b.z36)
				}
				if (!b.z34) {
					b.z34 = function(h, g) {
						if (h.type == "mouseout") {
							if (this.z35) {
								clearTimeout(this.z35)
							}
							this.z35 = false;
							return
						}
						if (g.title != "") {
							this.c.title = g.title
						}
						if (h.type == "mouseover") {
							this.z35 = setTimeout(this.update.j19(this, g.href, g.rev, g.rel), 0);

						} else {
							this.update(g.href, g.rev, g.rel);

						}
					}.j18(this, b);
					b.a(this.options.thumbChange, b.z34);
					if (this.options.thumbChange == "mouseover") {
						b.a("mouseout", b.z34)
					}
				}
				b.j6({
					outline: "0"
				});
				if (this.options.preloadSelectorsSmall) {
					f = new Image();
					f.src = b.rev
				}
				if (this.options.preloadSelectorsBig) {
					a = new Image();
					a.src = b.href
				}
				this.selectors.push(b)
			}
		}, this)
	},
	stop: function(a) {
		try {
			this.pause();
			this.c.j26("mousemove", this.z46Bind);
			this.c.j26("mouseout", this.z46Bind);
			if (undefined === a) {
				this.x.self.hide()
			}
			if (this.r) {
				this.r.stop()
			}
			this.y = null;
			this.z28 = false;
			if (this.selectors !== undefined) {
				this.selectors.j14(function(c) {
					if (undefined === a) {
						c.j26(this.options.thumbChange, c.z34);
						if (this.options.thumbChange == "mouseover") {
							c.j26("mouseout", c.z34)
						}
						c.z34 = null;
						c.j26("click", c.z36);
						c.z36 = null
					}
				}, this)
			}
			if (this.options.hotspots != "" && $j(this.options.hotspots)) {
				$j(this.options.hotspots).hide();
				$j(this.options.hotspots).z30.insertBefore($j(this.options.hotspots), $j(this.options.hotspots).z31);
				if (this.c.z32) {
					this.c.removeChild(this.c.z32)
				}
			}
			this.w.unload();
			if (this.options.opacityReverse) {
				this.c.j3("MagicZoomPup");
				this.q.self.g(1)
			}
			this.r = null;
			if (this.o) {
				this.c.removeChild(this.o)
			}
			if (undefined === a) {
				this.q.unload();
				this.c.removeChild(this.x.self);
				this.e.self.parentNode.removeChild(this.e.self);
				this.x = null;
				this.e = null;
				this.w = null;
				this.q = null
			}
			if (this.z20) {
				clearTimeout(this.z20);
				this.z20 = null
			}
			this.z48 = null;
			this.c.z32 = null;
			this.o = null;
			if (this.c.title == "") {
				this.c.title = this.c.z51
			}
			this.z25 = -1
		} catch (b) {}
	},
	start: function(a) {
		if (this.z25 != -1) {
			return
		}
		this.construct(false, a)
	},
	update: function(c, d, i) {
		var j, f, k, b, g, a, h;
		h = null;
		if ($J.now() - this.z25 < 300 || this.z25 == -1 || this.ufx) {
			j = 300 - $J.now() + this.z25;
			if (this.z25 == -1) {
				j = 300
			}
			this.z35 = setTimeout(this.update.j19(this, c, d, i), 0);
			return
		}
		f = function(l) {
			if (undefined != c) {
				this.c.href = c
			}
			if (undefined === i) {
				i = ""
			}
			if (this.options.preservePosition) {
				i = "x: " + this.options.x + "; y: " + this.options.y + "; " + i
			}
			if (undefined != d) {
				this.q.update(d);
				if (l !== undefined) {
					this.q.load(l)
				}
			}
		};
		b = this.q.width;
		g = this.q.height;
		this.stop(true);
		if (this.options.selectorsEffect != "false") {
			this.ufx = true;
			a = new MagicZoom.z50(d);
			this.c.appendChild(a.self);
			a.self.j6({
				opacity: 0,
				position: "absolute",
				left: "0px",
				top: "0px"
			});
			k = function() {
				var l, n, m;
				l = {};
				m = {};
				n = {
					opacity: [0, 1]
				};
				if (b != a.width || g != a.height) {
					m.width = n.width = l.width = [b, a.width];
					m.height = n.height = l.height = [g, a.height]
				}
				if (this.options.selectorsEffect == "fade") {
					l.opacity = [1, 0]
				}
				new $J.PFX([this.c, a.self, this.c.firstChild], {
					duration: this.options.selectorsEffectSpeed,
					onComplete: function() {
						f.call(this, function() {
							a.unload();
							this.c.removeChild(a.self);
							a = null;
							if (l.opacity) {
								$j(this.c.firstChild).j6({
									opacity: 1
								})
							}
							this.ufx = false;
							this.start(i);
							if (h) {
								h.j32(10)
							}
						}.j19(this))
					}.j19(this)
				}).start([m, n, l])
			};
			a.load(k.j19(this))
		} else {
			f.call(this, function() {
				this.c.j6({
					width: this.q.width + "px",
					height: this.q.height + "px"
				});
				this.start(i);
				if (h) {
					h.j32(10)
				}
			}.j19(this))
		}
	},
	z37: function(b) {
		var a, f, d, c;
		a = null;
		f = [];
		d = $j(b.split(";"));
		for (c in MagicZoom.options) {
			f[c.k()] = MagicZoom.options[c]
		}
		d.j14(function(g) {
			MagicZoom.z40.j14(function(h) {
				a = h.exec(g.j21());
				if (a) {
					switch ($J.j1(MagicZoom.defaults[a[1].k()])) {
					case "boolean":
						f[a[1].k()] = a[4] === "true";
						break;
					case "number":
						f[a[1].k()] = parseFloat(a[4]);
						break;
					default:
						f[a[1].k()] = a[4]
					}
				}
			}, this)
		}, this);
		if (f.dragMode && undefined === f.alwaysShowZoom) {
			f.alwaysShowZoom = true
		}
		this.options = $J.extend(this.options, f)
	},
	z23: function() {
		var a;
		if (!this.x) {
			this.x = {
				self: $j(document.createElement("DIV")).j2("MagicZoomPup").j6({
					zIndex: 10,
					position: "absolute",
					overflow: "hidden"
				}).hide(),
				width: 20,
				height: 20
			};
			this.c.appendChild(this.x.self)
		}
		if (this.options.entireImage) {
			this.x.self.j6({
				"border-width": "0px"
			})
		}
		this.x.z39 = false;
		this.x.height = this.zoomViewHeight / (this.w.height / this.q.height);
		this.x.width = this.options.zoomWidth / (this.w.width / this.q.width);
		if (this.x.width > this.q.width) {
			this.x.width = this.q.width
		}
		if (this.x.height > this.q.height) {
			this.x.height = this.q.height
		}
		this.x.width = Math.round(this.x.width);
		this.x.height = Math.round(this.x.height);
		this.x.borderWidth = this.x.self.j30("borderLeftWidth").j22();
		this.x.self.j6({
			width: (this.x.width - 2 * ($J.v.backCompat ? 0 : this.x.borderWidth)) + "px",
			height: (this.x.height - 2 * ($J.v.backCompat ? 0 : this.x.borderWidth)) + "px"
		});
		if (!this.options.opacityReverse && !this.options.enableRightClick) {
			this.x.self.g(parseFloat(this.options.opacity / 100));
			if (this.x.z45) {
				this.x.self.removeChild(this.x.z45);
				this.x.z45 = null
			}
		} else {
			if (this.x.z45) {
				this.x.z45.src = this.q.self.src
			} else {
				a = this.q.self.cloneNode(false);
				a.unselectable = "on";
				this.x.z45 = $j(this.x.self.appendChild(a)).j6({
					position: "absolute",
					zIndex: 5
				})
			}
			if (this.options.opacityReverse) {
				this.x.self.g(1)
			} else {
				if (this.options.enableRightClick) {
					this.x.z45.g(0.009)
				}
				this.x.self.g(parseFloat(this.options.opacity / 100))
			}
		}
	},
	z46: function(b, a) {
		if (!this.z28 || b === undefined) {
			return false
		}
		$j(b).stop();
		if (a === undefined) {
			a = $j(b).j15()
		}
		if (this.y === null || this.y === undefined) {
			this.y = this.q.getBox()
		}
		if (a.x > this.y.right || a.x < this.y.left || a.y > this.y.bottom || a.y < this.y.top) {
			this.pause();
			return false
		}
		if (b.type == "mouseout") {
			return false
		}
		if (this.options.dragMode && !this.z49) {
			return false
		}
		if (!this.options.moveOnClick) {
			a.x -= this.ddx;
			a.y -= this.ddy
		}
		if ((a.x + this.x.width / 2) >= this.y.right) {
			a.x = this.y.right - this.x.width / 2
		}
		if ((a.x - this.x.width / 2) <= this.y.left) {
			a.x = this.y.left + this.x.width / 2
		}
		if ((a.y + this.x.height / 2) >= this.y.bottom) {
			a.y = this.y.bottom - this.x.height / 2
		}
		if ((a.y - this.x.height / 2) <= this.y.top) {
			a.y = this.y.top + this.x.height / 2
		}
		this.options.x = a.x - this.y.left;
		this.options.y = a.y - this.y.top;
		if (this.z48 === null) {
			if ($J.v.trident) {
				this.c.style.zIndex = 1
			}
			this.z48 = setTimeout(this.z9, 0)
		}
		return true
	},
	show: function() {
		var f, i, d, c, h, g, b, a;
		f = this.x.width / 2;
		i = this.x.height / 2;
		this.x.self.style.left = this.options.x - f + this.q.border.left + "px";
		this.x.self.style.top = this.options.y - i + this.q.border.top + "px";
		if (this.options.opacityReverse) {
			this.x.z45.style.left = "-" + (parseFloat(this.x.self.style.left) + this.x.borderWidth) + "px";
			this.x.z45.style.top = "-" + (parseFloat(this.x.self.style.top) + this.x.borderWidth) + "px"
		}
		d = (this.options.x - f) * (this.w.width / this.q.width);
		c = (this.options.y - i) * (this.w.height / this.q.height);
		if (this.w.width - d < this.options.zoomWidth) {
			d = this.w.width - this.options.zoomWidth;
			if (d < 0) {
				d = 0
			}
		}
		if (this.w.height - c < this.zoomViewHeight) {
			c = this.w.height - this.zoomViewHeight;
			if (c < 0) {
				c = 0
			}
		}
		if (document.documentElement.dir == "rtl") {
			d = (this.options.x + this.x.width / 2 - this.q.width) * (this.w.width / this.q.width)
		}
		d = Math.round(d);
		c = Math.round(c);
		if (this.options.smoothing === false || !this.x.z39) {
			this.w.self.style.left = (-d) + "px";
			this.w.self.style.top = (-c) + "px"
		} else {
			h = parseInt(this.w.self.style.left);
			g = parseInt(this.w.self.style.top);
			b = (-d - h);
			a = (-c - g);
			if (!b && !a) {
				this.z48 = null;
				return
			}
			b *= this.options.smoothingSpeed / 100;
			if (b < 1 && b > 0) {
				b = 1
			} else {
				if (b > -1 && b < 0) {
					b = -1
				}
			}
			h += b;
			a *= this.options.smoothingSpeed / 100;
			if (a < 1 && a > 0) {
				a = 1
			} else {
				if (a > -1 && a < 0) {
					a = -1
				}
			}
			g += a;
			this.w.self.style.left = h + "px";
			this.w.self.style.top = g + "px"
		}
		if (!this.x.z39) {
			if (this.r) {
				this.r.stop();
				this.r.options.onComplete = $J.$F;
				this.r.options.duration = this.options.zoomFadeInSpeed;
				this.e.self.g(0);
				this.r.start({
					opacity: [0, 1]
				})
			}
			if (this.options.zoomPosition != "inner") {
				this.x.self.show()
			}
			this.e.self.style.top = this.e.z17;
			if (this.options.opacityReverse) {
				this.c.j2("MagicZoomPup").j31({
					"border-width": "0px"
				});
				this.q.self.g(parseFloat((100 - this.options.opacity) / 100))
			}
			this.x.z39 = true
		}
		if (this.z48) {
			this.z48 = setTimeout(this.z9, 0)
		}
	},
	pause: function() {
		if (this.z48) {
			clearTimeout(this.z48);
			this.z48 = null
		}
		if (!this.options.alwaysShowZoom && this.x.z39) {
			this.x.z39 = false;
			this.x.self.hide();
			if (this.r) {
				this.r.stop();
				this.r.options.onComplete = this.e.z18;
				this.r.options.duration = this.options.zoomFadeOutSpeed;
				var a = this.e.self.j30("opacity");
				this.r.start({
					opacity: [a, 0]
				})
			} else {
				this.e.hide()
			}
			if (this.options.opacityReverse) {
				this.c.j3("MagicZoomPup");
				this.q.self.g(1)
			}
		}
		this.y = null;
		if (this.options.clickToActivate) {
			this.z28 = false
		}
		if (this.options.dragMode) {
			this.z49 = false
		}
		if ($J.v.trident) {
			this.c.style.zIndex = 0
		}
	},
	mousedown: function(b) {
		$j(b).stop();
		if (this.options.clickToInitialize && !this.q) {
			this.initMouseEvent = b;
			this.z11();
			return
		}
		if (this.w && this.options.clickToActivate && !this.z28) {
			this.z28 = true;
			this.z46(b)
		}
		if (this.options.dragMode) {
			this.z49 = true;
			if (!this.options.moveOnClick) {
				var a = b.j15();
				this.ddx = a.x - this.options.x - this.y.left;
				this.ddy = a.y - this.options.y - this.y.top;
				if (Math.abs(this.ddx) > this.x.width / 2 || Math.abs(this.ddy) > this.x.height / 2) {
					this.z49 = false;
					return
				}
			}
		}
		if (this.options.moveOnClick) {
			this.z46(b)
		}
	},
	mouseup: function(a) {
		$j(a).stop();
		if (this.options.dragMode) {
			this.z49 = false
		}
	}
};
if ($J.v.trident) {
	try {
		document.execCommand("BackgroundImageCache", false, true)
	} catch (e) {}
}
$j(document).a("domready", MagicZoom.refresh);
$j(document).a("mousemove", MagicZoom.z1);