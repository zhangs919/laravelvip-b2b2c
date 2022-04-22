@if(!empty($pickup))
    @foreach($pickup as $v)
        <!-- -->
        <li class="logistics-item clearfix">
            <h3>自提点名称：{{ $v['pickup_name'] }}</h3>
            <div class="logistics-inner">
                <div class="logistics-img">
                    <img src="{{ get_image_url($v['pickup_images']) }}">
                </div>
                <a class="logistics-info" href="/index/information/amap?dest={{ $v['address_lng'] }},{{ $v['address_lat'] }}&title={{ $v['pickup_name'] }}">
                    <p class="logistics-address">{{ $v['pickup_address'] }}</p>

                    <p class="pickup-desc">商家推荐：{!! $v['pickup_desc'] !!}</p>

                </a>

                <a class="logistics-phone" href="tel:{{ $v['pickup_tel'] }}"></a>

            </div>
        </li>
    @endforeach
@else
    <div class="no-data-div">
        <div class="no-data-img">
            <img src="/images/bg_empty_data.png" />
        </div>
        <dl>
            <dt>暂无相关记录</dt>
        </dl>
    </div>
@endif