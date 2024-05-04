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
        <form id="WeixinKeyword" class="form-horizontal" name="WeixinKeyword" action="/weixin/keyword/add" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="weixinkeyword-id" class="form-control" name="WeixinKeyword[id]" value="{{ $model['id'] ?? '' }}">
            <!-- 关键词名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="weixinkeyword-key_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">关键词名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="weixinkeyword-key_name" class="form-control" name="WeixinKeyword[key_name]" data-rule-required="true" value="{{ $model['key_name'] ?? '' }}">
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 关键词类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="weixinkeyword-key_type" class="col-sm-4 control-label">
                        <span class="ng-binding">关键词类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label cur-p"><input type="radio" class="key_type" name="WeixinKeyword[key_type]" value="0" @if(@$model['key_type'] == 0){{ 'checked' }}@endif> 自定义文字</label>
                            <label class="control-label cur-p"><input type="radio" class="key_type" name="WeixinKeyword[key_type]" value="1" @if(@$model['key_type'] == 1){{ 'checked' }}@endif> 自定义图文</label>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div id="content">
                <!-- ================== BEGIN BASE  ================== -->
                <!-- ================== END BASE  ================== -->
                <!--引入菜单类型内容-->
                @include('weixin.keyword.change_type_'.$model['key_type'])

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
    <script id="client_rules" type="text">
[{"id": "weixinkeyword-key_content", "name": "WeixinKeyword[key_content]", "attribute": "key_content", "rules": {"required":true,"messages":{"required":"关键词回复内容不能为空。"}}},{"id": "weixinkeyword-key_name", "name": "WeixinKeyword[key_name]", "attribute": "key_name", "rules": {"required":true,"messages":{"required":"关键词名称不能为空。"}}},{"id": "weixinkeyword-key_type", "name": "WeixinKeyword[key_type]", "attribute": "key_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"关键词类型必须是整数。"}}},{"id": "weixinkeyword-shop_id", "name": "WeixinKeyword[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "weixinkeyword-key_name", "name": "WeixinKeyword[key_name]", "attribute": "key_name", "rules": {"string":true,"messages":{"string":"关键词名称必须是一条字符串。","maxlength":"关键词名称只能包含至多60个字符。"},"maxlength":60}},{"id": "weixinkeyword-key_content", "name": "WeixinKeyword[key_content]", "attribute": "key_content", "rules": {"string":true,"messages":{"string":"关键词回复内容必须是一条字符串。","maxlength":"关键词回复内容只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_img", "name": "WeixinKeyword[key_img]", "attribute": "key_img", "rules": {"string":true,"messages":{"string":"图片必须是一条字符串。","maxlength":"图片只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_link", "name": "WeixinKeyword[key_link]", "attribute": "key_link", "rules": {"string":true,"messages":{"string":"链接地址必须是一条字符串。","maxlength":"链接地址只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_desc", "name": "WeixinKeyword[key_desc]", "attribute": "key_desc", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_title", "name": "WeixinKeyword[key_title]", "attribute": "key_title", "rules": {"string":true,"messages":{"string":"标题必须是一条字符串。","maxlength":"标题只能包含至多20个字符。"},"maxlength":20}},]
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
            var validator = $("#WeixinKeyword").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#key_img_container").imagegroup({
                host: '{{ get_oss_host() }}',
                size: 1,
                values: [{{ $model['key_img'] ?? '' }}],
                callback: function(data) {
                    $("#weixinkeyword-key_img").val(data.path);
                },
                remove: function(value, values) {
                    $("#weixinkeyword-key_img").val('');
                }
            });
        });
        //
        $().ready(function() {
            var validator = $("#WeixinKeyword").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#WeixinKeyword").submit();
            });
            // 菜单类型
            $("body").on("click", ".key_type", function() {
                var key_type = $(this).val();
                $.loading.start();
                $.ajax({
                    type: 'GET',
                    url: 'change-type',
                    data: {
                        key_type: key_type
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#content").html(result.data);
                    }
                }).always(function() {
                    $.loading.stop();
                });
            })
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop