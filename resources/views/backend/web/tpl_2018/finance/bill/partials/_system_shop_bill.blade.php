<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">

        </th>
        <th class="text-c w100">起止时间</th>
        <th class="text-c w100">所属店铺</th>
        <th class="text-c w90">订单总数量</th>
        <th class="colspan-th w500">
            <div class="colspan-div">
                <p class="text-c">应付店铺金额</p>
                <p>
                    <span class="text-c w150">付款金额（不含运费）</span>
                    <span class="text-c w100">平台承担活动款</span>
                    <span class="text-c w70">运费</span>
                    <span class="text-c w80">平台佣金</span>

                </p>
            </div>
        </th>
        <th class="text-c w80">本期应结</th>
        <th class="text-c w100">结算状态</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
        <tr id="" class="toggle-btn cur-p bill_info">
            <td class="tcheck">
                <input type="checkbox" class="checkBox" />
            </td>
            <td>{{ $item['start_date'] }} - {{ $item['end_date'] }} </td>
            <td class="text-c">{{ $item['shop']['shop_name'] }}</td>
            <td class="text-c">{{ $item['order_count'] }}</td>
            <td class="w500">
                <div class="colspan-div">
                    <span class="w150 c-green text-c">{{ $item['order_amount'] }}</span>
                    <span class="w100 c-green text-c">+{{ $item['activity_money'] }}</span>
                    <span class="w70 c-green text-c">+{{ $item['shipping_fee'] }}</span>
                    <span class="w80 c-red text-c">-{{ $item['should_amount'] }}</span>
                </div>
            </td>
            <td class="text-c">{{ $item['gain_commission'] }}</td>
            <td class="text-c">
                <!-- -->
                <font class="c-green">{{ $item['chargeoff_status_format'] }}</font>
                <!-- -->
            </td>
            <td class="handle">
                @if($item['chargeoff_status'] == 1)
                    <a href="javascript:void(0)" class="statement" data-id="{{ $item['id'] }}">结算</a>
                @endif
                <a href="shop-orders-info?id={{ $item['id'] }}">查看</a>
{{--                <a href="javascript:void(0)" class='show_panel'>支付汇总</a>--}}
            </td>
        </tr>
{{--        <tr class="toggle-panel" style="display: none">--}}
{{--            <td colspan="7">--}}
{{--                <table>--}}
{{--                    <tr>--}}
{{--                        <td class="text-c w120">支付宝支付</td>--}}
{{--                        <td class="text-c w120">微信支付</td>--}}
{{--                        <td class="w120 text-c">银联支付</td>--}}
{{--                        <td class="w120 text-c">余额支付</td>--}}
{{--                        <td class="w120 text-c">货到付款</td>--}}
{{--                        <td class="w120 text-c">店铺购物卡支付</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="c-green text-c">{{ $item['alipay'] }}</td>--}}
{{--                        <td class="c-green text-c">{{ $item['weixin'] }}</td>--}}
{{--                        <td class="c-green text-c">{{ $item['union'] }}</td>--}}
{{--                        <td class="c-green text-c">{{ $item['surplus'] }}</td>--}}
{{--                        <td class="c-green text-c">{{ $item['is_cod'] }}</td>--}}
{{--                        <td class="c-green text-c">{{ $item['store_card'] }}</td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--            </td>--}}
{{--        </tr>--}}
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox table-list-checkbox-all" title="全选/全不选">
        </td>
        <td colspan="7">
            <div class="pull-left">
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
                <!--<a class="btn btn-default m-r-5">批量结算</a>-->
{{--                <button class="btn btn-default m-r-5 apply_count" type="button">合计</button>--}}
            </div>
            <div class="pull-right page-box">

                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
