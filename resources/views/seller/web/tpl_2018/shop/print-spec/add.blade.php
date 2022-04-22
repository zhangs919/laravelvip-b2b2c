{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <form id="PrintSpecModel" class="form-horizontal" name="PrintSpecModel" action="/shop/print-spec/add" method="post">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix">
            <!-- 编号  -->
            <input type="hidden" id="printspecmodel-id" class="form-control" name="PrintSpecModel[id]" value="{{ $info->id }}">
            <!-- 打印规格 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="printspecmodel-print_spec" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">打印规格：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select name="PrintSpecModel[print_spec]" class="form-control chosen-select" id="print_spec">

                                <option value="80MM" >80MM</option>

                                <option value="70MM" >70MM</option>

                                <option value="50MM" >50MM</option>

                                <option value="120MM*93MM" >120MM*93MM</option>

                                <option value="120MM*140MM" >120MM*140MM</option>

                                <option value="120MM*280MM" >120MM*280MM</option>

                                <option value="190MM*93MM" >190MM*93MM</option>

                                <option value="190MM*140MM" >190MM*140MM</option>

                                <option value="241MM*93MM" >241MM*93MM</option>

                                <option value="241MM*139MM" >241MM*139MM</option>

                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="printspecmodel-is_default" class="col-sm-4 control-label">

                        <span class="ng-binding">是否默认：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="PrintSpecModel[is_default]" value="0">
                                    @if(isset($info->is_default))
                                        <label><input type="checkbox" id="printspecmodel-is_default" class="form-control b-n"
                                               name="PrintSpecModel[is_default]" value="1" @if($info->is_default == 1)checked @endif data-on-text="是"
                                               data-off-text="否"></label>
                                    @else
                                        <label><input type="checkbox" id="printspecmodel-is_default" class="form-control b-n"
                                               name="PrintSpecModel[is_default]" value="1" data-on-text="是"
                                               data-off-text="否"></label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：在打印订单、打印发货单中，则会以默认打印规格进行展示，并且自动打印订单，将调取默认打印规格进行打印</div></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交">

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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "printspecmodel-print_spec", "name": "PrintSpecModel[print_spec]", "attribute": "print_spec", "rules": {"required":true,"messages":{"required":"打印规格不能为空。"}}},{"id": "printspecmodel-shop_id", "name": "PrintSpecModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "printspecmodel-printer", "name": "PrintSpecModel[printer]", "attribute": "printer", "rules": {"required":true,"messages":{"required":"打印机名称不能为空。"}}},{"id": "printspecmodel-is_default", "name": "PrintSpecModel[is_default]", "attribute": "is_default", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否默认必须是整数。"}}},{"id": "printspecmodel-shop_id", "name": "PrintSpecModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "printspecmodel-print_spec", "name": "PrintSpecModel[print_spec]", "attribute": "print_spec", "rules": {"string":true,"messages":{"string":"打印规格必须是一条字符串。","maxlength":"打印规格只能包含至多20个字符。"},"maxlength":20}},{"id": "printspecmodel-printer", "name": "PrintSpecModel[printer]", "attribute": "printer", "rules": {"string":true,"messages":{"string":"打印机名称必须是一条字符串。","maxlength":"打印机名称只能包含至多255个字符。"},"maxlength":255}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#PrintSpecModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#PrintSpecModel").submit();
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop