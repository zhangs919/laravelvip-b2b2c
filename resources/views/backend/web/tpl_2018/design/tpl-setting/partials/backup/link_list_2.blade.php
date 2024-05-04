<span class="goods-name" style="max-width: 90px;">{{ $link_data['title'] ?? '' }}</span>
<input type="hidden" name="link" value="{{ $link_data['link'] ?? '' }}" class="areaLinkInfo">
<a href="javascript:void(0)" class="btn goods-picker btn-default" data-goods_id="{{ $link_data['goods_id'] ?? '' }}">选择商品</a>