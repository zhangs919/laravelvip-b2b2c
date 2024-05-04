{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <!--统计-->
    <div class="balance-bill column2">
        <dl>
            <dt>账户进账金额</dt>
            <dd>
                <span class="money">{{ $income }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>账户出账金额</dt>
            <dd>
                <span class="money">{{ abs($expend) }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
    </div>
    <!--搜索-->
    <div class="search-term m-b-10 pos-r">
        <form id="searchForm" action="/finance/seller-account/list.html" method="GET">
            <div class="form-item">
                <div class="simple-form-field ">
                    <div class="form-group">
                        <label class="control-label">
                            <span>变动时间：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input type="text" id="from" class="form-control form_datetime ipt pull-none" name="from">
                            <span class="ctime">至</span>
                            <input type="text" id="to" class="form-control form_datetime ipt pull-none" name="to">
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
                        <div class="form-control-wrap">
                            <a class="inline-item category active" href="javascript:void(0);">全部</a>
                            <a class="inline-item category" value="11" href="javascript:void(0);">交易订单</a>
                            <a class="inline-item category" value="12" href="javascript:void(0);">退款订单</a>
                            <a class="inline-item category" value="13" href="javascript:void(0);">取消订单</a>
                            <a class="inline-item category" value="14" href="javascript:void(0);">短信购买</a>
                            <a class="inline-item category" value="15" href="javascript:void(0);">神码收银</a>
                            <a class="inline-item category" value="16" href="javascript:void(0);">退还运费</a>
                            <a class="inline-item category" value="17" href="javascript:void(0);">退还配送费和包装费</a>
                            <a class="inline-item category" value="18" href="javascript:void(0);">售卖店铺购物卡</a>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="account_type" name="account_type" />
            </div>
            <div class="form-item toggle hide">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>状态：</span>
                        </label>
                        <div class="form-control-wrap">
                            <select class="form-control" name="status">
                                <option value="">-- 请选择 --</option>
                                <option value="0">进行中</option>
                                <option value="1">交易成功</option>
                                <option value="2">交易关闭</option>
                                <option value="3">退款成功</option>
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
                    </div>
                </div>
            </div>
            <a id="searchMore" class="btn-link more">更多筛选条件</a>
        </form>    </div>
    <!-- <div class="balance">
                <span>
            支出：
            <font class="ft-amount ft-out">0.00</font>
            元
        </span>
            </div> -->
    <div class="common-title">
        <div class="ftitle">
            <h3>交易记录</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>	<!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('finance.seller-account.partials._list')

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

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/datetime/dateformat.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
                return false;
            });
        });
        // 
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
        // 
        $(function(){
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
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop