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

    <form id="LinksModel" class="form-horizontal" name="LinksModel" action="/mall/links/add" method="post" novalidate="novalidate">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix ">
            <!-- 链接ID  -->
            <input type="hidden" id="linksmodel-links_id" class="form-control" name="LinksModel[links_id]" value="{{ $info->links_id ?? '' }}">
            <!-- 链接名称  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="linksmodel-links_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">友情链接名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="linksmodel-links_name" class="form-control" name="LinksModel[links_name]" maxlength="20" value="{{ $info->links_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 链接地址  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="linksmodel-links_url" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">友情链接地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="linksmodel-links_url" class="form-control" name="LinksModel[links_url]" value="{{ $info->links_url ?? 'http://' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="linksmodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="LinksModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="linksmodel-is_show" class="form-control b-n"
                                                   name="LinksModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="linksmodel-is_show" class="form-control b-n"
                                                   name="LinksModel[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制PC端前台页面是否展示此友情链接</div></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="linksmodel-links_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="linksmodel-links_sort" class="form-control small" name="LinksModel[links_sort]" value="{{ $info->links_sort ?? '255' }}">


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

{{--helper_tool--}}
@section('helper_tool')

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
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "linksmodel-links_name", "name": "LinksModel[links_name]", "attribute": "links_name", "rules": {"required":true,"messages":{"required":"友情链接名称不能为空。"}}},{"id": "linksmodel-links_url", "name": "LinksModel[links_url]", "attribute": "links_url", "rules": {"required":true,"messages":{"required":"友情链接地址不能为空。"}}},{"id": "linksmodel-links_sort", "name": "LinksModel[links_sort]", "attribute": "links_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "linksmodel-links_sort", "name": "LinksModel[links_sort]", "attribute": "links_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "linksmodel-links_url", "name": "LinksModel[links_url]", "attribute": "links_url", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"请输入一个有效的友情链接地址，例如：http://www.laravelvip.com"}}},{"id": "linksmodel-links_name", "name": "LinksModel[links_name]", "attribute": "links_name", "rules": {"string":true,"messages":{"string":"友情链接名称必须是一条字符串。","maxlength":"友情链接名称只能包含至多60个字符。"},"maxlength":60}},{"id": "linksmodel-links_url", "name": "LinksModel[links_url]", "attribute": "links_url", "rules": {"string":true,"messages":{"string":"友情链接地址必须是一条字符串。","maxlength":"友情链接地址只能包含至多255个字符。"},"maxlength":255}},{"id": "linksmodel-is_show", "name": "LinksModel[is_show]", "attribute": "is_show", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否显示是无效的。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#LinksModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#LinksModel").submit();
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop