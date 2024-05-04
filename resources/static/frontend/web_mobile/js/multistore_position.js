/**
 * 多门店微信端前台定位相关方法
 * 
 * 支持的js文件amap.js,jquery.js
 */
(function($) {
	$.multiposition = {
		// 定位获取到的信息
		postion_data: {},
		// 初始定位信息
		load: function(callback) {
			if (sessionStorage.geolocation) {
				// console.log('a');
				$.multiposition.postion_data = $.parseJSON(sessionStorage.geolocation);
				if ($.isFunction(callback)) {
					callback.call(this, this.postion_data);
				}
			} else {
				// console.log('b');
				$.geolocation({
					callback: function(data) {
						this.postion_data = data
						if ($.isFunction(callback)) {
							callback.call(this, this.postion_data);
						}
					}
				});
			}
		},
		// 获取定位的信息
		getPostionData: function(callback) {
			if ($.isEmptyObject(this.postion_data)) {
				// console.log('4');
				$.multiposition.load();
			}
			return this.postion_data;
		},
		// 异步ajax获取最近的门店地址
		goNearStore: function(data, callback) {

			if ($.isPlainObject(data)) {
				if (typeof (shop_id) != 'undefined') {
					data.shop_id = shop_id;
				}
				$.post("/shop/multistore/near-one-store.html", data, function(result) {

					if ($.isFunction(callback) && result.code == 0) {
						callback.call(this, result)
					}

				}, 'json')

			} else {
				console.log('传入参数必须为lat,lng坐标属性对象');
			}

		},
		// 设置切换的城市信息,浏览器关闭后，自动清除
		setSelectCityInfo: function(city_info, callback) {
			if ($.isPlainObject(city_info)) {

				sessionStorage.setItem('select_city_info', JSON.stringify(city_info));
				if ($.isFunction(callback)) {
					callback.call();
				}
			} else {
				console.log('切换城市，请输入城市的code和name属性的对象!');
			}

		},
		// 获取城市信息
		getSelectCityInfo: function() {
			var city_info = sessionStorage.getItem('select_city_info');
			if (city_info) {
				return $.parseJSON(city_info);
			} else {
				var position_data = this.getPostionData();
				var region_code = position_data.region_code ? position_data.region_code : '';
				return {
					code: region_code.split(",", 2).join(","),
					name: position_data.city
				};
			}
		},
		// 设置切换位置信息
		setSelectLoctionInfo: function(location_info, callback) {
			if ($.isPlainObject(location_info)) {

				sessionStorage.setItem('select_location_info', JSON.stringify(location_info));
				$.multiposition.setVisitStoreInfo(location_info);
				if ($.isFunction(callback)) {
					callback.call();
				}
			} else {
				console.log('切换位置，请输入位置所在的code,lat,lng属性的对象!');
			}
		},
		// 获取城市信息
		getSelectLoctionInfo: function() {
			var location_info = sessionStorage.getItem('select_location_info');
			if (location_info) {
				return $.parseJSON(location_info);
			} else {
				var position_data = this.getPostionData();
				var region_code = position_data.region_code ? position_data.region_code : '';
				var city_code = '';
				if(region_code) {
					city_code = region_code.split(",", 2).join(",")
				}
				return {
					city_code: city_code,
					lat: this.getPostionData().lat,
					lng: this.getPostionData().lng,
					address: this.getPostionData().formattedAddress
				};
			}
		},
		// 设置选择的门店信息保存到cookie中,及cookie保存时所需要的配置信息
		setSelectStoreInfo: function(store_info, cookie_setting, callback) {

			if ($.isPlainObject(store_info)) {
				var defaults = {
					path: '/',
					expires: 365,
				};
				cookie_setting = $.extend(true, defaults, cookie_setting);
				$.cookie('store_info_' + store_info.shop_id, JSON.stringify(store_info), cookie_setting);
				if ($.isFunction(callback)) {
					callback.call();
				}
			} else {
				console.log('请传入选择的门店信息，比如包括门店的域名地址stor_url属性的对象!');
			}
		},
		// 获取cookie中的门店信息
		getSelectStoreInfo: function(shop_id) {
			if (typeof ($.cookie('store_info_' + shop_id)) == "undefined") {
				return false;
			}
			return $.parseJSON($.cookie('store_info_' + shop_id));
		},
		// 记录当前要访问的门店url
		setGoStoreUrl: function($go_store_url, shop_id, cookie_setting, callback) {
			var defaults = {
				path: '/',
			};
			cookie_setting = $.extend(true, defaults, cookie_setting);
			$.cookie('go_store_url_' + shop_id, $go_store_url, cookie_setting);
			if ($.isFunction(callback)) {
				callback.call();
			}
		},
		// 是否已经定位过门店url
		getGoStoreUrl: function(shop_id) {
			if (typeof ($.cookie('go_store_url_' + shop_id)) == "undefined") {
				// 没有定位选择过url
				return false;
			}
			return $.cookie('go_store_url_' + shop_id);
		},
		// 记录浏览记录:地址
		setVisitStoreInfo: function(visit_store_info) {
			if (!window.localStorage) {
				console.log('浏览器不支持localstorage');
			} else {
				var storage = window.localStorage;
				// console.log('保存浏览记录111');
				// var save_visit_info = JSON.stringify(visit_store_info);
				var store_list = $.multiposition.getVisitStoreInfo();
				var is_insert = true;
				if (store_list.length > 0) {
					store_list.map(function(data) {
						if (data.lng == visit_store_info.lng && data.lat == visit_store_info.lat) {
							is_insert = false
						}
					})
				}
				if (is_insert) {
					store_list.push(visit_store_info);
					storage.setItem('visit_store_info', JSON.stringify(store_list))
				}
			}
		},
		// 读取浏览记录
		getVisitStoreInfo: function() {
			var storage = window.localStorage;
			var store_list = storage.getItem('visit_store_info');
			if (store_list) {
				return $.parseJSON(store_list)
			} else {
				return [];
			}
		},
		// 清空浏览记录
		removeVisitStoreInfo: function() {
			var storage = window.localStorage;
			// storage.clear();
			storage.removeItem('visit_store_info');
		}

	}
})(jQuery);