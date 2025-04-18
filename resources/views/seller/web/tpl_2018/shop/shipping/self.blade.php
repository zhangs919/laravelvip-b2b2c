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

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index" method="post" enctype="multipart/form-data">
        @csrf
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



            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}" />
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
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