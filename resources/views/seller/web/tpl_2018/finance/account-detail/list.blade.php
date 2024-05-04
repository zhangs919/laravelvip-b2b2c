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

    <div class="balance-bill column3">
        <dl>
            <dt>可提现资金</dt>
            <dd>
                <span class="money">{{ $user['user_money'] }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>不可提现资金</dt>
            <dd>
                <span class="money">{{ $user['user_money_limit'] }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>冻结资金</dt>
            <dd>
                <span class="money">{{ $user['frozen_money'] }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
    </div>
    <!--搜索-->
    <div class="search-term m-b-10 pos-r">
        <form id="searchForm" name="searchForm" action="/finance/account-detail/list.html" method="GET">        <div class="form-item">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>关键词：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input id="key_word" name="key_word" class="form-control w300" type="text" placeholder="流水号/名称/备注">
                        </div>
                    </div>
                </div>
            </div>
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
                    <a class="inline-item date active" href="javascript:void(0);">今天</a>
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
            <div class="form-item search-params p-t-5">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>分类：</span>
                        </label>
                        <div class="form-control-wrap">
                            <a class="inline-item category active" href="javascript:void(0);">全部</a>
                            <a class="inline-item category" value="1" href="javascript:void(0);">充值</a>
                            <a class="inline-item category" value="11" href="javascript:void(0);">退款-余额支付</a>
                            <a class="inline-item category" value="10" href="javascript:void(0);">取消-余额支付</a>
                            <a class="inline-item category" value="15" href="javascript:void(0);">推荐分成</a>
                            <a class="inline-item category" value="16" href="javascript:void(0);">撤销推荐分成</a>
                            <a class="inline-item category" value="17" href="javascript:void(0);">分销账户提现到余额</a>
                            <a class="inline-item category" value="5" href="javascript:void(0);">调节账户资金</a>
                            <a class="inline-item category" value="8" href="javascript:void(0);">购物-余额支付</a>
                            <a class="inline-item category" value="19" href="javascript:void(0);">平台结算进账</a>
                            <a class="inline-item category" value="4" href="javascript:void(0);">提现</a>
                            <a class="inline-item category" value="18" href="javascript:void(0);">拒绝提现</a>
                            <a class="inline-item category" value="21" href="javascript:void(0);">购买短信</a>
                            <a class="inline-item category" value="20" href="javascript:void(0);">神码收银</a>
                            <a class="inline-item category" value="22" href="javascript:void(0);">储值卡充值</a>
                            <a class="inline-item category" value="23" href="javascript:void(0);">退款成功退还运费</a>
                            <a class="inline-item category" value="34" href="javascript:void(0);">退款成功退还配送费和包装费</a>
                            <a class="inline-item category" value="12" href="javascript:void(0);">取消订单返还定金</a>
                            <a class="inline-item category" value="24" href="javascript:void(0);">取消提现</a>
                            <a class="inline-item category" value="26" href="javascript:void(0);">提现手续费</a>
                            <a class="inline-item category" value="25" href="javascript:void(0);">线下消费余额</a>
                            <a class="inline-item category" value="27" href="javascript:void(0);">线下收款</a>
                            <a class="inline-item category" value="28" href="javascript:void(0);">线上转入线下余额</a>
                            <a class="inline-item category" value="29" href="javascript:void(0);">线下转入线上余额</a>
                            <a class="inline-item category" value="30" href="javascript:void(0);">保证金</a>
                            <a class="inline-item category" value="31" href="javascript:void(0);">订单返现金额</a>
                            <a class="inline-item category" value="32" href="javascript:void(0);">售后退款</a>
                            <a class="inline-item category" value="33" href="javascript:void(0);">店铺奖励金</a>
                            <a class="inline-item category" value="41" href="javascript:void(0);">售卖店铺购物卡</a>
                            <a class="inline-item category" value="36" href="javascript:void(0);">发布二手信息</a>
                            <a class="inline-item category" value="39" href="javascript:void(0);">会员权益卡-付费购买</a>
                            <a class="inline-item category" value="40" href="javascript:void(0);">会员权益卡-退款</a>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="process_type" name="process_type" />
            <div class="form-item toggle hide">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>金额区间：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input id="min_amount" name="min_amount" class="form-control ipt pull-none" type="text">
                            <span class="ctime">至</span>
                            <input id="max_amount" name="max_amount" class="form-control ipt pull-none m-r-5" type="text">
                            元
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-item toggle hide">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>支付方式：</span>
                        </label>
                        <div class="form-control-wrap">
                            <select class="form-control" id="pay_code" name="pay_code">
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
            <div class="form-item">
                <div class="simple-form-field">
                    <label class="control-label"></label>
                    <div class="form-control-wrap">
                        <button class="btn btn-primary m-r-5">搜索</button>
                        <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" />
                    </div>
                </div>
            </div>
            <a id="searchMore" class="btn-link more">更多筛选条件</a>
        </form>    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>店铺账户明细列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('finance.account-detail.partials._list')

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
                url: "list?id=2711"
            });
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            $("#btn_export").click(function() {
                var url = "/finance/account-detail/export-detail.html";
                url += "?key_word=" + $("#key_word").val();
                url += "&from=" + $("#from").val();
                url += "&to=" + $("#to").val();
                url += "&process_type=" + $("#process_type").val();
                url += "&min_amount=" + $("#min_amount").val();
                url += "&pay_code=" + $("#pay_code").val();
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, "_blank", false);
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
            var myDate = new Date();
            $('#from').val(myDate.Format("yyyy-MM-dd"));
            $(".category").click(function() {
                $(".category").removeClass("active");
                $(this).addClass("active");
                $("#process_type").val($(this).attr("value"));
            });
            $("#deposit").click(function() {
                $.go("http://{{ config('lrw.frontend_domain') }}/user/deposit/add.html", '_blank', false);
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop