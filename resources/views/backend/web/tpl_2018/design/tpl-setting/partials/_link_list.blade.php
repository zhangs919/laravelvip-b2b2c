@if($link_type == 0)
    <input class="form-control w150 areaLinkInfo" type="text" name="link" value="{{ $link ?? '' }}" placeholder="输入链接地址">
@elseif($link_type == 2)
    <span class="goods-name" style="max-width: 90px;">{{ $link_data['title'] ?? '' }}</span>
    <input type="hidden" name="link" value="{{ $link_data['link'] ?? '' }}" class="areaLinkInfo">
    <a href="javascript:void(0)" class="btn goods-picker btn-default" data-goods_id="{{ $link_data['goods_id'] ?? '' }}">选择商品</a>
@else
    <select name="link" class="form-control  areaLinkInfo w150">

        @if(!empty($link_data))
            <option value="" >-- 请选择 --</option>
            @foreach($link_data as $v)
                <option value="{{ $v['link'] }}" @if($link == $v['link']) selected="selected" @endif>{!! $v['title'] !!}</option>
            @endforeach
        @endif

    </select>
@endif