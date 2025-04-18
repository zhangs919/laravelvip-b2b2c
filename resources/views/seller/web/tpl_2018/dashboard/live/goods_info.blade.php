<tr data-live-sku-id="{{ $goods_info->sku_id }}" data-live-goods-id="{{ $goods_info->goods_id }}">
    <td>
        {{ $goods_info->goods_name }}
        <input type="hidden" name="goods_sku[]" value="{{ $goods_info->sku_id }}">
        <input type="hidden" name="goods_spu[]" value="{{ $goods_info->goods_id }}">
    </td>
    <td class="text-c">
        <input class="form-control w60" type="text" name="activity_price[]" data-rule-required="true" data-msg-required="促销价不能为空！" data-rule-min="0.01" data-rule-max="9999999">
    </td>
    <td>￥{{ $goods_info->goods_price }}</td>
    <td>{{ $goods_info->goods_number }}</td>
    <td class="text-c">
        <input class="form-control w60" type="text" name="activity_stock[]" data-rule-required="true" data-msg-required="活动库存不能为空！" data-rule-min="1" data-rule-digits="true" data-rule-max="9999999">
    </td>
    <td class="handle">
        <a href="javascript:void(0);" data-sku-id="{{ $goods_info->sku_id }}" data-goods-id="{{ $goods_info->goods_id }}" class="del border-none">删除</a>
    </td>
</tr>