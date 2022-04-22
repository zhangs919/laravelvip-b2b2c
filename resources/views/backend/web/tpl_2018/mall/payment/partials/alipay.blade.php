<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">支付宝帐号：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input class="form-control" type="text" name="seller_email" value="{{ $info->pay_config[0]['config_value'] ?? ''}}" data-rule-required="true">

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="seller_email">
    <input type="hidden" name="pay_type[]" value="text">
</div>


<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">合作者身份ID：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input class="form-control" type="text" name="partner" value="{{ $info->pay_config[1]['config_value'] ?? ''}}" data-rule-required="true">

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="partner">
    <input type="hidden" name="pay_type[]" value="text">
</div>


<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">安全校验码：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input class="form-control" type="text" name="key" value="{{ $info->pay_config[2]['config_value'] ?? ''}}" data-rule-required="true">

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="key">
    <input type="hidden" name="pay_type[]" value="text">
</div>


<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">商家私钥：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <textarea class="form-control" name="private_key" rows="5" cols="43">{{ $info->pay_config[3]['config_value'] ?? ''}}</textarea>

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t">确保秘钥完整，并没有空格，app中使用支付宝，需设置此项！</div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="private_key">
    <input type="hidden" name="pay_type[]" value="textarea">
</div>