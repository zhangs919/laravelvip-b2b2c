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

	<div class="table-content m-t-30 clearfix limit-discount-goods">
		<form id="LimitDiscountModel" class="form-horizontal" name="LimitDiscountModel" action="/dashboard/limit-discount/add" method="post" enctype="multipart/form-data">
			@csrf
			<!-- 隐藏域 -->
			<input type="hidden" id="limitdiscountmodel-act_id" class="form-control" name="LimitDiscountModel[act_id]" value="{{ $model['act_id'] ?? '' }}">
			<!-- 套餐名称 -->
			<div class="simple-form-field" >
				<div class="form-group">
					<label for="limitdiscountmodel-act_name" class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">活动名称：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">
							<input type="text" id="limitdiscountmodel-act_name" class="form-control" name="LimitDiscountModel[act_name]" value="{{ $model['act_name'] ?? '' }}">
						</div>
						<div class="help-block help-block-t"><div class="help-block help-block-t">活动名称必须在 1~20 个字内</div></div>
					</div>
				</div>
			</div>
			<!--套餐有效期  -->
			<div class="simple-form-field" >
				<div class="form-group">
					<label for="limitdiscountmodel-start_time" class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">活动有效期：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">
							<input type="text" id="limitdiscountmodel-start_time" class="form-control form_datetime large" name="LimitDiscountModel[start_time]" value="{{ $start_time }}">
							<span class="ctime">至</span>
							<input type="text" id="limitdiscountmodel-end_time" class="form-control form_datetime large" name="LimitDiscountModel[end_time]" value="{{ $end_time }}">
						</div>
						<div class="help-block help-block-t"></div>
					</div>
				</div>
			</div>
			<!-- 按周期重复 -->
			<div class="simple-form-field" >
				<div class="form-group">
					<label for="limitdiscountmodel-act_repeat" class="col-sm-3 control-label">
						<span class="ng-binding">周期重复：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">
							<label class="control-label control-label-switch">
								<div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
									<input type="hidden" name="LimitDiscountModel[act_repeat]" value="0">
									<label><input type="checkbox" id="limitdiscountmodel-act_repeat" class="switch-on-off" name="LimitDiscountModel[act_repeat]" value="1"
												  @if(isset($model['ext_info']['act_repeat']) && $model['ext_info']['act_repeat'] == 1){{ 'checked' }}@endif
												  data-on-text="允许" data-off-text="禁止"> </label>
								</div>
							</label>
						</div>
						<div class="help-block help-block-t"></div>
					</div>
				</div>
			</div>
				<div class="act_repeat_item @if(empty($model['ext_info']['act_repeat'])){{ 'hide' }}@endif">
				<div class="simple-form-field" >
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">
						</label>
						<div class="col-sm-9">
							<div class="form-control-box">
								<div id="cycle_picker_container"></div>
							</div>
							<div class="help-block help-block-t"><div class="help-block help-block-t">活动开始前，商品详情页面将会预告活动开始时间和活动折扣；在活动有效期内进行活动周期重复</div></div>
						</div>
					</div>
				</div>
				</div>
			<!-- 活动标签 -->
			<div class="simple-form-field" >
				<div class="form-group">
					<label for="limitdiscountmodel-act_label" class="col-sm-3 control-label">
						<span class="ng-binding">活动标签：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">
							<input type="text" id="limitdiscountmodel-act_label" class="form-control" name="LimitDiscountModel[act_label]" value="{{ $model['ext_info']['act_label'] ?? '' }}">
						</div>
						<div class="help-block help-block-t"><div class="help-block help-block-t">活动期间展示于商品详情的活动标记处，建议最多8个字，如果未设置，默认是“限时折扣”文字</div></div>
					</div>
				</div>
			</div>            <div class="simple-form-field">
				<div class="form-group">
					<label class="col-sm-3 control-label">
						<span class="ng-binding">限购设置：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box limit-type">
							<div class="clearfix limit-type-item">
								<label class="control-label cur-p m-r-30" style="float: left;">
									<input type="radio" class="icheck" name="limit_type" @if(isset($model['ext_info']['limit_type']) && $model['ext_info']['limit_type'] == 0)checked="checked"@endif value='0'>
									不限购
								</label>
							</div>
							<div class="clearfix limit-type-item">
								<label class="control-label cur-p" style="float: left;">
									<input type="radio" class="icheck" name="limit_type" @if(isset($model['ext_info']['limit_type']) && $model['ext_info']['limit_type'] == 1)checked="checked"@endif value='1'>
									每人每种商品限购
									<input class="form-control ipt m-l-10 m-r-10" type="text" name='limit_num_1' data-rule-min="1" data-rule-digits="true" data-msg-digits="只能输入大于0的整数" data-rule-callback="checkLimitNum" data-type="1" value="{{ $model['ext_info']['limit_num_1'] ?? '' }}">
									件
								</label>
								<br>
								<label class="control-label cur-p m-l-30" style="float: left;">
									<input type="checkbox" class="icheck limit_num_day_checkbox" name="limit_type_checks[]" value='1' >
									每天限购
									<input class="form-control ipt m-l-10 m-r-10" type="text" name='limit_num_day' data-rule-min="0" data-rule-digits="true" data-msg-digits="只能输入大于0的整数" data-rule-callback="checkLimitNum" data-type="1" value=''>
									件
									<div class="help-block help-block-t">勾选后如填写为0，则表示不限制</div>
								</label>
								<br>
								<label class="control-label cur-p m-l-30" style="float: left;">
									<input type="checkbox" class="icheck limit_num_order_checkbox" name="limit_type_checks[]" value='2' >
									每单限购
									<input class="form-control ipt m-l-10 m-r-10" type="text" name='limit_num_order' data-rule-min="0" data-rule-digits="true" data-msg-digits="只能输入大于0的整数" data-rule-callback="checkLimitNum" data-type="1" value=''>
									件
									<div class="help-block help-block-t">勾选后如填写为0，则表示不限制</div>
								</label>
							</div>
							<div class="clearfix limit-type-item">
								<label class="control-label cur-p" style="float: left;">
									<input type="radio" class="icheck" name="limit_type" value='2'>
									每人每种商品限前
									<input class="form-control ipt m-l-10 m-r-10" type="text" name='limit_num_2' data-rule-min="1" data-rule-digits="true" data-msg-digits="只能输入大于0的整数" data-rule-callback="checkLimitNum" data-type="2" value=''>
									件享受折扣
								</label>
							</div>
						</div>
						<div class="help-block help-block-t">开启周期重复后，每一个周期开始后都将重新计算限购条件；关闭周期重复后，限购条件是针对整个活动期间内的；限购设置是针对商品的sku进行设置的</div>
					</div>
				</div>
			</div>
			<!-- 活动图片 -->
			<div class="simple-form-field" >
				<div class="form-group">
					<label for="limitdiscountmodel-act_img" class="col-sm-3 control-label">
						<span class="ng-binding">活动推广图：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">
							<div id="act_img_container"></div>
							<input type="hidden" id="limitdiscountmodel-act_img" class="form-control" name="LimitDiscountModel[act_img]" value="{{ $model['act_img'] ?? '' }}">
						</div>
						<div class="help-block help-block-t"><div class="help-block help-block-t">上传活动推广图后，此活动才可在前台限时折扣活动页面展示。</br>建议上传尺寸为585*390像素，大小1M内，格式为jpg、jpeg、gif、png的图片。</div></div>
					</div>
				</div>
			</div>
			@if(empty($model['act_id']))
			<!-- 商品选择器容器 -->
			<div id="1715689451IRnbv5" class="limit-discount-goods">
				<!-- 活动商品 -->
				<div class="simple-form-field" >
					<div class="form-group">
						<label for="limitdiscountmodel-use_range" class="col-sm-3 control-label">
							<span class="ng-binding">参与商品：</span>
						</label>
						<div class="col-sm-9">
							<div class="form-control-box">
								<input type="hidden" name="LimitDiscountModel[use_range]" value="">
								<div id="limitdiscountmodel-use_range" class="" name="LimitDiscountModel[use_range]"><label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[use_range]" value="0" checked> 全部商品参与（包含出售中和已下架商品）</label>
									<label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[use_range]" value="2"> 全部出售中商品参与</label>
									<label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[use_range]" value="1"> 指定商品参与</label>
									<label class="control-label cur-p m-r-10"><input type="radio" name="LimitDiscountModel[use_range]" value="3"> 指定商品不参与</label></div>
							</div>
							<div class="help-block help-block-t"></div>
						</div>
					</div>
				</div>
				<div class="simple-form-field act_price_type_div ">
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
				<div class="simple-form-field act_stock_div ">
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
				<div class="simple-form-field act_goods_div hide">
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 门店选择器 -->
				<!-- 门店选择器 -->
				<!-- -->
				<!-- -->
				<div id="1715689451wanQ8Q">
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
    <div class="171568945164AgLy search-condition-table m-b-10 w800">
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
<div id="171568945164AgLy" class="table-responsive m-t-10 w800" style="max-height: 450px; overflow-y: auto;">
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
                <th class="w100 text-c">活动库存</th>
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
    $('#171568945164AgLy').on('click','.checkBox',function(){
        $('#171568945164AgLy').find('tbody').find('tr').removeClass('active')
    });
    $('.171568945164AgLy').on('click','.btn-search',function(){
        $("#171568945164AgLy").animate({
            scrollTop:0
        }, 0);
        var keyword_type = $('.171568945164AgLy').find('select[name="keyword_type"]').val();
        var keyword = $('.171568945164AgLy').find('input[name="keyword"]').val();
        var goods_barcode = $('.171568945164AgLy').find('input[name="goods_barcode"]').val();
        $('#171568945164AgLy').find('tbody').find('tr').removeClass('goods_info_search_selected');
        if (keyword != '' && goods_barcode != '') {
            if (keyword_type == 1) {
                $('#171568945164AgLy').find('tbody').find('tr[data-goods_name*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
            } else if (keyword_type == 2) {
                $('#171568945164AgLy').find('tbody').find('tr[data-goods_id*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
            } else if (keyword_type == 3) {
                $('#171568945164AgLy').find('tbody').find('tr[data-goods_sn*="' + keyword + '"][data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
            }
        } else if (keyword != '') {
            if (keyword_type == 1) {
                $('#171568945164AgLy').find('tbody').find('tr[data-goods_name*="' + keyword + '"]').addClass('goods_info_search_selected');
            } else if (keyword_type == 2) {
                $('#171568945164AgLy').find('tbody').find('tr[data-goods_id*="' + keyword + '"]').addClass('goods_info_search_selected');
            } else if (keyword_type == 3) {
                $('#171568945164AgLy').find('tbody').find('tr[data-goods_sn*="' + keyword + '"]').addClass('goods_info_search_selected');
            }
        } else if (goods_barcode != '') {
            $('#171568945164AgLy').find('tbody').find('tr[data-goods_barcode*="' + goods_barcode + '"]').addClass('goods_info_search_selected');
        }
        var item=$("#171568945164AgLy").find('.goods_info_search_selected').length;
        if(item >0){
            var item_top = $("#171568945164AgLy").find('.goods_info_search_selected:first').offset().top
            var parent_top =$("#171568945164AgLy").offset().top;
            var top = item_top - parent_top
            if(top > 0){
                $("#171568945164AgLy").animate({
                    scrollTop:top
                }, 0);
            }else{
                $("#171568945164AgLy").animate({
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
        var container = $("#171568945164AgLy");
        $("[data-toggle='popover']").popover();
        tablelist = $("#171568945164AgLy").find("#selected_table_list").tablelist();
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
                        act_id: "",
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
                        $("#171568945164AgLy").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
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
                    $("#171568945164AgLy").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
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
                        $("#171568945164AgLy").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
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
                    $("#171568945164AgLy").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
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
                        $("#171568945164AgLy").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
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
                    $("#171568945164AgLy").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
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
                        $("#171568945164AgLy").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
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
                    $("#171568945164AgLy").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
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
        $("#171568945164AgLy").on("click", ".batchset-del", function () {
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
			</div>
			@endif
			<!-- 排序 -->
			<div class="simple-form-field" >
				<div class="form-group">
					<label for="limitdiscountmodel-sort" class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">排序：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">
							<input type="text" id="limitdiscountmodel-sort" class="form-control small" name="LimitDiscountModel[sort]" value="{{ $model['sort'] ?? 255 }}">
						</div>
						<div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
					</div>
				</div>
			</div>
			<div class="bottom-btn p-b-30">
				<input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg"/>
			</div>
		</form>
	</div>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
	<style type="text/css">
		.limit-type .form-control-error {
			margin-top: 7px;
		}
		#widget_goods, #widget_goods_no_join {
			padding-left: 15px !important;
			padding-right: 15px !important;;
		}
	</style>
	<script type="text/javascript">
		//
	</script>
	<script id="client_rules" type="text">
[{"id": "limitdiscountmodel-act_name", "name": "LimitDiscountModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"活动名称不能为空。"}}},{"id": "limitdiscountmodel-start_time", "name": "LimitDiscountModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动有效期不能为空。"}}},{"id": "limitdiscountmodel-end_time", "name": "LimitDiscountModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"套餐结束时间不能为空。"}}},{"id": "limitdiscountmodel-sort", "name": "LimitDiscountModel[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "limitdiscountmodel-purchase_num", "name": "LimitDiscountModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"限购数量必须是整数。"}}},{"id": "limitdiscountmodel-shop_id", "name": "LimitDiscountModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "limitdiscountmodel-act_multistore_type", "name": "LimitDiscountModel[act_multistore_type]", "attribute": "act_multistore_type", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"参与门店必须是整数。"}}},{"id": "limitdiscountmodel-ext_info", "name": "LimitDiscountModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "limitdiscountmodel-act_name", "name": "LimitDiscountModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多20个字符。"},"maxlength":20}},{"id": "limitdiscountmodel-act_label", "name": "LimitDiscountModel[act_label]", "attribute": "act_label", "rules": {"string":true,"messages":{"string":"活动标签必须是一条字符串。","minlength":"活动标签应该包含至少2个字符。","maxlength":"活动标签只能包含至多8个字符。"},"minlength":2,"maxlength":8}},{"id": "limitdiscountmodel-sort", "name": "LimitDiscountModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "limitdiscountmodel-act_stock", "name": "LimitDiscountModel[act_stock]", "attribute": "act_stock", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"活动库存必须是整数。","min":"活动库存必须不小于0。","max":"活动库存必须不大于999999。"},"min":0,"max":999999}},{"id": "limitdiscountmodel-start_time", "name": "LimitDiscountModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"limitdiscountmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "limitdiscountmodel-end_time", "name": "LimitDiscountModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"limitdiscountmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},{"id": "limitdiscountmodel-act_discount", "name": "LimitDiscountModel[act_discount]", "attribute": "act_discount", "rules": {"number":{"pattern":/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/},"messages":{"number":"折扣必须是一个数字。","decimal":"折扣必须是一个不大于2位小数的数字。","min":"折扣必须不小于0.01。","max":"折扣必须不大于10。"},"decimal":2,"min":0.01,"max":10}},{"id": "limitdiscountmodel-act_mark_down", "name": "LimitDiscountModel[act_mark_down]", "attribute": "act_mark_down", "rules": {"number":{"pattern":/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/},"messages":{"number":"减价必须是一个数字。","decimal":"减价必须是一个不大于2位小数的数字。","min":"减价必须不小于0。","max":"减价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "limitdiscountmodel-act_price", "name": "LimitDiscountModel[act_price]", "attribute": "act_price", "rules": {"number":{"pattern":/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/},"messages":{"number":"指定价必须是一个数字。","decimal":"指定价必须是一个不大于2位小数的数字。","min":"指定价必须不小于0.01。","max":"指定价必须不大于9999999。"},"decimal":2,"min":0.01,"max":9999999}}]
</script>
	<script type="text/javascript">
		//
	</script>
	<script>
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
	<script src="/assets/d2eace91/min/js/validate.min.js?v=2.1"></script>
	<script src="/assets/d2eace91/min/js/upload.min.js?v=2.1"></script>
	<script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.1"></script>
	<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=2.1"></script>
	<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=2.1"></script>
	<script src="/assets/d2eace91/js/activity.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/json2csv.js?v=1.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
	<script>
		var multistore_selector = null;
		$(function () {
			//
			var act_multistore_type = "0";
			var act_multistore_type_name = "LimitDiscountModel[act_multistore_type]";
			var select_group_ids = "" ? "".split(",") : [];
			var select_store_ids = "" ? "".split(",") : [];
			var select_groups = new Object();
			var select_stores = new Object();
			var container = $("#1715689451wanQ8Q");
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
						//
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
			$("body").on("click", "#1715689451wanQ8Q .ss-item i", function () {
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
					act_id: "",
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
			//
			//
			function reloadGoodsPicker() {
				if (goodspicker == null) {
					// 初始化组件，为容器绑定组件
					goodspicker = $("#widget_goods").goodspicker({
						url: '/dashboard/limit-discount/picker?act_id=',
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
						url: '/dashboard/limit-discount/picker?act_id=',
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
		$("[name='limit_type']:radio").change(function () {
			$(".limit-type").find(":text,:checkbox").prop("disabled", true);
			$(this).parents('label').parents('.limit-type-item').find(":text,:checkbox").prop("disabled", false);
			$(this).parents('label').parents('.limit-type-item').find(":text:first").focus();
			$(this).parents('.form-group').find(":text").valid();
		});
		$("[name='limit_type']:radio").filter("[value='0']").prop("checked", true).change();
		// limit_num_1 - 每人每种商品限购 N 件
		// limit_num_day - 每天限购 N 件
		// limit_num_order - 每单限购 N 件
		// limit_num_2 - 每人每种商品前 N 件享受折扣
		function checkLimitNum(element, value) {
			var name = $(element).attr("name");
			var limit_type = $(".limit-type").find(":radio:checked").val();
			var current_limit_type = $(element).data('type');
			if (current_limit_type != limit_type) {
				return true;
			}
			if (limit_type == 0) {
				return true;
			} else if (limit_type == 1) {
				if (name == "limit_num_day" && $(".limit_num_day_checkbox").is(":checked") == false) {
					return true;
				}
				if (name == "limit_num_order" && $(".limit_num_order_checkbox:checked").is(":checked") == false) {
					return true;
				}
			}
			if (/^(([0])|([1-9](\d*)))$/.test($(element).val()) == false) {
				$(element).data("msg", "限购数量必须是一个大于 0 的整数");
				return false;
			}
			if (limit_type == 1) {
				var limit_num = parseFloat($("[name='limit_num_1']").val());
				if ((name == "limit_num_day" || name == "limit_num_1") && parseFloat($("[name='limit_num_day']").val()) > limit_num) {
					$(element).data("msg", "每天限购数量不能大于每人每种商品限购数量");
					return false;
				}
				if ((name == "limit_num_order" || name == "limit_num_1") && parseFloat($("[name='limit_num_order']").val()) > limit_num) {
					$(element).data("msg", "每单限购数量不能大于每人每种商品限购数量");
					return false;
				}
				// 级联验证
				if (name == "limit_num_1") {
					if ($("[name='limit_num_day']").attr('aria-invalid') == 'true') {
						setTimeout(function () {
							$("[name='limit_num_day']").valid();
						}, 50);
					}
					if ($("[name='limit_num_order']").attr('aria-invalid') == 'true') {
						setTimeout(function () {
							$("[name='limit_num_order']").valid();
						}, 50);
					}
				} else if ($("[name='limit_num_1']").attr('aria-invalid') == 'true') {
					setTimeout(function () {
						$("[name='limit_num_1']").valid();
					}, 50);
				}
			}
			return true;
		}
		$(".limit_num_day_checkbox").click(function() {
			$("[name='limit_num_day']").valid();
		});
		$(".limit_num_order_checkbox").click(function() {
			$("[name='limit_num_order']").valid();
		});
		$("#act_img_container").imagegroup({
			host: '{{ get_oss_host() }}',
			size: 1,
			gallery: true,
			values: [''],
			callback: function (data) {
				$("#limitdiscountmodel-act_img").val(data.path);
			},
			remove: function (value, values) {
				$("#limitdiscountmodel-act_img").val('');
			}
		});
		//
		$().ready(function () {
			//悬浮显示上下步骤按钮
			window.onscroll = function () {
				$(window).scroll(function () {
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
			var activity = $.activityInfo({
				listPageUrl: '/dashboard/limit-discount/list',
				progressKey: 'shop:activity:progress:info:8',
			});
			var validator = $("#LimitDiscountModel").validate();
			// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
			$.validator.addRules($("#client_rules").html());
			$("#btn_submit").click(function () {
				// if (!validator.form()) {
				// 	return;
				// }
				if (cyclePickerEnable && !cyclePicker.validate()) {
					$.msg("周期重复设置错误！" + cyclePicker.errors[0]);
					return;
				}
				$.loading.start();
				var use_range = $('input[name="LimitDiscountModel[use_range]"]:checked').val();
				//如果不是指定商品 验证是否填写价格和库存
				if (use_range != 1) {
					var act_price_type = $('input[name="LimitDiscountModel[act_price_type]"]:checked').val();
					if (act_price_type == 0) {
						var act_discount = $('#limitdiscountmodel-act_discount').val();
						if (act_discount == '') {
							$.msg('折扣不能为空');
							return false;
						}
					} else if (act_price_type == 1) {
						var act_mark_down = $('#limitdiscountmodel-act_mark_down').val();
						if (act_mark_down === '') {
							$.msg('减价不能为空');
							return false;
						}
					} else if (act_price_type == 2) {
						var act_price = $('#limitdiscountmodel-act_price').val();
						if (act_price == '') {
							$.msg('指定价不能为空');
							return false;
						}
					}
					var act_stock = $('#limitdiscountmodel-act_stock').val();
					if (act_stock == '') {
						$.msg('活动库存不能为空');
						return false;
					}
				}
				var limit_type = $('input[name="limit_type"]:checked').val();
				if (limit_type == 1) {
					var limit_num = $('input[name="limit_num_1"]').val();
					if (limit_num <= 0) {
						$.msg('请设置每人每种商品限购数量！');
						return false;
					}
				}
				// 检查参与门店
				if ($.multistoreSelector && $.multistoreSelector.validate() == false) {
					$.loading.stop();
					return false;
				}
				var target = $(this);
				$(target).prop("disabled", true);
				$(target).addClass("disabled");
				var url = null;
				var data = $("#LimitDiscountModel").serializeJson();
				// 周期重复数据
				if (cyclePickerEnable) {
					data.cycle_data = cyclePicker.getValue();
				} else {
					data.cycle_data = {
						type: '-1'
					}
				}
				// 从门店选择器获取值
				if ($.multistoreSelector) {
					data["LimitDiscountModel"].act_multistore_type = $.multistoreSelector.getType();
					data.group_ids = $.multistoreSelector.getGroupIds();
					data.store_ids = $.multistoreSelector.getStoreIds();
				}
				var msg = null;
				if ("" == "") {
					url = '/dashboard/limit-discount/add';
					msg = '您确定添加限时折扣活动吗？当前操作可能会花费很长时间而且请勿中断！';
				} else {
					url = '/dashboard/limit-discount/edit?id=&is_copy=';
					if ("" == "1") {
						msg = '您确定复制限时折扣活动吗？当前操作可能会花费很长时间而且请勿中断！';
					} else {
						msg = '您确定保存限时折扣活动吗？当前操作可能会花费很长时间而且请勿中断！';
					}
				}
				$.confirm(msg, function () {
					activity.request(url, data, target);
				}, function () {
					$(target).prop("disabled", false);
					$(target).removeClass("disabled");
				});
			});
		});
		//
		var cyclePicker = null;
		var cyclePickerEnable = "hide" == "";
		$().ready(function () {
			//周期重复选择
			$(".switch-on-off").on('switchChange.bootstrapSwitch', function (e, state) {
				if (!state) {
					$('.act_repeat_item').addClass('hide')
				} else {
					$('.act_repeat_item').removeClass('hide');
				}
				cyclePickerEnable = state;
			});
			// 周期循环组件
			cyclePicker = $("#cycle_picker_container").cyclePicker({
				value: JSON.parse('null'),
				minuteStep: 1,
				daySize: 1,
				weekSize: 1,
				monthSize: 5,
				renderDisable: function () {
					return '';
				},
				// 支持的类型回调函数
				typeCallback: function (value) {
					return true;
				},
				// 开始时间以时间点为准
				hourCallback: function (value, type, is_begin) {
					return true;
				},
				// 开始时间以时间点为准
				minuteCallback: function (value, type, is_begin) {
					return true;
				},
				change: function () {
					// 值发生改变后进行校验
					this.validate();
				}
			});
		})
		//
	</script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
