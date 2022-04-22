(function(f) {
	var d;
	f.fn.acts_as_tree_table = function(h) {
		d = f.extend({}, f.fn.acts_as_tree_table.defaults, h);
		return this.each(function() {
			var i = f(this);
			i.addClass("acts_as_tree_table");
			i.children("tbody").children("tbody tr").each(function() {
				var j = f(this);
				if (j.not(".parent") && c(j).size() >= 0) {
					j.addClass("parent")
				}
				if (j.is(".parent")) {
					b(j)
				}
			})
		})
	};
	f.fn.acts_as_tree_table.defaults = {
		expandable: true,
		default_state: "expanded",
		indent: 20,
		tree_column: 0
	};
	f.fn.collapse = function() {
		g(this)
	};
	f.fn.expand = function() {
		e(this)
	};
	f.fn.toggleBranch = function() {
		a(this)
	};

	function c(h) {
		return f("tr.child-of-" + h[0].id)
	}
	function g(h) {
		c(h).each(function() {
			var i = f(this);
			g(i);
			i.hide()
		})
	}
	function e(h) {
		c(h).each(function() {
			var i = f(this);
			if (i.is(".expanded.parent")) {
				e(i)
			}
			i.show()
		})
	}
	function b(i) {
		var h = f(i.children("td")[d.tree_column]);
		var j = parseInt(h.css("padding-left")) + d.indent;
		c(i).each(function() {
			f(f(this).children("td")[d.tree_column]).css("padding-left", j + "px")
		});
		if (d.expandable) {
			h.prepend('<span style="margin-left:0px; padding-left: ' + d.indent + 'px" class="expander"></span>');
			var k = f(h[0].firstChild);
			k.click(function() {
				a(i)
			});
			if (!(i.is(".expanded") || i.is(".collapsed"))) {
				i.addClass(d.default_state)
			}
			if (i.is(".collapsed")) {
				g(i)
			} else {
				if (i.is(".expanded")) {
					e(i)
				}
			}
		}
	}
	function a(h) {
		if (h.is(".collapsed")) {
			h.removeClass("collapsed");
			h.addClass("expanded");
			e(h)
		} else {
			h.removeClass("expanded");
			h.addClass("collapsed");
			g(h)
		}
	}
})(jQuery);
$(function() {
	$(".treeTable").each(function() {
		var b = true;
		var a = "expanded";
		if ($(this).attr("expandable") == "false") {
			b = false
		}
		if ($(this).attr("initState") == "collapsed") {
			a = "collapsed"
		}
		$(this).acts_as_tree_table({
			expandable: b,
			default_state: a
		})
	})
});