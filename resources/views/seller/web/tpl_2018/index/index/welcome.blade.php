{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <!-- 卖家中心首页样式 -->
    <link rel="stylesheet" href="/seller/css/index.css?v=4.0"/>
    <!-- 图表 -->
    <script src="/seller/js/chart.js?v=20190110"></script>
    <script src="/seller/js/chart-data.js?v=20190110"></script>
    <div class="alert renew-box hide">
        <div class="renew-box-text">
            <!-- <a href="#" class="close" data-dismiss="alert"> &times; </a> -->


            <p>
                <strong>
                    欢迎使用
                    <span class="major-label m-l-5 m-r-5 site_name"></span>
                    商城系统，您的店铺即将到期，到期前您还未缴费，将影响您店铺的正常运营，建议尽快进行续费！
                </strong>
            </p>
            <p>
                续费流程：前往店铺->店铺信息->续签日志tab->
                <a class="major-label m-l-5 m-r-5" href="/shop/shop-info/renew-add">添加续签申请</a>
                线下联系平台方管理员进行缴纳费用！
            </p>


        </div>
        <a class="renew-box-btn" href="/shop/shop-info/renew-add">立即续费</a>
    </div>
@stop

{{--content--}}
@section('content')

    <div class="row">
        <div class="col-sm-9">
            <div class="shop-panel panel-region">
                <div class="shop-basic-logo">
                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/images/2018/11/24/15430357753119.png" />
                    <div class="edit-mask">
                        <a href="/shop/shop-set/edit">
                            <i class="fa fa-edit"></i>
                            编辑店铺设置
                        </a>
                    </div>
                </div>
                <div class="shop-basic-info">
                    <span class="name">哆啦A梦</span>

                    <img class="m-r-20" src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/backend/859/images/2018/11/24/15430532353112.png" height="16" />


                    <span class="code-box popover-por">
						<span class="code">
							<i class="fa fa-qrcode"></i>
							店铺预览
						</span>
						<div class="popover-box top-left">
							<div class="popover-tip"></div>
							<div class="arrow"></div>
							<div class="popover-inner">
								<p>扫一扫，手机预览</p>
								<img class="qr-images" src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=">
								<a class="btn-link" href="/shop/download-qrcode?shop_id=1">下载店铺二维码</a>
							</div>
						</div>
					</span>
                    <div class="shop-renzheng">

						<span class="g-renzheng on">
							<i class="iconss iconss-shoprenzheng"></i>
							7天无理由退换货
							<div class="shop-badge-tip">
								<div class="ui-popover">
									<div class="ui-popover-inner">
										<span class="g-approve-msg">卖家就该商品退货服务向买家作出承诺，自商品签收之日起至卖家承诺保障时间内，商品符合卖家约定状态的情况下，如买家对购买的商品不满意可无理由申请退货。</span>

									</div>
									<div class="arrow"></div>
								</div>
							</div>
						</span>

                        <span class="g-renzheng on">
							<i class="iconss iconss-shoprenzheng"></i>
							品质承诺
							<div class="shop-badge-tip">
								<div class="ui-popover">
									<div class="ui-popover-inner">
										<span class="g-approve-msg">卖家就该商品品质向买家作出承诺，承诺商品为正品。</span>

									</div>
									<div class="arrow"></div>
								</div>
							</div>
						</span>

                        <span class="g-renzheng on">
							<i class="iconss iconss-shoprenzheng"></i>
							破损补寄
							<div class="shop-badge-tip">
								<div class="ui-popover">
									<div class="ui-popover-inner">
										<span class="g-approve-msg">卖家就该商品签收状态作出承诺，自商品签收之日起至卖家承诺保障时间内，如发现商品在运输途中出现破损，买家可申请破损部分商品补寄。</span>

									</div>
									<div class="arrow"></div>
								</div>
							</div>
						</span>

                        <span class="g-renzheng on">
							<i class="iconss iconss-shoprenzheng"></i>
							退货承诺
							<div class="shop-badge-tip">
								<div class="ui-popover">
									<div class="ui-popover-inner">
										<span class="g-approve-msg">卖家就该商品退货服务向买家作出承诺，自商品签收之日起至卖家承诺保障时间内，商品符合卖家约定状态的情况下，如买家对购买的商品不满意可无理由申请退货。</span>

									</div>
									<div class="arrow"></div>
								</div>
							</div>
						</span>

                        <span class="g-renzheng ">
							<i class="iconss iconss-shoprenzheng"></i>
							海外直邮
							<div class="shop-badge-tip">
								<div class="ui-popover">
									<div class="ui-popover-inner">
										<span class="g-approve-msg">提供商品海外直邮服务，明显标识吸引海淘买家；向买家承诺相应违约金，增强买家购买信心，提升浏览转化和下单转化率。</span>

										<a class="g-approve-link" target="_blank" href="/shop/contract/list.html">立即加入</a>

									</div>
									<div class="arrow"></div>
								</div>
							</div>
						</span>

                    </div>
                </div>

            </div>
            <div class="colour-item-box panel-region">
                <div class="colour-item blue">
                    <a href="/goods/list/index.html?status=2">
                        <span class="name">出售中的商品</span>
                        <div class="number">
                            <em id="onsale_goods_count">&nbsp;</em>
                            个
                        </div>
                        <div class="ribbon">
                            点击查看
                            <i class="fa fa-chevron-circle-right"></i>
                        </div>
                    </a>
                </div>
                <div class="colour-item yellow">
                    <a href="/goods/list/index.html?status=1">
                        <span class="name">仓库中的商品</span>
                        <div class="number">
                            <em id="offsale_goods_count">&nbsp;</em>
                            个
                        </div>
                        <div class="ribbon">
                            点击查看
                            <i class="fa fa-chevron-circle-right"></i>
                        </div>
                    </a>
                </div>
                <div class="colour-item green">
                    <a href="/goods/list/index.html?status=3">
                        <span class="name">等待审核的商品</span>
                        <div class="number">
                            <em id="wait_audit_goods_count">&nbsp;</em>
                            个
                        </div>
                        <div class="ribbon">
                            点击查看
                            <i class="fa fa-chevron-circle-right"></i>
                        </div>
                    </a>
                </div>
                <div class="colour-item red">
                    <a href="/goods/list/index.html?status=5">
                        <span class="name">违规下架的商品</span>
                        <div class="number">
                            <em id="illegal_goods_count">&nbsp;</em>
                            个
                        </div>
                        <div class="ribbon">
                            点击查看
                            <i class="fa fa-chevron-circle-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="count-item-box panel-region">
                        <div class="count-item red">
							<span class="name">
								今日统计营业额
								<i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="在线支付的订单，买家付款后进行统计，如果买家取消订单或卖家发货后，买家申请退款退货，并且退款成功后，统计相应减少；货到付款的订单，买家点击确认收货或卖家点击收到货款后，才进行统计。"></i>
							</span>
                            <span id="today_gains" class="number">&nbsp;</span>
                            <div class="line-icon">
                                <i class="line1"></i>
                                <i class="line3"></i>
                                <i class="line2"></i>
                            </div>
                        </div>
                        <div class="count-item blue">
							<span class="name">
								今日有效订单量
								<i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="在线支付的订单，买家付款后进行统计，如果买家取消订单或卖家发货后，买家申请退款退货，并且退款成功后，统计相应减少；货到付款的订单，买家点击确认收货或卖家点击收到货款后，才进行统计。"></i>
							</span>
                            <span id="today_order_count" class="number">&nbsp;</span>
                            <div class="line-icon">
                                <i class="line1"></i>
                                <i class="line2"></i>
                                <i class="line3"></i>
                            </div>
                        </div>
                        <div class="count-item green">
                            <span class="name">今日添加会员</span>
                            <span id="today_users_count" class="number">&nbsp;</span>
                            <div class="line-icon">
                                <i class="line1"></i>
                                <i class="line3"></i>
                                <i class="line2"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="count-block-item-box panel-region module-box">
                        <div class="module-head">
                            <div>订单提醒</div>
                        </div>
                        <div class="module-body">
                            <div class="division">
                                <div class="count-block-item red">
                                    <a href="/trade/order/list?order_status=unpayed">
                                        <span class="name">待付款订单</span>
                                        <span id="unpayed_order_count" class="number active"></span>
                                    </a>
                                </div>
                                <div class="count-block-item red">
                                    <a href="/trade/order/list?order_status=unshipped">
                                        <span class="name">待发货订单</span>
                                        <span id="unshipping_order_count" class="number active"></span>
                                    </a>
                                </div>
                                <div class="count-block-item red">
                                    <a href="/trade/order/list?evaluate_status=unevaluate">
                                        <span class="name">待评价订单</span>
                                        <span id="unevaluate_order_count" class="number active"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="division">
                                <div class="count-block-item yellow">
                                    <a href="/trade/order/list?order_status=backing">
                                        <span class="name">退款中订单</span>
                                        <span id="backing_order_count" class="number active"></span>
                                    </a>
                                </div>
                                <div class="count-block-item green">
                                    <a href="/trade/back/list?is_after_sale=1">
                                        <span class="name">售后退款订单</span>
                                        <span id="after_sale_order_count" class="number active"></span>
                                    </a>
                                </div>
                                <div class="count-block-item blue">
                                    <a href="/trade/back/list.html?is_after_sale=1&type=1">
                                        <span class="name">换货维修订单</span>
                                        <span id="exchange_order_count" class="number active"></span>
                                    </a>
                                </div>

                            </div>

                        </div>
                        <div class="module-head">
                            <div>违规提醒</div>
                        </div>
                        <div class="module-body">
                            <div class="division">
                                <div class="count-block-item green">
                                    <a href="/trade/complaint/list?complaint_status=3">
                                        <span class="name">待处理的投诉</span>
                                        <span id="wait_complaint_count" class="number active"></span>
                                    </a>
                                </div>
                                <div class="count-block-item blue">
                                    <a href="/trade/complaint/list?complaint_status=4">
                                        <span class="name">平台介入的投诉</span>
                                        <span id="involve_complaint_count" class="number active"></span>
                                    </a>
                                </div>
                                <div class="count-block-item bg-fff"></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="module-box panel-region">
                <div class="module-head">
                    <div>
                        销售情况统计
                        <span>（ 近10天 &nbsp; &nbsp;单位：元 ）</span>
                    </div>
                </div>
                <div class="module-body">
                    <div id="sales_div" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="module-box panel-region message-item-box">
                <div class="module-head">
                    <div>
                        店铺信息
                        <i id="shopshow" class="fa fa-eye-slash cur-p m-l-10" title="点此显示店铺信息"></i>
                    </div>
                </div>
                <div class="module-body shop-body hide">
                    <p>
                        <span>用户名：</span>
                        <font>测试店铺</font>
                    </p>

                    <p>
                        <span>店铺有效期：</span>
                        <font>截止至 2020-08-22</font>
                    </p>


                    <p>
                        <span>上次登录IP：</span>
                        <font title="112.117.8.43（云南省昆明市）">112.117.8.43（云南省昆明市）</font>
                    </p>
                    <p>
                        <span>上次登录时间：</span>
                        <font>2019-01-12 11:22:57</font>
                    </p>

                </div>
            </div>
            <div class="module-box panel-region message-item-box">
                <div class="module-head">
                    <div>平台信息</div>
                </div>
                <div class="module-body">
                    <p>电话：400-078-5268</p>
                    <p>邮件：kefu@bhmg.com</p>
                    <p>QQ：800007396</p>
                    <p>旺旺：szy800007396</p>
                </div>
            </div>



            <div class="module-box panel-region">
                <div class="module-head">
                    <div>
                        商家公告
                        <a class="more" target="_blank" href="/shop/message/system-message-list">更多</a>
                    </div>
                </div>
                <div class="module-body news-panel">
                    <ul>
                        <!---->
                        <li class="text-c m-t-20 m-b-20">
                            <font>暂无信息内容...</font>
                        </li>
                        <!---->
                    </ul>
                </div>
            </div>
            <div class="module-box panel-region">
                <div class="module-head">
                    <div>
                        站内信
                        <a class="more" target="_blank" href="/shop/message/index">更多</a>
                    </div>
                </div>
                <div class="module-body news-panel">
                    <ul>
                        <!---->



                        <li>
                            <span class="m-r-10">1月12日</span>
                            <a href="javascript:void(0);" data-msg-id="2585" class="link" title="亲爱的店主，您店铺订单号为：20190111041623494830的订单，买家已取消订单，您无需处理该订单。">亲爱的店主，您店铺订单号为：20190111...</a>
                        </li>




                        <li>
                            <span class="m-r-10">1月12日</span>
                            <a href="javascript:void(0);" data-msg-id="2583" class="link" title="亲爱的店主，您店铺订单号为：20190111041551376120的订单，买家已取消订单，您无需处理该订单。">亲爱的店主，您店铺订单号为：20190111...</a>
                        </li>




                        <li>
                            <span class="m-r-10">1月11日</span>
                            <a href="javascript:void(0);" data-msg-id="2571" class="link" title="亲爱的店主，您店铺商品ID为250的商品由于违规，已被平台方强制下架，请尽快修改。">亲爱的店主，您店铺商品ID为250的商品由于...</a>
                        </li>




                        <li>
                            <span class="m-r-10">1月11日</span>
                            <a href="javascript:void(0);" data-msg-id="2562" class="link" title="亲爱的店主，您店铺订单号为：20190111044146573490的订单，买家已成功付款，请及时发货。">亲爱的店主，您店铺订单号为：20190111...</a>
                        </li>




                        <li>
                            <span class="m-r-10">1月11日</span>
                            <a href="javascript:void(0);" data-msg-id="2556" class="link" title="亲爱的店主，您店铺订单号为：20190111041647156790的订单，买家已成功付款，请及时发货。">亲爱的店主，您店铺订单号为：20190111...</a>
                        </li>

















                        <!---->
                    </ul>
                </div>
            </div>
            <div class="module-box panel-region">
                <div class="module-head">
                    <div>
                        客户等级分析
                        <span>
							<a class="c-blue  pull-right" href="/member/rank/list.html">设置VIP等级</a>
						</span>
                    </div>
                </div>
                <div class="module-body">
                    <div id="customer_div" style="width: 100%; height: 300px; margin-top: 10px;"></div>
                </div>
            </div>


        </div>
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
    <div class="clear"></div>
    <script type="text/javascript">
        $('#shopshow').click(function() {
            if ($(this).hasClass('fa-eye')) {
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                $(this).parents().find('.shop-body').addClass('hide');
                $(this).attr("title","点此显示店铺信息");
            } else {
                $(this).addClass('fa-eye').removeClass('fa-eye-slash');
                $(this).parents().find('.shop-body').removeClass('hide');
                $(this).attr("title","点此隐藏店铺信息");
            }
        });
    </script>
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
                initValue: 475
            });
            $('#container2').radialIndicator({
                initValue: 492
            });
            $('#container3').radialIndicator({
                initValue: 492
            });
            $('#container4').radialIndicator({
                initValue: 486.33333333333
            });
        });
    </script>
    <!-- ECharts单文件引入 -->
    <script src="/assets/d2eace91/js/echarts/echarts-all.js?v=20190110"></script>
    <script type="text/javascript">
        $().ready(function() {
            // 基于准备好的dom，初始化echarts图表
            var myChart = echarts.init(document.getElementById('sales_div'));
            var option = {
                tooltip: {
                    show: true
                },
                legend: {
                    data: ['订单金额']
                },
                xAxis : [
                    {
                        type : 'category',
                        data : ["01\u670803\u65e5","01\u670804\u65e5","01\u670805\u65e5","01\u670806\u65e5","01\u670807\u65e5","01\u670808\u65e5","01\u670809\u65e5","01\u670810\u65e5","01\u670811\u65e5","01\u670812\u65e5"],
                        axisLine: {  // 控制x轴线的样式
                            lineStyle: {
                                type: 'solid',
                                color: '#666',
                                width:'1' }
                        }
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        axisLine: {  // 控制y轴线的样式
                            lineStyle: {
                                type: 'solid',
                                color: '#666',
                                width:'1' }
                        },
                        axisLabel: {

                            formatter: '{value} 元'

                        }
                    }
                ],
                series : [
                    {
                        "name":"订单金额",
                        "type":"bar",
                        "data":[0,0,0,0,0,0,0,0,300,0],
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
                tooltip: {
                    trigger: 'item',
                },
                color:['#FF7D43','#FCB747','#97DA67','#46CECE','#B48FC2','#FF726A','#49CDFF'],
                legend: {
                    orient: 'horizontal',
                    top:'0%',
                    right:'0%',
                    x: 'left',
                    bottom: 20,
                    formatter: function (name) {
                        return (name.length > 7 ? (name.slice(0,7)+"...") : name );
                    },
                    data:["\u666e\u901a\u4f1a\u5458\uff08VIP1\uff09","\u7279\u6b8a\u4f1a\u5458","\u94bb\u77f3\u4f1a\u5458"]
                },
                calculable: true,
                series : [
                    {
                        name: '客户等级',
                        type: 'pie',
                        radius: ['40%', '50%'],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: false
                                },
                                labelLine: {
                                    show: false
                                }
                            },

                            emphasis: {
                                label: {
                                    show: true,
                                    position: 'center',
                                    textStyle: {
                                        fontSize: '13',
                                        fontWeight: '300'
                                    }
                                }
                            }
                        },
                        data:[{"name":"\u666e\u901a\u4f1a\u5458\uff08VIP1\uff09","value":"3"},{"name":"\u7279\u6b8a\u4f1a\u5458","value":"0"},{"name":"\u94bb\u77f3\u4f1a\u5458","value":"3"}]
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
                url: '/index/index/get-data',
                dataType: 'json',
                success: function(data) {
                    // 出售中的商品
                    $("#onsale_goods_count").html(data.onsale_goods_count);
//				if(data.onsale_goods_count == 0) {
//					$("#onsale_goods_count").parent().removeClass("number");
//				}
                    // 仓库中的商品
                    $("#offsale_goods_count").html(data.offsale_goods_count);
//				if(data.offsale_goods_count == 0) {
//					$("#offsale_goods_count").parent().removeClass("number");
//				}
                    // 等待审核的商品
                    $("#wait_audit_goods_count").html(data.wait_audit_goods_count);
//				if(data.wait_audit_goods_count == 0) {
//					$("#wait_audit_goods_count").parent().removeClass("number");
//				}
                    // 违规下架的商品
                    $("#illegal_goods_count").html(data.illegal_goods_count);
//				if(data.illegal_goods_count == 0) {
//					$("#illegal_goods_count").parent().removeClass("number");
//				}
                    // 待付款订单
                    $("#unpayed_order_count").html(data.unpayed_order_count);
                    if(data.unpayed_order_count == 0) {
                        $("#unpayed_order_count").removeClass("active");
                    }
                    // 待发货订单
                    $("#unshipping_order_count").html(data.unshipping_order_count);
                    if(data.unshipping_order_count == 0) {
                        $("#unshipping_order_count").removeClass("active");
                    }
                    // 待评价订单
                    $("#unevaluate_order_count").html(data.unevaluate_order_count);
                    if(data.unevaluate_order_count == 0) {
                        $("#unevaluate_order_count").removeClass("active");
                    }
                    // 退款中订单
                    $("#backing_order_count").html(data.backing_order_count);
                    if(data.backing_order_count == 0) {
                        $("#backing_order_count").removeClass("active");
                    }
                    // 售后中订单
                    // $("#sercive_order_count").html(data.sercive_order_count);
                    //  售后退款订单
                    $("#after_sale_order_count").html(data.after_sale_order_count);
                    if(data.after_sale_order_count == 0) {
                        $("#after_sale_order_count").removeClass("active");
                    }
                    // 换货维修订单
                    $("#exchange_order_count").html(data.exchange_order_count);
                    if(data.exchange_order_count == 0) {
                        $("#exchange_order_count").removeClass("active");
                    }
                    // 待处理的投诉
                    $("#wait_complaint_count").html(data.wait_complaint_count);
                    if(data.wait_complaint_count == 0) {
                        $("#wait_complaint_count").removeClass("active");
                    }
                    // 平台介入的投诉
                    $("#involve_complaint_count").html(data.involve_complaint_count);
                    if(data.involve_complaint_count == 0) {
                        $("#involve_complaint_count").removeClass("active");
                    }
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
                    if(data.data == 0) {
                        $.open({
                            title: "店铺指引",
                            ajax: {
                                url: '/index/index/seller-guide.html',
                            },
                            width: "1080px",
                            height: "540px",
                        });
                    }
                }
            });
            //店铺到期提醒
            $.ajax({
                url: '/index/index/expiration-reminding',
                dataType: 'json',
                success: function(result) {
                    if(result.code == 0) {
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