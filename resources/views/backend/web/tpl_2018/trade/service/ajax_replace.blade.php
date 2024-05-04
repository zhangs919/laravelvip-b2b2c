<form id="ReplaceModel" class="form-horizontal" name="ReplaceModel" action="/trade/service/ajax-replace" method="post" enctype="multipart/form-data">
    @csrf
    <div class="table-content m-t-20 clearfix">

        <input type="hidden" id="replacemodel-id" class="form-control" name="ReplaceModel[id]" value="493">
        <!-- 采集评论条数 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="replacemodel-find_content" class="col-sm-4 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">被替换文字：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <input type="text" id="replacemodel-find_content" class="form-control" name="ReplaceModel[find_content]">


                    </div>

                    <div class="help-block help-block-t"><div class="help-block help-block-t">评论中所要替换的文字</div></div>
                </div>
            </div>
        </div>
        <!-- 关键字替换 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="replacemodel-replace_content" class="col-sm-4 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">替换成文字：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <input type="text" id="replacemodel-replace_content" class="form-control" name="ReplaceModel[replace_content]" value="">


                    </div>

                    <div class="help-block help-block-t"><div class="help-block help-block-t">评论中的文字所要替换成的文字</div></div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer text-c ">
        <input id="btn_submit" type="button" value="确认提交" class="btn btn-primary">
    </div>
</form>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
<script src="/assets/d2eace91/js/common.js?v=20180027"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "replacemodel-find_content", "name": "ReplaceModel[find_content]", "attribute": "find_content", "rules": {"required":true,"messages":{"required":"被替换文字不能为空。"}}},{"id": "replacemodel-replace_content", "name": "ReplaceModel[replace_content]", "attribute": "replace_content", "rules": {"required":true,"messages":{"required":"替换成文字不能为空。"}}},{"id": "replacemodel-id", "name": "ReplaceModel[id]", "attribute": "id", "rules": {"required":true,"messages":{"required":"Id不能为空。"}}},{"id": "replacemodel-find_content", "name": "ReplaceModel[find_content]", "attribute": "find_content", "rules": {"string":true,"messages":{"string":"被替换文字必须是一条字符串。","maxlength":"被替换文字只能包含至多20个字符。"},"maxlength":20}},{"id": "replacemodel-replace_content", "name": "ReplaceModel[replace_content]", "attribute": "replace_content", "rules": {"string":true,"messages":{"string":"替换成文字必须是一条字符串。","maxlength":"替换成文字只能包含至多20个字符。"},"maxlength":20}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#ReplaceModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("body").on("click", "#btn_submit", function() {
            if (!validator.form()) {
                return;
            }
            var json = $("#ReplaceModel").serializeJson()
            ajaxImport(json.ReplaceModel);
        });

    });
</script>