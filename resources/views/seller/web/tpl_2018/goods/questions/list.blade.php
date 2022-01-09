{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20180710"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20180702"/>
@stop

{{--content--}}
@section('content')


    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/goods/questions/list.html" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>问题名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="question_name" id='question_name' class="form-control" type="text" placeholder="名称">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>常见问题列表</h3>

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

        @include('goods.questions.partials._list')

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

            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                tablelist.load({
                    //问题名称
                    'question_name': $("#question_name").val(),
                });
                return false;
            });
        });

        // 删除记录
        $("body").on('click', '.del', function() {
            var id = $(this).attr("object_id");

            $.confirm('您确定删除这条记录吗？', function() {
                $.post('/goods/questions/delete', {
                    id: id
                }, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message);
                        $.go('list');
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        })
                    }
                }, "json");
            })

        });
    </script>


    <script type='text/javascript'>
        $(document).ready(function() {
            $(".question_sort").editable({
                type: "text",
                url: "/goods/questions/edit-question-info",
                pk: 1,
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.id = $(this).data("id");
                    params.title = "sort";
                    return params;
                },
                success: function(response, newValue) {
                    var response = eval("(" + response + ")");
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop