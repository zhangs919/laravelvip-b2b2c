@if($type){{--换货维修--}}
<div id="table_list">
    @if(!empty($list))

        <table class="table">
            <thead>
            <tr>
                <th style="width: 30%;">商品信息/订单编号/退款编号</th>
                <th style="width: 16%; cursor: default;" class="">卖家</th>
                <th style="width: 8%;">交易金额(整单)</th>
                <th style="width: 8%;">售后类型</th>
                <th style="width: 10%;">申请时间</th>
                <th style="width: 13%;">售后状态</th>
                <th style="width: 5%;">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $item)
                <tr>
                    <td class="after-sales-goods">
                        <div style="overflow: hidden;">

                            <a class="goods-img" href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}"
                               target="_blank">
                                <img src="{{ $item['sku_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"/>
                            </a>
                            <div class="item-con">
                                <div class="item-name">
                                    <a href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}"
                                       target="_blank" title="{{ $item['sku_name'] }}">{{ $item['sku_name'] }}</a>
                                </div>
                                <p>订单编号：{{ $item['order_sn'] }}</p>
                                <p>退款编号：{{ $item['back_sn'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="shop-info">
                            店铺：
                            <a href="/shop/{{ $item['shop_id'] }}.html" target="_blank"
                               title="{{ $item['shop']['shop']['shop_name'] }}"
                               class="btn-link">{{ $item['shop']['shop']['shop_name'] }}</a>
                        </p>
                        <p class="shop-info">
                            卖家：

                            <a href="/shop/{{ $item['shop_id'] }}.html" target="_blank"
                               title="{{ $item['shop']['user']['user_name'] }}"
                               class="btn-link">{{ $item['shop']['user']['user_name'] }}</a>
                        </p>
                    </td>
                    <td align="center">￥{{ $item['order_amount'] }}</td>
                    <td align="center">{{ format_back_type($item['back_type']) }}</td>
                    <td align="center">{{ format_time($item['add_time']) }}</td>
                    <td align="center">
                        <p>{{ $item['back_status_format'] }}</p>
                    </td>
                    <td align="center">
                        <div class="operate">
                            <a href="/user/back/info?id={{ $item['back_id'] }}" class="btn-link">查看</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!--分页-->
        <div class="page">
            <div class="page-wrap fr">
                <div id="pagination" class="pull-right page-box">
                    {!! $pageHtml !!}
                </div>
            </div>
        </div>

    @else
        <table class="table">
            <thead>
            <tr>
                <th style="width: 30%;">商品信息/订单编号/退款编号</th>
                <th style="width: 16%; cursor: default;" class="">卖家</th>
                <th style="width: 8%;">交易金额(整单)</th>
                <th style="width: 8%;">售后类型</th>
                <th style="width: 10%;">申请时间</th>
                <th style="width: 13%;">售后状态</th>
                <th style="width: 5%;">操作</th>
            </tr>
            </thead>
        </table>
        <div class="tip-box">
            <img src="/images/noresult.png" class="tip-icon"/>
            <div class="tip-text">没有符合条件的记录</div>
        </div>
    @endif
</div>

@else
    <div id="table_list">
        @if(!empty($list))

            <table class="table">
                <thead>
                <tr>
                    <th style="width: 30%;">商品信息/订单编号/退款编号</th>
                    <th style="width: 16%;">卖家</th>
                    <th style="width: 8%;">交易金额(整单)</th>
                    <th style="width: 8%;">退款金额</th>
                    <th style="width: 10%;">申请时间</th>
                    <th style="width: 10%;">超时时间</th>
                    <th style="width: 13%;">退款退货状态</th>
                    <th style="width: 5%;">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $item)
                    <tr>
                        <td class="after-sales-goods">
                            <div style="overflow: hidden;">

                                <a class="goods-img" href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}"
                                   target="_blank">
                                    <img src="{{ $item['sku_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"/>
                                </a>
                                <div class="item-con">
                                    <div class="item-name">
                                        <a href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}"
                                           target="_blank" title="{{ $item['sku_name'] }}">{{ $item['sku_name'] }}</a>
                                    </div>
                                    <p>订单编号：{{ $item['order_sn'] }}</p>
                                    <p>退款编号：{{ $item['back_sn'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="shop-info">
                                店铺：
                                <a href="/shop/{{ $item['shop_id'] }}.html" target="_blank"
                                   title="{{ $item['shop']['shop']['shop_name'] }}"
                                   class="btn-link">{{ $item['shop']['shop']['shop_name'] }}</a>
                            </p>
                            <p class="shop-info">
                                卖家：

                                <a href="/shop/{{ $item['shop_id'] }}.html" target="_blank"
                                   title="{{ $item['shop']['user']['user_name'] }}"
                                   class="btn-link">{{ $item['shop']['user']['user_name'] }}</a>
                            </p>
                        </td>
                        <td align="center">￥{{ $item['order_amount'] }}</td>
                        <td align="center">￥{{ $item['refund_money'] }}</td>
                        <td align="center">{{ format_time($item['add_time']) }}</td>
                        <td align="center">{{ format_time($item['disabled_time']) }}</td>
                        <td align="center">
                            <p>{{ $item['back_status_format'] }}</p>
                        </td>
                        <td align="center">
                            <div class="operate">
                                <a href="/user/back/info?id={{ $item['back_id'] }}" class="btn-link">查看</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <!--分页-->
            <div class="page">
                <div class="page-wrap fr">
                    <div id="pagination" class="pull-right page-box">
                        {!! $pageHtml !!}
                    </div>
                </div>
            </div>

        @else
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 30%;">商品信息/订单编号/退款编号</th>
                    <th style="width: 16%;">卖家</th>
                    <th style="width: 8%;">交易金额(整单)</th>
                    <th style="width: 8%;">退款金额</th>
                    <th style="width: 10%;">申请时间</th>
                    <th style="width: 10%;">超时时间</th>
                    <th style="width: 13%;">退款退货状态</th>
                    <th style="width: 5%;">操作</th>
                </tr>
                </thead>
            </table>
            <div class="tip-box">
                <img src="/images/noresult.png" class="tip-icon"/>
                <div class="tip-text">没有符合条件的记录</div>
            </div>
        @endif
    </div>

@endif


