
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>找回密码</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="wap-font-scale" content="no" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta name="is_frontend" content="yes" />
    <meta name="is_web_mobile" content="yes" />
    <meta name="is_webp" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="m_main_color" content="" />
    <!--整站改色 _start-->
    <link href="/css/common.css?v=2.0" rel="stylesheet">
    <link href="/css/forget-password.css?v=2.0" rel="stylesheet">
    <link href="/css/color-style.css?v=2.0" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=202003261806"></script>
</head>
<body>
<header id="header" class="header">
    <div class="header-left">
        <a href="javascript:history.back(-1)" class="sb-back">
            <i class="iconfont">&#xe606;</i>
        </a>
    </div>
    <div class="header-middle">找回密码</div>
</header>
<div class="middle-content">
    <!--第一步start-->
    <form id="AccountModel" class="form-horizontal" name="AccountModel" action="/user/find-password" method="post">
        @csrf
        <div class="form-group form-group-spe" >
            <dl>
                <dt>
                    <span>账户名：</span>
                </dt>
                <dd>
                    <div class="form-control-box">
                        <input type="text" id="accountmodel-username" class="form-control" name="AccountModel[username]" placeholder="用户名/邮箱/已验证手机">
                    </div>

                    @if(!empty(session('error')))
                    <span class="form-control-error">
                        <i></i>
                        {{ session('error') }}
                    </span>
                    @endif
                </dd>
            </dl>
        </div>
        <div class="invalid"></div>
        <div class="submit-btn">
            <!--通过disable控制按钮变灰-->
            <a class="btn-submit disable" id="btn_submit">下一步</a>
        </div>
    </form>    <!--第一步end-->
</div>
<!-- 验证码脚本 -->
<!-- 表单验证 -->
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "accountmodel-user_id", "name": "AccountModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"User Id必须是整数。"}}},{"id": "accountmodel-username", "name": "AccountModel[username]", "attribute": "username", "rules": {"required":true,"messages":{"required":"请输入您的用户名/邮箱/已验证手机"}}},{"id": "accountmodel-password", "name": "AccountModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"新密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"新密码不能包含空格。"}}},{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入验证码"}}},{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":400,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
</script>
<script type="text/javascript">
    // 
</script>
<script src="/assets/d2eace91/js/jquery.lazyload.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.cookie.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.history.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/szy.page.more.js?v=202003261806"></script>
<script src="/js/common.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.captcha.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/validate/jquery.metadata.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=202003261806"></script>
<script>
    $().ready(function() {
        var validator = $("#AccountModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form() || $(this).hasClass('disable')) {
                return;
            }
            $("#AccountModel").submit();
        });
        $("input:text").watch(function(input) {
            var flag = true;
            $.each($(this).parents('.form-control-box').find('input'), function() {
                if ($(this).val() == '') {
                    flag = false;
                }
            });
            if (input.valid() && flag == true) {
                $("#AccountModel").find('.btn-submit').removeClass('disable');
            } else {
                $("#AccountModel").find('.btn-submit').addClass('disable');
            }
        });
    });
    // 
</script>
</body>
</html>
