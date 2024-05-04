var scrollheight = 0;
// JavaScript Document
$(function () {

    // 商品选择框
    $("body").on('click', '.goods-checkbox', function () {
        var shop_id = $(this).data("shop-id");
        if ($(this).hasClass('select')) {
            $(this).removeClass('select');
            $(this).find(":checkbox").prop("checked", false);
            $('#cart_shop_' + shop_id).find(".shop-checkbox").removeClass('select'); // 店铺全选取消
            $('.all-checkbox').removeClass('select'); // 全选取消
        } else {
            $(this).addClass('select');
            $(this).find(":checkbox").prop("checked", true);

            if ($("#cart_shop_" + shop_id).find(":checkbox").size() == $("#cart_shop_" + shop_id).find(":checkbox:checked").size()) {
                $("#cart_shop_" + shop_id).find(".shop-checkbox").addClass('select'); // 店铺全选选中
            }

            if ($("#cart_list").find(":checkbox").size() == $("#cart_list").find(":checkbox:checked").size()) {
                $('.all-checkbox').addClass('select'); // 全选选中
            }
        }
        $(".cart-disable").find(".cart-checkbox").removeClass("select");
        select();
    });

    $("body").on('click', '.whole-checkbox', function () {
        var shop_id = $(this).data("shop-id");
        var goods_id = $(this).data("goods-id");
        if ($(this).hasClass('select')) {
            $(this).removeClass('select');
            $('.whole-checkbox-' + goods_id).find(".goods-checkbox").removeClass("select").find(":checkbox").prop("checked", false);
            $('#cart_shop_' + shop_id).find(".shop-checkbox").removeClass('select'); // 店铺全选取消
            $('.all-checkbox').removeClass('select'); // 全选取消
            $('.whole-checkbox-' + goods_id).removeClass('select'); // 全选取消
        } else {
            $(this).addClass('select');
            $('.whole-checkbox-' + goods_id).find(".goods-checkbox").addClass("select").find(":checkbox").prop("checked", true);
            if ($("#cart_shop_" + shop_id).find(":checkbox").size() == $("#cart_shop_" + shop_id).find(":checkbox:checked").size()) {
                $("#cart_shop_" + shop_id).find(".shop-checkbox").addClass('select'); // 店铺全选选中
            }
            if ($("#cart_list").find(":checkbox").size() == $("#cart_list").find(":checkbox:checked").size()) {
                $('.all-checkbox').addClass('select'); // 全选选中
            }
        }
        $(".cart-disable").find(".cart-checkbox").removeClass("select");
        select();
    });

    // 店铺选择框
    $("body").on('click', '.shop-checkbox', function () {
        var shop_id = $(this).data("shop-id");
        if ($(this).hasClass('select')) {
            $('#cart_shop_' + shop_id).find('.cart-checkbox').removeClass('select');
            $('#cart_shop_' + shop_id).find(":checkbox").prop("checked", false);
            $('.all-checkbox').removeClass('select'); // 全选取消
        } else {
            //店铺选择框不可选
            if($(this).hasClass('cart-shop-disable'))
            {
                return false;
            }
            $('#cart_shop_' + shop_id).find('.cart-checkbox').addClass('select');
            $('#cart_shop_' + shop_id).find(":checkbox").prop("checked", true);
            if ($("#cart_list").find(":checkbox").length == $("#cart_list").find(":checkbox:checked").length) {
                $('.all-checkbox').addClass('select'); // 全选选中
            }
        }
        $(".cart-disable").find(".cart-checkbox").removeClass("select");
        select();
    })

    // 全选框
    $("body").on('click', '.all-checkbox', function () {
        if ($(this).hasClass('select')) {
            $('.cart-checkbox').removeClass('select');
            $("#cart_list").find(":checkbox").prop("checked", false);
        } else {
            if (!$('.cart-checkbox').hasClass('cart-shop-disable')) {
                $('.cart-checkbox').addClass('select');
            }
            $("#cart_list").find(":checkbox").prop("checked", true);
        }
        $(".cart-disable").find(".cart-checkbox").removeClass("select");
        select();
    });

    // 管理
    $("#cart_manage_btn").click(function () {
        if ($('#cart_manage').hasClass('hide')) {
            $('#cart_manage').removeClass('hide');
            $('#cart_count').addClass('hide');
            $(this).attr('data-type', '1');
            $(this).text('完成');
        } else {
            $('#cart_manage').addClass('hide');
            $('#cart_count').removeClass('hide');
            $(this).attr('data-type', '0');
            $(this).text('管理');
        }
    });

    // 批量删除
    $('body').on('click', '#batch_delet', function () {
        var cart_ids = [];
        $("#cart_list").find(":checkbox:checked").each(function () {
            cart_ids.push($(this).val());
        });
        if (cart_ids.length == 0) {
            $.msg('请选择要删除的商品');
            return;
        }
        $.confirm("您确定要删除选中的商品吗?", function () {
            $.cart.del(cart_ids, function (result) {
                if (result.code == 0) {
                    $(".content").replaceWith(result.data);
                    // 重新初始化
                    init();
                }
            });
        });
    });

    // 清空
    $('body').on('click', '#cart_clear', function () {
        var cart_ids = [];
        // 购物车清空，由于不能购买商品没有checbox，所以只换成冲 li 的data-cart-id 中获取 @zhoujianchao
        $("#cartid li").each(function () {
            cart_ids.push($(this).attr('data-cart-id'));
        })
        $.confirm("您确定要清空购物车吗?", function () {
            $.cart.del(cart_ids, function (result) {
                if (result.code == 0) {
                    $(".content").replaceWith(result.data);
                    // 重新初始化
                    init();
                }
            });
        });
    });

    // 批量关注
    $('body').on('click', '#batch_collect', function () {
        var cart_ids = [];
        $("#cart_list").find(":checkbox:checked").each(function () {
            cart_ids.push($(this).val());
        });
        if (cart_ids.length == 0) {
            $.msg('请选择要收藏的商品');
            return;
        }

        var data = {};

        data.cart_ids = cart_ids;

        if (typeof (shop_id) != 'undefined' && shop_id > 0) {
            data.shop_id = shop_id
        }
        $.loading.start();
        $.post('/cart/add-collect-goods', data, function (result) {
            $.loading.stop();
            if (result.code == 0) {
                $.msg(result.message);
                $(".content").replaceWith(result.data);
                // 重新初始化
                init();
            } else {
                $.msg(result.message, {
                    time: 3000
                });
            }
        }, 'json');
    });

    // 删除
    $("body").on('click', '.del', function () {
        var cart_ids = $(this).attr('data-cart-id');
        if (!cart_ids) {
            cart_ids = [];
            $("#cart_list").find(":checkbox:checked").each(function () {
                cart_ids.push($(this).val());
            })
        } else {
            cart_ids = [cart_ids];
        }

        if (cart_ids.length == 0) {
            $.msg("请选择您要移除的商品");
            return;
        }

        $.confirm("您确定要从购物车中移除选中的商品吗?", function () {
            $.cart.del(cart_ids, function (result) {
                if (result.code == 0) {
                    $(".content").replaceWith(result.data);
                    // 重新初始化
                    init();
                }
            });
        })
    });

    $("body").on('click', '.whole-del', function () {
        var cart_ids = $(this).attr('data-cart-id');
        cart_ids = cart_ids.split(',');
        if (cart_ids.length == 0) {
            $.msg("请选择您要移除的商品");
            return;
        }

        $.confirm("您确定要从购物车中移除选中的商品吗?", function () {
            $.cart.del(cart_ids, function (result) {
                if (result.code == 0) {
                    $(".content").replaceWith(result.data);
                    // 重新初始化
                    init();
                }
            });
        })
    });

    // 清空失效商品
    $("body").on('click', '.del-invalid', function () {
        var cart_ids = [];
        $("#invalid-list").find(".SZY-INVALID-LI").each(function () {
            cart_ids.push($(this).data('cart-id'));
        });
        cart_ids = cart_ids.join(',');

        $.confirm("您确定要清空失效商品吗?", function () {
            $.cart.del(cart_ids, function (result) {
                if (result.code == 0) {
                    $(".content").replaceWith(result.data);
                    // 重新初始化
                    init();
                }
            });
        })
    });

    // 优惠券弹框
    $("body").on('click', '.shop-coupon-trigger', function () {
        var shop_id = $(this).data("shop-id");
        var $shop_coupon = $("#select_coupon_" + shop_id);
        var total = 0, h = $(window).height(), top = $shop_coupon.find('.discount-coupon h2').height() || 0,
            con = $shop_coupon.find('.coupon-list');
        $shop_coupon.show().removeClass('spec-menu-hide').addClass('spec-menu-show');
        $(".mask-div").show();
        scrollheight = $(document).scrollTop();
        $("body").css("top", "-" + scrollheight + "px");
        $("body").addClass("visibly");
        $shop_coupon.find(".flow-goods-list").height($(window).height() - 100);
        $shop_coupon.find(".flow-goods-list").css({
            margin: "0"
        });
        $shop_coupon.find(".flow-goods-list").css({
            overflow: "hidden"
        });
        setTimeout(function () {
            setTimeout(function () {
                $('#select_coupon_' + shop_id).find('.choose-attribute-close').addClass('show');
            }, 300);
        }, 150)
    })

    // 优惠券弹框关闭
    $("body").on('click', '.coupon_close', function () {
        var shop_id = $(this).data("shop-id");
        var $shop_coupon = $("#select_coupon_" + shop_id);
        $shop_coupon.hide().addClass('spec-menu-hide').removeClass('spec-menu-show');
        $(".mask-div").hide();
        $("body").css("top", "auto");
        $("body").removeClass("visibly");
        $(window).scrollTop(scrollheight);
        $shop_coupon.find(".flow-goods-list").removeAttr("style");
        $('.choose-attribute-close').removeClass('show');
    });

    // 领取红包
    $("body").on("click", ".bonus-receive", function () {
        var bonus_id = $(this).data("bonus-id");
        var target = $(this);
        $.bonus.receive(bonus_id, function (result) {
            if (result.code == 0) {
                if (result.data == 0) {
                    $(target).html("已领取").removeClass("bg-color").removeClass("bonus-receive").addClass("bonus-received").addClass('color');
                }
                $.msg(result.message, {
                    icon_type: 1
                });
                return;
            } else if (result.code == 130) {
                $(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
            } else if (result.code == 131) {
                $(target).html("已抢光").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
            }
            $.msg(result.message, {
                time: 5000
            });
        });
    });

    // 结算
    $("body").on('click', '.submit-btn', function () {
        submit();
    });

    // 选择商品事件
    function select() {
        $('.SZY-CART-SUBMIT-LOADING').show();
        $('.SZY-CART-SUBMIT').hide();
        var cart_ids = getSelectCartIds();
        var data = {};
        if (typeof (shop_id) != 'undefined' && shop_id > 0) {
            data.shop_id = shop_id;
        }
        $.cart.select(cart_ids, data, function (result) {
            if (result.code == 0) {
                $(".content").replaceWith(result.data);
                // 重新初始化
                init();
            }
        });
    }

    // select();

    // 初始化
    init();

});

var eventclick; // 防止重复点击

// 获取选中的购物车ID
function getSelectCartIds() {
    var cart_ids = [];
    // var shop_ids = new Array();
    $("#cart_list").find("input[type='checkbox']:checked").each(function () {
        cart_ids.push($(this).val());
    });
    return cart_ids;
}

// 商品数量变动
function changeNumber() {

    $(".amount").find(":text").amount({
        min: 1,
        change: function (element, value) {

            if ($('.edit-quantity-mask') && $('.edit-quantity-mask').is(':visible')) {
                return;
            }

            var sku_id = $(element).data('sku-id');
            var goods_number = $(element).data('goods-number');
            var cart_id = $(element).data('cart-id');
            var number = value;
            var max = this.max;
            var min = this.min;

            $('.SZY-CART-SUBMIT-LOADING').show();
            $('.SZY-CART-SUBMIT').hide();

            $.cart.changeNumber(sku_id, number, cart_id, function (result) {
                if (result.code == 0) {
                    $(".content").replaceWith(result.data);
                    // 重新初始化
                    init();
                    $(element).focus();
                } else if (result.code == 95) {
                    // 限够商品
                    $(element).val(result.data.max);
                } else {
                    $(element).val(goods_number);
                }
            }).always(function () {
                $('.SZY-CART-SUBMIT-LOADING').hide();
                $('.SZY-CART-SUBMIT').show();
            });
        },
        max_callback: function () {
            $.msg("最多只能购买" + this.max + "件");
        },
        min_callback: function (element) {
            var cart_id = $(element).data('cart-id');
            // $.msg("商品数量必须大于" + (this.min - 1));
            $.confirm("您确定要从购物车中移除该商品吗?", function () {
                $.cart.del([cart_id], function (result) {
                    if (result.code == 0) {
                        $(".content").replaceWith(result.data);
                        // 重新初始化
                        init();
                    }
                });
            });
        }
    })
}

function init() {
    // 初始加载商品数量变动步进器
    changeNumber();

    // 设置页面上checkbox状态
    if ($("#cart_list").find(":checkbox").length > 0 && $("#cart_list").find(":checkbox").length == $("#cart_list").find(":checkbox:checked").length) {
        $('.all-checkbox').addClass('select'); // 全选选中
    }

    $(".order-body").each(function () {
        if ($(this).find(":checkbox").length > 0 && $(this).find(":checkbox").length == $(this).find(":checkbox:checked").length) {
            $(this).find('.shop-checkbox').addClass('select'); // 店铺选中
        }
    });
}

// 结算
function submit() {

    var data = {};
    if (typeof (shop_id) != 'undefined' && shop_id > 0) {
        data.shop_id = shop_id
    }

    // 选中的购物车商品
    data.cart_ids = getSelectCartIds();

    $.loading.start();
    $.post('/cart/go-checkout.html', data, function (result) {

        $(".item-content").removeClass('bgcolor');

        if (result.code == 0) {
            $.loading.start();
            // 正常提交
            $.go(result.data+"?back_url=/cart.html");
        } else if (result.code == 102) {
            $.msg(result.message, {
                time: 2000
            }, function () {
                $.loading.start();
                $.go('/cart.html');
            });
        } else {
            $.msg(result.message, {
                time: 5000
            });
        }
    }, 'json').always(function () {
        $.loading.stop();
    });

}