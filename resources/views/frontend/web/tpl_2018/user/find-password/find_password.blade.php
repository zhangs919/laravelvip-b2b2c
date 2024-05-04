
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
                        <dl class="first  doing ">
                            <dt class="s-num">1</dt>
                            <dd class="s-text">
                                账户名
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                        <dl class="normal ">
                            <dt class="s-num">2</dt>
                            <dd class="s-text">
                                验证身份
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                        <dl class="normal ">
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
                    <form id="AccountModel" class="form-horizontal" name="AccountModel" action="/user/find-password.html" method="post">
                        @csrf
                        <div class="form-group form-group-spe" >
                            <label for="accountmodel-username" class="input-left">
                                <span class="spark">*</span>
                                <span>账户名：</span>
                            </label>
                            <div class="form-control-box">
                                <input type="text" id="accountmodel-username" class="form-control" name="AccountModel[username]" placeholder="用户名/邮箱/已验证手机">
                            </div>
                            <div class="invalid"></div>
                        </div><!-- 验证码 -->
                        <div class="form-group form-group-spe" >
                            <label for="accountmodel-captcha" class="input-left">
                                <span>验证码：</span>
                            </label>
                            <div class="form-control-box">
                                <input type="text" id="accountmodel-captcha" class="input-small" name="AccountModel[captcha]" placeholder="请输入验证码">
                                <label class="captcha">
                                    <img id="captcha-image" class="captcha-image" name="AccountModel[captcha]" src="/site/captcha.html?v={{ uniqid() }}" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;">
                                    <script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                                </label>
                            </div>
                            <div class="invalid"></div>
                        </div><div class="forget-btn">
                            <div class="form-group form-group-spe" >
                                <label for="" class="input-left">
                                </label>
                                <div class="form-control-box">
                                    <a href="javascript:void(0);" onclick="document.getElementById('btn_submit').click();" class="btn-img btn-entry bg-color">下一步</a>
                                    <div style="display: none;">
                                        <input type="submit" id="btn_submit" name="btn_submit" />
                                    </div>
                                </div>
                                <div class="invalid"></div>
                            </div></div>
                    </form>
                    <!-- 验证码脚本 -->
                    <!-- 表单验证 -->
                    <!-- 验证规则 -->
                    <script id="client_rules" type="text">
[{"id": "accountmodel-user_id", "name": "AccountModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"User Id必须是整数。"}}},{"id": "accountmodel-username", "name": "AccountModel[username]", "attribute": "username", "rules": {"required":true,"messages":{"required":"请输入您的用户名/邮箱/已验证手机"}}},{"id": "accountmodel-password", "name": "AccountModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"新密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"新密码不能包含空格。"}}},{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入验证码"}}},
{{--{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":457,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},--}}
]
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

<script type="text/javascript">
    //
</script>
<!-- 底部 _end-->
<script src="/assets/d2eace91/js/jquery.lazyload.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.cookie.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.history.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/szy.page.more.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/placeholder.js?v=202003261806"></script>
<script src="/js/login.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/common.js?v=202003261806"></script>
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
            if (!validator.form()) {
                return;
            }
            $("#AccountModel").submit();
        });
    });
    //
</script>
</body>
</html>
