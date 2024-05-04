{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30">
        <div class="content">



            <form id="form1" class="form-horizontal" name="Freight" action="/shop/freight/edit?id={{ $info->freight_id }}" method="post" left="col-sm-3" right="col-sm-9">
                @csrf
                <!-- 模板ID -->
                <input type="hidden" id="freight-freight_id" class="form-control" name="Freight[freight_id]" value="{{ $info->freight_id }}">
                <!-- 模板名称  -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="freight-title" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">模板名称：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="freight-title" class="form-control" name="Freight[title]" value="{{ $info->title }}">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 商品所在地  -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="freight-region_code" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">商品所在地：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <div id="region_container"></div>
                                <input type="hidden" id="freight-region_code" class="form-control" name="Freight[region_code]" value="{{ $info->region_code }}">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 是否包邮 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="freight-is_free" class="col-sm-3 control-label">

                            <span class="ng-binding">是否包邮：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="hidden" name="Freight[is_free]" value="0">
                                <div id="freight-is_free" class="" name="Freight[is_free]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Freight[is_free]" value="0" @if($info->is_free == 0) checked @endif> 自定义运费</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Freight[is_free]" value="1" @if($info->is_free == 1) checked @endif> 卖家承担运费</label>
                                </div>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">选择“卖家承担运费”后，当前运费模板下所有区域的运费将设置为0元，在订单中只针对当前运费模板下的商品有效</div></div>
                        </div>
                    </div>
                </div>
                <!-- 计价方式 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="freight-valuation" class="col-sm-3 control-label">

                            <span class="ng-binding">计价方式：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">



                                <input type="hidden" name="Freight[valuation]" value="">
                                <div id="freight-valuation" class="" name="Freight[valuation]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Freight[valuation]" value="{{ $info->valuation }}" checked> {{ format_freight_valuation($info->valuation) }}</label>
                                </div>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 区域限售 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="freight-limit_sale" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">区域限售：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="hidden" name="Freight[limit_sale]" value="0">
                                <div id="freight-limit_sale" class="" name="Freight[limit_sale]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Freight[limit_sale]" value="0" @if($info->limit_sale == 0) checked @endif> 不支持</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Freight[limit_sale]" value="1" @if($info->limit_sale == 1) checked @endif> 支持</label>
                                </div>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">如果支持区域限售，商品只能在设置了运费的指定地区销售</div></div>
                        </div>
                    </div>
                </div>


                <div id="record_container">
                    <!-- 区域限售 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">

                                <span class="ng-binding">运送方式：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <!--选择快递的弹框 star-->
                                    <div class="postage-detail freight-container" style="width: 780px;">
                                        <div class="entity">


                                            @foreach($info->freightRecord as $fr)
                                                @if($fr->is_default == 1 && $info->limit_sale == 0) {{--不支持区域限售并且是默认运费模板 才显示--}}
                                                    <div id="default_record" class="default" style="width: 100%; height: 30px; display: ;">
                                                        <input type="hidden" id="freightrecord-record_id" class="form-control" name="FreightRecord[record_id]" value="{{ $fr->record_id }}">{{--新加 用于编辑标识--}}
                                                        <input type="hidden" id="freightrecord-is_default" class="form-control small sm-height pull-none" name="FreightRecord[is_default]" value="{{ $fr->is_default }}">
                                                        <div style="float: left;">
                                                            默认运费：

                                                            <input type="text" id="freightrecord-start_num" class="form-control small sm-height pull-none start-num" name="FreightRecord[start_num]" value="{{ $fr->start_num }}" @if($info->is_free == 1) readonly @endif>

                                                            <span class="unit_mark">件</span>
                                                            内，

                                                            <input type="text" id="freightrecord-start_money" class="form-control small sm-height pull-none start-money" name="FreightRecord[start_money]" value="{{ $fr->start_money }}" @if($info->is_free == 1) readonly @endif>

                                                            元， 每增加

                                                            <input type="text" id="freightrecord-plus_num" class="form-control small sm-height pull-none plus-num" name="FreightRecord[plus_num]" value="{{ $fr->plus_num }}" @if($info->is_free == 1) readonly @endif>

                                                            <span class="unit_mark">件</span>
                                                            ， 增加运费

                                                            <input type="text" id="freightrecord-plus_money" class="form-control small sm-height pull-none plus-money" name="FreightRecord[plus_money]" value="{{ $fr->plus_money }}" @if($info->is_free == 1) readonly @endif>

                                                            元，

                                                            <input type="hidden" name="FreightRecord[is_cash]" value="0"><label><input type="checkbox" id="freightrecord-is_cash" class="cur-p" name="FreightRecord[is_cash]" value="1" @if($fr->is_cash == 1) checked @endif> 支持货到付款</label>
                                                        </div>



                                                        <span class="cash_more" style="@if($fr->is_cash == 1) float: left; @else visibility: hidden; @endif">
                                                            ，需加价：

                                                            <input type="text" id="freightrecord-cash_more" class="form-control small sm-height pull-none" name="FreightRecord[cash_more]" value="{{ $fr->cash_more }}">

                                                            元
                                                        </span>
                                                    </div>
                                                @endif
                                            @endforeach

                                            @if(count($info->freightRecord) > 1)
                                                <div class="freight-set m-t-10">
                                                    <div class="table-responsive">
                                                        <table id="freight_table" class="table table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th class="w180">运送到</th>
                                                                <th>
                                                                    <span class="unit_start">首件</span>
                                                                    (
                                                                    <span class="unit_mark">件</span>
                                                                    )
                                                                </th>
                                                                <th>收费(元)</th>
                                                                <th>
                                                                    <span class="unit_plus">续件</span>
                                                                    (
                                                                    <span class="unit_mark">件</span>
                                                                    )
                                                                </th>
                                                                <th>续费(元)</th>
                                                                <th class="w200">货到付款</th>
                                                                <th class="handle">操作</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="tbl">

                                                            @foreach($info->freightRecord as $fr)
                                                                @if($fr->is_default != 1)
                                                                    <tr>
                                                                        <td>

                                                                            <input type="hidden" id="freightrecord-record_id" class="form-control" name="FreightRecord[record_id]" value="{{ $fr->record_id }}">


                                                                            <input type="hidden" id="freightrecord-is_default" class="form-control" name="FreightRecord[is_default]" value="{{ $fr->is_default }}">

                                                                            <input type="hidden" id="freightrecord-region_codes" class="region-codes" name="FreightRecord[region_codes]" value="{{ $fr->region_codes }}">

                                                                            <input type="hidden" id="freightrecord-region_names" class="region-names" name="FreightRecord[region_names]" value="{{ $fr->region_names }}">
                                                                            <div class="area-group region-names-label" title="{{ $fr->region_names }}">

                                                                                {{ $fr->region_names }}

                                                                            </div>
                                                                            <a href="javascript:void(0);" class="region-edit c-blue" title="编辑运费区域">编辑</a>
                                                                        </td>
                                                                        <td><input type="text" id="freightrecord-start_num" class="form-control small sm-height pull-none start-num" name="FreightRecord[start_num]" value="{{ $fr->start_num }}" @if($info->is_free == 1) readonly @endif></td>
                                                                        <td><input type="text" id="freightrecord-start_money" class="form-control small sm-height pull-none start-money" name="FreightRecord[start_money]" value="{{ $fr->start_money }}" @if($info->is_free == 1) readonly @endif></td>
                                                                        <td><input type="text" id="freightrecord-plus_num" class="form-control small sm-height pull-none plus-num" name="FreightRecord[plus_num]" value="{{ $fr->plus_num }}" @if($info->is_free == 1) readonly @endif></td>
                                                                        <td><input type="text" id="freightrecord-plus_money" class="form-control small sm-height pull-none plus-money" name="FreightRecord[plus_money]" value="{{ $fr->plus_money }}" @if($info->is_free == 1) readonly @endif></td>
                                                                        <td>
                                                                            <input type="hidden" name="FreightRecord[is_cash]" value="0">
                                                                            <label><input type="checkbox" id="freightrecord-is_cash" class="cur-p" name="FreightRecord[is_cash]" value="1" @if($fr->is_cash == 1) checked @endif> 支持</label>



                                                                            <span class="cash_more" style="@if($fr->is_cash == 0) visibility: hidden; @endif">
                                                    ，需加价：

                                                    <input type="text" id="freightrecord-cash_more" class="form-control small sm-height pull-none m-r-5" name="FreightRecord[cash_more]" value="{{ $fr->cash_more }}">

                                                    元
                                                </span>
                                                                        </td>
                                                                        <td class="handle">
                                                                            <a href="javascript:void(0);" class="del freight-remove">删除</a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="freight-handle m-t-10">
                                                        <!--错误提示模块 star-->
                                                        <div class="freight-handle-error"></div>
                                                        <!--错误提示模块 end-->
                                                        <a id="add_freight" href="javascript:void(0);" class="btn btn-warning btn-sm m-r-5">
                                                            <i class="fa fa-hand-o-right"></i>
                                                            为指定地区城市设置运费
                                                        </a>
                                                        <!--
                                                    <a class="btn btn-primary btn-sm m-r-5" href="">批量设置</a>
                                                    <a class="btn btn-danger btn-sm" href="">批量删除</a>
                                                     -->
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="help-block help-block-t">除指定地区外，其余地区的运费采用“默认运费”，如果全国统一运费，则只需设置默认运费即可。</div>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>



                    <div id="free_container" @if($info->is_free == 1) style="display: none;" @endif>
                        <!-- 区域限售 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">

                                    <span class="ng-binding">是否指定条件包邮：</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-box">


                                        <input type="hidden" name="Freight[free_set]" value="0">
                                        <div id="freight-free_set" class="is-free-condition" name="Freight[free_set]" value="1" selection="0">
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="Freight[free_set]" value="1" @if($info->free_set == 1) checked @endif> 是</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="Freight[free_set]" value="0" @if($info->free_set == 0) checked @endif> 否</label>
                                        </div>




                                        <!--是否包邮弹框 star-->
                                        <div class="free-shipping free-container"style="width: 770px;">
                                            <div class="table-responsive">
                                                <table id="free_table" class="table table-hover m-b-0">
                                                    <thead>
                                                    <tr>
                                                        <th class="w250">选择地区</th>
                                                        <th class="w120">包邮模式</th>
                                                        <th class="w300">设置包邮条件</th>
                                                        <th class="handle w100">操作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($info->freightFreeRecord as $ffr)
                                                        <tr>
                                                            <td>

                                                                <input type="hidden" id="freightfreerecord-record_id" class="form-control" name="FreightFreeRecord[record_id]" value="{{ $ffr->record_id }}">


                                                                <input type="hidden" id="freightfreerecord-is_default" class="form-control" name="FreightFreeRecord[is_default]" value="{{ $ffr->is_default }}">

                                                                <input type="hidden" id="freightfreerecord-region_codes" class="region-codes" name="FreightFreeRecord[region_codes]" value="{{ $ffr->region_codes }}">

                                                                <input type="hidden" id="freightfreerecord-region_names" class="region-names" name="FreightFreeRecord[region_names]" value="{{ $ffr->region_names }}">
                                                                <div class="area-group region-names-label" title="{{ $ffr->region_names }}">

                                                                    {{ $ffr->region_names }}

                                                                </div>
                                                                <a href="javascript:void(0);" class="region-edit c-blue" title="编辑运费区域">编辑</a>
                                                            </td>
                                                            <td>

                                                                <select id="freightfreerecord-free_mode" class="form-control sm-height pull-none free-mode" name="FreightFreeRecord[free_mode]">
                                                                    <option value="0" @if($ffr->free_mode == 0) selected="" @endif>件数</option>
                                                                    <option value="1" @if($ffr->free_mode == 1) selected="" @endif>金额</option>
                                                                    <option value="2" @if($ffr->free_mode == 2) selected="" @endif>件数+金额</option>
                                                                    <option value="3" @if($ffr->free_mode == 3) selected="" @endif>件数或金额</option>
                                                                </select>

                                                            </td>
                                                            <td class="free_condition" style="width: 250px;">
                                                                @if($ffr->free_mode == 0)
                                                                    满 <input type="text" id="freightfreerecord-free_number" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_number]" value="{{ $ffr->free_number }}"> 件包邮
                                                                @elseif($ffr->free_mode == 1)
                                                                    满 <input type="text" id="freightfreerecord-free_money" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_money]" value="{{ $ffr->free_number }}"> 元包邮
                                                                @elseif($ffr->free_mode == 2)
                                                                    满 <input type="text" id="freightfreerecord-free_number" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_number]" value="{{ $ffr->free_number }}"> 件， 并且满<input type="text" id="freightfreerecord-free_money" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_money]" value="{{ $ffr->free_money }}"> 元包邮
                                                                @elseif($ffr->free_mode == 3)
                                                                    满 <input type="text" id="freightfreerecord-free_number" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_number]" value="{{ $ffr->free_number }}"> 件， 或者满<input type="text" id="freightfreerecord-free_money" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_money]" value="{{ $ffr->free_money }}"> 元包邮
                                                                @endif
                                                            </td>
                                                            <td class="handle">
                                                                <a href="javascript:void(0);" class="del free-remove">删除</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="freight-handle m-t-10">
                                                <!--错误提示模块 star-->
                                                <div class="freight-handle-error"></div>
                                                <!--错误提示模块 end-->
                                                <a id="add_free" href="javascript:void(0);" class="btn btn-warning btn-sm m-r-5">
                                                    <i class="fa fa-hand-o-right"></i>
                                                    为指定地区城市设置包邮条件
                                                </a>
                                            </div>
                                        </div>
                                        <!--是否包邮弹框 end-->

                                    </div>

                                    <div class="help-block help-block-t"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 提交 -->
                <div class="bottom-btn p-b-30">
                    <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
                </div>

            </form>
        </div>
    </div>

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
    <!--点击按钮为表格增加行-->
    <script id="freight_template" type="text">
<tr>
	<td>
		<input type="hidden" id="freightrecord-is_default" class="form-control" name="FreightRecord[is_default]" value="0">
		<input type="hidden" id="freightrecord-region_codes" class="region-codes" name="FreightRecord[region_codes]">
		<input type="hidden" id="freightrecord-region_names" class="region-names" name="FreightRecord[region_names]">
		<div class="area-group region-names-label">未指定任何地区</div>
		<a href="javascript:void(0);" class="region-edit c-blue" title="编辑运费区域">编辑</a>
	</td>
	<td>
		<input type="text" id="freightrecord-start_num" class="form-control small sm-height pull-none start-num" name="FreightRecord[start_num]" value="1">
	</td>
	<td>
		<input type="text" id="freightrecord-start_money" class="form-control small sm-height pull-none start-money" name="FreightRecord[start_money]" value="0">
	</td>
	<td>
		<input type="text" id="freightrecord-plus_num" class="form-control small sm-height pull-none plus-num" name="FreightRecord[plus_num]" value="1">
	</td>
	<td>
		<input type="text" id="freightrecord-plus_money" class="form-control small sm-height pull-none plus-money" name="FreightRecord[plus_money]" value="0">
	</td>
	<td>
		<label class="control-label cur-p">
			<input type="hidden" name="FreightRecord[is_cash]" value="0">
			<input type="checkbox" name="FreightRecord[is_cash]" value="1">
			支持
		</label>
		<span class="cash_more" style="visibility: hidden;">
			，需加价：
			<input type="text" id="freightrecord-cash_more" class="form-control small sm-height pull-none m-r-5" name="FreightRecord[cash_more]" value="0">
			元
		</span>
	</td>
	<td class="handle">
		<a href="javascript:;" class="del freight-remove">删除</a>
	</td>
