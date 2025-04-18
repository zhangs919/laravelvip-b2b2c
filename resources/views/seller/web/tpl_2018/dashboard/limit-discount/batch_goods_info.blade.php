{{--有规格商品--}}
{{--<tr data-limit-discount-sku-id="59" data-limit-discount-goods-id="26" data-goods_id="26" data-goods_sn='' data-goods_name='啊啊啊' data-goods_barcode='' >--}}
{{--    <td class="w50">--}}
{{--        <input type="checkbox" class="checkbox table-list-checkbox" value="26" data-sku_id="59" data-sku_open="1" data-sku_num="2" data-goods_price="90.00" data-min_price="90.00" data-max_price="190.00" />--}}
{{--    </td>--}}
{{--    <td>--}}
{{--        啊啊啊--}}
{{--        <!-- 商品额外信息 -->--}}
{{--        <input type="hidden" name="goods_spu[]" value="26">--}}
{{--        <input type="hidden" name="goods_spu_discount[]" value="59-10,60-10" class="26-discount calculation_price">--}}
{{--        <input type="hidden" name="goods_spu_reduce[]" value="" class="26-reduce calculation_price">--}}
{{--        <input type="hidden" name="goods_spu_set[]" value="" class="26-set calculation_price">--}}
{{--        <input type="hidden" name="goods_spu_stock[]" value="59-99,60-99" class="26-stock calculation_price">--}}
{{--    </td>--}}
{{--    <td class="text-c">￥90.00-￥190.00</td>--}}
{{--    <td class="text-c" id="26-discount-val">10-10</td>--}}
{{--    <td class="text-c" id="26-reduce-val">-</td>--}}
{{--    <td class="text-c" id="26-set-val">-</td>--}}
{{--    <td class="text-c" id="26-goods-price"></td>--}}
{{--    <td class="text-c" id="26-stock-val"><input type="text" class="form-control small sm-height sku-act_stock-59 set_act_stock set_act_stock-59" name="sku_act_stock_59" value="198" data-sku_id="59" data-goods_id="26" data-goods_price="90.00-190.00" data-type="set_act_stock" data-rule-callback="list_set_act_stock_callback" data-rule-required="true" readOnly="true"></td>--}}
{{--    <td class="handle">--}}
{{--        <a href="javascript:void(0);" data-sku-id="59" data-goods_id="26" data-goods_price="90.00-190.00" class="border-none set-price">设置</a>--}}
{{--        <a href="javascript:void(0);" data-sku-id="59" data-goods_id="26" data-goods_price="90.00-190.00" class="del border-none">删除</a>--}}
{{--    </td>--}}
{{--</tr>--}}

{{--无规格商品--}}
@if(isset($is_join) && $is_join == 0)
    <tr data-limit-discount-sku-id="{{ $goods_info->sku_id }}" data-limit-discount-goods-id="{{ $goods_info->goods_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_sn='{{ $goods_info->goods_sn }}' data-goods_name='{{ $goods_info->goods_name }}' data-goods_barcode='{{ $goods_info->goods_barcode }}' >
        <td class="w50">
            <input type="checkbox" class="checkbox table-list-checkbox" value="{{ $goods_info->goods_id }}" data-sku_id="{{ $goods_info->sku_id }}" />
        </td>
        <td>
            {{ $goods_info->goods_name }}
            <input type="hidden" name="exclude_goods_ids[]" value="{{ $goods_info->goods_id }}">
        </td>
        <td class="text-c">￥{{ $goods_info->goods_price }}</td>
        <td class="handle">
            <a href="javascript:void(0);" data-sku-id="{{ $goods_info->sku_id }}" data-goods_id="{{ $goods_info->goods_id }}" class="del-no-join border-none">删除</a>
        </td>
    </tr>
@else
    <tr data-limit-discount-sku-id="{{ $goods_info->sku_id }}" data-limit-discount-goods-id="{{ $goods_info->goods_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_sn='{{ $goods_info->goods_sn }}' data-goods_name='{{ $goods_info->goods_name }}' data-goods_barcode='{{ $goods_info->goods_barcode }}' >
        <td class="w50">
            <input type="checkbox" class="checkbox table-list-checkbox" value="{{ $goods_info->goods_id }}" data-sku_id="{{ $goods_info->sku_id }}" data-sku_open="{{ $goods_info->sku_open }}" data-sku_num="1" data-goods_price="{{ $goods_info->goods_price }}" data-min_price="{{ $goods_info->goods_price }}" data-max_price="{{ $goods_info->goods_price }}" />
        </td>
        <td>
            {{ $goods_info->goods_name }}
            <!-- 商品额外信息 -->
            <input type="hidden" name="goods_spu[]" value="{{ $goods_info->goods_id }}">
            <input type="hidden" name="goods_spu_discount[]" value="{{ $goods_info->sku_id }}-10" class="{{ $goods_info->goods_id }}-discount calculation_price">
            <input type="hidden" name="goods_spu_reduce[]" value="" class="{{ $goods_info->goods_id }}-reduce calculation_price">
            <input type="hidden" name="goods_spu_set[]" value="" class="{{ $goods_info->goods_id }}-set calculation_price">
            <input type="hidden" name="goods_spu_stock[]" value="{{ $goods_info->sku_id }}-{{ $goods_info->goods_number }}" class="{{ $goods_info->goods_id }}-stock calculation_price">
        </td>
        <td class="text-c">￥{{ $goods_info->goods_price }}</td>
        <td class="text-c"><input type="text" id="sku_discount_{{ $goods_info->sku_id }}" class="form-control small sm-height limit_discount_sku sku-act_price-{{ $goods_info->sku_id }} discount discount-{{ $goods_info->sku_id }}" value="10" data-sku_id="{{ $goods_info->sku_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_price="{{ $goods_info->goods_price }}" data-type="discount" data-rule-callback="list_act_price_callback"></td>
        <td class="text-c"><input type="text" id="sku_mark_down_{{ $goods_info->sku_id }}" class="form-control small sm-height limit_discount_sku sku-act_price-{{ $goods_info->sku_id }} mark_down mark_down-{{ $goods_info->sku_id }}" data-sku_id="{{ $goods_info->sku_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_price="{{ $goods_info->goods_price }}" data-type="mark_down" data-rule-callback="list_act_mark_down_callback"></td>
        <td class="text-c"><input type="text" id="sku_act_price_{{ $goods_info->sku_id }}" class="form-control small sm-height limit_discount_sku sku-act_price-{{ $goods_info->sku_id }} set_act_price set_act_price-{{ $goods_info->sku_id }}" data-sku_id="{{ $goods_info->sku_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_price="{{ $goods_info->goods_price }}" data-type="set_act_price" data-rule-callback="list_set_price_callback"></td>
        <td class="text-c" id="{{ $goods_info->goods_id }}-goods-price"></td>
        <td class="text-c"><input type="text" class="form-control small sm-height sku-act_stock-{{ $goods_info->sku_id }} set_act_stock set_act_stock-{{ $goods_info->sku_id }}" value="{{ $goods_info->goods_number }}" data-sku_id="{{ $goods_info->sku_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_price="{{ $goods_info->goods_price }}" data-type="set_act_stock" data-rule-callback="list_set_act_stock_callback"></td>
        <td class="handle">
            <a href="javascript:void(0);" data-sku-id="{{ $goods_info->sku_id }}" data-goods_id="{{ $goods_info->goods_id }}" data-goods_price="{{ $goods_info->goods_price }}" class="del border-none">删除</a>
        </td>
    </tr>
@endif