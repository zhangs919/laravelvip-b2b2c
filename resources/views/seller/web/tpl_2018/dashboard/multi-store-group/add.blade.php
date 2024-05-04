<div class="modal-body p-b-20 ">
    <div class="table-content m-t-10 clearfix">
        <form id="MultiStoreGroup" class="form-horizontal" name="MultiStoreGroup" action="/store/group/add" method="POST">
            @csrf

            <input type="hidden" id="multistoregroup-group_id" class="form-control" name="MultiStoreGroup[group_id]" value="{{ $info->group_id ?? '' }}">

            <input type="hidden" id="multistoregroup-shop_id" class="form-control" name="MultiStoreGroup[shop_id]" value="{{ $shop->shop_id }}">
            <!-- 分组名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoregroup-group_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">门店分组名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="multistoregroup-group_name" class="form-control" name="MultiStoreGroup[group_name]" value="{{ $info->group_name ?? '' }}" placeholder="">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 分组排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="multistoregroup-group_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">门店分组排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="multistoregroup-group_sort" class="form-control small" name="MultiStoreGroup[group_sort]" value="{{ $info->group_sort ?? 255 }}" placeholder="">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!--
            <div class="modal-footer">
            <a class="btn btn-primary">确认提交</a>
            <a class="btn btn-default">取消</a>
            </div>
            -->
        </form>
    </div>
</div>

<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "multistoregroup-shop_id", "name": "MultiStoreGroup[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺编号不能为空。"}}},{"id": "multistoregroup-group_name", "name": "MultiStoreGroup[group_name]", "attribute": "group_name", "rules": {"required":true,"messages":{"required":"门店分组名称不能为空。"}}},{"id": "multistoregroup-group_sort", "name": "MultiStoreGroup[group_sort]", "attribute": "group_sort", "rules": {"required":true,"messages":{"required":"门店分组排序不能为空。"}}},{"id": "multistoregroup-shop_id", "name": "MultiStoreGroup[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺编号必须是整数。"}}},{"id": "multistoregroup-group_sort", "name": "MultiStoreGroup[group_sort]", "attribute": "group_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店分组排序必须是整数。"}}},{"id": "multistoregroup-group_name", "name": "MultiStoreGroup[group_name]", "attribute": "group_name", "rules": {"string":true,"messages":{"string":"门店分组名称必须是一条字符串。","maxlength":"门店分组名称只能包含至多30个字符。"},"maxlength":30}},{"id": "multistoregroup-group_name", "name": "MultiStoreGroup[group_name]", "attribute": "group_name", "rules": {"ajax":{"url":"/store/group/client-validate","model":"Y29tbW9uXG1vZGVsc1xTdG9yZUdyb3Vw","attribute":"group_name","params":["MultiStoreGroup[group_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "multistoregroup-group_sort", "name": "MultiStoreGroup[group_sort]", "attribute": "group_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"门店分组排序必须是整数。","min":"门店分组排序必须不小于0。","max":"门店分组排序必须不大于255。"},"min":0,"max":255}},]
</script>
<script type="text/javascript">
    //
</script>
<script>

    var validator = $("#MultiStoreGroup").validate();
    // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
    $.validator.addRules($("#client_rules").html());
    // 自动获取焦点
    $("#multistoregroup-group_name").focus();

    //
</script>
