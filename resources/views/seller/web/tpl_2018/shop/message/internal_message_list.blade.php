{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="query" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>消息内容：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="content" name="content" class="form-control" type="text" value="">
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
            <h3>站内信列表</h3>

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
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.message.partials._internal_message_list')

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
            // 搜索
            $("#searchForm").submit(function() {
                tablelist.load({
                    // 消息内容
                    'content': $("#content").val()
                });
                return false;
            });

            // 查看详情
            $("body").on("click", ".btn-link", function() {
                var msg_id = $(this).data("msg-id");
                var rec_id = $(this).data("rec-id");

                $.open({
                    title: "站内信#" + rec_id,
                    ajax: {
                        url: "/shop/message/view",
                        data: {
                            msg_id: msg_id
                        }
                    },
                    width: "600px",
                    btn: ['关闭']
                });
            });

            // 删除
            $("body").on('click', '.del', function() {
                var id = $(this).data("rec-id");
                tablelist.remove({
                    confirm: '您确定删除站内信#' + id + '吗？',
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