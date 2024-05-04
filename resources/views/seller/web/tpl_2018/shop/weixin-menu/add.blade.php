{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="WeixinMenu" class="form-horizontal" name="WeixinMenu" action="/shop/weixin-menu/add" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="weixinmenu-id" class="form-control" name="WeixinMenu[id]" value="{{ $model['id'] ?? '' }}">
            <!-- 菜单名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="weixinmenu-menu_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">菜单名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="weixinmenu-menu_name" class="form-control" name="WeixinMenu[menu_name]" value="{{ $model['menu_name'] ?? '' }}">
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 上级菜单 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="weixinmenu-parent_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">上级菜单：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select id="weixinmenu-parent_id" name="WeixinMenu[parent_id]" class="chosen-select" >
                                <option value="0">顶级菜单</option>
                                @foreach($menu_list as $item)
                                <option value="{{ $item['id'] }}" @if($parent_id == $item['id']) selected="selected" @endif>{{ $item['menu_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 菜单类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="weixinmenu-menu_type" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">菜单类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label cur-p"><input type="radio" class="menu_type" name="WeixinMenu[menu_type]" value="0" @if(@$model['menu_type'] == 0){{ 'checked' }}@endif> 命令</label>
                            <label class="control-label cur-p"><input type="radio" class="menu_type" name="WeixinMenu[menu_type]" value="1" @if(@$model['menu_type'] == 1){{ 'checked' }}@endif> 链接</label>
                            <label class="control-label cur-p"><input type="radio" class="menu_type" name="WeixinMenu[menu_type]" value="2" @if(@$model['menu_type'] == 2){{ 'checked' }}@endif> 自定义图文</label>
                            <label class="control-label cur-p"><input type="radio" class="menu_type" name="WeixinMenu[menu_type]" value="3" @if(@$model['menu_type'] == 3){{ 'checked' }}@endif> 关联小程序</label>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div id="content">
                <!-- ================== BEGIN BASE  ================== -->
                <!-- ================== END BASE  ================== -->
                <!--引入菜单类型内容-->
                @include('shop.weixin-menu.change_type_'.$model['menu_type'])
            </div>
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="weixinmenu-menu_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="weixinmenu-menu_sort" class="form-control small" name="WeixinMenu[menu_sort]" value="{{ $model['menu_sort'] ?? 255 }}">
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

{{--extra html block--}}
@section('extra_html')
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "weixinmenu-menu_name", "name": "WeixinMenu[menu_name]", "attribute": "menu_name", "rules": {"required":true,"messages":{"required":"菜单名称不能为空。"}}},{"id": "weixinmenu-parent_id", "name": "WeixinMenu[parent_id]", "attribute": "parent_id", "rules": {"required":true,"messages":{"required":"上级菜单不能为空。"}}},{"id": "weixinmenu-menu_type", "name": "WeixinMenu[menu_type]", "attribute": "menu_type", "rules": {"required":true,"messages":{"required":"菜单类型不能为空。"}}},{"id": "weixinmenu-menu_sort", "name": "WeixinMenu[menu_sort]", "attribute": "menu_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "weixinmenu-menu_link", "name": "WeixinMenu[menu_link]", "attribute": "menu_link", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"链接地址不是一条有效的URL。"}}},{"id": "weixinmenu-is_auto_login", "name": "WeixinMenu[is_auto_login]", "attribute": "is_auto_login", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否自动登录必须是整数。"}}},{"id": "weixinmenu-menu_title", "name": "WeixinMenu[menu_title]", "attribute": "menu_title", "rules": {"string":true,"messages":{"string":"标题必须是一条字符串。","maxlength":"标题只能包含至多40个字符。"},"maxlength":40}},{"id": "weixinmenu-menu_desc", "name": "WeixinMenu[menu_desc]", "attribute": "menu_desc", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinmenu-appid", "name": "WeixinMenu[appid]", "attribute": "appid", "rules": {"string":true,"messages":{"string":"小程序的appid必须是一条字符串。","maxlength":"小程序的appid只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinmenu-pagepath", "name": "WeixinMenu[pagepath]", "attribute": "pagepath", "rules": {"string":true,"messages":{"string":"小程序的页面路径必须是一条字符串。","maxlength":"小程序的页面路径只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinmenu-parent_id", "name": "WeixinMenu[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级菜单必须是整数。"}}},{"id": "weixinmenu-menu_type", "name": "WeixinMenu[menu_type]", "attribute": "menu_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"菜单类型必须是整数。"}}},{"id": "weixinmenu-menu_sort", "name": "WeixinMenu[menu_sort]", "attribute": "menu_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "weixinmenu-menu_name", "name": "WeixinMenu[menu_name]", "attribute": "menu_name", "rules": {"string":true,"messages":{"string":"菜单名称必须是一条字符串。","maxlength":"菜单名称只能包含至多5个字符。"},"maxlength":5}},{"id": "weixinmenu-menu_sort", "name": "WeixinMenu[menu_sort]", "attribute": "menu_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            var validator = $("#WeixinMenu").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $('.bootstrap-switch [type="checkbox"]').bootstrapSwitch({
                radioAllOff: true,
                onSwitchChange: function(event, state) {
                    $(event.target).prop("checked", state);
                    $(event.target).change();
                }
            });
            $("#menu_img_container").imagegroup({
                host: '{{ get_oss_host() }}',
                size: 1,
                values: ["{{ $model['menu_img'] ?? '' }}"],
                callback: function(data) {
                    $("#weixinmenu-menu_img").val(data.path);
                },
                remove: function(value, values) {
                    $("#weixinmenu-menu_img").val('');
                }
            });
            $("[data-switch-toggle]").on("click", function() {
                var type = $(this).data("switch-toggle");
                return $("#switch-" + type).bootstrapSwitch("toggle" + type.charAt(0).toUpperCase() + type.slice(1));
            });
        });
        //
        $().ready(function() {
            var validator = $("#WeixinMenu").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#WeixinMenu").submit();
            });
            // 菜单类型
            $("body").on("click", ".menu_type", function() {
                var menu_type = $(this).val();
                $.loading.start();
                $.ajax({
                    type: 'GET',
                    url: 'change-type',
                    data: {
                        menu_type: menu_type
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#content").html(result.data);
                    }
                }).always(function() {
                    $.loading.stop();
                });
            })
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop