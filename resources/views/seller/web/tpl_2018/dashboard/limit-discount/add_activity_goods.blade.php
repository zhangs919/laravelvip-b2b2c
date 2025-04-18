<script type="text/javascript">
    //
</script>
<div class="table-content m-t-30 clearfix limit-discount-goods">
    <form id="LimitDiscountModel" class="form-horizontal" name="LimitDiscountModel" action="/dashboard/limit-discount/add-activity-goods?act_id=17" method="post" enctype="multipart/form-data">
        @csrf
        <!-- -->
        <div id="1715833994Xcikt7" class="limit-discount-goods">
            <!-- 活动商品 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="limitdiscountmodel-use_range" class="col-sm-3 control-label">
                        <span class="ng-binding">参与商品：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input type='hidden' name='LimitDiscountModel[use_range]' value='1'/>
                            <input type="hidden" name="LimitDiscountModel[use_range]" value=""><div id="limitdiscountmodel-use_range" class="" name="LimitDiscountModel[use_range]"><label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[use_range]" value="0" disabled="disabled"> 全部商品参与（包含出售中和已下架商品）</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[use_range]" value="2" disabled="disabled"> 全部出售中商品参与</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[use_range]" value="1" checked disabled="disabled"> 指定商品参与</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[use_range]" value="3" disabled="disabled"> 指定商品不参与</label></div>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field act_price_type_div hide">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">参与商品活动价设置：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box m-r-10">
                            <div class="" name="LimitDiscountModel[act_price_type]" value="0"><label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[act_price_type]" value="0" checked> 打折</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[act_price_type]" value="1"> 减价</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[act_price_type]" value="2"> 指定折扣价</label></div>
                            <div class='act_discount_div act_price_type_text  m-t-10 '>
                                <input type="text" id="limitdiscountmodel-act_discount" class="form-control ipt m-r-10" name="LimitDiscountModel[act_discount]">
                                折
                            </div>
                            <div class='act_mark_down_div act_price_type_text  m-t-10 hide'>
                                <input type="text" id="limitdiscountmodel-act_mark_down" class="form-control ipt m-r-10" name="LimitDiscountModel[act_mark_down]">
                                元
                            </div>
                            <div class='act_price_div act_price_type_text  m-t-10 hide'>
                                <input type="text" id="limitdiscountmodel-act_price" class="form-control ipt m-r-10" name="LimitDiscountModel[act_price]">
                                元
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field act_stock_div hide">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">参与商品活动库存设置：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box m-r-10">
                            <input type="text" id="limitdiscountmodel-act_stock" class="form-control ipt" name="LimitDiscountModel[act_stock]" data-rule-callback="check_act_stock_callback">
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">
                                    <div class="help-block help-block-t">编辑时，如果将活动库存设置为非0，则设置的值将替换参与活动的商品的活动库存，如果设置为0，商品活动库存不变</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field act_goods_div ">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">选择商品：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box disp-block m-r-10" style="float:none">
                            <!--请在这里调取选择商品选择器插件-->
                            <div id="widget_goods" class="w800"></div>
                            <div id="goods_list">
                                <div class="m-b-10 alert alert-warning br-0 w800" style="background-color: #fff9e6; border: 1px solid #ffd77a;">
                                    <p><b>重要提示</b></p>
                                    <p class="m-t-5">商品“剩余活动库存”如果为&nbsp;0&nbsp;则活动商品将<b>恢复原价售卖</b>，活动期间请确保“剩余活动库存”充足</p>
                                </div>
                                <div class="1715833994Mhiv79 search-condition-table m-b-10 w800">
                                    <div class="search-condition-box">
                                        <select name='keyword_type'  class="form-control w120 m-l-2 m-r-2">
                                            <option value='1'>商品名称</option>
                                            <option value='2'>商品ID</option>
                                            <option value='3'>商品货号</option>
                                        </select>
                                        <input type="text" name="keyword" class="form-control w150 m-l-2 m-r-2" placeholder="关键字">
                                        <input type="text" name="goods_barcode" class="form-control w150 m-l-2 m-r-2" placeholder="商品条形码">
                                        <input type="button" class="btn btn-primary m-l-2 m-r-2 btn-search" value="搜索商品">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div id="1715833994Mhiv79" class="table-responsive m-t-10 w800" style="max-height: 450px; overflow-y: auto;">
                                    <table id="selected_table_list" class="table table-hover m-b-0 w800 limit-discount-list" >
                                        <thead>
                                        <tr>
                                            <th class="w50">
                                                <input type="checkbox" />
                                            </th>
                                            <th class="w150">商品名称</th>
                                            <th class="w100 text-c">原价</th>
                                            <th class="w80 text-c">折扣（折）</th>
                                            <th class="w80 text-c">减价（元）</th>
                                            <th class="w150 text-c">指定折扣价（元）</th>
                                            <th class="w120 text-c">活动价</th>
                                            <!-- <th class="w100 text-c">总活动库存<i class='fa fa-question-circle c-ccc m-l-5' data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="总活动库存 = 剩余活动库存 + 已售卖活动商品数量"></i></th> -->
                                            <th class="w100 text-c">剩余<br/>活动库存</th>
                                            <th class="handle w100">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody id="goods_info">
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td class="w50">
                                                <input type="checkbox" class="checkBox" />
                                            </td>
                                            <td colspan="8">
                                                <input type="button" class="btn btn-default m-r-2 batchset-discount" value="批量折扣" />
                                                <input type="button" class="btn btn-default m-r-2 batchset-reduce" value="批量减价" />
                                                <input type="button" class="btn btn-default m-r-2 batchset-set" value="批量指定折扣价" />
                                                <input type="button" class="btn btn-default m-r-2 batchset-stock" value="批量设置活动库存" />
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!--错误提示模块 star-->
                                <div class="member-handle-error"></div>
                                <!--错误提示模块 end-->
                                <template id="batch_discount_template">
                                    <div class="p-20 ">
                                        <div class="table-content m-t-10">
                                            <div class="form-horizontal">
                                                <!-- 服务保障 -->
                                                <div class="simple-form-field" >
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 control-label">
                                                            <span class="ng-binding">折扣：</span>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <div class="form-control-box">
                                                                <input type="text" id="batchset_discount_val" class="form-control w100" data-rule-callback="list_act_price_callback">
                                                                <span class="m-l-5">折</span>
                                                            </div>
                                                            <div class="help-block help-block-t"></div>
                                                        </div>
                                                    </div>
                                                </div>        </div>
                                        </div>
                                    </div>
                                </template>
                                <template id="batch_reduce_template">
                                    <div class="p-20 ">
                                        <div class="table-content m-t-10">
                                            <div class="form-horizontal">
                                                <!-- 服务保障 -->
                                                <div class="simple-form-field" >
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 control-label">
                                                            <span class="ng-binding">减价：</span>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <div class="form-control-box">
                                                                <span class="m-r-5">减</span>
                                                                <input type="text" id="batchset_reduce_val" class="form-control w100" data-rule-callback="list_act_mark_down_callback">
                                                                <span class="m-l-5">元</span>
                                                            </div>
                                                            <div class="help-block help-block-t"></div>
                                                        </div>
                                                    </div>
                                                </div>        </div>
                                        </div>
                                    </div>
                                </template>
                                <template id="batch_set_template">
                                    <div class="p-20 ">
                                        <div class="table-content m-t-10">
                                            <div class="form-horizontal">
                                                <!-- 服务保障 -->
                                                <div class="simple-form-field" >
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 control-label">
                                                            <span class="ng-binding">指定折扣价：</span>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <div class="form-control-box">
                                                                <input type="text" id="batchset_set_val" class="form-control w100" data-rule-callback="list_set_price_callback">
                                                                <span class="m-l-5">元</span>
                                                            </div>
                                                            <div class="help-block help-block-t"></div>
                                                        </div>
                                                    </div>
                                                </div>        </div>
                                        </div>
                                    </div>
                                </template>
                                <template id="batch_stock_template">
                                    <div class="p-20 ">
                                        <div class="table-content m-t-10">
                                            <div class="form-horizontal">
                                                <!-- 服务保障 -->
                                                <div class="simple-form-field" >
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 control-label">
                                                            <span class="ng-binding">剩余活动库存：</span>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <div class="form-control-box">
                                                                <input type="text" id="batchset_stock_val" class="form-control w100 m-r-10" data-rule-callback="list_set_act_stock_callback">
                                                            </div>
                                                            <div class="help-block help-block-t"></div>
                                                        </div>
                                                    </div>
                                                </div>        </div>
                                        </div>
                                    </div>
                                </template>
                                <script type="text/javascript">
                                    $('#1715833994Mhiv79').on('click','.checkBox',function(){
                                        $('#1715833994Mhiv79').find('tbody').find('tr').removeClass('active')
                                    });
                                    $('.1715833994Mhiv79').on('click','.btn-search',function(){
                                        $("#1715833994Mhiv79").animate({
                                            scrollTop:0
                                        }, 0);
                                        var keyword_type = $('.1715833994Mhiv79').find('select[name="keyword_type"]').val();
                                        var keyword = $('.1715833994Mhiv79').find('input[name="keyword"]').val();
                                        var goods_barcode = $('.1715833994Mhiv79').find('input[name="goods_barcode"]').val();
                                        $('#1715833994Mhiv79').find('tbody').find('tr').removeClass('goods_info_search_selected');
                                        if (keyword != '' && goods_barcode != '') {
                                            if (keyword_type == 1) {
                                                $('#1715833994Mhiv79').find('tbody').find('tr[data-goods_name*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                                            } else if (keyword_type == 2) {
                                                $('#1715833994Mhiv79').find('tbody').find('tr[data-goods_id*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                                            } else if (keyword_type == 3) {
                                                $('#1715833994Mhiv79').find('tbody').find('tr[data-goods_sn*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                                            }
                                        } else if (keyword != '') {
                                            if (keyword_type == 1) {
                                                $('#1715833994Mhiv79').find('tbody').find('tr[data-goods_name*="' + keyword + '"]').addClass('goods_info_search_selected');
                                            } else if (keyword_type == 2) {
                                                $('#1715833994Mhiv79').find('tbody').find('tr[data-goods_id*="' + keyword + '"]').addClass('goods_info_search_selected');
                                            } else if (keyword_type == 3) {
                                                $('#1715833994Mhiv79').find('tbody').find('tr[data-goods_sn*="' + keyword + '"]').addClass('goods_info_search_selected');
                                            }
                                        } else if (goods_barcode != '') {
                                            $('#1715833994Mhiv79').find('tbody').find('tr[data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                                        }
                                        var item=$("#1715833994Mhiv79").find('.goods_info_search_selected').length;
                                        if(item >0){
                                            var item_top = $("#1715833994Mhiv79").find('.goods_info_search_selected:first').offset().top
                                            var parent_top =$("#1715833994Mhiv79").offset().top;
                                            var top = item_top - parent_top
                                            if(top > 0){
                                                $("#1715833994Mhiv79").animate({
                                                    scrollTop:top
                                                }, 0);
                                            }else{
                                                $("#1715833994Mhiv79").animate({
                                                    scrollTop:0
                                                }, 0);
                                            }
                                        }
                                    });
                                    // 自定义验证规则：指定折扣价
                                    function list_set_price_callback(element, value) {
                                        // 判断是否需要检查
                                        if(checkDiscountEnable(element) == false) {
                                            return true;
                                        }
                                        var sku_id = $(element).data('sku_id');
                                        var min_price = $(element).data('goods_price');
                                        var max_price = $(element).data('goods_price');
                                        var regu = /^[0-9]+\.?[0-9]*$/;
                                        if (isNaN($(element).val())) {
                                            $(element).data("msg", "指定折扣价格必须是数字。");
                                            return false;
                                        }
                                        if ($(element).val() <= 0) {
                                            $(element).data("msg", "指定折扣价格必须大于0。");
                                            return false;
                                        }
                                        //验证优惠价格与SKU价格
                                        if (min_price * 100 < $(element).val() * 100) {
                                            $(element).data("msg", "指定折扣价格不能大于商品价格 " + min_price + "。");
                                            return false;
                                        }
                                        if ($(element).val().indexOf('.') > -1) {
                                            if ($(element).val().split('.')[1].length > 2) {
                                                $(element).data("msg", "指定折扣价格只能保留2位小数。");
                                                return false;
                                            }
                                        }
                                        return true;
                                    }
                                    // 自定义验证规则：折扣
                                    function list_act_price_callback(element, value) {
                                        // 判断是否需要检查
                                        if(checkDiscountEnable(element) == false) {
                                            return true;
                                        }
                                        var goods_id = $(element).data('goods_id');
                                        var min_price = $(element).data('goods_price');
                                        var max_price = $(element).data('goods_price');
                                        var regu = /^[0-9]+\.?[0-9]*$/;
                                        if (isNaN($(element).val())) {
                                            $(element).data("msg", "折扣必须是数字。");
                                            return false;
                                        }
                                        if ($(element).val() < 0) {
                                            $(element).data("msg", "折扣必须大于0。");
                                            return false;
                                        }
                                        if ($(element).val() > 10) {
                                            $(element).data("msg", "折扣必须小于10。");
                                            return false;
                                        }
                                        if ($(element).val().indexOf('.') > -1) {
                                            if ($(element).val().split('.')[1].length > 2) {
                                                $(element).data("msg", "折扣只能保留2位小数。");
                                                return false;
                                            }
                                        }
                                        if ($(element).val() != '' &&　$(element).val() * 100 < 1) {
                                            $(element).data("msg", "折扣不能小于0.01。");
                                            return false;
                                        }
                                        if ($(element).val() != '' && $(element).val() * min_price / 10 < 0.01) {
                                            $(element).data("msg", "折后金额不能小于0.01。");
                                            return false;
                                        }
                                        return true;
                                    }
                                    // 自定义验证规则：减价
                                    function list_act_mark_down_callback(element, value) {
                                        // 判断是否需要检查
                                        if(checkDiscountEnable(element) == false) {
                                            return true;
                                        }
                                        var goods_id = $(element).data('goods_id');
                                        var min_price = $(element).data('goods_price');
                                        var max_price = $(element).data('goods_price');
                                        var regu = /^[0-9]+\.?[0-9]*$/;
                                        if (isNaN($(element).val())) {
                                            $(element).data("msg", "减价金额必须是数字。");
                                            return false;
                                        }
                                        if ($(element).val() < 0) {
                                            $(element).data("msg", "减价金额必须大于0。");
                                            return false;
                                        }
                                        if ($(element).val() * 100 > min_price * 100) {
                                            $(element).data("msg", "减价金额不能大于商品最低金额￥" + min_price);
                                            return false;
                                        }
                                        if ($(element).val().indexOf('.') > -1) {
                                            if ($(element).val().split('.')[1].length > 2) {
                                                $(element).data("msg", "折扣只能保留2位小数。");
                                                return false;
                                            }
                                        }
                                        return true;
                                    }
                                    function list_set_act_stock_callback(element, value) {
                                        if (/^(([0])|([1-9](\d*)))$/.test($(element).val()) == false) {
                                            $(element).data("msg", "活动库存必须是一个大于等于 0 的整数");
                                            return false;
                                        }
                                        return true;
                                    }
                                    //设置价格
                                    $("body").on('change', ".limit_discount_sku", function() {
                                        var goods_id = $(this).data('goods_id');
                                        var sku_id = $(this).data('sku_id');
                                        var type = $(this).data('type');
                                        var val = $(this).val();
                                        var goods_price = $(this).data('goods_price');
                                        var discount = '';
                                        var reduce = '';
                                        var set = '';
                                        if(!$(this).valid()) {
                                            return;
                                        }
                                        $(".sku-act_price-" + sku_id).val('');
                                        $(".sku-act_price-" + sku_id).removeClass('error');
                                        $("." + type + '-' + sku_id).val(val);
                                        if (isNaN(val) || val.length == 0) {
                                            $("#act_price-" + sku_id).html("--");
                                            return;
                                        }
                                        if (type == 'discount') {
                                            goods_price = (goods_price * val) / 10;
                                            $("." + goods_id + '-discount').val(sku_id + '-' + val);
                                            $("." + goods_id + '-reduce').val('');
                                            $("." + goods_id + '-set').val('');
                                        } else if (type == 'mark_down') {
                                            goods_price -= val;
                                            $("." + goods_id + '-reduce').val(sku_id + '-' + val);
                                            $("." + goods_id + '-discount').val('');
                                            $("." + goods_id + '-set').val('');
                                        } else {
                                            goods_price = parseFloat(val);
                                            $("." + goods_id + '-reduce').val('');
                                            $("." + goods_id + '-discount').val('');
                                            $("." + goods_id + '-set').val(sku_id + '-' + val);
                                        }
                                        $("#" + goods_id + "-goods-price").html("￥" + goods_price.toFixed(2));
                                    });
                                    // 设置库存
                                    $("body").on("change", ".set_act_stock", function() {
                                        var goods_id = $(this).data('goods_id');
                                        var sku_id = $(this).data('sku_id');
                                        var val = $(this).val();
                                        if(!$(this).valid()) {
                                            return;
                                        }
                                        if ($(this).valid()) {
                                            $("." + goods_id + '-stock').val(sku_id + '-' + val);
                                        }
                                    });
                                    var tablelist = null;
                                    $().ready(function() {
                                        var container = $("#1715833994Mhiv79");
                                        $("[data-toggle='popover']").popover();
                                        tablelist = $("#1715833994Mhiv79").find("#selected_table_list").tablelist();
                                        //删除商品
                                        $(container).off("click", ".del").on("click", ".del", function() {
                                            var target = $(this).parents("tr");
                                            var goods_id = $(this).data("goods_id");
                                            var sku_id = $(this).data("sku-id");
                                            var goods_price = $(this).data("goods_price");
                                            var container = $(this).parents(".limit-discount-goods").find("#widget_goods");
                                            var goodspicker = $.goodspicker(container);
                                            if (goodspicker) {
                                                // 获取控件
                                                goodspicker.remove(goods_id, sku_id);
                                                var selected_number = goodspicker.goods_ids.length;
                                                if (selected_number == 0) {
                                                    $(this).parents("table").remove();
                                                }
                                            }
                                            $(target).remove();
                                        });
                                        // 设置
                                        $(container).off("click", ".set-price").on("click", ".set-price", function() {
                                            var goods_id = $(this).data("goods_id");
                                            var sku_discount = $("." + goods_id + "-discount").val();
                                            var sku_reduce = $("." + goods_id + "-reduce").val();
                                            var sku_set = $("." + goods_id + "-set").val();
                                            var sku_stock = $("." + goods_id + "-stock").val();
                                            $.loading.start();
                                            $.open({
                                                title: '折扣价设置',
                                                width: '1200px',
                                                ajax: {
                                                    url: '/dashboard/limit-discount/sku-info',
                                                    method: 'POST',
                                                    data: {
                                                        act_id: "17",
                                                        goods_id: goods_id,
                                                        sku_discount: sku_discount,
                                                        sku_reduce: sku_reduce,
                                                        sku_set: sku_set,
                                                        sku_stock: sku_stock,
                                                    },
                                                    success: function(result) {
                                                        $.loading.stop();
                                                    },
                                                }
                                            });
                                        });
                                        // 临时验证器
                                        function validate(element) {
                                            var value = $(element).val();
                                            var callback = $(element).data("rule-callback");
                                            callback = window[callback];
                                            var valid = value != "" && callback(element, value);
                                            if (valid) {
                                                showError(element, false);
                                            } else {
                                                showError(element, $(element).data("msg"));
                                            }
                                            $(element).data("valid", valid)
                                            return valid;
                                        }
                                        // 批量设置折扣
                                        $(".batchset-discount").unbind().click(function() {
                                            var ids = tablelist.checkedValues();
                                            ids = ids.join(",");
                                            if (!ids) {
                                                $.msg("请选择要设置的商品！");
                                                return;
                                            }
                                            $.open({
                                                title: '批量设置折扣',
                                                width: '480px',
                                                content: $("#batch_discount_template").html(),
                                                btn: ['确定', '取消'],
                                                success: function(obj) {
                                                    $(obj).find("#batchset_discount_val").keyup(function() {
                                                        var element = this;
                                                        $("#1715833994Mhiv79").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                                                            $(element).data($(this).data());
                                                            $(element).data("goods_id", $(this).val());
                                                            if(validate(element) == false){
                                                                return false;
                                                            }
                                                        })
                                                    });
                                                },
                                                yes: function(index, obj) {
                                                    var target = $(obj).find("#batchset_discount_val");
                                                    var value = $(target).val();
                                                    if ($(target).data("valid") != true) {
                                                        $(target).focus();
                                                        return;
                                                    }
                                                    $.loading.start();
                                                    $("#1715833994Mhiv79").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                                                        var goods_id = $(this).val();
                                                        var sku_id = $(this).data("sku_id");
                                                        var sku_open = $(this).data("sku_open");
                                                        var min_price = $(this).data("min_price");
                                                        var max_price = $(this).data("max_price");
                                                        // 数据
                                                        $("." + goods_id + "-discount").val("0-" + value);
                                                        $("." + goods_id + "-reduce").val("");
                                                        $("." + goods_id + "-set").val("");
                                                        // 价格
                                                        if(min_price == max_price){
                                                            $("#" + goods_id + "-goods-price").html("￥" + (min_price * value / 10).toFixed(2))
                                                        }else{
                                                            $("#" + goods_id + "-goods-price").html("￥" + (min_price * value / 10).toFixed(2) + "-￥" + (max_price * value / 10).toFixed(2))
                                                        }
                                                        // 展示
                                                        if(sku_open == 1){
                                                            $("#" + goods_id + "-discount-val").html(value);
                                                            $("#" + goods_id + "-reduce-val").html("--");
                                                            $("#" + goods_id + "-set-val").html("--");
                                                        }else{
                                                            $(".discount-" + sku_id).val(value);
                                                            $(".mark_down-" + sku_id).val("");
                                                            $(".set_act_price-" + sku_id).val("");
                                                        }
                                                    });
                                                    $.loading.stop();
                                                    $.closeDialog(index);
                                                }
                                            });
                                            return false;
                                        });
                                        // 批量设置减价
                                        $(container).on("click", ".batchset-reduce", function() {
                                            var ids = tablelist.checkedValues();
                                            ids = ids.join(",");
                                            if (!ids) {
                                                $.msg("请选择要设置的商品！");
                                                return;
                                            }
                                            $.open({
                                                title: '批量设置减价',
                                                width: '480px',
                                                content: $("#batch_reduce_template").html(),
                                                btn: ['确定', '取消'],
                                                success: function(obj) {
                                                    $(obj).find("#batchset_reduce_val").keyup(function() {
                                                        var element = this;
                                                        $("#1715833994Mhiv79").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                                                            $(element).data($(this).data());
                                                            $(element).data("goods_id", $(this).val());
                                                            if (validate(element) == false) {
                                                                return false;
                                                            }
                                                        })
                                                    });
                                                },
                                                yes: function(index, obj) {
                                                    var target = $(obj).find("#batchset_reduce_val");
                                                    var value = $(target).val();
                                                    if ($(target).data("valid") != true) {
                                                        $(target).focus();
                                                        return;
                                                    }
                                                    $.loading.start();
                                                    $("#1715833994Mhiv79").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                                                        var goods_id = $(this).val();
                                                        var sku_id = $(this).data("sku_id");
                                                        var sku_open = $(this).data("sku_open");
                                                        var min_price = $(this).data("min_price");
                                                        var max_price = $(this).data("max_price");
                                                        // 数据
                                                        $("." + goods_id + "-discount").val("");
                                                        $("." + goods_id + "-reduce").val("0-" + value);
                                                        $("." + goods_id + "-set").val("");
                                                        // 价格
                                                        if(min_price == max_price){
                                                            $("#" + goods_id + "-goods-price").html("￥" + (min_price - value).toFixed(2))
                                                        }else{
                                                            $("#" + goods_id + "-goods-price").html("￥" + (min_price - value).toFixed(2) + "-￥" + (max_price - value).toFixed(2))
                                                        }
                                                        // 展示
                                                        if(sku_open == 1){
                                                            $("#" + goods_id + "-discount-val").html("--");
                                                            $("#" + goods_id + "-reduce-val").html(value);
                                                            $("#" + goods_id + "-set-val").html("--");
                                                        }else{
                                                            $(".discount-" + sku_id).val("");
                                                            $(".mark_down-" + sku_id).val(value);
                                                            $(".set_act_price-" + sku_id).val("");
                                                        }
                                                    });
                                                    $.loading.stop();
                                                    $.closeDialog(index);
                                                }
                                            });
                                            return false;
                                        });
                                        // 批量设置指定折扣价
                                        $(container).on("click", ".batchset-set", function() {
                                            var ids = tablelist.checkedValues();
                                            ids = ids.join(",");
                                            if (!ids) {
                                                $.msg("请选择要设置的商品！");
                                                return;
                                            }
                                            $.open({
                                                title: '批量设置指定折扣价',
                                                width: '480px',
                                                content: $("#batch_set_template").html(),
                                                btn: ['确定', '取消'],
                                                success: function(obj) {
                                                    $(obj).find("#batchset_set_val").keyup(function() {
                                                        var element = this;
                                                        $("#1715833994Mhiv79").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                                                            $(element).data($(this).data());
                                                            $(element).data("goods_id", $(this).val());
                                                            if (validate(element) == false) {
                                                                return false;
                                                            }
                                                        })
                                                    });
                                                },
                                                yes: function(index, obj) {
                                                    var target = $(obj).find("#batchset_set_val");
                                                    var value = $(target).val();
                                                    if ($(target).data("valid") != true) {
                                                        $(target).focus();
                                                        return;
                                                    }
                                                    $.loading.start();
                                                    $("#1715833994Mhiv79").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                                                        var goods_id = $(this).val();
                                                        var sku_id = $(this).data("sku_id");
                                                        var sku_open = $(this).data("sku_open");
                                                        var min_price = $(this).data("min_price");
                                                        var max_price = $(this).data("max_price");
                                                        min_price = parseFloat(min_price).toFixed(2);
                                                        max_price = parseFloat(max_price).toFixed(2);
                                                        // 数据
                                                        $("." + goods_id + "-discount").val("");
                                                        $("." + goods_id + "-reduce").val("");
                                                        $("." + goods_id + "-set").val("0-" + value);
                                                        // 价格
                                                        $("#" + goods_id + "-goods-price").html("￥" + value);
                                                        // 展示
                                                        if(sku_open == 1){
                                                            $("#" + goods_id + "-discount-val").html("--");
                                                            $("#" + goods_id + "-reduce-val").html("--");
                                                            $("#" + goods_id + "-set-val").html(value);
                                                        }else{
                                                            $(".discount-" + sku_id).val("");
                                                            $(".mark_down-" + sku_id).val("");
                                                            $(".set_act_price-" + sku_id).val(value);
                                                        }
                                                    });
                                                    $.loading.stop();
                                                    $.closeDialog(index);
                                                }
                                            });
                                            return false;
                                        });
                                        // 批量设置活动库存
                                        $(container).on("click", ".batchset-stock", function() {
                                            var ids = tablelist.checkedValues();
                                            ids = ids.join(",");
                                            if (!ids) {
                                                $.msg("请选择要设置的商品！");
                                                return;
                                            }
                                            $.open({
                                                title: '批量设置活动库存',
                                                width: '480px',
                                                content: $("#batch_stock_template").html(),
                                                btn: ['确定', '取消'],
                                                success: function(obj) {
                                                    $(obj).find("#batchset_stock_val").keyup(function() {
                                                        var element = this;
                                                        $("#1715833994Mhiv79").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                                                            $(element).data($(this).data());
                                                            $(element).data("goods_id", $(this).val());
                                                            if (validate(element) == false) {
                                                                return false;
                                                            }
                                                        })
                                                    });
                                                },
                                                yes: function(index, obj) {
                                                    var target = $(obj).find("#batchset_stock_val");
                                                    var value = $(target).val();
                                                    if ($(target).data("valid") != true) {
                                                        $(target).focus();
                                                        return;
                                                    }
                                                    $.loading.start();
                                                    $("#1715833994Mhiv79").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                                                        var goods_id = $(this).val();
                                                        var sku_id = $(this).data("sku_id");
                                                        var sku_open = $(this).data("sku_open");
                                                        var goods_price = $(this).data("goods_price");
                                                        var min_price = $(this).data("min_price");
                                                        var max_price = $(this).data("max_price");
                                                        min_price = parseFloat(min_price).toFixed(2);
                                                        max_price = parseFloat(max_price).toFixed(2);
                                                        var sku_num = $(this).data("sku_num") ? $(this).data("sku_num") : 1;
                                                        // 数据
                                                        $("." + goods_id + "-stock").val("0-" + value);
                                                        // 展示
                                                        if(sku_open == 1){
                                                            $("#" + goods_id + "-stock-val").find(":input").val(value * sku_num);
                                                        }else{
                                                            $(".set_act_stock-" + sku_id).val(value * sku_num);
                                                        }
                                                    });
                                                    $.loading.stop();
                                                    $.closeDialog(index);
                                                }
                                            });
                                            return false;
                                        });
                                    })
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field act_goods_no_join_div hide">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">选择商品：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box disp-block m-r-10" style="float:none">
                            <!--请在这里调取选择商品选择器插件-->
                            <div id="widget_goods_no_join" class="w800"></div>
                            <div id="no_join_goods_list">
                                <div class="search-condition-table no_join_search m-b-10 w800">
                                    <div class="search-condition-box">
                                        <select name='keyword_type'  class="form-control w120 m-l-2 m-r-2">
                                            <option value='1'>商品名称</option>
                                            <option value='2'>商品ID</option>
                                            <option value='3'>商品货号</option>
                                        </select>
                                        <input type="text" name="keyword" class="form-control w150 m-l-2 m-r-2" placeholder="关键字">
                                        <input type="text" name="goods_barcode" class="form-control w150 m-l-2 m-r-2" placeholder="商品条形码">
                                        <input type="button" class="btn btn-primary m-l-2 m-r-2 btn-search" value="搜索商品">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div id="no_join_list" class="table-responsive m-t-10 w800" style="max-height: 450px; overflow-y: auto;">
                                    <table id="selected_table_list_no_join" class="table table-hover m-b-0 w800 limit-discount-list">
                                        <thead>
                                        <tr>
                                            <th class="w50">
                                                <input type="checkbox" />
                                            </th>
                                            <th>商品名称</th>
                                            <th class="w100 text-c">原价</th>
                                            <th class="handle w100">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody id="goods_info_no_join">
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td class="w50">
                                                <input type="checkbox" class="checkBox" />
                                            </td>
                                            <td colspan="3">
                                                <input type="button" class="btn btn-default m-r-2 batchset-del" value="批量删除" />
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <script type="text/javascript">
                                    var no_join_tablelist = null;
                                    $().ready(function() {
                                        $('#no_join_list').on('click', '.checkBox', function () {
                                            $('#no_join_list').find('tbody').find('tr').removeClass('active')
                                        })
                                        $('.no_join_search').on('click', '.btn-search', function () {
                                            var keyword_type = $('.no_join_search').find('select[name="keyword_type"]').val();
                                            var keyword = $('.no_join_search').find('input[name="keyword"]').val();
                                            var goods_barcode = $('.no_join_search').find('input[name="goods_barcode"]').val();
                                            $('#no_join_list').find('tbody').find('tr').removeClass('goods_info_search_selected');
                                            if (keyword != '' && goods_barcode != '') {
                                                if (keyword_type == 1) {
                                                    $('#no_join_list').find('tbody').find('tr[data-goods_name*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                                                } else if (keyword_type == 2) {
                                                    $('#no_join_list').find('tbody').find('tr[data-goods_id*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                                                } else if (keyword_type == 3) {
                                                    $('#no_join_list').find('tbody').find('tr[data-goods_sn*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                                                }
                                            } else if (keyword != '') {
                                                if (keyword_type == 1) {
                                                    $('#no_join_list').find('tbody').find('tr[data-goods_name*="' + keyword + '"]').addClass('goods_info_search_selected');
                                                } else if (keyword_type == 2) {
                                                    $('#no_join_list').find('tbody').find('tr[data-goods_id*="' + keyword + '"]').addClass('goods_info_search_selected');
                                                } else if (keyword_type == 3) {
                                                    $('#no_join_list').find('tbody').find('tr[data-goods_sn*="' + keyword + '"]').addClass('goods_info_search_selected');
                                                }
                                            } else if (goods_barcode != '') {
                                                $('#no_join_list').find('tbody').find('tr[data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                                            }
                                            var item = $("#no_join_list").find('.goods_info_search_selected').length;
                                            if (item > 0) {
                                                var item_top = $("#no_join_list").find('.goods_info_search_selected:first').offset().top
                                                var parent_top = $("#no_join_list").offset().top;
                                                var top = item_top - parent_top
                                                if (top > 0) {
                                                    $("#no_join_list").animate({
                                                        scrollTop: top
                                                    }, 0);
                                                }else{
                                                    $("#no_join_list").animate({
                                                        scrollTop: 0
                                                    }, 0);
                                                }
                                            }
                                        })
                                        $("[data-toggle='popover']").popover();
                                        no_join_tablelist = $("#no_join_list").find("#selected_table_list_no_join").tablelist();
                                        //删除商品
                                        $("body").off("click", ".del-no-join").on("click", ".del-no-join", function () {
                                            var target = $(this).parents("tr");
                                            var goods_id = $(this).data("goods_id");
                                            var sku_id = $(this).data("sku-id");
                                            var container = $(this).parents(".limit-discount-goods").find("#widget_goods_no_join");
                                            var goodspicker = $.goodspicker(container);
                                            if (goodspicker) {
                                                // 获取控件
                                                goodspicker.remove(goods_id, sku_id);
                                                var selected_number = goodspicker.goods_ids.length;
                                                if (selected_number == 0) {
                                                    $(this).parents("table").remove();
                                                }
                                            }
                                            $(target).remove();
                                        });
                                        // 批量设置减价
                                        $("#1715833994Xcikt7").on("click", ".batchset-del", function () {
                                            var ids = no_join_tablelist.checkedValues();
                                            if (!ids) {
                                                $.msg("请选择要删除的商品！");
                                                return;
                                            }
                                            var container = $("#widget_goods_no_join");
                                            var goodspicker = $.goodspicker(container);
                                            for (j = 0, len = ids.length; j < len; j++) {
                                                var sku_id = $('.del-no-join[data-goods_id="' + ids[j] + '"]').data("sku-id");
                                                if (goodspicker) {
                                                    // 获取控件
                                                    goodspicker.remove(ids[j], sku_id);
                                                }
                                            }
                                            if (goodspicker) {
                                                var selected_number = goodspicker.goods_ids.length;
                                                if (selected_number == 0) {
                                                    $('#selected_table_list_no_join').remove();
                                                }
                                            }
                                            $('#selected_table_list_no_join').find('.table-list-checkbox:checked').parents('td').parents('tr').remove();
                                            return false;
                                        });
                                    })
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 门店选择器 -->
            <!-- 门店选择器 -->
            <!-- -->
            <!-- -->
            <div id="1715833994gR7ZRa">
                <div class="simple-form-field act_multistore_type_div hide">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">参与门店：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box m-r-10">
                                <div class="" name="LimitDiscountModel[act_multistore_type]" value="0"><label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[act_multistore_type]" value="0" checked> 全部门店</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[act_multistore_type]" value="1"> 指定分组下的门店</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[act_multistore_type]" value="2"> 指定门店</label></div>
                                <input type="hidden" id="group_ids" name="group_ids" value="">
                                <input type='hidden' id="store_ids" name="store_ids" value="">
                                <div class="selector-set region-selected m-b-0 m-t-10 " id="select_group"></div>
                                <div class="selector-set region-selected m-b-0 m-t-10" id="select_store"></div>
                            </div>
                            <span class="form-control-error error-message" style="display: none;"><i class="fa fa-warning"></i><span></span></span>
                        </div>
                    </div>
                </div>
                <div class="group_container " style="display: none">
                    <div class="p-20">
                        <div class="m-b-5">
                            <label class="control-label m-r-10 cur-p text-l">
                                <input type="checkbox" class="checkBox allCheckGroup m-r-5 cur-p"/>全部分组
                            </label>
                        </div>
                        <div class="group-list"></div>
                    </div>
                </div>
                <script type="text/javascript">
                    //
                </script>
            </div>
            <script id="goods" type="text"><div class="m-b-10 alert alert-warning br-0 w800" style="background-color: #fff9e6; border: 1px solid #ffd77a;">
<p><b>重要提示</b></p>
<p class="m-t-5">商品“剩余活动库存”如果为&nbsp;0&nbsp;则活动商品将<b>恢复原价售卖</b>，活动期间请确保“剩余活动库存”充足</p>
</div>
    <div class="17158339947btG00 search-condition-table m-b-10 w800">
        <div class="search-condition-box">
            <select name='keyword_type'  class="form-control w120 m-l-2 m-r-2">
                <option value='1'>商品名称</option>
                <option value='2'>商品ID</option>
                <option value='3'>商品货号</option>
            </select>
            <input type="text" name="keyword" class="form-control w150 m-l-2 m-r-2" placeholder="关键字">
            <input type="text" name="goods_barcode" class="form-control w150 m-l-2 m-r-2" placeholder="商品条形码">
            <input type="button" class="btn btn-primary m-l-2 m-r-2 btn-search" value="搜索商品">
        </div>
        <div class="clear"></div>
     </div>
<div id="17158339947btG00" class="table-responsive m-t-10 w800" style="max-height: 450px; overflow-y: auto;">
    <table id="selected_table_list" class="table table-hover m-b-0 w800 limit-discount-list" >
        <thead>
            <tr>
                <th class="w50">
                    <input type="checkbox" />
                </th>
                <th class="w150">商品名称</th>
                <th class="w100 text-c">原价</th>
                <th class="w80 text-c">折扣（折）</th>
                <th class="w80 text-c">减价（元）</th>
                <th class="w150 text-c">指定折扣价（元）</th>
                <th class="w120 text-c">活动价</th>
                <!-- <th class="w100 text-c">总活动库存<i class='fa fa-question-circle c-ccc m-l-5' data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="总活动库存 = 剩余活动库存 + 已售卖活动商品数量"></i></th> -->
                <th class="w100 text-c">剩余<br/>活动库存</th>
                <th class="handle w100">操作</th>
            </tr>
        </thead>
        <tbody id="goods_info">
        </tbody>
        <tfoot>
            <tr>
                <td class="w50">
                    <input type="checkbox" class="checkBox" />
                </td>
                <td colspan="8">
                    <input type="button" class="btn btn-default m-r-2 batchset-discount" value="批量折扣" />
                    <input type="button" class="btn btn-default m-r-2 batchset-reduce" value="批量减价" />
                    <input type="button" class="btn btn-default m-r-2 batchset-set" value="批量指定折扣价" />
                    <input type="button" class="btn btn-default m-r-2 batchset-stock" value="批量设置活动库存" />
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<!--错误提示模块 star-->
<div class="member-handle-error"></div>
<!--错误提示模块 end-->
<template id="batch_discount_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <!-- 服务保障 -->
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">折扣：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_discount_val" class="form-control w100" data-rule-callback="list_act_price_callback">
            <span class="m-l-5">折</span>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_reduce_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <!-- 服务保障 -->
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">减价：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <span class="m-r-5">减</span>
            <input type="text" id="batchset_reduce_val" class="form-control w100" data-rule-callback="list_act_mark_down_callback">
            <span class="m-l-5">元</span>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_set_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <!-- 服务保障 -->
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">指定折扣价：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_set_val" class="form-control w100" data-rule-callback="list_set_price_callback">
            <span class="m-l-5">元</span>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_stock_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <!-- 服务保障 -->
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">剩余活动库存：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_stock_val" class="form-control w100 m-r-10" data-rule-callback="list_set_act_stock_callback">
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<script type="text/javascript">
    $('#17158339947btG00').on('click','.checkBox',function(){
        $('#17158339947btG00').find('tbody').find('tr').removeClass('active')
    });
    $('.17158339947btG00').on('click','.btn-search',function(){
        $("#17158339947btG00").animate({
            scrollTop:0
        }, 0);
        var keyword_type = $('.17158339947btG00').find('select[name="keyword_type"]').val();
        var keyword = $('.17158339947btG00').find('input[name="keyword"]').val();
        var goods_barcode = $('.17158339947btG00').find('input[name="goods_barcode"]').val();
        $('#17158339947btG00').find('tbody').find('tr').removeClass('goods_info_search_selected');
        if (keyword != '' && goods_barcode != '') {
            if (keyword_type == 1) {
                $('#17158339947btG00').find('tbody').find('tr[data-goods_name*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
            } else if (keyword_type == 2) {
                $('#17158339947btG00').find('tbody').find('tr[data-goods_id*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
            } else if (keyword_type == 3) {
                $('#17158339947btG00').find('tbody').find('tr[data-goods_sn*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
            }
        } else if (keyword != '') {
            if (keyword_type == 1) {
                $('#17158339947btG00').find('tbody').find('tr[data-goods_name*="' + keyword + '"]').addClass('goods_info_search_selected');
            } else if (keyword_type == 2) {
                $('#17158339947btG00').find('tbody').find('tr[data-goods_id*="' + keyword + '"]').addClass('goods_info_search_selected');
            } else if (keyword_type == 3) {
                $('#17158339947btG00').find('tbody').find('tr[data-goods_sn*="' + keyword + '"]').addClass('goods_info_search_selected');
            }
        } else if (goods_barcode != '') {
            $('#17158339947btG00').find('tbody').find('tr[data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
        }
        var item=$("#17158339947btG00").find('.goods_info_search_selected').length;
        if(item >0){
            var item_top = $("#17158339947btG00").find('.goods_info_search_selected:first').offset().top
            var parent_top =$("#17158339947btG00").offset().top;
            var top = item_top - parent_top
            if(top > 0){
                $("#17158339947btG00").animate({
                    scrollTop:top
                }, 0);
            }else{
                $("#17158339947btG00").animate({
                    scrollTop:0
                }, 0);
            }
        }
    });
    // 自定义验证规则：指定折扣价
    function list_set_price_callback(element, value) {
        // 判断是否需要检查
        if(checkDiscountEnable(element) == false) {
            return true;
        }
        var sku_id = $(element).data('sku_id');
        var min_price = $(element).data('goods_price');
        var max_price = $(element).data('goods_price');
        var regu = /^[0-9]+\.?[0-9]*$/;
        if (isNaN($(element).val())) {
            $(element).data("msg", "指定折扣价格必须是数字。");
            return false;
        }
        if ($(element).val() <= 0) {
            $(element).data("msg", "指定折扣价格必须大于0。");
            return false;
        }
        //验证优惠价格与SKU价格
        if (min_price * 100 < $(element).val() * 100) {
            $(element).data("msg", "指定折扣价格不能大于商品价格 " + min_price + "。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "指定折扣价格只能保留2位小数。");
                return false;
            }
        }
        return true;
    }
    // 自定义验证规则：折扣
    function list_act_price_callback(element, value) {
        // 判断是否需要检查
        if(checkDiscountEnable(element) == false) {
            return true;
        }
        var goods_id = $(element).data('goods_id');
        var min_price = $(element).data('goods_price');
        var max_price = $(element).data('goods_price');
        var regu = /^[0-9]+\.?[0-9]*$/;
        if (isNaN($(element).val())) {
            $(element).data("msg", "折扣必须是数字。");
            return false;
        }
        if ($(element).val() < 0) {
            $(element).data("msg", "折扣必须大于0。");
            return false;
        }
        if ($(element).val() > 10) {
            $(element).data("msg", "折扣必须小于10。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "折扣只能保留2位小数。");
                return false;
            }
        }
        if ($(element).val() != '' &&　$(element).val() * 100 < 1) {
            $(element).data("msg", "折扣不能小于0.01。");
            return false;
        }
        if ($(element).val() != '' && $(element).val() * min_price / 10 < 0.01) {
            $(element).data("msg", "折后金额不能小于0.01。");
            return false;
        }
        return true;
    }
    // 自定义验证规则：减价
    function list_act_mark_down_callback(element, value) {
        // 判断是否需要检查
        if(checkDiscountEnable(element) == false) {
            return true;
        }
        var goods_id = $(element).data('goods_id');
        var min_price = $(element).data('goods_price');
        var max_price = $(element).data('goods_price');
        var regu = /^[0-9]+\.?[0-9]*$/;
        if (isNaN($(element).val())) {
            $(element).data("msg", "减价金额必须是数字。");
            return false;
        }
        if ($(element).val() < 0) {
            $(element).data("msg", "减价金额必须大于0。");
            return false;
        }
        if ($(element).val() * 100 > min_price * 100) {
            $(element).data("msg", "减价金额不能大于商品最低金额￥" + min_price);
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "折扣只能保留2位小数。");
                return false;
            }
        }
        return true;
    }
    function list_set_act_stock_callback(element, value) {
        if (/^(([0])|([1-9](\d*)))$/.test($(element).val()) == false) {
            $(element).data("msg", "活动库存必须是一个大于等于 0 的整数");
            return false;
        }
        return true;
    }
    //设置价格
    $("body").on('change', ".limit_discount_sku", function() {
        var goods_id = $(this).data('goods_id');
        var sku_id = $(this).data('sku_id');
        var type = $(this).data('type');
        var val = $(this).val();
        var goods_price = $(this).data('goods_price');
        var discount = '';
        var reduce = '';
        var set = '';
        if(!$(this).valid()) {
            return;
        }
        $(".sku-act_price-" + sku_id).val('');
        $(".sku-act_price-" + sku_id).removeClass('error');
        $("." + type + '-' + sku_id).val(val);
        if (isNaN(val) || val.length == 0) {
            $("#act_price-" + sku_id).html("--");
            return;
        }
        if (type == 'discount') {
            goods_price = (goods_price * val) / 10;
            $("." + goods_id + '-discount').val(sku_id + '-' + val);
            $("." + goods_id + '-reduce').val('');
            $("." + goods_id + '-set').val('');
        } else if (type == 'mark_down') {
            goods_price -= val;
            $("." + goods_id + '-reduce').val(sku_id + '-' + val);
            $("." + goods_id + '-discount').val('');
            $("." + goods_id + '-set').val('');
        } else {
            goods_price = parseFloat(val);
            $("." + goods_id + '-reduce').val('');
            $("." + goods_id + '-discount').val('');
            $("." + goods_id + '-set').val(sku_id + '-' + val);
        }
        $("#" + goods_id + "-goods-price").html("￥" + goods_price.toFixed(2));
    });
    // 设置库存
    $("body").on("change", ".set_act_stock", function() {
        var goods_id = $(this).data('goods_id');
        var sku_id = $(this).data('sku_id');
        var val = $(this).val();
        if(!$(this).valid()) {
            return;
        }
        if ($(this).valid()) {
            $("." + goods_id + '-stock').val(sku_id + '-' + val);
        }
    });
    var tablelist = null;
    $().ready(function() {
        var container = $("#17158339947btG00");
        $("[data-toggle='popover']").popover();
        tablelist = $("#17158339947btG00").find("#selected_table_list").tablelist();
        //删除商品
        $(container).off("click", ".del").on("click", ".del", function() {
            var target = $(this).parents("tr");
            var goods_id = $(this).data("goods_id");
            var sku_id = $(this).data("sku-id");
            var goods_price = $(this).data("goods_price");
            var container = $(this).parents(".limit-discount-goods").find("#widget_goods");
            var goodspicker = $.goodspicker(container);
            if (goodspicker) {
                // 获取控件
                goodspicker.remove(goods_id, sku_id);
                var selected_number = goodspicker.goods_ids.length;
                if (selected_number == 0) {
                    $(this).parents("table").remove();
                }
            }
            $(target).remove();
        });
        // 设置
        $(container).off("click", ".set-price").on("click", ".set-price", function() {
            var goods_id = $(this).data("goods_id");
            var sku_discount = $("." + goods_id + "-discount").val();
            var sku_reduce = $("." + goods_id + "-reduce").val();
            var sku_set = $("." + goods_id + "-set").val();
            var sku_stock = $("." + goods_id + "-stock").val();
            $.loading.start();
            $.open({
                title: '折扣价设置',
                width: '1200px',
                ajax: {
                    url: '/dashboard/limit-discount/sku-info',
                    method: 'POST',
                    data: {
                        act_id: "17",
                        goods_id: goods_id,
                        sku_discount: sku_discount,
                        sku_reduce: sku_reduce,
                        sku_set: sku_set,
                        sku_stock: sku_stock,
                    },
                    success: function(result) {
                        $.loading.stop();
                    },
                }
            });
        });
        // 临时验证器
        function validate(element) {
            var value = $(element).val();
            var callback = $(element).data("rule-callback");
            callback = window[callback];
            var valid = value != "" && callback(element, value);
            if (valid) {
                showError(element, false);
            } else {
                showError(element, $(element).data("msg"));
            }
            $(element).data("valid", valid)
            return valid;
        }
        // 批量设置折扣
        $(".batchset-discount").unbind().click(function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置折扣',
                width: '480px',
                content: $("#batch_discount_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_discount_val").keyup(function() {
                        var element = this;
                        $("#17158339947btG00").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if(validate(element) == false){
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_discount_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $.loading.start();
                    $("#17158339947btG00").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        var min_price = $(this).data("min_price");
                        var max_price = $(this).data("max_price");
                        // 数据
                        $("." + goods_id + "-discount").val("0-" + value);
                        $("." + goods_id + "-reduce").val("");
                        $("." + goods_id + "-set").val("");
                        // 价格
                        if(min_price == max_price){
                            $("#" + goods_id + "-goods-price").html("￥" + (min_price * value / 10).toFixed(2))
                        }else{
                            $("#" + goods_id + "-goods-price").html("￥" + (min_price * value / 10).toFixed(2) + "-￥" + (max_price * value / 10).toFixed(2))
                        }
                        // 展示
                        if(sku_open == 1){
                            $("#" + goods_id + "-discount-val").html(value);
                            $("#" + goods_id + "-reduce-val").html("--");
                            $("#" + goods_id + "-set-val").html("--");
                        }else{
                            $(".discount-" + sku_id).val(value);
                            $(".mark_down-" + sku_id).val("");
                            $(".set_act_price-" + sku_id).val("");
                        }
                    });
                    $.loading.stop();
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置减价
        $(container).on("click", ".batchset-reduce", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置减价',
                width: '480px',
                content: $("#batch_reduce_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_reduce_val").keyup(function() {
                        var element = this;
                        $("#17158339947btG00").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_reduce_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $.loading.start();
                    $("#17158339947btG00").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        var min_price = $(this).data("min_price");
                        var max_price = $(this).data("max_price");
                        // 数据
                        $("." + goods_id + "-discount").val("");
                        $("." + goods_id + "-reduce").val("0-" + value);
                        $("." + goods_id + "-set").val("");
                        // 价格
                        if(min_price == max_price){
                            $("#" + goods_id + "-goods-price").html("￥" + (min_price - value).toFixed(2))
                        }else{
                            $("#" + goods_id + "-goods-price").html("￥" + (min_price - value).toFixed(2) + "-￥" + (max_price - value).toFixed(2))
                        }
                        // 展示
                        if(sku_open == 1){
                            $("#" + goods_id + "-discount-val").html("--");
                            $("#" + goods_id + "-reduce-val").html(value);
                            $("#" + goods_id + "-set-val").html("--");
                        }else{
                            $(".discount-" + sku_id).val("");
                            $(".mark_down-" + sku_id).val(value);
                            $(".set_act_price-" + sku_id).val("");
                        }
                    });
                    $.loading.stop();
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置指定折扣价
        $(container).on("click", ".batchset-set", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置指定折扣价',
                width: '480px',
                content: $("#batch_set_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_set_val").keyup(function() {
                        var element = this;
                        $("#17158339947btG00").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_set_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $.loading.start();
                    $("#17158339947btG00").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        var min_price = $(this).data("min_price");
                        var max_price = $(this).data("max_price");
                        min_price = parseFloat(min_price).toFixed(2);
                        max_price = parseFloat(max_price).toFixed(2);
                        // 数据
                        $("." + goods_id + "-discount").val("");
                        $("." + goods_id + "-reduce").val("");
                        $("." + goods_id + "-set").val("0-" + value);
                        // 价格
                        $("#" + goods_id + "-goods-price").html("￥" + value);
                        // 展示
                        if(sku_open == 1){
                            $("#" + goods_id + "-discount-val").html("--");
                            $("#" + goods_id + "-reduce-val").html("--");
                            $("#" + goods_id + "-set-val").html(value);
                        }else{
                            $(".discount-" + sku_id).val("");
                            $(".mark_down-" + sku_id).val("");
                            $(".set_act_price-" + sku_id).val(value);
                        }
                    });
                    $.loading.stop();
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置活动库存
        $(container).on("click", ".batchset-stock", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置活动库存',
                width: '480px',
                content: $("#batch_stock_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_stock_val").keyup(function() {
                        var element = this;
                        $("#17158339947btG00").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_stock_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $.loading.start();
                    $("#17158339947btG00").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        var goods_price = $(this).data("goods_price");
                        var min_price = $(this).data("min_price");
                        var max_price = $(this).data("max_price");
                        min_price = parseFloat(min_price).toFixed(2);
                        max_price = parseFloat(max_price).toFixed(2);
                        var sku_num = $(this).data("sku_num") ? $(this).data("sku_num") : 1;
                        // 数据
                        $("." + goods_id + "-stock").val("0-" + value);
                        // 展示
                        if(sku_open == 1){
                            $("#" + goods_id + "-stock-val").find(":input").val(value * sku_num);
                        }else{
                            $(".set_act_stock-" + sku_id).val(value * sku_num);
                        }
                    });
                    $.loading.stop();
                    $.closeDialog(index);
                }
            });
            return false;
        });
    })
</script>
            </script>
            <script id="no_join_goods" type="text"><div class="search-condition-table no_join_search m-b-10 w800">
        <div class="search-condition-box">
            <select name='keyword_type'  class="form-control w120 m-l-2 m-r-2">
                <option value='1'>商品名称</option>
                <option value='2'>商品ID</option>
                <option value='3'>商品货号</option>
            </select>
            <input type="text" name="keyword" class="form-control w150 m-l-2 m-r-2" placeholder="关键字">
            <input type="text" name="goods_barcode" class="form-control w150 m-l-2 m-r-2" placeholder="商品条形码">
            <input type="button" class="btn btn-primary m-l-2 m-r-2 btn-search" value="搜索商品">
        </div>
        <div class="clear"></div>
     </div>
<div id="no_join_list" class="table-responsive m-t-10 w800" style="max-height: 450px; overflow-y: auto;">
    <table id="selected_table_list_no_join" class="table table-hover m-b-0 w800 limit-discount-list">
        <thead>
            <tr>
                <th class="w50">
                    <input type="checkbox" />
                </th>
                <th>商品名称</th>
                <th class="w100 text-c">原价</th>
                <th class="handle w100">操作</th>
            </tr>
        </thead>
        <tbody id="goods_info_no_join">
        </tbody>
        <tfoot>
            <tr>
                <td class="w50">
                    <input type="checkbox" class="checkBox" />
                </td>
                <td colspan="3">
                    <input type="button" class="btn btn-default m-r-2 batchset-del" value="批量删除" />
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">
    var no_join_tablelist = null;
    $().ready(function() {
        $('#no_join_list').on('click', '.checkBox', function () {
            $('#no_join_list').find('tbody').find('tr').removeClass('active')
        })
        $('.no_join_search').on('click', '.btn-search', function () {
            var keyword_type = $('.no_join_search').find('select[name="keyword_type"]').val();
            var keyword = $('.no_join_search').find('input[name="keyword"]').val();
            var goods_barcode = $('.no_join_search').find('input[name="goods_barcode"]').val();
            $('#no_join_list').find('tbody').find('tr').removeClass('goods_info_search_selected');
            if (keyword != '' && goods_barcode != '') {
                if (keyword_type == 1) {
                    $('#no_join_list').find('tbody').find('tr[data-goods_name*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                } else if (keyword_type == 2) {
                    $('#no_join_list').find('tbody').find('tr[data-goods_id*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                } else if (keyword_type == 3) {
                    $('#no_join_list').find('tbody').find('tr[data-goods_sn*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
                }
            } else if (keyword != '') {
                if (keyword_type == 1) {
                    $('#no_join_list').find('tbody').find('tr[data-goods_name*="' + keyword + '"]').addClass('goods_info_search_selected');
                } else if (keyword_type == 2) {
                    $('#no_join_list').find('tbody').find('tr[data-goods_id*="' + keyword + '"]').addClass('goods_info_search_selected');
                } else if (keyword_type == 3) {
                    $('#no_join_list').find('tbody').find('tr[data-goods_sn*="' + keyword + '"]').addClass('goods_info_search_selected');
                }
            } else if (goods_barcode != '') {
                $('#no_join_list').find('tbody').find('tr[data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
            }
            var item = $("#no_join_list").find('.goods_info_search_selected').length;
            if (item > 0) {
                var item_top = $("#no_join_list").find('.goods_info_search_selected:first').offset().top
                var parent_top = $("#no_join_list").offset().top;
                var top = item_top - parent_top
                if (top > 0) {
                    $("#no_join_list").animate({
                        scrollTop: top
                    }, 0);
                }else{
                    $("#no_join_list").animate({
                        scrollTop: 0
                    }, 0);
                }
            }
        })
        $("[data-toggle='popover']").popover();
        no_join_tablelist = $("#no_join_list").find("#selected_table_list_no_join").tablelist();
        //删除商品
        $("body").off("click", ".del-no-join").on("click", ".del-no-join", function () {
            var target = $(this).parents("tr");
            var goods_id = $(this).data("goods_id");
            var sku_id = $(this).data("sku-id");
            var container = $(this).parents(".limit-discount-goods").find("#widget_goods_no_join");
            var goodspicker = $.goodspicker(container);
            if (goodspicker) {
                // 获取控件
                goodspicker.remove(goods_id, sku_id);
                var selected_number = goodspicker.goods_ids.length;
                if (selected_number == 0) {
                    $(this).parents("table").remove();
                }
            }
            $(target).remove();
        });
        // 批量设置减价
        $("#1715833994Xcikt7").on("click", ".batchset-del", function () {
            var ids = no_join_tablelist.checkedValues();
            if (!ids) {
                $.msg("请选择要删除的商品！");
                return;
            }
            var container = $("#widget_goods_no_join");
            var goodspicker = $.goodspicker(container);
            for (j = 0, len = ids.length; j < len; j++) {
                var sku_id = $('.del-no-join[data-goods_id="' + ids[j] + '"]').data("sku-id");
                if (goodspicker) {
                    // 获取控件
                    goodspicker.remove(ids[j], sku_id);
                }
            }
            if (goodspicker) {
                var selected_number = goodspicker.goods_ids.length;
                if (selected_number == 0) {
                    $('#selected_table_list_no_join').remove();
                }
            }
            $('#selected_table_list_no_join').find('.table-list-checkbox:checked').parents('td').parents('tr').remove();
            return false;
        });
    })
</script>
            </script>
            <!-- 商品选择器 -->
            <script type="text/javascript">
                //
            </script>
        </div>        <!-- -->
    </form></div>
<style type="text/css">
    .limit-type .form-control-error {
        margin-top: 7px;
    }
</style>
<!-- 导出CSV文件 -->
<script type="text/javascript">
    //
</script>
<script src="/assets/d2eace91/js/json2csv.js?v=1.1"></script>
<script src="/assets/d2eace91/js/activity.js?v=1.1"></script>
<script>

    $(function () {
        // 解除绑定事件
        $(window).off(submitSuccessEventName).off(beforeSubmitEventName);
    });

    //


    var multistore_selector = null;
    $(function () {

        // <!--  -->

        var act_multistore_type = "0";
        var act_multistore_type_name = "LimitDiscountModel[act_multistore_type]";

        var select_group_ids = "" ? "".split(",") : [];
        var select_store_ids = "" ? "".split(",") : [];

        var select_groups = new Object();
        var select_stores = new Object();

        var container = $("#1715833994gR7ZRa");

        // 门店选择器
        $.multistoreSelector = {
            validate: function () {
                var type = this.getType();
                if (type == 1 && this.getGroupIds().length == 0) {
                    // $.msg("请选择参与门店的指定分组");
                    this.showError("请选择参与门店的指定分组");
                    return false;
                } else if (type == 2 && this.getStoreIds().length == 0) {
                    // $.msg("请选择参与门店的指定门店！");
                    this.showError("请选择参与门店的指定门店");
                    return false;
                }
                this.clearError();
                return true;
            },
            getType: function () {
                return $(container).find("[name='" + act_multistore_type_name + "']:radio:checked").val();
            },
            getStoreIds: function () {
                return select_store_ids;
            },
            getGroupIds: function () {
                return select_group_ids;
            },
            getData: function () {
                var type = this.getType();
                var value = [];
                if (type == 1) {
                    value = this.getGroupIds();
                } else if (type == 2) {
                    value = this.getStoreIds();
                }
                return {
                    type: type,
                    value: value
                };
            },
            showError: function (message) {
                if(message) {
                    $(container).find(".error-message").show().find("span").html(message);
                }else{
                    $(container).find(".error-message").hide();
                }
            },
            clearError: function () {
                $(container).find(".error-message").hide().find("span").html("");
            },
        };

        $(container).find("[name='" + act_multistore_type_name + "']:radio").filter("[value='" + act_multistore_type + "']").prop("checked", true).change();

        var group_list = [];
        var group_list_init = false;

        // 如果分组被选中则直接渲染
        if(act_multistore_type != 0) {
            loadData();
        }

        /**
         *
         * @returns Promise<unknown>
         */
        function loadData() {

            if(group_list_init) {
                return new Promise(function (resolve, reject) {
                    resolve();
                });
            }

            $.loading.start();

            return $.get("/dashboard/multi-store/selector-data", {
                group_ids: select_group_ids,
                store_ids: select_store_ids,
            }, function (result) {
                if (result.code == 0) {
                    group_list = result.data.group_list;
                    renderGroups(group_list);
                    renderSelectedGroups();

                    if(result.data.store_list) {
                        select_store_ids = [];
                        for(var i = 0; i < result.data.store_list.length; i++) {
                            var item = result.data.store_list[i];
                            select_stores[item.store_id] = item;
                            select_store_ids.push(item.store_id);
                        }
                        renderSelectedStores();
                    }

                    // <!--  -->

                } else {
                    $.msg(result.message, {
                        time: 3000
                    })
                }
            }, "JSON").always(function () {
                group_list_init = true;
                $.loading.stop();
            });
        }

        function renderGroups(group_list) {
            var target = $(container).find(".group_container").find(".group-list");

            var html = "";

            for (var i = 0; i < group_list.length; i++) {

                var checked = "";

                if (select_groups[group_list[i].group_id]) {
                    checked = "checked";
                }

                html += '<label class="control-label m-r-10 cur-p w120 text-l">'
                    + '<input type="checkbox" class="checkBox m-r-5 cur-p group_input group_input_#group_id#" value="#group_id#" name="group_id" data-name="#group_name#" #checked# />'
                    + '#group_name#'
                    + '</label>';

                html = html.replaceAll('#group_id#', group_list[i].group_id);
                html = html.replaceAll('#group_name#', group_list[i].group_name);
                html = html.replaceAll('#checked#', checked);
            }

            target.html(html);
        }

        function renderSelectedGroups() {
            var target = $(container).find("#select_group");
            var html = "";

            for (var i = 0; i < group_list.length; i++) {
                if (select_groups[group_list[i].group_id]) {
                    html += '<a id="group_div_#group_id#" class="ss-item" data-id="#group_id#" data-type="1">'
                        + '#group_name#'
                        + '<i title="移除">×</i>'
                        + '</a>';
                    html = html.replaceAll('#group_id#', group_list[i].group_id);
                    html = html.replaceAll('#group_name#', group_list[i].group_name);
                }
            }

            target.html(html);
        }

        function renderSelectedStores() {
            var target = $(container).find("#select_store");
            var html = "";

            for (var i in select_stores) {
                html += '<a id="store_div_#store_id#" class="ss-item" data-id="#store_id#" data-type="2">'
                    + '#store_name#'
                    + '<i title="移除">×</i>'
                    + '</a>';
                html = html.replaceAll('#store_id#', select_stores[i].store_id);
                html = html.replaceAll('#store_name#', select_stores[i].store_name);
            }

            target.html(html);
        }

        // 门店选择
        $(container).find('input[name="' + act_multistore_type_name + '"]').click(function () {

            var act_multistore_type = $(this).val();

            if (act_multistore_type == 0) {
                //隐藏指定门店
                $(container).find("#select_store").hide();
                //隐藏分组
                $(container).find("#select_group").hide();
                // 选择全部门店时去掉隐藏域id
                $(container).find("#store_ids").val('');
                $(container).find("#group_ids").val('');

                select_group_ids = [];
                select_store_ids = [];

                // 验证
                $.multistoreSelector.validate();
            } else if (act_multistore_type == 1) {

                //显示指定分组
                $(container).find("#select_group").show();
                //显示指定门店
                $(container).find("#select_store").hide();
                // 分组弹出框中的复选框全部不选中
                $(container).find(".group_input").removeAttr('checked');
                // 根据分组名称标签选中分组弹出框中的复选框
                $(container).find(".ss-item").each(function () {
                    $(".group_input_" + $(this).data('id')).attr('checked', 'checked');
                });

                loadData().then(function() {
                    $.open({
                        title: "选择分组",
                        type: 1,
                        content: $(container).find(".group_container").html(),
                        area: ['500px', '300px'],
                        fix: false, //不固定
                        scrollbar: false,
                        maxmin: false,
                        btn: ['确认', '取消'],
                        yes: function (index, obj) {

                            var temp_select_groups = [];
                            var temp_select_group_ids = [];

                            $(obj).find("[name=group_id]:checkbox:checked").each(function () {
                                var id = $(this).val();
                                var name = $(this).data("name");
                                if (id && !temp_select_groups[id]) {
                                    temp_select_groups[id] = {
                                        group_id: id,
                                        group_name: name,
                                    };
                                    temp_select_group_ids.push(id);
                                }
                            });

                            if (temp_select_group_ids.length == 0) {
                                $.msg('请选择门店分组');
                                return false;
                            }

                            $(container).find("#group_ids").val(temp_select_group_ids.join(","));

                            select_groups = temp_select_groups;
                            select_group_ids = temp_select_group_ids;

                            // 渲染
                            renderSelectedGroups();
                            // 验证
                            $.multistoreSelector.validate();

                            $.closeDialog(index);
                        },
                        btn2: function () {
                            // 验证
                            $.multistoreSelector.validate();
                        },
                        cancel: function () {
                            // 验证
                            $.multistoreSelector.validate();
                        }
                    });
                });
            } else if (act_multistore_type == 2) {

                //显示指定分组
                $(container).find("#select_group").hide();
                //显示指定门店
                $(container).find("#select_store").show();

                $.loading.start();

                $.open({
                    title: "选择门店",
                    type: 1,
                    width: 800,
                    height: 500,
                    btn: ['确认', '取消'],
                    ajax: {
                        url: '/dashboard/multi-store/list',
                        type: 'get',
                        data: {
                            store_ids: select_store_ids.join(","),
                            type: 1,
                            out_put: 1,
                            uuid: 'store_list',
                            store_status: 1
                        }
                    },
                    success: function (index, obj) {
                        $(obj).setSelectedStores(select_stores);
                    },
                    yes: function (index, obj) {

                        var temp_select_stores = $(obj).getSelectedStores();
                        var temp_select_store_ids = [];

                        for (var k in temp_select_stores) {
                            if(k) {
                                temp_select_store_ids.push(k);
                            }
                        }

                        if (temp_select_store_ids.length == 0) {
                            $.msg('请选择门店');
                            return false;
                        }

                        $(container).find("#store_ids").val(temp_select_store_ids.join(","));

                        select_stores = temp_select_stores;
                        select_store_ids = temp_select_store_ids;

                        // 渲染
                        renderSelectedStores();
                        // 验证
                        $.multistoreSelector.validate();

                        $.closeDialog(index);
                    },
                    btn2: function () {
                        // 验证
                        $.multistoreSelector.validate();
                    },
                    cancel: function () {
                        // 验证
                        $.multistoreSelector.validate();
                    }
                }).always(function () {
                    $.loading.stop();
                });
            }
        });

        //勾选全部分组
        $("body").on("click", ".allCheckGroup", function () {
            $(this).parents(".layui-layer").find("[name='group_id']:checkbox").prop("checked", this.checked);
        });

        //勾选单个分组
        $("body").on("click", "[name='group_id']:checkbox", function () {
            var flag = true;
            $(this).parents(".layui-layer").find("[name='group_id']:checkbox").each(function () {
                if (!this.checked) {
                    flag = false;
                }
            });
            $(this).parents(".layui-layer").find(".allCheckGroup").prop("checked", flag);
        });

        // 删除分组或门店：1-分组 2-门店
        $("body").on("click", "#1715833994gR7ZRa .ss-item i", function () {

            var id = $(this).parents(".ss-item").data('id');
            var type = $(this).parents(".ss-item").data('type');

            if (type == 1) {
                delete select_groups[id];
                select_group_ids = [];
                for (var k in select_groups) {
                    if (k) {
                        select_group_ids.push(k)
                    }
                }
                $(container).find("#group_ids").val(select_group_ids.join(","));
                $(container).find("#group_div_" + id).remove();
            } else if(type == 2) {
                delete select_stores[id];
                select_store_ids = [];
                for (var k in select_stores) {
                    if (k) {
                        select_store_ids.push(k)
                    }
                }
                $(container).find("#store_ids").val(select_store_ids.join(","));
                $(container).find("#store_div_" + id).remove();
            }

            // 验证
            $.multistoreSelector.validate();
        });
    });
    //



    function check_act_stock_callback(element, value) {
        if($("#limitdiscountmodel-use_range").find(":radio:checked").val() == "1") {
            return true;
        }
        if($(element).val() == "") {
            $(element).data("msg", "参与商品活动库存设置不能为空");
            return false;
        }
        return true;
    }

    $(function () {

        // 添加活动商品页面提交前验证
        $(window).on("szy.add.activity.goods.before_submit", function (event, data, errors) {
            if (!data.goods_spu || data.goods_spu.length == 0) {
                errors.push("请选择参与活动的商品");
                return;
            }
        });

        var values = [];
        var no_join = [];
        // 商品选择器加载以选择的商品数据
        $("body").find(".limit-discount-list").find("#goods_info").find("tr").each(function () {
            var goods_id = $(this).data("limit-discount-goods-id");
            var sku_id = 0;
            if(goods_id) {
                values[goods_id] = {
                    goods_id: goods_id,
                    sku_id: sku_id,
                };
            }
        });

        $("body").find(".limit-discount-list").find("#goods_info_no_join").find("tr").each(function () {
            var goods_id = $(this).data("limit-discount-goods-id");
            var sku_id = 0;
            no_join[goods_id] = {
                goods_id: goods_id,
                sku_id: sku_id,
            };
        });

        // 商品选择器
        var goodspicker = null;

        var goodspicker_no_join = null;

        // 批量加载商品信息
        function loadGoodsInfos(goods_ids, is_join) {

            if (!goods_ids || goods_ids.length == 0) {
                return new Promise(function (resolve, reject) {
                    resolve();
                });
            }

            var data = {
                act_id: "17",
                goods_ids: goods_ids,
            };
            var target = null;
            var picker = null;

            if (is_join === undefined) {
                target = $('#goods_info');
                picker = goodspicker;
            } else {
                data.is_join = is_join;
                target = $('#goods_info_no_join');
                picker = goodspicker_no_join;
            }

            $.loading.start();
            return $.ajax({
                type: "POST",
                url: "batch-goods-info",
                dataType: "json",
                data: data,
                success: function (result) {
                    if (result.code == 0) {
                        $(target).prepend(result.data);
                        // 库存不足的商品
                        if ($.isArray(result.unstock_goods_ids) && result.unstock_goods_ids.length > 0) {
                            for (var i = 0; i < result.unstock_goods_ids.length; i++) {
                                picker.remove(result.unstock_goods_ids[i]);
                            }
                            $.msg("商品[" + result.unstock_goods_ids.join(",") + "]库存不足，已取消选择！", {
                                time: 3000
                            });
                        }
                    } else {
                        if ($.isArray(goods_ids)) {
                            for (var i = 0; i < goods_ids; i++) {
                                picker.remove(goods_ids[i]);
                            }
                        }
                        $.msg(result.message, {
                            time: 3000
                        })
                    }
                }
            }).always(function () {
                $.loading.stop();
            });
        }

        // 批量加载商品信息
        function loadGoodsInfosNoJoin(goods_ids) {
            return loadGoodsInfos(goods_ids, 0);
        }

        // 商品信息队列
        var goods_ids_queue = [];
        var doing = false;

        var no_join_goods_ids_queue = [];
        var no_join_doing = false;

        // 执行队列
        function executeQueue(token) {

            if (doing && !token) {
                return;
            }

            doing = true;

            if (goods_ids_queue.length == 0) {
                doing = false;
                return;
            }

            var goods_ids = [];

            while (goods_ids_queue.length > 0 && goods_ids.length < 100) {
                var gid = goods_ids_queue.shift();
                if (gid) {
                    goods_ids.push(gid);
                }
            }

            var result = loadGoodsInfos(goods_ids);

            if (result !== false) {
                result.always(function () {
                    executeQueue(true);
                });
            }
        }

        function executeQueueNoJoin(token) {

            if (no_join_doing && !token) {
                return;
            }

            no_join_doing = true;

            if (no_join_goods_ids_queue.length == 0) {
                no_join_doing = false;
                return;
            }

            var goods_ids = [];

            while (no_join_goods_ids_queue.length > 0 && goods_ids.length < 100) {
                var gid = no_join_goods_ids_queue.shift();
                if (gid) {
                    goods_ids.push(gid);
                }
            }

            var result = loadGoodsInfosNoJoin(goods_ids);

            if (result !== false) {
                result.always(function () {
                    executeQueueNoJoin(true);
                });
            }
        }

        var deqFunc = $.debounce(executeQueue, 200);
        var deqnjFunc = $.debounce(executeQueueNoJoin, 200);

        // <!--  -->
        reloadGoodsPicker();
        // <!--  -->
        // <!--  -->

        function reloadGoodsPicker() {
            if (goodspicker == null) {
                // 初始化组件，为容器绑定组件
                goodspicker = $("#widget_goods").goodspicker({
                    url: '/dashboard/limit-discount/picker?act_id=17',
                    // 组件ajax提交的数据，主要设置分页的相关设置
                    data: {
                        page: {
                            // 分页唯一标识
                            // page_id: page_id
                        },
                        //act_id: $('#goodsmixmodel-act_id').val(),
                        is_sku: 0,
                        is_excel: 1,
                        // 不能将自己作为赠品
                        //except_sku_ids: sku_id
                    },
                    // 已加载的数据
                    values: values,
                    // 选择商品和未选择商品的按钮单击事件
                    // @param selected 点击是否选中
                    // @param sku 选中的SKU对象
                    // @return 返回false代表
                    click: function (selected, sku) {

                        if (selected == true) {
                            // 初始化模板
                            if (this.goods_ids.length == 1) {
                                $("#goods_list").html($("#goods").html());
                                $('#goods_info').html('');
                            }
                            goods_ids_queue.push(sku.goods_id);
                        } else {
                            $("body").find('#selected_table_list').find("[data-limit-discount-goods-id='" + sku.goods_id + "']").remove();

                            if (this.goods_ids.length == 0) {
                                $('#selected_table_list').find(".limit-discount-list").remove();
                            }
                        }

                        // debounce(executeQueue, 200)();
                        // 执行防抖处理后的函数
                        deqFunc();
                    },
                    // 移除全部事件
                    removeAll: function () {
                        $('#selected_table_list').find("#goods_info").remove();
                    },
                    uploadExcelCallback: function (data, selects) {

                        var goods_ids = [];
                        var sku_ids = [];
                        var values = [];
                        if (selects != '') {
                            selects = selects.split(",");
                        } else {
                            selects = [];
                        }

                        for (key in selects) {
                            var datas = selects[key].split("-");
                            goods_ids.push(datas[0]);
                            sku_ids.push(datas[1]);
                            values[datas[0]] = {
                                goods_id: datas[0],
                                sku_id: datas[1]
                            }
                        }
                        this.goods_ids = goods_ids;
                        this.sku_ids = sku_ids;
                        this.values = values;

                        $('#widget_goods').find(".selected_number").html(this.goods_ids.length);
                        $("#goods_list").html($("#goods").html());
                        $('#goods_info').html(data);
                    }
                });
            }
        }

        function reloadNoJoinGoodsPicker() {
            if (goodspicker_no_join == null) {
                // 初始化组件，为容器绑定组件
                goodspicker_no_join = $("#widget_goods_no_join").goodspicker({
                    url: '/dashboard/limit-discount/picker?act_id=17',
                    // 组件ajax提交的数据，主要设置分页的相关设置
                    data: {
                        page: {
                            // 分页唯一标识
                            // page_id: page_id
                        },
                        //act_id: $('#goodsmixmodel-act_id').val(),
                        is_sku: 0,
                        is_join: 0,
                        is_excel: 1
                        // 不能将自己作为赠品
                        //except_sku_ids: sku_id
                    },
                    // 已加载的数据
                    values: no_join,
                    // 选择商品和未选择商品的按钮单击事件
                    // @param selected 点击是否选中
                    // @param sku 选中的SKU对象
                    // @return 返回false代表
                    click: function (selected, sku) {
                        if (selected == true) {

                            // 初始化模板
                            if (this.goods_ids.length == 1) {
                                $("#no_join_goods_list").html($("#no_join_goods").html());
                                $('#goods_info_no_join').html('');
                            }

                            no_join_goods_ids_queue.push(sku.goods_id);
                        } else {
                            $("body").find('#selected_table_list_no_join').find("[data-limit-discount-goods-id='" + sku.goods_id + "']").remove();

                            if (this.goods_ids.length == 0) {
                                $('#selected_table_list_no_join').find(".limit-discount-list").remove();
                            }
                        }

                        // debounce(executeQueueNoJoin, 200)();
                        deqnjFunc();
                    },
                    // 移除全部事件
                    removeAll: function () {
                        $("#selected_table_list_no_join").find("#goods_info_no_join").html("");
                    },
                    uploadExcelCallback: function (data, selects) {

                        var goods_ids = [];
                        var sku_ids = [];
                        var values = [];
                        if (selects != '') {
                            selects = selects.split(",");
                        } else {
                            selects = [];
                        }
                        for (key in selects) {
                            var datas = selects[key].split("-");
                            goods_ids.push(datas[0]);
                            sku_ids.push(datas[1]);
                            values[datas[0]] = {
                                goods_id: datas[0],
                                sku_id: datas[1]
                            }
                        }
                        this.goods_ids = goods_ids;
                        this.sku_ids = sku_ids;
                        this.values = values;

                        $('#widget_goods_no_join').find(".selected_number").html(this.goods_ids.length);
                        $("#no_join_goods_list").html($("#no_join_goods").html());
                        $('#goods_info_no_join').html(data);
                    }
                });
            }
        }

        //商品选择
        $('input[name="LimitDiscountModel[use_range]"]').click(function () {
            var use_range = $(this).val();

            if (use_range == 0) {

                $('.act_price_type_div').removeClass('hide');
                $('.act_stock_div').removeClass('hide');
                $('.act_goods_div').addClass('hide');
                $('.act_goods_no_join_div').addClass('hide');

            } else if (use_range == 2) {

                $('.act_price_type_div').removeClass('hide');
                $('.act_stock_div').removeClass('hide');
                $('.act_goods_div').addClass('hide');
                $('.act_goods_no_join_div').addClass('hide');

            } else if (use_range == 1) {

                $('.act_price_type_div').addClass('hide');
                $('.act_stock_div').addClass('hide');
                $('.act_goods_div').removeClass('hide');
                $('.act_goods_no_join_div').addClass('hide');
                reloadGoodsPicker();
            } else if (use_range == 3) {

                $('.act_price_type_div').removeClass('hide');
                $('.act_stock_div').removeClass('hide');
                $('.act_goods_div').addClass('hide');
                $('.act_goods_no_join_div').removeClass('hide');
                reloadNoJoinGoodsPicker();
            }
        })

        //折扣价设置
        $('input[name="LimitDiscountModel[act_price_type]"]').click(function () {
            var act_price_type = $(this).val();
            if (act_price_type == 0) {
                $('.act_discount_div').removeClass('hide').siblings('.act_price_type_text').addClass('hide').find('input').attr('disabled', true);
                $('.act_discount_div').find('input').attr('disabled', false);
            } else if (act_price_type == 1) {
                $('.act_mark_down_div').removeClass('hide').siblings('.act_price_type_text').addClass('hide').find('input').attr('disabled', true);
                $('.act_mark_down_div').find('input').attr('disabled', false);
            } else if (act_price_type == 2) {
                $('.act_price_div').removeClass('hide').siblings('.act_price_type_text').addClass('hide').find('input').attr('disabled', true);
                $('.act_price_div').find('input').attr('disabled', false);
            }
        })
    });

    /**
     * 是否指定元素所在行中的优惠信息，如果其他优惠方式已经设置则跳过检查
     *
     * @param element
     * @returns boolean
     */
    function checkDiscountEnable(element) {
        var checkEnable = true;
        $(element).parents("tr").find(".limit_discount_sku").each(function(){
            if(element != this) {
                if($(this).val() != "") {
                    checkEnable = false;
                }
            }
        });
        return checkEnable;
    }

    //



    var validator = null;


    $(function () {
        $.validator.setDefaults({
            errorPlacement: function (error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");

                var sku_id = $(element).data("sku_id");
                var type = $(element).data("type");

                if (!error_msg && error_msg == "") {
                    return;
                }

                //显示错误信息
                if (error) {
                    $.showError(element, error_msg);
                } else {
                    // $(element).parents(".form-group").find(".form-control-error").html("");
                    $.removeErrors(element);
                }
            },
            // 失去焦点验证
            onfocusout: function (element) {
                $(element).valid();
            },
            // 成功后移除错误提示
            success: function (error, element) {
                var error_id = $(error).attr("id");
                var sku_id = $(element).data("sku_id");
                var type = $(element).data("type");
                error_id += sku_id + type;

                var sku_error_id = "sku_error_" + error_id;

                //移除错误信息
                $('body').find("#" + error_id).remove();
                if ($('body').find("#" + sku_error_id).find("p").size() == 0) {
                    $('body').find("#" + sku_error_id).remove();
                }

                // 移除错误信息
                $.removeErrors(element);
            }
        });

        validator = $("#LimitDiscountModel").validate();

        // 添加活动商品页面提交前验证
        $(window).on(beforeSubmitEventName, function (event, data, errors) {
            if (validator && !validator.form()) {
                if (validator.errorList.length > 0) {
                    $(validator.errorList[0].element).focus();
                }
                var set = new Object();
                for (var i = 0; i < validator.errorList.length; i++) {
                    var errorMsg = validator.errorList[i].message;
                    // 避免重复的错误消息
                    if(!set[errorMsg]) {
                        set[errorMsg] = true;
                        errors.push(errorMsg);
                    }
                }
                return;
            }
        })

        var activity = $.activityInfo({
            progressKey: 'shop:activity:progress:info:8',
        });

        var formName = "LimitDiscountModel";

        // 先解除事件绑定，避免绑定多次重复执行
        $(window).off(submitEventName).on(submitEventName, function (event) {
            var data = $("#" + formName).serializeJson();
            if (data[formName] == undefined) {
                data[formName] = new Object();
            }
            data[formName].act_id = "17";

            var errors = [];

            $(window).on(beforeSubmitEventName, function (event, data, errors) {
                // 错误信息处理
            });

            // 触发提交前事件，可在此做一些验证或者修改 data 数据
            $(window).trigger(beforeSubmitEventName, [data, errors]);

            if ($.isArray(errors) && errors.length > 0) {
                if (errors.length == 1) {
                    $.msg(errors[0]);
                    return;
                } else if (errors.length > 1) {
                    $.alert(errors.join("<br/>"));
                    return;
                }
            }

            // 检查参与门店
            if ($.multistoreSelector && $.multistoreSelector.validate() == false) {
                return;
            }

            // 从门店选择器获取值
            if ($.multistoreSelector) {
                data["LimitDiscountModel"].act_multistore_type = $.multistoreSelector.getType();
                data.group_ids = $.multistoreSelector.getGroupIds();
                data.store_ids = $.multistoreSelector.getStoreIds();
            }

            var url = 'add-activity-goods?act_id=17';
            var target = event.target;

            var act_multistore_type = data["LimitDiscountModel"].act_multistore_type;

            activity.request(url, data, target, function (result) {
                // 触发提交成功事件
                $(window).trigger(submitSuccessEventName);

                if (data["LimitDiscountModel"] && data["LimitDiscountModel"].act_multistore_type == 0) {
                    window.location.reload();
                } else if (typeof activity_goods_table_list != "undefined") {
                    activity_goods_table_list.load();
                } else {
                    window.location.reload();
                }
            });
        });
    });
    //
</script>