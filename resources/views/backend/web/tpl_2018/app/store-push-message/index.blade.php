{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="PushMessageModel" class="form-horizontal" name="PushMessageModel" action="/app/store-push-message/index" method="post" enctype="multipart/form-data" novalidate="novalidate">
            @csrf
            <!-- 推送标题-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="pushmessagemodel-title" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">推送标题：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="pushmessagemodel-title" class="form-control" name="PushMessageModel[title]">
                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 推送内容 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="pushmessagemodel-content" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">推送内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="pushmessagemodel-content" class="form-control" name="PushMessageModel[content]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 推送对象 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="pushmessagemodel-platforms" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">推送对象平台：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <table class="table-list table-hover">
                                <tbody><tr>
                                    <td><input type="hidden" name="PushMessageModel[platforms]" value="0"><div id="pushmessagemodel-platforms" class="m-b-10" name="PushMessageModel[platforms]"><label class="control-label cur-p m-r-10"><input type="checkbox" name="PushMessageModel[platforms][]" value="ios" checked=""> IOS</label>
                                            <label class="control-label cur-p m-r-10"><input type="checkbox" name="PushMessageModel[platforms][]" value="android" checked=""> Android</label></div></td>
                                </tr>
                                <tr>
                                    <td><input type="hidden" name="PushMessageModel[target_type]" value="0"><div id="pushmessagemodel-target_type" class="m-b-10" name="PushMessageModel[target_type]"><label class="control-label cur-p m-r-10"><input type="radio" name="PushMessageModel[target_type]" value="all" checked=""> 广播（所有人）</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="PushMessageModel[target_type]" value="alias"> 设备别名(Alias)</label></div></td>
                                </tr>
                                <tr style="display: none" class="target_text">
                                    <td><input type="text" id="pushmessagemodel-target_text" class="form-control" name="PushMessageModel[target_text]" placeholder="如有多个设备标签或别名请用英文半角逗号(,)隔开"></td>
                                </tr>
                                <tr style="display: none" class="target_text">
                                    <td>
                                        <div class="help-block help-block-t">填写格式：xinge+会员编号。例如会员编号为111，应填写“xinge111”。只有在该用户登录状态下的APP终端会收到消息</div>
                                    </td>
                                </tr>
                                </tbody></table>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交">

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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.3"></script>
    <!-- 商品选择器 -->
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.3"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "pushmessagemodel-title", "name": "PushMessageModel[title]", "attribute": "title", "rules": {"required":true,"messages":{"required":"推送标题不能为空。"}}},{"id": "pushmessagemodel-content", "name": "PushMessageModel[content]", "attribute": "content", "rules": {"required":true,"messages":{"required":"推送内容不能为空。"}}},{"id": "pushmessagemodel-push_type", "name": "PushMessageModel[push_type]", "attribute": "push_type", "rules": {"required":true,"messages":{"required":"推送类型不能为空。"}}},{"id": "pushmessagemodel-platforms", "name": "PushMessageModel[platforms]", "attribute": "platforms", "rules": {"required":true,"messages":{"required":"推送对象平台不能为空。"}}},{"id": "pushmessagemodel-target_type", "name": "PushMessageModel[target_type]", "attribute": "target_type", "rules": {"required":true,"messages":{"required":"推送对象条件不能为空。"}}},{"id": "pushmessagemodel-sales_type", "name": "PushMessageModel[sales_type]", "attribute": "sales_type", "rules": {"required":true,"messages":{"required":"Sales Type不能为空。"}}},{"id": "pushmessagemodel-sales_name", "name": "PushMessageModel[sales_name]", "attribute": "sales_name", "rules": {"required":true,"messages":{"required":"计划名称不能为空。"}}},{"id": "pushmessagemodel-group_id", "name": "PushMessageModel[group_id]", "attribute": "group_id", "rules": {"required":true,"messages":{"required":"选择人群不能为空。"}}},{"id": "pushmessagemodel-push_type", "name": "PushMessageModel[push_type]", "attribute": "push_type", "rules": {"string":true,"messages":{"string":"推送类型必须是一条字符串。"}}},{"id": "pushmessagemodel-platforms", "name": "PushMessageModel[platforms]", "attribute": "platforms", "rules": {"string":true,"messages":{"string":"推送对象平台必须是一条字符串。"}}},{"id": "pushmessagemodel-title", "name": "PushMessageModel[title]", "attribute": "title", "rules": {"string":true,"messages":{"string":"推送标题必须是一条字符串。","maxlength":"推送标题只能包含至多15个字符。"},"maxlength":15}},{"id": "pushmessagemodel-content", "name": "PushMessageModel[content]", "attribute": "content", "rules": {"string":true,"messages":{"string":"推送内容必须是一条字符串。","maxlength":"推送内容只能包含至多255个字符。"},"maxlength":255}},{"id": "pushmessagemodel-target_text", "name": "PushMessageModel[target_text]", "attribute": "target_text", "rules": {"string":true,"messages":{"string":"设备标签或别名必须是一条字符串。","maxlength":"设备标签或别名只能包含至多255个字符。"},"maxlength":255}},{"id": "pushmessagemodel-push_type", "name": "PushMessageModel[push_type]", "attribute": "push_type", "rules": {"required":true,"messages":{"required":"推送类型不能为空。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#PushMessageModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                $.loading.start();
                $.ajax({
                    cache: false,
                    type: "POST",
                    data: $("#PushMessageModel").serialize(),
                    url: "index",
                    success: function(result) {
                        var result = eval('(' + result + ')');
                        if (result.code == 0) {
                            $.alert(result.message, {
                                icon: 1
                            }, function() {
                            });
                        } else {
                            $.alert(result.message, {
                                icon: 2
                            });
                        }
                    },
                    error: function(result) {
                        $.alert("异常", {
                            icon: 2
                        });
                    }
                });
            });
            //选择设备别名或者设备标签时显示的输入框
            $("input[name='PushMessageModel[target_type]']").click(function() {
                if ($(this).val() == 'tag' || $(this).val() == 'alias') {
                    $('.target_text').show();
                } else {
                    $('.target_text').hide();
                }
            })
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop