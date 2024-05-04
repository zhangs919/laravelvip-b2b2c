{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="MultiStoreModel" class="form-horizontal" name="MultiStoreModel" action="/dashboard/multi-store/add" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 门店ID  -->
            <input type="hidden" id="multistoremodel-store_id" class="form-control" name="MultiStoreModel[store_id]" value="{{ $model['store_id'] ?? '' }}">
            <!-- 门店名称  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-store_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">门店名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="multistoremodel-store_name" class="form-control" name="MultiStoreModel[store_name]" value="{{ $model['store_name'] ?? '' }}">
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">不超过20个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺LOGO -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-store_logo" class="col-sm-4 control-label">
                        <span class="ng-binding">门店logo：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <!-- 图片组 start -->
                            <div id="store_logo_imagegroup_container" class="szy-imagegroup pull-left"
                                 data-id="multistoremodel-store_logo" data-size="1"></div>
                            <input type="hidden" id="multistoremodel-store_logo" class="form-control" name="MultiStoreModel[store_logo]" value="{{ $model['store_logo'] ?? '' }}">
                            <span class="c-blue pull-left" style="margin: 20px 0 0 50px;">
            查看示例
            <i data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true"
               data-content="<img width='200' height='180' src='/images/shop/pattern-store-logo.png'>"
               class="fa fa-question-circle f16 c-orange m-l-5 cur-p"></i>
        </span>
                            <!-- 图片组 end -->
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">文件格式GIF、JPG、JPEG、PNG文件大小80k以内，建议尺寸120*120像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 绑定门店管理员  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-user_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding"> 绑定门店管理员：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div class="form-control-box disp-block pull-none">
                                @if(!isset($model['store_id']))
                                <input type="hidden" name="MultiStoreModel[user_type]" value="0">
                                <div id="multistoremodel-user_type" class="m-b-10" name="MultiStoreModel[user_type]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="MultiStoreModel[user_type]" value="0" checked> 会员</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="MultiStoreModel[user_type]" value="1"> 店铺管理员</label></div>
                                <div id="user_type_0">
                                    <input type="text" id="multistoremodel-user_account" class="form-control" name="MultiStoreModel[user_account]" placeholder="会员帐号/手机号/邮箱" data-rule-required="true" data-msg="门店管理员不能为空"></div>
                                <div id="user_type_1" style="display: none;"></div>
                                @else
                                    <input type="hidden" id="multistoremodel-user_id" class="form-control" name="MultiStoreModel[user_id]" value="{{ $model['user_id'] }}">
                                    <input type="text" id="multistoremodel-user_account" class="form-control" name="MultiStoreModel[user_account]" value="{{ $model['user_name'] }}" disabled="">
                                @endif
                            </div>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 门店分组 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-group_id" class="col-sm-4 control-label">
                        <span class="ng-binding">门店分组：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select id="multistoremodel-group_id" class="form-control chosen-select" name="MultiStoreModel[group_id]">
                                @foreach($group_list as $k=>$v)
                                    @if(!isset($model['group_id']))
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @else
                                        <option value="{{ $k }}" @if($model['group_id'] == $k) selected @endif>{{ $v }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <a href="javascript:void(0);" class="btn btn-warning btn-sm m-l-5 add-store-group">新建门店分组</a>
                            <a id="btn_reload_group_list" class="btn btn-primary btn-sm m-l-5" href="javascript:void(0);">重新加载</a>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 门店主图 -->
            <!--     <div class="simple-form-field" >
<div class="form-group">
<label for="multistoremodel-store_img" class="col-sm-4 control-label">
<span class="ng-binding">门店主图：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
        图片组 start
        <div id="shop_sign_imagegroup_container" class="szy-imagegroup" data-id="storemodel-store_img" data-size="1"></div>
        <input type="hidden" id="multistoremodel-store_img" class="form-control" name="MultiStoreModel[store_img]">
        图片组 end
</div>
<div class="help-block help-block-t"><div class="help-block help-block-t">照片在门店详情页主图显示，最多可上传一张，建议尺寸16：9的长方形图片</div></div>
</div>
</div>
</div> -->
            <!-- 门店电话  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-tel" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">门店电话：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="multistoremodel-tel" class="form-control" name="MultiStoreModel[tel]" placeholder="手机或座机" value="{{ $model['tel'] ?? '' }}">
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">门店地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div id="region_container"></div>
                            <input type="hidden" id="region_code" name="MultiStoreModel[region_code]">
                            <input type="hidden" id="region_name" value="">
                            <input type="hidden" id="load" value="1">
                        </div>
                    </div>
                </div>
            </div>
            <!-- 详细地址  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-address" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">详细地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="multistoremodel-address" class="form-control" name="MultiStoreModel[address]" value="{{ $model['address'] ?? '' }}">
                            <input type="button" class="btn btn-primary" id="map_search" name="map_search" value="搜索地图"/>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">门店精确位置：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div id="container"
                                 style="margin-bottom: 10px; width: 700px; height: 400px; border: 1px solid #D7D7D7; overflow: hidden;"></div>
                            <div id="panel"></div>
                            经度：
                            <input class="form-control ipt m-r-20" type="text" id="store_lng"
                                   name="MultiStoreModel[store_lng]" value="{{ $model['store_lng'] ?? '' }}" readonly="readonly"/>
                            纬度：
                            <input class="form-control ipt" type="text" id="store_lat" name="MultiStoreModel[store_lat]"
                                   value="{{ $model['store_lat'] ?? '' }}" readonly="readonly"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 是否允许店铺编辑信息-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-edit_info" class="col-sm-4 control-label">
                        <span class="ng-binding">是否允许门店修改基本信息：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="MultiStoreModel[edit_info]" value="0"><label><input type="checkbox" id="multistoremodel-edit_info" class="form-control b-n" name="MultiStoreModel[edit_info]" value="1" checked data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">门店基本信息包含：门店名称、门店地址、营业时间、门店电话</div></div>
                    </div>
                </div>
            </div>            <!-- 起送金额  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-start_price" class="col-sm-4 control-label">
                        <span class="ng-binding">起送金额：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="multistoremodel-start_price" class="form-control ipt m-r-10" name="MultiStoreModel[start_price]" value="0.00">元
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">起送金额为商品促销后的实际售价，在红包抵扣、订单满减等订单优惠之前，不包括运费；其中参与拼团、砍价、预售、限购商品不受起送金额影响</div></div>
                    </div>
                </div>
            </div>            <!-- 营业时间 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-opening_type" class="col-sm-4 control-label">
                        <span class="ng-binding">营业时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="hidden" name="MultiStoreModel[opening_type]" value="0"><div id="multistoremodel-opening_type" class="" name="MultiStoreModel[opening_type]"><label class="control-label cur-p m-r-10"><input type="radio" name="MultiStoreModel[opening_type]" value="0" checked> 全天</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="MultiStoreModel[opening_type]" value="1"> 每天重复</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="MultiStoreModel[opening_type]" value="2"> 每周重复</label></div>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" id="opening_type_area">
            </div>
            <!-- 非营业时间是否支持下单 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-out_openhour_order_enable" class="col-sm-4 control-label">
                        <span class="ng-binding">非营业时间是否支持下单：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="MultiStoreModel[out_openhour_order_enable]" value="0"><label><input type="checkbox" id="multistoremodel-out_openhour_order_enable" class="enable-switch-on-off" name="MultiStoreModel[out_openhour_order_enable]" value="1" checked data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：非营业时间消费者可在店铺购物，结算页面会展示非营业时间下单提示内容；否：非营业时间消费者不可在店铺购物</div></div>
                    </div>
                </div>
            </div>            <!-- 非营业时间下单提示 -->
            <div class="close-tips ">
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="multistoremodel-close_tips" class="col-sm-4 control-label">
                            <span class="ng-binding">非营业时间下单提示：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <textarea id="multistoremodel-close_tips" class="form-control" name="MultiStoreModel[close_tips]" rows="5"></textarea>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">消费者在店铺非营业时间下单，提交订单时，展示的提示信息</div></div>
                        </div>
                    </div>
                </div>            </div>
            <!-- 门店打烊提示图 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-close_image" class="col-sm-4 control-label">
                        <span class="ng-binding">门店打烊提示图：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <!-- 图片组 start -->
                            <div id="close_image_imagegroup_container" class="szy-imagegroup pull-left"
                                 data-id="multistoremodel-close_image" data-size="1"></div>
                            <input type="hidden" id="multistoremodel-close_image" class="form-control" name="MultiStoreModel[close_image]">
                            <!-- 图片组 end -->
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于手机端，门店非营业时间，消费者访问门店首页展示，文件格式GIF、JPG、JPEG、PNG文件大小80k以内，建议尺寸300*440像素</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-region_editable" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">门店修改销售/配送范围：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="hidden" name="MultiStoreModel[region_editable]" value="1"><div id="multistoremodel-region_editable" class="" name="MultiStoreModel[region_editable]"><label class="control-label cur-p m-r-10"><input type="radio" name="MultiStoreModel[region_editable]" value="0"> 禁止修改</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="MultiStoreModel[region_editable]" value="1" checked> 允许修改</label></div>
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
                            <input type="hidden" name="MultiStoreModel[region_type]" value="0"><div id="multistoremodel-region_type" class="" name="MultiStoreModel[region_type]"><label class="control-label cur-p m-r-10"><input type="radio" name="MultiStoreModel[region_type]" value="0" checked> 全国模板</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="MultiStoreModel[region_type]" value="1"> 同城模板</label></div>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 全国模板 -->
            <div id="region_type_0" class="simple-form-field" >
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div class="selector-set region-selected">
                            </div>
                            <a class="btn btn-warning btn-sm region-edit">添加全国区域模板</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 同城模板 -->
            <div id="region_type_1" class="simple-form-field" style="display: none;">
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
                                            <a id="btn_add_area" class="btn btn-primary btn-sm pull-right"
                                               href="javascript:;" style="display: none;">添加配送区</a>
                                        </div>
                                        <ul>
                                            <li class="freight-records-none">
                                                <p class="null">暂无配送区域</p>
                                            </li>
                                        </ul>
                                        <!-- 确定按钮 -->
                                        <a id="btn_ok" class="btn btn-primary btn-sm pull-right m-t-10 m-r-10"
                                           href="javascript:;" style="display: none;">确定</a>
                                        <!-- 只要点击编辑配送区域，可让地图可以自动的最大化，并且以编辑状态展示 -->
                                        <a id="btn_edit_area" class="btn btn-primary btn-sm pull-right m-t-10 m-r-10"
                                           href="javascript:;">编辑配送区域</a>
                                        <a id="btn_location" class="btn btn-warning btn-sm pull-right m-t-10 m-r-10"
                                           href="javascript:;">定位门店</a>
                                    </div>
                                    <!-- 查看配送区域 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 门店是否统一额外配送费 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-is_other_shpping_fee" class="col-sm-4 control-label">
                        <span class="ng-binding">门店统一额外配送费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="MultiStoreModel[is_other_shpping_fee]" value="0"><label><input type="checkbox" id="multistoremodel-is_other_shpping_fee" class="form-control b-n" name="MultiStoreModel[is_other_shpping_fee]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：下单时间不在门店设置的时间范围内，收取额外配送费，全门店所有商品统一额外配送费金额，无论订单购买多少商品，仅收一次额外配送费；<br>
                                否：每个商品的额外配送金额受运费模板中控制，一笔订单多个商品，每个商品所属的运费模板均不同，则额外配送费累加</div></div>
                    </div>
                </div>
            </div>            <!-- 额外配送费  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-other_shipping_fee" class="col-sm-4 control-label">
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div class="form-control-box w800">
                                下单时间不在
                                <select name="shipping_time[begin_hour]" class="select form-control m-l-5 m-r-5">
                                    <!--   -->
                                    <option value="0"  selected="selected">00</option>
                                    <!--   -->
                                    <option value="1" >01</option>
                                    <!--   -->
                                    <option value="2" >02</option>
                                    <!--   -->
                                    <option value="3" >03</option>
                                    <!--   -->
                                    <option value="4" >04</option>
                                    <!--   -->
                                    <option value="5" >05</option>
                                    <!--   -->
                                    <option value="6" >06</option>
                                    <!--   -->
                                    <option value="7" >07</option>
                                    <!--   -->
                                    <option value="8" >08</option>
                                    <!--   -->
                                    <option value="9" >09</option>
                                    <!--   -->
                                    <option value="10" >10</option>
                                    <!--   -->
                                    <option value="11" >11</option>
                                    <!--   -->
                                    <option value="12" >12</option>
                                    <!--   -->
                                    <option value="13" >13</option>
                                    <!--   -->
                                    <option value="14" >14</option>
                                    <!--   -->
                                    <option value="15" >15</option>
                                    <!--   -->
                                    <option value="16" >16</option>
                                    <!--   -->
                                    <option value="17" >17</option>
                                    <!--   -->
                                    <option value="18" >18</option>
                                    <!--   -->
                                    <option value="19" >19</option>
                                    <!--   -->
                                    <option value="20" >20</option>
                                    <!--   -->
                                    <option value="21" >21</option>
                                    <!--   -->
                                    <option value="22" >22</option>
                                    <!--   -->
                                    <option value="23" >23</option>
                                </select>
                                :
                                <select name="shipping_time[begin_minute]" class="select form-control m-l-5 m-r-5">
                                    <!--   -->
                                    <option value="0"  selected="selected">00</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="5" >05</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="10" >10</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="15" >15</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="20" >20</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="25" >25</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="30" >30</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="35" >35</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="40" >40</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="45" >45</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="50" >50</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="55" >55</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="59" >59</option>
                                </select>
                                至
                                <select name="shipping_time[end_hour]" class="select form-control m-l-5 m-r-5">
                                    <!--   -->
                                    <option value="0"  selected="selected">00</option>
                                    <!--   -->
                                    <option value="1" >01</option>
                                    <!--   -->
                                    <option value="2" >02</option>
                                    <!--   -->
                                    <option value="3" >03</option>
                                    <!--   -->
                                    <option value="4" >04</option>
                                    <!--   -->
                                    <option value="5" >05</option>
                                    <!--   -->
                                    <option value="6" >06</option>
                                    <!--   -->
                                    <option value="7" >07</option>
                                    <!--   -->
                                    <option value="8" >08</option>
                                    <!--   -->
                                    <option value="9" >09</option>
                                    <!--   -->
                                    <option value="10" >10</option>
                                    <!--   -->
                                    <option value="11" >11</option>
                                    <!--   -->
                                    <option value="12" >12</option>
                                    <!--   -->
                                    <option value="13" >13</option>
                                    <!--   -->
                                    <option value="14" >14</option>
                                    <!--   -->
                                    <option value="15" >15</option>
                                    <!--   -->
                                    <option value="16" >16</option>
                                    <!--   -->
                                    <option value="17" >17</option>
                                    <!--   -->
                                    <option value="18" >18</option>
                                    <!--   -->
                                    <option value="19" >19</option>
                                    <!--   -->
                                    <option value="20" >20</option>
                                    <!--   -->
                                    <option value="21" >21</option>
                                    <!--   -->
                                    <option value="22" >22</option>
                                    <!--   -->
                                    <option value="23" >23</option>
                                </select>
                                :
                                <select name="shipping_time[end_minute]" class="select form-control m-l-5 m-r-5">
                                    <!--   -->
                                    <option value="0"  selected="selected">00</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="5" >05</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="10" >10</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="15" >15</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="20" >20</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="25" >25</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="30" >30</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="35" >35</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="40" >40</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="45" >45</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="50" >50</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="55" >55</option>
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <!--   -->
                                    <option value="59" >59</option>
                                </select>
                                范围内，额外增加配送费 <input type="text" id="multistoremodel-other_shipping_fee" class="form-control ipt m-l-10 m-r-10" name="MultiStoreModel[other_shipping_fee]" value="0.00">元
                            </div>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>            <!-- 门店是否统一包装费 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-is_packing_fee" class="col-sm-4 control-label">
                        <span class="ng-binding">门店统一包装费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="MultiStoreModel[is_packing_fee]" value="0"><label><input type="checkbox" id="multistoremodel-is_packing_fee" class="form-control b-n" name="MultiStoreModel[is_packing_fee]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：全门店所有商品统一包装费，无论订单购买多少商品，仅收一次包装费；<br>否：每个商品的包装费金额受运费模板中控制，一笔订单多个商品，每个商品所属的运费模板均不同，则包装费累加</div></div>
                    </div>
                </div>
            </div>            <!-- 包装费  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-packing_fee" class="col-sm-4 control-label">
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            包装费 <input type="text" id="multistoremodel-packing_fee" class="form-control ipt m-r-10" name="MultiStoreModel[packing_fee]" value="0.00">元
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>            <!-- 是否做为自提点 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-is_pickup" class="col-sm-4 control-label">
                        <span class="ng-binding">门店是否作为自提点：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="MultiStoreModel[is_pickup]" value="0"><label><input type="checkbox" id="multistoremodel-is_pickup" class="form-control b-n" name="MultiStoreModel[is_pickup]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：支持买家网上下单后自行到门店提取的服务</div></div>
                    </div>
                </div>
            </div>            <!-- 是否允许门店自主关联商品 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-is_allowed_related_goods" class="col-sm-4 control-label">
                        <span class="ng-binding">是否允许门店自主关联商品：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="MultiStoreModel[is_allowed_related_goods]" value="0"><label><input type="checkbox" id="multistoremodel-is_allowed_related_goods" class="form-control b-n" name="MultiStoreModel[is_allowed_related_goods]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：门店可独立自主关联和删除售卖的商品；否：门店售卖的商品只能是店铺统一管控</div></div>
                    </div>
                </div>
            </div>            <!-- 是否允许自动接单-->
            <!-- 是否允许拒绝接单-->
            <!-- 店铺分佣比例  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-take_rate" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺分佣比例：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="multistoremodel-take_rate" class="form-control ipt m-r-10" name="MultiStoreModel[take_rate]" value="0.00"> %
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">分佣比例为0~100之间，按订单比例进行计算</div></div>
                    </div>
                </div>
            </div> <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-clearing_cycle" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">结算周期：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select id="multistoremodel-clearing_cycle" class="form-control" name="MultiStoreModel[clearing_cycle]">
                                <option value="">-- 请选择 --</option>
                                <option value="0">1个月</option>
                                <option value="1">1周</option>
                                <option value="2">1天</option>
                                <option value="3">3天</option>
                            </select>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>            <!-- 门店状态 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoremodel-store_status" class="col-sm-4 control-label">
                        <span class="ng-binding">门店状态：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="MultiStoreModel[store_status]" value="0"><label><input type="checkbox" id="multistoremodel-store_status" class="form-control b-n" name="MultiStoreModel[store_status]" value="1" checked data-on-text="开启" data-off-text="关闭"> </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启：门店可接收抢单和指派订单；关闭：门店暂停使用，无法接收抢单和指派订单</div></div>
                    </div>
                </div>
            </div>            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">
            </div>
        </form>    </div>

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
    @if(!isset($model['store_id']))
        <script id="client_rules" type="text">
        [{"id": "multistoremodel-shop_id", "name": "MultiStoreModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop Id不能为空。"}}},{"id": "multistoremodel-user_type", "name": "MultiStoreModel[user_type]", "attribute": "user_type", "rules": {"required":true,"messages":{"required":"用户类型不能为空。"}}},{"id": "multistoremodel-store_lng", "name": "MultiStoreModel[store_lng]", "attribute": "store_lng", "rules": {"required":true,"messages":{"required":"门店经度不能为空。"}}},{"id": "multistoremodel-store_lat", "name": "MultiStoreModel[store_lat]", "attribute": "store_lat", "rules": {"required":true,"messages":{"required":"门店纬度不能为空。"}}},{"id": "multistoremodel-region_editable", "name": "MultiStoreModel[region_editable]", "attribute": "region_editable", "rules": {"required":true,"messages":{"required":"门店修改销售/配送范围不能为空。"}}},{"id": "multistoremodel-group_id", "name": "MultiStoreModel[group_id]", "attribute": "group_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店分组必须是整数。"}}},{"id": "multistoremodel-region_editable", "name": "MultiStoreModel[region_editable]", "attribute": "region_editable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店修改销售/配送范围必须是整数。"}}},{"id": "multistoremodel-region_type", "name": "MultiStoreModel[region_type]", "attribute": "region_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"地区类型必须是整数。"}}},{"id": "multistoremodel-add_time", "name": "MultiStoreModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Add Time必须是整数。"}}},{"id": "multistoremodel-is_pickup", "name": "MultiStoreModel[is_pickup]", "attribute": "is_pickup", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店是否作为自提点必须是整数。"}}},{"id": "multistoremodel-pickup_id", "name": "MultiStoreModel[pickup_id]", "attribute": "pickup_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Pickup Id必须是整数。"}}},{"id": "multistoremodel-store_status", "name": "MultiStoreModel[store_status]", "attribute": "store_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店状态必须是整数。"}}},{"id": "multistoremodel-edit_info", "name": "MultiStoreModel[edit_info]", "attribute": "edit_info", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许门店修改基本信息必须是整数。"}}},{"id": "multistoremodel-is_allowed_related_goods", "name": "MultiStoreModel[is_allowed_related_goods]", "attribute": "is_allowed_related_goods", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许门店自主关联商品必须是整数。"}}},{"id": "multistoremodel-yl_settle_mode", "name": "MultiStoreModel[yl_settle_mode]", "attribute": "yl_settle_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"银联结算模式必须是整数。"}}},{"id": "multistoremodel-opening_type", "name": "MultiStoreModel[opening_type]", "attribute": "opening_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Opening Type必须是整数。"}}},{"id": "multistoremodel-goods_count", "name": "MultiStoreModel[goods_count]", "attribute": "goods_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Goods Count必须是整数。"}}},{"id": "multistoremodel-out_openhour_order_enable", "name": "MultiStoreModel[out_openhour_order_enable]", "attribute": "out_openhour_order_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"非营业时间是否支持下单必须是整数。"}}},{"id": "multistoremodel-is_other_shpping_fee", "name": "MultiStoreModel[is_other_shpping_fee]", "attribute": "is_other_shpping_fee", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店统一额外配送费必须是整数。"}}},{"id": "multistoremodel-is_packing_fee", "name": "MultiStoreModel[is_packing_fee]", "attribute": "is_packing_fee", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店统一包装费必须是整数。"}}},{"id": "multistoremodel-store_name", "name": "MultiStoreModel[store_name]", "attribute": "store_name", "rules": {"required":true,"messages":{"required":"门店名称不能为空。"}}},{"id": "multistoremodel-region_code", "name": "MultiStoreModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":" 门店地址不能为空。"}}},{"id": "multistoremodel-address", "name": "MultiStoreModel[address]", "attribute": "address", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "multistoremodel-tel", "name": "MultiStoreModel[tel]", "attribute": "tel", "rules": {"required":true,"messages":{"required":"门店电话不能为空。"}}},{"id": "multistoremodel-region_type", "name": "MultiStoreModel[region_type]", "attribute": "region_type", "rules": {"required":true,"messages":{"required":"地区类型不能为空。"}}},{"id": "multistoremodel-take_rate", "name": "MultiStoreModel[take_rate]", "attribute": "take_rate", "rules": {"required":true,"messages":{"required":"店铺分佣比例不能为空。"}}},{"id": "multistoremodel-clearing_cycle", "name": "MultiStoreModel[clearing_cycle]", "attribute": "clearing_cycle", "rules": {"required":true,"messages":{"required":"结算周期不能为空。"}}},{"id": "multistoremodel-user_id", "name": "MultiStoreModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店管理员不能为空","min":" 绑定门店管理员必须不小于1。"},"min":1}},{"id": "multistoremodel-store_lng", "name": "MultiStoreModel[store_lng]", "attribute": "store_lng", "rules": {"required":true,"messages":{"required":"门店经度不能为空。"}}},{"id": "multistoremodel-store_lat", "name": "MultiStoreModel[store_lat]", "attribute": "store_lat", "rules": {"required":true,"messages":{"required":"门店纬度不能为空。"}}},{"id": "multistoremodel-store_lng", "name": "MultiStoreModel[store_lng]", "attribute": "store_lng", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"门店经度必须是一个数字。","min":"门店经度必须不小于0。"},"min":0}},{"id": "multistoremodel-store_lat", "name": "MultiStoreModel[store_lat]", "attribute": "store_lat", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"门店纬度必须是一个数字。","min":"门店纬度必须不小于0。"},"min":0}},{"id": "multistoremodel-take_rate", "name": "MultiStoreModel[take_rate]", "attribute": "take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺分佣比例必须是一个数字。","decimal":"店铺分佣比例必须是一个不大于2位小数的数字。","min":"店铺分佣比例必须不小于0。","max":"店铺分佣比例必须不大于100。"},"decimal":2,"min":0,"max":100}},{"id": "multistoremodel-other_shipping_fee", "name": "MultiStoreModel[other_shipping_fee]", "attribute": "other_shipping_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"额外配送费必须是一个数字。","decimal":"额外配送费必须是一个不大于2位小数的数字。","min":"额外配送费必须不小于0。","max":"额外配送费必须不大于999999。"},"decimal":2,"min":0,"max":999999}},{"id": "multistoremodel-packing_fee", "name": "MultiStoreModel[packing_fee]", "attribute": "packing_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"包装费必须是一个数字。","decimal":"包装费必须是一个不大于2位小数的数字。","min":"包装费必须不小于0。","max":"包装费必须不大于999999。"},"decimal":2,"min":0,"max":999999}},{"id": "multistoremodel-start_price", "name": "MultiStoreModel[start_price]", "attribute": "start_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"起送价必须是一个数字。","decimal":"起送价必须是一个不大于2位小数的数字。","min":"起送价必须不小于0。","max":"起送价必须不大于999999。"},"decimal":2,"min":0,"max":999999}},{"id": "multistoremodel-store_name", "name": "MultiStoreModel[store_name]", "attribute": "store_name", "rules": {"string":true,"messages":{"string":"门店名称必须是一条字符串。","maxlength":"门店名称只能包含至多20个字符。"},"maxlength":20}},{"id": "multistoremodel-address", "name": "MultiStoreModel[address]", "attribute": "address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-store_img", "name": "MultiStoreModel[store_img]", "attribute": "store_img", "rules": {"string":true,"messages":{"string":"门店主图必须是一条字符串。","maxlength":"门店主图只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-store_remark", "name": "MultiStoreModel[store_remark]", "attribute": "store_remark", "rules": {"string":true,"messages":{"string":"Store Remark必须是一条字符串。","maxlength":"Store Remark只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-close_image", "name": "MultiStoreModel[close_image]", "attribute": "close_image", "rules": {"string":true,"messages":{"string":"门店打烊提示图必须是一条字符串。","maxlength":"门店打烊提示图只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-close_tips", "name": "MultiStoreModel[close_tips]", "attribute": "close_tips", "rules": {"string":true,"messages":{"string":"非营业时间下单提示必须是一条字符串。","maxlength":"非营业时间下单提示只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-tel", "name": "MultiStoreModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"门店电话必须是一条字符串。","maxlength":"门店电话只能包含至多20个字符。"},"maxlength":20}},{"id": "multistoremodel-opening_hour", "name": "MultiStoreModel[opening_hour]", "attribute": "opening_hour", "rules": {"string":true,"messages":{"string":"Opening Hour必须是一条字符串。"}}},{"id": "multistoremodel-store_logo", "name": "MultiStoreModel[store_logo]", "attribute": "store_logo", "rules": {"string":true,"messages":{"string":"门店logo必须是一条字符串。"}}},{"id": "multistoremodel-tel", "name": "MultiStoreModel[tel]", "attribute": "tel", "rules": {"match":{"pattern":/^((0\d{2,3}-\d{7,8})|((13|14|15|17|18|19)\d{9}|(162|165|166|167)\d{8}))$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入正确的手机或座机号码，座机号码格式：XXXX-XXXXXXX。"}}},{"id": "multistoremodel-reserve_money", "name": "MultiStoreModel[reserve_money]", "attribute": "reserve_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"银联商户预留金额必须是一个数字。"}}},{"id": "multistoremodel-reserve_money", "name": "MultiStoreModel[reserve_money]", "attribute": "reserve_money", "rules": {"compare":{"operator":">=","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"银联商户预留金额的值必须大于或等于\"0\"。"}}},{"id": "multistoremodel-reserve_money", "name": "MultiStoreModel[reserve_money]", "attribute": "reserve_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}}]
        </script>
        <script id="user_type_0_template" type="text">
        <input type="text" id="multistoremodel-user_account" class="form-control" name="MultiStoreModel[user_account]" placeholder="会员帐号/手机号/邮箱" data-rule-required="true" data-msg="门店管理员不能为空">
        </script>
        <script id="user_type_1_template" type="text">
        <select id="multistoremodel-user_id" name="MultiStoreModel[user_id]" class="form-control chosen-select" data-rule-required='true' data-msg='门店管理员不能为空'>
            <option vlaue="0">--请选择--</option>
        @if(!empty($user_list))
            @foreach($user_list as $v)
                <option value="{{ $v['user_id'] }}">{{ $v['user_name'] }}</option>
            @endforeach
        @endif
        </select>
        <a href="/shop/account/add.html" target="_blank" class="btn btn-warning btn-sm m-l-5">新建管理员</a>
        <a id="btn_reload_user_list" class="btn btn-primary btn-sm m-l-5">重新加载</a>
        </script>
    @else
        <script id="client_rules" type="text">
        [{"id": "multistoremodel-shop_id", "name": "MultiStoreModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop Id不能为空。"}}},{"id": "multistoremodel-user_type", "name": "MultiStoreModel[user_type]", "attribute": "user_type", "rules": {"required":true,"messages":{"required":"用户类型不能为空。"}}},{"id": "multistoremodel-store_lng", "name": "MultiStoreModel[store_lng]", "attribute": "store_lng", "rules": {"required":true,"messages":{"required":"门店经度不能为空。"}}},{"id": "multistoremodel-store_lat", "name": "MultiStoreModel[store_lat]", "attribute": "store_lat", "rules": {"required":true,"messages":{"required":"门店纬度不能为空。"}}},{"id": "multistoremodel-region_editable", "name": "MultiStoreModel[region_editable]", "attribute": "region_editable", "rules": {"required":true,"messages":{"required":"门店修改销售/配送范围不能为空。"}}},{"id": "multistoremodel-group_id", "name": "MultiStoreModel[group_id]", "attribute": "group_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店分组必须是整数。"}}},{"id": "multistoremodel-region_editable", "name": "MultiStoreModel[region_editable]", "attribute": "region_editable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店修改销售/配送范围必须是整数。"}}},{"id": "multistoremodel-region_type", "name": "MultiStoreModel[region_type]", "attribute": "region_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"地区类型必须是整数。"}}},{"id": "multistoremodel-add_time", "name": "MultiStoreModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Add Time必须是整数。"}}},{"id": "multistoremodel-is_pickup", "name": "MultiStoreModel[is_pickup]", "attribute": "is_pickup", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店是否作为自提点必须是整数。"}}},{"id": "multistoremodel-pickup_id", "name": "MultiStoreModel[pickup_id]", "attribute": "pickup_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Pickup Id必须是整数。"}}},{"id": "multistoremodel-store_status", "name": "MultiStoreModel[store_status]", "attribute": "store_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店状态必须是整数。"}}},{"id": "multistoremodel-edit_info", "name": "MultiStoreModel[edit_info]", "attribute": "edit_info", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许门店修改基本信息必须是整数。"}}},{"id": "multistoremodel-is_allowed_related_goods", "name": "MultiStoreModel[is_allowed_related_goods]", "attribute": "is_allowed_related_goods", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许门店自主关联商品必须是整数。"}}},{"id": "multistoremodel-yl_settle_mode", "name": "MultiStoreModel[yl_settle_mode]", "attribute": "yl_settle_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"银联结算模式必须是整数。"}}},{"id": "multistoremodel-opening_type", "name": "MultiStoreModel[opening_type]", "attribute": "opening_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Opening Type必须是整数。"}}},{"id": "multistoremodel-goods_count", "name": "MultiStoreModel[goods_count]", "attribute": "goods_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Goods Count必须是整数。"}}},{"id": "multistoremodel-out_openhour_order_enable", "name": "MultiStoreModel[out_openhour_order_enable]", "attribute": "out_openhour_order_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"非营业时间是否支持下单必须是整数。"}}},{"id": "multistoremodel-is_other_shpping_fee", "name": "MultiStoreModel[is_other_shpping_fee]", "attribute": "is_other_shpping_fee", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店统一额外配送费必须是整数。"}}},{"id": "multistoremodel-is_packing_fee", "name": "MultiStoreModel[is_packing_fee]", "attribute": "is_packing_fee", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店统一包装费必须是整数。"}}},{"id": "multistoremodel-store_name", "name": "MultiStoreModel[store_name]", "attribute": "store_name", "rules": {"required":true,"messages":{"required":"门店名称不能为空。"}}},{"id": "multistoremodel-region_code", "name": "MultiStoreModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":" 门店地址不能为空。"}}},{"id": "multistoremodel-address", "name": "MultiStoreModel[address]", "attribute": "address", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "multistoremodel-tel", "name": "MultiStoreModel[tel]", "attribute": "tel", "rules": {"required":true,"messages":{"required":"门店电话不能为空。"}}},{"id": "multistoremodel-region_type", "name": "MultiStoreModel[region_type]", "attribute": "region_type", "rules": {"required":true,"messages":{"required":"地区类型不能为空。"}}},{"id": "multistoremodel-take_rate", "name": "MultiStoreModel[take_rate]", "attribute": "take_rate", "rules": {"required":true,"messages":{"required":"店铺分佣比例不能为空。"}}},{"id": "multistoremodel-clearing_cycle", "name": "MultiStoreModel[clearing_cycle]", "attribute": "clearing_cycle", "rules": {"required":true,"messages":{"required":"结算周期不能为空。"}}},{"id": "multistoremodel-store_id", "name": "MultiStoreModel[store_id]", "attribute": "store_id", "rules": {"required":true,"messages":{"required":"Store Id不能为空。"}}},{"id": "multistoremodel-store_lng", "name": "MultiStoreModel[store_lng]", "attribute": "store_lng", "rules": {"required":true,"messages":{"required":"门店经度不能为空。"}}},{"id": "multistoremodel-store_lat", "name": "MultiStoreModel[store_lat]", "attribute": "store_lat", "rules": {"required":true,"messages":{"required":"门店纬度不能为空。"}}},{"id": "multistoremodel-store_lng", "name": "MultiStoreModel[store_lng]", "attribute": "store_lng", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"门店经度必须是一个数字。","min":"门店经度必须不小于0。"},"min":0}},{"id": "multistoremodel-store_lat", "name": "MultiStoreModel[store_lat]", "attribute": "store_lat", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"门店纬度必须是一个数字。","min":"门店纬度必须不小于0。"},"min":0}},{"id": "multistoremodel-take_rate", "name": "MultiStoreModel[take_rate]", "attribute": "take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺分佣比例必须是一个数字。","decimal":"店铺分佣比例必须是一个不大于2位小数的数字。","min":"店铺分佣比例必须不小于0。","max":"店铺分佣比例必须不大于100。"},"decimal":2,"min":0,"max":100}},{"id": "multistoremodel-other_shipping_fee", "name": "MultiStoreModel[other_shipping_fee]", "attribute": "other_shipping_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"额外配送费必须是一个数字。","decimal":"额外配送费必须是一个不大于2位小数的数字。","min":"额外配送费必须不小于0。","max":"额外配送费必须不大于999999。"},"decimal":2,"min":0,"max":999999}},{"id": "multistoremodel-packing_fee", "name": "MultiStoreModel[packing_fee]", "attribute": "packing_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"包装费必须是一个数字。","decimal":"包装费必须是一个不大于2位小数的数字。","min":"包装费必须不小于0。","max":"包装费必须不大于999999。"},"decimal":2,"min":0,"max":999999}},{"id": "multistoremodel-start_price", "name": "MultiStoreModel[start_price]", "attribute": "start_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"起送价必须是一个数字。","decimal":"起送价必须是一个不大于2位小数的数字。","min":"起送价必须不小于0。","max":"起送价必须不大于999999。"},"decimal":2,"min":0,"max":999999}},{"id": "multistoremodel-store_name", "name": "MultiStoreModel[store_name]", "attribute": "store_name", "rules": {"string":true,"messages":{"string":"门店名称必须是一条字符串。","maxlength":"门店名称只能包含至多20个字符。"},"maxlength":20}},{"id": "multistoremodel-address", "name": "MultiStoreModel[address]", "attribute": "address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-store_img", "name": "MultiStoreModel[store_img]", "attribute": "store_img", "rules": {"string":true,"messages":{"string":"门店主图必须是一条字符串。","maxlength":"门店主图只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-store_remark", "name": "MultiStoreModel[store_remark]", "attribute": "store_remark", "rules": {"string":true,"messages":{"string":"Store Remark必须是一条字符串。","maxlength":"Store Remark只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-close_image", "name": "MultiStoreModel[close_image]", "attribute": "close_image", "rules": {"string":true,"messages":{"string":"门店打烊提示图必须是一条字符串。","maxlength":"门店打烊提示图只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-close_tips", "name": "MultiStoreModel[close_tips]", "attribute": "close_tips", "rules": {"string":true,"messages":{"string":"非营业时间下单提示必须是一条字符串。","maxlength":"非营业时间下单提示只能包含至多255个字符。"},"maxlength":255}},{"id": "multistoremodel-tel", "name": "MultiStoreModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"门店电话必须是一条字符串。","maxlength":"门店电话只能包含至多20个字符。"},"maxlength":20}},{"id": "multistoremodel-opening_hour", "name": "MultiStoreModel[opening_hour]", "attribute": "opening_hour", "rules": {"string":true,"messages":{"string":"Opening Hour必须是一条字符串。"}}},{"id": "multistoremodel-store_logo", "name": "MultiStoreModel[store_logo]", "attribute": "store_logo", "rules": {"string":true,"messages":{"string":"门店logo必须是一条字符串。"}}},{"id": "multistoremodel-tel", "name": "MultiStoreModel[tel]", "attribute": "tel", "rules": {"match":{"pattern":/^((0\d{2,3}-\d{7,8})|((13|14|15|17|18|19)\d{9}|(162|165|166|167)\d{8}))$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入正确的手机或座机号码，座机号码格式：XXXX-XXXXXXX。"}}},{"id": "multistoremodel-reserve_money", "name": "MultiStoreModel[reserve_money]", "attribute": "reserve_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"银联商户预留金额必须是一个数字。"}}},{"id": "multistoremodel-reserve_money", "name": "MultiStoreModel[reserve_money]", "attribute": "reserve_money", "rules": {"compare":{"operator":">=","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"银联商户预留金额的值必须大于或等于\"0\"。"}}},{"id": "multistoremodel-reserve_money", "name": "MultiStoreModel[reserve_money]", "attribute": "reserve_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}}]
        </script>
        <script id="user_type_0_template" type="text">
        <input type="text" id="multistoremodel-user_account" class="form-control" name="MultiStoreModel[user_account]" value="客服2" placeholder="会员帐号/手机号/邮箱" data-rule-required="true" data-msg="门店管理员不能为空">
        </script>
                <script id="user_type_1_template" type="text">
        <select id="multistoremodel-user_id" name="MultiStoreModel[user_id]" class="form-control chosen-select" data-rule-required='true' data-msg='门店管理员不能为空'>
            <option vlaue="0">--请选择--</option>
        </select>
        <a href="/shop/account/add.html" target="_blank" class="btn btn-warning btn-sm m-l-5">新建管理员</a>
        <a id="btn_reload_user_list" class="btn btn-primary btn-sm m-l-5">重新加载</a>
        </script>
    @endif

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
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript"
            src="//webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder"></script>
    <script type="text/javascript">
        //
    </script>
    <a class="totop animation" href="javascript:;"><i class="fa fa-angle-up"></i></a>
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

    <script>
        // 营业时间不能超过三条
        function checkLength(key) {
            var t = "time-subtime-" + key;
            var add_opentime = "add_opentime_" + key;
            if ($('.' + t).length >= 3) {
                $("#" + add_opentime).addClass("disabled");
            } else {
                $("#" + add_opentime).removeClass("disabled");
            }
        }
        //checkLength();
        $("#add_week").click(function() {
            var key = $(this).data('key');
            $(this).data('key', key + 1);
            $.get("/dashboard/multi-store/get-week.html", {
                key: key,
                is_opening:1
            }, function(result) {
                if (result.code == 0) {
                    $('.table1').append(result.data);
                }
            }, "JSON").always(function() {
            });
        });
        //
        $().ready(function () {
            //非营业时间不支持下单，隐藏非营业时间下单提示
            $(".enable-switch-on-off").on('switchChange.bootstrapSwitch', function(e, state) {
                var close_tips=$(".close-tips");
                if (!state) {
                    close_tips.addClass('hide');
                } else {
                    close_tips.removeClass('hide');
                }
            });
            //悬浮显示上下步骤按钮
            window.onscroll = function () {
                $(window).scroll(function () {
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
            var validator = $("#MultiStoreModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            var error_list = [];
            $("#btn_submit").click(function () {
                if($("#region_code").data("is_last")===false) {
                    $.alert('请选择完整的门店地址');
                    return ;
                }
                if (!validator.form()) {
                    var html = "";
                    error_list = validator.errorList;
                    for (var i = 0; i < validator.errorList.length; i++) {
                        var element = validator.errorList[i].element;
                        var message = validator.errorList[i].message;
                        html += "<div><a href='javascript:void(0);' data-id='" + i + "'>" + message + "</a></div>";
                    }
                    $.alert("<div id='error_list'>" + html + "</div>");
                    $("#error_list").find("a").click(function () {
                        var i = $(this).data("id");
                        if (error_list[i] && error_list[i].element) {
                            $(error_list[i].element).focus();
                        }
                    });
                    return;
                }
                var data = $("#MultiStoreModel").serializeJson();
                data.store_regions = [];
                if (data.MultiStoreModel.region_type == 0) {
                    $("#region_type_0").find(".region-selected").find(".region-code").each(function () {
                        data.store_regions.push({
                            'region_code': $(this).data("region_code"),
                            'region_name': $(this).data("region_name"),
                        });
                    });
                } else {
                    $("#region_type_1").find(".freight-records-item").each(function () {
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
                $(this).attr("disabled", true);
                var url = $("#MultiStoreModel").attr("action");
                $.post(url, data, function (result) {
                    if (result.code == 0) {
                        $.go("/dashboard/multi-store/index");
                        $.msg(result.message, {
                            time: 3000
                        });
                    } else {
                        $("#btn_submit").attr("disabled", false);
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function () {
                    $.loading.stop();
                });
                return false;
            });
        });
        //
        $(".szy-imagegroup").each(function () {
            var id = $(this).data("id");
            var size = $(this).data("size");
            var target = $("#" + id);
            var value = $(target).val();
            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: size,
                values: value.split("|"),
                // 回调函数
                callback: function (data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                },
                // 移除的回调函数
                remove: function (value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                }
            });
        });
        //
        //当前已选择的地区
        var region_codes_now = [];
        // 不能选择的地区
        var region_codes_not = [];
        $().ready(function () {
            $("#region_container").regionselector({
                value: '{{ $model['region_code'] ?? '' }}',
                select_class: 'form-control',
                change: function (value, names, is_last) {
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
            $("input[type='radio']").click(function () {
                if ($("input[type='radio']:checked").val() == 0) {
                    $("#opening").hide();
                } else {
                    $("#opening").show();
                }
            });
            // 全国地区模板运费选择地区
            $("body").on("click", ".region-edit", function () {
                var target = this;
                region_codes_now = {};
                region_codes_not = {};
                var table = null;
                $("#region_type_0").find(".region-selected").find(".region-code").each(function () {
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
                        url: "/dashboard/multi-store/region-picker"
                    },
                    btn: ['确定', '取消'],
                    success: function (object, index) {
                        $.loading.stop();
                    },
                    yes: function (index, object) {
                        var regions = [];
                        var region_codes = [];
                        var region_names = [];
                        $(object).find(".region-selected").find("a").each(function () {
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
                    onhide: function () {
                        $(".region-codes").each(function () {
                            $(this).valid();
                        });
                    }
                });
            });
            $("body").on("click", ".selector-set a i", function () {
                $(this).parents("a").remove();
            });
        });
        //
        var map;
        $().ready(function () {
            var x = $("#store_lng").val();
            var y = $("#store_lat").val();
            if (x == "" || y == "") {
                x = 0;
                y = 0;
                var lnglatXY = new AMap.LngLat(x, y);
                map = new AMap.Map("container", {
                    resizeEnable: true,
                    doubleClickZoom: false,
                    zoom: 13
                });
            } else {
                var lnglatXY = new AMap.LngLat(x, y);
                map = new AMap.Map("container", {
                    resizeEnable: true,
                    doubleClickZoom: false,
                    zoom: 15,
                    center: lnglatXY
                });
            }
            map.plugin(["AMap.ToolBar"], function () {
                // 加载工具条
                var tool = new AMap.ToolBar();
                map.addControl(tool);
            });
            var marker;
            var geocoder;
            regeocoder();
            $("#map_search").click(function () {
                $("#panel").show();
                AMap.service(["AMap.PlaceSearch"], function () {
                    // 构造地点查询类
                    var placeSearch = new AMap.PlaceSearch({
                        pageSize: 6,
                        map: map,
                        panel: "panel"
                    });
                    var array = $("#region_name").val().split(",");
                    var keyword = array.join("");
                    var keyword = keyword + $("#multistoremodel-address").val();
                    // 关键字查询
                    placeSearch.search(keyword);
                    // 点击搜索结果改变坐标点位置
                    AMap.event.addListener(placeSearch, 'listElementClick', function (e) {
                        var location = e.data.location;
                        var x = location.lng;
                        var y = location.lat;
                        lnglatXY = new AMap.LngLat(x, y);
                        regeocoder();
                        //    $("#panel").hide();
                        $("#store_lng").val(x);
                        $("#store_lat").val(y);
                    });
                });
            });
            // 点击地图改变坐标点位置
            AMap.event.addListener(map, 'click', function (e) {
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
                map.plugin(["AMap.Geocoder"], function () {
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
                marker.on('mouseup', function (e) {
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
                    openInfo($("#multistoremodel-address").val());
                } else {
                    var address = data.regeocode.formattedAddress;
                    var array = $("#region_name").val().split(","); // 返回地址描述
                    for (var i = 0; i < array.length; i++) {
                        address = address.replace(array[i], '');
                    }
                    address = address.replace('省', '');
                    address = address.replace('市', '');
                    $("#multistoremodel-address").val(address);
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
            $("#multistoremodel-address").keypress(function (e) {
                if (event.keyCode == 13) {
                    $("#map_search").click();
                }
            });
            // 重新加载门店分组
            $("#btn_reload_group_list").click(function () {
                $.loading.start();
                $.get("/dashboard/multi-store/group-list.html", {
                    format: "json"
                }, function (result) {
                    if (result.code == 0) {
                        var list = result.data;
                        var html = "";
                        for (var name in result.data) {
                            html += "<option value='" + name + "'>" + result.data[name] + "</option>";
                        }
                        $("#multistoremodel-group_id").html(html);
                        $("#multistoremodel-group_id").chosen("destroy").chosen();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function () {
                    $.loading.stop();
                });
            });
            // 重新加载管理员列表
            $("body").on("click", "#btn_reload_user_list", function () {
                $.loading.start();
                $.get("/dashboard/multi-store/user-list.html", {
                    format: "json"
                }, function (result) {
                    if (result.code == 0) {
                        var list = result.data;
                        var html = "<option value='0'>--请选择--</option>";
                        for (var i = 0; i < list.length; i++) {
                            var user_id = list[i].user_id;
                            var user_name = list[i].user_name;
                            html += "<option value='" + user_id + "'>" + user_name + "</option>";
                        }
                        $("#multistoremodel-user_id").html(html);
                        $("#multistoremodel-user_id").chosen("destroy").chosen();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function () {
                    $.loading.stop();
                });
            });
        });
        //
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
                $(".bottom-btn").addClass('bottom-btn-fixed');
                $(".freight-records-item .view").show();
                $(".freight-records-item .edit").hide();
                // 遍历赋值
                $(".freight-records-item").each(function () {
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
                $(".bottom-btn").removeClass('bottom-btn-fixed');
                $(".freight-records-item .view").hide();
                $(".freight-records-item .edit").show();
            }
        }
        // 点击编辑配送区域按钮
        $("#btn_edit_area").click(function () {
            mapToggle();
        });
        // 点击确定按钮
        $("#btn_ok").click(function () {
            // 检查输入
            var is_valid = true;
            var element = null;
            $(".freight-records-item").each(function () {
                $(this).find(":input").not(".region-codes").not(".region-names").not(".region-desc").each(function () {
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
                            getRegionCode(center.lng, center.lat, function (region_code, region_name) {
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
        $().ready(function () {
            $("input[name='MultiStoreModel[region_type]']").change(function () {
                var value = $(this).val();
                $("#region_type_" + value).show();
                value = value == 0 ? 1 : 0;
                $("#region_type_" + value).hide();
            });
        });
        //
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
                    $(free_record_tr).find(".region-names-label").html('<span class="block ' + color + '"></span>' + label);
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
            polygon.on("click", function (e) {
                if ($('.amap-container').hasClass('toggle')) {
                    editor.open();
                    polygon.setDraggable(true);
                    polygon.setOptions({
                        zIndex: zIndex++
                    });
                }
            });
            // 点击地图其他地方关闭编辑功能
            map.on("click", function () {
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
            $(element).find(":input").filter(".region-names").blur(function () {
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
            geocoder.getAddress([lng, lat], function (status, result) {
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
                    $.alert("访问高德地图服务接口失败！请联系系统管理员检查是否在高德开放平台创建了web端应用并授权当前网址可以访问！");
                }
                if ($.isFunction(callback)) {
                    callback.call(result, region_code, region_name);
                }
            });
        }
        $().ready(function () {
            $("[data-toggle='popover']").popover();
            var map = null;
            // 经度
            var store_lng = "{{ $model['store_lng'] ?? '' }}";
            //纬度
            var store_lat = "{{ $model['store_lat'] ?? '' }}";
            var mark_title = "门店所在位置";
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
                mark_title = "您尚未设置门店位置，当前为您所在的位置";
            }
            //当前位置
            map.plugin('AMap.Geolocation', function () {
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
            $("#btn_add_area").click(function () {
                addArea(map, null, null, []);
            });
            // 点击让配送区域居中
            $("body").on("click", ".freight-records-item", function () {
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
            $("body").on("click", ".freight-records-item-remove", function () {
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
            $("#btn_location").click(function () {
                var lng = $("#store_lng").val();
                var lat = $("#store_lat").val();
                if (lng == "" && lat == "") {
                    $.msg("请先设置门店位置！");
                    $("#multistoremodel-address").focus();
                    return;
                }
                map.setCenter([lng, lat]);
                mark_title = "门店所在位置";
                marker.setTitle(mark_title);
                // 给地图添加点标记等覆盖物
                marker.setPosition([lng, lat]);
            });
            //
        });
        $(".add-store-group").click(function () {
            url = '/dashboard/multi-store-group/add';
            $.open({
                type: 1,
                title: '添加门店分组',
                area: ['600px', '280px'],
                ajax: {
                    url: url,
                },
                btn: ['确认提交', '取消'],
                yes: function (index, obj) {
                    if (!validator.form()) {
                        return;
                    }
                    //加载提示
                    $.loading.start();
                    var data = $(obj).serializeJson();
                    $.post(url, data, function (result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            $.closeAll();
                        } else {
                            $.msg(result.message);
                        }
                    }, "JSON").always(function () {
                        $.loading.stop();
                    });
                }
            });
        });
        $('input:radio[name="MultiStoreModel[opening_type]"]').change(function () {
            var opening_type = $(this).val();
            var store_id = "{{ $model['store_id'] ?? '' }}";
            if (opening_type == 0) {
                $("#opening_type_area").html("");
                return;
            }
            $("#opening_type_area").show();
            // $.loading.start();
            $.get("/dashboard/multi-store/get-opening-hour.html", {
                opening_type: opening_type,
                store_id: store_id
            }, function (result) {
                if (result.code == 0) {
                    $("#opening_type_area").html(result.data);
                }
            }, "JSON").always(function () {
                // $.loading.stop();
            });
        });
        $("input[name='MultiStoreModel[user_type]']").click(function () {
            var value = $(this).val();
            var html = $("#user_type_" + value + "_template").html();
            $("#user_type_" + value).html(html).show();
            $("#user_type_" + value).find(".chosen-select").chosen();
            value = value == 0 ? 1 : 0;
            $("#user_type_" + value).html("");
            validator = $("#MultiStoreModel").validate();
        });
        // 删除营业时间
        $("body").on("click", "#del_opentime", function () {
            var target = this;
            var key = $(this).data('key');
            var t = "time-subtime-" + key;
            if ($('.' + t).length == 1) {
                $(target).parents('tr').remove();
                return;
            }
            $(target).parent().parent().remove();
            checkLength(key);
        });
        // 新建营业时间
        $("body").on("click", ".add-open-time", function () {
            var key = $(this).data('key');
            var t = "time-subtime-" + key;
            if ($('.' + t).length >= 3) {
                return;
            }
            $.get("/dashboard/multi-store/get-time.html", {
                key: key
            }, function (result) {
                if (result.code == 0) {
                    var html = result.data;
                    var element = $($.parseHTML(html));
                    var btn = "add-btn-" + key;
                    element.insertBefore($("." + btn));
                    checkLength(key);
                }
            }, "JSON").always(function () {
            });
        });
    </script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')


@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
