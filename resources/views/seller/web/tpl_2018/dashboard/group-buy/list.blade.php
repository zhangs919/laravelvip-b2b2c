{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/group-buy/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>活动名称：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="act_name" class="form-control" value="" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>审核状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="status" class="form-control" name="status">
                            <option value="-1">全部</option>
                            <option value="0">待审核</option>
                            <option value="1">已审核</option>
                            <option value="2">审核未通过</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>活动状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="act_status" class="form-control" name="act_status">
                            <option value="-1">全部</option>
                            <option value="0">未开始</option>
                            <option value="1">进行中</option>
                            <option value="2">已结束</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>团购列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <!-- 分类列表 -->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('dashboard.group-buy.partials._list')
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

    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>
    <script type="text/javascript">
        var tablelist;
        //popover弹框
        $("[data-toggle='popover']").popover();
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

            // 查看原因
            $("body").on("click", ".view", function() {
                var act_id = $(this).data("id");

                $.open({
                    title: '查看原因',
                    width: '500px',
                    ajax: {
                        url: '/dashboard/group-buy/view-reason',
                        data: {
                            act_id: act_id
                        }
                    },
                });
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

            // 批量删除
            $("body").on("click", ".batch-del", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量删除吗？',
                    url: 'batch-delete',
                    data: {
                        ids: ids
                    }
                });
            });

        });
    </script>
    <script type="text/javascript">
        $("body").on("click", ".upload-img", function() {
            var image = $(this).siblings("a");
            var span = $(this);
            $.imageupload({
                url: $(this).data("url"),
                data: {
                    act_id: $(this).data("id")
                },
                callback: function(result) {
                    if (result.code == 0) {
                        $(image).attr("ref", result.data.url);
                        $(span).attr("class", "btn btn-success btn-xs pos-r upload-img");
                        $.msg(result.message, {
                            time: 2000
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            });
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop