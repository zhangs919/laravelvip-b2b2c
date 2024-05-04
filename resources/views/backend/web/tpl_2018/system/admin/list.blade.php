{{--模板继承--}}
@extends('layouts.app')

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/system/admin/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>登录名：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="user_name" id="user_name" class="form-control" type="text" value="">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>姓名：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="real_name" id="real_name" class="form-control" type="text" value="">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索">
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>管理员列表</h3>

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

    {{--引入列表--}}
    @include('system.admin.partials._list')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                tablelist.load({
                    'user_name': $("#user_name").val(),
                    'real_name': $("#real_name").val()
                });
                return false;
            });
        });

        //删除管理员
        function delConfirm(id) {
            $.confirm('您确认要删除该管理员吗？删除后不可恢复!', {
                btn: ['确定', '取消']
                //按钮
            }, function() {
                $.ajax({
                    url: 'delete',
                    data: {
                        id: id
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                icon: 1,
                                time: 1000
                            }, function() {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message, {
                                icon: 2
                            });
                        }
                    },
                    error: function() {
                        $.msg('数据异常！', {
                            icon: 2
                        })
                    }
                })
            }, function() {

            })
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop