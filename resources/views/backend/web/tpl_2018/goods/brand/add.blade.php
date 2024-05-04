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
        <form id="BrandModel" class="form-horizontal" name="BrandModel" action="/goods/brand/add" method="post" enctype="multipart/form-data" novalidate="novalidate">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="brandmodel-brand_id" class="form-control" name="BrandModel[brand_id]" value="{{ $info->brand_id ?? ''}}">
            <!-- 品牌名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="brandmodel-brand_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">品牌名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="brandmodel-brand_name" class="form-control valid" name="BrandModel[brand_name]" value="{{ $info->brand_name ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 品牌首字母 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="brandmodel-brand_letter" class="col-sm-4 control-label">

                        <span class="ng-binding">首字母：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="brandmodel-brand_letter" class="form-control" name="BrandModel[brand_letter]" value="{{ $info->brand_letter ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果置空，系统将自动生成品牌的首字母，对于部分生僻字系统可能无法自动生成首字母，请您自行设置</div></div>
                    </div>
                </div>
            </div>
            <!-- 品牌网址 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="brandmodel-site_url" class="col-sm-4 control-label">

                        <span class="ng-binding">品牌网址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="brandmodel-site_url" class="form-control" name="BrandModel[site_url]" value="{{ $info->site_url ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 品牌Logo -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="brandmodel-brand_logo" class="col-sm-4 control-label">

                        <span class="ng-binding">品牌logo：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->
                            <div id="brand_logo_imagegroup_container" class="szy-imagegroup" data-id="brandmodel-brand_logo" data-size="1"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                            <input type="hidden" id="brandmodel-brand_logo" class="form-control" name="BrandModel[brand_logo]" value="{{ $info->brand_logo ?? ''}}">
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请上传图片，做为品牌的LOGO，建议尺寸100*40像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 品牌推广图 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="brandmodel-promotion_image" class="col-sm-4 control-label">

                        <span class="ng-binding">品牌推广图：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->
                            <div id="promotion_image_imagegroup_container" class="szy-imagegroup"
                                 data-id="brandmodel-promotion_image" data-size="1">
                                <ul class="image-group">
                                    <li class="image-group-button" data-label-index="0" title="点击并选择上传的图片">
                                        <div class="image-group-bg"></div>
                                    </li>
                                </ul>
                            </div>
                            <input type="hidden" id="brandmodel-promotion_image" class="form-control" name="BrandModel[promotion_image]" value="{{ $info->promotion_image ?? ''}}">
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">品牌推广图，建议尺寸300*200像素，设置品牌推广图，该品牌会在品牌专区显示，否则不展示</div></div>
                    </div>
                </div>
            </div>
            <!-- 品牌描述 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="brandmodel-brand_desc" class="col-sm-4 control-label">

                        <span class="ng-binding">品牌描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="brandmodel-brand_desc" class="form-control" name="BrandModel[brand_desc]" rows="5">{{ $info->brand_desc ?? ''}}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 是否显示
            <div class="simple-form-field" >
    <div class="form-group">
    <label for="brandmodel-is_show" class="col-sm-4 control-label">

    <span class="ng-binding">是否显示：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">

            <label class="control-label control-label-switch">
    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
    <input type="hidden" name="BrandModel[is_show]" value="0"><label><input type="checkbox" id="brandmodel-is_show" class="form-control b-n" name="BrandModel[is_show]" value="1" checked data-on-text="是" data-off-text="否"> </label>
    </div>
    </label>

    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">当品牌下还没有商品的时候，首页及分类页的品牌区将不会显示该品牌</div></div>
    </div>
    </div>
    </div>
             -->
            <!-- 是否推荐 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="brandmodel-is_recommend" class="col-sm-4 control-label">

                        <span class="ng-binding">是否推荐：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="BrandModel[is_recommend]" value="0">
                                    <label>
                                        @if(isset($info->is_recommend))
                                            <input type="checkbox" id="brandmodel-is_recommend" class="form-control b-n"
                                                   name="BrandModel[is_recommend]" value="1" @if($info->is_recommend == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="brandmodel-is_recommend" class="form-control b-n"
                                                   name="BrandModel[is_recommend]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制该品牌在品牌专区页面头部轮播展示区展示</div></div>
                    </div>
                </div>
            </div>
            <!-- 审核是否通过
            <div class="simple-form-field" >
    <div class="form-group">
    <label for="brandmodel-brand_apply" class="col-sm-4 control-label">

    <span class="ng-binding">审核是否通过：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">

            <label class="control-label control-label-switch">
    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
    <input type="hidden" name="BrandModel[brand_apply]" value="0"><label><input type="checkbox" id="brandmodel-brand_apply" class="form-control b-n" name="BrandModel[brand_apply]" value="1" checked data-on-text="是" data-off-text="否"> </label>
    </div>
    </label>

    </div>

    <div class="help-block help-block-t"></div>
    </div>
    </div>
    </div>
             -->
            <!-- 审核是否通过 -->
            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="brandmodel-brand_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="brandmodel-brand_sort" class="form-control small" name="BrandModel[brand_sort]" value="{{ $info->brand_sort ?? '255'}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~9999，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!---->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
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


{{--自定义css样式--}}
@section('style_css')

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
    <script type="text/javascript">
        $(".szy-imagegroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");

            var target = $("#" + id);
            var value = $(target).val();

            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: size,
                values: value.split("|"),
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                }
            });
        });
    </script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    @if(isset($info->brand_id))
        [{"id": "brandmodel-brand_id", "name": "BrandModel[brand_id]", "attribute": "brand_id", "rules": {"required":true,"messages":{"required":"品牌ID不能为空。"}}},{"id": "brandmodel-brand_name", "name": "BrandModel[brand_name]", "attribute": "brand_name", "rules": {"required":true,"messages":{"required":"品牌名称不能为空。"}}},{"id": "brandmodel-brand_sort", "name": "BrandModel[brand_sort]", "attribute": "brand_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "brandmodel-brand_desc", "name": "BrandModel[brand_desc]", "attribute": "brand_desc", "rules": {"string":true,"messages":{"string":"品牌描述必须是一条字符串。","maxlength":"品牌描述只能包含至多100个字符。"},"maxlength":100}},{"id": "brandmodel-is_recommend", "name": "BrandModel[is_recommend]", "attribute": "is_recommend", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否推荐必须是整数。"}}},{"id": "brandmodel-brand_sort", "name": "BrandModel[brand_sort]", "attribute": "brand_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "brandmodel-is_show", "name": "BrandModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "brandmodel-brand_apply", "name": "BrandModel[brand_apply]", "attribute": "brand_apply", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"审核是否通过必须是整数。"}}},{"id": "brandmodel-brand_name", "name": "BrandModel[brand_name]", "attribute": "brand_name", "rules": {"string":true,"messages":{"string":"品牌名称必须是一条字符串。","maxlength":"品牌名称只能包含至多20个字符。"},"maxlength":20}},{"id": "brandmodel-brand_banner", "name": "BrandModel[brand_banner]", "attribute": "brand_banner", "rules": {"string":true,"messages":{"string":"品牌展示图必须是一条字符串。","maxlength":"品牌展示图只能包含至多255个字符。"},"maxlength":255}},{"id": "brandmodel-site_url", "name": "BrandModel[site_url]", "attribute": "site_url", "rules": {"string":true,"messages":{"string":"品牌网址必须是一条字符串。","maxlength":"品牌网址只能包含至多255个字符。"},"maxlength":255}},{"id": "brandmodel-site_url", "name": "BrandModel[site_url]", "attribute": "site_url", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"请输入一个有效的网址，例如：http://www.laravelvip.com"}}},{"id": "brandmodel-brand_sort", "name": "BrandModel[brand_sort]", "attribute": "brand_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于9999。"},"min":0,"max":9999}},{"id": "brandmodel-brand_letter", "name": "BrandModel[brand_letter]", "attribute": "brand_letter", "rules": {"string":true,"messages":{"string":"首字母必须是一条字符串。","minlength":"首字母应该包含至少1个字符。","maxlength":"首字母只能包含至多1个字符。"},"minlength":1,"maxlength":1}},{"id": "brandmodel-brand_name", "name": "BrandModel[brand_name]", "attribute": "brand_name", "rules": {"ajax":{"url":"/goods/brand/client-validate","model":"YXBwXG1vZHVsZXNcZ29vZHNcbW9kZWxzXEJyYW5kTW9kZWw=","attribute":"brand_name","params":["BrandModel[brand_id]"],"scenario":"update"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @else
        [{"id": "brandmodel-brand_name", "name": "BrandModel[brand_name]", "attribute": "brand_name", "rules": {"required":true,"messages":{"required":"品牌名称不能为空。"}}},{"id": "brandmodel-brand_sort", "name": "BrandModel[brand_sort]", "attribute": "brand_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "brandmodel-brand_desc", "name": "BrandModel[brand_desc]", "attribute": "brand_desc", "rules": {"string":true,"messages":{"string":"品牌描述必须是一条字符串。","maxlength":"品牌描述只能包含至多100个字符。"},"maxlength":100}},{"id": "brandmodel-is_recommend", "name": "BrandModel[is_recommend]", "attribute": "is_recommend", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否推荐必须是整数。"}}},{"id": "brandmodel-brand_sort", "name": "BrandModel[brand_sort]", "attribute": "brand_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "brandmodel-is_show", "name": "BrandModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "brandmodel-brand_apply", "name": "BrandModel[brand_apply]", "attribute": "brand_apply", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"审核是否通过必须是整数。"}}},{"id": "brandmodel-brand_name", "name": "BrandModel[brand_name]", "attribute": "brand_name", "rules": {"string":true,"messages":{"string":"品牌名称必须是一条字符串。","maxlength":"品牌名称只能包含至多20个字符。"},"maxlength":20}},{"id": "brandmodel-brand_banner", "name": "BrandModel[brand_banner]", "attribute": "brand_banner", "rules": {"string":true,"messages":{"string":"品牌展示图必须是一条字符串。","maxlength":"品牌展示图只能包含至多255个字符。"},"maxlength":255}},{"id": "brandmodel-site_url", "name": "BrandModel[site_url]", "attribute": "site_url", "rules": {"string":true,"messages":{"string":"品牌网址必须是一条字符串。","maxlength":"品牌网址只能包含至多255个字符。"},"maxlength":255}},{"id": "brandmodel-site_url", "name": "BrandModel[site_url]", "attribute": "site_url", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"请输入一个有效的网址，例如：http://www.laravelvip.com"}}},{"id": "brandmodel-brand_sort", "name": "BrandModel[brand_sort]", "attribute": "brand_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于9999。"},"min":0,"max":9999}},{"id": "brandmodel-brand_letter", "name": "BrandModel[brand_letter]", "attribute": "brand_letter", "rules": {"string":true,"messages":{"string":"首字母必须是一条字符串。","minlength":"首字母应该包含至少1个字符。","maxlength":"首字母只能包含至多1个字符。"},"minlength":1,"maxlength":1}},{"id": "brandmodel-brand_name", "name": "BrandModel[brand_name]", "attribute": "brand_name", "rules": {"ajax":{"url":"/goods/brand/client-validate","model":"YXBwXG1vZHVsZXNcZ29vZHNcbW9kZWxzXEJyYW5kTW9kZWw=","attribute":"brand_name","params":[],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @endif
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

            var validator = $("#BrandModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                //清空文件
                $("#brandmodel-brand_file").val("");
                $("#BrandModel").submit();

            });
            // 单图AJAX上传 + 上传后预览图片
            /**
             $("body").on("change", "#brandmodel-brand_logo_file", function() {
			if ($("#brandmodel-brand_logo_file").val().length > 0 && $(this).valid()) {
				$.ajaxFileUpload({
					url: 'upload',
					fileElementId: "brandmodel-brand_logo_file",
					dataType: 'json',
					success: function(result, status) {
						if (result.code == 0 && result.data) {
							var url = result.data.url;
							var value = result.data.value;
							$("#brandmodel-brand_logo_file_image").attr("ref", url);
							$("#brandmodel-brand_logo").val(value);
						} else if (result.message) {
							// 显示错误信息
							$.validator.showError($("#brandmodel-brand_logo_file"), result.message);
						}
					},
				});
			}
			return true;
		});

             //单图AJAX上传 + 上传后预览图片
             var fileElementId = "brandmodel-brand_logo_file";
             var fieldElementId = "brandmodel-brand_logo";
             $("body").on("change", "#"+fileElementId, function() {
			if ($("#"+fileElementId).val().length > 0 && $(this).valid()) {
				$.ajaxFileImageUpload({
					fileElementId: fileElementId,
					fieldElementId: fieldElementId
				});
			}
			return true;
		});
             **/
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop