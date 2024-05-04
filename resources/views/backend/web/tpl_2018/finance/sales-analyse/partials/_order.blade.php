<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w80" data-sortname="shop_id">店铺ID</th>
        <th class="w150" data-sortname="shop_name">店铺名称</th>
        <th class="text-c w100" data-sortname="order_count">总订单量</th>
        <th class="text-c w100" data-sortname="order_count_valid">有效订单量</th>
        <th class="text-c w120" data-sortname="close_count">已关闭订单量</th>
        <th class="text-c w150" data-sortname="order_amount">订单总金额（元）</th>
        <th class="text-c w150" data-sortname="order_amount_valid">有效订单金额（元）</th>
        <th class="text-c w80" data-sortname="back_count">退款量</th>
        <th class="text-c w150" data-sortname="back_amount">退款总金额（元）</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $item)
        <tr>
            <td class="text-c">{{ $item->shop_id }}</td>
            <td>{{ $item->shop_name }}</td>
            <td class="text-c">{{ $item->order_count }}</td>
            <td class="text-c">{{ $item->order_count_valid }}</td>
            <td class="text-c">{{ $item->close_count }}</td>
            <td class="text-c">{{ $item->order_amount }}</td>
            <td class="text-c">{{ $item->order_amount_valid }}</td>
            <td class="text-c">{{ $item->back_count }}</td>
            <td class="text-c">{{ $item->back_amount }}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="9">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
