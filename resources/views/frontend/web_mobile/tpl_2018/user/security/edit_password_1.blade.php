<div class="steps">
    <!-- 第一步验证身份 _start-->
    <div class="steps-con">
        <!--头部 _start-->
        @if($service_type == 'edit_mobile')
            <div class="step-info">
                <div class="stepflex">
                    <dl class="first doing">
                        <dt class="s-num">1</dt>
                        <dd class="s-text">
                            验证身份
                            <s></s>
                            <b></b>
                        </dd>
                    </dl>
                    <dl class="normal">
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
        @elseif($service_type == 'edit_email')
            <div class="step-info">
                <div class="stepflex">
                    <dl class="first doing">
                        <dt class="s-num">1</dt>
                        <dd class="s-text">
                            验证身份
                            <s></s>
                            <b></b>
                        </dd>
                    </dl>
                    <dl class="normal">
                        <dt class="s-num">2</dt>
                        <dd class="s-text">
                            绑定验证邮箱
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
        @elseif($service_type == 'edit_password')
            <div class="step-info">
                <div class="stepflex">
                    <dl class="first doing">
                        <dt class="s-num">1</dt>
                        <dd class="s-text">
                            验证身份
                            <s></s>
                            <b></b>
                        </dd>
                    </dl>
                    <dl class="normal">
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
        @elseif($service_type == 'edit_surplus_password')
            <div class="step-info">
                <div class="stepflex">
                    <dl class="first doing">
                        <dt class="s-num">1</dt>
                        <dd class="s-text">
                            验证身份
                            <s></s>
                            <b></b>
                        </dd>
                    </dl>
                    <dl class="normal">
                        <dt class="s-num">2</dt>
                        <dd class="s-text">
                            设置余额支付密码
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
        @elseif($service_type == 'close_surplus_password')
            <div class="step-info">
                <div class="stepflex">
                    <dl class="first doing">
                        <dt class="s-num">1</dt>
                        <dd class="s-text">
                            验证身份
                            <s></s>
                            <b></b>
                        </dd>
                    </dl>
                    <dl class="last">
                        <dt class="s-num">2</dt>
                        <dd class="s-text">
                            完成
                            <s></s>
                            <b></b>
                        </dd>
                    </dl>
                </div>
            </div>
        @endif
        <!--头部  end-->
        <form id="ValidateModel" class="form-horizontal" name="ValidateModel" action="/user/security/validate.html" method="post">
            @csrf
            <div class="middle-content safe-content">
                <div class="form-group-box">
                    <!--验证身份方式-->
                    <div class="form-group form-group-spe">
                        <dl>
                            <dt>
                                <span>验证身份：</span>
                            </dt>
                            <dd>
                                @if($type == 'mobile')
                                    <span class="select-info type">手机验证</span>
                                    <input type="hidden" id="type" class="form-control" name="ValidateModel[type]" value="mobile">
                                @else
                                    <span class="select-info type">登录密码验证</span>
                                    <input type="hidden" id="type" class="form-control" name="ValidateModel[type]" value="password">
                                @endif
                            </dd>
                        </dl>
                    </div>

                    @if($type == 'password')
                        <!--用户名-->
                        <div class="form-group form-group-spe">
                            <dl>
                                <dt>
                                    <span>用户名：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <span class="input-none">{{ $user_info->user_name }}</span>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <!--登录密码-->
                        <div class="form-group form-group-spe">
                            <dl>
                                <dt>
                                    <span>登录密码：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="password" id="pwd-input" class="form-control" name="ValidateModel[password]" autocomplete="off">
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="invalid"></div>
                        <div class="form-group form-group-spe" style="display: none;">
                            <dl>
                                <dt>
                                    <span>图片验证码：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="text" id="captcha" class="input-small" name="ValidateModel[captcha]" disabled="">
                                        <label class="captcha">
                                            <img id="captcha-image" class="captcha-image" name="ValidateModel[captcha]" src="/site/captcha.html?v=5f9ead236c9fa" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer; margin-top: 8px;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                                        </label>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="invalid"></div>
                    @else
                        <div class="form-group form-group-spe">
                            <dl>
                                <dt>
                                    <span>手机号：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <span class="input-none">{{ hide_tel($user_info->mobile) }}</span>
                                        <input type="hidden" id="validatemodel-mobile" class="form-control" name="ValidateModel[mobile]" value="{{ $user_info->mobile }}">
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="form-group form-group-spe" style="display: none;">
                            <dl>
                                <dt>
                                    <span>图片验证码：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="text" id="captcha" class="input-small" name="ValidateModel[captcha]" disabled>
                                        <label class="captcha">
                                            <img id="captcha-image" class="captcha-image" name="ValidateModel[captcha]" src="/site/captcha.html?v=5f9eab2fae8aa" alt="点击换图" title="点击换图" style="vertical-align: middle; cursor: pointer; margin-top: 8px;"><script data-captcha-id="captcha-image" type="text">{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}</script>
                                        </label>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="invalid"></div>
                        <div class="form-group form-group-spe" >
                            <dl>
                                <dt>
                                    <span>验证码：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="number" id="sms_captcha" class="input-small" name="ValidateModel[sms_captcha]" pattern="[0-9]*" tabindex="3" placeholder="动态验证码">
                                        <a id="btn_send_sms_code" href="javascript:void(0);" class="phonecode">获取手机验证码</a>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="invalid"></div>
                    @endif
                </div>
                <!--按钮-->
                <div class="submit-btn">
                    <a class="btn-submit" id="btn_validate" href="javascript:void(0)">下一步</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="select-layer hide">
    <div class="select-layer-con">
        <div class="select-layer-title">请选择验证身份方式</div>
        <ul class="select-layer-info">
            <li data-value="password" class="@if($type == 'password'){{ 'seleted' }}@endif">登录密码验证</li>
            <li data-value="mobile" class="@if($type == 'mobile'){{ 'seleted' }}@endif">手机验证</li>
        </ul>
        <a class="close-select-layer" id="cancel" href="javascript:void(0)">取消</a>
    </div>
