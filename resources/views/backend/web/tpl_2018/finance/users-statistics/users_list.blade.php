{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/datetime/dateformat.js"></script>
    <script src="/assets/d2eace91/js/echarts/echarts-all.js"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="search-term m-b-10">
        <form id="searchForm" action="/finance/users-statistics/users-list" method="GET">
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="from" class="form-control form_datetime ipt" name="from" value="" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="to" class="form-control form_datetime ipt" name="to" value="" placeholder="结束时间">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <a class="inline-item date" href="javascript:void(0);">今天</a>
                <em class="ft-bar">|</em>
                <span class="inline-text">最近：</span>
                <a class="inline-item date" href="javascript:void(0);">1个月</a>
                <a class="inline-item date" href="javascript:void(0);">3个月</a>
                <a class="inline-item date" href="javascript:void(0);">1年</a>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>

                <!-- <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" /> -->

            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>下单总金额前15名买家</h3>

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
    <div class="table-responsive">

        <table id="table_list" class="table table-hover">
            <thead>
            <tr>
                <th class="w100">序号</th>
                <th class="w150">会员名称</th>
                <th class="w150">会员手机号</th>
                <th class="text-c w120">有效下单总金额（元）</th>
            </tr>
            </thead>
            <tbody>

            @if(!$order_amount_top_users->isEmpty())
                @foreach($order_amount_top_users as $key=>$item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->user_name }}</td>
                        <td>{{ $item->mobile }}</td>
                        <td class="text-c">{{ $item->total_fee }}</td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>下单量前15名买家</h3>

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
    <div class="table-responsive">
        <table id="table_list" class="table table-hover">
            <thead>
            <tr>
                <th class="w100">序号</th>
                <th class="w150">会员名称</th>
                <th class="w150">会员手机号</th>
                <th class="text-c w120">有效下单量</th>
            </tr>
            </thead>
            <tbody>

            @if(!$order_count_top_users->isEmpty())
                @foreach($order_count_top_users as $key=>$item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->user_name }}</td>
                        <td>{{ $item->mobile }}</td>
                        <td class="text-c">{{ $item->order_count }}</td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>

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
    <script type='text/javascript'>
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd'
        });

        $('#from').datetimepicker().on('changeDate', function(ev) {
            $('#to').datetimepicker('setStartDate', ev.date);
        });
        $('#to').datetimepicker().on('changeDate', function(ev) {
            $('#from').datetimepicker('setEndDate', ev.date);
        });

        $(".date").click(function() {
            $(".date").removeClass("active");
            $(this).addClass("active");
            if ($(this).text() == "今天") {
                var myDate = new Date();
                $('#from').val(myDate.Format("yyyy-MM-dd"));
                $('#to').val('');
            } else if ($(this).text() == "1个月") {
                var myDate = new Date();
                myDate.setMonth(myDate.getMonth() - 1);
                $('#from').val(myDate.Format("yyyy-MM-dd"));
                $('#to').val('');
            } else if ($(this).text() == "3个月") {
                var myDate = new Date();
                myDate.setMonth(myDate.getMonth() - 3);
                $('#from').val(myDate.Format("yyyy-MM-dd"));
                $('#to').val('');
            } else if ($(this).text() == "1年") {
                var myDate = new Date();
                myDate.setYear(myDate.getFullYear() - 1);
                $('#from').val(myDate.Format("yyyy-MM-dd"));
                $('#to').val('');
            }
        });

    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop