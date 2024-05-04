{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="ProgramsQrcodeModel" class="form-horizontal" name="ProgramsQrcodeModel" action="/weixin/programs-qrcode/add" method="post">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="programsqrcodemodel-id" class="form-control" name="ProgramsQrcodeModel[id]" value="{{ $model['id'] ?? '' }}">
            <!-- 二维码内容 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="programsqrcodemodel-content" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">自定义内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="programsqrcodemodel-content" class="form-control" name="ProgramsQrcodeModel[content]" value="{{ $model['content'] ?? '' }}">
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">填写自定义链接，支持绝对路径和相对路径。例： /goods-1.html或者http://m.xxx.xxx/goods-1.html</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="programsqrcodemodel-img" class="col-sm-4 control-label">
                        <span class="ng-binding">自定义logo：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div id="imagegroup_container" class="szy-imagegroup" data-size="1"></div>
                            <input type="hidden" id="programsqrcodemodel-img" class="form-control" name="ProgramsQrcodeModel[img]" value="{{ $model['img'] ?? '' }}">
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">显示在小程序码中间的logo图片，建议上传200*200的png图片，图片最大不能超过2M</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交" />
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

{{--extra html block--}}
@section('extra_html')
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "programsqrcodemodel-content", "name": "ProgramsQrcodeModel[content]", "attribute": "content", "rules": {"required":true,"messages":{"required":"自定义内容不能为空。"}}},{"id": "programsqrcodemodel-shop_id", "name": "ProgramsQrcodeModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "programsqrcodemodel-content", "name": "ProgramsQrcodeModel[content]", "attribute": "content", "rules": {"string":true,"messages":{"string":"自定义内容必须是一条字符串。"}}},{"id": "programsqrcodemodel-qrcode", "name": "ProgramsQrcodeModel[qrcode]", "attribute": "qrcode", "rules": {"string":true,"messages":{"string":"小程序码必须是一条字符串。"}}},{"id": "programsqrcodemodel-img", "name": "ProgramsQrcodeModel[img]", "attribute": "img", "rules": {"string":true,"messages":{"string":"自定义logo必须是一条字符串。"}}},]
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

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script>
        $().ready(function() {
            var validator = $("#ProgramsQrcodeModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ProgramsQrcodeModel").submit();
                return false;
            });
            $("#imagegroup_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: $(this).data("size"),
                values: $('#programsqrcodemodel-img').val().split("|"),
                gallery: true,
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#programsqrcodemodel-img').val(values);
                    $.validator.clearError($("#programsqrcodemodel-img"));
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#programsqrcodemodel-img').val(values);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop