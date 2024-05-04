{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">

        <form id="AttributeModel" class="form-horizontal" name="AttributeModel" action="/goods/attribute/edit-spec?id={{ $info->attr_id }}&amp;type_id={{ $type_id }}" method="POST" novalidate="novalidate">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="attributemodel-attr_id" class="form-control" name="AttributeModel[attr_id]" value="{{ $info->attr_id }}">

            <input type="hidden" id="attributemodel-is_spec" class="form-control" name="AttributeModel[is_spec]" value="1">

            <input type="hidden" id="attributemodel-is_index" class="form-control" name="AttributeModel[is_index]" value="0">

            <input type="hidden" id="attributemodel-is_linked" class="form-control" name="AttributeModel[is_linked]" value="0">
            <!-- 商品类型 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-type_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">商品类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="attributemodel-type_id" class="form-control chosen-select" name="AttributeModel[type_id]" style="display: none;">
                                @foreach($goods_type_all as $k=>$v)
                                    <option value="{{ $v->type_id }}" @if($info->type_id == $v->type_id) selected="" @endif>{{ $v->type_name }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">规格名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="attributemodel-attr_name" class="form-control" name="AttributeModel[attr_name]" value="{{ $info->attr_name }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 描述 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_remark" class="col-sm-4 control-label">

                        <span class="ng-binding">规格描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="attributemodel-attr_remark" class="form-control" name="AttributeModel[attr_remark]" rows="5">{{ $info->attr_remark }}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 是否显示 -->
            <!-- <div class="simple-form-field" >
    <div class="form-group">
    <label for="attributemodel-is_show" class="col-sm-4 control-label">

    <span class="ng-binding">是否显示：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">
     -->

            <!-- <label class="control-label control-label-switch">
    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
    <input type="hidden" name="AttributeModel[is_show]" value="0"><label><input type="checkbox" id="attributemodel-is_show" class="form-control b-n" name="AttributeModel[is_show]" value="1" checked data-on-text="是" data-off-text="否"> </label>
    </div>
    </label> -->

            <!--
    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">属性设为无效后，如果属性为规格，则相关商品将全部下架，请及时通知相关人员，谨慎操作</div></div>
    </div>
    </div>
    </div> -->
            <!-- 显示样式 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_style" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">显示样式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="AttributeModel[attr_style]" value="0">
                            <label class="control-label cur-p"><input type="radio" id="attributemodel-attr_style" class="" name="AttributeModel[attr_style]" value="0" checked=""> 多选</label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 属性值列表 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_values" class="col-sm-4 control-label">

                        <span class="ng-binding">规格值：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <div id="values_select" class="attr-values-area">
                                <ul class="attr-values">


                                    @foreach($info->attr_values as $v)
                                    <li class="m-b-10 attr-value">
                                        <input type="hidden" id="attrvalue-attr_vid" class="form-control" name="attr_vid" value="{{ $v->attr_vid }}">

                                        <input type="text" id="attrvalue-attr_vname" class="form-control" name="attr_vname" value="{{ $v->attr_vname }}" placeholder="请输入规格可选值" data-rule-maxlength="20" data-msg-maxlength="规格值最大不能超过20个字符">

                                        <input type="text" id="attrvalue-attr_vsort" class="form-control small m-l-10" name="attr_vsort" value="{{ $v->attr_vsort }}" placeholder="排序" data-rule-integer="true" data-rule-min="0" data-rule-max="255">

                                        <label class="control-label m-l-10">
                                            <label class="delete_label">
                                                <input type="hidden" value="0" name="is_delete">
                                                <input type="checkbox" value="1" name="is_delete">
                                                删除
                                            </label>
                                        </label>
                                    </li>
                                    @endforeach





                                    <li class="m-b-10 new-attr-value">
                                        <input type="hidden" class="form-control" name="attr_vid" value="0">

                                        <input type="text" class="form-control" name="attr_vname" placeholder="请输入规格可选值" data-rule-maxlength="20" data-msg-maxlength="规格值最大不能超过20个字符">

                                        <input type="text" id="attrvaluemodel-attr_vsort" class="form-control small m-l-10" name="attr_vsort" value="255" placeholder="排序" data-rule-integer="true" data-rule-min="0" data-rule-max="255">
                                        <input type="button" value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value" disabled="">
                                        <label style="display: none;">
                                            <input type="hidden" value="0" name="is_delete">
                                        </label>
                                    </li>

                                </ul>
                                <a id="add_attribute_value" href="javascript:void(0);" class="btn btn-warning btn-sm">
                                    <i class="fa fa-plus"></i>
                                    <!-- 继续添加规格值 -->
                                    继续添加规格值
                                </a>
                            </div>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="attributemodel-attr_sort" class="form-control small" name="AttributeModel[attr_sort]" value="{{ $info->attr_sort }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>
        </form></div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- JSON2 -->
    <script src="/assets/d2eace91/js/jquery.json-2.4.js?v=1.2"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 双向选择器:css -->
    <link rel="stylesheet" href="/assets/d2eace91/css/selector/jquery.multiselect2side.css?v=1.2">
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "attributemodel-attr_name", "name": "AttributeModel[attr_name]", "attribute": "attr_name", "rules": {"required":true,"messages":{"required":"规格名称不能为空。"}}},{"id": "attributemodel-shop_id", "name": "AttributeModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop Id不能为空。"}}},{"id": "attributemodel-attr_style", "name": "AttributeModel[attr_style]", "attribute": "attr_style", "rules": {"required":true,"messages":{"required":"显示样式不能为空。"}}},{"id": "attributemodel-attr_sort", "name": "AttributeModel[attr_sort]", "attribute": "attr_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "attributemodel-type_id", "name": "AttributeModel[type_id]", "attribute": "type_id", "rules": {"required":true,"messages":{"required":"商品类型不能为空。"}}},{"id": "attributemodel-type_id", "name": "AttributeModel[type_id]", "attribute": "type_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品类型必须是整数。"}}},{"id": "attributemodel-shop_id", "name": "AttributeModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shop Id必须是整数。"}}},{"id": "attributemodel-par_attr_id", "name": "AttributeModel[par_attr_id]", "attribute": "par_attr_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级属性ID必须是整数。"}}},{"id": "attributemodel-attr_vid", "name": "AttributeModel[attr_vid]", "attribute": "attr_vid", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"属性值ID必须是整数。"}}},{"id": "attributemodel-is_spec", "name": "AttributeModel[is_spec]", "attribute": "is_spec", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为规格必须是整数。"}}},{"id": "attributemodel-attr_style", "name": "AttributeModel[attr_style]", "attribute": "attr_style", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"显示样式必须是整数。"}}},{"id": "attributemodel-is_index", "name": "AttributeModel[is_index]", "attribute": "is_index", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否检索必须是整数。"}}},{"id": "attributemodel-is_linked", "name": "AttributeModel[is_linked]", "attribute": "is_linked", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Linked必须是整数。"}}},{"id": "attributemodel-attr_sort", "name": "AttributeModel[attr_sort]", "attribute": "attr_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "attributemodel-is_show", "name": "AttributeModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "attributemodel-attr_name", "name": "AttributeModel[attr_name]", "attribute": "attr_name", "rules": {"string":true,"messages":{"string":"规格名称必须是一条字符串。","maxlength":"规格名称只能包含至多10个字符。"},"maxlength":10}},{"id": "attributemodel-attr_remark", "name": "AttributeModel[attr_remark]", "attribute": "attr_remark", "rules": {"string":true,"messages":{"string":"规格描述必须是一条字符串。","maxlength":"规格描述只能包含至多255个字符。"},"maxlength":255}},{"id": "attributemodel-attr_sort", "name": "AttributeModel[attr_sort]", "attribute": "attr_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };

            var validator = $("#AttributeModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }

                var url = $("#AttributeModel").attr("action");
                var data = $("#AttributeModel").remove(".attr-values-area").serializeJson();

                data = {
                    _csrf: data._csrf,
                    AttributeModel: data.AttributeModel,
                    attr_values: data.attr_values
                };

                var attr_values = [];

                var message = null;

                $(".attr-values-area:visible").each(function() {
                    if ($(this).attr("id") == "values_select") {
                        $(this).find(".attr-value,.new-attr-value").each(function() {

                            if ($(this).find("[name='attr_vsort']").valid() == false) {
                                $(this).find("[name='attr_vsort']").focus();
                                message = "属性值排序输入错误！";
                                return false;
                            }

                            var object = $(this).serializeJson();
                            if ($.trim(object.attr_vname) != '') {
                                attr_values.push(object);
                            }
                        });
                    }
                });

                // 显示错误信息
                if (message != null) {
                    $.msg(message, {
                        time: 3000
                    });
                    return;
                }

                data.attr_values = attr_values;

                var attr_value_count = attr_values.length;

                for (var i = 0; i < attr_values.length; i++) {

                    if (attr_values[i].is_delete == 1) {
                        attr_value_count--;
                    }
                }

                if (attr_value_count == 0) {
                    $.msg("属性值不能为空！");
                    return;
                }

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
            var attr_value_tpl = $(".attr-values").find("li:last").clone();

            if ($(".new-attr-value").size() == 1) {
                $(".new-attr-value").find(".del-attr-value").prop("disabled", true);
            }

            // 继续添加属性值的点击事件
            $("#add_attribute_value").click(function() {
                $(".attr-values").append($(attr_value_tpl).clone());
                if ($(".new-attr-value").size() > 1) {
                    $(".new-attr-value").find(".del-attr-value").prop("disabled", false);
                }
            });

            // 删除属性
            $('body').on("click", ".del-attr-value", function() {
                $(this).parents(".new-attr-value").remove();
                if ($(".new-attr-value").size() == 1) {
                    $(".new-attr-value").find(".del-attr-value").prop("disabled", true);
                }
            })

            // 删除提示
            $(".delete_label").mouseover(function() {
                var element = this;
                $.tips("被勾选“删除”的属性值将在您点击“确认提交”按钮后被系统删除，请谨慎操作！", this, {
                    time: 0
                });
            }).mouseout(function() {
                $.closeAll("tips");
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop