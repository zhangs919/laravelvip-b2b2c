<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="wap-font-scale" content="no">
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />

    <!--登录页css-->
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif
</head>
<body>
<!--登录页css-->
<link rel="stylesheet" href="/css/common.css?v=20180702"/>
<link rel="stylesheet" href="/css/login.css?v=20180702"/>
<script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
<script src="/assets/d2eace91/js/placeholder.js?v=20180813"></script>
<script src="/assets/d2eace91/js/jquery.supersized.min.js?v=20180813"></script>
<script src="/js/login.js?v=20180813"></script>
<script src="/js/common.js?v=20180813"></script>


<div class="login-top" style='background: url({{ get_image_url(sysconf('m_login_bgimg'), 'm_login_bgimg') }}) no-repeat; background-size:cover'>
    <header id="header" class="header header-color">
        <div class="header-left">
            <a href="javascript:history.back(-1)" class="sb-back">
				<i class="iconfont">&#xe606;</i>
            </a>
            <a href="/"></a>
        </div>
        <div class="header-middle"></div>
        <div class="header-right">
            <a href="/register.html" class="text">注册</a>
        </div>
    </header>
    <div class="login-img">
        <img src="{{ get_image_url(sysconf('m_login_logo')) }}">

    </div>
</div>
<div class="login-radio bg-no">
    <ul>
        <li class="active" id="login2" onclick="setTab('login',2,2)">普通登录</li>
        <li class="" id="login1" onclick="setTab('login',1,2)">动态密码登录</li>
    </ul>
</div>
<div id="{{ $uuid }}">


    <div class="middle-content m-t-0" id="con_login_2">
        <form id="form2" action="/login.html" method="POST">
            @csrf
            <div class="form-group-box">
                <!-- 用户名 -->
                <div class="form-group form-group-spe" >
                    <dl>
                        <dt>
                            <span>用户名：</span>
                        </dt>
                        <dd>
                            <div class="form-control-box">


                                <input type="text" id="loginmodel-username" class="form-control" name="LoginModel[username]" value="{{ old('LoginModel.username') }}" placeholder="手机/邮箱/用户名" autocomplete="off">


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


                                <input type="password" id="loginmodel-password" class="form-control" name="LoginModel[password]" value="{{ old('LoginModel.password') }}" tabindex="2" placeholder="密码" autocomplete="off">


                            </div>

                        </dd>
                    </dl>
                </div>
                <div class="invalid"></div>

                <div class="form-group captcha" style="display: none;">
                    <dl class="form-group-spe captcha" id="o-authcode">
                        <dt>验证码:</dt>
                        <dd>
                            <div class="form-control-box input_box">
                                <i class="icon"></i>
                                <input type="text" id="captcha" name="LoginModel[verifyCode]" class="text" tabindex="3" placeholder="验证码" />
                                <label class="captcha captcha-img"> <img id="captcha-image" class="captcha-image" name="LoginModel[verifyCode]" src="/site/captcha.html?v=5b752db082898" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script></label>
                            </div>

                        </dd>
                    </dl>
                </div>
            </div>
            <div class="ng-foot ng-foot-logo clearfix">

                <input type="hidden" name="LoginModel[rememberMe]" value="0" />
                <div class="remember-info">
                    <input type="checkbox" value="1" name="LoginModel[rememberMe]" id="LoginModel[rememberMe]" checked />
                    <span>自动登录</span>
                </div>

                <a href="/user/find-password.html">
                    <i class="ng-foot-icon icon-clock"></i>
                    <span>找回密码</span>
                </a>
                <a href="/register.html" class="reg-link">
                    <i class="ng-foot-icon icon-reg"></i>
                    <span>快速注册</span>
                </a>
            </div>
            <div class="submit-btn">
                <input type="hidden" name="act" value="act_login" />
                <input type="hidden" name="back_act" value="" />
                <input type="submit" class="btn-submit" id="login_btn" value="登 录">
            </div>
            <input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">
        </form>
    </div>


    <div class="middle-content m-t-0" id="con_login_1" style="display: none;">
        <form id="form1" action="/login.html" method="POST">
            @csrf
            <div class="form-group-box">
                <!--  用户名  -->
                <div class="form-group form-group-spe" >
                    <dl>
                        <dt>
                            <span>手机号码：</span>
                        </dt>
                        <dd>
                            <div class="form-control-box">


                                <input type="number" id="smsloginmodel-mobile" class="form-control" name="SmsLoginModel[mobile]" value="{{ old('SmsLoginModel.mobile') }}" tabindex="1" placeholder="已注册的手机号码" autocomplete="off" pattern="[0-9]*">


                            </div>

                        </dd>
                    </dl>
                </div>
                <div class="invalid"></div>

                <div class="form-group captcha" style="display: none;">
                    <dl class="form-group-spe captcha" id="o-authcode">
                        <dt>验证码：</dt>
                        <dd>
                            <div class="form-control-box input_box">
                                <i class="icon"></i>
                                <input type="text" id="captcha_sms" name="SmsLoginModel[captcha]" class="text" tabindex="2" placeholder="验证码" />
                                <label class="captcha"> <img id="captcha-image" class="captcha-image" name="LoginModel[verifyCode]" src="/site/captcha.html?v=5b752db084b87" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script></label>
                            </div>

                        </dd>
                    </dl>
                </div>

                <!--  动态密码  -->
                <div class="form-group form-group-spe" >
                    <dl>
                        <dt>
                            <span>动态密码：</span>
                        </dt>
                        <dd>
                            <div class="form-control-box">


                                <input type="number" id="smsloginmodel-smscaptcha" class="text" name="SmsLoginModel[smsCaptcha]" tabindex="3" placeholder="动态密码" pattern="[0-9]*">
                                <a id="btn_send_sms_code" href="javascript:void(0);" class="phonecode phonecode1">获取验证码</a>


                            </div>

                        </dd>
                    </dl>
                </div>
                <div class="invalid"></div>

            </div>
            <div class="ng-foot clearfix">

                <input type="hidden" name="LoginModel[rememberMe]" value="0" />
                <div class="remember-info">
                    <input type="checkbox" value="1" name="LoginModel[rememberMe]" id="LoginModel[rememberMe]" checked />
                    <span>自动登录</span>
                </div>

                <a href="/user/find-password.html">
                    <i class="ng-foot-icon icon-clock"></i>
                    <span>找回密码</span>
                </a>
                <a href="/register.html" class="reg-link">
                    <i class="ng-foot-icon icon-reg"></i>
                    <span>快速注册</span>
                </a>
            </div>
            <div class="submit-btn">
                <input type="hidden" name="act" value="act_login" />
                <input type="hidden" name="back_act" value="" />
                <input type="submit" class="btn-submit" id="login_btn" value="登 录">
            </div>
            <input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">

        </form>
    </div>
    <!--第三方登录-->

    <div class="other-login">
        <fieldset class="other-login-title">
            <legend align="center">第三方登录</legend>
        </fieldset>
        <div class="other-login-content">

            @if(sysconf('open_weixin_login') && is_weixin())
                <a href="login/website-login?type=mobile_weixin" class="weixin"></a>
            @endif

            @if(sysconf('open_qq_login'))
                <a href="login/website-login?type=qq" class="qq"></a>
            @endif

            @if(sysconf('open_weibo_login'))
                <a href="login/website-login?type=weibo" class="sina"></a>
            @endif

        </div>
    </div>

</div>
<script type="text/javascript">
    function change_p_type(){
        if($("#password").attr("type") == "password"){
            $("#p_type").addClass("on");
            document.getElementById("password").type="text";
        }
        else{
            $("#p_type").removeClass("on");
            document.getElementById("password").type="password";
        }
    }
    if($('.other-login-content a').length>0)
    {
        $('.other-login').show();
    }else{
        $('.other-login').hide();
    }
</script>
<!-- 验证码脚本 -->
<script src="/assets/d2eace91/js/jquery.captcha.js?v=20180813"></script>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180813"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180813"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180813"></script>
<script id="client_rules" type="text/javascript">
    [{"id": "loginmodel-username", "name": "LoginModel[username]", "attribute": "username", "rules": {"required":true,"messages":{"required":"请输入用户名"}}},{"id": "loginmodel-password", "name": "LoginModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"请输入密码"}}},{"id": "loginmodel-username", "name": "LoginModel[username]", "attribute": "username", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","maxlength":"用户名长度必需在100以内"},"maxlength":50}},{"id": "loginmodel-password", "name": "LoginModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"密码必须是一条字符串。","maxlength":"密码长度必需在32以内"},"maxlength":32}},{"id": "loginmodel-rememberme", "name": "LoginModel[rememberMe]", "attribute": "rememberMe", "rules": {"boolean":{"trueValue":"1","falseValue":"0"},"messages":{"boolean":"记住用户名密码必须要么为\"1\"，要么为\"0\"。"}}},]
</script>
<script id="sms_client_rules" type="text/javascript">
    [{"id": "smsloginmodel-captcha", "name": "SmsLoginModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入图片验证码"},"when":"function(){return $(\"#captcha_sms\").is(\":visible\") && $(\"#captcha_sms\").size() > 0;}"}},{"id": "smsloginmodel-captcha", "name": "SmsLoginModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":431,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"},"when":"function(){return $(\"#captcha_sms\").is(\":visible\") && $(\"#captcha_sms\").size() > 0;}"}},{"id": "smsloginmodel-mobile", "name": "SmsLoginModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"请输入手机号码"}}},{"id": "smsloginmodel-smscaptcha", "name": "SmsLoginModel[smsCaptcha]", "attribute": "smsCaptcha", "rules": {"required":true,"messages":{"required":"请输入动态密码"}}},{"id": "smsloginmodel-mobile", "name": "SmsLoginModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入一个有效的手机号码"}}},{"id": "smsloginmodel-rememberme", "name": "SmsLoginModel[rememberMe]", "attribute": "rememberMe", "rules": {"boolean":{"trueValue":"1","falseValue":"0"},"messages":{"boolean":"记住用户名密码必须要么为\"1\"，要么为\"0\"。"}}},]
</script>
<!-- 第三方流量统计 -->
<div style="display: none;">
    {{--第三方统计代码--}}
    {!! sysconf('stats_code_wap') !!}
</div>
<!-- 底部 _end-->
<script type="text/javascript">
    $().ready(function() {
        var container = $("#{{ $uuid }}");
        var validator = $("#form2").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        $(container).find("#form2").submit(function() {
            if(!validator.form()){
                return false;
            }
            //
            return true;
            //
        });


        $("input").watch(function() {
            var flag = true;
            $.each($(this).parents('.submit-btn').find('input'), function() {
                if ($(this).val() == '') {
                    flag = false;
                }
            });
            if (flag == true) {
                //	$(input).parents('.denglu').find('.btn_submit').removeClass('disable');
            } else {
                //	$(input).parents('.denglu').find('.btn_submit').addClass('disable');
            }
        });


        var validator1 = $(container).find("#form1").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#sms_client_rules").html());

        $(container).find("#form1").submit(function() {
            if(!validator1.form()){
                return false;
            }
            //
            return true;
            //
        });

        $(container).find("#btn_send_sms_code").click(function(){

            if($(this).prop("disabled") == true || $(this).data("doing") == true){
                return;
            }

            var mobile_valid = $("#smsloginmodel-mobile").valid();

            if(mobile_valid == false){
                $("#smsloginmodel-mobile").focus();
                return false;
            }

            var captcha_valid = true;

            if($("#captcha_sms").is(":visible") && $("#captcha_sms").size() > 0){
                captcha_valid = $("#captcha_sms").valid();
            }

            if(captcha_valid == false){
                $("#captcha_sms").focus();
                return false;
            }

            if(mobile_valid && captcha_valid){

                var target = this;

                $(this).data("doing", true);

                var mobile = $("#smsloginmodel-mobile").val();

                $.post('/site/sms-captcha', {
                    mobile: mobile,
                    captcha: $("#captcha_sms").val()
                }, function(result){
                    if(result.code == 0){
                        // 开始倒计时
                        countdown(target, "获取验证码");
                    }else{
                        // 失败后点击验证码
                        if($("#captcha_sms-image").size() > 0){
                            $("#captcha_sms").val("");
                            $("#captcha_sms-image").click();
                        }
                        // 显示图形验证码
                        if($("#captcha_sms-image").is(":visible") == false && result.data.show_captcha == 1){
                            $("#captcha_sms").parents(".captcha").show();
                        }

                        var errors = {};
                        if(result.data && result.data.field){
                            errors["SmsLoginModel[" + result.data.field + "]"] = result.message;
                            validator1.showErrors(errors);
                        }else if(result.code == 1){
                            errors["SmsLoginModel[captcha]"] = result.message;
                            validator1.showErrors(errors);
                        }

                        // 解禁
                        $(this).addClass("disabled");
                        $(this).prop("disabled", true);
                    }
                    $(target).data("doing", false);
                }, "json");
            }

        });

        //
        var wait = null;
        //

        function countdown(obj, msg) {

            obj = $(obj);

            if(wait === null){
                wait = 60;
            }

            if (wait <= 0) {
                obj.removeClass("disabled");
                obj.prop("disabled", false);
                obj.html(msg);
                wait = 60;
            } else {
                if (msg == undefined || msg == null) {
                    msg = obj.html();
                }
                obj.addClass("disabled");
                obj.prop("disabled", true);
                obj.html(wait + "秒后重新获取");
                wait--;
                setTimeout(function() {
                    countdown(obj, msg)
                }, 1000)
            }
        }

        if(wait !== null){
            // 开始倒计时
            countdown($(container).find("#btn_send_sms_code"), "获取手机验证码");
        }
    });
</script>


</body>
</html>
