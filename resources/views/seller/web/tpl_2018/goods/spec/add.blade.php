{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">

        <form id="Attribute" class="form-horizontal" name="Attribute" action="/goods/spec/add" method="POST">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="attribute-attr_id" class="form-control" name="Attribute[attr_id]" value="{{ $info->attr_id ?? '' }}">

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


                            <input type="text" id="attribute-attr_name" class="form-control" name="Attribute[attr_name]" value="{{ $info->attr_name ?? '' }}">
                            <i class="fa fa-question-circle f16 c-ddd m-l-10 cur-p" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='200' height='155' src='/seller/images/goods/spec-sample.png'>"></i>


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


                            <textarea id="attribute-attr_remark" class="form-control" name="Attribute[attr_remark]" rows="5">{{ $info->attr_remark ?? '' }}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 规格值列表 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">规格值：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <div id="values_select" class='attr-values-area'>
                                <ul class="attr-values">


                                    @if(!isset($info->attr_id))
                                        @for($i=0; $i < 3; $i++)
                                        <li class="m-b-10 new-attr-value">
                                            <input type="hidden" class="form-control" name="attr_vid" value="0">

                                            <input type="text" class="form-control" name="attr_vname" placeholder="请输入规格可选值" data-rule-maxlength="30" data-msg-maxlength="规格值最大不能超过30个字符">

                                            <input type="text" id="attrvalue-attr_vsort" class="form-control small m-l-10" name="attr_vsort" placeholder="排序" data-rule-integer="true" data-rule-min="0" data-rule-max="255">
                                            <input type="button" value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value" />
                                            <label style="display: none;">
                                                <input type='hidden' value="0" name='is_delete' />
                                            </label>
                                        </li>
                                        @endfor
                                    @else

                                        @foreach($info->attr_values as $attr_value)
                                        <li class="m-b-10 attr-value">
                                            <input type="hidden" id="attrvalue-attr_vid" class="form-control" name="attr_vid" value="{{ $attr_value->attr_vid }}">

                                            <input type="text" id="attrvalue-attr_vname" class="form-control" name="attr_vname" value="{{ $attr_value->attr_vname }}" placeholder="请输入规格可选值" data-rule-maxlength="30" data-msg-maxlength="规格值最大不能超过30个字符">

                                            <input type="text" id="attrvalue-attr_vsort" class="form-control small m-l-10" name="attr_vsort" value="{{ $attr_value->attr_vsort }}" placeholder="排序" data-rule-integer="true" data-rule-min="0" data-rule-max="255">

                                            <label class="control-label m-l-10">
                                                <label class="delete_label">
                                                    <input type='hidden' value="0" name='is_delete' />
                                                    <input type='checkbox' value="1" name='is_delete' />
                                                    删除
                                                </label>
                                            </label>
                                        </li>

                                        @endforeach

                                        <li class="m-b-10 new-attr-value">
                                            <input type="hidden" class="form-control" name="attr_vid" value="0">

                                            <input type="text" class="form-control" name="attr_vname" placeholder="请输入规格可选值" data-rule-maxlength="30" data-msg-maxlength="规格值最大不能超过30个字符">

                                            <input type="text" id="attrvalue-attr_vsort" class="form-control small m-l-10" name="attr_vsort" placeholder="排序" data-rule-integer="true" data-rule-min="0" data-rule-max="255">
                                            <input type="button" value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value" />
                                            <label style="display: none;">
                                                <input type='hidden' value="0" name='is_delete' />
                                            </label>
                                        </li>
                                    @endif

                                </ul>
                                <a id="add_attribute_value" href="javascript:void(0);" class="btn btn-warning btn-sm">
                                    <i class="fa fa-plus"></i>
                                    <!-- 继续添加规格值 -->
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

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制商家发布商品页面，规格展示顺序，数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交" />

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
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
    <script src="/assets/d2eace91/js/jquery.json-2.4.js?v=20180710"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
    <!-- 双向选择器:css -->
    <link rel="stylesheet" href="/assets/d2eace91/css/selector/jquery.multiselect2side.css?v=20180702"/>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    [{"id": "attribute-attr_name", "name": "Attribute[attr_name]", "attribute": "attr_name", "rules": {"required":true,"messages":{"required":"规格名称不能为空。"}}},{"id": "attribute-attr_style", "name": "Attribute[attr_style]", "attribute": "attr_style", "rules": {"required":true,"messages":{"required":"规格样式不能为空。"}}},{"id": "attribute-type_id", "name": "Attribute[type_id]", "attribute": "type_id", "rules": {"required":true,"messages":{"required":"商品类型ID不能为空。"}}},{"id": "attribute-shop_id", "name": "Attribute[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "attribute-attr_sort", "name": "Attribute[attr_sort]", "attribute": "attr_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "attribute-type_id", "name": "Attribute[type_id]", "attribute": "type_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品类型ID必须是整数。"}}},{"id": "attribute-shop_id", "name": "Attribute[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "attribute-par_attr_id", "name": "Attribute[par_attr_id]", "attribute": "par_attr_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级规格ID必须是整数。"}}},{"id": "attribute-attr_vid", "name": "Attribute[attr_vid]", "attribute": "attr_vid", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"规格值ID必须是整数。"}}},{"id": "attribute-is_spec", "name": "Attribute[is_spec]", "attribute": "is_spec", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为规格属性必须是整数。"}}},{"id": "attribute-attr_style", "name": "Attribute[attr_style]", "attribute": "attr_style", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"规格样式必须是整数。"}}},{"id": "attribute-is_index", "name": "Attribute[is_index]", "attribute": "is_index", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否检索必须是整数。"}}},{"id": "attribute-is_linked", "name": "Attribute[is_linked]", "attribute": "is_linked", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否关联相同规格商品必须是整数。"}}},{"id": "attribute-is_show", "name": "Attribute[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"显示必须是整数。"}}},{"id": "attribute-attr_name", "name": "Attribute[attr_name]", "attribute": "attr_name", "rules": {"string":true,"messages":{"string":"规格名称必须是一条字符串。","maxlength":"规格名称只能包含至多10个字符。"},"maxlength":10}},{"id": "attribute-attr_remark", "name": "Attribute[attr_remark]", "attribute": "attr_remark", "rules": {"string":true,"messages":{"string":"规格描述必须是一条字符串。","maxlength":"规格描述只能包含至多255个字符。"},"maxlength":255}},{"id": "attribute-attr_sort", "name": "Attribute[attr_sort]", "attribute": "attr_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $("[data-toggle='popover']").popover();
            var validator = $("#Attribute").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
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

                var message = null;

                $(".attr-values-area:visible").each(function() {
                    if ($(this).attr("id") == "values_select") {
                        $(this).find(".attr-value,.new-attr-value").each(function() {
                            if ($(this).find("[name='attr_vsort']").valid() == false) {
                                $(this).find("[name='attr_vsort']").focus();
                                message = "规格值排序输入错误！";
                                return false;
                            }

                            var object = $(this).serializeJson();
                            if ($.trim(object.attr_vname) != '') {
                                attr_values.push(object);
                            }
                        });
                    }
                });

                if (message != null) {
                    $.msg(message);
                    return;
                }

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
            var attr_value_tpl = $(".attr-values").find("li:last").clone();

            if ($(".new-attr-value").size() == 1) {
                $(".new-attr-value").find(".del-attr-value").prop("disabled", true);
            }

            // 继续添加规格值的点击事件
            $("#add_attribute_value").click(function() {
                $(".attr-values").append($(attr_value_tpl).clone());
                if ($(".new-attr-value").size() > 1) {
                    $(".new-attr-value").find(".del-attr-value").prop("disabled", false);
                }
            });

            // 删除规格
            $('body').on("click", ".del-attr-value", function() {
                $(this).parents(".new-attr-value").remove();
                if ($(".new-attr-value").size() == 1) {
                    $(".new-attr-value").find(".del-attr-value").prop("disabled", true);
                }
            })

            // 删除提示
            $(".delete_label").mouseover(function() {
                var element = this;
                $.tips("被勾选“删除”的规格值将在您点击“确认提交”按钮后被系统删除，请谨慎操作！", this, {
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