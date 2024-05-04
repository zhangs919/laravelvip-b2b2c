<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="w150 text-c" data-sortname="order_sn">订单号</th>
        <th class="w90" data-sortname="add_time">下单时间</th>
        <th class="w90" data-sortname="pay_time">付款时间</th>
        <th class="w120 text-c" data-sortname="order_amount">付款/退款金额</th>
        <th class="w120">付款/退款方式</th>
        <th class="w100" data-sortname="store_id">网点</th>
        <th class="w80" data-sortname="group_id">分组</th>
        <th class="w80 text-c">红包金额</th>
        <th class="w80 text-c">红包数量</th>
        <th class="w80 text-c">赠品数量</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    @foreach($list as $item)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="">
        </td>
        <td class="text-c">{{ $item['order_sn'] }}</td>
        <td>{{ $item->add_time_format }}</td>
        <td>{{ $item->pay_time_format }}</td>
        <td class="text-c">
            +
            {{ $item['order_amount'] }}
        </td>
        <td>{{ $item['pay_type'] }}</td>
        <td>{{ $item['store_name'] }}</td>
        <td>{{ $item['group_name'] }}</td>
        <td class="text-c">{{ $item['bonus'] }}</td>
        <td class="text-c">
            <a class="c-blue">0</a>
        </td>
        <td class="text-c">
            <a class="c-blue">{{ $item['gift_count'] }}</a>
        </td>
        <td class="handle">
            <a href="/trade/order/info.html?id={{ $item['order_id'] }}">订单详情</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="11">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
