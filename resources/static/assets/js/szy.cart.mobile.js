/**
 * AJAX后台、卖家中心公共组件
 * 
 * ============================================================================
 * 版权所有 2008-2015 秦皇岛商之翼网络科技有限公司，并保留所有权利。
 * ============================================================================
 * 
 * @author: niqingyang
 * @version 1.0
 * @date 2015-11-19
 * @link http://www.68ecshop.com
 */

(function($) {
	var back_url = window.location.href;
	// 网站底部导航
	$.footerbar = {
		// 初始化登录信息
		initLogin: false,
		// 初始化
		init: function() {
			if (document.location.toString().indexOf('/subsite/change') == -1) {
				var data = {};
				if (typeof (shop_id) != 'undefined' && shop_id > 0) {
					data.shop_id = shop_id
				}
				$.get('/site/user', data, function(result) {
					if (result.code == 0 && result.data != null) {

						// 重置csrf token值
						if (result.data.csrf_token) {

							$('meta[name=csrf-token]').attr('content', result.data.csrf_token);
						}

						if (result.data.cart) {
							if (result.data.cart.goods_count >= 100) {
								$(".SZY-CART-COUNT").html('99+');
							} else {
								$(".SZY-CART-COUNT").html(result.data.cart.goods_count);
							}
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
								if (result.data.cart.goods_count >= 100) {
									$.cartbox.count = '99+';
								} else {
									$.cartbox.count = result.data.cart.goods_count;
								}
							}
						}
						// 判断是否存在站点
						if (result.data.site_id != undefined) {
							var data = {};
							data.site_id = result.data.site_id;
							data.site_status = result.data.site_status;
							data.site_name = result.data.site_change.site_name;
							data.region_code = result.data.region_code;
							$.sitebar.init(data);
						}
						initLogin = true;
						if (result.data.user_id > 0) {
							$("input[name='visiter_id']").val(result.data.user_id + '_' + result.data.yikf_user_suffix);
							$("input[name='visiter_name']").val(result.data.user_name);
							$("input[name='avatar']").val(result.data.headimg);
						}
						if (result.data.domain) {
							$("input[name='domain']").val(result.data.domain);
							$(".site_yikf_form").css('display', 'inline-block');
						}

					}
				}, "json");
			}
		},
		load: function() {
			// 获取购物车数量
			$.cartbox.lasttime = new Date().getTime();
		},
	};

	// 首页站点
	$.sitebar = {
		// 初始化
		init: function(data) {
			if (data.site_id == 0 || data.site_status == 0) {
				// 弹出选择站点的界面
				$.go('/subsite/change.html?back_url=' + back_url);
			}
			if (data.site_name != null) {
				if ($(".SZY-SUBSITE").size() > 0) {
					$(".SZY-SUBSITE").find("a").html(data.site_name);
				}
			}

			if (data.region_code && sessionStorage.geolocation && !localStorage.cancel_site_location) {
				var location_region_code = $.parseJSON(sessionStorage.geolocation).region_code;
				$.get('/site/subsite-location.html', {
					'site_region_code': data.region_code,
					'location_region_code': location_region_code
				}, function(r) {
					if (r.code == 0) {
						if (r.data.site_id && r.data.site_id != data.site_id) {
							$.confirm("您当前所在的城市：" + r.data.city + "，是否切换到此城市下的站点", function() {
								$.go('/subsite/index.html?site_id=' + r.data.site_id + '&back_url=' + back_url);
							}, function() {
								localStorage.cancel_site_location = true;
							});
						}
					}
				}, 'json');
			}
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
		fly: function(image_url, event, target, callback) {

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
							$(target).addClass('cart-animate');

							setTimeout(function() {
								$(target).removeClass('cart-animate')
							}, 1000);
							this.destroy();
							// 回调函数
							if ($.isFunction(callback)) {
								callback.call($.cartbox, false);
							}
						}
					});
				}
			} else {
				// 回调函数
				if ($.isFunction(callback)) {
					callback.call($.cartbox, true);
				}
			}
		},
		// 设置新增了几件商品
		add: function(number) {
			var target = this;
			// 计数累计
			target.count = parseInt(target.count) + parseInt(number);
			// 移入刷新
			target.lasttime = 0;
			// 渲染数量
			$.tipsBox({
				obj: $('.SZY-CART-COUNT'),
				str: "+" + number,
				callback: function() {
					target.renderCount();
				}
			});
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
			if (parseInt(count) < 100) {
				$(".cartbox").find(".SZY-CART-COUNT").html(count);
			} else {
				$(".cartbox").find(".SZY-CART-COUNT").html('99+');
			}
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
			// 虚拟商品
			if (options && options.virtual) {
				data.virtual = options.virtual;
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
				callback: undefined,
				// 显示加入购物车信息
				show_add_message: true
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
						// 飞入购物车
						$.cartbox.fly(options.image_url, options.event, $(".cartbox"), function(show_add_message) {

							// 刷新购物车数量
							$.cartbox.add(number);
							$.cartbox.load();

							options.show_add_message = show_add_message;

							if (options.show_add_message) {
								$.msg(result.message, {
									icon_type: 1
								});
							}

						});

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

						// 飞入购物车
						$.cartbox.fly(options.image_url, options.event, $(".cartbox"), function(show_add_message) {

							// 刷新购物车数量
							$.cartbox.add(number);
							$.cartbox.load();

							options.show_add_message = show_add_message;

							if (options.show_add_message) {
								$.msg(result.message, {
									icon_type: 1
								});
							}

						});

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
						$.msg(result.message, {
							icon_type: 1
						});
					}
					// 刷新购物车
					$.cartbox.count = result.count;
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
					$.cartbox.count = result.params.count;
					$.cartbox.renderCount();
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

					$.msg(result.message, {
						icon_type: 1
					});
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
						$.msg(result.message, {
							icon_type: 1
						});
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

				$.msg(result.message, {
					icon_type: 1
				});

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}

			}, "json");
		},
		// 批量收藏
		batchAddGoods: function(goods_ids, callback) {

			$.post('/user/collect/batch-add-goods', {
				goods_ids: goods_ids,

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
					$.msg(result.message, {
						icon_type: 1
					});
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

	$().ready(function() {
		// 初始化底部导航栏
		$.footerbar.init();
		// 初始化购物车盒子
		$.cartbox.init();
	});

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

	// +1特效
	$.extend({
		tipsBox: function(options) {
			options = $.extend({
				obj: null, // jq对象，要在那个html标签上显示
				str: "+1", // 字符串，要显示的内容;也可以传一段html，如: "<b
				// style='font-family:Microsoft YaHei;'>+1</b>"
				startSize: "10px", // 动画开始的文字大小
				endSize: "20px", // 动画结束的文字大小
				interval: 600, // 动画时间间隔
				color: "#F56456", // 文字颜色
				callback: function() {
				} // 回调函数
			}, options);

			var color = $("meta[name='m_main_color']").attr("content");

			if (color != '' && color != 'undefined' && color != undefined) {
				options.color = color;
			}

			if (options.obj && options.obj.length > 0) {
				$("body").append("<span class='add-cart-num'>" + options.str + "</span>");
				var box = $(".add-cart-num");
				var left = options.obj.offset().left + options.obj.width() / 2;
				var top = options.obj.offset().top - options.obj.height();
				box.css({
					"position": "absolute",
					"left": left + "px",
					"top": top + "px",
					"z-index": 9999,
					"font-size": options.startSize,
					"line-height": options.endSize,
					"color": options.color
				});
				box.animate({
					"font-size": options.endSize,
					"opacity": "0",
					"top": top - parseInt(options.endSize) + "px"
				}, options.interval, function() {
					box.remove();
					if ($.isFunction(options.callback)) {
						options.callback();
					}
				});
			} else {
				if ($.isFunction(options.callback)) {
					options.callback();
				}
			}
		}
	});

})(jQuery);