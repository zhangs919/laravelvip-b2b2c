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

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=log" method="post" enctype="multipart/form-data" novalidate="novalidate">
        {{ csrf_field() }}
        <input type="hidden" name="group" value="log">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-log_target" class="col-sm-4 control-label">

                        <span class="ng-binding">日志记录方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[log_target]" value="0"><div id="systemconfigmodel-log_target" class="" name="SystemConfigModel[log_target]"><label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[log_target]" value="0"> 关闭日志</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[log_target]" value="1" checked=""> 存储至数据库</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t"><ul><li>日志可以选择记录在文件中或者数据库中，如果需要减轻系统负担您可以关闭日志</li></ul></div></div>
                    </div>
                </div>
            </div>






            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="/system/log/set">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>

        </div></form>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--自定义css样式 page元素内--}}
@section('style_css')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')
    @include('layouts.partials.helper_tool')
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
    [{"id": "systemconfigmodel-log_target", "name": "SystemConfigModel[log_target]", "attribute": "log_target", "rules": {"string":true,"messages":{"string":"日志记录方式必须是一条字符串。"}}},]
    </script>




    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#SystemConfigModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                validator.form();
                if (!validator.form()) {
                    return;
                }
                $.loading.start();
                $("#SystemConfigModel").submit();
                /**
                 var data = $("#SystemConfigModel").serializeJson();
                 $.post('/system/config/index', data, function(result) {
				if (result.code == 0) {
					$.msg(result.message, {
						icon: 1
					});
				} else {
					$.alert(result.message, {
						icon: 2
					});
				}
			}, "json");
                 **/
            });

            $(".szy-imagegroup").each(function() {
                var id = $(this).data("id");
                var size = $(this).data("size");
                var mode = $(this).data("mode");
                var labels = $(this).data("labels");
                var target = $("#" + id);
                var value = $(target).val() ;
                var options = $(this).data("options") ? $(this).data("options") : [];
                $(this).imagegroup({
                    host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/",
                    size: size,
                    mode: mode,
                    labels: labels,
                    options: options,
                    gallery: true,
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

            $(".szy-videogroup").each(function() {
                var id = $(this).data("id");
                var size = $(this).data("size");
                var mode = $(this).data("mode");
                var labels = $(this).data("labels");

                var target = $("#" + id);
                var value = $(target).val() ;

                var options = $(this).data("options") ? $(this).data("options") : [];

                $(this).videogroup({
                    host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/",
                    size: size,
                    mode: mode,
                    labels: labels,
                    options: options,
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
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop