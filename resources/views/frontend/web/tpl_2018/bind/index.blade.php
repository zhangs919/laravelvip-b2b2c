
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
    <link href="/css/register.css?v=1" rel="stylesheet">
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <script src="/assets/d2eace91/js/jquery.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=20201016"></script>
</head>
<body>
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
                        <li class="active">
                            <a href="javascript:;">已有账号，请绑定</a>
                        </li>
                        <li class="">
                            <a href="/bind/bind/mobile">没有账号，请注册</a>
                        </li>
                    </ul>
                </div>
                <div class="reg-wrap">
                    <div class="reg-wrap-con" id="con_register_1" style="background: url(/images/register-bg.jpg) no-repeat right 20px;">
                        <div class="wellcome-tip">
                            <img src="{{ $third_login_info['avatar_url'] }}" width="28" height="28" />
                            Hi, {{ $third_login_info['name'] }} 欢迎来到商城！
                        </div>
                        <form id="form" class="form-horizontal" action="/bind.html" method="POST">
                            @csrf
                            <div class="form-group form-group-spe">
                                <label class="input-left">
                                    <span class="spark">*</span>
                                    <span>商城账号：</span>
                                </label>
                                <div class="form-control-box">
                                    <input type="text" id="username" name="LoginModel[username]" value="" class="text" tabindex="1" placeholder="已验证手机/邮箱/用户名" autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group form-group-spe">
                                <label class="input-left">
                                    <span class="spark">*</span>
                                    <span>密码：</span>
                                </label>
                                <div class="form-control-box">
                                    <input type="password" id="password" name="LoginModel[password]" value="" class="text" tabindex="2" placeholder="密码" autocomplete="off" />
                                    <i class="fa fa-eye-slash pwd-toggle" data-id="password"></i>
                                </div>
                            </div>
                            <div class="safety">
                                <a class="forget-password fr" href="/user/find-password.html">忘记密码？</a>
                            </div>
                            <div class="reg-btn">
                                <input type="hidden" name="act" value="act_login" />
                                <input type="hidden" name="back_act" value="" />
                                <input type="submit" name="submit" class="btn-img btn-entry bg-color" id="loginsubmit" value="立即绑定" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- 验证码脚本 -->
        <!-- 表单验证 -->
        <script id="client_rules" type="text/javascript">
            [{"id": "loginmodel-username", "name": "LoginModel[username]", "attribute": "username", "rules": {"required":true,"messages":{"required":"请输入用户名"}}},{"id": "loginmodel-password", "name": "LoginModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"请输入密码"}}},{"id": "loginmodel-username", "name": "LoginModel[username]", "attribute": "username", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","maxlength":"用户名长度必需在100以内"},"maxlength":50}},{"id": "loginmodel-password", "name": "LoginModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"密码必须是一条字符串。","maxlength":"密码长度必需在32以内"},"maxlength":32}},{"id": "loginmodel-rememberme", "name": "LoginModel[rememberMe]", "attribute": "rememberMe", "rules": {"boolean":{"trueValue":"1","falseValue":"0"},"messages":{"boolean":"记住用户名密码必须要么为\"1\"，要么为\"0\"。"}}},]
        </script>
        <script type="text/javascript">
            //
        </script>
    </div>
</div>
<!-- 用户协议 -->
<div id="user_protocol" style="display: none;">
    <div class="protocol">
        <div class="protocol-con"></div>
    </div>
</div>

@include('layouts.partials.common_footer')


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
        var validator = $("#form").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#form").submit(function() {
            if(!validator.form()){
                return false;
            }
            return true;
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
