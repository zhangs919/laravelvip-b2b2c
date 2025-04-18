<div id="{{ $uuid }}" class="modal-body p-b-20">
    <form id="ActivityGoods" class="form-horizontal" name="ActivityGoods" action="/dashboard/bargain/sku-info" method="post" enctype="multipart/form-data">
        @csrf
        <div class="goods-info order-item">
            <div class="edit-content  b-t-0">
                <h4>设置商品砍价价格</h4>
                <div class="table-responsive" style="max-height: 230px; overflow-x: hidden;">
                    <table class="table table-hover m-b-0">
                        <thead>
                        <tr>
                            <th class="w200">SKU规格</th>
                            <th class="w120">SKU价格（元）</th>
                            <th class="w180 text-c">
                                初始砍价价格（元）
                                <div class="batch">
                                    <a class="batch-edit" title="批量设置">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <div class="batch-input" style="display: none">
                                        <h6>批量设置初始砍价价格：</h6>
                                        <a class="batch-close">X</a>
                                        <input class="form-control text small batch_set_original_price" type="text">
                                        <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=0>设置</a>
                                        <span class="arrow"></span>
                                    </div>
                                </div>
                            </th>
                            <th class="w150 text-c">
                                砍价底价（元）
                                <div class="batch">
                                    <a class="batch-edit" title="批量设置">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <div class="batch-input" style="display: none">
                                        <h6>批量设置砍价底价：</h6>
                                        <a class="batch-close">X</a>
                                        <input class="form-control text small batch_set_act_price" type="text">
                                        <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type="1">设置</a>
                                        <span class="arrow"></span>
                                    </div>
                                </div>
                            </th>
                            <th class="w150 text-c">
                                活动库存
                                <div class="batch">
                                    <a class="batch-edit" title="批量设置">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <div class="batch-input" style="display: none;">
                                        <h6>批量设置活动库存：</h6>
                                        <a class="batch-close">X</a>
                                        <input class="form-control text small batch_set_act_stock" type="text">
                                        <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type="2">设置</a>
                                        <span class="arrow"></span>
                                    </div>
                                </div>
                            </th>
                            <th class="w120 text-c">
                                自砍比例
                                <div class="batch">
                                    <a class="batch-edit" title="批量设置">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <div class="batch-input" style="display: none">
                                        <h6>批量设置自砍比例：</h6>
                                        <a class="batch-close">X</a>
                                        <input class="form-control text small batch_set_ratio" type="text">
                                        <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type="3">设置</a>
                                        <span class="arrow"></span>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($sku_list as $v)
                        <tr>
                            <td>
                                <div class="ng-binding">{{ $v['spec_names'] ?? '无' }}</div>
                            </td>
                            <td>{{ $v['goods_price'] }}</td>
                            <td class="text-c"><input type="text" id="activitygoods-act_price" class="form-control small sm-height bargain_sku sku-act_price-{{ $v['sku_id'] }} original_price original_price-{{ $v['sku_id'] }}" name="ActivityGoods[act_price]" value="{{ $params[0][$v['sku_id']] }}" data-sku_id="{{ $v['sku_id'] }}" data-goods_id="{{ $v['goods_id'] }}" data-goods_price="{{ $v['goods_price'] }}" data-type="original_price" data-rule-trigger=".act_price-{{ $v['sku_id'] }}" data-rule-callback="original_price_callback"></td>
                            <td class="text-c"><input type="text" id="activitygoods-act_price" class="form-control small sm-height bargain_sku sku-act_price-{{ $v['sku_id'] }} act_price act_price-{{ $v['sku_id'] }}" name="ActivityGoods[act_price]" value="{{ $params[1][$v['sku_id']] }}" data-sku_id="{{ $v['sku_id'] }}" data-goods_id="{{ $v['goods_id'] }}" data-goods_price="{{ $v['goods_price'] }}" data-type="act_price" data-rule-trigger=".original_price-{{ $v['sku_id'] }}" data-rule-callback="act_price_callback"></td>
                            <td class="text-c"><input type="text" id="activitygoods-act_stock" class="form-control small sm-height bargain_sku bargain_sku_stock sku-act_stock-{{ $v['sku_id'] }} act_stock act_stock-{{ $v['sku_id'] }}" name="ActivityGoods[act_stock]" value="{{ $params[2][$v['sku_id']] }}" data-sku_id="{{ $v['sku_id'] }}" data-goods_id="{{ $v['goods_id'] }}" data-goods_price="{{ $v['goods_price'] }}" data-type="act_stock" data-rule-callback="act_stock_callback"></td>
                            <td class="text-c"><input type="text" id="activitygoods-ratio" class="form-control small m-r-5 sm-height bargain_sku sku-ratio-{{ $v['sku_id'] }} ratio ratio-{{ $v['sku_id'] }}" name="ActivityGoods[ratio]" value="{{ $params[3][$v['sku_id']] }}" data-sku_id="{{ $v['sku_id'] }}" data-goods_id="{{ $v['goods_id'] }}" data-goods_price="{{ $v['goods_price'] }}" data-type="ratio" data-rule-callback="ratio_callback">%</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--错误提示模块 star-->
        <div class="errors-container" style="max-height: 100px; overflow: auto;"></div>
        <!--错误提示模块 end-->
        <!-- 提交 -->
        <div class="m-t-10  text-c">
            <a id="btn_sku_price_submit" data-goods_id="{{ $v['goods_id'] }}" class="btn btn-primary" style="padding: 5px 68px !important; font-size: 15px !important; line-height: 26px !important;">确认提交</a>
        </div>
    </form></div>
<script type="text/javascript">
    // 
</script>
<script>

    //自定义验证规则：砍价初始价格
    function original_price_callback(element, value) {

        /* var sku_id = $(element).data('sku_id');
        var goods_price = $(element).data('goods_price'); */
        var regu = /^[0-9]+\.?[0-9]*$/;

        if ($(element).val() == "" || isNaN($(element).val())) {
            $(element).data("msg", "砍价初始价格必须是数字。");
            return false;
        }
        if (parseFloat($(element).val()) < 0) {
            $(element).data("msg", "砍价初始价格必须大于0。");
            return false;
        }

        if (parseFloat($(element).val()) >= 999999) {
            $(element).data("msg", "砍价初始价格必须小于999999。");
            return false;
        }

        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "砍价初始价格只能保留2位小数。");
                return false;
            }
        }

        var sku_id = $(element).data("sku_id");

        if (parseFloat(value) <= parseFloat($("#{{ $uuid }}").find(".act_price-" + sku_id).val())) {
            $(element).data("msg", "初始砍价价格必须大于砍价底价。");
            return false;
        }

        return true;
    }

    //自定义验证规则：砍价底价
    function act_price_callback(element, value) {

        var goods_id = $(element).data('goods_id');
        var min_price = $(element).data('min_price');
        var max_price = $(element).data('max_price');
        var regu = /^[0-9]+\.?[0-9]*$/;

        if ($(element).val() == "" || isNaN($(element).val())) {
            $(element).data("msg", "砍价底价必须是数字。");
            return false;
        }
        if (parseFloat($(element).val()) < 0) {
            $(element).data("msg", "砍价底价必须大于0。");
            return false;
        }
        if (parseFloat($(element).val()) >= 999999) {
            $(element).data("msg", "砍价底价必须小于999999。");
            return false;
        }
        /** 感觉没有什么用处
         if ($(element).val() > 10) {
$(element).data("msg", "砍价底价必须小于10。");
return false;
}
         **/
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "砍价底价只能保留2位小数。");
                return false;
            }
        }

        var sku_id = $(element).data("sku_id");

        if (parseFloat(value) >= parseFloat($("#{{ $uuid }}").find(".original_price-" + sku_id).val())) {
            $(element).data("msg", "砍价底价必须小于初始砍价价格。");
            return false;
        }

        return true;
    }

    function ratio_callback(element, value) {
        if ($(element).val() == '') {
            $(element).data("msg", "自砍比例不能为空。");
            return false;
        }
        if (isNaN($(element).val())) {
            $(element).data("msg", "自砍比例必须是数字。");
            return false;
        }
        if ($(element).val() < 0) {
            $(element).data("msg", "自砍比例必须大于0。");
            return false;
        }
        if ($(element).val() >= 100) {
            $(element).data("msg", "自砍比例必须小于100。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "自砍比例最多保留2位小数。");
                return false;
            }
        }
        return true;
    }

    function act_stock_callback(element, value) {

        if (/^(([0])|([1-9](\d*)))$/.test($(element).val()) == false) {
            $(element).data("msg", "活动库存必须是一个大于等于 0 的整数");
            return false;
        }

        return true;
    }

    //设置价格
    /* $("#{{ $uuid }}").on('change', ".bargain_sku", function() {
    var sku_id = $(this).data('sku_id');
    var type = $(this).data('type');
    var val = $(this).val();
    var goods_price = $(this).data('goods_price');
    
    $(".sku-act_price-" + sku_id).val('');
    $(".sku-act_price-" + sku_id).removeClass('error');
    $("." + type + '-' + sku_id).val(val);
    
    if (isNaN(val) || val.length == 0) {
    $("#act_price-" + sku_id).html("--");
    return;
    }
    if (type == 'discount') {
    goods_price = (goods_price * val) / 10;
    } else if (type == 'mark_down') {
    goods_price -= val;
    } else {
    goods_price = parseFloat(val);
    }
    $("#act_price-" + sku_id).html("￥" + goods_price.toFixed(2));
    
    }); */

    $().ready(function() {

        var container = $("#{{ $uuid }}");
        var validator = $(container).find("form").validate();
//提交
        $(container).find("#btn_sku_price_submit").click(function() {

            if (!validator.form()) {
                return false;
            }

            var valid = 0;
            var show_msg = 0;
            $("#{{ $uuid }}").find(".bargain_sku").each(function() {
                if ($(this).attr("aria-invalid") == 'true') {
                    valid = 1;
                    return false;
                }
                var sku_id = $(this).data('sku_id');
            });

            if (valid > 0) {
                return false;
            }

            var sku_ids = new Array();
            var original_price = new Array();
            var act_price = new Array();
            var ratio = new Array();

            var original_prices = new Array();
            var act_prices = new Array();
            var act_price_list = new Array();
            var act_stocks = new Array();
            var ratios = new Array();
            var stock_msg = 0;

            $(container).find(".bargain_sku_stock").each(function() {
                var sku_id = $(this).data('sku_id');
                var val = parseInt($(this).val());
                act_stocks.push(sku_id + '-' + val);
// 合计库存
                stock_msg += val;
            });

            $(container).find(".bargain_sku").each(function() {
                var sku_id = $(this).data('sku_id');
                var goods_id = $(this).data('goods_id');
                var type = $(this).data('type');
                var val = parseFloat($(this).val());

                if (val >= 0) {
                    sku_ids.push(sku_id);
                    if (type == 'original_price') {
                        original_price.push(sku_id + '-' + val);
                        original_prices.push(val);
                    } else if (type == 'act_price') {
                        act_price.push(sku_id + '-' + val);
                        act_prices.push(val);
                    } else if (type == 'ratio') {
                        ratio.push(sku_id + '-' + val);
                        ratios.push(val);
                    }
                }

            });

            var goods_id = $(this).data('goods_id');

            $("." + goods_id + '-original-price').val(original_price.join());
            $("." + goods_id + '-act-price').val(act_price.join());
            $("." + goods_id + '-act-stock').val(act_stocks.join());
            $("." + goods_id + '-ratio').val(ratio.join());

            original_prices = original_prices.sort();
            act_prices = act_prices.sort();
            ratios = ratios.sort();

            original_prices.sort(function(a, b) {
                return a - b;
            });

            act_prices.sort(function(a, b) {
                return a - b;
            });

            ratios.sort(function(a, b) {
                return a - b;
            });

            var original_price_msg = '';
            if (original_prices.length > 0) {
                if (original_prices.length == 1) {
                    original_price_msg = original_prices[0];
                } else {
                    if (original_prices[0] == original_prices[original_prices.length - 1]) {
                        original_price_msg = original_prices[0];
                    } else {
                        original_price_msg = original_prices[0] + '-' + original_prices[original_prices.length - 1]
                    }
                }
            } else {
                original_price_msg = '--';
            }
            var act_price_msg = '';
            if (act_prices.length > 0) {
                if (act_prices.length == 1) {
                    act_price_msg = act_prices[0];
                } else {
                    if (act_prices[0] == act_prices[act_prices.length - 1]) {
                        act_price_msg = act_prices[0];
                    } else {
                        act_price_msg = act_prices[0] + '-' + act_prices[act_prices.length - 1]
                    }
                }

            } else {
                act_price_msg = '--';
            }

            var ratio_msg = '';
            if (ratios.length > 0) {
                if (ratios.length == 1) {
                    ratio_msg = ratios[0];
                } else {
                    if (ratios[0] == ratios[ratios.length - 1]) {
                        ratio_msg = ratios[0];
                    } else {
                        ratio_msg = ratios[0] + '-' + ratios[ratios.length - 1]
                    }
                }

            } else {
                ratio_msg = '--';
            }

            $("#" + goods_id + '-original-price-val').html(original_price_msg);
            $("#" + goods_id + '-act-price-val').html(act_price_msg);
            $("#" + goods_id + '-act-stock-val').find(".act_stock").val(stock_msg);
            $("#" + goods_id + '-ratio-val').html(ratio_msg + '%');

            $.closeDialog();

            $.msg('设置成功', {
                time: 1500
            });
        });

// 批量设置
// 批量设置价格、库存、预警值
        $("body").on('click', ".batch > .batch-edit", function() {
            $('.batch > .batch-input').hide();
            $(this).next().show();
        });
        $("body").on('click', ".batch-input > .batch-close", function() {
            $(this).parent().hide();
        });
// 批量设置获取焦点
        $("body").on("click", ".batch-edit", function() {
            $(this).parents(".batch").find(".batch-input").find(":text").focus();
        });

// 批量设置获取焦点
        $("body").on("click", ".btn_batch_set", function() {
            $(this).parents(".batch").find(".batch-input").find(":text").focus();
            var type = $(this).data('type');

            if (type == '0') {
                var batch_type = '.original_price';
                var val = $("#{{ $uuid }}").find(".batch_set_original_price").val();
            } else if (type == '1') {
                var batch_type = '.act_price';
                var val = $("#{{ $uuid }}").find(".batch_set_act_price").val();
            } else if (type == '2') {
                var batch_type = '.act_stock';
                var val = $("#{{ $uuid }}").find(".batch_set_act_stock").val();
            } else if (type == '3') {
                var batch_type = '.ratio';
                var val = $("#{{ $uuid }}").find(".batch_set_ratio").val();
            }

            $("#{{ $uuid }}").find(batch_type).each(function() {
                $("#{{ $uuid }}").find(batch_type).val(val);
                $(this).parents("tr").find(":input").valid();

            });
            $(this).parent().hide();
        });

    })

    // 
</script>