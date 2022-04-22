{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="GiftModel" class="form-horizontal" name="GiftModel" action="/dashboard/gift/add" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix gift-goods">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="giftmodel-act_id" class="form-control" name="GiftModel[act_id]" value="{{ $model['act_id'] ?? '' }}">
                <!-- 活动名称 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="giftmodel-act_name" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">赠品活动名称：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="giftmodel-act_name" class="form-control" name="GiftModel[act_name]" value="{{ $model['act_name'] ?? '' }}">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">赠品活动名称必须在 1-20 个字内</div></div>
                        </div>
                    </div>
                </div>
                <!--活动有效期  -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="giftmodel-start_time" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">赠品活动有效期：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <input type="text" id="giftmodel-start_time" class="form-control form_datetime large" name="GiftModel[start_time]" value="{{ $start_time }}">
                                <span class="ctime">至</span>
                                <input type="text" id="giftmodel-end_time" class="form-control form_datetime large" name="GiftModel[end_time]" value="{{ $end_time }}">
                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">指的是赠品活动可以被使用的时间</div></div>
                        </div>
                    </div>
                </div>
                <!-- 领取有效期-->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="giftmodel-valid_data" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">赠品领取有效期：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="giftmodel-valid_data" class="form-control ipt m-r-10" name="GiftModel[valid_data]" value="{{ $model['ext_info']['valid_data'] ?? '' }}"> 天


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">指用户获取赠品后，点击领取赠品的期限，一般应用于抽奖类活动领取赠品</div></div>
                        </div>
                    </div>
                </div>
                <!-- 赠品领取限制-->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="giftmodel-gift_limit" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">赠品领取限制：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="giftmodel-gift_limit" class="form-control ipt m-r-10" name="GiftModel[gift_limit]" value="{{ $model['ext_info']['gift_limit'] ?? '' }}">次/人


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">指每人可以领取赠品的次数，一般应用于抽奖类活动领取赠品</div></div>
                        </div>
                    </div>
                </div>
                <!-- 选择商品 -->
                <div class="simple-form-field">
                    <div class="form-group m-b-0">
                        <label class="col-sm-3 control-label">赠品：</label>
                        <div class="col-sm-9">
                            <div id="widget_goods" class="p-l-15 p-r-15 w800"></div>
                            <div class="help-block help-block-t">暂时只支持无规格商品</div>
                        </div>
                    </div>
                </div>

                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <div id="goods_list" class="w800">

                                @if(!empty($goods_list))
                                    <div class="table-responsive m-t-10" style="max-height: 300px; overflow-y: auto;">
                                        <table id="table_list" class="table table-hover m-b-0 gift-list">
                                            <thead>
                                            <tr>
                                                <th class="w200">商品名称</th>
                                                <th class="w100">赠品数量</th>
                                                <th class="w100">赠品库存</th>
                                                <th class="handle w90">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody id="goods_info">

                                            @foreach($goods_list as $v)
                                            <tr data-gift-sku-id="{{ $v['sku_id'] }}" data-gift-goods-id="{{ $v['goods_id'] }}">
                                                <td>
                                                    {{ $v['goods_name'] }}
                                                    <input type="hidden" name="goods_spu[]" value="{{ $v['goods_id'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" id="{{ $v['goods_id'] }}-goods_number" class="form-control form-control-sm ipt" name=act_number[] data-goods-id={{ $v['goods_id'] }} value="{{ $v['act_number'] }}" data-max={{ $v['goods_number_max'] }} data-rule-callback='act_callback'>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ $v['goods_number_max'] }}" class="form-control form-control-sm ipt" data-max={{ $v['goods_number_max'] }} disabled='disabled'>
                                                </td>
                                                <td class="handle">
                                                    <a href="javascript:void(0);" data-sku-id="{{ $v['sku_id'] }}" data-goods-id="{{ $v['goods_id'] }}" data-goods-price="{{ $v['goods_price'] }}" class="del border-none">删除</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <!--错误提示模块 star-->
                                    <div class="member-handle-error"></div>
                                    <!--错误提示模块 end-->
                                    <script type="text/javascript">
                                        $().ready(function() {
                                            //删除商品
                                            $("body").on("click", ".del", function() {
                                                var target = $(this).parents("tr");
                                                var goods_id = $(this).data("goods-id");
                                                var sku_id = $(this).data("sku-id");
                                                var goods_price = $(this).data("goods-price");
                                                var container = $(this).parents(".gift-goods").find("#widget_goods");
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

                                        });
                                    </script>

                                    <script type="text/javascript">
                                        //自定义验证规则
                                        function act_callback(element, value) {

                                            var goods_id = $(element).data('goods-id');
                                            var max = $(element).data('max');
                                            var regu = /^[0-9]+\.?[0-9]*$/;

                                            if (isNaN($(element).val())) {
                                                $("#" + goods_id + "-goods_number").val(max);
                                                $(element).data("msg", "赠品数量必须是数字。");
                                                return false;
                                            }
                                            if ($(element).val() < 0) {
                                                $("#" + goods_id + "-goods_number").val(max);
                                                $(element).data("msg", "折扣必须大于0。");
                                                return false;
                                            }
                                            if ($(element).val().indexOf('.') > -1) {
                                                if ($(element).val().split('.')[1].length > 0) {
                                                    $("#" + goods_id + "-goods_number").val(max);
                                                    $(element).data("msg", "库存只能是整数。");
                                                    return false;
                                                }
                                            }
                                            if ($(element).val() > max) {
                                                $("#" + goods_id + "-goods_number").val(max);
                                                $(element).data("msg", "不能大于最大库存数。");
                                                return false;
                                            }

                                            return true;
                                        }
                                    </script>
                                @endif
                            </div>
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
<div class="table-responsive m-t-10" style="max-height: 300px; overflow-y: auto;">
	<table id="table_list" class="table table-hover m-b-0 gift-list">
		<thead>
			<tr>
				<th class="w200">商品名称</th>
				<th class="w100">赠品数量</th>
				<th class="w100">赠品库存</th>
				<th class="handle w90">操作</th>
			</tr>
		</thead>
		<tbody id="goods_info">

		</tbody>
	</table>
</div>
<!--错误提示模块 star-->
<div class="member-handle-error"></div>
<!--错误提示模块 end-->
<script type="text/javascript">
	$().ready(function() {
		//删除商品
		$("body").on("click", ".del", function() {
			var target = $(this).parents("tr");
			var goods_id = $(this).data("goods-id");
			var sku_id = $(this).data("sku-id");
			var goods_price = $(this).data("goods-price");
			var container = $(this).parents(".gift-goods").find("#widget_goods");
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

	});
</script>

    <script type="text/javascript">
        //自定义验证规则
        function act_callback(element, value) {

            var goods_id = $(element).data('goods-id');
            var max = $(element).data('max');
            var regu = /^[0-9]+\.?[0-9]*$/;

            if (isNaN($(element).val())) {
                $("#" + goods_id + "-goods_number").val(max);
                $(element).data("msg", "赠品数量必须是数字。");
                return false;
            }
            if ($(element).val() < 0) {
                $("#" + goods_id + "-goods_number").val(max);
                $(element).data("msg", "折扣必须大于0。");
                return false;
            }
            if ($(element).val().indexOf('.') > -1) {
                if ($(element).val().split('.')[1].length > 0) {
                    $("#" + goods_id + "-goods_number").val(max);
                    $(element).data("msg", "库存只能是整数。");
                    return false;
                }
            }
            if ($(element).val() > max) {
                $("#" + goods_id + "-goods_number").val(max);
                $(element).data("msg", "不能大于最大库存数。");
                return false;
            }

            return true;
        }
    </script>

    <script id="add_goods" type="text">
                    <tr data-gift-sku-id="" data-gift-goods-id="">
                    <td>

                    <input type="hidden" name="goods_spu[]" value="">
                    </td>
                    <td>
                    <input class="form-control form-control-sm ipt" type="text" id="-goods_number" name=act_number[] data-goods-id= value='1' data-max= data-rule-callback='act_callback'>
                    </td>
                    <td>
                    <input class="form-control form-control-sm ipt" type="text" value= disabled='disabled'>
                    </td>
                    <td class="handle">
                    <a href="javascript:void(0);" data-sku-id="" data-goods-id="" data-goods-price="" class="del border-none">删除</a>
                    </td>
                    </tr>
                </script>

    <script id="price_mode_0_template" type="text">
<input type="text" id="giftmodel-act_price" class="form-control ipt m-r-10 act_price" name="GiftModel[act_price]" value="0">元</script>
    <script id="price_mode_1_template" type="text">
<input id ='price_range' data-max_price=0 data-min_price=0 class='form-control ipt m-r-10 disabled' disabled>元
</script>

    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=2.0"/> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20180919"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180919"></script>
    <!-- 时间插件引入 end -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <!-- 商品选择器 -->
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>
    <script id="client_rules" type="text">
        @if(!isset($model['act_id']))
            [{"id": "giftmodel-act_name", "name": "GiftModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"赠品活动名称不能为空。"}}},{"id": "giftmodel-start_time", "name": "GiftModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"赠品活动有效期不能为空。"}}},{"id": "giftmodel-end_time", "name": "GiftModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"赠品活动结束时间不能为空。"}}},{"id": "giftmodel-valid_data", "name": "GiftModel[valid_data]", "attribute": "valid_data", "rules": {"required":true,"messages":{"required":"赠品领取有效期不能为空。"}}},{"id": "giftmodel-gift_limit", "name": "GiftModel[gift_limit]", "attribute": "gift_limit", "rules": {"required":true,"messages":{"required":"赠品领取限制不能为空。"}}},{"id": "giftmodel-shop_id", "name": "GiftModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "giftmodel-ext_info", "name": "GiftModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "giftmodel-act_name", "name": "GiftModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"赠品活动名称必须是一条字符串。","maxlength":"赠品活动名称只能包含至多20个字符。"},"maxlength":20}},{"id": "giftmodel-act_title", "name": "GiftModel[act_title]", "attribute": "act_title", "rules": {"string":true,"messages":{"string":"Act Title必须是一条字符串。","maxlength":"Act Title只能包含至多20个字符。"},"maxlength":20}},{"id": "giftmodel-act_img", "name": "GiftModel[act_img]", "attribute": "act_img", "rules": {"required":true,"messages":{"required":"Act Img不能为空。"}}},{"id": "giftmodel-valid_data", "name": "GiftModel[valid_data]", "attribute": "valid_data", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"赠品领取有效期必须是整数。","min":"赠品领取有效期必须不小于0。"},"min":0}},{"id": "giftmodel-gift_limit", "name": "GiftModel[gift_limit]", "attribute": "gift_limit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"赠品领取限制必须是整数。","min":"赠品领取限制必须不小于0。"},"min":0}},{"id": "giftmodel-sort", "name": "GiftModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于1。","max":"排序必须不大于255。"},"min":1,"max":255}},{"id": "giftmodel-start_time", "name": "GiftModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"giftmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "giftmodel-end_time", "name": "GiftModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"giftmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
        @else
            [{"id": "giftmodel-act_name", "name": "GiftModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"赠品活动名称不能为空。"}}},{"id": "giftmodel-start_time", "name": "GiftModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"赠品活动有效期不能为空。"}}},{"id": "giftmodel-end_time", "name": "GiftModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"赠品活动结束时间不能为空。"}}},{"id": "giftmodel-valid_data", "name": "GiftModel[valid_data]", "attribute": "valid_data", "rules": {"required":true,"messages":{"required":"赠品领取有效期不能为空。"}}},{"id": "giftmodel-gift_limit", "name": "GiftModel[gift_limit]", "attribute": "gift_limit", "rules": {"required":true,"messages":{"required":"赠品领取限制不能为空。"}}},{"id": "giftmodel-shop_id", "name": "GiftModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "giftmodel-ext_info", "name": "GiftModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "giftmodel-act_name", "name": "GiftModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"赠品活动名称必须是一条字符串。","maxlength":"赠品活动名称只能包含至多20个字符。"},"maxlength":20}},{"id": "giftmodel-act_title", "name": "GiftModel[act_title]", "attribute": "act_title", "rules": {"string":true,"messages":{"string":"Act Title必须是一条字符串。","maxlength":"Act Title只能包含至多20个字符。"},"maxlength":20}},{"id": "giftmodel-valid_data", "name": "GiftModel[valid_data]", "attribute": "valid_data", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"赠品领取有效期必须是整数。","min":"赠品领取有效期必须不小于0。"},"min":0}},{"id": "giftmodel-gift_limit", "name": "GiftModel[gift_limit]", "attribute": "gift_limit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"赠品领取限制必须是整数。","min":"赠品领取限制必须不小于0。"},"min":0}},{"id": "giftmodel-sort", "name": "GiftModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于1。","max":"排序必须不大于255。"},"min":1,"max":255}},{"id": "giftmodel-start_time", "name": "GiftModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"giftmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "giftmodel-end_time", "name": "GiftModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"giftmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
        @endif
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
            $("body").find(".gift-list").find("#goods_info").find("tr").each(function() {
                var goods_id = $(this).data("gift-goods-id");
                var sku_id = 0;
                values[goods_id] = {
                    goods_id: goods_id,
                    sku_id: sku_id,
                };
            });

            // 初始化组件，为容器绑定组件
            var goodspicker = $("#widget_goods").goodspicker({
                url: '/dashboard/gift/picker',
                // 组件ajax提交的数据，主要设置分页的相关设置
                data: {
                    page: {
                        // 分页唯一标识
                        // page_id: page_id
                    },
                    act_id: $('#giftmodel-act_id').val(),
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
                    var html = $("#goods").html();
                    if (selected == true) {
                        $.loading.start();
                        $.ajax({
                            type: "POST",
                            url: "goods-info",
                            dataType: "json",
                            data: {
                                goods_id: sku.goods_id
                            },
                            success: function(result) {

                                if (goods_count == 1) {
                                    $("#goods_list").html(html);
                                    $('#goods_info').html('');
                                }

                                //$.msg(result.max_price);
                                $('#goods_info').append(result.data);
                                $.loading.stop();
                            }
                        });
                    } else {

                        $("body").find("[data-gift-goods-id='" + sku.goods_id + "']").remove();
                        if (goods_count == 0) {
                            $(".goods-mix-list").remove();
                        }
                    }
                },

            });

            var validator = $("#GiftModel").validate();

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
                    $.post('/dashboard/gift/add', $("#GiftModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/gift/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                } else {
                    $.post('/dashboard/gift/edit?id={{ $model['act_id'] ?? '' }}', $("#GiftModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/gift/list');
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