<div id="{{ $uuid }}" class="p-20">
    <!--温馨提示-->
    <form id="form1" class="form-horizontal" name="EditGoodsDo" action="/dashboard/multi-store/edit-goods?goods_id={{ $goods_id }}&store_id={{ $store_id }}&shop_id={{ $shop_id }}" method="POST">
        @csrf
        <div class="simple-form-field">
            <div class="form-group">
                <label class="col-sm-2 w120 control-label">商品名称： </label>
                <div class="col-sm-10">
                    <div class="form-control-box">
                        <label class="control-label text-l" title="{{ $goods_name }}">{{ $goods_name }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <div class="form-group">
                <label class="col-sm-2 w120 control-label">批量设置价格：</label>
                <div class="col-sm-10">
                    <div class="form-control-box">
                        <input id="goods_price" class="form-control batch-value m-r-5 w60 start-num" type="text">
                        <span class="goods_price  w20 disp-inlblock">元</span>
                        <a class="btn btn-primary batch-submit m-r-5 m-l-20" onclick="setValue('goods_price')">确定</a>
                        <a class="btn btn-default clear-all" onclick="clearValue('goods_price')">清空</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <div class="form-group">
                <label class="col-sm-2 w120 control-label">批量设置库存：</label>
                <div class="col-sm-10">
                    <div class="form-control-box">
                        <input id="goods_number" class="form-control batch-value m-r-5 w60 start-num" type="text">
                        <span class="goods_number  w20 disp-inlblock">   </span>
                        <a class="btn btn-primary batch-submit m-r-5 m-l-20" onclick="setValue('goods_number')">确定</a>
                        <a class="btn btn-default clear-all" onclick="clearValue('goods_number')">清空</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-spec-user-rank-region" style="overflow-y: auto; max-height: 220px; width:800px; position: relative">
            <table class="table table-bordered table-spec w800">
                <tbody>
                <tr class="left-tr">
                    @foreach($spec_list as $spec)
                        <td id="spec_name_{{ $spec['attr_id'] }}" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                            {{ $spec['attr_name'] }}
                        </td>
                    @endforeach

                    <td id="shop_prices" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        店铺价格（元）
                    </td>
                    <td id="store_prices" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        门店价格（元）
                    </td>
                    <td id="store_goods_number" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        门店库存
                    </td>
                </tr>
                @foreach($sku_list as $skuK=>$item)
                <tr class="left-tr">
                    <?php $attr_vid = ''; ?>
                    @foreach($spec_list as $sk=>$spec)
                        @foreach($spec['attr_values'] as $ak=>$av)
                        @if(empty($item['spec_ids']) || in_array($ak, explode('|', $item['spec_ids'])))
                        @if((count($spec_list) > 1 && $sk == 0 && $skuK > 0 && count($spec['attr_values']) == 1)
                            || (count($spec_list) > 1 && $skuK % count($spec['attr_values']) > 0 && $sk == 0 && count($spec['attr_values']) > 1))
                        @else
                        <td id="attr_v{{ $attr_vid .= "_".$av['attr_vid'] }}" rowspan="{{ count($spec_list) > 1 && $sk == 0 ? (count($spec['attr_values']) == 1 ? count($spec_list) : count($spec['attr_values'])) : 1 }}" colspan="1" class="" style="width: 180px; height: 50px;">
                        {{ $av['attr_value'] }}
                        </td>
                        @endif
                        @endif
                        @endforeach
                    @endforeach
                    <td id="sku_price{{ $item['sku_id'] }}" rowspan="1" colspan="1" class="sku" style="width: 180px; height: 50px;">
                        ￥{{ $item['goods_price'] }}
                    </td>
                    <td id="store_sku_price-{{ $item['sku_id'] }}" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-{{ $item['sku_id'] }}" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="{{ $item['store_sku_price'] }}" data-sku-id="{{ $item['sku_id'] }}">
                    </td>
                    <td id="store_sku_number_{{ $item['sku_id'] }}" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-{{ $item['sku_id'] }}" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="{{ $item['store_sku_number'] }}" data-sku-id="{{ $item['sku_id'] }}">
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!--错误提示模块 star-->
        <div class="member-handle-error"></div>
        <!--错误提示模块 end-->
        <!-- 提交 -->
        <div class="m-t-30  text-c">
            <a id="btn_submit" class="btn btn-primary btn-lg">确认提交</a>
        </div>
    </form>
</div>
<script id="client_rules" type="text">
[{"id": "editgoodsdo-store_sku_number", "name": "EditGoodsDo[store_sku_number]", "attribute": "store_sku_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"价格/库存不正确"}}},{"id": "editgoodsdo-store_sku_price", "name": "EditGoodsDo[store_sku_price]", "attribute": "store_sku_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"价格/库存不正确","min":"门店价格必须不小于0.01。","max":"门店价格必须不大于9999999。"},"min":0.01,"max":9999999}},{"id": "editgoodsdo-store_sku_number", "name": "EditGoodsDo[store_sku_number]", "attribute": "store_sku_number", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"库存不正确","min":"门店库存必须不小于0。","max":"门店库存必须不大于9999999。"},"min":0,"max":9999999}}]
</script>
<script type="text/javascript">
    // 
