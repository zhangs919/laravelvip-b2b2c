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
        <form id="ShopClassModel" class="form-horizontal" name="ShopClassModel" action="/shop/shop-class/add" method="post" novalidate="novalidate">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="shopclassmodel-cls_id" class="form-control" name="ShopClassModel[cls_id]" value="{{ $info->cls_id ?? '' }}">
            <!-- 分类名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopclassmodel-cls_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">分类名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopclassmodel-cls_name" class="form-control" name="ShopClassModel[cls_name]" value="{{ $info->cls_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 上级分类ID -->
            @if(!isset($info->cls_id))
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopclassmodel-parent_id" class="col-sm-4 control-label">

                        <span class="ng-binding">上级分类：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="shopclassmodel-parent_id" class="form-control chosen-select" name="ShopClassModel[parent_id]" style="display: none;">
                                <option value="0" selected="">请选择</option>
                                @foreach($cls_list as $v)
                                <option value="{{ $v->cls_id }}" @if($parent_id == $v->cls_id) selected @endif>{{ $v->cls_name }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果不选择上级分类，则新增的分类为顶级分类</div></div>
                    </div>
                </div>
            </div>
            @endif

            <!-- 分类图标 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopclassmodel-cls_image" class="col-sm-4 control-label">

                        <span class="ng-binding">分类图标：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="cls_image_container"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                            <input type="hidden" id="shopclassmodel-cls_image" class="form-control" name="ShopClassModel[cls_image]" value="{{ $info->cls_image ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">此分类图标用于手机端店铺分类页面顶部图片展示，最佳显示尺寸为640*200像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否热门 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopclassmodel-is_hot" class="col-sm-4 control-label">

                        <span class="ng-binding">是否热门：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopClassModel[is_hot]" value="0">
                                    <label>
                                        @if(isset($info->is_hot))
                                            <input type="checkbox" id="shopclassmodel-is_hot" class="form-control b-n"
                                                   name="ShopClassModel[is_hot]" value="1" @if($info->is_hot == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="shopclassmodel-is_hot" class="form-control b-n"
                                                   name="ShopClassModel[is_hot]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制该分类在手机端店铺分类页面热门区域是否展示</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示店铺分类 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopclassmodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopClassModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="shopclassmodel-is_show" class="form-control b-n"
                                                   name="ShopClassModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="shopclassmodel-is_show" class="form-control b-n"
                                                   name="ShopClassModel[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制前台商家入驻、平台方后台添加店铺时，店铺分类是否展示</div></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopclassmodel-cls_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopclassmodel-cls_sort" class="form-control small" name="ShopClassModel[cls_sort]" value="{{ $info->cls_sort ?? '255' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary">


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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    [{"id": "shopclassmodel-cls_name", "name": "ShopClassModel[cls_name]", "attribute": "cls_name", "rules": {"required":true,"messages":{"required":"分类名称不能为空。"}}},{"id": "shopclassmodel-cls_sort", "name": "ShopClassModel[cls_sort]", "attribute": "cls_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shopclassmodel-parent_id", "name": "ShopClassModel[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级分类必须是整数。"}}},{"id": "shopclassmodel-is_show", "name": "ShopClassModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "shopclassmodel-cls_sort", "name": "ShopClassModel[cls_sort]", "attribute": "cls_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "shopclassmodel-cls_name", "name": "ShopClassModel[cls_name]", "attribute": "cls_name", "rules": {"string":true,"messages":{"string":"分类名称必须是一条字符串。","maxlength":"分类名称只能包含至多10个字符。"},"maxlength":10}},{"id": "shopclassmodel-keywords", "name": "ShopClassModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"Keywords必须是一条字符串。","maxlength":"Keywords只能包含至多255个字符。"},"maxlength":255}},{"id": "shopclassmodel-cls_desc", "name": "ShopClassModel[cls_desc]", "attribute": "cls_desc", "rules": {"string":true,"messages":{"string":"Cls Desc必须是一条字符串。","maxlength":"Cls Desc只能包含至多255个字符。"},"maxlength":255}},{"id": "shopclassmodel-cls_sort", "name": "ShopClassModel[cls_sort]", "attribute": "cls_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "shopclassmodel-cls_image", "name": "ShopClassModel[cls_image]", "attribute": "cls_image", "rules": {"string":true,"messages":{"string":"分类图标必须是一条字符串。"}}},{"id": "shopclassmodel-is_hot", "name": "ShopClassModel[is_hot]", "attribute": "is_hot", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否热门是无效的。"}}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ShopClassModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ShopClassModel").submit();
            });
            $("#cls_image_container").imagegroup({
                // host: 'http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/',
                host: '{{ get_oss_host() }}',
                size: 1,
                values: ['{{ $info->cls_image ?? '' }}'],
                callback: function(data) {
                    $("#shopclassmodel-cls_image").val(data.path);
                },
                remove: function(value, values) {
                    $("#shopclassmodel-cls_image").val('');
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop