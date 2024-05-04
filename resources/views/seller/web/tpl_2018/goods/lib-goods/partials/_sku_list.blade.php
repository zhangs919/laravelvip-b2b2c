<div class="modal-body">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-c">SKU编号</th>
            <th class="text-c">SKU图片</th>
            <th>SKU规格</th>
            <th>SKU货号</th>
            <th>SKU价格（元）</th>
            <th class="text-c">条形码</th>
        </tr>
        </thead>
        <tbody>

        @foreach($sku_list as $v)
            <tr>
                <td class="text-c">{{ $v->sku_id }}</td>
                <td class="sku-goods-img text-c">
                    <img src="{{ get_image_url($v->sku_image, 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"
                         class="goods-thumb"/>
                </td>
                <td>
                    @if(!empty($v->spec_ids))
                        {!! implode('<br>', explode(' ', $v->spec_names)) !!}
                    @else
                        无
                    @endif
                </td>
                <td>
                    <a href="javascript:void(0);" class="goods_sn" data-sku_id={{ $v->sku_id }}>{{ $v->goods_sn }}</a>
                </td>
                <td>

                    <a href="javascript:void(0);" class="goods_price"
                       data-sku_id={{ $v->sku_id }}>{{ $v->goods_price }}</a>

                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_barcode"
                       data-sku_id={{ $v->sku_id }}>{{ $v->goods_barcode }}</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>