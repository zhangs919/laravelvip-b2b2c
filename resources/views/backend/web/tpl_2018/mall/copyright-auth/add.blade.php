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

    <form id="CopyrightAuthModel" class="form-horizontal" name="CopyrightAuthModel" action="/mall/copyright-auth/add" method="post" novalidate="novalidate">
        @csrf
        <div class="table-content m-t-30 clearfix">
            <!-- 资质ID  -->
            <input type="hidden" id="copyrightauthmodel-auth_id" class="form-control" name="CopyrightAuthModel[auth_id]" value="{{ $info->auth_id ?? ''}}">
            <!-- 资质名称  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="copyrightauthmodel-auth_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">资质名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="copyrightauthmodel-auth_name" class="form-control" name="CopyrightAuthModel[auth_name]" maxlength="20" value="{{ $info->auth_name ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 图标  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="copyrightauthmodel-auth_image" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">图标：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->
                            <div id="auth_image_imagegroup_container" class="szy-imagegroup"
                                 data-id="copyrightauthmodel-auth_image" data-size="1">
                                {{--<ul class="image-group">
                                    <li class="image-group-button" data-label-index="0" title="点击并选择上传的图片">
                                        <div class="image-group-bg"></div>
                                    </li>
                                </ul>--}}
                            </div>
                            <input type="hidden" id="copyrightauthmodel-auth_image" class="form-control" name="CopyrightAuthModel[auth_image]" value="{{ $info->auth_image ?? ''}}">
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">商城PC端前台底部资质导航处展示，最佳显示尺寸为112*40像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 链接地址  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="copyrightauthmodel-links_url" class="col-sm-4 control-label">

                        <span class="ng-binding">链接地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="copyrightauthmodel-links_url" class="form-control" name="CopyrightAuthModel[links_url]" value="{{ $info->links_url ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="copyrightauthmodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="CopyrightAuthModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="copyrightauthmodel-is_show" class="form-control b-n"
                                                   name="CopyrightAuthModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="copyrightauthmodel-is_show" class="form-control b-n"
                                                   name="CopyrightAuthModel[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制此资质导航是否在PC端前台页面底部展示</div></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="copyrightauthmodel-auth_sort" class="col-sm-4 control-label">

                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="copyrightauthmodel-auth_sort" class="form-control small" name="CopyrightAuthModel[auth_sort]" value="{{ $info->auth_sort ?? 255}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
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
        </div>
    </form>


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
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "copyrightauthmodel-auth_name", "name": "CopyrightAuthModel[auth_name]", "attribute": "auth_name", "rules": {"required":true,"messages":{"required":"资质名称不能为空。"}}},{"id": "copyrightauthmodel-auth_image", "name": "CopyrightAuthModel[auth_image]", "attribute": "auth_image", "rules": {"required":true,"messages":{"required":"图标不能为空。"}}},{"id": "copyrightauthmodel-auth_sort", "name": "CopyrightAuthModel[auth_sort]", "attribute": "auth_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "copyrightauthmodel-links_url", "name": "CopyrightAuthModel[links_url]", "attribute": "links_url", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"请输入一个有效的链接地址，例如：http://www.laravelvip.com"}}},{"id": "copyrightauthmodel-auth_name", "name": "CopyrightAuthModel[auth_name]", "attribute": "auth_name", "rules": {"string":true,"messages":{"string":"资质名称必须是一条字符串。","maxlength":"资质名称只能包含至多20个字符。"},"maxlength":20}},{"id": "copyrightauthmodel-links_url", "name": "CopyrightAuthModel[links_url]", "attribute": "links_url", "rules": {"string":true,"messages":{"string":"链接地址必须是一条字符串。","maxlength":"链接地址只能包含至多255个字符。"},"maxlength":255}},{"id": "copyrightauthmodel-is_show", "name": "CopyrightAuthModel[is_show]", "attribute": "is_show", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否显示是无效的。"}}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#CopyrightAuthModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#CopyrightAuthModel").submit();
            });
        });

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
    
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop