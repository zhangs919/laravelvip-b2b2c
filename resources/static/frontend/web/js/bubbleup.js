(function(a) {
	a.fn.bubbleup = function(b) {
		b = a.extend({
			tooltip: false,
			scale: 120,
			fontFamily: "Helvetica, Arial, sans-serif",
			color: "#333333",
			fontSize: 12,
			fontWeight: "bold",
			inSpeed: "fast",
			outSpeed: "fast"
		}, b);
		return this.each(function() {
			a.fn.bubbleup.runing(a(this), b)
		})
	};
	a.fn.bubbleup.runing = function(d, b) {
		var c = d.width();
		d.mouseover(function() {
			if (b.tooltip) {
				tip = a("<div>" + a(this).attr("alt") + "</div>").css({
					fontFamily: b.fontFamily,
					color: b.color,
					fontSize: b.fontSize,
					fontWeight: b.fontWeight,
					position: "absolute",
					zIndex: 100000
				}).remove().css({
					top: 0,
					left: 0,
					visibility: "hidden",
					display: "block"
				}).appendTo(document.body);
				var e = a.extend({}, d.offset(), {
					width: this.offsetWidth,
					height: this.offsetHeight
				});
				var f = tip[0].offsetWidth;
				var g = tip[0].offsetHeight;
				tip.stop().css({
					top: e.top - g,
					left: e.left + e.width / 2 - f / 2,
					visibility: "visible"
				}).animate({
					top: "-=" + (b.scale / 2 - c / 2)
				}, b.inSpeed)
			}
			d.closest("li").css({
				"z-index": 100000
			});
			d.stop().css({
				"z-index": 100000,
				top: 0,
				left: 0,
				width: c
			}).animate({
				left: -b.scale / 2 + c / 2,
				top: -b.scale / 2 + c / 2,
				width: b.scale
			}, b.inSpeed)
		}).mouseout(function() {
			d.closest("li").css({
				"z-index": 100
			});
			d.closest("li").next().css({
				"z-index": 0
			});
			d.closest("li").next().css({
				"z-index": 0
			});
			d.closest("li").next().children("img").css({
				"z-index": 0
			});
			if (b.tooltip) {
				tip.remove()
			}
			d.stop().animate({
				left: 0,
				top: 0,
				width: c
			}, b.outSpeed, function() {
				d.css({
					"z-index": 0
				})
			})
		})
	}
})(jQuery);