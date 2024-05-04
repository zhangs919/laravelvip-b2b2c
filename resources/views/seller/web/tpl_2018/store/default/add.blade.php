{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="StoreModel" class="form-horizontal" name="StoreModel" action="/store/default/add" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 网点ID  -->
            <input type="hidden" id="storemodel-store_id" class="form-control" name="StoreModel[store_id]" value="{{ $info->store_id ?? '' }}">
            <!-- 网点名称  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-store_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">网点名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="storemodel-store_name" class="form-control" name="StoreModel[store_name]" value="{{ $info->store_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">不超过20个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 绑定网点管理员  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-user_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding"> 绑定网点管理员：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            @if(!isset($info->store_id))
                                <input type="hidden" name="StoreModel[user_type]" value="0">
                                <div id="storemodel-user_type" class="" name="StoreModel[user_type]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[user_type]" value="0" checked> 会员</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[user_type]" value="1"> 店铺管理员</label>
                                </div>
                                <div id="user_type_0" class="m-t-10">
                                    <input type="text" id="storemodel-user_account" class="form-control" name="StoreModel[user_account]" placeholder="会员帐号/手机号/邮箱" data-rule-required="true" data-msg="网点管理员不能为空">
                                </div>
                                <div id="user_type_1" class="m-t-10" style="display: none;"></div>
                            @else
                                <input type="hidden" id="storemodel-user_id" class="form-control" name="StoreModel[user_id]" value="{{ $info->user_id }}">

                                <input type="text" id="storemodel-user_account" class="form-control" name="StoreModel[user_account]" value="{{ $info->user_account }}" disabled="">
                            @endif

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 网点分组 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-group_id" class="col-sm-4 control-label">

                        <span class="ng-binding">网点分组：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="storemodel-group_id" class="form-control chosen-select" name="StoreModel[group_id]">
                                @foreach($group_list as $k=>$v)
                                    @if(!isset($info->group_id))
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @else
                                        <option value="{{ $k }}" @if($info->group_id == $k) selected @endif>{{ $v }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <a href="/store/group/list" target="_blank" class="btn btn-warning btn-sm m-l-5">新建网点分组</a>
                            <a id="btn_reload_group_list" class="btn btn-primary btn-sm m-l-5">重新加载</a>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 网点主图 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-store_img" class="col-sm-4 control-label">

                        <span class="ng-binding">网点主图：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->
                            <div id="shop_sign_imagegroup_container" class="szy-imagegroup" data-id="storemodel-store_img" data-size="1"></div>
                            <input type="hidden" id="storemodel-store_img" class="form-control" name="StoreModel[store_img]" value="{{ $info->store_img ?? '' }}">
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">照片在网点详情页主图显示，最多可上传一张，建议尺寸16：9的长方形图片</div></div>
                    </div>
                </div>
            </div>
            <!-- 网点电话  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-tel" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">网点电话：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="storemodel-tel" class="form-control" name="StoreModel[tel]" value="{{ $info->tel ?? '' }}" placeholder="手机或座机">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">网点地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div id="region_container"></div>
                            <input type="hidden" id="region_code" name="StoreModel[region_code]">
                            <input type="hidden" id="region_name" value="">
                            <input type="hidden" id="load" value="1">
                        </div>
                    </div>
                </div>
            </div>
            <!-- 详细地址  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-address" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">详细地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="storemodel-address" class="form-control" name="StoreModel[address]" value="{{ $info->address ?? '' }}">
                            <input type="button" class="btn btn-primary" id="map_search" name="map_search" value="搜索地图" />

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">网点精确位置：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div id="container" style="margin-bottom: 10px; width: 700px; height: 400px; border: 1px solid #D7D7D7; overflow: hidden;"></div>
                            <div id="panel"></div>
                            经度：
                            <input class="form-control ipt m-r-20" type="text" id="store_lng" name="StoreModel[store_lng]" value="{{ $info->store_lng ?? '' }}" readonly="readonly" />
                            纬度：
                            <input class="form-control ipt" type="text" id="store_lat" name="StoreModel[store_lat]" value="{{ $info->store_lat ?? '' }}" readonly="readonly" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- 是否允许店铺编辑信息-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-edit_info" class="col-sm-4 control-label">

                        <span class="ng-binding">是否允许网点修改基本信息：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="StoreModel[edit_info]" value="0">
                                    @if(!isset($info->edit_info))
                                        <label>
                                            <input type="checkbox" id="storemodel-edit_info"
                                                   class="form-control b-n" name="StoreModel[edit_info]"
                                                   value="1" checked data-on-text="是" data-off-text="否">
                                        </label>
                                    @else
                                        <label>
                                            <input type="checkbox" id="storemodel-edit_info"
                                                   class="form-control b-n" name="StoreModel[edit_info]"
                                                   value="1" @if($info->edit_info == 1) checked="" @endif data-on-text="是" data-off-text="否">
                                        </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">网点基本信息包含：网点名称、网点地址、网点主图、网点电话</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-region_editable" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">是否允许网点修改销售/配送范围：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="StoreModel[region_editable]" value="1">
                            <div id="storemodel-region_editable" class="" name="StoreModel[region_editable]">
                                @if(!isset($info->region_editable))
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[region_editable]" value="0"> 禁止修改</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[region_editable]" value="1" checked> 允许修改</label>
                                @else
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[region_editable]" value="0" @if($info->region_editable == 0) checked @endif> 禁止修改</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[region_editable]" value="1" @if($info->region_editable == 1) checked @endif> 允许修改</label>
                                @endif
                            </div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div> <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">销售/配送范围：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="StoreModel[region_type]" value="0">
                            <div id="storemodel-region_type" class="" name="StoreModel[region_type]">
                                @if(!isset($info->region_type))
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[region_type]" value="0" checked> 全国模板</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[region_type]" value="1"> 同城模板</label>
                                @else
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[region_type]" value="0" @if($info->region_type == 0) checked @endif> 全国模板</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="StoreModel[region_type]" value="1" @if($info->region_type == 1) checked @endif> 同城模板</label>
                                @endif

                            </div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 全国模板 -->
            <div id="region_type_0" class="simple-form-field" @if(@$info->region_type == 1)style="display: none;"@endif>
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
							<div class="selector-set region-selected">
								@foreach($store_regions as $item)
									<a class="ss-item region-code"
									   data-region_code="{{ $item['region_code'] }}" data-region_name="{{ $item['region_name'] }}" href="javascript:void(0);">{{ $item['region_name'] }}<i title="移除">×</i>
									</a>
								@endforeach
							</div>
                            <a class="btn btn-warning btn-sm region-edit">添加全国区域模板</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 同城模板 -->
            <div id="region_type_1" class="simple-form-field" @if(@$info->region_type == 0)style="display: none;"@endif>
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div id="mapContainer" class="amap-container">
                                <div class="amap-fixed-box">
                                    <!--block颜色样式有blue,red,green,young,light-blue,brown,orange,purple,powder-->
                                    <!-- 添加配送区域，添加时只会在全屏幕放大时显示，进行编辑 -->
                                    <div class="amap-fixed-info freight-records-edit" style="width: 220px;">
                                        <div class="amap-header">
                                            <span class="tit">配送区域</span>
                                            <a id="btn_add_area" class="btn btn-primary btn-sm pull-right" href="javascript:;" style="display: none;">添加配送区</a>
                                        </div>
                                        <ul>
											@if(!empty($store_regions))
												@foreach($store_regions as $k=>$item)
													<li class="freight-records-item p-b-10" data-id="{{ $k+1 }}" data-color="{{ $item['region_color'] }}">
														<div class="amap-header edit" style="display: none;">
															<label class="m-b-5">
																<span class="block {{ $item['region_color'] }}"></span>
																<span class="m-l-10">
																	<input type="hidden" class="region-codes" value="{{ $item['region_code'] }}">
																	<input type="hidden" class="region-desc" value="{{ $item['region_desc'] }}">
																	<input type="hidden" class="region-color valid" value="{{ $item['region_color'] }}" aria-invalid="false">
																	<input type="hidden" class="region-path valid" aria-invalid="false" value="{{ $item['region_path'] }}">
																	<input type="text" id="region_names" class="form-control form-control-sm w100 region-names" name="region_names" value="{{ $item['region_name'] }}" data-value="{{ $item['region_name'] }}">
																</span>
															</label>
															<a class="c-red pull-right m-t-5 freight-records-item-remove" href="javascript:void(0);" title="点击移除配送区域">删除</a>
															<!-- 报错信息 -->
															<div class="over-hidden freight-handle-error"></div>
														</div>
														<!-- 查看 -->
														<div class="amap-header view" style="display: block;">
															<label>
																<span class="block {{ $item['region_color'] }}"></span>
																<span class="m-l-10 region-names">{{ $item['region_name'] }}</span>
															</label>
														</div>
													</li>
												@endforeach
											@else
												<li class="freight-records-none">
													<p class="null">暂无配送区域</p>
												</li>
											@endif
                                        </ul>
                                        <!-- 确定按钮 -->
                                        <a id="btn_ok" class="btn btn-primary btn-sm pull-right m-t-10 m-r-10" href="javascript:;" style="display: none;">确定</a>
                                        <!-- 只要点击编辑配送区域，可让地图可以自动的最大化，并且以编辑状态展示 -->
                                        <a id="btn_edit_area" class="btn btn-primary btn-sm pull-right m-t-10 m-r-10" href="javascript:;">编辑配送区域</a>
                                        <a id="btn_location" class="btn btn-warning btn-sm pull-right m-t-10 m-r-10" href="javascript:;">定位网点</a>
                                    </div>
                                    <!-- 查看配送区域 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 是否做为自提点 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-is_pickup" class="col-sm-4 control-label">

                        <span class="ng-binding">网点是否作为自提点：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="StoreModel[is_pickup]" value="0">
                                    @if(!isset($info->is_pickup))
                                        <label>
                                            <input type="checkbox" id="storemodel-is_pickup"
                                                   class="form-control b-n" name="StoreModel[is_pickup]"
                                                   value="1" checked data-on-text="是" data-off-text="否">
                                        </label>
                                    @else
                                        <label>
                                            <input type="checkbox" id="storemodel-is_pickup"
                                                   class="form-control b-n" name="StoreModel[is_pickup]"
                                                   value="1" @if($info->is_pickup == 1) checked="" @endif data-on-text="是" data-off-text="否">
                                        </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：支持买家网上下单后自行到网点提取的服务</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否允许自动接单-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-auto_order_taking" class="col-sm-4 control-label">

                        <span class="ng-binding">网点是否自动接单：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="StoreModel[auto_order_taking]" value="0">
                                    @if(!isset($info->auto_order_taking))
                                        <label>
                                            <input type="checkbox" id="storemodel-auto_order_taking"
                                                   class="form-control b-n" name="StoreModel[auto_order_taking]"
                                                   value="1" checked data-on-text="是" data-off-text="否">
                                        </label>
                                    @else
                                        <label>
                                            <input type="checkbox" id="storemodel-auto_order_taking"
                                                   class="form-control b-n" name="StoreModel[auto_order_taking]"
                                                   value="1" @if($info->auto_order_taking == 1) checked="" @endif data-on-text="是" data-off-text="否">
                                        </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：消费者收货地址距离网点地址最近时，订单自动指派给网点；否：网点不接受消费者下单后自动派单</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否允许拒绝接单-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-refuse_order_taking" class="col-sm-4 control-label">

                        <span class="ng-binding">网点是否支持拒绝接单：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="StoreModel[refuse_order_taking]" value="0">
                                    @if(!isset($info->refuse_order_taking))
                                        <label>
                                            <input type="checkbox" id="storemodel-refuse_order_taking"
                                                   class="form-control b-n" name="StoreModel[refuse_order_taking]"
                                                   value="1" checked data-on-text="是" data-off-text="否">
                                        </label>
                                    @else
                                        <label>
                                            <input type="checkbox" id="storemodel-refuse_order_taking"
                                                   class="form-control b-n" name="StoreModel[refuse_order_taking]"
                                                   value="1" @if($info->refuse_order_taking == 1) checked="" @endif data-on-text="是" data-off-text="否">
                                        </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：网点可拒绝接收店铺指派的订单；否：网点无拒绝接收店铺指派订单权限</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺分佣比例  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-take_rate" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺分佣比例：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="storemodel-take_rate" class="form-control ipt m-r-10" name="StoreModel[take_rate]" value="{{ $info->take_rate ?? '0.00' }}"> %


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">分佣比例为0~100之间，按订单比例进行计算</div></div>
                    </div>
                </div>
            </div>
            <!-- 结算周期  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-clearing_cycle" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">结算周期：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="storemodel-clearing_cycle" class="form-control" name="StoreModel[clearing_cycle]">
                                @if(!isset($info->clearing_cycle))
                                    <option value="">-- 请选择 --</option>
                                    <option value="0">1个月</option>
                                    <option value="1">1周</option>
                                    <option value="2">1天</option>
                                    <option value="3">3天</option>
                                @else
                                    <option value="">-- 请选择 --</option>
                                    <option value="0" @if($info->clearing_cycle == 0) selected @endif>1个月</option>
                                    <option value="1" @if($info->clearing_cycle == 1) selected @endif>1周</option>
                                    <option value="2" @if($info->clearing_cycle == 2) selected @endif>1天</option>
                                    <option value="3" @if($info->clearing_cycle == 3) selected @endif>3天</option>
                                @endif
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 网点状态 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-store_status" class="col-sm-4 control-label">

                        <span class="ng-binding">网点状态：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="StoreModel[store_status]" value="0">
                                    @if(!isset($info->store_status))
                                        <label>
                                            <input type="checkbox" id="storemodel-store_status"
                                                   class="form-control b-n" name="StoreModel[store_status]"
                                                   value="1" checked data-on-text="开启" data-off-text="关闭">
                                        </label>
                                    @else
                                        <label>
                                            <input type="checkbox" id="storemodel-store_status"
                                                   class="form-control b-n" name="StoreModel[store_status]"
                                                   value="1" @if($info->store_status == 1)checked="" @endif data-on-text="开启" data-off-text="关闭">
                                        </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启：网点可接收抢单和指派订单；关闭：网点暂停使用，无法接收抢单和指派订单</div></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">
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
        .modal-footer {
            margin: 0px;
        }

        .amap-container {
            width: 700px;
        }
    </style>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    @if(!isset($info->store_id))
            [{"id": "storemodel-shop_id", "name": "StoreModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop Id不能为空。"}}},{"id": "storemodel-user_type", "name": "StoreModel[user_type]", "attribute": "user_type", "rules": {"required":true,"messages":{"required":"用户类型不能为空。"}}},{"id": "storemodel-store_lng", "name": "StoreModel[store_lng]", "attribute": "store_lng", "rules": {"required":true,"messages":{"required":"网点经度不能为空。"}}},{"id": "storemodel-store_lat", "name": "StoreModel[store_lat]", "attribute": "store_lat", "rules": {"required":true,"messages":{"required":"网点纬度不能为空。"}}},{"id": "storemodel-region_editable", "name": "StoreModel[region_editable]", "attribute": "region_editable", "rules": {"required":true,"messages":{"required":"是否允许网点修改销售/配送范围不能为空。"}}},{"id": "storemodel-group_id", "name": "StoreModel[group_id]", "attribute": "group_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点分组必须是整数。"}}},{"id": "storemodel-region_editable", "name": "StoreModel[region_editable]", "attribute": "region_editable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许网点修改销售/配送范围必须是整数。"}}},{"id": "storemodel-region_type", "name": "StoreModel[region_type]", "attribute": "region_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"地区类型必须是整数。"}}},{"id": "storemodel-add_time", "name": "StoreModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Add Time必须是整数。"}}},{"id": "storemodel-is_pickup", "name": "StoreModel[is_pickup]", "attribute": "is_pickup", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点是否作为自提点必须是整数。"}}},{"id": "storemodel-pickup_id", "name": "StoreModel[pickup_id]", "attribute": "pickup_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Pickup Id必须是整数。"}}},{"id": "storemodel-auto_order_taking", "name": "StoreModel[auto_order_taking]", "attribute": "auto_order_taking", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点是否自动接单必须是整数。"}}},{"id": "storemodel-refuse_order_taking", "name": "StoreModel[refuse_order_taking]", "attribute": "refuse_order_taking", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点是否支持拒绝接单必须是整数。"}}},{"id": "storemodel-store_status", "name": "StoreModel[store_status]", "attribute": "store_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点状态必须是整数。"}}},{"id": "storemodel-edit_info", "name": "StoreModel[edit_info]", "attribute": "edit_info", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许网点修改基本信息必须是整数。"}}},{"id": "storemodel-store_name", "name": "StoreModel[store_name]", "attribute": "store_name", "rules": {"required":true,"messages":{"required":"网点名称不能为空。"}}},{"id": "storemodel-region_code", "name": "StoreModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":" 网点地址不能为空。"}}},{"id": "storemodel-address", "name": "StoreModel[address]", "attribute": "address", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "storemodel-tel", "name": "StoreModel[tel]", "attribute": "tel", "rules": {"required":true,"messages":{"required":"网点电话不能为空。"}}},{"id": "storemodel-region_type", "name": "StoreModel[region_type]", "attribute": "region_type", "rules": {"required":true,"messages":{"required":"地区类型不能为空。"}}},{"id": "storemodel-take_rate", "name": "StoreModel[take_rate]", "attribute": "take_rate", "rules": {"required":true,"messages":{"required":"店铺分佣比例不能为空。"}}},{"id": "storemodel-clearing_cycle", "name": "StoreModel[clearing_cycle]", "attribute": "clearing_cycle", "rules": {"required":true,"messages":{"required":"结算周期不能为空。"}}},{"id": "storemodel-user_id", "name": "StoreModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点管理员不能为空","min":" 绑定网点管理员必须不小于1。"},"min":1}},{"id": "storemodel-take_rate", "name": "StoreModel[take_rate]", "attribute": "take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺分佣比例必须是一个数字。","decimal":"店铺分佣比例必须是一个不大于2位小数的数字。","min":"店铺分佣比例必须不小于0。","max":"店铺分佣比例必须不大于100。"},"decimal":2,"min":0,"max":100}},{"id": "storemodel-store_name", "name": "StoreModel[store_name]", "attribute": "store_name", "rules": {"string":true,"messages":{"string":"网点名称必须是一条字符串。","maxlength":"网点名称只能包含至多20个字符。"},"maxlength":20}},{"id": "storemodel-address", "name": "StoreModel[address]", "attribute": "address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "storemodel-store_img", "name": "StoreModel[store_img]", "attribute": "store_img", "rules": {"string":true,"messages":{"string":"网点主图必须是一条字符串。","maxlength":"网点主图只能包含至多255个字符。"},"maxlength":255}},{"id": "storemodel-store_remark", "name": "StoreModel[store_remark]", "attribute": "store_remark", "rules": {"string":true,"messages":{"string":"Store Remark必须是一条字符串。","maxlength":"Store Remark只能包含至多255个字符。"},"maxlength":255}},{"id": "storemodel-tel", "name": "StoreModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"网点电话必须是一条字符串。","maxlength":"网点电话只能包含至多20个字符。"},"maxlength":20}},{"id": "storemodel-tel", "name": "StoreModel[tel]", "attribute": "tel", "rules": {"match":{"pattern":/^((0[0-9]{2,3}-[0-9]{7,8})|(13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}))$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入正确的手机或座机号码，座机号码格式：XXXX-XXXXXXX。"}}},]
    @else
            [{"id": "storemodel-shop_id", "name": "StoreModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop Id不能为空。"}}},{"id": "storemodel-user_type", "name": "StoreModel[user_type]", "attribute": "user_type", "rules": {"required":true,"messages":{"required":"用户类型不能为空。"}}},{"id": "storemodel-store_lng", "name": "StoreModel[store_lng]", "attribute": "store_lng", "rules": {"required":true,"messages":{"required":"网点经度不能为空。"}}},{"id": "storemodel-store_lat", "name": "StoreModel[store_lat]", "attribute": "store_lat", "rules": {"required":true,"messages":{"required":"网点纬度不能为空。"}}},{"id": "storemodel-region_editable", "name": "StoreModel[region_editable]", "attribute": "region_editable", "rules": {"required":true,"messages":{"required":"是否允许网点修改销售/配送范围不能为空。"}}},{"id": "storemodel-group_id", "name": "StoreModel[group_id]", "attribute": "group_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点分组必须是整数。"}}},{"id": "storemodel-region_editable", "name": "StoreModel[region_editable]", "attribute": "region_editable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许网点修改销售/配送范围必须是整数。"}}},{"id": "storemodel-region_type", "name": "StoreModel[region_type]", "attribute": "region_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"地区类型必须是整数。"}}},{"id": "storemodel-add_time", "name": "StoreModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Add Time必须是整数。"}}},{"id": "storemodel-is_pickup", "name": "StoreModel[is_pickup]", "attribute": "is_pickup", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点是否作为自提点必须是整数。"}}},{"id": "storemodel-pickup_id", "name": "StoreModel[pickup_id]", "attribute": "pickup_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Pickup Id必须是整数。"}}},{"id": "storemodel-auto_order_taking", "name": "StoreModel[auto_order_taking]", "attribute": "auto_order_taking", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点是否自动接单必须是整数。"}}},{"id": "storemodel-refuse_order_taking", "name": "StoreModel[refuse_order_taking]", "attribute": "refuse_order_taking", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点是否支持拒绝接单必须是整数。"}}},{"id": "storemodel-store_status", "name": "StoreModel[store_status]", "attribute": "store_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点状态必须是整数。"}}},{"id": "storemodel-edit_info", "name": "StoreModel[edit_info]", "attribute": "edit_info", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许网点修改基本信息必须是整数。"}}},{"id": "storemodel-store_name", "name": "StoreModel[store_name]", "attribute": "store_name", "rules": {"required":true,"messages":{"required":"网点名称不能为空。"}}},{"id": "storemodel-region_code", "name": "StoreModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":" 网点地址不能为空。"}}},{"id": "storemodel-address", "name": "StoreModel[address]", "attribute": "address", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "storemodel-tel", "name": "StoreModel[tel]", "attribute": "tel", "rules": {"required":true,"messages":{"required":"网点电话不能为空。"}}},{"id": "storemodel-region_type", "name": "StoreModel[region_type]", "attribute": "region_type", "rules": {"required":true,"messages":{"required":"地区类型不能为空。"}}},{"id": "storemodel-take_rate", "name": "StoreModel[take_rate]", "attribute": "take_rate", "rules": {"required":true,"messages":{"required":"店铺分佣比例不能为空。"}}},{"id": "storemodel-clearing_cycle", "name": "StoreModel[clearing_cycle]", "attribute": "clearing_cycle", "rules": {"required":true,"messages":{"required":"结算周期不能为空。"}}},{"id": "storemodel-store_id", "name": "StoreModel[store_id]", "attribute": "store_id", "rules": {"required":true,"messages":{"required":"Store Id不能为空。"}}},{"id": "storemodel-take_rate", "name": "StoreModel[take_rate]", "attribute": "take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺分佣比例必须是一个数字。","decimal":"店铺分佣比例必须是一个不大于2位小数的数字。","min":"店铺分佣比例必须不小于0。","max":"店铺分佣比例必须不大于100。"},"decimal":2,"min":0,"max":100}},{"id": "storemodel-store_name", "name": "StoreModel[store_name]", "attribute": "store_name", "rules": {"string":true,"messages":{"string":"网点名称必须是一条字符串。","maxlength":"网点名称只能包含至多20个字符。"},"maxlength":20}},{"id": "storemodel-address", "name": "StoreModel[address]", "attribute": "address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "storemodel-store_img", "name": "StoreModel[store_img]", "attribute": "store_img", "rules": {"string":true,"messages":{"string":"网点主图必须是一条字符串。","maxlength":"网点主图只能包含至多255个字符。"},"maxlength":255}},{"id": "storemodel-store_remark", "name": "StoreModel[store_remark]", "attribute": "store_remark", "rules": {"string":true,"messages":{"string":"Store Remark必须是一条字符串。","maxlength":"Store Remark只能包含至多255个字符。"},"maxlength":255}},{"id": "storemodel-tel", "name": "StoreModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"网点电话必须是一条字符串。","maxlength":"网点电话只能包含至多20个字符。"},"maxlength":20}},{"id": "storemodel-tel", "name": "StoreModel[tel]", "attribute": "tel", "rules": {"match":{"pattern":/^((0[0-9]{2,3}-[0-9]{7,8})|(13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}))$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入正确的手机或座机号码，座机号码格式：XXXX-XXXXXXX。"}}},]
    @endif
    </script>

    <script id="user_type_0_template" type="text">
