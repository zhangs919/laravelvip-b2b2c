{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <form id="ShopRoleModel" class="form-horizontal" name="ShopRoleModel" action="/shop/role/add" method="post">
        @csrf
        <div class="table-content m-t-30 clearfix">
            <!-- 角色ID -->
            <input type="hidden" id="shoprolemodel-role_id" class="form-control" name="ShopRoleModel[role_id]" value="{{ $info->role_id ?? '' }}">
            <!-- 店铺ID -->
            <input type="hidden" id="shoprolemodel-shop_id" class="form-control" name="ShopRoleModel[shop_id]" value="{{ $shop->shop_id }}">
            <!-- 角色名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoprolemodel-role_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">角色名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shoprolemodel-role_name" class="form-control" name="ShopRoleModel[role_name]" value="{{ $info->role_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 角色说明 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoprolemodel-role_desc" class="col-sm-4 control-label">

                        <span class="ng-binding">角色说明：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shoprolemodel-role_desc" class="form-control" name="ShopRoleModel[role_desc]" rows="5">{!! $info->role_desc ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
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
                        <div class="help-block help-block-t">勾选“全部操作”，自动选中全部店铺管理员操作功能，可根据需要从设置详情中进行分组设置</div>
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
						<label title="{{ $node['node_title'] }}">
							<input type="checkbox" value="{{ $node['node_name'] }}" id="{{ $node['node_name'] }}" data-parent-id="{{ $node['parent_node'] }}" onclick="selectAuth(this.id)">
                            {{ $node['node_title'] }}
						</label>
					</span>
                        </dt>
                        <dd class="form-group-t">

                            @if(!empty($node['_child']))
                                @foreach($node['_child'] as $child)
                                    <div class="authset-list authset-list-last">
                                        <label class="col-sm-13 control-label" title="{{ $child['node_title'] }}">
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
                                                            <label title="{{ $childChild['node_title'] }}">

                                                                <input type="checkbox" id="{{ $childChild['node_name'] }}" name="role_auths[]"
                                                                       data-parent-id="{{ $child['node_name'] }}" value="{{ $childChild['node_name'] }}" class="auth-item" onclick="selectAuth(this.id)" @if(in_array($childChild['node_name'], $auth_codes))checked="checked"@endif />

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

            <div class="bottom-btn p-b-30 p-l-0 text-c">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
            </div>
        </div>
    </form>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <script id="client_rules" type="text">
        [{"id": "shoprolemodel-role_name", "name": "ShopRoleModel[role_name]", "attribute": "role_name", "rules": {"required":true,"messages":{"required":"角色名称不能为空。"}}},{"id": "shoprolemodel-shop_id", "name": "ShopRoleModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shop Id必须是整数。"}}},{"id": "shoprolemodel-role_type", "name": "ShopRoleModel[role_type]", "attribute": "role_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Role Type必须是整数。"}}},{"id": "shoprolemodel-role_name", "name": "ShopRoleModel[role_name]", "attribute": "role_name", "rules": {"string":true,"messages":{"string":"角色名称必须是一条字符串。","maxlength":"角色名称只能包含至多60个字符。"},"maxlength":60}},{"id": "shoprolemodel-role_alias", "name": "ShopRoleModel[role_alias]", "attribute": "role_alias", "rules": {"string":true,"messages":{"string":"Role Alias必须是一条字符串。","maxlength":"Role Alias只能包含至多60个字符。"},"maxlength":60}},{"id": "shoprolemodel-role_desc", "name": "ShopRoleModel[role_desc]", "attribute": "role_desc", "rules": {"string":true,"messages":{"string":"角色说明必须是一条字符串。","maxlength":"角色说明只能包含至多100个字符。"},"maxlength":100}},]
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
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

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
            // 禁止回车事件
            $.stopEnterEvent($("#ShopRoleModel"));

            var validator = $("#ShopRoleModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }

                var data = $("#ShopRoleModel").serializeJson();
                var url = $("#ShopRoleModel").attr("action");
                //加载提示
                $.loading.start();
                $.post(url, data, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message);
                        $.loading.start();
                        $.go("list");
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