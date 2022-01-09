<div id="{{ $uuid }}">


    <div class="table-content m-t-10 clearfix">
        <form id="TplBackup" class="form-horizontal" name="TplBackup" action="/site/tpl-backup" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="hidden" name="action" value="backup">
            <input type="hidden" id="tplbackup-page" class="form-control" name="TplBackup[page]" value="">
            <input type="hidden" id="tplbackup-topic_id" class="form-control" name="TplBackup[topic_id]" value="0">

            <input type="hidden" id="tplbackup-back_id" class="form-control" name="TplBackup[back_id]">
            <!-- 名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="tplbackup-name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">备份名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="tplbackup-name" class="form-control" name="TplBackup[name]">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 备注 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="tplbackup-remark" class="col-sm-4 control-label">

                        <span class="ng-binding">备注信息：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="tplbackup-remark" class="form-control" name="TplBackup[remark]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 备份类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="tplbackup-type" class="col-sm-4 control-label">

                        <span class="ng-binding">备份类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="TplBackup[type]" value="0"><div id="tplbackup-type" class="" name="TplBackup[type]" selection='[null]'><label class="control-label cur-p m-r-10"><input type="radio" name="TplBackup[type]" value="0" checked> 模板及数据</label>
                            <label class="control-label cur-p m-r-10"><input type="radio" name="TplBackup[type]" value="1"> 仅备份模板</label></div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">提供两种备份类型，如果你不想备份数据可以选择“仅备份模板”。</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否为主题 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="tplbackup-is_theme" class="col-sm-4 control-label">

                        <span class="ng-binding">是否设为主题：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="TplBackup[is_theme]" value="0"><label><input type="checkbox" id="tplbackup-is_theme" class="form-control b-n" name="TplBackup[is_theme]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 封面 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="tplbackup-img" class="col-sm-4 control-label">

                        <span class="ng-binding">主题封面：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="imagegroup_container" class="szy-imagegroup" data-size="1"></div>
                            <input type="hidden" id="tplbackup-img" class="form-control" name="TplBackup[img]">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <button class="btn btn-primary" id="btn_submit" data-dismiss="modal">确认提交</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/assets/d2eace91/js/common.js?v=20180418"></script>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180418"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180418"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180418"></script>
<script id="client_rules" type="text">
[{"id": "tplbackup-name", "name": "TplBackup[name]", "attribute": "name", "rules": {"required":true,"messages":{"required":"备份名称不能为空。"}}},{"id": "tplbackup-back_id", "name": "TplBackup[back_id]", "attribute": "back_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"备份id必须是整数。"}}},{"id": "tplbackup-add_time", "name": "TplBackup[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"备份时间必须是整数。"}}},{"id": "tplbackup-is_sys", "name": "TplBackup[is_sys]", "attribute": "is_sys", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为系统预置模板必须是整数。"}}},{"id": "tplbackup-is_theme", "name": "TplBackup[is_theme]", "attribute": "is_theme", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否设为主题必须是整数。"}}},{"id": "tplbackup-shop_id", "name": "TplBackup[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "tplbackup-site_id", "name": "TplBackup[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点ID必须是整数。"}}},{"id": "tplbackup-type", "name": "TplBackup[type]", "attribute": "type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"备份类型必须是整数。"}}},{"id": "tplbackup-topic_id", "name": "TplBackup[topic_id]", "attribute": "topic_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"专题id必须是整数。"}}},{"id": "tplbackup-name", "name": "TplBackup[name]", "attribute": "name", "rules": {"string":true,"messages":{"string":"备份名称必须是一条字符串。","maxlength":"备份名称只能包含至多255个字符。"},"maxlength":255}},{"id": "tplbackup-page", "name": "TplBackup[page]", "attribute": "page", "rules": {"string":true,"messages":{"string":"所在页面必须是一条字符串。","maxlength":"所在页面只能包含至多255个字符。"},"maxlength":255}},{"id": "tplbackup-remark", "name": "TplBackup[remark]", "attribute": "remark", "rules": {"string":true,"messages":{"string":"备注信息必须是一条字符串。","maxlength":"备注信息只能包含至多255个字符。"},"maxlength":255}},{"id": "tplbackup-img", "name": "TplBackup[img]", "attribute": "img", "rules": {"string":true,"messages":{"string":"主题封面必须是一条字符串。","maxlength":"主题封面只能包含至多255个字符。"},"maxlength":255}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $('#{{ $uuid }}').find("#TplBackup").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $('#{{ $uuid }}').find("#btn_submit").click(function() {
            if (!validator.form()) {
                return false;
            }
            $('#{{ $uuid }}').find('#tplbackup-page').val(page);
            $('#{{ $uuid }}').find('#tplbackup-topic_id').val(topic_id);
            $.loading.start();
            var data = $('#{{ $uuid }}').find('#TplBackup').serializeJson();
            $.ajax({
                type: 'post',
                url: '/site/tpl-backup',
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.code == 0) {
                        if ($.modal($('.SZY-TPL-USE')) != undefined) {
                            $.modal($('.SZY-TPL-USE')).close();
                        }
                        $.msg(result.message);
                    } else {
                        $.msg(result.message);
                    }
                }
            });
        });

        $('#tplbackup-is_sys').click(function() {
            alert($(this).val());
        });

        $("#imagegroup_container").imagegroup({
            host: "{{ get_oss_host() }}",
            size: $(this).data("size"),
            values: $('#tplbackup-img').val().split("|"),
            gallery: true,
// 回调函数
            callback: function(data) {
                var values = this.values;
                if (!values) {
                    values = [];
                }
                values = values.join("|");
                $('#tplbackup-img').val(values);
                $.validator.clearError($("#tplbackup-img"));
            },
// 移除的回调函数
            remove: function(value, values) {
                var values = this.values;
                if (!values) {
                    values = [];
                }
                values = values.join("|");
                $('#tplbackup-img').val(values);
            }
        });

    });
</script>

<style>
    .modal-body .form-horizontal .form-group .form-control-box {
        line-height: 20px;
    }

    .table tbody tr td.no-data {
        padding: 4px 8px;
    }

    .no-data .fa-exclamation-circle {
        width: auto;
        height: auto;
        background: none;
    }
</style>