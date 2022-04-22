<form id="CollectCommentModel" class="form-horizontal" name="CollectCommentModel" action="/goods/collect-comment/ajax-setting.html" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="IPYgcNkAIO7ibKjkV12E6eWjsSz-J9AhDcUZq6cSov9BrEFJslJPlqMB469lbPaAjPWcVcZuo2A8qVbZ9lPurQ==">
    <div class="modal-body">
        <div class="table-content m-t-10 clearfix">

            <!-- 采集商品id -->

            <input type="hidden" id="collectcommentmodel-goods_ids" class="form-control w500" name="CollectCommentModel[goods_ids]" value="216">

            <!-- 采集评论条数 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectcommentmodel-comment_num" class="col-sm-4 control-label">

                        <span class="ng-binding">采集评论条数：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="collectcommentmodel-comment_num" class="form-control" name="CollectCommentModel[comment_num]" value="" min="1" number="true">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">不填写，默认为最大条数；<br>淘宝评论数，最多仅可采集50条；天猫评论数，最多仅可采集100条</div></div>
                    </div>
                </div>
            </div>
            <!-- 关键字替换 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectcommentmodel-replace_keywords" class="col-sm-4 control-label">

                        <span class="ng-binding">淘宝、天猫文字替换：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="collectcommentmodel-replace_keywords" class="form-control" name="CollectCommentModel[replace_keywords]" value="">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">评论中的"淘宝"、"天猫"等文字替换</div></div>
                    </div>
                </div>
            </div>
            <!-- 其它被替换的文字 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectcommentmodel-replace_keywords" class="col-sm-4 control-label">

                        <span class="ng-binding">其它文字替换：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input id="collectcommentmodel-other_find" class="form-control middle valid" name="CollectCommentModel[other_find]" value="" aria-invalid="false" type="text">
                            替换成
                            <input id="collectcommentmodel-other_replace" class="form-control middle valid" name="CollectCommentModel[other_replace]" value="" aria-invalid="false" type="text">


                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer text-c m-t-10">
            <input id="btn_submit" type="button" value="确认采集" class="btn btn-primary">
        </div>
    </div>


</form>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
<script src="/assets/d2eace91/js/common.js?v=20180027"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "collectcommentmodel-goods_ids", "name": "CollectCommentModel[goods_ids]", "attribute": "goods_ids", "rules": {"required":true,"messages":{"required":"Goods Ids不能为空。"}}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#CollectCommentModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            var json = $("#CollectCommentModel").serializeJson()
            ajaxImport(json.CollectCommentModel);
        });

    });
</script>