{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20180809"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20180702"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->


    <div class="common-title">
        <div class="ftitle">
            <h3>{{ $title }}</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>
    <!-- 分类列表 -->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('user.live-user.partials._list')

    </div>

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
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>

    <script type="text/javascript">
        var tablelist;
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


        });

        // 审核
        $("body").on("click", ".audit", function() {
            var id = $(this).data("id");
            $.modal({
                title: '审核主播',
                width: 550,
                ajax: {
                    url: '/user/live-user/audit',
                    data: {
                        id: id
                    }
                },
            });
        });

    </script>


@stop

{{--outside body script--}}
@section('outside_body_script')

@stop