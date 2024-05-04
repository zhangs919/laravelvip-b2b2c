{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="NavAdModel" class="form-horizontal" name="NavAdModel" action="{{ $form_action }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="navadmodel-id" class="form-control" name="NavAdModel[id]" value="{{ $info->id ?? ''}}">
            <!-- 广告名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navadmodel-ad_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">广告名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navadmodel-ad_name" class="form-control" name="NavAdModel[ad_name]" value="{{ $info->ad_name ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 广告图片 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navadmodel-ad_image" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">广告图片：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="imagegroup_container" class="szy-imagegroup"  data-size="1"></div>
                            <input type="hidden" id="navadmodel-ad_image" class="form-control" name="NavAdModel[ad_image]" value="{{ $info->ad_image ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最佳显示尺寸180*250像素，建议上传jpg、jpeg、gif、png格式</div></div>
                    </div>
                </div>
            </div>
            <!-- 广告链接 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navadmodel-ad_link" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">广告链接：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navadmodel-ad_link" class="form-control" name="NavAdModel[ad_link]" placeholder="" value="{{ $info->ad_link ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">示例：http://www.xxx.com</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navadmodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="NavAdModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="navadmodel-is_show" class="form-control b-n"
                                                   name="NavAdModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="navadmodel-is_show" class="form-control b-n"
                                                   name="NavAdModel[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 广告排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navadmodel-ad_sort" class="col-sm-4 control-label">

                        <span class="ng-binding">广告排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navadmodel-ad_sort" class="form-control small" name="NavAdModel[ad_sort]" value="{{ $info->ad_sort ?? 255}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围0~255，数字越小越靠前</div></div>
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

                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交" />

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
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "navadmodel-ad_name", "name": "NavAdModel[ad_name]", "attribute": "ad_name", "rules": {"required":true,"messages":{"required":"广告名称不能为空。"}}},{"id": "navadmodel-ad_link", "name": "NavAdModel[ad_link]", "attribute": "ad_link", "rules": {"required":true,"messages":{"required":"广告链接不能为空。"}}},{"id": "navadmodel-ad_image", "name": "NavAdModel[ad_image]", "attribute": "ad_image", "rules": {"required":true,"messages":{"required":"广告图片不能为空。"}}},{"id": "navadmodel-category_id", "name": "NavAdModel[category_id]", "attribute": "category_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"首页分类ID必须是整数。"}}},{"id": "navadmodel-is_show", "name": "NavAdModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "navadmodel-ad_name", "name": "NavAdModel[ad_name]", "attribute": "ad_name", "rules": {"string":true,"messages":{"string":"广告名称必须是一条字符串。","maxlength":"广告名称只能包含至多255个字符。"},"maxlength":255}},{"id": "navadmodel-ad_image", "name": "NavAdModel[ad_image]", "attribute": "ad_image", "rules": {"string":true,"messages":{"string":"广告图片必须是一条字符串。","maxlength":"广告图片只能包含至多255个字符。"},"maxlength":255}},{"id": "navadmodel-ad_link", "name": "NavAdModel[ad_link]", "attribute": "ad_link", "rules": {"string":true,"messages":{"string":"广告链接必须是一条字符串。","maxlength":"广告链接只能包含至多255个字符。"},"maxlength":255}},{"id": "navadmodel-ad_height", "name": "NavAdModel[ad_height]", "attribute": "ad_height", "rules": {"string":true,"messages":{"string":"广告高度必须是一条字符串。","maxlength":"广告高度只能包含至多255个字符。"},"maxlength":255}},{"id": "navadmodel-ad_sort", "name": "NavAdModel[ad_sort]", "attribute": "ad_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"广告排序必须是整数。","min":"广告排序必须不小于0。","max":"广告排序必须不大于255。"},"min":0,"max":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#NavAdModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#NavAdModel").submit();
            });

            $("#imagegroup_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: $(this).data("size"),
                values: $('#navadmodel-ad_image').val().split("|"),
                gallery: true,
                // 回调函数
                callback: function(data) {
                    console.info(data);
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#navadmodel-ad_image').val(values);
                    $.validator.clearError($("#navadmodel-ad_image"));
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#navadmodel-ad_image').val(values);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop