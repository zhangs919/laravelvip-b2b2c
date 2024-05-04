{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2">

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

                        <input type="text" name="act_name" class="form-control" value="" placeholder="活动名称/店铺名称" />
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
    <div class="item-list-hd">
        <ul class="item-list-tabs">
            <li id="0" class="tabs-t current">
                <a>全部活动</a>
            </li>
            <li id="1" class="tabs-t">
                <a>未开始</a>
            </li>
            <li id="2" class="tabs-t">
                <a>进行中</a>
            </li>
            <li id="3" class="tabs-t">
                <a>已结束</a>
            </li>
            <!-- 			<li id="4" class="tabs-t">
                            <a>未审核</a>
                        </li>
                        <li id="5" class="tabs-t last">
                            <a>已审核</a>
                        </li> -->
        </ul>
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
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>

    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                if ($("#activity_status").val() != '') {
                    $("li[class^='tabs-']").removeClass('current');
                    $("li[id='" + $("#activity_status").val() + "']").addClass('current');
                } else {
                    $("li[class^='tabs-']").removeClass('current');
                    $("li[id='0']").addClass('current');
                }
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

            $("li[class^='tabs-']").click(function() {
                $("li[class^='tabs-']").removeClass('current');
                $(this).addClass('current');

                $("#activity_status").val($(this).attr("id"));

                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                tablelist.load();
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
    <script type="text/javascript">
        $().ready(function() {
            $(".shop_sort").editable({
                type: "text",
                url: "change-sort",
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.id = $(this).data("act_id");
                    params.title = "sort";
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '排序不能为空。';
                    } else if (!ex.test(value)) {
                        return '排序必须是0~255的正整数。';
                    } else if (value > 255) {
                        return '排序必须是0~255的正整数。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
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