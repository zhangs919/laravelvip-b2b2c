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

	$.topbar = {
		init: function() {
			if ($(".SZY-USER-NAME").size() > 0) {
				var url = '/site/user.html';
				if ($(".SZY-DEFAULT-SEARCH").size() > 0) {
					// 默认搜索词添加
					var cat_id = $(".SZY-DEFAULT-SEARCH").data('cat_id');
					url = '/site/user?cat_id=' + cat_id;
				}
				$.get(url, {}, function(result) {
					if (result.code == 0 && result.data != null) {
						$.sidebar.renderLogin(result.data);
						$.sidebar.initLogin = true;

						var data = result.data;

						// 搜索框显示词
						if (data.show_keywords) {
							if ($(".SZY-SEARCH-BOX-KEYWORD").val() == "") {
								$(".SZY-SEARCH-BOX-KEYWORD").data("searchwords", data.show_keywords.keyword);
								$(".SZY-SEARCH-BOX-KEYWORD").attr("placeholder", data.show_keywords.show_words);
							} else {
								$(".SZY-SEARCH-BOX-KEYWORD").attr("placeholder", "请输入要搜索的关键词");
							}
						} else {
							$(".SZY-SEARCH-BOX-KEYWORD").attr("placeholder", "请输入要搜索的关键词");
						}

						var cur_value = $(".SZY-SEARCH-BOX-KEYWORD").attr('placeholder');
						var search_type = $(".SZY-SEARCH-BOX-KEYWORD").data("search_type");
						// 绑定切换事件
						$(".SZY-SEARCH-BOX-FORM").find('.search-type li:not(".curr")').click(function() {
							var this_text = $(this).text();
							var this_num = $(this).attr('num');
							var curr_text = $(this).siblings('.curr').text();
							var curr_num = $(this).siblings('.curr').attr('num');
							if (this_num == 1) {
								$(".SZY-SEARCH-BOX-KEYWORD").attr('placeholder', '请输入要搜索的关键词');

							} else {
								$(".SZY-SEARCH-BOX-KEYWORD").attr('placeholder', cur_value);
							}

							$(this).text(curr_text).attr('num', curr_num).siblings('.curr').text(this_text).attr('num', this_num);
							$(".SZY-SEARCH-BOX-FORM").find('.searchtype').val(this_num);
							$(".SZY-SEARCH-BOX-FORM").find('.search-type').css({
								"height": 36,
								"overflow": "hidden"
							});
						});

						if (search_type == "1") {
							$(".SZY-SEARCH-BOX-FORM").find('.search-type li[num=1]').click();
						}

						$(".SZY-SEARCH-BOX-FORM").find('.search-type').show();

						// 默认搜索词
						if (data.default_keywords) {
							var html = '';
							var default_keywords = data.default_keywords
							var i = 0;
							default_keywords.forEach(function(e) {
								if (i == 0) {
									html += "<li class='first'><a href='/" + e.url + "' title='" + e.keyword + "'>" + e.keyword + "</a></li>";
								} else {
									html += "<li><a href='/" + e.url + "' title='" + e.keyword + "'>" + e.keyword + "</a></li>";
								}
								i++;
							})
							$(".SZY-DEFAULT-SEARCH").html(html);
						}
						// 热门搜索词
						if (data.hot_keywords) {
							$(".SZY-HOT-SEARCH").find("li").not(".title").remove();
							var html = "";
							$(data.hot_keywords).each(function(i, item) {
								html += '<li><a target="_blank" href="' + item.url + '" title="' + item.keyword + '">' + item.keyword + '</a></li>';
							});
							$(".SZY-HOT-SEARCH").find("li:last").after(html);
						}

						// 搜索记录
						if (data.search_records) {
							var html = "";
							$(data.search_records).each(function(i, item) {
								if ($.trim(item) == "") {
									return;
								}
								html += '<li class="active rec_over" id="search_record_' + i + '"><span><a href="/search.html?keyword=' + item + '" title="' + item + '">' + item + '</a><i onclick="search_box_remove(' + i + ')"></i></span></li>';
							});
							$(".SZY-SEARCH-RECORDS").find("li:last").after(html);
						}
						// 搜索帮助显示隐藏控制
						if (data.hot_keywords == false && data.search_records == false) {
							$(".SZY-SEARCH-BOX-HELPER").remove();
						}

						// 判断是否存在站点
						if (data.site_id != undefined) {

							if (data.site_id == 0) {
								// 弹出选择站点的界面
								$.get('/subsite/selector.html', {}, function(result) {
									if (result.code == 0 && result.data != null) {
										var element = $($.parseHTML(result.data, true));
										$("body").append(element);
									}
								}, "json");
							}

							if (data.site_change != undefined || data.site_change != null) {
								if ($(".SZY-SUBSITE").size() > 0) {
									$(".SZY-SUBSITE").html(data.site_change);
								}
							}

						}
					}
				}, "json");
			}
		}
	};

	// 侧边栏
	$.sidebar = {
		// 初始化登录信息
		initLogin: false,
		// 初始化
		init: function() {
			// 侧边栏浏览记录
			$(".sidebar-historybox-trigger").click(function() {
				var target = this;
				if ($(target).data("load")) {
					return;
				}
				$.get("/history/box-goods-list.html", {}, function(result) {
					if (result.code == 0) {
						$(".sidebar-historybox").find(".sidebar-historybox-goods-list").html(result.data);
					}
					$(target).data("load", true);
				}, "json");
			});

			// 初始化侧边栏登录信息
			$(".sidebar-user-trigger").mouseover(function() {

				if ($.sidebar.initLogin) {
					return;
				}

				$.get('/site/user.html', {}, function(result) {
					if (result.code == 0 && result.data != null) {
						$.sidebar.renderLogin(result.data);
					}
				});

				$.sidebar.initLogin = true;
			});
		},
		renderLogin: function(user) {

			if (user && user.cart) {
				var count = user.cart.goods_count;

				if ($.cartbox) {
					$.cartbox.count = count;
				}

				if (count > 99) {
					count = "99+";
				}
				// 购物车中商品数量
				$(".SZY-CART-COUNT").html(count);
			}

			// 用户信息
			if (user && user.user_name) {

				var target = $(".SZY-USER-ALREADY-LOGIN");

				$(target).find(".SZY-USER-NAME").html(user.user_name);

				$(target).find(".SZY-USER-PIC").attr("src", user.headimg);

				if (user.user_rank) {

					$(target).find(".SZY-USER-RANK").show();

					$(target).find(".SZY-USER-RANK-IMG").attr("src", user.user_rank.rank_img);

					$(target).find(".SZY-USER-RANK-NAME").html(user.user_rank.rank_name);

				} else {
					$(target).find(".SZY-USER-RANK").hide();
				}

				$(target).find(".SZY-USER-LAST-LOGIN").html(user.last_time_format);

				$(".SZY-USER-NOT-LOGIN").hide();
				$(".SZY-USER-ALREADY-LOGIN").show();
			} else {
				$(".SZY-USER-NOT-LOGIN").show();
				$(".SZY-USER-ALREADY-LOGIN").hide();
			}

			// 未读消息
			if (user && user.message) {
				if (user.message.internal_count > 0) {
					$(".SZY-UNREADE-MESSAGE-COUNT").show().html(user.message.internal_count);
				} else {
					$(".SZY-UNREADE-MESSAGE-COUNT").hide().html(0);
				}
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
		}
	};

	// 购物车盒子
	$.cartbox = {
		// 上次访问的时间戳
		lasttime: 0,
		// 当前购物车盒子中商品的数量
		count: 0,
		// 初始化
		init: function() {

			$(".cartbox").mouseenter(function() {
				var time = new Date().getTime();
				if ($.cartbox.lasttime == 0 || time - $.cartbox.lasttime > 5 * 1000) {
					$.cartbox.load();
				}
				$(this).find(".cartbox-goods-list").show();
			}).mouseleave(function() {
				$(this).find(".cartbox-goods-list").hide();
			});

			$(".sidebar-cartbox-trigger").click(function() {
				var time = new Date().getTime();
				if ($.cartbox.lasttime == 0 || time - $.cartbox.lasttime > 5 * 1000) {
					$.cartbox.load();
				}
			});
		},
		// 加载
		load: function() {

			$.cartbox.lasttime = new Date().getTime();

			if ($(".cartbox").size() > 0 || $(".sidebar-cartbox").size() > 0) {
				$.get("/cart/box-goods-list.html", {}, function(result) {
					if (result.code == 0) {
						$.cartbox.count = result.count;
						$.cartbox.renderCount();

						var cartbox_goods_list = $(".cartbox").find(".cartbox-goods-list");

						if (cartbox_goods_list.size() > 0) {
							$(cartbox_goods_list).html(result.data[0]);
						}

						var sidebar_cartbox_goods_list = $(".sidebar-cartbox").find(".sidebar-cartbox-goods-list");

						if (sidebar_cartbox_goods_list.size() > 0) {
							$(sidebar_cartbox_goods_list).html(result.data[1]);
							$(".sidebar-cartbox").find('.cart-panel-content').height($(window).height() - 90);
							$(".sidebar-cartbox").find('.bonus-panel-content').height($(window).height() - 40);
						}

					}
				}, "json");
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
		// 渲染数量
		renderCount: function(count) {
			if (!count) {
				count = this.count;
			}
			if (count > 99) {
				count = "99+";
			}
			$(".cartbox").find(".SZY-CART-COUNT").html(count);

			$(".sidebar-cartbox-trigger").find(".SZY-CART-COUNT").html(count);
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
			if (options && options.group_sn) {
				data.group_sn = options.group_sn;
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
		},
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
		// shop_id-店铺编号
		// callback-回调函数}
		add: function(id, number, options) {

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
				sku_id: id,
				number: number
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

			if (options.is_sku) {
				$.post('/cart/add.html', data, function(result) {
					if (result.code == 0) {
						$.msg(result.message);
						// 刷新购物车数量
						$.cartbox.add(number);
						// 飞入购物车
						$.sidebar.fly(options.image_url, options.event, $(".sidebar-cartbox-trigger"));
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
			} else {
				// 添加商品
				$.post('/cart/add.html', {
					goods_id: id,
					number: number
				}, function(result) {

					if (result.code == 0) {
						$.msg(result.message);
						// 刷新购物车数量
						$.cartbox.add(number);
						// 飞入购物车
						$.sidebar.fly(options.image_url, options.event, $(".sidebar-cartbox-trigger"));
					} else if (result.code == 98) {
						$("body").append(result.data);
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
					// 刷新购物车数量
					// $.cartbox.add(number);
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
		remove: function(cart_ids, callback) {

			if (this.request != null && $.isFunction(this.request.abort)) {
				// 终止请求
				this.request.abort();
			}

			this.request = $.post('/cart/remove.html', {
				cart_ids: cart_ids
			}, function(result) {

				if (result.code == 0) {
					if (result.message != null && result.message.length > 0) {
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

			this.request = $.post('/cart/delete.html', data, function(result) {

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
		changeNumber: function(sku_id, number,cart_id, callback) {

			if (this.request != null && $.isFunction(this.request.abort)) {
				// 终止请求
				this.request.abort();
			}

			var data = {};
			data.sku_id = sku_id;
			data.number = number;
			data.cart_id = cart_id;
			if (typeof (shop_id) != 'undefined' && shop_id > 0) {
				data.shop_id = shop_id
			}

			this.request = $.post('/cart/change-number.html', data, function(result) {

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
		select: function(cart_ids, callback) {

			if (this.request != null && $.isFunction(this.request.abort)) {
				// 终止请求
				this.request.abort();
			}

			var data = {};

			data.cart_ids = cart_ids.join(",");

			if (typeof (shop_id) != 'undefined' && shop_id > 0) {
				data.shop_id = shop_id
			}

			this.request = $.post('/cart/select.html', data, function(result) {

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
		// 容器格式必须符合商城SKU的DOM结构dl>dd>ul>li(#id、spec-id、attr-id)
		// @param container 规格所在的DOM容器
		// @param sku_list SKU列表，必须以规格串为KEY
		// @param objects 规格项列表对象
		// @param done_callback SKU存在时的回调函数，参数列表：sku对象，上下文对象为点击的规格DOM
		// @param fail_callback SKU不存在时的回调函数，参数列表：无，上下文对象为点击的规格DOM
		checkSpecs: function(container, sku_list, objects, done_callback, fail_callback) {
			$(objects).click(function() {

				$(this).siblings(".selected").removeClass("selected").find("i").remove();
				$(this).addClass("selected").append("<i></i>");

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

					$(container).find("li").removeClass("no-stock").removeClass("invalid");
					$(container).find("li").parents("dl").removeClass("no-stock-bg");

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
								$(target).parents("dl").addClass("no-stock-bg");
							}
						}
					}

					$(this).siblings("li").removeClass("no-stock");
				}
			}).hover(function() {
				if ($(this).hasClass("no-stock")) {
				} else {
					$(this).addClass("spec-hover");
				}
			}, function() {
				$(this).removeClass("spec-hover");
			});
			;
		}
	};
	// 在线客服
	$.openim = function(options) {

		var name = 'webcall'; // 网页名称，可为空;
		var iWidth = 700; // 弹出窗口的宽度;
		var iHeight = 580; // 弹出窗口的高度;
		// 获得窗口的垂直位置
		var iTop = (window.screen.availHeight - 30 - iHeight) / 2;
		// 获得窗口的水平位置
		var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;

		var win_object = window.open('', name, 'height=' + iHeight + ',,innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no');

		win_object.document.write('<html><head><title>正在连接客服，请稍后...</title><meta charset="utf-8" /><meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" /><link type="text/css" rel="stylesheet" href="/css/common.css" /></head><body><div class="loading"><div class="loading-img"><img src="/images/aliim-loading.gif"></div></div></body></html>');

		var defaults = {
			goods_id: null,
			order_id: null,
			shop_id: null
		};

		options = $.extend(defaults, options);

		var goods_id = options.goods_id;
		var order_id = options.order_id;
		var shop_id = options.shop_id;

		$.get('/user/im/check.html', {}, function(result) {

			// 转向网页的地址;
			var url = '/user/im/open.html';
			if (goods_id) {
				url += '?goods_id=' + goods_id;
			} else if (order_id) {
				url += '?order_id=' + order_id;
			} else if (shop_id) {
				url += '?shop_id=' + shop_id;
			}

			win_object.location = url;

		}, "json");
	}

	$.sidebar.comparebox = {
		// 上次访问的时间戳
		lasttime: 0,
		// 当前购物车盒子中商品的数量
		count: 0,
		// 初始化
		init: function() {
			if ($(".sidebar-comparebox").size() == 0) {
				return;
			}
			$(".sidebar-comparebox-trigger").click(function() {
				var time = new Date().getTime();
				if ($.sidebar.comparebox.lasttime == 0 || time - $.sidebar.comparebox.lasttime > 5 * 1000) {
					$.sidebar.comparebox.load();
				}
			});
		},
		// 加载
		load: function() {
			if ($(".sidebar-comparebox").size() == 0) {
				return;
			}
			$.sidebar.comparebox.lasttime = new Date().getTime();
			$.get("/compare/box-goods-list", {}, function(result) {
				if (result.code == 0) {
					$(".sidebar-comparebox").find(".sidebar-comparebox-goods-list").html(result.data);
				}
			}, "json");
		},
		reset: function() {
			$.sidebar.comparebox.lasttime = 0;
		}
	};

	// 对比
	$.compare = {
		// 添加/移除对比商品
		// @param goods_id 商品编号
		// @param image_url 图片路径
		// @param event 点击事件
		// @param callback 回调函数 result.data=0 已经移除 result.data=1已经加入
		toggle: function(goods_id, image_url, event, callback) {
			$.post('/compare/toggle', {
				goods_id: goods_id
			}, function(result) {
				if (result.code == 0) {
					// 重置
					$.sidebar.comparebox.reset();
					if (result.data == 1) {
						// 飞入
						$.sidebar.fly(image_url, event, $(".sidebar-comparebox-trigger"));
					}
				} else {
					$.msg(result.message);
				}
				// 回调函数
				if ($.isFunction(callback)) {
					callback.call($.compare, result);
				}
			}, "json");
		},
		// 添加对比商品
		// @param goods_id 商品编号
		// @param image_url 图片路径
		// @param event 点击事件
		// @param callback 回调函数
		add: function(goods_id, image_url, event, callback) {
			$.post('/compare/add', {
				goods_id: goods_id
			}, function(result) {
				if (result.code == 0) {
					// 重置
					$.sidebar.comparebox.reset();
					// 飞入
					$.sidebar.fly(image_url, event, $(".sidebar-comparebox-trigger"));

				} else {
					$.msg(result.message);
				}
				// 回调函数
				if ($.isFunction(callback)) {
					callback.call($.compare, result);
				}
			}, "json");
		},
		// 移除对比商品
		remove: function(goods_id, callback) {
			$.post('/compare/remove', {
				goods_id: goods_id
			}, function(result) {
				if (result.code == 0) {
					// 重置
					$.sidebar.comparebox.load();
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}
				// 回调函数
				if ($.isFunction(callback)) {
					callback.call($.compare, result);
				}

				// 回调函数
				if ($.isFunction($.compare.removeCallback)) {
					$.compare.removeCallback.call($.compare, goods_id, result);
				}
			}, "json");
		},
		// 清空对比商品
		clear: function() {
			$.post('/compare/clear', {}, function(result) {
				if (result.code == 0) {
					// 重置
					$.sidebar.comparebox.load();
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}

				if ($.isFunction($.compare.clearCallback)) {
					$.compare.clearCallback.call($.compare, result);
				}
			}, "json");
		},
		// 获取对比商品
		getGoodsList: function(goods_ids, callback) {

			var data = {
				goods_ids: goods_ids
			};

			$.get('/compare/goods-list.html', data, function(result) {

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}
			}, "json");
		},

		// 清空的回调函数
		clearCallback: null,
		// 移除回调函数
		// @param goods_id
		// @param result
		removeCallback: null
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

			$.post('/user/collect/toggle.html', data, function(result) {

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

			$.post('/user/collect/toggle.html', data, function(result) {

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
			$.post('/user/collect/add.html', {
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
			$.post('/user/collect/add.html', {
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
			$.post('/user/collect/remove.html', {
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
			$.post('/user/collect/remove.html', {
				shop_id: shop_id
			}, function(result) {
				$.msg(result.message);

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}

			}, "json");
		},
		getGoodsList: function(goods_ids, sku_ids, callback) {

			if (!sku_ids) {
				sku_ids = 0;
			}

			var data = {
				goods_ids: goods_ids,
				sku_ids: sku_ids
			};

			$.get('/user/collect/goods-list.html', data, function(result) {

				if ($.isFunction(callback)) {
					callback.call(this, result);
				}
			}, "json");
		}
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

	if (!$("body").data("cart-js-init")) {
		// 顶部栏初始化
		$.topbar.init();
		// 初始化侧边栏
		$.sidebar.init();
		// 初始化购物车盒子
		$.cartbox.init();
		// 初始化
		$.sidebar.comparebox.init();
		// 标记
		$("body").data("cart-js-init", true);
	}

})(jQuery);