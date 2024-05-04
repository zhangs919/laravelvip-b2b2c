<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title }}</title>
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="flexible" content="initial-dpr=2,maximum-dpr=3" />
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="wap-font-scale" content="no">
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />

    <link rel="stylesheet" href="/css/common.css?v=20180702"/>
    <link rel="stylesheet" href="/css/login.css?v=20180702"/>
    <link rel="stylesheet" href="/css/bonus_message.css?v=20180702"/>
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/placeholder.js?v=20180813"></script>
    <script src="/js/login.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/js/common.js?v=20180813"></script>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif
</head>
<body>
<!-- 红包消息 -->


<div class="reg-content"><header id="header" class="header">
        <div class="header-left">
            <a href="javascript:history.back(-1)" class="sb-back">
				<i class="iconfont">&#xe606;</i>
			</a>
        </div>
        <div class="header-middle">邮箱注册</div>
        <div class="header-right">
            <a href="/login.html" class="text">登录</a>
        </div>
    </header>
    <div class="reg-form">
        <div class="reg-con">
            <div class="reg-wrap">
                <div class="reg-wrap-con middle-content">

                    <div class="login-radio">
                        <label id="menu1" onclick="javascript:window.location.href='/register/mobile.html'">
                            <input type="radio" value="0" name="register" />
                            <span>手机注册</span>
                        </label>
                        <label id="menu2" onclick="">
                            <input type="radio" value="1" name="register" checked />
                            <span>邮箱注册</span>
                        </label>
                    </div>

                    <!-- 邮箱注册 star -->
                    <form id="EmailRegisterModel" class="form-horizontal" name="EmailRegisterModel" action="/register/email.html" method="post">
                        @csrf
                        <!-- 邮箱 -->
                        <div class="form-group form-group-spe" >
                            <dl>
                                <dt>
                                    <span>邮箱：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">


                                        <input type="text" id="emailregistermodel-email" class="form-control" name="EmailRegisterModel[email]">


                                    </div>

                                </dd>
                            </dl>
                        </div>
                        <div class="invalid"></div>
                        <!-- 密码 -->
                        <div class="form-group form-group-spe" >
                            <dl>
                                <dt>
                                    <span>密码：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">


                                        <input type="password" id="password" class="form-control" name="EmailRegisterModel[password]" value="" autocomplete="off">
                                        <i class="fa fa-eye-slash pwd-toggle" data-id="password"></i>


                                    </div>

                                </dd>
                            </dl>
                        </div>
                        <div class="invalid"></div>
                        <!-- 验证码 -->
                        <div class="form-group form-group-spe" >
                            <dl>
                                <dt>
                                    <span>验证码：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">


                                        <input type="text" id="captcha" class="input-small" name="EmailRegisterModel[captcha]">
                                        <label class="captcha">

                                            <img id="captcha-image" class="captcha-image" name="EmailRegisterModel[captcha]" src="/site/captcha.html?v=5b77ec0ec4073" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                                        </label>

                                    </div>

                                </dd>
                            </dl>
                        </div>
                        <div class="invalid"></div>
                        <!-- 邮箱校验码 -->
                        <div class="form-group form-group-spe" >
                            <dl>
                                <dt>
                                    <span>邮箱校验码：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">


                                        <input type="text" id="emailregistermodel-email_captcha" class="input-small" name="EmailRegisterModel[email_captcha]">

                                        <a href="javascript:void(0);" class="phonecode">获取邮箱校验码</a>

                                    </div>

                                </dd>
                            </dl>
                        </div>
                        <div class="invalid"></div>
                        <div class="agree-deal">
                            <!--协议选中状态 checked-->
                            <input type="checkbox" value="0" name="remember" id="remember1" class="agree-checkbox checked" checked="checked">
                            <span>
                        我已阅读并同意
                        <a href="javascript:void(0);" class="user_protocol">《用户注册协议》</a>
                    </span>
                        </div>
                        <div class="submit-btn">
                            <a class="btn-submit" id="btn_submit" href="javascript:void(0)">同意协议并注册</a>
                        </div>
                    </form>
                    <!-- 手机注册 end -->
                </div>
            </div>
        </div>
    </div>
    <!-- 验证码脚本 -->
    <script src="/assets/d2eace91/js/jquery.captcha.js?v=20180813"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180813"></script>

    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "emailregistermodel-email", "name": "EmailRegisterModel[email]", "attribute": "email", "rules": {"required":true,"messages":{"required":"邮箱不能为空。"}}},{"id": "emailregistermodel-password", "name": "EmailRegisterModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"密码不能为空。"}}},{"id": "emailregistermodel-email_captcha", "name": "EmailRegisterModel[email_captcha]", "attribute": "email_captcha", "rules": {"required":true,"messages":{"required":"邮箱校验码不能为空。"}}},{"id": "emailregistermodel-email", "name": "EmailRegisterModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱不是有效的邮箱地址。"}}},{"id": "emailregistermodel-email", "name": "EmailRegisterModel[email]", "attribute": "email", "rules": {"ajax":{"url":"/register/client-validate","model":"c2VydmljZVxyZWdpc3Rlclxtb2RlbHNcRW1haWxSZWdpc3Rlck1vZGVs","attribute":"email","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已被注册。"}}},{"id": "emailregistermodel-password", "name": "EmailRegisterModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"密码不能包含空格。"}}},{"id": "emailregistermodel-captcha", "name": "EmailRegisterModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"验证码不能为空。"}}},{"id": "emailregistermodel-captcha", "name": "EmailRegisterModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":428,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
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
    </script>
</div>
<!-- 用户协议 -->
<div id="user_protocol">
    <div class="user-protocol-con">
        <header>
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:void(0)">
						<i class="iconfont">&#xe606;</i>
					</a>
                </div>
                <div class="header-middle">用户注册协议</div>
                <div class="header-right"></div>
            </div>
        </header>
        <div class="protocol">
            <div class="protocol-con">
                {!! sysconf('user_protocol') !!}
            </div>
        </div>
    </div>
</div>
<!-- 底部 -->
<script type="text/javascript">
    $().ready(function() {
        $(".user_protocol").click(function() {
            $('#user_protocol').addClass('show');
        });
        $('.header-left').click(function() {
            $('#user_protocol').removeClass('show');
        });
    });
</script>
<!-- 第三方流量统计 -->
<div style="display: none;">
    {{--第三方统计代码--}}
    {!! sysconf('stats_code_wap') !!}
</div>
<!-- 底部 _end-->
</body>
</html>
