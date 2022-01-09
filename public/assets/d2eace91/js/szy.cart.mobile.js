/**
 * AJAX后台、卖家中心公共组件
 * 
 * ============================================================================ 版权所有 2008-2015 秦皇岛商之翼网络科技有限公司，并保留所有权利。 ============================================================================
 * 
 * @author: niqingyang
 * @version 1.0
 * @date 2015-11-19
 * @link http://www.68ecshop.com
 */

(function($) {
	// 网站底部导航
	$.footerbar = {
		// 初始化登录信息
		initLogin: false,
		// 初始化
		init: function() {
			if (document.location.toString().indexOf('/subsite/change') == -1) {
				var data = {};
				var back_url = window.location.href;
				if (typeof (shop_id) != 'undefined' && shop_id > 0) {
					data.shop_id = shop_id
				}
				$.get('/site/user', data, function(result) {
					if (result.code == 0 && result.data != null) {
						if (result.data.cart) {
							$(".SZY-CART-COUNT").html(result.data.cart.goods_count);
							if (parseInt(result.data.message.internal_count) >= 100) {
								$(".SZY-INTERNAL-COUNT").html("99+");
								$(".SZY-INTERNAL-COUNT").removeClass('hide');
							} else {
								if (parseInt(result.data.message.internal_count) > 0) {
									$(".SZY-INTERNAL-COUNT").html(result.data.message.internal_count);
									$(".SZY-INTERNAL-COUNT").removeClass('hide');
								}
							}

							if ($.cartbox) {
								$.cartbox.count = result.data.cart.goods_count;
							}
						}
						// 判断是否存在站点
						if (result.data.site_id != undefined) {
							if (result.data.site_id == 0) {
								// 弹出选择站点的界面
								$.go('/subsite/change.html?back_url=' + back_url);
							}
							if (result.data.site_change != undefined || result.data.site_change.site_name != null) {
								if ($(".SZY-SUBSITE").size() > 0) {
									$(".SZY-SUBSITE").find("a").html(result.data.site_change.site_name);
								}
							}

							if (result.data.region_code && sessionStorage.geolocation && !localStorage.cancel_site_location) {
								var location_region_code = $.parseJSON(sessionStorage.geolocation).region_code;
								$.get('/site/subsite-location.html', {
									'site_region_code': result.data.region_code,
									'location_region_code': location_region_code
								}, function(r) {
									if (r.code == 0) {
										if (r.data.site_id && r.data.site_id != result.data.site_id) {
											$.confirm("您当前所在的城市：" + r.data.city + "，是否切换到此城市下的站点", function() {
												$.go('/subsite/index.html?site_id=' + r.data.site_id + '&back_url=' + back_url);
											}, function() {
												localStorage.cancel_site_location = true;
											});
										}
									}
								}, 'json');
							}
						}
						initLogin = true;
					}
				}, "json");
			}
		},
		load: function() {
			// 获取购物车数量
			$.cartbox.lasttime = new Date().getTime();
		},
	};

	// 购物车盒子
	$.cartbox = {
		// 上次访问的时间戳
		lasttime: 0,
		// 当前购物车盒子中商品的数量
		count: 0,
		loaded: false,
		data: {},
		init: function() {
			$(".cartbox").on('click', '.cart-icon', function() {
				if ($.cartbox.loaded) {
					$.cartbox.open();
				} else {
					$.loading.start();
					var time = new Date().getTime();
					if ($.cartbox.lasttime == 0 || time - $.cartbox.lasttime > 1000) {
						$.cartbox.load(function(result) {
							if (result.count > 0) {
								$.cartbox.open();
							} else {
								$.cartbox.close();
								$('.SZY-PAY').addClass('disabled');
							}
							$.loading.stop();
						});
					}
				}
			});
			$(".cartbox").on('click', '.shop-cart-layer', function() {
				$.cartbox.close();
			});

		},
		// 加载
		load: function(callback) {
			$.cartbox.lasttime = new Date().getTime();

			if ($(".cartbox").size() > 0 && $(".cartbox-layer").size() > 0) {
				if (typeof (shop_id) != 'undefined') {
					$.cartbox.data = {
						shop_id: shop_id
					}
				}
				$.get("/cart/box-goods-list.html", $.cartbox.data, function(result) {
					if (result.code == 0) {
						$.cartbox.count = result.count;
						$.cartbox.renderCount();
						$(".cartbox").html(result.data);
						if (result.start_price > 0) {
							if (result.select_goods_number == 0) {
								$('.SZY-PAY').html(result.start_price_format + '起送');
								$('.SZY-PAY').addClass('disabled');
							} else if (result.dif_price > 0) {
								$('.SZY-PAY').html('还差' + result.dif_price_format + '起送');
								$('.SZY-PAY').addClass('disabled');
							} else {
								$('.SZY-PAY').html('去结算');
								$('.SZY-PAY').removeClass('disabled');
							}
						} else {
							if (result.select_goods_number == 0) {
								$('.SZY-PAY').html('去结算');
								$('.SZY-PAY').addClass('disabled');
							} else {
								$('.SZY-PAY').html('去结算');
								$('.SZY-PAY').removeClass('disabled');
							}
						}
						$.cartbox.loaded = true;
					}
					// 回调函数
					if ($.isFunction(callback)) {
						callback.call($.cartbox, result);
					}
				}, "json");
			}
		},
		open: function() {
			if ($(".cartbox").find('.cartbox-layer').size() > 0) {
				$(".cartbox").find('.cartbox-layer').removeClass('hide');
				$('.mask-div').show();
				$(".cartbox").find('.cartbox-con').addClass('show');
				$(".cartbox").find('.footer-cart-icon').children('a').addClass('hide');
				$(".cartbox").children('.goods-total-price').css('transform', 'translateX(-60px)');
			}

		},
		close: function() {
			if ($(".cartbox").find('.cartbox-layer').size() > 0) {
				$(".cartbox").find('.cartbox-layer').addClass('hide');
				$('.mask-div').hide();
				$(".cartbox").find('.cartbox-con').removeClass('show');
				$(".cartbox").find('.footer-cart-icon').children('a').removeClass('hide');
				$(".cartbox").children('.goods-total-price').css('transform', 'translateX(0px)');
			}
		},
		// 飞入购物车效果
		fly: function(image_url, event, target) {
			if (image_url && event && $(target).size() > 0) {
				// 结束的地方的元素
				var offset = $(target).offset();
				var flyer = $('<img class="fly-img" src="' + image_url + '">');
				if ($.isFunction(flyer.fly)) {
					flyer.fly({
						start: {
							left: event.pageX - 20,
							top: event.pageY - $(window).scrollTop()
						},
						end: {
							left: offset.left + 20,
							top: offset.top - $(window).scrollTop() + 50,
							width: 0,
							height: 0
						},
						onEnd: function() {
							this.destory();
						}
					});
				}
			}
		},
		// 设置新增了几件商品
		add: function(number) {
			// 计数累计
			this.count = parseInt(this.count) + parseInt(number);
			// 移入刷新
			this.lasttime = 0;
			// 渲染数量
			this.renderCount();
		},
		subtract: function(number) {
			// 计数累计
			this.count = parseInt(this.count) - parseInt(number);
			// 移入刷新
			this.lasttime = 0;
			// 渲染数量
			this.renderCount();
		},
		// 渲染数量
		renderCount: function(count) {
			if (!count) {
				count = this.count;
			}
			$(".cartbox").find(".SZY-CART-COUNT").html(count);
			// $(".SZY-CART-COUNT").html(count);
		}
	};

	// 购物车
	$.cart = {
		loading: false,
		request: null,
		// 立即购买
		quickBuy: function(id, number, options) {

			$.loading.start();

			var data = {
				sku_id: id,
				number: number
			};

			// 拼团
			if (options && options.group_sn != undefined && options.group_sn != null) {
				data.group_sn = options.group_sn;
			}

			// 砍价
			if (options && options.bar_id != undefined && options.bar_id != null) {
				data.bar_id = options.bar_id;
			}

			// 积分兑换
			if (options && options.exchange) {
				data.exchange = options.exchange;
			}

			// 搭配套餐活动
			if (options && options.act_id > 0) {
				data.act_id = options.act_id;
				data.act_type = options.act_type;
				data.sku_ids = options.sku_ids;
			}

			// 限购、预售
			if (options && options.act_type > 0) {
				data.act_type = options.act_type;
			}
			$.post('/cart/quick-buy.html', data, function(result) {
				if (result.code == 0) {
					$.go(result.data);
				} else if (result.code == 1) {
					$.go('/goods/validate.html');
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}
			}, "json").always(function() {
				$.loading.stop()
			});
		},
		// 批量
		batchQuickBuy: function(sku_list, options) {
			$.loading.start();
			var data = {
				sku_list: sku_list,
				goods_id: options.goods_id,
				whole_number: options.whole_number
			};
			$.post('/cart/batch-quick-buy.html', data, function(result) {
				if (result.code == 0) {
					$.go(result.data);
				} else {
					$.msg(result.message, {
						time: 3000
					});
				}
			}, "json").always(function() {
				$.loading.stop()
			});
		},
		// 添加购物车
		// @param sku_id 商品SKU编号
		// @param number 数量
		// @param options 其他参数 {is_sku-是否为SKU, image_url-图片路径, event-点击事件,
		// callback-回调函数}
		add: function(id, number, options) {

			if (this.loading) {
				return;
			}

			this.loading = true;

			var defaults = {
				// 是否为SKU商品
				is_sku: true,
				// 图片路径
				image_url: undefined,
				// 点击事件
				event: undefined,
				// 回调函数
				callback: undefined
			};

			options = $.extend(true, defaults, options);

			var data = {
				number: number,
			};

			if (options.shop_id != undefined && options.shop_id != 0) {
				data.shop_id = options.shop_id;
			}

			// 活动ID
			if (options.act_id != undefined && options.act_id != 0) {
				data.act_id = options.act_id;
				data.act_type = options.act_type;
				data.sku_ids = options.sku_ids;
				// 多个商品加入购物车 侧边栏购物车商品数量显示的数量
				if (options.sku_ids.length > 0) {
					number = number * options.sku_ids.length;
				}
			}
			// 直播
			if (options && options.live_id > 0) {
				data.live_id = options.live_id;
			}
			if (options.is_sku) {
				data.sku_id = id;

				$.post('/cart/add', data, function(result) {

					$.cart.loading = false;

					if (result.code == 0) {

						if (options.image_url == undefined) {
							$.msg(result.message);
						}
						// 刷新购物车数量
						$.cartbox.add(number);
						$.cartbox.load();
						// 飞入购物车
						$.cartbox.fly(options.image_url, options.event, $(".cartbox"));
					} else if (result.code == 94) {
						// 回调函数
						if ($.isFunction(options.info_callback)) {
							options.info_callback.call($.cart, result);
						} else {
							setTimeout(function() {
								$.loading.start();
							}, 100);
							// 跳转详情页面
							if (result.data && result.data.url) {
								$.go(result.data.url, null, false);
							} else {
								$.go("/" + id + ".html", null, false);
							}
						}
					} else {
						$.msg(result.message, {
							time: 5000
						});
					}

					// 回调函数
					if ($.isFunction(options.callback)) {
						options.callback.call($.cart, result);
					}

				}, "json");
			} else {
				// 添加商品
				data.goods_id = id;
				$.post('/cart/add', data, function(result) {

					$.cart.loading = false;

					if (result.code == 0) {

						if (options.image_url == undefined) {
							$.msg(result.message);
						}
						// 刷新购物车数量
						$.cartbox.add(number);
						$.cartbox.load();
						// 飞入购物车
						$.cartbox.fly(options.image_url, options.event, $(".cartbox"));
					} else if (result.code == 98) {
						var scrollheight = 0;
						scrollheight = $(document).scrollTop();
						$("body").css("top", "-" + scrollheight + "px");
						$("body").addClass("visibly");
						$("body").append(result.data);
						$(".SZY_ADD_CART_OPTION_X").val(options.event.pageX);
						$(".SZY_ADD_CART_OPTION_Y").val(options.event.pageY);
						$(".SZY_CHOOSE_SPEC_SCROLLHEIGHT").val(scrollheight);
					} else if (result.code == 94) {
						// 回调函数
						if ($.isFunction(options.info_callback)) {
							options.info_callback.call($.cart, result);
						} else {
							setTimeout(function() {
								$.loading.start();
							}, 100);
							// 跳转详情页面
							if (result.data && result.data.url) {
								$.go(result.data.url, null, false);
							} else {
								$.go("/goods-" + id + ".html", null, false);
							}
						}
					} else {
						$.msg(result.message, {
							time: 5000
						});
					}

					// 回调函数
					if ($.isFunction(options.callback)) {
						options.callback.call($.cart, result);
					}

				}, "json");
			}

		},
		// 礼品
		addGift: function(goods_id, sku_id, options) {

			var defaults = {
				// 是否为SKU商品
				is_sku: true,
				// 图片路径
				image_url: undefined,
				// 点击事件
				event: undefined,
				// 回调函数
				callback: undefined
			};

			options = $.extend(true, defaults, options);

			var data = {
				goods_id: goods_id,
				sku_id: sku_id,
				gift: 1
			};

			if (options.shop_id != undefined && options.shop_id != 0) {
				data.shop_id = options.shop_id;
			}

			// 添加商品
			$.post('/cart/add-gift.html', {
				goods_id: goods_id,
				sku_id: sku_id,
				is_sku: options.is_sku
			}, function(result) {

				if (result.code == 0) {
					// 跳转到结算页面
					$.post('/cart/quick-buy.html', data, function(result) {
						if (result.code == 0) {
							$.go(result.data);
						} else {
							$.msg(result.message, {
								time: 3000
							});
						}
					}, "json").always(function() {
						$.loading.stop()
					});

				} else if (result.code == 98) {
					// 商品属性弹窗
					$("body").append(result.data);
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}
			}, "json");
		},
		// 批量添加购物车actionBatchAdd
		batch_add: function(sku_list, options) {
			var defaults = {
				// 是否为SKU商品
				sku_list: [],
				// 点击事件
				event: undefined,
				// 回调函数
				callback: undefined
			};
			options = $.extend(true, defaults, options);
			var data = {
				sku_list: sku_list,
				goods_id: options.goods_id
			};
			$.post('/cart/batch-add.html', data, function(result) {
				if (result.code == 0) {
					$.msg(result.message);
				} else {
					$.msg(result.message, {
						time: 3000
					});
				}

				// 回调函数
				if ($.isFunction(options.callback)) {
					options.callback.call($.cart, result);
				}
			}, "json");
		},

		// 从购物车中删除
		remove: function(data, callback) {

			if (this.request != null && $.isFunction(this.request.abort)) {
				// 终止请求
				this.request.abort();
			}

			this.request = $.post('/cart/remove', data, function(result) {
				if (result.code == 0) {
					$.cartbox.count = result.data.count;
					$.cartbox.renderCount();
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}

				// 回调函数
				if ($.isFunction(callback)) {
					callback.call($.cart, result);
				}

			}, "json");

			return this.request;
		},
		// 从购物车中删除
		del: function(cart_ids, callback) {

			if (this.request != null && $.isFunction(this.request.abort)) {
				// 终止请求
				this.request.abort();
			}

			var data = {};
			data.cart_ids = cart_ids;
			if (typeof (shop_id) != 'undefined' && shop_id > 0) {
				data.shop_id = shop_id
			}

			this.request = $.post('/cart/delete', data, function(result) {

				if (result.code == 0) {
					if (result.message.length > 0) {
						$.msg(result.message);
					}
					// 刷新购物车
					$.cartbox.load();
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}

				// 回调函数
				if ($.isFunction(callback)) {
					callback.call($.cart, result);
				}

			}, "json");

			return this.request;
		},

		// 从购物车中减少
		subtract: function(goods_id, number, options, callback) {

			var data = {
				goods_id: goods_id,
				number: number
			};

			if (options.shop_id != undefined && options.shop_id != 0) {
				data.shop_id = options.shop_id;
			}
			$.post('/cart/remove', data, function(result) {

				if (result.code == 0) {
					// $.msg(result.message);
					// 刷新购物车数量
					$.cartbox.subtract(number);
					$.cartbox.load();
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}

				// 回调函数
				if ($.isFunction(callback)) {
					callback.call($.cart, result);
				}

			}, "json");
		},

		/**
		 * 根据规格串的数组获取SKU编号
		 * 
		 * @params array spec_ids 规格串的数组
		 * @params array sku_ids 以SKU规格串为Key，包含“sku_id”属性的数组
		 */
		getSkuId: function(spec_ids, sku_ids) {

			var temp_spec_ids = spec_ids.join("|");

			if (sku_ids[temp_spec_ids]) {
				return sku_ids[temp_spec_ids]['sku_id'];
			} else {
				// 求数组的全排序
				var spec_ids_list = $.toPermute(spec_ids);

				for (var i = 0; i < spec_ids_list.length; i++) {
					spec_ids = spec_ids_list[i];

					spec_ids = spec_ids.join("|");

					if (sku_ids[spec_ids]) {
						return sku_ids[spec_ids]['sku_id'];
					}

				}

				return null;
			}
		},
		// 改变购物车中商品数量
		// @param sku_id SKU商品编号
		// @param number 变更后的数量
		// @param callback 变更后的回调函数
		changeNumber: function(sku_id, number, cart_id, callback) {

			if (this.request != null && $.isFunction(this.request.abort)) {
				// 终止请求
				this.request.abort();
			}

			var data = {
				sku_id: sku_id,
				number: number,
				cart_id: cart_id
			};
			if (typeof (shop_id) != 'undefined') {
				data.shop_id = shop_id;
			}

			this.request = $.post('/cart/change-number', data, function(result) {
				if (result.code == 0) {

				} else {
					$.msg(result.message, {
						time: 5000
					});
				}

				if ($.isFunction(callback)) {
					callback.call($.cart, result);
				}

			}, "json");

			return this.request;
		},
		// 选择商品
		select: function(cart_ids, options, callback) {

			if (this.request != null && $.isFunction(this.request.abort)) {
				// 终止请求
				this.request.abort();
			}

			var data = {
				cart_ids: cart_ids.join(",")
			};

			if (typeof (shop_id) != 'undefined') {
				data.shop_id = shop_id;
			}

			data = $.extend(true, data, options);

			this.request = $.post('/cart/select', data, function(result) {

				if (result.code == 0) {
					// $.cartbox.load(function(res) {
					// $.cartbox.open();
					// });
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}

				if ($.isFunction(callback)) {
					callback.call($.cart, result);
				}

			}, "json");

			return this.request;
		},
		// 检查SKU组合
		// 容器格式必须符合商城SKU的DOM结构dl>dd>ul>li(#id、spec-id、attr-id)
		// @param container 规格所在的DOM容器
		// @param sku_list SKU列表，必须以规格串为KEY
		checkSkus: function(container, sku_list) {
			var item_list = $(container).find("li.selected");

			var size = item_list.length;

			for (var i = 0; i < size; i++) {

				var list = [];

				var spec_ids = [];

				for (var j = 0; j < size; j++) {
					if (i == j) {
						continue;
					}
					spec_ids.push($(item_list[j]).data("spec-id"));
				}

				$(item_list[i]).parents("ul").find("li").not(".selected").each(function() {
					spec_ids[size - 1] = $(this).data("spec-id");

					var sku_id = $.cart.getSkuId(spec_ids, sku_list);
					if (sku_id) {
						$(this).removeClass("no-stock");
					} else {
						$(this).addClass("no-stock");
					}
				});
			}
		},
		// 点击规格事件
		// @param container 规格所在的DOM容器
		// 容器格式必须符合商城SKU的DOM结构dl>dd>ul>li(#id、spec-id、attr-id)
		// @param sku_list SKU列表，必须以规格串为KEY
		// @param objects 规格项列表对象
		// @param done_callback SKU存在时的回调函数，参数列表：sku对象，上下文对象为点击的规格DOM
		// @param fail_callback SKU不存在时的回调函数，参数列表：无，上下文对象为点击的规格DOM
		checkSpecs: function(container, sku_list, objects, done_callback, fail_callback) {
			$(objects).click(function() {

				if ($(this).hasClass('disable')) {
					return;
				}

				$(this).siblings(".selected").removeClass("selected");
				$(this).addClass("selected");

				var spec_ids = [];
				$(container).find("ul").each(function() {
					var spec_id = $(this).find("li.selected").data("spec-id");
					spec_ids.push(spec_id);
				});

				var sku_id = $.cart.getSkuId(spec_ids, sku_list);

				if (sku_id) {

					$(this).siblings("li").removeClass("no-stock").parents("dl").removeClass("no-stock-bg");
					$.cart.checkSkus(container, sku_list);

					var sku = null;

					for ( var spec_id in sku_list) {
						if (sku_list[spec_id].sku_id == sku_id) {
							sku = sku_list[spec_id];
							break;
						}
					}

					if ($.isFunction(done_callback)) {
						done_callback.call(this, sku);
					}
				} else {

					if ($.isFunction(fail_callback)) {
						fail_callback.call(this);
					}

					var spec_ids = [];

					var spec_id = $(this).data("spec-id") + "";
					var attr_id = $(this).data("attr-id") + "";

					$(container).find("li").removeClass("no-stock").removeClass("disable");
					$(container).find("li").parents(".attr").removeClass("no-stock-bg");

					for ( var key in sku_list) {
						if (key == "") {
							continue;
						}

						var ids = key.split("|");

						if ($.inArray(spec_id, ids) != -1) {
							spec_ids = $.merge(spec_ids, ids);
						}
					}

					spec_ids = $.unique(spec_ids, ids);

					for ( var key in sku_list) {
						if (key == "") {
							continue;
						}

						var ids = key.split("|");

						if ($.inArray(spec_id, ids) == -1) {
							for (var i = 0; i < ids.length; i++) {

								if ($.inArray(ids[i], spec_ids) != -1) {
									continue;
								}

								var target = $(container).find("li[data-spec-id='" + ids[i] + "']");

								$(target).removeClass("selected");

								if ($(target).data("attr-id") == attr_id) {
									continue;
								}

								$(target).addClass("no-stock");
								$(target).parents(".attr").addClass("no-stock-bg");
							}
						}
					}

					$(this).siblings("li").removeClass("no-stock");
				}
			});
		}
	};

	// 收藏接口
	$.collect = {
		// 收藏、取消收藏商品
		// @params goods_id
		// @params goods_id
		// @params sku_id
		// @params callback
		// @params show_count true-返回收藏数量 false-不返回收藏数量
		toggleGoods: function(goods_id, sku_id, callback, show_count) {
			if (!sku_id) {
				sku_id = 0;
			}

			var data = {
				goods_id: goods_id,
				sku_id: sku_id
			};

			if (show_count) {
				data.show_count = 1;
			}

			$.post('/user/collect/toggle', data, function(result) {

				if (result.code == 0) {

					if (result.data == 1) {
						// 收藏成功
					} else {
						// 取消收藏
					}

					$.msg(result.message);
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}

			}, "json");
		},
		// 收藏、取消收藏店铺
		toggleShop: function(shop_id, callback, show_count) {

			var data = {
				shop_id: shop_id
			};

			if (show_count) {
				data.show_count = 1;
			}

			$.post('/user/collect/toggle', data, function(result) {

				if (result.code == 0) {
					if (result.bonus_info && result.bonus_info.html) {
						$("body").append(result.bonus_info.html);
					} else {
						$.msg(result.message);
					}
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}

			}, "json");
		},

		// 添加收藏
		addGoods: function(goods_id, sku_id, callback) {
			if (!sku_id) {
				sku_id = 0;
			}
			$.post('/user/collect/add', {
				goods_id: goods_id,
				sku_id: sku_id
			}, function(result) {

				$.msg(result.message);

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}

			}, "json");
		},
		// 添加收藏
		addShop: function(shop_id, callback) {
			$.post('/user/collect/add', {
				shop_id: shop_id
			}, function(result) {
				if (result.bonus_info && result.bonus_info.html) {
					$("body").append(result.bonus_info.html);
				} else {
					$.msg(result.message);
				}

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}

			}, "json");
		},
		removeGoods: function(goods_id, sku_id, callback) {
			$.post('/user/collect/remove', {
				goods_id: goods_id,
				sku_id: sku_id
			}, function(result) {
				$.msg(result.message);

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}

			}, "json");
		},
		removeShop: function(shop_id, callback) {
			$.post('/user/collect/remove', {
				shop_id: shop_id
			}, function(result) {
				$.msg(result.message);

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}

			}, "json");
		}
	};

	// 初始化底部导航栏
	$.footerbar.init();
	// 初始化购物车盒子
	$.cartbox.init();

	// 在线客服
	$.openim = function(options) {
		$.loading.start();
		var defaults = {
			goods_id: null,
			order_id: null,
			shop_id: null
		};

		options = $.extend(defaults, options);

		var goods_id = options.goods_id;
		var order_id = options.order_id;
		var shop_id = options.shop_id;

		$.get("/user/im/check", {}, function(result) {
			$.loading.stop();
			if (result.code == 1) {
				window.location.href = '/login.html';
			}
			if (result.code == 0) {

				var url = '/user/im/open' // 转向网页的地址;
				if (goods_id) {
					url += '?goods_id=' + goods_id;
				} else if (order_id) {
					url += '?order_id=' + order_id;
				} else if (shop_id) {
					url += '?shop_id=' + shop_id;
				}
				window.location.href = url;
			}

		}, "json");
	};

	// 红包
	$.bonus = {
		/**
		 * 领取红包
		 */
		receive: function(bonus_id, callback) {
			return $.post("/user/bonus/receive.html", {
				bonus_id: bonus_id
			}, function(result) {
				if ($.isFunction(callback)) {
					callback.call(this, result);
				}
			}, "JSON");
		}
	};

})(jQuery);