
<table id='table_list' class="table table-hover m-b-0">
    <thead>
    <tr>
        <th class="w200">店铺名称</th>
        <th>当日订单</th>
        <th>订单总数量</th>
        <th>商品数量</th>
        <th>图片总大小</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td>{{ $v->shop_name }}</td>
        <td>{{ $v->today_orders }}</td>
        <td>{{ $v->order_count }}</td>
        <td>{{ $v->goods_count }}</td>
        <td>{{ $v->image_total_size ?? '--' }}</td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>