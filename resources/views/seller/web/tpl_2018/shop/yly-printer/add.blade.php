{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <form id="YlyPrinterModel" class="form-horizontal" name="YlyPrinterModel" action="/shop/yly-printer/add" method="post">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix">
            <!-- 编号  -->
            <input type="hidden" id="ylyprintermodel-id" class="form-control" name="YlyPrinterModel[id]" value="{{ $info->id ?? '' }}">
            <!-- 打印机终端号 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="ylyprintermodel-machine_code" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">打印机终端号：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="ylyprintermodel-machine_code" class="form-control" name="YlyPrinterModel[machine_code]" value="{{ $info->machine_code ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 打印机密钥 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="ylyprintermodel-msign" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">打印机密钥：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="ylyprintermodel-msign" class="form-control" name="YlyPrinterModel[msign]" value="{{ $info->msign ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 打印机名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="ylyprintermodel-print_name" class="col-sm-4 control-label">

                        <span class="ng-binding">打印机名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="ylyprintermodel-print_name" class="form-control" name="YlyPrinterModel[print_name]" value="{{ $info->print_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 手机号 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="ylyprintermodel-phone" class="col-sm-4 control-label">

                        <span class="ng-binding">手机号：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="ylyprintermodel-phone" class="form-control" name="YlyPrinterModel[phone]" value="{{ $info->phone ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="ylyprintermodel-is_default" class="col-sm-4 control-label">

                        <span class="ng-binding">是否默认：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="YlyPrinterModel[is_default]" value="0">
                                    @if(isset($info->is_default))
                                        <label><input type="checkbox" id="ylyprintermodel-is_default" class="form-control b-n"
                                                      name="YlyPrinterModel[is_default]" value="1" readonly="true" @if($info->is_default == 1)checked @endif data-on-text="是"
                                                      data-off-text="否"></label>
                                    @else
                                        <label><input type="checkbox" id="ylyprintermodel-is_default" class="form-control b-n"
                                                      name="YlyPrinterModel[is_default]" value="1" readonly="true" data-on-text="是"
                                                      data-off-text="否"></label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
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
[{"id": "ylyprintermodel-machine_code", "name": "YlyPrinterModel[machine_code]", "attribute": "machine_code", "rules": {"required":true,"messages":{"required":"打印机终端号不能为空。"}}},{"id": "ylyprintermodel-msign", "name": "YlyPrinterModel[msign]", "attribute": "msign", "rules": {"required":true,"messages":{"required":"打印机密钥不能为空。"}}},{"id": "ylyprintermodel-is_default", "name": "YlyPrinterModel[is_default]", "attribute": "is_default", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否默认必须是整数。"}}},{"id": "ylyprintermodel-shop_id", "name": "YlyPrinterModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "ylyprintermodel-machine_code", "name": "YlyPrinterModel[machine_code]", "attribute": "machine_code", "rules": {"string":true,"messages":{"string":"打印机终端号必须是一条字符串。","maxlength":"打印机终端号只能包含至多16个字符。"},"maxlength":16}},{"id": "ylyprintermodel-phone", "name": "YlyPrinterModel[phone]", "attribute": "phone", "rules": {"string":true,"messages":{"string":"手机号必须是一条字符串。","maxlength":"手机号只能包含至多16个字符。"},"maxlength":16}},{"id": "ylyprintermodel-print_name", "name": "YlyPrinterModel[print_name]", "attribute": "print_name", "rules": {"string":true,"messages":{"string":"打印机名称必须是一条字符串。","maxlength":"打印机名称只能包含至多16个字符。"},"maxlength":16}},{"id": "ylyprintermodel-msign", "name": "YlyPrinterModel[msign]", "attribute": "msign", "rules": {"string":true,"messages":{"string":"打印机密钥必须是一条字符串。","maxlength":"打印机密钥只能包含至多64个字符。"},"maxlength":64}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#YlyPrinterModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $.post('/shop/yly-printer/add', $("#YlyPrinterModel").serializeJson(), function(result) {
                    // 停止加载
                    $.loading.stop();
                    if (result.code == 0) {
                        $.go('/shop/yly-printer/list');
                        $.msg(result.message, {
                            time: 3000
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, 'json');
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop