@if(count(explode(',', $sku_ids)) > 1)
    <tr data-limit-discount-sku-id="{{ $goods_info->sku_id }}" data-limit-discount-goods-id="{{ $goods_info->goods_id }}">
        <td>
            {{ $goods_info->goods_name }}
            <input type="hidden" name="goods_spu[]" value="{{ $goods_info->goods_id }}">
            <input type="hidden" name="goods_spu_discount[]" value="{{ $goods_info->goods_id }}-10" class="{{ $goods_info->goods_id }}-discount calculation_price">
            <input type="hidden" name="goods_spu_reduce[]" value="" class="{{ $goods_info->goods_id }}-reduce calculation_price">
            <input type="hidden" name="goods_spu_set[]" value="" class="{{ $goods_info->goods_id }}-set calculation_price">
        </td>
        <td class="text-c">{{ $goods_price }}</td>
        <!-- <td class="text-c after-price after-price-{{ $goods_info->goods_id }} " data-goods-id="{{ $goods_info->goods_id }}">￥588.00</td> -->
        <td class="text-c" id="{{ $goods_info->goods_id }}-discount-val">--</td>
        <td class="text-c" id="{{ $goods_info->goods_id }}-reduce-val">--</td>
        <td class="text-c" id="{{ $goods_info->goods_id }}-set-val">--</td>
        <td class="text-c">{{ $goods_info->goods_number }}</td>
        <td class="handle">
            <a href="javascript:void(0);" data-sku-id="{{ $goods_info->sku_id }}" data-goods-id="{{ $goods_info->goods_id }}" data-goods-price="{{ $goods_info->goods_price }}" class="border-none set-price">折扣价设置</a>
            <a href="javascript:void(0);" data-sku-id="{{ $goods_info->sku_id }}" data-goods-id="{{ $goods_info->goods_id }}" data-goods-price="{{ $goods_info->goods_price }}" class="del border-none">删除</a>
        </td>
    </tr>
@else
    <tr data-limit-discount-sku-id="{{ $goods_info->sku_id }}" data-limit-discount-goods-id="{{ $goods_info->goods_id }}">
        <td>
            {{ $goods_info->goods_name }}
            <input type="hidden" name="goods_spu[]" value="{{ $goods_info->goods_id }}">
            <input type="hidden" name="goods_spu_discount[]" value="{{ $goods_info->goods_id }}-10" class="{{ $goods_info->goods_id }}-discount calculation_price">
            <input type="hidden" name="goods_spu_reduce[]" value="" class="{{ $goods_info->goods_id }}-reduce calculation_price">
            <input type="hidden" name="goods_spu_set[]" value="" class="{{ $goods_info->goods_id }}-set calculation_price">
        </td>
        <td class="text-c">{{ $goods_price }}</td>
        <!-- <td class="text-c after-price after-price-{{ $goods_info->goods_id }} " data-goods-id="{{ $goods_info->goods_id }}">￥221.00</td> -->
        <td class="text-c"><input type="text" class="form-control small sm-height limit_discount_sku sku-act_price-{{ $goods_info->sku_id }} discount discount-{{ $goods_info->sku_id }}" value="" data-sku_id="{{ $goods_info->sku_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_price="221.00" data-type="discount" data-rule-callback="act_price_callback"></td>
        <td class="text-c"><input type="text" class="form-control small sm-height limit_discount_sku sku-act_price-{{ $goods_info->sku_id }} mark_down mark_down-{{ $goods_info->sku_id }}" value="" data-sku_id="{{ $goods_info->sku_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_price="221.00" data-type="mark_down" data-rule-callback="act_mark_down_callback"></td>
        <td class="text-c"><input type="text" class="form-control small sm-height limit_discount_sku sku-act_price-{{ $goods_info->sku_id }} set_act_price set_act_price-{{ $goods_info->sku_id }}" value="" data-sku_id="{{ $goods_info->sku_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_price="221.00" data-type="set_act_price" data-rule-callback="set_price_callback"></td>
        <td class="text-c">{{ $goods_info->goods_number }}</td>
        <td class="handle">
            <a href="javascript:void(0);" data-sku-id="{{ $goods_info->sku_id }}" data-goods-id="{{ $goods_info->goods_id }}" data-goods-price="{{ $goods_info->goods_price }}" class="del border-none">删除</a>
        </td>
    </tr>
@endif