{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190319"/>
@stop

{{--content--}}
@section('content')

    <form id="ActivityModel" class="form-horizontal" name="ActivityModel" action="/dashboard/group-buy/view.html?id={{ $info->act_id }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
        @csrf

        <div class="table-content m-t-30 clearfix">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="activitymodel-act_id" class="form-control" name="ActivityModel[act_id]" value="{{ $info->act_id }}">
                <!-- 活动名称 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="activitymodel-act_name" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动名称：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="activitymodel-act_name" class="form-control" name="ActivityModel[act_name]" value="{{ $info->act_name }}" disabled="">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 活动标题 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="activitymodel-act_title" class="col-sm-4 control-label">

                            <span class="ng-binding">活动标题：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="activitymodel-act_title" class="form-control" name="ActivityModel[act_title]" value="{{ $info->act_title }}" disabled="">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div> <div class="simple-form-field">
                    <div class="form-group">
                        <label for="activitymodel-start_time" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动开始时间：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <input type="text" id="start_time" class="form-control form_datetime large m-r-10" name="ActivityModel[start_time]" value="{{ $info->start_time }}" disabled="" data-rule-date="true" data-rule-dateiso="true"> 至 <input type="text" id="end_time" class="form-control form_datetime large m-l-10" name="ActivityModel[end_time]" value="{{ $info->end_time }}" disabled="" data-rule-date="true" data-rule-dateiso="true">
                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 限购数量 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="activitymodel-purchase_num" class="col-sm-4 control-label">

                            <span class="ng-binding">限购数量：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="activitymodel-purchase_num" class="form-control ipt" name="ActivityModel[purchase_num]" value="{{ $info->purchase_num }}" disabled="">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 图片 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="activitymodel-act_img" class="col-sm-4 control-label">

                            <span class="ng-binding">活动图片：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <img src="{{ get_image_url($info->act_img) }}" >


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

                @include('dashboard.group-buy.partials._view_list')

                <script type="text/javascript">
                    var tablelist;
                    $().ready(function() {
                        tablelist = $("#table_list").tablelist({
                            // 支持保存查询条件
                            params: $("#searchForm").serializeJson()
                        });
                        // 搜索
                        $("#searchForm").submit(function() {
                            // 序列化表单为JSON对象
                            var data = $(this).serializeJson();
                            // Ajax加载数据
                            tablelist.load(data);
                            // 阻止表单提交
                            return false;
                        });
                    })
                </script>

            </div>
        </div>

    </form>

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


{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=1.2"> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
    <!-- 时间插件引入 end -->
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script> <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <script id="client_rules" type="text">
[{"id": "activitymodel-act_name", "name": "ActivityModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"活动名称不能为空。"}}},{"id": "activitymodel-start_time", "name": "ActivityModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动开始时间不能为空。"}}},{"id": "activitymodel-end_time", "name": "ActivityModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"活动结束时间不能为空。"}}},{"id": "activitymodel-purchase_num", "name": "ActivityModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购数量必须是整数。"}}},{"id": "activitymodel-ext_info", "name": "ActivityModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "activitymodel-act_name", "name": "ActivityModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多255个字符。"},"maxlength":255}},{"id": "activitymodel-act_title", "name": "ActivityModel[act_title]", "attribute": "act_title", "rules": {"string":true,"messages":{"string":"活动标题必须是一条字符串。","maxlength":"活动标题只能包含至多255个字符。"},"maxlength":255}},{"id": "activitymodel-reason", "name": "ActivityModel[reason]", "attribute": "reason", "rules": {"string":true,"messages":{"string":"审核意见必须是一条字符串。","maxlength":"审核意见只能包含至多255个字符。"},"maxlength":255}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ActivityModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                $.loading.start();
            });

            $("body").on("mouseover", ".QR-code", function() {
                if ($(this).data("loading")) {
                    return;
                }
                var target = $(this).find("img");
                var src = $(target).data("src");
                var img = new Image();
                img.src = src;
                img.onload = function() {
                    $(target).attr("src", src);
                };
                $(this).data("loading", true);
            });
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop