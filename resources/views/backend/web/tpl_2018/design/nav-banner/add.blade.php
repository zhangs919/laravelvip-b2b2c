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
        <form id="NavBannerModel" class="form-horizontal" name="NavBannerModel" action="{{ $form_action }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="navbannermodel-id" class="form-control" name="NavBannerModel[id]" value="{{ $info->id ?? ''}}">

            <!-- banner名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navbannermodel-banner_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">广告名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navbannermodel-banner_name" class="form-control" name="NavBannerModel[banner_name]" value="{{ $info->banner_name ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- banner大图 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navbannermodel-banner_image" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">广告图片：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="imagegroup_container" class="szy-imagegroup" data-size="1"></div>
                            <input type="hidden" id="navbannermodel-banner_image" class="form-control" name="NavBannerModel[banner_image]" value="{{ $info->banner_image ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最佳尺寸1920*443像素，允许上传的图片格式：jpg、jpeg、gif、png</div></div>
                    </div>
                </div>
            </div>
            <!-- 图片连接 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navbannermodel-banner_link" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">广告链接：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navbannermodel-banner_link" class="form-control" name="NavBannerModel[banner_link]" value="{{ $info->banner_link ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">输入外链时请加http://</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navbannermodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="NavBannerModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="navbannermodel-is_show" class="form-control b-n"
                                                   name="NavBannerModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="navbannermodel-is_show" class="form-control b-n"
                                                   name="NavBannerModel[is_show]" value="1" checked data-on-text="是"
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
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navbannermodel-banner_sort" class="col-sm-4 control-label">

                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navbannermodel-banner_sort" class="form-control small" name="NavBannerModel[banner_sort]" value="{{ $info->banner_sort ?? 255}}">


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
	<style>
		.platform-footer {
			display: none
		}
	</style>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "navbannermodel-banner_name", "name": "NavBannerModel[banner_name]", "attribute": "banner_name", "rules": {"required":true,"messages":{"required":"广告名称不能为空。"}}},{"id": "navbannermodel-banner_link", "name": "NavBannerModel[banner_link]", "attribute": "banner_link", "rules": {"required":true,"messages":{"required":"广告链接不能为空。"}}},{"id": "navbannermodel-banner_image", "name": "NavBannerModel[banner_image]", "attribute": "banner_image", "rules": {"required":true,"messages":{"required":"广告图片不能为空。"}}},{"id": "navbannermodel-banner_height", "name": "NavBannerModel[banner_height]", "attribute": "banner_height", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"广告高度必须是整数。"}}},{"id": "navbannermodel-banner_sort", "name": "NavBannerModel[banner_sort]", "attribute": "banner_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "navbannermodel-site_id", "name": "NavBannerModel[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点id必须是整数。"}}},{"id": "navbannermodel-is_show", "name": "NavBannerModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "navbannermodel-banner_name", "name": "NavBannerModel[banner_name]", "attribute": "banner_name", "rules": {"string":true,"messages":{"string":"广告名称必须是一条字符串。","maxlength":"广告名称只能包含至多255个字符。"},"maxlength":255}},{"id": "navbannermodel-banner_image", "name": "NavBannerModel[banner_image]", "attribute": "banner_image", "rules": {"string":true,"messages":{"string":"广告图片必须是一条字符串。","maxlength":"广告图片只能包含至多255个字符。"},"maxlength":255}},{"id": "navbannermodel-banner_link", "name": "NavBannerModel[banner_link]", "attribute": "banner_link", "rules": {"string":true,"messages":{"string":"广告链接必须是一条字符串。","maxlength":"广告链接只能包含至多255个字符。"},"maxlength":255}},{"id": "navbannermodel-nav_page", "name": "NavBannerModel[nav_page]", "attribute": "nav_page", "rules": {"string":true,"messages":{"string":"所属页面必须是一条字符串。","maxlength":"所属页面只能包含至多255个字符。"},"maxlength":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#NavBannerModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#NavBannerModel").submit();

            });

            $("#imagegroup_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: $(this).data("size"),
                values: $('#navbannermodel-banner_image').val().split("|"),
                gallery: true,
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#navbannermodel-banner_image').val(values);
                    $.validator.clearError($("#navbannermodel-banner_image"));
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#navbannermodel-banner_image').val(values);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop