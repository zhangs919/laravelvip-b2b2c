function updateBorders(obj,color) {
	// hexColor表示上次调色板显示的颜色
	var hexColor = "transparent";
	// 如果当前设置颜色，则将颜色设置为当前颜色，否则，如果没有点击确定，则将颜色恢复为上次选择的颜色
	if (color) {
		hexColor = color.toHexString();
	}
	// 如果没有下面这行代码，点击选择器面板时，即使不点击保存，也会造成input框中的值改变
	$("#docs-content").css("border-color", hexColor);
	// 将调色版的颜色放置到input框中
	$(obj).val(hexColor);
}

/**
 * 设置调色板的颜色值
 * 
 * @param obj
 *            this|null
 * @returns
 */
function setPalette(obj) {
	// 颜色值
	var $colorValue = null;
	// 颜色picker容器
	var $colorPicker = null;

	// obj是this对象，为了防止一个页面中有多个picker冲突问题
	// obj也可能是jQuery对象
	if (obj) {
		$colorValue = $(obj);
		$colorPicker = $colorValue.next('input');
	} else {
		$colorValue = $(".color-input-value");
		$colorPicker = $(".colorpicker");
	}
	var colorValue = $colorValue.val();
	// 对input框输入的颜色值进行简单的校验
	// == 4 -> eg. #ccc
	if (colorValue.indexOf('#') == 0 && (colorValue.length == 7 || colorValue.length == 4)) {
		$colorPicker.spectrum("set", $colorValue.val());
		$colorPicker.spectrum("show");
	} else if (colorValue == null || colorValue.length == 0) {
		return;
	} else {
		alert("请输入正确的色值");
	}
}

$(function() {
	$.fn.colorpicker = function(settings) {
		this.each(function() {
			var target = $(this);
			var defaults = {
				color: $(target).val(),
				callback: null,
				show_input: false
			};
			settings = $.extend(true, defaults, settings);

			if(settings.show_input){
				target.before('<input class="color-input-value form-control w120 m-r-5" onblur="setPalette(this)" type="text" value="'+settings.color+'">');
			};
			$(target).spectrum({
				allowEmpty: true,
				color: $(this).val(),
				showInput: true,
				containerClassName: "full-spectrum",
				showInitial: true,
				showPalette: true,
				showSelectionPalette: true,
				showAlpha: false,
				maxPaletteSize: 10,
				preferredFormat: "hex",// 输入框颜色格式,(hex十六进制,hex3十六进制可以的话只显示3位,hsl,rgb三原色,name英文名显示)
				localStorageKey: "spectrum.demo",// 把选择过的颜色存在浏览器上
				// 选择器右边面板移动时触发
				move: function(color) {

				},
				// 选择器面板显示时触发
				show: function() {
				},
				// 选择器面板显示之前触发,返回false时不显示
				beforeShow: function() {

				},
				// 关闭面板或点击选择按钮,颜色变化时触发
				change: function() {
					var color = $(target).spectrum("get");
					
					if(settings.show_input){
						 updateBorders(target.prev('input'),color)
					}
					if ($.isFunction(settings.callback)) {
						settings.callback.call(this, color);
					}
				},
				// 选择器面板隐藏时触发
				hide: function(color) {
					if ($.isFunction(settings.callback)) {
						settings.callback.call(this, color);
					}
				},
				// 调色选择器面板显示的颜色
				palette: [["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)", "rgb(153, 153, 153)", "rgb(183, 183, 183)", "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(239, 239, 239)", "rgb(243, 243, 243)", "rgb(255, 255, 255)"], ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)", "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"], ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)", "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)", "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)", "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)", "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)", "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)", "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)", "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)", "rgb(133, 32, 12)", "rgb(153, 0, 0)", "rgb(180, 95, 6)", "rgb(191, 144, 0)", "rgb(56, 118, 29)", "rgb(19, 79, 92)", "rgb(17, 85, 204)", "rgb(11, 83, 148)", "rgb(53, 28, 117)", "rgb(116, 27, 71)", "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)", "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]]
			});
		});
	}
});

/*
$(function() {
	var cvlaue = $(".colorpicker").val();
	$(".color-input-value").val(cvlaue);

	$(".colorpicker").spectrum({
		allowEmpty: true,
		color: cvlaue,
		showInput: true,
		containerClassName: "full-spectrum",
		showInitial: true,
		showPalette: true,
		showSelectionPalette: true,
		showAlpha: false,
		maxPaletteSize: 10,
		preferredFormat: "hex",// 输入框颜色格式,(hex十六进制,hex3十六进制可以的话只显示3位,hsl,rgb三原色,name英文名显示)
		localStorageKey: "spectrum.demo",// 把选择过的颜色存在浏览器上
		// 选择器右边面板移动时触发
		move: function(color) {
			updateBorders(color);
		},
		// 选择器面板显示时触发
		show: function() {

		},
		// 选择器面板显示之前触发,返回false时不显示
		beforeShow: function() {

		},
		// 关闭面板或点击选择按钮,颜色变化时触发
		change: function() {

		},
		// 选择器面板隐藏时触发
		hide: function(color) {
			updateBorders(color);
		},
		// 调色选择器面板显示的颜色
		palette: [["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)", "rgb(153, 153, 153)", "rgb(183, 183, 183)", "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(239, 239, 239)", "rgb(243, 243, 243)", "rgb(255, 255, 255)"], ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)", "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"], ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)", "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)", "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)", "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)", "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)", "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)", "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)", "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)", "rgb(133, 32, 12)", "rgb(153, 0, 0)", "rgb(180, 95, 6)", "rgb(191, 144, 0)", "rgb(56, 118, 29)", "rgb(19, 79, 92)", "rgb(17, 85, 204)", "rgb(11, 83, 148)", "rgb(53, 28, 117)", "rgb(116, 27, 71)", "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)", "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]]
	});

	$("#hideButtons").spectrum({
		showButtons: false,
		change: updateBorders
	});

	var isDisabled = true;
	$("#toggle-disabled").click(function() {
		if (isDisabled) {
			$("#disabled").spectrum("enable");
		} else {
			$("#disabled").spectrum("disable");
		}
		isDisabled = !isDisabled;
		return false;
	});

	$("#disabled").spectrum({
		disabled: true
	});

	$("#pick1").spectrum({
		flat: true,
		change: function(color) {
			var hsv = color.toHsv();
			var rgb = color.toRgbString();
			var hex = color.toHexString();
			// console.log("callback",color.toHslString(), color.toHsl().h,
			// color.toHsl().s, color.toHsl().l)
			$("#docs-content").css({
				'background-color': color.toRgbString()
			}).toggleClass("dark", hsv.v < .5);
			$("#switch-current-rgb").text(rgb);
			$("#switch-current-hex").text(hex);
		},
		show: function() {

		},
		hide: function() {

		},
		showInput: true,
		showPalette: true,
		palette: ['white', '#306', '#c5c88d', '#ac5c5c', '#344660']
	});

	$("#collapsed").spectrum({
		color: "#dd3333",
		change: updateBorders,
		show: function() {

		},
		hide: function() {

		}
	});

	$("#flat").spectrum({
		flat: true,
		showInput: true,
		move: updateBorders
	});

	$("#flatClearable").spectrum({
		flat: true,
		move: updateBorders,
		change: updateBorders,
		allowEmpty: true,
		showInput: true
	});

	$("#showInput").spectrum({
		color: "#dd33dd",
		showInput: true,
		change: updateBorders,
		show: function() {

		},
		hide: function() {

		}
	});

	$("#showAlpha").spectrum({
		color: "rgba(255, 128, 0, .5)",
		showAlpha: true,
		change: updateBorders
	});

	$("#showAlphaWithInput").spectrum({
		color: "rgba(255, 128, 0, .5)",
		showAlpha: true,
		showInput: true,
		showPalette: true,
		palette: [["rgba(255, 128, 0, .9)", "rgba(255, 128, 0, .5)"], ["red", "green", "blue"], ["hsla(25, 50, 75, .5)", "rgba(100, .5, .5, .8)"]],
		change: updateBorders
	});

	$("#showAlphaWithInputAndEmpty").spectrum({
		color: "rgba(255, 128, 0, .5)",
		allowEmpty: true,
		showAlpha: true,
		showInput: true,
		showPalette: true,
		palette: [["rgba(255, 128, 0, .9)", "rgba(255, 128, 0, .5)"], ["red", "green", "blue"], ["hsla(25, 50, 75, .5)", "rgba(100, .5, .5, .8)"]],
		change: updateBorders
	});

	$("#showInputWithClear").spectrum({
		allowEmpty: true,
		color: "",
		showInput: true,
		change: updateBorders,
		show: function() {

		},
		hide: function() {

		}
	});

	$("#openWithLink").spectrum({
		color: "#dd3333",
		change: updateBorders,
		show: function() {

		},
		hide: function() {

		}
	});

	$("#className").spectrum({
		className: 'awesome'
	});

	$("#replacerClassName").spectrum({
		replacerClassName: 'awesome'
	});

	$("#containerClassName").spectrum({
		containerClassName: 'awesome'
	});

	$("#showPalette").spectrum({
		showPalette: true,
		palette: [['black', 'white', 'blanchedalmond'], ['rgb(255, 128, 0);', 'hsv 100 70 50', 'lightyellow']],
		change: updateBorders
	});

	var textPalette = ["rgb(255, 255, 255)", "rgb(204, 204, 204)", "rgb(192, 192, 192)", "rgb(153, 153, 153)", "rgb(102, 102, 102)", "rgb(51, 51, 51)", "rgb(0, 0, 0)", "rgb(255, 204, 204)", "rgb(255, 102, 102)", "rgb(255, 0, 0)", "rgb(204, 0, 0)", "rgb(153, 0, 0)", "rgb(102, 0, 0)", "rgb(51, 0, 0)", "rgb(255, 204, 153)", "rgb(255, 153, 102)", "rgb(255, 153, 0)", "rgb(255, 102, 0)", "rgb(204, 102, 0)", "rgb(153, 51, 0)", "rgb(102, 51, 0)", "rgb(255, 255, 153)", "rgb(255, 255, 102)", "rgb(255, 204, 102)", "rgb(255, 204, 51)", "rgb(204, 153, 51)", "rgb(153, 102, 51)", "rgb(102, 51, 51)", "rgb(255, 255, 204)", "rgb(255, 255, 51)", "rgb(255, 255, 0)", "rgb(255, 204, 0)", "rgb(153, 153, 0)", "rgb(102, 102, 0)", "rgb(51, 51, 0)", "rgb(153, 255, 153)", "rgb(102, 255, 153)", "rgb(51, 255, 51)", "rgb(51, 204, 0)", "rgb(0, 153, 0)", "rgb(0, 102, 0)", "rgb(0, 51, 0)", "rgb(153, 255, 255)", "rgb(51, 255, 255)", "rgb(102, 204, 204)", "rgb(0, 204, 204)", "rgb(51, 153, 153)", "rgb(51, 102, 102)", "rgb(0, 51, 51)", "rgb(204, 255, 255)", "rgb(102, 255, 255)", "rgb(51, 204, 255)", "rgb(51, 102, 255)", "rgb(51, 51, 255)", "rgb(0, 0, 153)", "rgb(0, 0, 102)", "rgb(204, 204, 255)", "rgb(153, 153, 255)", "rgb(102, 102, 204)", "rgb(102, 51, 255)", "rgb(102, 0, 204)", "rgb(51, 51, 153)", "rgb(51, 0, 153)", "rgb(255, 204, 255)", "rgb(255, 153, 255)", "rgb(204, 102, 204)", "rgb(204, 51, 204)", "rgb(153, 51, 153)", "rgb(102, 51, 102)", "rgb(51, 0, 51)"];

	$("#showPaletteOnly").spectrum({
		color: 'blanchedalmond',
		showPaletteOnly: true,
		showPalette: true,
		palette: [['black', 'white', 'blanchedalmond', 'rgb(255, 128, 0);', 'hsv 100 70 50'], ['red', 'yellow', 'green', 'blue', 'violet']]
	});

	$("#clickoutFiresChange").spectrum({
		clickoutFiresChange: true,
		change: updateBorders
	});

	$("#clickoutDoesntFireChange").spectrum({
		change: updateBorders
	});

	$("#showInitial").spectrum({
		showInitial: true
	});

	$("#showInputAndInitial").spectrum({
		showInitial: true,
		showInput: true
	});

	$("#showInputInitialClear").spectrum({
		allowEmpty: true,
		showInitial: true,
		showInput: true
	});

	$("#changeOnMove").spectrum({
		move: function(c) {
			var label = $("#changeOnMoveLabel");
			label.text("Move called: " + c.toHexString());
		}
	});
	$("#changeOnMoveNo").spectrum({
		showInput: true,
		change: function(c) {
			var label = $("#changeOnMoveNoLabel");
			label.text("Change called: " + c.toHexString());
		}
	});

	function prettyTime() {
		var date = new Date();

		return date.toLocaleTimeString();
	}

	$("#eventshow").spectrum({
		show: function(c) {
			var label = $("#eventshowLabel");
			label.text("show called at " + prettyTime() + " (color is " + c.toHexString() + ")");
		}
	});

	$("#eventhide").spectrum({
		hide: function(c) {
			var label = $("#eventhideLabel");
			label.text("hide called at " + prettyTime() + " (color is " + c.toHexString() + ")");
		}
	});

	$("#eventdragstart").spectrum({
		showAlpha: true
	}).on("dragstart.spectrum", function(e, c) {
		var label = $("#eventdragstartLabel");
		label.text("dragstart called at " + prettyTime() + " (color is " + c.toHexString() + ")");
	});

	$("#eventdragstop").spectrum({
		showAlpha: true
	}).on("dragstop.spectrum", function(e, c) {
		var label = $("#eventdragstopLabel");
		label.text("dragstop called at " + prettyTime() + " (color is " + c.toHexString() + ")");
	});

	$(".basic").spectrum({
		change: updateBorders
	});
	$(".override").spectrum({
		color: "yellow",
		change: updateBorders
	});

	$(".startEmpty").spectrum({
		allowEmpty: true,
		change: updateBorders
	});

	$("#beforeShow").spectrum({
		beforeShow: function() {
			return false;
		}
	});

	$("#custom").spectrum({
		color: "#f00"
	});

	$("#buttonText").spectrum({
		allowEmpty: true,
		chooseText: "Alright",
		cancelText: "No way"
	});

	$("#showSelectionPalette").spectrum({
		showPalette: true,
		showSelectionPalette: true, // true by default
		palette: []
	});
	$("#showSelectionPaletteStorage").spectrum({
		showPalette: true,
		localStorageKey: "spectrum.homepage", // Any picker with the same
		// string will share selection
		showSelectionPalette: true,
		palette: []
	});
	$("#showSelectionPaletteStorage2").spectrum({
		showPalette: true,
		localStorageKey: "spectrum.homepage", // Any picker with the same
		// string will share selection
		showSelectionPalette: true,
		palette: []
	});

	$("#preferredHex").spectrum({
		preferredFormat: "hex",
		showInput: true,
		showPalette: true,
		palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]
	});
	$("#preferredHex3").spectrum({
		preferredFormat: "hex3",
		showInput: true,
		showPalette: true,
		palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]
	});
	$("#preferredHsl").spectrum({
		preferredFormat: "hsl",
		showInput: true,
		showPalette: true,
		palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]
	});
	$("#preferredRgb").spectrum({
		preferredFormat: "rgb",
		showInput: true,
		showPalette: true,
		palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]
	});
	$("#preferredName").spectrum({
		preferredFormat: "name",
		showInput: true,
		showPalette: true,
		palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]
	});
	$("#preferredNone").spectrum({
		showInput: true,
		showPalette: true,
		palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]
	});

	$("#triggerSet").spectrum({
		change: updateBorders
	});

	// Show the original input to demonstrate the value changing when calling
	// `set`
	$("#triggerSet").show();

	$("#btnEnterAColor").click(function() {
		$("#triggerSet").spectrum("set", $("#enterAColor").val());
	});

	$("#toggle").spectrum();
	$("#btn-toggle").click(function() {
		$("#toggle").spectrum("toggle");
		return false;
	});

	// $('#toc').toc({
	// 'selectors': 'h2,h3', //elements to use as headings
	// 'container': '#docs', //element to find all selectors in
	// 'smoothScrolling': true, //enable or disable smooth scrolling on click
	// 'prefix': 'toc', //prefix for anchor tags and class names
	// 'highlightOnScroll': true, //add class to heading that is currently in
	// focus
	// 'highlightOffset': 100, //offset to trigger the next headline
	// 'anchorName': function(i, heading, prefix) { //custom function for anchor
	// name
	// return heading.id || prefix+i;
	// }
	// });

	// prettyPrint();
}); 
*/
