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
        <form id="CategoryModel" class="form-horizontal" name="CategoryModel" action="/goods/category/edit-other?id={{ $info->cat_id }}" method="POST">
            @csrf
            <!-- 添加属性 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">

                        <span class="ng-binding">关联属性：</span>
                    </label>
                    <div class="col-sm-10">
                        <div class="form-control-box">

                            @if(!empty($cat_spec_list))
                            <ul id="attr_values" class="attr-value">
                                <div class="form-control-box">
                                    @foreach($cat_attr_list as $v)
                                        <li class="m-b-10">
                                            <input type="hidden" name="is_spec" value="0">
                                            <input type='hidden' name='cat_id' value="{{ $v->cat_id }}">
                                            <input type='hidden' name='attr_id' value="{{ $v->attr_id }}" class='attr-id'>
                                            <input class="form-control ipt  m-r-10" type="text" readonly="readonly" value="{{ $v->attr_name }}">
                                            <input class="form-control  m-r-10" type="text" readonly="readonly" value="{{ $v->attr_values }}">

                                            <input type="text" id="catattrmodel-group_name" class="form-control ipt pull-none m-r-10" name="group_name" value="{{ $v->group_name }}" placeholder="分组名称" data-msg-maxlength="排序号不能为空">

                                            <input type="text" id="catattrmodel-sort" class="form-control small pull-none m-r-10" name="sort" value="{{ $v->sort }}" data-rule-required="true" data-rule-digits="true" data-rule-min="0" data-rule-max="255" data-msg-required="排序号不能为空">

                                            <input type="hidden" name="is_show" value="0">
                                            <label><input type="checkbox" class="cur-p" name="is_show" value="1" @if($v->is_show) checked @endif> 显示</label> &nbsp;

                                            <input type="hidden" name="is_required" value="0">
                                            <label><input type="checkbox" class="cur-p" name="is_required" value="1" style="margin-right: 10px;" @if($v->is_required) checked @endif> 必填</label> &nbsp;


                                            <input type="hidden" name="is_filter" value="0">
                                            <label><input type="checkbox" class="cur-p" name="is_filter" value="1" @if($v->is_filter) checked @endif> 筛选</label> &nbsp;


                                            <input type="hidden" name="is_delete" value="0">
                                            <label><input type="checkbox" class="cur-p" name="is_delete" value="1"> 删除</label>
                                        </li>
                                    @endforeach
                                </div>
                            </ul>
                            @else
                            <label class="form-control" style="border-color: #fff; padding: 7px;">此分类下未关联任何属性</label>
                            @endif

                            <a id="add_cat_attrs" href="javascript:void(0);" class="btn btn-warning btn-sm click-fade">
                                <i class="fa fa-plus"></i>
                                添加属性
                            </a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm click-fade del-all" title="选中所有属性的删除复选框">
                                <i class="fa fa-check-circle"></i>
                                全选删除
                            </a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm click-fade undel-all" title="取消选中所有属性的删除复选框">
                                <i class="fa fa-times-circle-o"></i>
                                取消删除
                            </a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm click-fade reverse-del" title="反选所有属性的删除复选框">
                                <i class="fa fa-check-circle-o"></i>
                                反选删除
                            </a>
                            <div class="simple-form-field col-sm-10 edit-attrs edit m-t-10 w800">
                                <div class="form-group">
                                    <div class="edit-content">
                                        <h3 title="点击关闭" class="click-close">
                                            <i class="close-i">×</i>
                                        </h3>
                                        <div class="search-term">
                                            <div class="simple-form-field">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        <span>关键词：</span>
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" id="attr_keywords" class="form-control" placeholder="属性名称/属性描述">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simple-form-field">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        <span>商品类型：</span>
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <select id="attr_goods_type" class="form-control chosen-select">
                                                            <option value="">全部</option>
                                                            @foreach($goods_type_all as $v)
                                                                <option value="{{ $v->type_id }}">{{ $v->type_name }}</option>
                                                            @endforeach
                                                        </select></div>
                                                </div>
                                            </div>
                                            <div class="simple-form-field">
                                                <input type="button" id="attr_search" value="搜索" class="btn btn-primary" />
                                            </div>
                                        </div>
                                        <div id="cat_attr_container" class="table-responsive"></div>
                                    </div>
                                </div>
                            </div>


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
                                    <input type="text" class="form-control ipt pull-none m-r-10" readonly="readonly" value="{{ $v->attr_name }}">
                                    <input type="text" class="form-control pull-none" readonly="readonly" value="{{ $v->attr_values }}">

                                    <input type="text" id="catspecmodel-sort" class="form-control small pull-none m-r-10" name="sort" value="{{ $v->sort }}" data-rule-required="true" data-rule-digits="true" data-rule-min="0" data-rule-max="255" data-msg-required="排序号不能为空">

                                    <input type="hidden" name="is_input" value="0">
                                    <label><input type="checkbox" class="cur-p" name="is_input" value="1" @if($v->is_input) checked @endif> 允许输入</label><i class="fa fa-question-circle f16 c-ddd cur-p m-l-5 m-r-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='150' height='80' src='/images/goods/pattern1.png'>"></i>

                                    <input type="hidden" name="is_alias" value="0">
                                    <label><input type="checkbox" class="cur-p" name="is_alias" value="1" @if($v->is_alias) checked @endif> 别名</label><i class="fa fa-question-circle f16 c-ddd cur-p m-l-5 m-r-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='150' height='80' src='/images/goods/pattern2.png'>"></i>

                                    <input type="hidden" name="is_desc" value="0">
                                    <label><input type="checkbox" class="cur-p" name="is_desc" value="1" @if($v->is_desc) checked @endif> 备注</label><i class="fa fa-question-circle f16 c-ddd cur-p m-l-5 m-r-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='150' height='80' src='/images/goods/pattern3.png'>"></i>

                                    <input type="hidden" name="is_filter" value="0">
                                    <label><input type="checkbox" class="cur-p" name="is_filter" value="1" @if($v->is_filter) checked @endif> 筛选</label><i class="fa fa-question-circle f16 c-ddd cur-p m-l-5 m-r-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='150' height='80' src='/images/goods/pattern4.png'>"></i>

                                    <input type="hidden" name="is_delete" value="0">
                                    <label><input type="checkbox" class="cur-p" name="is_delete" value="1"> 删除</label>
                                </li>
                                @endforeach

                            </ul>
                            @else
                            <label class="form-control" style="border-color: #fff; padding: 7px;">此分类下未关联任何规格</label>
                            @endif

                            <a id="add_cat_specs" href="javascript:void(0);" class="btn btn-warning btn-sm click-fade">
                                <i class="fa fa-plus"></i>
                                添加规格
                            </a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm click-fade del-all" title="选中所有规格的删除复选框">
                                <i class="fa fa-check-circle"></i>
                                全选删除
                            </a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm click-fade undel-all" title="取消选中所有规格的删除复选框">
                                <i class="fa fa-times-circle-o"></i>
                                取消删除
                            </a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm click-fade reverse-del" title="反选所有规格的删除复选框">
                                <i class="fa fa-check-circle-o"></i>
                                反选删除
                            </a>
                            <div class="simple-form-field col-sm-10 edit edit-specs m-t-10 w800">
                                <div class="form-group">
                                    <div class="edit-content">
                                        <h3 title="点击关闭" class="click-close">
                                            <i class="close-i">×</i>
                                        </h3>
                                        <div class="search-term">
                                            <div class="simple-form-field">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        <span>关键词：</span>
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" id="spec_keywords" class="form-control" placeholder="规格名称/规格描述">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simple-form-field">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        <span>商品类型：</span>
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <select id="spec_goods_type" class="form-control chosen-select">
                                                            <option value="">全部</option>
                                                            @foreach($goods_type_all as $v)
                                                            <option value="{{ $v->type_id }}">{{ $v->type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simple-form-field">
                                                <input type="button" id="spec_search" value="搜索" class="btn btn-primary" />
                                            </div>
                                        </div>
                                        <div id="cat_spec_container" class="table-responsive"></div>
                                    </div>
                                </div>
                            </div>


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
            <input type="hidden" id="categorymodel-cat_id" class="form-control" name="CategoryModel[cat_id]" value="{{ $info->cat_id }}">
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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180418"></script>
    <!-- JSON -->
    <script src="/assets/d2eace91/js/jquery.json-2.4.js?v=20180418"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "categorymodel-cat_name", "name": "CategoryModel[cat_name]", "attribute": "cat_name", "rules": {"trim":true,"messages":{"trim":""}}},{"id": "categorymodel-cat_name", "name": "CategoryModel[cat_name]", "attribute": "cat_name", "rules": {"required":true,"messages":{"required":"分类名称不能为空。"}}},{"id": "categorymodel-cat_sort", "name": "CategoryModel[cat_sort]", "attribute": "cat_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "categorymodel-take_rate", "name": "CategoryModel[take_rate]", "attribute": "take_rate", "rules": {"required":true,"messages":{"required":"佣金比例不能为空。"}}},{"id": "categorymodel-parent_id", "name": "CategoryModel[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级分类ID必须是整数。"}}},{"id": "categorymodel-show_mode", "name": "CategoryModel[show_mode]", "attribute": "show_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品列表页商品展示方式必须是整数。"}}},{"id": "categorymodel-show_virtual", "name": "CategoryModel[show_virtual]", "attribute": "show_virtual", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许发布虚拟商品必须是整数。"}}},{"id": "categorymodel-is_show", "name": "CategoryModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "categorymodel-is_parent", "name": "CategoryModel[is_parent]", "attribute": "is_parent", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许新增下级分类必须是整数。"}}},{"id": "categorymodel-cat_sort", "name": "CategoryModel[cat_sort]", "attribute": "cat_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "categorymodel-take_rate", "name": "CategoryModel[take_rate]", "attribute": "take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"佣金比例必须是一个数字。","min":"佣金比例必须不小于0。","max":"佣金比例必须不大于100。"},"min":0,"max":100}},{"id": "categorymodel-sync_take_rate", "name": "CategoryModel[sync_take_rate]", "attribute": "sync_take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"佣金比例是否关联到子分类必须是一个数字。","min":"佣金比例是否关联到子分类必须不小于0。","max":"佣金比例是否关联到子分类必须不大于100。"},"min":0,"max":100}},{"id": "categorymodel-ext_info", "name": "CategoryModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"分类扩展字段必须是一条字符串。"}}},{"id": "categorymodel-cat_image", "name": "CategoryModel[cat_image]", "attribute": "cat_image", "rules": {"string":true,"messages":{"string":"分类图标必须是一条字符串。"}}},{"id": "categorymodel-cat_name", "name": "CategoryModel[cat_name]", "attribute": "cat_name", "rules": {"string":true,"messages":{"string":"分类名称必须是一条字符串。","maxlength":"分类名称只能包含至多30个字符。"},"maxlength":30}},{"id": "categorymodel-keywords", "name": "CategoryModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键词必须是一条字符串。","maxlength":"关键词只能包含至多255个字符。"},"maxlength":255}},{"id": "categorymodel-cat_desc", "name": "CategoryModel[cat_desc]", "attribute": "cat_desc", "rules": {"string":true,"messages":{"string":"分类描述必须是一条字符串。","maxlength":"分类描述只能包含至多255个字符。"},"maxlength":255}},{"id": "categorymodel-cat_link", "name": "CategoryModel[cat_link]", "attribute": "cat_link", "rules": {"string":true,"messages":{"string":"分类链接必须是一条字符串。","maxlength":"分类链接只能包含至多255个字符。"},"maxlength":255}},{"id": "categorymodel-cat_sort", "name": "CategoryModel[cat_sort]", "attribute": "cat_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
    <!-- 属性模板 -->
    <script id="attr_template" type="text">
<li class="m-b-10">
	<input type="hidden" name="is_spec" value="0">
	<input type="hidden" name="cat_id" class='cat-id' value="{{ $info->cat_id }}">
	<input type="hidden" name="attr_id" class='attr-id'>
	<input type="text" class="form-control ipt m-r-10 attr-name" value="" readonly="readonly">
	<input type="text" class="form-control attr-value m-r-10" value="" readonly="readonly">
	<input type="text" id="catattrmodel-group_name" class="form-control ipt pull-none m-r-10" name="group_name" value="" placeholder="分组名称" data-msg-maxlength="排序号不能为空">
	<input type="text" id="catattrmodel-sort" class="form-control small m-r-10" name="sort" value="255" data-rule-required="true" data-rule-digits="true" data-rule-min="0" data-rule-max="255" data-msg-required="排序号不能为空">
	<input type="hidden" name="is_show" value="0"><label><input type="checkbox" id="catattrmodel-is_show" class="cur-p" name="is_show" value="1" checked> 显示</label>&nbsp;
	<input type="hidden" name="is_required" value="0"><label><input type="checkbox" id="catattrmodel-is_required" class="cur-p" name="is_required" value="1"> 必填</label>&nbsp;
	<input type="hidden" name="is_filter" value="0"><label><input type="checkbox" id="catattrmodel-is_filter" class="cur-p" name="is_filter" value="1"> 筛选</label>&nbsp;
	<input type="button" value="移除" class="btn btn-danger btn-sm attr-remove" />
</li>
</script>
    <!-- 规格模板 -->
    <script id="spec_template" type="text">
<li class="m-b-10">
	<input type="hidden" name="is_spec" value="1">
	<input type="hidden" name="cat_id" class='cat-id' value="{{ $info->cat_id }}">
	<input type="hidden" name="attr_id" class='spec-id'>
	<input type="text" class="form-control ipt m-r-10 spec-name" value="" readonly="readonly">
	<input type="text" class="form-control spec-value" value="" readonly="readonly">
	<input type="text" id="catspecmodel-sort" class="form-control small m-r-10" name="sort" value="255" data-rule-required="true" data-rule-digits="true" data-rule-min="0" data-rule-max="255" data-msg-required="排序号不能为空">
	<input type="hidden" name="is_input" value="0"><label><input type="checkbox" id="catspecmodel-is_input" class="cur-p" name="is_input" value="1"> 允许输入</label><i class="fa fa-question-circle f16 c-ddd cur-p m-l-5 m-r-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='150' height='80' src='/images/goods/pattern1.png'>"></i>
	<input type="hidden" name="is_alias" value="0"><label><input type="checkbox" id="catspecmodel-is_alias" class="cur-p" name="is_alias" value="1"> 别名</label><i class="fa fa-question-circle f16 c-ddd cur-p m-l-5 m-r-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='150' height='80' src='/images/goods/pattern2.png'>"></i>
	<input type="hidden" name="is_desc" value="0"><label><input type="checkbox" id="catspecmodel-is_desc" class="cur-p" name="is_desc" value="1"> 备注</label><i class="fa fa-question-circle f16 c-ddd cur-p m-l-5 m-r-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='150' height='80' src='/images/goods/pattern3.png'>"></i>
	<input type="hidden" name="is_filter" value="0"><label><input type="checkbox" id="catspecmodel-is_filter" class="cur-p" name="is_filter" value="1"> 筛选</label><i class="fa fa-question-circle f16 c-ddd cur-p m-l-5 m-r-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='150' height='80' src='/images/goods/pattern4.png'>"></i>
	<input type="button" value="移除" class="btn btn-danger btn-sm spec-remove" />
</li>
</script>
    <script type="text/javascript">
        $().ready(function() {
            $("[data-toggle='popover']").popover();
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

                $.post('/goods/category/edit-other?id={{ $info->cat_id }}', {
                    data: data
                }, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message);
                        $.loading.start();
                        $.go("/goods/category/edit-other?id={{ $info->cat_id }}");
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

            });

            //-------------------------------属性----------------------------------

            var attr_tablelist = null;

            // 添加属性按钮的点击事件
            $("#add_cat_attrs").click(function() {

                if ($(".edit-attrs").is(":hidden")) {
                    $(".edit-attrs").show();
                } else {
                    $(".edit-attrs").hide();
                    return;
                }

                var attr_ids = $(".attr-id").serializeJson(true);

                var data = new Object();

                data.not_attr_ids = attr_ids['attr_id'];

                // 需要进行判断
                if (!attr_ids['attr_id']) {
                    data.not_attr_ids = [];
                }

                data.keywords = $("#attr_keywords").val();
                data.type_id = $("#attr_goods_type").val();
                data.page = {
                    page_id: "attr_pagination"
                };

                if (attr_tablelist == null) {
                    $.get('attr-table', data, function(result) {
                        $("#cat_attr_container").html(result.data);
                        attr_tablelist = $("#cat_attr_table").tablelist({
                            url: 'attr-table',
                            page_id: '#attr_pagination'
                        });
                    }, "json");
                } else {
                    attr_tablelist.load(data);
                }
            });

            // 点击属性表格中的“选择”按钮
            $("body").on("click", ".select_attr", function() {

                var attr_id = $(this).data("id");
                var attr_name = $(this).data("name");
                var attr_value = $(this).data("value");
                var template = $("#attr_template").html();

                $("#attr_values").append(template);

                var element = $("#attr_values").find("li:last");

                $(element).find(".attr-id").val(attr_id);
                $(element).find(".attr-name").val(attr_name);
                $(element).find(".attr-name").prop("title", attr_name);
                $(element).find(".attr-value").val(attr_value);
                $(element).find(".attr-value").prop("title", attr_value);

                $("#attr_search").click();
            });

            $("body").on("click", ".attr-remove", function() {
                $(this).parents("li").remove();
                $("#attr_search").click();
            });

            $("#attr_search").click(function() {

                var attr_ids = $(".attr-id").serializeJson(true);

                var data = new Object();

                data.not_attr_ids = attr_ids['attr_id'];

                // 需要进行判断
                if (!attr_ids['attr_id']) {
                    data.not_attr_ids = [];
                }

                data.keywords = $("#attr_keywords").val();
                data.type_id = $("#attr_goods_type").val();
                data.page = {
                    page_id: "attr_pagination"
                };

                $.loading.start();
                attr_tablelist.load(data, function() {
                    $.loading.stop();
                });

            });

            //-------------------------------规格----------------------------------

            var spec_tablelist = null;

            // 添加属性按钮的点击事件
            $("#add_cat_specs").click(function() {

                if ($(".edit-specs").is(":hidden")) {
                    $(".edit-specs").show();
                } else {
                    $(".edit-specs").hide();
                    return;
                }

                var spec_ids = $(".spec-id").serializeJson(true);

                var data = new Object();

                data.not_attr_ids = spec_ids['attr_id'];

                // 需要进行判断
                if (!spec_ids['attr_id']) {
                    data.not_attr_ids = [];
                }

                data.keywords = $("#spec_keywords").val();
                data.type_id = $("#spec_goods_type").val();
                data.page = {
                    page_id: "spec_pagination"
                };

                if (spec_tablelist == null) {
                    $.get('spec-table', data, function(result) {
                        $("#cat_spec_container").html(result.data);
                        spec_tablelist = $("#cat_spec_table").tablelist({
                            url: 'spec-table',
                            page_id: '#spec_pagination'
                        });
                    }, "json");
                } else {
                    spec_tablelist.load(data);
                }
            });

            // 点击属性表格中的“选择”按钮
            $("body").on("click", ".select_spec", function() {
                var spec_id = $(this).data("id");
                var spec_name = $(this).data("name");
                var spec_value = $(this).data("value");
                var template = $("#spec_template").html();

                $("#spec_values").append(template);

                var element = $("#spec_values").find("li:last");

                $(element).find(".spec-id").val(spec_id);
                $(element).find(".spec-name").val(spec_name);
                $(element).find(".spec-name").prop("title", spec_name);
                $(element).find(".spec-value").val(spec_value);
                $(element).find(".spec-value").prop("title", spec_value);

                if ($("#spec_values").find("li").size() == 1) {
                    $("#spec_values").find(":radio").prop("checked", true);
                }

                $("#spec_search").click();
            });

            $("body").on("click", ".spec-remove", function() {
                $(this).parents("li").remove();
                $("#spec_search").click();
            });

            $("#spec_search").click(function() {
                var spec_ids = $(".spec-id").serializeJson(true);

                var data = new Object();

                data.not_attr_ids = spec_ids['attr_id'];

                // 需要进行判断
                if (!spec_ids['attr_id']) {
                    data.not_attr_ids = [];
                }

                data.keywords = $("#spec_keywords").val();
                data.type_id = $("#spec_goods_type").val();
                data.page = {
                    page_id: "spec_pagination"
                };

                $.loading.start();
                spec_tablelist.load(data, function() {
                    $.loading.stop();
                });
            });

            $(".click-close").click(function() {
                $(this).parents(".edit").hide();
            });

            $(".del-all").click(function() {
                $(this).parents(".form-group").find("[name='is_delete']").prop("checked", true);
            });
            $(".undel-all").click(function() {
                $(this).parents(".form-group").find("[name='is_delete']").prop("checked", false);
            });
            $(".reverse-del").click(function() {
                $(this).parents(".form-group").find("[name='is_delete']").each(function() {
                    $(this).prop("checked", !$(this).prop("checked"));
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop