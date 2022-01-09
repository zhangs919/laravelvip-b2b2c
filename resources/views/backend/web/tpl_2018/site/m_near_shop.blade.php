<!-- 手机端附近店铺模板 -->
<!--附近商家start-->
<!-- 店铺列表 start-->
<div id="">
    <div class=" nearby-shops-list">

        @foreach($m_near_shop as $v)
        <div class="nearby-shops-info SZY-IS-OPEN valid" data-shop_id="{{ $v->shop_id }}">
            <a href="{{ route('mobile_shop_home', ['shop_id'=>$v->shop_id]) }}">
                <div class="shop-logo">
                    <img src="{{ get_image_url($v->shop_logo, 'shop_logo') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="{{ $v->shop_name }}">
                </div>
                <dl class="shop-content">
                    <dt>
                        <span class="shop-name">{{ $v->shop_name }}</span>
                    </dt>
                    <dd class="is-opening-38">
<span class="shop-rank">
<img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/" title="" />
</span>
                        <span class="shop-rank-num">5.00</span>
                        <span class="shop-sold">
销量
                            <!---->
1

</span>
                    </dd>
                    <dd>
                        <span class="shop-start-price">起送  ￥{{ $v->start_price }}</span>

                        <span class="shop-time">
58
<em>小时</em>
8
<em>分钟</em>
</span>
                        <span class="line"></span>
                        <span class="shop-distance-num">1743.68km</span>

                    </dd>

                    <div class="activity-tag">

                        <span class="label-text blue">支持自提</span>

                    </div>

                </dl>
            </a>
            <span class="shop-distance SZY-MAP-NAV" style="cursor: pointer;" id="distance_{{ $v->shop_id }}" data-lat="{{ $v->shop_lat }}" data-lng="{{ $v->shop_lng }}" data-title="{{ $v->shop_name }}" data-content="{{ $v->address }}"> 导航 </span>
        </div>
        @endforeach

    </div>
    <!-- 分页 -->

</div>