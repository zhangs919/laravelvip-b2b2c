(function(g, k, c) {
	var j = g.APF || {};

	j.Namespace = {
		register: function(o) {
			var n = o.split("."),
				l = g,
				p, m;
			for (m = 0, p = n.length; m < p; m++) {
				if (typeof l[n[m]] == "undefined") {
					l[n[m]] = {}
				}
				l = l[n[m]]
			}
			return l
		}
	};


	g.APF = j;


})(window, document, Zepto);
(function(b, a) {
	a.Observer = {
		listener: {
			defaults: []
		},
		data_status: {},
		on: function(d, c) {
			if (b.type(d) === "function") {
				d = "defaults";
				c = d
			}
			if (b.type(c) !== "function") {
				return
			}
			if (!this.listener[d]) {
				this.listener[d] = []
			}
			this.listener[d].push(c)
		},
		off: function(g, f) {
			var e, d, c;
			if (b.type(g) === "function") {
				f = g;
				g = "defaults"
			}
			if (!g) {
				return
			}
			e = this.listener[g];
			c = e ? e.length : 0;
			if (b.type(f) === "function") {
				for (d = 0; d < c; d++) {
					if (e[d] === f) {
						e.splice(d, 1)
					}
				}
				this.listener[g] = e;
				return
			}
			this.listener[g] = []
		},
		trigger: function() {
			var j = arguments.length,
				h, g, e = [],
				d, c, f;
			if (j <= 1) {
				h = b.type(arguments[0]);
				if (h === "array") {
					h = "defaults";
					e = h
				} else {
					if (h !== "string") {
						return
					} else {
						h = arguments[0]
					}
				}
			} else {
				e = [].concat.apply([], arguments);
				h = e.splice(0, 1)
			}
			g = this.listener[h];
			d = g ? g.length : 0;
			for (f = 0; f < d; f++) {
				c = g[f].apply(null, e);
				if (c === false) {
					break
				}
			}
		},


	};

})(Zepto, APF.Namespace.register("touch.component.module"));
(function(a) {
	a.Dialog = function(b) {
		var c = {
			clazz: "g-d-dialog",
			action: "click",
			target: ""
		};
		this.ops = $.extend(c, b);
		this.dom = {};
		this.init()
	};
	a.Dialog.prototype = $.extend({}, a.Observer, {
		constructor: a.Dialog,
		init: function() {
			var c = $(document.createDocumentFragment()),
				e = this,
				b, d = $("<div></div>");
			d.addClass(this.ops.clazz);
			c.append(d);
			if (this.ops.select) {
				b = $(this.ops.select)
			}
			d.append(b || "");
			$("body").append(c);
			this.dom.dialog = d;
			this.dom.dialog.on("touchmove", function(f) {
				f.preventDefault()
			});
			$(this.ops.closeSelect).click(function(f) {
				f.stopPropagation();
				e.trigger("dialogClose");
				e.close()
			});
			d.find("input").blur(function(f) {
				f.stopPropagation();
				e.fixDrawSlow()
			});
			if (this.ops.target) {
				$(this.ops.target).on(this.ops.action, function(g) {
					g.stopPropagation();
					var f = [].slice.call(arguments);
					e.open(f.slice(1))
				})
			}
		},
		open: function(b) {
			this.trigger("open", b);
			this.dom.dialog.css("display", "-webkit-box");
			this.trigger("afteropen", b)
		},
		close: function(b) {
			this.dom.dialog.hide();
			this.trigger("close", b)
		},
		getDialog: function() {
			return this.dom.dialog
		},
		fixDrawSlow: function() {
			var b = $(window).scrollTop();
			setTimeout(function() {
				$(window).scrollTop(b + 1);
				setTimeout(function() {
					$(window).scrollTop(b)
				}, 10)
			}, 1)
		},
	})
})(APF.Namespace.register("touch.component.module"));
(function(c, b, a) {
	b.CitySearch = function(d) {
		this.opt = c.extend({}, d);
		this.elem = {
			clSearchInput: "#cl-search-input",
			clSListNone: ".cl-s-list-none",
			clSListUl: ".cl-s-list-ul",
		};
		this.inputTimer = 0;
		this.init()
	};
	b.CitySearch.prototype = {
		constructor: b.CitySearch,
		init: function() {
			var d = this;
			c(this.elem.clSearchInput).on("input", function(f) {
				var g = c(this).val();
				if (d.inputTimer != 0) {
					clearTimeout(d.inputTimer)
				}
				d.inputTimer = setTimeout(function() {
					d.search(g);
					d.inputTimer = 0
				}, 500)
			})
		},
		search: function(f) {
			var g = this;
			var e = [];
			var d;
			if (f.indexOf("^") >= 0 || f == "" || f == undefined) {
				return this.searchResult(e)
			}
			for (d in this.opt.data) {
				if (d.indexOf(f) >= 0) {
					e.push(this.opt.data[d])
				}
			}
			return this.searchResult(e, f)
		},
		searchResult: function(e, d) {
			if (e.length < 1) {
				c(this.elem.clSListNone).show();
				c(this.elem.clSListUl).hide()
			} else {
				c(this.elem.clSListUl).empty().append(this.buildSearchHtml(e, d));
				c(this.elem.clSListNone).hide();
				c(this.elem.clSListUl).show();
				c(this.elem.clSListUl).height(window.innerHeight - 52);
			}
		},
		buildSearchHtml: function(k, e) {
			var g = [];
			var f = 0;
			var d, j;
			for (var f = 0; f < k.length; f++) {
				d = k[f]["city_name"];
				j = '<li><a href="' + k[f]["url"] + '">';
				if (d.indexOf(e) >= 0) {
					j += d.replace(e, "<span>" + e + "</span>")
				} else {
					j += d
				}
				j += "</a></li>";
				g.push(j)
			}
			return g.join("")
		},
	};
	b.CityList = function() {
		this.elem = {
			clHeader: ".header",
			clLetter: ".cl-c-letter",
			clContainer: ".cl-container",
			clLetterShade: ".cl-c-letter-shade",
			clCSearch: ".cl-c-search",
			clSearch: ".cl-search",
			clSHCancel: ".cl-s-h-cancel",
			clSearchInput: "#cl-search-input",
			clSListUl: ".cl-s-list-ul",
			clSListNone: ".cl-s-list-none",
			clCLH: ".cl-c-l-h",
		};
		this.className = {
			clLetterSelect: "cl-c-letter-select",
			clSearchShow: "cl-search-show",
		};
		this.init()
	};
	b.CityList.prototype = {
		constructor: b.CityList,
		init: function() {
			this.defLH = 0;
			this.dialog = new a({
				select: this.elem.clLetterShade,
			});
			this.initLetter();
			this.initSearch();
			this.initFixed()
		},
		visibleSearch: function(d) {
			if (d) {
				c(this.elem.clSearch).addClass(this.className.clSearchShow)
			} else {
				c(this.elem.clSearch).removeClass(this.className.clSearchShow)
			}
		},
		initSearch: function() {
			var d = this;
			c(this.elem.clCSearch).on("click", function() {
				d.visibleSearch(true);
				c(d.elem.clSListUl).hide();
				c(d.elem.clSListNone).hide();
				setTimeout(function() {
					c(d.elem.clSearchInput).focus()
				}, 100)
			});
			c(this.elem.clSHCancel).on("click", function() {
				d.visibleSearch(false);
				setTimeout(function() {
					c(d.elem.clSearchInput).val("");
					c(d.elem.clSearchInput).blur()
				}, 100)
			})
		},
		initletterHeight: function() {
			var f = c(this.elem.clLetter).children("li");
			var d = c(window).height() - c(this.elem.clHeader).height() - 80;
			var g = 26;
			if (d > 0 && g > 0) {
				var e = parseInt(d / g * 100) / 100;
				if (this.defLH == e && this.defLH > 0) {
					return
				} else {
					this.defLH = e
				}
				//f.css({
				//height: e + "px",
				//"line-height": e + "px",
				//})
			}
		},
		initLetter: function() {
			var e = this;
			setTimeout(function() {
				e.initletterHeight()
			}, 500);

			function d() {
				c(e.elem.clLetter).find("li." + e.className.clLetterSelect).removeClass(e.className.clLetterSelect)
			}
			c(window).on("scroll", c.proxy(this.initletterHeight, this));
			c(this.elem.clLetter).on("click", "li", function(h) {
				var f = c(this).data("key");
				if (f == "" || f == undefined) {
					return false
				}
				var g = c(e.elem.clContainer).scrollTop();
				d();
				c(window).scrollTop(g + c("#letter-" + f).position().top - 130);
				c(e.elem.clLetterShade).html(f);
				c(this).addClass(e.className.clLetterSelect);
				e.dialog.open();
				setTimeout(function() {
					e.dialog.close();
					//d()
				}, 500)
			})
		},
		initFixed: function() {
			c(window).on("scroll", c.proxy(this.labelFixed, this))
		},
		labelFixed: function() {
			var j = this;
			var h = 130;
			var e = c(window).height();
			var d = c(window).scrollTop();
			var g = c(this.elem.clCLH).children("div");
			if (g.length < 1) {
				return false
			}
			g.removeClass("cl-c-fix");
			for (var f = 0; f < g.length; f++) {
				if (f < g.length - 1) {
					if (d > c(g[f]).offset().top - h && d < c(g[f + 1]).offset().top - h) {
						c(g[f]).addClass("cl-c-fix")
					}
				} else {
					if (d > c(g[f]).offset().top - h) {
						c(g[f]).addClass("cl-c-fix")
					}
				}
			}
		},
	}
})(Zepto, APF.Namespace.register("touch"), touch.component.module.Dialog);