<input type="text" id="storemodel-user_account" class="form-control" name="StoreModel[user_account]" placeholder="会员帐号/手机号/邮箱" data-rule-required="true" data-msg="网点管理员不能为空">
</script>
    <script id="user_type_1_template" type="text">
<select id="storemodel-user_id" name="StoreModel[user_id]" class="form-control chosen-select" data-rule-required='true' data-msg='网点管理员不能为空'>
	<option vlaue="0">--请选择--</option>
    @if(!empty($user_list))
            @foreach($user_list as $v)
                <option value="{{ $v['user_id'] }}">{{ $v['user_name'] }}</option>
        @endforeach
        @endif
        </select>
        <a href="/shop/account/add" target="_blank" class="btn btn-warning btn-sm m-l-5">新建管理员</a>
        <a id="btn_reload_user_list" class="btn btn-primary btn-sm m-l-5">重新加载</a>
</script>
    <!--点击按钮为表格增加行-->
    <script id="freight_edit_template" type="text">
<li class="freight-records-item p-b-10" data-id="#0#" data-color="#color#">
	<div class="amap-header edit">
		<label class="m-b-5">
			<span class="block #color#"></span>
			<span class="m-l-10">
				<input type="hidden" class="region-codes">
				<input type="hidden" class="region-desc">
				<input type="hidden" class="region-color" value="#color#">
				<input type="hidden" class="region-path">
				<input type="text" id="region_names" class="form-control form-control-sm w100 region-names" name="region_names" value="区域#0#" data-value="区域#0#">
			</span>
		</label>
		<a class="c-red pull-right m-t-5 freight-records-item-remove" href="javascript:void(0);" title="点击移除配送区域">删除</a>
		<!-- 报错信息 -->
		<div class="over-hidden freight-handle-error"></div>
	</div>
	<!-- 查看 -->
	<div class="amap-header view">
		<label>
			<span class="block #color#"></span>
			<span class="m-l-10 region-names">区域#0#</span>
		</label>
	</div>
</li>
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
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')




    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".table-content").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };

            var validator = $("#StoreModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            var error_list = [];
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    var html = "";
                    error_list = validator.errorList;

                    for (var i = 0; i < validator.errorList.length; i++) {
                        var element = validator.errorList[i].element;
                        var message = validator.errorList[i].message;

                        html += "<div><a href='javascript:void(0);' data-id='" + i + "'>" + message + "</a></div>";
                    }

                    $.alert("<div id='error_list'>" + html + "</div>");

                    $("#error_list").find("a").click(function() {
                        var i = $(this).data("id");
                        if (error_list[i] && error_list[i].element) {
                            $(error_list[i].element).focus();
                        }
                    });
                    return;
                }

                var data = $("#StoreModel").serializeJson();
                data.store_regions = [];

                if (data.StoreModel.region_type == 0) {
                    $("#region_type_0").find(".region-selected").find(".region-code").each(function() {
                        data.store_regions.push({
                            'region_code': $(this).data("region_code"),
                            'region_name': $(this).data("region_name"),
                        });
                    });
                } else {
                    $("#region_type_1").find(".freight-records-item").each(function() {
                        data.store_regions.push({
                            'region_code': $(this).find(".region-codes").val(),
                            'region_name': $(this).find(".region-names").val(),
                            'region_path': $(this).find(".region-path").val(),
                            'region_desc': $(this).find(".region-desc").val(),
                            'region_color': $(this).find(".region-color").val(),
                        });
                    });
                }

                if (data.store_regions.length == 0) {
                    $.msg("销售/配送范围不能为空！");
                    return;
                }

                //加载提示
                $.loading.start();

                var url = $("#StoreModel").attr("action");

                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 3000
                        });
                        $.go("/store/default/list");
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });

                return false;
            });

            $("input[name='StoreModel[user_type]']").click(function() {
                var value = $(this).val();

                var html = $("#user_type_" + value + "_template").html();

                $("#user_type_" + value).html(html).show();
                $("#user_type_" + value).find(".chosen-select").chosen();

                value = value == 0 ? 1 : 0;
                $("#user_type_" + value).html("");

                validator = $("#StoreModel").validate();
            });
        });
    </script>
    <script type="text/javascript">
        $(".szy-imagegroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");

            var target = $("#" + id);
            var value = $(target).val();

            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: size,
                values: value.split("|"),
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                }
            });
        });
    </script>
    <script type="text/javascript">
        //当前已选择的地区
        var region_codes_now = [];
        // 不能选择的地区
        var region_codes_not = [];
        $().ready(function() {
            $("#region_container").regionselector({
                value: '{{ $info->region_code ?? '' }}',
                select_class: 'form-control',
                change: function(value, names, is_last) {
                    if (value == '') {
                        var values = this.values();
                        if (values.length > 0) {
                            value = values[values.length - 1].region_code;
                        }
                    }
                    $("#region_code").val(value);
                    $("#region_name").val(names);
                    $("#region_code").data("is_last", is_last);
                    $("#region_code").valid();
                }
            });

            $("input[type='radio']").click(function() {
                if ($("input[type='radio']:checked").val() == 0) {
                    $("#opening").hide();
                } else {
                    $("#opening").show();
                }
            });

            // 全国地区模板运费选择地区
            $("body").on("click", ".region-edit", function() {
                var target = this;

                region_codes_now = {};
                region_codes_not = {};

                var table = null;

                $("#region_type_0").find(".region-selected").find(".region-code").each(function() {
                    var region_code = $(this).data("region_code");
                    var region_name = $(this).data("region_name");
                    region_codes_now[region_code] = region_name;
                });

                $.loading.start();

                $.open({
                    title: "地区选择",
                    width: "950px",
                    height: "500px",
                    ajax: {
                        url: "/store/default/region-picker"
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

                        $("#region_type_0").find(".region-names").val(region_names.join("|"));
                        $("#region_type_0").find(".region-codes").val(region_codes.join("|"));

                        var html = "";

                        for (var i = 0; i < region_names.length; i++) {
                            var region_name = region_names[i];
                            html += '<a class="ss-item region-code" data-region_code="' + region_codes[i] + '" data-region_name="' + region_names[i] + '" href="javascript:void(0);">' + region_name + '<i title="移除">×</i></a>';
                        }

                        $("#region_type_0").find(".region-selected").html(html);

                        $.closeDialog(index);
                    },
                    onhide: function() {
                        $(".region-codes").each(function() {
                            $(this).valid();
                        });
                    }
                });
            });

            $("body").on("click", ".selector-set a i", function() {
                $(this).parents("a").remove();
            });

        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var x = $("#store_lng").val();
            var y = $("#store_lat").val();
            if (x == "" || y == "") {
                x = 0;
                y = 0;
                var lnglatXY = new AMap.LngLat(x, y);
                var map = new AMap.Map("container", {
                    resizeEnable: true,
                    doubleClickZoom: false,
                    zoom: 13
                });
            } else {
                var lnglatXY = new AMap.LngLat(x, y);
                var map = new AMap.Map("container", {
                    resizeEnable: true,
                    doubleClickZoom: false,
                    zoom: 15,
                    center: lnglatXY
                });
            }
            map.plugin(["AMap.ToolBar"], function() {
                // 加载工具条
                var tool = new AMap.ToolBar();
                map.addControl(tool);
            });
            var marker;
            var geocoder;
            regeocoder();
            $("#map_search").click(function() {
                $("#panel").show();
                AMap.service(["AMap.PlaceSearch"], function() {
                    // 构造地点查询类
                    var placeSearch = new AMap.PlaceSearch({
                        pageSize: 6,
                        map: map,
                        panel: "panel"
                    });
                    var array = $("#region_name").val().split(",");
                    var keyword = array.join("");
                    var keyword = keyword + $("#storemodel-address").val();
                    // 关键字查询
                    placeSearch.search(keyword);
                });
            });
            // 点击地图改变坐标点位置
            AMap.event.addListener(map, 'click', function(e) {
                var x = e.lnglat.getLng();
                var y = e.lnglat.getLat();
                lnglatXY = new AMap.LngLat(x, y);
                regeocoder();
                $("#panel").hide();
                $("#store_lng").val(x);
                $("#store_lat").val(y);
            });

            // 逆地理编码
            function regeocoder() {
                // 加载地理编码插件
                map.plugin(["AMap.Geocoder"], function() {
                    geocoder = new AMap.Geocoder({
                        radius: 1000, // 以已知坐标为中心点，radius为半径，返回范围内兴趣点和道路信息
                        extensions: "base" //返回地址描述以及附近兴趣点和道路信息，默认"base"
                    });

                    // 返回地理编码结果
                    AMap.event.addListener(geocoder, "complete", geocoder_callBack);
                    // 逆地理编码
                    geocoder.getAddress(lnglatXY);
                });

                var zoom = map.getZoom();
                var center = map.getCenter();
                map.clearMap();
                // 加点
                marker = new AMap.Marker({
                    position: lnglatXY,
                    draggable: true,
                    cursor: 'move',
                    raiseOnDrag: true
                });
                marker.setMap(map); // 在地图上添加点
                map.setFitView();
                map.setZoomAndCenter(zoom, center);

                // 移动坐标点位置
                marker.on('mouseup', function(e) {
                    var x = e.lnglat.getLng();
                    var y = e.lnglat.getLat();
                    lnglatXY = new AMap.LngLat(x, y);
                    regeocoder();
                    $("#panel").hide();
                    $("#store_lng").val(x);
                    $("#store_lat").val(y);
                });
            }

            function geocoder_callBack(data) {
                if ($("#load").val() == 1) {
                    $("#load").val(0);
                    openInfo($("#storemodel-address").val());
                } else {
                    var address = data.regeocode.formattedAddress;
                    var array = $("#region_name").val().split(","); // 返回地址描述
                    for (var i = 0; i < array.length; i++) {
                        address = address.replace(array[i], '');
                    }
                    address = address.replace('省', '');
                    address = address.replace('市', '');
                    $("#storemodel-address").val(address);
                    openInfo(address);
                }
            }

            // 在指定位置打开信息窗体
            function openInfo(address) {
                if (address == "") {
                    return;
                }
                // 构建信息窗体中显示的内容
                var info = [];
                info.push("<div>地址：" + address + "</div>");
                infoWindow = new AMap.InfoWindow({
                    content: info.join("<br/>"),
                    offset: new AMap.Pixel(0, -30)
                });
                infoWindow.open(map, marker.getPosition());
            }

            // 回车搜索
            $("#storemodel-address").keypress(function(e) {
                if (event.keyCode == 13) {
                    $("#map_search").click();
                }
            });

            // 重新加载网点分组
            $("#btn_reload_group_list").click(function() {
                $.loading.start();
                $.get("/store/default/group-list", {
                    format: "json"
                }, function(result) {
                    if (result.code == 0) {
                        var list = result.data;
                        var html = "";
                        for ( var name in result.data) {
                            html += "<option value='"+name+"'>" + result.data[name] + "</option>";
                        }

                        $("#storemodel-group_id").html(html);
                        $(".chosen-select").chosen("destroy").chosen();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });

            // 重新加载管理员列表
            $("body").on("click", "#btn_reload_user_list", function() {
                $.loading.start();
                $.get("/store/default/user-list", {
                    format: "json"
                }, function(result) {
                    if (result.code == 0) {
                        var list = result.data;

                        var html = "<option value='0'>--请选择--</option>";
                        for (var i = 0; i < list.length; i++) {
                            var user_id = list[i].user_id;
                            var user_name = list[i].user_name;
                            html += "<option value='"+user_id+"'>" + user_name + "</option>";
                        }
                        $("#storemodel-user_id").html(html);
                        $("#storemodel-user_id").chosen("destroy").chosen();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });
        });
    </script>
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
                $(".amap-fixed-info").css("width", '200px');
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
            } else {

                // 点击最大化

                $(".seller-head").css({
                    "z-index": "1"
                });
                $(".style-seller").css({
                    "overflow": "hidden"
                });
                $('.amap-container').addClass('toggle');
                $(".amap-fixed-info").css("width", '220px');
                $(".amap-fixed-box ul").css("max-height", '470px');

                $("#btn_edit_area").hide();
                $("#btn_add_area").show();
                $("#btn_ok").show();

                $(".freight-records-item .view").hide();
                $(".freight-records-item .edit").show();
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

                            var center = polygon.getBounds().getCenter();

                            getRegionCode(center.lng, center.lat, function(region_code, region_name) {
                                $(target).find(".region-codes").val(region_code);
                                $(target).find(".region-desc").val(region_name);

                                if ($(free_record_tr).size() > 0) {
                                    $(free_record_tr).find(".region-codes").val(region_code)
                                }
                            });
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
                $.msg("配送设置存在错误！", {
                    time: 2000
                });
            }
        });

        $().ready(function() {
            $("input[name='StoreModel[region_type]']").change(function() {
                var value = $(this).val();
                $("#region_type_" + value).show();
                value = value == 0 ? 1 : 0;
                $("#region_type_" + value).hide();
            });
        });
    </script>
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.15&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder"></script>
    <script type="text/javascript">
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

                list.push(['region_name', '.region-names']);
                list.push(['region_codes', '.region-codes']);
                list.push(['region_names', '.region-names']);
                list.push(['region_path', '.region-path']);
                list.push(['region_desc', '.region-desc']);

                for (var i = 0; i < list.length; i++) {
                    var item = list[i];

                    if (data[item[0]]) {
                        $(element).find(".edit").find(item[1]).val(data[item[0]]);
                        $(element).find(".view").find(item[1]).html(data[item[0]]);
                    }
                }
            }

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
                var region_code = "";

                if (status === 'complete' && result.info === 'OK') {
                    region_code = result.regeocode.addressComponent.adcode;
                    region_name = result.regeocode.formattedAddress;

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
            var store_lng = "";
            //纬度
            var store_lat = "";
            var mark_title = "网点所在位置";

            //加载地图，调用浏览器定位服务
            map = new AMap.Map("mapContainer", {
                level: 17,
                // 缩放级别
                zooms: [8, 18],
                resizeEnable: true
            });

            if ($.trim(store_lng) != "" && $.trim(store_lat) != "") {
                map.setCenter([store_lng, store_lat]);
            } else if ("0" == 0) {
                mark_title = "您尚未设置网点位置，当前为您所在的位置";
            }

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
                //geolocation.getCurrentPosition();
            });

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

            $("#btn_location").click(function() {

                var lng = $("#store_lng").val();
                var lat = $("#store_lat").val();

                if (lng == "" && lat == "") {
                    $.msg("请先设置网点位置！");
                    $("#storemodel-address").focus();
                    return;
                }

                map.setCenter([lng, lat]);

                mark_title = "网点所在位置";
                marker.setTitle(mark_title);

                // 给地图添加点标记等覆盖物
                marker.setPosition([lng, lat]);
            });

            //
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
