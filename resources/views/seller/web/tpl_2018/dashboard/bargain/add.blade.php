{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

	<form id="BargainModel" class="form-horizontal" name="BargainModel" action="/dashboard/bargain/add" method="post" enctype="multipart/form-data">
		@csrf
		<div class="table-content m-t-30 clearfix bargain-goods">
			<div class="form-horizontal">
				<!-- 隐藏域 -->
				<input type="hidden" id="bargainmodel-act_id" class="form-control" name="BargainModel[act_id]">
				<!-- 活动名称 -->
				<div class="simple-form-field" >
					<div class="form-group">
						<label for="bargainmodel-act_name" class="col-sm-4 control-label">
							<span class="text-danger ng-binding">*</span>
							<span class="ng-binding">活动名称：</span>
						</label>
						<div class="col-sm-8">
							<div class="form-control-box">
								<input type="text" id="bargainmodel-act_name" class="form-control" name="BargainModel[act_name]">
							</div>
							<div class="help-block help-block-t"></div>
						</div>
					</div>
				</div>
				<div class="simple-form-field" >
					<div class="form-group">
						<label for="bargainmodel-start_time" class="col-sm-3 control-label">
							<span class="text-danger ng-binding">*</span>
							<span class="ng-binding">活动有效期：</span>
						</label>
						<div class="col-sm-9">
							<div class="form-control-box">
								<input type="text" id="bargainmodel-start_time" class="form-control form_datetime large" name="BargainModel[start_time]" value="{{ $start_time }}">
								<span class="ctime">至</span>
								<input type="text" id="bargainmodel-end_time" class="form-control form_datetime large" name="BargainModel[end_time]" value="{{ $end_time }}">
							</div>
							<div class="help-block help-block-t"></div>
						</div>
					</div>
				</div>            <!-- 砍价时限-->
				<div class="simple-form-field" >
					<div class="form-group">
						<label for="bargainmodel-bargain_time" class="col-sm-4 control-label">
							<span class="text-danger ng-binding">*</span>
							<span class="ng-binding">砍价时限：</span>
						</label>
						<div class="col-sm-8">
							<div class="form-control-box">
								<input type="text" id="bargainmodel-bargain_time" class="form-control ipt m-r-10" name="BargainModel[bargain_time]">时
							</div>
							<div class="help-block help-block-t"><div class="help-block help-block-t">砍价时限如果发生改变，将会影响到正在进行中的砍价活动，为了消费者的体验，如非必要请勿变更</div></div>
						</div>
					</div>
				</div>
				<div class="simple-form-field">
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<span class="text-danger ng-binding">*</span>
							<span class="ng-binding">新用户帮砍规则：</span>
						</label>
						<div class="col-sm-9">
							<div class="form-control-box">
								<table class="table">
									<thead>
									<tr>
										<th class="w350 text-c">规则价格区间（元）</th>
										<th class="w350 text-c">砍价随机金额（元）</th>
										<th class="w100 text-c">操作</th>
									</tr>
									</thead>
									<tbody>
									<tr class="new_length">
										<td class="text-c td-num">
											<input class="form-control ipt m-r-10" type="text" name='new_price_min[]' value="" data-rule-callback='new_price_min_callback' max="9999999">
											至
											<input class="form-control ipt m-l-10" type="text" name='new_price_max[]' value="" data-rule-callback='new_price_max_callback' max="9999999">
										</td>
										<td class="text-c">
											<input class="form-control ipt m-r-10" type="text" name='new_bargain_min_price[]' value="" data-rule-callback='new_bargain_min_price_callback' max="9999999">
											至
											<input class="form-control ipt m-l-10" type="text" name='new_bargain_max_price[]' value="" data-rule-callback='new_bargain_max_price_callback' max="9999999">
										</td>
										<td class="handle text-c">
											<a class="new-del">删除</a>
										</td>
									</tr>
									<tr id='template_new_end'>
										<td colspan="3">
											<a class="btn btn-warning btn-sm m-r-20" id='add_new'>新增砍价规则</a>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!--错误提示模块 star-->
				<div class="member-handle-error"></div>
				<!--错误提示模块 end-->
				<div class="simple-form-field">
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<span class="text-danger ng-binding">*</span>
							<span class="ng-binding">老用户帮砍规则：</span>
						</label>
						<div class="col-sm-9">
							<div class="form-control-box">
								<table class="table">
									<thead>
									<tr>
										<th class="w350 text-c">规则价格区间（元）</th>
										<th class="w350 text-c">砍价随机金额（元）</th>
										<th class="w100 text-c">操作</th>
									</tr>
									</thead>
									<tbody>
									<tr class="old_length">
										<td class="text-c td-num">
											<input class="form-control ipt m-r-10" type="text" name='old_price_min[]' value="" data-rule-callback='old_price_min_callback' max="9999999">
											至
											<input class="form-control ipt m-l-10" type="text" name='old_price_max[]' value="" data-rule-callback='old_price_max_callback' max="9999999">
										</td>
										<td class="text-c">
											<input class="form-control ipt m-r-10" type="text" name='old_bargain_min_price[]' value="" data-rule-callback='old_bargain_min_price_callback' max="9999999">
											至
											<input class="form-control ipt m-l-10" type="text" name='old_bargain_max_price[]' value="" data-rule-callback='old_bargain_max_price_callback' max="9999999">
										</td>
										<td class="handle text-c">
											<a class="old-del">删除</a>
										</td>
									</tr>
									<tr id='template_old_end'>
										<td colspan="3">
											<a class="btn btn-warning btn-sm m-r-20" id='add_old'>新增砍价规则</a>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!--错误提示模块 star-->
				<div class="member-handle-error"></div>
				<!--错误提示模块 end-->
				<!-- 所有商品最多发起砍价次数-->
				<div class="simple-form-field" >
					<div class="form-group">
						<label for="bargainmodel-all_goods_bargain_num" class="col-sm-4 control-label">
							<span class="text-danger ng-binding">*</span>
							<span class="ng-binding">所有商品最多发起砍价次数：</span>
						</label>
						<div class="col-sm-8">
							<div class="form-control-box">
								<input type="text" id="bargainmodel-all_goods_bargain_num" class="form-control ipt m-r-10" name="BargainModel[all_goods_bargain_num]">次/人
							</div>
							<div class="help-block help-block-t"><div class="help-block help-block-t">设置为0，代表次数无上限</div></div>
						</div>
					</div>
				</div>            <!-- 每种商品最多发起砍价次数 -->
				<div class="simple-form-field" >
					<div class="form-group">
						<label for="bargainmodel-one_goods_bargain_num" class="col-sm-4 control-label">
							<span class="text-danger ng-binding">*</span>
							<span class="ng-binding">每种商品最多发起砍价次数：</span>
						</label>
						<div class="col-sm-8">
							<div class="form-control-box">
								<input type="text" id="bargainmodel-one_goods_bargain_num" class="form-control ipt m-r-10" name="BargainModel[one_goods_bargain_num]">次/人
							</div>
							<div class="help-block help-block-t"><div class="help-block help-block-t">设置为0，代表次数无上限</div></div>
						</div>
					</div>
				</div>            <!-- 帮砍次数 -->
				<div class="simple-form-field" >
					<div class="form-group">
						<label for="bargainmodel-help_bargain_num" class="col-sm-4 control-label">
							<span class="text-danger ng-binding">*</span>
							<span class="ng-binding">帮砍次数：</span>
						</label>
						<div class="col-sm-8">
							<div class="form-control-box">
								<input type="text" id="bargainmodel-help_bargain_num" class="form-control ipt m-r-10" name="BargainModel[help_bargain_num]">次/天
							</div>
							<div class="help-block help-block-t"><div class="help-block help-block-t">设置为0，代表次数无上限</div></div>
						</div>
					</div>
				</div>            <!-- 虚拟参与人数 -->
				<div class="simple-form-field" >
					<div class="form-group">
						<label for="bargainmodel-virtual_min_part_num" class="col-sm-3 control-label">
							<span class="ng-binding">虚拟参与人数：</span>
						</label>
						<div class="col-sm-9">
							<div class="form-control-box">
								随机<input type="text" id="bargainmodel-virtual_min_part_num" class="form-control ipt m-l-10" name="BargainModel[virtual_min_part_num]">
								<span class="ctime">~</span>
								<input type="text" id="bargainmodel-virtual_max_part_num" class="form-control ipt m-r-10" name="BargainModel[virtual_max_part_num]">人
							</div>
							<div class="help-block help-block-t"><div class="help-block help-block-t">编辑砍价活动时，修改虚拟参与人数只对新关联的商品起作用</div></div>
						</div>
					</div>
				</div>
				<!-- 商品选择器容器 -->
				<div id="17160279143SvM0V" class="bargain-goods">
					<div class="simple-form-field">
						<div class="form-group">
							<label class="col-sm-3 control-label">
								<span class="text-danger ng-binding">*</span>
								<span class="ng-binding">选择商品：</span>
							</label>
							<div class="col-sm-9">
								<div class="form-control-box m-r-10">
									<!--请在这里调取选择商品选择器插件-->
									<div id="widget_goods" class="p-l-15 p-r-15 w800"></div>
									<div id="goods_list">
									</div>
								</div>
							</div>
						</div>
					</div>
					<script id="goods" type="text">
    <div id="1716027914c08FxT" class="table-responsive m-t-10 w800" style="max-height: 450px; overflow-y: auto; border-bottom:1px solid #eee;">
    <table id="selected_table_list" class="table table-hover m-b-0 w800 bargain-list">
        <thead>
            <tr>
                <th class="w50  p-r-0">
                    <input type="checkbox" />
                </th>
                <th class="w150 p-l-0 p-r-0">活动商品</th>
                <th class="w100 text-c p-l-0 p-r-0">店铺价（元）</th>
                <th class="w150 text-c p-l-0 p-r-0">初始砍价价格（元）</th>
                <th class="w120 text-c p-l-0 p-r-0">砍价底价（元）</th>
                <th class="w80 text-c p-l-0 p-r-0">活动库存</th>
                <th class="w80 text-c p-l-0 p-r-0">自砍比例</th>
                <th class="w120 text-c p-l-0 p-r-0">运费模版</th>
                <th class="handle w70 p-l-0 p-r-5">操作</th>
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
                    <input type="button" class="btn btn-default m-r-2 batchset-original-price" value="批量初始砍价价格" />
                    <input type="button" class="btn btn-default m-r-2 batchset-act-price" value="批量砍价底价" />
                    <input type="button" class="btn btn-default m-r-2 batchset-act-stock" value="批量活动库存" />
                    <input type="button" class="btn btn-default m-r-2 batchset-freight" value="批量运费模版" />
                    <input type="button" class="btn btn-default m-r-2 batchset-ratio" value="批量自砍比例" />
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<div class="help-block help-block-t">
    <div class="help-block help-block-t">
        砍价是以初始砍价价格开始往下砍，不同规格砍价底价可不同，参与砍价活动的商品优先执行砍价设置的运费模板<br/>
        砍价底价建议低于店铺价，否则前台消费者砍价之后，购买商品时，系统调取最低的价格进行购买，如果店铺价低于砍价底价，消费者即使砍价成功了，也将按店铺价进行购买<br/>
        自砍比例是以初始砍价价格为基数计算的
    </div>
</div>
<!--错误提示模块 star-->
<div class="member-handle-error"></div>
<!--错误提示模块 end-->
<template id="batch_original_price_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">初始砍价价格：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_original_price_val" class="form-control w100" data-rule-callback="list_original_price_callback">
            <span class="m-l-5">元</span>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_act_price_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">砍价底价：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_act_price_val" class="form-control w100" data-rule-callback="list_act_price_callback">
            <span class="m-l-5">元</span>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_act_stock_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">活动库存：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_act_stock_val" class="form-control w100" data-rule-callback="list_act_stock_callback">
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_ratio_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">自砍比例：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_ratio_val" class="form-control w100" data-rule-callback="list_ratio_callback">
            <span class="m-l-5">%</span>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_freight_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">运费模版：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <select id="batchset_freight_id_val" class="form-control m-l-5 m-r-5" data-rule-callback="freight_callback">
<option value="0">店铺统一运费</option>
<option value="22">全国</option>
</select>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<script type="text/javascript">
    // 自定义验证规则：初始砍价价格
    function list_original_price_callback(element, value) {
        var regu = /^[0-9]+\.?[0-9]*$/;
        if ($(element).val() == "" || isNaN($(element).val())) {
            $(element).data("msg", "初始砍价价格必须是数字。");
            return false;
        }
        if (parseFloat($(element).val()) < 0) {
            $(element).data("msg", "初始砍价价格必须大于0。");
            return false;
        }
        if (parseFloat($(element).val()) >= 999999) {
            $(element).data("msg", "初始砍价价格必须小于999999。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "初始砍价价格只能保留2位小数。");
                return false;
            }
        }
        var sku_id = $(element).data("sku_id");
        if (parseFloat(value) <= parseFloat($(".act-price-" + sku_id).val())) {
            $(element).data("msg", "初始砍价价格必须大于砍价底价。");
            return false;
        }
        return true;
    }
    // 自定义验证规则：砍价底价
    function list_act_price_callback(element, value) {
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
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "砍价底价只能保留2位小数。");
                return false;
            }
        }
        var sku_id = $(element).data("sku_id");
        if (parseFloat(value) >= parseFloat($(".original-price-" + sku_id).val())) {
            $(element).data("msg", "砍价底价必须小于初始砍价价格。");
            return false;
        }
        return true;
    }
    function list_ratio_callback(element, value) {
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
    function freight_callback(element, value) {
        if ($(element).val() == "") {
            //$(element).data("msg", "请选择运费模版。");
            //return false;
        }
        return true;
    }
    // 自定义验证规则：活动库存
    function list_act_stock_callback(element, value) {
        if (/^(([0])|([1-9](\d*)))$/.test($(element).val()) == false) {
            $(element).data("msg", "活动库存必须是一个大于等于 0 的整数");
            return false;
        }
        return true;
    }
    var tablelist = null;
    $().ready(function() {
        var container = $("#1716027914c08FxT");
        tablelist = $("#1716027914c08FxT").find("#selected_table_list").tablelist();
        //设置价格
        $(container).on('change', ".bargain_sku", function() {
            var goods_id = $(this).data('goods_id');
            var sku_id = $(this).data('sku_id');
            var type = $(this).data('type');
            var val = $(this).val();
            $("." + type + '-' + sku_id).val(val);
            if (type == 'original_price') {
                $("." + goods_id + '-original-price').val(sku_id + '-' + val);
            } else if (type == 'act_price') {
                $("." + goods_id + '-act-price').val(sku_id + '-' + val);
            } else if (type == 'act_stock') {
                $("." + goods_id + '-act-stock').val(sku_id + '-' + val);
            } else if (type == 'ratio'){
                $("." + goods_id + '-ratio').val(sku_id + '-' + val);
            }
        });
        // 设置库存
        $(container).on("change", ".act_stock", function() {
            var goods_id = $(this).data('goods_id');
            var sku_id = $(this).data('sku_id');
            var val = $(this).val();
            if ($(this).valid()) {
                $("." + goods_id + '-act-stock').val(sku_id + '-' + val);
            }
        });
        $(container).on("change", ".freight_id", function() {
            var goods_id = $(this).data('goods_id');
            var sku_id = $(this).data('sku_id');
            var val = $(this).val();
            var sku_open = $(this).data("sku_open");
            if (sku_open == 1) {
                var sku_ids = new Array();
                var skuids = $(this).data("sku_ids");
                skuids = skuids.toString();
                var sku_id_arr = skuids.split(',');
                for ( var i in sku_id_arr) {
                    sku_ids.push(sku_id_arr[i] + '-' + val);
                }
                $("." + goods_id + '-freight-id').val(sku_ids.join());
            } else {
                $("." + goods_id + '-freight-id').val(sku_id + '-' + val);
            }
        });
        //删除商品
        $(container).off("click", ".del").on("click", ".del", function() {
            var target = $(this).parents("tr");
            var goods_id = $(this).data("goods_id");
            var sku_id = $(this).data("sku-id");
            var goods_price = $(this).data("goods_price");
            var container = $(this).parents(".bargain-goods").find("#widget_goods");
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
            var sku_original_price = $("." + goods_id + "-original-price").val();
            var sku_act_price = $("." + goods_id + "-act-price").val();
            var sku_act_stock = $("." + goods_id + "-act-stock").val();
            var sku_ratio = $("." + goods_id + "-ratio").val();
            $.loading.start();
            $.open({
                title: '砍价设置',
                width: '900px',
                ajax: {
                    url: '/dashboard/bargain/sku-info',
                    method: 'POST',
                    data: {
                        act_id: "",
                        goods_id: goods_id,
                        sku_original_price: sku_original_price,
                        sku_act_price: sku_act_price,
                        sku_act_stock: sku_act_stock,
                        sku_ratio: sku_ratio
                    },
                    success: function(result) {
                        $.loading.stop();
                    },
                }
            });
        });
        // 展示错误信息
        function showError(element, error) {
            if (error) {
                if ($(element).parents(".form-group").find(".form-control-error").size() == 0) {
                    $(element).parents(".form-control-box").after('<span class="form-control-error"><i class="fa fa-warning"></i>' + error + '</span>')
                } else {
                    $(element).parents(".form-group").find(".form-control-error").html('<i class="fa fa-warning"></i>' + error);
                }
            } else {
                $(element).parents(".form-group").find(".form-control-error").html("");
            }
        }
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
            $(element).data("valid", valid);
            return valid;
        }
        // 批量设置初始砍价价格
        $(container).find(".batchset-original-price").unbind().click(function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置初始砍价价格',
                width: '480px',
                content: $("#batch_original_price_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_original_price_val").keyup(function() {
                        var element = this;
                        $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_original_price_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        // 数据
                        $("." + goods_id + "-original-price").val("0-" + value);
                        if (sku_open == 1) {
                            var sku_ids = new Array();
                            var skuids = $(this).data("sku_ids");
                            skuids = skuids.toString();
                            var sku_id_arr = skuids.split(',');
                            for ( var i in sku_id_arr) {
                                sku_ids.push(sku_id_arr[i] + '-' + value);
                            }
                            $("." + goods_id + '-original-price').val(sku_ids.join());
                        } else {
                            $("." + goods_id + '-original-price').val(sku_id + '-' + value);
                        }
                        // 展示
                        if (sku_open == 1) {
                            $("#" + goods_id + "-original-price-val").html(value);
                        } else {
                            $(".original-price-" + sku_id).val(value);
                        }
                    });
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置砍价底价
        $(container).on("click", ".batchset-act-price", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置砍价底价',
                width: '480px',
                content: $("#batch_act_price_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_act_price_val").keyup(function() {
                        var element = this;
                        $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_act_price_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        if (sku_open == 1) {
                            var sku_ids = new Array();
                            var skuids = $(this).data("sku_ids");
                            skuids = skuids.toString();
                            var sku_id_arr = skuids.split(',');
                            for ( var i in sku_id_arr) {
                                sku_ids.push(sku_id_arr[i] + '-' + value);
                            }
                            $("." + goods_id + '-act-price').val(sku_ids.join());
                        } else {
                            $("." + goods_id + '-act-price').val(sku_id + '-' + value);
                        }
                        // 展示
                        if (sku_open == 1) {
                            $("#" + goods_id + "-act-price-val").html(value);
                        } else {
                            $(".act-price-" + sku_id).val(value);
                        }
                    });
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置活动库存
        $(container).on("click", ".batchset-act-stock", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置活动库存',
                width: '480px',
                content: $("#batch_act_stock_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_act_stock_val").keyup(function() {
                        var element = this;
                        $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_act_stock_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        var goods_price = $(this).data("goods_price");
                        var min_price = $(this).data("min_price");
                        var max_price = $(this).data("max_price");
                        var sku_num = $(this).data("sku_num") ? $(this).data("sku_num") : 1;
                        if (sku_open == 1) {
                            var sku_ids = new Array();
                            var skuids = $(this).data("sku_ids");
                            skuids = skuids.toString();
                            var sku_id_arr = skuids.split(',');
                            for ( var i in sku_id_arr) {
                                sku_ids.push(sku_id_arr[i] + '-' + value);
                            }
                            $("." + goods_id + '-act-stock').val(sku_ids.join());
                        } else {
                            $("." + goods_id + '-act-stock').val(sku_id + '-' + value);
                        }
                        // 展示
                        if (sku_open == 1) {
                            $("#" + goods_id + "-act-stock-val").find(":input").val(value * sku_num);
                        } else {
                            $(".act-stock-" + sku_id).val(value);
                        }
                    });
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置自砍比例
        $(container).on("click", ".batchset-ratio", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置自砍比例',
                width: '480px',
                content: $("#batch_ratio_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_ratio_val").keyup(function() {
                        var element = this;
                        $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_ratio_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        if (sku_open == 1) {
                            var sku_ids = new Array();
                            var skuids = $(this).data("sku_ids");
                            skuids = skuids.toString();
                            var sku_id_arr = skuids.split(',');
                            for ( var i in sku_id_arr) {
                                sku_ids.push(sku_id_arr[i] + '-' + value);
                            }
                            $("." + goods_id + '-ratio').val(sku_ids.join());
                        } else {
                            $("." + goods_id + '-ratio').val(sku_id + '-' + value);
                        }
                        // 展示
                        if (sku_open == 1) {
                            $("#" + goods_id + "-ratio-val").html(value);
                        } else {
                            $(".ratio-" + sku_id).val(value);
                        }
                    });
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置运费模版
        $(container).on("click", ".batchset-freight", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置运费模版',
                width: '480px',
                content: $("#batch_freight_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_freight_id_val").keyup(function() {
                        var element = this;
                        $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_freight_id_val");
                    var value = $(target).val();
                    $("#1716027914c08FxT").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        if (sku_open == 1) {
                            var sku_ids = new Array();
                            var skuids = $(this).data("sku_ids");
                            skuids = skuids.toString();
                            var sku_id_arr = skuids.split(',');
                            for ( var i in sku_id_arr) {
                                sku_ids.push(sku_id_arr[i] + '-' + value);
                            }
                            $("." + goods_id + '-freight-id').val(sku_ids.join());
                        } else {
                            $("." + goods_id + '-freight-id').val(sku_id + '-' + value);
                        }
                        // 展示
                        if (sku_open == 1) {
                            $("#" + goods_id + "-freight-id-val").val(value);
                        } else {
                            $(".freight-id-" + sku_id).val(value);
                        }
                    });
                    $.closeDialog(index);
                }
            });
            return false;
        });
    })
</script>    </script>
					<!-- 商品选择器 -->
					<script type="text/javascript">
						//
					</script>
				</div>
				<!-- 确认提交 -->
				<div class="bottom-btn p-b-30">
					<input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg"/>
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
	<script id="new_template" type="text">
<tr class="new_length">
<td class="text-c td-num">
<input class="form-control ipt m-r-10" type="text" name='new_price_min[]' value="" data-rule-callback='new_price_min_callback'>
至
<input class="form-control ipt m-l-10" type="text" name='new_price_max[]' value="" data-rule-callback='new_price_max_callback'>
</td>
<td class="text-c">
<input class="form-control ipt m-r-10" type="text" name='new_bargain_min_price[]' value="" data-rule-callback='new_bargain_min_price_callback'>
至
<input class="form-control ipt m-l-10" type="text" name='new_bargain_max_price[]' value="" data-rule-callback='new_bargain_max_price_callback'>
</td>
<td class="handle text-c"><a class="new-del">删除</a></td>
</tr>
</script>
	<script id="old_template" type="text">
<tr class="old_length">
<td class="text-c td-num">
<input class="form-control ipt m-r-10" type="text" name='old_price_min[]' value="" data-rule-callback='old_price_min_callback'>
至
<input class="form-control ipt m-l-10" type="text" name='old_price_max[]' value="" data-rule-callback='old_price_max_callback'>
</td>
<td class="text-c">
<input class="form-control ipt m-r-10" type="text" name='old_bargain_min_price[]' value="" data-rule-callback='old_bargain_min_price_callback'>
至
<input class="form-control ipt m-l-10" type="text" name='old_bargain_max_price[]' value="" data-rule-callback='old_bargain_max_price_callback'>
</td>
<td class="handle text-c"><a class="old-del">删除</a></td>
</tr>
</script>
	<script id="client_rules" type="text/javascript">
		[{"id": "bargainmodel-act_name", "name": "BargainModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"活动名称不能为空。"}}},{"id": "bargainmodel-bargain_time", "name": "BargainModel[bargain_time]", "attribute": "bargain_time", "rules": {"required":true,"messages":{"required":"砍价时限不能为空。"}}},{"id": "bargainmodel-start_time", "name": "BargainModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动有效期不能为空。"}}},{"id": "bargainmodel-end_time", "name": "BargainModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"活动结束时间不能为空。"}}},{"id": "bargainmodel-all_goods_bargain_num", "name": "BargainModel[all_goods_bargain_num]", "attribute": "all_goods_bargain_num", "rules": {"required":true,"messages":{"required":"所有商品最多发起砍价次数不能为空。"}}},{"id": "bargainmodel-one_goods_bargain_num", "name": "BargainModel[one_goods_bargain_num]", "attribute": "one_goods_bargain_num", "rules": {"required":true,"messages":{"required":"每种商品最多发起砍价次数不能为空。"}}},{"id": "bargainmodel-help_bargain_num", "name": "BargainModel[help_bargain_num]", "attribute": "help_bargain_num", "rules": {"required":true,"messages":{"required":"帮砍次数不能为空。"}}},{"id": "bargainmodel-all_goods_bargain_num", "name": "BargainModel[all_goods_bargain_num]", "attribute": "all_goods_bargain_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"所有商品最多发起砍价次数必须是整数。"}}},{"id": "bargainmodel-one_goods_bargain_num", "name": "BargainModel[one_goods_bargain_num]", "attribute": "one_goods_bargain_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"每种商品最多发起砍价次数必须是整数。"}}},{"id": "bargainmodel-help_bargain_num", "name": "BargainModel[help_bargain_num]", "attribute": "help_bargain_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"帮砍次数必须是整数。"}}},{"id": "bargainmodel-virtual_min_part_num", "name": "BargainModel[virtual_min_part_num]", "attribute": "virtual_min_part_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"虚拟参与人数必须是整数。"}}},{"id": "bargainmodel-virtual_max_part_num", "name": "BargainModel[virtual_max_part_num]", "attribute": "virtual_max_part_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"虚拟参与人数必须是整数。"}}},{"id": "bargainmodel-ext_info", "name": "BargainModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "bargainmodel-bargain_time", "name": "BargainModel[bargain_time]", "attribute": "bargain_time", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"砍价时限必须是整数。","min":"砍价时限必须不小于1。","max":"砍价时限必须不大于999999。"},"min":1,"max":999999}},{"id": "bargainmodel-all_goods_bargain_num", "name": "BargainModel[all_goods_bargain_num]", "attribute": "all_goods_bargain_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"所有商品最多发起砍价次数必须是整数。","min":"所有商品最多发起砍价次数必须不小于0。","max":"所有商品最多发起砍价次数必须不大于999999。"},"min":0,"max":999999}},{"id": "bargainmodel-one_goods_bargain_num", "name": "BargainModel[one_goods_bargain_num]", "attribute": "one_goods_bargain_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"每种商品最多发起砍价次数必须是整数。","min":"每种商品最多发起砍价次数必须不小于0。","max":"每种商品最多发起砍价次数必须不大于999999。"},"min":0,"max":999999}},{"id": "bargainmodel-help_bargain_num", "name": "BargainModel[help_bargain_num]", "attribute": "help_bargain_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"帮砍次数必须是整数。","min":"帮砍次数必须不小于0。","max":"帮砍次数必须不大于999999。"},"min":0,"max":999999}},{"id": "bargainmodel-virtual_min_part_num", "name": "BargainModel[virtual_min_part_num]", "attribute": "virtual_min_part_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"虚拟参与人数必须是整数。","min":"虚拟参与人数必须不小于0。","max":"虚拟参与人数必须不大于999999。"},"min":0,"max":999999}},{"id": "bargainmodel-virtual_max_part_num", "name": "BargainModel[virtual_max_part_num]", "attribute": "virtual_max_part_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"虚拟参与人数必须是整数。","min":"虚拟参与人数必须不小于0。","max":"虚拟参与人数必须不大于999999。"},"min":0,"max":999999}},{"id": "bargainmodel-virtual_min_part_num", "name": "BargainModel[virtual_min_part_num]", "attribute": "virtual_min_part_num", "rules": {"compare":{"operator":"<","type":"number","compareAttribute":"bargainmodel-virtual_max_part_num","skipOnEmpty":1},"messages":{"compare":"最小虚拟参与人数不能大于或等于最大虚拟参与人数"}}},{"id": "bargainmodel-virtual_max_part_num", "name": "BargainModel[virtual_max_part_num]", "attribute": "virtual_max_part_num", "rules": {"compare":{"operator":">=","type":"number","compareAttribute":"bargainmodel-virtual_min_part_num","skipOnEmpty":1},"messages":{"compare":"最大虚拟参与人数不能小于最小虚拟参与人数"}}},{"id": "bargainmodel-start_time", "name": "BargainModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"bargainmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "bargainmodel-end_time", "name": "BargainModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"bargainmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},{"id": "bargainmodel-act_name", "name": "BargainModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多20个字符。"},"maxlength":20}}]
	</script>
	<script type="text/javascript">
		//
	</script>
	<script type="text/javascript">
		//
	</script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
	<script src="/assets/d2eace91/js/validate/jquery.metadata.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.1"></script>
	<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.1"></script>
	<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/activity.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/json2csv.js?v=1.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
	<script>
		$(function () {
			// 添加活动商品页面提交前验证
			$(window).on("szy.add.activity.goods.before_submit", function (event, data, errors) {
				if (!data.goods_spu || data.goods_spu.length == 0) {
					errors.push("请选择参与活动的商品");
					return;
				}
			});
			var container = $("#17160279143SvM0V");
			var values = [];
			//商品选择器加载以选择的商品数据
			$(container).find(".bargain-list").find("#goods_info").find("tr").each(function() {
				var goods_id = $(this).data("bargain-goods-id");
				var sku_id = 0;
				if(goods_id) {
					values[goods_id] = {
						goods_id: goods_id,
						sku_id: sku_id,
					};
				}
			});
			// 初始化组件，为容器绑定组件
			var goodspicker = $(container).find("#widget_goods").goodspicker({
				url: '/dashboard/bargain/picker?act_id=',
				// 组件ajax提交的数据，主要设置分页的相关设置
				data: {
					page: {
						// 分页唯一标识
						// page_id: page_id
					},
					//act_id: $('#goodsmixmodel-act_id').val(),
					is_sku: 0
					// 不能将自己作为赠品
					//except_sku_ids: sku_id
				},
				// 已加载的数据
				values: values,
				// 全部取消
				removeAll: function () {
					$(container).find('#goods_info').html('');
				},
				// 选择商品和未选择商品的按钮单击事件
				// @param selected 点击是否选中
				// @param sku 选中的SKU对象
				// @return 返回false代表
				click: function(selected, sku) {
					var html = $(container).find("#goods").html();
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
								if(result.code == 0){
									if ($(container).find('#goods_info').size() == 0) {
										$(container).find("#goods_list").html(html);
										$(container).find('#goods_info').html('');
									}
									$(container).find('#goods_info').append(result.data);
									$(container).find("#" + sku.goods_id + "-freight-id-val").trigger("change");
								}else{
									goodspicker.remove(sku.goods_id, sku.sku_id);
									$.msg(result.message, {
										time: 3000
									});
								}
							}
						}).always(function () {
							$.loading.stop();
						});
					} else {
						$(container).find("[data-bargain-goods-id='" + sku.goods_id + "']").remove();
						if (goodspicker.goods_ids.length == 0) {
							$(container).find(".bargain-list").remove();
						}
					}
				},
			});
		});
		//
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
			//添加新用户帮砍规则
			$("#add_new").click(function() {
				var html = $("#new_template").html();
				html = html.replace('data-level="1"', 'data-level="' + ($(".new_length").length + 1) + '"');
				var element = $($.parseHTML(html));
				element.insertBefore($("#template_new_end"));
			});
			//删除新用户帮砍规则
			$("body").on("click", ".new-del", function() {
				if($(".new_length").length <= 1){
					$.msg("请至少保留一个新用户帮砍规则！");
					return;
				}else{
					$(this).parents('tr').remove();
				}
			});
			//添加老用户帮砍规则
			$("#add_old").click(function() {
				var html = $("#old_template").html();
				html = html.replace('data-level="1"', 'data-level="' + ($(".old_length").length + 1) + '"');
				var element = $($.parseHTML(html));
				element.insertBefore($("#template_old_end"));
			});
			//删除新用户帮砍规则
			$("body").on("click", ".old-del", function() {
				if($(".old_length").length <= 1){
					$.msg("请至少保留一个老用户帮砍规则！");
					return;
				}else{
					$(this).parents('tr').remove();
				}
			});
			var validator = $("#BargainModel").validate();
			// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
			$.validator.addRules($("#client_rules").html());
			var activity = $.activityInfo({
				listPageUrl: '/dashboard/bargain/list',
				progressKey: 'shop:activity:progress:info:8',
			});
			// 提交数据
			$("#btn_submit").click(function() {
				if (!validator.form()) {
					console.log(validator.errorMap)
					return;
				}
				$.loading.start();
				var target = $(this);
				$(target).addClass("disabled");
				$(target).prop("disabled", true);
				var url = null;
				if ("" == "") {
					url = '/dashboard/bargain/add';
				} else {
					url = '/dashboard/bargain/edit?id=';
				}
				var data = $("#BargainModel").serializeJson();
				activity.request(url, data, target);
			});
		})
		//
		//自定义验证规则
		function new_price_min_callback(element, value) {
			if ($(element).val() == '') {
				$(element).data("msg", "新用户帮砍规则价格区间不能为空。");
				return false;
			}
			if (isNaN($(element).val())) {
				$(element).data("msg", "新用户帮砍规则价格区间必须是数字。");
				return false;
			}
			if ($(element).val() < 0) {
				$(element).data("msg", "新用户帮砍规则价格区间必须大于0。");
				return false;
			}
			if ($(element).val().indexOf('.') > -1) {
				if ($(element).val().split('.')[1].length > 2) {
					$(element).data("msg", "新用户帮砍规则价格区间不能超过2位小数。");
					return false;
				}
			}
			return true;
		}
		function new_price_max_callback(element, value) {
			if ($(element).val() == '') {
				$(element).data("msg", "新用户帮砍规则价格区间不能为空。");
				return false;
			}
			if (isNaN($(element).val())) {
				$(element).data("msg", "新用户帮砍规则价格区间必须是数字。");
				return false;
			}
			if ($(element).val() < 0) {
				$(element).data("msg", "新用户帮砍规则价格区间必须大于0。");
				return false;
			}
			if ($(element).val().indexOf('.') > -1) {
				if ($(element).val().split('.')[1].length > 2) {
					$(element).data("msg", "新用户帮砍规则价格区间不能超过2位小数。");
					return false;
				}
			}
			return true;
		}
		function new_bargain_min_price_callback(element, value){
			if ($(element).val() == '') {
				$(element).data("msg", "新用户砍价随机金额不能为空。");
				return false;
			}
			if (isNaN($(element).val())) {
				$(element).data("msg", "新用户砍价随机金额必须是数字。");
				return false;
			}
			if ($(element).val() < 0) {
				$(element).data("msg", "新用户砍价随机金额必须大于0。");
				return false;
			}
			if ($(element).val().indexOf('.') > -1) {
				if ($(element).val().split('.')[1].length > 2) {
					$(element).data("msg", "新用户砍价随机金额不能超过2位小数。");
					return false;
				}
			}
			return true;
		}
		function new_bargain_max_price_callback(element, value){
			if ($(element).val() == '') {
				$(element).data("msg", "新用户砍价随机金额不能为空。");
				return false;
			}
			if (isNaN($(element).val())) {
				$(element).data("msg", "新用户砍价随机金额必须是数字。");
				return false;
			}
			if ($(element).val() < 0) {
				$(element).data("msg", "新用户砍价随机金额必须大于0。");
				return false;
			}
			if ($(element).val().indexOf('.') > -1) {
				if ($(element).val().split('.')[1].length > 2) {
					$(element).data("msg", "新用户砍价随机金额不能超过2位小数。");
					return false;
				}
			}
			return true;
		}
		function old_price_min_callback(element, value) {
			if ($(element).val() == '') {
				$(element).data("msg", "老用户帮砍规则价格区间不能为空。");
				return false;
			}
			if (isNaN($(element).val())) {
				$(element).data("msg", "老用户帮砍规则价格区间必须是数字。");
				return false;
			}
			if ($(element).val() < 0) {
				$(element).data("msg", "老用户帮砍规则价格区间必须大于0。");
				return false;
			}
			if ($(element).val().indexOf('.') > -1) {
				if ($(element).val().split('.')[1].length > 2) {
					$(element).data("msg", "老用户帮砍规则价格区间不能超过2位小数。");
					return false;
				}
			}
			return true;
		}
		function old_price_max_callback(element, value) {
			if ($(element).val() == '') {
				$(element).data("msg", "老用户帮砍规则价格区间不能为空。");
				return false;
			}
			if (isNaN($(element).val())) {
				$(element).data("msg", "老用户帮砍规则价格区间必须是数字。");
				return false;
			}
			if ($(element).val() < 0) {
				$(element).data("msg", "老用户帮砍规则价格区间必须大于0。");
				return false;
			}
			if ($(element).val().indexOf('.') > -1) {
				if ($(element).val().split('.')[1].length > 2) {
					$(element).data("msg", "老用户帮砍规则价格区间不能超过2位小数。");
					return false;
				}
			}
			return true;
		}
		function old_bargain_min_price_callback(element, value){
			if ($(element).val() == '') {
				$(element).data("msg", "老用户砍价随机金额不能为空。");
				return false;
			}
			if (isNaN($(element).val())) {
				$(element).data("msg", "老用户砍价随机金额必须是数字。");
				return false;
			}
			if ($(element).val() < 0) {
				$(element).data("msg", "老用户砍价随机金额必须大于0。");
				return false;
			}
			if ($(element).val().indexOf('.') > -1) {
				if ($(element).val().split('.')[1].length > 2) {
					$(element).data("msg", "老用户砍价随机金额不能超过2位小数。");
					return false;
				}
			}
			return true;
		}
		function old_bargain_max_price_callback(element, value){
			if ($(element).val() == '') {
				$(element).data("msg", "老用户砍价随机金额不能为空。");
				return false;
			}
			if (isNaN($(element).val())) {
				$(element).data("msg", "老用户砍价随机金额必须是数字。");
				return false;
			}
			if ($(element).val() < 0) {
				$(element).data("msg", "老用户砍价随机金额必须大于0。");
				return false;
			}
			if ($(element).val().indexOf('.') > -1) {
				if ($(element).val().split('.')[1].length > 2) {
					$(element).data("msg", "老用户砍价随机金额不能超过2位小数。");
					return false;
				}
			}
			return true;
		}
		//
	</script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
