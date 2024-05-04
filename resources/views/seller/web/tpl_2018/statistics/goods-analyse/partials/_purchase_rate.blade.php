<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w80">编号</th>
        <th class="w200">商品名称</th>
        <th class="text-c w100">访问人气</th>
        <th class="text-c w100">销售量</th>
        <th class="text-c w100">访问购买率</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($list))
        @foreach($list as $item)
            <tr>
                <td class="text-c">{{ $item['goods_id'] }}</td>
                <td>
                    <a class="goods-name" href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}" target="_blank" title="{{ $item['goods_name'] }}">{{ $item['goods_name'] }}</a>
                </td>
                <td class="text-c">{{ $item['click_count'] }}</td>
                <td class="text-c">{{ $item['goods_number'] }}</td>
                <td class="text-c">{{ round(($item['goods_number'] / $item['click_count']), 2) }}</td>
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
