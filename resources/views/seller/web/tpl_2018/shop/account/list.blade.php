{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="query" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>登录名：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="user_name" name="user_name" class="form-control" type="text" value="">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>角色：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="role_id" name="role_id">

                            <option value="-1">全部</option>

                            <option value="169">老板</option>

                            <option value="170">运营人员</option>

                            <option value="171">财务</option>

                            <option value="172">订单及客服</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>类型：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="type" name="type">
                            <option value="0">全部</option>
                            <option value="1">店铺管理员</option>
                            <option value="2">网点管理员</option>
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
                        <select class="form-control" id="status" name="status">
                            <option value="-1">全部</option>
                            <option value="1">启用</option>
                            <option value="0">禁用</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>管理员列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.account.partials._list')

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
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            // 取消记录
            $("body").on('click', '.del', function() {
                var id = $(this).attr("object_id");
                var store_id = $(this).data("store_id");

                if (store_id > 0) {
                    $.msg("此帐号为网点管理员，请先删除网点！");
                    return;
                }

                tablelist.remove({
                    confirm: '您确定删除这个管理员账号吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });

            // 搜索
            $("#searchForm").submit(function() {
                tablelist.load({
                    // 登录名
                    'user_name': $("#user_name").val(),
                    // 角色
                    'role_id': $("#role_id").val(),
                    // 类型
                    'type': $("#type").val(),
                    // 管理员状态
                    'status': $("#status").val()
                });
                return false;
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop