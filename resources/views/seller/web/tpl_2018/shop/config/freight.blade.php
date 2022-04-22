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
        <input type="hidden" name="group" value="freight">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">





            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-freight_fee" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺统一运费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="shopconfigmodel-freight_fee" class="form-control ipt m-r-10" name="ShopConfigModel[freight_fee]" value="{{ $group_info['freight_fee']->value }}">



                            元


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">当发布、编辑商品的运费设置为店铺统一运费时，此商品的运费按照店铺的统一运费进行计算</div></div>
                    </div>
                </div>
            </div>






            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-freight_cod_enable" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">是否支持货到付款：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopConfigModel[freight_cod_enable]" value="0">
                                    <label><input type="checkbox" id="shopconfigmodel-freight_cod_enable" class="form-control b-n"
                                                  name="ShopConfigModel[freight_cod_enable]" value="1" @if($group_info['freight_cod_enable']->value == 1) checked @endif data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">仅用于控制店铺统一运费是否支持货到付款，按运费模板计算运费的商品不受此设置影响</div></div>
                    </div>
                </div>
            </div>






            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-freight_cash_more" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">货到付款加价：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="shopconfigmodel-freight_cash_more" class="form-control ipt m-r-10" name="ShopConfigModel[freight_cash_more]" value="{{ $group_info['freight_cash_more']->value }}">



                            元


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">仅在上一项支持货到付款为“是”时起作用，用于控制店铺统一运费在支持货到付款时加价金额，按运费模板计算运费的商品不受此设置影响</div></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}" />
                        {{--<input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}" />--}}
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary" />
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

    {!! $script_render !!}

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop