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
        <form id="NavQuickServiceModel" class="form-horizontal" name="NavQuickServiceModel" action="" method="post" enctype="multipart/form-data">
        @csrf
        <!-- 隐藏域 -->
            <input type="hidden" id="navquickservicemodel-id" class="form-control" name="NavQuickServiceModel[id]" value="{{ $info->id ?? ''}}">

            <!-- 快捷服务名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navquickservicemodel-qs_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">快捷服务名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navquickservicemodel-qs_name" class="form-control" name="NavQuickServiceModel[qs_name]" value="{{ $info->qs_name ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多只能输入5个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 快捷服务图标 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navquickservicemodel-qs_icon" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">快捷服务图标：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- data-file="指向type=“file”的对象，比如为：$("#file")" -->
                            <div id="imagegroup_container" class="szy-imagegroup"  data-size=""></div>
                            <input type="hidden" id="navquickservicemodel-qs_icon" class="form-control" name="NavQuickServiceModel[qs_icon]" value="{{ $info->qs_icon ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最佳显示尺寸为100*100像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 快捷服务链接 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navquickservicemodel-qs_link" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">快捷服务链接：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navquickservicemodel-qs_link" class="form-control" name="NavQuickServiceModel[qs_link]" value="{{ $info->qs_link ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navquickservicemodel-is_show" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="NavQuickServiceModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="navquickservicemodel-is_show" class="form-control b-n"
                                                   name="NavQuickServiceModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="navquickservicemodel-is_show" class="form-control b-n"
                                                   name="NavQuickServiceModel[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制快捷服务是否在商城首页显示，最多可设置9条记录为显示</div></div>
                    </div>
                </div>
            </div>

            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navquickservicemodel-sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navquickservicemodel-sort" class="form-control small" name="NavQuickServiceModel[sort]" value="{{ $info->sort ?? 255}}">


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
        [{"id": "navquickservicemodel-qs_name", "name": "NavQuickServiceModel[qs_name]", "attribute": "qs_name", "rules": {"required":true,"messages":{"required":"快捷服务名称不能为空。"}}},{"id": "navquickservicemodel-qs_icon", "name": "NavQuickServiceModel[qs_icon]", "attribute": "qs_icon", "rules": {"required":true,"messages":{"required":"快捷服务图标不能为空。"}}},{"id": "navquickservicemodel-qs_link", "name": "NavQuickServiceModel[qs_link]", "attribute": "qs_link", "rules": {"required":true,"messages":{"required":"快捷服务链接不能为空。"}}},{"id": "navquickservicemodel-is_show", "name": "NavQuickServiceModel[is_show]", "attribute": "is_show", "rules": {"required":true,"messages":{"required":"是否显示不能为空。"}}},{"id": "navquickservicemodel-sort", "name": "NavQuickServiceModel[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "navquickservicemodel-id", "name": "NavQuickServiceModel[id]", "attribute": "id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"ID必须是整数。"}}},{"id": "navquickservicemodel-is_show", "name": "NavQuickServiceModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "navquickservicemodel-sort", "name": "NavQuickServiceModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "navquickservicemodel-site_id", "name": "NavQuickServiceModel[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点ID必须是整数。"}}},{"id": "navquickservicemodel-qs_name", "name": "NavQuickServiceModel[qs_name]", "attribute": "qs_name", "rules": {"string":true,"messages":{"string":"快捷服务名称必须是一条字符串。","maxlength":"快捷服务名称只能包含至多5个字符。"},"maxlength":5}},{"id": "navquickservicemodel-qs_icon", "name": "NavQuickServiceModel[qs_icon]", "attribute": "qs_icon", "rules": {"string":true,"messages":{"string":"快捷服务图标必须是一条字符串。","maxlength":"快捷服务图标只能包含至多255个字符。"},"maxlength":255}},{"id": "navquickservicemodel-qs_link", "name": "NavQuickServiceModel[qs_link]", "attribute": "qs_link", "rules": {"string":true,"messages":{"string":"快捷服务链接必须是一条字符串。","maxlength":"快捷服务链接只能包含至多255个字符。"},"maxlength":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#NavQuickServiceModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#NavQuickServiceModel").submit();

            });
            $("#imagegroup_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: $(this).data("size"),
                values: $('#navquickservicemodel-qs_icon').val().split("|"),
                gallery: true,
                // 回调函数
                callback: function(data) {
                    console.info(data);
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#navquickservicemodel-qs_icon').val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#navquickservicemodel-qs_icon').val(values);
                }
            });


        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop