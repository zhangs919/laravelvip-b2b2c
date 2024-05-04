{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/user-bonus/list.html" method="GET">		<div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" name="keywords" class="form-control" placeholder="请输入红包序号" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>使用状态：</span>
                    </label>
                    <div class="form-control-wrap"><select class="form-control" name="bonus_status">
                            <option value="">全部</option>
                            <option value="0">未使用</option>
                            <option value="1">已使用</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>领取状态：</span>
                    </label>
                    <div class="form-control-wrap"><select class="form-control" name="receive_status">
                            <option value="">全部</option>
                            <option value="0">未领取</option>
                            <option value="1">已领取</option>
                        </select></div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>红包类型：</span>
                    </label>
                    <div class="form-control-wrap"><select class="form-control" name="bonus_type">
                            <option value="">全部</option>
                            <option value="1">到店送红包</option>
                            <option value="2">收藏送红包</option>
                            <option value="4">会员送红包</option>
                            <option value="10">积分兑换红包</option>
                        </select></div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="hidden" name="activity_id" value="">
                <input type="button" class="btn btn-primary m-r-5" id="btn_search" value="搜索">
            </div>
        </form>	</div>
    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>已发送红包列表</h3>

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
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('dashboard.user-bonus.partials._list')

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
    <script type='text/javascript'>
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
            /* 搜索 */
            $("#btn_search").click(function() {
                var data = $("#searchForm").serializeJson();
                tablelist.load(data);
            });
            /* excel导出 */
            $("body").on('click', '#excel', function() {
                $("#searchForm").attr("action", "excel-export");
                $("#searchForm").submit();
            });

            $("body").on("mouseover", ".bonus-desc", function() {
                $.tips($(this).data("bonus-desc"), $(this));
            });

            $("body").on("mouseout", ".bonus-desc", function() {
                $.closeAll("tips");
            });
        })
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop