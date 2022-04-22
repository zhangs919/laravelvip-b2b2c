<div id="{{ $uuid }}" class="modal-body p-b-20">
    <form id="ActivityGoods" class="form-horizontal" name="ActivityGoods" action="/dashboard/goods-mix/sku-info?goods_id=1&sku_ids=1&sku_price=&price_mode=1" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="goods-info order-item">
            <div class="edit-goods item">
                <div class="pic-info pull-left">
                    <a class="goods-thumb" href="{{ route('pc_show_goods',['goods_id'=>$goods_info['goods_id']]) }}" target="_blank" title="查看商品详情">
                        <img src="{{ get_image_url($goods_info['goods_image']) }}" alt="查看商品详情">
                    </a>
                </div>
                <div class="txt-info">
                    <div class="desc">
                        <a class="goods-name" href="{{ route('pc_show_goods',['goods_id'=>$goods_info['goods_id']]) }}" target="_blank" title="查看商品详情">{{ $goods_info['goods_name'] }}</a>
                    </div>
                    <div class="wholesale m-t-5">
                        批量设置优惠后价格：
                        <input type="text" class="form-control small sm-height batch_price m-r-5" >
                        元 <a id="batch_set_price" class="btn btn-primary btn-sm m-l-5 c-fff" data-goods-id="">设置</a>
                    </div>
                </div>
            </div>
            <div class="edit-content">
                <div class="alert alert-info br-0 m-b-10">选择参与套餐活动的商品的指定规格，未参与的规格，消费者购买此套餐时，此商品的规格不可选。</div>
                <h4>设置商品规格优惠价格</h4>
                <div class="table-responsive" style="max-height: 230px;">
                    <table class="table table-hover m-b-0">
                        <thead>
                        <tr>
                            <th class="w200">SKU规格</th>
                            <th class="w150">SKU价格（元）</th>
                            <th class="w150 text-c">优惠后价格（元）</th>
                            <th class="w100">
                                <label class="cur-p">
                                    <input class="icheck m-r-5 va-sub cur-p" type="checkbox" data-goods-id=1 id='checkedAll'>
                                    全选
                                </label>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($sku_info as $v)
                            <tr>
                                <td>
                                    <div class="ng-binding">{{ $v['spec_names'] ?? '无' }}</div>
                                </td>
                                <td>{{ $v['goods_price'] }}</td>
                                <td class="text-c">
                                    <input type="text" id="activitygoods-act_price" class="form-control small sm-height sku-act_price"
                                           name="ActivityGoods[act_price]" value="" data-sku_id="{{ $v['sku_id'] }}" data-goods_id="{{ $v['goods_id'] }}" data-goods_price="{{ $v['goods_price'] }}" data-rule-callback="act_price_callback">
                                </td>

                                <td>
                                    <label class="cur-p">
                                        <input class="icheck m-r-5 va-sub cur-p " id={{ $v['sku_id'] }}-sku data-sku-id={{ $v['sku_id'] }} data-goods-id={{ $v['goods_id'] }} name='checkbox' type="checkbox" @if($disable)disabled="disabled"@endif>
                                        参与
                                    </label>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--错误提示模块 star-->
        <div class="member-handle-error"></div>
        <!--错误提示模块 end-->
        <!-- 提交 -->

        <div class="m-t-10 text-c">
            <a id="btn_sku_price_submit" data-goods-id="{{ $goods_info['goods_id'] }}" class="btn btn-primary" style="padding: 5px 68px !important; font-size: 15px !important; line-height: 26px !important;">确认提交</a>
        </div>

    </form>
</div>

<script type='text/javascript'>
    //自定义验证规则
    function act_price_callback(element, value) {

        var sku_id = $(element).data('sku_id');
        var goods_price = $(element).data('goods_price');
        var regu = /^[0-9]+\.?[0-9]*$/;

        if ($("#" + sku_id + "-sku").is(':checked')) {
            if ($(element).val().length == 0) {
                $(element).data("msg", "优惠后价格不能为空");
                return false;
            }
        }
        if (isNaN($(element).val())) {
            $(element).data("msg", "优惠后价格必须是数字。");
            return false;
        }
        if ($(element).val() <= 0) {
            $(element).data("msg", "优惠后价格必须大于0。");
            return false;
        }
//验证优惠价格与SKU价格
        if (goods_price * 100 < $(element).val() * 100) {
            $(element).data("msg", "优惠后价格不能大于商品价格。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "优惠后价格只能保留2位小数。");
                return false;
            }
        }

        return true;
    }

    $().ready(function() {

        /**
         * 初始化validator默认值自定义错误提示位置
         */
        var _errorPlacement = $.validator.defaults.errorPlacement;
        var _success = $.validator.defaults.success;

        $.validator.setDefaults({
            errorPlacement: function(error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");
                if (!error_msg && error_msg == "") {
                    return;
                }
                if ($(element).parents(".member-container").find(".member-handle-error").find("div").size() == 0) {
                    $(".member-handle-error").html("<div class='form-control-warning error m-t-10'></div>");
                }
                var error_dom = $("<p id='"+error_id+"'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></p>");
                $(".member-handle-error").find("div").append(error_dom);
            },
// 失去焦点验证
            onfocusout: function(element) {
                $(element).valid();
            },
// 成功后移除错误提示
            success: function(error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");
                var sku = $(this).data('sku_id');
                var rank = $(this).data('rank_id');
                if ($(element).parents(".member-container").size() > 0) {
                    $("[id='" + error_id + "']").remove();
                }

                if ($(element).find(".member-handle-error").find("p").size() == 0) {
                    $('.form-control-warning').remove();
//$(element).parents(".member-container").find(".member-handle-error").find("div").remove();
                }
                _success.call(this, error, element);
            }
        });
        var validator = $("#{{ $uuid }}").find("form").validate();
//提交
        $("#{{ $uuid }}").find("#btn_sku_price_submit").click(function() {
            var validat = 0;
            $(".sku-act_price").each(function() {
                if ($(this).attr("aria-invalid") == 'true') {
                    validat = 1;
                    return;
                }
            });
            if (!validator.form() || validat > 0) {
                return;
            }
            var act_price = '';
            var max_price = 0;
            var min_price = 0;
            var price_range_min = $("#price_range").data("min_price");
            var price_range_max = $("#price_range").data("max_price");
            $(".sku-act_price").each(function() {
                var sku_id = $(this).data('sku_id');
                var goods_id = $(this).data('goods_id');

                if ($("#" + sku_id + "-sku").is(':checked')) {
                    if (act_price.length == 0) {
                        if ($(this).val()) {
                            act_price = goods_id + '-' + sku_id + '-' + $(this).val();
                        }
                    } else {
                        if ($(this).val()) {
                            act_price += ',' + goods_id + '-' + sku_id + '-' + $(this).val();
                        }
                    }
                }

            });

            var goods_id = $(this).data('goods-id');
            $("." + goods_id + "-sku_price").val(act_price);
//循环计算价格区间
            price_range_min = 0;
            price_range_max = 0
            $(".calculation_price").each(function() {

                max_price = 0;
                min_price = 0;
                var val = $(this).val();
                sku_arr = val.split(",");
                if (sku_arr.length >= 1) {
                    for (var i = 0; i < sku_arr.length; i++) {
                        var sku_price = sku_arr[i].split("-");
//跳过没有选中的规格属性
                        if (sku_price.length < 3) {
                            continue;
                        }
                        if (max_price == 0) {
                            max_price = sku_price[2];
                        } else {
                            if (max_price * 1 <= sku_price[2] * 1) {
                                max_price = sku_price[2];
                            }
                        }
                        if (min_price == 0) {
                            min_price = sku_price[2];
                        } else {
                            if (min_price >= sku_price[2]) {
                                min_price = sku_price[2];
                            }
                        }
                        if (i == (sku_arr.length - 1)) {

                            price_range_min += parseFloat(min_price);
                            price_range_max += parseFloat(max_price);
                            min_price = 0;
                            max_price = 0
                        }
                    }
                }

            });
            /* price_range_min = parseFloat(min_price) + parseFloat(price_range_min);
            
            price_range_max = parseFloat(max_price) + parseFloat(price_range_max); */
            $("#price_range").data("max_price", price_range_max);
            $("#price_range").data("min_price", price_range_min);
            $("#price_range").val(price_range_min + '-' + price_range_max);
            $.msg('设置成功', {
                time: 5000
            });
            $.closeAll();
        });

//全选
        $("body").on("click", "#checkedAll", function() {
            var goods_id = $(this).data('goods-id');
            if ($(this).is(":checked")) {
                $("input[name='checkbox']").prop("checked", true);
            } else {
                $("input[name='checkbox']").prop("checked", false);

            }
        });
//批量设置价格
        $("body").on("click", "#batch_set_price", function() {
            var price = $('.batch_price').val();
            if (price.length == 0) {
                $.msg('价格不能为空', {
                    time: 5000
                });
                return;
            } else if (isNaN(price)) {
                $.msg('设置价格必须是数字', {
                    time: 5000
                });
                return;
            } else if (price < 0) {
                $.msg('设置价格必须大于0', {
                    time: 5000
                });
                return;
            } else {

                $('.sku-act_price').each(function() {
                    $(this).val(price);
                })

            }
        });

    })
</script>