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
                        绑定验证手机号码
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
        <form id="EditMobileModel" class="form-horizontal form-horizontal-security" name="EditMobileModel" action="/user/security/validate.html" method="post">
            @csrf
            <div class="middle-content safe-content">
                <div class="form-group-box form-group-box-new">
                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>新手机号码：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">
                                    <input type="text" id="mobile" class="form-control" name="EditMobileModel[mobile]">
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"></div>
{{--                    <div class="form-group form-group-spe" style="display: none;">--}}
{{--                        <dl>--}}
{{--                            <dt>--}}
{{--                                <span>验证码：</span>--}}
{{--                            </dt>--}}
{{--                            <dd>--}}
{{--                                <div class="form-control-box">--}}
{{--                                    <input type="text" id="captcha" class="input-small" name="EditMobileModel[captcha]">--}}
{{--                                    <label class="captcha">--}}
{{--                                        <img id="captcha-image" class="captcha-image" name="EditMobileModel[captcha]" src="/site/captcha.html?v=5f9eb1b65e1e4" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </dd>--}}
{{--                        </dl>--}}
{{--                    </div>--}}
{{--                    <div class="invalid"></div>--}}
                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>手机验证码：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">
                                    <input type="number" id="sms_captcha" class="input-small" name="EditMobileModel[sms_captcha]" tabindex="3" placeholder="动态验证码" pattern="[0-9]*">
                                    <a id="btn_send_sms_code" href="javascript:void(0);" class="phonecode">获取短信校验码</a>
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
        </form>    </div>
</div>
<!-- 表单验证 -->
<script id="client_rules" type="text/javascript">
    [{"id": "editmobilemodel-captcha", "name": "EditMobileModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"请输入验证码"}}},{"id": "editmobilemodel-captcha", "name": "EditMobileModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":464,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},{"id": "editmobilemodel-mobile", "name": "EditMobileModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"请输入新手机号码"}}},{"id": "editmobilemodel-sms_captcha", "name": "EditMobileModel[sms_captcha]", "attribute": "sms_captcha", "rules": {"required":true,"messages":{"required":"请输入手机验证码"}}},{"id": "editmobilemodel-mobile", "name": "EditMobileModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|195|198|166|191|167)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"新手机号码是无效的。"}}},{"id": "editmobilemodel-mobile", "name": "EditMobileModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/user/security/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcRWRpdE1vYmlsZU1vZGVs","attribute":"mobile","params":["EditMobileModel[mobile]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
</script>
<script type="text/javascript">
    // 
</script><script src="/assets/d2eace91/min/js/validate.min.js?v=20201016"></script>
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
                    errors["EditMobileModel["+result.data+"]"] = result.message;
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