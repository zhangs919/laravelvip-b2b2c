<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ sysconf('site_name') }} - 注册</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/frontend/css/common.css?v=20180428"/>
    <link rel="stylesheet" href="/frontend/css/register.css?v=20180428"/>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/frontend/css/custom/site-color-style-0.css?v=1.6"/>
    @else
        <link rel="stylesheet" href="/frontend/css/color-style.css?v=1.6"/>
    @endif
    <!--整站改色 _end-->
    <script src="/assets/d2eace91/js/jquery.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/placeholder.js?v=20180528"></script>
    <script src="/frontend/js/login.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/common.js?v=20180528"></script>
</head>
<body>
{{--post 提交 错误提示信息--}}
{{--{{ dd($errors) }}--}}
@if(is_object($errors) && count($errors->all()) > 0)
    <script>
        var msg = '@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach';
        layer.msg(msg);
    </script>
@elseif(is_array($errors) && !empty($errors))
    <script>
        var msg = '@foreach ($errors as $error)<p>{{ $error }}</p>@endforeach';
        layer.msg(msg);
    </script>
@elseif(is_string($errors))
    <script>
        var msg = '<p>{{ $errors }}</p>';
        layer.msg(msg);
    </script>
@endif

<!-- 红包消息 -->


<div class="header w990">
    <div class="logo-info">
        <a href="/" class="logo">
            <img alt="" src="{{ get_image_url(sysconf('mall_logo')) }}" />
        </a>
        <span class="findpw">欢迎注册</span>
    </div>
</div>
<div class="reg-content">
    <div class="w990">
        <div class="reg-form">
            <div class="reg-con">

                <div class="reg-type">
                    <p class="login-info">
                        我已经注册，现在就
                        <a href="/login.html" title="去登录" class="color">登录</a>
                    </p>

                    <ul class="clearfix">
                        <li>
                            <a href="/register/mobile.html">手机注册</a>
                        </li>
                        <li class="active">
                            <a href="javascript:void(0);">邮箱注册</a>
                        </li>
                    </ul>

                </div>

                <div class="reg-wrap">
                    <div class="reg-wrap-con" style="background: url({{ get_image_url(sysconf('register_bg_image')) }}) no-repeat right 70px;">

                        <!--<div class="login-radio">
                            <label id="menu1" onclick="javascript:$.go('/register/mobile.html')">
                                <input type="radio" value="0" name="register" />
                                <span>手机注册</span>
                            </label>
                            <label id="menu2" onclick="">
                                <input type="radio" value="1" name="register" checked />
                                <span>邮箱注册</span>
                            </label>
                        </div>-->

                        <!-- 邮箱注册 star -->
                        <form id="EmailRegisterModel" class="form-horizontal" name="EmailRegisterModel" action="/register/email.html" method="post">
                            {{ csrf_field() }}
                            <!-- 邮箱 -->
                            <div class="form-group form-group-spe" >
                                <label for="emailregistermodel-email" class="input-left">
                                    <span class="spark">*</span>
                                    <span>邮箱：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="text" id="emailregistermodel-email" class="form-control" name="EmailRegisterModel[email]">


                                </div>

                                <div class="invalid"></div>
                            </div>
                            <input style="display: none">
                            <!-- 密码 -->
                            <div class="form-group form-group-spe" >
                                <label for="emailregistermodel-password" class="input-left">
                                    <span class="spark">*</span>
                                    <span>密码：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="password" id="password" class="form-control" name="EmailRegisterModel[password]" autocomplete="off">
                                    <i class="fa fa-eye-slash pwd-toggle" data-id="password"></i>


                                </div>

                                <div class="invalid"></div>
                            </div>
                            <!-- 验证码 -->
                            <div class="form-group form-group-spe" style="display: none;">
                                <label for="emailregistermodel-captcha" class="input-left">

                                    <span>验证码：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="text" id="captcha" class="input-small" name="EmailRegisterModel[captcha]" disabled maxlength="4">
                                    <label class="captcha">

                                        <img id="captcha-image" class="captcha-image" name="EmailRegisterModel[captcha]" src="/site/captcha.html?v={{ uniqid() }}" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                                    </label>

                                </div>

                                <div class="invalid"></div>
                            </div>
                            <!-- 邮箱校验码 -->
                            <div class="form-group form-group-spe" >
                                <label for="emailregistermodel-email_captcha" class="input-left">
                                    <span class="spark">*</span>
                                    <span>邮箱校验码：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="text" id="emailregistermodel-email_captcha" class="input-small" name="EmailRegisterModel[email_captcha]">

                                    <a href="javascript:void(0);" class="phonecode">获取邮箱校验码</a>

                                </div>

                                <div class="invalid"></div>
                            </div>
                            <!-- 注册邀请码 -->

                            <div class="form-group form-group-spe" >
                                <label for="emailregistermodel-invite_code" class="input-left">

                                    <span>注册邀请码：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="text" id="emailregistermodel-invite_code" class="input-small" name="EmailRegisterModel[invite_code]"><span style="margin-left: 10px;">（选填）</span>


                                </div>

                                <div class="invalid"></div>
                            </div>

                            <div class="form-group m-10">
                                <label class="input-left">&nbsp;</label>
                                <div class="form-control-box">
                                    <label for="remember1">
                                        <input type="checkbox" value="0" name="remember" id="remember1" class="checkbox" checked="checked" />
                                        <span>
								我已阅读并同意
								<a href="javascript:void(0);" class="user_protocol">《用户注册协议》</a>
							</span>
                                    </label>
                                </div>
                            </div>
                            <div class="reg-btn">
                                <div class="form-group form-group-spe" >
                                    <label for="" class="input-left">


                                    </label>
                                    <div class="form-control-box">

                                        <input type="button" class="btn-img btn-entry bg-color" id="btn_submit" name="btn_submit" value="同意协议并注册">

                                    </div>

                                    <div class="invalid"></div>
                                </div>
                            </div>
                        </form>
                        <!-- 手机注册 end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- 验证码脚本 -->
        <script src="/assets/d2eace91/js/jquery.captcha.js?v=20180528"></script>
        <!-- 表单验证 -->
        <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180528"></script>

        <!-- 验证规则 -->
        <script id="client_rules" type="text">
            [{"id": "emailregistermodel-email", "name": "EmailRegisterModel[email]", "attribute": "email", "rules": {"required":true,"messages":{"required":"邮箱不能为空。"}}},{"id": "emailregistermodel-password", "name": "EmailRegisterModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"密码不能为空。"}}},{"id": "emailregistermodel-email_captcha", "name": "EmailRegisterModel[email_captcha]", "attribute": "email_captcha", "rules": {"required":true,"messages":{"required":"邮箱校验码不能为空。"}}},{"id": "emailregistermodel-email", "name": "EmailRegisterModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱不是有效的邮箱地址。"}}},{"id": "emailregistermodel-email", "name": "EmailRegisterModel[email]", "attribute": "email", "rules": {"ajax":{"url":"/register/client-validate","model":"c2VydmljZVxyZWdpc3Rlclxtb2RlbHNcRW1haWxSZWdpc3Rlck1vZGVs","attribute":"email","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已被注册。"}}},{"id": "emailregistermodel-password", "name": "EmailRegisterModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"密码不能包含空格。"}}},{"id": "emailregistermodel-captcha", "name": "EmailRegisterModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"验证码不能为空。"}}},{"id": "emailregistermodel-captcha", "name": "EmailRegisterModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":420,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
        </script>
        <script type="text/javascript">
            $().ready(function() {
                var validator = $("#EmailRegisterModel").validate();
                // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                $.validator.addRules($("#client_rules").html());
                $("#btn_submit").click(function() {
                    if (!validator.form()) {
                        return;
                    }

                    // 禁止再次点击
                    $(this).prop("disabled", true);

                    var data = $("#EmailRegisterModel").serializeJson();
                    var url = $("#EmailRegisterModel").attr("action");

                    $.loading.start();

                    $("#EmailRegisterModel").submit();

                    return false;
                });

                // 获取验证码链接点击事件
                $(".phonecode").click(function() {
                    if (!$("#emailregistermodel-email").valid()) {
                        $("#emailregistermodel-email").focus();
                        return;
                    }
                    if (!$("#password").valid()) {
                        $("#password").focus();
                        return;
                    }
                    if ($("#captcha").is(":visible") && !$("#captcha").valid()) {
                        $("#captcha").focus();
                        return;
                    }
                    if ($(this).prop("disabled") == true || $(this).data("doing") == true) {
                        return;
                    }
                    if ($(this).data("doing")) {
                        return;
                    }
                    $(this).data("doing", true);

                    // 获取邮箱验证码
                    var target = this;

                    var email = $("#emailregistermodel-email").val();
                    var captcha = $("#captcha").val();
                    $.post('/register/email-captcha', {
                        email: email,
                        captcha: captcha
                    }, function(result) {
                        if (result.code == 0) {
                            // 开始倒计时
                            countdown(target, "获取邮箱验证码");
                        } else {
                            // 显示验证码
                            if (result.data && result.data.show_captcha == 1) {
                                $("#captcha").parents(".form-group").show();
                                $("#captcha").prop("disabled", false);
                            }
                            if (result.code == 1) {
                                // 验证码不正确或者已过期
                                $.validator.showError($("#captcha"), result.message);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                            // 失败后点击验证码
                            if ($("#captcha-image").size() > 0) {
                                $("#captcha").val("");
                                $("#captcha-image").click();
                            }
                        }
                        $(target).data("doing", false);
                    }, "json");
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
                        setTimeout(function() {
                            countdown(obj, msg)
                        }, 1000)
                    }
                }
            });
        </script>
        <script type="text/javascript">
            $(function() {
                $("input[type='checkbox']").click(function() {
                    if ($(this).is(":checked")) {
                        $("#btn_submit").removeAttr("disabled");
                    } else {
                        $("#btn_submit").attr("disabled", true);
                    }
                });
            });
        </script></div>
</div>
<!-- 用户协议 -->
<div id="user_protocol" style="display: none;">
    <div class="protocol">
        <div class="protocol-con">
            {!! sysconf('user_protocol') !!}
        </div>
    </div>
</div>
<!-- 底部 -->

{{-- include common footer --}}
@include('layouts.partials.short_footer')


</body>
<script type="text/javascript">
    $().ready(function() {
        $(".user_protocol").click(function() {
            if ($.modal($(this))) {
                $.modal($(this)).show();
            } else {
                var modal = $.modal({
                    title: "用户注册协议",
                    trigger: $(this),
                    content: $("#user_protocol").html()
                });
                modal.addButton({
                    text: "同意协议并继续",
                    click: function() {
                        $("input[type='checkbox']").prop("checked", true);
                        $("#btn_submit").removeAttr("disabled");
                        this.hide();
                    }
                });
            }
        });
    });
</script>
</html>
