<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck w10">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="w100">订单号</th>
{{--        <th class="w80 text-c">下单时间</th>--}}
        <th class="w120 text-c">
            确认收货日期
        </th>
        <th class="w120 text-c">出账日期</th>
        <th class="colspan-th" style="width: 540px;">
            <div class="colspan-div">
                <p class="text-c">店铺应收金额</p>
                <p>
                    <span class="w80 text-c">付款金额
{{--                        <br>（不含运费）--}}
                    </span>
{{--                    <span class="w60 text-c">--}}
{{--                                    平台承担 <br> 活动款--}}
{{--                                </span>--}}
{{--                    <span class="w40 text-c">运费</span>--}}
{{--                    <span class="w40 text-c">--}}
{{--                                    额外 <br> 配送费--}}
{{--                                </span>--}}
{{--                    <span class="w40 text-c">包装费</span>--}}
{{--                    <span class="w40 text-c">--}}
{{--                                    积分 <br> 抵扣--}}
{{--                                </span>--}}
{{--                    <span class="w40 text-c">--}}
{{--                                    平台 <br> 佣金--}}
{{--                                </span>--}}
{{--                    <span class="w40 text-c">--}}
{{--                                    站点 <br> 佣金--}}
{{--                                </span>--}}
                </p>
            </div>
        </th>
{{--        <th class="w70  text-c">--}}
{{--            本期 <br> 应结--}}
{{--        </th>--}}
        <th class="w80  text-c">
            付款方式
        </th>
        <th class="w80  text-c">
            状态
        </th>
        <th class="handle w120 p-r-0">操作</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    <!-- -->
    @foreach($list as $item)
    <tr class="toggle-btn cur-p bill_info">
        <td class="tcheck">
            <input type="checkbox" class="checkBox" />
        </td>
        <td>
            {{ $item['order_sn'] }}
            <div>
            </div>
        </td>
{{--        <td class="text-c">{{ format_time($item['add_time'], 'Y-m-d') }} </td>--}}
        <td class="text-c">{{ $item['confirm_take_time'] }} </td>
        <td class="text-c">{{ $item['created_at'] }} </td>
        <td>
            <div class="colspan-div">
                <span class="w80 c-green text-c">+{{ $item['order_amount'] }}</span>
{{--                <span class="w60 c-green text-c">+{{ $item['activity_money'] }}</span>--}}
{{--                <span class="w40 c-green text-c">+{{ $item['shipping_fee'] }}</span>--}}
{{--                <span class="w40 c-green text-c">+{{ $item['other_shipping_fee'] }}</span>--}}
{{--                <span class="w40 c-green text-c">+{{ $item['packing_fee'] }}</span>--}}
{{--                <span class="w40 c-red text-c">-{{ $item['integral_money'] }}</span>--}}
{{--                <span class="w40 c-red text-c">-{{ $item['system_money'] }}</span>--}}
{{--                <span class="w40 c-red text-c">-{{ $item['site_money'] }}</span>--}}
            </div>
        </td>
{{--        <td class="text-c">--}}
{{--            <span class="c-green">{{ $item['order_amount'] }}</span>--}}
{{--        </td>--}}
        <td class="text-c">线上付款</td>
        <td class="text-c">
            <font class="c-green">{{ $item['chargeoff_status_format'] }}</font>
        </td>
        <td class="handle p-r-0">
            <a href="/trade/order/info?id={{ $item['order_id']}}">查看</a>
{{--            <a href="javascript:void(0)" class='show_panel'>支付汇总</a>--}}
        </td>
    </tr>
    <tr class="toggle-panel" style="display: none">
        <td colspan="10">
            <table>
                <tr>
                    <td class="text-c w120">支付宝进账</td>
                    <td class="text-c w120">微信支付进账</td>
                    <td class="w120 text-c">银联支付进账</td>
                    <td class="w120 text-c">余额支付进账</td>
                    <td class="w120 text-c">货到付款金额</td>
                    <td class="w120 text-c">店铺购物卡金额</td>
                </tr>
                <tr>
                    <td class="c-green text-c">{{ $item['alipay'] }}</td>
                    <td class="c-green text-c">{{ $item['weixin'] }}</td>
                    <td class="c-green text-c">{{ $item['union'] }}</td>
                    <td class="c-green text-c">{{ $item['surplus'] }}</td>
                    <td class="c-green text-c">{{ $item['is_cod'] }}</td>
                    <td class="c-green text-c">{{ $item['store_card'] }}</td>
                </tr>
            </table>
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="2">合计：{{ $total_data['total_order_amount'] }}</td>
        <td class="subtotal" colspan="8">
            <div class="text-r">
                            <span>
{{--                                店铺线下支付平台金额： <em id="minus">0</em>--}}
                            </span>
            </div>
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="10">
            <!-- <input type="checkbox" class="allCheckBox checkBox"/> -->
{{--            <div class="pull-left p-l-0">--}}
{{--                <button class="btn btn-default apply_count" type="button">合计店铺欠款</button>--}}
{{--            </div>--}}
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
