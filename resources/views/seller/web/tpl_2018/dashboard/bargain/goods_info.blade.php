
@if($goods_info['sku_num'] > 1)
    <tr data-bargain-sku-id="{{ $goods_info['sku_id'] }}" data-bargain-goods-id="{{ $goods_info['goods_id'] }}">
        <td class="w50">
            <input type="checkbox" class="checkbox table-list-checkbox" value="{{ $goods_info['goods_id'] }}" data-sku_ids="{{ $sku_ids }}" data-sku_id="{{ $goods_info['sku_id'] }}" data-sku_num="{{ $goods_info['sku_num'] }}" data-sku_open="{{ $goods_info['sku_open'] }}" data-goods_price="{{ $goods_info['min_price'] }}" data-min_price="{{ $goods_info['min_price'] }}" data-max_price="{{ $goods_info['min_price'] }}" />
        </td>
        <td>
            {{ $goods_info['goods_name'] }}
            <input type="hidden" name="goods_spu[]" value="{{ $goods_info['goods_id'] }}">
            <input type="hidden" name="goods_spu_original_price[]" value="{{ $goods_info['goods_spu_original_price'] }}" class="{{ $goods_info['goods_id'] }}-original-price calculation_price">
            <input type="hidden" name="goods_spu_act_price[]" value="{{ $goods_info['goods_spu_act_price'] }}" class="{{ $goods_info['goods_id'] }}-act-price calculation_price">
            <input type="hidden" name="goods_spu_act_stock[]" value="{{ $goods_info['goods_spu_act_stock'] }}" class="{{ $goods_info['goods_id'] }}-act-stock calculation_price">
            <input type="hidden" name="goods_spu_freight_id[]" value="{{ $goods_info['goods_spu_freight_id'] }}" class="{{ $goods_info['goods_id'] }}-freight-id calculation_price">
            <input type="hidden" name="goods_spu_ratio[]" value="{{ $goods_info['goods_spu_ratio'] }}" class="{{ $goods_info['goods_id'] }}-ratio calculation_price">
            <input type="hidden" name="sku_ids[]" id="{{ $goods_info['goods_id'] }}-sku-ids" value="{{ $sku_ids }}">
        </td>
        <td class="text-c">{{ $goods_info['goods_price'] }}</td>
        <td class="text-c" id="{{ $goods_info['goods_id'] }}-original-price-val"></td>
        <td class="text-c" id="{{ $goods_info['goods_id'] }}-act-price-val"></td>
        <td class="text-c" id="{{ $goods_info['goods_id'] }}-act-stock-val"><input type="text" class="form-control small sm-height bargain_sku sku-act_stock-{{ $goods_info['sku_id'] }} act_stock act-stock-{{ $goods_info['sku_id'] }}" name="sku_act_stock_{{ $goods_info['sku_id'] }}" value="{{ $goods_info['act_stock'] }}" data-sku_id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}" data-goods_price="{{ $goods_info['goods_price'] }}" data-type="act_stock" data-rule-callback="list_act_stock_callback" data-rule-required="true" readOnly="true"></td>
        <td class="text-c" id="{{ $goods_info['goods_id'] }}-ratio-val"></td>
        <td class="text-c">
            <select id="{{ $goods_info['goods_id'] }}-freight-id-val" class="form-control w100 bargain_sku freight_id_sku sku-freight_id-{{ $goods_info['sku_id'] }} freight_id freight-id-{{ $goods_info['sku_id'] }}" data-sku_ids="{{ $sku_ids }}" data-sku_open="{{ $goods_info['sku_open'] }}" data-sku_id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}">
                <option value="0">店铺统一运费</option>
{{--                <option value="22">全国</option>--}}
            </select></td>
        <td class="handle">
            <a href="javascript:void(0);" data-sku-id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}" data-goods_price="{{ $goods_info['goods_price'] }}" class="border-none set-price">设置</a>
            <a href="javascript:void(0);" data-sku-id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}" data-goods_price="{{ $goods_info['goods_price'] }}" class="del border-none">删除</a>
        </td>
    </tr>