</tr>
</script>
    <!-- 包邮模板 -->
    <script id="free_template_0" type=text>
<tr>
	<td class="free-area free-contion">

		<input type="hidden" id="freightfreerecord-region_codes" class="region-codes" name="FreightFreeRecord[region_codes]">

		<input type="hidden" id="freightfreerecord-region_names" class="region-names" name="FreightFreeRecord[region_names]">
		<div class="area-group region-names-label">未指定任何地区</div>
		<a href="javascript:void(0);" class="region-edit c-blue" title="编辑运费区域">编辑</a>
	</td>
	<td>
		<select id="freightfreerecord-free_mode" class="form-control sm-height pull-none free-mode" name="FreightFreeRecord[free_mode]">
<option value="0" selected>件数</option>
<option value="1">金额</option>
<option value="2">件数+金额</option>
<option value="3">件数或金额</option>
</select>
	</td>
	<td class="free_condition" style="width: 250px;">
		<span class="unit_free_start">满</span>
		<input type="text" id="freightfreerecord-free_number" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_number]" data-rule-required="true" data-msg="包邮条件不能为空">
		<span class="unit_free_end">件</span>包邮
	</td>
	<td class="handle">
		<a href="javascript:void(0);" class="del free-remove">删除</a>
	</td>
</tr>
</script>
    <script id="free_template_1" type=text>
<tr>
	<td class="free-area free-contion">

		<input type="hidden" id="freightfreerecord-region_codes" class="region-codes" name="FreightFreeRecord[region_codes]">

		<input type="hidden" id="freightfreerecord-region_names" class="region-names" name="FreightFreeRecord[region_names]">
		<div class="area-group region-names-label">未指定任何地区</div>
		<a href="javascript:void(0);" class="region-edit c-blue" title="编辑运费区域">编辑</a>
	</td>
	<td>
		<select id="freightfreerecord-free_mode" class="form-control sm-height pull-none free-mode" name="FreightFreeRecord[free_mode]">
<option value="0" selected>重量</option>
<option value="1">金额</option>
<option value="2">重量+金额</option>
<option value="3">重量或金额</option>
</select>
	</td>
	<td class="free_condition" style="width: 250px;">
		<span class="unit_free_start">在</span>
		<input type="text" id="freightfreerecord-free_number" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_number]" data-rule-required="true" data-msg="包邮条件不能为空">
		<span class="unit_free_end">Kg内</span>包邮
	</td>
	<td class="handle">
		<a href="javascript:void(0);" class="del free-remove">删除</a>
	</td>
</tr>
</script>
    <script id="free_template_2" type=text>
<tr>
	<td class="free-area free-contion">

		<input type="hidden" id="freightfreerecord-region_codes" class="region-codes" name="FreightFreeRecord[region_codes]">

		<input type="hidden" id="freightfreerecord-region_names" class="region-names" name="FreightFreeRecord[region_names]">
		<div class="area-group region-names-label">未指定任何地区</div>
		<a href="javascript:void(0);" class="region-edit c-blue" title="编辑运费区域">编辑</a>
	</td>
	<td>
		<select id="freightfreerecord-free_mode" class="form-control sm-height pull-none free-mode" name="FreightFreeRecord[free_mode]" data-rule-required="true" data-msg="包邮条件不能为空">
<option value="0" selected>体积</option>
<option value="1">金额</option>
<option value="2">体积+金额</option>
<option value="3">体积或金额</option>
</select>
	</td>
	<td class="free_condition" style="width: 250px;">
		<span class="unit_free_start">在</span>
		<input type="text" id="freightfreerecord-free_number" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_number]" data-rule-required="true" data-msg="包邮条件不能为空">
		<span class="unit_free_end">m<sup>3</sup>内</span>包邮
	</td>
	<td class="handle">
		<a href="javascript:void(0);" class="del free-remove">删除</a>
	</td>
</tr>
</script>

    <script id="free_mode_0_template" type="text">
<span class="unit_free_start">满</span>
<input type="text" id="freightfreerecord-free_number" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_number]" data-rule-required="true" data-msg="包邮条件不能为空">
<span class="unit_free_end">件</span>包邮
</script>
    <script id="free_mode_1_template" type="text">
满
<input type="text" id="freightfreerecord-free_money" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_money]" data-rule-required="true" data-msg="包邮条件不能为空">
元包邮
</script>
    <script id="free_mode_2_template" type="text">
<span class="unit_free_start">满</span>
<input type="text" id="freightfreerecord-free_number" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_number]" data-rule-required="true" data-msg="包邮条件不能为空">
<span class="unit_free_end">件</span>，并且满
<input type="text" id="freightfreerecord-free_money" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_money]" data-rule-required="true" data-msg="包邮条件不能为空">
元包邮
</script>
    <script id="free_mode_3_template" type="text">
<span class="unit_free_start">满</span>
<input type="text" id="freightfreerecord-free_number" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_number]" data-rule-required="true" data-msg="包邮条件不能为空">
<span class="unit_free_end">件</span>，或者满
<input type="text" id="freightfreerecord-free_money" class="form-control small sm-height pull-none m-l-5 m-r-5" name="FreightFreeRecord[free_money]" data-rule-required="true" data-msg="包邮条件不能为空">
元包邮
</script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <!-- 地区 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180919"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "freight-shop_id", "name": "Freight[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商家编号必须是整数。"}}},{"id": "freight-freight_type", "name": "Freight[freight_type]", "attribute": "freight_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Freight Type必须是整数。"}}},{"id": "freight-is_free", "name": "Freight[is_free]", "attribute": "is_free", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否包邮必须是整数。"}}},{"id": "freight-free_set", "name": "Freight[free_set]", "attribute": "free_set", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否支持指定条件包邮必须是整数。"}}},{"id": "freight-valuation", "name": "Freight[valuation]", "attribute": "valuation", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"计价方式必须是整数。"}}},{"id": "freight-limit_sale", "name": "Freight[limit_sale]", "attribute": "limit_sale", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"区域限售必须是整数。"}}},{"id": "freight-add_time", "name": "Freight[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "freight-last_time", "name": "Freight[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最后编辑时间必须是整数。"}}},{"id": "freight-title", "name": "Freight[title]", "attribute": "title", "rules": {"required":true,"messages":{"required":"模板名称不能为空。"}}},{"id": "freight-region_code", "name": "Freight[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"商品所在地不能为空。"}}},{"id": "freight-limit_sale", "name": "Freight[limit_sale]", "attribute": "limit_sale", "rules": {"required":true,"messages":{"required":"区域限售不能为空。"}}},{"id": "freight-add_time", "name": "Freight[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"添加时间不能为空。"}}},{"id": "freight-last_time", "name": "Freight[last_time]", "attribute": "last_time", "rules": {"required":true,"messages":{"required":"最后编辑时间不能为空。"}}},{"id": "freight-title", "name": "Freight[title]", "attribute": "title", "rules": {"string":true,"messages":{"string":"模板名称必须是一条字符串。","maxlength":"模板名称只能包含至多20个字符。"},"maxlength":20}},{"id": "freight-region_code", "name": "Freight[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"商品所在地必须是一条字符串。","maxlength":"商品所在地只能包含至多20个字符。"},"maxlength":20}},{"id": "freight-is_free", "name": "Freight[is_free]", "attribute": "is_free", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否包邮是无效的。"}}},{"id": "freight-free_set", "name": "Freight[free_set]", "attribute": "free_set", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否支持指定条件包邮是无效的。"}}},]
</script>
    <script id="record_client_rules_0" type="text">
[{"id": "freightrecord-freight_id", "name": "FreightRecord[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"模板ID不能为空。"}}},{"id": "freightrecord-is_default", "name": "FreightRecord[is_default]", "attribute": "is_default", "rules": {"required":true,"messages":{"required":"默认运费不能为空。"}}},{"id": "freightrecord-region_codes", "name": "FreightRecord[region_codes]", "attribute": "region_codes", "rules": {"required":true,"messages":{"required":"地区不能为空。"}}},{"id": "freightrecord-is_cash", "name": "FreightRecord[is_cash]", "attribute": "is_cash", "rules": {"required":true,"messages":{"required":"是否支持货到付款不能为空。"}}},{"id": "freightrecord-start_num", "name": "FreightRecord[start_num]", "attribute": "start_num", "rules": {"required":true,"messages":{"required":"首件不能为空。"}}},{"id": "freightrecord-plus_num", "name": "FreightRecord[plus_num]", "attribute": "plus_num", "rules": {"required":true,"messages":{"required":"续件不能为空。"}}},{"id": "freightrecord-start_money", "name": "FreightRecord[start_money]", "attribute": "start_money", "rules": {"required":true,"messages":{"required":"首费不能为空。"}}},{"id": "freightrecord-plus_money", "name": "FreightRecord[plus_money]", "attribute": "plus_money", "rules": {"required":true,"messages":{"required":"续费不能为空。"}}},{"id": "freightrecord-cash_more", "name": "FreightRecord[cash_more]", "attribute": "cash_more", "rules": {"required":true,"messages":{"required":"货到付款加价不能为空。"}}},{"id": "freightrecord-add_time", "name": "FreightRecord[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"添加时间不能为空。"}}},{"id": "freightrecord-freight_id", "name": "FreightRecord[freight_id]", "attribute": "freight_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"模板ID必须是整数。"}}},{"id": "freightrecord-is_default", "name": "FreightRecord[is_default]", "attribute": "is_default", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"默认运费必须是整数。"}}},{"id": "freightrecord-is_cash", "name": "FreightRecord[is_cash]", "attribute": "is_cash", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否支持货到付款必须是整数。"}}},{"id": "freightrecord-add_time", "name": "FreightRecord[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "freightrecord-sort", "name": "FreightRecord[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "freightrecord-region_codes", "name": "FreightRecord[region_codes]", "attribute": "region_codes", "rules": {"string":true,"messages":{"string":"地区必须是一条字符串。"}}},{"id": "freightrecord-region_names", "name": "FreightRecord[region_names]", "attribute": "region_names", "rules": {"string":true,"messages":{"string":"地区必须是一条字符串。"}}},{"id": "freightrecord-region_path", "name": "FreightRecord[region_path]", "attribute": "region_path", "rules": {"string":true,"messages":{"string":"Region Path必须是一条字符串。"}}},{"id": "freightrecord-region_desc", "name": "FreightRecord[region_desc]", "attribute": "region_desc", "rules": {"string":true,"messages":{"string":"Region Desc必须是一条字符串。"}}},{"id": "freightrecord-region_color", "name": "FreightRecord[region_color]", "attribute": "region_color", "rules": {"string":true,"messages":{"string":"Region Color必须是一条字符串。"}}},{"id": "freightrecord-start_money", "name": "FreightRecord[start_money]", "attribute": "start_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"首费必须是一个数字。","min":"首费必须不小于0。","max":"首费必须不大于999.99。"},"min":0,"max":999.99}},{"id": "freightrecord-plus_money", "name": "FreightRecord[plus_money]", "attribute": "plus_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"续费必须是一个数字。","min":"续费必须不小于0。","max":"续费必须不大于999.99。"},"min":0,"max":999.99}},{"id": "freightrecord-cash_more", "name": "FreightRecord[cash_more]", "attribute": "cash_more", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"货到付款加价必须是一个数字。","min":"货到付款加价必须不小于0。","max":"货到付款加价必须不大于999.99。"},"min":0,"max":999.99}},]
</script>
    <script id="record_client_rules_1" type="text">
[{"id": "freightrecord-freight_id", "name": "FreightRecord[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"模板ID不能为空。"}}},{"id": "freightrecord-is_default", "name": "FreightRecord[is_default]", "attribute": "is_default", "rules": {"required":true,"messages":{"required":"默认运费不能为空。"}}},{"id": "freightrecord-region_codes", "name": "FreightRecord[region_codes]", "attribute": "region_codes", "rules": {"required":true,"messages":{"required":"地区不能为空。"}}},{"id": "freightrecord-is_cash", "name": "FreightRecord[is_cash]", "attribute": "is_cash", "rules": {"required":true,"messages":{"required":"是否支持货到付款不能为空。"}}},{"id": "freightrecord-start_num", "name": "FreightRecord[start_num]", "attribute": "start_num", "rules": {"required":true,"messages":{"required":"首重不能为空。"}}},{"id": "freightrecord-plus_num", "name": "FreightRecord[plus_num]", "attribute": "plus_num", "rules": {"required":true,"messages":{"required":"续重不能为空。"}}},{"id": "freightrecord-start_money", "name": "FreightRecord[start_money]", "attribute": "start_money", "rules": {"required":true,"messages":{"required":"首费不能为空。"}}},{"id": "freightrecord-plus_money", "name": "FreightRecord[plus_money]", "attribute": "plus_money", "rules": {"required":true,"messages":{"required":"续费不能为空。"}}},{"id": "freightrecord-cash_more", "name": "FreightRecord[cash_more]", "attribute": "cash_more", "rules": {"required":true,"messages":{"required":"货到付款加价不能为空。"}}},{"id": "freightrecord-add_time", "name": "FreightRecord[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"添加时间不能为空。"}}},{"id": "freightrecord-freight_id", "name": "FreightRecord[freight_id]", "attribute": "freight_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"模板ID必须是整数。"}}},{"id": "freightrecord-is_default", "name": "FreightRecord[is_default]", "attribute": "is_default", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"默认运费必须是整数。"}}},{"id": "freightrecord-is_cash", "name": "FreightRecord[is_cash]", "attribute": "is_cash", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否支持货到付款必须是整数。"}}},{"id": "freightrecord-add_time", "name": "FreightRecord[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "freightrecord-sort", "name": "FreightRecord[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "freightrecord-region_codes", "name": "FreightRecord[region_codes]", "attribute": "region_codes", "rules": {"string":true,"messages":{"string":"地区必须是一条字符串。"}}},{"id": "freightrecord-region_names", "name": "FreightRecord[region_names]", "attribute": "region_names", "rules": {"string":true,"messages":{"string":"地区必须是一条字符串。"}}},{"id": "freightrecord-region_path", "name": "FreightRecord[region_path]", "attribute": "region_path", "rules": {"string":true,"messages":{"string":"Region Path必须是一条字符串。"}}},{"id": "freightrecord-region_desc", "name": "FreightRecord[region_desc]", "attribute": "region_desc", "rules": {"string":true,"messages":{"string":"Region Desc必须是一条字符串。"}}},{"id": "freightrecord-region_color", "name": "FreightRecord[region_color]", "attribute": "region_color", "rules": {"string":true,"messages":{"string":"Region Color必须是一条字符串。"}}},{"id": "freightrecord-start_money", "name": "FreightRecord[start_money]", "attribute": "start_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"首费必须是一个数字。","min":"首费必须不小于0。","max":"首费必须不大于999.99。"},"min":0,"max":999.99}},{"id": "freightrecord-plus_money", "name": "FreightRecord[plus_money]", "attribute": "plus_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"续费必须是一个数字。","min":"续费必须不小于0。","max":"续费必须不大于999.99。"},"min":0,"max":999.99}},{"id": "freightrecord-cash_more", "name": "FreightRecord[cash_more]", "attribute": "cash_more", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"货到付款加价必须是一个数字。","min":"货到付款加价必须不小于0。","max":"货到付款加价必须不大于999.99。"},"min":0,"max":999.99}},{"id": "freightrecord-start_num", "name": "FreightRecord[start_num]", "attribute": "start_num", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"首重必须是一个数字。","min":"首重必须不小于0.1。","max":"首重必须不大于9999.9。"},"min":0.1,"max":9999.9}},{"id": "freightrecord-plus_num", "name": "FreightRecord[plus_num]", "attribute": "plus_num", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"续重必须是一个数字。","min":"续重必须不小于0.1。","max":"续重必须不大于9999.9。"},"min":0.1,"max":9999.9}},]
</script>
    <script id="record_client_rules_2" type="text">
[{"id": "freightrecord-freight_id", "name": "FreightRecord[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"模板ID不能为空。"}}},{"id": "freightrecord-is_default", "name": "FreightRecord[is_default]", "attribute": "is_default", "rules": {"required":true,"messages":{"required":"默认运费不能为空。"}}},{"id": "freightrecord-region_codes", "name": "FreightRecord[region_codes]", "attribute": "region_codes", "rules": {"required":true,"messages":{"required":"地区不能为空。"}}},{"id": "freightrecord-is_cash", "name": "FreightRecord[is_cash]", "attribute": "is_cash", "rules": {"required":true,"messages":{"required":"是否支持货到付款不能为空。"}}},{"id": "freightrecord-start_num", "name": "FreightRecord[start_num]", "attribute": "start_num", "rules": {"required":true,"messages":{"required":"首体积不能为空。"}}},{"id": "freightrecord-plus_num", "name": "FreightRecord[plus_num]", "attribute": "plus_num", "rules": {"required":true,"messages":{"required":"续体积不能为空。"}}},{"id": "freightrecord-start_money", "name": "FreightRecord[start_money]", "attribute": "start_money", "rules": {"required":true,"messages":{"required":"首费不能为空。"}}},{"id": "freightrecord-plus_money", "name": "FreightRecord[plus_money]", "attribute": "plus_money", "rules": {"required":true,"messages":{"required":"续费不能为空。"}}},{"id": "freightrecord-cash_more", "name": "FreightRecord[cash_more]", "attribute": "cash_more", "rules": {"required":true,"messages":{"required":"货到付款加价不能为空。"}}},{"id": "freightrecord-add_time", "name": "FreightRecord[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"添加时间不能为空。"}}},{"id": "freightrecord-freight_id", "name": "FreightRecord[freight_id]", "attribute": "freight_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"模板ID必须是整数。"}}},{"id": "freightrecord-is_default", "name": "FreightRecord[is_default]", "attribute": "is_default", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"默认运费必须是整数。"}}},{"id": "freightrecord-is_cash", "name": "FreightRecord[is_cash]", "attribute": "is_cash", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否支持货到付款必须是整数。"}}},{"id": "freightrecord-add_time", "name": "FreightRecord[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "freightrecord-sort", "name": "FreightRecord[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "freightrecord-region_codes", "name": "FreightRecord[region_codes]", "attribute": "region_codes", "rules": {"string":true,"messages":{"string":"地区必须是一条字符串。"}}},{"id": "freightrecord-region_names", "name": "FreightRecord[region_names]", "attribute": "region_names", "rules": {"string":true,"messages":{"string":"地区必须是一条字符串。"}}},{"id": "freightrecord-region_path", "name": "FreightRecord[region_path]", "attribute": "region_path", "rules": {"string":true,"messages":{"string":"Region Path必须是一条字符串。"}}},{"id": "freightrecord-region_desc", "name": "FreightRecord[region_desc]", "attribute": "region_desc", "rules": {"string":true,"messages":{"string":"Region Desc必须是一条字符串。"}}},{"id": "freightrecord-region_color", "name": "FreightRecord[region_color]", "attribute": "region_color", "rules": {"string":true,"messages":{"string":"Region Color必须是一条字符串。"}}},{"id": "freightrecord-start_money", "name": "FreightRecord[start_money]", "attribute": "start_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"首费必须是一个数字。","min":"首费必须不小于0。","max":"首费必须不大于999.99。"},"min":0,"max":999.99}},{"id": "freightrecord-plus_money", "name": "FreightRecord[plus_money]", "attribute": "plus_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"续费必须是一个数字。","min":"续费必须不小于0。","max":"续费必须不大于999.99。"},"min":0,"max":999.99}},{"id": "freightrecord-cash_more", "name": "FreightRecord[cash_more]", "attribute": "cash_more", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"货到付款加价必须是一个数字。","min":"货到付款加价必须不小于0。","max":"货到付款加价必须不大于999.99。"},"min":0,"max":999.99}},{"id": "freightrecord-start_num", "name": "FreightRecord[start_num]", "attribute": "start_num", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"首体积必须是一个数字。","min":"首体积必须不小于0.1。","max":"首体积必须不大于9999.9。"},"min":0.1,"max":9999.9}},{"id": "freightrecord-plus_num", "name": "FreightRecord[plus_num]", "attribute": "plus_num", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"续体积必须是一个数字。","min":"续体积必须不小于0.1。","max":"续体积必须不大于9999.9。"},"min":0.1,"max":9999.9}},]
</script>
    <script id="free_record_client_rules_0" type="text">
[{"id": "freightfreerecord-freight_id", "name": "FreightFreeRecord[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"模板ID不能为空。"}}},{"id": "freightfreerecord-region_codes", "name": "FreightFreeRecord[region_codes]", "attribute": "region_codes", "rules": {"required":true,"messages":{"required":"地区不能为空。"}}},{"id": "freightfreerecord-free_mode", "name": "FreightFreeRecord[free_mode]", "attribute": "free_mode", "rules": {"required":true,"messages":{"required":"包邮模式不能为空。"}}},{"id": "freightfreerecord-freight_id", "name": "FreightFreeRecord[freight_id]", "attribute": "freight_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"模板ID必须是整数。"}}},{"id": "freightfreerecord-free_mode", "name": "FreightFreeRecord[free_mode]", "attribute": "free_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"包邮模式必须是整数。"}}},{"id": "freightfreerecord-add_time", "name": "FreightFreeRecord[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "freightfreerecord-region_codes", "name": "FreightFreeRecord[region_codes]", "attribute": "region_codes", "rules": {"string":true,"messages":{"string":"地区必须是一条字符串。"}}},{"id": "freightfreerecord-region_names", "name": "FreightFreeRecord[region_names]", "attribute": "region_names", "rules": {"string":true,"messages":{"string":"必须是一条字符串。"}}},{"id": "freightfreerecord-region_path", "name": "FreightFreeRecord[region_path]", "attribute": "region_path", "rules": {"string":true,"messages":{"string":"Region Path必须是一条字符串。"}}},{"id": "freightfreerecord-free_money", "name": "FreightFreeRecord[free_money]", "attribute": "free_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"满足金额必须是一个数字。"}}},{"id": "freightfreerecord-free_mode", "name": "FreightFreeRecord[free_mode]", "attribute": "free_mode", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"包邮模式是无效的。"}}},]
</script>
    <script id="free_record_client_rules_1" type="text">
[{"id": "freightfreerecord-freight_id", "name": "FreightFreeRecord[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"模板ID不能为空。"}}},{"id": "freightfreerecord-region_codes", "name": "FreightFreeRecord[region_codes]", "attribute": "region_codes", "rules": {"required":true,"messages":{"required":"地区不能为空。"}}},{"id": "freightfreerecord-free_mode", "name": "FreightFreeRecord[free_mode]", "attribute": "free_mode", "rules": {"required":true,"messages":{"required":"包邮模式不能为空。"}}},{"id": "freightfreerecord-freight_id", "name": "FreightFreeRecord[freight_id]", "attribute": "freight_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"模板ID必须是整数。"}}},{"id": "freightfreerecord-free_mode", "name": "FreightFreeRecord[free_mode]", "attribute": "free_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"包邮模式必须是整数。"}}},{"id": "freightfreerecord-add_time", "name": "FreightFreeRecord[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "freightfreerecord-region_codes", "name": "FreightFreeRecord[region_codes]", "attribute": "region_codes", "rules": {"string":true,"messages":{"string":"地区必须是一条字符串。"}}},{"id": "freightfreerecord-region_names", "name": "FreightFreeRecord[region_names]", "attribute": "region_names", "rules": {"string":true,"messages":{"string":"必须是一条字符串。"}}},{"id": "freightfreerecord-region_path", "name": "FreightFreeRecord[region_path]", "attribute": "region_path", "rules": {"string":true,"messages":{"string":"Region Path必须是一条字符串。"}}},{"id": "freightfreerecord-free_money", "name": "FreightFreeRecord[free_money]", "attribute": "free_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"满足金额必须是一个数字。"}}},{"id": "freightfreerecord-free_number", "name": "FreightFreeRecord[free_number]", "attribute": "free_number", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"满足重量必须是一个数字。","min":"满足重量必须不小于0.1。","max":"满足重量必须不大于9999.9。"},"min":0.1,"max":9999.9}},{"id": "freightfreerecord-free_mode", "name": "FreightFreeRecord[free_mode]", "attribute": "free_mode", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"包邮模式是无效的。"}}},]
</script>
    <script id="free_record_client_rules_2" type="text">
[{"id": "freightfreerecord-freight_id", "name": "FreightFreeRecord[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"模板ID不能为空。"}}},{"id": "freightfreerecord-region_codes", "name": "FreightFreeRecord[region_codes]", "attribute": "region_codes", "rules": {"required":true,"messages":{"required":"地区不能为空。"}}},{"id": "freightfreerecord-free_mode", "name": "FreightFreeRecord[free_mode]", "attribute": "free_mode", "rules": {"required":true,"messages":{"required":"包邮模式不能为空。"}}},{"id": "freightfreerecord-freight_id", "name": "FreightFreeRecord[freight_id]", "attribute": "freight_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"模板ID必须是整数。"}}},{"id": "freightfreerecord-free_mode", "name": "FreightFreeRecord[free_mode]", "attribute": "free_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"包邮模式必须是整数。"}}},{"id": "freightfreerecord-add_time", "name": "FreightFreeRecord[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "freightfreerecord-region_codes", "name": "FreightFreeRecord[region_codes]", "attribute": "region_codes", "rules": {"string":true,"messages":{"string":"地区必须是一条字符串。"}}},{"id": "freightfreerecord-region_names", "name": "FreightFreeRecord[region_names]", "attribute": "region_names", "rules": {"string":true,"messages":{"string":"必须是一条字符串。"}}},{"id": "freightfreerecord-region_path", "name": "FreightFreeRecord[region_path]", "attribute": "region_path", "rules": {"string":true,"messages":{"string":"Region Path必须是一条字符串。"}}},{"id": "freightfreerecord-free_money", "name": "FreightFreeRecord[free_money]", "attribute": "free_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"满足金额必须是一个数字。"}}},{"id": "freightfreerecord-free_number", "name": "FreightFreeRecord[free_number]", "attribute": "free_number", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"满足体积必须是一个数字。","min":"满足体积必须不小于0.1。","max":"满足体积必须不大于9999.9。"},"min":0.1,"max":9999.9}},{"id": "freightfreerecord-free_mode", "name": "FreightFreeRecord[free_mode]", "attribute": "free_mode", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"包邮模式是无效的。"}}},]
</script>
    <script id="units" type="text">
[{"name":"\u4ef6\u6570","mark":"\u4ef6","start":"\u9996\u4ef6","plus":"\u7eed\u4ef6","free_start":"\u6ee1","free_end":"\u4ef6","free_items":["\u4ef6\u6570","\u91d1\u989d","\u4ef6\u6570+\u91d1\u989d","\u4ef6\u6570\u6216\u91d1\u989d"]},{"name":"\u91cd\u91cf","mark":"Kg","start":"\u9996\u91cd","plus":"\u7eed\u91cd","free_start":"\u5728","free_end":"Kg\u5185","free_items":["\u91cd\u91cf","\u91d1\u989d","\u91cd\u91cf+\u91d1\u989d","\u91cd\u91cf\u6216\u91d1\u989d"]},{"name":"\u4f53\u79ef","mark":"m<sup>3<\/sup>","start":"\u9996\u4f53\u79ef","plus":"\u7eed\u4f53\u79ef","free_start":"\u5728","free_end":"m<sup>3<\/sup>\u5185","free_items":["\u4f53\u79ef","\u91d1\u989d","\u4f53\u79ef+\u91d1\u989d","\u4f53\u79ef\u6216\u91d1\u989d"]}]
</script>
    <script type="text/javascript">
        // 当前已选择的地区
        var region_codes_now = [];
        // 不能选择的地区
        var region_codes_not = [];
        var validator = null;
        var units = $.parseJSON($("#units").html());

        function getValuation() {
            var value = $("[name='Freight[valuation]']:checked").val();
            if (value == undefined) {
                value = 0;
            }
            return value;
        }

        var valuation = 0;

        $().ready(function() {

            /**
             * 初始化validator默认值
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

                    if ($(element).parents(".freight-container").size() > 0) {
                        if ($("[id='freight_" + error_id + "']").size() > 0) {
                            return;
                        }
                        if ($(element).parents(".freight-container").find(".freight-handle-error").find("ul").size() == 0) {
                            $(element).parents(".freight-container").find(".freight-handle-error").html("<ul></ul>");
                        }
                        var error_dom = $("<li id='freight_"+error_id+"'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></li>");
                        $(element).parents(".freight-container").find("ul").append(error_dom);
                    } else if ($(element).parents(".free-container").size() > 0) {
                        if ($("[id='free_" + error_id + "']").size() > 0) {
                            return;
                        }
                        if ($(element).parents(".free-container").find(".freight-handle-error").find("ul").size() == 0) {
                            $(element).parents(".free-container").find(".freight-handle-error").html("<ul></ul>");
                        }
                        var error_dom = $("<li id='free_"+error_id+"'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></li>");
                        $(element).parents(".free-container").find("ul").append(error_dom);
                    } else {
                        if ($("[id='" + error_id + "']").size() > 0) {
                            return;
                        }
                        _errorPlacement.call(this, error, element);
                    }
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

                    if ($(element).parents(".freight-container").size() > 0) {
                        $("[id='freight_" + error_id + "']").remove();
                    } else if ($(element).parents(".free-container").size() > 0) {
                        $("[id='free_" + error_id + "']").remove();
                    }

                    if ($(element).parents().find(".freight-handle-error").find("li").size() == 0) {
                        $(element).parents().find(".freight-handle-error").find("ul").remove();
                    }

                    _success.call(this, error, element);
                }
            });

            valuation = getValuation();

            validator = $("#form1").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $.validator.addRules($("#record_client_rules_" + valuation).html());
            $.validator.addRules($("#free_record_client_rules_" + valuation).html());

            // 初始化地区选择器
            var regionselector = $("#region_container").regionselector({
                value: '{{ $info->region_code }}',
                select_class: 'form-control',
                check_all: false,
                change: function(value, names, is_last) {
                    $("#freight-region_code").val(value);
                    $("#freight-region_code").data("is_last", is_last);
                    $("#freight-region_code").valid();
                }
            });

            $("body").on("click", ".region-edit", function() {

                var target = this;

                region_codes_now = {};
                region_codes_not = {};

                var table = null;

                if ($(this).parents("#freight_table").size() > 0) {
                    table = $(this).parents("#freight_table");
                } else {
                    table = $(this).parents("#free_table");
                }

                $(table).find(".region-codes").each(function() {
                    var codes = $(this).val();
                    var names = $(this).siblings(".region-names").val();
                    codes = codes.split("|");
                    names = names.split("|");

                    if ($(this).val() == $(target).parents("td").find(".region-codes").val()) {
                        for (var i = 0; i < codes.length; i++) {
                            if (codes[i] != undefined && codes[i] != '') {
                                region_codes_now[codes[i]] = names[i];
                            }
                        }
                    } else {
                        for (var i = 0; i < codes.length; i++) {
                            if (codes[i] != undefined && codes[i] != '') {
                                region_codes_not[codes[i]] = names[i];
                            }
                        }
                    }

                });

                $.loading.start();

                $.open({
                    title: "地区选择",
                    width: "950px",
                    height: "500px",
                    ajax: {
                        url: "/shop/freight/region-picker"
                    },
                    btn: ['确定', '取消'],
                    success: function(object, index) {
                        $.loading.stop();
                    },
                    yes: function(index, object) {
                        var regions = [];
                        var region_codes = [];
                        var region_names = [];
                        $(object).find(".region-selected").find("a").each(function() {
                            var region_code = $(this).data("region-code");
                            var region_name = $(this).data("region-name");
                            regions.push({
                                region_code: region_code,
                                region_name: region_name,
                            });

                            region_names.push(region_name);
                            region_codes.push(region_code);
                        });

                        $(target).parents("tr").find(".region-names").val(region_names.join("|"));
                        $(target).parents("tr").find(".region-codes").val(region_codes.join("|"));

                        region_names = region_names.join("|");
                        $(target).parents("tr").find(".region-names-label").attr("title", region_names);
                        region_names = $.word_limit(region_names, 15, '...');
                        $(target).parents("tr").find(".region-names-label").html(region_names);

                        if (region_codes.length == 0) {
                            $(target).parents("tr").find(".region-names-label").html("未指定任何地区");
                        }

                        $.closeDialog(index);
                    },
                    onhide: function() {
                        $(".region-codes").each(function() {
                            $(this).valid();
                        });
                    }
                });

            });

            // 是否包邮的触发事件
            $("[name='Freight[is_free]']").find(":radio").on("click", function() {

                var is_free = $(this).val();
                var limit_sale = $("[name='Freight[limit_sale]:checked']").val();

                if (is_free == 1) {
                    $.msg("选择“卖家承担运费”后，所有区域的运费将设置为0元且原运费设置无法恢复，请保存原有运费设置。", {
                        time: 3000
                    });

                    $("#free_container").hide();

                    $(".start-num").prop("readonly", true).val(1);
                    $(".start-money").prop("readonly", true).val(0);
                    $(".plus-num").prop("readonly", true).val(1);
                    $(".plus-money").prop("readonly", true).val(0);

                } else if ($(this).val() == 0) {
                    $.msg("您的运费设置将变为未设置状态，请设置运费", {
                        time: 3000
                    });

                    $("#free_container").show();

                    $(".start-num").prop("readonly", false);
                    $(".start-money").prop("readonly", false);
                    $(".plus-num").prop("readonly", false);
                    $(".plus-money").prop("readonly", false);
                }
            });

            // 是否包邮的触发事件
            $("[name='Freight[valuation]']").find(":radio").on("click", function() {
                if ($(this).val() == valuation) {
                    return false;
                }
                var result = confirm('切换计价方式后，所设置当前模板的运输信息将被清空，确定继续么？');
                if (result == false) {
                    return false;
                }

                valuation = $(this).val();

                $("#free_table").find("tbody").html("");
                $("#freight_table").find("tbody").html("");
                $(".freight-handle-error").find("ul").html("");

                var unit = units[valuation];

                $(".unit_start").html(unit.start);
                $(".unit_plus").html(unit.plus);
                $(".unit_mark").html(unit.mark);

                validator = $("#form1").validate();
                // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                $.validator.addRules($("#client_rules").html());
                $.validator.addRules($("#record_client_rules_" + valuation).html());
                $.validator.addRules($("#free_record_client_rules_" + valuation).html());
            });

            $("#btn_submit").click(function() {

                var free_set = $("#freight-free_set").find("input:radio:checked").val();

                if (free_set == "0") {
                    // 移除包邮条件
                    $("#free_table").find("tbody").find("tr").remove();
                    $(".free-container").find(".freight-handle-error").find("li").remove();
                }

                if (!validator.form()) {
                    return;
                }

                var jsonData = $("#form1").serializeJson();

                var data = {
                    freight: jsonData.Freight,
                    records: [],
                    free_records: []
                };

                var default_exists = false;

                // 不区域限售则包含默认运费
                if (data.freight.limit_sale == 0) {
                    // 第一项必须是默认运费
                    data.records.push($(".freight-container").find(".default").serializeJson()['FreightRecord']);
                    default_exists = true;
                }

                // 自定义运费
                $("#freight_table").find("tbody").find("tr").each(function() {
                    var record = $(this).serializeJson()['FreightRecord'];
                    if (record && record.region_codes != 0 && $.trim(record.region_codes) != '') {
                        data.records.push(record);
                    }
                });

                if (data.records.length == 0) {
                    // 不包邮+区域限售则必须至少添加一套地区的运费
                    if ($("#freight_table").find("tbody").find("tr").size() == 0) {
                        $("#add_freight").click();
                        $("#freight_table").find("tbody").find("tr").find(":input").focus();
                    }
                    $.msg('您必须至少添加一条指定地区的运费！');
                    return;
                }

                if (data.freight.free_set == 1) {
                    // 包邮设置
                    // 自定义运费
                    $("#free_table").find("tbody").find("tr").each(function() {
                        var record = $(this).serializeJson()['FreightFreeRecord'];
                        if (record) {
                            data.free_records.push(record);
                        }
                    });
                }

                if (data.free_records.length > 0) {
                    data.freight.free_set = 1;
                } else {
                    data.freight.free_set = 0;
                }

                var url = $("#form1").attr("action");

                $.loading.start();

                $.post(url, data, function(result) {

                    $.loading.stop();

                    if (result.code == 0) {
                        $.msg(result.message, {}, function() {
                            $.loading.start();
                            $.go("/shop/freight/edit?id=" + result.data);
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

            });
        });
    </script>
    <script type="text/javascript">
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
            //$(".amap-fixed-info ul").mCustomScrollbar();
            $("#add_freight").click(function() {
                var html = $("#freight_template").html();
                var element = $($.parseHTML(html));
                var valuation = getValuation();
                $("#freight_table").find("tbody").append(element);

                var is_free = $("[name='Freight[is_free]']:checked").val();

                if (is_free == 1) {
                    $(".start-num").prop("readonly", true).val(1);
                    $(".start-money").prop("readonly", true).val(0);
                    $(".plus-num").prop("readonly", true).val(1);
                    $(".plus-money").prop("readonly", true).val(0);
                } else {
                    $(".start-num").prop("readonly", false);
                    $(".start-money").prop("readonly", false);
                    $(".plus-num").prop("readonly", false);
                    $(".plus-money").prop("readonly", false);
                }

                validator = $("#form1").validate();
                $.validator.addRules($("#client_rules").html());
                $.validator.addRules($("#record_client_rules_" + valuation).html());
                $.validator.addRules($("#free_record_client_rules_" + valuation).html());
            });

            $("body").on("click", "#freight_table :checkbox", function() {
                if ($(this).is(":checked")) {
                    $(this).parents("td").find(".cash_more").css("visibility", "visible");
                } else {
                    $(this).parents("td").find(".cash_more").css("visibility", "hidden");
                }
            });

            $("body").on("click", ".default :checkbox", function() {
                if ($(this).is(":checked")) {
                    $(this).parents(".default").find(".cash_more").css("visibility", "visible");
                } else {
                    $(this).parents(".default").find(".cash_more").css("visibility", "hidden");
                }
            });

            $("body").on("click", ".freight-remove", function() {
                var target = this;
                $.confirm("您确定要删除当前的地区运费设置吗？", function() {
                    $(target).parents("tr").remove();

                    $(".freight-handle-error").find("li").remove();
                });
            });

            $("#add_free").click(function() {
                var valuation = getValuation();
                var html = $("#free_template_" + valuation).html();
                var element = $($.parseHTML(html));
                $("#free_table").find("tbody").append(element);

                validator = $("#form1").validate();
                $.validator.addRules($("#client_rules").html());
                $.validator.addRules($("#record_client_rules_" + valuation).html());
                $.validator.addRules($("#free_record_client_rules_" + valuation).html());
            });

            $("body").on("click", ".free-remove", function() {
                var target = this;
                $.confirm("您确定要删除当前的地区包邮条件设置吗？", function() {
                    $(target).parents("tr").remove();

                    $(".freight-handle-error").find("li").remove();
                });
            });

            $("body").on("change", ".free-mode", function() {
                var valuation = getValuation();
                var html = $("#free_mode_" + $(this).val() + "_template").html();
                $(this).parents("tr").find(".free_condition").html(html);
                $.validator.addRules($("#free_record_client_rules_" + valuation).html());

                var valuation = getValuation();
                var unit = units[valuation];

                $(".unit_free_start").html(unit.free_start);
                $(".unit_free_end").html(unit.free_end);

                validator = $("#form1").validate();
                $.validator.addRules($("#client_rules").html());
                $.validator.addRules($("#record_client_rules_" + valuation).html());
                $.validator.addRules($("#free_record_client_rules_" + valuation).html());

                if ($(".free-container").find(".freight-handle-error").html() != "") {
                    $(".free-container").find(".freight-handle-error").html("");
                    $(".free-container").find(":input").valid();
                }
            });

            $(".is-free-condition").find(":radio").change(function() {
                if ($(this).val() == 1) {
                    $(".free-container").show();
                } else if ($(this).val() == 0) {
                    $(".free-container").hide();
                }
            });

            $("#freight-limit_sale").find(":radio").change(function() {
                var limit_sale = $(this).val();

                if (limit_sale == 1) {
                    $("#default_record").hide();
                } else {
                    $("#default_record").show();
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop