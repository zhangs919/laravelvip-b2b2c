<tr data-gift-sku-id="{{ $goods_info->sku_id }}" data-gift-goods-id="{{ $goods_info->goods_id }}">
    <td>
        {{ $goods_info->goods_name }}
        <input type="hidden" name="goods_spu[]" value="{{ $goods_info->goods_id }}">
    </td>
    <td>
        <input class="form-control form-control-sm ipt" type="text" id="{{ $goods_info->goods_id }}-goods_number" name=act_number[] data-goods-id={{ $goods_info->goods_id }} value='1' data-max={{ $goods_info->goods_number }} data-rule-callback='act_callback'>
    </td>
    <td>
        <input class="form-control form-control-sm ipt" type="text" value={{ $goods_info->goods_number }} disabled='disabled'>
    </td>
    <td class="handle">
        <a href="javascript:void(0);" data-sku-id="{{ $goods_info->sku_id }}" data-goods-id="{{ $goods_info->goods_id }}" data-goods-price="{{ $goods_info->goods_price }}" class="del border-none">删除</a>
    </td>
</tr>