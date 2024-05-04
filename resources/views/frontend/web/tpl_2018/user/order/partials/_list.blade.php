<div id="table_list">
    <table class="table">
        <colgroup>
            <col style="width: 38%;">
            <col style="">
            <col style="">

            <col style="width: 12%;">

            <col style="width: 12%;">
            <col style="width: 11%;">
            <col style="width: 12%;">
        </colgroup>
        <thead>
        <tr>
            <th>宝贝</th>
            <th>单价（元）</th>
            <th>数量</th>

            <th>商品操作</th>

            <th>金额（元）</th>
            <th>交易状态</th>
            <th>交易操作</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($list))
            <tr>
                <th colspan="7">
                    <div class="fl">
                        <label class="input-label">
                            <input class="checkBox" type="checkbox" />
                            全选
                        </label>
                        <!-- <button class="btn-default" type="button">批量确认收货</button> -->
                        @if($is_delete)
                            <button class="btn-default" type="button" onclick="order_deletes(0)">批量还原订单</button>
                            <button class="btn-default" type="button" onclick="order_deletes(2)">批量彻底删除订单</button>
                        @else
                            <button class="btn-default" type="button" onclick="order_deletes(1)">批量删除订单</button>
                        @endif
                    </div>
                </th>
            </tr>
        @endif

        </tbody>
    </table>

    @if(empty($list))
        <div class="tip-box">
            <img src="/images/noresult.png" class="tip-icon">
            <div class="tip-text">没有符合条件的记录</div>
        </div>
    @else

        @foreach($list as $v)
            <div class="trade-order">
                <table class="trade-order-goods">

                    <colgroup>
                        <col style="width: 36%;">
                        <col style="width: 10%;">
                        <col style="width: 5%;">
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: 11%;">
                        <col style="width: 13%;">
                    </colgroup>

                    <tbody>
                    <tr class="trade-order-info">
                        <td colspan="2">
                            <label>
                                <input type="checkbox" name="order_delete" value="{{ $v['order_id'] }}" />
                                <span style="">{{ format_time($v['add_time'], 'Y-m-d H:i:s') }}</span>
                            </label>
                            <span>订单号：</span>
                            <span>{{ $v['order_sn'] }}</span>
                        </td>
                        <td colspan="@if(get_order_operate_state('buyer_delete', $v) || get_order_operate_state('buyer_drop', $v)){{ 3 }}@else{{ 5 }}@endif">
                            <span class="shop-logo">
                                <img src="/images/shop-type/shop-icon1.png" />
                            </span>
                            <a href="{{ route('pc_shop_home', ['shop_id'=>$v['shop_id']]) }}" title="{{ $v['shop_name'] }}" target="_blank" class="shop-name">{{ $v['shop_name'] }}</a>

                            {{--客服工具 默认0 0无客服 1QQ 2旺旺--}}
                            @if($v['customer_tool'] == 2)
                            <span class="ww-light">
                                <!-- 旺旺不在线 i 标签的 class="ww-offline" -->

                                <!-- s等于1时带文字，等于2时不带文字 -->
                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $v['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid={{ $v['customer_account'] }}&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                    <span></span>
                                </a>

                            </span>
                            @elseif($v['customer_tool'] == 1)
                                <!-- s等于1时带文字，等于2时不带文字 -->
                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $v['customer_account'] }}&site=qq&menu=yes" class="service-btn">
                                    <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $v['customer_account'] }}:52" alt="QQ" title="" style="height: 20px;" />
                                    <span></span>
                                </a>
                            @else{{--默认 平台客服--}}
                                <a href='{{ $v['yikf_url'] ?? 'javascript:;' }}' class="ww-light  color" target="_blank" title="点击联系在线客服">
                                    <i class="iconfont">&#xe6ad;</i>
                                </a>
                            @endif

                        </td>

                        @if(get_order_operate_state('buyer_drop', $v))
                            <td colspan="2" class="order-recycle-bin">
                                <a class="del" onclick="order_delete('{{ $v['order_id'] }}',2)">
                                    <i class="iconfont"></i>
                                    <span>彻底删除</span>
                                </a>
                            </td>
                        @endif
                        @if(get_order_operate_state('buyer_delete', $v))
                            <td colspan="2" class="order-recycle-bin">
                                <a onclick="order_delete('{{ $v['order_id'] }}',1)">
                                    <i class="iconfont">&#xe6bf;</i>
                                    <span>删除</span>
                                </a>
                            </td>
                        @endif

                    </tr>
                    <!-- 订单商品列表 -->

                    @foreach($v['goods_list'] as $oKey=>$goods)
                    <tr>
                        <td class="goods-info @if($oKey > 0){{ 'border-top' }}@endif">
                            <div style="overflow: hidden;">
                                <a class="goods-img" href="{{ route('pc_show_goods', ['goods_id' => $goods['goods_id']]) }}" target="_blank">
                                    <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </a>
                                <div class="item-con">
                                    <div class="item-name">
                                        <a href="{{ route('pc_show_goods', ['goods_id' => $goods['goods_id']]) }}" target="_blank">
                                            <span>{{ $goods['goods_name'] }}</span>
                                        </a>
                                        <a href="/user/order/info.html?id={{ $v['order_id'] }}">
                                            <!-- <span>[</span><span>交易快照</span><span>]</span> -->
                                        </a>
                                    </div>

                                    @if(!empty($goods['spec_info']))
                                    <div class="item-props">
                                        <span class="sku">
                                            @foreach(explode(' ', $goods['spec_info']) as $spec)
                                                <span>{{ $spec }}</span>
                                            @endforeach
                                        </span>
                                    </div>
                                    @endif

                                    @if(!empty($goods['saleservice']))
                                    <div class="item-icons">
                                        @foreach($goods['saleservice'] as $service)
                                        <a class="item-icon" href="javascript:void(0);" title="【{{ $service['contract_name'] }}】{{ $service['contract_desc'] }}">
                                            <img src="{{ get_image_url($service['contract_image']) }}" />
                                        </a>
                                        @endforeach

                                    </div>
                                    @endif

                                </div>
                            </div>
                        </td>
                        <td class="goods-price @if($oKey > 0){{ 'border-top' }}@endif">


                            <p class="second-color"> {{ $goods['goods_price'] }} </p>

                            <!-- -->


                            {{--商品活动标识--}}
                            @if($goods['goods_type'] > 0)
                                <div class="goods-active {{ format_order_goods_type($goods['goods_type'],1) }}">
                                    <a>{{ format_order_goods_type($goods['goods_type']) }}</a>
                                </div>
                            @endif






                        </td>
                        <td class="goods-num @if($oKey > 0){{ 'border-top' }}@endif">{{ $goods['goods_number'] }}</td>

                        <td class="goods-operate @if($oKey > 0){{ 'border-top' }}@endif">


                            {{--买家退款--}}
                            @if(get_order_operate_state('buyer_refund', $v))
                            <a href="/user/back/apply.html?id={{ $v['order_id'] }}&record_id={{ $goods['record_id'] }}&gid={{ $goods['goods_id'] }}&sid={{ $goods['sku_id'] }}">退款</a>
                            @endif


                            <div class="operate">


                                {{--投诉商家--}}
                                @if(get_order_operate_state('buyer_complaint', $v))
                                    <div class="operate">
                                        <a href="/user/complaint/add.html?order_id={{ $v['order_id'] }}&sku_id={{ $goods['sku_id'] }}" target="_blank">投诉商家</a>
                                    </div>
                                @endif




                            </div>

                        </td>

                        @if($oKey == 0)
                            <td class="goods-payment" rowspan="{{ $v['rowspan'] }}">

                                <p>
                                    总金额： {{ $v['order_amount_format'] }}

                                </p>


                                <p>
                                    待付款：
                                    <strong class="second-color">{{ $v['order_amount_format'] }}</strong>
                                </p>

                                <p>
                                    @if($v['shipping_fee'] > 0)
                                        <span>(含快递：￥{{ $v['shipping_fee'] }})</span>
                                    @else
                                        <span>(免邮)</span>
                                    @endif
                                </p>
                                <p>
                                    <span>{{ $v['pay_name'] }}</span>
                                </p>

                            </td>
                            <td class="trading-status" rowspan="{{ $v['rowspan'] }}">
                                <div class="operate">
                                    {{ $v['order_status_format'] }}
                                </div>

                                <div class="operate">
                                    <a href="/user/order/info.html?id={{ $v['order_id'] }}">订单详情</a>
                                </div>

                                @if(get_order_operate_state('buyer_view_logistics', $v))
                                    <div class="operate">
                                        <a href="/user/order/express.html?id={{ $v['order_id'] }}" class="color" target="_blank">查看物流</a>
                                    </div>
                                @endif

                            </td>

                            <!-- 拆分订单判断 -->




                            <td class="trading-operate @if($v['order_cancel'] == 3){{ 'dismantle' }}@endif" rowspan="{{ $v['rowspan'] }}">
                                {{--立即付款--}}
                                @if(get_order_operate_state('buyer_payment', $v))
                                    <div class="operate">
                                        <p class="confirm-receipt-time">
                                            还剩
                                            <span id="counter_{{ $v['order_id'] }}">00 天 00 小时 00 分 00 秒</span>
                                        </p>
                                        <a href="/checkout/pay.html?id={{ $v['order_id'] }}" target="_blank" class="on-payment">立即付款</a>
                                    </div>
                                @endif

                                {{--todo--}}
                                {{--<div class="operate">
                                    <a class="cancel-payment to-pay" data-id="{{ $v['order_id'] }}">找朋友帮忙付</a>
                                </div>--}}

                                {{--取消订单--}}
                                @if(get_order_operate_state('buyer_cancel', $v))
                                    <div class="operate">
                                        <a class="cancel-payment edit-order" data-id="{{ $v['order_id'] }}" data-type="cancel">取消订单</a>
                                    </div>
                                @endif

                                {{--确认收货--}}
                                @if(get_order_operate_state('buyer_confirm_receipt', $v))
                                    <div class="operate">

                                        <p class="confirm-receipt-time">
                                            还剩
                                            <span id="counter_{{ $v['order_id'] }}"></span>
                                        </p>

                                        <a class="confirm-receipt edit-order" data-id="{{ $v['order_id'] }}" data-type="confirm">确认收货</a>
                                    </div>
                                @endif

                                {{--延长收货时间--}}
                                @if(get_order_operate_state('buyer_delay', $v))
                                    <div class="operate">
                                        <a class="extend-time edit-order" data-id="{{ $v['order_id'] }}" data-type="delay">延长收货时间</a>
                                    </div>
                                @endif

                                {{--评价晒单--}}
                                @if(get_order_operate_state('buyer_evaluate', $v))
                                    <div class="operate">
                                        <a href="/user/evaluate/info.html?order_id={{ $v['order_id'] }}" class="evaluate">评价晒单</a>
                                    </div>
                                @endif

                                {{--还原订单--}}
                                @if(get_order_operate_state('buyer_restore', $v))
                                    <a onclick="order_delete('{{ $v['order_id'] }}',0)">还原订单</a>
                                @endif

                                @if($v['order_cancel'] == 1)
                                    商家审核取消订单申请
                                @endif


                            </td>
                            <script type="text/javascript">
                                //
                            </script>
                        @endif





                    </tr>
                    <!-- 商品自带赠品 -->
                    @endforeach


                    </tbody>
                </table>
            </div>
        @endforeach

        {{--分页--}}
        <div class="page">
            <div class="page-wrap fr">
                <div id="pagination" class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </div>
        </div>
    @endif

</div>
