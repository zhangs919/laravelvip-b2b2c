{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="form1" class="form-horizontal" name="ShopCategory" action="/goods/category/add" method="POST">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="shopcategory-cat_id" class="form-control" name="ShopCategory[cat_id]" value="{{ $info->cat_id ?? '' }}">
            <!-- 分类名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopcategory-cat_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">分类名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopcategory-cat_name" class="form-control" name="ShopCategory[cat_name]" value="{{ $info->cat_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">1~30个字符，支持中、英文、数字及符号</div></div>
                    </div>
                </div>
            </div>
            <!-- 上级分类ID -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopcategory-parent_id" class="col-sm-4 control-label">

                        <span class="ng-binding">上级分类：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="shopcategory-parent_id" class="form-control chosen-select" name="ShopCategory[parent_id]">
                                <option value="0" selected>请选择</option>
                                @foreach($cat_list as $v)
                                    <option value="{{ $v->cat_id }}" @if($parent_id == $v->cat_id) selected="selected" @endif>{{ $v->cat_name }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果不选择上级分类，则新增的分类为顶级分类</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopcategory-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopCategory[is_show]" value="0">
                                    @if(!isset($info->is_show))
                                        <label>
                                            <input type="checkbox" id="shopcategory-is_show"
                                                      class="form-control b-n" name="ShopCategory[is_show]"
                                                   value="1" checked data-on-text="是" data-off-text="否">
                                        </label>
                                    @else
                                        <label>
                                            <input type="checkbox" id="shopcategory-is_show"
                                                   class="form-control b-n" name="ShopCategory[is_show]"
                                                   value="1" @if($info->is_show == 1)checked="" @endif data-on-text="是" data-off-text="否">
                                        </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制前台店铺首页，店铺商品分类是否展示</div></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopcategory-cat_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopcategory-cat_sort" class="form-control small m-r-10" name="ShopCategory[cat_sort]" value="{{ $info->cat_sort ?? 255 }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "shopcategory-cat_name", "name": "ShopCategory[cat_name]", "attribute": "cat_name", "rules": {"required":true,"messages":{"required":"分类名称不能为空。"}}},{"id": "shopcategory-cat_sort", "name": "ShopCategory[cat_sort]", "attribute": "cat_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shopcategory-parent_id", "name": "ShopCategory[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级分类必须是整数。"}}},{"id": "shopcategory-is_show", "name": "ShopCategory[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "shopcategory-cat_sort", "name": "ShopCategory[cat_sort]", "attribute": "cat_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "shopcategory-cat_name", "name": "ShopCategory[cat_name]", "attribute": "cat_name", "rules": {"string":true,"messages":{"string":"分类名称必须是一条字符串。","maxlength":"分类名称只能包含至多30个字符。"},"maxlength":30}},{"id": "shopcategory-keywords", "name": "ShopCategory[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"Keywords必须是一条字符串。","maxlength":"Keywords只能包含至多255个字符。"},"maxlength":255}},{"id": "shopcategory-cat_desc", "name": "ShopCategory[cat_desc]", "attribute": "cat_desc", "rules": {"string":true,"messages":{"string":"Cat Desc必须是一条字符串。","maxlength":"Cat Desc只能包含至多255个字符。"},"maxlength":255}},{"id": "shopcategory-cat_sort", "name": "ShopCategory[cat_sort]", "attribute": "cat_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#form1").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();

                var url = $("#form1").attr("action");
                var data = $("#form1").serializeJson();
                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message);
                        $.go('list');
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });

            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop