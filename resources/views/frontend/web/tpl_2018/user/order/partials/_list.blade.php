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
                        <button class="btn-default" type="button" onclick="order_deletes(1)">批量删除订单</button>

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
                        <td colspan="3">
                                        <span class="shop-logo">
                                            <img src="/images/shop-type/shop-icon1.png" />
                                        </span>
                            <a href="{{ route('pc_shop_home', ['shop_id'=>$v['shop_id']]) }}" title="{{ $v['shop_name'] }}" target="_blank" class="shop-name">{{ $v['shop_name'] }}</a>

                            <span class="ww-light">
                                <!-- 旺旺不在线 i 标签的 class="ww-offline" -->

                                <!-- s等于1时带文字，等于2时不带文字 -->
                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                    <span></span>
                                </a>

                            </span>

                        </td>
                        <td colspan="2" class="order-recycle-bin">
                            <a onclick="order_delete({{ $v['order_id'] }},1)">
                                <i class="iconfont">&#xe6bf;</i>
                                <span>删除</span>
                            </a>
                        </td>
                    </tr>
                    <!-- 订单商品列表 -->

                    @foreach($v['goods_list'] as $og)
                    <tr>
                        <td class="goods-info">
                            <div style="overflow: hidden;">
                                <a class="goods-img" href="{{ route('pc_show_goods', ['goods_id' => $og['goods_id']]) }}" target="_blank">
                                    <img src="{{ get_image_url($og['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </a>
                                <div class="item-con">
                                    <div class="item-name">
                                        <a href="{{ route('pc_show_goods', ['goods_id' => $og['goods_id']]) }}" target="_blank">
                                            <span>{{ $og['goods_name'] }}</span>
                                        </a>
                                        <a href="/user/order/info.html?id={{ $v['order_id'] }}">
                                            <!-- <span>[</span><span>交易快照</span><span>]</span> -->
                                        </a>
                                    </div>

                                    @if(!empty($og['saleservice']))
                                    <div class="item-icons">
                                        @foreach($og['saleservice'] as $service)
                                        <a class="item-icon" href="javascript:void(0);" title="【{{ $service['contract_name'] }}】{{ $service['contract_desc'] }}">
                                            <img src="{{ $service['contract_image'] }}" />
                                        </a>
                                        @endforeach

                                    </div>
                                    @endif

                                </div>
                            </div>
                        </td>
                        <td class="goods-price">


                            <p class="second-color"> {{ $og['goods_price'] }} </p>

                            <!-- -->


                            {{--todo 判断是否是限时活动或满减送 是就显示 否则隐藏--}}
                            <div class="goods-active group-buy">
                                <a>团购</a>
                            </div>






                        </td>
                        <td class="goods-num">{{ $og['goods_number'] }}</td>

                        <td class="goods-operate">







                            <div class="operate">

                                {{--取消订单--}}
                                <a class="cancel-payment edit-order" data-id="{{ $v['order_id'] }}" data-type="cancel">取消订单</a>


                            </div>

                        </td>

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
                                    ( 含快递：￥{{ $v['shipping_fee'] }} )
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
                                交易关闭
                            </div>

                            <div class="operate">
                                <a href="/user/order/info.html?id={{ $v['order_id'] }}">订单详情</a>
                            </div>

                        </td>

                        <!-- 拆分订单判断 -->




                        <td class="trading-operate dismantle" rowspan="{{ $v['rowspan'] }}"></td>
                        <script type="text/javascript">
                            //商家拒绝取消订单申请
                            try {
                                $(".shop-cancel-reason ").hover(function() {
                                    $(this).find('.cancel-reason-box').show();
                                }, function() {
                                    $(this).find('.cancel-reason-box').hide();
                                });
                            } catch (e) {
                            }
                        </script>





                    </tr>
                    <!-- 商品自带赠品 -->
                    @endforeach


                    </tbody>
                </table>
            </div>
        @endforeach


        <!--分页-->
        <div class="page">
            <div class="page-wrap fr">
                <div id="pagination" class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </div>
        </div>
    @endif

</div>
