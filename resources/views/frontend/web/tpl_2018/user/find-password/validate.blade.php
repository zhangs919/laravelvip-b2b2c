
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
                        <dl class="normal  doing ">
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
                    <form id="AccountModel" class="form-horizontal" name="AccountModel" action="/user/find-password/validate" method="post">
                        @csrf
                        <div class="form-group form-group-spe">
                            <label class="input-left">
                                <span>验证方式：</span>
                            </label>
                            <div class="form-control-box">
        <span class="select">
            <select id="sel_type">
                <option value="mobile">已验证的手机</option>
            </select>
        </span>
                            </div>
                        </div>
                        <div class="mobile">
                            <div class="form-group form-group-spe">
                                <label class="input-left">
                                    <span>已验证手机：</span>
                                </label>
                                <span class="input-none">{{ hide_tel(session('find_password_mobile')) }}</span>
                            </div>
                            <!-- 验证码 -->
                            <div class="form-group form-group-spe" style="display: none;">
                                <label for="accountmodel-captcha" class="input-left">
                                    <span class="spark">*</span>
                                    <span>验证码：</span>
                                </label>
                                <div class="form-control-box">
                                    <input type="text" id="captcha" class="input-small" name="AccountModel[captcha]" disabled maxlength="4">
                                    <label class="captcha">
                                        <img id="captcha-image" class="captcha-image" name="AccountModel[captcha]" src="/site/captcha.html?v=5f9ac262dfaa5" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;">
                                        <script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                                    </label>
                                </div>
                                <div class="invalid"></div>
                            </div>
                            <div class="form-group form-group-spe" >
                                <label for="accountmodel-sms_captcha" class="input-left">
                                    <span class="spark">*</span>
                                    <span>手机验证码：</span>
                                </label>
                                <div class="form-control-box">
                                    <input type="text" id="accountmodel-sms_captcha" class="input-small" name="AccountModel[sms_captcha]">
                                    <a href="javascript:void(0);" class="phonecode" id="get_phonecode">获取手机验证码</a>
                                </div>
                                <div class="invalid"></div>
                            </div></div>
                        <div class="forget-btn">
                            <a href="javascript:void(0);" onclick="document.getElementById('btn_submit').click();" class="btn-img btn-entry bg-color">下一步</a>
                            <div style="display: none;">
                                <input type="submit" id="btn_submit" name="btn_submit" />
                            </div>
                        </div>
                    </form><!-- 验证码脚本 -->
                    <!-- 表单验证 -->
                    <!-- 验证规则 -->
                    <script id="client_rules" type="text">
[{"id": "accountmodel-user_id", "name": "AccountModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"User Id必须是整数。"}}},{"id": "accountmodel-password", "name": "AccountModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^((?=[^\u4e00-\u9fa5\·]*[A-Za-z])(?=[^\u4e00-\u9fa5\·]*\d)|(?=[^\u4e00-\u9fa5\·]*[A-Za-z])(?=[^\u4e00-\u9fa5\·]*[$@$!%*#?&])|(?=[^\u4e00-\u9fa5\·]*\d)(?=[^\u4e00-\u9fa5\·]*[$@$!%*#?&]))[A-Za-z\d$@$!%*#?&]{8,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"新密码必须为8-20个字符，并且包含至少字母、数字、符号两种以上组合，区分大小写","match":"新密码不能包含空格。"}}},{"id": "accountmodel-sms_captcha", "name": "AccountModel[sms_captcha]", "attribute": "sms_captcha", "rules": {"required":true,"messages":{"required":"手机验证码不能为空。"}}},{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入验证码"}}},{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":443,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
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
        // 获取验证码链接点击事件
        $("#get_phonecode").click(function() {
            if ($(this).prop("disabled") == true || $(this).data("doing") == true) {
                return;
            }
            if ($(this).data("doing")) {
                return;
            }
            if ($("#captcha").is(":visible") && !$("#captcha").valid()) {
                $("#captcha").focus();
                return;
            }
            $(this).data("doing", true);
            // 获取短信验证码
            var target = this;
            var captcha = $("#captcha").val();
            $.loading.start();
            $.post('/user/find-password/sms-captcha', {
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
            }, "json").always(function() {
                $.loading.stop();
            });
        });
        // 获取验证码链接点击事件
        $("#get_emailcode").click(function() {
            // 验证失败
            if ($(this).prop("disabled") == true || $(this).data("doing") == true) {
                return;
            }
            if ($("#captcha").is(":visible") && !$("#captcha").valid()) {
                $("#captcha").focus();
                return;
            }
            $(this).data("doing", true);
            // 获取邮箱验证码
            var target = this;
            var captcha = $("#captcha").val();
            $.loading.start();
            $.post('/user/find-password/email-captcha', {
                captcha: captcha
            }, function(result) {
                if (result.code == 0) {
                    // 开始倒计时
                    countdown(target, "获取邮箱验证码");
                } else {
                    console.info(result);
                    if (result.code == 1) {
                        $.validator.showError($("#email_captcha"), result.message);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
                $(target).data("doing", false);
            }, "json").always(function() {
                $.loading.stop();
            });
        });
        //
        var wait = null;
        //
        function countdown(obj, msg) {
            obj = $(obj);
            if (wait === null) {
                wait = 60;
            }
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
        //
        if (wait !== null) {
            // 开始倒计时
            countdown($("#get_phonecode"), "获取手机验证码");
        }
        //
        $("#sel_type").change(function() {
            var type = $("#sel_type").val();
            location.href = "validate?type=" + type;
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
