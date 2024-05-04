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

    <!--搜索-->
    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/system/region/list" method="GET">
            <div class="simple-form-field simple-form-search">
                <div class="form-group">
                    <label class="control-label">
                        <i class="fa fa-search"></i>
                    </label>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>地区：</span>
                    </label>
                    <div class="form-control-wrap">

                        {{--<div class="chosen-container chosen-container-single" title="" style="width: 250px;" id="region_id_chosen">
                            <a class="chosen-single" tabindex="-1"><span>请选择</span><div><b></b></div></a>
                            <div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div>
                                <ul class="chosen-results"></ul>
                            </div>
                        </div>--}}
                        <select id="region_id" class="form-control chosen-select" name="region_code" data-width="auto" style="width: 250px; display: none;">
                            <option value="">请选择</option>
                            @foreach($parent_area as $v)
                                <option value="{{ $v->region_code }}">{{ $v->region_name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>状态：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="is_enable" class="form-control" name="is_enable">
                            <option value="">全部</option>
                            <option value="1">启用</option>
                            <option value="0">禁用</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>经营地区：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="is_scope" class="form-control" name="is_scope">
                            <option value="">全部</option>
                            <option value="1">经营地区</option>
                            <option value="0">非经营地区</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="button" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">

                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出">

            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>地区列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>

    <!--列表上面（列表名称、列表显示项设置）-->

    {{--引入列表--}}
    @include('system.region.partials._list')

@stop

{{--script page元素内--}}
@section('script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 地区选择器 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=1.2"></script>
    <script type="text/javascript">
        var tablelist = null;

        function switch_enable_click(target, value) {
            var url = $(target).data("action");

            var post = function(is_sync) {

                $.loading.start();

                $.post(url, {
                    is_sync: is_sync
                }, function(result) {
                    if (result.code == 0) {
                        var value = result.data;
                        tablelist.changeSwitch($(target), value);
                    } else if (result.message) {
                        if ($.isFunction($.msg)) {
                            $.msg(result.message, {
                                icon: 'error'
                            });
                        } else {
                            alert(result.message);
                        }
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            }

            if (value == 0) {
                $.confirm("是否同时将所有下级地区设置为启用？", {
                    btn: ['是', '否', '取消']
                }, function() {
                    post.call(target, 1);
                }, function() {
                    post.call(target, 0);
                });
            } else {
                post.call(target, 1);
            }
        }

        function switch_scope_click(target, value) {
            var url = $(target).data("action");

            var post = function(is_sync) {

                $.loading.start();

                $.post(url, {
                    is_sync: is_sync
                }, function(result) {
                    if (result.code == 0) {
                        var value = result.data;
                        tablelist.changeSwitch($(target), value);
                    } else if (result.message) {
                        if ($.isFunction($.msg)) {
                            $.msg(result.message, {
                                icon: 'error'
                            });
                        } else {
                            alert(result.message);
                        }
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            }

            if (value == 0) {
                $.confirm("是否同时将所有下级地区设置为经营地区？", {
                    btn: ['是', '否', '取消']
                }, function() {
                    post.call(target, 1);
                }, function() {
                    post.call(target, 0);
                });
            } else {
                post.call(target, 1);
            }
        }

        $().ready(function() {

            tablelist = $("#tablelist").tablelist();

            $("#btn_submit").click(function() {
                var data = $("#searchForm").serializeJson();
                tablelist.load(data);
            });

            // 新增
            $("#btn_add_region").click(function() {
                var parent_code = "{{ $parent_code }}";
                $.modal({
                    title: "新增地区",
                    ajax: {
                        url: "/system/region/add",
                        data: {
                            parent_code: parent_code
                        }
                    }
                });
            });

            // 编辑
            $("body").on("click", ".edit", function() {
                var id = $(this).data("id");
                $.modal({
                    title: "编辑地区",
                    ajax: {
                        url: "/system/region/edit",
                        data: {
                            id: id
                        }
                    }
                });
            });

            // 导出
            $("#btn_export").click(function() {
                var query = $("#searchForm").serialize();
                $.go("/system/region/export.html?" + query, "_blank", false);
            });

        });
    </script>
@stop

{{--自定义css样式 page元素内--}}
@section('style_css')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop