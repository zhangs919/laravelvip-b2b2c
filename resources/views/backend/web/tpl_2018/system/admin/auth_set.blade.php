{{--模板继承--}}
@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--content--}}
@section('content')

    <form id="form" class="form-horizontal" action="/system/admin/auth-set?id={{ $role_id }}" method="post">
        {{ csrf_field() }}
        <div class="common-title">
            <h5>
                <label class="control-label cur-p m-l-10">
                    <input id="all" class="checkBox allCheckBox va-sub" type="checkbox" onclick="selectAuthsAll(this)">
                    全部操作
                </label>
            </h5>
        </div>
        <div class="table-content">
            <div class="table-responsive m-t-10">
                <div class="authset-all">

                    @foreach($nodes as $node)
                        <dl class="simple-form-field">
                            <dt class="tit">
                                <span>
                                    <label>
                                        <input type="checkbox" value="{{ $node['node_name'] }}" id="{{ $node['node_name'] }}" data-parent-id="{{ $node['parent_node'] }}" onclick="selectAuth(this.id)">
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
                <div class="bottom-btn p-b-30 text-c p-l-0">
                    <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
                </div>

            </div>
        </div>
    </form>

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".table-content").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };
            $("#btn_submit").click(function() {

                var data = $("#form").serializeJson();
                var url = $("#form").attr("action");

                //加载提示
                $.loading.start();

                $.post(url, data, function(result) {

                    $.loading.stop();

                    if (result.code == 0) {
                        $.msg(result.message);
                        $.go("/system/admin/list");
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

                return false;
            });

            //级联选中
            $("[data-parent-id]:checkbox").on("change", function() {
                var checked = $(this).is(":checked");
                var parent_id = $(this).data("parent-id");
                var id = $(this).attr("id");

                // 排除禁用的选项
                var elements = $("[data-parent-id='" + id + "']:checkbox").not("[disabled]");
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

            // 如果全部禁用了则上级也禁用
            if ($(elements).filter("[disabled]").size() == $(elements).size()) {
                $("#" + parent_id).prop("disabled", true);
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