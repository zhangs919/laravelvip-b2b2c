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

    <link rel="stylesheet" href="/mobile/css/common.css?v=20180702"/>
    <link rel="stylesheet" href="/mobile/css/login.css?v=20180702"/>
    <link rel="stylesheet" href="/mobile/css/bonus_message.css?v=20180702"/>
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/placeholder.js?v=20180813"></script>
    <script src="/mobile/js/login.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/mobile/js/common.js?v=20180813"></script>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/mobile/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/mobile/css/color-style.css?v=1.2" id="site_style"/>
    @endif
</head>
<body>
<!-- 红包消息 -->


<div class="reg-content"><header id="header" class="header">
        <div class="header-left">
            <a href="javascript:history.back(-1)" class="sb-back"></a>
        </div>
        <div class="header-middle">手机快速注册</div>
        <div class="header-right">
            <a href="/login.html" class="text">登录</a>
        </div>
    </header>
    <form id="MobileRegisterModel" class="form-horizontal" name="MobileRegisterModel" action="/register.html" method="post">
        {{ csrf_field() }}
        <!-- 第一步 -->
        <div class="middle-content hide" id="step_1">
            <span class="tip-text m-l-3">手机号即为登录账号，我们将发送验证短信到该号码</span>
            <div class="form-group-box">
                <div class="form-group form-group-spe" >
                    <dl>
                        <dt>
                            <span>手机号：</span>
                        </dt>
                        <dd>
                            <div class="form-control-box">


                                <input type="number" id="mobileregistermodel-mobile" class="form-control" name="MobileRegisterModel[mobile]" placeholder="请输入手机号码" pattern="[0-9]*">


                            </div>

                        </dd>
                    </dl>
                </div>
                <div class="invalid"></div>
            </div>
            <div class="agree-deal">
                <!--协议选中状态 checked-->
                <input type="checkbox" value="0" name="remember" id="remember1" class="agree-checkbox checked" checked="checked">
                <span>
			我已阅读并同意
			<a href="javascript:void(0);" class="user_protocol">《用户注册协议》</a>
		</span>
            </div>
            <div class="submit-btn">
                <!-- class添加disable样式 判断按钮是否可点击 -->
                <a class="btn-submit disable" id="step_btn_1" href="javascript:void(0)">下一步</a>
            </div>
        </div>
        <!-- 第二步 -->
        <!-- 验证码 -->
        <div class="mask-div"></div>
        <div class="hide middle-content register-content" id="step_2">
            <span class="tip-text m-l-3">请输入手机收到的验证码</span>
            <div class="form-group-box">
                <!-- 短信校验码 -->
                <div class="form-group form-group-spe" >
                    <dl>
                        <dt>
                            <span>短信校验码：</span>
                        </dt>
                        <dd>
                            <div class="form-control-box">


                                <input type="number" id="mobileregistermodel-sms_captcha" class="numcode" name="MobileRegisterModel[sms_captcha]" pattern="[0-9]*">

                                <a href="javascript:void(0);" class="phonecode">获取验证码</a>

                            </div>

                        </dd>
                    </dl>
                </div>
                <div class="invalid"></div>
            </div>
            <div class="submit-btn">
                <a class="disable btn-submit" id="step_btn_2" href="javascript:void(0)">下一步</a>
            </div>
        </div>
        <!-- 第三步 -->
        <div class="hide middle-content" id="step_3">
            <span class="tip-text m-l-3">请设置登录密码</span>
            <div class="form-group-box">
                <div class="form-group form-group-spe">
                    <dl>
                        <dt>
                            <span>设置密码：</span>
                        </dt>
                        <dd>
                            <div class="form-control-box"><input type="password" id="mobileregistermodel-password" class="form-control" name="MobileRegisterModel[password]" placeholder="设置密码"></div>

                        </dd>
                    </dl>
                </div>
            </div>

            <div class="submit-btn">
                <a class="disable btn-submit" id="step_btn_3" href="javascript:void(0)">完成</a>
            </div>
        </div>
    </form>
    <!-- 验证码脚本 -->
    <script src="/assets/d2eace91/js/jquery.captcha.js?v=20180813"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180813"></script>
    <script id="client_rules" type="text">
