<div class="order-center-content" id="table_list">
    @if(!empty($list))
        <div class="tablelist-append">
            @foreach($list as $v)
            <div class="order-list" id="order_list_{{ $v['order_id'] }}">
                <!--选中时给h2标签添加class：active-->
                <h2 class="trade-order-info">
                    <label>
                        <input name="order_delete" class="table-list-checkbox" type="checkbox" value="{{ $v['order_id'] }}">
                    </label>
                    <a href="/shop/{{ $v['shop_id'] }}.html">
                        <i class="shop-icon"></i>
                        <span>{{ $v['shop_name'] }}</span>
                    </a>
                    <strong class="color">{{ $v['order_status_format'] }}</strong>
                </h2>
                <ul class="order-list-goods">
                    @foreach($v['goods_list'] as $oKey=>$goods)
                    <li>
                        <a href="/user/order/info?id={{ $v['order_id'] }}">
                            <div class="goods-pic">
                                <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                            </div>
                            <dl class="goods-info">
                                <!--此处商品名称需要控制显示字数-->
                                <dt class="goods-name">
                                    <!-- -->
                                    {{--商品活动标识--}}
                                    @if($goods['goods_type'] > 0)
                                        <em class="goods-active {{ format_order_goods_type($goods['goods_type'],1) }}-label">{{ format_order_goods_type($goods['goods_type']) }}</em>
                                    @endif
                                    {{ $goods['goods_name'] }}
                                </dt>
                                <dd class="goods-attr">
                                    @if(!empty($goods['spec_info']))
                                        @foreach(explode(' ', $goods['spec_info']) as $spec)
                                            <span>{{ $spec }}</span>
                                        @endforeach
                                    @endif
                                </dd>
                                <dd class="goods-price price-color">
                                    <em>￥{{ $goods['goods_price'] }}</em>
                                    <span class="goods-num">x{{ $goods['goods_number'] }}</span>
                                </dd>
                            </dl>
                        </a>
                    </li>
                    <!-- 商品自带赠品 -->
                    @endforeach
                </ul>
                <div class="price">
                    <span>共{{ $v['goods_num'] }}件商品</span>
                    <span>待付款：</span>
                    <span class="price_sum price-color">
                        <strong>{{ $v['order_amount_format'] }}</strong>
                    </span>
                    <!-- <span>待付款：</span>
                    <span class="price_sum price-color">
                        <strong>￥100.00</strong>
                    </span> -->
                    <!-- <span class="freight">(免邮)</span> -->
                </div>
                <!-- 操作 -->
                <div class="order-bottom-con">

                    @if(get_order_operate_state('buyer_delete', $v))
                        <div class="order-bottom-btn">
                            <a onclick="order_delete('{{ $v['order_id'] }}',1)">删除订单</a>
                        </div>
                    @endif


                    @if(get_order_operate_state('buyer_cancel', $v))
                        <!-- 取消订单 -->
                        <div class="order-bottom-btn">
                            <a class="cancel-payment edit-order" data-id="{{ $v['order_id'] }}" data-type="cancel">取消订单</a>
                        </div>
                        <script type="text/javascript">
                            //
                        </script>
                    @endif

                    @if($v['order_cancel'] == 1)
                        <span>商家审核取消订单申请</span>
                    @endif

                    @if(get_order_operate_state('buyer_view_logistics', $v))
                        <div class="order-bottom-btn">
                            <a href="/user/order/express.html?id={{ $v['order_id'] }}" class="">查看物流</a>
                        </div>
                    @endif

                    <!-- -->
                    @if(get_order_operate_state('buyer_payment', $v))
                        <!-- 预售判断 -->
                        <div class="order-bottom-btn">
                            <a href="/checkout/pay.html?id={{ $v['order_id'] }}" class="on-payment cur">立即付款</a>
                        </div>
                    @endif

                    {{--todo--}}
                    {{--<div class="order-bottom-btn">
                        <a class="cancel-payment to-pay" data-id="{{ $v['order_id'] }}">朋友代付</a>
                    </div>--}}


                    {{--确认收货--}}
                    @if(get_order_operate_state('buyer_confirm_receipt', $v))
                        <div class="order-bottom-btn">
                            <a class="confirm-receipt edit-order cur" data-id="{{ $v['order_id'] }}" data-type="confirm">确认收货</a>
                        </div>
                    @endif

                    {{--延长收货时间--}}
                    @if(get_order_operate_state('buyer_delay', $v))
                        <div class="order-bottom-btn">
                            <a class="extend-time edit-order" data-id="{{ $v['order_id'] }}" data-type="delay">延长收货时间</a>
                        </div>
                        <span id="counter_{{ $v['order_id'] }}" style="display: none"></span>
                        <script type="text/javascript">
                            //
                        </script>
                    @endif

                    {{--评价晒单--}}
                    @if(get_order_operate_state('buyer_evaluate', $v))
                        <div class="order-bottom-btn">
                            <a href="/user/evaluate/info?order_id={{ $v['order_id'] }}" class="evaluate cur">评价晒单</a>
                        </div>
                    @endif

                    <!--邀请好友参团按钮-->

                    @if(in_array($v['order_status'], [1,2,3,4]))
                    <!-- 再次购买 -->
                        <div class="order-bottom-btn">
                            <a class="again-buy cur" data-order_id="{{ $v['order_id'] }}">再次购买</a>
                        </div>
                    @endif

                </div>
            </div>
            @endforeach
        </div>
        <!-- 分页 -->
        <!-- 分页 -->
        <div id="pagination" class="page">
            <div class="more-loader-spinner">
                <div class="is-loaded">
                    <div class="loaded-bg">我是有底线的</div>
                </div>
            </div>
            <script data-page-json="true" type="text" id="page_json">
                {!! $page_json !!}
            </script>
        </div>
    @else
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png" />
            </div>
            <dl>
                <dt>一个订单都没有哦</dt>
            </dl>
            <a href="/" class="no-data-btn">去购物</a>
        </div>
    @endif
</div>