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

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=open_shop" method="post" enctype="multipart/form-data" novalidate="novalidate">
        {{ csrf_field() }}
        <input type="hidden" name="group" value="open_shop">
        <input type="hidden" name="tabs" value="">
        <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">
        <div class="table-content m-t-30">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-base_fee" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">平台保证金：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-base_fee" class="form-control ipt m-r-10" name="SystemConfigModel[base_fee]" value="{{ $config_info['base_fee']->value }}">

                            元


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">0表示无需支付保证金</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-use_fee" class="col-sm-4 control-label">

                        <span class="ng-binding">平台使用费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="SystemConfigModel[use_fee]" value="">
                            <div id="systemconfigmodel-use_fee" class="" name="SystemConfigModel[use_fee]">
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="SystemConfigModel[use_fee]" value="0" @if($config_info['use_fee']->value == 0) checked="" @endif> 免费</label>
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="SystemConfigModel[use_fee]" value="1" @if($config_info['use_fee']->value == 1) checked="" @endif> 付费</label></div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="SystemConfigModel[use_fee_value]" value="1">
            <div id="set_use_fee">

                @if(count($config_info['use_fee_value']->value) > 0)
                    @foreach($config_info['use_fee_value']->value['number'] as $k=>$item)
                        <div class="simple-form-field">
                            <div class="form-group m-b-10">
                                <label class="col-sm-4 control-label"> </label>
                                <div class="col-sm-8">
                                    <div class="form-control-box w400">

                                        @if($k == 0)
                                            <label class="control-label">
                                                <a class="btn-link c-blue" href="javascript:void(0);">
                                                    <i class="fa fa-plus-circle" onclick="$('#set_use_fee').append($('#copy_source').html())"></i>
                                                </a>
                                            </label>
                                        @else
                                            <label class="control-label" onclick="$(this).parent().parent().parent().remove()">
                                                <a class="btn-link c-blue" href="javascript:void(0);">
                                                    <i class="fa fa-minus-circle"></i>
                                                </a>
                                            </label>
                                        @endif

                                        <input class="form-control ipt pull-none m-r-5 disable" type="text" name="SystemConfigModel[use_fee_value][number][]" placeholder="请输入>0的数字" value="{{ $config_info['use_fee_value']->value['number'][$k] }}">
                                        <select class="form-control ipt pull-none m-r-10 disable" name="SystemConfigModel[use_fee_value][unit][]">

                                            <option value="year" @if($config_info['use_fee_value']->value['unit'][$k] == 'year') selected="" @endif>年</option>

                                            <option value="month" @if($config_info['use_fee_value']->value['unit'][$k] == 'month') selected="" @endif>月</option>

                                            <option value="day" @if($config_info['use_fee_value']->value['unit'][$k] == 'day') selected="" @endif>天</option>

                                        </select>
                                        <label class="disp-inlblock m-b-0">
                                            费用：
                                            <input class="form-control ipt pull-none m-r-5 disable" type="text" value="{{ $config_info['use_fee_value']->value['fee'][$k] }}" name="SystemConfigModel[use_fee_value][fee][]">
                                            元
                                        </label>
                                    </div>
                                    <span class="error-msg form-control-error" style="display: none">
                                    <i class="fa fa-warning"></i>
                                    时间为大于0的整数；费用为大于或等于0的整数。
                                </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="simple-form-field">
                        <div class="form-group m-b-10">
                            <label class="col-sm-4 control-label"> </label>
                            <div class="col-sm-8">
                                <div class="form-control-box w400">

                                    <label class="control-label">
                                        <a class="btn-link c-blue" href="javascript:void(0);">
                                            <i class="fa fa-plus-circle" onclick="$('#set_use_fee').append($('#copy_source').html())"></i>
                                        </a>
                                    </label>

                                    <input class="form-control ipt pull-none m-r-5 disable" type="text" name="SystemConfigModel[use_fee_value][number][]" placeholder="请输入>0的数字" value="1">
                                    <select class="form-control ipt pull-none m-r-10 disable" name="SystemConfigModel[use_fee_value][unit][]">

                                        <option value="year" selected="">年</option>

                                        <option value="month">月</option>

                                        <option value="day">天</option>

                                    </select>
                                    <label class="disp-inlblock m-b-0">
                                        费用：
                                        <input class="form-control ipt pull-none m-r-5 disable" type="text" value="1000" name="SystemConfigModel[use_fee_value][fee][]">
                                        元
                                    </label>
                                </div>
                                <span class="error-msg form-control-error" style="display: none">
							<i class="fa fa-warning"></i>
							时间为大于0的整数；费用为大于或等于0的整数。
						</span>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <br>
            <!--错误提示模块 end-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-first_warn" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">首次警告：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            到期前

                            <input type="text" id="systemconfigmodel-first_warn" class="form-control ipt m-l-10 m-r-10" name="SystemConfigModel[first_warn]" value="{{ $config_info['first_warn']->value }}">

                            天


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">首次警告：比如：30天，表示店铺还有30天到期时，店铺将自动进入到待续费店铺列表中，且系统会自动向店铺发送到期续费提醒 </div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-second_warn" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">再次警告：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            到期前

                            <input type="text" id="systemconfigmodel-second_warn" class="form-control ipt m-l-10 m-r-10" name="SystemConfigModel[second_warn]" value="{{ $config_info['second_warn']->value }}">

                            天


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">再次警告：比如：10天，店铺还有10天到期时，会再次向店铺发送到期续费提醒 </div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-third_warn" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">三次警告：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            到期前

                            <input type="text" id="systemconfigmodel-third_warn" class="form-control ipt m-l-10 m-r-10" name="SystemConfigModel[third_warn]" value="{{ $config_info['third_warn']->value }}">

                            天


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">三次警告：比如：3天，店铺还有3天到期时，会第三次向店铺发送到期续费提醒<br>如设置为0天，表示不发送续费提醒通知 </div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <button id="btn_submit" class="btn btn-primary btn-lg">确认提交</button>
            </div>
        </div>
    </form>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')
    <div id="copy_source_1" style="display: none">
        <div class="simple-form-field">
            <div class="form-group m-b-10">
                <label class="col-sm-4 control-label"> </label>
                <div class="col-sm-8">
                    <div class="form-control-box w400">
                        <label class="control-label">
                            <a class="btn-link c-blue" href="javascript:void(0);">
                                <i class="fa fa-plus-circle" onclick="$('#set_use_fee').append($('#copy_source').html())"></i>
                            </a>
                        </label>
                        <input class="form-control ipt pull-none m-r-5 disable" type="text" name="SystemConfigModel[use_fee_value][number][]" placeholder="请输入>0的数字">
                        <select class="form-control ipt pull-none m-r-10 disable" name="SystemConfigModel[use_fee_value][unit][]">

                            <option value="year">年</option>

                            <option value="month">月</option>

                            <option value="day">天</option>

                        </select>
                        <label class="disp-inlblock m-b-0">
                            费用：
                            <input class="form-control ipt pull-none m-r-5 disable" type="text" value="0" name="SystemConfigModel[use_fee_value][fee][]">
                            元
                        </label>
                    </div>
                    <span class="error-msg form-control-error" style="display: none">
					<i class="fa fa-warning"></i>
					时间为大于0的整数；费用为大于或等于0的整数。
				</span>
                </div>
            </div>
        </div>
    </div>
    <div id="copy_source" style="display: none">
        <div class="simple-form-field">
            <div class="form-group m-b-10">
                <label class="col-sm-4 control-label"> </label>
                <div class="col-sm-8">
                    <div class="form-control-box w400">
                        <label class="control-label" onclick="$(this).parent().parent().parent().remove()">
                            <a class="btn-link c-blue" href="javascript:void(0);">
                                <i class="fa fa-minus-circle"></i>
                            </a>
                        </label>
                        <input class="form-control ipt pull-none m-r-5 disable" type="text" name="SystemConfigModel[use_fee_value][number][]" placeholder="请输入>0的数字">
                        <select class="form-control ipt pull-none m-r-10 disable" name="SystemConfigModel[use_fee_value][unit][]">

                            <option value="year">年</option>

                            <option value="month">月</option>

                            <option value="day">天</option>

                        </select>
                        <label class="disp-inlblock m-b-0">
                            费用：
                            <input class="form-control ipt pull-none m-r-5 disable" type="text" value="0" name="SystemConfigModel[use_fee_value][fee][]">
                            元
                        </label>
                    </div>
                    <span class="error-msg form-control-error" style="display: none">
					<i class="fa fa-warning"></i>
					时间为大于0的整数；费用为大于或等于0的整数。
				</span>
                </div>
            </div>
        </div>
    </div>
    <div id="linshi" style="display: none">
        <input class="form-control ipt pull-none m-r-5" type="text" value="0" name="SystemConfigModel[use_fee_value]">
    </div>
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
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "systemconfigmodel-base_fee", "name": "SystemConfigModel[base_fee]", "attribute": "base_fee", "rules": {"string":true,"messages":{"string":"平台保证金必须是一条字符串。"}}},{"id": "systemconfigmodel-base_fee", "name": "SystemConfigModel[base_fee]", "attribute": "base_fee", "rules": {"required":true,"messages":{"required":"平台保证金不能为空。"}}},{"id": "systemconfigmodel-base_fee", "name": "SystemConfigModel[base_fee]", "attribute": "base_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"平台保证金必须是一个数字。","min":"平台保证金必须不小于0。"},"min":0}},{"id": "systemconfigmodel-base_fee", "name": "SystemConfigModel[base_fee]", "attribute": "base_fee", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字。"}}},{"id": "systemconfigmodel-use_fee", "name": "SystemConfigModel[use_fee]", "attribute": "use_fee", "rules": {"string":true,"messages":{"string":"平台使用费必须是一条字符串。"}}},{"id": "systemconfigmodel-use_fee_value", "name": "SystemConfigModel[use_fee_value]", "attribute": "use_fee_value", "rules": {"required":true,"messages":{"required":"Use Fee Value不能为空。"}}},{"id": "systemconfigmodel-first_warn", "name": "SystemConfigModel[first_warn]", "attribute": "first_warn", "rules": {"string":true,"messages":{"string":"首次警告必须是一条字符串。"}}},{"id": "systemconfigmodel-first_warn", "name": "SystemConfigModel[first_warn]", "attribute": "first_warn", "rules": {"required":true,"messages":{"required":"首次警告不能为空。"}}},{"id": "systemconfigmodel-first_warn", "name": "SystemConfigModel[first_warn]", "attribute": "first_warn", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"首次警告必须是整数。","min":"首次警告必须不小于0。"},"min":0}},{"id": "systemconfigmodel-second_warn", "name": "SystemConfigModel[second_warn]", "attribute": "second_warn", "rules": {"string":true,"messages":{"string":"再次警告必须是一条字符串。"}}},{"id": "systemconfigmodel-second_warn", "name": "SystemConfigModel[second_warn]", "attribute": "second_warn", "rules": {"required":true,"messages":{"required":"再次警告不能为空。"}}},{"id": "systemconfigmodel-second_warn", "name": "SystemConfigModel[second_warn]", "attribute": "second_warn", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"再次警告必须是整数。","min":"再次警告必须不小于0。"},"min":0}},{"id": "systemconfigmodel-third_warn", "name": "SystemConfigModel[third_warn]", "attribute": "third_warn", "rules": {"string":true,"messages":{"string":"三次警告必须是一条字符串。"}}},{"id": "systemconfigmodel-third_warn", "name": "SystemConfigModel[third_warn]", "attribute": "third_warn", "rules": {"required":true,"messages":{"required":"三次警告不能为空。"}}},{"id": "systemconfigmodel-third_warn", "name": "SystemConfigModel[third_warn]", "attribute": "third_warn", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"三次警告必须是整数。","min":"三次警告必须不小于0。"},"min":0}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };

            var validator = $("#SystemConfigModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return false;
                }

                var has_err = false;
                $("#set_use_fee input[name='SystemConfigModel[use_fee_value][number][]']").each(function() {
                    var val = $(this).val();
                    if (!isPositiveNum(val)) {
                        has_err = true;
                        $(this).parent().parent().find(".error-msg").css('display', 'block');
                        $(this).addClass("error");
                    } else {
                        $(this).parent().parent().find(".error-msg").css('display', 'none');
                        $(this).removeClass("error");
                    }
                });
                $("#set_use_fee input[name='SystemConfigModel[use_fee_value][fee][]']").each(function() {
                    var val = $(this).val();
                    if (!isPositiveNum(val) && val != '0') {
                        has_err = true;
                        $(this).parent().parent().parent().find(".error-msg").css('display', 'block');
                        $(this).addClass("error");
                    } else {
                        if (!has_err) {
                            $(this).parent().parent().parent().find(".error-msg").css('display', 'none');
                            $(this).removeClass("error");
                        }
                    }
                });
                if (has_err) {
                    return false;
                }

                $.loading.start();
                $("#SystemConfigModel").submit();
            });

            // 判断是否为正整数
            function isPositiveNum(s) {
                var re = /^[0-9]*[1-9][0-9]*$/;
                return re.test(s);
            }

            $("input[name='SystemConfigModel[use_fee]']").change(function() {
                if (this.value > 0) {
                    $("input[name='SystemConfigModel[use_fee_value][fee][]']").each(function(element) {
                        $(this).removeAttr("readonly");
                    });
                } else {
                    $("input[name='SystemConfigModel[use_fee_value][fee][]']").each(function(element) {
                        $(this).val(0);
                        $(this).attr({
                            readonly: 'true'
                        });
                    });
                }
            });

            if ($("input[name='SystemConfigModel[use_fee]']:checked").val() == 1) {
                $("input[name='SystemConfigModel[use_fee_value][fee][]']").each(function(element) {
                    $(this).removeAttr("readonly");
                });
            } else {
                $("input[name='SystemConfigModel[use_fee_value][fee][]']").each(function(element) {
                    $(this).val(0);
                    $(this).attr({
                        readonly: 'true'
                    });
                });
            }
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop