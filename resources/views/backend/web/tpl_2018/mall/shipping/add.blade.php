{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30">
        <form id="Shipping" class="form-horizontal" name="Shipping" action="/mall/shipping/add" method="post" novalidate="novalidate">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="shipping-shipping_id" class="form-control" name="Shipping[shipping_id]" value="{{ $info->shipping_id ?? '' }}">
            <!-- 快递公司名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shipping-shipping_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">快递公司名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shipping-shipping_name" class="form-control" name="Shipping[shipping_name]" value="{{ $info->shipping_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 系统物流代码 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shipping-shipping_code" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">系统物流代码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shipping-shipping_code" class="form-control" name="Shipping[shipping_code]" value="{{ $info->shipping_code ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">一般填写快递公司的拼音首字母</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否启用 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shipping-is_open" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">是否启用：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="Shipping[is_open]" value="0">
                                    <label>
                                        @if(isset($info->is_open))
                                            <input type="checkbox" id="shipping-is_open" class="form-control b-n"
                                                   name="Shipping[is_open]" value="1" @if($info->is_open == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="shipping-is_open" class="form-control b-n"
                                                   name="Shipping[is_open]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif

                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：店铺可使用此快递公司；否：店铺将无法看到此快递公司</div></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shipping-shipping_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shipping-shipping_sort" class="form-control small" name="Shipping[shipping_sort]" value="{{ $info->shipping_sort ?? 9999 }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围0~9999，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>

            <!-- 确认提交 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交">

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    @if(!isset($info->shipping_id))
        [{"id": "shipping-shipping_name", "name": "Shipping[shipping_name]", "attribute": "shipping_name", "rules": {"required":true,"messages":{"required":"快递公司名称不能为空。"}}},{"id": "shipping-shipping_code", "name": "Shipping[shipping_code]", "attribute": "shipping_code", "rules": {"required":true,"messages":{"required":"系统物流代码不能为空。"}}},{"id": "shipping-is_open", "name": "Shipping[is_open]", "attribute": "is_open", "rules": {"required":true,"messages":{"required":"是否启用不能为空。"}}},{"id": "shipping-shipping_sort", "name": "Shipping[shipping_sort]", "attribute": "shipping_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shipping-is_open", "name": "Shipping[is_open]", "attribute": "is_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "shipping-img_width", "name": "Shipping[img_width]", "attribute": "img_width", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"背景图片宽度必须是整数。"}}},{"id": "shipping-img_height", "name": "Shipping[img_height]", "attribute": "img_height", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"背景图片高度必须是整数。"}}},{"id": "shipping-offset_top", "name": "Shipping[offset_top]", "attribute": "offset_top", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上偏移量必须是整数。"}}},{"id": "shipping-offset_left", "name": "Shipping[offset_left]", "attribute": "offset_left", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"左偏移量必须是整数。"}}},{"id": "shipping-config_lable", "name": "Shipping[config_lable]", "attribute": "config_lable", "rules": {"string":true,"messages":{"string":"配置标签必须是一条字符串。"}}},{"id": "shipping-logo", "name": "Shipping[logo]", "attribute": "logo", "rules": {"string":true,"messages":{"string":"快递公司logo必须是一条字符串。","maxlength":"快递公司logo只能包含至多255个字符。"},"maxlength":255}},{"id": "shipping-site_url", "name": "Shipping[site_url]", "attribute": "site_url", "rules": {"string":true,"messages":{"string":"快递公司网址必须是一条字符串。","maxlength":"快递公司网址只能包含至多255个字符。"},"maxlength":255}},{"id": "shipping-img_path", "name": "Shipping[img_path]", "attribute": "img_path", "rules": {"string":true,"messages":{"string":"模板图片必须是一条字符串。","maxlength":"模板图片只能包含至多255个字符。"},"maxlength":255}},{"id": "shipping-shipping_name", "name": "Shipping[shipping_name]", "attribute": "shipping_name", "rules": {"string":true,"messages":{"string":"快递公司名称必须是一条字符串。","maxlength":"快递公司名称只能包含至多20个字符。"},"maxlength":20}},{"id": "shipping-shipping_code", "name": "Shipping[shipping_code]", "attribute": "shipping_code", "rules": {"string":true,"messages":{"string":"系统物流代码必须是一条字符串。","maxlength":"系统物流代码只能包含至多20个字符。"},"maxlength":20}},{"id": "shipping-shipping_sort", "name": "Shipping[shipping_sort]", "attribute": "shipping_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于9999。"},"min":0,"max":9999}},{"id": "shipping-shipping_code", "name": "Shipping[shipping_code]", "attribute": "shipping_code", "rules": {"ajax":{"url":"/mall/shipping/client-validate","model":"Y29tbW9uXG1vZGVsc1xTaGlwcGluZw==","attribute":"shipping_code","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @else
    [{"id": "shipping-shipping_name", "name": "Shipping[shipping_name]", "attribute": "shipping_name", "rules": {"required":true,"messages":{"required":"快递公司名称不能为空。"}}},{"id": "shipping-shipping_code", "name": "Shipping[shipping_code]", "attribute": "shipping_code", "rules": {"required":true,"messages":{"required":"系统物流代码不能为空。"}}},{"id": "shipping-is_open", "name": "Shipping[is_open]", "attribute": "is_open", "rules": {"required":true,"messages":{"required":"是否启用不能为空。"}}},{"id": "shipping-shipping_sort", "name": "Shipping[shipping_sort]", "attribute": "shipping_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shipping-is_open", "name": "Shipping[is_open]", "attribute": "is_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "shipping-img_width", "name": "Shipping[img_width]", "attribute": "img_width", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"背景图片宽度必须是整数。"}}},{"id": "shipping-img_height", "name": "Shipping[img_height]", "attribute": "img_height", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"背景图片高度必须是整数。"}}},{"id": "shipping-offset_top", "name": "Shipping[offset_top]", "attribute": "offset_top", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上偏移量必须是整数。"}}},{"id": "shipping-offset_left", "name": "Shipping[offset_left]", "attribute": "offset_left", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"左偏移量必须是整数。"}}},{"id": "shipping-config_lable", "name": "Shipping[config_lable]", "attribute": "config_lable", "rules": {"string":true,"messages":{"string":"配置标签必须是一条字符串。"}}},{"id": "shipping-logo", "name": "Shipping[logo]", "attribute": "logo", "rules": {"string":true,"messages":{"string":"快递公司logo必须是一条字符串。","maxlength":"快递公司logo只能包含至多255个字符。"},"maxlength":255}},{"id": "shipping-site_url", "name": "Shipping[site_url]", "attribute": "site_url", "rules": {"string":true,"messages":{"string":"快递公司网址必须是一条字符串。","maxlength":"快递公司网址只能包含至多255个字符。"},"maxlength":255}},{"id": "shipping-img_path", "name": "Shipping[img_path]", "attribute": "img_path", "rules": {"string":true,"messages":{"string":"模板图片必须是一条字符串。","maxlength":"模板图片只能包含至多255个字符。"},"maxlength":255}},{"id": "shipping-shipping_name", "name": "Shipping[shipping_name]", "attribute": "shipping_name", "rules": {"string":true,"messages":{"string":"快递公司名称必须是一条字符串。","maxlength":"快递公司名称只能包含至多20个字符。"},"maxlength":20}},{"id": "shipping-shipping_code", "name": "Shipping[shipping_code]", "attribute": "shipping_code", "rules": {"string":true,"messages":{"string":"系统物流代码必须是一条字符串。","maxlength":"系统物流代码只能包含至多20个字符。"},"maxlength":20}},{"id": "shipping-shipping_sort", "name": "Shipping[shipping_sort]", "attribute": "shipping_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于9999。"},"min":0,"max":9999}},{"id": "shipping-shipping_code", "name": "Shipping[shipping_code]", "attribute": "shipping_code", "rules": {"ajax":{"url":"/mall/shipping/client-validate","model":"Y29tbW9uXG1vZGVsc1xTaGlwcGluZw==","attribute":"shipping_code","params":["Shipping[shipping_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @endif
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#Shipping").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            $("#btn_submit").click(function() {

                if (!validator.form()) {
                    return;
                }

                var data = $("#Shipping").serializeJson();
                var url = $("#Shipping").attr("action");
                //加载提示
                $.loading.start();
                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.go('/mall/shipping/list');
                        $.msg(result.message);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });

        });
    </script>
    
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop