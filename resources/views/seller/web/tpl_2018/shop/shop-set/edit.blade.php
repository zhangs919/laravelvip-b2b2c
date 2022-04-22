{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}"></script>
    <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>
    <style type="text/css">
        #panel {
            position: absolute;
            background-color: white;
            max-height: 90%;
            overflow-y: auto;
            top: 10px;
            right: 10px;
            width: 280px;
        }
    </style>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="ShopModel" class="form-horizontal" name="ShopModel" action="/shop/shop-set/edit" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="table-content m-t-30  clearfix">
            <h5 class="m-b-30 m-t-0">店铺基本信息</h5>

            <!-- 店铺ID -->
            <input type="hidden" id="shopmodel-shop_id" class="form-control" name="ShopModel[shop_id]" value="{{ $model['shop_id'] }}">
            <!-- 店铺名称  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-shop_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-shop_name" class="form-control" name="ShopModel[shop_name]" value="{{ $model['shop_name'] }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 店铺头像 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-shop_image" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺头像：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->

                            <div id="shop_image_imagegroup_container" class="szy-imagegroup pull-left" data-id="shopmodel-shop_image" data-size="1"></div>

                            <input type="hidden" id="shopmodel-shop_image" class="form-control" name="ShopModel[shop_image]" value="{{ $model['shop_image'] }}">
                            <span class="c-blue pull-left" style="margin: 20px 0 0 50px;">
			查看示例
			<i data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='200' height='180' src='/images/shop/pattern-shop-head.png'>" class="fa fa-question-circle f16 c-orange m-l-5 cur-p"></i>
		</span>
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺头像用于手机端店铺展示，平台方后台店铺列表中店铺图片展示，文件格式GIF、JPG、JPEG、PNG文件大小80k以内，建议尺寸80*80像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺LOGO -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-shop_logo" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺LOGO：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->

                            <div id="shop_logo_imagegroup_container" class="szy-imagegroup pull-left" data-id="shopmodel-shop_logo" data-size="1"></div>

                            <input type="hidden" id="shopmodel-shop_logo" class="form-control" name="ShopModel[shop_logo]" value="{{ $model['shop_logo'] }}">
                            <span class="c-blue pull-left" style="margin: 20px 0 0 50px;">
			查看示例
			<i data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='200' height='180' src='/images/shop/pattern-shop-logo.png'>" class="fa fa-question-circle f16 c-orange m-l-5 cur-p"></i>
		</span>
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">文件格式GIF、JPG、JPEG、PNG文件大小80k以内，建议尺寸120*60像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺海报 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-shop_poster" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺海报：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->

                            <div id="shop_poster_imagegroup_container" class="szy-imagegroup pull-left" data-id="shopmodel-shop_poster" data-size="1"></div>

                            <input type="hidden" id="shopmodel-shop_poster" class="form-control" name="ShopModel[shop_poster]" value="{{ $model['shop_poster'] }}">
                            <span class="c-blue pull-left" style="margin: 20px 0 0 50px;">
			查看示例
			<i data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='200' height='180' src='/images/shop/pattern-shop-poster.png'>" class="fa fa-question-circle f16 c-orange m-l-5 cur-p"></i>
		</span>
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于店铺街页面展示，文件格式GIF、JPG、JPEG、PNG文件大小80k以内，建议尺寸390*200像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺招牌 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-shop_sign" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺招牌：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->

                            <div id="shop_sign_imagegroup_container" class="szy-imagegroup pull-left" data-id="shopmodel-shop_sign" data-size="1"></div>

                            <input type="hidden" id="shopmodel-shop_sign" class="form-control" name="ShopModel[shop_sign]" value="{{ $model['shop_sign'] }}">
                            <span class="c-blue pull-left" style="margin: 20px 0 0 50px;">
			查看示例
			<i data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='300' height='130' src='/images/shop/pattern-shop-sign.png'>" class="fa fa-question-circle f16 c-orange m-l-5 cur-p"></i>
		</span>
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于店铺首页页面展示，文件格式GIF、JPG、JPEG、PNG文件大小80k以内，建议尺寸1920*188像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺招牌(微) -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-shop_sign_m" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺招牌(微)：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->

                            <div id="shop_sign_m_imagegroup_container" class="szy-imagegroup pull-left" data-id="shopmodel-shop_sign_m" data-size="1"></div>

                            <input type="hidden" id="shopmodel-shop_sign_m" class="form-control" name="ShopModel[shop_sign_m]" value="{{ $model['shop_sign_m'] }}">
                            <span class="c-blue pull-left" style="margin: 20px 0 0 50px;">
			查看示例
			<i data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='200' height='180' src='/images/shop/pattern-shop-w-sign.png'>" class="fa fa-question-circle f16 c-orange m-l-5 cur-p"></i>
		</span>
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于微商城店铺首页页面展示，文件格式GIF、JPG、JPEG、PNG文件大小80k以内，建议尺寸1000*400像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺介绍 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-detail_introduce" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺公告：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shopmodel-detail_introduce" class="form-control" name="ShopModel[detail_introduce]" rows="5">{!! $model['detail_introduce'] !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺公告设置，将会在店铺首页展示，50个字以内</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺关键词  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-shop_keywords" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺关键词：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shopmodel-shop_keywords" class="form-control" name="ShopModel[shop_keywords]" rows="5">{{ $model['shop_keywords'] }}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺关键词会加入到店铺SEO优化中，50个字以内</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺简介  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-shop_description" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺简介：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shopmodel-shop_description" class="form-control" name="ShopModel[shop_description]" rows="5">{!! $model['shop_description'] !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺简介会加入到店铺SEO优化中，100个字以内</div></div>
                    </div>
                </div>
            </div>

            <!-- 店铺经营信息 -->
            <h5 class="m-b-30">店铺经营信息</h5>
            <!-- 店铺简介  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-start_price" class="col-sm-4 control-label">

                        <span class="ng-binding">起送金额：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-start_price" class="form-control ipt m-r-10" name="ShopModel[start_price]" value="{{ $model['start_price'] ?? '0.00' }}">元


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">起送金额为商品促销后的实际售价，在红包抵扣、订单满减等订单优惠之前，不包括运费</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">营业时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <table class="table table-bordered shop-time-table">
                                <thead>
                                <tr>
                                    <th>周一</th>
                                    <th>周二</th>
                                    <th>周三</th>
                                    <th>周四</th>
                                    <th>周五</th>
                                    <th>周六</th>
                                    <th>周日</th>
                                    <th class="w150">开始时间</th>
                                    <th class="w150">结束时间</th>
                                    <th class="handle w50">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach(range(0, 6) as $item)
                                    <td>
                                        @if(!empty($model['opening_hour']['week']))
                                        <input class="check" type="checkbox" name="opening_hour[week][]"
                                               value="{{ $item }}" @if(in_array($item, @$model['opening_hour']['week'])) checked="checked" @endif  />
                                        @else
                                            <input class="check" type="checkbox" name="opening_hour[week][]"
                                                   value="{{ $item }}"  />
                                        @endif
                                    </td>
                                    @endforeach

                                    <td class="time-panel" colspan="3">
                                        <!--点击新建营业时间按钮每次添加time-subtime一个DIV内容，默认只显示一个-->

                                        @if(!empty($model['opening_hour']['time_arr']))
                                        @foreach($model['opening_hour']['time_arr'] as $item)
                                            <div class="time-subtime">
                                                <div class="time-select">
                                                    <select name="opening_hour[begin_hour][]" class="select form-control m-r-5">
                                                        @foreach(get_day_hours() as $hk=>$h)
                                                        <!--   -->
                                                        <option value="{{ $h }}" @if($item['begin_hour'] == $h) selected="selected" @endif>{{ $h }}</option>
                                                        @endforeach

                                                    </select>
                                                    :
                                                    <select name="opening_hour[begin_minute][]" class="select form-control m-l-5">
                                                        @foreach(get_hour_minutes() as $hk=>$h)
                                                            <!--   -->
                                                            <option value="{{ $h }}" @if($item['begin_minute'] == $h) selected="selected" @endif>{{ $h }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="time-select">
                                                    <select name="opening_hour[end_hour][]" class="select form-control m-r-5">
                                                        @foreach(get_day_hours() as $hk=>$h)
                                                            <!--   -->
                                                            <option value="{{ $h }}" @if($item['end_hour'] == $h) selected="selected" @endif>{{ $h }}</option>
                                                        @endforeach

                                                    </select>
                                                    :
                                                    <select name="opening_hour[end_minute][]" class="select form-control m-l-5">
                                                        @foreach(get_hour_minutes() as $hk=>$h)
                                                            <!--   -->
                                                            <option value="{{ $h }}" @if($item['end_minute'] == $h) selected="selected" @endif>{{ $h }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="handle">
                                                    <a id="del_opentime" class="c-blue" href="javascript:void();">删除</a>
                                                </div>
                                            </div>
                                        @endforeach
                                        @else
                                            <div class="time-subtime">
                                                <div class="time-select">
                                                    <select name="opening_hour[begin_hour][]" class="select form-control m-r-5">
                                                    @foreach(get_day_hours() as $hk=>$h)
                                                        <!--   -->
                                                            <option value="{{ $h }}" >{{ $h }}</option>
                                                        @endforeach

                                                    </select>
                                                    :
                                                    <select name="opening_hour[begin_minute][]" class="select form-control m-l-5">
                                                    @foreach(get_hour_minutes() as $hk=>$h)
                                                        <!--   -->
                                                            <option value="{{ $h }}" >{{ $h }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="time-select">
                                                    <select name="opening_hour[end_hour][]" class="select form-control m-r-5">
                                                    @foreach(get_day_hours() as $hk=>$h)
                                                        <!--   -->
                                                            <option value="{{ $h }}" >{{ $h }}</option>
                                                        @endforeach

                                                    </select>
                                                    :
                                                    <select name="opening_hour[end_minute][]" class="select form-control m-l-5">
                                                    @foreach(get_hour_minutes() as $hk=>$h)
                                                        <!--   -->
                                                            <option value="{{ $h }}" >{{ $h }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="handle">
                                                    <a id="del_opentime" class="c-blue" href="javascript:void();">删除</a>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="time-subtime add-btn text-c">
                                            <a id="add_opentime" class="btn btn-primary">+ 新建营业时间</a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 非营业时间下单提示 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-close_tips" class="col-sm-4 control-label">

                        <span class="ng-binding">非营业时间下单提示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <textarea id="shopmodel-close_tips" class="form-control valid" name="ShopModel[close_tips]" rows="5">{!! $model['close_tips'] !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">消费者在店铺非营业时间下单，提交订单时，展示的提示信息</div></div>
                    </div>
                </div>
            </div>

            <!-- 店铺是否统一额外配送费 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-is_other_shpping_fee" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺是否统一额外配送费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopModel[is_other_shpping_fee]" value="0">
                                    <label><input type="checkbox" id="shopmodel-is_other_shpping_fee" class="form-control b-n" name="ShopModel[is_other_shpping_fee]" value="1" @if($model['is_other_shpping_fee'] == 1) checked @endif data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：超过店铺设置的下单时间超过几点，收取额外配送费，全店铺所有商品统一额外配送费金额，无论订单购买多少商品，仅收一次额外配送费；<br>否：每个商品的额外配送金额受运费模板中控制，一笔订单多个商品，每个商品所属的运费模板均不同，则额外配送费累加</div></div>
                    </div>
                </div>
            </div>
            <!-- 额外配送费  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-other_shipping_fee" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            下单时间不在
                            <select name="shipping_time[begin_hour]" class="select form-control m-l-5 m-r-5">
                                @foreach(get_day_hours() as $hk=>$h)
                                    <!--   -->
                                    <option value="{{ $h }}" @if($model['shipping_time']['begin_hour'] == $h) selected="selected" @endif>{{ $h }}</option>
                                @endforeach
                            </select>
                            :
                            <select name="shipping_time[begin_minute]" class="select form-control m-l-5 m-r-5">
                                @foreach(get_hour_minutes() as $hk=>$h)
                                    <!--   -->
                                    <option value="{{ $h }}" @if($model['shipping_time']['begin_minute'] == $h) selected="selected" @endif>{{ $h }}</option>
                                @endforeach
                            </select>
                            至
                            <select name="shipping_time[end_hour]" class="select form-control m-l-5 m-r-5">
                            @foreach(get_day_hours() as $hk=>$h)
                                <!--   -->
                                <option value="{{ $h }}" @if($model['shipping_time']['end_hour'] == $h) selected="selected" @endif>{{ $h }}</option>
                            @endforeach

                            </select>
                            :
                            <select name="shipping_time[end_minute]" class="select form-control m-l-5 m-r-5">
                            @foreach(get_hour_minutes() as $hk=>$h)
                                <!--   -->
                                <option value="{{ $h }}" @if($model['shipping_time']['end_minute'] == $h) selected="selected" @endif>{{ $h }}</option>
                            @endforeach

                            </select>
                            范围内，额外增加配送费 <input type="text" id="shopmodel-other_shipping_fee" class="form-control ipt m-r-10" name="ShopModel[other_shipping_fee]" value="{{ $model['other_shipping_fee'] }}">元


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺是否统一包装费 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-is_packing_fee" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺是否统一包装费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopModel[is_packing_fee]" value="0">
                                    <label><input type="checkbox" id="shopmodel-is_packing_fee" class="form-control b-n" name="ShopModel[is_packing_fee]" value="1" @if($model['is_packing_fee'] == 1) checked @endif data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：全店铺所有商品统一包装费，无论订单购买多少商品，仅收一次包装费；<br>否：每个商品的包装费金额受运费模板中控制，一笔订单多个商品，每个商品所属的运费模板均不同，则包装费累加</div></div>
                    </div>
                </div>
            </div>
            <!-- 包装费  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-packing_fee" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            包装费 <input type="text" id="shopmodel-packing_fee" class="form-control ipt m-r-10" name="ShopModel[packing_fee]" value="{{ $model['packing_fee'] }}">元


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">联系地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div id="form-control-box">
                            <div id="region_container"></div>
                            <input type="hidden" id="region_code" name="ShopModel[region_code]" value="">
                            <input type="hidden" id="region_name" value="">
                            <input type="hidden" id="load" value="1">
                        </div>
                    </div>
                </div>
            </div>
            <!-- 详细地址  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-address" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">详细地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-address" class="form-control valid address" name="ShopModel[address]" value="{{ $model['address'] }}">
                            <input type="button" class="btn btn-primary" id="map_search" name="map_search" value="搜索地图" />

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请填写详细地址，以便买家联系；（勿重复填写省市区信息）</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺精确位置：</span>
                    </label>
                    <div class="col-sm-5">
                        <div class="form-control-box">
                            <div id="container" style="margin-bottom: 5px; width: 700px; height: 400px; border: 1px solid #D7D7D7; overflow: hidden;"></div>
                            <div id="panel"></div>
                            <div class="help-block help-block-t">单击地图出现蓝点，您可通过移动蓝点来设置您店铺的精准位置，双击地图可查看更精确的地区</div>
                            <br />
                            经度：
                            <input class="form-control ipt m-r-20" type="text" id="shop_lng" name="ShopModel[shop_lng]" value="{{ $model['shop_lng'] }}" readonly="readonly" />
                            纬度：
                            <input class="form-control ipt" type="text" id="shop_lat" name="ShopModel[shop_lat]" value="{{ $model['shop_lat'] }}" readonly="readonly" />
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="m-b-30">店铺商品购买权限信息</h5>
            <!-- 店铺价格是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-show_price" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺价格是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopModel[show_price]" value="0">
                                    <label><input type="checkbox" id="shopmodel-show_price" class="form-control b-n"
                                                  name="ShopModel[show_price]" value="1" @if($model['show_price'] == 1) checked @endif data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是，则店铺商品价格在前台展示；否，店铺商品价格将不在前台展示</div></div>
                    </div>
                </div>
            </div>

            <!-- 店铺价格显示内容 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-show_content" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺价格显示内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-show_content" class="form-control" name="ShopModel[show_content]" value="{{ $model['show_content'] }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺控制商品价格不展示时，前台所有展示商品的页面，价格处所展示的文字，未填写，则默认展示“面议”，建议最多显示2个字	</div></div>
                    </div>
                </div>
            </div>

            <!-- 购买按钮显示内容  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-button_content" class="col-sm-4 control-label">

                        <span class="ng-binding">购买按钮显示内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-button_content" class="form-control" name="ShopModel[button_content]" value="{{ $model['button_content'] }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺控制商品价格不展示时，前台所有展示商品的页面，购买按钮处所展示的文字，未填写，则默认展示“无权购买”，建议最多显示4个字</div></div>
                    </div>
                </div>
            </div>

            <!-- 购买按钮链接地址  -->



            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">
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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180702"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180702"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180702"></script>
    <!-- 在线文本编辑器 -->
    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=20180702"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=20180702"></script>
    <!-- 创建KindEditor的脚本 必须设置editor_id属性，editor_id为文本域的ID属性 -->

    <script type="text/javascript">
        KindEditor.ready(function(K) {

            var extraFileUploadParams = [];
            extraFileUploadParams['B2B2C_YUNMALL_68MALL_COM_USER_PHPSESSID'] = 'efoa8elmam95sa17e24vp0ov33';

            window.editor = K.create('#detail_introduce', {
                width: '100%',
                height: '450px',
                items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                themesPath: "/assets/d2eace91/js/editor/themes/",
                cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
                uploadJson: "/site/upload-image",
                extraFileUploadParams: extraFileUploadParams,
                allowImageUpload: true,
                allowFlashUpload: false,
                allowMediaUpload: false,
                allowFileManager: true,
                syncType: "form",
                // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
                pasteType: 2,
                afterCreate: function() {
                    var self = this;
                    self.sync();
                },
                afterChange: function() {
                    var self = this;
                    self.sync();
                },
                afterBlur: function() {
                    var self = this;
                    self.sync();
                }
            });
        });
    </script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180702"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180702"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180702"></script>

    <!-- 地区选择 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180702"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "shopmodel-shop_id", "name": "ShopModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop Id不能为空。"}}},{"id": "shopmodel-shop_name", "name": "ShopModel[shop_name]", "attribute": "shop_name", "rules": {"required":true,"messages":{"required":"店铺名称不能为空。"}}},{"id": "shopmodel-region_code", "name": "ShopModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"联系地址不能为空。"}}},{"id": "shopmodel-address", "name": "ShopModel[address]", "attribute": "address", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "shopmodel-shop_image", "name": "ShopModel[shop_image]", "attribute": "shop_image", "rules": {"required":true,"messages":{"required":"店铺头像不能为空。"}}},{"id": "shopmodel-shop_logo", "name": "ShopModel[shop_logo]", "attribute": "shop_logo", "rules": {"required":true,"messages":{"required":"店铺LOGO不能为空。"}}},{"id": "shopmodel-shop_poster", "name": "ShopModel[shop_poster]", "attribute": "shop_poster", "rules": {"required":true,"messages":{"required":"店铺海报不能为空。"}}},{"id": "shopmodel-start_price", "name": "ShopModel[start_price]", "attribute": "start_price", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "shopmodel-other_shipping_fee", "name": "ShopModel[other_shipping_fee]", "attribute": "other_shipping_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"额外增加配送费必须是一个数字。","min":"额外增加配送费必须不小于0。","max":"额外增加配送费必须不大于9999999。"},"min":0,"max":9999999}},{"id": "shopmodel-packing_fee", "name": "ShopModel[packing_fee]", "attribute": "packing_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"包装费必须是一个数字。","min":"包装费必须不小于0。","max":"包装费必须不大于9999999。"},"min":0,"max":9999999}},{"id": "shopmodel-shop_name", "name": "ShopModel[shop_name]", "attribute": "shop_name", "rules": {"string":true,"messages":{"string":"店铺名称必须是一条字符串。","maxlength":"店铺名称只能包含至多20个字符。"},"maxlength":20}},{"id": "shopmodel-shop_description", "name": "ShopModel[shop_description]", "attribute": "shop_description", "rules": {"string":true,"messages":{"string":"店铺简介必须是一条字符串。","maxlength":"店铺简介只能包含至多100个字符。"},"maxlength":100}},{"id": "shopmodel-shop_keywords", "name": "ShopModel[shop_keywords]", "attribute": "shop_keywords", "rules": {"string":true,"messages":{"string":"店铺关键词必须是一条字符串。","maxlength":"店铺关键词只能包含至多50个字符。"},"maxlength":50}},{"id": "shopmodel-detail_introduce", "name": "ShopModel[detail_introduce]", "attribute": "detail_introduce", "rules": {"string":true,"messages":{"string":"店铺公告必须是一条字符串。","maxlength":"店铺公告只能包含至多50个字符。"},"maxlength":50}},{"id": "shopmodel-close_tips", "name": "ShopModel[close_tips]", "attribute": "close_tips", "rules": {"string":true,"messages":{"string":"非营业时间下单提示必须是一条字符串。","maxlength":"非营业时间下单提示只能包含至多255个字符。"},"maxlength":255}},{"id": "shopmodel-shop_name", "name": "ShopModel[shop_name]", "attribute": "shop_name", "rules": {"ajax":{"url":"/shop/shop-set/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcU2VsZlNob3BNb2RlbA==","attribute":"shop_name","params":["ShopModel[shop_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
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
            var validator = $("#ShopModel").validate();
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
                    return;
                }
                //加载提示
                $.loading.start();

                $("#ShopModel").submit();
            });

            // 新建营业时间
            $("#add_opentime").click(function() {
                if ($(".time-subtime").length < 4) {
                    var html = $("#opentime_template").html();
                    var element = $($.parseHTML(html));
                    element.insertBefore($(".add-btn"));
                    checkLength();
                }
            });
            // 删除营业时间
            $("body").on("click", "#del_opentime", function() {
                var target = this;
                //$.confirm("您确定要删除当前营业时间吗？", function() {
                $(target).parent().parent().remove();
                //});
                checkLength();
            });

            // 营业时间不能超过三条
            function checkLength() {
                if ($(".time-subtime").length >= 4) {
                    $("#add_opentime").addClass("disabled");
                } else {
                    $("#add_opentime").removeClass("disabled");
                }
            }
            checkLength();
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $("#region_container").regionselector({
                value: '{{ $model['region_code'] }}',
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
        });
    </script>
    <!--点击按钮为表格增加行-->
    <script id="opentime_template" type="text">
<div class="time-subtime">
	<div class="time-select">
		<select name="opening_hour[begin_hour][]" class="select form-control m-r-5">
			<!--   -->
			<option value="0">00</option>
			<!--   -->
			<option value="1">01</option>
			<!--   -->
			<option value="2">02</option>
			<!--   -->
			<option value="3">03</option>
			<!--   -->
			<option value="4">04</option>
			<!--   -->
			<option value="5">05</option>
			<!--   -->
			<option value="6">06</option>
			<!--   -->
			<option value="7">07</option>
			<!--   -->
			<option value="8">08</option>
			<!--   -->
			<option value="9">09</option>
			<!--   -->
			<option value="10">10</option>
			<!--   -->
			<option value="11">11</option>
			<!--   -->
			<option value="12">12</option>
			<!--   -->
			<option value="13">13</option>
			<!--   -->
			<option value="14">14</option>
			<!--   -->
			<option value="15">15</option>
			<!--   -->
			<option value="16">16</option>
			<!--   -->
			<option value="17">17</option>
			<!--   -->
			<option value="18">18</option>
			<!--   -->
			<option value="19">19</option>
			<!--   -->
			<option value="20">20</option>
			<!--   -->
			<option value="21">21</option>
			<!--   -->
			<option value="22">22</option>
			<!--   -->
			<option value="23">23</option>

		</select>
		:
		<select name="opening_hour[begin_minute][]" class="select form-control m-l-5">
			<!--   -->

			<option value="0">00</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="5">05</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="10">10</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="15">15</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="20">20</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="25">25</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="30">30</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="35">35</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="40">40</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="45">45</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="50">50</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="55">55</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="59">59</option>


		</select>
	</div>
	<div class="time-select">
		<select name="opening_hour[end_hour][]" class="select form-control m-r-5">
			<!--   -->
			<option value="0">00</option>
			<!--   -->
			<option value="1">01</option>
			<!--   -->
			<option value="2">02</option>
			<!--   -->
			<option value="3">03</option>
			<!--   -->
			<option value="4">04</option>
			<!--   -->
			<option value="5">05</option>
			<!--   -->
			<option value="6">06</option>
			<!--   -->
			<option value="7">07</option>
			<!--   -->
			<option value="8">08</option>
			<!--   -->
			<option value="9">09</option>
			<!--   -->
			<option value="10">10</option>
			<!--   -->
			<option value="11">11</option>
			<!--   -->
			<option value="12">12</option>
			<!--   -->
			<option value="13">13</option>
			<!--   -->
			<option value="14">14</option>
			<!--   -->
			<option value="15">15</option>
			<!--   -->
			<option value="16">16</option>
			<!--   -->
			<option value="17">17</option>
			<!--   -->
			<option value="18">18</option>
			<!--   -->
			<option value="19">19</option>
			<!--   -->
			<option value="20">20</option>
			<!--   -->
			<option value="21">21</option>
			<!--   -->
			<option value="22">22</option>
			<!--   -->
			<option value="23">23</option>

		</select>
		:
		<select name="opening_hour[end_minute][]" class="select form-control m-l-5">
			<!--   -->

			<option value="0">00</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="5">05</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="10">10</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="15">15</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="20">20</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="25">25</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="30">30</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="35">35</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="40">40</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="45">45</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="50">50</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="55">55</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="59">59</option>


		</select>
	</div>
	<div class="handle">
		<a id="del_opentime" class="c-blue" href="javascript:void(0);">删除</a>
	</div>
</div>
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
        $().ready(function() {
            var x = $("#shop_lng").val();
            var y = $("#shop_lat").val();
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

                    var keyword = keyword + $("#selfshopmodel-address").val();

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
                $("#shop_lng").val(x);
                $("#shop_lat").val(y);
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
                    $("#shop_lng").val(x);
                    $("#shop_lat").val(y);
                });
            }

            function geocoder_callBack(data) {
                if ($("#load").val() == 1) {
                    $("#load").val(0);

                    openInfo($("#selfshopmodel-address").val());

                } else {
                    var address = data.regeocode.formattedAddress;
                    var array = $("#region_name").val().split(","); // 返回地址描述
                    for (var i = 0; i < array.length; i++) {
                        address = address.replace(array[i], '');
                    }
                    address = address.replace('省', '');
                    address = address.replace('市', '');

                    $("#selfshopmodel-address").val(address);

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
            $(".address").keypress(function(e) {
                if (event.keyCode == 13) {
                    $("#map_search").click();
                }
            })
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop