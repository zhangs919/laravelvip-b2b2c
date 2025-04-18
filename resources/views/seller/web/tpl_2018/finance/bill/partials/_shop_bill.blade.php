<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w200 text-c">起止时间</th>
        <th class="w80 text-c">订单<br>总数量</th>
        <th class="colspan-th" style="width:600px">
            <div class="colspan-div">
                <p class="text-c">店铺应收金额</p>
                <p>
                                <span class="w90 text-c">
                                    付款金额
                                    <br>
                                    （不含运费）
                                </span>
                    <span class="w70 text-c">
                                    平台承担
                                    <br>
                                    活动款
                                </span>
                    <span class="w40 text-c">运费</span>
                    <span class="w60 text-c">额外<br>配送费</span>
                    <span class="w40 text-c">包装费</span>
                    <span class="w40 text-c">积分<br>抵扣</span>
                    <span class="w40 text-c">平台<br>佣金</span>
{{--                    <span class="w40 text-c">站点<br>佣金</span>--}}
                </p>
            </div>
        </th>
        <th class="w80 text-c">本期<br>应结</th>
        <th class="w100 text-c">结算<br>状态</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr id="" class="toggle-btn cur-p bill_info">
        <td>{{ $item['start_date'] }} - {{ $item['end_date'] }} </td>
        <td class="text-c">{{ $item['order_count'] ?? 0 }}</td>
        <td>
            <div class="colspan-div">
                <span class="w90 c-green text-c">{{ $item['order_amount'] }}</span>
                <span class="w70 c-green text-c">+{{ $item['activity_money'] }}</span>
                <span class="w40 c-green text-c">+{{ $item['shipping_amount'] }}</span>
                <span class="w60 c-green text-c">+{{ $item['other_shipping_fee'] }}</span>
                <span class="w40 c-green text-c">+{{ $item['packing_fee'] }}</span>
                <span class="w40 c-red text-c">-{{ $item['integral_money'] }}</span>
                <span class="w40 c-red text-c">-{{ $item['should_amount'] }}</span>
{{--                <span class="w40 c-red text-c">-{{ $item['site_money'] }}</span>--}}
            </div>
        </td>
        <td class="text-c">{{ $item['gain_commission'] }}</td>
        <td class="text-c">
            <!-- -->
            <font class="c-green">{{ $item['chargeoff_status_format'] }}</font>
            <!-- -->
        </td>
        <td class="handle">
            <a href="shop-orders-info?id={{ $item['id'] }}">查看</a>
{{--            <a href="javascript:void(0)" class='show_panel'>支付汇总</a>--}}
        </td>
    </tr>
    <tr class="toggle-panel" style="display: none">
        <td colspan="6">
            <table>
                <tr>
{{--                    <td class="text-c w120">支付宝支付</td>--}}
                    <td class="text-c w120">微信支付</td>
{{--                    <td class="w120 text-c">银联支付</td>--}}
{{--                    <td class="w120 text-c">余额支付</td>--}}
{{--                    <td class="w120 text-c">货到付款</td>--}}
{{--                    <td class="w120 text-c">店铺购物卡支付</td>--}}
                </tr>
                <tr>
{{--                    <td class="c-green text-c">{{ $item['alipay'] ?? 0.00 }}</td>--}}
                    <td class="c-green text-c">{{ $item['weixin'] ?? 0.00 }}</td>
{{--                    <td class="c-green text-c">{{ $item['union'] ?? 0.00 }}</td>--}}
{{--                    <td class="c-green text-c">{{ $item['surplus'] ?? 0.00 }}</td>--}}
{{--                    <td class="c-green text-c">{{ $item['is_cod'] ?? 0.00 }}</td>--}}
{{--                    <td class="c-green text-c">{{ $item['store_card'] ?? 0.00 }}</td>--}}
                </tr>
            </table>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
