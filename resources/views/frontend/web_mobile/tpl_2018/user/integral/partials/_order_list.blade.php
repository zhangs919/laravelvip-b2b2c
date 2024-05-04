<div class="order-center-content" id="table_list">
    @if(!empty($list))
        <div class="tablelist-append">
            @foreach($list as $item)
                <div class="order-list" id="order_list_{{ $v['order_id'] }}">
                    <h2>
                        <a href="/user/integral/express?id={{ $v['order_id'] }}">
                            <span>兑换单号：{{ $v['order_sn'] }}</span>
                        </a>
                        <strong class="color">等待商家发货</strong>
                    </h2>
                    <ul class="order-list-goods">
                        @foreach($v['goods_list'] as $oKey=>$goods)
                            <li>
                                <a href="/user/integral/order-info?id={{ $v['order_id'] }}">
                                    <div class="goods-pic">
                                        <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                                    </div>
                                    <dl class="goods-info">
                                        <!--此处商品名称需要控制显示字数-->
                                        <dt class="goods-name">
                                            <em class="goods-active exchange-label">积分兑换</em>
                                            {{ $goods['goods_name'] }}
                                        </dt>
                                        <dd class="goods-price price-color">
                                            <em>{{ $goods['goods_points'] }} 积分</em>
                                            <span class="goods-num">x{{ $goods['goods_number'] }}</span>
                                        </dd>
                                    </dl>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- 操作 -->
                    <div class="order-bottom-con border-none">
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
            <a href="/integralmall.html" class="no-data-btn">立即去兑换</a>
        </div>
    @endif
</div>
