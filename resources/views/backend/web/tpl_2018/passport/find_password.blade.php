
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>找回密码</title>
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <!-- ================== BEGIN BASE  ================== -->
    <!-- ================== END BASE  ================== -->
    <link href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=1.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=1.0" rel="stylesheet">
    <link href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=1.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/animate.css?v=1.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/loading/loaders.css?v=1.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/common.css?v=1.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/styles.css?v=1.0" rel="stylesheet">
    <link href="/css/forget-password.css?v=1.0" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=202003261806"></script>
</head>
<body>
<div class="header">
    <div class="logo-info ">
        <a href="/" class="logo">
            <img src="{{ get_image_url(sysconf('backend_logo')) }}" />
        </a>
        <span class="findpw">平台方管理员-找回密码</span>
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
                    <!-- ================== BEGIN BASE  ================== -->
                    <!-- ================== END BASE  ================== -->
                    <form id="FindPwdModel" class="form-horizontal" name="FindPwdModel" action="/find-password.html" method="post">
                        @csrf
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="findpwdmodel-username" class="col-sm-4 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">账户名：</span>
                                </label>
                                <div class="col-sm-8">
                                    <div class="form-control-box">
                                        <input type="text" id="findpwdmodel-username" class="form-control" name="FindPwdModel[username]" placeholder="请输入用户名">
                                    </div>
                                    <div class="help-block help-block-t"></div>
                                </div>
                            </div>
                        </div><!-- 验证码 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="findpwdmodel-captcha" class="col-sm-4 control-label">
                                    <span class="ng-binding">验证码：</span>
                                </label>
                                <div class="col-sm-8">
                                    <div class="form-control-box">
                                        <input type="text" id="findpwdmodel-captcha" class="form-control ipt" name="FindPwdModel[captcha]" placeholder="请输入验证码">
                                        <label class="captcha">
                                            <img id="captcha-image" class="captcha-image" name="FindPwdModel[captcha]" src="/site/captcha.html?v=5e802961a18da" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                                        </label>
                                    </div>
                                    <div class="help-block help-block-t"></div>
                                </div>
                            </div>
                        </div><div class="forget-btn">
                            <div class="simple-form-field" >
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <a href="javascript:void(0);" onclick="document.getElementById('btn_submit').click();" class="btn-img btn-entry">下一步</a>
                                            <div style="display: none;">
                                                <input type="submit" id="btn_submit" name="btn_submit" />
                                            </div>
                                        </div>
                                        <div class="help-block help-block-t"></div>
                                    </div>
                                </div>
                            </div></div>
                    </form>
                    <!-- 验证码脚本 -->
                    <!-- 验证规则 -->
                    <script id="client_rules" type="text">
[{"id": "findpwdmodel-username", "name": "FindPwdModel[username]", "attribute": "username", "rules": {"required":true,"messages":{"required":"请输入用户名"}}},{"id": "findpwdmodel-captcha", "name": "FindPwdModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入验证码"}}},{"id": "findpwdmodel-captcha", "name": "FindPwdModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":447,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
</script>
                    <script type="text/javascript">
                        //
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-info">
    <div class="info-text">
        <p>
            {!! sysconf('site_copyright') !!}
            <a href="http://www.beian.miit.gov.cn/" target="_blank">{{ sysconf('site_icp') }}</a>
        </p>
        <p class="company-info" style="display: none;"></p>
        <p>Powered by <a href="http://www.laravelvip.com" target="_blank">乐融沃</a> ・ 云商城</p>
    </div>
</div>

<script src="/assets/d2eace91/js/jquery.lazyload.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.cookie.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.history.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/szy.page.more.js?v=202003261806"></script>
<script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/common.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/placeholder.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.captcha.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/validate/jquery.metadata.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=202003261806"></script>
<script>
    $().ready(function() {
        var validator = $("#FindPwdModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return false;
            }
            $("#FindPwdModel").submit();
        });
    });
    // 
</script>
</body>
</html>
