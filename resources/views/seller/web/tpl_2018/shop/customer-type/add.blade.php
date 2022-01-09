{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="CustomerTypeModel" class="form-horizontal" name="CustomerTypeModel" action="/shop/customer-type/add" method="post">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="customertypemodel-type_id" class="form-control" name="CustomerTypeModel[type_id]" value="{{ $info->type_id ?? '' }}">
            <input type="hidden" id="customertypemodel-shop_id" class="form-control" name="CustomerTypeModel[shop_id]" value="{{ $shop_info->shop_id }}">
            <!-- 类型名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customertypemodel-type_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">客服类型名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="customertypemodel-type_name" class="form-control" name="CustomerTypeModel[type_name]"  value="{{ $info->type_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 客服描述 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customertypemodel-type_desc" class="col-sm-4 control-label">

                        <span class="ng-binding">客服类型描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="content" class="form-control" name="CustomerTypeModel[type_desc]" rows="3">{!! $info->type_desc ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customertypemodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否启用：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="CustomerTypeModel[is_show]" value="0">
                                    @if(isset($info->is_show))
                                        <label><input type="checkbox" id="customertypemodel-is_show" class="form-control b-n"
                                                      name="CustomerTypeModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                      data-off-text="否"> </label>
                                    @else
                                        <label><input type="checkbox" id="customertypemodel-is_show" class="form-control b-n"
                                                      name="CustomerTypeModel[is_show]" value="1" checked data-on-text="是"
                                                      data-off-text="否"> </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customertypemodel-type_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="customertypemodel-type_sort" class="form-control" name="CustomerTypeModel[type_sort]" value="{{ $info->type_sort ?? 255 }}" style="width: 60px;">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
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
        @if(!isset($info->type_id))
            [{"id": "customertypemodel-type_name", "name": "CustomerTypeModel[type_name]", "attribute": "type_name", "rules": {"required":true,"messages":{"required":"客服类型名称不能为空。"}}},{"id": "customertypemodel-type_sort", "name": "CustomerTypeModel[type_sort]", "attribute": "type_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "customertypemodel-is_show", "name": "CustomerTypeModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "customertypemodel-type_sort", "name": "CustomerTypeModel[type_sort]", "attribute": "type_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "customertypemodel-type_name", "name": "CustomerTypeModel[type_name]", "attribute": "type_name", "rules": {"string":true,"messages":{"string":"客服类型名称必须是一条字符串。","maxlength":"客服类型名称只能包含至多10个字符。"},"maxlength":10}},{"id": "customertypemodel-type_desc", "name": "CustomerTypeModel[type_desc]", "attribute": "type_desc", "rules": {"string":true,"messages":{"string":"客服类型描述必须是一条字符串。","maxlength":"客服类型描述只能包含至多40个字符。"},"maxlength":40}},{"id": "customertypemodel-type_sort", "name": "CustomerTypeModel[type_sort]", "attribute": "type_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "customertypemodel-type_name", "name": "CustomerTypeModel[type_name]", "attribute": "type_name", "rules": {"ajax":{"url":"/shop/customer-type/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcQ3VzdG9tZXJUeXBlTW9kZWw=","attribute":"type_name","params":["CustomerTypeModel[shop_id]"],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
        @else
            [{"id": "customertypemodel-type_name", "name": "CustomerTypeModel[type_name]", "attribute": "type_name", "rules": {"required":true,"messages":{"required":"客服类型名称不能为空。"}}},{"id": "customertypemodel-type_sort", "name": "CustomerTypeModel[type_sort]", "attribute": "type_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "customertypemodel-is_show", "name": "CustomerTypeModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "customertypemodel-type_sort", "name": "CustomerTypeModel[type_sort]", "attribute": "type_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "customertypemodel-type_name", "name": "CustomerTypeModel[type_name]", "attribute": "type_name", "rules": {"string":true,"messages":{"string":"客服类型名称必须是一条字符串。","maxlength":"客服类型名称只能包含至多10个字符。"},"maxlength":10}},{"id": "customertypemodel-type_desc", "name": "CustomerTypeModel[type_desc]", "attribute": "type_desc", "rules": {"string":true,"messages":{"string":"客服描述必须是一条字符串。","maxlength":"客服描述只能包含至多40个字符。"},"maxlength":40}},{"id": "customertypemodel-type_sort", "name": "CustomerTypeModel[type_sort]", "attribute": "type_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "customertypemodel-type_name", "name": "CustomerTypeModel[type_name]", "attribute": "type_name", "rules": {"ajax":{"url":"/shop/customer-type/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcQ3VzdG9tZXJUeXBlTW9kZWw=","attribute":"type_name","params":["CustomerTypeModel[type_id]","CustomerTypeModel[shop_id]"],"scenario":"update"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
        @endif
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#CustomerTypeModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#CustomerTypeModel").submit();

            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop