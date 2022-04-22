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
                {{ csrf_field() }}
                <!-- 模板ID -->
                <input type="hidden" id="freight-freight_id" class="form-control" name="Freight[freight_id]" value="{{ $info->freight_id }}">
                <!-- 模板类型 -->
                <input type="hidden" id="freight-freight_type" class="form-control" name="Freight[freight_type]" value="{{ $info->freight_type }}">
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

                <!-- 区域限售 -->
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



                                            @if(count($info->freightRecord) > 1)
                                                @foreach($info->freightRecord as $fr)
                                                    @if($fr->is_default != 1)
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
                                                                        <td><input type="text" id="freightrecord-start_num" class="form-control small sm-height pull-none start-num" name="FreightRecord[start_num]" value="{{ $fr->start_num }}"></td>
                                                                        <td><input type="text" id="freightrecord-start_money" class="form-control small sm-height pull-none start-money" name="FreightRecord[start_money]" value="{{ $fr->start_money }}"></td>
                                                                        <td><input type="text" id="freightrecord-plus_num" class="form-control small sm-height pull-none plus-num" name="FreightRecord[plus_num]" value="{{ $fr->plus_num }}"></td>
                                                                        <td><input type="text" id="freightrecord-plus_money" class="form-control small sm-height pull-none plus-money" name="FreightRecord[plus_money]" value="{{ $fr->plus_money }}"></td>
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
                                                @endforeach
                                            @else
                                                @foreach($info->freightRecord as $fr)
                                                    @if($fr->is_default == 1)
                                                        <div id="default_record" style="width: 100%; display: block;">
                                                            <div class="simple-form-field" >
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">

                                                                        <span class="ng-binding">默认运费：</span>
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <div class="form-control-box">

                                                                            <!--选择快递的弹框 star-->
                                                                            <div class="postage-detail freight-container m-t-0 m-b-3" style="width: 780px;">
                                                                                <div class="entity">
                                                                                    <div class="default">
                                                                                        <input type="hidden" id="freightrecord-is_default" class="form-control small sm-height pull-none" name="FreightRecord[is_default]" value="{{ $fr->is_default }}">
                                                                                        <div style="float: left;">
                                                                                            默认运费：

                                                                                            <input type="text" id="freightrecord-start_num" class="form-control small sm-height pull-none start-num" name="FreightRecord[start_num]" value="{{ $fr->start_num }}">

                                                                                            <span class="unit_mark">件</span>
                                                                                            内，

                                                                                            <input type="text" id="freightrecord-start_money" class="form-control small sm-height pull-none start-money" name="FreightRecord[start_money]" value="{{ $fr->start_money }}">

                                                                                            元， 每增加

                                                                                            <input type="text" id="freightrecord-plus_num" class="form-control small sm-height pull-none plus-num" name="FreightRecord[plus_num]" value="{{ $fr->plus_num }}">

                                                                                            <span class="unit_mark">件</span>
                                                                                            ， 增加运费

                                                                                            <input type="text" id="freightrecord-plus_money" class="form-control small sm-height pull-none plus-money" name="FreightRecord[plus_money]" value="{{ $fr->plus_money }}">

                                                                                            元，

                                                                                            <input type="hidden" name="FreightRecord[is_cash]" value="0">
                                                                                            <label><input type="checkbox" id="freightrecord-is_cash" class="cur-p" name="FreightRecord[is_cash]" value="1" @if($fr->is_cash == 1) checked @endif> 支持货到付款</label>
                                                                                        </div>



                                                                                        <span class="cash_more" style="@if($fr->is_cash == 0) visibility: hidden; @endif">
                                                            ，需加价：

                                                            <input type="text" id="freightrecord-cash_more" class="form-control small sm-height pull-none" name="FreightRecord[cash_more]" value="{{ $fr->cash_more }}">

                                                            元
                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="help-block help-block-t">除指定地区外，其余地区的运费采用“默认运费”，如果全国统一运费，则只需设置默认运费即可。</div>

                                                                        </div>

                                                                        <div class="help-block help-block-t"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="help-block help-block-t">除指定地区外，其余地区的运费采用“默认运费”，如果全国统一运费，则只需设置默认运费即可。</div>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>



                    <div id="free_container">
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
                                        <div class="free-shipping free-container"style="width: 770px; @if($info->free_set == 0) display: none; @endif">
                                            <div class="table-responsive">
                                                <table id="free_table" class="table table-hover m-b-0">
                                                    <thead>
                                                    <tr>
                                                        <th class="w200">选择地区</th>
                                                        <th>包邮模式</th>
                                                        <th>设置包邮条件</th>
                                                        <th class="handle">操作</th>
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
                                                    为指定配送区域设置包邮条件
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
    <style>
        .modal-footer {
            margin: 0px;
        }
    </style>

    <!--点击按钮为表格增加行-->
    <script id="freight_edit_template" type="text">
<li class="freight-records-item" data-id="#0#" data-color="#color#">
	<div class="amap-header edit">
		<label class="m-b-5">
			<span class="freight-records-item-color block #color#"></span>
			<span class="m-l-10">
				<input type="hidden" id="freightrecord-record_id" class="record-id" name="FreightRecord[record_id]">
				<input type="hidden" id="freightrecord-region_codes" class="region-codes" name="FreightRecord[region_codes]">
				<input type="hidden" id="freightrecord-region_desc" class="region-desc" name="FreightRecord[region_desc]">
				<input type="hidden" id="freightrecord-region_color" class="region-color" name="FreightRecord[region_color]" value="#color#">
				<input type="hidden" id="freightrecord-region_path" class="region-path" name="FreightRecord[region_path]">
				<input type="text" id="freightrecord-region_names" class="form-control form-control-sm w100 region-names" name="FreightRecord[region_names]" value="区域#0#" data-value="区域#0#">
			</span>
		</label>
		<a class="c-red pull-right m-t-5 freight-records-item-remove" href="javascript:void(0);" title="点击移除配送区域">删除</a>
		<a class="pull-right m-t-5 freight-records-item-down" href="javascript:void(0);" title="点击向下移动配送区域">下移</a>
		<a class="pull-right m-t-5 freight-records-item-up" href="javascript:void(0);" title="点击向上移动配送区域">上移</a>
		<a class="pull-right m-t-5 freight-records-item-edit" href="javascript:void(0);" title="点击编辑此配送区域绑定的地区">地区</a>
	</div>
	<div class="amap-body edit">
		<div class="over-hidden">
				<div class="pull-left">
					<span class="unit_start">首件</span>：
					<input type="text" id="freightrecord-start_num" class="form-control form-control-sm w70 start-num" name="FreightRecord[start_num]" value="1">
					<span class="unit_mark">件</span>
				</div>
				<div class="pull-right">
				收费：<input type="text" id="freightrecord-start_money" class="form-control form-control-sm w70 m-r-5 start-money" name="FreightRecord[start_money]" value="0">元
				</div>
			</div>
			<div class="over-hidden m-t-5 m-b-5">
				<div class="pull-left">
					<span class="unit_plus">续件</span>：
					<input type="text" id="freightrecord-plus_num" class="form-control form-control-sm w70 plus-num" name="FreightRecord[plus_num]" value="1">
					<span class="unit_mark">件</span>
				</div>
				<div class="pull-right">
				收费：<input type="text" id="freightrecord-plus_money" class="form-control form-control-sm w70 m-r-5 plus-money" name="FreightRecord[plus_money]" value="0">元
				</div>
			</div>
		<input type="hidden" name="FreightRecord[is_cash]" value="0"><label><input type="checkbox" id="freightrecord-is_cash" class="cur-p is-cash" name="FreightRecord[is_cash]" value="1"> 支持货到付款</label>
		<label>
			，加
			<input type="text" id="freightrecord-cash_more" class="form-control form-control-sm w60 m-l-5 m-r-5 cash-more" name="FreightRecord[cash_more]" value="0">
			元
		</label>
		<p class="region-names-label" title="此地区用于在PC端等无法获取用户经纬度时，方便根据用户的所选择的省市区县等位置来匹配当前的所画地区"></p>
		<!-- 报错信息 -->
		<div class="over-hidden freight-handle-error"></div>
	</div>
	<!-- 查看 -->
	<div class="amap-header view">
		<label>
			<span class="freight-records-item-color block #color#"></span>
			<span class="m-l-10 region-names">区域#0#</span>
		</label>
		<label class="pull-right hide m-t-5">支持货到付款</label>
	</div>
	<div class="amap-body view">
			<div class="over-hidden">
				<div class="pull-left">
					<span class="unit_start">首件</span>：
					<span class="start-num">#start_num#</span>
					<span class="unit_mark">件</span>
				</div>
				<div class="pull-right">
					<span>收费：</span>
					<span class="start-money">#start_money#</span>元
				</div>
			</div>
			<div class="over-hidden m-t-5 m-b-5">
				<div class="pull-left">
					<span class="unit_plus">续件</span>：
					<span class="plus-num">#plus_num#</span>
					<span class="unit_mark">件</span>
				</div>
				<div class="pull-right">
					<span>续费：</span>
					<span class="plus-money">#plus_money#</span>元
			    </div>
			</div>
			<p class="region-names-label" title="此地区用于在PC端等无法获取用户经纬度时，方便根据用户的所选择的省市区县等位置来匹配当前的所画地区"></p>
		</div>
	</div>
</li>
</script>
    <!-- 包邮模板 -->
    <script id="free_template_0" type=text>
<tr>
	<td class="free-area free-contion">

		<input type="hidden" id="freightfreerecord-region_codes" class="region-codes" name="FreightFreeRecord[region_codes]">

		<input type="hidden" id="freightfreerecord-region_path" class="region-path" name="FreightFreeRecord[region_path]">

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

		<input type="hidden" id="freightfreerecord-region_path" class="region-path" name="FreightFreeRecord[region_path]">

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

		<input type="hidden" id="freightfreerecord-region_path" class="region-path" name="FreightFreeRecord[region_path]">

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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
    <!-- 地区 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180710"></script>
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
        var region_codes = [];
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

                    if ($(element).parents(".freight-records-item").size() > 0) {
                        if ($("[id='freight_" + error_id + "']").size() > 0) {
                            return;
                        }
                        var target = $(element).parents(".freight-records-item").find(".freight-handle-error");
                        var error_dom = $("<span id='freight_"+error_id+"' class='form-control-error'><i class='fa fa-warning'></i>" + error_msg + "</span>");
                        $(target).append(error_dom);
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

                    if ($(element).parents(".freight-records-item").size() > 0) {
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
                value: '11,01,05',
                select_class: 'form-control',
                check_all: false,
                change: function(value, names, is_last) {
                    $("#freight-region_code").val(value);
                    $("#freight-region_code").data("is_last", is_last);
                    $("#freight-region_code").valid();
                }
            });

            // 点击包邮编辑按钮
            $("body").on("click", ".region-edit", function() {

                var id_list = [];

                $("#free_table").find("tbody").find("tr").each(function() {
                    id_list[$(this).data("id")] = $(this).data("id");
                });

                var area_list = [];

                var html = "<div class='over-hidden p-20'>";

                if ($(".freight-records-item").size() > 0) {
                    $(".freight-records-item").each(function() {
                        var id = $(this).data("id");
                        var color = $(this).data("color");
                        if (id_list[id] == undefined) {
                            var code = $(this).find(".edit").find(".region-codes").val();
                            var name = $(this).find(".edit").find(".region-names").val();
                            var path = $(this).find(".edit").find(".region-path").val();
                            var color = $(this).find(".edit").find(".region-color").val();
                            html += "<a class='special-check' href='javascript:;' data-id='" + id + "' title='" + name + "'><label><span class='block " + color + "'></span><input type='radio' class='chkValue' name='recored' value=" + id + "'>" + name + "</label></a>";
                            area_list[id] = {
                                region_codes: code,
                                region_names: name,
                                region_path: path,
                                region_color: color
                            };
                        }
                    });

                    if (area_list.length == 0) {
                        $.msg("已经没有其他的配送区域可供选择，请添加新的配送区域！");
                        return;
                    }
                } else {
                    $.msg("您还没有添加任何配送区域！");
                    return;
                }

                var tr_obj = $(this).parents("tr");

                html += "</div>";

                $.open({
                    type: 1,
                    width: "480px",
                    height: "",
                    title: "选择配送区域",
                    content: html,
                    btn: ['确定', '取消'],
                    yes: function(index, object) {
                        var id = $(object).find(".selected").data("id");

                        var data = area_list[id];

                        if ($.trim(id) != "") {
                            $(tr_obj).data("id", id);
                            $(tr_obj).addClass("freight-free-record-" + id);
                            $(tr_obj).find(".region-codes").val(data.region_codes);
                            $(tr_obj).find(".region-names").val(data.region_names);
                            var label = '<span class="block '+data.region_color+'"></span>' + data.region_names;
                            $(tr_obj).find(".region-names-label").html(label);
                            $(tr_obj).find(".region-names-label").attr("title", data.region_names);
                        }

                        $.closeDialog(index);
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
                $(".freight-records-item-remove").click();
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

                var record_list = [];
                var sort = 0;

                // 自定义运费
                $(".freight-records-item").each(function() {
                    var record = $(this).serializeJson()['FreightRecord'];

                    var id = $(this).data("id");
                    var color = $(this).data("color");
                    var editor = $(this).data("editor");
                    var polygon = $(this).data("polygon");
                    // 定义排序
                    record.sort = sort++;

                    data.records.push(record);

                    record_list[id] = record;
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

                    var free_sort = 0;

                    // 包邮设置
                    // 自定义运费
                    $("#free_table").find("tbody").find("tr").each(function() {

                        var id = $(this).data("id");

                        if (record_list[id] != undefined) {
                            var record = $(this).serializeJson()['FreightFreeRecord'];
                            if (record) {
                                record.region_path = record_list[id].region_path;
                                record.region_names = record_list[id].region_names;
                                record.region_codes = record_list[id].region_codes;
                                record.region_desc = record_list[id].region_desc;
                                record.sort = free_sort++;
                                data.free_records.push(record);
                            }
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
                    if (result.code == 0) {
                        $.msg(result.message, {}, function() {
                            $.loading.start();
                            $.go("/shop/freight/edit.html?id=" + result.data);
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });

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
            //特殊单选区域切换
            $("body").on("click", ".special-check", function() {
                $(this).addClass("selected").siblings("a").removeClass("selected");
            });

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

            // 点击添加配送区域包邮条件：选择区域
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
    <!-- 地图操作JS -->
    <script type="text/javascript">
        function mapToggle() {
            if ($('.amap-container').hasClass('toggle')) {

                // 点击还原

                $(".seller-head").css({
                    "z-index": "9999"
                });
                $(".style-seller").css({
                    "overflow": "auto"
                });
                $(".amap-container").removeClass('toggle');
                $(".amap-fixed-info").css("width", '250px');
                $(".amap-fixed-box ul").css("max-height", '250px');
                $("#btn_edit_area").show();
                $("#btn_add_area").hide();
                $("#btn_ok").hide();

                $(".freight-records-item .view").show();
                $(".freight-records-item .edit").hide();

                // 遍历赋值
                $(".freight-records-item").each(function() {
                    var editor = $(this).data("editor");
                    var polygon = $(this).data("polygon");
                    if (editor) {
                        editor.close();
                    }
                    if (polygon) {
                        polygon.setDraggable(false);
                    }

                    var target = $(this);

                    var list = ['.region-names', '.start-num', '.start-money', '.plus-num', '.plus-money'];

                    for (var i = 0; i < list.length; i++) {
                        var value = $(target).find(".edit").find(list[i]).val();
                        $(target).find(".view").find(list[i]).html(value);
                    }
                });

                $(".search-fixed-box").hide();
            } else {

                // 点击最大化

                $(".seller-head").css({
                    "z-index": "1"
                });
                $(".style-seller").css({
                    "overflow": "hidden"
                });
                $('.amap-container').addClass('toggle');
                $(".amap-fixed-info").css("width", '340px');
                $(".amap-fixed-box ul").css("max-height", '470px');

                $("#btn_edit_area").hide();
                $("#btn_add_area").show();
                $("#btn_ok").show();

                $(".freight-records-item .view").hide();
                $(".freight-records-item .edit").show();

                $(".search-fixed-box").show();
            }
        }

        // 点击编辑配送区域按钮
        $("#btn_edit_area").click(function() {
            mapToggle();
        });
        // 点击确定按钮
        $("#btn_ok").click(function() {

            // 检查输入
            var is_valid = true;

            var element = null;

            $(".freight-records-item").each(function() {

                $(this).find(":input").not(".region-codes").not(".region-names").not(".region-desc").each(function() {
                    if ($(this).valid() == false) {
                        is_valid = false;

                        if (element == null) {
                            element = this;
                        }
                    }
                });

                if (is_valid) {
                    var target = this;
                    var id = $(this).data("id");
                    var polygon = $(target).data("polygon");

                    if (polygon) {
                        var path = polygon.getPath();

                        var region_path = [];

                        for (var i = 0; i < path.length; i++) {
                            region_path.push(path[i].lng + "," + path[i].lat);
                        }

                        region_path = region_path.join("|");

                        var free_record_tr = $("#free_table").find(".freight-free-record-" + id);

                        if ($(this).find(".region-path").val() != region_path || $(target).find(".region-codes").val() == "" || $(target).find(".region-codes").val() == "0") {

                            $(this).find(".region-path").val(region_path);

                            // 如果地区代码为空或者为全国则定位
                            if($(target).find(".region-codes").val() == "" || $(target).find(".region-codes").val() == "0"){

                                var center = polygon.getBounds().getCenter();

                                getRegionCode(center.lng, center.lat, function(region_code, region_name) {
                                    $(target).find(".region-codes").val(region_code);
                                    $(target).find(".region-desc").val(region_name);
                                    $(target).find(".freight-records-item-color").attr("title", region_name);
                                    $(target).find(".region-names-label").html("地区：" + region_name);

                                    if ($(free_record_tr).size() > 0) {
                                        $(free_record_tr).find(".region-codes").val(region_code)
                                    }
                                });
                            }
                        }

                        if ($(free_record_tr).size() > 0) {
                            $(free_record_tr).find(".region-path").val(region_path);
                            $(free_record_tr).find(".region-names").val($(this).find(".region-names").val());
                        }
                    }
                }
            });

            if (is_valid) {
                mapToggle();
            } else {
                $(element).focus();
                $.msg("运费设置存在错误！", {
                    time: 2000
                });
            }
        });
    </script>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=fa78e2878a855b797089dfd08d5ac961&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.PlaceSearch"></script>
    <script type="text/javascript">
        //当前已选择的地区
        var region_codes_now = [];
        // 不能选择的地区
        var region_codes_not = [];
        // 地区序列号
        var area_index = 0;
        var zIndex = 11;
        function addArea(map, path, color, data) {

            if (area_index == 0) {
                area_index = $(".freight-records-item").size();
            }

            var is_new = false;

            if (path == null) {

                is_new = true;

                center = map.getCenter();

                var lng = center.lng;
                var lat = center.lat;

                var lng_dif = 0.020;
                var lat_dif = 0.015;

                //构建多边形经纬度坐标数组
                path = [];
                path.push([lng - lng_dif, lat - lat_dif]);
                path.push([lng + lng_dif, lat - lat_dif]);
                path.push([lng + lng_dif, lat + lat_dif]);
                path.push([lng - lng_dif, lat + lat_dif]);
            } else {

                var free_record_tr = $("#free_table").find("tbody tr").filter("[data-path='" + path + "']");

                if ($(free_record_tr).size() > 0) {
                    $(free_record_tr).data("id", area_index + 1);
                    if (!$(free_record_tr).hasClass("freight-free-record-" + (area_index + 1))) {
                        $(free_record_tr).addClass("freight-free-record-" + (area_index + 1));
                    }

                    var label = $(free_record_tr).find(".region-names-label").html();

                    $(free_record_tr).find(".region-names-label").html('<span class="block '+color+'"></span>' + label);
                    $(free_record_tr).find(".region-names-label").attr("title", label);
                }

                path = path.split("|");

                for (var i = 0; i < path.length; i++) {
                    var item = path[i].split(",");
                    if (isNaN(item[0]) || isNaN(item[1])) {
                        continue;
                    }
                    path[i] = [item[0], item[1]];
                }
            }

            // 颜色
            var colors = eval('[["blue","#93C1FC","#0778E2"],["red","#FF9486","#BB412D"],["young","#A3E1B8","#47C370"],["light-blue","#A4DCDE","#58C9CD"],["brown","#F4E08E","#E9C11D"],["green","#A7EE99","#4FDC33"],["orange","#FFBF80","#FF7F00"],["purple","#BDA3EF","#7B47DF"],["powder","#EFA3DB","#DF47B6"]]');

            if (color == null) {
                // 获取颜色
                var index = area_index % colors.length;
                color = colors[index];
            } else {
                for (var i = 0; i < colors.length; i++) {
                    if (colors[i][0] == color) {
                        color = colors[i];
                        break;
                    }
                }
            }

            // 创建多边形
            var polygon = new AMap.Polygon({
                map: map,
                path: path,
                strokeColor: color[2],
                strokeOpacity: 1,
                strokeWeight: 3,
                fillColor: color[1],
                fillOpacity: 0.35
            });

            map.setFitView();

            var editor = new AMap.PolyEditor(map, polygon);

            if (is_new) {
                // 新添加的开启编辑功能
                editor.open();
                polygon.setDraggable(true);
            }

            // 点击开启编辑功能
            polygon.on("click", function(e) {
                if ($('.amap-container').hasClass('toggle')) {
                    editor.open();
                    polygon.setDraggable(true);
                    polygon.setOptions({
                        zIndex: zIndex++
                    });
                }
            });

            // 点击地图其他地方关闭编辑功能
            map.on("click", function() {
                if (polygon) {
                    editor.close();
                    polygon.setDraggable(false);
                }
            });

            // 定位第一个
            if (area_index == 0) {
                var bounds = polygon.getBounds();
                map.setCenter(bounds.getCenter());
            }

            var template = $("#freight_edit_template").html();
            template = template.replace(/#0#/g, area_index + 1);
            template = template.replace(/#color#/g, color[0]);

            var element = $($.parseHTML(template));

            $(element).data('editor', editor);
            $(element).data('polygon', polygon);

            if (is_new) {
                $(element).find(".view").hide();
                $(element).find(".edit").show();
            } else {
                $(element).find(".view").show();
                $(element).find(".edit").hide();
            }

            $(element).find(":input").filter(".region-names").blur(function() {
                if ($.trim($(this).val()) == "") {
                    $(this).val($(this).data("value"));
                }
            });

            if (data) {
                template = template.replace(/#s#/g, color[0]);

                var list = [];

                list.push(['record_id', '.record-id']);
                list.push(['region_name', '.region-names']);
                list.push(['start_num', '.start-num']);
                list.push(['start_money', '.start-money']);
                list.push(['plus_num', '.plus-num']);
                list.push(['plus_money', '.plus-money']);
                list.push(['region_codes', '.region-codes']);
                list.push(['region_names', '.region-names']);
                list.push(['region_path', '.region-path']);
                list.push(['region_desc', '.region-desc']);

                for (var i = 0; i < list.length; i++) {
                    var item = list[i];

                    if (data[item[0]]) {
                        $(element).find(".edit").find(item[1]).val(data[item[0]]);
                        $(element).find(".view").find(item[1]).html(data[item[0]]);

                        if (item[0] == "region_desc") {
                            $(element).find(".edit").find(".freight-records-item-color").attr("title", data[item[0]]);
                            $(element).find(".view").find(".freight-records-item-color").attr("title", data[item[0]]);

                            $(element).find(".edit").find(".region-names-label").html("地区：" +　data[item[0]]);
                            $(element).find(".view").find(".region-names-label").html("地区：" + data[item[0]]);
                        }
                    }
                }

                if (data.is_cash == 1) {
                    $(element).find(".edit").find(".is-cash").prop("checked", true);
                    $(element).find(".edit").find(".cash-more").val(data.cash_more);
                } else {
                    $(element).find(".edit").find(".is-cash").prop("checked", false);
                    $(element).find(".edit").find(".cash-more").val(0);
                }
            }

            var units = $.parseJSON($("#units").html());
            var unit = units[valuation];

            $(element).find(".unit_start").html(unit.start);
            $(element).find(".unit_plus").html(unit.plus);
            $(element).find(".unit_mark").html(unit.mark);

            $(".freight-records-edit ul").append(element);
            // 无记录隐藏
            $(".freight-records-none").hide();

            // 区域索引+1
            area_index++;
        }

        // 根据经纬度获取地理信息
        function getRegionCode(lng, lat, callback) {
            var geocoder = new AMap.Geocoder({
                radius: 1000,
                extensions: "all"
            });
            geocoder.getAddress([lng, lat], function(status, result) {

                var region_code = "";
                var region_name = "";

                if (status === 'complete' && result.info === 'OK') {
                    region_code = result.regeocode.addressComponent.adcode;

                    if(result.regeocode.addressComponent.district){
                        region_name = result.regeocode.addressComponent.district;
                    }else if(result.regeocode.addressComponent.city){
                        region_name = result.regeocode.addressComponent.city;
                    }else if(result.regeocode.addressComponent.province){
                        region_name = result.regeocode.addressComponent.province;
                    }else{
                        region_name = result.regeocode.formattedAddress;
                    }

                    var codes = [];

                    for (var i = 0; i < region_code.length; i = i + 2) {
                        codes.push(region_code.charAt(i) + "" + region_code.charAt(i + 1));

                        if (codes.length == 3) {
                            break;
                        }
                    }

                    region_code = codes.join(",");
                } else {
                    $.alert("访问高德地图服务接口失败！请联系系统管理员检查平台方是否在高德开放平台创建了web端应用并授权当前网址可以访问！");
                }

                if ($.isFunction(callback)) {
                    callback.call(result, region_code, region_name);
                }
            });
        }

        $().ready(function() {

            var map = null;
            // 经度
            var shop_lng = "116.391218";
            //纬度
            var shop_lat = "39.906367";
            var mark_title = "店铺所在位置";

            //加载地图，调用浏览器定位服务
            map = new AMap.Map("mapContainer", {
                level: 17,
                // 缩放级别
                zooms: [8, 18],
                resizeEnable: true
            });

            if ($.trim(shop_lng) != "" && $.trim(shop_lat) != "") {
                map.setCenter([shop_lng, shop_lat]);
            } else if ("0" == 0) {
                //当前位置
                map.plugin('AMap.Geolocation', function() {
                    geolocation = new AMap.Geolocation({
                        enableHighAccuracy: true,//是否使用高精度定位，默认:true
                        timeout: 10000, //超过10秒后停止定位，默认：无穷大
                        buttonOffset: new AMap.Pixel(10, 20),//定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
                        zoomToAccuracy: true, //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
                        buttonPosition: 'RB'
                    });
                    map.addControl(geolocation);
                    geolocation.getCurrentPosition();
                });

                mark_title = "您尚未设置店铺位置，当前为您所在的位置";
            }

            map.addControl(new AMap.Scale({
                visible: true
            }));

            // 获取中心点
            var center = map.getCenter();

            // 给地图添加点标记等覆盖物
            var marker = new AMap.Marker({
                map: map,
                position: [center.lng, center.lat],//marker所在的位置
                animation: 'AMAP_ANIMATION_DROP',
                title: mark_title,
            });

            // 点击添加配送区域
            $("#btn_add_area").click(function() {
                addArea(map, null, null, []);
            });

            // 点击让配送区域居中
            $("body").on("click", ".freight-records-item", function() {
                var polygon = $(this).data("polygon");
                if (polygon) {
                    var bounds = polygon.getBounds();
                    map.setCenter(bounds.getCenter());
                    // 置顶
                    polygon.setOptions({
                        zIndex: zIndex++
                    });
                }
            });

            // 点击移除配送区域
            $("body").on("click", ".freight-records-item-remove", function() {
                var target = $(this).parents(".freight-records-item");
                var id = $(target).data("id");
                var editor = $(target).data("editor");
                var polygon = $(target).data("polygon");
                if (editor) {
                    editor.close();
                }
                if (polygon) {
                    polygon.hide();
                }
                target.remove();

                // 移除包邮条件
                $(".freight-free-record-" + id).remove();

                var template = '<p class="null">暂无配送区域</p>';

                if ($(".freight-records-item").size() == 0) {
                    $(".freight-records-none").show();
                } else {
                    $(".freight-records-none").hide();
                }
            });

            // 点击向上移动配送区域
            $("body").on("click", ".freight-records-item-up", function() {
                var target = $(this).parents(".freight-records-item");
                var prev = $(target).prev(".freight-records-item");

                if ($(prev).size() == 0) {
                    $.msg("已经是第一个了，不能再上移了！");
                    return;
                }

                $(prev).before(target);
            });

            // 点击向下移动配送区域
            $("body").on("click", ".freight-records-item-down", function() {
                var target = $(this).parents(".freight-records-item");
                var next = $(target).next(".freight-records-item");

                if ($(next).size() == 0) {
                    $.msg("已经是最后一个了，不能再下移了！");
                    return;
                }

                $(next).after(target);
            });

            //
            var region_search_name = null;
            var region_search_adcode = null;
            var region_search_center = null;

            // 初始化地区选择器
            var regionsearch = $(".region-search-container").regionselector({
                value: null,
                select_class: 'form-control form-control-xs',
                check_all: false,
                change: function(value, names, is_last, data) {
                    region_search_adcode = value.split(",", 3).join();
                    region_search_name = names.join("");
                    region_search_center = data ? data.center : null;
                }
            });

            $(".keywords-search").click(function() {

                var address = $("#keywords").val();

                if ($.trim(address) == "") {
                    $("#keywords").focus();
                    $.msg("关键词不能为空！");
                    return;
                }

                // 构造地点查询类
                var placeSearch = new AMap.PlaceSearch({
                    map: map,
                    citylimit: true,
                    pageSize: 1,
                });
                // 设置城市
                placeSearch.setCity(null);
                // 关键字查询查询
                placeSearch.search(address, function(status, result) {
                    if (result.poiList) {
                        var poi = result.poiList.pois[0];
                        var position = poi.location;
                    } else {
                        if (result == "INSUFFICIENT_ABROAD_PRIVILEGES") {
                            console.info("高德地图接口请求：" + status + " - " + result);
                        }
                    }
                });
            });

            var search_mark = null;

            $(".region-search").click(function() {

                if (search_mark) {
                    search_mark.hide();
                }

                map.setZoom(17);

                if ($.trim(region_search_center) != "") {
                    var position = region_search_center.split(",");
                    map.setCenter(position);
                    // 给地图添加点标记等覆盖物
                    search_mark = new AMap.Marker({
                        map: map,
                        position: position,//marker所在的位置
                        animation: 'AMAP_ANIMATION_DROP',
                        title: region_search_name,
                    });
                } else {
                    // 构造地点查询类
                    var placeSearch = new AMap.PlaceSearch({
                        map: map,
                        citylimit: true,
                        pageSize: 1,
                    });
                    // 设置城市
                    placeSearch.setCity(region_search_adcode);
                    // 关键字查询查询
                    placeSearch.search(region_search_name, function(status, result) {
                        if (result.poiList) {
                            var poi = result.poiList.pois[0];
                            var position = poi.location;
                        } else {
                            if (result == "INSUFFICIENT_ABROAD_PRIVILEGES") {
                                console.info("高德地图接口请求：" + status + " - " + result);
                            }
                        }
                    });
                }
            });

            $("body").on("click", ".freight-records-item-edit", function() {

                var target = this;
                var parent = $(target).parents(".freight-records-item");

                region_codes_now = {};
                region_codes_not = {};

                $(".freight-records-edit").find(".region-codes").each(function() {
                    var codes = $(this).val();
                    var names = $(this).siblings(".region-desc").val();
                    codes = codes.split("|");
                    names = names.split("|");

                    if ($(this).val() == $(parent).find(".region-codes").val()) {
                        for (var i = 0; i < codes.length; i++) {
                            if (codes[i] != undefined && codes[i] != '') {
                                region_codes_now[codes[i]] = names[i];
                            }
                        }
                    } else {
                        for (var i = 0; i < codes.length; i++) {
                            if (codes[i] != undefined && codes[i] != '') {
                                // region_codes_not[codes[i]] = names[i];
                            }
                        }
                    }

                });

                $.loading.start();

                $.open({
                    title: "地区选择",
                    width: "950px",
                    height: "520px",
                    ajax: {
                        url: "/shop/freight/region-picker.html"
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

                        $(parent).find(".region-desc").val(region_names.join("|"));
                        $(parent).find(".region-codes").val(region_codes.join("|"));

                        region_names = region_names.join("|");

                        if (region_codes.length == 0) {
                            $(parent).find(".freight-records-item-color").attr("title", "未指定任何地区");
                            $(parent).find(".region-names-label").html("地区：未指定任何地区");
                        } else {
                            $(parent).find(".freight-records-item-color").attr("title", region_names);
                            $(parent).find(".region-names-label").html("地区：" + region_names);
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

        });
        $().ready(function() {
            $(".direntry").click(function() {
                $(".real-height-box").slideDown();
            });
            $(".close-btn").click(function() {
                $(".real-height-box").slideUp();
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop