<tr data-goods-mix-sku-id="{{ $goods_info->sku_id }}" data-goods-mix-goods-id="{{ $goods_info->goods_id }}">
    <td>
        <a href="{{ route('pc_show_goods',['goods_id'=>$goods_info->goods_id]) }}" target=_blank>{{ $goods_info->goods_name }}</a>
        <input type="hidden" id="{{ $goods_info->goods_id }}-spu" name="goods_sku[]" value="{{ $sku_ids }}">
        <input type="hidden" name="goods_spu[]" value="{{ $goods_info->goods_id }}">
        <input type="hidden" name="goods_sku_act_price[]" value="" class="{{ $goods_info->goods_id }}-sku_price calculation_price">
    </td>
    <td>{{ $goods_price }}</td>

    <td>
        @if(count(explode(',', $sku_ids)) > 1)
            <a class="btn btn-warning btn-sm show-sku" data-goods-id="{{ $goods_info->goods_id }}">设置参与套餐规格</a>
        @else
            <p>---</p>
        @endif
    </td>

    <td class="handle">
        <a href="javascript:void(0);" data-sku-id="{{ $goods_info->sku_id }}" data-goods-id="{{ $goods_info->goods_id }}" data-goods-price="{{ $goods_price }}" class="del border-none">删除</a>
    </td>
</tr>