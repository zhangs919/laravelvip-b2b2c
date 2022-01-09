<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">商户号：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input class="form-control" type="text" name="mchid" value="{{ $info->pay_config[0]['config_value'] ?? ''}}" data-rule-required="true">

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="mchid">
    <input type="hidden" name="pay_type[]" value="text">
</div>


<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">签名证书：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <div class="file-attach-1">
                    <div class="file-attach-2">
                        <i class="fa fa-upload"></i>
                        上传附件
                    </div>
                    <input class="inputstyle valid upload-file" data-id="sdk_sign_cert_path" type="file" name="sdk_sign_cert_path">
                    <input type="hidden" id="sdk_sign_cert_path" name="sdk_sign_cert_path_file" value="{{ $info->pay_config[1]['config_value'] ?? ''}}">

                </div>

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="sdk_sign_cert_path">
    <input type="hidden" name="pay_type[]" value="file-button">
</div>


<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">签名证书密码：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input class="form-control" type="text" name="sdk_sign_cert_pwd" value="{{ $info->pay_config[2]['config_value'] ?? ''}}" data-rule-required="true">

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="sdk_sign_cert_pwd">
    <input type="hidden" name="pay_type[]" value="text">
</div>