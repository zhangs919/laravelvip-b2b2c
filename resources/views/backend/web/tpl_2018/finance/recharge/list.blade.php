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
            <dt>在线充值金额</dt>
            <dd>
                <span class="money">0.00</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <!-- <dl>
            <dt>储值卡充值金额</dt>
            <dd>
                <span class="money">0.00</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>支付红包充值金额</dt>
            <dd>
                <span class="money">0.00</span>
                <span class="unit">元</span>
            </dd>
        </dl> -->
    </div>
    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/finance/recharge/list.html" method="GET">
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
                        <span>支付方式：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="pay_code" name="pay_code">
                            <option value="">全部</option>

                            <option value="alipay">支付宝</option>

                            <option value="union">银联支付</option>

                            <option value="weixin">微信支付</option>

                            <option value="app_weixin">APP微信支付</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>支付状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="status" class="form-control" name="status">
                            <option value="-1">全部</option>
                            <option value="0">未支付</option>
                            <option value="1">已支付</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>充值日期：</span>
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

                <input type="button" id="btn_export" class="btn btn-default" value="导出">

                <a id="searchMore" class="btn-link m-l-10">更多筛选条件</a>
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>充值列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true">0</span>
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
    <!-- 分类列表 -->
    <div class="table-responsive">

        @include('finance.recharge.partials._list')


    </div>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=1.2">
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=1.2"></script>
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
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

            $("#btn_export").click(function() {
                var url = "/finance/recharge/export.html";
                url += "?user_name=" + $("#user_name").val();
                url += "&pay_code=" + $("#pay_code").val();
                url += "&status=" + $("#status").val();
                url += "&start_time=" + $("#start_time").val();
                url += "&end_time=" + $("#end_time").val();

                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, null, false);
            });

            // 审批
            $("body").on("click", ".view", function() {
                var id = $(this).data("id");
                var status = $(this).data("status");

                $.open({
                    title: '充值明细',
                    width: '670px',
                    ajax: {
                        url: '/finance/recharge/view',
                        data: {
                            id: id
                        }
                    },
                    btn: [status == 0 ? '保存' : '关闭'],
                    yes: function(index, container) {
                        if (status == 0) {

                            if (!validator.form()) {
                                return;
                            }

                            var data = $(container).serializeJson();
                            $.loading.start();
                            $.post('/finance/recharge/view.html', data, function(result) {
                                $.loading.stop();
                                if (result.code == 0) {
                                    $.closeAll();
                                    tablelist.load();
                                    $.msg(result.message);
                                } else {
                                    $.msg(result.message, {
                                        time: 5000
                                    })
                                }
                            }, "json");
                        } else {
                            $.closeDialog(index);
                        }
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