{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="GoodsMixModel" class="form-horizontal" name="GoodsMixModel" action="/dashboard/goods-mix/add" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix goods-mix-goods">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="goodsmixmodel-act_id" class="form-control" name="GoodsMixModel[act_id]">
                <!-- 套餐名称 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmixmodel-act_name" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">套餐名称：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">

                                <input type="text" id="goodsmixmodel-act_name" class="form-control" name="GoodsMixModel[act_name]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">套餐名称必须在 1-20 个字内</div></div>
                        </div>
                    </div>
                </div>
                <!--套餐有效期  -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmixmodel-start_time" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">套餐有效期：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <input type="text" id="goodsmixmodel-start_time" class="form-control form_datetime large" name="GoodsMixModel[start_time]" value="{{ $start_time }}">
                                <span class="ctime">至</span>
                                <input type="text" id="goodsmixmodel-end_time" class="form-control form_datetime large" name="GoodsMixModel[end_time]" value="{{ $end_time }}">
                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 价格模式 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmixmodel-price_mode" class="col-sm-3 control-label">

                            <span class="ng-binding">价格模式：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">

                                <input type="hidden" name="GoodsMixModel[price_mode]" value="0"><div id="goodsmixmodel-price_mode" class="" name="GoodsMixModel[price_mode]" selection='[0]'><label class="control-label cur-p m-r-10"><input type="radio" name="GoodsMixModel[price_mode]" value="0" checked> 统一套餐价</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsMixModel[price_mode]" value="1"> 自定义规格价</label></div>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">统一套餐价：套餐中的商品，无论任何规格，全部按统一的套餐价计算；自定义规格价：需设置每个商品规格参与套餐时的价格</div></div>
                        </div>
                    </div>
                </div>

                <!-- 选择商品 -->

                <div class="simple-form-field">
                    <div class="form-group m-b-0">
                        <label class="col-sm-3 control-label">选择商品：</label>
                        <div class="col-sm-9">
                            <p class="m-b-10">
                                <label class="control-label c-red">注意：每个活动最多可以添加5个商品</label>
                            </p>
                            <div id="widget_goods" class="p-l-15 p-r-15 w800"></div>
                        </div>
                    </div>
                </div>

                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <div id="goods_list" class="w800">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- 套餐总价格 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmixmodel-act_price" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">套餐总价格：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <div id="price_mode_0"><input type="text" id="goodsmixmodel-act_price" class="form-control ipt m-r-10 act_price" name="GoodsMixModel[act_price]">元</div>
                                <div id="price_mode_1" style="display: none;"></div>



                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">套餐价格不包含运费，不能超过套餐商品原价总和</div></div>
                        </div>
                    </div>
                </div>			<!-- 优惠价格展示 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmixmodel-discount_show" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">优惠价格展示：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">

                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="GoodsMixModel[discount_show]" value="0"><label><input type="checkbox" id="goodsmixmodel-discount_show" class="form-control b-n" name="GoodsMixModel[discount_show]" value="1" data-on-text="允许" data-off-text="禁止"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">买家浏览商品详情时，是否可以看到套餐优惠价格</div></div>
                        </div>
                    </div>
                </div>

                <!-- 确认提交 -->
                <div class="bottom-btn p-b-30">
                    <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交" />
                </div>

            </div>
        </div>
    </form>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script id="goods" type="text">
<table id="table_list" class="table table-hover m-b-0 goods-mix-list">
	<thead>
		<tr>
			<th class="w200">商品名称</th>
			<th class="w80">原价</th>
			<th class="w100">
				<span class="text-danger ng-binding">*</span>
				参与套餐的规格
			</th>
			<th class="handle w90">操作</th>
		</tr>
	</thead>
	<tbody id="goods_info">
			</tbody>
</table>
<script type="text/javascript">
	$().ready(function() {
		//删除商品
		$("body").on("click", ".del", function() {
			var target = $(this).parents("tr");
			var goods_id = $(this).data("goods-id");
			var sku_id = $(this).data("sku-id");
			var goods_price = $(this).data("goods-price");
			var container = $(this).parents(".goods-mix-goods").find("#widget_goods");
			var goodspicker = $.goodspicker(container);
			var max_price = $('.act_price').data("rule-max");

			max_price = parseFloat(max_price) - parseFloat(goods_price);

			$('.act_price').data("rule-max", max_price);

			//循环计算价格区间(删除商品重新计算自定义规格价格区间)
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
					}
				}
				price_range_min += parseFloat(min_price);
				price_range_max += parseFloat(max_price);
			});
			/* price_range_min = parseFloat(min_price) + parseFloat(price_range_min);

			price_range_max = parseFloat(max_price) + parseFloat(price_range_max); */
			$("#price_range").data("max_price", price_range_max);
			$("#price_range").data("min_price", price_range_min);
			$("#price_range").val(price_range_min + '-' + price_range_max);

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

	});
</script>

    <script id="add_goods" type="text">
                <tr data-goods-mix-sku-id="" data-goods-mix-goods-id="">
                <td>

                <input type="hidden" id="-spu" name="goods_sku[]" value="">
                <input type="hidden" name="goods_spu[]" value="">
                <input type="hidden" name="goods_sku_act_price[]" value="" class="-sku_price calculation_price">
                </td>
                <td></td>

                <td>

                <p>---</p>

                </td>

                <td class="handle">
                <a href="javascript:void(0);" data-sku-id="" data-goods-id="" data-goods-price="" class="del border-none">删除</a>
                </td>
                </tr></script>

    <script id="price_mode_0_template" type="text">
<input type="text" id="goodsmixmodel-act_price" class="form-control ipt m-r-10 act_price" name="GoodsMixModel[act_price]">元</script>
    <script id="price_mode_1_template" type="text">
<input id ='price_range' data-max_price=0 data-min_price=0 class='form-control ipt m-r-10 disabled' disabled>元
</script>

    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=20190319"/> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190319"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190319"></script>
    <!-- 时间插件引入 end -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190319"></script>
    <!-- 商品选择器 -->
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190319"></script>
    <script id="client_rules" type="text">
[{"id": "goodsmixmodel-act_name", "name": "GoodsMixModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"套餐名称不能为空。"}}},{"id": "goodsmixmodel-start_time", "name": "GoodsMixModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"套餐有效期不能为空。"}}},{"id": "goodsmixmodel-end_time", "name": "GoodsMixModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"套餐结束时间不能为空。"}}},{"id": "goodsmixmodel-act_price", "name": "GoodsMixModel[act_price]", "attribute": "act_price", "rules": {"required":true,"messages":{"required":"套餐总价格不能为空。"}}},{"id": "goodsmixmodel-discount_show", "name": "GoodsMixModel[discount_show]", "attribute": "discount_show", "rules": {"required":true,"messages":{"required":"优惠价格展示不能为空。"}}},{"id": "goodsmixmodel-purchase_num", "name": "GoodsMixModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购数量必须是整数。"}}},{"id": "goodsmixmodel-shop_id", "name": "GoodsMixModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "goodsmixmodel-ext_info", "name": "GoodsMixModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "goodsmixmodel-act_name", "name": "GoodsMixModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"套餐名称必须是一条字符串。","maxlength":"套餐名称只能包含至多20个字符。"},"maxlength":20}},{"id": "goodsmixmodel-act_title", "name": "GoodsMixModel[act_title]", "attribute": "act_title", "rules": {"string":true,"messages":{"string":"活动标题必须是一条字符串。","maxlength":"活动标题只能包含至多20个字符。"},"maxlength":20}},{"id": "goodsmixmodel-act_img", "name": "GoodsMixModel[act_img]", "attribute": "act_img", "rules": {"required":true,"messages":{"required":"活动图片不能为空。"}}},{"id": "goodsmixmodel-sort", "name": "GoodsMixModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "goodsmixmodel-act_price", "name": "GoodsMixModel[act_price]", "attribute": "act_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"套餐总价格必须是一个数字。","min":"套餐总价格必须不小于0.01。"},"min":0.01}},{"id": "goodsmixmodel-act_price", "name": "GoodsMixModel[act_price]", "attribute": "act_price", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"套餐价格最多两位小数。"}}},{"id": "goodsmixmodel-start_time", "name": "GoodsMixModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"goodsmixmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "goodsmixmodel-end_time", "name": "GoodsMixModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"goodsmixmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
</script>
    <script type='text/javascript'>
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };
            var values = [];
            $("body").find(".goods-mix-list").find("#goods_info").find("tr").each(function() {
                var goods_id = $(this).data("goods-mix-goods-id");
                var sku_id = 0;
                values[goods_id] = {
                    goods_id: goods_id,
                    sku_id: sku_id,
                };
            });
            //设置参与套餐商品规格的弹窗
            $("body").on("click", ".show-sku", function() {
                var goods_id = $(this).data('goods-id');
                var sku_ids = $("#" + goods_id + "-spu").val();
                $.open({
                    title: '设置参与套餐商品规格',
                    width: '650px',
                    ajax: {
                        url: '/dashboard/goods-mix/sku-info',
                        data: {
                            goods_id: goods_id,
                            sku_ids: sku_ids
                        }
                    }
                });
            });
            //设置商品规格优惠价格
            $("body").on("click", ".set-price", function() {
                var goods_id = $(this).data('goods-id');
                var sku_ids = $("#" + goods_id + "-spu").val();
                var sku_price = $("." + goods_id + "-sku_price").val();

                $.open({
                    title: '设置商品规格优惠价格',
                    width: '650px',
                    ajax: {
                        url: '/dashboard/goods-mix/sku-info',
                        data: {
                            goods_id: goods_id,
                            sku_ids: sku_ids,
                            sku_price: sku_price,
                            price_mode: 1
                        }
                    }
                });
            });

            // 初始化组件，为容器绑定组件  
            var goodspicker = $("#widget_goods").goodspicker({
                url: '/dashboard/goods-mix/picker',
                // 组件ajax提交的数据，主要设置分页的相关设置  
                data: {
                    page: {
                        // 分页唯一标识  
                        // page_id: page_id
                    },
                    act_id: $('#goodsmixmodel-act_id').val(),
                    is_sku: 0
                    // 不能将自己作为赠品  
                    //except_sku_ids: sku_id  
                },
                // 已加载的数据  
                values: values,
                // 选择商品和未选择商品的按钮单击事件  
                // @param selected 点击是否选中  
                // @param sku 选中的SKU对象  
                // @return 返回false代表  
                click: function(selected, sku) {
                    var goods_count = this.goods_ids.length;
                    var price_mode = $('#goodsmixmodel-price_mode input:radio:checked').val();

                    if (goods_count > 5) {
                        $.msg('套餐中最多可以选择5个商品');
                        return false;
                    }
                    var html = $("#goods").html();
                    if (selected == true) {
                        $.loading.start();
                        $.ajax({
                            type: "POST",
                            url: "goods-info",
                            dataType: "json",
                            data: {
                                goods_id: sku.goods_id,
                                price_mode: price_mode
                            },
                            success: function(result) {
                                if (goods_count == 1) {
                                    $("#goods_list").html(html);
                                    $('#goods_info').html('');
                                }
                                var max_price = $('.act_price').data("rule-max");
                                if (max_price == undefined) {
                                    max_price = 0;
                                }
                                max_price = parseFloat(max_price) + parseFloat(result.max_price);

                                $('.act_price').data("rule-max", max_price);

                                //$.msg(result.max_price);
                                $('#goods_info').append(result.data);
                                $.loading.stop();
                            }
                        });
                    } else {
                        var max_price = $('.act_price').data("rule-max");
                        if (max_price == undefined) {
                            max_price = 0;
                        }
                        max_price = parseFloat(max_price) - parseFloat(sku.goods_price);

                        $('.act_price').data("rule-max", max_price);
                        $("body").find("[data-goods-mix-goods-id='" + sku.goods_id + "']").remove();
                        if (goods_count == 0) {
                            $(".goods-mix-list").remove();
                        }

                        //循环计算价格区间(删除商品重新计算自定义规格价格区间)
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
                                }
                            }
                            price_range_min += parseFloat(min_price);
                            price_range_max += parseFloat(max_price);
                        });
                        /* price_range_min = parseFloat(min_price) + parseFloat(price_range_min);
    
                        price_range_max = parseFloat(max_price) + parseFloat(price_range_max); */
                        $("#price_range").data("max_price", price_range_max);
                        $("#price_range").data("min_price", price_range_min);
                        $("#price_range").val(price_range_min + '-' + price_range_max);
                    }
                },

            });

            //选择价格模式 清空已选的商品 
            $("input[name='GoodsMixModel[price_mode]']").click(function() {

                var value = $(this).val();

                var html = $("#price_mode_" + value + "_template").html();

                $("#price_mode_" + value).html(html).show();

                value = value == 0 ? 1 : 0;
                $("#price_mode_" + value).html("");

                validator = $("#GoodsMixModel").validate();

                $("body").find(".goods-mix-list").find("#goods_info").find("tr").each(function() {

                    var goods_id = $(this).data('goods-mix-goods-id');
                    var sku_id = $(this).data('goods-mix-sku-id');

                    var container = $(this).parents(".goods-mix-goods").find("#widget_goods");
                    var goodspicker = $.goodspicker(container);

                    if (goodspicker) {
                        // 获取控件
                        goodspicker.remove(goods_id, sku_id);
                    }
                });

                $(".goods-mix-list").remove();

            });

            /* if ($.validator) {
                $.validator.prototype.elements = function() {
                    var validator = this, rulesCache = {};
                    return $(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function() {
                        if (!this.name && validator.settings.debug && window.console) {
                            console.error("%o has no name assigned", this);
                        }
                        rulesCache[this.name] = true;
                        return true;
                    });
                }
            } */

            var validator = $("#GoodsMixModel").validate();

            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            $("#btn_submit").click(function() {
                /* if (!validator.form()) {
                    return;
                } */
                if (!validator.form()) {
                    var html = "";

                    error_list = validator.errorList;

                    for (var i = 0; i < validator.errorList.length; i++) {
                        var element = validator.errorList[i].element;
                        var message = validator.errorList[i].message;

                        var element = $(error_list[i].element);

                        $(element).focus();
                        $(window).scrollTop($(element).offset().top - $(window).height() + 120);

                    }

                    return false;
                }
                $.loading.start();
                if ("" == "") {
                    $.post('/dashboard/goods-mix/add', $("#GoodsMixModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/goods-mix/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                } else {
                    $.post('/dashboard/goods-mix/edit?id=', $("#GoodsMixModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/goods-mix/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                }
            });

            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd hh:ii:ss',
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
            });

        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop