{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="GoodsMixModel" class="form-horizontal" name="GoodsMixModel" action="/dashboard/goods-mix/check?id={{ $model['act_id'] }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="table-content m-t-30 clearfix goods-mix-goods">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="goodsmixmodel-act_id" class="form-control" name="GoodsMixModel[act_id]" value="{{ $model['act_id'] }}">
                <!-- 套餐名称 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmixmodel-act_name" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">套餐名称：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="goodsmixmodel-act_name" class="form-control" name="GoodsMixModel[act_name]" value="{{ $model['act_name'] }}" readonly="readonly">


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


                                <input type="text" id="goodsmixmodel-start_time" class="form-control form_datetime large" name="GoodsMixModel[start_time]" value="{{ $model['start_time'] }}" readonly="readonly">
                                <span class="ctime">至</span>
                                <input type="text" id="goodsmixmodel-end_time" class="form-control form_datetime large" name="GoodsMixModel[end_time]" value="{{ $model['end_time'] }}" readonly="readonly">
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



                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" value="0" @if($model['price_mode'] == 0)checked='checked'@endif disabled="disabled">
                                    统一套餐价
                                </label>

                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" value="1" @if($model['price_mode'] == 1)checked='checked'@endif disabled="disabled">
                                    自定义规格价
                                </label>



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
                            <div id="widget_goods" class="p-l-15 p-r-15"></div>
                        </div>
                    </div>
                </div>

                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <div id="goods_list">

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

                                    @foreach($goods_list as $v)
                                    <tr data-goods-mix-sku-id="{{ $v['sku_id'] }}" data-goods-mix-goods-id="{{ $v['goods_id'] }}">
                                        <td>
                                            <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target= _blank>{{ $v['goods_name'] }}</a>
                                            <input type="hidden" id="{{ $v['goods_id'] }}-spu" name="goods_sku[]" value="{{ $v['sku_ids'] }}">
                                            <input type="hidden" name="goods_spu[]" value="{{ $v['goods_id'] }}">
                                            <input type="hidden" name="goods_sku_act_price[]" value="" class="{{ $v['goods_id'] }}-sku_price calculation_price">
                                        </td>
                                        <td>{{ $v['goods_price'] }}</td>

                                        <td>
                                            <a class="btn btn-warning btn-sm show-sku" data-goods-id="{{ $v['goods_id'] }}">设置参与套餐规格</a>
                                        </td>

                                        <td class="handle">
                                            <a href="javascript:void(0);" data-sku-id="{{ $v['sku_id'] }}" data-goods-id="{{ $v['goods_id'] }}" data-goods-price="{{ $v['goods_price'] }}" class="border-none disabled">删除</a>
                                        </td>
                                    </tr>
                                    @endforeach

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

                                <input id='price_range' value='{{ $model['act_price'] }}' data-max_price=160 data-min_price=160 class='form-control ipt m-r-10 disabled' disabled> 元

                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">套餐价格不包含运费，不能超过套餐商品原价总和</div></div>
                        </div>
                    </div>
                </div>
                <!-- 优惠价格展示 -->
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
                                        <input type="hidden" name="GoodsMixModel[discount_show]" value="0"><label><input type="checkbox" id="goodsmixmodel-discount_show" class="form-control b-n" name="GoodsMixModel[discount_show]" value="1" @if($model['discount_show'] == 1){{ 'checked' }}@endif disabled="disabled" data-on-text="允许" data-off-text="禁止"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">买家浏览商品详情时，是否可以看到套餐优惠价格</div></div>
                        </div>
                    </div>
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
		</tr>
	</thead>
	<tbody id="goods_info">

		<tr data-goods-mix-sku-id="662" data-goods-mix-goods-id="107">
			<td>
				波士顿龙虾
				<input type="hidden" id="107-spu" name="goods_sku[]" value="662">
				<input type="hidden" name="goods_spu[]" value="107">
				<input type="hidden" name="goods_sku_act_price[]" value="107-662-150.00" class="107-sku_price calculation_price">
			</td>
			<td>￥200.00</td>
			<!--   -->
			<td>
				<a class="btn btn-warning btn-sm set-price" data-goods-id="107">设置商品规格优惠价格</a>
			</td>

		</tr>

		<tr data-goods-mix-sku-id="660" data-goods-mix-goods-id="105">
			<td>
				轻轻的我走了带走所有云彩
				<input type="hidden" id="105-spu" name="goods_sku[]" value="660">
				<input type="hidden" name="goods_spu[]" value="105">
				<input type="hidden" name="goods_sku_act_price[]" value="105-660-10.00" class="105-sku_price calculation_price">
			</td>
			<td>￥11.00</td>
			<!--   -->
			<td>
				<a class="btn btn-warning btn-sm set-price" data-goods-id="105">设置商品规格优惠价格</a>
			</td>

		</tr>

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

    <script id="price_mode_0_template" type="text">
    <input type="text" id="goodsmixmodel-act_price" class="form-control ipt m-r-10 act_price" name="GoodsMixModel[act_price]">元</script>
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
[{"id": "goodsmixmodel-act_name", "name": "GoodsMixModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"套餐名称不能为空。"}}},{"id": "goodsmixmodel-start_time", "name": "GoodsMixModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"套餐有效期不能为空。"}}},{"id": "goodsmixmodel-end_time", "name": "GoodsMixModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"套餐结束时间不能为空。"}}},{"id": "goodsmixmodel-act_price", "name": "GoodsMixModel[act_price]", "attribute": "act_price", "rules": {"required":true,"messages":{"required":"套餐总价格不能为空。"}}},{"id": "goodsmixmodel-discount_show", "name": "GoodsMixModel[discount_show]", "attribute": "discount_show", "rules": {"required":true,"messages":{"required":"优惠价格展示不能为空。"}}},{"id": "goodsmixmodel-purchase_num", "name": "GoodsMixModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购数量必须是整数。"}}},{"id": "goodsmixmodel-shop_id", "name": "GoodsMixModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "goodsmixmodel-ext_info", "name": "GoodsMixModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "goodsmixmodel-act_name", "name": "GoodsMixModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"套餐名称必须是一条字符串。","maxlength":"套餐名称只能包含至多20个字符。"},"maxlength":20}},{"id": "goodsmixmodel-act_title", "name": "GoodsMixModel[act_title]", "attribute": "act_title", "rules": {"string":true,"messages":{"string":"活动标题必须是一条字符串。","maxlength":"活动标题只能包含至多20个字符。"},"maxlength":20}},{"id": "goodsmixmodel-sort", "name": "GoodsMixModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于1。","max":"排序必须不大于255。"},"min":1,"max":255}},{"id": "goodsmixmodel-act_price", "name": "GoodsMixModel[act_price]", "attribute": "act_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"套餐总价格必须是一个数字。","min":"套餐总价格必须不小于0.01。"},"min":0.01}},{"id": "goodsmixmodel-act_price", "name": "GoodsMixModel[act_price]", "attribute": "act_price", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"套餐价格最多两位小数。"}}},{"id": "goodsmixmodel-start_time", "name": "GoodsMixModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"goodsmixmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "goodsmixmodel-end_time", "name": "GoodsMixModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"goodsmixmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
</script>
    <script type='text/javascript'>
        $().ready(function() {
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
                            sku_ids: sku_ids,
                            disable:1
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
                            price_mode: 1,
                            disable:1
                        }
                    }
                });
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

        })
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop