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
        <form id="QcodeModel" class="form-horizontal" name="QcodeModel" action="/weixin/qcode/add" method="post" novalidate="novalidate">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="qcodemodel-id" class="form-control" name="QcodeModel[id]" value="{{ $model['id'] ?? '' }}">
            <!-- 二维码类型 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="qcodemodel-qcode_type" class="col-sm-4 control-label">

                        <span class="ng-binding">二维码类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="qcodemodel-qcode_type" class="" name="QcodeModel[qcode_type]" selection="[null]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="QcodeModel[qcode_type]" value="0" @if(@$model['qcode_type'] == 0){{ 'checked' }}@endif> 商品二维码</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="QcodeModel[qcode_type]" value="1" @if(@$model['qcode_type'] == 1){{ 'checked' }}@endif> 文章二维码</label>
                            </div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 二维码内容 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="qcodemodel-qcode_content" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">二维码内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="qcodemodel-qcode_content" class="form-control" name="QcodeModel[qcode_content]" value="{{ $model['qcode_content'] ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">根据选择的类型，填写商品ID、文章ID</div></div>
                    </div>
                </div>
            </div>

            @if(isset($info->id))
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="qcodemodel-qcode" class="col-sm-4 control-label">

                            <span class="ng-binding">二维码：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <img src="{{ $info->qcode }}" width="200" height="200">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            @endif

                <!-- 确认提交 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交">

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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "qcodemodel-qcode_content", "name": "QcodeModel[qcode_content]", "attribute": "qcode_content", "rules": {"required":true,"messages":{"required":"二维码内容不能为空。"}}},{"id": "qcodemodel-qcode_type", "name": "QcodeModel[qcode_type]", "attribute": "qcode_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"二维码类型必须是整数。"}}},{"id": "qcodemodel-qcode_content", "name": "QcodeModel[qcode_content]", "attribute": "qcode_content", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"二维码内容必须是整数。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#QcodeModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#QcodeModel").submit();

            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop