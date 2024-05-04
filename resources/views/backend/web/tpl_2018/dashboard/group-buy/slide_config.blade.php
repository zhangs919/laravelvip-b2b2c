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
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel"
          action="/system/config/index?group=group_buy_slide" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="group" value="group_buy_slide">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">
            <h5 class="m-b-30" data-anchor="PC端图片设置">PC端图片设置</h5>
            <!-- pc端图片start -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片1：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="systemconfigmodel-group_buy_slide_img1_control" class="input-file-show">
<span class="show">
<a id="systemconfigmodel-group_buy_slide_img1_image" class="preview"
   ref="{{ get_image_url($config_info['group_buy_slide_img1']->value) }}"
   data-file="systemconfigmodel-group_buy_slide_img1">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="systemconfigmodel-group_buy_slide_img1_text" name="SystemConfigModel[group_buy_slide_img1]_text"
       class="type-file-text">
<input type="button" id="systemconfigmodel-group_buy_slide_img1_button"
       name="SystemConfigModel[group_buy_slide_img1]_button" value="选择上传..." class="type-file-button">
<input type="file" id="systemconfigmodel-group_buy_slide_img1" name="SystemConfigModel[group_buy_slide_img1]"
       class="type-file-file" size="30"
       onchange="document.getElementById('systemconfigmodel-group_buy_slide_img1_text').value=this.value">
</span>
                            </div>

                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="systemconfigmodel-group_buy_slide_link1" class="form-control"
                                   name="SystemConfigModel[group_buy_slide_link1]"
                                   value="{{ $config_info['group_buy_slide_link1']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-type="group_buy" data-id="1"
                               href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1920*440像素的jpg、gif、png格式图片作为幻灯片banner上传，
                            如需跳转请在后方添加以http://开头的链接地址。
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片2：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="systemconfigmodel-group_buy_slide_img2_control" class="input-file-show">
<span class="show">
<a id="systemconfigmodel-group_buy_slide_img2_image" class="preview"
   ref="{{ get_image_url($config_info['group_buy_slide_img2']->value) }}"
   data-file="systemconfigmodel-group_buy_slide_img2">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="systemconfigmodel-group_buy_slide_img2_text" name="SystemConfigModel[group_buy_slide_img2]_text"
       class="type-file-text">
<input type="button" id="systemconfigmodel-group_buy_slide_img2_button"
       name="SystemConfigModel[group_buy_slide_img2]_button" value="选择上传..." class="type-file-button">
<input type="file" id="systemconfigmodel-group_buy_slide_img2" name="SystemConfigModel[group_buy_slide_img2]"
       class="type-file-file" size="30"
       onchange="document.getElementById('systemconfigmodel-group_buy_slide_img2_text').value=this.value">
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="systemconfigmodel-group_buy_slide_link2" class="form-control"
                                   name="SystemConfigModel[group_buy_slide_link2]"
                                   value="{{ $config_info['group_buy_slide_link2']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-type="group_buy" data-id="2"
                               href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1920*440像素的jpg、gif、png格式图片作为幻灯片banner上传，
                            如需跳转请在后方添加以http://开头的链接地址。
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片3：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="systemconfigmodel-group_buy_slide_img3_control" class="input-file-show">
<span class="show">
<a id="systemconfigmodel-group_buy_slide_img3_image" class="preview"
   ref="{{ get_image_url($config_info['group_buy_slide_img3']->value) }}"
   data-file="systemconfigmodel-group_buy_slide_img3">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="systemconfigmodel-group_buy_slide_img3_text" name="SystemConfigModel[group_buy_slide_img3]_text"
       class="type-file-text">
<input type="button" id="systemconfigmodel-group_buy_slide_img3_button"
       name="SystemConfigModel[group_buy_slide_img3]_button" value="选择上传..." class="type-file-button">
<input type="file" id="systemconfigmodel-group_buy_slide_img3" name="SystemConfigModel[group_buy_slide_img3]"
       class="type-file-file" size="30"
       onchange="document.getElementById('systemconfigmodel-group_buy_slide_img3_text').value=this.value">
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="systemconfigmodel-group_buy_slide_link3" class="form-control"
                                   name="SystemConfigModel[group_buy_slide_link3]"
                                   value="{{ $config_info['group_buy_slide_link3']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-type="group_buy" data-id="3"
                               href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1920*440像素的jpg、gif、png格式图片作为幻灯片banner上传，
                            如需跳转请在后方添加以http://开头的链接地址。
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片4：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="systemconfigmodel-group_buy_slide_img4_control" class="input-file-show">
<span class="show">
<a id="systemconfigmodel-group_buy_slide_img4_image" class="preview"
   ref="{{ get_image_url($config_info['group_buy_slide_img4']->value) }}"
   data-file="systemconfigmodel-group_buy_slide_img4">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="systemconfigmodel-group_buy_slide_img4_text" name="SystemConfigModel[group_buy_slide_img4]_text"
       class="type-file-text">
<input type="button" id="systemconfigmodel-group_buy_slide_img4_button"
       name="SystemConfigModel[group_buy_slide_img4]_button" value="选择上传..." class="type-file-button">
<input type="file" id="systemconfigmodel-group_buy_slide_img4" name="SystemConfigModel[group_buy_slide_img4]"
       class="type-file-file" size="30"
       onchange="document.getElementById('systemconfigmodel-group_buy_slide_img4_text').value=this.value">
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="systemconfigmodel-group_buy_slide_link4" class="form-control"
                                   name="SystemConfigModel[group_buy_slide_link4]"
                                   value="{{ $config_info['group_buy_slide_link4']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-type="group_buy" data-id="4"
                               href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1920*440像素的jpg、gif、png格式图片作为幻灯片banner上传，
                            如需跳转请在后方添加以http://开头的链接地址。
                        </div>
                    </div>
                </div>
            </div>
            <!-- pc端图片end -->
            <h5 class="m-b-30" data-anchor="PC端图片设置">手机端图片设置</h5>
            <!-- mobile端图片start -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片1：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="systemconfigmodel-m_group_buy_slide_img1_control" class="input-file-show">
<span class="show">
<a id="systemconfigmodel-m_group_buy_slide_img1_image" class="preview"
   ref="{{ get_image_url($config_info['m_group_buy_slide_img1']->value) }}"
   data-file="systemconfigmodel-m_group_buy_slide_img1">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="systemconfigmodel-m_group_buy_slide_img1_text"
       name="SystemConfigModel[m_group_buy_slide_img1]_text" class="type-file-text">
<input type="button" id="systemconfigmodel-m_group_buy_slide_img1_button"
       name="SystemConfigModel[m_group_buy_slide_img1]_button" value="选择上传..." class="type-file-button">
<input type="file" id="systemconfigmodel-m_group_buy_slide_img1" name="SystemConfigModel[m_group_buy_slide_img1]"
       class="type-file-file" size="30"
       onchange="document.getElementById('systemconfigmodel-m_group_buy_slide_img1_text').value=this.value">
</span>
                            </div>

                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="systemconfigmodel-m_group_buy_slide_link1" class="form-control"
                                   name="SystemConfigModel[m_group_buy_slide_link1]"
                                   value="{{ $config_info['m_group_buy_slide_link1']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-type="m_group_buy" data-id="1"
                               href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1000*400像素的jpg、gif、png格式图片作为幻灯片banner上传，
                            如需跳转请在后方添加以http://开头的链接地址
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片2：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="systemconfigmodel-m_group_buy_slide_img2_control" class="input-file-show">
<span class="show">
<a id="systemconfigmodel-m_group_buy_slide_img2_image" class="preview"
   ref="{{ get_image_url($config_info['m_group_buy_slide_img2']->value) }}"
   data-file="systemconfigmodel-m_group_buy_slide_img2">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="systemconfigmodel-m_group_buy_slide_img2_text"
       name="SystemConfigModel[m_group_buy_slide_img2]_text" class="type-file-text">
<input type="button" id="systemconfigmodel-m_group_buy_slide_img2_button"
       name="SystemConfigModel[m_group_buy_slide_img2]_button" value="选择上传..." class="type-file-button">
<input type="file" id="systemconfigmodel-m_group_buy_slide_img2" name="SystemConfigModel[m_group_buy_slide_img2]"
       class="type-file-file" size="30"
       onchange="document.getElementById('systemconfigmodel-m_group_buy_slide_img2_text').value=this.value">
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="systemconfigmodel-m_group_buy_slide_link2" class="form-control"
                                   name="SystemConfigModel[m_group_buy_slide_link2]"
                                   value="{{ $config_info['m_group_buy_slide_link2']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-type="m_group_buy" data-id="2"
                               href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1000*400像素的jpg、gif、png格式图片作为幻灯片banner上传，
                            如需跳转请在后方添加以http://开头的链接地址
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片3：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="systemconfigmodel-m_group_buy_slide_img3_control" class="input-file-show">
<span class="show">
<a id="systemconfigmodel-m_group_buy_slide_img3_image" class="preview"
   ref="{{ get_image_url($config_info['m_group_buy_slide_img3']->value) }}"
   data-file="systemconfigmodel-m_group_buy_slide_img3">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="systemconfigmodel-m_group_buy_slide_img3_text"
       name="SystemConfigModel[m_group_buy_slide_img3]_text" class="type-file-text">
<input type="button" id="systemconfigmodel-m_group_buy_slide_img3_button"
       name="SystemConfigModel[m_group_buy_slide_img3]_button" value="选择上传..." class="type-file-button">
<input type="file" id="systemconfigmodel-m_group_buy_slide_img3" name="SystemConfigModel[m_group_buy_slide_img3]"
       class="type-file-file" size="30"
       onchange="document.getElementById('systemconfigmodel-m_group_buy_slide_img3_text').value=this.value">
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="systemconfigmodel-m_group_buy_slide_link3" class="form-control"
                                   name="SystemConfigModel[m_group_buy_slide_link3]"
                                   value="{{ $config_info['m_group_buy_slide_link3']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-type="m_group_buy" data-id="3"
                               href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1000*400像素的jpg、gif、png格式图片作为幻灯片banner上传，
                            如需跳转请在后方添加以http://开头的链接地址
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片4：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="systemconfigmodel-m_group_buy_slide_img4_control" class="input-file-show">
<span class="show">
<a id="systemconfigmodel-m_group_buy_slide_img4_image" class="preview"
   ref="{{ get_image_url($config_info['m_group_buy_slide_img4']->value) }}"
   data-file="systemconfigmodel-m_group_buy_slide_img4">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="systemconfigmodel-m_group_buy_slide_img4_text"
       name="SystemConfigModel[m_group_buy_slide_img4]_text" class="type-file-text">
<input type="button" id="systemconfigmodel-m_group_buy_slide_img4_button"
       name="SystemConfigModel[m_group_buy_slide_img4]_button" value="选择上传..." class="type-file-button">
<input type="file" id="systemconfigmodel-m_group_buy_slide_img4" name="SystemConfigModel[m_group_buy_slide_img4]"
       class="type-file-file" size="30"
       onchange="document.getElementById('systemconfigmodel-m_group_buy_slide_img4_text').value=this.value">
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="systemconfigmodel-m_group_buy_slide_link4" class="form-control"
                                   name="SystemConfigModel[m_group_buy_slide_link4]"
                                   value="{{ $config_info['m_group_buy_slide_link4']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-type="m_group_buy" data-id="4"
                               href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1000*400像素的jpg、gif、png格式图片作为幻灯片banner上传，
                            如需跳转请在后方添加以http://开头的链接地址
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile端图片end -->
            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
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

    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <script id="client_rules" type="text">
[{"id": "systemconfigmodel-group_buy_slide_img1", "name": "SystemConfigModel[group_buy_slide_img1]", "attribute": "group_buy_slide_img1", "rules": {"string":true,"messages":{"string":"滚动图片1必须是一条字符串。"}}},{"id": "systemconfigmodel-group_buy_slide_img2", "name": "SystemConfigModel[group_buy_slide_img2]", "attribute": "group_buy_slide_img2", "rules": {"string":true,"messages":{"string":"滚动图片2必须是一条字符串。"}}},{"id": "systemconfigmodel-group_buy_slide_img3", "name": "SystemConfigModel[group_buy_slide_img3]", "attribute": "group_buy_slide_img3", "rules": {"string":true,"messages":{"string":"滚动图片3必须是一条字符串。"}}},{"id": "systemconfigmodel-group_buy_slide_img4", "name": "SystemConfigModel[group_buy_slide_img4]", "attribute": "group_buy_slide_img4", "rules": {"string":true,"messages":{"string":"滚动图片4必须是一条字符串。"}}},{"id": "systemconfigmodel-group_buy_slide_link1", "name": "SystemConfigModel[group_buy_slide_link1]", "attribute": "group_buy_slide_link1", "rules": {"string":true,"messages":{"string":"Group Buy Slide Link1必须是一条字符串。"}}},{"id": "systemconfigmodel-group_buy_slide_link2", "name": "SystemConfigModel[group_buy_slide_link2]", "attribute": "group_buy_slide_link2", "rules": {"string":true,"messages":{"string":"Group Buy Slide Link2必须是一条字符串。"}}},{"id": "systemconfigmodel-group_buy_slide_link3", "name": "SystemConfigModel[group_buy_slide_link3]", "attribute": "group_buy_slide_link3", "rules": {"string":true,"messages":{"string":"Group Buy Slide Link3必须是一条字符串。"}}},{"id": "systemconfigmodel-group_buy_slide_link4", "name": "SystemConfigModel[group_buy_slide_link4]", "attribute": "group_buy_slide_link4", "rules": {"string":true,"messages":{"string":"Group Buy Slide Link4必须是一条字符串。"}}},{"id": "systemconfigmodel-m_group_buy_slide_img1", "name": "SystemConfigModel[m_group_buy_slide_img1]", "attribute": "m_group_buy_slide_img1", "rules": {"string":true,"messages":{"string":"滚动图片1必须是一条字符串。"}}},{"id": "systemconfigmodel-m_group_buy_slide_img2", "name": "SystemConfigModel[m_group_buy_slide_img2]", "attribute": "m_group_buy_slide_img2", "rules": {"string":true,"messages":{"string":"滚动图片2必须是一条字符串。"}}},{"id": "systemconfigmodel-m_group_buy_slide_img3", "name": "SystemConfigModel[m_group_buy_slide_img3]", "attribute": "m_group_buy_slide_img3", "rules": {"string":true,"messages":{"string":"滚动图片3必须是一条字符串。"}}},{"id": "systemconfigmodel-m_group_buy_slide_img4", "name": "SystemConfigModel[m_group_buy_slide_img4]", "attribute": "m_group_buy_slide_img4", "rules": {"string":true,"messages":{"string":"滚动图片4必须是一条字符串。"}}},{"id": "systemconfigmodel-m_group_buy_slide_link1", "name": "SystemConfigModel[m_group_buy_slide_link1]", "attribute": "m_group_buy_slide_link1", "rules": {"string":true,"messages":{"string":"M Group Buy Slide Link1必须是一条字符串。"}}},{"id": "systemconfigmodel-m_group_buy_slide_link2", "name": "SystemConfigModel[m_group_buy_slide_link2]", "attribute": "m_group_buy_slide_link2", "rules": {"string":true,"messages":{"string":"M Group Buy Slide Link2必须是一条字符串。"}}},{"id": "systemconfigmodel-m_group_buy_slide_link3", "name": "SystemConfigModel[m_group_buy_slide_link3]", "attribute": "m_group_buy_slide_link3", "rules": {"string":true,"messages":{"string":"M Group Buy Slide Link3必须是一条字符串。"}}},{"id": "systemconfigmodel-m_group_buy_slide_link4", "name": "SystemConfigModel[m_group_buy_slide_link4]", "attribute": "m_group_buy_slide_link4", "rules": {"string":true,"messages":{"string":"M Group Buy Slide Link4必须是一条字符串。"}}},]

    </script>
    <script type="text/javascript">
        $().ready(function () {
            //悬浮显示上下步骤按钮
            window.onscroll = function () {
                $(window).scroll(function () {
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
            $("#btn_submit").click(function () {
                $.loading.start();
                $("#SystemConfigModel").submit();
            });

            $("body").on('click', '.clear', function () {
                var key = $(this).data("id");
                var type = $(this).data("type");
                $.ajax({
                    type: "POST",
                    url: "/system/config/clear",
                    dataType: "json",
                    data: {
                        key: key,
                        type: type
                    },
                    success: function (result) {
                        $.msg(result.message, {
                            icon: 1
                        });
                        location.reload();
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop