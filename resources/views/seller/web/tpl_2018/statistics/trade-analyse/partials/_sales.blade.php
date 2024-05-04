<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w150">订单编号</th>
        <th class="w100">买家账号</th>
        <th class="text-c w120">下单时间</th>
        <th class="text-c w150">订单总金额（元）</th>
        <th class="text-c w100">订单状态</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($list))
        @foreach($list as $item)
            <tr>
                <td>{{ $item['order_sn'] }}</td>
                <td>{{ $item['user_name'] }}</td>
                <td class="text-c">{{ format_time($item['add_time']) }}</td>
                <td class="text-c">{{ $item['order_amount'] }}</td>
                <td class="text-c">{{ $item['order_status_format'] }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
