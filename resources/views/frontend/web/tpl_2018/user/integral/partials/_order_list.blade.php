<div id="table_list">
    <table class="table">
        <colgroup>
            <col style="width: 38%;">
            <col style="">
            <col style="">
            <col style="width: 12%;">
            <col style="width: 11%;">
            <col style="width: 12%;">
        </colgroup>
        <thead>
        <tr>
            <th>兑换商品</th>
            <th>兑换积分</th>
            <th>兑换数量</th>
            <th>合计（积分）</th>
            <th>交易状态</th>
            <th>交易操作</th>
        </tr>
        </thead>
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
                        <col style="width: 40%;">
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: 12%;">
                        <col style="width: 11%;">
                        <col style="width: 12%;">
                    </colgroup>
                    <tbody>
                    <tr class="trade-order-info">
                        <td colspan="6">
                            <label>
                                <!-- <input type="checkbox" name="order_delete" value="{{ $v['order_id'] }}" /> -->
                                <span style="">{{ format_time($v['add_time'], 'Y-m-d H:i:s') }}</span>
                            </label>
                            <span>兑换单号：</span>
                            <span>{{ $v['order_sn'] }}</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

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
                    </tr>
                    @foreach($v['goods_list'] as $oKey=>$goods)

                    <tr>
                        <td class="goods-info @if($oKey > 0){{ 'border-top' }}@endif">
                            <div style="overflow: hidden;">
                                <a class="goods-img" href="/integralmall/goods-{{ $goods['goods_id'] }}.html" target="_blank">
                                    <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </a>
                                <div class="item-con">
                                    <div class="item-name">
                                        <a href="/integralmall/goods-{{ $goods['goods_id'] }}.html" target="_blank">
                                            <span>{{ $goods['goods_name'] }}</span>
                                        </a>
                                        <a href="/user/order/info?id={{ $v['order_id'] }}"> </a>
                                    </div>
                                </div>

                            </div>
                        </td>

                        <td class="goods-price @if($oKey > 0){{ 'border-top' }}@endif">

                            <p class="del">￥{{ $goods['goods_price'] }}</p>

                            <p class="second-color">{{ $goods['goods_points'] }} 积分</p>
                            <div class="goods-active exchange">
                                <a>积分兑换</a>
                            </div>
                        </td>

                        <td class="goods-operate">{{ $goods['goods_number'] }}</td>

                        <td class="goods-payment" rowspan="1">
                            <p>
                                <b>{{ $goods['goods_integral'] }}积分</b>
                            </p>




                            <p>
                                <a class="phone-order">{{ $v['order_from_format'] }}</a>
                            </p>
                        </td>

                        <td class="trading-status" rowspan="1">
                            <div class="operate">
                                <a target="_blank">{{ $v['order_status_format'] }}</a>
                            </div>
                            <div class="operate">
                                <a href="/user/integral/order-info?id={{ $v['order_id'] }}">兑换单详情</a>
                            </div>
                        </td>

                        <td class="trading-operate" rowspan="1">
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>
