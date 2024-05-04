<div class="stepflex">
    <dl id="dl_1" class="first">
        <dt class="s-num">1</dt>
        <dd class="s-text">
            验证身份
            <s></s>
            <b></b>
        </dd>
    </dl>
    <dl id="dl_2" class="normal doing">
        <dt class="s-num">2</dt>
        <dd class="s-text">
            绑定验证手机号码
            <s></s>
            <b></b>
        </dd>
    </dl>
    <dl id="dl_3" class="last">
        <dt class="s-num">3</dt>
        <dd class="s-text">
            完成
            <s></s>
            <b></b>
        </dd>
    </dl>
</div>
<form id="EditMobileModel" class="form-horizontal form-horizontal-security" name="EditMobileModel" action="/user/security/validate.html" method="post">
    @csrf
    <div class="form-group form-group-spe" >
        <label for="editmobilemodel-mobile" class="input-left">
            <span class="spark">*</span>
            <span>新手机号码：</span>
        </label>
        <div class="form-control-box">
            <input type="text" id="mobile" class="form-control" name="EditMobileModel[mobile]">
        </div>
        <div class="invalid"></div>
    </div>
    <div class="form-group form-group-spe" style="display: none;">
    <label for="editmobilemodel-captcha" class="input-left">
        <span>验证码：</span>
    </label>
    <div class="form-control-box">
        <input type="text" id="captcha" class="input-small" name="EditMobileModel[captcha]" disabled>
        <label class="captcha">
            <img id="captcha-image" class="captcha-image" name="EditMobileModel[captcha]" src="/site/captcha.html?v=5e0214f057ac2" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
        </label>
    </div>
    <div class="invalid"></div>
    </div>
    <div class="form-group form-group-spe" >
        <label for="editmobilemodel-sms_captcha" class="input-left">
            <span class="spark">*</span>
            <span>手机验证码：</span>
        </label>
        <div class="form-control-box">
            <input type="text" id="sms_captcha" class="input-small" name="EditMobileModel[sms_captcha]" tabindex="3" placeholder="动态验证码">
            <a id="btn_send_sms_code" href="javascript:void(0);" class="phonecode">获取短信校验码</a>
        </div>
        <div class="invalid"></div>
    </div>
    <div class="act">
        <input type="button" value="下一步" id="btn_submit">
    </div>
</form><!-- 表单验证 -->
<script id="client_rules" type="text/javascript">
    [{"id": "editmobilemodel-captcha", "name": "EditMobileModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入验证码"}}},{"id": "editmobilemodel-captcha", "name": "EditMobileModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":401,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},{"id": "editmobilemodel-mobile", "name": "EditMobileModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"请输入新手机号码"}}},{"id": "editmobilemodel-sms_captcha", "name": "EditMobileModel[sms_captcha]", "attribute": "sms_captcha", "rules": {"required":true,"messages":{"required":"请输入手机验证码"}}},{"id": "editmobilemodel-mobile", "name": "EditMobileModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166|191|167)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"新手机号码是无效的。"}}},{"id": "editmobilemodel-mobile", "name": "EditMobileModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/user/security/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcRWRpdE1vYmlsZU1vZGVs","attribute":"mobile","params":["EditMobileModel[mobile]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
</script>
<script type="text/javascript">
    // 
</script><script src="/assets/d2eace91/min/js/validate.min.js"></script>
<script>

    $().ready(function() {
        var validator = $("#EditMobileModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        $("#EditMobileModel").submit(function() {

            return true;
        });

        $("#btn_submit").click(function() {
            if(!validator.form()){
                return false;
            }
            var data = $("#EditMobileModel").serializeJson ();
            var service_type = 'edit_mobile';
            var s_type = service_type.replace(/_/g, '-');

            $.loading.start();

            $.post('/user/security/'+s_type, data, function(result){
                if (result.code == 0){
                    $("#safe-info").html(result.data);
                }else{
                    $.msg(result.message);
                }
            }, "json").always(function(){
                $.loading.stop();
            });
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
                    errors["EditMobileModel[" + result.data.field + "]"] = result.message;
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
    })

    // 
</script>