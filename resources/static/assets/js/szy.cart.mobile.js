/**
 * AJAX后台、卖家中心公共组件
 *
 */

(function ($) {
    var back_url = window.location.href;
    // 网站底部导航
    $.footerbar = {
        // 初始化登录信息
        initLogin: false,
        // 初始化
        init: function () {

            if (window['szy_ajax_user_info_enable'] !== false) {
                var data = {};
                if (typeof (shop_id) != 'undefined' && shop_id > 0) {
                    data.shop_id = shop_id
                }
                $.get('/site/user', data, function (result) {
                    if (result.code == 0 && result.data != null) {

                        var data = result.data;

                        // 重置csrf token值
                        if (data.csrf_token) {

                            $('meta[name=csrf-token]').attr('content', data.csrf_token);
                        }

                        if (data.cart) {
                            if (data.cart.goods_count >= 100) {
                                $(".SZY-CART-COUNT").html('99+');
                            } else {
                                $(".SZY-CART-COUNT").html(data.cart.goods_count);
                            }
                            if (parseInt(data.message.internal_count) >= 100) {
                                $(".SZY-INTERNAL-COUNT").html("99+");
                                $(".SZY-INTERNAL-COUNT").removeClass('hide');
                            } else {
                                if (parseInt(data.message.internal_count) > 0) {
                                    $(".SZY-INTERNAL-COUNT").html(data.message.internal_count);
                                    $(".SZY-INTERNAL-COUNT").removeClass('hide');
                                }
                            }

                            if ($.cartbox) {
                                if (data.cart.goods_count >= 100) {
                                    $.cartbox.count = '99+';
                                } else {
                                    $.cartbox.count = data.cart.goods_count;
                                }
                            }
                        }
                        // 判断是否存在站点
                        if (data.site_id != undefined) {
                            var site_data = {};
                            site_data.site_id = data.site_id;
                            site_data.site_status = data.site_status;
                            site_data.site_name = data.site_change.site_name;
                            site_data.region_code = data.region_code;
                            $.sitebar.init(site_data);
                        }
                        initLogin = true;
                        if (data.user_id > 0) {
                            $("input[name='visiter_id']").val(data.user_id + '_' + data.yikf_user_suffix);
                            $("input[name='visiter_name']").val(data.user_name);
                            $("input[name='avatar']").val(data.headimg);
                        }
                        if (data.domain) {
                            $("input[name='domain']").val(data.domain);
                            $(".site_yikf_form").css('display', 'inline-block');
                        }
                        $.footerbar.sign_in(data.sign_in_entry);

                        // 连接 websocket
                        if (typeof WS_AddUser == "function" && data.sys_msg_cfg_url) {
                            if (data.user_id > 0) {
                                WS_AddUser({
                                    user_id: "user_" + data.user_id,
                                    url: data.sys_msg_cfg_url,
                                    type: "add_user"
                                });
                            } else if (data.session_id) {
                                WS_AddUser({
                                    user_id: "user_" + data.session_id,
                                    url: data.sys_msg_cfg_url,
                                    type: "add_user"
                                });
                            }

                            if (typeof currentUserId == "function") {
                                window.currentUserId = function (ob) {
                                    return data.user_id > 0 ? data.user_id : data.session_id;
                                }
                            }
                        }

                        // 触发请求用户信息事件
                        $(window).trigger("szy.after.request.user.info", [data]);
                    }
                }, "json");
            }
        },
        load: function () {
            // 获取购物车数量
            $.cartbox.lasttime = new Date().getTime();
        },
        // 签到提醒弹框
        sign_in: function (sign_in_entry) {
            // 如果签到开启首页弹框入口设置，并且引入的页面中存在弹框的层框架
            if (sign_in_entry > 0 && $(".sign-frame").length > 0) {
                // 如果用户今天还未操作
                if ($.cookie('signin') == undefined) {
                    $('.sign-layer-box').show();
                    $('.mask1-div').show();
                }
            }
        }
    };

    // 首页站点
    $.sitebar = {
        // 初始化
        init: function (data) {
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
                }, function (r) {
                    if (r.code == 0) {
                        if (r.data.site_id && r.data.site_id != data.site_id) {
                            $.confirm("您当前所在的城市：" + r.data.city + "，是否切换到此城市下的站点", function () {
                                $.go('/subsite/index.html?site_id=' + r.data.site_id + '&back_url=' + back_url);
                            }, function () {
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
        // 获取当前购物车盒子中的商品数量
        getCount: function () {
            if (this.count == 0) {
                var cart_count = $(".cartbox").find(".SZY-CART-COUNT").html();
                if (isNaN(parseInt(cart_count)) == false) {
                    this.count = parseInt(cart_count);
                } else if (cart_count == "99+") {
                    this.count = 100;
                }
            }
            return this.count;
        },
        init: function () {
            $(".cartbox").on('click', '.cart-icon', function () {
                if ($.cartbox.loaded) {
                    $.cartbox.open();
                } else {
                    $.loading.start();
                    var time = new Date().getTime();
                    if ($.cartbox.lasttime == 0 || time - $.cartbox.lasttime > 1000) {
                        $.cartbox.load(function (result) {
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
            $(".cartbox").on('click', '.shop-cart-layer', function () {
                $.cartbox.close();
            });
        },
        // 加载
        load: function (callback) {
            $.cartbox.lasttime = new Date().getTime();

            if ($(".cartbox").size() > 0 && $(".cartbox-layer").size() > 0) {
                if (typeof (shop_id) != 'undefined') {
                    $.cartbox.data = {
                        shop_id: shop_id
                    }
                }
                $.get("/cart/box-goods-list.html", $.cartbox.data, function (result) {
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
        open: function () {
            if ($(".cartbox").find('.cartbox-layer').size() > 0) {
                $(".cartbox").find('.cartbox-layer').removeClass('hide');
                $('.mask-div').show();
                $(".cartbox").find('.cartbox-con').addClass('show');
                $(".cartbox").find('.footer-cart-icon').children('a').addClass('hide');
                $(".cartbox").children('.goods-total-price').css('transform', 'translateX(-60px)');
            }

        },
        close: function () {
            if ($(".cartbox").find('.cartbox-layer').size() > 0) {
                $(".cartbox").find('.cartbox-layer').addClass('hide');
                $('.mask-div').hide();
                $(".cartbox").find('.cartbox-con').removeClass('show');
                $(".cartbox").find('.footer-cart-icon').children('a').removeClass('hide');
                $(".cartbox").children('.goods-total-price').css('transform', 'translateX(0px)');
            }
        },
        // 飞入购物车效果
        fly: function (image_url, event, target, callback) {

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
                        onEnd: function () {
                            $(target).addClass('cart-animate');

                            setTimeout(function () {
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
        add: function (number) {
            var target = this;
            // 计数累计
            target.count = parseInt(target.getCount()) + parseInt(number);
            // 移入刷新
            target.lasttime = 0;
            // 渲染数量
            $.tipsBox({
                obj: $('.SZY-CART-COUNT'),
                str: "+" + number,
                callback: function () {
                    target.renderCount();
                }
            });
        },
        subtract: function (number) {
            // 计数累计
            this.count = parseInt(this.count) - parseInt(number);
            // 移入刷新
            this.lasttime = 0;
            // 渲染数量
            this.renderCount();
        },
        // 渲染数量
        renderCount: function (count) {
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
        quickBuy: function (id, number, options) {

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

                if (options.sku_prop_vids) {
                    data.sku_prop_vids = options.sku_prop_vids;
                }
            }

            // 限购、预售
            if (options && options.act_type > 0) {
                data.act_type = options.act_type;
            }
            // 小程序直播标记，使用的是官方第三方直播间ID
            if (options && options.miniprogram_live_room_id != undefined && options.miniprogram_live_room_id > 0) {
                data.miniprogram_live_room_id = options.miniprogram_live_room_id;
            }

            // 商品特殊属性
            if (options.prop_vids) {
                data.prop_vids = options.prop_vids;
            } else {
                var goods_id = options.is_sku == false ? id : (options.goods_id ? options.goods_id : undefined);

                if (goods_id) {
                    var prop_data = $.cart.getPropData($(".goods-props-choosen-" + goods_id));

                    if (prop_data.invalid) {
                        return;
                    }

                    data.prop_vids = prop_data.checked_prop_vids;

                    if ($.isArray(data.prop_vids)) {
                        data.prop_vids = data.prop_vids.join(",");
                    }
                }
            }

            return $.post('/cart/quick-buy.html', data, function (result) {
                if (result.code == 0) {
                    $.go(result.data);
                } else if (result.code == 1) {
                    $.go('/goods/validate.html');
                } else if (result.code == 2) {
                    // 未绑定手机号先去验证
                    $.msg(result.message, {
                        time: 3000
                    }, function () {
                        $.go('/user/security/edit-mobile.html');
                    });
                    return false;
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function () {
                $.loading.stop()
            });
        },
        // 批量
        batchQuickBuy: function (sku_list, options) {
            $.loading.start();
            var data = {
                sku_list: sku_list,
                goods_id: options.goods_id,
                whole_number: options.whole_number
            };

            // 代客下单
            if (options.replace_order) {
                data.replace_order = options.replace_order;
            }

            // 小程序直播标记，使用的是官方第三方直播间ID
            if (options && options.miniprogram_live_room_id != undefined && options.miniprogram_live_room_id > 0) {
                data.miniprogram_live_room_id = options.miniprogram_live_room_id;
            }

            return $.post('/cart/batch-quick-buy.html', data, function (result) {
                if (result.code == 0) {
                    $.go(result.data);
                } else {
                    $.msg(result.message, {
                        time: 3000
                    });
                }
            }, "json").always(function () {
                $.loading.stop()
            });
        },
        // 选择规格
        chooseSku: function (id, number, options) {
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
                // 是否显示购买的商品数量
                show_number: true,
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

            data.hide_number = options.show_number == false;

            $.loading.start();

            if (options.is_sku) {
                data.sku_id = id;

                return $.post('/cart/choose-sku', data, function (result) {

                    $.cart.loading = false;

                    if (result.code == 0) {

                    } else if (result.code == 94) {
                        // 回调函数
                        if ($.isFunction(options.info_callback)) {
                            options.info_callback.call($.cart, result);
                        } else {
                            setTimeout(function () {
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

                    // 触发购物车添加事件
                    $(document).trigger("szy.cart.add", [data, result]);
                }, "json").always(function () {
                    $.loading.stop();
                });
            } else {
                // 添加商品
                data.goods_id = id;

                return $.post('/cart/choose-sku', data, function (result) {

                    $.cart.loading = false;

                    if (result.code == 0) {

                    } else if (result.code == 98) {

                        $("body").data("choose_sku_callback", options.callback);

                        var scrollheight = 0;
                        scrollheight = $(document).scrollTop();
                        $("body").css("top", "-" + scrollheight + "px");
                        $("body").addClass("visibly");
                        $("body").append(result.data);
                        $(".SZY_ADD_CART_OPTION_X").val(options.event.pageX);
                        $(".SZY_ADD_CART_OPTION_Y").val(options.event.pageY);
                        $(".SZY_CHOOSE_SPEC_SCROLLHEIGHT").val(scrollheight);
                        return;
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

                    // 触发购物车添加事件
                    $(document).trigger("szy.cart.add", [data, result]);

                }, "json").always(function () {
                    $.loading.stop();
                });
            }
        },
        // 添加购物车
        // @param sku_id 商品SKU编号
        // @param number 数量
        // @param options 其他参数 {is_sku-是否为SKU, image_url-图片路径, event-点击事件,
        // callback-回调函数}
        add: function (id, number, options) {

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

            if (number == undefined || number == "") {
                number = 1;
            }
            var data = {
                number: number,
            };

            if (options.shop_id != undefined && options.shop_id != 0) {
                data.shop_id = options.shop_id;
            }

            if (options.client_cart) {
                data.client_cart = options.client_cart;
            }

            // 活动ID
            if (options.act_id != undefined && options.act_id != 0) {
                data.act_id = options.act_id;
                data.act_type = options.act_type;
                data.sku_ids = options.sku_ids;

                if (options.sku_prop_vids) {
                    data.sku_prop_vids = options.sku_prop_vids;
                }

                // 多个商品加入购物车 侧边栏购物车商品数量显示的数量
                if (options.sku_ids.length > 0) {
                    number = number * options.sku_ids.length;
                }
            }
            // 直播
            if (options && options.live_id > 0) {
                data.live_id = options.live_id;
            }

            // 小程序直播标记，使用的是官方第三方直播间ID
            if (options && options.miniprogram_live_room_id != undefined && options.miniprogram_live_room_id > 0) {
                data.miniprogram_live_room_id = options.miniprogram_live_room_id;
            }

            // 商品特殊属性
            if (options.prop_vids) {
                data.prop_vids = options.prop_vids;
            } else {
                var goods_id = options.is_sku == false ? id : (options.goods_id ? options.goods_id : undefined);

                if (goods_id) {
                    var prop_data = $.cart.getPropData($(".goods-props-choosen-" + goods_id));

                    if (prop_data.invalid) {

                        this.loading = false;

                        return new Promise(function (resolve, reject) {
                            reject(prop_data);
                        });
                    }

                    data.prop_vids = prop_data.checked_prop_vids;

                    if ($.isArray(data.prop_vids)) {
                        data.prop_vids = data.prop_vids.join(",");
                    }
                }
            }

            if (options.is_sku) {
                data.sku_id = id;

                $.loading.start();

                return $.post('/cart/add', data, function (result) {

                    $.cart.loading = false;

                    if (result.code == 0) {
                        // 飞入购物车
                        $.cartbox.fly(options.image_url, options.event, $(".cartbox"), function (show_add_message) {

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
                            setTimeout(function () {
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

                    // 触发购物车添加事件
                    $(document).trigger("szy.cart.add", [data, result]);

                }, "json").always(function () {
                    $.loading.stop();
                });
            } else {
                // 添加商品
                data.goods_id = id;

                $.loading.start();

                return $.post('/cart/add', data, function (result) {

                    $.cart.loading = false;

                    if (result.code == 0) {

                        // 飞入购物车
                        $.cartbox.fly(options.image_url, options.event, $(".cartbox"), function (show_add_message) {

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
                        if (typeof (options.event) !== "undefined") {
                            $(".SZY_ADD_CART_OPTION_X").val(options.event.pageX);
                            $(".SZY_ADD_CART_OPTION_Y").val(options.event.pageY);
                        }
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

                    // 触发购物车添加事件
                    $(document).trigger("szy.cart.add", [data, result]);

                }, "json").always(function () {
                    $.loading.stop();
                });
            }

        },
        // 礼品
        addGift: function (goods_id, sku_id, options) {

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
                is_sku: options.is_sku,
                gift: 1
            };

            if (options.shop_id != undefined && options.shop_id != 0) {
                data.shop_id = options.shop_id;
            }

            var id = goods_id;

            // 商品特殊属性
            if (options.prop_vids) {
                data.prop_vids = options.prop_vids;
            } else {
                var goods_id = options.is_sku == false ? id : (options.goods_id ? options.goods_id : undefined);

                if (goods_id) {
                    var prop_data = $.cart.getPropData($(".goods-props-choosen-" + goods_id));

                    if (prop_data.invalid) {

                        this.loading = false;

                        return new Promise(function (resolve, reject) {
                            reject(prop_data);
                        });
                    }

                    data.prop_vids = prop_data.checked_prop_vids;

                    if ($.isArray(data.prop_vids)) {
                        data.prop_vids = data.prop_vids.join(",");
                    }
                }
            }

            // 添加商品
            return $.post('/cart/add-gift.html', data, function (result) {

                if (result.code == 0) {
                    // 跳转到结算页面
                    $.post('/cart/quick-buy.html', data, function (result) {
                        if (result.code == 0) {
                            $.go(result.data);
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, "json").always(function () {
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
        // sku_list ['{sku_id}-{number}','{sku_id}-{number}','{sku_id}-{number}']
        batch_add: function (sku_list, options) {
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

            // 小程序直播标记，使用的是官方第三方直播间ID
            if (options && options.miniprogram_live_room_id != undefined && options.miniprogram_live_room_id > 0) {
                data.miniprogram_live_room_id = options.miniprogram_live_room_id;
            }
            return $.post('/cart/batch-add.html', data, function (result) {
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
        remove: function (data, callback) {

            if (this.request != null && $.isFunction(this.request.abort)) {
                // 终止请求
                this.request.abort();
            }

            this.request = $.post('/cart/remove', data, function (result) {
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

                // 触发购物车移除事件
                $(document).trigger("szy.cart.remove", [data, result]);

            }, "json");

            return this.request;
        },
        // 从购物车中删除
        del: function (cart_ids, callback) {

            if (this.request != null && $.isFunction(this.request.abort)) {
                // 终止请求
                this.request.abort();
            }

            var data = {};
            data.cart_ids = cart_ids;
            if (typeof (shop_id) != 'undefined' && shop_id > 0) {
                data.shop_id = shop_id
            }

            this.request = $.post('/cart/delete', data, function (result) {

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
        subtract: function (goods_id, number, options, callback) {

            var data = {
                goods_id: goods_id,
                number: number
            };

            if (options.shop_id != undefined && options.shop_id != 0) {
                data.shop_id = options.shop_id;
            }
            $.post('/cart/remove', data, function (result) {

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
         * 获取选中的规格ID
         *
         * @params container 容器
         */
        getSpecIds: function (container) {
            var spec_ids = [];

            if (!container) {
                container = $(".SZY-GOODS-SPEC-ITEMS");
            }

            $(container).find(".attr").each(function () {
                var spec_id = $(this).find(".selected").data("spec-id");
                if (spec_id) {
                    spec_ids.push(spec_id);
                }
            });

            return spec_ids;
        },
        /**
         * 根据规格串的数组获取SKU编号
         *
         * @params array spec_ids 规格串的数组
         * @params array sku_ids 以SKU规格串为Key，包含“sku_id”属性的数组
         */
        getSkuId: function (spec_ids, sku_ids) {

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
        /**
         * 获取当前选中的SKU ID
         *
         * @params array sku_ids 以SKU规格串为Key，包含“sku_id”属性的数组
         * @params Element container 容器对象
         */
        getCheckedSkuId: function (sku_list, container) {
            var spec_ids = $.cart.getSpecIds(container);
            var sku_id = $.cart.getSkuId(spec_ids, sku_list);

            if (sku_id == null) {
                return null;
            }

            return sku_id;
        },
        // 改变购物车中商品数量
        // @param sku_id SKU商品编号
        // @param number 变更后的数量
        // @param callback 变更后的回调函数
        changeNumber: function (sku_id, number, cart_id, callback) {

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

            this.request = $.post('/cart/change-number', data, function (result) {
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
        select: function (cart_ids, options, callback) {

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

            this.request = $.post('/cart/select', data, function (result) {

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
        // 发起 AJAX 请求获取选中的SKU的对象
        // @params params {sku_id, prop_vids, is_lib_goods}
        // @return Promise
        getSku: function (params) {

            // 商品属性
            if (params.prop_vids) {
                if ($.isArray(params.prop_vids)) {
                    params.prop_vids = params.prop_vids.join(",");
                }
            }

            var sku_id = params.sku_id;
            var prop_vids = params.prop_vids;

            var cache_key = "SZY-SKU-" + sku_id + "-" + prop_vids;

            if ($(document).data(cache_key)) {
                var sku = $(document).data(cache_key);

                return new Promise(function (resolve, reject) {
                    resolve(sku);
                });
            } else {

                if ($.isPlainObject(params)) {
                    for (var name in params) {
                        if (params[name] == undefined) {
                            delete params[name];
                        }
                    }
                }

                return new Promise(function (resolve, reject) {
                    $.loading.start();
                    $.get('/goods/sku', params, function (result) {
                        if (result.code == 0) {
                            var sku = result.data;
                            // 缓存
                            $(document).data(cache_key, sku);
                            // 回调
                            resolve(sku);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                            // 错误回调
                            reject(result);
                        }
                    }, "json").always(function () {
                        $.loading.stop();
                    });
                });
            }
        },
        // 检查SKU组合
        // 容器格式必须符合商城SKU的DOM结构dl>dd>ul>li(#id、spec-id、attr-id)
        // @param container 规格所在的DOM容器
        // @param sku_list SKU列表，必须以规格串为KEY
        checkSkus: function (container, sku_list) {
            var item_list = $(container).find("li.selected");

            var size = item_list.length;

            for (var i = 0; i < size; i++) {

                var list = [];

                var spec_ids = [];

                for (var j = 0; j < size; j++) {
                    if (i == j) {
                        continue;
                    }
                    var spec_id = $(item_list[j]).data("spec-id");

                    if (spec_id == undefined) {
                        return;
                    }

                    spec_ids.push(spec_id);
                }

                $(item_list[i]).parents("ul").find("li").not(".selected").each(function () {

                    var spec_id = $(this).data("spec-id");

                    if (spec_id == undefined) {
                        return;
                    }

                    spec_ids[size - 1] = spec_id;
                    var sku_id = $.cart.getSkuId(spec_ids, sku_list);
                    if (sku_id) {
                        $(this).removeClass("no-stock");
                    } else {
                        $(this).addClass("no-stock");
                    }
                });
            }
        },
        /**
         * 构建 SKU 相关的函数
         * @param sku_list
         * @param container
         * @returns {{getSkuData: ((function(*=): (*|null))|*), getSkuId: (function(): *)}}
         */
        buildSkuFuncs: function (sku_list, container) {

            if (!container) {
                container = $(".SZY-GOODS-SPEC-ITEMS");
            }

            return {
                // 获取选中的 sku_id
                getSkuId: function () {
                    return $.cart.getCheckedSkuId(sku_list, container);
                },
                // 根据 sku_list 获取 sku 数据
                getSkuData: function (sku_id) {

                    if (!sku_id) {
                        sku_id = $.cart.getCheckedSkuId(sku_list, container);
                    }

                    for (var spec_id in sku_list) {
                        var sku = sku_list[spec_id];

                        if (sku.sku_id == sku_id) {
                            return sku;
                        }
                    }

                    return null;
                }
            };
        },
        // 点击规格事件
        checkSpecs: function (options) {
            var defaults = {
                // SKU列表，必须以规格串为KEY
                sku_list: [],
                // 容器格式必须符合商城SKU的DOM结构dl>dd>ul>li(#id、spec-id、attr-id)
                container: $(".SZY-GOODS-SPEC-ITEMS"),
                // 规格项列表对象
                objects: $(".SZY-GOODS-SPEC-ITEMS").find("li"),
                // 发起AJAX请求获取SKU信息时参数的回调函数
                params_callback: function (params) {
                    return params;
                },
                // SKU存在时的回调函数，参数列表：sku对象，上下文对象为点击的规格DOM
                done_callback: function (sku) {

                },
                // SKU不存在时的回调函数，参数列表：无，上下文对象为点击的规格DOM
                fail_callback: function (result) {

                },
                // 支持自定义获取 SKU 的信息，必须返回一个 Promise 对象
                // @params object params
                // @params object sku_list
                // @params object container
                // @return Promise
                getSkuInfo: null
            };

            options = $.extend(true, {}, defaults, options);

            return $.cart.checkSpecsFunc(options.container, options.sku_list, options.objects, options.done_callback, options.fail_callback, options.params_callback, options.getSkuInfo);
        },
        // 点击规格事件
        // 容器格式必须符合商城SKU的DOM结构dl>dd>ul>li(#id、spec-id、attr-id)
        // @param container 规格所在的DOM容器
        // @param sku_list SKU列表，必须以规格串为KEY
        // @param objects 规格项列表对象
        // @param ajax_params_callback 发起AJAX请求获取SKU信息时参数的回调函数
        // @param done_callback SKU存在时的回调函数，参数列表：sku对象，上下文对象为点击的规格DOM
        // @param fail_callback SKU不存在时的回调函数，参数列表：无，上下文对象为点击的规格DOM
        // @param getSku 获取 SKU 信息的接口
        checkSpecsFunc: function (container, sku_list, objects, done_callback, fail_callback, ajax_params_callback, getSkuInfo) {
            $(objects).click(function () {

                // 当前点击对象
                var target = this;

                // 判断是否为规格
                var is_spec_item = $(this).data("spec-id") != undefined;

                if (is_spec_item) {
                    $(this).siblings(".selected").removeClass("selected").find("i").remove();
                    $(this).addClass("selected").append("<i></i>");
                } else {
                    // 属性
                    var multi_enable = $(this).parents(".prop").data("multi_enable");

                    if ($(this).hasClass("selected")) {
                        $(this).removeClass("selected");
                    } else {
                        if (multi_enable == '0') {
                            $(this).siblings(".selected").data("selected", false).removeClass("selected");
                        }
                        $(this).addClass("selected");
                    }
                }

                var spec_ids = [];
                // 是否启用了特殊属性
                var prop_enable = false;
                // 属性值ID：仅当每个属性存在至少一个被选中的时候则有值
                var prop_vids = [];
                // 是否存在未选中的属性
                var prop_unchecked_exists = false;

                $(container).find("ul").each(function () {

                    var is_prop = $(this).data("prop_id") != undefined;
                    var prop_checked_num = 0;

                    $(this).find("li.selected").each(function () {
                        // 规格
                        var spec_id = $(this).data("spec-id");
                        if (spec_id) {
                            spec_ids.push(spec_id);
                            return;
                        }
                        // 属性
                        var prop_vid = $(this).data("prop_vid");
                        if (prop_vid) {
                            prop_vids.push(prop_vid);
                            prop_checked_num += 1;
                        }
                    });

                    if (is_prop && prop_checked_num == 0) {
                        prop_unchecked_exists = true;
                    }

                    if (is_prop) {
                        prop_enable = true;
                    }
                });

                if (prop_unchecked_exists) {
                    prop_vids = [];
                } else {
                    // 排序
                    prop_vids = prop_vids.sort(function (a, b) {
                        return a < b ? -1 : 1;
                    });
                }

                var sku_id = $.cart.getSkuId(spec_ids, sku_list);

                if (sku_id) {

                    $(this).siblings("li").removeClass("no-stock").parents("dl").removeClass("no-stock-bg");
                    $.cart.checkSkus(container, sku_list);

                    var sku = null;

                    for (var spec_id in sku_list) {
                        if (sku_list[spec_id].sku_id == sku_id) {
                            sku = sku_list[spec_id];
                            break;
                        }
                    }

                    if (sku) {
                        sku['prop_vids'] = prop_vids;
                    }

                    var params = {
                        sku_id: sku_id,
                        prop_vids: prop_vids.join(","),
                    };

                    var is_lib_goods = $("meta[name='is_lib_goods']").attr("content") == "yes";

                    if (is_lib_goods) {
                        params.is_lib_goods = '1';
                    }

                    if ($.isFunction(ajax_params_callback)) {
                        // 上下文为点击的DOM元素
                        var params_temp = ajax_params_callback.call(target, params);
                        if (params_temp) {
                            params = $.extend(true, params, params_temp);
                        }
                    }

                    var get_sku_promise = null;

                    // 是否自定义了获取 sku 信息的接口
                    if ($.isFunction(getSkuInfo)) {
                        get_sku_promise = getSkuInfo(params, sku_list, container);
                    } else {
                        get_sku_promise = $.cart.getSku(params, sku_list, container);
                    }

                    get_sku_promise.then(function (sku) {

                        // 默认规格
                        var is_default = $(target).data("is-default") || $(target).data("is_default");

                        sku.is_default = is_default ? 1 : 0;

                        if (sku.is_default == 0) {
                            sku.is_default = $(target).find("img").size() > 0 ? 1 : 0;
                        }

                        if ($.isFunction(done_callback)) {
                            // 上下文为点击的DOM元素
                            done_callback.call(target, sku);
                        }
                        // 触发规格变更事件
                        $(window).trigger("szy.choose.spec.change", [sku]);
                    }).catch(function (result) {
                        if ($.isFunction(fail_callback)) {
                            // 上下文为点击的DOM元素
                            fail_callback.call(target, result);
                        }
                    });

                } else if (is_spec_item) {

                    if ($.isFunction(fail_callback)) {
                        // 上下文为点击的DOM元素
                        fail_callback.call(target);
                    }

                    var spec_ids = [];

                    var spec_id = $(this).data("spec-id") + "";
                    var attr_id = $(this).data("attr-id") + "";

                    $(container).find("li").removeClass("no-stock").removeClass("disable");
                    $(container).find("li").parents(".attr").removeClass("no-stock-bg");

                    for (var key in sku_list) {
                        if (key == "") {
                            continue;
                        }

                        var ids = key.split("|");

                        if ($.inArray(spec_id, ids) != -1) {
                            spec_ids = $.merge(spec_ids, ids);
                        }
                    }

                    spec_ids = $.unique(spec_ids, ids);

                    for (var key in sku_list) {
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

            return {
                // 获取选中的 sku_id
                getSkuId: function () {
                    return $.cart.getCheckedSkuId(sku_list, container);
                },
                // 根据 sku_list 获取 sku 数据
                getSkuData: function (sku_id) {

                    if (!sku_id) {
                        sku_id = $.cart.getCheckedSkuId(sku_list, container);
                    }

                    for (var spec_id in sku_list) {
                        var sku = sku_list[spec_id];

                        if (sku.sku_id == sku_id) {
                            return sku;
                        }
                    }

                    return null;
                },
                // 获取 sku 的函数
                // @params object params {sku_id, prop_vids, ...}
                // @return Promise
                getSkuInfo: function (params) {

                    // 不传则获取当前选择的 sku
                    if (params == null || params == undefined) {
                        params = {
                            sku_id: $.cart.getCheckedSkuId(sku_list, container)
                        }
                    }

                    if (typeof params == "number" || typeof params == "string") {
                        params = {
                            sku_id: params
                        };
                    }

                    // 是否自定义了获取 sku 信息的接口
                    if ($.isFunction(getSkuInfo)) {
                        return getSkuInfo(params, sku_list, container);
                    }

                    return $.cart.getSku(params, sku_list, container);
                },
                // 获取当前属性值数据
                getPropData: function (error_callback) {
                    return $.cart.getPropData(container, error_callback);
                }
            };
        },
        // 获取选中的属性信息
        getPropData: function (container, error_callback) {

            var checked_prop_list = [];
            var checked_prop_vids = [];
            var checked_prop_vnames = [];
            var checked_prop_amount = 0;
            var unchecked_prop_names = [];

            if ($(container).hasClass(".prop") == false) {
                container = $(container).find(".prop");
            }

            $(container).each(function () {

                var prop_id = $(this).data("prop_id");
                var prop_name = $(this).data("prop_name");
                var multi_enable = $(this).data("multi_enable");

                if ($(this).find("li.selected").size() == 0) {
                    unchecked_prop_names.push($(this).data("prop_name"));
                } else {
                    $(this).find("li.selected").each(function () {

                        var item = {
                            prop_id: prop_id,
                            prop_name: prop_name,
                            prop_vid: $(this).data("prop_vid"),
                            prop_vname: $(this).data("prop_vname"),
                            prop_price: $(this).data("prop_price"),
                            prop_price_format: $(this).data("prop_price_format"),
                        };

                        checked_prop_list.push(item);
                        checked_prop_vids.push(item.prop_vid);

                        if (item.prop_price) {
                            checked_prop_amount += parseFloat(item.prop_price);
                            checked_prop_vnames.push(item.prop_vname + "+" + item.prop_price_format);
                        } else {
                            checked_prop_vnames.push(item.prop_vname);
                        }
                    });
                }
            });

            // 排序
            var prop_vids = checked_prop_vids.sort(function (a, b) {
                return a < b ? -1 : 1;
            });

            var data = {
                invalid: unchecked_prop_names.length > 0,
                checked_prop_list: checked_prop_list,
                checked_prop_vids: checked_prop_vids,
                checked_prop_vnames: checked_prop_vnames,
                unchecked_prop_names: unchecked_prop_names,
                checked_prop_amount: checked_prop_amount,
                prop_vids: prop_vids.join(",")
            };

            if (unchecked_prop_names.length > 0) {

                var message = "请选择" + unchecked_prop_names.join("、 ");

                if ($.isFunction(error_callback)) {
                    error_callback(message, data);
                } else {
                    $.msg(message);
                }
            }

            return data;
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
        toggleGoods: function (goods_id, sku_id, callback, show_count) {
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

            $.post('/user/collect/toggle', data, function (result) {

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
        toggleShop: function (shop_id, callback, show_count) {

            var data = {
                shop_id: shop_id
            };

            if (show_count) {
                data.show_count = 1;
            }

            $.post('/user/collect/toggle', data, function (result) {

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
        addGoods: function (goods_id, sku_id, callback) {
            if (!sku_id) {
                sku_id = 0;
            }
            $.post('/user/collect/add', {
                goods_id: goods_id,
                sku_id: sku_id
            }, function (result) {

                $.msg(result.message, {
                    icon_type: 1
                });

                if ($.isFunction(callback)) {
                    callback.call(this, result);
                }

            }, "json");
        },
        // 批量收藏
        batchAddGoods: function (goods_ids, callback) {

            $.post('/user/collect/batch-add-goods', {
                goods_ids: goods_ids,

            }, function (result) {

                $.msg(result.message);

                if ($.isFunction(callback)) {
                    callback.call(this, result);
                }

            }, "json");
        },
        // 添加收藏
        addShop: function (shop_id, callback) {
            $.post('/user/collect/add', {
                shop_id: shop_id
            }, function (result) {
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
        removeGoods: function (goods_id, sku_id, callback) {
            $.post('/user/collect/remove', {
                goods_id: goods_id,
                sku_id: sku_id
            }, function (result) {
                $.msg(result.message);

                if ($.isFunction(callback)) {
                    callback.call(this, result);
                }

            }, "json");
        },
        removeShop: function (shop_id, callback) {
            $.post('/user/collect/remove', {
                shop_id: shop_id
            }, function (result) {
                $.msg(result.message);

                if ($.isFunction(callback)) {
                    callback.call(this, result);
                }

            }, "json");
        }
    };

    $().ready(function () {
        // 初始化底部导航栏
        $.footerbar.init();
        // 初始化购物车盒子
        $.cartbox.init();
    });

    // 在线客服
    $.openim = function (options) {
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

        $.get("/user/im/check", {}, function (result) {
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
        receive: function (bonus_id, callback) {
            return $.post("/user/bonus/receive.html", {
                bonus_id: bonus_id
            }, function (result) {
                if ($.isFunction(callback)) {
                    callback.call(this, result);
                }
            }, "JSON");
        }
    };

    // +1特效
    $.extend({
        tipsBox: function (options) {
            options = $.extend({
                obj: null, // jq对象，要在那个html标签上显示
                str: "+1", // 字符串，要显示的内容;也可以传一段html，如: "<b
                // style='font-family:Microsoft YaHei;'>+1</b>"
                startSize: "10px", // 动画开始的文字大小
                endSize: "20px", // 动画结束的文字大小
                interval: 600, // 动画时间间隔
                color: "#F56456", // 文字颜色
                callback: function () {
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
                    "font-weight": 'bold',
                    "font-size": options.startSize,
                    "line-height": options.endSize,
                    "color": options.color
                });
                box.animate({
                    "font-size": options.endSize,
                    "opacity": "0",
                    "top": top - parseInt(options.endSize) + "px"
                }, options.interval, function () {
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

    /**
     * sku活动倒计时label渲染
     * @param settings
     * @returns {*}
     */
    $.renderGoodsActivityInfo = function (settings) {
        var defaults = {
            // 活动类型
            type: 0,  // 活动类型
            label: '', // 活动标题
            subLabel: '', // 活动副标题
            act_status: 0, // 活动状态
            price_type: '',
            cutdown_time: '', // 活动倒计时
            end_time: '',// 活动结束时间
            // 是否
            is_finish: 0, // 是否完成
            is_not_act: 0, // 是否不是活动
            // 活动倒计时
            countdown: 0, // 倒计时
            sku_open: 0,
            exchange_goods: '',
            // 倒计时结束回调函数
            countdownComplete: null,
            render: function () {
                switch (this.type) {
                    case '3':
                        // 团购
                        this.renderGroupBuy();
                        break;
                    case '11':
                        // 限时折扣
                        this.renderLimitDiscount();
                        break;
                    case '':
                        this.randerNormal();
                        break;
                    default:
                        break;
                }
            },
            makeNormalGoodsPriceHtml: function () {
                // sku没有活动价格
                normal_html = '<div class="goods-price">\n' +
                    '\t\t<div class="now-prices">\n' +
                    '\t\t\t<em class="SZY-GOODS-PRICE price-color">' + settings.goods_price_format + '</em>\n';
                if (settings.floor_price == 0 || settings.floor_price == '') {
                    normal_html += '\t\t\t<del class="SZY-MARKET-PRICE" style="display: none;"></del>\n';
                } else {
                    normal_html += '\t\t\t<del class="SZY-MARKET-PRICE"></del>\n';
                }
                normal_html += '\t\t</div>\n';
                if (settings.show_sale_number) {
                    normal_html += '\t\t<span class="sold">销量：' + settings.goods_sale_num + settings.goods_unit + '</span>\n';
                }
                normal_html += '\t</div>';
                return normal_html;
            },
            // 团购 3
            renderGroupBuy: function () {
                defaults
                var html = '';
                var normal_html = '';
                var uuid = $.uuid();
                if (settings.is_not_act == 1) {
                    // 显示价格html
                    normal_html = this.makeNormalGoodsPriceHtml();
                    $(".goods_activity_temp").html(normal_html);
                    $(".goods-activity-type-group-buy-temp").hide();
                } else if (settings.is_finish == 1 && settings.is_not_act == 0 && settings.exchange_goods == '') {
                    // 团购已开始
                    html += '<div class="goods-promotion-box clearfix">';
                    html += '<div class="goods-promotion-left">\n' +
                        '\t\t\t<dt>\n' +
                        '\t\t\t\t<em class="SZY-GOODS-PRICE">' + settings.min_price;
                    if (settings.sku_open == 1) {
                        html += '<i>起</i>';
                    }
                    html += '</em>\n' +
                        '\t\t\t</dt>\n' +
                        '\t\t\t<dd>\n' +
                        '\t\t\t\t<p>\n' +
                        '\t\t\t\t\t<del>' + settings.sku.original_price_format + '</del>\n' +
                        '\t\t\t\t</p>\n' +
                        '\t\t\t\t<span>\n' +
                        '\t\t\t\t\t ' + settings.sku.activity.total_sale_count + '<em>已售</em>\n' +
                        '\t\t\t\t</span>\n' +
                        '\t\t\t</dd>\n' +
                        '\t\t</div>\n' +
                        '\t\t<div class="goods-promotion-right">\n' +
                        '\t\t\t<div class="goods-promotion-text">距结束仅剩</div>\n' +
                        '\t\t\t<div class="goods-promotion-time" id="groupbuy_countdown_' + uuid + '">\n' +
                        '\t\t\t\t<span class="time">00</span>\n' +
                        '\t\t\t\t<span class="separator">:</span>\n' +
                        '\t\t\t\t<span class="time">00</span>\n' +
                        '\t\t\t\t<span class="separator">:</span>\n' +
                        '\t\t\t\t<span class="time">00</span>\n' +
                        '\t\t\t\t<span class="separator">:</span>\n' +
                        '\t\t\t\t<span class="time">00</span>\n' +
                        '\t\t\t</div>\n' +
                        '\t\t</div>';
                    html += '</div>';

                    $(".goods-activity-type-group-buy-temp").html(html);
                    $(".goods-activity-type-group-buy-temp").show();
                    $(".goods-price").hide();
                    var gmtime = Math.round(new Date().getTime() / 1000).toString();
                    var make_time = (settings.end_time - gmtime) * 1000;

                    // 调用倒计时
                    $("#groupbuy_countdown_" + uuid).countdown({
                        time: make_time,
                        leadingZero: true,
                        htmlTemplate: "<span class='time'>%{d}天</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                        onComplete: function (event) {
                            if ($.isFunction(settings.countdownComplete)) {
                                settings.countdownComplete.call(settings);
                            } else {
                                (this).parent('.goods-promotion-right').html("团购活动已结束！");
                                windows.location.reload();
                                // $.go("/goods-{$goods.goods_id}.html");
                            }
                            //$(this).parent().html("活动已结束！");
                        }
                    });
                } else if (settings.is_finish == 0 && settings.is_not_act == 0 && settings.exchange_goods == '') {
                    // 团购未开始
                    html += '<div class="goods-promotion-box clearfix goods-promotion-coming">';
                    html += '<div class="goods-promotion-left">\n' +
                        '\t\t\t<dt>\n' +
                        '\t\t\t\t<em class="SZY-GOODS-PRICE">' + settings.min_price;
                    if (settings.sku_open == 1) {
                        html += '<i>起</i>';
                    }
                    html += '</em>\n' +
                        '\t\t\t</dt>\n' +
                        '\t\t\t<dd>\n' +
                        '\t\t\t\t<p>\n' +
                        '\t\t\t\t\t团购价<del>' + settings.sku.original_price_format + '</del>\n' +
                        '\t\t\t\t</p>\n' +
                        '\t\t\t\t<span>\n' +
                        '\t\t\t\t\t ' + settings.sale_num + '<em>已售</em>\n' +
                        '\t\t\t\t</span>\n' +
                        '\t\t\t</dd>\n' +
                        '\t\t</div>\n' +
                        '\t\t<div class="goods-promotion-right">\n' +
                        '\t\t\t<div class="goods-promotion-text">距开团还剩</div>\n' +
                        '\t\t\t<div class="goods-promotion-time" id="groupbuy_countdown_' + uuid + '">\n' +
                        '\t\t\t\t<span class="time">00</span>\n' +
                        '\t\t\t\t<span class="separator">:</span>\n' +
                        '\t\t\t\t<span class="time">00</span>\n' +
                        '\t\t\t\t<span class="separator">:</span>\n' +
                        '\t\t\t\t<span class="time">00</span>\n' +
                        '\t\t\t\t<span class="separator">:</span>\n' +
                        '\t\t\t\t<span class="time">00</span>\n' +
                        '\t\t\t</div>\n' +
                        '\t\t</div>';
                    html += '</div>';

                    $(".goods-activity-type-group-buy-temp").html(html);
                    $(".goods-activity-type-group-buy-temp").show();
                    var gmtime = Math.round(new Date().getTime() / 1000).toString();
                    var make_time = (settings.end_time - gmtime) * 1000;

                    // 调用倒计时
                    $("#groupbuy_countdown_" + uuid).countdown({
                        time: make_time,
                        leadingZero: true,
                        htmlTemplate: "<span class='time'>%{d}天</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                        onComplete: function (event) {
                            if ($.isFunction(settings.countdownComplete)) {
                                settings.countdownComplete.call(settings);
                            } else {
                                (this).parent('.goods-promotion-right').html("团购活动已结束！");
                                windows.location.reload();
                                // $.go("/goods-{$goods.goods_id}.html");
                            }
                            //$(this).parent().html("活动已结束！");
                        }
                    });
                } else {
                    $(".goods-promotion-box").html(html);
                }
            },
            // 限时折扣 11
            renderLimitDiscount: function () {
                var html = '';
                var uuid = $.uuid();
                if (settings.price_type == 'activity_price' && settings.is_not_act == 0) {
                    // 价格
                    html += '<div class="goods-price">\n' +
                        '\t\t\t\t<div class="now-prices">\n' +
                        '\t\t\t\t\t<em class="SZY-GOODS-PRICE price-color">'+settings.goods_price_format+'</em>\n';
                    if (settings.floor_price == 0 || settings.floor_price == '') {
                        html += '\t\t\t\t\t<del class="SZY-MARKET-PRICE"style="display: none;">' + settings.floor_price_format + '</del>\n';
                    } else {
                        html += '\t\t\t\t\t<del class="SZY-MARKET-PRICE">' + settings.floor_price_format + '</del>\n';
                    }
                    html += '\t\t\t\t</div>\n';
                    if (settings.show_sale_number) {
                        html += '\t\t\t\t\t<span class="sold">销量：' + settings.goods_sale_num + '</span>\n';
                    }
                    html += '</div>\n';

                    // 生成html
                    html += '<div class="limit-discount-con">\n' +
                        '\t\t\t\t\t<span class="limit-discount-tag">\n' +
                        '\t\t\t\t\t\t<i class="label-icon-div">\n' +
                        '\t\t\t\t\t\t\t<i class="label-icon"></i>\n' +
                        '\t\t\t\t\t\t\t<span class="label-text">' + settings.label + '</span>\n' +
                        '\t\t\t\t\t\t</i>\n' +
                        '\t\t\t\t\t</span>\n' +
                        '\t\t\t\t\t<span class="activity-text">\n';
                    if (settings.act_status == 1) {
                        html += '<em class="discount">' + settings.subLabel + '</em>\n' +
                            '\t\t\t\t\t\t\t<span id="limit_discount_countdown_' + uuid + '" class="promotion-time">\n' +
                            '\t\t\t\t\t\t\t<span class="time">00</span>\n' +
                            '\t\t\t\t\t\t\t<span class="separator">:</span>\n' +
                            '\t\t\t\t\t\t<span class="time">00</span>\n' +
                            '\t\t\t\t\t\t\t<span class="separator">:</span>\n' +
                            '\t\t\t\t\t\t<span class="time">00</span>\n' +
                            '\t\t\t\t\t\t\t<span class="separator">:</span>\n' +
                            '\t\t\t\t\t\t<span class="time">00</span>\n' +
                            '\t\t\t\t\t\t\t</span>\n' +
                            '\t\t\t\t\t\t\t<em>后结束，请尽快购买！</em>';
                    } else {
                        html += '<em class="discount">' + settings.subLabel + '</em>\n' +
                            '\t\t\t\t\t\t<!--  -->\n' +
                            '\t\t\t\t\t\t预计<span id="groupbuy_countdown">{\'Y-m-d H:i:s\'|local_date:$sku.activity.cutdown_time}</span>开始';
                    }
                    html += '</span></div>';

                    var gmtime = Math.round(new Date().getTime() / 1000).toString();
                    var make_time = (this.cutdown_time - gmtime) * 1000;
                    $(".goods_activity_temp").html(html);
                    // 调用倒计时
                    if (settings.act_status == 1) {
                        $("#limit_discount_countdown_" + uuid).countdown({
                            time: make_time,
                            leadingZero: true,
                            htmlTemplate: "<span class='time'>%{d}天</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                            onComplete: function (event) {
                                if ($.isFunction(settings.countdownComplete)) {
                                    settings.countdownComplete.call(settings);
                                } else {
                                    windows.location.reload();
                                    // $.go("/goods-{$goods.goods_id}.html");
                                }
                                //$(this).parent().html("活动已结束！");
                            }
                        });
                    } else {
                        $("#groupbuy_countdown").countdown({
                            time: make_time,
                            leadingZero: true,
                            htmlTemplate: "<span class='time'>%{d}天</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                            onComplete: function (event) {
                                $(this).parent('.goods-promotion-right').html("团购活动已结束！");
                                $.go("{goods_url($goods.goods_id)}");
                            }
                        });
                    }
                } else {
                    this.randerNormal();
                }
            },
            //
            randerNormal: function () {
                if (settings.is_not_act == 1) {
                    // 显示价格html
                    normal_html = this.makeNormalGoodsPriceHtml();
                    $(".goods_activity_temp").html(normal_html);
                    // 隐藏团购倒计时
                    $(".goods-activity-type-group-buy-temp").hide();
                }

            }
        };

        settings = $.extend(defaults, settings);
        settings.render();
        return settings;
    }

})(jQuery);