<div id="{{ $uid }}" class="table-content m-t-10 clearfix" style="min-height:290px">
    <form id="AdminLoginModel" class="backend-form-login" name="AdminLoginModel" action="/login.html" method="post">
        {{ csrf_field() }}
        <!-- 用户名 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="adminloginmodel-username" class="0 control-label">
                    <span class="text-danger ng-binding">*</span>

                </label>
                <div class="12">
                    <div class="form-control-box">

                        <div class="input-item-box">
                            <i class="icon user-name"></i>
                            <input type="text" id="adminloginmodel-username" class="form-control" name="AdminLoginModel[user_name]" placeholder="请输入帐号名称">
                        </div>


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
        <!-- 密码 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="password" class="0 control-label">


                </label>
                <div class="12">
                    <div class="form-control-box">

                        <div class="input-item-box">
                            <i class="icon user-pwd"></i>
                            <input type="password" id="adminloginmodel-password" class="form-control" name="AdminLoginModel[password]" placeholder="请输入密码">
                        </div>


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>

        <div class="safety">
            <!-- <label class="cur-p">
            <input type="checkbox" name="remberme" class="m-r-5" />
            <span>记住密码</span>
            </label> -->
            <a href="/find-password.html" class="pull-right forget-password" target="_blank">忘记密码？</a>
        </div>

        <div class="login-btn m-t-5">
            <a href="javascript:void(0);" id="btn_submit_{{ $uid }}" class="form-login-btn">立即登录</a>
        </div>

        <input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">
        <input type="hidden" name="ajax_layout" value="1">
    </form>
</div>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180528"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180528"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180528"></script>
<script src="/assets/d2eace91/js/jquery.captcha.js?v=20180528"></script>
<!-- 验证规则 -->
<script id="client_rules_{{ $uid }}" type="text">
[{"id": "adminloginmodel-username", "name": "AdminLoginModel[username]", "attribute": "username", "rules": {"required":true,"messages":{"required":"请输入用户名"}}},{"id": "adminloginmodel-password", "name": "AdminLoginModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"请输入密码"}}},{"id": "adminloginmodel-username", "name": "AdminLoginModel[username]", "attribute": "username", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","maxlength":"用户名长度必需在100以内"},"maxlength":50}},{"id": "adminloginmodel-password", "name": "AdminLoginModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"密码必须是一条字符串。","maxlength":"密码长度必需在32以内"},"maxlength":32}},{"id": "adminloginmodel-rememberme", "name": "AdminLoginModel[rememberMe]", "attribute": "rememberMe", "rules": {"boolean":{"trueValue":"1","falseValue":"0"},"messages":{"boolean":"记住用户名密码必须要么为\"1\"，要么为\"0\"。"}}},]
</script>
<script>
    $().ready(function() {

        $("#captcha-image").click();

        var validator = $("#AdminLoginModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules_{{ $uid }}").html());
        $("#btn_submit_{{ $uid }}").click(function() {
            if (!validator.form()) {
                return;
            }

            $.loading.start();

            var data = $("#AdminLoginModel").serializeJson();

            $.post("/login.html", data, function(result) {
                if (result.code == 0) {
                    $.msg(result.message);
                    if ($.login) {
// 关闭
                        $.login.close();
// 回调
                        if ($.isFunction($.login.success)) {
                            $.login.success.call(this, result);
                        }
                    }
                } else {
                    $("#{{ $uid }}").replaceWith(result.data);
                }
            }, "JSON").always(function() {
                $.loading.stop();
            });
        });

// 表单第一项获取焦点
        $("form").find(":input").not(":hidden").first().focus();

        $("body").keypress(function(e) {
            if (e.keyCode == 13) {
                $("#btn_submit_{{ $uid }}").click();
                return false;
            }
        });
    });
</script>