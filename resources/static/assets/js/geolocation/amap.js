/**
 * 坐标获取 调用高德接口 返回火星坐标
 *
 */
(function($) {
	$.geolocation = function(settings) {
		var map, geolocation;
		// 加载地图，调用浏览器定位服务
		var defaults = {
			// 提交的数据
			data: {},
			// 返回的数据
			callback: null
		};
		settings = $.extend(true, defaults, settings);
		map = new AMap.Map('container', {
			resizeEnable: true
		});
		map.plugin('AMap.Geolocation', function() {
			geolocation = new AMap.Geolocation({
				enableHighAccuracy: true,// 是否使用高精度定位，默认:true
				timeout: 10000, // 超过10秒后停止定位，默认：无穷大
				buttonOffset: new AMap.Pixel(10, 20),// 定位按钮与设置的停靠位置的偏移量，默认：Pixel(10,
				// 20)
				zoomToAccuracy: false, // 定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
			});
			map.addControl(geolocation);
			geolocation.getCurrentPosition();
			AMap.event.addListener(geolocation, 'complete', successCallback);// 返回定位信息
			AMap.event.addListener(geolocation, 'error', errorCallback); // 返回定位出错信息
		});

		// 解析定位结果
		function successCallback(data) {
			var region_code = data.addressComponent.adcode;
			var codes = [];
			for (var i = 0; i < region_code.length; i = i + 2) {
				codes.push(region_code.charAt(i) + "" + region_code.charAt(i + 1));

				if (codes.length == 3) {
					break;
				}
			}
			region_code = codes.join(",");

			data = {
				lat: data.position.getLat(),
				lng: data.position.getLng(),
				region_code: region_code,
			}
			// 坐标存储在session中
			sessionStorage.geolocation = JSON.stringify(data);

			if ($.isFunction(settings.callback)) {
				settings.callback.call(settings, data);
			}
		}
		// 解析定位错误信息

		function errorCallback(error) {
			//$.msg("无法获取位置信息，请检查定位权限是否开启");
			if ($.isFunction(settings.callback)) {
				settings.callback.call(settings, []);
			}
		}
	}

})(jQuery);