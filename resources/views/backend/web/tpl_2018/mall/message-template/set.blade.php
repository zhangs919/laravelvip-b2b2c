{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="MessageTemplate" class="form-horizontal" name="MessageTemplate" action="/mall/message-template/set?id={{ $info->id }}&amp;type={{ $type }}" method="post">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="messagetemplate-id" class="form-control" name="MessageTemplate[id]" value="{{ $info->id }}">

            <!-- 模板代码 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="messagetemplate-code" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">模板标识：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label">{{ $info->code }}</label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 模板名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="messagetemplate-name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">模板名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label">{{ $info->name }}</label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            @if($type == 'sys')
                <!-- 站内信模板内容 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="messagetemplate-sys_content" class="col-sm-4 control-label">

                            <span class="ng-binding">站内信模板内容：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <textarea id="messagetemplate-sys_content" class="form-control" name="MessageTemplate[sys_content]" rows="5">{!! $info->sys_content !!}</textarea>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 站内信开关 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="messagetemplate-sys_open" class="col-sm-4 control-label">

                            <span class="ng-binding">站内信开关：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="MessageTemplate[sys_open]" value="0">
                                        <label><input type="checkbox" id="messagetemplate-sys_open" class="form-control b-n" name="MessageTemplate[sys_open]" value="1" @if($info->sys_open == 1)checked @endif data-on-text="开" data-off-text="关"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            @elseif($type == 'sms')
                <!-- 短信模板内容 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="messagetemplate-sms_content" class="col-sm-4 control-label">

                            <span class="ng-binding">短信模板内容：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <textarea id="messagetemplate-sms_content" class="form-control" name="MessageTemplate[sms_content]" rows="5">{!! $info->sms_content !!}</textarea>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 短信开关 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="messagetemplate-sms_open" class="col-sm-4 control-label">

                            <span class="ng-binding">短信开关：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="MessageTemplate[sms_open]" value="0">
                                        <label><input type="checkbox" id="messagetemplate-sms_open" class="form-control b-n"
                                                      name="MessageTemplate[sms_open]" value="1" @if($info->sms_open == 1)checked @endif data-on-text="开" data-off-text="关"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 阿里大鱼模板代码 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="messagetemplate-aliyu_code" class="col-sm-4 control-label">

                            <span class="ng-binding">阿里云短信模板代码：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="messagetemplate-aliyu_code" class="form-control" name="MessageTemplate[aliyu_code]" value="{{ $info->aliyu_code }}">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">如果您对接了阿里大于短信服务，请输入其对应的模板ID</div></div>
                        </div>
                    </div>
                </div>
            @elseif($type == 'wx')
                <!-- 微信模板内容 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="messagetemplate-wx_code" class="col-sm-4 control-label">

                            <span class="ng-binding">微信模板消息：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="messagetemplate-wx_code" name="MessageTemplate[wx_code]" class="chosen-select template">
                                    <option value="">请选择模板消息</option>

                                    <option value="" selected></option>

                                </select>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">微信模板消息需要在微信公众号申请开通消息模版接口，具体如何操作请参考教程</div></div>
                        </div>
                    </div>
                </div>
                <div id='template_content'></div>
                <!-- 微信开关 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="messagetemplate-wx_open" class="col-sm-4 control-label">

                            <span class="ng-binding">微信开关：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="MessageTemplate[wx_open]" value="0">
                                        <label><input type="checkbox" id="messagetemplate-wx_open" class="form-control b-n"
                                                      name="MessageTemplate[wx_open]" value="1" @if($info->wx_open == 1)checked @endif data-on-text="开" data-off-text="关"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            @elseif($type == 'email')
                <!-- 邮件模板内容 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="messagetemplate-email_content" class="col-sm-4 control-label">

                            <span class="ng-binding">邮件模板内容：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <div class="form-control-box">
                                    <!-- 文本编辑器 -->
                                    <textarea id="email_content" class="form-control" name="MessageTemplate[email_content]" rows="5" style="width: 600px; height: 300px;">{!! $info->email_content !!}</textarea>
                                </div>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 邮件开关 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="messagetemplate-email_open" class="col-sm-4 control-label">

                            <span class="ng-binding">邮件开关：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="MessageTemplate[email_open]" value="0">
                                        <label><input type="checkbox" id="messagetemplate-email_open" class="form-control b-n"
                                                      name="MessageTemplate[email_open]" value="1" @if($info->email_open == 1)checked @endif data-on-text="开" data-off-text="关"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            @else

            @endif

            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交">
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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=201807241613"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=201807241613"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=201807241613"></script>
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=201807241613"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "messagetemplate-name", "name": "MessageTemplate[name]", "attribute": "name", "rules": {"required":true,"messages":{"required":"模板名称不能为空。"}}},{"id": "messagetemplate-code", "name": "MessageTemplate[code]", "attribute": "code", "rules": {"required":true,"messages":{"required":"模板标识不能为空。"}}},{"id": "messagetemplate-type", "name": "MessageTemplate[type]", "attribute": "type", "rules": {"required":true,"messages":{"required":"模板类型不能为空。"}}},{"id": "messagetemplate-msg_type", "name": "MessageTemplate[msg_type]", "attribute": "msg_type", "rules": {"required":true,"messages":{"required":"消息类型不能为空。"}}},{"id": "messagetemplate-type", "name": "MessageTemplate[type]", "attribute": "type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"模板类型必须是整数。"}}},{"id": "messagetemplate-msg_type", "name": "MessageTemplate[msg_type]", "attribute": "msg_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"消息类型必须是整数。"}}},{"id": "messagetemplate-sys_open", "name": "MessageTemplate[sys_open]", "attribute": "sys_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站内信开关必须是整数。"}}},{"id": "messagetemplate-sms_open", "name": "MessageTemplate[sms_open]", "attribute": "sms_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"短信开关必须是整数。"}}},{"id": "messagetemplate-email_open", "name": "MessageTemplate[email_open]", "attribute": "email_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"邮件开关必须是整数。"}}},{"id": "messagetemplate-wx_open", "name": "MessageTemplate[wx_open]", "attribute": "wx_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"微信开关必须是整数。"}}},{"id": "messagetemplate-last_modify", "name": "MessageTemplate[last_modify]", "attribute": "last_modify", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最后修改时间必须是整数。"}}},{"id": "messagetemplate-aliyu_code", "name": "MessageTemplate[aliyu_code]", "attribute": "aliyu_code", "rules": {"string":true,"messages":{"string":"阿里云短信模板代码必须是一条字符串。"}}},{"id": "messagetemplate-sys_content", "name": "MessageTemplate[sys_content]", "attribute": "sys_content", "rules": {"string":true,"messages":{"string":"站内信模板内容必须是一条字符串。"}}},{"id": "messagetemplate-sms_content", "name": "MessageTemplate[sms_content]", "attribute": "sms_content", "rules": {"string":true,"messages":{"string":"短信模板内容必须是一条字符串。"}}},{"id": "messagetemplate-email_content", "name": "MessageTemplate[email_content]", "attribute": "email_content", "rules": {"string":true,"messages":{"string":"邮件模板内容必须是一条字符串。"}}},{"id": "messagetemplate-wx_content", "name": "MessageTemplate[wx_content]", "attribute": "wx_content", "rules": {"string":true,"messages":{"string":"微信模板内容必须是一条字符串。"}}},{"id": "messagetemplate-code", "name": "MessageTemplate[code]", "attribute": "code", "rules": {"string":true,"messages":{"string":"模板标识必须是一条字符串。","maxlength":"模板标识只能包含至多255个字符。"},"maxlength":255}},{"id": "messagetemplate-explain", "name": "MessageTemplate[explain]", "attribute": "explain", "rules": {"string":true,"messages":{"string":"模板说明必须是一条字符串。","maxlength":"模板说明只能包含至多255个字符。"},"maxlength":255}},{"id": "messagetemplate-email_title", "name": "MessageTemplate[email_title]", "attribute": "email_title", "rules": {"string":true,"messages":{"string":"邮件标题(邮件)必须是一条字符串。","maxlength":"邮件标题(邮件)只能包含至多255个字符。"},"maxlength":255}},{"id": "messagetemplate-sys_spec", "name": "MessageTemplate[sys_spec]", "attribute": "sys_spec", "rules": {"string":true,"messages":{"string":"站内信说明必须是一条字符串。","maxlength":"站内信说明只能包含至多255个字符。"},"maxlength":255}},{"id": "messagetemplate-sms_spec", "name": "MessageTemplate[sms_spec]", "attribute": "sms_spec", "rules": {"string":true,"messages":{"string":"短信模板说明必须是一条字符串。","maxlength":"短信模板说明只能包含至多255个字符。"},"maxlength":255}},{"id": "messagetemplate-email_spec", "name": "MessageTemplate[email_spec]", "attribute": "email_spec", "rules": {"string":true,"messages":{"string":"邮件模板说明必须是一条字符串。","maxlength":"邮件模板说明只能包含至多255个字符。"},"maxlength":255}},{"id": "messagetemplate-wx_spec", "name": "MessageTemplate[wx_spec]", "attribute": "wx_spec", "rules": {"string":true,"messages":{"string":"微信模板说明必须是一条字符串。","maxlength":"微信模板说明只能包含至多255个字符。"},"maxlength":255}},{"id": "messagetemplate-name", "name": "MessageTemplate[name]", "attribute": "name", "rules": {"string":true,"messages":{"string":"模板名称必须是一条字符串。","maxlength":"模板名称只能包含至多30个字符。"},"maxlength":30}},{"id": "messagetemplate-code", "name": "MessageTemplate[code]", "attribute": "code", "rules": {"ajax":{"url":"/mall/message-template/client-validate","model":"Y29tbW9uXG1vZGVsc1xNZXNzYWdlVGVtcGxhdGU=","attribute":"code","params":["MessageTemplate[id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "messagetemplate-aliyu_code", "name": "MessageTemplate[aliyu_code]", "attribute": "aliyu_code", "rules": {"ajax":{"url":"/mall/message-template/client-validate","model":"Y29tbW9uXG1vZGVsc1xNZXNzYWdlVGVtcGxhdGU=","attribute":"aliyu_code","params":["MessageTemplate[id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
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
            var validator = $("#MessageTemplate").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();

                var data = $("#MessageTemplate").serializeJson();
                var url = $("#MessageTemplate").attr("action");
                $.post(url, data, function(result) {

                    $.loading.stop();

                    if (result.code == 0) {
                        $.msg(result.message);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });

            $(".template").change(function() {
                var wx_code = $(this).val();
                $.loading.start();

                $.ajax({
                    type: 'POST',
                    url: 'dis-template',
                    data: {
                        wx_code: wx_code
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.code > 0) {
                            $("#template_content").html('');
                        } else {
                            $("#template_content").html(result.data);
                        }

                    }
                }).always(function() {
                    $.loading.stop();
                });
            });
        });
    </script>

    @if($type == 'email')
        <script src="/assets/d2eace91/js/editor/kindeditor-all-min.js?v=201807241613"></script>
        <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=201807241613"></script>

        <script type="text/javascript">
            KindEditor.ready(function(K) {

                var extraFileUploadParams = [];
                // extraFileUploadParams['B2B2C_YUNMALL_68MALL_COM_BACKEND_PHPSESSID'] = 'ti003subk41odq8cb3h40nd0go';

                window.editor = K.create('#email_content', {
                    width: '100%',
                    height: '450px',
                    items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                    themesPath: "/assets/d2eace91/js/editor/themes/",
                    cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
                    uploadJson: "/site/upload-image",
                    // extraFileUploadParams: extraFileUploadParams,
                    allowImageUpload: true,
                    allowFlashUpload: false,
                    allowMediaUpload: false,
                    allowFileManager: true,
                    syncType: "form",
                    // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
                    pasteType: 2,
                    afterCreate: function() {
                        var self = this;
                        self.sync();
                    },
                    afterChange: function() {
                        var self = this;
                        self.sync();
                    },
                    afterBlur: function() {
                        var self = this;
                        self.sync();
                    }
                });
            });
        </script>
    @endif
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop