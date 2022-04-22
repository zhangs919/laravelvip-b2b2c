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

    <div class="table-content m-t-30 clearfix form-horizontal">
        <form id="CategoryModel" class="form-horizontal" name="CategoryModel" action="/goods/category/edit-filter?id={{ $info->cat_id }}" method="POST">
            {{ csrf_field() }}
            <!-- 添加属性 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">

                        <span class="ng-binding">关联属性：</span>
                    </label>
                    <div class="col-sm-10">
                        <div class="form-control-box">


                            <ul id="attr_values" class="attr-value">

                                @if(!empty($cat_spec_list))
                                <div class="form-control-box">
                                    @foreach($cat_attr_list as $v)
                                    <li class="m-b-10">
                                        <input type="hidden" name="is_spec" value="0">
                                        <input type='hidden' name='cat_id' value="{{ $v->cat_id }}">
                                        <input type='hidden' name='attr_id' value="{{ $v->attr_id }}" class='attr-id'>
                                        <input class="form-control ipt pull-none m-r-10" type="text" readonly="readonly" value="{{ $v->cat_name }}">
                                        <input class="form-control ipt pull-none m-r-10" type="text" readonly="readonly" value="{{ $v->attr_name }}">
                                        <input class="form-control pull-none m-r-10" type="text" readonly="readonly" value="{{ $v->attr_values }}">

                                        <input type="text" id="catattrmodel-sort" class="form-control small pull-none m-r-10" name="sort" value="{{ $v->sort }}" data-rule-required="true" data-rule-digits="true" data-rule-min="0" data-rule-max="255" data-msg-required="排序号不能为空">


                                        <input type="hidden" name="is_filter" value="0">
                                        <label><input type="checkbox" class="cur-p" name="is_filter" value="1" @if($v->is_filter) checked @endif> 筛选</label> &nbsp;


                                        <input type="hidden" name="is_show" value="0">
                                        <label><input type="checkbox" class="cur-p" name="is_show" value="1" checked disabled="disabled"> 显示</label> &nbsp;
                                    </li>
                                    @endforeach
                                </div>
                                @else
                                <label class="form-control" style="border-color: #fff; padding: 7px;">此分类下未关联任何属性</label>
                                @endif

                            </ul>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 添加规格 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">

                        <span class="ng-binding">关联规格：</span>
                    </label>
                    <div class="col-sm-10">
                        <div class="form-control-box">


                            @if(!empty($cat_spec_list))
                            <ul id="spec_values" class="spec-value">

                                @foreach($cat_spec_list as $v)
                                <li class="m-b-10">
                                    <input type="hidden" name="is_spec" value="1">
                                    <input type='hidden' name='cat_id' value="{{ $v->cat_id }}">
                                    <input type='hidden' name='attr_id' value="{{ $v->attr_id }}" class='spec-id'>
                                    <input class="form-control ipt pull-none m-r-10" type="text" readonly="readonly" value="{{ $v->cat_name }}">
                                    <input type="text" class="form-control ipt pull-none m-r-10" readonly="readonly" value="{{ $v->attr_name }}">
                                    <input type="text" class="form-control pull-none m-r-10" readonly="readonly" value="{{ $v->attr_values }}">

                                    <input type="text" id="catspecmodel-sort" class="form-control small pull-none m-r-10" name="sort" value="{{ $v->sort }}" data-rule-required="true" data-rule-digits="true" data-rule-min="0" data-rule-max="255" data-msg-required="排序号不能为空">

                                    <input type="hidden" name="is_filter" value="0">
                                    <label><input type="checkbox" class="cur-p" name="is_filter" value="1" @if($v->is_filter) checked @endif> 筛选</label> &nbsp;

                                    <!-- <input type="hidden" name="is_default" value="0"><label class="control-label cur-p"><input type="radio" class="" name="is_default" value="1" checked disabled="disabled"> 默认规格</label> -->
                                </li>
                                @endforeach

                            </ul>
                            @else
                            <label class="form-control" style="border-color: #fff; padding: 7px;">此分类下未关联任何规格</label>
                            @endif


                        </div>

                        <div class="help-block help-block-t"></div>
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


                            <input type="button" id='btn_submit' value='确认提交' class="btn btn-primary" />


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>



            <!-- 隐藏域 -->
            <input type="hidden" id="categorymodel-cat_id" class="form-control" name="CategoryModel[cat_id]" value="271">
            <input type="hidden" id="data" name='data' value='' />

        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- JSON -->
    <script src="/assets/d2eace91/js/jquery.json-2.4.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "categorymodel-cat_name", "name": "CategoryModel[cat_name]", "attribute": "cat_name", "rules": {"trim":true,"messages":{"trim":""}}},{"id": "categorymodel-cat_name", "name": "CategoryModel[cat_name]", "attribute": "cat_name", "rules": {"required":true,"messages":{"required":"分类名称不能为空。"}}},{"id": "categorymodel-cat_sort", "name": "CategoryModel[cat_sort]", "attribute": "cat_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "categorymodel-take_rate", "name": "CategoryModel[take_rate]", "attribute": "take_rate", "rules": {"required":true,"messages":{"required":"佣金比例不能为空。"}}},{"id": "categorymodel-parent_id", "name": "CategoryModel[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级分类ID必须是整数。"}}},{"id": "categorymodel-show_mode", "name": "CategoryModel[show_mode]", "attribute": "show_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品列表页商品展示方式必须是整数。"}}},{"id": "categorymodel-show_virtual", "name": "CategoryModel[show_virtual]", "attribute": "show_virtual", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许发布虚拟商品必须是整数。"}}},{"id": "categorymodel-is_show", "name": "CategoryModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "categorymodel-is_parent", "name": "CategoryModel[is_parent]", "attribute": "is_parent", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许新增下级分类必须是整数。"}}},{"id": "categorymodel-cat_sort", "name": "CategoryModel[cat_sort]", "attribute": "cat_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "categorymodel-take_rate", "name": "CategoryModel[take_rate]", "attribute": "take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"佣金比例必须是一个数字。","min":"佣金比例必须不小于0。","max":"佣金比例必须不大于100。"},"min":0,"max":100}},{"id": "categorymodel-sync_take_rate", "name": "CategoryModel[sync_take_rate]", "attribute": "sync_take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"佣金比例是否关联到子分类必须是一个数字。","min":"佣金比例是否关联到子分类必须不小于0。","max":"佣金比例是否关联到子分类必须不大于100。"},"min":0,"max":100}},{"id": "categorymodel-ext_info", "name": "CategoryModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"分类扩展字段必须是一条字符串。"}}},{"id": "categorymodel-cat_image", "name": "CategoryModel[cat_image]", "attribute": "cat_image", "rules": {"string":true,"messages":{"string":"分类图标必须是一条字符串。"}}},{"id": "categorymodel-cat_name", "name": "CategoryModel[cat_name]", "attribute": "cat_name", "rules": {"string":true,"messages":{"string":"分类名称必须是一条字符串。","maxlength":"分类名称只能包含至多30个字符。"},"maxlength":30}},{"id": "categorymodel-keywords", "name": "CategoryModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键词必须是一条字符串。","maxlength":"关键词只能包含至多255个字符。"},"maxlength":255}},{"id": "categorymodel-cat_desc", "name": "CategoryModel[cat_desc]", "attribute": "cat_desc", "rules": {"string":true,"messages":{"string":"分类描述必须是一条字符串。","maxlength":"分类描述只能包含至多255个字符。"},"maxlength":255}},{"id": "categorymodel-cat_link", "name": "CategoryModel[cat_link]", "attribute": "cat_link", "rules": {"string":true,"messages":{"string":"分类链接必须是一条字符串。","maxlength":"分类链接只能包含至多255个字符。"},"maxlength":255}},{"id": "categorymodel-cat_sort", "name": "CategoryModel[cat_sort]", "attribute": "cat_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#CategoryModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }

                var data = [];

                var i = 0;

                $("#attr_values").find("li").each(function() {
                    data[i] = $(this).serializeJson();
                    i++;
                });

                $("#spec_values").find("li").each(function() {
                    data[i] = $(this).serializeJson();
                    i++;
                });

                $.loading.start();

                $.post('/goods/category/edit-filter?id={{ $info->cat_id }}', {
                    data: data
                }, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message, function() {
                            $.loading.start();
                            $.go("/goods/category/edit-filter?id={{ $info->cat_id }}");
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop