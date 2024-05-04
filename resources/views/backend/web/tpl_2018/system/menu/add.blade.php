{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="form1" class="form-horizontal" name="AdminMenu" action="/system/menu/add" method="POST">
            @csrf
        <!-- 隐藏域 -->
            <input type="hidden" id="adminmenu-id" class="form-control" name="AdminMenu[id]" value="{{ $info->id ?? '' }}">
            <!-- 菜单标题 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="adminmenu-title" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">菜单标题：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmenu-title" class="form-control" name="AdminMenu[title]" value="{{ $info->title ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">1~30个字符，支持中、英文、数字及符号</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="adminmenu-name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">菜单名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmenu-name" class="form-control" name="AdminMenu[name]" value="{{ $info->name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">1~30个字符，只支持英文</div></div>
                    </div>
                </div>
            </div>
            <!-- 上级菜单ID -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="adminmenu-pid" class="col-sm-4 control-label">

                        <span class="ng-binding">上级菜单：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="adminmenu-pid" class="form-control chosen-select" name="AdminMenu[pid]">
                                <option value="0" selected>请选择</option>
{{--                                @foreach($menu_list as $v)--}}
{{--                                    <option value="{{ $v->id }}" @if(@$info->pid == $v->id || $pid == $v->id) selected="selected" @endif>{{ $v->title }}[{{ $v->name }}]</option>--}}
{{--                                @endforeach--}}
                                @foreach($menu_list as $v)
                                    <option value="{{ $v['id'] }}" @if(@$info->pid == $v['id'] || $pid == $v['id']) selected="selected" @endif>{{ $v['title'] }}[{{ $v['name'] }}]</option>
                                    @if(!empty($v['_child']))
                                        @foreach($v['_child'] as $child)
                                            <option value="{{ $child['id'] }}" @if(@$info->pid == $child['id'] || $pid == $child['id']) selected="selected" @endif>&nbsp;&nbsp;&nbsp;&nbsp; {{ $child['title'] }}[{{ $child['name'] }}]</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果不选择上级菜单，则新增的菜单为顶级菜单</div></div>
                    </div>
                </div>
            </div>

            {{--url--}}
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="adminmenu-url" class="col-sm-4 control-label">
                        <span class="ng-binding">菜单链接：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmenu-url" class="form-control" name="AdminMenu[url]" value="{{ $info->url ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">1~30个字符，只支持英文</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="adminmenu-target" class="col-sm-4 control-label">

                        <span class="ng-binding">打开方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="adminmenu-target" class="form-control chosen-select" name="AdminMenu[target]">
                                <option value="_self" @if(@$info->target == '_self') selected="selected" @endif>当前窗口</option>
                                <option value="_blank" @if(@$info->target == '_blank') selected="selected" @endif>新窗口</option>
                                <option value="_parent" @if(@$info->target == '_parent') selected="selected" @endif>父窗口</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            {{--菜单路由--}}
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="adminmenu-route" class="col-sm-4 control-label">
                        <span class="ng-binding">菜单路由：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmenu-route" class="form-control" name="AdminMenu[route]" value="{{ $info->route ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">1~30个字符，只支持英文</div></div>
                    </div>
                </div>
            </div>

            {{--菜单图标--}}
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="adminmenu-icon" class="col-sm-4 control-label">
                        <span class="ng-binding">菜单图标：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmenu-icon" class="form-control" name="AdminMenu[icon]" value="{{ $info->icon ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">1~30个字符，只支持英文</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="adminmenu-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="AdminMenu[is_show]" value="0">
                                    @if(!isset($info->is_show))
                                        <label>
                                            <input type="checkbox" id="adminmenu-is_show"
                                                   class="form-control b-n" name="AdminMenu[is_show]"
                                                   value="1" checked data-on-text="是" data-off-text="否">
                                        </label>
                                    @else
                                        <label>
                                            <input type="checkbox" id="adminmenu-is_show"
                                                   class="form-control b-n" name="AdminMenu[is_show]"
                                                   value="1" @if($info->is_show == 1)checked="" @endif data-on-text="是" data-off-text="否">
                                        </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t">控制是否显示菜单</div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="adminmenu-sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmenu-sort" class="form-control small m-r-10" name="AdminMenu[sort]" value="{{ $info->sort ?? 255}}">


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


                            <input type="button" id='btn_submit' value='确认提交' class="btn btn-primary" />


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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "adminmenu-name", "name": "AdminMenu[name]", "attribute": "name", "rules": {"required":true,"messages":{"required":"菜单名称不能为空。"}}},{"id": "adminmenu-sort", "name": "AdminMenu[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "adminmenu-pid", "name": "AdminMenu[pid]", "attribute": "pid", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级菜单必须是整数。"}}},{"id": "adminmenu-is_show", "name": "AdminMenu[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "adminmenu-sort", "name": "AdminMenu[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "adminmenu-name", "name": "AdminMenu[name]", "attribute": "name", "rules": {"string":true,"messages":{"string":"菜单名称必须是一条字符串。","maxlength":"菜单名称只能包含至多30个字符。"},"maxlength":30}},{"id": "adminmenu-keywords", "name": "AdminMenu[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"Keywords必须是一条字符串。","maxlength":"Keywords只能包含至多255个字符。"},"maxlength":255}},{"id": "adminmenu-cat_desc", "name": "AdminMenu[cat_desc]", "attribute": "cat_desc", "rules": {"string":true,"messages":{"string":"Cat Desc必须是一条字符串。","maxlength":"Cat Desc只能包含至多255个字符。"},"maxlength":255}},{"id": "adminmenu-sort", "name": "AdminMenu[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#form1").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();

                var url = $("#form1").attr("action");
                var data = $("#form1").serializeJson();
                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message);
                        $.go('list');
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });

            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop