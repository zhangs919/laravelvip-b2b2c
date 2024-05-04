@if($service_type == 'edit_mobile')
    <div class="stepflex">
        <dl id="dl_1" class="first doing">
            <dt class="s-num">1</dt>
            <dd class="s-text">
                验证身份
                <s></s>
                <b></b>
            </dd>
        </dl>
        <dl id="dl_2" class="normal">
            <dt class="s-num">2</dt>
            <dd class="s-text">
                绑定验证手机号码
                <s></s>
                <b></b>
            </dd>
        </dl>
        <dl id="dl_3" class="last">
            <dt class="s-num">3</dt>
            <dd class="s-text">
                完成
                <s></s>
                <b></b>
            </dd>
        </dl>
    </div>
@elseif($service_type == 'edit_email')
    <div class="stepflex">
        <dl id="dl_1" class="first doing">
            <dt class="s-num">1</dt>
            <dd class="s-text">
                验证身份
                <s></s>
                <b></b>
            </dd>
        </dl>
        <dl id="dl_2" class="normal">
            <dt class="s-num">2</dt>
            <dd class="s-text">
                绑定验证邮箱地址
                <s></s>
                <b></b>
            </dd>
        </dl>
        <dl id="dl_3" class="last">
            <dt class="s-num">3</dt>
            <dd class="s-text">
                完成
                <s></s>
                <b></b>
            </dd>
        </dl>
    </div>
@elseif($service_type == 'edit_password')
<div class="stepflex">
    <dl id="dl_1" class="first doing">
        <dt class="s-num">1</dt>
        <dd class="s-text">
            验证身份
            <s></s>
            <b></b>
        </dd>
    </dl>
    <dl id="dl_2" class="normal">
        <dt class="s-num">2</dt>
        <dd class="s-text">
            设置登录密码
            <s></s>
            <b></b>
        </dd>
    </dl>
    <dl id="dl_3" class="last">
        <dt class="s-num">3</dt>
        <dd class="s-text">
            完成
            <s></s>
            <b></b>
        </dd>
    </dl>
</div>
@elseif($service_type == 'edit_surplus_password')
    <div class="stepflex">
        <dl id="dl_1" class="first doing">
            <dt class="s-num">1</dt>
            <dd class="s-text">
                验证身份
                <s></s>
                <b></b>
            </dd>
        </dl>
        <dl id="dl_2" class="normal">
            <dt class="s-num">2</dt>
            <dd class="s-text">
                设置余额支付密码
                <s></s>
                <b></b>
            </dd>
        </dl>
        <dl id="dl_3" class="last">
            <dt class="s-num">3</dt>
            <dd class="s-text">
                完成
                <s></s>
                <b></b>
            </dd>
        </dl>
    </div>
@elseif($service_type == 'close_surplus_password')
    <div class="stepflex stepflex-spe">
        <dl id="dl_1" class="first doing">
            <dt class="s-num">1</dt>
            <dd class="s-text">
                验证身份
                <s></s>
                <b></b>
            </dd>
        </dl>
        <dl id="dl_2" class="last">
            <dt class="s-num">2</dt>
            <dd class="s-text">
                完成
                <s></s>
                <b></b>
            </dd>
        </dl>
    </div>
@endif

<form id="ValidateModel" class="form-horizontal" name="ValidateModel" action="{{ request()->getPathInfo() }}" method="post">
    @csrf
    <div class="form-group form-group-spe">
        <label for="validatemodel-type" class="input-left">
            <span class="spark">*</span>
            <span>请选择验证身份方式：</span>
        </label>
        <div class="form-control-box">
            <span class="select">
            <select id="type" class="form-control" name="ValidateModel[type]">
            <option value="password" @if($type == 'password'){{ 'selected' }}@endif>登录密码验证</option>
            <option value="mobile" @if($type == 'mobile'){{ 'selected' }}@endif>手机验证</option>
            </select>
            </span>
        </div>
        <div class="invalid"></div>
    </div>
    @if($type == 'password')
    <!-- 密码验证 -->
        <div class="form-group form-group-spe">
            <label class="input-left">
                <span>用户名：</span>
            </label>
            <span class="input-none">{{ $user_info->user_name }}</span>
        </div>
        <div class="form-group form-group-spe">
            <label for="validatemodel-password" class="input-left">
                <span class="spark">*</span>
                <span>登录密码：</span>
            </label>
            <div class="form-control-box">
                <input type="password" id="pwd-input" class="form-control"
                       name="ValidateModel[password]" autocomplete="off">
                <i class="fa fa-eye-slash pwd-toggle" data-id="pwd-input"></i>
            </div>
            <div class="invalid"></div>
        </div>
        <div class="form-group form-group-spe" style="display: none;">
            <label for="validatemodel-captcha" class="input-left">
                <span class="spark">*</span>
                <span>图片验证码：</span>
            </label>
            <div class="form-control-box">
                <input type="text" id="captcha" class="input-small" name="ValidateModel[captcha]" disabled>
                <label class="captcha">
                    <img id="captcha-image" class="captcha-image" name="ValidateModel[captcha]"
                         src="/site/captcha.html?v=5e0208a0a43fb" alt="点击换图" title="点击换图"
                         style="vertical-align: middle; cursor: pointer;">
                    <script data-captcha-id="captcha-image" type="text">
                                            {"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}

                    </script>
                </label>
            </div>
            <div class="invalid"></div>
        </div>
    @else
    <!-- 手机验证 -->
        <div class="form-group form-group-spe">
            <label class="input-left">
                <span>已验证手机：</span>
            </label>
            <span class="input-none">{{ hide_tel($user_info->mobile) }}</span>
            <input type="hidden" id="validatemodel-mobile" class="form-control" name="ValidateModel[mobile]" value="{{ $user_info->mobile }}">
        </div>
        <div class="form-group form-group-spe" style="display: none;">
            <label for="validatemodel-captcha" class="input-left">
                <span class="spark">*</span>
                <span>图片验证码：</span>
            </label>
            <div class="form-control-box">
                <input type="text" id="captcha" class="input-small" name="ValidateModel[captcha]" disabled>
                <label class="captcha">
                    <img id="captcha-image" class="captcha-image" name="ValidateModel[captcha]" src="/site/captcha.html?v=5e020d4e2d359" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                </label>
            </div>
            <div class="invalid"></div>
        </div>
        <!-- 短信验证码 -->
        <div class="form-group form-group-spe" >
            <label for="validatemodel-sms_captcha" class="input-left">
                <span class="spark">*</span>
                <span>手机验证码：</span>
            </label>
            <div class="form-control-box">
                <input type="text" id="sms_captcha" class="input-small" name="ValidateModel[sms_captcha]" tabindex="3" placeholder="动态验证码">
                <a id="btn_send_sms_code" href="javascript:void(0);" class="phonecode">获取短信校验码</a>
            </div>
            <div class="invalid"></div>
        </div>
    @endif
    <div class="act">
        <input type="button" id="btn_validate" value="下一步">
    </div>
</form>
<div class="operat-tips">
    <h4>为什么要进行身份验证?</h4>
    <ul class="operat-panel">
        <li>
            <span>为保障您的账户信息安全，在变更账户中的重要信息时需要进行身份验证，感谢您的理解和支持；</span>
        </li>
        <li>
            <span>验证身份遇到问题？请联系客服人员，客服将协助您处理。</span>
        </li>
    </ul>
</div>
<!-- 表单验证 -->
<script id="client_rules" type="text/javascript">
    //password
    @if($type == 'password')
    [{"id": "validatemodel-type", "name": "ValidateModel[type]", "attribute": "type", "rules": {"required":true,"messages":{"required":"请选择验证身份方式不能为空。"}}},{"id": "validatemodel-captcha", "name": "ValidateModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"图片验证码不能为空。"}}},{"id": "validatemodel-captcha", "name": "ValidateModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":441,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},{"id": "validatemodel-password", "name": "ValidateModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"登录密码不能为空。"}}},]
    @elseif($type == 'mobile')
    //mobile
    [{"id": "validatemodel-type", "name": "ValidateModel[type]", "attribute": "type", "rules": {"required":true,"messages":{"required":"请选择验证身份方式不能为空。"}}},{"id": "validatemodel-captcha", "name": "ValidateModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"图片验证码不能为空。"}}},{"id": "validatemodel-captcha", "name": "ValidateModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":418,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},{"id": "validatemodel-mobile", "name": "ValidateModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"已验证手机不能为空。"}}},{"id": "validatemodel-sms_captcha", "name": "ValidateModel[sms_captcha]", "attribute": "sms_captcha", "rules": {"required":true,"messages":{"required":"手机验证码不能为空。"}}},]
    @endif
</script>
<script type="text/javascript">
    //
</script>
<script src="/assets/d2eace91/min/js/validate.min.js"></script>
<script>
    $().ready(function () {
        var validator = $("#ValidateModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#ValidateModel").submit(function () {
            return true;
        });
        $("#btn_validate").click(function () {
            if (!validator.form()) {
                return false;
            }
            var data = $("#ValidateModel").serializeJson();
            $.loading.start();
            $.post('/user/security/validate.html', data, function (result) {
                if (result.code == 0) {
                    $("#safe-info").html(result.data);
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function () {
                $.loading.stop();
            });
        });
        $("#btn_send_sms_code").click(function () {
            if ($(this).prop("disabled") == true || $(this).data("doing") == true) {
                return;
            }
            var captcha_valid = true;
            if ($("#captcha").is(":visible") && $("#captcha").size() > 0) {
                captcha_valid = $("#captcha").valid();
            }
            if (captcha_valid) {
                var target = this;
                $(this).data("doing", true);
                $.validator.clearError($("#sms_captcha"));
                $.loading.start();
                $.post('/user/security/sms-captcha.html', {
                    captcha: $("#captcha").val()
                }, function (result) {
                    if (result.code == 0) {
                        // 开始倒计时
                        countdown(target, "获取手机验证码");
                    } else {
                        var show_captcha = result.data && result.data.show_captcha ? true : false;
                        if (show_captcha) {
                            $("#captcha").parents(".form-group").show();
                            $("#captcha").focus();
                            $("#captcha-image").click();
                            $("#captcha").val("");
                            $("#captcha").prop("disabled", false);
                        }
                        if (result.data && result.data.field) {
                            var errors = {};
                            errors["ValidateModel[" + result.data.field + "]"] = result.message;
                            validator.showErrors(errors);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                    $(target).data("doing", false);
                }, "json").always(function () {
                    $.loading.stop();
                });
            } else {
                $("#captcha").focus();
            }
        });
        $("#btn_send_email_code").click(function () {
            if ($(this).prop("disabled") == true || $(this).data("doing") == true) {
                return;
            }
            var captcha_valid = true;
            if ($("#captcha").is(":visible") && $("#captcha").size() > 0) {
                captcha_valid = $("#captcha").valid();
            }
            if (captcha_valid) {
                var target = this;
                $(this).data("doing", true);
                $.validator.clearError($("#email_captcha"));
                $.loading.start();
                $.post('/user/security/email-captcha.html', {
                    captcha: $("#captcha").val()
                }, function (result) {
                    if (result.code == 0) {
                        // 开始倒计时
                        countdown(target, "获取邮箱验证码");
                    } else {
                        var show_captcha = result.data && result.data.show_captcha ? true : false;
                        if (show_captcha) {
                            $("#captcha").parents(".form-group").show();
                            $("#captcha").focus();
                            $("#captcha-image").click();
                            $("#captcha").val("");
                            $("#captcha").prop("disabled", false);
                        }
                        if (result.data && result.data.field) {
                            var errors = {};
                            errors["ValidateModel[" + result.data.field + "]"] = result.message;
                            validator.showErrors(errors);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                    $(target).data("doing", false);
                }, "json").always(function () {
                    $.loading.stop();
                });
            } else {
                $("#captcha").focus();
            }
        });
        var wait = 60;

        function countdown(obj, msg) {
            obj = $(obj);
            if (wait <= 0) {
                obj.prop("disabled", false);
                obj.html(msg);
                wait = 60;
            } else {
                if (msg == undefined || msg == null) {
                    msg = obj.html();
                }
                obj.prop("disabled", true);
                obj.html(wait + "秒后重新获取");
                wait--;
                setTimeout(function () {
                    countdown(obj, msg)
                }, 1000)
            }
        }
    });
    //
</script>