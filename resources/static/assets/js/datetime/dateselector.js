/*
时间选择控件，开始时间是1900年结束时间是今年
 */
(function($) {
	$.extend({
		dateselector: function(options) {
			var defaults = {
				yearselector: "#sel_year",
				monthselector: "#sel_month",
				dayselector: "#sel_day",
				firsttext: "请选择",
				firstvalue: 0,
				end: new Date().getFullYear() + "-" + new Date().getMonth() + 1 + "-" + new Date().getDate(),
				defaulttime: "1900-01-01",
				sel_unix: "#sel_unix" //前台隐藏域中的Unix时间戳
			};

			var opts = $.extend({}, defaults, options);
			var $yearselector = $(opts.yearselector);
			var $monthselector = $(opts.monthselector);
			var $dayselector = $(opts.dayselector);
			var end = opts.end;
			var firsttext = opts.firsttext;
			var firstvalue = opts.firstvalue;
			var defaulttime = opts.defaulttime;
			var $sel_unix = $(opts.sel_unix);

			// 初始化
			var str = "<option value=\"" + firstvalue + "\">" + firsttext + "</option>";
			$yearselector.html(str);
			$monthselector.html(str);
			$dayselector.html(str);

			var endarr = end.split('-');// 截取传过来的结束时间
			var endyear = endarr[0];
			var endmonth = endarr[1];
			var endday = endarr[2];

			var defaulttimearr = defaulttime.split('-');// 截取传过来的默认时间
			var defaulttimeyear = defaulttimearr[0];
			var defaulttimemonth = defaulttimearr[1];
			var defaulttimeday = defaulttimearr[2];

			// 年份列表
			var yearnow = new Date().getFullYear();
			var yearsel = defaulttimeyear;
			for (var i = yearnow; i >= 1900; i--) {
				var sed = yearsel == i ? "selected" : "";
				var yearstr = "<option value=\"" + i + "\" " + sed + ">" + i + "</option>";
				$yearselector.append(yearstr);
			}

			// 月列表(仅当选择了年)
			function buildmonth() {
				if ($yearselector.val() == 0) {
					// 未选择年份或者月份
					$monthselector.html(str);
					$dayselector.html(str);
				} else {

					$monthselector.html(str);
					$dayselector.html(str);
					var year = parseInt($yearselector.val());
					var month = 0;
					var daycount = 0;

					var monthsel = defaulttimemonth;
					for (var i = 1; i <= 12; i++) {
						var sed = monthsel == i ? "selected" : "";
						if (year == endyear) {
							if (i > endmonth) {
								var monthstr = "<option value=\"" + i + "\" " + sed + " disabled =\'true'>" + i + "</option>";
							} else {
								var monthstr = "<option value=\"" + i + "\" " + sed + ">" + i + "</option>";
							}

						} else {
							var monthstr = "<option value=\"" + i + "\" " + sed + ">" + i + "</option>";
						}

						$monthselector.append(monthstr);
					}
				}
			}

			// 日列表(仅当选择了年月)
			function buildday() {
				if ($yearselector.val() == 0 || $monthselector.val() == 0) {
					// 未选择年份或者月份
					$dayselector.html(str);
				} else {
					$dayselector.html(str);
					var year = parseInt($yearselector.val());
					var month = parseInt($monthselector.val());
					var daycount = 0;
					switch (month) {
						case 1:
						case 3:
						case 5:
						case 7:
						case 8:
						case 10:
						case 12:
							daycount = 31;
							break;
						case 4:
						case 6:
						case 9:
						case 11:
							daycount = 30;
							break;
						case 2:
							daycount = 28;
							if ((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0)) {
								daycount = 29;
							}
							break;
						default:
							break;
					}

					var daysel = defaulttimeday;
					for (var i = 1; i <= daycount; i++) {
						var sed = daysel == i ? "selected" : "";

						if (year == endyear && month == endmonth) {
							if (i > endday) {
								var daystr = "<option value=\"" + i + "\" " + sed + " disabled =\'true'>" + i + "</option>";
							} else {
								var daystr = "<option value=\"" + i + "\" " + sed + ">" + i + "</option>";
							}

						} else {
							var daystr = "<option value=\"" + i + "\" " + sed + ">" + i + "</option>";
						}

						$dayselector.append(daystr);
					}
				}
			}
			$dayselector.change(function(){
				var str = $yearselector.val()+"/"+$monthselector.val()+"/"+$dayselector.val();
				var dt = new Date(str);
				$sel_unix.val(dt.getTime()/1000);
			});
			$monthselector.change(function() {

				defaulttimeday = 0;
				buildday();
			});
			$yearselector.change(function() {
				defaulttimemonth = 0;
				defaulttimeday = 0;
				buildmonth();

			});
			buildmonth();
			buildday();
		}
	});
})(jQuery);