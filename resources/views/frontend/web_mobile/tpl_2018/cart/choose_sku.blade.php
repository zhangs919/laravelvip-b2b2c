<div class="choose-attribute-mask" style="display: block;"></div>
<div id="{{ $uuid }}" class="choose-attribute-main spec-menu-show" style="display: block;">
    <div class="choose-attribute-header clearfix">
        <img src="{{ $goods_image }}" class='SZY-GOODS-IMAGE' />
        <div class="attribute-header-right">
            <span class="goodprice price-color choose-result-price SZY-GOODS-PRICE">
                <em>￥0</em>
            </span>
            <span>
                <i class="SZY-GOODS-NUMBER"></i>

            </span>
            <span class="choose-result-attr SZY-GOODS-SPEC"></span>
        </div>
        <a class="choose-attribute-close" href="javascript:void(0);" title="关闭"></a>
    </div>
    <div class="choose-attribute-content">
        <div class="attr-list choose SZY-GOODS-SPEC-ITEMS">

            @foreach($spec_list as $k=>$v)
                <dl class="attr">
                    <dt class="dt">{{ $v['attr_name'] }}</dt>
                    <dd class="dd">
                        <ul>
                        @foreach($v['attr_values'] as $kk=>$vv)
                            <!-- 属性值被选中的状态 _start-->
                            <li class="@if(in_array($vv['spec_id'], $sku['spec_ids'])) selected @endif"
                                data-spec-id="{{ $vv['spec_id'] }}" data-is-default="{{ $v['is_default'] }}">
                                <a href="javascript:void(0);" title="{{ $vv['attr_value'] }}"> {{ $vv['attr_value'] }}</a>
                            </li>
                            <!-- 属性值被选中的状态 _end-->
                            @endforeach
                        </ul>
                    </dd>
                </dl>
            @endforeach
            <!-- 商品属性 -->
        </div>
        <input type="hidden" class="amount-input num" value="1">
    </div>
    <div class="choose-foot">
        <input type="button" class="btn btn-primary btn-add-cart" value="确定" />
    </div>
    <input type="hidden" class="SZY_ADD_CART_OPTION_X">
    <input type="hidden" class="SZY_ADD_CART_OPTION_Y">
</div>
<script id="SZY_SKU_LIST_{{ $uuid }}" type="text">
    {!! $sku_list !!}
</script>
<script type="text/javascript">
    //
