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

    <div class="balance-bill column3">
        <dl>
            <dt>待审核提现金额</dt>
            <dd>
                <span class="money">{{ $wait_audit_count }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>审核通过转账中提现金额</dt>
            <dd>
                <span class="money">{{ $wait_pay_count }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>成功提现金额</dt>
            <dd>
                <span class="money">{{ $finished_count }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
    </div>
    
    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/finance/deposit/list" method="GET">
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
                        <span>会员名称：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" id="user_name" name="user_name" class="form-control" value="" placeholder="会员名称/手机号/邮箱">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="status" class="form-control" name="status">
                            <option value="-1">全部</option>
                            <option value="0">待审核</option>
                            <option value="1">审核通过，转账中</option>
                            <option value="2">提现成功</option>
                            <option value="3">已取消</option>
                            <option value="4">已拒绝</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>提现时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input class="form-control form_datetime ipt" type="text" name="start_time" id="start_time" data-rule-date="true" data-rule-dateiso="true">
                        <span class="ctime">至</span>
                        <input class="form-control form_datetime ipt" type="text" name="end_time" id="end_time" data-rule-date="true" data-rule-dateiso="true">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">

                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出">

            </div>
        </form>
    </div>


    <div class="common-title">
        <div class="ftitle">
            <h3>提现列表</h3>

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
    <div class="item-list-hd">
        <ul class="item-list-tabs">
            <li id="-1" class="tabs-t current">
                <a>全部</a>
            </li>
            <li id="0" class="tabs-t">
                <a>待审核</a>
            </li>
            <li id="1" class="tabs-t">
                <a>审核通过转账中</a>
            </li>
            <li id="2" class="tabs-t">
                <a>提现成功</a>
            </li>
            <li id="3" class="tabs-t">
                <a>已取消</a>
            </li>
            <li id="4" class="tabs-t last">
                <a>已拒绝</a>
            </li>
        </ul>
    </div>
    <!-- 分类列表 -->
    <div class="table-responsive">

        {{--引入分类列表--}}
        @include('finance.deposit.partials._list')

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
    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=1.2"> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
    <!-- 时间插件引入 end -->
    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                if ($("#status").val() != '') {
                    $("li[class^='tabs-']").removeClass('current');
                    $("li[id='" + $("#status").val() + "']").addClass('current');
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

            $("#btn_export").click(function() {
                var url = "/finance/deposit/export.html";
                url += "?user_name=" + $("#user_name").val();
                url += "&status=" + $("#status").val();

                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, null, false);
            });

            $("li[class^='tabs-']").click(function() {
                $("li[class^='tabs-']").removeClass('current');
                $(this).addClass('current');

                $("#status").val($(this).attr("id"));

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
            // 审批
            $("body").on("click", ".examine", function() {
                var id = $(this).data("id");
                $.modal({
                    title: '审核',
                    width: 500,
                    params: {
                        tablelist: tablelist
                    },
                    ajax: {
                        url: '/finance/deposit/examine',
                        data: {
                            id: id
                        }
                    },
                });
            });

            $("body").on('click', '.finish', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定要完成转账吗？',
                    url: 'finish',
                    data: {
                        id: id
                    }
                });
            });

            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                todayBtn: 1,
                autoclose: 1,
                weekStart: 0,
                startView: 2,//显示的初始示图(1:hour;2:day;3:month;4:year)
                minView: 2,//日期时间选择器所能够提供的最精确的时间选择视图(1:hour;2:day;3:month;4:year)
                //maxView: 4,
                minuteStep: 5,//分钟的阶段范围
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop