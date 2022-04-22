{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/datetime/dateformat.js?v=20180702"></script>
@stop

{{--content--}}
@section('content')

    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <div class="table-content m-t-30 clearfix">
        <form id="ShopPaymentModel" class="form-horizontal" name="ShopPaymentModel" action="/shop/shop-info/renew-add.html" method="post">
            <input type="hidden" name="_csrf" value="XGRUNU-MqwaLHkwtEJ8IO8zCOrXfceZ7SF_JE55z4T8qVjJAKL3GTMUzeExf_j1R4bJN_41FpSIOJ6V_5guuSQ==">
            <!-- 店铺ID -->
            <input type="hidden" id="shoppaymentmodel-shop_id" class="form-control" name="ShopPaymentModel[shop_id]" value="1">
            <!-- 平台保证金 -->
            <input type="hidden" id="shoppaymentmodel-insure_fee" class="form-control" name="ShopPaymentModel[insure_fee]" value="0">
            <!-- 是否续费 -->
            <input type="hidden" id="shoppaymentmodel-is_renew" class="form-control" name="ShopPaymentModel[is_renew]" value="1">
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
                                <option value="1-year-0">1年</option>
                                <option value="6-month-0">6个月</option>
                                <option value="30-day-0">30天</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 平台使用费 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">平台使用费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">
                                <strong id="label_system_fee" class="order-amount"></strong>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 起始时间 -->
            <input type="hidden" id="shoppaymentmodel-begin_time" class="form-control" name="ShopPaymentModel[begin_time]" value="2020-08-23">
            <!-- 店铺到期时间 -->
            <input type="hidden" id="shoppaymentmodel-end_time" class="form-control" name="ShopPaymentModel[end_time]">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">预计店铺到期时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label" id="label_end_time"></label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 付款方式 -->
            <input type="hidden" id="shoppaymentmodel-pay_type" class="form-control" name="ShopPaymentModel[pay_type]" value="0">
            <!-- 付款时间 -->
            <input type="hidden" id="shoppaymentmodel-pay_time" class="form-control" name="ShopPaymentModel[pay_time]" value="0">
            <!-- 付款状态 -->
            <input type="hidden" id="shoppaymentmodel-pay_status" class="form-control" name="ShopPaymentModel[pay_status]" value="0">
            <!-- 备注 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoppaymentmodel-remark" class="col-sm-4 control-label">

                        <span class="ng-binding">备注：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shoppaymentmodel-remark" class="form-control" name="ShopPaymentModel[remark]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180702"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180702"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180702"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "shoppaymentmodel-shop_id", "name": "ShopPaymentModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop Id不能为空。"}}},{"id": "shoppaymentmodel-begin_time", "name": "ShopPaymentModel[begin_time]", "attribute": "begin_time", "rules": {"required":true,"messages":{"required":"Begin Time不能为空。"}}},{"id": "shoppaymentmodel-pay_time", "name": "ShopPaymentModel[pay_time]", "attribute": "pay_time", "rules": {"required":true,"messages":{"required":"Pay Time不能为空。"}}},{"id": "shoppaymentmodel-duration", "name": "ShopPaymentModel[duration]", "attribute": "duration", "rules": {"required":true,"messages":{"required":"开店时长不能为空。"}}},{"id": "shoppaymentmodel-shop_id", "name": "ShopPaymentModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shop Id必须是整数。"}}},{"id": "shoppaymentmodel-unit", "name": "ShopPaymentModel[unit]", "attribute": "unit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Unit必须是整数。"}}},{"id": "shoppaymentmodel-pay_status", "name": "ShopPaymentModel[pay_status]", "attribute": "pay_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Pay Status必须是整数。"}}},{"id": "shoppaymentmodel-is_renew", "name": "ShopPaymentModel[is_renew]", "attribute": "is_renew", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Renew必须是整数。"}}},{"id": "shoppaymentmodel-system_fee", "name": "ShopPaymentModel[system_fee]", "attribute": "system_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"费用必须是一个数字。"}}},{"id": "shoppaymentmodel-insure_fee", "name": "ShopPaymentModel[insure_fee]", "attribute": "insure_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"Insure Fee必须是一个数字。"}}},{"id": "shoppaymentmodel-remark", "name": "ShopPaymentModel[remark]", "attribute": "remark", "rules": {"string":true,"messages":{"string":"备注必须是一条字符串。","maxlength":"备注只能包含至多155个字符。"},"maxlength":155}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ShopPaymentModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ShopPaymentModel").submit();
            });
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

                if ($(this).val() != "" && end_time >= new Date(start_time)) {
                    $("#label_system_fee").text(payment.toFixed(2) + "  元");
                    $("#shoppaymentmodel-end_time").val(end_time.Format("yyyy-MM-dd"));
                    $("#label_end_time").text(end_time.Format("yyyy-MM-dd"));
                } else {
                    $("#label_system_fee").text("");
                    $("#shoppaymentmodel-end_time").val("");
                    $("#label_end_time").text("");
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop