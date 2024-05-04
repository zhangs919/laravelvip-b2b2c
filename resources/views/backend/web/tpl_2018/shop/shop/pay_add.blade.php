{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>

    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180027"></script>

    <script src="/assets/d2eace91/js/datetime/dateformat.js?v=20180027"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="ShopPaymentModel" class="form-horizontal" name="ShopPaymentModel" action="/shop/shop/pay-add?{{ $extra }}" method="post">
            @csrf
            <!-- 付款ID -->
            <input type="hidden" id="shoppaymentmodel-pay_id" class="form-control" name="ShopPaymentModel[pay_id]" value="{{ $info->pay_id ?? '' }}">
            <!-- 店铺ID -->
            <input type="hidden" id="shoppaymentmodel-shop_id" class="form-control" name="ShopPaymentModel[shop_id]" value="{{ $shop_info->shop_id }}">

            <!-- 平台保证金 -->
            <input type="hidden" id="shoppaymentmodel-insure_fee" class="form-control" name="ShopPaymentModel[insure_fee]" value="{{ $info->insure_fee ?? sysconf('base_fee') }}">
            <!-- 是否续费 -->
            <input type="hidden" id="shoppaymentmodel-is_renew" class="form-control" name="ShopPaymentModel[is_renew]" value="{{ $info->is_renew ?? 1 }}">

            <!-- 开店时长 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoppaymentmodel-duration" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">开店时长：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="shoppaymentmodel-duration" class="form-control" name="ShopPaymentModel[duration]">
                                <option value="">-- 请选择 --</option>
                                @if(!empty($use_fee_value))
                                    @foreach($use_fee_value['number'] as $k=>$item)
                                        @php $f_value = $use_fee_value['number'][$k].'-'.$use_fee_value['unit'][$k].'-'.$use_fee_value['fee'][$k]; @endphp
                                        <option value="{{ $f_value }}" @if(@$info->duration == $f_value) selected @endif>{{ $use_fee_value['number'][$k] }}{{ format_unit($use_fee_value['unit'][$k]) }}</option>
                                    @endforeach
                                @endif
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 平台使用费 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoppaymentmodel-system_fee" class="col-sm-4 control-label">

                        <span class="ng-binding">平台使用费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            @if(sysconf('use_fee') == 0){{--免费--}}
                                <input type="text" id="shoppaymentmodel-system_fee" class="form-control ipt m-r-5" name="ShopPaymentModel[system_fee]" value="0.00"> 元
                            @else{{--收费--}}
                                <input type="text" id="shoppaymentmodel-system_fee" class="form-control ipt m-r-5" name="ShopPaymentModel[system_fee]" value="{{ $info->system_fee ?? '0.00' }}"> 元
                            @endif
                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请与店主协商后，再修改平台使用费</div></div>
                    </div>
                </div>
            </div>
            <!-- 起始时间 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoppaymentmodel-begin_time" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">起始时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            @if(isset($info->pay_id))
                                <input type="text" id="shoppaymentmodel-begin_time" class="form-control form_datetime large pull-none" name="ShopPaymentModel[begin_time]"
                                       value="@if(!empty($info->begin_time)){{ $info->begin_time }}@elseif(!empty($shop_info->end_time)){{format_time($shop_info->end_time) }}@else{{ format_time(time()) }}@endif" readonly="readonly">
                            @else
                                <input type="text" id="shoppaymentmodel-begin_time" class="form-control form_datetime large pull-none" name="ShopPaymentModel[begin_time]"
                                       value="@if(!empty($shop_info->end_time)){{ format_time($shop_info->end_time+1) }}@else{{ format_time(time()) }}@endif" readonly="readonly">
                            @endif

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺到期时间 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoppaymentmodel-end_time" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding"> 店铺到期时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            @if(isset($info->pay_id))
                                <input type="text" id="shoppaymentmodel-end_time" class="form-control form_datetime large pull-none" name="ShopPaymentModel[end_time]" value="{{ $info->end_time ?? '' }}" readonly="readonly">
                            @else
                                <input type="text" id="shoppaymentmodel-end_time" class="form-control form_datetime large pull-none" name="ShopPaymentModel[end_time]" readonly="readonly">
                            @endif


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺到期时间根据开店时长自动生成，如非特殊情况请不要随意修改到期时间，付款成功后店铺将于此时间到期</div></div>
                    </div>
                </div>
            </div>
            <!-- 付款方式 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoppaymentmodel-pay_code" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">付款方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="shoppaymentmodel-pay_code" class="form-control" name="ShopPaymentModel[pay_code]">
                                <option value="">-- 请选择 --</option>
                                <option value="支付宝" @if(@$info->pay_code == '支付宝') selected @endif>支付宝</option>
                                <option value="银联支付" @if(@$info->pay_code == '银联支付') selected @endif>银联支付</option>
                                <option value="微信支付" @if(@$info->pay_code == '微信支付') selected @endif>微信支付</option>
                                <option value="虚拟账户" @if(@$info->pay_code == '虚拟账户') selected @endif>虚拟账户</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺付款使用的支付方式</div></div>
                    </div>
                </div>
            </div>
            <!-- 付款时间 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoppaymentmodel-pay_time" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">付款时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shoppaymentmodel-pay_time" class="form-control form_datetime large pull-none" name="ShopPaymentModel[pay_time]" value="{{ $info->pay_time ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果您不输入付款时间，系统将以当前时间为准</div></div>
                    </div>
                </div>
            </div>
            <!-- 付款状态 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoppaymentmodel-pay_status" class="col-sm-4 control-label">

                        <span class="ng-binding">付款状态：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="ShopPaymentModel[pay_status]" value="">
                            <div id="shoppaymentmodel-pay_status" class="" name="ShopPaymentModel[pay_status]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopPaymentModel[pay_status]" value="0" @if(@$info->pay_status == 0){{ 'checked' }}@endif> 未付款</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopPaymentModel[pay_status]" value="1" @if(@$info->pay_status == 1){{ 'checked' }}@endif> 已付款</label></div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 备注 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoppaymentmodel-remark" class="col-sm-4 control-label">

                        <span class="ng-binding">备注：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shoppaymentmodel-remark" class="form-control" name="ShopPaymentModel[remark]" rows="5">{!! $info->remark ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class="bottom-btn p-b-30">
                <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">
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

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        @if(!isset($info->pay_id))
            [{"id": "shoppaymentmodel-shop_id", "name": "ShopPaymentModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "shoppaymentmodel-begin_time", "name": "ShopPaymentModel[begin_time]", "attribute": "begin_time", "rules": {"required":true,"messages":{"required":"起始时间不能为空。"}}},{"id": "shoppaymentmodel-pay_time", "name": "ShopPaymentModel[pay_time]", "attribute": "pay_time", "rules": {"required":true,"messages":{"required":"付款时间不能为空。"}}},{"id": "shoppaymentmodel-pay_code", "name": "ShopPaymentModel[pay_code]", "attribute": "pay_code", "rules": {"required":true,"messages":{"required":"付款方式不能为空。"}}},{"id": "shoppaymentmodel-end_time", "name": "ShopPaymentModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":" 店铺到期时间不能为空。"}}},{"id": "shoppaymentmodel-duration", "name": "ShopPaymentModel[duration]", "attribute": "duration", "rules": {"required":true,"messages":{"required":"开店时长不能为空。"}}},{"id": "shoppaymentmodel-shop_id", "name": "ShopPaymentModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "shoppaymentmodel-unit", "name": "ShopPaymentModel[unit]", "attribute": "unit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Unit必须是整数。"}}},{"id": "shoppaymentmodel-pay_status", "name": "ShopPaymentModel[pay_status]", "attribute": "pay_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"付款状态必须是整数。"}}},{"id": "shoppaymentmodel-is_renew", "name": "ShopPaymentModel[is_renew]", "attribute": "is_renew", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Renew必须是整数。"}}},{"id": "shoppaymentmodel-system_fee", "name": "ShopPaymentModel[system_fee]", "attribute": "system_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"平台使用费必须是一个数字。","min":"平台使用费必须不小于0。"},"min":0}},{"id": "shoppaymentmodel-insure_fee", "name": "ShopPaymentModel[insure_fee]", "attribute": "insure_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"平台保证金必须是一个数字。","min":"平台保证金必须不小于0。"},"min":0}},{"id": "shoppaymentmodel-remark", "name": "ShopPaymentModel[remark]", "attribute": "remark", "rules": {"string":true,"messages":{"string":"备注必须是一条字符串。","maxlength":"备注只能包含至多155个字符。"},"maxlength":155}},{"id": "shoppaymentmodel-insure_fee", "name": "ShopPaymentModel[insure_fee]", "attribute": "insure_fee", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "shoppaymentmodel-system_fee", "name": "ShopPaymentModel[system_fee]", "attribute": "system_fee", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},]
        @else
            [{"id": "shoppaymentmodel-pay_id", "name": "ShopPaymentModel[pay_id]", "attribute": "pay_id", "rules": {"required":true,"messages":{"required":"付款ID不能为空。"}}},{"id": "shoppaymentmodel-shop_id", "name": "ShopPaymentModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "shoppaymentmodel-begin_time", "name": "ShopPaymentModel[begin_time]", "attribute": "begin_time", "rules": {"required":true,"messages":{"required":"起始时间不能为空。"}}},{"id": "shoppaymentmodel-pay_time", "name": "ShopPaymentModel[pay_time]", "attribute": "pay_time", "rules": {"required":true,"messages":{"required":"付款时间不能为空。"}}},{"id": "shoppaymentmodel-pay_code", "name": "ShopPaymentModel[pay_code]", "attribute": "pay_code", "rules": {"required":true,"messages":{"required":"付款方式不能为空。"}}},{"id": "shoppaymentmodel-end_time", "name": "ShopPaymentModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":" 店铺到期时间不能为空。"}}},{"id": "shoppaymentmodel-duration", "name": "ShopPaymentModel[duration]", "attribute": "duration", "rules": {"required":true,"messages":{"required":"开店时长不能为空。"}}},{"id": "shoppaymentmodel-shop_id", "name": "ShopPaymentModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "shoppaymentmodel-unit", "name": "ShopPaymentModel[unit]", "attribute": "unit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Unit必须是整数。"}}},{"id": "shoppaymentmodel-pay_status", "name": "ShopPaymentModel[pay_status]", "attribute": "pay_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"付款状态必须是整数。"}}},{"id": "shoppaymentmodel-is_renew", "name": "ShopPaymentModel[is_renew]", "attribute": "is_renew", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Renew必须是整数。"}}},{"id": "shoppaymentmodel-system_fee", "name": "ShopPaymentModel[system_fee]", "attribute": "system_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"平台使用费必须是一个数字。","min":"平台使用费必须不小于0。"},"min":0}},{"id": "shoppaymentmodel-insure_fee", "name": "ShopPaymentModel[insure_fee]", "attribute": "insure_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"平台保证金必须是一个数字。","min":"平台保证金必须不小于0。"},"min":0}},{"id": "shoppaymentmodel-remark", "name": "ShopPaymentModel[remark]", "attribute": "remark", "rules": {"string":true,"messages":{"string":"备注必须是一条字符串。","maxlength":"备注只能包含至多155个字符。"},"maxlength":155}},{"id": "shoppaymentmodel-insure_fee", "name": "ShopPaymentModel[insure_fee]", "attribute": "insure_fee", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "shoppaymentmodel-system_fee", "name": "ShopPaymentModel[system_fee]", "attribute": "system_fee", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},]
        @endif
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

            var validator = $("#ShopPaymentModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                if ($("#shoppaymentmodel-end_time").val() < $("#shoppaymentmodel-begin_time").val()) {
                    $.msg("店铺到期时间不能小于起始时间。");
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ShopPaymentModel").submit();
            });
        });
    </script>
    <script type='text/javascript'>
        (function($) {
            $(window).load(function() {
                $(".edit-table ul").mCustomScrollbar();
            });
        })(jQuery);

        $('.form_datetime.ipt').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2, // 只选年月日
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd 23:59:59',
        });

        $('.form_datetime.large').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd hh:ii:ss',
        });

        $('#shoppaymentmodel-begin_time').datetimepicker().on('changeDate', function(ev) {
            $('#shoppaymentmodel-end_time').datetimepicker('setStartDate', ev.date);
        });
        $('#shoppaymentmodel-end_time').datetimepicker().on('changeDate', function(ev) {
            $('#shoppaymentmodel-begin_time').datetimepicker('setEndDate', ev.date);
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $("#shoppaymentmodel-duration").change(function() {
                // 平台使用费
                var payment = 0;
                // 起始时间
                var start_time = $("#shoppaymentmodel-begin_time").val();
                // 店铺到期时间
                var end_time = new Date(start_time);
                if ($(this).val() != "") {
                    var array = $(this).val().split("-");
                    payment = parseFloat(array[2]);

                    var duration = parseInt(array[0]);
                    if (array[1] == "year") {
                        end_time.setFullYear(end_time.getFullYear() + duration);
                    } else if (array[1] == "month") {
                        end_time.setMonth(end_time.getMonth() + duration);
                    } else if (array[1] == "day") {
                        end_time.setDate(end_time.getDate() + duration);
                    }
                    end_time.setDate(end_time.getDate() - 1);
                }
                $("#shoppaymentmodel-system_fee").val(payment.toFixed(2));
                $("#shoppaymentmodel-end_time").val(end_time.Format("yyyy-MM-dd 23:59:59"));
                /* if (end_time > new Date()) {
                    $("#shoppaymentmodel-end_time").val(end_time.Format("yyyy-MM-dd 23:59:59"));
                } else {
                    $("#shoppaymentmodel-end_time").val("");
                } */
            });

            if ($("#shoppaymentmodel-pay_time").val() == "") {
                $("#shoppaymentmodel-pay_time").val(new Date().Format("yyyy-MM-dd HH:mm:ss"));
            }

            $("#shoppaymentmodel-duration").change();
        });
    </script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop