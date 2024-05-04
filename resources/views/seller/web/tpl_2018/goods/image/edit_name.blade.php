<form id="{{ $uuid }}" class="form-horizontal" action="add" method="POST">
    @csrf
    <input type="hidden" id="imagemodel-img_id" class="form-control" name="ImageModel[img_id]" value="{{ $info->img_id }}">
    <div class="table-content m-t-10 clearfix">
        <!-- 相册名称 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="imagemodel-name" class="col-sm-3 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">上传图片名称：</span>
                </label>
                <div class="col-sm-9">
                    <div class="form-control-box">


                        <input type="text" id="imagemodel-name" class="form-control" name="ImageModel[name]" value="{{ $info->name }}">
                        <!-- -->

                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" id="btn_submit" class="btn btn-primary" value="确定" />
        <input type="button" class="btn btn-default" data-dismiss="modal" value="取消" />
    </div>
</form>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.3"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.3"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.3"></script>
<!-- 验证规则 -->
<script id="client_rules_{{ $uuid }}" type="text">
[{"id": "imagemodel-dir_id", "name": "ImageModel[dir_id]", "attribute": "dir_id", "rules": {"required":true,"messages":{"required":"目录编号不能为空。"}}},{"id": "imagemodel-name", "name": "ImageModel[name]", "attribute": "name", "rules": {"required":true,"messages":{"required":"上传图片名称不能为空。"}}},{"id": "imagemodel-file_name", "name": "ImageModel[file_name]", "attribute": "file_name", "rules": {"required":true,"messages":{"required":"文件名不能为空。"}}},{"id": "imagemodel-dirname", "name": "ImageModel[dirname]", "attribute": "dirname", "rules": {"required":true,"messages":{"required":"文件所在目录不能为空。"}}},{"id": "imagemodel-extension", "name": "ImageModel[extension]", "attribute": "extension", "rules": {"required":true,"messages":{"required":"图片扩展名不能为空。"}}},{"id": "imagemodel-path", "name": "ImageModel[path]", "attribute": "path", "rules": {"required":true,"messages":{"required":"图片路径不能为空。"}}},{"id": "imagemodel-add_time", "name": "ImageModel[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"上传时间不能为空。"}}},{"id": "imagemodel-dir_id", "name": "ImageModel[dir_id]", "attribute": "dir_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"目录编号必须是整数。"}}},{"id": "imagemodel-size", "name": "ImageModel[size]", "attribute": "size", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"图片大小必须是整数。"}}},{"id": "imagemodel-width", "name": "ImageModel[width]", "attribute": "width", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"图片宽必须是整数。"}}},{"id": "imagemodel-height", "name": "ImageModel[height]", "attribute": "height", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"图片高必须是整数。"}}},{"id": "imagemodel-sort", "name": "ImageModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "imagemodel-add_time", "name": "ImageModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上传时间必须是整数。"}}},{"id": "imagemodel-name", "name": "ImageModel[name]", "attribute": "name", "rules": {"string":true,"messages":{"string":"上传图片名称必须是一条字符串。","maxlength":"上传图片名称只能包含至多255个字符。"},"maxlength":255}},{"id": "imagemodel-file_name", "name": "ImageModel[file_name]", "attribute": "file_name", "rules": {"string":true,"messages":{"string":"文件名必须是一条字符串。","maxlength":"文件名只能包含至多255个字符。"},"maxlength":255}},{"id": "imagemodel-dirname", "name": "ImageModel[dirname]", "attribute": "dirname", "rules": {"string":true,"messages":{"string":"文件所在目录必须是一条字符串。","maxlength":"文件所在目录只能包含至多255个字符。"},"maxlength":255}},{"id": "imagemodel-extension", "name": "ImageModel[extension]", "attribute": "extension", "rules": {"string":true,"messages":{"string":"图片扩展名必须是一条字符串。","maxlength":"图片扩展名只能包含至多255个字符。"},"maxlength":255}},]
</script>
<script type="text/javascript">
    $().ready(function() {

        var form = $("#{{ $uuid }}");

        var modal = $.modal($('#{{ $uuid }}'));
        var tablelist = modal.params.tablelist;

        var validator = $(form).validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules_{{ $uuid }}").html(), {
            form: $(form)
        });

        $(form).find("#btn_submit").click(function() {

            if (!validator.form()) {
                return;
            }

//加载提示
            $.loading.start();

            var data = $(form).serializeJson();

            $.post('edit-name?id={{ $info->img_id }}', data, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    $.msg(result.message);
                    modal.hide();
                    tablelist.load();
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, 'json');
        });
    });
</script>