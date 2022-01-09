
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>登录 - {{ sysconf('site_name') }}B2B2C商城演示站卖家中心 </title>
    <!-- 禁止搜索引擎收录 -->
    <meta name="robots" content="noarchive">
    <meta name="baidspider" content="noarchive">
    <meta name="googlebot" content="noarchive">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link type="text/css" rel="stylesheet" href="/frontend/css/common.css">
    <script src="/assets/d2eace91/js/jquery.js?v=20180418"></script>
    <script type="text/javascript" src="/frontend/js/common.js"></script>

    <!-- 加载Layer插件 -->
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script><link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">

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
<div class="header login-header w990">
    <div class="logo-info">
        <a href="./" class="logo">
            <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
        </a>
        <span class="findpw">欢迎登录</span>
    </div>
    <div class="logo-right">
        <ul class="logo-right-menu">
            <li class="current"><a class="seller" href="http://{{ env('SELLER_DOMAIN') }}/index.html" target="_blank"><i></i>商家管理中心</a></li>
            <li ><a class="store" href="http://{{ env('STORE_DOMAIN') }}/index.html" target="_blank"><i></i>网点管理中心</a></li>
        </ul>
    </div>
</div>
<div class="header-line"><span></span></div>
<div class="login-content">
    <div class="login-banner" style="background: url('{{ get_image_url(sysconf('login_bg_image')) }}') center;">
        <div class="w990 pos-r">


            <link type="text/css" rel="stylesheet" href="/frontend/css/login.css">
            <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.6"/>
            <!--整站改色 _start-->
            @if(sysconf('custom_style_enable') == 1)
                <link rel="stylesheet" href="/frontend/css/custom/site-color-style-0.css?v=1.6"/>
            @else
                <link rel="stylesheet" href="/frontend/css/color-style.css?v=1.6"/>
            @endif
            <!--整站改色 _end-->
            <script src="/assets/d2eace91/js/layer/layer.js?v=20180418"></script>
            <script src="/assets/d2eace91/js/jquery.method.js?v=20180418"></script>
            <script src="/assets/d2eace91/js/placeholder.js?v=20180418"></script>
            <script src="/assets/d2eace91/js/jquery.supersized.min.js?v=20180418"></script>
            <div id="1524381447rads9d" class="login-form">
                <div class="login-con pos-r">

                    <div class="login-switch">
                        <a href="javascript:;" class="qrcode-target btn-qrcode" on-moblie="false" title="手机扫码登录"></a>
                    </div>

                    <div class="login-wrap ">

                        <div class="login-tit">
                            还不是卖家？
                            <a href="http://www.laravelvip.com/shop/apply.html" class="regist-link color">
                                立即申请
                                <i>&gt;</i>
                            </a>
                        </div>

                        <div class="login-radio">
                            <ul>
                                <li class="active" id="login2" onclick="setTab('login',2,2)">普通登录</li>
                                <li class="" id="login1" onclick="setTab('login',1,2)">动态密码登录</li>
                            </ul>
                        </div>
                        <!-- 普通登录 start -->


                        <div id="con_login_2" class="form">
                            <form id="form2" action="/login" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group item-name">
                                    <!-- 错误项标注 给div另添加一个class值'error' star -->
                                    <div class="form-control-box">
                                        <i class="icon"></i>
                                        <input type="text" id="username" name="LoginModel[username]" value="" class="text" tabindex="1" placeholder="已验证手机/邮箱/用户名" autocomplete="off" />
                                    </div>

                                    <!-- 错误项标注 给div另添加一个class值'error' end -->
                                </div>
                                <div class="form-group item-password">
                                    <div class="form-control-box">
                                        <i class="icon"></i>
                                        <input type="password" id="password" name="LoginModel[password]" value="" class="text" tabindex="2" placeholder="密码" autocomplete="off" />
                                    </div>

                                </div>
                                <div class="form-group form-group-spe captcha" id="o-authcode" style="display: none;">
                                    <div class="form-control-box">
                                        <i class="icon"></i>
                                        <input type="text" id="captcha" name="LoginModel[verifyCode]" class="text" tabindex="3" placeholder="验证码" maxlength="4" />
                                        <label class="captcha"> <img id="captcha-image" class="captcha-image" name="LoginModel[verifyCode]" src="/site/captcha.html?v=5adc3707d7cc0" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script></label>
                                    </div>

                                </div>
                                <div class="safety">

                                    <input type="hidden" name="LoginModel[rememberMe]" value="0" />
                                    <label for="LoginModel[rememberMe]">
                                        <input type="checkbox" value="1" name="LoginModel[rememberMe]" id="LoginModel[rememberMe]" class="checkbox" />
                                        <span>自动登录</span>
                                    </label>

                                    <a class="forget-password fr" href="http://www.laravelvip.com/user/find-password">忘记密码？</a>
                                </div>
                                <div class="login-btn">
                                    <input type="hidden" name="act" value="act_login" />
                                    <input type="hidden" name="back_act" value="" />
                                    <input type="submit" name="submit" class="btn-img btn-entry bg-color" value="立即登录" />
                                </div>
                                <div class="item-coagent">

                                </div>
                                <input type="hidden" name="back_url" value="http://seller.laravelvip.com/shop/account/add" />

                            </form>
                        </div>
                        <!-- 普通登录 end -->
                        <!-- 动态登录 star -->


                        <div id="con_login_1" class="form" style="display: none;">
                            <form id="form1" action="/login" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group item-name">
                                    <!-- 错误项标注 给div另添加一个class值'error' star -->
                                    <div class="form-control-box">
                                        <i class="icon"></i>
                                        <input type="text" id="mobile" name="SmsLoginModel[mobile]" class="text" value="" tabindex="1" placeholder="已注册的手机号码" autocomplete="off" />
                                    </div>

                                    <!-- 错误项标注 给div另添加一个class值'error' end -->
                                </div>
                                <div class="form-group form-group-spe captcha" id="o-authcode" style="display: none;">
                                    <div class="form-control-box">
                                        <i class="icon"></i>
                                        <input type="text" id="captcha_sms" name="SmsLoginModel[captcha]" class="text" tabindex="2" placeholder="验证码" maxlength="4" />
                                        <label class="captcha"> <img id="captcha_sms-image" class="captcha-image" name="LoginModel[captcha]" src="/site/captcha.html?v=5adc3707d840b" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha_sms-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script></label>
                                    </div>

                                </div>
                                <div class="form-group form-group-spe form-group-phonecode">
                                    <div class="form-control-box fl">
                                        <i class="icon"></i>
                                        <input type="text" id="smsCaptcha" name="SmsLoginModel[smsCaptcha]" class="text" tabindex="3" placeholder="动态密码" />
                                        <a id="btn_send_sms_code" href="javascript:void(0);" class="phonecode">获取手机验证码</a>
                                    </div>

                                </div>

                                <div class="safety">
                                    <input type="hidden" name="SmsLoginModel[rememberMe]" value="0" />
                                    <label for="SmsLoginModel[rememberMe]">
                                        <input type="checkbox" id="SmsLoginModel[rememberMe]" name="SmsLoginModel[rememberMe]" class="checkbox" value="1" />
                                        <span>自动登录</span>
                                    </label>
                                </div>

                                <div class="login-btn">
                                    <input type="hidden" name="act" value="act_login" />
                                    <input type="hidden" name="back_act" value="" />
                                    <input type="submit" name="submit" class="btn-img btn-entry bg-color" value="立即登录" />
                                </div>
                                <div class="item-coagent">

                                </div>
                                <input type="hidden" name="back_url" value="http://seller.laravelvip.com/shop/account/add" />

                            </form>
                        </div>
                        <!-- 动态登录 end -->
                    </div>
                    <!-- 扫码登录 start -->

                    <div class="login-mobile hide">
                        <div class="default-state">
                            <p class="qrcode-tit">手机扫码，安全登录</p>
                            <div class="qrcode-box">
                                <div class="qrcode SZY-QRCODE-LOGIN"></div>
                                <div class="qrcode-help"></div>
                                <!-- 二维码失效或者登录失败显示该模块 _start -->
                                <div class="qrcode-error hide">
                                    <p>二维码已失效</p>
                                    <a href="javascript:REF_QRCodeLogin(1);" class="refresh">请点击刷新</a>
                                </div>
                                <!-- 二维码失效或者登录失败显示该模块 _end -->
                            </div>
                            <div class="qrcode-desc">
                                <i></i>
                                <p>
                                    打开进入
                                    <a href="javascript:void(0)" class="color">手机商城</a>
                                    <span>扫一扫登录</span>
                                </p>
                            </div>
                            <div class="login-links">
                                <a href="javascript:void(0)" class="forget-pwd">密码登录</a>
                                <a href="http://www.laravelvip.com/register.html" class="register" target="_blank">免费注册</a>
                            </div>
                        </div>
                    </div>
                    <!-- 扫码登录 end -->
                    <!-- 扫码登录成功 start -->
                    <div class="login-mobile hide">
                        <div class="default-state">
                            <p class="qrcode-tit">手机扫码，安全登录</p>
                            <div class="qrcode-msg">
                                <div class="msg-ok">
                                    <div class="msg-icon">
                                        <i class="iconfont icon-ok">&#xe6d4;</i>
                                        <i class="iconfont icon-phone">&#xe60b;</i>
                                    </div>
                                    <p class="tip1">扫描成功！</p>
                                    <p class="tip2">请在手机上确认登录</p>
                                    <div class="link">
                                        <a href="javascript:REF_QRCodeLogin(1);" class="light-link">返回二维码登录</a>
                                    </div>
                                </div>
                            </div>
                            <div class="login-links">
                                <a href="javascript:void(0)" class="forget-pwd">密码登录</a>
                                <a href="http://www.laravelvip.com/register.html" class="register" target="_blank">免费注册</a>
                            </div>
                        </div>
                    </div>
                    <!-- 扫码登录成功 end -->

                </div>
            </div>
            <!-- cookie -->
            <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180418"></script>
            <!-- 验证码脚本 -->
            <script src="/assets/d2eace91/js/jquery.captcha.js?v=20180418"></script>
            <!-- 表单验证 -->
            <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180418"></script>
            <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180418"></script>
            <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180418"></script>
            <script id="client_rules" type="text/javascript">
                [{"id": "loginmodel-username", "name": "LoginModel[username]", "attribute": "username", "rules": {"required":true,"messages":{"required":"请输入用户名"}}},{"id": "loginmodel-password", "name": "LoginModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"请输入密码"}}},{"id": "loginmodel-username", "name": "LoginModel[username]", "attribute": "username", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","maxlength":"用户名长度必需在100以内"},"maxlength":50}},{"id": "loginmodel-password", "name": "LoginModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"密码必须是一条字符串。","maxlength":"密码长度必需在32以内"},"maxlength":32}},{"id": "loginmodel-rememberme", "name": "LoginModel[rememberMe]", "attribute": "rememberMe", "rules": {"boolean":{"trueValue":"1","falseValue":"0"},"messages":{"boolean":"记住用户名密码必须要么为\"1\"，要么为\"0\"。"}}},]
            </script>
            <script id="sms_client_rules" type="text/javascript">
                [{"id": "smsloginmodel-captcha", "name": "SmsLoginModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入图片验证码"},"when":"function(){return $(\"#captcha_sms\").is(\":visible\") && $(\"#captcha_sms\").size() > 0;}"}},{"id": "smsloginmodel-captcha", "name": "SmsLoginModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":427,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"},"when":"function(){return $(\"#captcha_sms\").is(\":visible\") && $(\"#captcha_sms\").size() > 0;}"}},{"id": "smsloginmodel-mobile", "name": "SmsLoginModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"请输入手机号码"}}},{"id": "smsloginmodel-smscaptcha", "name": "SmsLoginModel[smsCaptcha]", "attribute": "smsCaptcha", "rules": {"required":true,"messages":{"required":"请输入动态密码"}}},{"id": "smsloginmodel-mobile", "name": "SmsLoginModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^(13[0-9]{1}[0-9]{8}|15[0-9]{1}[0-9]{8}|18[0-9]{1}[0-9]{8}|17[0-9]{1}[0-9]{8}|14[0-9]{1}[0-9]{8}|199[0-9]{8}|198[0-9]{8}|166[0-9]{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入一个有效的手机号码"}}},{"id": "smsloginmodel-rememberme", "name": "SmsLoginModel[rememberMe]", "attribute": "rememberMe", "rules": {"boolean":{"trueValue":"1","falseValue":"0"},"messages":{"boolean":"记住用户名密码必须要么为\"1\"，要么为\"0\"。"}}},]
            </script>
            <script type="text/javascript">
                $().ready(function() {

                    $('.forget-pwd').click(function(){
                        $('.qrcode-target').removeClass('btn-login').addClass('btn-qrcode').attr('title','去手机扫码登录');
                        $('.login-wrap').show();
                        $('.login-mobile').hide();
                    });
                    $("body").on('click', '.website-login', function() {
                        var type = $(this).data("id");
                        $.go("http://www.laravelvip.com"+"/website/login?type="+type);
                    })

                    var container = $("#1524381447rads9d");

                    /**
                     * 初始化validator默认值
                     */
                        //先获取到默认函数，不能直接覆盖掉
                    var errorPlacement = $.validator.defaults.errorPlacement;
                    $.validator.setDefaults({
                        errorPlacement: function(error, element) {
                            $(element).parent(".form-control-box").addClass("error");
                            errorPlacement.call(this, error, element);
                        },
                        // 失去焦点验证
                        onfocusout: function(element) {
                            $(element).valid();
                        },
                        // 成功后移除错误提示
                        success: function(error) {
                            var error_id = $(error).attr("id");
                            var element_id = $(error).attr("for");
                            // 移除错误样式
                            $("[id='"+error_id+"']").remove();
                            $(":input[id='"+element_id+"']").parent(".form-control-box").removeClass("error");
                        }
                    });

                    var validator = $(container).find("#form2").validate();
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

                        var mobile_valid = $("#mobile").valid();

                        if(mobile_valid == false){
                            $("#mobile").focus();
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

                            var mobile = $("#mobile").val();

                            $.post('/site/sms-captcha', {
                                mobile: mobile,
                                captcha: $("#captcha_sms").val()
                            }, function(result){
                                if(result.code == 0){
                                    // 开始倒计时
                                    countdown(target, "获取手机验证码");
                                }else{
                                    // 失败后点击验证码
                                    if($("#captcha_sms-image").is(":visible") && $("#captcha_sms-image").size() > 0){
                                        $("#captcha_sms").val("");
                                        $("#captcha_sms-image").click();
                                    }
                                    // 显示图形验证码
                                    if($("#captcha_sms-image").is(":visible") == false && result.data.show_captcha == 1){
                                        $("#captcha_sms").parents(".captcha").show();
                                    }
                                    var errors = {};
                                    errors["SmsLoginModel[" + result.data.field + "]"] = result.message;
                                    validator1.showErrors(errors);
                                }
                                $(target).data("doing", false);
                            }, "json");
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
                            setTimeout(function() {
                                countdown(obj, msg)
                            }, 1000)
                        }
                    }
                });
            </script>
            <script src="/assets/d2eace91/js/message/message.js?v=20180418"></script>
            <script src="/assets/d2eace91/js/message/messageWS.js?v=20180418"></script>
            <script src="/assets/d2eace91/js/jquery.qrcode.min.js?v=20180418"></script>
            <script type="text/javascript">

                //二维码、PC登录切换
                $('.qrcode-target').click(function(){
                    if($(this).hasClass('btn-qrcode')){
                        $(this).removeClass('btn-qrcode').addClass('btn-login').attr('title','去电脑登录');
                        REF_QRCodeLogin(1);
                        $('.login-wrap').hide();
                        $('.login-mobile').eq(0).show();
                        $.cookie('is_qrcode_login', '1');
                        return;
                    }
                    if($(this).hasClass('btn-login')){
                        $(this).removeClass('btn-login').addClass('btn-qrcode').attr('title','去手机扫码登录');
                        $('.login-wrap').show();
                        $('.login-mobile').hide();
                        $.cookie('is_qrcode_login', '0');
                    }
                });

                var record = 0;
                //
                function qrcode_login(result) {
                    if (typeof result == "undefined" || result == null) {
                        return;
                    }
                    if(result.handle == 'scan'){
                        if($('.qrcode-target').hasClass('btn-qrcode')){
                            $('.qrcode-target').removeClass('btn-qrcode').addClass('btn-login').attr('title','去电脑登录');
                            $('.login-wrap').hide();
                            $('.login-mobile').eq(0).show();
                            $.cookie('is_qrcode_login', '1');
                        }
                        $('.login-mobile').eq(0).hide();
                        $('.login-mobile').eq(1).show();
                        record = 1;
                    }
                    if(result.handle == 'login'){
                        $.post('/site/qrcode-login.html',{
                            key : result.model.key,
                            user_id : result.model.user_id,
                            host : result.model.host,
                            user_name : result.user_name,
                        },function(result){
                            if(result.code == 0){
                                $.login.close();
                                $.login.success(result.back_url);
                            }else{
                                $.msg(result.message);
                            }
                        },'JSON');
                    }
                    if(result.handle == 'cancel'){
                        $('.login-mobile').eq(1).hide();
                        $('.login-mobile').eq(0).show();
                        $('.login-mobile').eq(0).find('.qrcode-error').hide();
                        REF_QRCodeLogin(1);
                        record = 0;
                    }
                }
                // @param view 1-有二维码的页面 2-二维码失效页面
                function REF_QRCodeLogin(view){
                    $.get('/site/get-qrcode-login-key',{ },function(result){
                        $('.SZY-QRCODE-LOGIN').html('');
                        $('.SZY-QRCODE-LOGIN').qrcode({
                            width:150,
                            height:150,
                            text: 'http://www.laravelvip.com/site/qrcode-login.html?k=' + result.data.key
                        });

                        var is_qrcode_login = $.cookie('is_qrcode_login') ? $.cookie('is_qrcode_login') : '0';

                        if(view == 1 && is_qrcode_login != '0'){
                            $('.login-mobile').eq(1).hide();
                            $('.login-mobile').eq(0).show();
                            $('.login-mobile').eq(0).find('.qrcode-error').hide();
                        }
                        if(view == 2){
                            $('.login-mobile').eq(0).show();
                            $('.login-mobile').eq(1).hide();
                            $('.login-mobile').eq(0).find('.qrcode-error').show();
                            record = 0;
                        }
                        //
                        WS_QRCodeLogin({
                            user_id : result.data.user_id,
                            // url: "ws://push.laravelvip.com:7272",
                            'url': "{{ get_ws_url('7272') }}",
                            type: "qrcode_login_set"
                        });
                        // 3分钟后过期
                        setTimeout(function(){
                            if(record == 0){
                                REF_QRCodeLogin(1);
                            }else{
                                REF_QRCodeLogin(2);
                            }
                        }, 180000);
                    },'JSON');
                }
            </script>
        </div>
    </div>
</div>
<!-- 底部 -->
<div class="login-footer">

    {{-- include common footer --}}
    @include('layouts.partials.common_footer')


</div>
</body>
</html>
