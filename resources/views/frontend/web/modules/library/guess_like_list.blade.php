@foreach($guess_like_goods as $v)
<li>
    <div class="p-img">
        <a target="_blank" title="{{ $v->goods_name }}" href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}">
            <img alt="" src="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220">
        </a>
    </div>
    <div class="p-name">
        <a target="_blank" title="{{ $v->goods_name }}" href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}">{{ $v->goods_name }}</a>
    </div>
    <div class="p-comm">
        <span class="p-price second-color">￥{{ $v->goods_price }}</span>
        <a class="p-comm-num" href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}#goods_evaluate" target="_blank" href="javascript:;">评论：{{ $v->comment_num }}</a>
    </div>
</li>
@endforeach
<input type="hidden" id="user_like_page" value="{{ $user_like_page }}" />