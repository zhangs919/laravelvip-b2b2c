<div id="{{ $uuid }}">
    <form id="ValidateModel" class="form-horizontal" name="ValidateModel" action="/system/admin/edit-password" method="post">
        @csrf
        <div class="table-content m-t-30 clearfix" style="padding-bottom:60px;">
            <!-- 原始密码 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="validatemodel-password" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">原密码：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="password" id="validatemodel-password" class="form-control w250" name="ValidateModel[password]">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 新密码 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="validatemodel-newpassword" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">新密码：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="password" id="validatemodel-newpassword" class="form-control w250" name="ValidateModel[newpassword]">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 确认密码 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="validatemodel-qrpassword" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">确认密码：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="password" id="validatemodel-qrpassword" class="form-control w250" name="ValidateModel[qrpassword]">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn_submit">确定</button>
                <button type="button" class="btn btn-default btn_cancel" data-dismiss="modal">取消</button>
            </div>
        </div>
    </form>
</div>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180418"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180418"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180418"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "validatemodel-password", "name": "ValidateModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"原密码不能为空。"}}},{"id": "validatemodel-newpassword", "name": "ValidateModel[newpassword]", "attribute": "newpassword", "rules": {"required":true,"messages":{"required":"新密码不能为空。"}}},{"id": "validatemodel-qrpassword", "name": "ValidateModel[qrpassword]", "attribute": "qrpassword", "rules": {"required":true,"messages":{"required":"确认密码不能为空。"}}},{"id": "validatemodel-password", "name": "ValidateModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"原密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"原密码不能包含空格。"}}},{"id": "validatemodel-newpassword", "name": "ValidateModel[newpassword]", "attribute": "newpassword", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"新密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"新密码不能包含空格。"}}},{"id": "validatemodel-qrpassword", "name": "ValidateModel[qrpassword]", "attribute": "qrpassword", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"确认密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"确认密码不能包含空格。"}}},{"id": "validatemodel-qrpassword", "name": "ValidateModel[qrpassword]", "attribute": "qrpassword", "rules": {"compare":{"operator":"==","type":"string","compareAttribute":"validatemodel-newpassword","skipOnEmpty":1},"messages":{"compare":"确认密码与新密码不一致"}}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#ValidateModel").validate();
        var container = $("#{{ $uuid }}");

// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#{{ $uuid }}").find(".btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            $.loading.start();

            var data = $(container).serializeJson();

            $.post("/system/admin/edit-password", data, function(result) {
                if (result.code == 0) {
                    $.msg(result.message, {
                        time: 2000
                    }, function() {
                        $.go();
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function() {
                $.loading.stop();
            });
        });

        $("#{{ $uuid }}").find(".btn_cancel").click(function() {
            $.closeAll();
        })
    });
</script>