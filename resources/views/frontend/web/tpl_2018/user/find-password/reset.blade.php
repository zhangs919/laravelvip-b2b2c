
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>找回密码</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <meta name="is_frontend" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!--整站改色 _start-->
    <!--整站改色 _end-->
    <link href="/css/common.css?v=2.0" rel="stylesheet">
    <link href="/css/forget-password.css?v=2.0" rel="stylesheet">
    <link href="/css/color-style.css?v=2.0" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=202003261806"></script>
</head>
<body>
<div class="header w990">
    <div class="logo-info ">
        <a href="/" class="logo">
            <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
        </a>
        <span class="findpw">找回密码</span>
    </div>
</div>
<div class="forget-content w990">
    <div class="forget-form">
        <div class="forget-con">
            <div class="forget-wrap">
                <div class="safe-con">
                    <div class="stepflex">
                        <dl class="first  done ">
                            <dt class="s-num">1</dt>
                            <dd class="s-text">
                                账户名
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                        <dl class="normal  done ">
                            <dt class="s-num">2</dt>
                            <dd class="s-text">
                                验证身份
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                        <dl class="normal  doing ">
                            <dt class="s-num">3</dt>
                            <dd class="s-text">
                                设置新密码
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                        <dl class="last ">
                            <dt class="s-num">4</dt>
                            <dd class="s-text">
                                完成
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                    </div>
                    <form id="AccountModel" class="form-horizontal form-horizontal-3" name="AccountModel" action="/user/find-password/reset" method="post">
                        @csrf
                        <!-- 密码 -->
                        <div class="form-group form-group-spe" >
                            <label for="accountmodel-password" class="input-left">
                                <span class="spark">*</span>
                                <span>新密码：</span>
                            </label>
                            <div class="form-control-box">
                                <input type="password" id="pwdInput" class="form-control" name="AccountModel[password]" value="" autocomplete="off">
                                <i class="fa fa-eye-slash pwd-toggle" data-id="pwdInput"></i>
                            </div>
                            <div class="invalid"></div>
                        </div><div class="forget-btn">
                            <a href="javascript:void(0);" onclick="document.getElementById('btn_submit').click();" class="btn-img btn-entry bg-color">下一步</a>
                            <div style="display: none;">
                                <input type="submit" id="btn_submit" name="btn_submit" />
                            </div>
                        </div>
                    </form>
                    <!-- 表单验证 -->
                    <!-- 验证规则 -->
                    <script id="client_rules" type="text">
[{"id": "accountmodel-user_id", "name": "AccountModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"User Id必须是整数。"}}},{"id": "accountmodel-password", "name": "AccountModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"请设置新密码"}}},{"id": "accountmodel-password", "name": "AccountModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"新密码必须是一条字符串。","minlength":"新密码应该包含至少6个字符。","maxlength":"新密码只能包含至多20个字符。"},"minlength":6,"maxlength":20}},{"id": "accountmodel-password", "name": "AccountModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"新密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"新密码不能包含空格。"}}},{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入验证码"}}},{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":450,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
</script>
                    <script type="text/javascript">
                        // 
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 底部 _start-->
{{-- include common footer --}}
@include('layouts.partials.short_footer')
<!-- 底部 _end-->

<script type="text/javascript">
    // 
</script>
<script src="/assets/d2eace91/min/js/core.min.js?v=20201016"></script>
<script src="/assets/d2eace91/js/placeholder.js?v=20201016"></script>
<script src="/js/login.js?v=20201016"></script>
<script src="/assets/d2eace91/js/common.js?v=20201016"></script>
<script src="/assets/d2eace91/min/js/validate.min.js?v=20201016"></script>
<script>
    $().ready(function() {
        var validator = $("#AccountModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            $("#AccountModel").submit();
        });
    });
    // 
    $().ready(function() {
        $('.site_to_yikf').click(function() {
            $(this).parent('form').submit();
        })
    });
    // 
</script>
</body>
</html>
