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

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=deposit" method="post" enctype="multipart/form-data" novalidate="novalidate">
        @csrf
        <input type="hidden" name="group" value="deposit">
        <input type="hidden" name="tabs" value="">
        <input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">
        <div class="table-content m-t-30">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-is_deposit" class="col-sm-4 control-label">

                        <span class="ng-binding">是否开启申请提现：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[is_deposit]" value="0">
                                    <label>
                                        <input type="checkbox"
                                               id="systemconfigmodel-is_deposit"
                                               class="form-control b-n"
                                               name="SystemConfigModel[is_deposit]"
                                               value="1" @if($group_info['is_deposit']->value == 1)checked="" @endif
                                               data-on-text="是" data-off-text="否"></label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启：消费者在用户中心可进行申请提现；关闭：消费者无法申请提现</div></div>
                    </div>
                </div>
            </div>
            <!-- 微信提现自动打款 -->

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-is_weixin_auto_deposit" class="col-sm-4 control-label">

                        <span class="ng-binding">微信提现自动打款：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[is_weixin_auto_deposit]" value="0">
                                    <label>
                                        <input type="checkbox"
                                               id="systemconfigmodel-is_weixin_auto_deposit"
                                               class="form-control b-n"
                                               name="SystemConfigModel[is_weixin_auto_deposit]"
                                               value="1" @if($group_info['is_weixin_auto_deposit']->value == 1)checked="" @endif
                                               data-on-text="是" data-off-text="否"></label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">启用：消费者提现到账户绑定的微信账户中，提现之后，平台同意申请后系统自动将提现金额打到消费者微信账户中<br>禁用：消费者无法提现到绑定的微信中</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-shoper_deposit_limit" class="col-sm-4 control-label">

                        <span class="ng-binding">商家每月提现次数：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-shoper_deposit_limit" class="form-control" name="SystemConfigModel[shoper_deposit_limit]" value="{{ $group_info['shoper_deposit_limit']->value }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请输入大于0的整数，为空表示不限制</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-user_deposit_limit" class="col-sm-4 control-label">

                        <span class="ng-binding">每天提现次数：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-user_deposit_limit" class="form-control" name="SystemConfigModel[user_deposit_limit]" value="{{ $group_info['user_deposit_limit']->value }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">限制所有会员每天提现次数，请输入大于0的整数，为空表示不限制</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-min_deposit_money" class="col-sm-4 control-label">

                        <span class="ng-binding">最低提现金额：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-min_deposit_money" class="form-control" name="SystemConfigModel[min_deposit_money]" value="{{ $group_info['min_deposit_money']->value }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">个人或店铺申请提现时，最低提现金额，请输入大于1的值</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group m-b-10">
                    <label class="col-sm-4 control-label"><span class="ng-binding">提现手续费：</span></label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <p class="m-b-5">
                                <select class="form-control m-r-10">
                                    <option>支付宝</option>
                                </select>
                                <input type="text" id="systemconfigmodel-alipay_procedures_money" class="form-control ipt m-r-10" name="SystemConfigModel[alipay_procedures_money]" value="{{ $group_info['alipay_procedures_money']->value }}">%
                            </p>
                            <p class="m-b-5">
                                <select class="form-control m-r-10">
                                    <option>银行卡</option>
                                </select>
                                <input type="text" id="systemconfigmodel-bank_procedures_money" class="form-control ipt m-r-10" name="SystemConfigModel[bank_procedures_money]" value="{{ $group_info['bank_procedures_money']->value }}">%
                            </p>
                        </div>
                        <div class="help-block help-block-t">手续费按提现金额的百分比进行收取</div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-min_procedures_money" class="col-sm-4 control-label">

                        <span class="ng-binding">最低手续费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-min_procedures_money" class="form-control ipt m-r-10" name="SystemConfigModel[min_procedures_money]" value="{{ $group_info['min_procedures_money']->value }}">

                            元


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">按提现金额百分比收取手续费后，计算结果保留两位小数后为0的话，则收取的最低手续费</div></div>
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
[{"id": "systemconfigmodel-is_deposit", "name": "SystemConfigModel[is_deposit]", "attribute": "is_deposit", "rules": {"string":true,"messages":{"string":"是否开启申请提现必须是一条字符串。"}}},{"id": "systemconfigmodel-is_weixin_auto_deposit", "name": "SystemConfigModel[is_weixin_auto_deposit]", "attribute": "is_weixin_auto_deposit", "rules": {"string":true,"messages":{"string":"微信提现自动打款必须是一条字符串。"}}},{"id": "systemconfigmodel-shoper_deposit_limit", "name": "SystemConfigModel[shoper_deposit_limit]", "attribute": "shoper_deposit_limit", "rules": {"string":true,"messages":{"string":"商家每月提现次数必须是一条字符串。"}}},{"id": "systemconfigmodel-shoper_deposit_limit", "name": "SystemConfigModel[shoper_deposit_limit]", "attribute": "shoper_deposit_limit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商家每月提现次数必须是整数。","min":"商家每月提现次数必须不小于0。"},"min":0}},{"id": "systemconfigmodel-user_deposit_limit", "name": "SystemConfigModel[user_deposit_limit]", "attribute": "user_deposit_limit", "rules": {"string":true,"messages":{"string":"每天提现次数必须是一条字符串。"}}},{"id": "systemconfigmodel-user_deposit_limit", "name": "SystemConfigModel[user_deposit_limit]", "attribute": "user_deposit_limit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"每天提现次数必须是整数。","min":"每天提现次数必须不小于0。"},"min":0}},{"id": "systemconfigmodel-min_deposit_money", "name": "SystemConfigModel[min_deposit_money]", "attribute": "min_deposit_money", "rules": {"string":true,"messages":{"string":"最低提现金额必须是一条字符串。"}}},{"id": "systemconfigmodel-min_deposit_money", "name": "SystemConfigModel[min_deposit_money]", "attribute": "min_deposit_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"最低提现金额必须是一个数字。","min":"最低提现金额必须不小于1。"},"min":1}},{"id": "systemconfigmodel-min_deposit_money", "name": "SystemConfigModel[min_deposit_money]", "attribute": "min_deposit_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字。"}}},{"id": "systemconfigmodel-alipay_procedures_money", "name": "SystemConfigModel[alipay_procedures_money]", "attribute": "alipay_procedures_money", "rules": {"string":true,"messages":{"string":"支付宝手续费必须是一条字符串。"}}},{"id": "systemconfigmodel-alipay_procedures_money", "name": "SystemConfigModel[alipay_procedures_money]", "attribute": "alipay_procedures_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"支付宝手续费必须是一个数字。","min":"支付宝手续费必须不小于0。"},"min":0}},{"id": "systemconfigmodel-alipay_procedures_money", "name": "SystemConfigModel[alipay_procedures_money]", "attribute": "alipay_procedures_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字。"}}},{"id": "systemconfigmodel-bank_procedures_money", "name": "SystemConfigModel[bank_procedures_money]", "attribute": "bank_procedures_money", "rules": {"string":true,"messages":{"string":"银行卡手续费必须是一条字符串。"}}},{"id": "systemconfigmodel-bank_procedures_money", "name": "SystemConfigModel[bank_procedures_money]", "attribute": "bank_procedures_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"银行卡手续费必须是一个数字。","min":"银行卡手续费必须不小于0。"},"min":0}},{"id": "systemconfigmodel-bank_procedures_money", "name": "SystemConfigModel[bank_procedures_money]", "attribute": "bank_procedures_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字。"}}},{"id": "systemconfigmodel-min_procedures_money", "name": "SystemConfigModel[min_procedures_money]", "attribute": "min_procedures_money", "rules": {"string":true,"messages":{"string":"最低手续费必须是一条字符串。"}}},{"id": "systemconfigmodel-min_procedures_money", "name": "SystemConfigModel[min_procedures_money]", "attribute": "min_procedures_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"最低手续费必须是一个数字。","min":"最低手续费必须不小于0。"},"min":0}},{"id": "systemconfigmodel-min_procedures_money", "name": "SystemConfigModel[min_procedures_money]", "attribute": "min_procedures_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字。"}}},]
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

                $.loading.start();
                $("#SystemConfigModel").submit();
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop