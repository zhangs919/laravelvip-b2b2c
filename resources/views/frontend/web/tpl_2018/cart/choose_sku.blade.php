{{--商品列表 加入购物车时 有规格 弹出框内容--}}
<div class="pop-choose-spec-mask" style="display: block;"></div>
<div id="{{ $uuid }}" class="pop-choose-spec-main" style="display: block;">
    <div class="pop-choose-spec-header">
        <img src="{{ get_image_url($default_sku['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" class='goods-thumb SZY-GOODS-IMAGE' />
        <div class="attribute-header-right">
            <span class="goodprice choose-result-price">
            <em class="SZY-GOODS-PRICE">￥0</em>
            </span>
            <span class="goods-number SZY-GOODS-NUMBER"></span>
            <span class="choose-result-attr SZY-GOODS-SPEC">
            已选：
            <i></i>
            </span>
        </div>
        <a class="pop-choose-spec-close" href="javascript:void(0);" title="关闭"></a>
    </div>
    <!--<div class="pop-choose-spec-header">
    <span>请选择商品属性</span>
    <a class="pop-choose-spec-close" href="javascript:void(0);" title="关闭"></a>
    </div>-->
    <div class="pop-choose-spec-con">
        <div class="attr-list choose">

            @foreach($spec_list as $k=>$v)
            <dl class="attr">
                <dt class="dt">{{ $v[0]->attr_name }}：</dt>
                <dd class="dd">
                    <ul>

                        @foreach($v as $kk=>$vv)
                        <!-- 属性值被选中的状态 _start-->
                        <li class="@if(in_array($vv->attr_vid, $selected_spec_ids)) selected @endif"
                            data-spec-id="{{ $vv->attr_vid }}" data-attr-id="{{ $vv->attr_id }}" data-is-default="@if(in_array($vv->attr_vid, $selected_spec_ids)){!! 1 !!}@else{!! 0 !!}@endif">
                            <a href="javascript:void(0);" title="{{ $vv->attr_vname }}">
                                <span class="value-label">{{ $vv->attr_vname }}</span>
                            </a>
                            <i></i>
                        </li>
                        <!-- 属性值被选中的状态 _end-->
                        @endforeach

                    </ul>
                </dd>
            </dl>
            @endforeach


        </div>
        <div class="choose-btn">
            <dl class="amount">
                <dt class="dt">购买数量：</dt>
                <dd class="dd">
                    <span class="amount-widget">
                    <input type="text" class="amount-input" value="1" maxlength="8" title="请输入购买量">
                    <span class="amount-btn">
                    <span class="amount-plus">
                    <i>+</i>
                    </span>
                    <span class="amount-minus">
                    <i>-</i>
                    </span>
                    </span>
                    <span class="amount-unit">件</span>
                    </span>

                </dd>
            </dl>
            <input type="button" class="btn btn-primary btn-add-cart" value="加入购物车" />
            <input type="button" class="btn pop-choose-spec-close" value="取消" />
        </div>
    </div>
</div>
<script src="/assets/d2eace91/js/jquery.widget.js?v=20180726"></script>
<script id="SZY_SKU_LIST_{{ $uuid }}" type="text">
{!! $sku_list !!}
</script>
<script type="text/javascript">
    $().ready(function() {
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

        function setSkuInfo(sku) {
            var goods_number = "{{ $default_sku['goods_number'] }}";
            var goods_price = "{{ $default_sku['goods_price'] }}";
            var goods_image = "{{ get_image_url($default_sku['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320";

            if (sku == null || sku.goods_number <= 0) {
                $("#{{ $uuid }}").find(".btn-add-cart").addClass("disabled");
                $("#{{ $uuid }}").find(".SZY-GOODS-NUMBER").html("库存不足");
            } else {
                $("#{{ $uuid }}").find(".btn-add-cart").removeClass("disabled");
                goods_number = sku.goods_number;
                goods_price = sku.goods_price;

                $("#{{ $uuid }}").find(".SZY-GOODS-IMAGE").attr("src", sku.sku_image_thumb);
// 库存判断
//
                $("#{{ $uuid }}").find(".SZY-GOODS-NUMBER").html("库存" + goods_number + "件");
//
            }

// 已选规格
            var spec_names = [];

            $(".attr-list dl").each(function() {
                var label = $(this).find("li").filter(".selected").find(".value-label").text();
                spec_names.push(label);
            });

            if (spec_names.length > 0) {
                $(".SZY-GOODS-SPEC").find("i").html(spec_names.join(" "));
                $(".SZY-GOODS-SPEC").show();
            } else {
                $(".SZY-GOODS-SPEC").hide();
            }

// 设置步进器
            var amount_obj = $("#{{ $uuid }}").find(".amount-input");
            $(amount_obj).data("amount-max", goods_number);

            if (goods_number > 0 && $(".amount-input").val() == 0) {
                $(amount_obj).val(1);
            } else if (goods_number == 0 && $(".amount-input").val() != 0) {
                $(amount_obj).val(0);
            }

            var goods_number_input = parseInt($(amount_obj).val());

            if (goods_number_input > goods_number) {
                $(amount_obj).val(goods_number);
            }

            var format = "￥#0#";

            $("#{{ $uuid }}").find(".SZY-GOODS-PRICE").html(format.replace("#0#", goods_price));
        }

        function getSkuImage() {
            var image_url = undefined;
            $("#{{ $uuid }}").find(".choose").find(".attr").each(function() {
                var spec_id = $(this).find(".selected").data("spec-id");
                image_url = $(this).find(".selected").find("img").attr("src");
                return false;
            });

            if (!image_url) {
                image_url = "{{ get_image_url($default_sku['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320";
            }

            return image_url;
        }

// 步进器
        $("#{{ $uuid }}").find(".amount-input").amount({
            value: 1,
            min: 1,
            max_callback: function() {
                $.msg("最多只能购买" + this.max + "件");
            },
            min_callback: function() {
                $.msg("商品数量必须大于" + (this.min - 1));
            }
        });
        $("#{{ $uuid }}").find(".amount-input").val(1);

// 绑定点击规格事件
        $.cart.checkSpecs($("#{{ $uuid }}"), sku_ids, $("#{{ $uuid }}").find(".choose li"), function(sku) {
// SKU存在事件
            setSkuInfo(sku);
        }, function() {
// SKU不存在事件
            $("#{{ $uuid }}").find(".btn-add-cart").addClass("disabled");
            $("#{{ $uuid }}").find(".SZY-GOODS-NUMBER").html("库存不足");
        });

        $("#{{ $uuid }}").find(".choose li").each(function() {
            $(this).click();

            var sku = getSkuInfo();

            if (sku != null) {
                return false;
            }
        });

// 检查SKU组合
        $.cart.checkSkus($("#{{ $uuid }}"), sku_ids);

// 加入购物车
        $("#{{ $uuid }}").find(".btn-add-cart").click(function(event) {
            if ($(this).hasClass('disabled')) {
                return;
            }

            var sku = getSkuInfo();

            if (sku == null) {
                $.msg("商品已失效或不存在");
                return;
            }

            if (sku.goods_number == 0) {
                $.msg("商品库存不足");
                return;
            }

            var sku_id = sku.sku_id;
            var image_url = getSkuImage();
            var goods_number = $("#{{ $uuid }}").find(".amount-input").val();
            $.cart.add(sku_id, goods_number, {
                is_sku: true,
                event: event,
                image_url: image_url,
                callback: function() {
                    $("#{{ $uuid }}").find(".pop-choose-spec-close").click();
                },
                info_callback: function() {

                }
            });
        });

        $("#{{ $uuid }}").find(".pop-choose-spec-close").click(function() {
            $(".pop-choose-spec-mask").remove();
            $(".pop-choose-spec-main").remove();
        });
    });
</script>