[{"id": "mobileregistermodel-mobile", "name": "MobileRegisterModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"手机号不能为空。"}}},{"id": "mobileregistermodel-password", "name": "MobileRegisterModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"密码不能为空。"}}},{"id": "mobileregistermodel-sms_captcha", "name": "MobileRegisterModel[sms_captcha]", "attribute": "sms_captcha", "rules": {"required":true,"messages":{"required":"短信校验码不能为空。"}}},{"id": "mobileregistermodel-mobile", "name": "MobileRegisterModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号是无效的。"}}},{"id": "mobileregistermodel-mobile", "name": "MobileRegisterModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/register/client-validate","model":"c2VydmljZVxyZWdpc3Rlclxtb2RlbHNcTW9iaWxlUmVnaXN0ZXJNb2RlbA==","attribute":"mobile","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已被注册。"}}},{"id": "mobileregistermodel-password", "name": "MobileRegisterModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"密码不能包含空格。"}}},{"id": "mobileregistermodel-captcha", "name": "MobileRegisterModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":448,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
</script>

    <script type="text/javascript">
        $.each($(".middle-content"), function(index, value) {
            if ($(this).find('.form-control-error').length > 0) {
                $(this).show();
                $('#mobileregistermodel-password').val('');
                return false;
            }
            if (index + 1 == $(".middle-content").length) {
                $("#step_1").show();
            }
        });
    </script>
    <script type="text/javascript">
        function mobile_info() {
            $("#mobile_info").show();
            $(".mask-div").show();
            $("body").css({
                overflow: "hidden"
            }); //禁用滚动条
        }
        function close_choose_attr() {
            $(".mask-div").hide();
            $('#mobile_info').hide();
        }
        function change_p_type() {
            if ($("#password").attr("type") == "password") {
                $("#p_type").addClass("on");
                document.getElementById("password").type = "text";

            } else {
                $("#p_type").removeClass("on");
                document.getElementById("password").type = "password";
            }
        }

        $().ready(function() {
            var validator = $("#MobileRegisterModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            //
            var show_captcha = false;
            //

            function showCaptcha() {
                if ($('#captcha_model').hasClass('hide')) {
                    $('.mask-div').show();
                    $('#captcha_model').removeClass('hide');
                }
            }

            $('#step_btn_1').bind('click', function() {
                //第一步:按钮是红色的时候，点击显示第二步
                if ($(this).hasClass('disable')) {
                    return;
                }
                $("#step_1").hide();
                $("#step_2").show();
                $("#step_3").hide();
                $("#step_2").find(".tip-text").html("请输入" + $("#mobileregistermodel-mobile").val() + "收到的验证码");
            });

            $('#step_btn_2').bind('click', function() {
                if ($(this).hasClass('disable')) {
                    return;
                }

                var mobile = $("#mobileregistermodel-mobile").val();
                var sms_captcha = $("#mobileregistermodel-sms_captcha").val();

                $.loading.start();

                // 检查短信验证码是否正确
                $.post("/register/check-sms-captcha.html", {
                    mobile: mobile,
                    sms_captcha: sms_captcha,
                }, function(result) {
                    if (result.code == 0) {
                        // 下一步
                        $("#step_1").hide();
                        $("#step_2").hide();
                        $("#step_3").show();
                    } else {

                        if (result.data && result.data.show_captcha) {
                            show_captcha = true;
                        }

                        $.msg(result.message, {
                            time: 5000
                        });

                        // 失败后点击验证码
                        if ($("#captcha-image").size() > 0) {
                            $("#captcha").val("");
                            $("#captcha-image").click();
                        }
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });

            $('#step_btn_3').bind('click', function() {
                if ($(this).hasClass('disable') || $(this).prop("disabled") || !validator.form()) {
                    return;
                }
                // 禁止再次点击
                $(this).prop("disabled", true);
                $.loading.start();
                $("#MobileRegisterModel").submit();
            });

            //input验证
            $("#mobileregistermodel-mobile").data("rule-ajax-callback", function(result) {
                if (result.code == 0 && $("#remember1").is(":checked")) {
                    $(this).parents('.middle-content').find('.btn-submit').removeClass('disable');
                } else {
                    $(this).parents('.middle-content').find('.btn-submit').addClass('disable');
                }
            });

            $("input").watch(function(input) {
                var flag = true;
                $.each($(this).parents('.middle-content').find('input'), function() {
                    if ($(this).val() == '') {
                        flag = false;
                    }
                });

                var captcha = true;

                if (show_captcha && input.attr('id') == 'mobileregistermodel-sms_captcha') {
                    captcha = $("#captcha").valid();
                    $.validator.clearError($("#captcha"));
                }

                if (input.valid() && flag == true && $("#remember1").is(":checked")) {
                    $(input).parents('.middle-content').find('.btn-submit').removeClass('disable');
                } else {
                    $(input).parents('.middle-content').find('.btn-submit').addClass('disable');
                }
            });
            //协议点击事件
            $("#remember1").change(function() {
                if ($(this).is(":checked") && $(this).parents('.middle-content').find('input').valid()) {
                    $(this).parents('.middle-content').find('.btn-submit').removeClass('disable');
                } else {
                    $(this).parents('.middle-content').find('.btn-submit').addClass('disable');
                }
            });

            // 获取验证码链接点击事件
            $(".phonecode").click(function() {
                if (show_captcha) {
                    showCaptcha();
                } else {
                    sendSMSCaptcha(false);
                }
            });

            //点击取消
            $('#captcha_cancel').click(function() {
                $('#captcha_model').addClass('hide');
                $('.mask-div').hide();
                // 按钮生效
                $(".phonecode").removeClass("disable");
                $(".phonecode").data("doing", false);
                $(".phonecode").prop("disable", false);
            });
            //点击确定
            $('#captcha_submit').click(function() {
                if (!$("#captcha").valid()) {
                    $("#captcha").focus();
                    return;
                }
                // 隐藏
                $('#captcha_model').addClass('hide');
                $('.mask-div').hide();
                // 发送
                sendSMSCaptcha(false);
            });

            function sendSMSCaptcha(check_show_captcha) {

                // 获取短信验证码
                var target = $(".phonecode");

                if ($(target).prop("disable") == true || $(target).data("doing") == true || $(target).hasClass("disable")) {
                    return;
                }

                if ($(target).data("doing")) {
                    return;
                }

                // 检查图片验证码并且展示图片验证码
                if (check_show_captcha && show_captcha) {
                    showCaptcha();
                    return;
                }

                // 禁用按钮
                $(target).addClass("disable");
                $(target).data("doing", true);
                $(target).prop("disable", true);

                var mobile = $("#mobileregistermodel-mobile").val();
                var captcha = $("#captcha").val();
                $.post('/register/sms-captcha', {
                    mobile: mobile,
                    captcha: captcha
                }, function(result) {
                    if (result.code == 0) {
                        // 开始倒计时
                        countdown(target, "获取验证码");
                    } else {

                        if (result.data && result.data.show_captcha) {
                            show_captcha = true;
                        }

                        if (result.code == 1) {
                            $.validator.showError($("#captcha"), result.message);
                            showCaptcha();
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

                        // 使按钮生效
                        $(target).removeClass('disable');
                        $(target).data("doing", false);
                        $(target).prop("disable", false);
                    }
                }, "json");
            }

            var wait = 60;

            function countdown(obj, msg) {
                obj = $(obj);
                if (wait <= 0) {
                    // 使按钮生效
                    $(obj).removeClass('disable');
                    $(obj).data("doing", false);
                    $(obj).prop("disable", false);
                    // 显示文字
                    $(obj).html(msg);
                    wait = 60;
                } else {
                    if (msg == undefined || msg == null) {
                        msg = obj.html();
                    }
                    // 使按钮失效
                    $(obj).addClass('disable');
                    $(obj).data("doing", true);
                    $(obj).prop("disable", true);
                    // 设置文字
                    $(obj).html(wait + "秒后重新获取");
                    wait--;
                    setTimeout(function() {
                        countdown(obj, msg)
                    }, 1000)
                }
            }

        });
        $(window).load(function() {
            $('#mobileregistermodel-mobile').focus();
        });
    </script>
</div>
<!-- 用户协议 -->
<div id="user_protocol">
    <div class="user-protocol-con">
        <header>
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:void(0)"></a>
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
