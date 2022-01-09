<input type="text" id="systemconfigmodel-aliyunsms_app_key" class="form-control" name="SystemConfigModel[aliyunsms_app_key]">

<input type="text" id="systemconfigmodel-captcha_sms_max" class="form-control ipt m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_max]" value="100">


<div class="simple-form-field">
    <div class="form-group">
        <label for="systemconfigmodel-captcha_sms_mobile_max" class="col-sm-4 control-label">

            <span class="ng-binding">每个手机号码地址短信验证码控制：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">



                同一业务内，每个&nbsp;&nbsp;手机号码&nbsp;&nbsp;在<input type="text" id="systemconfigmodel-captcha_sms_mobile_time" class="form-control ipt valid m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_mobile_time]" value="30">分钟内，发送短信验证码超过


                <input type="text" id="systemconfigmodel-captcha_sms_mobile_max" class="form-control ipt m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_mobile_max]" value="5">



                条，将被系统认定发送验证码过于频繁，限制<input type="text" id="systemconfigmodel-captcha_sms_mobile_interval" class="form-control ipt valid m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_mobile_interval]" value="30">分钟之后恢复正常


            </div>

            <div class="help-block help-block-t"><div class="help-block help-block-t">两次短信验证码发送的时间间隔为60秒</div></div>
        </div>
    </div>
</div>