</script>
<script>

    $().ready(function() {
        var scrollheight = 0;
        scrollheight = parseInt($("body").offset().top);
        var bodyscrollheight = Math.abs(scrollheight);
        var sku_list = $.parseJSON($("#SZY_SKU_LIST_{{ $uuid }}").html());
        var getSkuId = null;
        var getSkuData = null;
        var getSkuInfo = null;

        function getSkuImage() {
            var image_url = undefined;
            $("#{{ $uuid }}").find(".choose").find(".attr").each(function() {
                var spec_id = $(this).find(".selected").data("spec-id");
                image_url = $(this).find(".selected").find("img").attr("src");
                return false;
            });

            if (!image_url) {
                image_url = "{{ $goods_image  }}";
            }

            return image_url;
        }

// 绑定点击规格事件
        var specObj = $.cart.checkSpecs({
            sku_list: sku_list,
            container: $("#{{ $uuid }}").find(".SZY-GOODS-SPEC-ITEMS"),
            objects: $("#{{ $uuid }}").find(".SZY-GOODS-SPEC-ITEMS").find("li"),
// 处理选中的SKU
            done_callback: function(sku){
// SKU存在事件
                console.log("---" + sku)
                setSkuInfo(sku);
            },
// 处理未选中SKU时的事件
            fail_callback: function(result){
// SKU不存在事件
                setSkuInfo(false);
            },
        });

        getSkuId = specObj.getSkuId;
        getSkuData = specObj.getSkuData;
        getSkuInfo = specObj.getSkuInfo;

// 加入购物车
        $("#{{ $uuid }}").find(".btn-add-cart").click(function(event) {
            if ($(this).hasClass('disabled')) {
                return;
            }
            var sku_id = getSkuId();
            event.pageX = $("#{{ $uuid }}").find('.SZY_ADD_CART_OPTION_X').val();
            event.pageY = $("#{{ $uuid }}").find('.SZY_ADD_CART_OPTION_Y').val();
            var goods_number = $("#{{ $uuid }}").find(".amount-input").val();
            var replace_order = $("#replace_order").val();

            var act_type = "";
            var bargain_type = "8";

            if(act_type == bargain_type)
            {
                $.go("/plat-bargain-info-" + sku_id + ".html");
                return;
            }

            var step = $(this).data("step");
            if (isNaN(step)) {
                step = 1;
            }

            $.cart.add(sku_id, goods_number, {
                is_sku: true,
                event: event,
// 为获取商品属性
                goods_id: "{{ $goods_id }}",
//image_url: image_url,
                shop_id: "{{ $shop_id }}",
                replace_order: replace_order,
                client_cart: replace_order == 1 ? 1 : 0,
                callback: function(result) {
                    $("#{{ $uuid }}").find(".choose-attribute-close").click();
                    if ($("#number_{{ $sku['sku_id'] }}").size() > 0 && result.code == 0) {
                        $('.SZY-PAY').removeClass('disabled');
//启用滚动
                        $("body").css("top", "auto");
                        $("body").removeClass("visibly");
                        $(window).scrollTop(bodyscrollheight);
                        var numbtn = $("#number_{{ $sku['sku_id'] }}").find(".num");
                        var top_id = '{{ $top_id }}';
                        if (parseInt(numbtn.val()) == 0) {
// 点击加入购物车相应的购买数量+1
                            numbtn.show();
                            numbtn.removeClass('hide');
//减号的按钮动画显示
                            $("#number_{{ $sku['sku_id'] }}").find(".decrease").show();
                            $("#number_{{ $sku['sku_id'] }}").find(".decrease").removeClass('hide');
                        }
                        numbtn.val(parseInt(numbtn.val()) + parseInt(result.data.goods_number));

                        <!--  -->


                        var add_btn = $("#number_{{ $sku['sku_id'] }}").find(".increase");
                        var max_number = add_btn.data('max_number');
                        if (numbtn.val() >= max_number) {
                            add_btn.addClass('disabled');
                        }

                        if (typeof refreshCatList != 'undefined' && refreshCatList instanceof Function) {
                            refreshCatList(top_id, 1);
                        }

                        if (typeof compute_discount != 'undefined' && compute_discount instanceof Function) {
// 点击加入购物车相应的购买数量
                            var goods_number = result.data.goods_number;
                            compute_discount(goods_number, result.data.goods_price);
                        }
                    }
                }
            });
        });

        $("#{{ $uuid }}").find(".choose-attribute-close").click(function() {
            $(".choose-attribute-mask").remove();
            $(".choose-attribute-main").remove();
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(bodyscrollheight);
        });
        $(".choose-attribute-mask").click(function() {
            $(".choose-attribute-mask").remove();
            $(".choose-attribute-main").remove();
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(bodyscrollheight);
        });

        var sku_obj = getSkuData();

// 步进器
        $("#{{ $uuid }}").find(".amount-input").amount({
            value: sku_obj.cart_step,
            min: sku_obj.cart_step,
            max_callback: function() {
                $.msg("最多只能购买" + this.max + "件");
            },
            min_callback: function() {
                $.msg("商品数量必须大于" + (this.min - 1));
            }
        });
        $("#{{ $uuid }}").find(".amount-input").val(1);

// 设置SKU信息
        function setSkuInfo(sku) {
            var goods_number = sku ? sku.goods_number : 0;
            var goods_price = sku ? sku.goods_price : 0;
            if (sku == undefined || sku == null || sku == false || goods_number <= 0) {
                $("#{{ $uuid }}").find(".btn-add-cart").addClass("disabled");
                $("#{{ $uuid }}").find(".SZY-GOODS-NUMBER").html("库存不足");
                $("#{{ $uuid }}").find(".btn-add-cart").val("库存不足");
            } else {

                if(sku.is_default && sku.sku_image){
                    $("#{{ $uuid }}").find(".SZY-GOODS-IMAGE").attr("src", sku.sku_image);
                }

// 库存判断
// <!--  -->
                $("#{{ $uuid }}").find(".SZY-GOODS-NUMBER").html("库存 " + goods_number + " 件");
// <!--  -->
                $("#{{ $uuid }}").find(".btn-add-cart").removeClass("disabled");
                $("#{{ $uuid }}").find(".btn-add-cart").val("确定");
                $("#{{ $uuid }}").find(".SZY-GOODS-IMAGE").attr("src", sku.sku_image_thumb);

//已选规格
                var spec_names = [];

                $("#{{ $uuid }}").find(".attr-list dl").each(function() {
                    var label = $(this).find("li").filter(".selected").find("a").text();
                    spec_names.push(label);
                });

                $("#{{ $uuid }}").find('.SZY-GOODS-SPEC').html("已选：<i>" + spec_names.join(" ") + "</i>");

// 设置步进器
                var amount_obj = $("#{{ $uuid }}").find(".amount-input");
                $(amount_obj).data("amount-step", sku.cart_step);
                $(amount_obj).data("amount-min", sku.cart_step);
                $(amount_obj).data("amount-max", goods_number);

                if (goods_number > 0 && $(amount_obj).val() == 0) {
                    $(amount_obj).val(1);
                } else if (goods_number == 0 && $(amount_obj).val() != 0) {
                    $(amount_obj).val(0);
                } else if ($(amount_obj).val() < sku.cart_step) {
                    $(amount_obj).val(sku.cart_step);
                } else if ($(amount_obj).val() % sku.cart_step != 0) {
                    $(amount_obj).val(sku.cart_step);
                }

                if ($(amount_obj).val() == '') {
                    $(amount_obj).val(1);
                }

                var goods_number_input = parseInt($(amount_obj).val());

                if (goods_number_input > goods_number) {
                    $(amount_obj).val(goods_number);
                }

            }
            var format = "￥#0#";

            goods_price = parseFloat(goods_price);

            $("#{{ $uuid }}").find(".SZY-GOODS-PRICE").html(format.replace("#0#", goods_price.toFixed(2)));
        }

        if(sku_obj){
            setSkuInfo(sku_obj);
        }
    });
    setTimeout(function() {
        $('.choose-attribute-close').addClass('show');
    }, 500);
    //
</script>
<script>

    $().ready(function() {
        var scrollheight = 0;
        scrollheight = parseInt($("body").offset().top);
        var bodyscrollheight = Math.abs(scrollheight);
        var sku_ids = $.parseJSON($("#SZY_SKU_LIST_{{ $uuid }}").html());

        function getSkuId() {
            var spec_ids = [];
            $("#{{ $uuid }}").find(".choose").find(".attr").each(function() {
                var spec_id = $(this).find(".selected").data("spec-id");
                spec_ids.push(spec_id);
            });

            var sku_id = $.cart.getSkuId(spec_ids, sku_ids);

            return sku_id;
        }

        function getSkuInfo() {
            var sku_id = getSkuId();

            for ( var spec_id in sku_ids) {
                var sku = sku_ids[spec_id];

                if (sku.sku_id == sku_id) {
                    return sku;
                }
            }

            return null;
        }
        function getSkuImage() {
            var image_url = undefined;
            $("#{{ $uuid }}").find(".choose").find(".attr").each(function() {
                var spec_id = $(this).find(".selected").data("spec-id");
                image_url = $(this).find(".selected").find("img").attr("src");
                return false;
            });

            if (!image_url) {
                image_url = "{{ $goods_image }}";
            }

            return image_url;
        }

        /* $("#{{ $uuid }}").find(".choose li").click(function() {

        $(this).siblings(".selected").removeClass("selected").find("i").remove();
        $(this).addClass("selected").append("<i></i>");

        var sku = getSkuInfo();
        setSkuInfo(sku);
        });
         */

// 绑定点击规格事件
        $.cart.checkSpecs($("#{{ $uuid }}"), sku_ids, $("#{{ $uuid }}").find(".choose li"), function(sku) {
// SKU存在事件
            setSkuInfo(sku);
        }, function() {
// SKU不存在事件
            setSkuInfo(false);
        });

        $("#{{ $uuid }}").find(".choose li").each(function() {
            $(this).click();
            var sku = getSkuInfo();
            if (sku != null && sku.goods_number > 0) {
                return false;
            }
        });

// 加入购物车
        $("#{{ $uuid }}").find(".btn-add-cart").click(function(event) {
            if ($(this).hasClass('disabled')) {
                return;
            }
            var sku_id = getSkuId();
            event.pageX = $("#{{ $uuid }}").find('.SZY_ADD_CART_OPTION_X').val();
            event.pageY = $("#{{ $uuid }}").find('.SZY_ADD_CART_OPTION_Y').val();
            var goods_number = $("#{{ $uuid }}").find(".amount-input").val();
            var replace_order = $("#replace_order").val();
            $.cart.add(sku_id, goods_number, {
                is_sku: true,
                event: event,
//image_url: image_url,
                shop_id: "{{ $shop_id }}",
                replace_order: replace_order,
                callback: function(result) {
                    $("#{{ $uuid }}").find(".choose-attribute-close").click();
                    if ($("#number_{{ $sku['sku_id'] }}").size() > 0 && result.code == 0) {
                        $('.SZY-PAY').removeClass('disabled');
//启用滚动
                        $("body").css("top", "auto");
                        $("body").removeClass("visibly");
                        $(window).scrollTop(bodyscrollheight);
                        var numbtn = $("#number_{{ $sku['sku_id'] }}").find(".num");
                        var top_id = '4';
                        if (parseInt(numbtn.val()) == 0) {
// 点击加入购物车相应的购买数量+1
                            numbtn.show();
                            numbtn.removeClass('hide');
//减号的按钮动画显示
                            $("#number_{{ $sku['sku_id'] }}").find(".decrease").show();
                            $("#number_{{ $sku['sku_id'] }}").find(".decrease").removeClass('hide');
                        }
                        numbtn.val(parseInt(numbtn.val()) + parseInt(result.data.goods_number));

                        var add_btn = $("#number_{{ $sku['sku_id'] }}").find(".increase");
                        var max_number = add_btn.data('max_number');
                        if (numbtn.val() >= max_number) {
                            add_btn.addClass('disabled');
                        }

                        if (typeof refreshCatList != 'undefined' && refreshCatList instanceof Function) {
                            refreshCatList(top_id, 1);
                        }
                    }

//代客下单
                    if (replace_order == 1) {
                        var ids = $("#replace_sku_ids").val();
                        var goods_number = 0;
                        var goods_price = $("#replace_goods_price").val();
                        goods_price = parseFloat(goods_price);
                        if (ids.length == 0) {
                            ids = result.data.sku_id + '-1';
                            goods_number = 1;
                            goods_price = parseFloat(result.data.goods_price);
                            $(".shop-cart-icon").removeClass('cart-icon');
                            $(".shop-cart-icon").addClass('empty-footer-cart');
                        } else {
                            ids = ids.split(',');
                            var sku_id_list = new Array();
                            for (var i = 0; i < ids.length; i++) {
                                var temp_arr = ids[i].split('-');
                                if (temp_arr[0] == result.data.sku_id) {
                                    temp_arr[1]++;
                                }
                                sku_id_list.push(temp_arr[0]);
                                goods_number += parseInt(temp_arr[1]);
                                ids[i] = temp_arr.join('-');
                            }

                            if (sku_id_list.indexOf(result.data.sku_id) == -1) {
                                ids.push(result.data.sku_id + '-1');
                                goods_number++;
                            }

                            ids.join(',');
                            goods_price += parseFloat(result.data.goods_price);
                        }
                        $("#replace_sku_ids").val(ids);
                        $(".SZY-REPLACE-CART-COUNT").html(goods_number);
                        goods_price = goods_price.toFixed(2);
                        $("#replace_goods_price").val(goods_price);
                        $("#goods_price_amount").html('￥' + goods_price);
                        $(".shop-cart-icon").removeClass('empty-footer-cart');
                        $(".shop-cart-icon").addClass('cart-icon');
                    }


                }
            });
        });

        $("#{{ $uuid }}").find(".choose-attribute-close").click(function() {
            $(".choose-attribute-mask").remove();
            $(".choose-attribute-main").remove();
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(bodyscrollheight);
        });
        $(".choose-attribute-mask").click(function() {
            $(".choose-attribute-mask").remove();
            $(".choose-attribute-main").remove();
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(bodyscrollheight);
        });

        var sku_obj = getSkuInfo();

// 步进器
        $("#{{ $uuid }}").find(".amount-input").amount({
            value: sku_obj.cart_step,
            min: sku_obj.cart_step,
            max_callback: function() {
                $.msg("最多只能购买" + this.max + "件");
            },
            min_callback: function() {
                $.msg("商品数量必须大于" + (this.min - 1));
            }
        });
        $("#{{ $uuid }}").find(".amount-input").val(1);

// 设置SKU信息
        function setSkuInfo(sku) {
            var goods_image = "https://xxxx/images/taobao-yun-images/525935083011/TB1LlwhKVXXXXXyXVXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320";
            var goods_number = sku ? sku.goods_number : 0;
            var goods_price = sku ? sku.goods_price : 0;
            if (sku == undefined || sku == null || sku == false || goods_number <= 0) {
                $("#{{ $uuid }}").find(".btn-add-cart").addClass("disabled");
                $("#{{ $uuid }}").find(".SZY-GOODS-NUMBER").html("库存不足");
                $("#{{ $uuid }}").find(".btn-add-cart").val("库存不足");
            } else {
// 库存判断
// <!--  -->
                $("#{{ $uuid }}").find(".SZY-GOODS-NUMBER").html("库存" + goods_number + "件");
// <!--  -->
                $("#{{ $uuid }}").find(".btn-add-cart").removeClass("disabled");
                $("#{{ $uuid }}").find(".btn-add-cart").val("确定");
                $("#{{ $uuid }}").find(".SZY-GOODS-IMAGE").attr("src", sku.sku_image_thumb);

//已选规格
                var spec_names = [];

                $("#{{ $uuid }}").find(".attr-list dl").each(function() {
                    var label = $(this).find("li").filter(".selected").find("a").text();
                    spec_names.push(label);
                });

                $("#{{ $uuid }}").find('.SZY-GOODS-SPEC').html("已选：<i>" + spec_names.join(" ") + "</i>");

// 设置步进器
                var amount_obj = $("#{{ $uuid }}").find(".amount-input");
                $(amount_obj).data("amount-step", sku.cart_step);
                $(amount_obj).data("amount-min", sku.cart_step);
                $(amount_obj).data("amount-max", goods_number);

                if (goods_number > 0 && $(amount_obj).val() == 0) {
                    $(amount_obj).val(1);
                } else if (goods_number == 0 && $(amount_obj).val() != 0) {
                    $(amount_obj).val(0);
                } else if ($(amount_obj).val() < sku.cart_step) {
                    $(amount_obj).val(sku.cart_step);
                } else if ($(amount_obj).val() % sku.cart_step != 0) {
                    $(amount_obj).val(sku.cart_step);
                }

                if ($(amount_obj).val() == '') {
                    $(amount_obj).val(1);
                }

                var goods_number_input = parseInt($(amount_obj).val());

                if (goods_number_input > goods_number) {
                    $(amount_obj).val(goods_number);
                }

            }
            var format = "￥#0#";

            $("#{{ $uuid }}").find(".SZY-GOODS-PRICE").html(format.replace("#0#", goods_price));

        }
    });
    setTimeout(function() {
        $('.choose-attribute-close').addClass('show');
    }, 500);

    //
</script>
