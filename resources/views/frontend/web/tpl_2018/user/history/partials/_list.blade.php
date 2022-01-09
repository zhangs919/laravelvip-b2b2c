<ul id="tab_list" class="img-item-list clearfix">
    <!---->
    @if($list->isEmpty())
        <!-- 没有历史记录的展示 -->
        <div class="tip-box">
            <img src="/frontend/images/noresult.png" class="tip-icon">
            <div class="tip-text">暂无足迹</div>
        </div>
        <!---->
    @else
        @foreach($list as $v)
        <!---->
        <li class="fav-item">
            <div class="controller-box">
                <div class="controller-img-box">
                    <a href="{{ route('pc_show_goods', ['goods_id' => $v->goods_id]) }}" class="controller-img-link" target="_blank" title="">
                        <img class="controller-img" src="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $v->goods_name }}">
                    </a>
                </div>

                <a class="add-cat-btn" data-tip="{{ $v->history_id }}" title="加入购物车">加入购物车</a>
                <a class="del-btn" data-tip="{{ $v->history_id }}" title="删除宝贝">删除</a>
            </div>
            <div class="item-title">

                <a title="{{ $v->goods_name }}" target="_blank" href="{{ route('pc_show_goods', ['goods_id' => $v->goods_id]) }}"> {{ $v->goods_name }} </a>
            </div>
            <div class="price-container">
                <div class="price-box">
                    <!---->

                    <!---->
                    <div class="price">
                        <strong class="second-color">￥{{ $v->goods_price }}</strong>
                    </div>
                    <!---->
                    <!---->
                </div>
            </div>
        </li>
        @endforeach
    @endif
</ul>