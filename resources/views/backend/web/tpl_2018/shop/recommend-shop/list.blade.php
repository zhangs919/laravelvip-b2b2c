{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/shop/recommend-shop/list.html" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="keywords" class="form-control w180" value="" placeholder="店铺名称/推荐人/联系方式">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="status" class="form-control" name="status">
                            <option value="-1">请选择</option>
                            <option value="0">待审核</option>
                            <option value="1">审核通过</option>
                            <option value="2">审核未通过</option>
                            <option value="3">已取消</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
            </div>
        </form>
    </div>
    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>推荐开店</h3>

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
    <!--列表内容-->


    {{--引入列表--}}
    @include('shop.recommend-shop.partials._list')

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
            // 备注
            $("body").on("click", ".remark", function() {
                var id = $(this).data("id");

                $.open({
                    title: '备注',
                    type: 1,
                    width: '600px',
                    height: '260px',
                    ajax: {
                        url: 'remark',
                        data: {
                            id: id
                        }
                    },
                    btn: '确认提交',
                    yes: function(index, container) {
                        var data = $(container).serializeJson();
                        $.loading.start();
                        $.post('/shop/recommend-shop/remark', data, function(result) {
                            $.loading.stop();
                            if (result.code == 0) {
                                $.closeAll();
                                tablelist.load();
                                $.msg(result.message);
                            } else {
                                $.msg(result.message, {
                                    time: 2000
                                })
                            }
                        }, "json");
                    }
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
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop