
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
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v={{ time() }}" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v={{ time() }}" id="site_style"/>
    @endif
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
<div class="middle-content forget-content">
    <!--第二步start-->
    <form id="AccountModel" class="form-horizontal" name="AccountModel" action="/user/find-password/validate" method="post">
        @csrf
        <p class="page-notice">验证码已发送到{{ hide_tel(session('mobile')) }}的手机上</p>
        <!-- 验证码 -->
        <div class="form-group form-group-spe" style="display: none;">
            <dl>
                <dt>
                    <span>验证码：</span>
                </dt>
                <dd>
                    <div class="form-control-box">
                        <input type="text" id="captcha" class="input-small" name="AccountModel[captcha]" disabled maxlength="4">
                        <label class="captcha">
                            <img id="captcha-image" class="captcha-image" name="AccountModel[captcha]" src="/site/captcha.html?v=5e8b1781ccb44" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                        </label>
                    </div>
                </dd>
            </dl>
        </div>
        <div class="invalid"></div>
        <div class="form-group form-group-spe" >
            <dl>
                <dt>
                    <span>手机验证码：</span>
                </dt>
                <dd>
                    <div class="form-control-box">
                        <input type="text" id="accountmodel-sms_captcha" class="input-small" name="AccountModel[sms_captcha]">
                        <a href="javascript:void(0);" class="phonecode" id="get_phonecode">手机验证码</a>
                    </div>
                </dd>
            </dl>
        </div>
        <div class="invalid"></div>    <div class="submit-btn">
            <a class="btn-submit disable" id="btn_submit">下一步</a>
        </div>
    </form>    <!--第二步end-->
</div>
<!-- 验证码脚本 -->
<!-- 表单验证 -->
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "accountmodel-user_id", "name": "AccountModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"User Id必须是整数。"}}},{"id": "accountmodel-password", "name": "AccountModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"新密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"新密码不能包含空格。"}}},{"id": "accountmodel-sms_captcha", "name": "AccountModel[sms_captcha]", "attribute": "sms_captcha", "rules": {"required":true,"messages":{"required":"手机验证码不能为空。"}}},{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入验证码"}}},{"id": "accountmodel-captcha", "name": "AccountModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":449,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
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
        // 获取验证码链接点击事件
        $("#get_phonecode").click(function() {
            // 验证失败
            if ($(this).hasClass("disable") == true || $(this).data("doing") == true) {
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
            $.post('sms-captcha', {
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
        $("#get_emailcode").click(function() {
            // 验证失败
            if ($(this).hasClass("disable") == true || $(this).data("doing") == true) {
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
            $.post('email-captcha', {
                captcha: captcha
            }, function(result) {
                if (result.code == 0) {
                    // 开始倒计时
                    countdown(target, "获取邮箱验证码");
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
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
                obj.removeClass("disable");
                obj.html(msg);
                wait = 60;
            } else {
                if (msg == undefined || msg == null) {
                    msg = obj.html();
                }
                obj.addClass("disable");
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
            $.go("step_2?type=" + type);
        });
    });
    // 
</script>
</body>
</html>
