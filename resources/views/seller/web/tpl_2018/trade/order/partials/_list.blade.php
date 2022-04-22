<!-- 新订单列表 -->
<div id="table_list">



    <div class="common-title">
        <div class="ftitle">
            <h3>订单列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true></span>
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
    <!-- 不要格式化！！！ -->
    <div class="item-list-hd order-list">
        <ul class="item-list-tabs">


            <li id="all" class="tabs-t @if($params['order_status'] == '') current @endif">
                <a>
                    全部订单（
                    <span id="order-all">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>

            <li id="unpayed" class="tabs-t @if($params['order_status'] == 'unpayed') current @endif">
                <a>
                    等待买家付款（
                    <span id="order-unpayed">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>


            <li id="unshipped" class="tabs-t @if($params['order_status'] == 'unshipped') current @endif">
                <a>
                    待发货未指派订单（
                    <span id="order-unshipped">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>
            <li id="assign" class="tabs-t @if($params['order_status'] == 'assign') current @endif">
                <a>
                    待发货已指派订单（
                    <span id="order-assign">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>


            <li id="shipped_part" class="tabs-b @if($params['order_status'] == 'shipped_part') current @endif">
                <a>
                    发货中（
                    <span id="order-shipped-part">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>


            <li id="shipped" class="tabs-b @if($params['order_status'] == 'shipped') current @endif">
                <a>
                    已发货（
                    <span id="order-shipped">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>

            <li id="finished" class="tabs-b @if($params['order_status'] == 'finished') current @endif">
                <a>
                    已完成（
                    <span id="order-finished">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>

            <li id="closed" class="tabs-b @if($params['order_status'] == 'closed') current @endif">
                <a>
                    已关闭（
                    <span id="order-closed">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>


            <li id="backing" class="tabs-b @if($params['order_status'] == 'backing') current @endif">
                <a>
                    退款中（
                    <span id="order-backing">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>


            <li id="cancel" class="tabs-b last @if($params['order_status'] == 'cancel') current @endif">
                <a>
                    取消订单申请（
                    <span id="order-cancel">&nbsp;&nbsp;</span>
                    ）
                </a>
            </li>



        </ul>
    </div>

    <style type="text/css">
        .item-list-hd.order-list ul li {
            padding: 8px 3px 5px 5px;
        }
    </style>

    <script type="text/javascript">
        $().ready(function() {
            $("li[class^='tabs-']").click(function() {
                $("li[class^='tabs-']").removeClass('current');
                $(this).addClass('current');

                // 订单状态下拉框中必须存在此状态，才能被选中
                $("#order_status").val($(this).attr("id"));

                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                tablelist.load();
            });

            var url = '/trade/order/get-order-counts';
            //
            var data = $("#searchForm").serializeJson();
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'POST',
                data: data,
                success: function(data) {
                    $("#order-all").html(data.all);

                    $("#order-unpayed").html(data.unpayed);


                    $("#order-unshipped").html(data.unshipped);
                    $("#order-assign").html(data.assign);


                    $("#order-shipped-part").html(data.shipped_part);
                    $("#order-shipped").html(data.shipped);

                    $("#order-finished").html(data.finished);

                    $("#order-closed").html(data.closed);


                    $("#order-backing").html(data.backing);


                    $("#order-cancel").html(data.cancel);

                    $("#order-pending").html(data.pending);
                }
            });
        });
    </script>

    @foreach($list as $v)
    <div class="new-order-item">
        <!--订单基本信息及状态-->
        <div class="order-item-title">
            <input name="order_id_box" type="checkbox" class="table-list-checkbox checkBox cur-p m-r-5" value="{{ $v['order_id'] }}" />

            <h5 class="order-id">#{{ $v['sub_order_id'] }}</h5>

            （订单ID：{{ $v['order_id'] }}）

            <span>
					<em class="c-red">{{ $v['best_time'] }}</em>
					送达
				</span>

            <span>订单编号：{{ $v['order_sn'] }}</span>
            <span>下单时间：{{ $v['created_at'] }}</span>




            <!-- -->
            <label class="label label-primary">{{ $v['pay_name'] }}</label>

        </div>
        <!--订单提示信息-->


        <div class="order-item-reminder order-item-layout">
            <h5>温馨提示：</h5>
            <p>交易已关闭</p>
            <p>

                关闭类型： 系统取消订单

            </p>
            <p>关闭原因： 订单超时未支付，系统自动取消订单!</p>
        </div>


        <!--买家信息-->

        <div class="order-item-user order-item-layout over-visible pos-r">
            <h5 class="name">

                {{ $v['consignee'] }}

                <span class="name-label popover-box buyer">
						{{ $v['user_name'] }}
						<div class="popover-info" style="right: -280px; left: auto;">
							<i class="fa fa-caret-left"></i>
							<ul>
								<li>
									<h3>
										<i class="fa fa-user"></i>
										联系信息
									</h3>
								</li>
								<li>
									<div class="dt">
										<span>会员账号：</span>
									</div>
									<div class="dd">{{ $v['user_name'] }}</div>
								</li>
								<li>
									<div class="dt">
										<span>会员昵称：</span>
									</div>
									<div class="dd">{{ $v['nickname'] }}</div>
								</li>
								<li>
									<div class="dt">
										<span>绑定电话：</span>
									</div>
									<div class="dd">{{ $v['mobile'] }}</div>
								</li>
								<li>
									<div class="dt">
										<span>绑定邮箱：</span>
									</div>
									<div class="dd">{{ $v['user_email'] }}</div>
								</li>
								<li>
									<div class="dt">
										<span>交易订单：</span>
									</div>
									<div class="dd">
										{{ $v['order_number'] }}笔

										<a class="c-blue m-l-10" href="/trade/order/list.html?uid={{ $v['user_id'] }}" target="_blank">（会员所有订单）</a>

									</div>
								</li>
							</ul>
						</div>
					</span>
            </h5>


            <p class="tel">{{ $v['tel'] }}</p>
            <p class="address">
                {{ $v['region_name'] }} {{ $v['address'] }}
                <!-- 地图功能，暂时没有 -->
                <!-- <a class="address-map m-l-10">
                    <i class="fa fa-map-marker"></i>
                </a> -->

            </p>




        </div>

        <div class="clear"></div>
        <!--买家留言-->
        <!-- 其它信息 -->
        <!-- 预售发货时间 -->


        <!-- 配送状态 -->
        <div class="order-item-delivery">
            <div class="order-item-title">


                <h5>配送状态：</h5>
                <span class="c-green m-l-10">{{ $v['shipping_status_format'] }}</span>











            </div>

        </div>
        <!-- 商品信息 -->
        <div class="order-item-goods">
            <div class="order-item-title">
                <h5>
                    商品信息（共&nbsp;
                    <em>{{ $v['goods_number'] }}</em>
                    &nbsp;件商品）
                </h5>
                <a class="goods-toggle-btn btn btn-primary btn-xs c-fff pull-right">
                    收起
                    <i class="fa fa-angle-down m-r-0 m-l-5"></i>
                </a>
            </div>
            <table class="table m-b-0 order-item-layout goods-toggle-panel">

                @foreach($v['goods_list'] as $goods)
                <tr class="order-item">
                    <td class="item w300">
                        <div class="pic-info">
                            <a href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                                <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情" />
                            </a>
                        </div>
                        <div class="txt-info">
                            <div class="desc">
                                <a href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" class="goods-name" target="_blank" title="{{ $goods['goods_name'] }}">


                                    {{ $goods['goods_name'] }}
                                </a>
                                <!-- <a href="http://www.laravelvip.com/3" class="snap">【交易快照】</a> -->
                            </div>


                            <div class="icon m-b-5">

                                <a href="javascript:;" target="_blank" title="【品质承诺】卖家就该商品品质向买家作出承诺，承诺商品为正品。">
                                    <img src="http://images.68mall.com/contract/2016/06/07/14653028223253.png">
                                </a>

                            </div>

                            {{--商品活动标识--}}
                            @if($goods['goods_type'] == 3){{--团购商品--}}
                            <div class="goods-active group-buy">
                                <a>团购</a>
                            </div>
                            @elseif($goods['goods_type'] == 2){{--预售--}}
                            <div class="goods-active pre-sale">
                                <a>预售</a>
                            </div>
                            @elseif($goods['goods_type'] == 5){{--积分兑换--}}
                            <div class="goods-active exchange">
                                <a>积分兑换</a>
                            </div>
                            @elseif($goods['goods_type'] == 8){{--砍价--}}
                            <div class="goods-active bargain">
                                <a>砍价</a>
                            </div>
                            @else
                                {{--todo 其他活动标识--}}


                            @endif


                        </div>
                    </td>
                    <td class="w200">

                        <span></span>

                    </td>

                    <td class="w100">￥{{ $goods['goods_price'] }}</td>

                    <td class="c-red w100">× {{ $goods['goods_number'] }}</td>

                    {{--todo 价格不确定是否正确--}}
                    <td class="w100">￥48.9</td>

                </tr>
                @endforeach


            </table>
            <!-- 商品小计 -->

            <div class="order-item-layout text-r">
                <strong>小计</strong>
                <p class="m-t-5">
                    商品总金额：
                    <em class="m-r-5">￥40.09</em>

                    + 运费：
                    <em class="m-r-5">￥0.00 </em>


                    - 店铺红包：
                    <em class="m-r-5">￥0.00</em>
                    - 平台红包：
                    <em class="m-r-5">￥0.00</em>


                    - 卖家优惠：
                    <em class="m-r-5">￥9.00</em>

                    = 订单总金额：
                    <em class="m-r-5">￥31.09</em>
                </p>
            </div>

            <div class="order-item-layout text-r">

                <span class="c-red">[ 未支付 ]</span>
                <strong class="m-l-10">￥31.09</strong>
            </div>

            <div class="order-item-layout text-r">
                <strong>平台佣金：</strong>
                <strong class="c-red m-l-10">￥0.62</strong>
            </div>

            <div class="order-item-layout text-r">
                <strong>本单预计收入：</strong>
                <strong class="c-red m-l-10">￥30.47</strong>
            </div>

        </div>
        <!-- 订单备注信息 -->


        <!-- 退款信息 -->
        <!-- 订单操作 -->

        <div class="order-item-handle">
            <div class="pull-left">

                <a class="btn btn-warning" id="order_print_{{ $v['order_id'] }}" href="javascript:order_print('{{ $v['order_id'] }}')">打印订单</a>
                <a class="btn btn-default m-l-5" id="remark" data-id="{{ $v['order_id'] }}">备注</a>

            </div>


            <div class="pull-right">

                <a class="btn btn-primary m-l-5 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="order">修改订单价格</a>

                <a class="btn btn-default m-l-5 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="close">关闭订单</a>

                <a class="btn btn-primary m-l-5" href="info.html?id={{ $v['order_id'] }}">订单详情</a>

            </div>

        </div>

        <!-- 订单状态 -->
        <div class="seal-state-box">
            <div class="seal-state state6"></div>


        </div>
    </div>
    @endforeach

    <table id="order-item-page" class="table">
        <tfoot>
        <tr>
            <td class="text-c w10">
                <input type="checkbox" class="allCheckBox checkBox">
            </td>
            <td>
                <div class="pull-left">
                    <div class="btn-group dropup m-r-2">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            批量操作
                            <span class="caret m-l-5"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="javascript:;" onclick="batch_print()">批量打印</a>
                            </li>
                            <li class="divider"></li>


                            <li>
                                <a href="javascript:void(0);" onclick="batch_delivery(0)">批量发货</a>
                            </li>



                        </ul>
                    </div>


                    <a class="btn btn-primary m-l-5" href="javascript:getReceived(0);">收到货款</a>

                </div>
                <div id="pagination" class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>
<script type="text/javascript">
    $('body').find('.order-toggle-btn').click(function() {
        if ($(this).hasClass('toggle')) {
            $(this).html('收起<i class="fa fa-angle-down m-r-0 m-l-5"></i>').removeClass('toggle');
            $(this).parents().next(".order-toggle-panel").slideToggle(300);
        } else {
            $(this).html('展开<i class="fa fa-angle-up m-r-0 m-l-5"></i>').addClass('toggle');
            $(this).parents().next(".order-toggle-panel").slideToggle(300);
        }
    })
    $('body').find('.goods-toggle-btn').click(function() {
        if ($(this).hasClass('toggle')) {
            $(this).html('收起<i class="fa fa-angle-down m-r-0 m-l-5"></i>').removeClass('toggle');
            $(this).parents().next(".goods-toggle-panel").slideToggle(300);
        } else {
            $(this).html('展开<i class="fa fa-angle-up m-r-0 m-l-5"></i>').addClass('toggle');
            $(this).parents().next(".goods-toggle-panel").slideToggle(300);
        }
    });
</script>