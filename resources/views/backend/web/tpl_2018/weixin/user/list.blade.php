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

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/weixin/user/list.html" method="GET">
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
                        <span>昵称：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="nickname" class="form-control" value="">
                    </div>
                </div>
            </div>
            <!--新加标签搜索
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>标签：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control">
                            <option value="0">请选择</option>
                        </select>
                    </div>
                </div>
            </div>-->
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索">
            </div>
        </form>
    </div>



    <div class="common-title">
        <div class="ftitle">
            <h3>粉丝管理列表</h3>

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
    <!-- 列表 -->
    <div class="table-responsive">
        @include('weixin.user.partials._list')
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
    <script>
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params : $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                var params = $("#searchForm").serializeJson();
                tablelist.load(params);
                return false;
            });
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm : '您确定删除这条记录吗？',
                    url : 'delete',
                    data : {
                        id : id
                    }
                });
            });
        });

    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop