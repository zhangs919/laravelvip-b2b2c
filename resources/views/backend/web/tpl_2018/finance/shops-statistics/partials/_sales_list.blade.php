<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w70" data-sortname="shop_id">编号</th>
        <th class="w150" data-sortname="shop_name">店铺名称</th>
        <th class="text-c w120" data-sortname="users_count">下单会员数</th>
        <th class="text-c w120" data-sortname="order_count">下单量</th>
        <th class="text-c w120" data-sortname="order_amount">下单金额（元）</th>
        <th class="text-c w120" data-sortname="order_count_valid">有效订单量</th>
        <th class="text-c w150" data-sortname="order_amount_valid">有效订单金额（元）</th>
        <th class="text-c w120" data-sortname="back_count">退款数量</th>
        <th class="text-c w150" data-sortname="back_amount">退款金额（元）</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)

        <tr>
            <td class="text-c">{{ $item->shop_id }}</td>
            <td>{{ $item->shop_name }}</td>
            <td class="text-c">{{ $item->users_count }}</td>
            <td class="text-c">{{ $item->order_count }}</td>
            <td class="text-c">{{ $item->order_amount }}</td>
            <td class="text-c">{{ $item->order_count_valid }}</td>
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