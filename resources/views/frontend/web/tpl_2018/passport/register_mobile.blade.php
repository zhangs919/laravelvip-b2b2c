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
                        <li class="active">
                            <a href="javascript:void(0);">手机注册</a>
                        </li>
                        <li>
                            <a href="/register/email.html">邮箱注册</a>
                        </li>
                    </ul>

                </div>

                <div class="reg-wrap">
                    <div class="reg-wrap-con" style="background: url({{ get_image_url(sysconf('register_bg_image')) }}) no-repeat right 70px;">

                        <!--<div class="login-radio">
                            <label id="menu1" onclick="">
                                <input type="radio" value="0" name="register" checked="checked" />
                                <span>手机注册</span>
                            </label>
                            <label id="menu2" onclick="javascript:$.go('/register/email.html')">
                                <input type="radio" value="1" name="register" />
                                <span>邮箱注册</span>
                            </label>
                        </div>-->

                        <!-- 手机注册 start -->
                        <form id="MobileRegisterModel" class="form-horizontal" name="MobileRegisterModel" action="/register.html" method="post">
                            {{ csrf_field() }}
                            <!-- 手机号 -->
                            <div class="form-group form-group-spe" >
                                <label for="mobileregistermodel-mobile" class="input-left">
                                    <span class="spark">*</span>
                                    <span>手机号：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="text" id="mobileregistermodel-mobile" class="form-control" name="MobileRegisterModel[mobile]" value="{{ old('mobile') }}">


                                </div>

                                <div class="invalid"></div>
                            </div>
                            <input style="display: none">
                            <!-- 密码 -->
                            <div class="form-group form-group-spe" >
                                <label for="mobileregistermodel-password" class="input-left">
                                    <span class="spark">*</span>
                                    <span>密码：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="password" id="password" class="form-control" name="MobileRegisterModel[password]" autocomplete="off">
                                    <i class="fa fa-eye-slash pwd-toggle" data-id="password"></i>


                                </div>

                                <div class="invalid"></div>
                            </div>
                            <!-- 验证码 -->
                            <div class="form-group form-group-spe" style="display: none;">
                                <label for="mobileregistermodel-captcha" class="input-left">
                                    <span class="spark">*</span>
                                    <span>验证码：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="text" id="captcha" class="input-small" name="MobileRegisterModel[captcha]" disabled maxlength="4">
                                    <label class="captcha">

                                        <img id="captcha-image" class="captcha-image" name="MobileRegisterModel[captcha]" src="/site/captcha.html?v={{ uniqid() }}" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;">
                                        <script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                                    </label>

                                </div>

                                <div class="invalid"></div>
                            </div>

                            <!-- 短信校验码 -->
                            <div class="form-group form-group-spe" >
                                <label for="mobileregistermodel-sms_captcha" class="input-left">
                                    <span class="spark">*</span>
                                    <span>短信校验码：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="text" id="mobileregistermodel-sms_captcha" class="input-small" name="MobileRegisterModel[sms_captcha]" value="{{ old('sms_captcha') }}">

                                    <a href="javascript:void(0);" class="phonecode">获取短信校验码</a>

                                </div>

                                <div class="invalid"></div>
                            </div>
                            <!-- 注册邀请码 -->

                            <div class="form-group form-group-spe" >
                                <label for="mobileregistermodel-invite_code" class="input-left">

                                    <span>注册邀请码：</span>
                                </label>
                                <div class="form-control-box">


                                    <input type="text" id="mobileregistermodel-invite_code" class="input-small" name="MobileRegisterModel[invite_code]" value="{{ old('invite_code') }}"><span style="margin-left: 10px;">（选填）</span>


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
            [
            {"id": "mobileregistermodel-mobile", "name": "MobileRegisterModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"手机号不能为空。"}}},
            {"id": "mobileregistermodel-password", "name": "MobileRegisterModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"密码不能为空。"}}},
            {"id": "mobileregistermodel-sms_captcha", "name": "MobileRegisterModel[sms_captcha]", "attribute": "sms_captcha", "rules": {"required":true,"messages":{"required":"短信校验码不能为空。"}}},
            {"id": "mobileregistermodel-mobile", "name": "MobileRegisterModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^(13[0-9]{1}[0-9]{8}|15[0-9]{1}[0-9]{8}|18[0-9]{1}[0-9]{8}|17[0-9]{1}[0-9]{8}|14[0-9]{1}[0-9]{8}|199[0-9]{8}|198[0-9]{8}|166[0-9]{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号是无效的。"}}},
            {"id": "mobileregistermodel-mobile", "name": "MobileRegisterModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/register/client-validate","model":"c2VydmljZVxyZWdpc3Rlclxtb2RlbHNcTW9iaWxlUmVnaXN0ZXJNb2RlbA==","attribute":"mobile","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已被注册。"}}},
            {"id": "mobileregistermodel-password", "name": "MobileRegisterModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"密码不能包含空格。"}}},
            {{--todo 图片验证码目前还不知道怎么做--}}
            {{--{"id": "mobileregistermodel-captcha", "name": "MobileRegisterModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":447,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},--}}
            ]
        </script>
        <script type="text/javascript">
            $().ready(function() {
                var validator = $("#MobileRegisterModel").validate();
                // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                $.validator.addRules($("#client_rules").html());
                $("#btn_submit").click(function() {
                    if (!validator.form()) {
                        return;
                    }

                    // 禁止再次点击
                    $(this).prop("disabled", true);

                    // 开始加载
                    $.loading.start();

                    $("#MobileRegisterModel").submit();

                    return false;
                });

                // 获取验证码链接点击事件
                $(".phonecode").click(function() {
                    if (!$("#mobileregistermodel-mobile").valid()) {
                        $("#mobileregistermodel-mobile").focus();
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

                    // 获取短信验证码
                    var target = this;

                    var mobile = $("#mobileregistermodel-mobile").val();
                    var captcha = $("#captcha").val();
                    $.post('/register/sms-captcha', {
                        mobile: mobile,
                        captcha: captcha
                    }, function(result) {
                        if (result.code == 0) {
                            // 开始倒计时
                            countdown(target, "获取短信验证码");
                        } else {
                            // 显示验证码
                            if (result.data && result.data.show_captcha == 1) {
                                $("#captcha").parents(".form-group").show();
                                $("#captcha").prop("disabled", false);
                            }
                            if (result.code == 1) {
                                // 图形验证码错误
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
