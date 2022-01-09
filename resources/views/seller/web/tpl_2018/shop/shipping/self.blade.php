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
        <input type="hidden" name="group" value="shipping">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">





            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-zxps_open" class="col-sm-4 control-label">

                        <span class="ng-binding">是否开启：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopConfigModel[zxps_open]" value="0">
                                    <label>
                                        <input type="checkbox"
                                               id="shopconfigmodel-zxps_open"
                                               class="form-control b-n"
                                               name="ShopConfigModel[zxps_open]"
                                               value="1" @if($config_info['zxps_open']->value == 1)checked="" @endif
                                               data-on-text="是" data-off-text="否"></label>
                                </div>
                            </label>




                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="hidden" name="back_url" value="/shop/shipping/self" />
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
    @include('shop.config.partials.shipping')
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop