<div class="modal-body p-b-20 ">
    <div class="table-content m-t-10 clearfix">
        <form id="StoreGroup" class="form-horizontal" name="StoreGroup" action="/store/group/add" method="POST">
            {{ csrf_field() }}

            <input type="hidden" id="storegroup-group_id" class="form-control" name="StoreGroup[group_id]" value="{{ $info->group_id ?? '' }}">

            <input type="hidden" id="storegroup-shop_id" class="form-control" name="StoreGroup[shop_id]" value="{{ $shop_info->shop_id }}">
            <!-- 分组名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storegroup-group_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">网点分组名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="storegroup-group_name" class="form-control" name="StoreGroup[group_name]" value="{{ $info->group_name ?? '' }}" placeholder="">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 分组排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storegroup-group_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">网点分组排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="storegroup-group_sort" class="form-control small" name="StoreGroup[group_sort]" value="{{ $info->group_sort ?? 255 }}" placeholder="">


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
[{"id": "storegroup-shop_id", "name": "StoreGroup[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺编号不能为空。"}}},{"id": "storegroup-group_name", "name": "StoreGroup[group_name]", "attribute": "group_name", "rules": {"required":true,"messages":{"required":"网点分组名称不能为空。"}}},{"id": "storegroup-group_sort", "name": "StoreGroup[group_sort]", "attribute": "group_sort", "rules": {"required":true,"messages":{"required":"网点分组排序不能为空。"}}},{"id": "storegroup-shop_id", "name": "StoreGroup[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺编号必须是整数。"}}},{"id": "storegroup-group_sort", "name": "StoreGroup[group_sort]", "attribute": "group_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点分组排序必须是整数。"}}},{"id": "storegroup-group_name", "name": "StoreGroup[group_name]", "attribute": "group_name", "rules": {"string":true,"messages":{"string":"网点分组名称必须是一条字符串。","maxlength":"网点分组名称只能包含至多30个字符。"},"maxlength":30}},{"id": "storegroup-group_name", "name": "StoreGroup[group_name]", "attribute": "group_name", "rules": {"ajax":{"url":"/store/group/client-validate","model":"Y29tbW9uXG1vZGVsc1xTdG9yZUdyb3Vw","attribute":"group_name","params":["StoreGroup[group_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "storegroup-group_sort", "name": "StoreGroup[group_sort]", "attribute": "group_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"网点分组排序必须是整数。","min":"网点分组排序必须不小于0。","max":"网点分组排序必须不大于255。"},"min":0,"max":255}},]
</script>
<script type="text/javascript">
    var validator = $("#StoreGroup").validate();
    // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
    $.validator.addRules($("#client_rules").html());
</script>