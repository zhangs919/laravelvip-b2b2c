{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <form id="UserRankModel" class="form-horizontal" name="UserRankModel" action="/user/user-rank/add" method="post" enctype="multipart/form-data" novalidate="novalidate">
        @csrf
        <div class="table-content m-t-30 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="userrankmodel-rank_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">等级名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="userrankmodel-rank_name" class="form-control" name="UserRankModel[rank_name]" value="{{ $info->rank_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">2~16个字符，支持中英文及数字</div></div>
                    </div>
                </div>
            </div>

            <!-- 等级图标 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="userrankmodel-rank_img" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">等级图标：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            @if(!empty($info->rank_img))
                                <!-- 图片组 start -->
                                <div id="rank_img_imagegroup_container" class="szy-imagegroup" data-id="userrankmodel-rank_img" data-size="1"><ul class="image-group"><li data-label-index="0" title="点击预览图片"><span title="删除图片" class="image-group-remove">删除图片</span><a href="javascript:void(0);" data-value="{{ get_image_url($info->rank_img) }}" data-url="{{ get_image_url($info->rank_img) }}"><img src="{{ get_image_url($info->rank_img) }}" data-value="{{ get_image_url($info->rank_img) }}" data-url="{{ get_image_url($info->rank_img) }}"></a></li><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片" style="display: none;"><div class="image-group-bg"></div></li></ul></div>
                                <input type="hidden" id="userrankmodel-rank_img" class="form-control" name="UserRankModel[rank_img]" value="{{ $info->rank_img }}">
                                <!-- 图片组 end -->
                            @else
                                <!-- 图片组 start -->
                                <div id="rank_img_imagegroup_container" class="szy-imagegroup" data-id="userrankmodel-rank_img" data-size="1"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                                <input type="hidden" id="userrankmodel-rank_img" class="form-control" name="UserRankModel[rank_img]">
                                <!-- 图片组 end -->
                        @endif


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">为保证页面美观，建议上传宽度最大尺寸为100，高度最大尺寸为20像素的图片</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否特殊会员等级 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="userrankmodel-is_special" class="col-sm-4 control-label">

                        <span class="ng-binding">特殊会员等级：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            @if(isset($info->rank_id))
                            <label class="control-label">@if($info->is_special == 1) 是 @else 否 @endif</label>
                            <input type="hidden" id="userrankmodel-is_special" class="form-control" name="UserRankModel[is_special]" value="{{ $info->is_special }}">
                            @else
                                <input type="hidden" name="UserRankModel[is_special]" value="">
                                <div id="userrankmodel-is_special" class="" name="UserRankModel[is_special]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="UserRankModel[is_special]" value="1"> 是</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="UserRankModel[is_special]" value="0" checked=""> 否</label>
                                </div>
                            @endif

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">特殊会员等级的会员是不随着成长值变化而变化</div></div>
                    </div>
                </div>
            </div>
            <div id="points-div" @if(@$info->is_special == 1) style="display: none;" @endif>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">

                            <span class="ng-binding">成长值范围：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="point_type" name="point_type" class="form-control m-r-5">
                                    <option value="0" @if(@$info->type == 0) selected="selected" @endif>介于</option>
                                    <option value="1" @if(@$info->type == 1) selected="selected" @endif>大于</option>
                                </select>
                                <input type="text" id="userrankmodel-min_points" class="form-control ipt" name="UserRankModel[min_points]" value="{{ $info->min_points ?? '0' }}">
                                <span class="ctime point_type_0">至</span>
                                <input type="text" id="userrankmodel-max_points" class="form-control ipt point_type_0" name="UserRankModel[max_points]" value="{{ $info->max_points ?? '0' }}">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary">
                        @if(isset($info->rank_id))
                        <!-- 隐藏域，标识作用 -->
                        <input type="hidden" id="userrankmodel-rank_id" class="form-control" name="UserRankModel[rank_id]" value="{{ $info->rank_id }}">
                        @endif

                        <input type="hidden" id="userrankmodel-type" class="form-control" name="UserRankModel[type]" value="0">
                    </div>
                </div>
            </div>
        </div>
    </form>

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
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
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
    @if(isset($info->rank_id))
    [{"id": "userrankmodel-rank_name", "name": "UserRankModel[rank_name]", "attribute": "rank_name", "rules": {"required":true,"messages":{"required":"等级名称不能为空。"}}},{"id": "userrankmodel-min_points", "name": "UserRankModel[min_points]", "attribute": "min_points", "rules": {"required":true,"messages":{"required":"成长值下限不能为空。"}}},{"id": "userrankmodel-rank_name", "name": "UserRankModel[rank_name]", "attribute": "rank_name", "rules": {"string":true,"messages":{"string":"等级名称必须是一条字符串。","minlength":"等级名称应该包含至少2个字符。","maxlength":"等级名称只能包含至多16个字符。"},"minlength":"2","maxlength":"16"}},{"id": "userrankmodel-is_special", "name": "UserRankModel[is_special]", "attribute": "is_special", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"特殊会员等级必须是整数。"}}},{"id": "userrankmodel-type", "name": "UserRankModel[type]", "attribute": "type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"等级类型必须是整数。"}}},{"id": "userrankmodel-point_type", "name": "UserRankModel[point_type]", "attribute": "point_type", "rules": {"in":{"range":["0","1"]},"messages":{"in":"Point Type是无效的。"}}},{"id": "userrankmodel-min_points", "name": "UserRankModel[min_points]", "attribute": "min_points", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"成长值下限必须是整数。","min":"成长值下限必须不小于0。","max":"成长值下限必须不大于2140000000。"},"min":0,"max":2140000000}},{"id": "userrankmodel-max_points", "name": "UserRankModel[max_points]", "attribute": "max_points", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"成长值上限必须是整数。","min":"成长值上限必须不小于0。","max":"成长值上限必须不大于2140000000。"},"min":0,"max":2140000000}},{"id": "userrankmodel-max_points", "name": "UserRankModel[max_points]", "attribute": "max_points", "rules": {"compare":{"operator":">=","type":"number","compareAttribute":"userrankmodel-min_points","skipOnEmpty":1},"messages":{"compare":"成长值上限的值必须大于或等于\"成长值下限\"。"}}},{"id": "userrankmodel-rank_name", "name": "UserRankModel[rank_name]", "attribute": "rank_name", "rules": {"ajax":{"url":"/user/user-rank/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlclJhbmtNb2RlbA==","attribute":"rank_name","params":["UserRankModel[type]","UserRankModel[rank_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "userrankmodel-rank_img", "name": "UserRankModel[rank_img]", "attribute": "rank_img", "rules": {"required":true,"messages":{"required":"等级图标不能为空。"}}},]
    @else
    [{"id": "userrankmodel-rank_name", "name": "UserRankModel[rank_name]", "attribute": "rank_name", "rules": {"required":true,"messages":{"required":"等级名称不能为空。"}}},{"id": "userrankmodel-min_points", "name": "UserRankModel[min_points]", "attribute": "min_points", "rules": {"required":true,"messages":{"required":"成长值下限不能为空。"}}},{"id": "userrankmodel-rank_name", "name": "UserRankModel[rank_name]", "attribute": "rank_name", "rules": {"string":true,"messages":{"string":"等级名称必须是一条字符串。","minlength":"等级名称应该包含至少2个字符。","maxlength":"等级名称只能包含至多16个字符。"},"minlength":"2","maxlength":"16"}},{"id": "userrankmodel-is_special", "name": "UserRankModel[is_special]", "attribute": "is_special", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"特殊会员等级必须是整数。"}}},{"id": "userrankmodel-type", "name": "UserRankModel[type]", "attribute": "type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"等级类型必须是整数。"}}},{"id": "userrankmodel-point_type", "name": "UserRankModel[point_type]", "attribute": "point_type", "rules": {"in":{"range":["0","1"]},"messages":{"in":"Point Type是无效的。"}}},{"id": "userrankmodel-min_points", "name": "UserRankModel[min_points]", "attribute": "min_points", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"成长值下限必须是整数。","min":"成长值下限必须不小于0。","max":"成长值下限必须不大于2140000000。"},"min":0,"max":2140000000}},{"id": "userrankmodel-max_points", "name": "UserRankModel[max_points]", "attribute": "max_points", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"成长值上限必须是整数。","min":"成长值上限必须不小于0。","max":"成长值上限必须不大于2140000000。"},"min":0,"max":2140000000}},{"id": "userrankmodel-max_points", "name": "UserRankModel[max_points]", "attribute": "max_points", "rules": {"compare":{"operator":">=","type":"number","compareAttribute":"userrankmodel-min_points","skipOnEmpty":1},"messages":{"compare":"成长值上限的值必须大于或等于\"成长值下限\"。"}}},{"id": "userrankmodel-rank_name", "name": "UserRankModel[rank_name]", "attribute": "rank_name", "rules": {"ajax":{"url":"/user/user-rank/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlclJhbmtNb2RlbA==","attribute":"rank_name","params":["UserRankModel[type]","UserRankModel[rank_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "userrankmodel-rank_img", "name": "UserRankModel[rank_img]", "attribute": "rank_img", "rules": {"required":true,"messages":{"required":"等级图标不能为空。"}}},]
    @endif
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#UserRankModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#UserRankModel").submit();
            });

            $("body").on("change", "#point_type", function() {
                var value = $(this).val();
                if (value == 0) {
                    $("#userrankmodel-max_points").val("{{ $info->max_points ?? '0' }}");
                    $(".point_type_0").show();
                } else {
                    $(".point_type_0").hide();
                    $("#userrankmodel-min_points").val("{{ $info->min_points ?? '0' }}");
                    $("#userrankmodel-max_points").val("2140000000");
                }
                $("#userrankmodel-max_points").focus();
                $("#userrankmodel-max_points").blur();
            });
            $("#point_type").change();

            $('input[name="UserRankModel[is_special]"]').click(function() {
                if ($(this).val() == 1) {
                    $("#points-div").hide();
                    $("#point_type").val(0);
                    $("#userrankmodel-min_points").val(0);
                    $("#userrankmodel-max_points").val(0);
                } else {
                    $("#points-div").show();
                }
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop