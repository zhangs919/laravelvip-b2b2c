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

    <form id="form" class="form-horizontal" action="/system/role/add" method="post" novalidate="novalidate">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix">
            <input type="hidden" id="rolemodel-role_id" class="form-control" name="RoleModel[role_id]" value="{{ $info->role_id ?? '' }}">

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="rolemodel-role_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">角色名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="rolemodel-role_name" class="form-control" name="RoleModel[role_name]" value="{{ $info->role_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="rolemodel-role_desc" class="col-sm-4 control-label">

                        <span class="ng-binding">角色描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="rolemodel-role_desc" class="form-control" name="RoleModel[role_desc]" rows="5">{!! $info->role_desc ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <input type="hidden" id="rolemodel-role_type" class="form-control" name="RoleModel[role_type]" value="0">
            <div class="simple-form-field p-t-0">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">设置权限：</span>
                    </label>
                    <div class="col-sm-8">
                        <label class="control-label cur-p">
                            <input type="checkbox" id="root" onclick="selectAuthsAll(this)">
                            全部操作
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive m-t-10">
            <div class="common-title">
                <div class="ftitle">
                    <h3>权限操作</h3>
                    <h5>设置详情</h5>
                </div>
            </div>

            <div class="authset-all">

                @foreach($nodes as $node)
                    <dl class="simple-form-field">
                        <dt class="tit">
						<span>
							<label>
								<input type="checkbox" value="system" id="{{ $node['node_name'] }}" data-parent-id="root" onclick="selectAuth(this.id)">
                                {{ $node['node_title'] }}
							</label>
						</span>
                        </dt>
                        <dd class="form-group-t">
                            @if(!empty($node['_child']))
                                @foreach($node['_child'] as $child)
                                    <div class="authset-list ">
                                        <label class="col-sm-13 control-label">
								<span>
									<input type="checkbox" value="{{ $node['node_name'] }}" id="{{ $child['node_name'] }}" data-parent-id="{{ $node['node_name'] }}" onclick="selectAuth(this.id)">
                                    {{ $child['node_title'] }}
								</span>
                                        </label>
                                        <div class="col-sm-14 control-label control-label-t">
                                            <ul class="authset-section">
                                                @if(!empty($child['_child']))
                                                    @foreach($child['_child'] as $childChild)
                                                        <li>
                                                            <label>
                                                                {{--todo 判断是否选中及是否可选 checked="checked" disabled="disabled"--}}
                                                                <input type="checkbox" id="{{ $childChild['node_name'] }}" name="auth_codes[]" data-parent-id="{{ $child['node_name'] }}"
                                                                       value="{{ $childChild['node_name'] }}" class="auth-item" onclick="selectAuth(this.id)" @if(in_array($childChild['node_name'], $auth_codes))checked="checked"@endif @if(!$childChild['is_auth'])disabled="disabled"@endif {{--checked="checked" disabled="disabled"--}}>

                                                                {{ $childChild['node_title'] }}
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </dd>
                    </dl>
                @endforeach

            </div>

            <div class="bottom-btn p-b-30 text-c p-l-0 bottom-btn-fixed">
                <input type="button" id="btn_submit" class="btn btn-primary btn-lg" value="确认提交">
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
    <script id="client_rules" type="text">
        @if(!isset($info->role_id))
        [{"id": "rolemodel-role_name", "name": "RoleModel[role_name]", "attribute": "role_name", "rules": {"required":true,"messages":{"required":"角色名称不能为空。"}}},{"id": "rolemodel-role_type", "name": "RoleModel[role_type]", "attribute": "role_type", "rules": {"required":true,"messages":{"required":"角色类型不能为空。"}}},{"id": "rolemodel-role_name", "name": "RoleModel[role_name]", "attribute": "role_name", "rules": {"string":true,"messages":{"string":"角色名称必须是一条字符串。","maxlength":"角色名称只能包含至多60个字符。"},"maxlength":60}},{"id": "rolemodel-role_desc", "name": "RoleModel[role_desc]", "attribute": "role_desc", "rules": {"string":true,"messages":{"string":"角色描述必须是一条字符串。","maxlength":"角色描述只能包含至多100个字符。"},"maxlength":100}},{"id": "rolemodel-role_type", "name": "RoleModel[role_type]", "attribute": "role_type", "rules": {"integer":true,"messages":{"integer":"角色类型必须是整数。"}}},{"id": "rolemodel-role_id", "name": "RoleModel[role_id]", "attribute": "role_id", "rules": {"integer":true,"messages":{"integer":"Role Id必须是整数。"}}},{"id": "rolemodel-role_name", "name": "RoleModel[role_name]", "attribute": "role_name", "rules": {"ajax":{"url":"\/system\/role\/client-validate","model":"YXBwXG1vZHVsZXNcc3lzdGVtXG1vZGVsc1xSb2xlTW9kZWw=","attribute":"role_name","params":[]},"messages":{"ajax":"{attribute}的值\u0022{value}\u0022已经被占用了。"}}},]
        @else
        [{"id": "rolemodel-role_name", "name": "RoleModel[role_name]", "attribute": "role_name", "rules": {"required":true,"messages":{"required":"角色名称不能为空。"}}},{"id": "rolemodel-role_type", "name": "RoleModel[role_type]", "attribute": "role_type", "rules": {"required":true,"messages":{"required":"角色类型不能为空。"}}},{"id": "rolemodel-role_name", "name": "RoleModel[role_name]", "attribute": "role_name", "rules": {"string":true,"messages":{"string":"角色名称必须是一条字符串。","maxlength":"角色名称只能包含至多60个字符。"},"maxlength":60}},{"id": "rolemodel-role_desc", "name": "RoleModel[role_desc]", "attribute": "role_desc", "rules": {"string":true,"messages":{"string":"角色描述必须是一条字符串。","maxlength":"角色描述只能包含至多100个字符。"},"maxlength":100}},{"id": "rolemodel-role_type", "name": "RoleModel[role_type]", "attribute": "role_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"角色类型必须是整数。"}}},{"id": "rolemodel-role_id", "name": "RoleModel[role_id]", "attribute": "role_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Role Id必须是整数。"}}},{"id": "rolemodel-role_name", "name": "RoleModel[role_name]", "attribute": "role_name", "rules": {"ajax":{"url":"/system/role/client-validate","model":"YXBwXG1vZHVsZXNcc3lzdGVtXG1vZGVsc1xSb2xlTW9kZWw=","attribute":"role_name","params":["RoleModel[role_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
        @endif
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
            var validator = $("#form").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }

                var data = $("#form").serializeJson();
                var url = $("#form").attr("action");

                //加载提示
                $.loading.start();

                $.post(url, data, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message);
                        $.loading.start();
                        $.go("/system/role/list");
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

                return false;
            });

            // 级联选中
            $("[data-parent-id]:checkbox").on("change", function() {
                var checked = $(this).is(":checked");
                var parent_id = $(this).data("parent-id");
                var id = $(this).attr("id")

                var elements = $("[data-parent-id='" + id + "']:checkbox");

                $(elements).prop("checked", checked);
                $(elements).change();
            });

            // 页面加载后的初始化状态
            $(".auth-item").each(function() {
                selectAuth($(this).attr("id"));
            });
        });

        // 选择权限项
        function selectAuth(id) {
            var parent_id = $("#" + id).data("parent-id");

            if (!parent_id) {
                return;
            }

            var elements = $("[data-parent-id='" + parent_id + "']:checkbox");

            if ($(elements).size() == $(elements).filter(":checked").size()) {
                $("#" + parent_id).prop("checked", true);
                selectAuth(parent_id);
            } else {
                $("#" + parent_id).prop("checked", false);
                selectAuth(parent_id);
            }
        }

        //全选权限
        function selectAuthsAll(target) {
            $("[data-parent-id='root']").prop("checked", $(target).prop("checked"));
            $("[data-parent-id='root']").change();
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop