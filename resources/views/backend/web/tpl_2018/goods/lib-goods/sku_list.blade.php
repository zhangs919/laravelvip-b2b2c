<table class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w80">SKU编号</th>
        <th class="w70">SKU图片</th>
        <th>SKU规格</th>
        <th class="w70">SKU货号</th>
        <th class="w120">SKU价格（元）</th>
        <th class="w70">SKU库存</th>
        <th class="w100 text-c">条形码</th>
        <th class="w80 handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($skuList as $v)
    <tr>
        <td class="text-c">{{ $v->sku_id }}</td>
        <td class="sku-goods-img">
            <img src="{{ get_image_url($v->sku_image, 'goods_image') }}" class="goods-thumb" />
        </td>
        <td>
            @if(!empty($v->spec_ids))
                {!! implode('<br>', explode(' ', $v->spec_names)) !!}
            @else
                无
            @endif
        </td>
        <td>{{ $v->goods_sn }}</td>
        <td>{{ $v->goods_price }}</td>
        <td>{{ $v->goods_number }}</td>
        <td class="text-c">{{ $v->goods_barcode }}</td>
        <td class="handle">
            <a href="/lib-{{ $v->sku_id }}.html" target="_blank">查看</a>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>