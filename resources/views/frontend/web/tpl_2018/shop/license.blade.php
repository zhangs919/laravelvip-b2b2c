<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>工商资质</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <link rel="stylesheet" href="/frontend/css/license.css?v=20181217"/>
</head>
<body>

<div class="bomb-box-mod">
    <div class="bomb-box">
        <h5>网店经营者营业执照信息</h5>
        <div class="content">
            <div class="box-hd">
                <h3>{{ sysconf('site_name') }}经营者营业执照信息</h3>
                <p>根据国家工商总局《网络交易管理办法》要求对网店营业执照信息公示如下：</p>
            </div>
            <div class="check">
                <form id="CaptchaModel" class="form-horizontal" name="CaptchaModel" action="/shop/index/license.html?id=1&amp;code=special_aptitude" method="post">
                    {{ csrf_field() }}

                    <div class="form-group form-group-spe" >
                        <label for="captchamodel-captcha" class="input-left">

                            <span>请输入图中的验证码后查看：</span>
                        </label>
                        <div class="form-control-box">


                            <input type="text" id="captcha" class="input-small" name="CaptchaModel[captcha]">
                            <label class="captcha">

                                <img id="captcha-image" class="captcha-image" name="CaptchaModel[captcha]" src="/site/captcha.html?v=5c2048f2d42a6" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                            </label>

                        </div>

                        <div class="invalid"></div>
                    </div>

                    <div class="form-group form-group-spe" >
                        <label for="" class="input-left">


                        </label>
                        <div class="form-control-box">

                            <input type="button" class="btn" id="btn_submit" name="btn_submit" value="提交">

                        </div>

                        <div class="invalid"></div>
                    </div> </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script src="/assets/d2eace91/js/jquery-1.9.1.min.js?v=2018121902"></script>
<!-- 验证码脚本 -->
<script src="/assets/d2eace91/js/jquery.captcha.js?v=2018121902"></script>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=2018121902"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=2018121902"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=2018121902"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "captchamodel-captcha", "name": "CaptchaModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":436,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#CaptchaModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            $("#CaptchaModel").submit();
            return false;
        });
    });
</script>
