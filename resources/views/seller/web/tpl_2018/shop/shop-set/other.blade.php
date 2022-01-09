{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="group" value="shop_other">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">




            <input type="hidden" id="shopconfigmodel-shop_index_topic" class="form-control" name="ShopConfigModel[shop_index_topic]" value="0">





            <h5 class="m-b-30" data-anchor="店铺首页设置">店铺首页设置</h5>



            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-shop_index" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺首页：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="ShopConfigModel[shop_index]" value="0">
                            <div id="shopconfigmodel-shop_index" class="" name="ShopConfigModel[shop_index]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[shop_index]" value="0" @if($config_info['shop_index']->value == 0) checked @endif> 店铺首页</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[shop_index]" value="1" @if($config_info['shop_index']->value == 1) checked @endif> 商品列表</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[shop_index]" value="2" @if($config_info['shop_index']->value == 2) checked @endif> 专题页
                                    <select id="shopconfigmodel-shop_index_topic" name="ShopConfigModel[shop_index_topic]" class="form-control form-control-xs w150 m-l-10 valid" style="margin-top: -5px;" onClick="$(this).parents('label').find('input').click()">
                                        <option value="0">--请选择--</option>
                                        <option value="1">食品盛宴</option><option value="2">大厦</option>
                                    </select>
                                </label>
                            </div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">此设置用于定制你的店铺首页显示的内容，暂时支持店铺的装修首页、商品列表页、专题页</div></div>
                    </div>
                </div>
            </div>





            <h5 class="m-b-30" data-anchor="店铺商品列表设置">店铺商品列表设置</h5>



            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-goods_list_show_mode" class="col-sm-4 control-label">

                        <span class="ng-binding">商品列表展示方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="ShopConfigModel[goods_list_show_mode]" value="0">
                            <div id="shopconfigmodel-goods_list_show_mode" class="" name="ShopConfigModel[goods_list_show_mode]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[goods_list_show_mode]" value="0" @if($config_info['goods_list_show_mode']->value == 0) checked @endif> 默认主图</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[goods_list_show_mode]" value="1" @if($config_info['goods_list_show_mode']->value == 1) checked @endif> 规格相册</label>
                            </div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置店铺商品列表页面商品的展示形式，默认仅展示商品主图，设置为规格相册后，会将每个商品的规格主图以小图展示出来，让用户能在列表页面即切换看到每个商品的规格主图</div></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="hidden" name="back_url" value="/shop/shop-set/other" />
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary" />
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
    @include('shop.config.partials.shop_other')
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop