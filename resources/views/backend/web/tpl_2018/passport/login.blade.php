<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <title>
        {{ sysconf('site_name') }}平台管理中心 - 登录
    </title>
    <!-- 禁止搜索引擎收录 -->
    <meta name="robots" content="noarchive" />
    <meta name="baidspider" content="noarchive" />
    <meta name="googlebot" content="noarchive" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=1.2"/>
    <link rel="stylesheet" href="/css/login.css?v=1.2"/>
    <!-- [if lt IE 9]-->
    <script src="/assets/d2eace91/js/html5shiv.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/respond.min.js?v=1.2"></script>
    <!-- [endif] -->
    <script src="/assets/d2eace91/js/jquery.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.supersized.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.captcha.js?v=1.2"></script>
</head>
<body>
<!--[if IE]>
<div class="ie-warning" style="width:auto;">什么？您还在使用 Internet Explorer (IE) 浏览器？ 很遗憾，我们已不再支持IE浏览器。事实上，升级到以下支持HTML5的浏览器将获得更牛逼的操作体验：<a href="http://www.mozillaonline.com/">Firefox</a> / <a href="http://www.google.com/chrome/?hl=zh-CN">Chrome</a> / <a href="http://www.apple.com.cn/safari/">Safari</a> / <a href="http://www.operachina.com/">Opera</a>，
    赶紧升级浏览器，让操作效率提升80%-120%！
</div>
<![endif]-->




<div class="page-container">
    <div class="login-menu swing animated">
        <ul>
            <li class="current"><a class="blue-bg"  target="_blank" href="http://{{ config('lrw.backend_domain') }}"><i>☜</i>平台后台</a></li>
            <li><a class="green-bg"  target="_blank" href="http://{{ config('lrw.seller_domain') }}">商家后台</a></li>
            <li><a class="yellow-bg"  target="_blank" href="http://{{ config('lrw.store_domain') }}">网点后台</a></li>
        </ul>
    </div>
    <div class="center">
        <div class="logo-info">
            <a href="javascript:void(0);">
                <img src="{{ get_image_url(sysconf('backend_logo')) }}">
            </a>
            <p>{{ sysconf('site_name') }}平台系统管理中心</p>
        </div>
        <div class="line">
            <img src="/images/login/line.png">
        </div>
        <div class="form-info">
            <form id="AdminLoginModel" name="AdminLoginModel" action="{{ route('admin.login') }}" method="POST" autocomplete="off">
                @csrf
                <div class="input-text-box">
                    <div class="form-group">
                        <label class="tit">帐号</label>
                        <!-- 用户名 -->
                        <input type="text" id="adminloginmodel-username" class="username input-text" name="AdminLoginModel[user_name]" value="{{ old('AdminLoginModel.user_name') }}" autocomplete="off" placeholder="请输入用户名">
                    </div>
                    <div class="form-group">
                        <label class="tit">密码</label>
                        <!-- 密码 -->
                        <input type="password" id="adminloginmodel-password" class="username input-text" name="AdminLoginModel[password]" value="{{ old('AdminLoginModel.password') }}" autocomplete="off" placeholder="请输入密码 ">
                    </div>

                    <div class="form-group checkbox-signup">
                        <label class="check-label">
                            <input type="checkbox" name="remember" checked="checked" />
                            记住密码
                        </label>

                        <a class="forget-password" href="/find-password.html">忘记密码？</a>

                    </div>
                </div>
                <input type="button" id="btn_submit" class="submit" value="立即登录" />
            </form>
        </div>

    </div>
    <div class="bottom">
        <h6>
            {{--版权信息 备案号--}}
            {!! sysconf('site_copyright') !!}
            <font style="display: none">{{ sysconf('site_icp') }}</font>
        </h6>

    </div>
</div>
<script type="text/javascript">
    $(function() {

        var images = "{{ $login_bg }}".split("|");

        var slides = [];

        for(var i = 0; i < images.length; i++){
            slides.push({
                image: images[i]
            });
        }

        $.supersized({

            // 功能
            slide_interval: 4000,
            transition: 1,
            transition_speed: 1000,
            performance: 1,

            // 大小和位置
            min_width: 0,
            min_height: 0,
            vertical_center: 1,
            horizontal_center: 1,
            fit_always: 0,
            fit_portrait: 1,
            fit_landscape: 0,

            // 组件
            slide_links: 'blank',
            slides: slides
        });
    });

</script>
<ul class="quality" id="supersized">
</ul>
</body>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "adminloginmodel-username", "name": "AdminLoginModel[username]", "attribute": "username", "rules": {"required":true,"messages":{"required":"请输入用户名"}}},{"id": "adminloginmodel-password", "name": "AdminLoginModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"请输入密码"}}},{"id": "adminloginmodel-username", "name": "AdminLoginModel[username]", "attribute": "username", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","maxlength":"用户名长度必需在100以内"},"maxlength":50}},{"id": "adminloginmodel-password", "name": "AdminLoginModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"密码必须是一条字符串。","maxlength":"密码长度必需在32以内"},"maxlength":32}},{"id": "adminloginmodel-rememberme", "name": "AdminLoginModel[rememberMe]", "attribute": "rememberMe", "rules": {"boolean":{"trueValue":"1","falseValue":"0"},"messages":{"boolean":"记住用户名密码必须要么为\"1\"，要么为\"0\"。"}}},]
</script>
<!-- 错误模板 -->
<!--当显示的时候，tip-error样式为fadeInLeft;当隐藏的时候，样式为fadeOutLeft-->
<script id="error_template" type="text">
<div class="tip-error animated fadeInLeft" style="animation-duration: 0.2s;">
	<div class="tip-arrow"></div>
	<div class="tip-inner"></div>
</div>
</script>
<script type="text/javascript">
    $().ready(function() {

        if(top != window){
            top.location.href = "/login";
            return;
        }

        var error_template = $("#error_template").html();

        /**
         * 初始化validator默认值
         */
        $.validator.setDefaults({
            errorPlacement: function(error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");

                if ($.trim(error_msg) == 0) {
                    return;
                }

                var error_dom = $("[id='" + error_id + "']");

                if (error_dom.size() > 0) {
                    $(error_dom).removeClass("fadeOutLeft");
                    $(error_dom).addClass("fadeInLeft");
                } else {
                    error_dom = $($.parseHTML(error_template));
                    $(error_dom).attr("id", error_id);
                    $(error_dom).find(".tip-inner").html(error_msg);
                    $(element).after(error_dom);
                }
            },
            // 失去焦点验证
            onfocusout: function(element) {
                $(element).valid();
            },
            // 成功后移除错误提示
            success: function(error) {
                var error_id = $(error).attr("id");
                var element_id = $(error).attr("for");

                var error_dom = $("[id='" + error_id + "']");

                if (error_dom.size() > 0) {
                    $(error_dom).removeClass("fadeInLeft");
                    $(error_dom).addClass("fadeOutLeft");
                }
            }
        });

        var validator = $("#AdminLoginModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            //加载提示
            $("#AdminLoginModel").submit();
        });

        /*错误提示*/
        @include('components.errors')

        // 表单第一项获取焦点
        $("form").find(":input").not(":hidden").first().focus();

        $("body").keypress(function(e){
            if(e.keyCode == 13){
                $("#btn_submit").click();
            }
        });
    });
</script>
</html>
