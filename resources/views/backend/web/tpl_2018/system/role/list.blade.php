{{--模板继承--}}
@extends('layouts.app')

{{--content--}}
@section('content')

    <div class="search-term m-b-10">
        <form id="searchForm" action="/system/role/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>角色名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="role_name" id="role_name" class="form-control" type="text" value="">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <button class="btn btn-primary">搜索</button>
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>角色列表</h3>

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
    @include('system.role.partials._list')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#btn_submit").click(function() {
                tablelist.load({});
            });
            $("#searchForm").submit(function() {
                tablelist.load({
                    'role_name': $("#role_name").val(),
                });
                return false;
            });

            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop