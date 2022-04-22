<!-- 默认缓载图片 -->
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
<!-- 手机端精品推荐模板 -->
<!-- -->




<!---->

<div id="">
    <div class=" clearfix">

        @foreach($m_goods_list as $v)
        <ul class="product single_item info">
            <li>
                <div class="goods-info">
                    <div class="item-tag-box">
                        <!---->
                        <!---->
                    </div>
                    <div class="goods-pic">
                        <a href="{{ route('pc_show_goods', ['goods_id' => $v->goods_id]) }}" title="{{ $v->goods_name }}" style="display: block;">
                            <img class="" src="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $v->goods_name }}" data-original-webp="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp/quality,q_75">
                        </a>
                    </div>
                    <div class="goods-name">
                        <a href="{{ route('pc_show_goods', ['goods_id' => $v->goods_id]) }}" title="{{ $v->goods_name }}">{{ $v->goods_name }}</a>
                    </div>
                    <div class="price price-color">
                        <span>￥{{ $v->goods_price }}</span>
                    </div>
                </div>
            </li>
        </ul>
        @endforeach

    </div>
    <!-- 分页 -->

</div>