</script>
<script>


    $().ready(function () {

        /**
         * 初始化validator默认值
         */
        var _errorPlacement = $.validator.defaults.errorPlacement;
        var _success = $.validator.defaults.success;
        $.validator.setDefaults({
            errorPlacement: function (error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");
                if (!error_msg && error_msg == "") {
                    return;
                }
                if ($(element).parents(".member-container").find(".member-handle-error").find("div").size() == 0) {
                    $(".member-handle-error").html("<div class='form-control-warning error m-t-10'></div>");
                }
                var error_dom = $("<p id='" + error_id + "'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></p>");
                $("#{{ $uuid }}").find(".member-handle-error").find("div").append(error_dom);
                if(error_msg)
                {
                    $.msg(error_msg);
                }
            },
            // 失去焦点验证
            onfocusout: function (element) {
                $(element).valid();
            },// 成功后移除错误提示
            success: function (error, element) {
                _success.call(this, error, element);
                $("#{{ $uuid }}").find('.form-control-warning').remove();
            }
        });


        var validator = $("#form1").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        // @hezhiqiang 增加多门店模式的判断
        var isShowMultiStock = '';

        $("#{{ $uuid }}").find("#btn_submit").click(function () {
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            var price = new Array();
            var number = new Array();

            //价格
            $("#{{ $uuid }}").find(".store_sku_price").find("input").each(function () {
                var sku_obj = new Object();
                sku_obj['sku_id'] = $(this).data('sku-id');
                sku_obj['store_sku_price'] = $(this).val();
                price.push(sku_obj);
            });
            //库存
            $("#{{ $uuid }}").find(".store_sku_number").find("input").each(function () {
                var sku_obj = new Object();
                sku_obj['sku_id'] = $(this).data('sku-id');
                sku_obj['store_sku_number'] = $(this).val();
                number.push(sku_obj);
            });
            // @hezhiqiang 库位码
            if (isShowMultiStock){
                // 库位码
                var stock = [];
                $("#{{ $uuid }}").find(".stock_code").find("input").each(function () {
                    var sku_obj = new Object();
                    sku_obj['sku_id'] = $(this).data('sku-id');
                    sku_obj['stock_code'] = $(this).val();
                    stock.push(sku_obj);
                });
            }

            // 数据信息
            var data = {
                price: price,
                number: number,
                goods_id: '{{ $goods_id }}',
                shop_id: '{{ $shop_id }}',
                store_id: '{{ $store_id }}'
            };

            // @hezhiqiang 库位码
            if (isShowMultiStock){
                // 库位码
                data.stock = stock;
            }

            $.post("edit-goods", data, function (result) {
                if (result.code == 0) {
                    // 关闭对话框
                    $("#{{ $uuid }}").parents(".layui-layer").find(".layui-layer-close").click();
                    // 显示信息
                    $.msg(result.message, {
                        time: 1500
                    }, function () {
                        if (typeof (tablelist) != "undefined" && tablelist) {
                            tablelist.load();
                        } else {
                            $.go('/goods/list');
                        }
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function () {
                $.loading.stop();
            });


        })
    })

    // @hezhiqiang
    // 一种类型对应一种class，但是代码是重复的
    var mapClazz = {
        // 批量设置价格
        'goods_price': 'store_sku_price',
        // 批量设置库存
        'goods_number': 'store_sku_number',
        // 批量设置库位码
        'stock_code': 'stock_code'
    };
    //批量设置
    function setValue(type) {
        // 获取对应的class内容
        var clazz = mapClazz[type];
        if (clazz){
            $("#{{ $uuid }}").find("." + clazz).val($("#{{ $uuid }}").find("#" + type).val());
        }
    }

    //清空
    function clearValue(type) {
        // 获取对应的class内容
        var clazz = mapClazz[type];
        if (clazz){
            $("#{{ $uuid }}").find("." + clazz).val('');
        }
    }

    // 
</script>