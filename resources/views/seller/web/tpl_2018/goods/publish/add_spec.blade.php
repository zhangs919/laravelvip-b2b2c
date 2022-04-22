<div id="{{ $uuid }}" class="table-content m-t-30 clearfix">
    <form id="Attribute" class="form-horizontal" name="Attribute" action="/goods/publish/add-spec" method="POST">
        {{ csrf_field() }}
        <!-- 隐藏域 -->
        <input type="hidden" id="attribute-attr_id" class="form-control" name="Attribute[attr_id]">

        <input type="hidden" id="attribute-is_spec" class="form-control" name="Attribute[is_spec]" value="1">

        <input type="hidden" id="attribute-is_index" class="form-control" name="Attribute[is_index]" value="0">

        <input type="hidden" id="attribute-is_linked" class="form-control" name="Attribute[is_linked]" value="0">
        <!-- 名称 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="attribute-attr_name" class="col-sm-4 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">规格名称：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <input type="text" id="attribute-attr_name" class="form-control" name="Attribute[attr_name]">


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
        <!-- 描述 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="attribute-attr_remark" class="col-sm-4 control-label">

                    <span class="ng-binding">规格描述：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <textarea id="attribute-attr_remark" class="form-control" name="Attribute[attr_remark]" rows="5"></textarea>


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
        <!-- 规格值列表 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">

                    <span class="ng-binding">规格值：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">




                        <div id="values_select" class='attr-values-area'>
                            <ul class="attr-values">


                                <li class="m-b-10 new-attr-value">
                                    <input type="hidden" class="form-control" name="attr_vid" value="0">

                                    <input type="text" class="form-control" name="attr_vname" placeholder="请输入规格可选值" data-rule-maxlength="20" data-msg-maxlength="规格值最大不能超过20个字符">

                                    <input type="button" value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value" />
                                    <label style="display: none;">
                                        <input type='hidden' value="0" name='is_delete' />
                                    </label>
                                </li>
                                <li class="m-b-10 new-attr-value">
                                    <input type="hidden" class="form-control" name="attr_vid" value="0">

                                    <input type="text" class="form-control" name="attr_vname" placeholder="请输入规格可选值" data-rule-maxlength="20" data-msg-maxlength="规格值最大不能超过20个字符">
                                    <input type="button" value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value" />
                                    <label style="display: none;">
                                        <input type='hidden' value="0" name='is_delete' />
                                    </label>
                                </li>
                                <li class="m-b-10 new-attr-value">
                                    <input type="hidden" class="form-control" name="attr_vid" value="0">

                                    <input type="text" class="form-control" name="attr_vname" placeholder="请输入规格可选值" data-rule-maxlength="20" data-msg-maxlength="规格值最大不能超过20个字符">
                                    <input type="button" value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value" />
                                    <label style="display: none;">
                                        <input type='hidden' value="0" name='is_delete' />
                                    </label>
                                </li>

                            </ul>
                            <a id="add_attribute_value" href="javascript:void(0);" class="btn btn-warning btn-sm">
                                <i class="fa fa-plus"></i>
                                <!-- 继续添加属性值 -->
                                添加规格值
                            </a>
                        </div>

                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>

        <!-- 排序 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="attribute-attr_sort" class="col-sm-4 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">排序：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <input type="text" id="attribute-attr_sort" class="form-control small" name="Attribute[attr_sort]" value="255">


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
</div>
</form>
<!-- 验证规则 -->
<script id="client_rules_{{ $uuid }}" class="client-rules" type="text">
    [{"id": "attribute-attr_name", "name": "Attribute[attr_name]", "attribute": "attr_name", "rules": {"required":true,"messages":{"required":"规格名称不能为空。"}}},{"id": "attribute-attr_style", "name": "Attribute[attr_style]", "attribute": "attr_style", "rules": {"required":true,"messages":{"required":"规格样式不能为空。"}}},{"id": "attribute-type_id", "name": "Attribute[type_id]", "attribute": "type_id", "rules": {"required":true,"messages":{"required":"商品类型ID不能为空。"}}},{"id": "attribute-shop_id", "name": "Attribute[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "attribute-attr_sort", "name": "Attribute[attr_sort]", "attribute": "attr_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "attribute-type_id", "name": "Attribute[type_id]", "attribute": "type_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品类型ID必须是整数。"}}},{"id": "attribute-shop_id", "name": "Attribute[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "attribute-par_attr_id", "name": "Attribute[par_attr_id]", "attribute": "par_attr_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级规格ID必须是整数。"}}},{"id": "attribute-attr_vid", "name": "Attribute[attr_vid]", "attribute": "attr_vid", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"规格值ID必须是整数。"}}},{"id": "attribute-is_spec", "name": "Attribute[is_spec]", "attribute": "is_spec", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为规格属性必须是整数。"}}},{"id": "attribute-attr_style", "name": "Attribute[attr_style]", "attribute": "attr_style", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"规格样式必须是整数。"}}},{"id": "attribute-is_index", "name": "Attribute[is_index]", "attribute": "is_index", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否检索必须是整数。"}}},{"id": "attribute-is_linked", "name": "Attribute[is_linked]", "attribute": "is_linked", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否关联相同规格商品必须是整数。"}}},{"id": "attribute-is_show", "name": "Attribute[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"显示必须是整数。"}}},{"id": "attribute-attr_name", "name": "Attribute[attr_name]", "attribute": "attr_name", "rules": {"string":true,"messages":{"string":"规格名称必须是一条字符串。","maxlength":"规格名称只能包含至多10个字符。"},"maxlength":10}},{"id": "attribute-attr_remark", "name": "Attribute[attr_remark]", "attribute": "attr_remark", "rules": {"string":true,"messages":{"string":"规格描述必须是一条字符串。","maxlength":"规格描述只能包含至多255个字符。"},"maxlength":255}},{"id": "attribute-attr_sort", "name": "Attribute[attr_sort]", "attribute": "attr_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
<script type="text/javascript">
    $().ready(function() {

        var container = $("#{{ $uuid }}");


        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }

            var url = $("#Attribute").attr("action");
            var data = $("#Attribute").remove(".attr-values-area").serializeJson();

            data = {
                _csrf: data._csrf,
                Attribute: data.Attribute,
                attr_values: data.attr_values
            };

            var attr_values = [];

            $(".attr-values-area:visible").each(function() {
                if ($(this).attr("id") == "values_select") {
                    $(this).find(".attr-value,.new-attr-value").each(function() {
                        var object = $(this).serializeJson();
                        if ($.trim(object.attr_vname) != '') {
                            attr_values.push(object);
                        }
                    });
                }
            });

            if (attr_values.length == 0) {
                $.msg("规格值不能为空！");
                return;
            }

            data.attr_values = attr_values;

            data = JSON.stringify(data);

            //加载提示
            $.loading.start();

            $.post(url, {
                data: data
            }, function(result) {
                if (result.code == 0) {
                    $.msg(result.message);
                    if (result.data) {
                        $.loading.start();
                        $.go(result.data);
                    }
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function() {
                $.loading.stop();
            });
        });

        // 模板
        var attr_value_tpl = $(container).find(".attr-values").find("li:last").clone();

        if ($(container).find(".new-attr-value").size() == 1) {
            $(container).find(".new-attr-value").find(".del-attr-value").prop("disabled", true);
        }

        // 继续添加属性值的点击事件
        $(container).find("#add_attribute_value").click(function() {
            $(container).find(".attr-values").append($(attr_value_tpl).clone());
            if ($(container).find(".new-attr-value").size() > 1) {
                $(container).find(".new-attr-value").find(".del-attr-value").prop("disabled", false);
            }
        });

        // 删除属性
        $('body').on("click", ".del-attr-value", function() {
            $(this).parents(".new-attr-value").remove();
            if ($(container).find(".new-attr-value").size() == 1) {
                $(container).find(".new-attr-value").find(".del-attr-value").prop("disabled", true);
            }
        })

        // 删除提示
        $(container).find(".delete_label").mouseover(function() {
            var element = this;
            $.tips("被勾选“删除”的属性值将在您点击“确认提交”按钮后被系统删除，请谨慎操作！", this, {
                time: 0
            });
        }).mouseout(function() {
            $.closeAll("tips");
        });

    });
</script>