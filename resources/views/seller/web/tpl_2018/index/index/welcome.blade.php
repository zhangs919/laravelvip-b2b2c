{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <!-- 卖家中心首页样式 -->
    <link rel="stylesheet" href="/seller/css/index.css?v=1.2"/>
    <!-- 图表 -->
    <script src="/seller/js/chart.js?v=1.2"></script>
    <script src="/seller/js/chart-data.js?v=1.2"></script>
@stop

{{--content--}}
@section('content')

    <div class="alert renew-box hide">
        <!-- <a href="#" class="close" data-dismiss="alert"> &times; </a> -->

        <p>
            欢迎使用
            <span class="major-label m-l-5 m-r-5 site_name"></span>
            商城系统，您的店铺还未缴费，将影响您店铺的正常运营，建议尽快进行续费！
        </p>
        <p>
            续费流程：前往店主用户中心->服务中心->
            <a class="major-label m-l-5 m-r-5" href="http://www.b2b2c.yunmall.laravelvip.com/shop/apply/result.html" target="_blank">我要开店</a>
            进行线上缴费，或联系平台方管理员进行缴纳费用！
        </p>

    </div>
    <div class="seller">
        <div class="store-logo">
            <p>
                <img src="{{ get_image_url($shop_info->shop_logo, 'shop_logo') }}" />
            </p>
            <a href="/shop/shop-set/edit">
                <i class="fa fa-edit"></i>
                编辑店铺设置
            </a>
        </div>
        <div class="store-qrcode">
            <p>
                <img src="http://images.laravelvip.com/15164/gqrcode/shop/C4/qrcode_1.png" width="100" height="100" />
            </p>
            <a class="btn-link" href="/shop/download-qrcode?shop_id=1"> 下载店铺二维码 </a>
        </div>
        <!-- end -->
        <div class="store-info">
            <h2>{{ $shop_info->shop_name ?? '' }}</h2>
            <ul>
                <li>
                    <span>累计信用评价：</span>

                    <img src="http://images.laravelvip.com/system/credit/2016/06/07/14653016855399.gif" height="16" />


                </li>
                <li>
                    <span>用户名：</span>
                    <font>{{ $seller->user_name }}</font>
                </li>

                <li>
                    <span>店铺有效期：</span>
                    <font>截止至 {{ $shop_info->end_time }}</font>
                </li>


                <li>
                    <span>上次登录IP：</span>
                    <font title="{{ $seller->last_ip }}">{{ $seller->last_ip }}</font>
                </li>
                <li>
                    <span>上次登录时间：</span>
                    <font>{{ $seller->last_login }}</font>
                </li>

            </ul>
        </div>
        <div class="store-grade">
            <h3>店铺动态评分</h3>
            <ul>
                <li>
                    <div id="container1"></div>
                    <span>描述相符</span>
                </li>
                <li>
                    <div id="container2"></div>
                    <span>服务态度</span>
                </li>
                <li>
                    <div id="container3"></div>
                    <span>发货速度</span>
                </li>
                <li>
                    <div id="container4"></div>
                    <span>综合评分</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="manage">

        <div class="module goods-manage">
            <h5>商品管理</h5>
            <div class="module-content">
                <ul>
                    <li>
                        <a href="/goods/list/index.html?goods_status=1&goods_audit=1" class="num">
                            出售中的商品
                            <i id="onsale_goods_count">&nbsp;</i>
                        </a>
                    </li>
                    <li>
                        <a href="/goods/list/index.html?goods_status=0" class="num">
                            仓库中的商品
                            <i id="offsale_goods_count"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/goods/list/index.html?goods_audit=0" class="num">
                            等待审核的商品
                            <i id="wait_audit_goods_count"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/goods/list/index.html?goods_status=2" class="num">
                            违规下架的商品
                            <i id="illegal_goods_count"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="module order-remind">
            <h5>订单提醒</h5>
            <div class="module-content">
                <ul>
                    <li>
                        <a href="/trade/order/list?order_status=unpayed" class="num">
                            待付款订单
                            <i id="unpayed_order_count"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/trade/order/list?order_status=unshipped" class="num">
                            待发货订单
                            <i id="unshipping_order_count"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/trade/order/list?evaluate_status=unevaluate" class="num">
                            待评价订单
                            <i id="unevaluate_order_count"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/trade/order/list?order_status=backing" class="num">
                            退款中订单
                            <i id="backing_order_count"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/trade/back/list?is_after_sale=1" class="num">
                            售后退款订单
                            <i id="after_sale_order_count"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/trade/back/list.html?is_after_sale=1&type=1" class="num">
                            换货维修订单
                            <i id="exchange_order_count"></i>
                        </a>
                    </li>
                    <!--
                    <li>
                        <a href="/trade/order/list?order_status=" class="num">
                            售后中订单
                            <i></i>
                        </a>
                    </li>
                     -->
                </ul>
            </div>
        </div>
        <div class="module illegal-remind">
            <h5>违规提醒</h5>
            <div class="module-content">
                <ul>
                    <li>
                        <a href="/trade/complaint/list?complaint_status=3" class="num">
                            待处理的投诉
                            <i id="wait_complaint_count"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/trade/complaint/list?complaint_status=4" class="num">
                            平台介入的投诉
                            <i id="involve_complaint_count"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="module order-remind">
            <h5>
                客户等级分析
                <a class="c-666 pull-right" href="/member/rank/list">设置VIP等级</a>
            </h5>
            <div class="module-content m-t-10">
                <div id="customer_div" style="width: 100%; height: 300px;"></div>
            </div>
        </div>
    </div>

    <div class="system">
        <div class="chart-info">
            <h5>今日统计</h5>
            <div class="module-content p-0">
                <ul>
                    <li style="width: 34%">
                        <div class="value">
							<span>
								今日营业总额
								<i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="在线支付的订单，买家付款后进行统计，如果买家取消订单或卖家发货后，买家申请退款退货，并且退款成功后，统计相应减少；货到付款的订单，买家点击确认收货或卖家点击收到货款后，才进行统计。"></i>
							</span>
                            <h4 id="today_gains">&nbsp;</h4>
                        </div>

                    </li>
                    <li style="width: 35%">
                        <div class="value">
							<span>
								今日有效订单量
								<i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="在线支付的订单，买家付款后进行统计，如果买家取消订单或卖家发货后，买家申请退款退货，并且退款成功后，统计相应减少；货到付款的订单，买家点击确认收货或卖家点击收到货款后，才进行统计。"></i>
							</span>
                            <h4 id="today_order_count">&nbsp;</h4>
                        </div>

                    </li>
                    <li style="width: 28%">
                        <div class="value">
                            <span>今日添加会员</span>
                            <h4 id="today_users_count">&nbsp;</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="contact-info">
            <h5>平台联系方式</h5>
            <div class="module-content">
                <ul>
                    <li>
                        <span>电话：{{ sysconf('mall_phone') }}</span>
                    </li>
                    <li>
                        <span style="width: 220px">邮件：{{ sysconf('mall_email') }}</span>
                    </li>
                    <li>
                        <span>QQ：{{ sysconf('mall_qq') }}</span>
                    </li>
                    <li>
                        <span>旺旺：{{ sysconf('mall_wangwang') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="system-info">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active">
                        <a href="#texpress1" data-toggle="tab">商家公告</a>
                    </li>
                    <li>
                        <a href="#texpress2" data-toggle="tab">站内信</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="texpress1" class="tab-pane fade in active">
                    <ul>
                        <!---->
                        <li class="text-c p-20">
                            <font>暂无信息内容...</font>
                        </li>
                        <!---->
                    </ul>
                </div>
                <div id="texpress2" class="tab-pane fade">
                    <ul>
                        <!---->



                        <li>
                            <h2>
                                <a href="javascript:void(0);" class="link" data-msg-id="864">亲爱的店主，您店铺订单号为：20180713...</a>
                            </h2>
                            <span class="data">7月14日</span>
                        </li>




                        <li>
                            <h2>
                                <a href="javascript:void(0);" class="link" data-msg-id="862">亲爱的店主，您店铺订单号为：20180711...</a>
                            </h2>
                            <span class="data">7月12日</span>
                        </li>




                        <li>
                            <h2>
                                <a href="javascript:void(0);" class="link" data-msg-id="854">亲爱的店主，您店铺订单号为：20180706...</a>
                            </h2>
                            <span class="data">7月07日</span>
                        </li>





                        <li class="text-c m-t-10">
                            <a class="btn-link" href="/shop/message/index">查看更多</a>
                        </li>

































                        <!---->
                    </ul>
                </div>
            </div>
        </div>
        <div class="order-ranking">
            <h5>
                销售情况统计
                <span>( 近10天 )</span>
            </h5>
            <div class="module-content m-t-10">
                <div id="sales_div" style="width: 100%; height: 300px;"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>

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
    <div class="clear"></div>
    <script type="text/javascript">
        $().ready(function() {
            radialIndicator.defaults.barColor = {
                100: '#F47171',
                200: '#FF9162',
                300: '#FFFF75',
                400: '#21BCFE',
                500: '#4ED89D'
            };
            radialIndicator.defaults.minValue = 0;
            radialIndicator.defaults.maxValue = 500;
            radialIndicator.defaults.format = '#.##分';

            $('#container1').radialIndicator({
                initValue: 452
            });
            $('#container2').radialIndicator({
                initValue: 333
            });
            $('#container3').radialIndicator({
                initValue: 300
            });
            $('#container4').radialIndicator({
                initValue: 361.66666666667
            });
        });
    </script>
    <!-- ECharts单文件引入 -->
    <script src="/assets/d2eace91/js/echarts/echarts-all.js?v=20180710"></script>
    <script type="text/javascript">
        $().ready(function() {
            // 基于准备好的dom，初始化echarts图表
            var myChart = echarts.init(document.getElementById('sales_div'));

            var option = {
                tooltip: {
                    show: true
                },
                legend: {
                    data:['订单金额']
                },
                xAxis : [
                    {
                        type : 'category',
                        data : ["07\u670805\u65e5","07\u670806\u65e5","07\u670807\u65e5","07\u670808\u65e5","07\u670809\u65e5","07\u670810\u65e5","07\u670811\u65e5","07\u670812\u65e5","07\u670813\u65e5","07\u670814\u65e5"]
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        "name":"订单金额",
                        "type":"bar",
                        "data":[0,0,0,0,0,0,0,0,0,0]
                    }
                ]
            };

            // 为echarts对象加载数据
            myChart.setOption(option);
        });
    </script>

    <script type="text/javascript">
        $().ready(function() {
            // 基于准备好的dom，初始化echarts图表
            var myChart = echarts.init(document.getElementById('customer_div'));

            option = {
                tooltip : {
                    trigger: 'item'
                },
                legend: {
                    orient : 'vertical',
                    x : 'left',
                    data:["\u666e\u901a\u4f1a\u5458\uff08VIP1\uff09","\u7279\u6b8a\u4f1a\u5458","\u4e8c\u6279","VIP\u4f1a\u5458(VIP3)","\u94bb\u77f3\u4f1a\u5458"]
                },
                calculable : true,
                series : [
                    {
                        name:'客户等级',
                        type:'pie',
                        radius : ['50%', '70%'],
                        itemStyle : {
                            normal : {
                                label : {
                                    show : false
                                },
                                labelLine : {
                                    show : false
                                }
                            },
                            emphasis : {
                                label : {
                                    show : true,
                                    position : 'center',
                                    textStyle : {
                                        fontSize : '15',
                                        fontWeight : 'bold'
                                    }
                                }
                            }
                        },
                        data:[{"name":"\u666e\u901a\u4f1a\u5458\uff08VIP1\uff09","value":"1"},{"name":"\u7279\u6b8a\u4f1a\u5458","value":"0"},{"name":"\u4e8c\u6279","value":"0"},{"name":"VIP\u4f1a\u5458(VIP3)","value":"0"},{"name":"\u94bb\u77f3\u4f1a\u5458","value":"3"}]
                    }
                ]
            };

            // 为echarts对象加载数据
            myChart.setOption(option);
        });
    </script>

    <script type="text/javascript">
        $().ready(function() {
            $.ajax({
                url:'/index/index/get-data',
                dataType:'json',
                success:function(data) {
                    // 出售中的商品
                    $("#onsale_goods_count").html(data.onsale_goods_count);
                    // 仓库中的商品
                    $("#offsale_goods_count").html(data.offsale_goods_count);
                    // 等待审核的商品
                    $("#wait_audit_goods_count").html(data.wait_audit_goods_count);
                    // 违规下架的商品
                    $("#illegal_goods_count").html(data.illegal_goods_count);
                    // 待付款订单
                    $("#unpayed_order_count").html(data.unpayed_order_count);
                    // 待发货订单
                    $("#unshipping_order_count").html(data.unshipping_order_count);
                    // 待评价订单
                    $("#unevaluate_order_count").html(data.unevaluate_order_count);
                    // 退款中订单
                    $("#backing_order_count").html(data.backing_order_count);
                    // 售后中订单
                    // $("#sercive_order_count").html(data.sercive_order_count);
                    //  售后退款订单
                    $("#after_sale_order_count").html(data.after_sale_order_count);
                    // 换货维修订单
                    $("#exchange_order_count").html(data.exchange_order_count);
                    // 待处理的投诉
                    $("#wait_complaint_count").html(data.wait_complaint_count);
                    // 平台介入的投诉
                    $("#involve_complaint_count").html(data.involve_complaint_count);
                    // 今日收益
                    $("#today_gains").html("<em>￥</em>" + data.today_gains);
                    // 今日订单
                    $("#today_order_count").html(data.today_order_count);
                    // 今日添加会员
                    $("#today_users_count").html(data.today_users_count);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $("[data-toggle='popover']").popover();
            // 查看详情
            $("body").on("click", ".link", function() {
                var msg_id = $(this).data("msg-id");

                $.open({
                    title: "站内信",
                    ajax: {
                        url: "/shop/message/view",
                        data: {
                            msg_id: msg_id
                        }
                    },
                    width: "600px",
                    btn: ['关闭']
                });
            });
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            //店铺指引页面 弹窗
            $.ajax({
                url: '/index/index/show-message',
                dataType: 'json',
                success: function(data) {
                    if (data.data == 0) {
                        $.open({
                            title: "店铺指引",
                            ajax: {
                                url: '/index/index/seller-guide.html',
                            },
                            width: "1080px",
                            height:"540px",
                        });
                    }
                }
            });
            //店铺到期提醒
            $.ajax({
                url:'/index/index/expiration-reminding',
                dataType: 'json',
                success:function(result){
                    if (result.code == 0) {
                        $(".renew-box").removeClass('hide');
                        $(".site_name").html(result.data['shop_name']);
                        $(".shop_end_time").html(result.data['end_time']);
                    }
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop