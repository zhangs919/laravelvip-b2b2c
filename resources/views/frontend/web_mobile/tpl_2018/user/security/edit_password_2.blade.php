<div class="steps">
    <!-- 第一步验证身份 _start-->
    <div class="steps-con">
        <!--头部 _start-->
        <div class="step-info">
            <div class="stepflex">
                <dl class="first done">
                    <dt class="s-num">1</dt>
                    <dd class="s-text">
                        验证身份
                        <s></s>
                        <b></b>
                    </dd>
                </dl>
                <dl class="normal doing">
                    <dt class="s-num">2</dt>
                    <dd class="s-text">
                        设置登录密码
                        <s></s>
                        <b></b>
                    </dd>
                </dl>
                <dl class="last">
                    <dt class="s-num">3</dt>
                    <dd class="s-text">
                        完成
                        <s></s>
                        <b></b>
                    </dd>
                </dl>
            </div>
        </div>
        <form id="EditPasswordModel" class="form-horizontal form-horizontal-security" name="EditPasswordModel" action="/user/security/validate.html" method="post">
            @csrf
            <div class="middle-content safe-content">
                <div class="form-group-box form-group-box-new">
                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>登录密码：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">
                                    <input type="password" id="pwd-input" class="form-control" name="EditPasswordModel[password]" autocomplete="off">
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"></div>
                    <div class="submit-btn">
                        <a class="btn-submit" id="btn_submit" href="javascript:void(0)">下一步</a>
                    </div>
                </div>
            </div>
        </form>    
    </div>
</div>
<!-- 表单验证 -->
<script id="client_rules" type="text/javascript">
    [{"id": "editpasswordmodel-password", "name": "EditPasswordModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"请输入登录密码"}}},{"id": "editpasswordmodel-captcha", "name": "EditPasswordModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入验证码"}}},{"id": "editpasswordmodel-password", "name": "EditPasswordModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"登录密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"登录密码不能包含空格。"}}},{"id": "editpasswordmodel-captcha", "name": "EditPasswordModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":417,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
</script>
<script type="text/javascript">
    // 
</script><script src="/assets/d2eace91/min/js/validate.min.js?v=20201016"></script>
<script>

    $().ready(function() {
        var validator = $("#EditPasswordModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        $("#EditPasswordModel").submit(function() {

            return true;
        });

        $("#btn_submit").click(function() {
            if(!validator.form()){
                return false;
            }
            var data = $("#EditPasswordModel").serializeJson ();
            var service_type = 'edit_password';
            var s_type = service_type.replace(/_/g, '-');

            $.post('/user/security/'+s_type, data, function(result){
                $("#safe-info").html(result.data);
                if (result.code == '-1')
                {
                    $.msg(result.message);
                }
            }, "json");
        })


        $("#btn_send_sms_code").click(function(){

            if($(this).prop("disabled") == true || $(this).data("doing") == true){
                return;
            }

            if($("#mobile").size() > 0 &&　!$("#mobile").valid()){
                $("#mobile").focus();
                return;
            }

            if($("#captcha").size() > 0 && !$("#captcha").valid()){
                $("#captcha").focus();
                return;
            }

            var target = this;

            $(this).data("doing", true);

            $.validator.clearError($("#sms_captcha"));

            $.post('/user/security/sms-captcha', {
                captcha: $("#captcha").val(),
                mobile: $("#mobile").val()
            }, function(result){
                if(result.code == 0){
// 开始倒计时
                    countdown(target, "获取手机验证码");
                }else{
// 失败后点击验证码
                    if($("#captcha-image").size() > 0){
                        $("#captcha").val("");
                        $("#captcha-image").click();
                    }
                    var errors = {};
                    errors["EditPasswordModel["+result.data+"]"] = result.message;
                    validator.showErrors(errors);
                }
                $(target).data("doing", false);
            }, "json");
        });

        var wait = 60;
        function countdown(obj, msg) {
            obj = $(obj);

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

        $("input").watch();
    })

    // 
</script>