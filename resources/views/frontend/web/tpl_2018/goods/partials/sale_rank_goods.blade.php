@if(!empty($sale_top_list))
    <div class="aside-con">
        <h2 class="aside-tit">销量排行榜</h2>
        <ul class="aside-list">

            @foreach($sale_top_list as $v)
                <li>
                    <!--售罄-->
                    @if($v['goods_number'] <= 0)
                        <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" class="sell-out"></a>
                    @endif
                    <div class="p-img">
                        <a target="_blank" title="{{ $v['goods_name'] }}" href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" style="">
                            <img class="lazy" alt="" src="/images/common/blank.png" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450">
                        </a>
                    </div>
                    <div class="p-name">
                        <a target="_blank" title="{{ $v['goods_name'] }}" href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}">{{ $v['goods_name'] }}</a>
                    </div>
                    <div class="p-price">
                        <span class="sale-price second-color">￥{{ $v['goods_price'] }}</span>
                        <span class="sale-num">销量：{{ $v['sale_num'] }}</span>
                    </div>
                </li>
            @endforeach

        </ul>
    </div>
@endif