</div>
<!-- 表单验证 -->
<script id="client_rules" type="text">
[{"id": "validatemodel-type", "name": "ValidateModel[type]", "attribute": "type", "rules": {"required":true,"messages":{"required":"验证身份不能为空。"}}},{"id": "validatemodel-captcha", "name": "ValidateModel[captcha]", "attribute": "captcha", "rules": {"required":true,"messages":{"required":"图片验证码不能为空。"}}},{"id": "validatemodel-captcha", "name": "ValidateModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":419,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},{"id": "validatemodel-mobile", "name": "ValidateModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"手机号不能为空。"}}},{"id": "validatemodel-sms_captcha", "name": "ValidateModel[sms_captcha]", "attribute": "sms_captcha", "rules": {"required":true,"messages":{"required":"验证码不能为空。"}}},]
</script>
<script type="text/javascript">
    //
</script><script src="/assets/d2eace91/min/js/validate.min.js?v=20201016"></script>
<script>

    $().ready(function(){
        var validator = $("#ValidateModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        $("#ValidateModel").submit(function() {

            return true;
        });

        $("#btn_validate").click(function(){
            if(!validator.form()){
                return false;
            }

            $.loading.start();

            var data = $("#ValidateModel").serializeJson ();
            $.post('/user/security/validate.html', data, function(result){
                if(result.code == 0){
                    $("#safe-info").html(result.data);
                }else{
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function(){
                $.loading.stop();
            });
        });

        $("#btn_send_sms_code").click(function(){

            if($(this).hasClass('disabled') || $(this).data("doing") == true){
                return;
            }

            var captcha_valid = true;
            if($("#captcha").is(":visible") && $("#captcha").size() > 0){
                captcha_valid = $("#captcha").valid();
            }

            if(captcha_valid){

                var target = this;

                $(this).data("doing", true);

                $.loading.start();

                $.validator.clearError($("#sms_captcha"));

                $.post('/user/security/sms-captcha', {
                    captcha: $("#captcha").val()
                }, function(result){
                    if(result.code == 0){
// 开始倒计时
                        countdown(target, "获取手机验证码");
                    }else{
                        var show_captcha = result.data && result.data.show_captcha ? true : false;

                        if(show_captcha){
                            $("#captcha").parents(".form-group").show();
                            $("#captcha").focus();
                            $("#captcha-image").click();
                            $("#captcha").val("");
                            $("#captcha").prop("disabled", false);
                        }

                        if (result.data && result.data.field) {
                            var errors = {};
                            errors["ValidateModel["+result.data.field+"]"] = result.message;
                            validator.showErrors(errors);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                    $(target).data("doing", false);
                }, "json").always(function(){
                    $.loading.stop();
                });
            }else{
                $("#captcha").focus();
            }
        });

        var wait = 60;
        function countdown(obj, msg) {
            obj = $(obj);

            if (wait <= 0) {
                obj.removeClass('disabled');
                obj.html(msg);
                wait = 60;
            } else {
                if (msg == undefined || msg == null) {
                    msg = obj.html();
                }
                obj.addClass('disabled');
                obj.html(wait + "秒后重新获取");
                wait--;
                setTimeout(function() {
                    countdown(obj, msg)
                }, 1000)
            }
        }

        $('.select-info').click(function(){
            $('.select-layer').removeClass('hide');
        });

        $("input").watch();
    });


    //
</script>