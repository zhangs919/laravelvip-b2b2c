/**
 * 坐标获取 调用高德接口 返回火星坐标
 * 
 */
(function($) {

	var resolve_data = null;
	var reject_data = null;

	// 判断是否为微信
	function isWeiXin() {
		var ua = window.navigator.userAgent.toLowerCase();
		if (ua.match(/MicroMessenger/i) == 'micromessenger') {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 高德定位
	 * @param settings
	 * @returns {Promise<unknown>}
	 */
	function geolocation_amap(settings) {

		var promise = new Promise(function(resolve, reject){
			// 解析定位结果
			function successCallback(result) {

				if(!result.position) {
					console.error("高德定位失败", result);
				}

				var data = {
					lat: result.position.getLat(),
					lng: result.position.getLng(),
				};

				if(result.addressComponent) {
					data.citycode = result.addressComponent.citycode;
					data.province = result.addressComponent.province;
					data.city = result.addressComponent.city;
					data.district = result.addressComponent.district;
					data.township = result.addressComponent.township;
					data.street = result.addressComponent.street;
					data.streetNumber = result.addressComponent.streetNumber;
					data.formattedAddress = result.formattedAddress;

					var region_code = result.addressComponent.adcode;

					var codes = [];
					for (var i = 0; i < region_code.length; i = i + 2) {
						codes.push(region_code.charAt(i) + "" + region_code.charAt(i + 1));

						if (codes.length == 3) {
							break;
						}
					}

					data.region_code = codes.join(",");
				}

				if(data.lat && data.lng) {
					// 坐标存储在session中
					sessionStorage.geolocation = JSON.stringify(data);
					document.cookie = "lat=" + data.lat + ";path=/";
					document.cookie = "lng=" + data.lng + ";path=/";
				}

				if(data.region_code) {
					document.cookie = "region_code=" + data.region_code + ";path=/";
				}

				if ($.isFunction(settings.callback)) {
					settings.callback.call(settings, data);
				}

				// 记录成功数据
				resolve_data = data;

				// 正常
				resolve(data);
			}
			// 解析定位错误信息
			function errorCallback(error) {
				console.info(error);
				if ($.isFunction(settings.callback)) {
					settings.callback.call(settings, []);
				}

				// 记录失败数据
				reject_data = error;

				// 错误
				reject(error);
			}

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
		});

		return promise;
	}

	/**
	 * 微信定位
	 * @param settings
	 * @returns {Promise<unknown>}
	 */
	function geolocation_weixin(settings) {

		var promise = new Promise(function(resolve, reject){
			// 获取微信信息
			var url = location.href.split('#')[0];
			var gloading = false;
			if (url.indexOf("mkt.") >= 0) {
				geolocation_amap(settings).then(function(data){
					// 记录数据
					resolve_data = data;
					resolve(data);
				}).catch(function (res){
					// 记录数据
					reject_data = res;
					reject(res);
				});
				return;
			}
			var defaults = {
				// 提交的数据
				data: {},
				// 返回的数据
				callback: null
			};
			settings = $.extend(true, defaults, settings);

			var success = function(result) {
				if (result.code == 0) {
					wx.config({
						debug: false,
						appId: result.data.appId,
						timestamp: result.data.timestamp,
						nonceStr: result.data.nonceStr,
						signature: result.data.signature,
						jsApiList: [
							// 所有要调用的 API 都要加到这个列表中
							"getLocation"
						]
					});
					wx.ready(function() {
						if (gloading == true) {
							// 进行中
							reject(null);
							return;
						}

						gloading = true;

						wx.getLocation({
							type: 'gcj02', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
							success: function(res) {
								var latitude = res.latitude; // 纬度，浮点数，范围为90
								// ~ -90
								var longitude = res.longitude; // 经度，浮点数，范围为180

								// 先存储
								document.cookie = "lat=" + latitude + ";path=/";
								document.cookie = "lng=" + longitude + ";path=/";

								// ~
								// -180。
								var speed = res.speed; // 速度，以米/每秒计
								var accuracy = res.accuracy; // 位置精度
								gloading = false;
								$.get('/site/region-gps', {
									'lat': latitude,
									'lng': longitude
								}, function(result) {

									if(result.code != 0) {
										$.msg(result.message);
										// 错误
										reject(result);
										return;
									}

									var data = {
										lat: latitude,
										lng: longitude,
										region_code: result.data.region_code,
										citycode: result.data.citycode,
										province: result.data.province,
										city: result.data.city,
										district: result.data.district,
										township: result.data.township,
										street: result.data.street,
										streetNumber: result.data.streetNumber,
										formattedAddress: result.data.formattedAddress
									}
									// 坐标存储在session中
									sessionStorage.geolocation = JSON.stringify(data);

									document.cookie = "lat=" + data.lat + ";path=/";
									document.cookie = "lng=" + data.lng + ";path=/";
									document.cookie = "region_code=" + data.region_code + ";path=/";

									if ($.isFunction(settings.callback)) {
										settings.callback.call(settings, data);
									}

									// 记录成功数据
									resolve_data = data;

									// 正常
									resolve(data);
								}, 'JSON');
							},
							fail: function(res) {
								gloading = false;
								console.info('微信定位失败，使用高德定位', res);
								geolocation_amap(settings).then(function(data){
									// 记录数据
									resolve_data = data;
									resolve(data);
								}).catch(function (res){
									// 记录数据
									reject_data = res;
									reject(res);
								});
							},
							cancel: function(res) {
								gloading = false;
								if ($.isFunction(settings.callback)) {
									settings.callback.call(settings, []);
								}
								console.info('用户拒绝授权获取地理位置', res);
								// 记录数据
								reject_data = res;
								// 错误
								reject(res);
							}
						});
					});
				} else {
					geolocation_amap(settings).then(function(data){
						// 记录数据
						resolve_data = data;
						resolve(data);
					}).catch(function (res){
						// 记录数据
						reject_data = res;
						reject(res);
					});
				}
			};

			$.post('/index/information/get-weixinconfig.html', {
				url: url
			}, success, 'JSON').catch(function(res){
				// 记录数据
				reject_data = res;
				reject(res);
			})
		});

		return promise;
	}

	var geolocationLoaded = false;
	var is_inxpark = window.location.href.indexOf("inxpark.com") != -1;

	$.geolocationQueue = function(settings) {

		// 是否必须获取定位
		settings.required = !!settings.required;

		var queueName = 'geolocation';
		$("body").queue(queueName, function(next) {

			if (sessionStorage.geolocation) {
				var data = $.parseJSON(sessionStorage.geolocation);
				if(data) {
					document.cookie = "lat=" + data.lat + ";path=/";
					document.cookie = "lng=" + data.lng + ";path=/";
					document.cookie = "region_code=" + data.region_code + ";path=/";
					if (settings && $.isFunction(settings.callback)) {
						settings.callback.call(settings, data);
					}
					next();
					return;
				}
			}
			var promise = null;

			// 如果必须要求定位则检查是否已获取到定位数据，未获取到则认为需要重新加载
			if(settings.required && resolve_data == null) {
				geolocationLoaded = false;
				sessionStorage.geolocationLoaded = 0;
			}

			// 会话期间仅打开一次位置授权
			if(geolocationLoaded || (is_inxpark && sessionStorage.geolocationLoaded == 1)) {
				console.log("$.geolocationQueue 已执行过...");
				promise = new Promise(function(resolve, reject){
					if(resolve_data) {
						resolve(resolve_data);
					}else{
						reject(reject_data);
					}
				});
			}
			// 标记是否执行过了
			geolocationLoaded = true;
			sessionStorage.geolocationLoaded = 1;

			if(promise == null) {
				if (isWeiXin()) {
					promise = geolocation_weixin(settings);
				} else {
					promise = geolocation_amap(settings);
				}
			}

			if(promise) {
				promise.then(function () {
					next();
				}).catch(function (res) {
					if (settings && $.isFunction(settings.error_callback)) {
						settings.error_callback.call(settings, res);
					}
					next();
				});
			}
		});
		$("body").dequeue(queueName);
	}

	$.geolocation = $.geolocationQueue;
})(jQuery);