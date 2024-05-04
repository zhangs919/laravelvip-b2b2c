
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <meta name="is_frontend" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!--整站改色 _start-->
    <!--整站改色 _end-->
    <link href="/assets/d2eace91/iconfont/iconfont.css?v=20201012" rel="stylesheet">
    <link href="/css/common.css?v=20201012" rel="stylesheet">
    <link href="/css/register.css?v=20201012" rel="stylesheet">
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <script src="/assets/d2eace91/js/jquery.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=20201016"></script>

    <!-- 加载Layer插件 -->
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script><link rel="stylesheet" href="/assets/d2eace91/js/layer/skin/default/layer.css?v=3.1.0" id="layuicss-layer">

</head>
<body>
@if(!empty(session('layerMsg')))
    <script>
        var status = '{{ session()->get('layerMsg.status') }}';
        var msg = '{{ session()->get('layerMsg.msg') }}';

        switch (status) {
            case 'success':
                layer.msg(msg);
                break;
            case 'error':
                layer.msg(msg, function () {
                    // 关闭后的操作
                });
                break;
            case 'info':
                layer.msg(msg)
                break;
            case 'warning':
                layer.msg(msg, function () {
                    // 关闭后的操作
                });
                break;
        }
    </script>
@endif

<div class="header w990">
    <div class="logo-info">
        <a href="/" class="logo">
            <img alt="" src="{{ get_image_url(sysconf('mall_logo')) }}" />
        </a>
        <span class="findpw">帐号绑定</span>
    </div>
</div>
<div class="reg-content">
    <div class="w990">
        <div class="reg-form">
            <div class="reg-con">
                <div class="reg-type">
                    <ul class="clearfix">
                        <li class="">
                            <a href="/bind">已有账号，请绑定</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">没有账号，请注册</a>
                        </li>
                    </ul>
                </div>
                <div class="reg-wrap">
                    <div class="reg-wrap-con" id="con_register_2" style="background: url(/images/register-bg.jpg) no-repeat right 70px;">
                        <div class="wellcome-tip">
                            <img src="{{ $third_login_info['avatar_url'] }}" width="28" height="28" />
                            Hi, {{ $third_login_info['name'] }} 欢迎来到商城！
                        </div>
                        <div class="login-radio">
                            <label id="login1" onclick="javascript:$.go('/bind/bind/mobile')">
                                <input type="radio" value="" name="register" />
                                <span>手机注册</span>
                            </label>
                            <label id="login2">
                                <input type="radio" value="" name="register" checked />
                                <span>邮箱注册</span>
                            </label>
                        </div>
                        <!-- 邮箱注册 star -->
                        <form id="EmailRegisterModel" class="form-horizontal" name="EmailRegisterModel" action="/bind/bind/email.html" method="post">
                            @csrf
                            <div class="form-group form-group-spe" >
                                <label for="emailregistermodel-email" class="input-left">
                                    <span class="spark">*</span>
                                    <span>邮箱：</span>
                                </label>
                                <div class="form-control-box">
                                    <input type="text" id="emailregistermodel-email" class="form-control" name="EmailRegisterModel[email]">
                                </div>
                                <div class="invalid"></div>
                            </div>                <!-- 密码 -->
                            <div class="form-group form-group-spe" >
                                <label for="emailregistermodel-password" class="input-left">
                                    <span class="spark">*</span>
                                    <span>密码：</span>
                                </label>
                                <div class="form-control-box">
                                    <input type="password" id="password" class="form-control" name="EmailRegisterModel[password]" value="" autocomplete="off">
                                    <i class="fa fa-eye-slash pwd-toggle" data-id="password"></i>
                                </div>
                                <div class="invalid"></div>
                            </div>                <!-- 验证码 -->
                            <div class="form-group form-group-spe" >
                                <label for="emailregistermodel-captcha" class="input-left">
                                    <span>验证码：</span>
                                </label>
                                <div class="form-control-box">
                                    <input type="text" id="captcha" class="input-small" name="EmailRegisterModel[captcha]">
                                    <label class="captcha">
                                        <img id="captcha-image" class="captcha-image" name="EmailRegisterModel[captcha]" src="/site/captcha.html?v=5fa55019deca7" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                                    </label>
                                </div>
                                <div class="invalid"></div>
                            </div>                <!-- 邮箱校验码 -->
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
                            </div>                <div class="form-group m-10">
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
                                        <input type="button" class="btn-img btn-entry bg-color" id="btn_submit" name="btn_submit" value="同意协议注册并绑定">
                                    </div>
                                    <div class="invalid"></div>
                                </div>
                            </div>
                        </form>
                        <!-- 邮箱注册 end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- 验证码脚本 -->
        <!-- 表单验证 -->
        <!-- 验证规则 -->
        <script id="client_rules" type="text">
[{"id": "emailregistermodel-email", "name": "EmailRegisterModel[email]", "attribute": "email", "rules": {"required":true,"messages":{"required":"邮箱不能为空。"}}},{"id": "emailregistermodel-password", "name": "EmailRegisterModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"密码不能为空。"}}},{"id": "emailregistermodel-email_captcha", "name": "EmailRegisterModel[email_captcha]", "attribute": "email_captcha", "rules": {"required":true,"messages":{"required":"邮箱校验码不能为空。"}}},{"id": "emailregistermodel-email", "name": "EmailRegisterModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱不是有效的邮箱地址。"}}},{"id": "emailregistermodel-email", "name": "EmailRegisterModel[email]", "attribute": "email", "rules": {"ajax":{"url":"/register/client-validate","model":"c2VydmljZVxyZWdpc3Rlclxtb2RlbHNcRW1haWxSZWdpc3Rlck1vZGVs","attribute":"email","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已被注册。"}}},{"id": "emailregistermodel-password", "name": "EmailRegisterModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"密码不能包含空格。"}}},{"id": "emailregistermodel-captcha", "name": "EmailRegisterModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"验证码不能为空。"}}},{"id": "emailregistermodel-captcha", "name": "EmailRegisterModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":427,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
</script>
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
    </div>
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

<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<script src="/assets/d2eace91/min/js/core.min.js?v=20201016"></script>
<script src="/js/common.js?v=20201016"></script>
<script src="/js/jquery.fly.min.js?v=20201016"></script>
<script src="/js/placeholder.js?v=20201016"></script>
<script src="/js/login.js?v=20201016"></script>
<script src="/assets/d2eace91/js/jquery.captcha.js?v=20201016"></script>
<script src="/assets/d2eace91/min/js/validate.min.js?v=20201016"></script>
<script>
    $().ready(function() {
        var validator = $("#EmailRegisterModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
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
            if (!$("#captcha").valid()) {
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
                    if (result.code == 1) {
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
    //
    $(function() {
        $("input[type='checkbox']").click(function() {
            if ($(this).is(":checked")) {
                $("#btn_submit").removeAttr("disabled");
            } else {
                $("#btn_submit").attr("disabled", true);
            }
        });
    });
    //
    $().ready(function() {
        $('.site_to_yikf').click(function() {
            $(this).parent('form').submit();
        })
    });
    //
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
                        this.hide();
                    }
                });
            }
        });
    });
    //
</script>
</body>
</html>
