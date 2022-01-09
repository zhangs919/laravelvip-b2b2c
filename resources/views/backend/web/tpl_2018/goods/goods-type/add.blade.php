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

    <!-- 表单 -->
    <form id="GoodsTypeModel" class="form-horizontal" name="GoodsTypeModel" action="/goods/goods-type/add" method="post" novalidate="novalidate">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix">
            <!-- 隐藏域 -->
            <input type="hidden" id="goodstypemodel-type_id" class="form-control" name="GoodsTypeModel[type_id]" value="{{ $info->type_id ?? ''}}">
            <!-- 类型名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="goodstypemodel-type_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">类型名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="goodstypemodel-type_name" class="form-control" name="GoodsTypeModel[type_name]" value="{{ $info->type_name ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入30个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 类型描述 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="goodstypemodel-type_desc" class="col-sm-4 control-label">

                        <span class="ng-binding">类型描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="goodstypemodel-type_desc" class="form-control" name="GoodsTypeModel[type_desc]" rows="5">{{ $info->type_desc ?? ''}}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入255个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="goodstypemodel-type_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="goodstypemodel-type_sort" class="form-control small" name="GoodsTypeModel[type_sort]" value="{{ $info->type_sort ?? '255'}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
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

                            <input type="submit" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交">

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
    @if(isset($info->type_id))
        [{"id": "goodstypemodel-type_name", "name": "GoodsTypeModel[type_name]", "attribute": "type_name", "rules": {"required":true,"messages":{"required":"类型名称不能为空。"}}},{"id": "goodstypemodel-type_sort", "name": "GoodsTypeModel[type_sort]", "attribute": "type_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "goodstypemodel-type_sort", "name": "GoodsTypeModel[type_sort]", "attribute": "type_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "goodstypemodel-type_name", "name": "GoodsTypeModel[type_name]", "attribute": "type_name", "rules": {"string":true,"messages":{"string":"类型名称必须是一条字符串。","maxlength":"类型名称只能包含至多30个字符。"},"maxlength":30}},{"id": "goodstypemodel-type_desc", "name": "GoodsTypeModel[type_desc]", "attribute": "type_desc", "rules": {"string":true,"messages":{"string":"类型描述必须是一条字符串。","maxlength":"类型描述只能包含至多255个字符。"},"maxlength":255}},{"id": "goodstypemodel-type_id", "name": "GoodsTypeModel[type_id]", "attribute": "type_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"编号必须是整数。"}}},{"id": "goodstypemodel-type_name", "name": "GoodsTypeModel[type_name]", "attribute": "type_name", "rules": {"ajax":{"url":"/goods/goods-type/client-validate","model":"YXBwXG1vZHVsZXNcZ29vZHNcbW9kZWxzXEdvb2RzVHlwZU1vZGVs","attribute":"type_name","params":["GoodsTypeModel[type_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @else
        [{"id": "goodstypemodel-type_name", "name": "GoodsTypeModel[type_name]", "attribute": "type_name", "rules": {"required":true,"messages":{"required":"类型名称不能为空。"}}},{"id": "goodstypemodel-type_sort", "name": "GoodsTypeModel[type_sort]", "attribute": "type_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "goodstypemodel-type_sort", "name": "GoodsTypeModel[type_sort]", "attribute": "type_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "goodstypemodel-type_name", "name": "GoodsTypeModel[type_name]", "attribute": "type_name", "rules": {"string":true,"messages":{"string":"类型名称必须是一条字符串。","maxlength":"类型名称只能包含至多30个字符。"},"maxlength":30}},{"id": "goodstypemodel-type_desc", "name": "GoodsTypeModel[type_desc]", "attribute": "type_desc", "rules": {"string":true,"messages":{"string":"类型描述必须是一条字符串。","maxlength":"类型描述只能包含至多255个字符。"},"maxlength":255}},{"id": "goodstypemodel-type_id", "name": "GoodsTypeModel[type_id]", "attribute": "type_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"编号必须是整数。"}}},{"id": "goodstypemodel-type_name", "name": "GoodsTypeModel[type_name]", "attribute": "type_name", "rules": {"ajax":{"url":"/goods/goods-type/client-validate","model":"YXBwXG1vZHVsZXNcZ29vZHNcbW9kZWxzXEdvb2RzVHlwZU1vZGVs","attribute":"type_name","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @endif
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#GoodsTypeModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#GoodsTypeModel").submit();
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop