<div class="order-center-content" id="table_list">

    @if(!empty($list))
        <div class="tablelist-append">

            @foreach($list as $item)
                <div class="order-list">
                    <h2>
                        <a href="/shop/{{ $item['shop_id'] }}.html" title="{{ $item['shop']['shop']['shop_name'] }}">
                            <i class="shop-icon"></i>
                            <span>{{ $item['shop']['shop']['shop_name'] }}</span>
                        </a>
                        <strong class="color">{{ $item['back_status_format'] }}</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id={{ $item['back_id'] }}">
                                <div class="goods-pic">
                                    <img src="{{ $item['sku_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"/>
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">{{ $item['sku_name'] }}</dt>
                                    <dd class="goods-attr">
                                        @if(!empty($item['spec_info']))
                                            @foreach(explode(' ', $item['spec_info']) as $spec)
                                                <span>{{ $spec }}</span>
                                            @endforeach
                                        @endif
                                    </dd>
                                    <dd class="back-order-money">
                                    <span class="back-money">
                                        @if($type){{--换货维修--}}
                                        订单金额：￥{{ $item['order_amount'] }}
                                        @else{{--退款退货--}}
                                        退款金额：￥{{ $item['refund_money'] }}
                                        @endif
                                    </span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id={{ $item['back_id'] }}">查看详情</a>
                        </div>
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
                <img src="/images/bg_empty_data.png">
            </div>
            <dl>
                <dt>暂无相关记录</dt>
            </dl>
        </div>
    @endif

</div>
