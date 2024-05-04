<div class="main" id="table_list">
    <div class="shops-box shops-box2">
        <div class="shops-list tablelist-append">

            @foreach($list as $item)
            <div class="shops-info valid SZY-IS-OPEN SZY-IS-STORE avalid" data-shop_id="{{ $item['shop_id'] }}">
                <a href="/shop/{{ $item['shop_id'] }}.html">
                    <div class="shop-logo">
                        <img src="{{ get_image_url($item['shop_image'], 'shop_image') }}" alt="{{ $item['shop_name'] }}">
                    </div>
                    <dl class="shop-content">
                        <dt>
                            <span class="shop-name">{{ $item['shop_name'] }}</span>
                        </dt>
                        <dd class="is-opening-{{ $item['shop_id'] }}">
                            <span class="shop-rank">
                                <img src="{{ get_image_url($item['credit_img']) }}" title="{{ $item['credit_name'] }}" />
                            </span>
                            <span class="shop-rank-num">{{ $item['score'] }}</span>
                            <span class="shop-sold">
                                销量
                                {{ $item['sale_num'] }}
                            </span>
                        </dd>
                        <dd>
                            <span class="shop-start-price">起送价  {{ $item['start_price'] > 0 ? $item['start_price_format'] : '无' }}</span>
                            <div class="shop-distance-item valid" data-shop_id="7" data-shop_lng="102.724117" data-shop_lat="24.985968">
                                <span class="shop-time" id="shop_time_7"> 14<em>小时</em>28<em>分钟</em> </span>
                                <span class="line"></span>
                                <span class="shop-distance-num" id="shop_distance_num_7">1153.56km</span>
                            </div>
{{--                            <span class="shop-time"> 65小时13分钟 </span>--}}
{{--                            <span class="line"></span>--}}
{{--                            <span class="shop-distance-num" id="shop_distance_num_{{ $item['shop_id'] }}">{{ $item['distance'] }}km</span>--}}
                        </dd>
                        <div class="activity-tag">
                            {{--<span class="label-text">满2999减100</span>--}}
                            {{--<span class="label-text">满5000减200</span>--}}
                            <span class="label-text">包邮</span>
                            <span class="label-text blue">支持自提</span>
                            <span class="label-text bonus">送红包</span>
                        </div>
                    </dl>
                </a>
                <span class="shop-distance SZY-MAP-NAV" style="cursor: pointer;" id="distance_{{ $item['shop_id'] }}"
                      data-lat="{{ $item['shop_lat'] }}" data-lng="{{ $item['shop_lng'] }}"
                      data-title="{{ $item['shop_name'] }}" data-content="{{ get_region_names_by_region_code($item['region_code']) }}{{ $item['address'] }}"> 导航 </span>
            </div>
            @endforeach

        </div>
    </div>
    <!-- 分页 -->
    <!-- 分页 -->
    <div id="pagination" class="page">
        <div class="more-loader-spinner"><div class="is-loaded"><div class="loaded-bg">我是有底线的</div></div></div>
        <script data-page-json="true" type="text" id="page_json">{!! $page_json !!}</script>
    </div>
</div>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<script>
    $().ready(function() {
        tablelist = $("#table_list").tablelist({
            params: $("#searchForm").serializeJson()
        });
    });

    //
    // 滚动加载数据
    $(window).on('scroll', function() {
        if (($(document).scrollTop() + $(window).height() + 50) > $(document).height()) {
            if ($.isFunction($.pagemore)) {
                $.pagemore({
                    callback: function(result) {
                        is_opening();
                    }
                });
            }
        }
    });

    //
</script>