@else
    <tr data-bargain-sku-id="{{ $goods_info['sku_id'] }}" data-bargain-goods-id="{{ $goods_info['goods_id'] }}">
        <td class="w50">
            <input type="checkbox" class="checkbox table-list-checkbox" value="{{ $goods_info['goods_id'] }}" data-sku_ids="{{ $goods_info['sku_id'] }}" data-sku_id="{{ $goods_info['sku_id'] }}" data-sku_num="{{ $goods_info['sku_num'] }}" data-sku_open="{{ $goods_info['sku_open'] }}" data-goods_price="{{ $goods_info['min_price'] }}" data-min_price="{{ $goods_info['min_price'] }}" data-max_price="{{ $goods_info['max_price'] }}" />
        </td>
        <td>
            {{ $goods_info['goods_name'] }}
            <input type="hidden" name="goods_spu[]" value="{{ $goods_info['goods_id'] }}">
            <input type="hidden" name="goods_spu_original_price[]" value="{{ $goods_info['goods_spu_original_price'] }}" class="{{ $goods_info['goods_id'] }}-original-price calculation_price">
            <input type="hidden" name="goods_spu_act_price[]" value="{{ $goods_info['goods_spu_act_price'] }}" class="{{ $goods_info['goods_id'] }}-act-price calculation_price">
            <input type="hidden" name="goods_spu_act_stock[]" value="{{ $goods_info['goods_spu_act_stock'] }}" class="{{ $goods_info['goods_id'] }}-act-stock calculation_price">
            <input type="hidden" name="goods_spu_freight_id[]" value="{{ $goods_info['goods_spu_freight_id'] }}" class="{{ $goods_info['goods_id'] }}-freight-id calculation_price">
            <input type="hidden" name="goods_spu_ratio[]" value="{{ $goods_info['goods_spu_ratio'] }}" class="{{ $goods_info['goods_id'] }}-ratio calculation_price">
            <input type="hidden" name="sku_ids[]" id="{{ $goods_info['goods_id'] }}-sku-ids" value="{{ $goods_info['sku_id'] }}">
        </td>
        <td class="text-c">{{ $goods_info['goods_price'] }}</td>
        <td class="text-c"><input type="text" class="form-control small sm-height bargain_sku original_price_sku sku-original_price-{{ $goods_info['sku_id'] }} original_price original-price-{{ $goods_info['sku_id'] }}" value="0" data-sku_id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}" data-goods_price="{{ $goods_info['goods_price'] }}" data-type="original_price" data-rule-trigger=".act-price-{{ $goods_info['sku_id'] }}" data-rule-callback="list_original_price_callback"></td>
        <td class="text-c"><input type="text" class="form-control small sm-height bargain_sku act_price_sku sku-act_price-{{ $goods_info['sku_id'] }} act_price act-price-{{ $goods_info['sku_id'] }}" value="0" data-sku_id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}" data-goods_price="{{ $goods_info['goods_price'] }}" data-type="act_price" data-rule-trigger=".original-price-{{ $goods_info['sku_id'] }}" data-rule-callback="list_act_price_callback"></td>
        <td class="text-c"><input type="text" class="form-control small sm-height bargain_sku sku-act_stock-{{ $goods_info['sku_id'] }} act_stock act-stock-{{ $goods_info['sku_id'] }}" value="{{ $goods_info['act_stock'] }}" data-sku_id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}" data-goods_price="{{ $goods_info['goods_price'] }}" data-type="act_stock" data-rule-callback="list_act_stock_callback"></td>
        <td class="text-c"><input type="text" class="form-control small sm-height m-r-2 bargain_sku sku-ratio-{{ $goods_info['sku_id'] }} ratio ratio-{{ $goods_info['sku_id'] }}" value="" data-sku_id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}" data-goods_price="{{ $goods_info['goods_price'] }}" data-type="ratio" data-rule-callback="list_ratio_callback">%</td>
        <td class="text-c"><select id="{{ $goods_info['goods_id'] }}-freight-id-val" class="form-control w100 bargain_sku freight_id_sku sku-freight_id-{{ $goods_info['sku_id'] }} freight_id freight-id-{{ $goods_info['sku_id'] }}" data-sku_ids="{{ $goods_info['sku_id'] }}" data-sku_open="0" data-sku_id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}" data-type="freight">
                <option value="0">店铺统一运费</option>
{{--                <option value="22">全国</option>--}}
            </select></td>
        <td class="handle">
            <a href="javascript:void(0);" data-sku-id="{{ $goods_info['sku_id'] }}" data-goods_id="{{ $goods_info['goods_id'] }}" data-goods_price="{{ $goods_info['goods_price'] }}" class="del border-none">删除</a>
        </td>
    </tr>
@endif
