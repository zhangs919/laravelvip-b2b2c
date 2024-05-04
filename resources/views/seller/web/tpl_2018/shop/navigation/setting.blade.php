{{--模板继承--}}
@extends('layouts.'.$base_layout)

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/js/colour/css/spectrum.css?v=4.0" rel="stylesheet">

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="group" value="navigation">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">




            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-nav_bgcolor" class="col-sm-4 control-label">

                        <span class="ng-binding">导航背景色：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="text" id="shopconfigmodel-nav_bgcolor" class="form-control colorpicker w100" name="ShopConfigModel[nav_bgcolor]" value="{{ $config_info['nav_bgcolor']->value }}">





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置导航背影颜色,如果为空则显示默认颜色</div></div>
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
        </div>
    </form>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "shopconfigmodel-nav_bgcolor", "name": "ShopConfigModel[nav_bgcolor]", "attribute": "nav_bgcolor", "rules": {"string":true,"messages":{"string":"导航背景色必须是一条字符串。"}}},]
</script>
    <script type="text/javascript">
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
    <script src="/assets/d2eace91/js/validate/jquery.metadata.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/colour/js/spectrum.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/colour/js/docs.js?v=202003261806"></script>

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    @include('shop.config.partials.navigation')
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop