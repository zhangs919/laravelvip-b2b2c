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

    <div class="bill-title">
        <span>
            账单日期： <em>{{ $bill_info['start_time'] }} ~ {{ $bill_info['end_time'] }}</em>
        </span>
        <span>
            店铺名称： <em>{{ $shop_info['shop_name'] }}</em>
        </span>
        @if(!empty($site))
        <span>
            所属站点： <em>{{ $site['site_name'] }}</em>
        </span>
        @endif
    </div>
    <!--步骤-->
{{--    <div class="order-step bill">--}}
{{--        <!--完成步骤为dl添加current样式，完成操作内容后会显示完成时间-->--}}
{{--        <dl class="step-first current">--}}
{{--            <dt>账单待出账</dt>--}}
{{--            <dd class="bg"></dd>--}}
{{--            <dd class="details cur-p" title="什么样的账单可以出账？" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="left" data-content='当周期内的所有订单都已经确认收货，并不再发生退款退货时，即可出账。例如：订单在1号确认收货，商城设置“申请售后期限”为7天，那么此笔订单会在8号出账'>--}}
{{--                <p>此周期还有未出账的账单， 请等待账单出账！</p>--}}
{{--                <p class="c-blue m-t-10">什么样的账单可以出账？</p>--}}
{{--            </dd>--}}
{{--        </dl>--}}
{{--        <dl class="current">--}}
{{--            <dt style="right: -40px">已出账，已转入余额</dt>--}}
{{--            <dd class="bg"></dd>--}}
{{--            <dd class="details">--}}
{{--                <span>--}}
{{--                    应结金额： <strong>{{ $order_message['stage_money'] }}</strong>--}}
{{--                </span>--}}
{{--                <span>--}}
{{--                    订单总数： <strong>{{ $order_message['order_count'] }}</strong> 单--}}
{{--                </span>--}}
{{--            </dd>--}}
{{--        </dl>--}}
{{--    </div>--}}
    <!--统计-->
    <!-- <div class="balance-bill settlement">
        <h5>本期结算</h5>
        <p>结算时间： 2019-06-01~2019-06-30</p>
        <p>本期应结：31.00=31.00(订单金额)-0.00（佣金金额）+0.00（运费金额）</p>
        <p>结算状态：已结算</p>
        <p>商家账户：，账号：</p>
    </div> -->
{{--    <div class="explanation m-b-10">--}}
{{--        <div class="title explain-checkZoom" title="">--}}
{{--            <i class="fa fa-bullhorn"></i>--}}
{{--            <h4>温馨提示</h4>--}}
{{--        </div>--}}
{{--        <ul class="explain-panel">--}}
{{--            <li>--}}
{{--                <span>付款金额=订单中所有商品总金额-店铺红包-店铺优惠-平台红包-积分抵扣金额-退款成功的商品的退款金额； 平台佣金=（未退款成功的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠）*平台与店铺的佣金比例-（未退款成功的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠）*平台与店铺的佣金比例*站点与平台的佣金比例，站点佣金=（未退款成功的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠）*平台与店铺的佣金比例*站点与平台间的佣金比例</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span>账单计算公式：应付店铺金额=订单中未退款的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠+运费+额外配送费+包装费-（店铺购物卡总支付金额-店铺购物卡退回金额）-平台佣金-站点佣金+（退款成功的商品的应退款金额-退款成功的商品的实际退款金额）-未退款商品均分的订单返现金额；如发现金额计算不准，是因为存在货到付款情况，请以本期应结金额为准</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span>货到付款支付方式，应付店铺金额=余额支付金额+平台承担活动款+积分抵扣金额-平台佣金-站点佣金 货到付款是特殊的付款方式，系统默认此款项已由店铺收取，因此店铺需要支付佣金给平台，所以本期应结金额为负数，结算时请注意</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span>账单处理流程：系统自动出账 > 商家手动结算打款到网点/门店的结算账户中，共2个环节</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span>账单出账时间：当周期内的所有订单都已经确认收货，并不再发生退款退货时，即可出账，例如：订单在1号确认收货，商城设置“申请售后期限”为7天，那么此笔订单会在8号出账</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span>店铺欠款：指结算周期的账单，出账统计的结算金额是负数，那么此账单内的所有订单都有"欠"标记，表示店铺应线下给平台支付的费用</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span>支付汇总：统计结算周期内所有订单的各种支付方式的支付金额 </span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span>如果结算周期已经超过了，并且账单状态已经是已出账，已转入余额后，但是这个周期内的某个订单在结算周期过了之后才点击的确认收货并且尚未超过售后期限的时候，有待结算标记，在超过售后期限后，系统将自动补寄一张本周期内的账单</span>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/finance/bill/shop-orders-info" method="GET">
            <input type="hidden" name="shop_id" value="{{ $shop_id}}">
            <input type="hidden" name="group_time" value="{{ $group_time}}">
            <input type="hidden" name="type" value="{{ $type }}">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单编号：</span>
                    </label>
                    <input id="order_sn" name="order_sn" class="form-control" type="text" placeholder="订单编号">
                </div>
            </div>
{{--            <div class="simple-form-field">--}}
{{--                <div class="form-group">--}}
{{--                    <label class="control-label">--}}
{{--                        <span>付款方式：</span>--}}
{{--                    </label>--}}
{{--                    <div class="form-control-wrap">--}}
{{--                        <select name='is_cod' class="form-control">--}}
{{--                            <option value="0">全部</option><option value="1">线上付款</option><option value="2">货到付款</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>结算状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="chargeoff_status" name="chargeoff_status" class="form-control">
                            <option value="">全部</option><option value="0">待结算</option><option value="1">已结算</option>
                        </select>
                    </div>
                </div>
            </div>
{{--            <div class="simple-form-field">--}}
{{--                <div class="form-group">--}}
{{--                    <label class="control-label">--}}
{{--                        <span>店铺欠款：</span>--}}
{{--                    </label>--}}
{{--                    <div class="form-control-wrap">--}}
{{--                        <select id="shop_money_lt_zero" name="shop_money_lt_zero" class="form-control">--}}
{{--                            <option value="">全部</option><option value="1">是</option><option value="0">否</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>下单时间：</span>
                    </label>
                    <div class="form-control-wrap">
                    <input type="text" id="begin" class="form-control form_datetime ipt pull-none" name="begin">
                    至
                    <input type="text" id="end" class="form-control form_datetime ipt pull-none" name="end">
                    </div>
                </div>
            </div>
             -->
            <div class="simple-form-field">
                <label class="control-label"></label>
                <div class="form-control-wrap">
                    <button class="btn btn-primary m-r-5">搜索</button>
                </div>
            </div>
        </form>    </div>
    <input type="hidden" name="type" id="type" value="0">
    <input type="hidden" name="shop_id" id="shop_id" value="511">
    <input type="hidden" name="group_time" id="group_time" value="2019-06">
    <!--列表上面（列表名称、列表显示项设置）-->
    <div class="common-title">
        <div class="ftitle">
            <h3>账单详情</h3>
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
        @include('finance.bill.partials._shop_orders_info')

    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <div class="modal fade" id="settlementModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">结算</h4>
                </div>
                <div class="modal-body">
                    <h5>您确定已经与商家结算此笔账单吗</h5>
                    <form method="" action="" class="form-horizontal">
                        <div class="simple-form-field">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <span class="ng-binding">商家账户：</span>
                                </label>
                                <div class="col-sm-8">
                                    <div class="form-control-box">
                                        <select class="form-control">
                                            <option value="0">支付宝，帐号：2348293</option>
                                            <option value="1">银行，帐号：2348293</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">确定</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // 
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')
    <script src="/assets/d2eace91/js/clipboard.min.js?v=20200812"></script>
    <script src="/assets/d2eace91/js/lodop/LodopAutoHttps.js?v=20200812"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20200812"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20200812"></script>

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
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("[data-toggle='popover']").popover();
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,// 开始视图
                minView: 2, // 最小视图
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd',
            });
            $("#searchForm").submit(function() {
                var params = $("#searchForm").serializeJson();
                tablelist.load(params);
                return false;
            });
            $("#btn_export").click(function() {
                var url = "/finance/bill/export-shop-detail.html";
                url += "?type=" + $("#type").val();
                url += "&shop_id=" + $("#shop_id").val();
                url += "&group_time=" + $("#group_time").val();
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, null, false);
            });
        });
        //批量统计
        //批量统计
        $("body").on("click", ".apply_count", function() {
            var minus = 0;
            $(".minus").each(function() {
                minus += isNaN($(this).data("amount")) ? 0 : $(this).data("amount");
            });
            $("#minus").html('-' + minus);
        })
        //查询列表
        function serachList() {
            var params = $("#searchForm").serializeJson();
            tablelist.load(params);
            return false;
        }
        //订单状态
        function orderStatus(status) {
            $("#order_status").val(status);
            $(".order_status").removeClass("active");
            $("#order_status_" + status).addClass("active");
            serachList();
        }
        //账单状态
        function billStatus(status) {
            $("#bill_status").val(status);
            $(".bill_status").removeClass("active");
            $("#bill_status_" + status).addClass("active");
            serachList();
        }
        // $('.toggle-btn').each(function() {
        //     $(this).find('td:not(.tcheck,.handle)').click(function() {
        //         $(this).parents().addClass("active").siblings('.toggle-btn').removeClass('active');
        //         $(".toggle-panel").not($(this).parents().next(".toggle-panel")).hide();
        //         $(this).parents().next(".toggle-panel").slideToggle(300);
        //     })
        // });
        // $("body").on("click", ".show_panel", function() {
        //     $(this).parents().addClass("active").siblings('.toggle-btn').removeClass('active');
        //     $(".toggle-panel").not($(this).parents().next(".toggle-panel")).hide();
        //     $(this).parents().next(".toggle-panel").slideToggle(300);
        // });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop