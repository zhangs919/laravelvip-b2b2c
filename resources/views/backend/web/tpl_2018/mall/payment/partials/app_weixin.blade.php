<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">AppID：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input class="form-control" type="text" name="appid" value="{{ $info->pay_config[0]['config_value'] ?? ''}}" data-rule-required="true">

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="appid">
    <input type="hidden" name="pay_type[]" value="text">
</div>


<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">AppSecret：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input class="form-control" type="text" name="appsecret" value="{{ $info->pay_config[1]['config_value'] ?? ''}}" data-rule-required="true">

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="appsecret">
    <input type="hidden" name="pay_type[]" value="text">
</div>


<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">商户号：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input class="form-control" type="text" name="mchid" value="{{ $info->pay_config[2]['config_value'] ?? ''}}" data-rule-required="true">

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
            <span class="ng-binding">初始密钥：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input class="form-control" type="text" name="key" value="{{ $info->pay_config[3]['config_value'] ?? ''}}" data-rule-required="true">

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
            <span class="ng-binding">退款证书key：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <div class="file-attach-1">
                    <div class="file-attach-2">
                        <i class="fa fa-upload"></i>
                        上传附件
                    </div>
                    <input class="inputstyle valid upload-file" data-id="apiclient_key" type="file" name="apiclient_key">
                    <input type="hidden" id="apiclient_key" name="apiclient_key_file" value="{{ $info->pay_config[4]['config_value'] ?? ''}}">

                </div>

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="apiclient_key">
    <input type="hidden" name="pay_type[]" value="file-button">
</div>


<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <!--<span class="text-danger ng-binding">*</span>-->
            <span class="ng-binding">退款证书cert：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <div class="file-attach-1">
                    <div class="file-attach-2">
                        <i class="fa fa-upload"></i>
                        上传附件
                    </div>
                    <input class="inputstyle valid upload-file" data-id="apiclient_cert" type="file" name="apiclient_cert">
                    <input type="hidden" id="apiclient_cert" name="apiclient_cert_file" value="{{ $info->pay_config[5]['config_value'] ?? ''}}">

                </div>

                <div class="help-block help-block-t">
                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="pay_name[]" value="apiclient_cert">
    <input type="hidden" name="pay_type[]" value="file-button">
</div>