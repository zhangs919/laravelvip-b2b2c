{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
<!-- 日历控件-->
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.2"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
<script src="/assets/d2eace91/js/datetime/dateformat.js?v=1.2"></script>

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--统计-->
    <div class="balance-bill column2">
        <dl>
            <dt>商城进账金额</dt>
            <dd>
                <span class="money">{{ $income }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>商城出账金额</dt>
            <dd>
                <span class="money">{{ $expend }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <!-- <dl>
            <dt>商城积分收入</dt>
            <dd>
                <span class="money">13</span>
                <span class="unit">点</span>
            </dd>
        </dl>
        <dl>
            <dt>商城积分支出</dt>
            <dd>
                <span class="money">500</span>
                <span class="unit">点</span>
            </dd>
        </dl> -->
    </div>

    <!--搜索-->
    <div class="search-term m-b-10 pos-r">
        <form id="searchForm" action="/finance/mall-account/list.html" method="GET">
            <!-- <div class="form-item  h30 l-h-32 text-r">
                <span class="c-green">账户累计进账：1500.00元</span>
                <span class="c-blue">账户累计出账：1000.00元</span>
            </div> -->
            <div class="form-item">
                <div class="simple-form-field ">
                    <div class="form-group">
                        <label class="control-label">
                            <span>时间：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input type="text" id="from" class="form-control form_datetime ipt" name="from">
                            <span class="ctime">至</span>
                            <input type="text" id="to" class="form-control form_datetime ipt" name="to">
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
                    <!-- <a class="inline-item date choice" href="javascript:void(0);">
                    按月选择
                    <i class="fa fa-caret-down"></i>
                </a> -->
                </div>
            </div>
            <div class="form-item search-params">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>分类：</span>
                        </label>
                        <div class="form-control-wrap w900">
                            <a class="inline-item category active" href="javascript:void(0);">全部</a>

                            <a class="inline-item category" value="101" href="javascript:void(0);">购物在线支付交易收入</a>
                            <a class="inline-item category" value="102" href="javascript:void(0);">充值</a>
                            <a class="inline-item category" value="103" href="javascript:void(0);">保证金和使用费</a>
                            <a class="inline-item category" value="104" href="javascript:void(0);">续缴平台使用费</a>
                            <a class="inline-item category" value="105" href="javascript:void(0);">神码收银</a>
                            <!-- <a class="inline-item category" value="106" href="javascript:void(0);">余额支付退款</a>
                            <a class="inline-item category" value="107" href="javascript:void(0);">余额支付取消订单</a> -->
                            <a class="inline-item category" value="108" href="javascript:void(0);">人为调整-增加</a>
                            <a class="inline-item category" value="109" href="javascript:void(0);">在线支付购买短信</a>
                            <a class="inline-item category" value="110" href="javascript:void(0);">站点加盟费</a>
                            <a class="inline-item category" value="111" href="javascript:void(0);">平台储值卡充值</a>
                            <a class="inline-item category" value="112" href="javascript:void(0);">支付宝退款</a>

                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="account_type" name="account_type">
            <div class="form-item toggle hide">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>账户类型：</span>
                        </label>
                        <div class="form-control-wrap">
                            <select class="form-control" name="pay_name">

                                <option value="">-- 请选择 --</option>

                                <option value="支付宝">支付宝</option>

                                <option value="银联支付">银联支付</option>

                                <option value="微信支付">微信支付</option>

                                <option value="虚拟账户">虚拟账户</option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-item toggle hide">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>金额区间：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input name="min_amount" class="form-control ipt pull-none" type="text">
                            <span class="ctime">至</span>
                            <input name="max_amount" class="form-control ipt pull-none m-r-5" type="text">
                            元
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-item toggle hide">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>关键词：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input name="key_word" class="form-control w300" type="text" placeholder="流水号/订单号/名称/备注">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-item">
                <div class="simple-form-field">
                    <label class="control-label"></label>
                    <div class="form-control-wrap">
                        <button class="btn btn-primary m-r-5">搜索</button>
                        <!-- <button class="btn btn-default m-r-5">导出</button> -->
                    </div>
                </div>
            </div>
            <a id="searchMore" class="btn-link more">更多筛选条件</a>
        </form>
    </div>


    <div class="common-title">
        <div class="ftitle">
            <h3>商城账户列表</h3>

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
    <div class="table-responsive">

    @include('finance.mall-account.partials._income_list')

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

    <script type="text/javascript">
    $().ready(function() {
        var tablelist = $("#table_list").tablelist({
            params: $("#searchForm").serializeJson(),
            url: 'list'
        });
        $("#searchForm").submit(function() {
            // 序列化表单为JSON对象
            var data = $(this).serializeJson();
            // Ajax加载数据
            tablelist.load(data);
            // 阻止表单提交
            return false;
        });
    });
</script>
<script type="text/javascript">
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

    $(".category").click(function() {
        $(".category").removeClass("active");
        $(this).addClass("active");
        $("#account_type").val($(this).attr("value"));
    });
</script>
    
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop